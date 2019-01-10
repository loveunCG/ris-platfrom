/** 
 * Tool module.
 * @module tool
 */
var BAMBOO = BAMBOO || {};
BAMBOO.tool = BAMBOO.tool || {};

/**
 * Filter tool.
 * @class Filter
 * @namespace BAMBOO.tool
 * @constructor
 * @param {Object} app The associated application.
 */
BAMBOO.tool.Filter = function(/*app*/)
{
    /**
     * Selected filter.
     * @property selectedFilter
     * @type Object
     */
    this.selectedFilter = 0;
    /**
     * Default filter name.
     * @property defaultFilterName
     * @type String
     */
    this.defaultFilterName = 0;
    /**
     * Display Flag.
     * @property displayed
     * @type Boolean
     */
    this.displayed = false;
};

/**
 * Help for this tool.
 * @method getHelp
 * @returns {Object} The help content.
 */
BAMBOO.tool.Filter.prototype.getHelp = function()
{
    return {
        'title': "Filter",
        'brief': "A few simple image filters are available: a Threshold filter to " +
            "limit the image intensities between a chosen minimum and maximum, " +
            "a Sharpen filter to convolute the image with a sharpen matrix, " +
            "a Sobel filter to get the gradient of the image in both directions."
    };
};

/**
 * Enable the filter.
 * @method enable
 * @param {Boolean} bool Flag to enable or not.
 */
BAMBOO.tool.Filter.prototype.display = function(bool)
{
    BAMBOO.gui.displayFilterHtml(bool);
    this.displayed = bool;
    // display the selected filter
    this.selectedFilter.display(bool);
};

/**
 * Get the selected filter.
 * @method getSelectedFilter
 * @return {Object} The selected filter.
 */
BAMBOO.tool.Filter.prototype.getSelectedFilter = function() {
    return this.selectedFilter;
};

/**
 * Set the selected filter.
 * @method setSelectedFilter
 * @return {String} The name of the filter to select.
 */
BAMBOO.tool.Filter.prototype.setSelectedFilter = function(name) {
    // check if we have it
    if( !this.hasFilter(name) )
    {
        throw new Error("Unknown filter: '" + name + "'");
    }
    // hide last selected
    if( this.displayed )
    {
        this.selectedFilter.display(false);
    }
    // enable new one
    this.selectedFilter = BAMBOO.tool.filters[name];
    // display the selected filter
    if( this.displayed )
    {
        this.selectedFilter.display(true);
    }
};

/**
 * Check if a filter is in the filter list.
 * @method hasFilter
 * @param {String} name The name to check.
 * @return {String} The filter list element for the given name.
 */
BAMBOO.tool.Filter.prototype.hasFilter = function(name) {
    return BAMBOO.tool.filters[name];
};

/**
 * Initialise the filter.
 * @method init
 */
BAMBOO.tool.Filter.prototype.init = function()
{
    // set the default to the first in the list
    for( var key in BAMBOO.tool.filters ){
        this.defaultFilterName = key;
        break;
    }
    this.setSelectedFilter(this.defaultFilterName);
    // init all filters
    for( key in BAMBOO.tool.filters ) {
        BAMBOO.tool.filters[key].init();
    }    
    // init html
    //BAMBOO.gui.initFilterHtml();
};

/**
 * Handle keydown event.
 * @method keydown
 * @param {Object} event The keydown event.
 */
BAMBOO.tool.Filter.prototype.keydown = function(event){
    app.handleKeyDown(event);
};

// Filter namespace
BAMBOO.tool.filter = BAMBOO.tool.filter || {};

/**
 * Threshold filter tool.
 * @class Threshold
 * @namespace BAMBOO.tool.filter
 * @constructor
 * @param {Object} app The associated application.
 */
BAMBOO.tool.filter.Threshold = function(/*app*/) {};

/**
 * Enable the filter.
 * @method enable
 * @param {Boolean} bool Flag to enable or not.
 */
BAMBOO.tool.filter.Threshold.prototype.display = function(bool)
{
    BAMBOO.gui.filter.displayThresholdHtml(bool);
};

BAMBOO.tool.filter.Threshold.prototype.init = function()
{
    // init html
    BAMBOO.gui.filter.initThresholdHtml();
};

/**
 * Run the filter.
 * @method run
 * @param {Mixed} args The filter arguments.
 */
BAMBOO.tool.filter.Threshold.prototype.run = function(args)
{
    var filter = new BAMBOO.image.filter.Threshold();
    filter.setMin(args.min);
    filter.setMax(args.max);
    var command = new BAMBOO.tool.RunFilterCommand(filter, app);
    command.execute();
    // save command in undo stack
    app.getUndoStack().add(command);
};

/**
 * Sharpen filter tool.
 * @class Sharpen
 * @namespace BAMBOO.tool.filter
 * @constructor
 * @param {Object} app The associated application.
 */
BAMBOO.tool.filter.Sharpen = function(/*app*/) {};

/**
 * Enable the filter.
 * @method enable
 * @param {Boolean} bool Flag to enable or not.
 */
BAMBOO.tool.filter.Sharpen.prototype.display = function(bool)
{
    BAMBOO.gui.filter.displaySharpenHtml(bool);
};

BAMBOO.tool.filter.Sharpen.prototype.init = function()
{
    // nothing to do...
};

/**
 * Run the filter.
 * @method run
 * @param {Mixed} args The filter arguments.
 */
BAMBOO.tool.filter.Sharpen.prototype.run = function(/*args*/)
{
    var filter = new BAMBOO.image.filter.Sharpen();
    var command = new BAMBOO.tool.RunFilterCommand(filter, app);
    command.execute();
    // save command in undo stack
    app.getUndoStack().add(command);
};

/**
 * Sobel filter tool.
 * @class Sharpen
 * @namespace BAMBOO.tool.filter
 * @constructor
 * @param {Object} app The associated application.
 */
BAMBOO.tool.filter.Sobel = function(/*app*/) {};

/**
 * Enable the filter.
 * @method enable
 * @param {Boolean} bool Flag to enable or not.
 */
BAMBOO.tool.filter.Sobel.prototype.display = function(bool)
{
    BAMBOO.gui.filter.displaySobelHtml(bool);
};

BAMBOO.tool.filter.Sobel.prototype.init = function()
{
    // nothing to do...
};

/**
 * Run the filter.
 * @method run
 * @param {Mixed} args The filter arguments.
 */
BAMBOO.tool.filter.Sobel.prototype.run = function(/*args*/)
{
    var filter = new BAMBOO.image.filter.Sobel();
    var command = new BAMBOO.tool.RunFilterCommand(filter, app);
    command.execute();
    // save command in undo stack
    app.getUndoStack().add(command);
};

/**
 * Run filter command.
 * @class RunFilterCommand
 * @namespace BAMBOO.tool
 * @constructor
 * @param {Object} filter The filter to run.
 * @param {Object} app The associated application.
 */
BAMBOO.tool.RunFilterCommand = function (filter, app)
{
    /**
     * Get the command name.
     * @method getName
     * @return {String} The command name.
     */
    this.getName = function () { return "Filter-" + filter.getName(); };

    /**
     * Execute the command.
     * @method execute
     */
    this.execute = function ()
    {
        app.setImage(filter.update());
        app.generateAndDrawImage();
    }; 
    /**
     * Undo the command.
     * @method undo
     */
    this.undo = function () {
        app.setImage(filter.getOriginalImage());
        app.generateAndDrawImage();
    };
}; // RunFilterCommand class
