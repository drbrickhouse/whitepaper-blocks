const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { InspectorControls, MediaUpload, InnerBlocks } = wp.editor;
const { PanelBody, TextControl } = wp.components;

import { renderImageUpload } from '../modules/functions';

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
registerBlockType( 'whitepaper-blocks/hero-block', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'Hero' ), // Block title.
  description: __('A customizable hero image block'),
	icon: 'slides', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'formatting', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
  attributes: {
    backgroundImage: {
			type: 'string',
			default: null,
		},
		backgroundImageStyle: {
			type: 'string',
			default: null,
		},
    blockId: {
      type: 'string',
      default: null,
    },
    heroClasses: {
			type: 'string',
			default: null,
		}
  },
	keywords: [
		__( 'hero' ),
		__( 'banner' ),
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
        <PanelBody>
					<MediaUpload
						label='Background Image'
						onSelect={(imageObject) => {
              setAttributes( {backgroundImage: imageObject.sizes.full.url} );
							setAttributes( {backgroundImageStyle: 'url(' + imageObject.sizes.full.url + ')'} );
            }}
						type="image"
						value={props.attributes.backgroundImage}
						render={({ open }) => renderImageUpload(open, props) }
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
          <TextControl
            label='Hero Classes'
            value={ props.attributes.heroClasses }
						help={__(<p>One or more HTML classes to be added to the hero image container. Separate classes with a space, but make sure that each class uses all lower case and dashes instead of spaces. This is a great place to use <a href="https://getbootstrap.com/docs/4.1/layout/grid/" target="_blank">Bootstrap rows or containers</a>.</p>)}
						placeholder='my-class'
            onChange={(changes) => {
              !changes ? setAttributes( {heroClasses: null} ) : setAttributes( {heroClasses: changes} );
            }}
          />
        </PanelBody>
      </InspectorControls>,
      <div className='block-wrap'>
        <div className='block-title'>Hero</div>
  			<div className={ [props.className, 'row'].filter(Boolean).join(' ') } id={ props.attributes.blockId } style={ {backgroundImage: props.attributes.backgroundImageStyle} }>
          <div className='col-md-12'>
            <div className='row whitepaper-block-inner'>
              <div className='col-md-12'>
                <div className={ [props.attributes.heroClasses, 'hero-overlay'].filter(Boolean).join(' ') }>
                  <div className='col-md-12'>
                    <InnerBlocks />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
		return (
      <div className={ [props.className, 'row'].filter(Boolean).join(' ') } id={ props.attributes.blockId } style={ {backgroundImage: props.attributes.backgroundImageStyle} }>
        <div className='col-md-12'>
          <div className='row whitepaper-block-inner'>
            <div className='col-md-12'>
              <div className={ [props.attributes.heroClasses, 'hero-overlay'].filter(Boolean).join(' ') }>
                <div className='col-md-12'>
                  <InnerBlocks.Content />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
		);
	},
} );
