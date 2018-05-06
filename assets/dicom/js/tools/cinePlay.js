/** 
 * Tool module.
 * @module tool
 */
var BAMBOO = BAMBOO || {};
/**
 * Namespace for tool functions.
 * @class tool
 * @namespace BAMBOO
 * @static
 */
BAMBOO.tool = BAMBOO.tool || {};

/**
 * ZoomAndPan class.
 * @class CinePlay
 * @namespace BAMBOO.tool
 * @constructor
 * @param {Object} app The associated application.
 */
BAMBOO.tool.CinePlay = function(app)
{
    /**
     * Closure to self: to be used by event handlers.
     * @property self
     * @private
     * @type WindowLevel
     */
    var self = this;
    /**
     * current cine index.
     * @property ser current index
     * @type Int
     */
    this.curIndex = 0;
	/**
     * state flag.
     * @property set State
     * @type Int
     */
    this.playstate = 0;
	
	this.timeout = -1;
	var frame_index = 0;
		
	
	/**
     * Enable the tool.
     * @method enable
     * @param {Boolean} bool The flag to enable or not.
     */
    this.display = function(bool){

		this.frametime_vector =BAMBOO.tool.tools["CinePlay"].frametime_vector;
		if (this.frametime_vector != undefined && this.frametime_vector != null)
		{
			 if (this.frametime_vector.length>1)
			   this.frametime_fix = false;
		     else this.frametime_fix = true;
		}
		
	 
		
		if (bool){
         
			switch(this.playstate)
			{
				case 0: // play
				   			 		  
					 BAMBOO.tool.tools["CinePlay"].play();
					 
			  			
					break;
				case 1: // pause
					this.pause();
					break;
				case 2: // PrevImage
				    	this.prevImage();
					break;
				case 3: // NextImage
					this.nextImage();
					break;
				case 4: // PrevSeries
					this.prevSeries();
					break;
				case 5: // NextSeries
					this.nextSeries();
					break;
				default:
					break;
			}
		}
		else{
			if (this.timeout >= 0) clearTimeout(this.timeout);
		}
    };

	this.play = function(){
		if (this.frametime_vector != undefined && this.frametime_vector != null)
		{
			app.getView().incrementSliceNb();
		    if (this.frametime_fix)
		     {
			   this.timeout = setTimeout(function() {
			   BAMBOO.tool.tools["CinePlay"].play();},  this.frametime_vector[0]);
		     }
		   else{	  
			       this.timeout = setTimeout(function() {
				   BAMBOO.tool.tools["CinePlay"].play();},  this.frametime_vector[frame_index]);
				   frame_index++;
				   if(frame_index >= this.frametime_vector.length)
				   frame_index = 0;
			  }
		}
		
		
	};

	this.pause = function(){
		if (this.timeout >= 0) clearTimeout(this.timeout);
	};

	this.prevImage = function(){
		if (this.timeout >= 0) clearTimeout(this.timeout);
		app.getView().decrementSliceNb();
	};

	this.nextImage = function(){
		if (this.timeout >= 0) clearTimeout(this.timeout);
		app.getView().incrementSliceNb();
	};

	this.prevSeries = function(){		
		if (this.timeout >= 0) clearTimeout(this.timeout);
		app.getView().goFirstSlice();
	};

	this.nextSeries = function(){
		if (this.timeout >= 0) clearTimeout(this.timeout);
		app.getView().goLastSlice();
	};

    this.updateState = function(){
		//app.getView().updateBuffer();
		if (this.playstate === 0)
		{
			//var view = app.dicomParser.createImage(this.curIndex);
			//this.curIndex++;

			//app.postLoadCine({"view": view, "info": dicomParser.dicomElements});
		}
    };

}; // CinePlay class

/**
 * Help for this tool.
 * @method getHelp
 * @returns {Object} The help content.
 */
BAMBOO.tool.CinePlay.prototype.getHelp = function()
{
    return {
        'title': "CinePlay",
        'brief': "The CinePlay tool allows to play the multi frame image.",        
    };
};

/**
 * Initialise the tool.
 * @method init
 */
BAMBOO.tool.CinePlay.prototype.init = function() {
    // nothing to do.
};