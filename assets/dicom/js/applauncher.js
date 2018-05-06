/** 
 * Application launcher.
 */

// check browser support
BAMBOO.browser.check();
// main application
var app = new BAMBOO.App();

// launch when page is loaded
$(document).ready( function()
{
    $("#tabs_viewer").tabs();
    
    var layerDivW = document.body.clientWidth - screen.height;    
    
    var layerDivH = screen.height -300;

    $("#myWaitCursor").css("top", screen.height / 2 - 10);
    $("#myWaitCursor").css("left", document.body.clientWidth / 2 - 50);

    $("#workwist").css("width", document.body.clientWidth - 50);
    $("#workwist").css("height", layerDivH + "px");

    $("#tags").css("width", document.body.clientWidth - 370);
    $("#tags").css("height", "600px");

    $("#thumbnailDiv").css("width", "300px");
    $("#thumbnailDiv").css("height", "600px");

    $("#thumbnailDiv").css("left", document.body.clientWidth - 340);
    
    $("#layerDiv").css("width", layerDivW+ "px");
    $("#layerDiv").css("height", layerDivH + "px");


    $("#drawDiv").css("width", layerDivW + "px");
    $("#drawDiv").css("height", layerDivH + "px");
    
    $("#roiDiv").css("width", "230px");
    $("#roiDiv").css("height", layerDivH + "px");
    $("#roiDiv").css("top", $("#layerDiv").position().top + 50);
    $("#roiDiv").css("left", $("#layerDiv").position().left + layerDivW + 30);
    $("#roiDiv").css("background-color", "#555");

    $("#toolboxDiv").css("width", "300px");
    $("#toolboxDiv").css("background-color", "#555");
    $("#toolboxDiv").css("height", layerDivH + "px");
    $("#toolboxDiv").css("top", $("#layerDiv").position().top );
    $("#toolboxDiv").css("left", $("#layerDiv").position().left + layerDivW + 50);

    $("#viewer").css("width", layerDivW + "px");
    $("#viewer").css("height", layerDivH + "px");
    $("#viewer").css("background-color", "#555");

    // Add required loaders to the loader list
    BAMBOO.io.loaders = {};
    BAMBOO.io.loaders.file = BAMBOO.io.File;
    BAMBOO.io.loaders.url = BAMBOO.io.Url;

    // append load container HTML
    // append loaders HTML
    BAMBOO.gui.appendFileLoadHtml();
    //BAMBOO.gui.appendUrlLoadHtml();

    // Add tools to the tool list
    BAMBOO.tool.tools = {};
    BAMBOO.tool.tools["Window/Level"] = new BAMBOO.tool.WindowLevel(app);
    BAMBOO.tool.tools["Zoom/Pan"] = new BAMBOO.tool.ZoomAndPan(app);
    BAMBOO.tool.tools["CinePlay"] = new BAMBOO.tool.CinePlay(app);
    BAMBOO.tool.tools.scroll = new BAMBOO.tool.Scroll(app);
    BAMBOO.tool.tools.draw = new BAMBOO.tool.Draw(app);
    BAMBOO.tool.tools.livewire = new BAMBOO.tool.Livewire(app);
    BAMBOO.tool.tools.filter = new BAMBOO.tool.Filter(app);

    // Add filters to the filter list for the filter tool
    BAMBOO.tool.filters = {};
    BAMBOO.tool.filters.threshold = new BAMBOO.tool.filter.Threshold(app);
    BAMBOO.tool.filters.sharpen = new BAMBOO.tool.filter.Sharpen(app);
    BAMBOO.tool.filters.sobel = new BAMBOO.tool.filter.Sobel(app);

    // Add shapes to the shape list for the draw tool
    BAMBOO.tool.shapes = {};
    BAMBOO.tool.shapes.line = BAMBOO.tool.LineCreator;
    BAMBOO.tool.shapes.rectangle = BAMBOO.tool.RectangleCreator;
    BAMBOO.tool.shapes.roi = BAMBOO.tool.RoiCreator;
    BAMBOO.tool.shapes.ellipse = BAMBOO.tool.EllipseCreator;

    // initialise the application
    app.init();

    $("#ww_wl").click(function() {
        app.getToolBox().setSelectedTool("Window/Level");
    });
    $("#Zoom").click(function() {
        app.getToolBox().setSelectedTool("Zoom/Pan");
        BAMBOO.tool.tools["Zoom/Pan"].onlypan = false;
    });
    $("#pan").click(function() {
        app.getToolBox().setSelectedTool("Zoom/Pan");
        BAMBOO.tool.tools["Zoom/Pan"].onlypan = true;
    });
    $("#Reset").click(function() {      
        BAMBOO.tool.resetWindowing();
        BAMBOO.gui.onZoomReset();
    });
    $("#Play").click(function() {
        BAMBOO.tool.tools["CinePlay"].playstate = 0;
        app.getToolBox().setSelectedTool("CinePlay");
    });
    $("#Pause").click(function() {
        BAMBOO.tool.tools["CinePlay"].playstate = 1;
        app.getToolBox().setSelectedTool("CinePlay");
    });
    $("#PrevImage").click(function() {
        BAMBOO.tool.tools["CinePlay"].playstate = 2;
        app.getToolBox().setSelectedTool("CinePlay");
    });
    $("#NextImage").click(function() {
        BAMBOO.tool.tools["CinePlay"].playstate = 3;
        app.getToolBox().setSelectedTool("CinePlay");
    });
    $("#PrevSeries").click(function() {
        BAMBOO.tool.tools["CinePlay"].playstate = 4;
        app.getToolBox().setSelectedTool("CinePlay");
    });
    $("#NextSeries").click(function() {
        BAMBOO.tool.tools["CinePlay"].playstate = 5;
        app.getToolBox().setSelectedTool("CinePlay");
    });
    
    
    $("#Line").click(function() {
        app.getToolBox().setSelectedTool("draw");
        app.getToolBox().getSelectedTool().setShapeName("line");
    });
    $("#Rectangle").click(function() {
        app.getToolBox().setSelectedTool("draw");
        app.getToolBox().getSelectedTool().setShapeName("rectangle");
    });
    $("#ROI").click(function() {
        app.getToolBox().setSelectedTool("draw");
        app.getToolBox().getSelectedTool().setShapeName("roi");
    });
    $("#Ellipse").click(function() {
        app.getToolBox().setSelectedTool("draw");
        app.getToolBox().getSelectedTool().setShapeName("ellipse");
    }); 
    $("#return").click(function() {
      var return_url = $("#return_url").val();
      window.location.href = return_url;
    });     
    

    app.Wado_test();

    $('#downloadAndView').click(function() {
           app.Wado_test();
        });
    $("#clear").click(function() {
        if (confirm("Are you sure you want to clear the worklist?") == true)
        {
            //$("#dicom_info tbody").html("");          
            location.reload();
        }       
    });

/*
    // Request 100MB of Temporary Storage
    var fso = new FSO(1024 * 1024 * 1000, false);
    // shorthand for FSO Utilities
    var fsu = FSOUtil;

    fso
    .createQueue() // Create FSOQueue object
        .write('base.txt', '')
        .mkdir('test')
        .write('test/hi.txt', 'Hello World')
        .insert('test/hi.txt', 'Doge!', 6)
        .append('test/hi.txt', ' ... and world.')
        .read('test/hi.txt', function(data) {
            console.log(data);
        })
        .list('/', null, function(dirList) {
            console.log(fsu.prettyDirectory(dirList));
        })
        .rmdir('/')
    .execute(function() { console.log('done!'); });
*/

});

function isASCII(str) {
    return /^[\x00-\x7F]*$/.test(str);
}

// This function iterates through dataSet recursively and adds new HTML strings
// to the output array passed into it
function dumpDataSet(dataSet, output)
{
    function getTag(tag)
    {
        var group = tag.substring(1,5);
        var element = tag.substring(5,9);
        var tagIndex = ("("+group+","+element+")").toUpperCase();
        var attr = TAG_DICT[tagIndex];
        return attr;
    }


    // the dataSet.elements object contains properties for each element parsed.  The name of the property
    // is based on the elements tag and looks like 'xGGGGEEEE' where GGGG is the group number and EEEE is the
    // element number both with lowercase hexadecimal letters.  For example, the Series Description DICOM element 0008,103E would
    // be named 'x0008103e'.  Here we iterate over each property (element) so we can build a string describing its
    // contents to add to the output array
    for(var propertyName in dataSet.elements) {
        var element = dataSet.elements[propertyName];

        var text = "";

        var color = 'black';

        var tag = getTag(element.tag);
        // The output string begins with the element name (or tag if not in data dictionary), length and VR (if present).  VR is undefined for
        // implicit transfer syntaxes
        if(tag === undefined)
        {
            text += element.tag;
            text += "; length=" + element.length;

            if(element.hadUndefinedLength) {
                text += " <strong>(-1)</strong>";
            }

            if(element.vr) {
                text += " VR=" + element.vr +"; ";
            }

            // make text lighter since this is an unknown attribute
            color = '#C8C8C8';
        }
        else
        {
            text += tag.name;
            text += "(" + element.tag + ") :";
        }



        // Here we check for Sequence items and iterate over them if present.  items will not be set in the
        // element object for elements that don't have SQ VR type.  Note that implicit little endian
        // sequences will are currently not parsed.
        if(element.items)
        {
            output.push('<li>'+ text + '</li>');
            output.push('<ul>');

            // each item contains its own data set so we iterate over the items
            // and recursively call this function
            var itemNumber = 0;
            element.items.forEach(function(item)
            {
                output.push('<li>Item #' + itemNumber++ + '</li>')
                output.push('<ul>');
                dumpDataSet(item.dataSet, output);
                output.push('</ul>');
            });
            output.push('</ul>');
        }
        else {
            // use VR to display the right value
            var vr;
            if(element.vr !== undefined)
            {
                vr = element.vr;
            }
            else {
                if(tag !== undefined)
                {
                    vr = tag.vr;
                }
            }

            // if the length of the element is less than 128 we try to show it.  We put this check in
            // to avoid displaying large strings which makes it harder to use.
            if(element.length < 128) {
                // Since the dataset might be encoded using implicit transfer syntax and we aren't using
                // a data dictionary, we need some simple logic to figure out what data types these
                // elements might be.  Since the dataset might also be explicit we could be switch on the
                // VR and do a better job on this, perhaps we can do that in another example

                // First we check to see if the element's length is appropriate for a UI or US VR.
                // US is an important type because it is used for the
                // image Rows and Columns so that is why those are assumed over other VR types.
                if(element.vr === undefined && tag === undefined) {
                    if(element.length === 2)
                    {
                        text += " (" + dataSet.uint16(propertyName) + ")";
                    }
                    else if(element.length === 4)
                    {
                        text += " (" + dataSet.uint32(propertyName) + ")";
                    }


                    // Next we ask the dataset to give us the element's data in string form.  Most elements are
                    // strings but some aren't so we do a quick check to make sure it actually has all ascii
                    // characters so we know it is reasonable to display it.
                    var str = dataSet.string(propertyName);
                    var stringIsAscii = isASCII(str);

                    if(stringIsAscii)
                    {
                        // the string will be undefined if the element is present but has no data
                        // (i.e. attribute is of type 2 or 3 ) so we only display the string if it has
                        // data.  Note that the length of the element will be 0 to indicate "no data"
                        // so we don't put anything here for the value in that case.
                        if(str !== undefined) {
                            text += '"' + str + '"';
                        }
                    }
                    else
                    {
                        if(element.length !== 2 && element.length !== 4)
                        {
                            color = '#C8C8C8';
                            // If it is some other length and we have no string
                            text += "<i>binary data</i>";
                        }
                    }
                }
                else
                {
                    function isStringVr(vr)
                    {
                        if(vr === 'AT'
                                || vr === 'FL'
                                || vr === 'FD'
                                || vr === 'OB'
                                || vr === 'OF'
                                || vr === 'OW'
                                || vr === 'SI'
                                || vr === 'SQ'
                                || vr === 'SS'
                                || vr === 'UL'
                                || vr === 'US'
                                )
                        {
                            return false;
                        }
                        return true;
                    }

                    if(isStringVr(vr))
                    {
                        // Next we ask the dataset to give us the element's data in string form.  Most elements are
                        // strings but some aren't so we do a quick check to make sure it actually has all ascii
                        // characters so we know it is reasonable to display it.
                        var str = dataSet.string(propertyName);
                        var stringIsAscii = isASCII(str);

                        if(stringIsAscii)
                        {
                            // the string will be undefined if the element is present but has no data
                            // (i.e. attribute is of type 2 or 3 ) so we only display the string if it has
                            // data.  Note that the length of the element will be 0 to indicate "no data"
                            // so we don't put anything here for the value in that case.
                            if(str !== undefined) {
                                text += '"' + str + '"';
                            }
                        }
                        else
                        {
                            if(element.length !== 2 && element.length !== 4)
                            {
                                color = '#C8C8C8';
                                // If it is some other length and we have no string
                                text += "<i>binary data</i>";
                            }
                        }
                    }
                    else if (vr == 'US')
                    {
                        text += dataSet.uint16(propertyName);
                    }
                    else if(vr === 'SS')
                    {
                        text += dataSet.int16(propertyName);
                    }
                    else if (vr == 'UL')
                    {
                        text += dataSet.uint32(propertyName);
                    }
                    else if(vr === 'SL')
                    {
                        text += dataSet.int32(propertyName);
                    }
                    else if(vr == 'FD')
                    {
                        text += dataSet.double(propertyName);
                    }
                    else if(vr == 'FL')
                    {
                        text += dataSet.float(propertyName);
                    }
                    else if(vr === 'OB' || vr === 'OW' || vr === 'UN' || vr === 'OF' || vr ==='UT')
                    {
                        color = '#C8C8C8';
                        // If it is some other length and we have no string
                        text += "<i>binary data of length " + element.length + " and VR " + vr + "</i>";
                    }
                    else {
                        // If it is some other length and we have no string
                        text += "<i>no display code for VR " + vr + " yet, sorry!</i>";
                    }
                }

                if(element.length ===0) {
                    color = '#C8C8C8';
                }
            }
            else {
                color = '#C8C8C8';

                // Add text saying the data is too long to show...
                text += "<i>data of length " + element.length + " for VR + " + vr + " too long to show</i>";
            }
        }
        // finally we add the string to our output array surrounded by li elements so it shows up in the
        // DOM as a list
        output.push('<li style="color:' + color +';">'+ text + '</li>');
    }
}
