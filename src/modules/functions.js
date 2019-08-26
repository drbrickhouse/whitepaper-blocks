const { Button } = wp.components;

// Image upload render function to be used with MediaUpload compnent
function renderImageUpload(openEvent, props) {
  if(props.attributes.backgroundImage) {
    return (
      <div className="image-container">
        <img
          src={ props.attributes.backgroundImage }
          onClick={ openEvent }
          className="image"
        />
          <Button
            onClick={() => {
              props.setAttributes( { backgroundImage: null} );
              props.setAttributes( { backgroundImageStyle: null} );
            }}
            isLink
            isDestructive
            style={{marginTop: '15px', marginBottom: '15px'}}
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
          isPrimary
          style={{width: '100%', justifyContent: 'center', marginTop: '15px', marginBottom: '15px'}}
        >
          Select an Image
        </Button>
      </div>
    );
  }
}

export { renderImageUpload };
