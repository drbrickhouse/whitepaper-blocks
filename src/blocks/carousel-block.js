const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { createElement } = wp.element;
const { InnerBlocks, InspectorControls } = wp.editor;
const { Button, PanelBody, TextControl, TextareaControl, SelectControl, ServerSideRender, ToggleControl } = wp.components;
const { withState } = wp.compose;
const { select } = wp.data;

// Getting a list of public CPTs
const postTypes = [];

fetch('/wp-json/whitepaper-api/post-types/public')
  .then(function(response) {
    return response.json();
  })
  .then(function(myJson) {
    for (let [key, val] of Object.entries(myJson)) {
      let obj = {value : key, label : val};
      postTypes.push(obj);
    }
  });

/**
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType('whitepaper-blocks/carousel-block', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'Carousel' ), // Block title.
  description: __('A customizable Bootstrap carousel block.'),
	icon: 'slides', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'formatting', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
  attributes: {
    blockId: {
      type: 'string',
      default: null
    },
    carouselClasses: {
      type: 'string',
      default: 'row no-gutters'
    },
    postType: {
      type: 'string',
      default: 'post'
    },
    numPosts: {
      type: 'string',
      default: 3
    },
    postClasses: {
      type: 'string',
      default: null
    },
    carouselLayout: {
      type: 'string',
      default: null
    },
    carouselIndicators: {
      type: 'boolean',
      default: false
    },
    carouselControls: {
      type: 'boolean',
      default: false
    },
    taxonomy: {
      type: 'string',
      default: null
    },
    taxonomyTerm: {
      type: 'string',
      default: null
    }
  },
	keywords: [
		__( 'carousel' ),
		__( 'slider' )
	],

	/**
	 * The edit function describes the structure of your block in the context of the editor.
	 * This represents what the editor will render when the block is used.
	 *
	 * The "edit" property must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 */
	edit: function( props ) {
    const { setAttributes } = props;

		return ([
      <InspectorControls>
        <PanelBody
          title='Carousel Settings'
          initialOpen ={true}
        >
          <TextControl
            label='Block ID *'
            value={ props.attributes.blockId }
            help={__('A unique HTML ID for this block. Make sure to use all lower case and dashes instead of spaces')}
            placeholder='my-id'
            required
            onChange={(changes) => {
              !changes ? setAttributes( {blockId: null} ) : setAttributes( {blockId: changes} );
            }}
          />
          <TextControl
            label='Carousel Classes'
            value={ props.attributes.carouselClasses }
            help={__(<p>One or more HTML classes to be added to the carousel container. Separate classes with a space, but make sure that each class uses all lower case and dashes instead of spaces. This is a great place to use <a href="https://getbootstrap.com/docs/4.1/layout/grid/" target="_blank">Bootstrap rows or containers</a>.</p>)}
            placeholder='my-class'
            onChange={(changes) => {
              !changes ? setAttributes( {carouselClasses: null} ) : setAttributes( {carouselClasses: changes} );
            }}
          />
          <SelectControl
            label='Post Type'
            value={ props.attributes.postType }
            help={__('What kind of posts do you want to show? You can choose blog posts, pages, or a custom post type.')}
            options={ postTypes }
            onChange={(changes) => {
              setAttributes({postType: changes});
            }}
          />
          <TextControl
            label='Number of Posts to Display'
            value={ props.attributes.numPosts }
            help={__('The maximum number of posts to be displayed from your selected post type')}
            type='number'
            onChange={(changes) => {
              setAttributes({numPosts: changes});
            }}
          />
          <TextControl
            label='Post Classes'
            value={ props.attributes.postClasses }
            help={__(<p>One or more CSS classes to be added to each post in this block. Separate classes with a space, but make sure that each class uses all lower case and dashes instead of spaces. This is a great place to use <a href="https://getbootstrap.com/docs/4.1/layout/grid/" target="_blank">Bootstrap columns</a>.</p>)}
            placeholder='my-class'
            onChange={(changes) => {
              !changes ? setAttributes( {postClasses: null} ) : setAttributes( {postClasses: changes} );
            }}
          />
        </PanelBody>
        <PanelBody
          title='Advanced Layout Settings'
          initialOpen ={false}
        >
          <TextareaControl
            label='Carousel Layout'
            value={ props.attributes.carouselLayout }
            help={__(<p>How would you like the individual slides in the loop to be laid out? You can use HTML and <a href="https://getbootstrap.com/docs/4.1/layout/grid/" target="_blank">Bootstrap</a> for formatting. You can also use <a href="https://github.com/drbrickhouse/whitepaper-blocks#whitepaper-handlebars">WhitePaper Handlebars</a> to display dynamic information. If you are not sure, you can leave this blank and just use the default.</p>)}
            onChange={(changes) => {
              !changes ? setAttributes( {carouselLayout: null} ) : setAttributes( {carouselLayout: changes} );
            }}
          />
          <ToggleControl
            label='Carousel Indicators'
            checked={ props.attributes.carouselIndicators }
            onChange={(changes) => {
              setAttributes({carouselIndicators: changes});
            }}
          />
          <ToggleControl
            label='Carousel Controls'
            checked={ props.attributes.carouselControls }
            onChange={(changes) => {
              setAttributes({carouselControls: changes});
            }}
          />
        </PanelBody>
        <PanelBody
          title='Advanced Query Settings'
          initialOpen ={false}
        >
          <TextControl
            label='Taxonomy'
            value={ props.attributes.taxonomy }
            placeholder='category'
            onChange={(changes) => {
              !changes ? setAttributes( {taxonomy: null} ) : setAttributes( {taxonomy: changes} );
            }}
          />
          <TextControl
            label='Taxonomy Term'
            value={ props.attributes.taxonomyTerm }
            placeholder='my-category'
            onChange={(changes) => {
              !changes ? setAttributes( {taxonomyTerm: null} ) : setAttributes( {taxonomyTerm: changes} );
            }}
          />
        </PanelBody>
      </InspectorControls>,
      <div className='block-wrap'>
        <div className='block-title'>Carousel</div>
        <ServerSideRender
          block='whitepaper-blocks/carousel-block'
          attributes={ props.attributes }
          className={ props.className }
        />
      </div>
		]);
	},

	/**
	 * The save function defines the way in which the different attributes should be combined
	 * into the final markup, which is then serialized by Gutenberg into post_content.
	 *
	 * The "save" property must be specified and must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 */
	save: function( props ) {
    // Rendered with PHP
		return null;
	},
});
