   
var JpegLosslessImage = (function jpegImage() {
	"use strict";	
	function clampToUint8(a) {
       return a <= 0 ? 0 : a >= 255 ? 255 : a | 0;
	   }
	   
	function constructor() {
	}

	constructor.prototype = {
		load: function load(path) {
		  var handleData = (function(data) {
			this.parse(arr);
			if (this.onload)
			  this.onload();
		  }).bind(this);

		  if (path.indexOf("data:") > -1) {
			var offset = path.indexOf("base64,")+7;
			var data = atob(path.substring(offset));
			var arr = new Uint8Array(data.length);
			for (var i = data.length - 1; i >= 0; i--) {
			  arr[i] = data.charCodeAt(i);
			}
			handleData(data);
		  } else {
			var xhr = new XMLHttpRequest();
			xhr.open("GET", path, true);
			xhr.responseType = "arraybuffer";
			xhr.onload = (function() {
			  // TODO catch parse error
			  var data = new Uint8Array(xhr.response);
			  handleData(data);
			}).bind(this);
			xhr.send(null);
		  }
		},
		parse: function parse(data) {
    
		  var bitMask = new Array(0xffffffff, 0x7fffffff, 0x3fffffff, 0x1fffffff,
								0x0fffffff, 0x07ffffff, 0x03ffffff, 0x01ffffff,
								0x00ffffff, 0x007fffff, 0x003fffff, 0x001fffff,
								0x000fffff, 0x0007ffff, 0x0003ffff, 0x0001ffff,
								0x0000ffff, 0x00007fff, 0x00003fff, 0x00001fff,
								0x00000fff, 0x000007ff, 0x000003ff, 0x000001ff,
								0x000000ff, 0x0000007f, 0x0000003f, 0x0000001f,
								0x0000000f, 0x00000007, 0x00000003, 0x00000001);

		  var MAGCAT16_NUMBITS_MARKER = 0x1234;
		  var BITS_PER_LONG =(8*8);
		  var MIN_GET_BITS = (BITS_PER_LONG-7);
		  
		  var bmask = new Array (0x0000,
								 0x0001, 0x0003, 0x0007, 0x000F,
								 0x001F, 0x003F, 0x007F, 0x00FF,
								 0x01FF, 0x03FF, 0x07FF, 0x0FFF,
								 0x1FFF, 0x3FFF, 0x7FFF, 0xFFFF);
		 
		  var getBuffer;

		  var extendTest =new Array(0, 0x0001, 0x0002, 0x0004, 0x0008, 0x0010, 0x0020, 0x0040, 0x0080,
								   0x0100, 0x0200, 0x0400, 0x0800, 0x1000, 0x2000, 0x4000, 0x8000);
		  var extendOffset = new Array(0, ((-1) << 1) + 1, ((-1) << 2) + 1, ((-1) << 3) + 1, ((-1) << 4) + 1,       
									 ((-1) << 5) + 1, ((-1) << 6) + 1, ((-1) << 7) + 1, ((-1) << 8) + 1,
									 ((-1) << 9) + 1, ((-1) << 10) + 1, ((-1) << 11) + 1, ((-1) << 12) + 1,
									 ((-1) << 13) + 1, ((-1) << 14) + 1, ((-1) << 15) + 1, ((-1) <<16) + 1);   /* entry n is (-1 << n) + 1 */

		  function readUint16() {
			var value = (data[offset] << 8) | data[offset + 1];
			offset += 2;
			return value;
		  }

		  function readDataBlock() {
			var length = readUint16();
			var array = data.subarray(offset, offset + length - 2);
			offset += array.length;
			return array;
		  }
		  function GetDht() {
			  var length = readUint16();
			  var huffmanTableSpec = data[offset++];
			  var bits = new Uint8Array(17);
			  var huffval = new Uint8Array(256);
			  bits[0] = 0;
			  var codeLengthSum = 0;
			  for (j = 1; j <= 16; j++, offset++)
				  codeLengthSum += (bits[j] = data[offset]);

			  for (j = 0; j < codeLengthSum; j++, offset++)
				   huffval[j] = data[offset];
			 
			  if ( huffmanTableSpec & 0x10) {	                         /* AC table definition */
				 throw "Huffman table for lossless JPEG is not defined.\n";
			  }
			  if ( huffmanTableSpec < 0 ||  huffmanTableSpec >= 4) {
				   throw "Bogus DHT index %d";
			  }
			
			  frame.dcHuffTblPtrs[huffmanTableSpec] ={ bits:bits,
													   huffval:huffval,
													   ehufco:[],
													   ehufsi:[],
													   maxcode:[],
													   mincode:[],
													   valptr:[],
													   numbits:[],
													   value:[]};
		}

		function FixHuffTbl (dcHuffTblPtrs){				   
			var p, i, l, lastp, si;
			var huffsize = new Uint8Array(257); 
			var huffcode = new Uint16Array(257);
			var code,size,value, ll, ul;
			 p = 0;                                                                
			for (l = 1; l <= 16; l++) {
			for (i = 1; i <=dcHuffTblPtrs.bits[l]; i++)
				huffsize[p++] = l;
			}
			huffsize[p] = 0;
			lastp = p; 
			code = 0;                                                        
			si = huffsize[0];
			p = 0;
			while (huffsize[p]) {
				while (huffsize[p] == si) {
					huffcode[p++] = code;
					code++;
				}
				code <<= 1;
				si++;
			}

			for (p = 0; p < lastp; p++) {
				dcHuffTblPtrs.ehufco[dcHuffTblPtrs.huffval[p]] = huffcode[p];
				dcHuffTblPtrs.ehufsi[dcHuffTblPtrs.huffval[p]] = huffsize[p];
			}

			p = 0; 
			for (l = 1; l <= 16; l++) {                             
				if (dcHuffTblPtrs.bits[l]) {
					dcHuffTblPtrs.valptr[l] = p;
					dcHuffTblPtrs.mincode[l] = huffcode[p];
					p += dcHuffTblPtrs.bits[l];
					dcHuffTblPtrs.maxcode[l] = huffcode[p - 1];
				} else {
				   dcHuffTblPtrs.maxcode[l] = -1;
				}
			}
     
			dcHuffTblPtrs.maxcode[17] = 0xFFFFF;

			for (p=0; p<lastp; p++) {
			size = huffsize[p];
			if (size <= 8) {                               
				value =dcHuffTblPtrs.huffval[p];           
				code = huffcode[p];                        
				ll = code << (8-size);                     
				if (size < 8) {
					ul = ll | bitMask[24+size];            
				} 
				else {                                   
					ul = ll;                               
				}
				for (i=ll; i<=ul; i++) {                   
					dcHuffTblPtrs.numbits[i] = size;               
					dcHuffTblPtrs.value[i] = value;                
				}
			}
		}
	}

	function HuffDecoderInit(){
		var ci ;
		bitsLeft = 0;

		for (ci = 0; ci < frame.compsInScan; ci++) {       
			if (frame.dcHuffTblPtrs[frame.curCompInfo[ci].dcTblNo] ==null) 
				throw "Error: Use of undefined Huffman table\n";	    
		
			/*
			 * Compute derived values for Huffman tables.
			 * We may do this more than once for same table, but it's not a
			 * big deal
			 */
			FixHuffTbl (frame.dcHuffTblPtrs[frame.curCompInfo[ci].dcTblNo]);
		 }

		frame.restartInRows = (frame.restartInterval)/(frame.imageWidth);
		frame.restartRowsToGo = frame.restartInRows;
		frame.nextRestartNum = 0;
	}
	
    function DecodeFirstRow(curRowBuf){
		var curComp,ci;
		var s,col,compsInScan,numCOL;
		var compptr, dctbl;
		var Pr,Pt,d;

		Pr=frame.dataPrecision;
		Pt=frame.Pt;
		compsInScan=frame.compsInScan;
		numCOL=frame.imageWidth;

		for (curComp = 0; curComp < compsInScan; curComp++)     
		{
			ci =frame.MCUmembership[curComp];                
			compptr =frame.curCompInfo[ci];                  
			dctbl = frame.dcHuffTblPtrs[compptr.dcTblNo];     
        
			s = HuffDecode(dctbl); 
			
			if (s && s!= MAGCAT16_NUMBITS_MARKER) {
			   d =get_bits(s);                                  
			   if (d < extendTest[s]) d += extendOffset[s];
			} else if ( s== MAGCAT16_NUMBITS_MARKER ) {
			   d = 32768;
			} else d = 0;
       
			// curRowBuf[0]=d+(1<<(Pr-Pt-1));
			curRowBuf[0].i[curComp]=d+(1<<(Pr-Pt-1));            
       }

    
		for (col=1; col<numCOL; col++) {
			for (curComp = 0; curComp < compsInScan; curComp++) {
				ci = frame.MCUmembership[curComp];
				compptr = frame.curCompInfo[ci];
				dctbl = frame.dcHuffTblPtrs[compptr.dcTblNo];
				
				s = HuffDecode(dctbl);
				if (s && s!=MAGCAT16_NUMBITS_MARKER) {
				  d = get_bits(s);
				   if (d < extendTest[s])					
					 d += extendOffset[s];		
				} else if ( s==MAGCAT16_NUMBITS_MARKER ) {
				   d = 32768;
				} else d = 0;
			   
			  
				curRowBuf[col].i[curComp]=d+curRowBuf[col-1].i[curComp];   
			}
		}

		if (frame.restartInRows) {      
		   (frame.restartRowsToGo)--;
		}
	}


	function HuffDecode(htbl){

		var l, code, temp, rv;									
		var bMagCat16; 
		code = show_bits8();												
		if (htbl.numbits[code]) {										    
			flush_bits(htbl.numbits[code]);								    
			rv=htbl.value[code];											    
		}  																
		else {															
			flush_bits(8);													    
			l = 8;															
			while (code > htbl.maxcode[l]) {								     
				temp =get_bit();												    
				code = (code << 1) | temp;									    
				l++;														
			}

			if (l > 16) {													
				throw "Corrupt JPEG data: bad Huffman code";	
				rv = 0;		/* fake a zero as the safest result */	
			} else {														
				rv = htbl.huffval[htbl.valptr[l] + (code - htbl.mincode[l])];							  
			}																
		}/*endelse*/	

		bMagCat16 = (rv==16) //&& !(code & 0xff00) && (htbl.numbits[code] < 9);       
		if ( bMagCat16 )                                   
			rv = MAGCAT16_NUMBITS_MARKER; 
		return rv;
	}
     
	function flush_bits(nbits){
		bitsLeft -= (nbits);
	}

	function show_bits8() {
		 var rv;
		 if (bitsLeft < 8) FillBitBuffer(8);					     
		 rv = (getBuffer >> (bitsLeft-8)) & 0xff;
		 return rv;
	}

	function FillBitBuffer(nbits){
		var c, c2;												
		while (bitsLeft < 25) {					
			c = data[offset++];											
			if (c == 0xFF) {											
				c2 =data[offset++];									
				if (c2 != 0) {
					data[--offset]=(c2);
					data[--offset]=(c);
					c = 0;
				}
			}/*endif 0xFF*/										
			
			/* OK, load c into getBuffer */								
			getBuffer = (getBuffer << 8) | c;							
			bitsLeft += 8;	
		}
	}

	function  get_bit() {
		var rv;
		if (!bitsLeft) FillBitBuffer(1);							
		rv = (getBuffer >> (--bitsLeft)) & 1;
		return rv;
	}

    function get_bits(nbits) {
		var rv;
		if (bitsLeft < nbits) FillBitBuffer(nbits);					
		rv = ((getBuffer >> (bitsLeft -= (nbits)))) & bmask[nbits];	
		return rv;
	}
		
	function  PmPutRow(RowBuf,  numCol, image,depth)  {  
		var col,comp,i=0;
	  
     
		for (col = 0; col < numCol; col++){
			for (comp=0;comp<frame.compsInScan ;comp++ )
			image[i++]= RowBuf[col].i[comp];
		}
	}	
	
	function swap(a,b)	{
		var c; c=(a); (a)=(b); (b)=c;
	}

	function DecodeRow(curPixelPtr,comp_count,numROW, numCOL,psv){
		var row,col,index,s,d, pred, comp;
		var ci,dctbl,compptr;
		index = curPixelPtr.length;

		for (row = 1; row < numROW; row++) {
			for (comp=0;comp< comp_count ;comp++ )
			{
				ci = frame.MCUmembership[comp];                               
				compptr = frame.curCompInfo[ci];                              
				dctbl = frame.dcHuffTblPtrs[compptr.dcTblNo];                 
				s = HuffDecode(dctbl);
				if (s && s!=MAGCAT16_NUMBITS_MARKER) { 
					d= get_bits(s); 
					if (d < extendTest[s]) d += extendOffset[s];	
				}
				else if ( s==MAGCAT16_NUMBITS_MARKER ) {
					d = 32768;
				}
				else d = 0;

			curPixelPtr[index] =  (d + curPixelPtr[index - comp_count*numCOL]);
			index++;
			}
			
			for (col=1; col < numCOL; col++) {
				for (comp=0;comp< comp_count ;comp++)
				{
					ci = frame.MCUmembership[comp];                              
					compptr = frame.curCompInfo[ci];                             
					dctbl = frame.dcHuffTblPtrs[compptr.dcTblNo];                
					s = HuffDecode(dctbl);
					if (s && s!=MAGCAT16_NUMBITS_MARKER) { 
						d = get_bits(s);
						if (d < extendTest[s])	
							d += extendOffset[s];	
					} else if ( s==MAGCAT16_NUMBITS_MARKER ) {
						d = 32768;
					} else d = 0;
					pred = sel_predictor(psv,index,numCOL,curPixelPtr);
					curPixelPtr[index] =  (d + pred);
					index++;
				}				                		
            }/*endfor col*/
		}/*endfor row*/
    }

    function sel_predictor(psv,index,numCOL,curPixel)
	{
		var predictor;
		var i = frame.compsInScan;
		var upper     = curPixel[index - i* numCOL];
		var left      = curPixel[index-i*1];
		var diag      = curPixel[index - i*(numCOL - 1)];
		switch (psv) 
		{
			case 0: predictor = 0;		break;
			case 1: predictor = left;   break;
			case 2: predictor = upper;	break;
			case 3: predictor = diag;	break;
			case 4: predictor = left + upper - diag;	  break;
			case 5: predictor = left + upper - (diag>>1); break; 
			case 6: predictor = upper+((left-diag)>>1);	  break;
			case 7: predictor = (left+upper)>>1;	 	  break;
			default : predictor = 0;
		}/*endsandwich*/

		return predictor;
	}

	function DecodeImage(){	
	   var  curComp, ci;
	   var predictor;
       var numCOL, numROW, compsInScan;
	   var imagewidth, Pt, psv;
       var prevRowBuf,curRowBuf;
       var curPixelPtr;
	   var  row = 0;
	   var image;
	   numCOL      = imagewidth=frame.imageWidth;
       numROW      = frame.imageHeight;
       compsInScan = frame.compsInScan;
       Pt          = frame.Pt;
       psv         = frame.Ss;
	    
       curRowBuf   = mcuROW1;
	   curPixelPtr = imagetmp;
	   DecodeFirstRow (curRowBuf);
       PmPutRow(curRowBuf, numCOL,curPixelPtr);          
	   DecodeRow(curPixelPtr,compsInScan,numROW,numCOL,psv);
	}

	
      var offset = 0, length = data.length;
      var jfif = null;
      var adobe = null;
      var pixels = null;
      var frame, resetInterval;
      var quantizationTables = [];
      var huffmanTablesAC = [], huffmanTablesDC = [];
	  var spatialValue = [];
	  var  bitsLeft;
      frame = {};
      frame.dcHuffTblPtrs = [];	

      var fileMarker = readUint16();
      if (fileMarker != 0xFFD8) { // SOI (Start of Image)
        throw "SOI not found";
      }

      fileMarker = readUint16();
      while (fileMarker != 0xFFD9) { // EOI (End of image)
        var i, j, l;
        switch(fileMarker) {
          case 0xFFE0: // APP0 (Application Specific)
          case 0xFFE1: // APP1
          case 0xFFE2: // APP2
          case 0xFFE3: // APP3
          case 0xFFE4: // APP4
          case 0xFFE5: // APP5
          case 0xFFE6: // APP6
          case 0xFFE7: // APP7
          case 0xFFE8: // APP8
          case 0xFFE9: // APP9
          case 0xFFEA: // APP10
          case 0xFFEB: // APP11
          case 0xFFEC: // APP12
          case 0xFFED: // APP13
          case 0xFFEE: // APP14
          case 0xFFEF: // APP15
          case 0xFFFE: // COM (Comment)
            var appData = readDataBlock();

            if (fileMarker === 0xFFE0) {
              if (appData[0] === 0x4A && appData[1] === 0x46 && appData[2] === 0x49 &&
                appData[3] === 0x46 && appData[4] === 0) { // 'JFIF\x00'
                jfif = {
                  version: { major: appData[5], minor: appData[6] },
                  densityUnits: appData[7],
                  xDensity: (appData[8] << 8) | appData[9],
                  yDensity: (appData[10] << 8) | appData[11],
                  thumbWidth: appData[12],
                  thumbHeight: appData[13],
                  thumbData: appData.subarray(14, 14 + 3 * appData[12] * appData[13])
                };
              }
            }
            // TODO APP1 - Exif
            if (fileMarker === 0xFFEE) {
              if (appData[0] === 0x41 && appData[1] === 0x64 && appData[2] === 0x6F &&
                appData[3] === 0x62 && appData[4] === 0x65 && appData[5] === 0) { 
                adobe = {
                  version: appData[6],
                  flags0: (appData[7] << 8) | appData[8],
                  flags1: (appData[9] << 8) | appData[10],
                  transformCode: appData[11]
                };
              }
            }
            break;                
		   
		   case 0xFFC3: // SOF3(Spatial (sequential) lossless)     
			  readUint16(); // skip data length
			 
			  frame.lossless = (fileMarker === 0xFFC3);
			  frame.dataPrecision = data[offset++];                   
			  frame.imageHeight = readUint16(); // height
			  frame.imageWidth = readUint16(); // width
			  frame.numComponents = data[offset++];        
              frame.compInfo = [] ;
              frame.curCompInfo = [];
              frame.MCUmembership = [];      
              frame.restartInterval = 0;
			 		 
            
			  if ((frame.imageHeight <= 0) ||(frame.imageWidth <= 0) ||(frame.numComponents <= 0))
              {
					throw "Empty JPEG image (DNL not supported)";
	          }
			 
               var i;
			   
               var componentId;                      
               var componentIndex;
               for (i = 0; i <  frame.numComponents; i++) {
					componentIndex = i;
					componentId = data[offset];                       
					var h = data[offset + 1] >> 4;       //h sampling 1
					var v = data[offset + 1] & 15;       //v sampling 1
					
									
					frame.compInfo.push({
					 componentIndex: componentIndex,
					 componentId: componentId,               //componentId
					 hSampFactor: h,
					 vSampFactor: v, 
					 dcTblNo:0                
					});
					offset += 3;
			   }
			  break;

          case 0xFFC4: // DHT (Define Huffman Tables)       
             GetDht();
            break;

          case 0xFFDD: // DRI (Define Restart Interval)
            readUint16(); // skip data length
            resetInterval = readUint16();
            break;

          case 0xFFDA: // SOS (Start of Scan)
            var scanLength = readUint16();
            frame.compsInScan= data[offset++];
            scanLength -= 3;
			var n = frame.compsInScan;
            
            if ( scanLength != (n * 2 + 3) || n < 1 || n > 4) {
	           throw "Bogus SOS length";
	        } 
            
            var i,c,cc,ci;
            for (i = 0; i < n; i++){
				cc = data[offset++];
				c = data[offset++];

				for (ci = 0; ci < frame.numComponents; ci++)
				if (cc == frame.compInfo[ci].componentId) {
					break;
				}
				if (ci >= frame.numComponents) {
					throw "Invalid component number in SOS";
				}
				frame.curCompInfo[i] = frame.compInfo[ci];
				frame.compInfo[ci].dcTblNo = (c >> 4) & 15;
			} 
         
            frame.Ss = data[offset++]; 
            offset++
            c = data[offset++]; 
            frame.Pt = c & 0x0F;            
           
            // Check sampling factor validity.
           
            for (ci = 0; ci < frame.numComponents; ci++) {	          
				if ((frame.compInfo[ci].hSampFactor != 1) || (frame.compInfo[ci].vSampFactor != 1)) {
					throw "Error: Downsampling is not supported.\n";
				}
            }            
           
          
			// Prepare array describing MCU composition
     
            if (frame.compsInScan == 1) {
				frame.MCUmembership[0] = 0;
			} 
			else {
				if (frame.compsInScan > 4) {
					throw "Too many components for interleaved scan";
				}

				for (ci = 0; ci <frame.compsInScan; ci++) {
					frame.MCUmembership[ci] = ci;
			}
       }
    
       //Initialize mucROW1 and mcuROW2 which buffer two rows of
       // pixels for predictor calculation.
       
		var imagetmp = [];
        var mcuROW1 = [];

		for (i=0;i<frame.imageWidth;i++) {
			mcuROW1.push({i:[]});
		}
       
	    HuffDecoderInit();
        DecodeImage();
		break;

		default:
            if (data[offset - 3] == 0xFF && data[offset - 2] >= 0xC0 && data[offset - 2] <= 0xFE) {
              // could be incorrect encoding -- last 0xFF byte of the previous
              // block was eaten by the encoder
              offset -= 3;
              break;
            }
            throw "unknown JPEG marker " + fileMarker.toString(16);
        }
        fileMarker = readUint16();
      }

      this.width = frame.imageWidth;
      this.height = frame.imageHeight;
      this.jfif = jfif;
      this.adobe = adobe;
      this.image = imagetmp;
	  this.com_len = frame.numComponents;
     
    }, //end parse

	getData: function getData(width, height) {

	  var Y, Cb, Cr, K, C, M, Ye, R, G, B;
      var colorTransform;
      var numComponents = this.com_len;
      var dataLength = width * height * numComponents;
      var data = new Array(dataLength);
	 
	  var imagetmp = this.image;
	  var i;

	 switch (numComponents) {
        case 1: case 2:
             
		 for (i = 0; i < dataLength; i += numComponents)
			 data[i] = imagetmp[i];
		     break;
		 
        // no color conversion for one or two compoenents

        case 3:
          // The default transform for three components is true
          colorTransform = true;
          // The adobe transform marker overrides any previous setting
          if (this.adobe && this.adobe.transformCode)
            colorTransform = true;
          else if (typeof this.colorTransform !== 'undefined')
            colorTransform = !!this.colorTransform;

          if (colorTransform) {
            for (i = 0; i < dataLength; i += numComponents) {
              Y  = imagetmp[i    ];
              Cb = imagetmp[i + 1];
              Cr = imagetmp[i + 2];

              R = clampToUint8(Y - 179.456 + 1.402 * Cr);
              G = clampToUint8(Y + 135.459 - 0.344 * Cb - 0.714 * Cr);
              B = clampToUint8(Y - 226.816 + 1.772 * Cb);

              data[i    ] = R;
              data[i + 1] = G;
              data[i + 2] = B;
            }
          }
          break;
        case 4:
          if (!this.adobe)
            throw 'Unsupported color mode (4 components)';
          // The default transform for four components is false
          colorTransform = false;
          // The adobe transform marker overrides any previous setting
          if (this.adobe && this.adobe.transformCode)
            colorTransform = true;
          else if (typeof this.colorTransform !== 'undefined')
            colorTransform = !!this.colorTransform;

          if (colorTransform) {
            for (i = 0; i < dataLength; i += numComponents) {
              Y  = imagetmp[i];
              Cb = imagetmp[i + 1];
              Cr = imagetmp[i + 2];

              C = clampToUint8(434.456 - Y - 1.402 * Cr);
              M = clampToUint8(119.541 - Y + 0.344 * Cb + 0.714 * Cr);
              Y = clampToUint8(481.816 - Y - 1.772 * Cb);

              data[i    ] = C;
              data[i + 1] = M;
              data[i + 2] = Y;
              // K is unchanged
            }
          }
          break;
        default:
          throw 'Unsupported color mode';
      }
      return data;
    }, //end getData 

  copyToImageData: function copyToImageData() {
      var width = this.width, height = this.height;
      var imageDataBytes = width * height * 4;
      var imageDataArray = new Array(imageDataBytes);
      var data = this.getData(width, height);
      var i = 0, j = 0, k0, k1;
      var Y, K, C, M, R, G, B;
      switch (this.com_len) {
        case 1:
          while (j < imageDataBytes) {
            Y = data[i++];

            imageDataArray[j++] = Y;
            imageDataArray[j++] = Y;
            imageDataArray[j++] = Y;
            imageDataArray[j++] = 255;
          }
          break;
        case 3:
          while (j < imageDataBytes) {
            R = data[i++];
            G = data[i++];
            B = data[i++];

            imageDataArray[j++] = R;
            imageDataArray[j++] = G;
            imageDataArray[j++] = B;
            imageDataArray[j++] = 255;
          }
          break;
        case 4:
          while (j < imageDataBytes) {
            C = data[i++];
            M = data[i++];
            Y = data[i++];
            K = data[i++];

            k0 = 255 - K;
            k1 = k0 / 255;


            R = clampToUint8(k0 - C * k1);
            G = clampToUint8(k0 - M * k1);
            B = clampToUint8(k0 - Y * k1);

            imageDataArray[j++] = R;
            imageDataArray[j++] = G;
            imageDataArray[j++] = B;
            imageDataArray[j++] = 255;
          }
          break;
        default:
          throw 'Unsupported color mode';
      }

     return imageDataArray;
    } //end copyToImageData
  };   //end constructor.prototype 

  return constructor;
})();