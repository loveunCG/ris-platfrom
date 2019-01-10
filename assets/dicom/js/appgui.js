/** 
 * Application GUI.
 */

// Window
BAMBOO.gui.getWindowSize = function(){
    return { 'width': ($('#layerDiv').width() ), 'height': ($('#layerDiv').height() ) };
};
// Progress
BAMBOO.gui.displayProgress = function(percent){
    // jquery-ui progress bar
    if( percent < 100 ) {
        $("#myWaitCursor").css("display", "inline");
        document.body.style.cursor = 'wait !important';
    }
    else if (percent >= 100) {
        $("#myWaitCursor").css("display", "none");
        document.body.style.cursor = 'hand';
    }
};
// Select
BAMBOO.gui.refreshSelect = function(/*selectName*/){
    // nothing to do
};
// Slider
BAMBOO.gui.appendSliderHtml = function(){
    // nothing to do
};
BAMBOO.gui.initSliderHtml = function(){
    var min = app.getImage().getDataRange().min;
    var max = app.getImage().getDataRange().max;
    
    // jquery-ui slider
    $( "#thresholdLi" ).slider({
        range: true,
        min: min,
        max: max,
        values: [ min, max ],
        slide: function( event, ui ) {
            BAMBOO.gui.onChangeMinMax(
                    {'min':ui.values[0], 'max':ui.values[1]});
        }
    });
};
function toggle(dialogId)
{
    if( $(dialogId).dialog('isOpen') ) { 
        $(dialogId).dialog('close');
    }
    else {
        $(dialogId).dialog('open');
    }
}

// Loaders
BAMBOO.gui.appendLoadboxHtml = function(){
    BAMBOO.gui.base.appendLoadboxHtml();
};

// File loader
BAMBOO.gui.appendFileLoadHtml = function(){
    BAMBOO.gui.base.appendFileLoadHtml();
};
BAMBOO.gui.displayFileLoadHtml = function(bool){
    BAMBOO.gui.base.displayFileLoadHtml(bool);
};

// Url loader
BAMBOO.gui.appendUrlLoadHtml = function(){
    BAMBOO.gui.base.appendUrlLoadHtml();
};
BAMBOO.gui.displayUrlLoadHtml = function(bool){
    BAMBOO.gui.base.displayUrlLoadHtml(bool);
};

// Toolbox 
BAMBOO.gui.appendToolboxHtml = function(){
    BAMBOO.gui.base.appendToolboxHtml();

    // toolbar
    var open = document.createElement("button");
    open.appendChild(document.createTextNode("File"));
    open.onclick = function() { toggle("#openData"); };
    open.style.display = 'none';
    $("#openData").dialog('open');
    
    var toolbox = document.createElement("button");
    toolbox.appendChild(document.createTextNode("Toolbox"));
    toolbox.onclick = function() { toggle("#toolbox"); };
    toolbox.style.display = 'none';
    $("#toolbox").dialog('close');

    var history = document.createElement("button");
    history.appendChild(document.createTextNode("History"));
    history.onclick = function() { toggle("#history"); };
    history.style.display = 'none';
    $("#history").dialog('close');

    var tags = document.createElement("button");
    tags.appendChild(document.createTextNode("Tags"));
    tags.onclick = function() { toggle("#tags"); };
    tags.style.display = 'none';
    $("#tags").dialog('close');

    var image = document.createElement("button");
    image.appendChild(document.createTextNode("Image"));
    image.onclick = function() { toggle("#layerDialog"); };
    image.style.display = 'none';
    $("#layerDialog").dialog('open');

    var info = document.createElement("button");
    info.appendChild(document.createTextNode("Info"));
    info.onclick = BAMBOO.gui.onToggleInfoLayer;
    info.style.display = 'none';

    var help = document.createElement("button");
    help.appendChild(document.createTextNode("Help"));
    help.onclick = function() { toggle("#help"); };
    help.style.display = 'none';
    $("#help").dialog('close');

    var node = document.getElementById("toolbar");
    node.appendChild(open);
    node.appendChild(toolbox);
    node.appendChild(history);
    node.appendChild(tags);
    node.appendChild(image);
    node.appendChild(info);
    node.appendChild(help);
    $("button").button();
};
BAMBOO.gui.displayToolboxHtml = function(bool){
    BAMBOO.gui.base.displayToolboxHtml(bool);
};
BAMBOO.gui.initToolboxHtml = function(){
    BAMBOO.gui.base.initToolboxHtml();
};

// Window/level
BAMBOO.gui.appendWindowLevelHtml = function(){
    BAMBOO.gui.base.appendWindowLevelHtml();
};
BAMBOO.gui.displayWindowLevelHtml = function(bool){
    BAMBOO.gui.base.displayWindowLevelHtml(bool);
};
BAMBOO.gui.initWindowLevelHtml = function(){
    BAMBOO.gui.base.initWindowLevelHtml();
};

// Draw
BAMBOO.gui.appendDrawHtml = function(){
    BAMBOO.gui.base.appendDrawHtml();
};
BAMBOO.gui.displayDrawHtml = function(bool){
    BAMBOO.gui.base.displayDrawHtml(bool);  
};
BAMBOO.gui.initDrawHtml = function(){
    BAMBOO.gui.base.initDrawHtml();  
};

// Livewire
BAMBOO.gui.appendLivewireHtml = function(){
    BAMBOO.gui.base.appendLivewireHtml();  
};
BAMBOO.gui.displayLivewireHtml = function(bool){
    BAMBOO.gui.base.displayLivewireHtml(bool);
};
BAMBOO.gui.initLivewireHtml = function(){
    BAMBOO.gui.base.initLivewireHtml();
};

// Navigate
BAMBOO.gui.appendZoomAndPanHtml = function(){
    BAMBOO.gui.base.appendZoomAndPanHtml();
};
BAMBOO.gui.displayZoomAndPanHtml = function(bool){
    BAMBOO.gui.base.displayZoomAndPanHtml(bool);
};

// Scroll
BAMBOO.gui.appendScrollHtml = function(){
    BAMBOO.gui.base.appendScrollHtml();
};
BAMBOO.gui.displayScrollHtml = function(bool){
    BAMBOO.gui.base.displayScrollHtml(bool);
};

// Filter
BAMBOO.gui.appendFilterHtml = function(){
    BAMBOO.gui.base.appendFilterHtml();
};
BAMBOO.gui.displayFilterHtml = function(bool){
    BAMBOO.gui.base.displayFilterHtml(bool);
};
BAMBOO.gui.initFilterHtml = function(){
    BAMBOO.gui.base.initFilterHtml();
};

// Threshold
BAMBOO.gui.filter.appendThresholdHtml = function(){
    BAMBOO.gui.filter.base.appendThresholdHtml();
};
BAMBOO.gui.filter.displayThresholdHtml = function(bool){
    BAMBOO.gui.filter.base.displayThresholdHtml(bool);
};
BAMBOO.gui.filter.initThresholdHtml = function(){
    BAMBOO.gui.filter.base.initThresholdHtml();
};

// Sharpen
BAMBOO.gui.filter.appendSharpenHtml = function(){
    BAMBOO.gui.filter.base.appendSharpenHtml();
};
BAMBOO.gui.filter.displaySharpenHtml = function(bool){
    BAMBOO.gui.filter.base.displaySharpenHtml(bool);
};

// Sobel
BAMBOO.gui.filter.appendSobelHtml = function(){
    BAMBOO.gui.filter.base.appendSobelHtml();
};
BAMBOO.gui.filter.displaySobelHtml = function(bool){
    BAMBOO.gui.filter.base.displaySobelHtml(bool);
};

// Undo/redo
BAMBOO.gui.appendUndoHtml = function(){
    BAMBOO.gui.base.appendUndoHtml();
};

// Help
BAMBOO.gui.appendHelpHtml = function(mobile){
    BAMBOO.gui.base.appendHelpHtml(mobile);
};
BAMBOO.gui.appendVersionHtml = function(){
    BAMBOO.gui.base.appendVersionHtml();
};