/** 
 * DICOM module.
 * @module dicom
 */
var BAMBOO = BAMBOO || {};
BAMBOO.dicom = BAMBOO.dicom || {};

/**
 * Data reader.
 * @class DataReader
 * @namespace BAMBOO.dicom
 * @constructor
 * @param {Array} buffer The input array buffer.
 * @param {Boolean} isLittleEndian Flag to tell if the data is little or big endian.
 */
BAMBOO.dicom.DataReader = function(buffer, isLittleEndian)
{
    /**
     * The main data view.
     * @property view
     * @private
     * @type DataView
     */
    var view = new DataView(buffer);
    // Set endian flag if not defined.
    if(typeof(isLittleEndian)==='undefined') {
        isLittleEndian = true;
    }
    
    /**
     * Read Uint8 (1 byte) data.
     * @method readUint8
     * @param {Number} byteOffset The offset to start reading from.
     * @return {Number} The read data.
     */
    this.readUint8 = function(byteOffset) {
        return view.getUint8(byteOffset, isLittleEndian);
    };
    /**
     * Read Uint16 (2 bytes) data.
     * @method readUint16
     * @param {Number} byteOffset The offset to start reading from.
     * @return {Number} The read data.
     */
    this.readUint16 = function(byteOffset) {
        return view.getUint16(byteOffset, isLittleEndian);
    };
    /**
     * Read Uint32 (4 bytes) data.
     * @method readUint32
     * @param {Number} byteOffset The offset to start reading from.
     * @return {Number} The read data.
     */
    this.readUint32 = function(byteOffset) {
        return view.getUint32(byteOffset, isLittleEndian);
    };
    /**
     * Read Float32 (8 bytes) data.
     * @method readFloat32
     * @param {Number} byteOffset The offset to start reading from.
     * @return {Number} The read data.
     */
    this.readFloat32 = function(byteOffset) {
        return view.getFloat32(byteOffset, isLittleEndian);
    };
    /**
     * Read Uint data of nBytes size.
     * @method readNumber
     * @param {Number} byteOffset The offset to start reading from.
     * @param {Number} nBytes The number of bytes to read.
     * @return {Number} The read data.
     */
    this.readNumber = function(byteOffset, nBytes) {
        if( nBytes === 1 ) {
            return this.readUint8(byteOffset, isLittleEndian);
        }
        else if( nBytes === 2 ) {
            return this.readUint16(byteOffset, isLittleEndian);
        }
        else if( nBytes === 4 ) {
            return this.readUint32(byteOffset, isLittleEndian);
        }
        else if( nBytes === 8 ) {
            return this.readFloat32(byteOffset, isLittleEndian);
        }
        else { 
            console.log("Non number: '"+this.readString(byteOffset, nBytes)+"'");
            throw new Error("Unsupported number size.");
        }
    };
    /**
     * Read Uint8 array.
     * @method readUint8Array
     * @param {Number} byteOffset The offset to start reading from.
     * @param {Number} size The size of the array.
     * @return {Array} The read data.
     */
    this.readUint8Array = function(byteOffset, size) {
        var data = new Uint8Array(size);
        var index = 0;
        for(var i=byteOffset; i<byteOffset + size; ++i) {     
            data[index++] = this.readUint8(i);
        }
        return data;
    };
    /**
     * Read Uint16 array.
     * @method readUint16Array
     * @param {Number} byteOffset The offset to start reading from.
     * @param {Number} size The size of the array.
     * @return {Array} The read data.
     */
    this.readUint16Array = function(byteOffset, size) {
        var data = new Uint16Array(size/2);
        var index = 0;
        for(var i=byteOffset; i<byteOffset + size; i+=2) {     
            data[index++] = this.readUint16(i);
        }
        return data;
    };
    /**
     * Read data as an hexadecimal string.
     * @method readHex
     * @param {Number} byteOffset The offset to start reading from.
     * @return {Array} The read data.
     */
    this.readHex = function(byteOffset) {
        // read and convert to hex string
        var str = this.readUint16(byteOffset).toString(16);
        // return padded
        return "0x0000".substr(0, 6 - str.length) + str.toUpperCase();
    };
    /**
     * Read data as a string.
     * @method readString
     * @param {Number} byteOffset The offset to start reading from.
     * @param {Number} nChars The number of characters to read.
     * @return {String} The read data.
     */
    this.readString = function(byteOffset, nChars) {
        var result = "";
        for(var i=byteOffset; i<byteOffset + nChars; ++i){
            result += String.fromCharCode( this.readUint8(i) );
        }
        return result;
    };
};

/**
 * Tell if a given syntax is a JPEG one.
 * @method isJpegTransferSyntax
 * @param {String} The transfer syntax to test.
 * @returns {Boolean} True if a jpeg syntax.
 */
BAMBOO.dicom.isJpegTransferSyntax = function(syntax)
{
    return syntax.match(/1.2.840.10008.1.2.4.5/) !== null ||
        syntax.match(/1.2.840.10008.1.2.4.6/) !== null ||
        syntax.match(/1.2.840.10008.1.2.4.7/) !== null;
};

/**
 * Tell if a given syntax is a JPEG one.
 * @method isJpegTransferSyntax
 * @param {String} The transfer syntax to test.
 * @returns {Boolean} True if a jpeg syntax.
 */
BAMBOO.dicom.isJpeglosslessTransferSyntax = function(syntax)
{
    return syntax.match(/1.2.840.10008.1.2.4.57/) !== null ||
        syntax.match(/1.2.840.10008.1.2.4.58/) !== null ||
		syntax.match(/1.2.840.10008.1.2.4.65/) !== null ||
        syntax.match(/1.2.840.10008.1.2.4.66/) !== null ||
        syntax.match(/1.2.840.10008.1.2.4.70/) !== null;
};

/**
 * Tell if a given syntax is a JPEG-LS one.
 * @method isJpeglsTransferSyntax
 * @param {String} The transfer syntax to test.
 * @returns {Boolean} True if a jpeg-ls syntax.
 */
BAMBOO.dicom.isJpeglsTransferSyntax = function(syntax)
{
    return syntax.match(/1.2.840.10008.1.2.4.8/) !== null;
};

/**
 * Tell if a given syntax is a JPEG 2000 one.
 * @method isJpeg2000TransferSyntax
 * @param {String} The transfer syntax to test.
 * @returns {Boolean} True if a jpeg 2000 syntax.
 */
BAMBOO.dicom.isJpeg2000TransferSyntax = function(syntax)
{
    return syntax.match(/1.2.840.10008.1.2.4.9/) !== null;
};

/**
 * DicomParser class.
 * @class DicomParser
 * @namespace BAMBOO.dicom
 * @constructor
 */
BAMBOO.dicom.DicomParser = function()
{
    /**
     * The list of DICOM elements.
     * @property dicomElements
     * @type Array
     */
    this.dicomElements = {};
    /**
     * The number of DICOM Items.
     * @property numberOfItems
     * @type Number
     */
    this.numberOfItems = 0;
    /**
     * The pixel buffer.
     * @property pixelBuffer
     * @type Array
     */
    this.pixelBuffer = [];

	this.numberOfFrames = 0;
	this.framePixelBuffer = {};
};

/**
 * Get the DICOM data pixel buffer.
 * @method getPixelBuffer
 * @returns {Array} The pixel buffer.
 */
BAMBOO.dicom.DicomParser.prototype.getPixelBuffer = function()
{
    return this.pixelBuffer;
};

/**
 * Append a DICOM element to the dicomElements member object.
 * Allows for easy retrieval of DICOM tag values from the tag name.
 * If tags have same name (for the 'unknown' and private tags cases), a number is appended
 * making the name unique.
 * @method appendDicomElement
 * @param {Object} element The element to add.
 */
BAMBOO.dicom.DicomParser.prototype.appendDicomElement = function( element )
{
    // find a good tag name
    var name = element.name;
    // count the number of items
    if( name === "Item" ) {
        ++this.numberOfItems;
    }
    var count = 1;
    while( this.dicomElements[name] ) {
        name = element.name + (count++).toString();
    }
    // store it
    this.dicomElements[name] = { 
        "group": element.group, 
        "element": element.element,
        "vr": element.vr,
        "vl": element.vl,
        "value": element.value 
    };
};

/**
 * Read a DICOM tag.
 * @method readTag
 * @param reader The raw data reader.
 * @param offset The offset where to start to read.
 * @returns An object containing the tags 'group', 'element' and 'name'.
 */
BAMBOO.dicom.DicomParser.prototype.readTag = function(reader, offset)
{
    // group
    var group = reader.readHex(offset);
    // element
    var element = reader.readHex(offset+2);
    // name
    var name = "BAMBOO::unknown";
    if( BAMBOO.dicom.dictionary[group] ) {
        if( BAMBOO.dicom.dictionary[group][element] ) {
            name = BAMBOO.dicom.dictionary[group][element][2];
        }
    }
    // return
    return {'group': group, 'element': element, 'name': name};
};

/**
 * Read a DICOM data element.
 * @method readDataElement
 * @param reader The raw data reader.
 * @param offset The offset where to start to read.
 * @param implicit Is the DICOM VR implicit?
 * @returns {Object} An object containing the element 'tag', 'vl', 'vr', 'data' and 'offset'.
 */
BAMBOO.dicom.DicomParser.prototype.readDataElement = function(reader, offset, implicit)
{
    // tag: group, element
    var tag = this.readTag(reader, offset);
    var tagOffset = 4;
    
    var vr; // Value Representation (VR)
    var vl; // Value Length (VL)
    var vrOffset = 0; // byte size of VR
    var vlOffset = 0; // byte size of VL
    
    // (private) Item group case
    if( tag.group === "0xFFFE" ) {
        vr = "N/A";
        vrOffset = 0;
        vl = reader.readUint32( offset+tagOffset );
        vlOffset = 4;
    }
    // non Item case
    else {
        // implicit VR?
        if(implicit) {
            vr = "UN";
            if( BAMBOO.dicom.dictionary[tag.group] ) {
                if( BAMBOO.dicom.dictionary[tag.group][tag.element] ) {
                    vr = BAMBOO.dicom.dictionary[tag.group][tag.element][0];
                }
            }
            vrOffset = 0;
            vl = reader.readUint32( offset+tagOffset+vrOffset );
            vlOffset = 4;
        }
        else {
            vr = reader.readString( offset+tagOffset, 2 );
            vrOffset = 2;
            // long representations
            if(vr === "OB" || vr === "OF" || vr === "SQ" || vr === "OW" || vr === "UN") {
                vl = reader.readUint32( offset+tagOffset+vrOffset+2 );
                vlOffset = 6;
            }
            // short representation
            else {
                vl = reader.readUint16( offset+tagOffset+vrOffset );
                vlOffset = 2;
            }
        }
    }
    
    // check the value of VL
    if( vl === 0xffffffff ) {
        vl = 0;
    }
    
    
    // data
    var data;
    var dataOffset = offset+tagOffset+vrOffset+vlOffset;
    if( vr === "US" || vr === "UL")
    {
        data = [reader.readNumber( dataOffset, vl )];
    }
    else if( vr === "OX" || vr === "OW" )
    {
        if(this.bitsAllocated ==8) data = reader.readUint8Array( dataOffset, vl );
         else data = reader.readUint16Array( dataOffset, vl );
    }
    else if( vr === "OB" || vr === "N/A")
    {
        data = reader.readUint8Array( dataOffset, vl );
    }
    else
    {
        data = reader.readString( dataOffset, vl);
        data = data.split("\\");                
    }    

    // total element offset
    var elementOffset = tagOffset + vrOffset + vlOffset + vl;
    
    // return
    return { 
        'tag': tag, 
        'vr': vr, 
        'vl': vl, 
        'data': data,
        'offset': elementOffset
    };    
};

/**
 * Parse the complete DICOM file (given as input to the class).
 * Fills in the member object 'dicomElements'.
 * @method parse
 * @param buffer The input array buffer.
 */
BAMBOO.dicom.DicomParser.prototype.parse = function(buffer)
{
    var offset = 0;
    
	var implicit = false;
	var deflated = false;
    var jpeg = false;
	var jpegls = false;
	var jpeglossless = false;
    var jpeg2000 = false;
	var mpeg2 = false;
	var rle = false;

    // default readers
    var metaReader = new BAMBOO.dicom.DataReader(buffer);
    var dataReader = new BAMBOO.dicom.DataReader(buffer);

    // 128 -> 132: magic word
    offset = 128;
    var magicword = metaReader.readString( offset, 4 );
    if(magicword !== "DICM")
    {
        throw new Error("Not a valid DICOM file (no magic DICM word found)");
    }
    offset += 4;
    
    // 0x0002, 0x0000: MetaElementGroupLength
    var dataElement = this.readDataElement(metaReader, offset);
    var metaLength = parseInt(dataElement.data, 10);
    offset += dataElement.offset;
    
    // meta elements
    var metaStart = offset;
    var metaEnd = metaStart + metaLength;
    var i = metaStart;
    while( i < metaEnd ) 
    {
        // get the data element
        dataElement = this.readDataElement(metaReader, i, false);
        // check the transfer syntax
        if( dataElement.tag.name === "TransferSyntaxUID" ) {
            var syntax = BAMBOO.utils.cleanString(dataElement.data[0]);
            
            // Implicit VR - Little Endian
            if( syntax === "1.2.840.10008.1.2" ) {
                implicit = true;
            }
            // Explicit VR - Little Endian (default): 1.2.840.10008.1.2.1 
            // Deflated Explicit VR - Little Endian
            else if( syntax === "1.2.840.10008.1.2.1.99" ) {
				deflated = true;
                throw new Error("Unsupported DICOM transfer syntax (Deflated Explicit VR): "+syntax);
            }
            // Explicit VR - Big Endian
            else if( syntax === "1.2.840.10008.1.2.2" ) {
                dataReader = new BAMBOO.dicom.DataReader(buffer,false);
            }
            // JPEG
            else if( BAMBOO.dicom.isJpegTransferSyntax(syntax) ) {
                jpeg = true;
				if( BAMBOO.dicom.isJpeglosslessTransferSyntax(syntax) )
					jpeglossless = true;
                console.log("JPEG compressed DICOM data: " + syntax);
                //throw new Error("Unsupported DICOM transfer syntax (JPEG): "+syntax);
            }
            // JPEG-LS
            else if( BAMBOO.dicom.isJpeglsTransferSyntax(syntax) ) {
				jpegls = true;
                console.log("JPEG-LS compressed DICOM data: " + syntax);
                throw new Error("Unsupported DICOM transfer syntax (JPEG-LS): "+syntax);
            }
            // JPEG 2000
            else if( BAMBOO.dicom.isJpeg2000TransferSyntax(syntax) ) {
				jpeg2000 = true;
                console.log("JPEG 2000 compressed DICOM data: " + syntax);                
            }
            // MPEG2 Image Compression
            else if( syntax === "1.2.840.10008.1.2.4.100" ) {
				mpeg2 = true;
                throw new Error("Unsupported DICOM transfer syntax (MPEG2): "+syntax);
            }
            // RLE (lossless)
            else if( syntax === "1.2.840.10008.1.2.4.5" ) {
				rle = true;
                throw new Error("Unsupported DICOM transfer syntax (RLE): "+syntax);
            }
        }  
		
		
        // store the data element
        this.appendDicomElement( { 
            'name': dataElement.tag.name,
            'group': dataElement.tag.group, 
            'vr' : dataElement.vr, 
            'vl' : dataElement.vl, 
            'element': dataElement.tag.element,
            'value': dataElement.data 
        });
        // increment index
        i += dataElement.offset;
    }
    
    var startedPixelItems = false;
    
    var tagName = "";
    // DICOM data elements
    while( i < buffer.byteLength ) 
    {
        // get the data element
        try
        {
            dataElement = this.readDataElement(dataReader, i, implicit);
        }
        catch(err)
        {
            console.warn("Problem reading at " + i + " / " + buffer.byteLength +
                ", after " + tagName + ".\n" + err);
        }
        tagName = dataElement.tag.name;
		 if(tagName === "BitsAllocated")
		     {
			  console.log("BitsAllocated---->16bit");
			  this.bitsAllocated = dataElement.data[0];
		     }
        // store pixel data from multiple items
        if( startedPixelItems ) {
            if( tagName === "Item" ) {
                if( dataElement.data.length === 4 ) {
                    console.log("Skipping Basic Offset Table.");
                }
                else if( dataElement.data.length !== 0 ) {
                    console.log("Concatenating multiple pixel data items, length: "+dataElement.data.length);
                    // concat does not work on typed arrays
                    //this.pixelBuffer = this.pixelBuffer.concat( dataElement.data );
                    // manual concat...
                    var size = dataElement.data.length + this.pixelBuffer.length;
                    var newBuffer = new Uint16Array(size);
                    newBuffer.set( this.pixelBuffer, 0 );
                    newBuffer.set( dataElement.data, this.pixelBuffer.length );
                    this.pixelBuffer = newBuffer;
                }
            }
            else if( tagName === "SequenceDelimitationItem" ) {
                startedPixelItems = false;
            }
            else {
                throw new Error("Unexpected tag in encapsulated pixel data: "+dataElement.tag.name);
            }
        }
        // check the pixel data tag
        if( tagName === "PixelData") {
            if( dataElement.data.length !== 0 ) {
                this.pixelBuffer = dataElement.data;
            }
            else {
                startedPixelItems = true;
            }
        }
        // store the data element
        this.appendDicomElement( {
            'name': tagName,
            'group' : dataElement.tag.group, 
            'vr' : dataElement.vr, 
            'vl' : dataElement.vl, 
            'element': dataElement.tag.element,
            'value': dataElement.data 
        });
        // increment index
        i += dataElement.offset;
    }

	var isMultiFrame = false;
	var numOfFrames = this.dicomElements.NumberOfFrames;
	if (numOfFrames != null && numOfFrames != undefined)
	{
		if (numOfFrames.value[0] > 1)
		{
			isMultiFrame = true;
			this.numberOfFrames = parseInt(numOfFrames.value[0]);
		}
	}

	//if(app.preview) isMultiFrame = false; 
    
	if (isMultiFrame)
	{   
		var frametime_vector;
		if(  this.dicomElements.FrameTime != null &&this.dicomElements.FrameTime != undefined) 
			frametime_vector = this.dicomElements.FrameTime.value;
		else if( this.dicomElements.FrameTimeVector != null && this.dicomElements.FrameTimeVector != undefined) 
			frametime_vector = this.dicomElements.FrameTimeVector.value;
		else frametime_vector = null;
		
		BAMBOO.tool.tools["CinePlay"].frametime_vector = frametime_vector;
		var deff = this.numberOfItems - this.numberOfFrames -1;

		for (var index = 1; index <= this.numberOfFrames; index++)
		{
			
			
			if (implicit)
			{
				
				var i= 0;
				var subpixdata = [];
				var len = (this.pixelBuffer.length)/(this.numberOfFrames);
				var component = (this.pixelBuffer.length)/(this.numberOfFrames*this.dicomElements.Columns.value[0]*this.dicomElements.Rows.value[0])
			    //var len = this.dicomElements.Columns.value[0] * this.dicomElements.Rows.value[0]*component;
				for(var pix =len*(index-1); pix < len*index; pix++)
				{
					subpixdata[i] = this.pixelBuffer[pix];
					i++;
				}
				this.framePixelBuffer[index-1] = subpixdata;
			}
			else
			{   
				var offeset_index = index + deff; 
				var item = eval("this.dicomElements.Item" + offeset_index);
				if (item != null && item != undefined)
				{
					// uncompress data
					if (jpeglossless) {
						var jl = new JpegLosslessImage();
						jl.parse(item.value);
						var data = jl.copyToImageData();
						this.framePixelBuffer[index-1] = data;
						if (index == 1) this.pixelBuffer = data;
					}
					else if( jpeg ) {
						// using jpgjs from https://github.com/notmasteryet/jpgjs
						// -> error with ffc3 and ffc1 jpeg jfif marker
						var j = new JpegImage();
						j.parse(item.value);
						var data = j.copyToImageData();
						this.framePixelBuffer[index-1] = data;
						if (index == 1) this.pixelBuffer = data;
					}
					else if( jpeg2000 ) {
						// decompress pixel buffer into Uint8 image
						var uint8Image = null;
						try {
							uint8Image = openjpeg(item.value, "j2k");
						} catch(error) {
							throw new Error("Cannot decode JPEG 2000 ([" +error.name + "] " + error.message + ")");
						}
						this.framePixelBuffer[index-1] = uint8Image.data;
						if (index == 1) this.pixelBuffer = uint8Image.data;					
					}
				}
			}
           
           if(app.preview) break; 
		}		
	}
	else
	{
		// uncompress data
		if (jpeglossless) {
			var jl = new JpegLosslessImage();
			jl.parse(this.pixelBuffer);
			this.pixelBuffer =jl.copyToImageData();;
		}
		else if( jpeg ) {
			// using jpgjs from https://github.com/notmasteryet/jpgjs
			// -> error with ffc3 and ffc1 jpeg jfif marker
			var j = new JpegImage();
			j.parse(this.pixelBuffer);
			this.pixelBuffer = j.copyToImageData();
			}
		else if( jpeg2000 ) {
			// decompress pixel buffer into Uint8 image
			var uint8Image = null;
			try {
				uint8Image = openjpeg(this.pixelBuffer, "j2k");
			} catch(error) {
				throw new Error("Cannot decode JPEG 2000 ([" +error.name + "] " + error.message + ")");
			}
			this.pixelBuffer = uint8Image.data;
		}
	}    
};

/**
 * Get an Image object from the read DICOM file.
 * @method createImage
 * @returns {View} A new Image.
 */
BAMBOO.dicom.DicomParser.prototype.createImage = function()
{
    // size
    if( !this.dicomElements.Columns ) {
        throw new Error("Missing DICOM image number of columns");
    }
    if( !this.dicomElements.Rows ) {
        throw new Error("Missing DICOM image number of rows");
    }
    var size = new BAMBOO.image.Size(
        this.dicomElements.Columns.value[0], 
        this.dicomElements.Rows.value[0] );
    // spacing
    var rowSpacing = 1;
    var columnSpacing = 1;
    if( this.dicomElements.PixelSpacing ) {
        rowSpacing = parseFloat(this.dicomElements.PixelSpacing.value[0]);
        columnSpacing = parseFloat(this.dicomElements.PixelSpacing.value[1]);
    }
    else if( this.dicomElements.ImagerPixelSpacing ) {
        rowSpacing = parseFloat(this.dicomElements.ImagerPixelSpacing.value[0]);
        columnSpacing = parseFloat(this.dicomElements.ImagerPixelSpacing.value[1]);
    }
    var spacing = new BAMBOO.image.Spacing( columnSpacing, rowSpacing);

	// slice position
    var slicePosition = new Array(0,0,0);
    if( this.dicomElements.ImagePositionPatient ) {
        slicePosition = [ parseFloat(this.dicomElements.ImagePositionPatient.value[0]),
            parseFloat(this.dicomElements.ImagePositionPatient.value[1]),
            parseFloat(this.dicomElements.ImagePositionPatient.value[2]) ];
    }

    // special jpeg 2000 case: openjpeg returns a Uint8 planar MONO or RGB image
    var syntax = BAMBOO.utils.cleanString(this.dicomElements.TransferSyntaxUID.value[0] );
    var jpeg2000 = BAMBOO.dicom.isJpeg2000TransferSyntax( syntax );
	var jpeg = BAMBOO.dicom.isJpegTransferSyntax( syntax );
	var jpegloss = BAMBOO.dicom.isJpeglosslessTransferSyntax( syntax );
	jpeg &= !jpegloss;

	var photo_format = BAMBOO.utils.cleanString(this.dicomElements.PhotometricInterpretation.value[0]).toUpperCase();

	var viewArray = [];
	var pixBuff = this.pixelBuffer;
	var nf = this.numberOfFrames;
	if (nf == 0||app.preview == true)
	{
		nf = 1;
	}

	for (var id = 0; id < nf; id++)
	{
		if (this.numberOfFrames > 0)
		{
			pixBuff = this.framePixelBuffer[id];
		}

		// buffer data
		var buffer = null;
		// convert to 16bit if needed
		if( jpeg2000 && this.dicomElements.BitsAllocated.value[0] === 16 )
		{
			var sliceSize = size.getSliceSize();
			buffer = new Int16Array( sliceSize );
			var k = 0;
			for( var p = 0; p < sliceSize; ++p ) {
				buffer[p] = 256 * pixBuff[k] + pixBuff[k+1];
				k += 2;
			}
		}
		else if( jpegloss && this.dicomElements.BitsAllocated.value[0] === 16 )
		{				
			var sliceSize = size.getSliceSize();
			buffer = new Int16Array( sliceSize );		
			var k = 0;
			for( var p = 0; p < sliceSize; ++p ) {
				buffer[p] = pixBuff[k];				
				k += 4;
			}
		}
		else if( jpegloss && this.dicomElements.BitsAllocated.value[0] === 8 )
		{
			var sliceSize = size.getSliceSize();
			buffer = new Int16Array( sliceSize );		
			var k = 0;
			for( var p = 0; p < sliceSize; ++p ) {
				buffer[p] = pixBuff[k];				
				k += 4;
			}
		}
		else if( jpeg && this.dicomElements.BitsAllocated.value[0] === 16 )
		{
			switch (photo_format)
			{
			case "MONOCHROME1":
			case "MONOCHROME2":
				var sliceSize = size.getSliceSize();
				buffer = new Int16Array( sliceSize );		
				var k = 0;
				for( var p = 0; p < sliceSize; ++p ) {
					buffer[p] = pixBuff[k];				
					k += 4;
				}
				break;
			
			case "PALETTE COLOUR":
			case "YBR_FULL":
			case "RGB":			
			case "YBR_RCT":
			case "YBR_ICT":
			case "YBR_FULL_422":
			case "YBR_PARTIAL_422":
			case "YBR_PARTIAL_420":
				buffer = new Int16Array( pixBuff.length );
				// unsigned to signed data if needed
				var shift = false;
				if( this.dicomElements.PixelRepresentation &&
						this.dicomElements.PixelRepresentation.value[0] == 1) {
					shift = true;
				}
				for( var p = 0; p < pixBuff.length; ++p ) {
					buffer[p] = pixBuff[p];
					if( shift && buffer[i] >= Math.pow(2, 15) ) {
						buffer[i] -= Math.pow(2, 16);
					}
				}
				break;
			
			default: 
				throw new Error("Unsupported photometric interpretation: "+photoInterpretation);
			}
		}
		else if( jpeg && this.dicomElements.BitsAllocated.value[0] === 8 )
		{
			switch (photo_format)
			{
			case "MONOCHROME1":
			case "MONOCHROME2":
				var sliceSize = size.getSliceSize();
				buffer = new Int16Array( sliceSize );		
				var k = 0;
				for( var p = 0; p < sliceSize; ++p ) {
					buffer[p] = pixBuff[k];				
					k += 4;
				}
				break;
			
			case "PALETTE COLOUR":
			case "YBR_FULL":
			case "RGB":			
			case "YBR_RCT":
			case "YBR_ICT":
			case "YBR_FULL_422":
			case "YBR_PARTIAL_422":
			case "YBR_PARTIAL_420":
				buffer = new Int16Array( pixBuff.length );
				// unsigned to signed data if needed
				var shift = false;
				if( this.dicomElements.PixelRepresentation &&
						this.dicomElements.PixelRepresentation.value[0] == 1) {
					shift = true;
				}
				for( var p = 0; p < pixBuff.length; ++p ) {
					buffer[p] = pixBuff[p];
					if( shift && buffer[i] >= Math.pow(2, 15) ) {
						buffer[i] -= Math.pow(2, 16);
					}
				}
				this.framePixelBuffer[id].length = 0;
				break;
			
			default: 
				throw new Error("Unsupported photometric interpretation: "+photoInterpretation);
			}
		}
		else
		{
			buffer = new Int16Array(pixBuff.length);
			// unsigned to signed data if needed
			var shift = false;
			if( this.dicomElements.PixelRepresentation &&
					this.dicomElements.PixelRepresentation.value[0] == 1) {
				shift = true;
			}
			// copy
			for( var i=0; i<pixBuff.length; ++i ) {
				buffer[i] = pixBuff[i];
				if( shift && buffer[i] >= Math.pow(2, 15) ) {
					buffer[i] -= Math.pow(2, 16);
				}
			}
		}
		
		// image
		var image = new BAMBOO.image.Image( size, spacing, buffer, [slicePosition] );

		// photometricInterpretation
		if( this.dicomElements.PhotometricInterpretation ) {
			var photo = BAMBOO.utils.cleanString(
				this.dicomElements.PhotometricInterpretation.value[0]).toUpperCase();
			if( jpeg2000 && photo.match(/YBR/) ) {
				photo = "RGB";
			}
			image.setPhotometricInterpretation( photo );
		}        
		// planarConfiguration
		if( this.dicomElements.PlanarConfiguration ) {
			var planar = this.dicomElements.PlanarConfiguration.value[0];
			if( jpeg2000 ) {
				planar = 1;
			}
			image.setPlanarConfiguration( planar );
		}        
		// rescale slope
		if( this.dicomElements.RescaleSlope ) {
			image.setRescaleSlope( parseFloat(this.dicomElements.RescaleSlope.value[0]) );
		}
		// rescale intercept
		if( this.dicomElements.RescaleIntercept ) {
			image.setRescaleIntercept( parseFloat(this.dicomElements.RescaleIntercept.value[0]) );
		}
		// meta information
		var meta = {};
		if( this.dicomElements.Modality ) {
			meta.Modality = this.dicomElements.Modality.value[0];
		}
		if( this.dicomElements.StudyInstanceUID ) {
			meta.StudyInstanceUID = this.dicomElements.StudyInstanceUID.value[0];
		}
		if( this.dicomElements.SeriesInstanceUID ) {
			meta.SeriesInstanceUID = this.dicomElements.SeriesInstanceUID.value[0];
		}
		if( this.dicomElements.BitsStored ) {
			meta.BitsStored = parseInt(this.dicomElements.BitsStored.value[0], 10);
		}
		image.setMeta(meta);
		
		// pixel representation
		var isSigned = 0;
		if( this.dicomElements.PixelRepresentation ) {
			isSigned = this.dicomElements.PixelRepresentation.value[0];
		}
		// view
		var view = new BAMBOO.image.View(image, isSigned);
		// window center and width
		var windowPresets = [];
		if( this.dicomElements.WindowCenter && this.dicomElements.WindowWidth ) {
			var name;
			for( var j = 0; j < this.dicomElements.WindowCenter.value.length; ++j) {
				var width = parseFloat( this.dicomElements.WindowWidth.value[j], 10 );
				if( width !== 0 ) {
					if( this.dicomElements.WindowCenterWidthExplanation ) {
						name = this.dicomElements.WindowCenterWidthExplanation.value[j];
					}
					else {
						name = "Default"+j;
					}
					windowPresets.push({
						"center": parseFloat( this.dicomElements.WindowCenter.value[j], 10 ),
						"width": width, 
						"name": name
					});
				}
			}
		}
		if( windowPresets.length !== 0 ) {
			view.setWindowPresets( windowPresets );
		}
		else {
			view.setWindowLevelMinMax();
		}

		viewArray[id] = view;
	}
    this.framePixelBuffer.length = 0;
    return viewArray;
};
