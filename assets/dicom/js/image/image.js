/** 
 * Image module.
 * @module image
 */
var BAMBOO = BAMBOO || {};
BAMBOO.image = BAMBOO.image || {};

/**
 * Image Size class.
 * Supports 2D and 3D images.
 * @class Size
 * @namespace BAMBOO.image
 * @constructor
 * @param {Number} numberOfColumns The number of columns.
 * @param {Number} numberOfRows The number of rows.
 * @param {Number} numberOfSlices The number of slices.
*/
BAMBOO.image.Size = function( numberOfColumns, numberOfRows, numberOfSlices )
{
    /**
     * Get the number of columns.
     * @method getNumberOfColumns
     * @return {Number} The number of columns.
     */ 
    this.getNumberOfColumns = function() { return numberOfColumns; };
    /**
     * Get the number of rows.
     * @method getNumberOfRows
     * @return {Number} The number of rows.
     */ 
    this.getNumberOfRows = function() { return numberOfRows; };
    /**
     * Get the number of slices.
     * @method getNumberOfSlices
     * @return {Number} The number of slices.
     */ 
    this.getNumberOfSlices = function() { return (numberOfSlices || 1.0); };
};

/**
 * Get the size of a slice.
 * @method getSliceSize
 * @return {Number} The size of a slice.
 */ 
BAMBOO.image.Size.prototype.getSliceSize = function() {
    return this.getNumberOfColumns()*this.getNumberOfRows();
};

/**
 * Get the total size.
 * @method getTotalSize
 * @return {Number} The total size.
 */ 
BAMBOO.image.Size.prototype.getTotalSize = function() {
    return this.getSliceSize()*this.getNumberOfSlices();
};

/**
 * Check for equality.
 * @method equals
 * @param {Size} rhs The object to compare to.
 * @return {Boolean} True if both objects are equal.
 */ 
BAMBOO.image.Size.prototype.equals = function(rhs) {
    return rhs !== null &&
        this.getNumberOfColumns() === rhs.getNumberOfColumns() &&
        this.getNumberOfRows() === rhs.getNumberOfRows() &&
        this.getNumberOfSlices() === rhs.getNumberOfSlices();
};

/**
 * Check that coordinates are within bounds.
 * @method isInBounds
 * @param {Number} i The column coordinate.
 * @param {Number} j The row coordinate.
 * @param {Number} k The slice coordinate.
 * @return {Boolean} True if the given coordinates are within bounds.
 */ 
BAMBOO.image.Size.prototype.isInBounds = function( i, j, k ) {
    if( i < 0 || i > this.getNumberOfColumns() - 1 ||
        j < 0 || j > this.getNumberOfRows() - 1 ||
        k < 0 || k > this.getNumberOfSlices() - 1 ) {
        return false;
    }
    return true;
};

BAMBOO.image.Size.prototype.getSliceNum = function() {
    return this.getNumberOfSlices();
};


/**
 * Image Spacing class. 
 * Supports 2D and 3D images.
 * @class Spacing
 * @namespace BAMBOO.image
 * @constructor
 * @param {Number} columnSpacing The column spacing.
 * @param {Number} rowSpacing The row spacing.
 * @param {Number} sliceSpacing The slice spacing.
 */
BAMBOO.image.Spacing = function( columnSpacing, rowSpacing, sliceSpacing )
{
    /**
     * Get the column spacing.
     * @method getColumnSpacing
     * @return {Number} The column spacing.
     */ 
    this.getColumnSpacing = function() { return columnSpacing; };
    /**
     * Get the row spacing.
     * @method getRowSpacing
     * @return {Number} The row spacing.
     */ 
    this.getRowSpacing = function() { return rowSpacing; };
    /**
     * Get the slice spacing.
     * @method getSliceSpacing
     * @return {Number} The slice spacing.
     */ 
    this.getSliceSpacing = function() { return (sliceSpacing || 1.0); };
};

/**
 * Check for equality.
 * @method equals
 * @param {Spacing} rhs The object to compare to.
 * @return {Boolean} True if both objects are equal.
 */ 
BAMBOO.image.Spacing.prototype.equals = function(rhs) {
    return rhs !== null &&
        this.getColumnSpacing() === rhs.getColumnSpacing() &&
        this.getRowSpacing() === rhs.getRowSpacing() &&
        this.getSliceSpacing() === rhs.getSliceSpacing();
};

/**
 * Image class.
 * Usable once created, optional are:
 * - rescale slope and intercept (default 1:0), 
 * - photometric interpretation (default MONOCHROME2),
 * - planar configuration (default RGBRGB...).
 * @class Image
 * @namespace BAMBOO.image
 * @constructor
 * @param {Size} size The size of the image.
 * @param {Spacing} spacing The spacing of the image.
 * @param {Array} buffer The image data.
 * @param {Array} slicePositions The slice positions.
 */
BAMBOO.image.Image = function(size, spacing, buffer, slicePositions)
{
    /**
     * Rescale slope.
     * @property rescaleSlope
     * @private
     * @type Number
     */
    var rescaleSlope = 1;
    /**
     * Rescale intercept.
     * @property rescaleIntercept
     * @private
     * @type Number
     */
    var rescaleIntercept = 0;
    /**
     * Photometric interpretation (MONOCHROME, RGB...).
     * @property photometricInterpretation
     * @private
     * @type String
     */
    var photometricInterpretation = "MONOCHROME2";
    /**
     * Planar configuration for RGB data (0:RGBRGBRGBRGB... or 1:RRR...GGG...BBB...).
     * @property planarConfiguration
     * @private
     * @type Number
     */
    var planarConfiguration = 0;
    /**
     * Number of components.
     * @property planarConfiguration
     * @private
     * @type Number
     */
    var numberOfComponents = buffer.length / size.getTotalSize();
    /**
     * Meta information.
     * @property meta
     * @private
     * @type Object
     */
    var meta = {};
    
    /**
     * Original buffer.
     * @property originalBuffer
     * @private
     * @type Array
     */
    var originalBuffer = new Int16Array(buffer);
    
    // check slice positions.
    if( typeof(slicePositions) === 'undefined' ) {
        slicePositions = [[0,0,0]];
    }
    
    /**
     * Data range.
     * @property dataRange
     * @private
     * @type Object
     */
    var dataRange = null;
    /**
     * Histogram.
     * @property histogram
     * @private
     * @type Array
     */
    var histogram = null;
     
    /**
     * Get the size of the image.
     * @method getSize
     * @return {Size} The size of the image.
     */ 
    this.getSize = function() { return size; };
    /**
     * Get the spacing of the image.
     * @method getSpacing
     * @return {Spacing} The spacing of the image.
     */ 
    this.getSpacing = function() { return spacing; };
    /**
     * Get the data buffer of the image. TODO dangerous...
     * @method getBuffer
     * @return {Array} The data buffer of the image.
     */ 
    this.getBuffer = function() { return buffer; };
    /**
     * Get the slice positions.
     * @method getSlicePositions
     * @return {Array} The slice positions.
     */ 
    this.getSlicePositions = function() { return slicePositions; };
    
    /**
     * Get the rescale slope.
     * @method getRescaleSlope
     * @return {Number} The rescale slope.
     */ 
    this.getRescaleSlope = function() { return rescaleSlope; };
    /**
     * Set the rescale slope.
     * @method setRescaleSlope
     * @param {Number} rs The rescale slope.
     */ 
    this.setRescaleSlope = function(rs) { rescaleSlope = rs; };
    /**
     * Get the rescale intercept.
     * @method getRescaleIntercept
     * @return {Number} The rescale intercept.
     */ 
    this.getRescaleIntercept = function() { return rescaleIntercept; };
    /**
     * Set the rescale intercept.
     * @method setRescaleIntercept
     * @param {Number} ri The rescale intercept.
     */ 
    this.setRescaleIntercept = function(ri) { rescaleIntercept = ri; };
    /**
     * Get the photometricInterpretation of the image.
     * @method getPhotometricInterpretation
     * @return {String} The photometricInterpretation of the image.
     */ 
    this.getPhotometricInterpretation = function() { return photometricInterpretation; };
    /**
     * Set the photometricInterpretation of the image.
     * @method setPhotometricInterpretation
     * @pqrqm {String} interp The photometricInterpretation of the image.
     */ 
    this.setPhotometricInterpretation = function(interp) { photometricInterpretation = interp; };
    /**
     * Get the planarConfiguration of the image.
     * @method getPlanarConfiguration
     * @return {Number} The planarConfiguration of the image.
     */ 
    this.getPlanarConfiguration = function() { return planarConfiguration; };
    /**
     * Set the planarConfiguration of the image.
     * @method setPlanarConfiguration
     * @param {Number} config The planarConfiguration of the image.
     */ 
    this.setPlanarConfiguration = function(config) { planarConfiguration = config; };
    /**
     * Get the numberOfComponents of the image.
     * @method getNumberOfComponents
     * @return {Number} The numberOfComponents of the image.
     */ 
    this.getNumberOfComponents = function() { return numberOfComponents; };

    /**
     * Get the meta information of the image.
     * @method getMeta
     * @return {Object} The meta information of the image.
     */ 
    this.getMeta = function() { return meta; };
    /**
     * Set the meta information of the image.
     * @method setMeta
     * @param {Object} rhs The meta information of the image.
     */ 
    this.setMeta = function(rhs) { meta = rhs; };

    /**
     * Get value at offset. Warning: No size check...
     * @method getValueAtOffset
     * @param {Number} offset The desired offset.
     * @return {Number} The value at offset.
     */ 
    this.getValueAtOffset = function(offset) {
        return buffer[offset];
    };
    
    /**
     * Clone the image.
     * @method clone
     * @return {Image} A clone of this image.
     */ 
    this.clone = function()
    {
        var copy = new BAMBOO.image.Image(this.getSize(), this.getSpacing(), originalBuffer, slicePositions);
        copy.setRescaleSlope(this.getRescaleSlope());
        copy.setRescaleIntercept(this.getRescaleIntercept());
        copy.setPhotometricInterpretation(this.getPhotometricInterpretation());
        copy.setPlanarConfiguration(this.getPlanarConfiguration());
        copy.setMeta(this.getMeta());
        return copy;
    };
    
    /**
     * Append a slice to the image.
     * @method appendSlice
     * @param {Image} The slice to append.
     */ 
    this.appendSlice = function(rhs)
    {
        // check input
        if( rhs === null ) {
            throw new Error("Cannot append null slice");
        }
        if( rhs.getSize().getNumberOfSlices() !== 1 ) {
            throw new Error("Cannot append more than one slice");
        }
        if( size.getNumberOfColumns() !== rhs.getSize().getNumberOfColumns() ) {
            throw new Error("Cannot append a slice with different number of columns");
        }
        if( size.getNumberOfRows() !== rhs.getSize().getNumberOfRows() ) {
            throw new Error("Cannot append a slice with different number of rows");
        }
        if( photometricInterpretation !== rhs.getPhotometricInterpretation() ) {
            throw new Error("Cannot append a slice with different photometric interpretation");
        }
        // all meta should be equal
        for( var key in meta ) {
            if( meta[key] !== rhs.getMeta()[key] ) {
                throw new Error("Cannot append a slice with different "+key);
            }
        }
        
        // find index where to append slice
        var closestSliceIndex = 0;
        var slicePosition = rhs.getSlicePositions()[0];
        var minDiff = Math.abs( slicePositions[0][2] - slicePosition[2] );
        var diff = 0;
        for( var i = 0; i < slicePositions.length; ++i )
        {
            diff = Math.abs( slicePositions[i][2] - slicePosition[2] );
            if( diff < minDiff ) 
            {
                minDiff = diff;
                closestSliceIndex = i;
            }
        }
        diff = slicePositions[closestSliceIndex][2] - slicePosition[2];
        var newSliceNb = ( diff > 0 ) ? closestSliceIndex : closestSliceIndex + 1;
        
        // new size
        var newSize = new BAMBOO.image.Size(size.getNumberOfColumns(),
                size.getNumberOfRows(),
                size.getNumberOfSlices() + 1 );
        
        // calculate slice size
        var mul = 1;
        if( photometricInterpretation === "RGB" ) {
            mul = 3;
        }

		if ( photometricInterpretation === "YBR_FULL_422")
		{
			mul = 4;
		}
		var sliceSize = mul * size.getSliceSize();
        
        // create the new buffer
        var newBuffer = new Int16Array(sliceSize * newSize.getNumberOfSlices());
        
        // append slice at new position
        if( newSliceNb === 0 )
        {
            newBuffer.set(rhs.getBuffer());
            newBuffer.set(buffer, sliceSize);
        }
        else //if( newSliceNb === size.getNumberOfSlices() )
        {
            newBuffer.set(buffer);
            newBuffer.set(rhs.getBuffer(), size.getNumberOfSlices() * sliceSize);
        }
         
        // update slice positions
        slicePositions.splice(newSliceNb, 0, slicePosition);
        
        // copy to class variables
        size = newSize;
        buffer = newBuffer;
       // originalBuffer = new Int16Array(newBuffer);
    }; 

	this.append_numberOfSlice = function(rhs)
	  {
		 if( rhs === null ) {
            throw new Error("Cannot append null slice");
        }
        if( rhs.getSize().getNumberOfSlices() !== 1 ) {
            throw new Error("Cannot append more than one slice");
        }
        if( size.getNumberOfColumns() !== rhs.getSize().getNumberOfColumns() ) {
            throw new Error("Cannot append a slice with different number of columns");
        }
        if( size.getNumberOfRows() !== rhs.getSize().getNumberOfRows() ) {
            throw new Error("Cannot append a slice with different number of rows");
        }
        if( photometricInterpretation !== rhs.getPhotometricInterpretation() ) {
            throw new Error("Cannot append a slice with different photometric interpretation");
        }
        // all meta should be equal
        for( var key in meta ) {
            if( meta[key] !== rhs.getMeta()[key] ) {
                throw new Error("Cannot append a slice with different "+key);
            }
        }

        var closestSliceIndex = 0;
        var slicePosition = rhs.getSlicePositions()[0];
        var minDiff = Math.abs( slicePositions[0][2] - slicePosition[2] );
        var diff = 0;
        for( var i = 0; i < slicePositions.length; ++i )
        {
            diff = Math.abs( slicePositions[i][2] - slicePosition[2] );
            if( diff < minDiff ) 
            {
                minDiff = diff;
                closestSliceIndex = i;
            }
        }
        diff = slicePositions[closestSliceIndex][2] - slicePosition[2];
        var newSliceNb = ( diff > 0 ) ? closestSliceIndex : closestSliceIndex + 1;
        
        // new size
        var newSize = new BAMBOO.image.Size(size.getNumberOfColumns(),
                size.getNumberOfRows(),
                size.getNumberOfSlices() + 1 );
		 // update slice positions
        slicePositions.splice(newSliceNb, 0, slicePosition);
        
        // copy to class variables
        size = newSize;	

	  };
    
    /**
     * Get the data range.
     * @method getDataRange
     * @return {Object} The data range.
     */ 
    this.getDataRange = function() { 
        if( !dataRange ) {
            dataRange = this.calculateDataRange();
        }
        return dataRange;
    };

    /**
     * Get the histogram.
     * @method getHistogram
     * @return {Array} The histogram.
     */ 
    this.getHistogram = function() { 
        if( !histogram ) {
            histogram = this.calculateHistogram();
        }
        return histogram;
    };
};

/**
 * Get the value of the image at a specific coordinate.
 * @method getValue
 * @param {Number} i The X index.
 * @param {Number} j The Y index.
 * @param {Number} k The Z index.
 * @return {Number} The value at the desired position.
 * Warning: No size check...
 */
BAMBOO.image.Image.prototype.getValue = function( i, j, k )
{
    return this.getValueAtOffset( i +
        ( j * this.getSize().getNumberOfColumns() ) +
        ( k * this.getSize().getSliceSize()) );
};

/**
 * Get the rescaled value of the image at a specific offset.
 * @method getRescaledValueAtOffset
 * @param {Number} offset The offset in the buffer. 
 * @return {Number} The rescaled value at the desired offset.
 * Warning: No size check...
 */
BAMBOO.image.Image.prototype.getRescaledValueAtOffset = function( offset )
{
    return (this.getValueAtOffset(offset)*this.getRescaleSlope())+this.getRescaleIntercept();
};

/**
 * Get the rescaled value of the image at a specific coordinate.
 * @method getRescaledValue
 * @param {Number} i The X index.
 * @param {Number} j The Y index.
 * @param {Number} k The Z index.
 * @return {Number} The rescaled value at the desired position.
 * Warning: No size check...
 */
BAMBOO.image.Image.prototype.getRescaledValue = function( i, j, k )
{
    return (this.getValue(i,j,k)*this.getRescaleSlope())+this.getRescaleIntercept();
};

/**
 * Calculate the raw image data range.
 * @method calculateDataRange
 * @return {Object} The range {min, max}.
 */
BAMBOO.image.Image.prototype.calculateDataRange = function()
{
    var min = this.getValueAtOffset(0);
    var max = min;
    var value = 0;
    for(var i=0; i < this.getSize().getTotalSize(); ++i)
    {    
        value = this.getValueAtOffset(i);
        if( value > max ) { max = value; }
        if( value < min ) { min = value; }
    }
    return { "min": min, "max": max };
};

/**
 * Calculate the image data range after rescale.
 * @method getRescaledDataRange
 * @return {Object} The rescaled data range {min, max}.
 */
BAMBOO.image.Image.prototype.getRescaledDataRange = function()
{
    var rawRange = this.getDataRange();
    return { "min": rawRange.min*this.getRescaleSlope()+this.getRescaleIntercept(),
        "max": rawRange.max*this.getRescaleSlope()+this.getRescaleIntercept()};
};

/**
 * Calculate the histogram of the image.
 * @method calculateHistogram
 * @return {Array} An array representing the histogram.
 */
BAMBOO.image.Image.prototype.calculateHistogram = function()
{
    var histo = [];
    var histoPlot = [];
    var value = 0;
    var size = this.getSize().getTotalSize();
    for ( var i = 0; i < size; ++i ) {    
        value = this.getRescaledValueAtOffset(i);
        histo[value] = ( histo[value] || 0 ) + 1;
    }
    // generate data for plotting
    var min = this.getRescaledDataRange().min;
    var max = this.getRescaledDataRange().max;
    for ( var j = min; j <= max; ++j ) {    
        histoPlot.push([j, ( histo[j] || 0 ) ]);
    }
    return histoPlot;
};

/**
 * Convolute the image with a given 2D kernel.
 * @method convolute2D
 * @param {Array} weights The weights of the 2D kernel as a 3x3 matrix.
 * @return {Image} The convoluted image.
 * Note: Uses the raw buffer values.
 */
BAMBOO.image.Image.prototype.convolute2D = function(weights)
{
    if(weights.length !== 9) {
        throw new Error("The convolution matrix does not have a length of 9; it has "+weights.length);
    }

    var newImage = this.clone();
    var newBuffer = newImage.getBuffer();

    var ncols = this.getSize().getNumberOfColumns();
    var nrows = this.getSize().getNumberOfRows();
    var nslices = this.getSize().getNumberOfSlices();
    var ncomp = this.getNumberOfComponents();
    
    // adapt to number of component and planar configuration
    var factor = 1;
    var componentOffset = 1;
    if( ncomp === 3 )
    {
        if( this.getPlanarConfiguration() === 0 )
        {
            factor = 3;
        }
        else
        {
            componentOffset = this.getSize().getTotalSize();
        }
    }
    
    // allow special indent for matrices
    /*jshint indent:false */

    // default weight offset matrix
    var wOff = [];
    wOff[0] = (-ncols-1) * factor; wOff[1] = (-ncols) * factor; wOff[2] = (-ncols+1) * factor;
    wOff[3] = -factor; wOff[4] = 0; wOff[5] = 1 * factor;
    wOff[6] = (ncols-1) * factor; wOff[7] = (ncols) * factor; wOff[8] = (ncols+1) * factor;
    
    // border weight offset matrices
    // borders are extended (see http://en.wikipedia.org/wiki/Kernel_%28image_processing%29)
    
    // i=0, j=0
    var wOff00 = [];
    wOff00[0] = wOff[4]; wOff00[1] = wOff[4]; wOff00[2] = wOff[5];
    wOff00[3] = wOff[4]; wOff00[4] = wOff[4]; wOff00[5] = wOff[5];
    wOff00[6] = wOff[7]; wOff00[7] = wOff[7]; wOff00[8] = wOff[8];
    // i=0, j=*
    var wOff0x = [];
    wOff0x[0] = wOff[1]; wOff0x[1] = wOff[1]; wOff0x[2] = wOff[2];
    wOff0x[3] = wOff[4]; wOff0x[4] = wOff[4]; wOff0x[5] = wOff[5];
    wOff0x[6] = wOff[7]; wOff0x[7] = wOff[7]; wOff0x[8] = wOff[8];
    // i=0, j=nrows
    var wOff0n = [];
    wOff0n[0] = wOff[1]; wOff0n[1] = wOff[1]; wOff0n[2] = wOff[2];
    wOff0n[3] = wOff[4]; wOff0n[4] = wOff[4]; wOff0n[5] = wOff[5];
    wOff0n[6] = wOff[4]; wOff0n[7] = wOff[4]; wOff0n[8] = wOff[5];
    
    // i=*, j=0
    var wOffx0 = [];
    wOffx0[0] = wOff[3]; wOffx0[1] = wOff[4]; wOffx0[2] = wOff[5];
    wOffx0[3] = wOff[3]; wOffx0[4] = wOff[4]; wOffx0[5] = wOff[5];
    wOffx0[6] = wOff[6]; wOffx0[7] = wOff[7]; wOffx0[8] = wOff[8];
    // i=*, j=* -> wOff
    // i=*, j=nrows
    var wOffxn = [];
    wOffxn[0] = wOff[0]; wOffxn[1] = wOff[1]; wOffxn[2] = wOff[2];
    wOffxn[3] = wOff[3]; wOffxn[4] = wOff[4]; wOffxn[5] = wOff[5];
    wOffxn[6] = wOff[3]; wOffxn[7] = wOff[4]; wOffxn[8] = wOff[5];
    
    // i=ncols, j=0
    var wOffn0 = [];
    wOffn0[0] = wOff[3]; wOffn0[1] = wOff[4]; wOffn0[2] = wOff[4];
    wOffn0[3] = wOff[3]; wOffn0[4] = wOff[4]; wOffn0[5] = wOff[4];
    wOffn0[6] = wOff[6]; wOffn0[7] = wOff[7]; wOffn0[8] = wOff[7];
    // i=ncols, j=*
    var wOffnx = [];
    wOffnx[0] = wOff[0]; wOffnx[1] = wOff[1]; wOffnx[2] = wOff[1];
    wOffnx[3] = wOff[3]; wOffnx[4] = wOff[4]; wOffnx[5] = wOff[4];
    wOffnx[6] = wOff[6]; wOffnx[7] = wOff[7]; wOffnx[8] = wOff[7];
    // i=ncols, j=nrows
    var wOffnn = [];
    wOffnn[0] = wOff[0]; wOffnn[1] = wOff[1]; wOffnn[2] = wOff[1];
    wOffnn[3] = wOff[3]; wOffnn[4] = wOff[4]; wOffnn[5] = wOff[4];
    wOffnn[6] = wOff[3]; wOffnn[7] = wOff[4]; wOffnn[8] = wOff[4];
    
    // restore indent for rest of method
    /*jshint indent:4 */

    // loop vars
    var pixelOffset = 0;
    var newValue = 0;
    var wOffFinal = [];
    // go through the destination image pixels
    for (var c=0; c<ncomp; c++) {
        // special component offset
        pixelOffset = c * componentOffset;
        for (var k=0; k<nslices; k++) {
            for (var j=0; j<nrows; j++) {
                for (var i=0; i<ncols; i++) {
                    wOffFinal = wOff;
                    // special border cases
                    if( i === 0 && j === 0 ) {
                        wOffFinal = wOff00;
                    }
                    else if( i === 0 && j === (nrows-1)  ) {
                        wOffFinal = wOff0n;
                    }
                    else if( i === (ncols-1) && j === 0 ) {
                        wOffFinal = wOffn0;
                    }
                    else if( i === (ncols-1) && j === (nrows-1) ) {
                        wOffFinal = wOffnn;
                    }
                    else if( i === 0 && j !== (nrows-1) && j !== 0 ) {
                        wOffFinal = wOff0x;
                    }
                    else if( i === (ncols-1) && j !== (nrows-1) && j !== 0 ) {
                        wOffFinal = wOffnx;
                    }
                    else if( i !== 0 && i !== (ncols-1) && j === 0 ) {
                        wOffFinal = wOffx0;
                    }
                    else if( i !== 0 && i !== (ncols-1) && j === (nrows-1) ) {
                        wOffFinal = wOffxn;
                    }
                        
                    // calculate the weighed sum of the source image pixels that
                    // fall under the convolution matrix
                    newValue = 0;
                    for( var wi=0; wi<9; ++wi )
                    {
                        newValue += this.getValueAtOffset(pixelOffset + wOffFinal[wi]) * weights[wi];
                    }
                    newBuffer[pixelOffset] = newValue;
                    // increment pixel offset
                    pixelOffset += factor;
                }
            }
        }
    }
    return newImage;
};

/**
 * Transform an image using a specific operator.
 * @method transform
 * @param {Function} operator The operator to use when transforming.
 * @return {Image} The transformed image.
 * Note: Uses the raw buffer values.
 */
BAMBOO.image.Image.prototype.transform = function(operator)
{
    var newImage = this.clone();
    var newBuffer = newImage.getBuffer();
    for( var i=0; i < newBuffer.length; ++i )
    {   
        newBuffer[i] = operator( newImage.getValueAtOffset(i) );
    }
    return newImage;
};

/**
 * Compose this image with another one and using a specific operator.
 * @method compose
 * @param {Image} rhs The image to compose with.
 * @param {Function} operator The operator to use when composing.
 * @return {Image} The composed image.
 * Note: Uses the raw buffer values.
 */
BAMBOO.image.Image.prototype.compose = function(rhs, operator)
{
    var newImage = this.clone();
    var newBuffer = newImage.getBuffer();
    for( var i=0; i < newBuffer.length; ++i )
    {   
        // using the operator on the local buffer, i.e. the latest (not original) data
        newBuffer[i] = Math.floor( operator( this.getValueAtOffset(i), rhs.getValueAtOffset(i) ) );
    }
    return newImage;
};

