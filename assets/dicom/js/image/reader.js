/** 
 * Image module.
 * @module image
 */
var BAMBOO = BAMBOO || {};
/**
 * Namespace for image related functions.
 * @class image
 * @namespace BAMBOO
 * @static
 */
BAMBOO.image = BAMBOO.image || {};

/**
 * Get data from an input image using a canvas.
 * @method getDataFromImage
 * @static
 * @param {Image} image The image.
 * @return {Mixed} The corresponding view and info.
 */
BAMBOO.image.getDataFromImage = function(image)
{
    // draw the image in the canvas in order to get its data
    var canvas = document.getElementById('imageLayer');
    canvas.width = image.width;
    canvas.height = image.height;
    var ctx = canvas.getContext('2d');
    ctx.drawImage(image, 0, 0, image.width, image.height);
    // get the image data
    var imageData = ctx.getImageData(0, 0, image.width, image.height);
    // remove alpha
    // TODO support passing the full image data
    var buffer = [];
    var j = 0;
    for( var i = 0; i < imageData.data.length; i+=4 ) {
        buffer[j] = imageData.data[i];
        buffer[j+1] = imageData.data[i+1];
        buffer[j+2] = imageData.data[i+2];
        j+=3;
    }
    // create BAMBOO Image
    var imageSize = new BAMBOO.image.Size(image.width, image.height);
    // TODO: wrong info...
    var imageSpacing = new BAMBOO.image.Spacing(1,1);
    var sliceIndex = image.index ? image.index : 0;
    var BAMBOOImage = new BAMBOO.image.Image(imageSize, imageSpacing, buffer, [[0,0,sliceIndex]]);
    BAMBOOImage.setPhotometricInterpretation("RGB");
    // meta information
    var meta = {};
    meta.BitsStored = 8;
    BAMBOOImage.setMeta(meta);
    // view
    var view = new BAMBOO.image.View(BAMBOOImage);
    view.setWindowLevelMinMax();
    // properties
    var info = {};
    if( image.file )
    {
        info.fileName = { "value": image.file.name };
        info.fileType = { "value": image.file.type };
        info.fileLastModifiedDate = { "value": image.file.lastModifiedDate };
    }
    info.imageWidth = { "value": image.width };
    info.imageHeight = { "value": image.height };
    // return
    return {"view": view, "info": info};
};

/**
 * Get data from an input buffer using a DICOM parser.
 * @method getDataFromDicomBuffer
 * @static
 * @param {Array} buffer The input data buffer.
 * @return {Mixed} The corresponding view and info.
 */
BAMBOO.image.getDataFromDicomBuffer = function(buffer)
{
    // DICOM parser
    var dicomParser = new BAMBOO.dicom.DicomParser();
    // parse the buffer
    dicomParser.parse(buffer);

	if( !dicomParser.dicomElements.Columns )
	{
		var byteArray = new Uint8Array(buffer);
		var dataSet = dicomdirParser.parseDicomdir(byteArray);

		return {"view": null, "info": dataSet, "dicomdir":true};
	}
    var view = dicomParser.createImage();
    // return
    return {"view": view, "info": dicomParser.dicomElements};
};

