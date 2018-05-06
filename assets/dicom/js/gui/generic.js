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
 * Get the size of the image display window.
 * @method getWindowSize
 * @static
 */
BAMBOO.gui.base.getWindowSize = function()
{
    return { 'width': ($(window).width()), 'height': ($(window).height() - 147) };
};

/**
 * Update the progress bar.
 * @method updateProgress
 * @static
 * @param {Object} event A ProgressEvent.
 */
BAMBOO.gui.updateProgress = function(event)
{
    // event is an ProgressEvent.
    if( event.lengthComputable )
    {
        var percent = Math.round((event.loaded / event.total) * 100);
        BAMBOO.gui.displayProgress(percent);
    }
};

/**
 * Display a progress value.
 * @method displayProgress
 * @static
 * @param {Number} percent The progress percentage.
 */
BAMBOO.gui.base.displayProgress = function(percent)
{
    // jquery-mobile specific
    if( percent < 100 ) {
        $.mobile.loading("show", {text: percent+"%", textVisible: true, theme: "b"} );
    }
    else if( percent === 100 ) {
        $.mobile.loading("hide");
    }
};

/**
 * Refresh a HTML select. Mainly for jquery-mobile.
 * @method refreshSelect
 * @static
 * @param {String} selectName The name of the HTML select to refresh.
 */
BAMBOO.gui.base.refreshSelect = function(selectName)
{
    // jquery-mobile
    if( $(selectName).selectmenu ) {
        $(selectName).selectmenu('refresh');
    }
};

/**
 * Set the selected item of a HTML select.
 * @method refreshSelect
 * @static
 * @param {String} selectName The name of the HTML select.
 * @param {String} itemName The name of the itme to mark as selected.
 */
BAMBOO.gui.setSelected = function(selectName, itemName)
{
	return;
    var select = document.getElementById(selectName);
    var index = 0;
    for( index in select.options){ 
        if( select.options[index].text === itemName ) {
            break;
        }
    }
    select.selectedIndex = index;
    BAMBOO.gui.refreshSelect("#" + selectName);
};

/**
 * Append the slider HTML.
 * @method appendSliderHtml
 * @static
 */
BAMBOO.gui.base.appendSliderHtml = function()
{
	return;
    // default values
    var min = 0;
    var max = 1;
    
    // jquery-mobile range slider
    // minimum input
    var inputMin = document.createElement("input");
    inputMin.id = "threshold-min";
    inputMin.type = "range";
    inputMin.max = max;
    inputMin.min = min;
    inputMin.value = min;
    // maximum input
    var inputMax = document.createElement("input");
    inputMax.id = "threshold-max";
    inputMax.type = "range";
    inputMax.max = max;
    inputMax.min = min;
    inputMax.value = max;
    // slicer div
    var div = document.createElement("div");
    div.id = "threshold-div";
    div.setAttribute("data-role", "rangeslider");
    div.appendChild(inputMin);
    div.appendChild(inputMax);
    div.setAttribute("data-mini", "true");
    // append to document
    document.getElementById("thresholdLi").appendChild(div);
    // bind change
    $("#threshold-div").on("change",
            function(/*event*/) {
                BAMBOO.gui.onChangeMinMax(
                    { "min":$("#threshold-min").val(),
                      "max":$("#threshold-max").val() } );
            }
        );
    // trigger creation
    $("#toolList").trigger("create");
};

/**
 * Initialise the slider HTML.
 * @method initSliderHtml
 * @static
 */
BAMBOO.gui.base.initSliderHtml = function()
{
	return;
    var min = app.getImage().getDataRange().min;
    var max = app.getImage().getDataRange().max;
    
    // minimum input
    var inputMin = document.getElementById("threshold-min");
    inputMin.max = max;
    inputMin.min = min;
    inputMin.value = min;
    // maximum input
    var inputMax = document.getElementById("threshold-max");
    inputMax.max = max;
    inputMax.min = min;
    inputMax.value = max;
    // trigger creation
    $("#toolList").trigger("create");
};


