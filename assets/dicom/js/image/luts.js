/** 
 * Image module.
 * @module image
 */
var BAMBOO = BAMBOO || {};
BAMBOO.image = BAMBOO.image || {};
BAMBOO.image.lut = BAMBOO.image.lut || {};

/**
 * Rescale LUT class.
 * @class Rescale
 * @namespace BAMBOO.image.lut
 * @constructor
 * @param {Number} slope_ The rescale slope.
 * @param {Number} intercept_ The rescale intercept.
 */
BAMBOO.image.lut.Rescale = function(slope_,intercept_)
{
    /**
     * The internal array.
     * @property rescaleLut_
     * @private
     * @type Array
     */
    var rescaleLut_ = null;
    
    // Check the rescale slope.
    if(typeof(slope_) === 'undefined') {
        slope_ = 1;
    }
    // Check the rescale intercept.
    if(typeof(intercept_) === 'undefined') {
        intercept_ = 0;
    }
    
    /**
     * Get the rescale slope.
     * @method getSlope
     * @return {Number} The rescale slope.
     */ 
    this.getSlope = function() { return slope_; };
    /**
     * Get the rescale intercept.
     * @method getIntercept
     * @return {Number} The rescale intercept.
     */ 
    this.getIntercept = function() { return intercept_; };
    
    /**
     * Initialise the LUT.
     * @method initialise
     * @param {Number} bitsStored The number of bits used to store the data.
     */ 
    // Initialise the LUT.
    this.initialise = function(bitsStored)
    {
        var size = Math.pow(2, bitsStored);
        rescaleLut_ = new Float32Array(size);
        for(var i=0; i<size; ++i) {
            rescaleLut_[i] = i * slope_ + intercept_;
        }
    };
    
    /**
     * Get the length of the LUT array.
     * @method getLength
     * @return {Number} The length of the LUT array.
     */ 
    this.getLength = function() { return rescaleLut_.length; };
    
    /**
     * Get the value of the LUT at the given offset.
     * @method getValue
     * @return {Number} The value of the LUT at the given offset.
     */ 
    this.getValue = function(offset) { return rescaleLut_[offset]; };
};

/**
 * Window LUT class.
 * @class Window
 * @namespace BAMBOO.image.lut
 * @constructor
 * @param {Number} rescaleLut_ The associated rescale LUT.
 * @param {Boolean} isSigned_ Flag to know if the data is signed.
 */
BAMBOO.image.lut.Window = function(rescaleLut_, isSigned_)
{
    /**
     * The internal array: Uint8ClampedArray clamps between 0 and 255.
     * (not supported on travis yet... using basic array, be sure not to overflow!)
     * @property rescaleLut_
     * @private
     * @type Array
     */
    var windowLut_ = null;
    
    // check Uint8ClampedArray support
    if( !BAMBOO.browser.hasClampedArray() ) {
        windowLut_ = new Uint8Array(rescaleLut_.getLength());
    }
    else {
        windowLut_ = new Uint8ClampedArray(rescaleLut_.getLength());
    }
    
    /**
     * The window center.
     * @property center_
     * @private
     * @type Number
     */
    var center_ = null;
    /**
     * The window width.
     * @property width_
     * @private
     * @type Number
     */
    var width_ = null;
    
    /**
     * Get the window center.
     * @method getCenter
     * @return {Number} The window center.
     */ 
    this.getCenter = function() { return center_; };
    /**
     * Get the window width.
     * @method getWidth
     * @return {Number} The window width.
     */ 
    this.getWidth = function() { return width_; };
    /**
     * Get the signed flag.
     * @method isSigned
     * @return {Boolean} The signed flag.
     */ 
    this.isSigned = function() { return isSigned_; };
    
    /**
     * Set the window center and width.
     * @method setCenterAndWidth
     * @param {Number} center The window center.
     * @param {Number} width The window width.
     */ 
    this.setCenterAndWidth = function(center, width)
    {
        // store the window values
        center_ = center;
        width_ = width;
        // pre calculate loop values
        var size = windowLut_.length;
        var center0 = isSigned_ ? center - 0.5 + size / 2 : center - 0.5;
        var width0 = width - 1;
        var dispval = 0;
        if( !BAMBOO.browser.hasClampedArray() )
        {
            var yMax = 255;
            var yMin = 0;
            for(var j=0; j<size; ++j)
            {
                // from the DICOM specification (https://www.dabsoft.ch/dicom/3/C.11.2.1.2/)
                // y = ((x - (c - 0.5)) / (w-1) + 0.5) * (ymax - ymin )+ ymin
                dispval = ((rescaleLut_.getValue(j) - center0 ) / width0 + 0.5) * 255;
                dispval = parseInt(dispval, 10);
                if ( dispval <= yMin ) {
                    windowLut_[j] = yMin;
                }
                else if ( dispval > yMax ) {
                    windowLut_[j] = yMax;
                }
                else {
                    windowLut_[j] = dispval;
                }
            }
        }
        else
        {
            // when using Uint8ClampedArray, values are clamped between 0 and 255
            // no need to check
            for(var i=0; i<size; ++i)
            {
                // from the DICOM specification (https://www.dabsoft.ch/dicom/3/C.11.2.1.2/)
                // y = ((x - (c - 0.5)) / (w-1) + 0.5) * (ymax - ymin )+ ymin
                dispval = ((rescaleLut_.getValue(i) - center0 ) / width0 + 0.5) * 255;
                windowLut_[i]= parseInt(dispval, 10);
            }
        }
    };
    
    /**
     * Get the length of the LUT array.
     * @method getLength
     * @return {Number} The length of the LUT array.
     */ 
    this.getLength = function() { return windowLut_.length; };

    /**
     * Get the value of the LUT at the given offset.
     * @method getValue
     * @return {Number} The value of the LUT at the given offset.
     */ 
    this.getValue = function(offset)
    {
        var shift = isSigned_ ? windowLut_.length / 2 : 0;
        return windowLut_[offset+shift];
    };
};

/**
* Lookup tables for image color display. 
*/

BAMBOO.image.lut.range_max = 256;

BAMBOO.image.lut.buildLut = function(func)
{
    var lut = [];
    for( var i=0; i<BAMBOO.image.lut.range_max; ++i ) {
        lut.push(func(i));
    }
    return lut;
};

BAMBOO.image.lut.max = function(/*i*/)
{
    return BAMBOO.image.lut.range_max-1;
};

BAMBOO.image.lut.maxFirstThird = function(i)
{
    if( i < BAMBOO.image.lut.range_max/3 ) {
        return BAMBOO.image.lut.range_max-1;
    }
    return 0;
};

BAMBOO.image.lut.maxSecondThird = function(i)
{
    var third = BAMBOO.image.lut.range_max/3;
    if( i >= third && i < 2*third ) {
        return BAMBOO.image.lut.range_max-1;
    }
    return 0;
};

BAMBOO.image.lut.maxThirdThird = function(i)
{
    if( i >= 2*BAMBOO.image.lut.range_max/3 ) {
        return BAMBOO.image.lut.range_max-1;
    }
    return 0;
};

BAMBOO.image.lut.toMaxFirstThird = function(i)
{
    var val = i * 3;
    if( val > BAMBOO.image.lut.range_max-1 ) {
        return BAMBOO.image.lut.range_max-1;
    }
    return val;
};

BAMBOO.image.lut.toMaxSecondThird = function(i)
{
    var third = BAMBOO.image.lut.range_max/3;
    var val = 0;
    if( i >= third ) {
        val = (i-third) * 3;
        if( val > BAMBOO.image.lut.range_max-1 ) {
            return BAMBOO.image.lut.range_max-1;
        }
    }
    return val;
};

BAMBOO.image.lut.toMaxThirdThird = function(i)
{
    var third = BAMBOO.image.lut.range_max/3;
    var val = 0;
    if( i >= 2*third ) {
        val = (i-2*third) * 3;
        if( val > BAMBOO.image.lut.range_max-1 ) {
            return BAMBOO.image.lut.range_max-1;
        }
    }
    return val;
};

BAMBOO.image.lut.zero = function(/*i*/)
{
    return 0;
};

BAMBOO.image.lut.id = function(i)
{
    return i;
};

BAMBOO.image.lut.invId = function(i)
{
    return (BAMBOO.image.lut.range_max-1)-i;
};

// plain
BAMBOO.image.lut.plain = {
    "red":   BAMBOO.image.lut.buildLut(BAMBOO.image.lut.id),
    "green": BAMBOO.image.lut.buildLut(BAMBOO.image.lut.id),
    "blue":  BAMBOO.image.lut.buildLut(BAMBOO.image.lut.id)
};

// inverse plain
BAMBOO.image.lut.invPlain = {
    "red":   BAMBOO.image.lut.buildLut(BAMBOO.image.lut.invId),
    "green": BAMBOO.image.lut.buildLut(BAMBOO.image.lut.invId),
    "blue":  BAMBOO.image.lut.buildLut(BAMBOO.image.lut.invId)
};

//rainbow 
BAMBOO.image.lut.rainbow = {
    "blue":  [0, 4, 8, 12, 16, 20, 24, 28, 32, 36, 40, 44, 48, 52, 56, 60, 64, 68, 72, 76, 80, 84, 88, 92, 96, 100, 104, 108, 112, 116, 120, 124, 128, 132, 136, 140, 144, 148, 152, 156, 160, 164, 168, 172, 176, 180, 184, 188, 192, 196, 200, 204, 208, 212, 216, 220, 224, 228, 232, 236, 240, 244, 248, 252, 255, 247, 239, 231, 223, 215, 207, 199, 191, 183, 175, 167, 159, 151, 143, 135, 127, 119, 111, 103, 95, 87, 79, 71, 63, 55, 47, 39, 31, 23, 15, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    "green": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 8, 16, 24, 32, 40, 48, 56, 64, 72, 80, 88, 96, 104, 112, 120, 128, 136, 144, 152, 160, 168, 176, 184, 192, 200, 208, 216, 224, 232, 240, 248, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 253, 251, 249, 247, 245, 243, 241, 239, 237, 235, 233, 231, 229, 227, 225, 223, 221, 219, 217, 215, 213, 211, 209, 207, 205, 203, 201, 199, 197, 195, 193, 192, 189, 186, 183, 180, 177, 174, 171, 168, 165, 162, 159, 156, 153, 150, 147, 144, 141, 138, 135, 132, 129, 126, 123, 120, 117, 114, 111, 108, 105, 102, 99, 96, 93, 90, 87, 84, 81, 78, 75, 72, 69, 66, 63, 60, 57, 54, 51, 48, 45, 42, 39, 36, 33, 30, 27, 24, 21, 18, 15, 12, 9, 6, 3],
    "red":   [0, 2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 34, 36, 38, 40, 42, 44, 46, 48, 50, 52, 54, 56, 58, 60, 62, 64, 62, 60, 58, 56, 54, 52, 50, 48, 46, 44, 42, 40, 38, 36, 34, 32, 30, 28, 26, 24, 22, 20, 18, 16, 14, 12, 10, 8, 6, 4, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 8, 12, 16, 20, 24, 28, 32, 36, 40, 44, 48, 52, 56, 60, 64, 68, 72, 76, 80, 84, 88, 92, 96, 100, 104, 108, 112, 116, 120, 124, 128, 132, 136, 140, 144, 148, 152, 156, 160, 164, 168, 172, 176, 180, 184, 188, 192, 196, 200, 204, 208, 212, 216, 220, 224, 228, 232, 236, 240, 244, 248, 252, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255]
};

// hot
BAMBOO.image.lut.hot = {
    "red":   BAMBOO.image.lut.buildLut(BAMBOO.image.lut.toMaxFirstThird),
    "green": BAMBOO.image.lut.buildLut(BAMBOO.image.lut.toMaxSecondThird),
    "blue":  BAMBOO.image.lut.buildLut(BAMBOO.image.lut.toMaxThirdThird)
};

// test
BAMBOO.image.lut.test = {
    "red":   BAMBOO.image.lut.buildLut(BAMBOO.image.lut.id),
    "green": BAMBOO.image.lut.buildLut(BAMBOO.image.lut.zero),
    "blue":  BAMBOO.image.lut.buildLut(BAMBOO.image.lut.zero)
};

//red
/*BAMBOO.image.lut.red = {
   "red":   BAMBOO.image.lut.buildLut(BAMBOO.image.lut.max),
   "green": BAMBOO.image.lut.buildLut(BAMBOO.image.lut.id),
   "blue":  BAMBOO.image.lut.buildLut(BAMBOO.image.lut.id)
};*/
