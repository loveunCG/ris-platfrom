/**
 * Application launcher.
 */

// start app function
function startApp() {
    // gui setup
    dwv.gui.setup();

    // main application
    var myapp = new dwv.App();
    // initialise the application
    myapp.init({
        "containerDivId": "dwv",
        "fitToWindow": true,
        "gui": ["tool", "load", "help", "undo", "version", "tags", "drawList"],
        "loaders": ["File", "Url"],
        "tools": ["Scroll", "WindowLevel", "ZoomAndPan", "Draw", "Livewire", "Filter", "Floodfill"],
        "filters": ["Threshold", "Sharpen", "Sobel"],
        "shapes": ["Arrow", "Ruler", "Protractor", "Rectangle", "Roi", "Ellipse", "FreeHand"],
        "isMobile": false
    });


    myapp.Wado_test(); 

    // help
    // TODO Seems accordion only works when at end...
    $("#accordion").accordion({ collapsible: "true", active: "false", heightStyle: "content" });
}

// Image decoders (for web workers)
dwv.image.decoderScripts = {
    "jpeg2000": "../../decoders/pdfjs/decode-jpeg2000.js",
    "jpeg-lossless": "../../decoders/rii-mango/decode-jpegloss.js",
    "jpeg-baseline": "../../decoders/pdfjs/decode-jpegbaseline.js"
};

// check browser support
dwv.browser.check();
// initialise i18n
dwv.i18nInitialise();

// status flags
var domContentLoaded = false;
var i18nLoaded = false;
// launch when both DOM and i18n are ready
function launchApp() {
    if ( domContentLoaded && i18nLoaded ) {
        startApp();
    }
}
// DOM ready?
$(document).ready( function() {
    var layerDivH = screen.height -300;
    $("#pageMain").css("width", document.body.clientWidth - 240);
    $("#pageMain").css("height", layerDivH + "px");


    domContentLoaded = true;
    launchApp();

});
// i18n ready?
dwv.i18nOnLoaded( function () {
    // call next once the overlays are loaded
    var onLoaded = function (data) {
        dwv.gui.info.overlayMaps = data;
        i18nLoaded = true;
        launchApp();
    };
    // load overlay map info
    $.getJSON( dwv.i18nGetLocalePath("overlays.json"), onLoaded )
    .fail( function () {
        console.log("Using fallback overlays.");
        $.getJSON( dwv.i18nGetFallbackLocalePath("overlays.json"), onLoaded );
    });
});
