// Main BAMBOO namespace.
var BAMBOO = BAMBOO || {};

var Kinetic = Kinetic || {};

/**
 * Main application class.
 * @class App
 * @namespace BAMBOO
 * @constructor
 */
BAMBOO.App = function()
{
    // Local object
    var self = this;
    // Image
    var image = null;
    // View
    var view = null;
    // Original image
    var originalImage = null;
    // Image data array
    var imageData = null;
    // Image data width
    var dataWidth = 0;
    // Image data height
    var dataHeight = 0;

    // display window scale
    var windowScale = 1;
     
    // Image layer
    var imageLayer = null;
    // Draw layer
    var drawLayer = null;
    // Draw stage
    var drawStage = null;
	var table_make = true;
	var prev_index;
	this.preview = false;

	
    
    // flag to know if the info layer is listening on the image.
    var isInfoLayerListening = false;
    
    // Tool box
    var toolBox = new BAMBOO.tool.ToolBox(this);
    // UndoStack
    var undoStack = new BAMBOO.tool.UndoStack();
    
    /** 
     * Get the version of the application.
     * @method getVersion
     * @return {String} The version of the application.
     */
    this.getVersion = function() { return "v0.8.0beta"; };
    
    /** 
     * Get the image.
     * @method getImage
     * @return {Image} The associated image.
     */
    this.getImage = function() { return image; };
    /** 
     * Get the view.
     * @method getView
     * @return {Image} The associated view.
     */
    this.getView = function() { return view; };
    
    /** 
     * Set the view.
     * @method setImage
     * @param {Image} img The associated image.
     */
    this.setImage = function(img)
    { 
        image = img; 
        view.setImage(img);
    };
    
    /** 
     * Restore the original image.
     * @method restoreOriginalImage
     */
    this.restoreOriginalImage = function() 
    { 
        image = originalImage; 
        view.setImage(originalImage); 
    }; 
    
    /** 
     * Get the image data array.
     * @method getImageData
     * @return {Array} The image data array.
     */
    this.getImageData = function() { return imageData; };

    /** 
     * Get the tool box.
     * @method getToolBox
     * @return {Object} The associated toolbox.
     */
    this.getToolBox = function() { return toolBox; };

    /** 
     * Get the image layer.
     * @method getImageLayer
     * @return {Object} The image layer.
     */
    this.getImageLayer = function() { return imageLayer; };
    /** 
     * Get the draw layer.
     * @method getDrawLayer
     * @return {Object} The draw layer.
     */
    this.getDrawLayer = function() { return drawLayer; };
    /** 
     * Get the draw stage.
     * @method getDrawStage
     * @return {Object} The draw layer.
     */
    this.getDrawStage = function() { return drawStage; };

    /** 
     * Get the undo stack.
     * @method getUndoStack
     * @return {Object} The undo stack.
     */
    this.getUndoStack = function() { return undoStack; };

    /**
     * Initialise the HTML for the application.
     * @method init
     */
    this.init = function(){
        // align layers when the window is resized
        window.onresize = this.resize;
        // possible load from URL
        if( typeof skipLoadUrl === "undefined" ) {
            var inputUrls = BAMBOO.html.getUriParam(); 
            if( inputUrls && inputUrls.length > 0 ) {
                this.loadURL(inputUrls);
            }
        }
        else{
            console.log("Not loading url from adress since skipLoadUrl is defined.");
        }
    };
    
    /**
     * Reset the application.
     * @method reset
     */
    this.reset = function()
    {
        image = null;
        view = null;
        undoStack = new BAMBOO.tool.UndoStack();
        BAMBOO.gui.cleaUndoHtml();
    };
    
    /**
     * Reset the layout of the application.
     * @method resetLayout
     */
    this.resetLayout = function () {
        if ( imageLayer ) {
            imageLayer.resetLayout(1);
			//imageLayer.setWidth();
			//imageLayer.setHeight();
			imageLayer.draw();
        }
        if ( drawStage ) {
            drawStage.offset( {'x': 0, 'y': 0} );
           // drawStage.scale( {'x': windowScale, 'y': windowScale} );
            drawStage.scale( {'x': 1, 'y': 1} );
            drawStage.draw();
        }
    };
    
    /**
     * Handle key down event.
     * - CRTL-Z: undo
     * - CRTL-Y: redo
     * Default behavior. Usually used in tools. 
     * @method handleKeyDown
     * @param {Object} event The key down event.
     */
    this.handleKeyDown = function(event)
    {
        if( event.keyCode === 90 && event.ctrlKey ) // ctrl-z
        {
            undoStack.undo();
        }
        else if( event.keyCode === 89 && event.ctrlKey ) // ctrl-y
        {
            undoStack.redo();
        }
    };

	this.browser_type = function()
	  {
		var agt = navigator.userAgent.toLowerCase();
        if (agt.indexOf("chrome") != -1) return 'Chrome'; 
        if (agt.indexOf("opera") != -1) return 'Opera'; 
        if (agt.indexOf("staroffice") != -1) return 'Star Office'; 
        if (agt.indexOf("webtv") != -1) return 'WebTV'; 
        if (agt.indexOf("beonex") != -1) return 'Beonex'; 
        if (agt.indexOf("chimera") != -1) return 'Chimera'; 
        if (agt.indexOf("netpositive") != -1) return 'NetPositive'; 
        if (agt.indexOf("phoenix") != -1) return 'Phoenix'; 
        if (agt.indexOf("firefox") != -1) return 'Firefox'; 
        if (agt.indexOf("safari") != -1) return 'Safari'; 
        if (agt.indexOf("skipstone") != -1) return 'SkipStone'; 
        if (agt.indexOf("msie") != -1) return 'Internet Explorer'; 
        if (agt.indexOf("netscape") != -1) return 'Netscape'; 
        if (agt.indexOf("mozilla/5.0") != -1) return 'Mozilla'; 
	  }
    
    /**
     * Handle change files event.
     * @method onChangeFiles
     * @param {Object} event The event fired when changing the file field.
     */
    function search_handle(hlist,handle){
		var result = false;
        if( handle.length != 0){          
            
          for(var i=0;i<hlist.length;i++){
		     if((hlist[i][0].name == handle[0].name)&&(hlist[i][0].size == handle[0].size))
			    {
			       result = true;		   
				    $("#dicom_info tbody tr").each(function(){
					if ($(this).attr("id") != null && $(this).attr("id") != undefined)
					   {
						   var indexs = $(this).attr("id");
				           var ids = indexs.substr(7, 10);
				          parseInt(ids);

						 if ( parseInt(ids) == i)
						     {
                               $(".tagsList tbody tr").removeClass( "treeDicom_sel" ).css("background-color","white");
						       $(this).addClass( "treeDicom_sel" ).css("background-color","gainsboro");							
						     }
					   }
				   });
		         break;
			   }
		   }
          
       }
		return result;
	}
  


  function search_urls(ulist,url){
       var result = false;
	   var index = ulist.indexOf(url,100);
	   if(  index != -1)
	     {
             result = true;
			  $("#dicom_info tbody tr").each(function(){
					if ($(this).attr("id") != null && $(this).attr("id") != undefined)
					   {
						   var indexs = $(this).attr("id");
				           var ids = indexs.substr(12,3);
				          
						 if ( parseInt(ids) == index)
						     {
                               $(".tagsList tbody tr").removeClass( "treeDicom_sel" ).css("background-color","white");
						       $(this).addClass( "treeDicom_sel" ).css("background-color","gainsboro");							
						     }
					   }
				 });
	     }
       return result;
  
  }

    var file_list =[];
    this.handle_index = -1;
    this.onChangeFiles = function(event)
      {    
          this.url_type = false;
          if (BAMBOO.tool.tools["CinePlay"].timeout >= 0) BAMBOO.tool.tools["CinePlay"].pause();
         
             if(!search_handle(file_list,event.target.files))
               {
		         self.table_make = true;
		         file_list[++(this.handle_index)] = event.target.files;
                 self.prev_index = this.handle_index;
                
		       }
		    else
              {
                self.table_make = false;
              }
		    this.loadFiles(event.target.files);
           
            if (this.browser_type()=='Internet Explorer') {
                   $("#imagefile").replaceWith( $("#imagefile").clone(true) );
             } else {   
                  $("#imagefile").val("");
             }
     		
       };


	var urls =new Array();
	var urls_list =[]
    this.urls_hindex = 100;

	this.Wado_test = function()
	{   
		urls[0] = $('#dic_info').val();
		this.url_type = true;
		if (BAMBOO.tool.tools["CinePlay"].timeout >= 0) BAMBOO.tool.tools["CinePlay"].pause();
  
        if(!search_urls(urls_list,urls))
           {
               self.table_make = true;
		       urls_list[++this.urls_hindex] = urls;
		       self.prev_index = this.urls_hindex; 
              
           }
        else
          {
              self.table_make = false;
          }
           this.loadURL(urls);
		

	}

    /**
     * Load a list of files.
     * @method loadFiles
     * @param {Array} files The list of files to load.
     */
    this.loadFiles = function(files) 
    {
        // clear variables
        this.reset();
        // create IO
        var fileIO = new BAMBOO.io.File();
        fileIO.onload = function(data){
           if( image ) {
             //   image.appendSlice( data.view.getImage() );
            }
        
         
		   postLoadInit(data);
       
        };
        fileIO.onerror = function(error){ handleError(error); };
        // main load (asynchronous)
        fileIO.load(files);
    };

	 this.p_loadFiles = function(files) 
       {
        // clear variables
        this.reset();
        // create IO
        var fileIO = new BAMBOO.io.File();
        fileIO.onload = function(data){
              
          preview_draw(data,278,200);  
       
        };
        fileIO.onerror = function(error){ handleError(error); };
        // main load (asynchronous)
        fileIO.load(files);
       };
	   
    
    /**
     * Handle change url event.
     * @method onChangeURL
     * @param {Object} event The event fired when changing the url field.
     */
   
    this.onChangeURL = function(event)
    {
        this.loadURL([event.target.value]);

    };

    /**
     * Load a list of URLs.
     * @method loadURL
     * @param {Array} urls The list of urls to load.
     */
    this.loadURL = function(urls) 
    {
        // clear variables
        this.reset();
        // create IO
        var urlIO = new BAMBOO.io.Url();
        urlIO.onload = function(data){
            if( image ) {
               // image.appendSlice( data.view.getImage() );
            }
			 
             postLoadInit(data);
        };
        urlIO.onerror = function(error){ handleError(error); };
        // main load (asynchronous)
        urlIO.load(urls);
    };

	this.p_loadURL = function(urls) 
    {
        // clear variables
      //  this.reset();
        // create IO
        var urlIO = new BAMBOO.io.Url();
        urlIO.onload = function(data){
          
		   preview_draw(data,278,200);
           
        };
        urlIO.onerror = function(error){ handleError(error); };
        // main load (asynchronous)
        urlIO.load(urls);
    };


    
    /**
     * Generate the image data and draw it.
     * @method generateAndDrawImage
     */
    this.generateAndDrawImage = function()
    {         
        // generate image data from DICOM
        view.generateImageData(imageData);
		//app.generate_data(imageData);        //adder
        // set the image data of the layer
        imageLayer.setImageData(imageData);
        // draw the image
        imageLayer.draw();
    };

	this.generate_data = function(array)
	{
		var sliceNumber = view.getCurrentPosition().k;
		var view_slice = app.data.view[sliceNumber];
		var image = view_slice.getImage();
        var pxValue = 0;
        var photoInterpretation = image.getPhotometricInterpretation();
        var planarConfig = image.getPlanarConfiguration();
        var windowLut = view_slice.getWindowLut();
        var colorMap = view_slice.getColorMap();
        var index = 0;
        var sliceSize = 0;
        var sliceOffset = 0;
    switch (photoInterpretation)
    {
    case "MONOCHROME1":
    case "MONOCHROME2":
        sliceSize = image.getSize().getSliceSize();       
        for(var i=0; i < sliceSize; ++i)
        {   
		  var a=windowLut.getValue( image.getValueAtOffset(i));

            pxValue = parseInt( windowLut.getValue( image.getValueAtOffset(i) ), 10 );
            array.data[index] = colorMap.red[pxValue];
            array.data[index+1] = colorMap.green[pxValue];
            array.data[index+2] = colorMap.blue[pxValue];
            array.data[index+3] = 0xff;
            index += 4;
        }
        break;
	
	case "PALETTE COLOUR":
	case "YBR_FULL":
	case "YBR_PARTIAL_422":
	case "YBR_PARTIAL_420":
	case "YBR_RCT":
	case "YBR_ICT":
	case "YBR_FULL_422":

		// the planar configuration defines the memory layout
        if( planarConfig !== 0 && planarConfig !== 1 ) {
            throw new Error("Unsupported planar configuration: "+planarConfig);
        }
        sliceSize = image.getSize().getSliceSize();
       
        // default: RGBRGBRGBRGB...
        var posR =0;
        var posG =1;
        var posB =2;
        var stepPos = 4;
        // RRRR...GGGG...BBBB...
        if (planarConfig === 1) { 
            posR = 0;
            posG = 1 + sliceSize;
            posB = 2 + 2 * sliceSize;
            stepPos = 1;
        }
        
        var redValue = 0;
        var greenValue = 0;
        var blueValue = 0;
        for(var j=0; j < image.getSize().getSliceSize(); ++j)
        {        
            redValue = parseInt( windowLut.getValue( image.getValueAtOffset(posR) ), 10 );
            greenValue = parseInt( windowLut.getValue( image.getValueAtOffset(posG) ), 10 );
            blueValue = parseInt( windowLut.getValue( image.getValueAtOffset(posB) ), 10 );
            
            array.data[index] =   redValue;
            array.data[index+1] = greenValue;
            array.data[index+2] = blueValue;
            array.data[index+3] = 0xff;
            index += 4;
            
            posR += stepPos;
            posG += stepPos;
            posB += stepPos;
        }
        break;
    
    case "RGB":
        // the planar configuration defines the memory layout
        if( planarConfig !== 0 && planarConfig !== 1 ) {
            throw new Error("Unsupported planar configuration: "+planarConfig);
        }
        sliceSize = image.getSize().getSliceSize();
        sliceOffset = 0;
        // default: RGBRGBRGBRGB...
        var posR = sliceOffset;
        var posG = sliceOffset + 1;
        var posB = sliceOffset + 2;
        var stepPos = 3;
        // RRRR...GGGG...BBBB...
        if (planarConfig === 1) { 
            posR = sliceOffset;
            posG = sliceOffset + sliceSize;
            posB = sliceOffset + 2 * sliceSize;
            stepPos = 1;
        }
        
        var redValue = 0;
        var greenValue = 0;
        var blueValue = 0;
        for(var j=0; j < image.getSize().getSliceSize(); ++j)
        {        
            redValue = parseInt( windowLut.getValue( image.getValueAtOffset(posR) ), 10 );
            greenValue = parseInt( windowLut.getValue( image.getValueAtOffset(posG) ), 10 );
            blueValue = parseInt( windowLut.getValue( image.getValueAtOffset(posB) ), 10 );
            
            array.data[index] = redValue;
            array.data[index+1] = greenValue;
            array.data[index+2] = blueValue;
            array.data[index+3] = 0xff;
            index += 4;
            
            posR += stepPos;
            posG += stepPos;
            posB += stepPos;
        }
        break;
    
    default: 
        throw new Error("Unsupported photometric interpretation: "+photoInterpretation);
    }

	};
    
    /**
     * Resize the display window. To be called once the image is loaded.
     * @method resize
     */
    this.resize = function()
    {
        // previous width
         //var oldWidth = parseInt(windowScale*dataWidth, 10);
	     var oldWidth = parseInt(dataWidth, 10);
        // find new best fit
        var size = BAMBOO.gui.getWindowSize();
        windowScale = Math.min( (size.width / dataWidth), (size.height / dataHeight) );
		
		// new sizes
        var newWidth = parseInt(windowScale*dataWidth, 10);
        var newHeight = parseInt(windowScale*dataHeight, 10);

		//var newWidth = $("#drawDiv").width();
        //var newHeight = $("#drawDiv").height();
          

        // ratio previous/new to add to zoom
        var mul = newWidth / oldWidth;

      // resize container
         var draw_width = size.width
         var draw_height = size.height
        $("#layerContainer").width(draw_width);
        $("#layerContainer").height(draw_height + 1);


       // $("#layerContainer").width(newWidth);
       // $("#layerContainer").height(newHeight + 1); // +1 to be sure...
        // resize image layer
        if( imageLayer ) {
            var iZoomX = imageLayer.getZoom().x * mul;
            var iZoomY = imageLayer.getZoom().y * mul;
            imageLayer.setWidth(draw_width);
            imageLayer.setHeight(draw_height + 1);
            imageLayer.zoom(iZoomX, iZoomY, 0, 0);
            imageLayer.draw();
        }
        // resize draw stage
        if( drawStage ) {
            // resize div
            $("#drawDiv").width(draw_width);
            $("#drawDiv").height(draw_height);
            // resize stage
            var stageZomX = drawStage.scale().x * mul;
            var stageZoomY = drawStage.scale().y * mul;
            drawStage.setWidth(draw_width);
            drawStage.setHeight(draw_height);
            drawStage.scale( {x: stageZomX, y: stageZoomY} );
            drawStage.draw();
        }
    };
    
    /**
     * Toggle the display of the info layer.
     * @method toggleInfoLayerDisplay
     */
    this.toggleInfoLayerDisplay = function()
    {
        // toggle html
        BAMBOO.html.toggleDisplay('infoLayer');
        // toggle listeners
        if( isInfoLayerListening ) {
            removeImageInfoListeners();
        }
        else {
            addImageInfoListeners();
        }
    };
    
    /**
     * Init the Window/Level display
     */
    this.initWLDisplay = function()
    {
        // set window/level
        var keys = Object.keys(BAMBOO.tool.presets);
        BAMBOO.tool.updateWindowingData(
            BAMBOO.tool.presets[keys[0]].center, 
            BAMBOO.tool.presets[keys[0]].width );
        // default position
        BAMBOO.tool.updatePostionValue(0,0);
    };

    // Private Methods -------------------------------------------

    /**
     * Add image listeners.
     * @method addImageInfoListeners
     * @private
     */
    function addImageInfoListeners()
    {
        view.addEventListener("wlchange", BAMBOO.info.updateWindowingDiv);
        view.addEventListener("wlchange", BAMBOO.info.updateMiniColorMap);
        view.addEventListener("wlchange", BAMBOO.info.updatePlotMarkings);
        view.addEventListener("colorchange", BAMBOO.info.updateMiniColorMap);
        view.addEventListener("positionchange", BAMBOO.info.updatePositionDiv);
        isInfoLayerListening = true;
    }
    
    /**
     * Remove image listeners.
     * @method removeImageInfoListeners
     * @private
     */
    function removeImageInfoListeners()
    {
        view.removeEventListener("wlchange", BAMBOO.info.updateWindowingDiv);
        view.removeEventListener("wlchange", BAMBOO.info.updateMiniColorMap);
        view.removeEventListener("wlchange", BAMBOO.info.updatePlotMarkings);
        view.removeEventListener("colorchange", BAMBOO.info.updateMiniColorMap);
        view.removeEventListener("positionchange", BAMBOO.info.updatePositionDiv);
        isInfoLayerListening = false;
    }
    
    /**
     * General-purpose event handler. This function just determines the mouse 
     * position relative to the canvas element. It then passes it to the current tool.
     * @method eventHandler
     * @private
     * @param {Object} event The event to handle.
     */
    function eventHandler(event)
    {
        // flag not to get confused between touch and mouse
        var handled = false;
        // Store the event position relative to the image canvas
        // in an extra member of the event:
        // event._x and event._y.
        var offsets = null;
        var position = null;
        if( event.type === "touchstart" ||
            event.type === "touchmove")
        {
            event.preventDefault();
            // event offset(s)
            offsets = BAMBOO.html.getEventOffset(event);
            // should have at least one offset
            event._xs = offsets[0].x;
            event._ys = offsets[0].y;
            position = self.getImageLayer().displayToIndex( offsets[0] );
            event._x = parseInt( position.x, 10 );
            event._y = parseInt( position.y, 10 );
            // possible second
            if ( offsets.length === 2 ) {
                event._x1s = offsets[1].x;
                event._y1s = offsets[1].y;
                position = self.getImageLayer().displayToIndex( offsets[1] );
                event._x1 = parseInt( position.x, 10 );
                event._y1 = parseInt( position.y, 10 );
            }
            // set handle event flag
            handled = true;
        }
        else if( event.type === "mousemove" ||
            event.type === "mousedown" ||
            event.type === "mouseup" ||
            event.type === "mouseout" ||
            event.type === "mousewheel" ||
            event.type === "dblclick" ||
            event.type === "DOMMouseScroll" )
        {
            offsets = BAMBOO.html.getEventOffset(event);
            event._xs = offsets[0].x;
            event._ys = offsets[0].y;
            position = self.getImageLayer().displayToIndex( offsets[0] );
            event._x = parseInt( position.x, 10 );
            event._y = parseInt( position.y, 10 );
            // set handle event flag
            handled = true;
        }
        else if( event.type === "keydown" || 
                event.type === "touchend")
        {
            handled = true;
        }
            
        // Call the event handler of the tool.
        if( handled )
        {
            var func = self.getToolBox().getSelectedTool()[event.type];
            if( func )
            {
                func(event);
            }
        }
    }
    
    /**
     * Handle an error: display it to the user.
     * @method handleError
     * @private
     * @param {Object} error The error to handle.
     */
    function handleError(error)
    {
        // alert window
        if( error.name && error.message) {
            alert(error.name+": "+error.message+".");
        }
        else {
            alert("Error: "+error+".");
        }
        // log
        if( error.stack ) {
            console.error(error.stack);
        }
    }
    
    /**
     * Create the application layers.
     * @method createLayers
     * @private
     * @param {Number} dataWidth The width of the input data.
     * @param {Number} dataHeight The height of the input data.
     */
    function createLayers(dataWidth, dataHeight)
    {
        // image layer
        imageLayer = new BAMBOO.html.Layer("imageLayer");
        imageLayer.initialise(dataWidth, dataHeight);
        imageLayer.fillContext();
        imageLayer.setStyleDisplay(true);
        // draw layer
        if( document.getElementById("drawDiv") !== null) {
            // create stage
            drawStage = new Kinetic.Stage({
                container: 'drawDiv',
                width: dataWidth,
                height: dataHeight,
                listening: false
            });
            // create layer
            drawLayer = new Kinetic.Layer({
                listening: false,
                hitGraphEnabled: false
            });
            // add the layer to the stage
            drawStage.add(drawLayer);
        }
        // resize app
        //  self.resetLayout();
        self.resize();
    }

	function createDirTagsTable(dataInfo)
	{
		// HTML node
        var node = document.getElementById("tags");
        if( node === null ) {
            return;
        }
		alert ("dddd");
		var curStudy = -1;
		var curSeries = -1;
		var curImage = -1;

		var dicomdirObj = {};

		var keys = Object.keys(dataInfo.elements);
		for( var o=0; o<keys.length; ++o )
		{
			if (keys[o] == "x00041220") // DirectoryRecordSequence
			{
				var dirObj = dataInfo.elements[keys[o]];
				if (dirObj instanceof Object)
				{
					for ( var i = 0; i < dirObj.items.length; i++)
					{
						var _modality = "";
						var _id = "";
						var _name = "";
						var _age = "";
						var _sex = "";
						var _studyDate = "";
						var _studyId = "";
						var _studyDec = "";						
						var _ReferencedFileID = "";

						var type = -1;

						var dataSet = dirObj.items[i].dataSet;
						for(var propertyName in dataSet.elements)
						{
							if (propertyName == "x00041430") // DirectoryRecordType
							{
								var str = dataSet.string(propertyName);
								var stringIsAscii = isASCII(str);
								if (stringIsAscii)
								{
									if (str == "PATIENT")
									{
										type = 0;
									}
									if (str == "STUDY")
									{
										type = 1;
									}
									if (str == "SERIES")
									{
										type = 2;
									}
									if (str == "IMAGE")
									{
										type = 3;
									}
								}
								else
								{
								}
							}
							else
							{
								if (propertyName == "x00080060") //Modality
									_modality = dataSet.string(propertyName);
								if (propertyName == "x00100010") //PatientName
									_name = dataSet.string(propertyName);
								if (propertyName == "x00100020") //PatientID
									_id = dataSet.string(propertyName);
								if (propertyName == "x00101010") //PatientAge
									_age = dataSet.string(propertyName);
								if (propertyName == "x00100040") //PatientSex
									_sex = dataSet.string(propertyName);
								if (propertyName == "x00080020") //StudyDate
									_studyDate = dataSet.string(propertyName);
								if (propertyName == "x00200010") //StudyID
									_studyId = dataSet.string(propertyName);
								if (propertyName == "x00081030") //StudyDescription
									_studyDec = dataSet.string(propertyName);
								if (propertyName == "x00041500") //ReferencedFileID
									_ReferencedFileID = dataSet.string(propertyName);
							}
						}

						if (type == 0)
						{
							dicomdirObj.name = _name;
							dicomdirObj.id = _id;
							dicomdirObj.age = _age;
							dicomdirObj.sex = _sex;
							dicomdirObj.study = [];
							curStudy = -1;
							curSeries = -1;
							curImage = -1;
						}
						if (type == 1)
						{
							curStudy++;
							curSeries = -1;
							curImage = -1;
							var studyObj = {};
							studyObj.studyDate = _studyDate;
							studyObj.studyId = _studyId;
							studyObj.studyDec = _studyDec;
							if (_studyDec == "" || _studyDec == "...")
							{
								studyObj.studyDec = "No study description";
							}
							dicomdirObj.study[curStudy] = studyObj;
							dicomdirObj.study[curStudy].series = [];
						}
						if (type == 2)
						{
							curSeries++;
							curImage = -1;
							var seriesObj = {};
							seriesObj.modality = _modality;
							seriesObj.dec = _studyDec;
							if (_studyDec == "" || _studyDec == "...")
							{
								seriesObj.dec = "No series description";
							}

							dicomdirObj.study[curStudy].series[curSeries] = seriesObj;
							dicomdirObj.study[curStudy].series[curSeries].image = [];
						}
						if (type == 3)
						{
							curImage++;
							var imageObj = {};
							imageObj.fileID = _ReferencedFileID;
							dicomdirObj.study[curStudy].series[curSeries].image[curImage] = imageObj;
						}
					}
					break;
				}
			}
		}

		var tbl = document.getElementById("dicom_info");
		var rows_count = tbl.rows.length;
		$("#dicom_info tbody").html($("#dicom_info tbody").html() + '<tr><td id="Select'+rows_count+'"></td><td id="Modality'+rows_count+'"></td><td id="ID'+rows_count+'"></td>'+
								'<td id="Name'+rows_count+'"></td><td id="Age'+rows_count+'"></td><td id="Sex'+rows_count+'"></td>'+
								'<td id="StudyDate'+rows_count+'"></td><td id="StudyID'+rows_count+'"></td><td id="StudyDesc'+rows_count+'"></td></tr>');

		$("#Modality"+rows_count).html("...");		
		$("#ID"+rows_count).html(dicomdirObj.id);
		$("#Name"+rows_count).html(dicomdirObj.name);
		$("#Age"+rows_count).html(dicomdirObj.age);
		$("#Sex"+rows_count).html(dicomdirObj.sex);
		$("#StudyDate"+rows_count).html("...");
		$("#StudyID"+rows_count).html("...");
		$("#StudyDesc"+rows_count).html("...");

		$(".tagsList tbody tr").hover(
			function () {
				if ($(this).hasClass( "treeDicom_sel" ) === false)
					$(this).css("background-color","lightgoldenrodyellow");
			}, 
			function () {
				if ($(this).hasClass( "treeDicom_sel" ))
					$(this).css("background-color","gainsboro");
				else
					$(this).css("background-color","white");
			}
		);

		var imgId = "dicomdir_0";
		$("#Select"+rows_count).html("<img src='resources/expand.png' title='collapse/expand' coll='1' id='"+imgId+"' class='collapseDicomDir'>");
		$("#"+imgId).click( function() {
			if ($(this).attr("coll") == "1" )
			{
				$(this).attr("coll", "0");
				$(this).attr("src", "resources/collapse.png");				
				
				var strHtml = "";
				
				for (var st = 0; st < dicomdirObj.study.length; st++)
				{
					strHtml += "<tr class='"+imgId+"' index='"+imgId+"_"+st+"' style=''>";
					strHtml += "<td id='Select'><img src='resources/collapse.png' title='collapse/expand' coll='1' id='"+imgId+'_'+st+"' class='collapseDicomDir_study' style='padding-left:35px;'></td>";
					strHtml += "<td id='Modality'></td>";
					strHtml += "<td id='ID'>"+dicomdirObj.id+"</td>";
					strHtml += "<td id='Name'>"+dicomdirObj.name+"</td>";
					strHtml += "<td id='Age'>"+dicomdirObj.age+"</td>";
					strHtml += "<td id='Sex'>"+dicomdirObj.sex+"</td>";
					strHtml += "<td id='StudyDate'>"+dicomdirObj.study[st].studyDate+"</td>";
					strHtml += "<td id='StudyID'>"+dicomdirObj.study[st].studyId+"</td>";
					strHtml += "<td id='StudyDesc'>"+dicomdirObj.study[st].studyDec+"</td>";		
					strHtml += "</tr>";
					for (var se = 0; se < dicomdirObj.study[st].series.length; se++)
					{
						strHtml += "<tr class='"+imgId+" "+imgId+'_'+st+"' index='"+imgId+"_"+st+"_"+se+"' style=''>";
						strHtml += "<td id='Select'><img src='resources/collapse.png' title='collapse/expand' coll='1' id='"+imgId+'_'+st+'_'+se+"' class='collapseDicomDir_series' style='padding-left:60px;'></td>";
						strHtml += "<td id='Modality'>"+dicomdirObj.study[st].series[se].modality+"</td>";
						strHtml += "<td id='ID'>"+dicomdirObj.id+"</td>";
						strHtml += "<td id='Name'>"+dicomdirObj.name+"</td>";
						strHtml += "<td id='Age'>"+dicomdirObj.age+"</td>";
						strHtml += "<td id='Sex'>"+dicomdirObj.sex+"</td>";
						strHtml += "<td id='StudyDate'>"+dicomdirObj.study[st].studyDate+"</td>";
						strHtml += "<td id='StudyID'>"+dicomdirObj.study[st].studyId+"</td>";
						strHtml += "<td id='StudyDesc'>"+dicomdirObj.study[st].series[se].dec+"</td>";		
						strHtml += "</tr>";

						for (var img = 0; img < dicomdirObj.study[st].series[se].image.length; img++)
						{
							strHtml += "<tr class='"+imgId+" "+imgId+'_'+st+" "+imgId+'_'+st+'_'+se+"' imgpath='"+dicomdirObj.study[st].series[se].image[img].fileID+"'"+
										" id='dicomdirimg_"+st+'_'+se+'_'+img+"' style='background-color:white'>";
							strHtml += "<td id='Select'></td>";
							strHtml += "<td id='Modality'>"+dicomdirObj.study[st].series[se].modality+"</td>";
							strHtml += "<td id='ID'>"+dicomdirObj.id+"</td>";
							strHtml += "<td id='Name'>"+dicomdirObj.name+"</td>";
							strHtml += "<td id='Age'>"+dicomdirObj.age+"</td>";
							strHtml += "<td id='Sex'>"+dicomdirObj.sex+"</td>";
							strHtml += "<td id='StudyDate'>"+dicomdirObj.study[st].studyDate+"</td>";
							strHtml += "<td id='StudyID'>"+dicomdirObj.study[st].studyId+"</td>";
							strHtml += "<td id='StudyDesc'>"+dicomdirObj.study[st].series[se].image[img].fileID+"</td>";		
							strHtml += "</tr>";
						}
					}
				}

				strHtml += "";

				$(strHtml).insertAfter($(this).parent().parent());

				//$("#treeDicomDir").html(strHtml);
				//$("#treeDicomDir").css("width", $(".tagsList").width());				
				//$("#treeDicomDir").css("top", $(this).parent().position().top + $(this).parent().height() + 10);
				//$("#treeDicomDir").css("left", $(".tagsList").position().left + 10);
				//$("#treeDicomDir").css("display", "inline");

				$("."+imgId).hover(
					function () {
						if ($(this).hasClass( "treeDicom_sel" ) === false)
							$(this).css("background-color","lightgoldenrodyellow");
					}, 
					function () {
						if ($(this).hasClass( "treeDicom_sel" ))
							$(this).css("background-color","gainsboro");
						else
							$(this).css("background-color","white");
					}
				);

				$("."+imgId).dblclick(function () {
					 var index = $(this).attr("index");
					 if (index != null && index != undefined)
					 {
						 $(".tagsList tbody tr").removeClass( "treeDicom_sel" ).css("background-color","white");
						 $(this).addClass( "treeDicom_sel" ).css("background-color","gainsboro");
						 //alert(0);
					 }					 
				});

				for (var st = 0; st < dicomdirObj.study.length; st++)
				{
					$("#"+imgId+'_'+st).click(function () {
						if ($(this).attr("coll") == "1" )
						{
							$(this).attr("coll", "0");
							$(this).attr("src", "resources/expand.png");
							$("."+$(this).attr("id")).css("display", "none");	
						}
						else
						{
							$(this).attr("coll", "1");
							$(this).attr("src", "resources/collapse.png");	
							$("."+$(this).attr("id")).css("display", "");
						}
					});
					
					for (var se = 0; se < dicomdirObj.study[st].series.length; se++)
					{
						$("#"+imgId+'_'+st+'_'+se).click(function () {
							if ($(this).attr("coll") == "1" )
							{
								$(this).attr("coll", "0");
								$(this).attr("src", "resources/expand.png");	
								$("."+$(this).attr("id")).css("display", "none");
							}
							else
							{
								$(this).attr("coll", "1");
								$(this).attr("src", "resources/collapse.png");
								$("."+$(this).attr("id")).css("display", "");
							}
						});
						
						for (var img = 0; img < dicomdirObj.study[st].series[se].image.length; img++)
						{
							$("#dicomdirimg_"+st+'_'+se+'_'+img).dblclick(function() {
								var path = $(this).attr("imgpath");
								$(".tagsList tbody tr").removeClass( "treeDicom_sel" ).css("background-color","white");
								$(this).addClass( "treeDicom_sel" ).css("background-color","gainsboro");
								//alert(1);
							});
						}
					}
				}
			}
			else
			{
				$(this).attr("coll", "1");
				$(this).attr("src", "resources/expand.png");
				$("."+imgId).remove();				
				//$("#treeDicomDir").html("");
				//$("#treeDicomDir").css("display", "none");
			}
		});

		var tbl =document.getElementById("dicom_info");
		self.row_count = tbl.rows.length;
	}
    
    /**
     * Create the DICOM tags table. To be called once the DICOM has been parsed.
     * @method createTagsTable
     * @private
     * @param {Object} dataInfo The data information.
     */
    function createTagsTable(dataInfo)
    {
        // HTML node
        var node = document.getElementById("tags");
        if( node === null ) {
            return;
        }
		alert ("dddd");
		var imgId = "dicomdir_0";
		$("."+imgId).remove();
		var cell = new Array(9);
		cell[0] = "";

		var keys = Object.keys(dataInfo);
 
		for( var o=0; o<keys.length; ++o )
		{
			var str = dataInfo[keys[o]].value;
			if (str instanceof Array)
			{
				if (keys[o] == "Modality")   cell[1] =str[0] ;
				if (keys[o] == "PatientID")  cell[2] =str[0];
				if (keys[o] == "PatientName") cell[3] =str[0] ;
				if (keys[o] == "PatientAge")  cell[4] =str[0];
				if (keys[o] == "PatientSex")  cell[5] =str[0];
				if (keys[o] == "StudyDate")  cell[6] =str[0];
				if (keys[o] == "StudyID")    cell[7] =str[0];
				if (keys[o] == "StudyDescription") cell[8]=str[0];
			}						
		}

       // var row_id; 
	   // if (self.url_type)  row_id =self.urls_hindex;
	   // else row_id = self.handle_index ; 
        
        
		
		if (self.table_make)
		  {	
			if (self.url_type)
		     	{
                    $("#dicom_info tbody").html($("#dicom_info tbody").html() + '<tr id="wado_server_'+self.urls_hindex+'">'+
								'<td class="sel"></td>'+
								'<td class="mod"></td>'+
								'<td class="pid"></td>'+
								'<td class="pname"></td>'+
								'<td class="page"></td>'+
								'<td class="psex"></td>'+
								'<td class="sdate"></td>'+
								'<td class="sid"></td>'+
								'<td class="sd"></td></tr>');

			     if(cell[0] == undefined ) cell[0] = "";
			     $("#wado_server_"+self.urls_hindex).children(".sel").html(cell[0]);			
			     if(cell[1] == undefined ) cell[1] = "";
			     $("#wado_server_"+self.urls_hindex).children(".mod").html(cell[1]);			
			     if(cell[2] == undefined ) cell[2] = "";
			     $("#wado_server_"+self.urls_hindex).children(".pid").html(cell[2]);			
			     if(cell[3] == undefined ) cell[3] = "";
			     $("#wado_server_"+self.urls_hindex).children(".pname").html(cell[3]);			
			     if(cell[4] == undefined ) cell[4] = "";
			     $("#wado_server_"+self.urls_hindex).children(".page").html(cell[4]);			
			     if(cell[5] == undefined ) cell[5] = "";
			     $("#wado_server_"+self.urls_hindex).children(".psex").html(cell[5]);			
			     if(cell[6] == undefined ) cell[6] = "";
			     $("#wado_server_"+self.urls_hindex).children(".sdate").html(cell[6]);			
			     if(cell[7] == undefined ) cell[7] = "";
			     $("#wado_server_"+self.urls_hindex).children(".sid").html(cell[7]);			
			     if(cell[8] == undefined ) cell[8] = "";
			     $("#wado_server_"+self.urls_hindex).children(".sd").html(cell[8]);	  

                 $(".tagsList tbody tr").removeClass( "treeDicom_sel" ).css("background-color","white");
			     $("#wado_server_"+self.urls_hindex).addClass( "treeDicom_sel" ).css("background-color","gainsboro");     
			   }
            else 
               {
                 $("#dicom_info tbody").html($("#dicom_info tbody").html() + '<tr id="ct_idx_'+self.handle_index+'">'+
								'<td class="sel"></td>'+
								'<td class="mod"></td>'+
								'<td class="pid"></td>'+
								'<td class="pname"></td>'+
								'<td class="page"></td>'+
								'<td class="psex"></td>'+
								'<td class="sdate"></td>'+
								'<td class="sid"></td>'+
								'<td class="sd"></td></tr>');

			     if(cell[0] == undefined ) cell[0] = "";
			     $("#ct_idx_"+self.handle_index).children(".sel").html(cell[0]);			
			     if(cell[1] == undefined ) cell[1] = "";
			     $("#ct_idx_"+self.handle_index).children(".mod").html(cell[1]);			
			     if(cell[2] == undefined ) cell[2] = "";
			     $("#ct_idx_"+self.handle_index).children(".pid").html(cell[2]);			
			     if(cell[3] == undefined ) cell[3] = "";
			     $("#ct_idx_"+self.handle_index).children(".pname").html(cell[3]);			
			     if(cell[4] == undefined ) cell[4] = "";
			     $("#ct_idx_"+self.handle_index).children(".page").html(cell[4]);			
			     if(cell[5] == undefined ) cell[5] = "";
			     $("#ct_idx_"+self.handle_index).children(".psex").html(cell[5]);			
			     if(cell[6] == undefined ) cell[6] = "";
			     $("#ct_idx_"+self.handle_index).children(".sdate").html(cell[6]);			
			     if(cell[7] == undefined ) cell[7] = "";
			     $("#ct_idx_"+self.handle_index).children(".sid").html(cell[7]);			
			     if(cell[8] == undefined ) cell[8] = "";
			     $("#ct_idx_"+self.handle_index).children(".sd").html(cell[8]);	 
      
                 $(".tagsList tbody tr").removeClass( "treeDicom_sel" ).css("background-color","white");
			     $("#ct_idx_"+self.handle_index).addClass( "treeDicom_sel" ).css("background-color","gainsboro");
                       
            }
			
          
			     		
             
			$(".tagsList tbody tr").hover(
				function () {
					if ($(this).hasClass( "treeDicom_sel" ) === false)
						$(this).css("background-color","lightgoldenrodyellow");
				}, 
				function () {
					if ($(this).hasClass( "treeDicom_sel" ))
						$(this).css("background-color","gainsboro");
					else
						$(this).css("background-color","white");
				}

			);
			 

			$(".tagsList tbody tr").dblclick( function(){
				if (BAMBOO.tool.tools["CinePlay"].timeout >= 0) BAMBOO.tool.tools["CinePlay"].pause();
				self.table_make = false;
				var indexs = $(this).attr("id");
				var local = indexs.substr(7, 3);
                var wado = indexs.substr(12,3)
				var local_index  = parseInt(local);
                var wado_index = parseInt(wado);
                
               if(!isNaN(local_index))
                 {
                   if (self.prev_index != local_index )
                     {
                       self.loadFiles(file_list[local_index]);
                      }               			
                   self.prev_index= local_index;
                                
                 }	
               else if (!isNaN(wado_index))
                 {
                      
                      if (self.prev_index != wado_index)
                         {
                           self.loadURL(urls_list[wado_index]);
                         }               			
                       self.prev_index = wado_index;                       
                 }	                
              
				$(".tagsList tbody tr").removeClass( "treeDicom_sel" ).css("background-color","white");
				$(this).addClass( "treeDicom_sel" ).css("background-color","gainsboro");
				
			});


            var preview_pindex;
		/*	$(".tagsList tbody tr").click( function(){
              
				self.preview = true;
				if (BAMBOO.tool.tools["CinePlay"].timeout >= 0) BAMBOO.tool.tools["CinePlay"].pause();
				self.table_make = false;
				var indexs = $(this).attr("id");
				var local = indexs.substr(7, 3);
                var wado = indexs.substr(12,3)
				var local_index  = parseInt(local);
                var wado_index = parseInt(wado);
                
               if(!isNaN(local_index))
                 {
                      // if (local_index == preview_pindex) return;
                       self.p_loadFiles(file_list[local_index]);
                       preview_pindex = local_index;
                                
                 }	
               else if (!isNaN(wado_index))
                 {
                      
                     // if (wado_index == preview_pindex) return; 
                      self.p_loadURL(urls_list[wado_index]);
					  preview_pindex = wado_index;
                                         
                 }	                
                
				$(".tagsList tbody tr").removeClass( "treeDicom_sel" ).css("background-color","white");
				$(this).addClass( "treeDicom_sel" ).css("background-color","gainsboro");
				
				
			});  */
			
		
		  }
	    
		
		/*
        // tag list table (without the pixel data)
        if(dataInfo.PixelData) {
            dataInfo.PixelData.value = "...";
        }
        // remove possible previous
        while (node.hasChildNodes()) { 
            node.removeChild(node.firstChild);
        }
        // tags HTML table
        var table = BAMBOO.html.toTable(dataInfo);
        table.id = "tagsTable";
        table.className = "tagsList table-stripe";
        table.setAttribute("data-role", "table");
        table.setAttribute("data-mode", "columntoggle");
        // search form
        //node.appendChild(BAMBOO.html.getHtmlSearchForm(table));
        // tags table
        node.appendChild(table);
		*/

    }



	function  preview_draw(data,real_width,real_height)
	  {
	     var preview_view = data.view[0];
	     var image = preview_view.getImage();
	     var dataWidth = image.getSize().getNumberOfColumns();
	     var dataHeight = image.getSize().getNumberOfRows();	
   
	     var canvas = document.getElementById("thum_canvas");
	   if (!canvas)
        {
            alert("Error: cannot find the canvas element for '" + name + "'.");
            return;
        }

	    var context = canvas.getContext('2d');
 	     
	   //var prev_Scale = Math.min( (real_width / dataWidth), (real_height / dataHeight));
	    var prev_Scale = real_width/dataWidth;
         context.setTransform( 1, 0, 0, 1, 0, 0 );  	     
	     context.clearRect (0, 0, canvas.width, canvas.height);

	     var cacheCanvas = document.createElement("canvas");
           cacheCanvas.width = dataWidth;
           cacheCanvas.height = dataHeight;
		   canvas.style.display = '';
		   var cachecontext =cacheCanvas.getContext("2d");
           var imageData = cachecontext.createImageData(dataWidth, dataHeight);
		   preview_view.generateImageData(imageData); 		   
		   cachecontext.putImageData(imageData, 0, 0);		  
		   context.setTransform( prev_Scale, 0, 0, prev_Scale, 0, 0 );
		   context.drawImage( cacheCanvas, 0, 0 );
		   self.preview = false;
	
	 }
    
    /**
     * Post load application initialisation. To be called once the DICOM has been parsed.
     * @method postLoadInit
     * @private
     * @param {Object} data The data to display.
     */
    function postLoadInit(data)
    {
        // only initialise the first time

        self.data = data;
        if( view ) {
            return;
        }

		if (data.dicomdir == true)
		{
			// create the DICOM tags table
			createDirTagsTable(data.info);
		}
		else
		{
			// get the view from the loaded data
			view = data.view[0];
			if (!view)
				view = data.view;

			// create the DICOM tags table
			createTagsTable(data.info);
			// store image
			originalImage = view.getImage();
			image = originalImage;

		   for (var i = 1; i < data.view.length; i++)
			{
				image.appendSlice( data.view[i].getImage() );
				//image.append_numberOfSlice( data.view[i].getImage());      //add 
			} 
			
			// layout
			dataWidth = image.getSize().getNumberOfColumns();
			dataHeight = image.getSize().getNumberOfRows();
			createLayers(dataWidth, dataHeight);
			
			// get the image data from the image layer
			imageData = imageLayer.getContext().createImageData( 
					dataWidth, dataHeight);

			var topLayer = imageLayer.getCanvas();
			if ( drawLayer ) {
				topLayer = document.getElementById("drawDiv");
			}
			// mouse listeners
			topLayer.addEventListener("mousedown", eventHandler, false);
			topLayer.addEventListener("mousemove", eventHandler, false);
			topLayer.addEventListener("mouseup", eventHandler, false);
			topLayer.addEventListener("mouseout", eventHandler, false);
			topLayer.addEventListener("mousewheel", eventHandler, false);
			topLayer.addEventListener("DOMMouseScroll", eventHandler, false);
			topLayer.addEventListener("dblclick", eventHandler, false);
			// touch listeners
			topLayer.addEventListener("touchstart", eventHandler, false);
			topLayer.addEventListener("touchmove", eventHandler, false);
			topLayer.addEventListener("touchend", eventHandler, false);
			// keydown listener
			window.addEventListener("keydown", eventHandler, true);
			// image listeners
			view.addEventListener("wlchange", self.generateAndDrawImage);
			view.addEventListener("colorchange", self.generateAndDrawImage);
			view.addEventListener("slicechange", self.generateAndDrawImage);
			
			// info layer
			if(document.getElementById("infoLayer")){
				BAMBOO.info.createWindowingDiv();
				BAMBOO.info.createPositionDiv();
				BAMBOO.info.createMiniColorMap();
				BAMBOO.info.createPlot();
				addImageInfoListeners();
			} 		
			// initialise the toolbox
			toolBox.init();
			toolBox.display(true);
			
			// init W/L display
			self.initWLDisplay();        
		}
    }
 
    
};
