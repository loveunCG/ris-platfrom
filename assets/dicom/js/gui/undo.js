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
 * Append the undo HTML to the page.
 * @method appendUndoHtml
 * @static
 */
BAMBOO.gui.base.appendUndoHtml = function()
{
    var paragraph = document.createElement("p");  
    paragraph.appendChild(document.createTextNode("History:"));
    paragraph.appendChild(document.createElement("br"));
    
    var select = document.createElement("select");
    select.id = "history_list";
    select.name = "history_list";
    select.multiple = "multiple";
    paragraph.appendChild(select);

    // node
    var node = document.getElementById("history");
    // clear it
    while(node.hasChildNodes()) {
        node.removeChild(node.firstChild);
    }
    // append
    node.appendChild(paragraph);
};

/**
 * Clear the command list of the undo HTML.
 * @method cleaUndoHtml
 * @static
 */
BAMBOO.gui.cleaUndoHtml = function ()
{
    var select = document.getElementById("history_list");
    if ( select && select.length !== 0 ) {
        for( var i = select.length - 1; i >= 0; --i)
        {
            select.remove(i);
        }
    }
};

/**
 * Add a command to the undo HTML.
 * @method addCommandToUndoHtml
 * @static
 * @param {String} commandName The name of the command to add.
 */
BAMBOO.gui.addCommandToUndoHtml = function(commandName)
{
    var select = document.getElementById("history_list");
    // remove undone commands
    var count = select.length - (select.selectedIndex+1);
    if( count > 0 )
    {
        for( var i = 0; i < count; ++i)
        {
            select.remove(select.length-1);
        }
    }
    // add new option
    var option = document.createElement("option");
    option.text = commandName;
    option.value = commandName;
    select.add(option);
    // increment selected index
    select.selectedIndex++;
};

/**
 * Enable the last command of the undo HTML.
 * @method enableInUndoHtml
 * @static
 * @param {Boolean} enable Flag to enable or disable the command.
 */
BAMBOO.gui.enableInUndoHtml = function(enable)
{
    var select = document.getElementById("history_list");
    // enable or not (order is important)
    var option;
    if( enable ) 
    {
        // increment selected index
        select.selectedIndex++;
        // enable option
        option = select.options[select.selectedIndex];
        option.disabled = false;
    }
    else 
    {
        // disable option
        option = select.options[select.selectedIndex];
        option.disabled = true;
        // decrement selected index
        select.selectedIndex--;
    }
};
