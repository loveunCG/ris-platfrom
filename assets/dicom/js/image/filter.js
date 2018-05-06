/** 
 * Image module.
 * @module image
 */
var BAMBOO = BAMBOO || {};
BAMBOO.image = BAMBOO.image || {};
BAMBOO.image.filter = BAMBOO.image.filter || {};

/**
 * Threshold an image between an input minimum and maximum.
 * @class Threshold
 * @namespace BAMBOO.image.filter
 * @constructor
 */
BAMBOO.image.filter.Threshold = function()
{
    /**
     * Threshold minimum.
     * @property min
     * @private
     * @type Number
     */
    var min = 0;
    /**
     * Threshold maximum.
     * @property max
     * @private
     * @type Number
     */
    var max = 0;

    /**
     * Get the threshold minimum.
     * @method getMin
     * @return {Number} The threshold minimum.
     */
    this.getMin = function() { return min; };
    /**
     * Set the threshold minimum.
     * @method setMin
     * @param {Number} val The threshold minimum.
     */
    this.setMin = function(val) { min = val; };
    /**
     * Get the threshold maximum.
     * @method getMax
     * @return {Number} The threshold maximum.
     */
    this.getMax = function() { return max; };
    /**
     * Set the threshold maximum.
     * @method setMax
     * @param {Number} val The threshold maximum.
     */
    this.setMax = function(val) { max = val; };
    /**
     * Get the name of the filter.
     * @method getName
     * @return {String} The name of the filter.
     */
    this.getName = function() { return "Threshold"; };
    
    /**
     * Original image.
     * @property originalImage
     * @private
     * @type Object
     */
    var originalImage = null;
    /**
     * Set the original image.
     * @method setOriginalImage
     * @param {Object} image The original image.
     */
    this.setOriginalImage = function (image) { originalImage = image; };
    /**
     * Get the original image.
     * @method setOriginalImage
     * @return {Object} image The original image.
     */
    this.getOriginalImage = function () { return originalImage; };
};

/**
 * Transform the main image using this filter.
 * @method update
 * @return {Object} The transformed image.
 */ 
BAMBOO.image.filter.Threshold.prototype.update = function()
{
    var self = this;
    var imageMin = app.getImage().getDataRange().min;
    self.setOriginalImage( app.getImage() );
    var threshFunction = function(value){
        if(value<self.getMin()||value>self.getMax()) {
            return imageMin;
        }
        else {
            return value;
        }
    };
    return app.getImage().transform( threshFunction );
};

/**
 * Sharpen an image using a sharpen convolution matrix.
 * @class Sharpen
 * @namespace BAMBOO.image.filter
 * @constructor
 */
BAMBOO.image.filter.Sharpen = function()
{
    /**
     * Get the name of the filter.
     * @method getName
     * @return {String} The name of the filter.
     */
    this.getName = function() { return "Sharpen"; };
    /**
     * Original image.
     * @property originalImage
     * @private
     * @type Object
     */
    var originalImage = null;
    /**
     * Set the original image.
     * @method setOriginalImage
     * @param {Object} image The original image.
     */
    this.setOriginalImage = function (image) { originalImage = image; };
    /**
     * Get the original image.
     * @method setOriginalImage
     * @return {Object} image The original image.
     */
    this.getOriginalImage = function () { return originalImage; };
};

/**
 * Transform the main image using this filter.
 * @method update
 * @return {Object} The transformed image.
 */ 
BAMBOO.image.filter.Sharpen.prototype.update = function()
{
    this.setOriginalImage( app.getImage() );
    
    return app.getImage().convolute2D(
        [  0, -1,  0,
          -1,  5, -1,
           0, -1,  0 ] );
};

/**
 * Apply a Sobel filter to an image.
 * @class Sobel
 * @namespace BAMBOO.image.filter
 * @constructor
 */
BAMBOO.image.filter.Sobel = function()
{
    /**
     * Get the name of the filter.
     * @method getName
     * @return {String} The name of the filter.
     */
    this.getName = function() { return "Sobel"; };
    /**
     * Original image.
     * @property originalImage
     * @private
     * @type Object
     */
    var originalImage = null;
    /**
     * Set the original image.
     * @method setOriginalImage
     * @param {Object} image The original image.
     */
    this.setOriginalImage = function (image) { originalImage = image; };
    /**
     * Get the original image.
     * @method setOriginalImage
     * @return {Object} image The original image.
     */
    this.getOriginalImage = function () { return originalImage; };
};

/**
 * Transform the main image using this filter.
 * @method update
 * @return {Object} The transformed image.
 */ 
BAMBOO.image.filter.Sobel.prototype.update = function()
{
    this.setOriginalImage( app.getImage() );
    
    var gradX = app.getImage().convolute2D(
        [ 1,  0,  -1,
          2,  0,  -2,
          1,  0,  -1 ] );

    var gradY = app.getImage().convolute2D(
        [  1,  2,  1,
           0,  0,  0,
          -1, -2, -1 ] );
    
    return gradX.compose( gradY, function(x,y){return Math.sqrt(x*x+y*y);} );
};

