/** 
 * GUI module.
 * @module gui
 */
var BAMBOO = BAMBOO || {};
/**
 * Namespace for GUI functions.
 * @class gui
 * @namespace BAMBOO
 * @static
 */
BAMBOO.gui = BAMBOO.gui || {};

/**
 * Handle window/level change.
 * @method onChangeWindowLevelPreset
 * @namespace BAMBOO.gui
 * @static
 * @param {Object} event The change event.
 */
BAMBOO.gui.onChangeWindowLevelPreset = function(/*event*/)
{
    BAMBOO.tool.updateWindowingDataFromName(this.value);
};

/**
 * Handle colour map change.
 * @method onChangeColourMap
 * @static
 * @param {Object} event The change event.
 */
BAMBOO.gui.onChangeColourMap = function(/*event*/)
{
    BAMBOO.tool.updateColourMapFromName(this.value);
};

/**
 * Handle loader change.
 * @method onChangeLoader
 * @static
 * @param {Object} event The change event.
 */
BAMBOO.gui.onChangeLoader = function(/*event*/)
{
    if( this.value === "file") {
        BAMBOO.gui.displayUrlLoadHtml(false);
        BAMBOO.gui.displayFileLoadHtml(true);
    }
    else if( this.value === "url") {
        BAMBOO.gui.displayFileLoadHtml(false);
        BAMBOO.gui.displayUrlLoadHtml(true);
    }
};

/**
 * Handle files change.
 * @method onChangeFiles
 * @static
 * @param {Object} event The change event.
 */
BAMBOO.gui.onChangeFiles = function(event)
{
    app.onChangeFiles(event);
};

/**
 * Handle URL change.
 * @method onChangeURL
 * @static
 * @param {Object} event The change event.
 */
BAMBOO.gui.onChangeURL = function(event)
{
    app.onChangeURL(event);
};

/**
 * Handle tool change.
 * @method onChangeTool
 * @static
 * @param {Object} event The change event.
 */
BAMBOO.gui.onChangeTool = function(/*event*/)
{
    app.getToolBox().setSelectedTool(this.value);
};

/**
 * Handle filter change.
 * @method onChangeFilter
 * @static
 * @param {Object} event The change event.
 */
BAMBOO.gui.onChangeFilter = function(/*event*/)
{
    app.getToolBox().getSelectedTool().setSelectedFilter(this.value);
};

/**
 * Handle filter run.
 * @method onRunFilter
 * @static
 * @param {Object} event The run event.
 */
BAMBOO.gui.onRunFilter = function(/*event*/)
{
    app.getToolBox().getSelectedTool().getSelectedFilter().run();
};

/**
 * Handle min/max slider change.
 * @method onChangeMinMax
 * @static
 * @param {Object} range The new range of the data.
 */
BAMBOO.gui.onChangeMinMax = function(range)
{
    // seems like jquery is checking if the method exists before it 
    // is used...
    if( app.getToolBox().getSelectedTool().getSelectedFilter ) {
        app.getToolBox().getSelectedTool().getSelectedFilter().run(range);
    }
};

/**
 * Handle shape change.
 * @method onChangeShape
 * @static
 * @param {Object} event The change event.
 */
BAMBOO.gui.onChangeShape = function(/*event*/)
{
    app.getToolBox().getSelectedTool().setShapeName(this.value);
};

/**
 * Handle line color change.
 * @method onChangeLineColour
 * @static
 * @param {Object} event The change event.
 */
BAMBOO.gui.onChangeLineColour = function(/*event*/)
{
    app.getToolBox().getSelectedTool().setLineColour(this.value);
};

/**
 * Handle zoom reset.
 * @method onZoomReset
 * @static
 * @param {Object} event The change event.
 */
BAMBOO.gui.onZoomReset = function(/*event*/)
{
    app.resetLayout();
};

/**
 * Handle display reset.
 * @method onDisplayReset
 * @static
 * @param {Object} event The change event.
 */
BAMBOO.gui.onDisplayReset = function(event)
{
    BAMBOO.gui.onZoomReset(event);
    app.initWLDisplay();
    // update preset select
    var select = document.getElementById("presetSelect");
    select.selectedIndex = 0;
    BAMBOO.gui.refreshSelect("#presetSelect");
};

/**
 * Handle undo.
 * @method onUndo
 * @static
 * @param {Object} event The associated event.
 */
BAMBOO.gui.onUndo = function(/*event*/)
{
    app.getUndoStack().undo();
};

/**
 * Handle redo.
 * @method onRedo
 * @static
 * @param {Object} event The associated event.
 */
BAMBOO.gui.onRedo = function(/*event*/)
{
    app.getUndoStack().redo();
};

/**
 * Handle toggle of info layer.
 * @method onToggleInfoLayer
 * @static
 * @param {Object} event The associated event.
 */
BAMBOO.gui.onToggleInfoLayer = function(/*event*/)
{
    app.toggleInfoLayerDisplay();
};
