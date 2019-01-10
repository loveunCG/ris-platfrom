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
BAMBOO.gui.filter = BAMBOO.gui.filter || {};
BAMBOO.gui.filter.base = BAMBOO.gui.filter.base || {};

/**
 * Append the filter HTML to the page.
 * @method appendFilterHtml
 * @static
 */
BAMBOO.gui.base.appendFilterHtml = function ()
{
    // filter select
    var filterSelector = BAMBOO.html.createHtmlSelect("filterSelect",BAMBOO.tool.filters);
    filterSelector.onchange = BAMBOO.gui.onChangeFilter;
	filterSelector.style.display = 'none';

    // filter list element
    var filterLi = BAMBOO.html.createHiddenElement("li", "filterLi");
    filterLi.setAttribute("class","ui-block-b");
    filterLi.appendChild(filterSelector);
    
	var list = BAMBOO.tool.filters;
    if( list instanceof Array )
    {
        for ( var i in list )
        {
            var tmpBtn= document.createElement("button");
			tmpBtn.value = list[i];
			tmpBtn.appendChild(document.createTextNode(BAMBOO.utils.capitaliseFirstLetter(list[i])));
			tmpBtn.onclick = function() { app.getToolBox().getSelectedTool().setSelectedFilter(this.value);};
            filterLi.appendChild(tmpBtn);
        }
    }
    else if( typeof list === 'object')
    {
        for ( var item in list )
        {
            var tmpBtn= document.createElement("button");
			tmpBtn.value = item;
			tmpBtn.appendChild(document.createTextNode(BAMBOO.utils.capitaliseFirstLetter(item)));
			tmpBtn.onclick = function() { app.getToolBox().getSelectedTool().setSelectedFilter(this.value);};
            filterLi.appendChild(tmpBtn);
        }
    }
    else
    {
        throw new Error("Unsupported input list type.");
    }
    // append element
    BAMBOO.html.appendElement("toolList", filterLi);
};

/**
 * Display the filter HTML.
 * @method displayFilterHtml
 * @static
 * @param {Boolean} flag True to display, false to hide.
 */
BAMBOO.gui.base.displayFilterHtml = function (flag)
{
    BAMBOO.html.displayElement("filterLi", flag);
};

/**
 * Initialise the filter HTML.
 * @method displayFilterHtml
 * @static
 */
BAMBOO.gui.base.initFilterHtml = function ()
{
    // filter select: reset selected options
    var filterSelector = document.getElementById("filterSelect");
    filterSelector.selectedIndex = 0;
    BAMBOO.gui.refreshSelect("#filterSelect");
};

/**
 * Append the threshold filter HTML to the page.
 * @method appendThresholdHtml
 * @static
 */
BAMBOO.gui.filter.base.appendThresholdHtml = function ()
{
    // threshold list element
    var thresholdLi = BAMBOO.html.createHiddenElement("li", "thresholdLi");
    thresholdLi.setAttribute("class","ui-block-c");
    
    // node
    var node = document.getElementById("toolList");
    // append threshold
    node.appendChild(thresholdLi);
    // threshold slider
    BAMBOO.gui.appendSliderHtml();
    // trigger create event (mobile)
    $("#toolList").trigger("create");
};

/**
 * Clear the treshold filter HTML.
 * @method displayThresholdHtml
 * @static
 * @param {Boolean} flag True to display, false to hide.
 */
BAMBOO.gui.filter.base.displayThresholdHtml = function (flag)
{
    BAMBOO.html.displayElement("thresholdLi", flag);
};

/**
 * Initialise the treshold filter HTML.
 * @method initThresholdHtml
 * @static
 */
BAMBOO.gui.filter.base.initThresholdHtml = function ()
{
    // threshold slider
    BAMBOO.gui.initSliderHtml();
};

/**
 * Append the sharpen filter HTML to the page.
 * @method appendSharpenHtml
 * @static
 */
BAMBOO.gui.filter.base.createFilterApplyButton = function ()
{
    var button = document.createElement("button");
    button.id = "runFilterButton";
    button.onclick = BAMBOO.gui.onRunFilter;
    button.appendChild(document.createTextNode("Apply"));
    return button;
};

/**
 * Append the sharpen filter HTML to the page.
 * @method appendSharpenHtml
 * @static
 */
BAMBOO.gui.filter.base.appendSharpenHtml = function ()
{
    // sharpen list element
    var sharpenLi = BAMBOO.html.createHiddenElement("li", "sharpenLi");
    sharpenLi.setAttribute("class","ui-block-c");
    sharpenLi.appendChild( BAMBOO.gui.filter.base.createFilterApplyButton() );
    
    // append element
    BAMBOO.html.appendElement("toolList", sharpenLi);
};

/**
 * Display the sharpen filter HTML.
 * @method displaySharpenHtml
 * @static
 * @param {Boolean} flag True to display, false to hide.
 */
BAMBOO.gui.filter.base.displaySharpenHtml = function (flag)
{
    BAMBOO.html.displayElement("sharpenLi", flag);
};

/**
 * Append the sobel filter HTML to the page.
 * @method appendSobelHtml
 * @static
 */
BAMBOO.gui.filter.base.appendSobelHtml = function ()
{
    // sobel list element
    var sobelLi = BAMBOO.html.createHiddenElement("li", "sobelLi");
    sobelLi.setAttribute("class","ui-block-c");
    sobelLi.appendChild( BAMBOO.gui.filter.base.createFilterApplyButton() );
    
    // append element
    BAMBOO.html.appendElement("toolList", sobelLi);
};

/**
 * Display the sobel filter HTML.
 * @method displaySobelHtml
 * @static
 * @param {Boolean} flag True to display, false to hide.
 */
BAMBOO.gui.filter.base.displaySobelHtml = function (flag)
{
    BAMBOO.html.displayElement("sobelLi", flag);
};

