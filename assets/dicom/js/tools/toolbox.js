/** 
 * Tool module.
 * @module tool
 */
var BAMBOO = BAMBOO || {};
BAMBOO.tool = BAMBOO.tool || {};

/**
 * Tool box.
 * Relies on the static variable BAMBOO.tool.tools. The available tools 
 * of the gui will be those of this list.
 * @class ToolBox
 * @namespace BAMBOO.tool
 * @constructor
 * @param {Object} app The associated application.
 */
BAMBOO.tool.ToolBox = function(/*app*/)
{
    /**
     * Selected tool.
     * @property selectedTool
     * @type Object
     */
    this.selectedTool = 0;
    /**
     * Default tool name.
     * @property defaultToolName
     * @type String
     */
    this.defaultToolName = 0;
};

/**
 * Enable the toolbox.
 * @method enable
 * @param {Boolean} bool Flag to enable or not.
 */
BAMBOO.tool.ToolBox.prototype.display = function(bool)
{
    BAMBOO.gui.displayToolboxHtml(bool);
};

/**
 * Get the selected tool.
 * @method getSelectedTool
 * @return {Object} The selected tool.
 */
BAMBOO.tool.ToolBox.prototype.getSelectedTool = function() {
    return this.selectedTool;
};

/**
 * Set the selected tool.
 * @method setSelectedTool
 * @return {String} The name of the tool to select.
 */
BAMBOO.tool.ToolBox.prototype.setSelectedTool = function(name) {
    // check if we have it
    if( !this.hasTool(name) )
    {
        throw new Error("Unknown tool: '" + name + "'");
    }
    // hide last selected
    if( this.selectedTool )
    {
        this.selectedTool.display(false);
    }
    // enable new one
    this.selectedTool = BAMBOO.tool.tools[name];
    // display it
    this.selectedTool.display(true);
};

/**
 * Check if a tool is in the tool list.
 * @method hasTool
 * @param {String} name The name to check.
 * @return {String} The tool list element for the given name.
 */
BAMBOO.tool.ToolBox.prototype.hasTool = function(name) {
    return BAMBOO.tool.tools[name];
};

/**
 * Initialise the tool box.
 * @method init
 */
BAMBOO.tool.ToolBox.prototype.init = function()
{
    // set the default to the first in the list
    for( var key in BAMBOO.tool.tools ){
        this.defaultToolName = key;
        break;
    }
    this.setSelectedTool(this.defaultToolName);
	
    // init all tools
    for( key in BAMBOO.tool.tools ) {
        BAMBOO.tool.tools[key].init();
    }    
    // init html
    //BAMBOO.gui.initToolboxHtml();
};
