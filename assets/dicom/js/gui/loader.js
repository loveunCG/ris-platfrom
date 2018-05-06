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
 * Append the loadbox HTML to the page.
 * @method appendLoadboxHtml
 * @static
 */
BAMBOO.gui.base.appendLoadboxHtml = function()
{
    // loader select
    var loaderSelector = BAMBOO.html.createHtmlSelect("loaderSelect",BAMBOO.io.loaders);
    loaderSelector.onchange = BAMBOO.gui.onChangeLoader;
    
    // node
    var node = document.getElementById("loaderlist");
    // clear it
    while(node.hasChildNodes()) {
        node.removeChild(node.firstChild);
    }
    // append
//    node.appendChild(loaderSelector);
    // trigger create event (mobile)
    $("#loaderlist").trigger("create");
};

/**
 * Append the file load HTML to the page.
 * @method appendFileLoadHtml
 * @static
 */
BAMBOO.gui.base.appendFileLoadHtml = function()
{
	var fileLoadInput = document.getElementById("fileopen");
    fileLoadInput.onchange = BAMBOO.gui.onChangeFiles;
 //    fileLoadInput.type = "file";
 //    fileLoadInput.multiple = true;
 //    fileLoadInput.id = "imagefiles";
 //    fileLoadInput.setAttribute("data-clear-btn","true");
 //    fileLoadInput.setAttribute("data-mini","true");
	var fileLoadInput = document.getElementById("fileopen");
    fileLoadInput.onchange = BAMBOO.gui.onChangeFiles;
    fileLoadInput.type = "file";
    fileLoadInput.multiple = true;
    fileLoadInput.id = "imagefiles";
    fileLoadInput.setAttribute("data-clear-btn","true");
    fileLoadInput.setAttribute("data-mini","true");

	/*
    // input
    var fileLoadInput = document.createElement("input");
    fileLoadInput.onchange = BAMBOO.gui.onChangeFiles;
    fileLoadInput.type = "file";
    fileLoadInput.multiple = true;
    fileLoadInput.id = "imagefiles";
    fileLoadInput.setAttribute("data-clear-btn","true");
    fileLoadInput.setAttribute("data-mini","true");

    // associated div
    var fileLoadDiv = document.createElement("div");
    fileLoadDiv.id = "imagefilesdiv";
    fileLoadDiv.style.display = "none";
    fileLoadDiv.appendChild(fileLoadInput);
    
    // node
    var node = document.getElementById("loaderlist");
    // append
    node.appendChild(fileLoadDiv);
    // trigger create event (mobile)
    $("#loaderlist").trigger("create");
	*/
};

/**
 * Display the file load HTML.
 * @method clearUrlLoadHtml
 * @static
 * @param {Boolean} bool True to display, false to hide.
 */
BAMBOO.gui.base.displayFileLoadHtml = function(bool)
{
    // file div element
    var filediv = document.getElementById("imagefilesdiv");
    filediv.style.display = bool ? "" : "none";
};

/**
 * Append the url load HTML to the page.
 * @method appendUrlLoadHtml
 * @static
 */
BAMBOO.gui.base.appendUrlLoadHtml = function()
{
    // input
    var urlLoadInput = document.createElement("input");
    urlLoadInput.onchange = BAMBOO.gui.onChangeURL;
    urlLoadInput.type = "url";
    urlLoadInput.id = "imageurl";
    urlLoadInput.setAttribute("data-clear-btn","true");
    urlLoadInput.setAttribute("data-mini","true");

    // associated div
    var urlLoadDiv = document.createElement("div");
    urlLoadDiv.id = "imageurldiv";
    urlLoadDiv.style.display = "none";
    urlLoadDiv.appendChild(urlLoadInput);

    // node
    var node = document.getElementById("loaderlist");
    // append
    node.appendChild(urlLoadDiv);
    // trigger create event (mobile)
    $("#loaderlist").trigger("create");
};

/**
 * Display the url load HTML.
 * @method clearUrlLoadHtml
 * @static
 * @param {Boolean} bool True to display, false to hide.
 */
BAMBOO.gui.base.displayUrlLoadHtml = function(bool)
{
    // url div element
    var urldiv = document.getElementById("imageurldiv");
    urldiv.style.display = bool ? "" : "none";
};
