!function(e){function t(r){if(n[r])return n[r].exports;var l=n[r]={i:r,l:!1,exports:{}};return e[r].call(l.exports,l,l.exports,t),l.l=!0,l.exports}var n={};t.m=e,t.c=n,t.d=function(e,n,r){t.o(e,n)||Object.defineProperty(e,n,{configurable:!1,enumerable:!0,get:r})},t.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(n,"a",n),n},t.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},t.p="",t(t.s=0)}([function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});n(1)},function(e,t,n){"use strict";var r=n(2),l=(n.n(r),n(3)),a=(n.n(l),wp.i18n.__),o=wp.blocks.registerBlockType,u=wp.editor,c=u.InnerBlocks,i=u.InspectorControls,s=u.MediaUpload,m=wp.components,p=m.Button,b=m.PanelBody,d=(m.PanelRow,m.TextControl);o("whitepaper/block-whitepaper-block-wrapper",{title:a("Wrapper"),icon:"editor-code",category:"common",attributes:{blockId:{type:"string",default:null},backgroundImage:{type:"string",default:null},backgroundImageProp:{type:"string",default:null}},keywords:[a("container"),a("wrapper"),a("section")],edit:function(e){function t(t){t||(t=null),e.setAttributes({blockId:t})}function n(t){t||(t=null),e.setAttributes({backgroundImage:t.sizes.full.url}),e.setAttributes({backgroundImageProp:"url("+t.sizes.full.url+")"})}function r(){e.setAttributes({backgroundImage:null}),e.setAttributes({backgroundImageProp:null})}function l(t){return e.attributes.backgroundImage?wp.element.createElement("div",{className:"image-container"},wp.element.createElement("img",{src:e.attributes.backgroundImage,onClick:t,className:"image"}),wp.element.createElement(p,{onClick:r,className:"button button-large"},"Remove Image")):wp.element.createElement("div",{className:"button-container"},wp.element.createElement(p,{onClick:t,className:"button button-large"},"Pick an image"))}return[wp.element.createElement(i,null,wp.element.createElement(b,null,wp.element.createElement(s,{onSelect:n,type:"image",value:e.attributes.backgroundImage,render:function(e){return l(e.open)}}),wp.element.createElement(d,{label:"Block ID",value:e.attributes.blockId,onChange:t}))),wp.element.createElement("div",{className:e.className,id:e.attributes.blockId,style:{backgroundImage:e.attributes.backgroundImageProp}},wp.element.createElement(c,null))]},save:function(e){return wp.element.createElement("div",{className:e.className,id:e.attributes.blockId,style:{backgroundImage:e.attributes.backgroundImageProp}},wp.element.createElement(c.Content,null))}})},function(e,t){},function(e,t){}]);
