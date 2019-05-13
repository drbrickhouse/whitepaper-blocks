/**
 * BLOCK: whitepaper-block-wrapper
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './style.scss';
import './editor.scss';

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { InnerBlocks, InspectorControls, MediaUpload } = wp.editor;
const { Button, PanelBody, PanelRow, TextControl } = wp.components;

/**
 * Register: aa Gutenberg Block.
 *
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
registerBlockType( 'whitepaper/block-whitepaper-block-wrapper', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'Wrapper' ), // Block title.
	icon: 'editor-code', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'common', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
  attributes: {
    blockId: {
      type: 'string',
      default: null,
    },
		backgroundImage: {
			type: 'string',
			default: null,
		},
		backgroundImageProp: {
			type: 'string',
			default: null,
		}
  },
	keywords: [
		__( 'container' ),
		__( 'wrapper' ),
		__( 'section' ),
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
    function onIdChange(changes) {
			if(!changes) {
				changes = null;
			}
      props.setAttributes( {blockId: changes} );
    }

		function onImageSelect(imageObject) {
			if(!imageObject) {
				imageObject = null;
			}
      props.setAttributes( {backgroundImage: imageObject.sizes.full.url} );
			props.setAttributes( {backgroundImageProp: 'url(' + imageObject.sizes.full.url + ')' } )
    }

		function removeImage() {
			props.setAttributes( {backgroundImage: null} );
			props.setAttributes( {backgroundImageProp: null} );
		}

		function getImageButton(openEvent) {
			if(props.attributes.backgroundImage) {
		    return (
					<div className="image-container">
			      <img
			        src={ props.attributes.backgroundImage }
			        onClick={ openEvent }
			        className="image"
			      />
			        <Button
			          onClick={ removeImage }
			          className="button button-large"
			        >
			          Remove Image
			        </Button>
						</div>
		    );
		  } else {
		    return (
		      <div className="button-container">
		        <Button
		          onClick={ openEvent }
		          className="button button-large"
		        >
		          Pick an image
		        </Button>
		      </div>
		    );
		  }
		}

		return ([
      <InspectorControls>
        <PanelBody>
					<MediaUpload
						onSelect={onImageSelect}
						type="image"
						value={props.attributes.backgroundImage}
						render={({ open }) => getImageButton(open) }
					/>
          <TextControl
            label='Block ID'
            value={ props.attributes.blockId }
            onChange={onIdChange}
          />
        </PanelBody>
      </InspectorControls>,
			<div className={ props.className } id={ props.attributes.blockId } style={{backgroundImage: props.attributes.backgroundImageProp,}}>
				<InnerBlocks />
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
			<div className={ props.className } id={ props.attributes.blockId } style={{backgroundImage: props.attributes.backgroundImageProp,}}>
				<InnerBlocks.Content />
			</div>
		);
	},
} );
