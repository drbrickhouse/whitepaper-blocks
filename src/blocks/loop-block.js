const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { createElement } = wp.element;
const { InnerBlocks, InspectorControls } = wp.editor;
const { Button, PanelBody, TextControl, TextareaControl, SelectControl, ServerSideRender } = wp.components;
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
registerBlockType('whitepaper-blocks/loop-block', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'Loop' ), // Block title.
  description: __('A customizable loop block.'),
	icon: 'controls-repeat', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'formatting', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
  attributes: {
    blockId: {
      type: 'string',
      default: null
    },
    title: {
      type: 'string',
      default: null
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
      default: 'col-12'
    },
    beforeLoopLayout: {
      type: 'string',
      default: null
    },
    postLayout: {
      type: 'string',
      default: null
    },
    afterLoopLayout: {
      type: 'string',
      default: null
    },
    taxonomy: {
      type: 'string',
      default: null
    },
    taxonomyTerm: {
      type: 'string',
      default: null
    },
    offset: {
      type: 'string',
      default: 0
    }
  },
	keywords: [
		__( 'loop' ),
		__( 'query' )
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
          title='Loop Settings'
          initialOpen ={true}
        >
					<TextControl
            label='Block Title'
            value={ props.attributes.title }
            onChange={(changes) => {
              !changes ? setAttributes( {title: null} ) : setAttributes( {title: changes} );
            }}
          />
          <TextControl
            label='Block ID'
            value={ props.attributes.blockId }
            help={__('A unique HTML ID for this block. Make sure to use all lower case and dashes instead of spaces')}
            placeholder='my-id'
            onChange={(changes) => {
              !changes ? setAttributes( {blockId: null} ) : setAttributes( {blockId: changes} );
            }}
          />
          <SelectControl
            label='Post Type'
            value={ props.attributes.postType }
            options={ postTypes }
            help={__('What kind of posts do you want to show? You can choose blog posts, pages, or a custom post type.')}
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
            help={__(<p>One or more HTML classes to be added to each post in this block. Separate classes with a space, but make sure that each class uses all lower case and dashes instead of spaces. This is a great place to use <a href="https://getbootstrap.com/docs/4.1/layout/grid/" target="_blank">Bootstrap rows or containers</a>.</p>)}
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
            label='Before the Loop'
            value={ props.attributes.beforeLoopLayout }
            help={__(<p>Information to be placed before the loop. This will only be shown once, no matter how many posts are displayed. You can use HTML and <a href="https://getbootstrap.com/docs/4.1/layout/grid/" target="_blank">Bootstrap</a> for formatting. You can also use <a href="https://github.com/drbrickhouse/whitepaper-blocks#whitepaper-handlebars">WhitePaper Handlebars</a> to display dynamic information. This section is totally optional.</p>)}
            onChange={(changes) => {
              !changes ? setAttributes( {beforeLoopLayout: null} ) : setAttributes( {beforeLoopLayout: changes} );
            }}
          />
          <TextareaControl
            label='Post Layout'
            value={ props.attributes.postLayout }
            help={__(<p>How would you like the individual slides in the loop to be laid out? You can use HTML and <a href="https://getbootstrap.com/docs/4.1/layout/grid/" target="_blank">Bootstrap</a> for formatting. You can also use <a href="https://github.com/drbrickhouse/whitepaper-blocks#whitepaper-handlebars">WhitePaper Handlebars</a> to display dynamic information. If you are not sure, you can leave this blank and just use the default.</p>)}
            onChange={(changes) => {
              !changes ? setAttributes( {postLayout: null} ) : setAttributes( {postLayout: changes} );
            }}
          />
          <TextareaControl
            label='After the Loop'
            value={ props.attributes.afterLoopLayout }
            help={__(<p>Information to be placed after the loop. This will only be shown once, no matter how many posts are displayed. You can use HTML and <a href="https://getbootstrap.com/docs/4.1/layout/grid/" target="_blank">Bootstrap</a> for formatting. You can also use <a href="https://github.com/drbrickhouse/whitepaper-blocks#whitepaper-handlebars">WhitePaper Handlebars</a> to display dynamic information. This section is totally optional.</p>)}
            onChange={(changes) => {
              !changes ? setAttributes( {afterLoopLayout: null} ) : setAttributes( {afterLoopLayout: changes} );
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
          <TextControl
            label='Offset'
            value={ props.attributes.offset }
            type='number'
            onChange={(changes) => {
              setAttributes({offset: changes});
            }}
          />
        </PanelBody>
      </InspectorControls>,
      <div className='bock-wrap'>
        <div className='block-title'>Loop</div>
        <ServerSideRender
          block='whitepaper-blocks/loop-block'
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
