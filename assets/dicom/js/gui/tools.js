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
BAMBOO.gui.base = BAMBOO.gui.base || {};

/**
 * Append the toolbox HTML to the page.
 * @method appendToolboxHtml
 * @static
 */
 /* 원본함수
BAMBOO.gui.base.appendToolboxHtml = function()
{
    // tool select
    var toolSelector = BAMBOO.html.createHtmlSelect("toolSelect",BAMBOO.tool.tools);
    toolSelector.onchange = BAMBOO.gui.onChangeTool;
    
    // tool list element
    var toolLi = document.createElement("li");
    toolLi.id = "toolLi";
    toolLi.style.display = "none";
    toolLi.appendChild(toolSelector);
    toolLi.setAttribute("class","ui-block-a");

    // node
    var node = document.getElementById("toolList");
    // clear it
    while(node.hasChildNodes()) {
        node.removeChild(node.firstChild);
    }
    // append
    node.appendChild(toolLi);
    // trigger create event (mobile)
    $("#toolList").trigger("create");
};*/

//////////////////cgc가 만든 함수//////////////////////////////////////////////
BAMBOO.gui.base.appendToolboxHtml = function()
{  
	return;
	var toolSelector = BAMBOO.html.createHtmlSelect("toolSelect",BAMBOO.tool.tools);
    toolSelector.onchange = BAMBOO.gui.onChangeTool;
	toolSelector.style.display = 'none';
	// tool list element
    var toolLi = document.createElement("li");
    toolLi.id = "toolLi";
    toolLi.style.display = "none";
    toolLi.setAttribute("class","ui-block-a");
	toolLi.appendChild(toolSelector);
	
    // buttons
    var list = BAMBOO.tool.tools;
    if( list instanceof Array )
    {
        for ( var i in list )
        {
            var tmpBtn= document.createElement("button");
			tmpBtn.value = list[i];
			tmpBtn.appendChild(document.createTextNode(BAMBOO.utils.capitaliseFirstLetter(list[i])));
			tmpBtn.onclick = function() {app.getToolBox().setSelectedTool(this.value);};
            toolLi.appendChild(tmpBtn);
        }
    }
    else if( typeof list === 'object')
    {
        for ( var item in list )
        {
            var tmpBtn= document.createElement("button");
			tmpBtn.value = item;
			tmpBtn.appendChild(document.createTextNode(BAMBOO.utils.capitaliseFirstLetter(item)));
			tmpBtn.onclick = function() {app.getToolBox().setSelectedTool(this.value);};
            toolLi.appendChild(tmpBtn);
        }
    }
    else
    {
        throw new Error("Unsupported input list type.");
    }
    
    

    // node
    var node = document.getElementById("toolList");
    // clear it
    while(node.hasChildNodes()) {
        node.removeChild(node.firstChild);
    }
    // append
    node.appendChild(toolLi);	
    // trigger create event (mobile)
    $("#toolList").trigger("create");
};
//////////////////////////////////////////////////////////////
/**
 * Display the toolbox HTML.
 * @method displayToolboxHtml
 * @static
 * @param {Boolean} bool True to display, false to hide.
 */
BAMBOO.gui.base.displayToolboxHtml = function(bool)
{
	return;
    // tool list element
    BAMBOO.html.displayElement("toolLi", bool);
};

/**
 * Initialise the toolbox HTML.
 * @method initToolboxHtml
 * @static
 */
BAMBOO.gui.base.initToolboxHtml = function()
{
	return;
    // tool select: reset selected option
    var toolSelector = document.getElementById("toolSelect");
    toolSelector.selectedIndex = 0;
    BAMBOO.gui.refreshSelect("#toolSelect");
};

/**
 * Append the window/level HTML to the page.
 * @method appendWindowLevelHtml
 * @static
 */
 /*원본함수
BAMBOO.gui.base.appendWindowLevelHtml = function()
{
    // preset select
    var wlSelector = BAMBOO.html.createHtmlSelect("presetSelect",BAMBOO.tool.presets);
    wlSelector.onchange = BAMBOO.gui.onChangeWindowLevelPreset;
    // colour map select
    var cmSelector = BAMBOO.html.createHtmlSelect("colourMapSelect",BAMBOO.tool.colourMaps);
    cmSelector.onchange = BAMBOO.gui.onChangeColourMap;

    // preset list element
    var wlLi = document.createElement("li");
    wlLi.id = "wlLi";
    wlLi.style.display = "none";
    wlLi.appendChild(wlSelector);
    wlLi.setAttribute("class","ui-block-b");
    // color map list element
    var cmLi = document.createElement("li");
    cmLi.id = "cmLi";
    cmLi.style.display = "none";
    cmLi.appendChild(cmSelector);
    cmLi.setAttribute("class","ui-block-c");

    // node
    var node = document.getElementById("toolList");
    // apend preset
    node.appendChild(wlLi);
    // apend color map if monochrome image
    node.appendChild(cmLi);
    // trigger create event (mobile)
    $("#toolList").trigger("create");
};
*/
////////////////////////////cgc가 만든 함수//////////////////////////////////////////////

BAMBOO.gui.base.appendWindowLevelHtml = function()
{
	return;
	 var wlSelector = BAMBOO.html.createHtmlSelect("presetSelect",BAMBOO.tool.presets);
    wlSelector.onchange = BAMBOO.gui.onChangeWindowLevelPreset;
	wlSelector.style.display = 'none';
    // colour map select
    var cmSelector = BAMBOO.html.createHtmlSelect("colourMapSelect",BAMBOO.tool.colourMaps);
    cmSelector.onchange = BAMBOO.gui.onChangeColourMap;
	cmSelector.style.display = 'none';
	// preset list element
    var wlLi = document.createElement("li");
    wlLi.id = "wlLi";
    wlLi.style.display = "none";
    wlLi.setAttribute("class","ui-block-b");   
	wlLi.appendChild(wlSelector);

	var list = BAMBOO.tool.presets;
    if( list instanceof Array )
    {
        for ( var i in list )
        {
            var tmpBtn= document.createElement("button");
			tmpBtn.value = list[i];
			tmpBtn.appendChild(document.createTextNode(BAMBOO.utils.capitaliseFirstLetter(list[i])));
			tmpBtn.onclick = function() {BAMBOO.tool.updateWindowingDataFromName(this.value);};
            wlLi.appendChild(tmpBtn);
        }
    }
    else if( typeof list === 'object')
    {
        for ( var item in list )
        {
            var tmpBtn= document.createElement("button");
			tmpBtn.value = item;
			tmpBtn.appendChild(document.createTextNode(BAMBOO.utils.capitaliseFirstLetter(item)));
			tmpBtn.onclick = function() {BAMBOO.tool.updateWindowingDataFromName(this.value);};
            wlLi.appendChild(tmpBtn);
        }
    }
    else
    {
        throw new Error("Unsupported input list type.");
    }

	 // color map list element
    var cmLi = document.createElement("li");
    cmLi.id = "cmLi";
    cmLi.style.display = "none";
    cmLi.setAttribute("class","ui-block-c");
	cmLi.appendChild(cmSelector);
	
	var list = BAMBOO.tool.colourMaps;
    if( list instanceof Array )
    {
        for ( var i in list )
        {
            var tmpBtn= document.createElement("button");
			tmpBtn.value = list[i];
			tmpBtn.appendChild(document.createTextNode(BAMBOO.utils.capitaliseFirstLetter(list[i])));
			tmpBtn.onclick = function() {BAMBOO.tool.updateColourMapFromName(this.value);};
            cmLi.appendChild(tmpBtn);
        }
    }
    else if( typeof list === 'object')
    {
        for ( var item in list )
        {
            var tmpBtn= document.createElement("button");
			tmpBtn.value = item;
			tmpBtn.appendChild(document.createTextNode(BAMBOO.utils.capitaliseFirstLetter(item)));
			tmpBtn.onclick = function() {BAMBOO.tool.updateColourMapFromName(this.value);};
            cmLi.appendChild(tmpBtn);
        }
    }
    else
    {
        throw new Error("Unsupported input list type.");
    }
   
    // node
    var node = document.getElementById("toolList");
    // apend preset
    node.appendChild(wlLi);
    // apend color map if monochrome image
    node.appendChild(cmLi);
    // trigger create event (mobile)
    $("#toolList").trigger("create");
};
///////////////////////////////////////////////////////////////////////
/**
 * Display the window/level HTML.
 * @method displayWindowLevelHtml
 * @static
 * @param {Boolean} bool True to display, false to hide.
 */
BAMBOO.gui.base.displayWindowLevelHtml = function(bool)
{
	return;
    // presets list element
    BAMBOO.html.displayElement("wlLi", bool);
    // color map list element
    BAMBOO.html.displayElement("cmLi", bool);
};

/**
 * Initialise the window/level HTML.
 * @method initWindowLevelHtml
 * @static
 */
BAMBOO.gui.base.initWindowLevelHtml = function()
{
	return;
    // create new preset select
    var wlSelector = BAMBOO.html.createHtmlSelect("presetSelect",BAMBOO.tool.presets);
    wlSelector.onchange = BAMBOO.gui.onChangeWindowLevelPreset;
    wlSelector.title = "Select w/l preset.";
	wlSelector.style.display = 'none';
    
    // copy html list
    var wlLi = document.getElementById("wlLi");
    // clear node
    BAMBOO.html.cleanNode(wlLi);
    // add children
    wlLi.appendChild(wlSelector);
	var list = BAMBOO.tool.presets;
    if( list instanceof Array )
    {
        for ( var i in list )
        {
            var tmpBtn= document.createElement("button");
			tmpBtn.value = list[i];
			tmpBtn.appendChild(document.createTextNode(BAMBOO.utils.capitaliseFirstLetter(list[i])));
			tmpBtn.onclick = function() {BAMBOO.tool.updateWindowingDataFromName(this.value);};
            wlLi.appendChild(tmpBtn);
        }
    }
    else if( typeof list === 'object')
    {
        for ( var item in list )
        {
            var tmpBtn= document.createElement("button");
			tmpBtn.value = item;
			tmpBtn.appendChild(document.createTextNode(BAMBOO.utils.capitaliseFirstLetter(item)));
			tmpBtn.onclick = function() {BAMBOO.tool.updateWindowingDataFromName(this.value);};
            wlLi.appendChild(tmpBtn);
        }
    }
    else
    {
        throw new Error("Unsupported input list type.");
    }
    $("#toolList").trigger("create");
    
    // colour map select
    var cmSelector = document.getElementById("colourMapSelect");
    cmSelector.selectedIndex = 0;
    // special monochrome1 case
    if( app.getImage().getPhotometricInterpretation() === "MONOCHROME1" )
    {
        cmSelector.selectedIndex = 1;
    }
    BAMBOO.gui.refreshSelect("#colourMapSelect");
};

/**
 * Append the draw HTML to the page.
 * @method appendDrawHtml
 * @static
 */
BAMBOO.gui.base.appendDrawHtml = function()
{
	return;
    // shape select
    var shapeSelector = BAMBOO.html.createHtmlSelect("shapeSelect",BAMBOO.tool.shapes);
    shapeSelector.onchange = BAMBOO.gui.onChangeShape;
	shapeSelector.style.display = 'none';
    // colour select
    var colourSelector = BAMBOO.html.createHtmlSelect("colourSelect",BAMBOO.tool.colors);
    colourSelector.onchange = BAMBOO.gui.onChangeLineColour;
	colourSelector.style.display = 'none';

    // shape list element
    var shapeLi = document.createElement("li");
    shapeLi.id = "shapeLi";
    shapeLi.style.display = "none";
    shapeLi.appendChild(shapeSelector);
    shapeLi.setAttribute("class","ui-block-c");
	var list = BAMBOO.tool.shapes;
    if( list instanceof Array )
    {
        for ( var i in list )
        {
            var tmpBtn= document.createElement("button");
			tmpBtn.value = list[i];
			tmpBtn.appendChild(document.createTextNode(BAMBOO.utils.capitaliseFirstLetter(list[i])));
			tmpBtn.onclick = function() {app.getToolBox().getSelectedTool().setShapeName(this.value);};
            shapeLi.appendChild(tmpBtn);
        }
    }
    else if( typeof list === 'object')
    {
        for ( var item in list )
        {
            var tmpBtn= document.createElement("button");
			tmpBtn.value = item;
			tmpBtn.appendChild(document.createTextNode(BAMBOO.utils.capitaliseFirstLetter(item)));
			tmpBtn.onclick = function() {app.getToolBox().getSelectedTool().setShapeName(this.value);};
            shapeLi.appendChild(tmpBtn);
        }
    }
    else
    {
        throw new Error("Unsupported input list type.");
    }
    // colour list element
    var colourLi = document.createElement("li");
    colourLi.id = "colourLi";
    colourLi.style.display = "none";
    colourLi.appendChild(colourSelector);
    colourLi.setAttribute("class","ui-block-b");
    
	var list = BAMBOO.tool.colors;
    if( list instanceof Array )
    {
        for ( var i in list )
        {
            var tmpBtn= document.createElement("button");
			tmpBtn.value = list[i];
			tmpBtn.appendChild(document.createTextNode(BAMBOO.utils.capitaliseFirstLetter(list[i])));
			tmpBtn.onclick = function() {app.getToolBox().getSelectedTool().setLineColour(this.value);};
            colourLi.appendChild(tmpBtn);
        }
    }
    else if( typeof list === 'object')
    {
        for ( var item in list )
        {
            var tmpBtn= document.createElement("button");
			tmpBtn.value = item;
			tmpBtn.appendChild(document.createTextNode(BAMBOO.utils.capitaliseFirstLetter(item)));
			tmpBtn.onclick = function() {app.getToolBox().getSelectedTool().setLineColour(this.value);};
            colourLi.appendChild(tmpBtn);
        }
    }
    else
    {
        throw new Error("Unsupported input list type.");
    }
    // node
    var node = document.getElementById("toolList");
    // apend shape
    node.appendChild(shapeLi);
    // append color
    node.appendChild(colourLi);
    // trigger create event (mobile)
    $("#toolList").trigger("create");
};

/**
 * Display the draw HTML.
 * @method displayDrawHtml
 * @static
 * @param {Boolean} bool True to display, false to hide.
 */
BAMBOO.gui.base.displayDrawHtml = function(bool)
{
	return;
    // color list element
    BAMBOO.html.displayElement("colourLi", bool);
    // shape list element
    BAMBOO.html.displayElement("shapeLi", bool);
};

/**
 * Initialise the draw HTML.
 * @method displayDrawHtml
 * @static
 * */
BAMBOO.gui.base.initDrawHtml = function()
{
	return;
    // shape select: reset selected option
    var shapeSelector = document.getElementById("shapeSelect");
    shapeSelector.selectedIndex = 0;
    BAMBOO.gui.refreshSelect("#shapeSelect");
    // color select: reset selected option
    var colourSelector = document.getElementById("colourSelect");
    colourSelector.selectedIndex = 0;
    BAMBOO.gui.refreshSelect("#colourSelect");
};

/**
 * Append the color chooser HTML to the page.
 * @method appendLivewireHtml
 * @static
 */
BAMBOO.gui.base.appendLivewireHtml = function()
{
	return;
    // colour select
    var colourSelector = BAMBOO.html.createHtmlSelect("lwColourSelect",BAMBOO.tool.colors);
    colourSelector.onchange = BAMBOO.gui.onChangeLineColour;
	colourSelector.style.display = 'none';
    
    // colour list element
    var colourLi = document.createElement("li");
    colourLi.id = "lwColourLi";
    colourLi.style.display = "none";
    colourLi.setAttribute("class","ui-block-b");
    colourLi.appendChild(colourSelector);
    
	var list = BAMBOO.tool.colors;
    if( list instanceof Array )
    {
        for ( var i in list )
        {
            var tmpBtn= document.createElement("button");
			tmpBtn.value = list[i];
			tmpBtn.appendChild(document.createTextNode(BAMBOO.utils.capitaliseFirstLetter(list[i])));
			tmpBtn.onclick = function() {app.getToolBox().getSelectedTool().setLineColour(this.value);};
            colourLi.appendChild(tmpBtn);
        }
    }
    else if( typeof list === 'object')
    {
        for ( var item in list )
        {
            var tmpBtn= document.createElement("button");
			tmpBtn.value = item;
			tmpBtn.appendChild(document.createTextNode(BAMBOO.utils.capitaliseFirstLetter(item)));
			tmpBtn.onclick = function() {app.getToolBox().getSelectedTool().setLineColour(this.value);};
            colourLi.appendChild(tmpBtn);
        }
    }
    else
    {
        throw new Error("Unsupported input list type.");
    }
    // node
    var node = document.getElementById("toolList");
    // apend colour
    node.appendChild(colourLi);
    // trigger create event (mobile)
    $("#toolList").trigger("create");
};

/**
 * Display the livewire HTML.
 * @method displayLivewireHtml
 * @static
 * @param {Boolean} bool True to display, false to hide.
 */
BAMBOO.gui.base.displayLivewireHtml = function(bool)
{
	return;
    // colour list
    BAMBOO.html.displayElement("lwColourLi", bool);
};

/**
 * Initialise the livewire HTML.
 * @method initLivewireHtml
 * @static
 */
BAMBOO.gui.base.initLivewireHtml = function()
{
	return;
    var colourSelector = document.getElementById("lwColourSelect");
    colourSelector.selectedIndex = 0;
    BAMBOO.gui.refreshSelect("#lwColourSelect");
};

/**
 * Append the ZoomAndPan HTML to the page.
 * @method appendZoomAndPanHtml
 * @static
 */
BAMBOO.gui.base.appendZoomAndPanHtml = function()
{
	return;
    // reset button
    var button = document.createElement("button");
    button.id = "zoomResetButton";
    button.name = "zoomResetButton";
    button.onclick = BAMBOO.gui.onZoomReset;
    var text = document.createTextNode("Reset");
    button.appendChild(text);
    
    // list element
    var liElement = document.createElement("li");
    liElement.id = "zoomLi";
    liElement.style.display = "none";
    liElement.setAttribute("class","ui-block-c");
    liElement.appendChild(button);
    
    // node
    var node = document.getElementById("toolList");
    // append element
    node.appendChild(liElement);
    // trigger create event (mobile)
    $("#toolList").trigger("create");
};

/**
 * Display the ZoomAndPan HTML.
 * @method displayZoomAndPanHtml
 * @static
 * @param {Boolean} bool True to display, false to hide.
 */
BAMBOO.gui.base.displayZoomAndPanHtml = function(bool)
{
	return;
    // display list element
    BAMBOO.html.displayElement("zoomLi", bool);
};

/**
 * Append the Scroll HTML to the page.
 * @method appendScrollHtml
 * @static
 */
BAMBOO.gui.base.appendScrollHtml = function()
{
	return;
    // list element
    var liElement = document.createElement("li");
    liElement.id = "scrollLi";
    liElement.style.display = "none";
    liElement.setAttribute("class","ui-block-c");
    
    // node
    var node = document.getElementById("toolList");
    // append element
    node.appendChild(liElement);
    // trigger create event (mobile)
    $("#toolList").trigger("create");
};

/**
 * Display the Scroll HTML.
 * @method displayScrollHtml
 * @static
 * @param {Boolean} bool True to display, false to hide.
 */
BAMBOO.gui.base.displayScrollHtml = function(bool)
{
	return;
    // display list element
    BAMBOO.html.displayElement("scrollLi", bool);
};
