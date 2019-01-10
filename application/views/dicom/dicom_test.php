    <link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/dicoms/style.css">

    <style type="text/css">

        
        #pageHeader h1 {
            display: inline-block;
            margin: 0;
            color: #fff;
        }
        
        #pageHeader a {
            color: #ddf;
        }
        
        #pageHeader .toolbar {
            display: inline-block;
            float: right;
        }
        
        .toolList ul {
            padding: 0;
        }
        
        .toolList li {
            list-style-type: none;
            color: #555;
        }
        
        #pageMain {
            position: absolute;

            background-color: #333;
        }

        .infotl {
            text-shadow: 0 1px 0 #000;
        }
        
        .infotc {
            text-shadow: 0 1px 0 #000;
        }
        
        .infotr {
            text-shadow: 0 1px 0 #000;
        }
        
        .infocl {
            text-shadow: 0 1px 0 #000;
        }
        
        .infocr {
            text-shadow: 0 1px 0 #000;
        }
        
        .infobl {
            text-shadow: 0 1px 0 #000;
        }
        
        .infobc {
            text-shadow: 0 1px 0 #000;
        }
        
        .infobr {
            text-shadow: 0 1px 0 #000;
        }
        
        .dropBox {
            margin: 20px;
        }
        
        .ui-icon {
            zoom: 125%;
        }
        
        .tagsTable tr:nth-child(even) {
            background-color: #333;
            color: #555;
        }
        
        .drawList tr:nth-child(even) {
            background-color: #333;
        }
        
        button,
        input,
        li,
        table {
            margin-top: 0.2em;
        }
        
        li button,
        li input {
            margin: 0;
        }
        
        .history_list {
            width: 100%;
        }

    </style>
    <link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/dicoms/ext/jquery-ui/themes/ui-darkness/jquery-ui-1.12.0.min.css">
    <style type="text/css">
        .ui-widget-content {
            background-color: #222;
            background-image: url();
        }
    </style>    


    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/ext/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/ext/i18next/i18next.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/ext/i18next/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/ext/i18next/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/ext/konva/konva.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/ext/magic-wand/magic-wand.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/ext/jszip/jszip.min.js"></script>
    <!-- Third party (viewer) -->
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/ext/jquery/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/ext/jquery-ui/jquery-ui-1.12.0.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/ext/flot/jquery.flot.min.js"></script>
    <!-- decoders -->
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/decoders/pdfjs/jpx.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/decoders/pdfjs/util.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/decoders/pdfjs/arithmetic_decoder.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/decoders/pdfjs/jpg.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/decoders/rii-mango/lossless-min.js"></script>
    <!-- Local -->
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/app/application.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/app/drawController.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/app/infoController.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/app/toolboxController.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/app/viewController.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/app/state.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/dicom/dicomParser.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/dicom/dictionary.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/gui/filter.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/gui/generic.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/gui/help.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/gui/html.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/gui/info.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/gui/layer.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/gui/loader.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/gui/style.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/gui/tools.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/gui/undo.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/image/decoder.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/image/dicomBufferToView.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/image/domReader.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/image/filter.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/image/geometry.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/image/image.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/image/luts.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/image/view.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/io/filesLoader.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/io/urlsLoader.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/io/memoryLoader.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/io/dicomDataLoader.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/io/jsonTextLoader.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/io/rawImageLoader.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/io/rawVideoLoader.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/io/zipLoader.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/math/matrix.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/math/bucketQueue.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/math/point.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/math/scissors.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/math/shapes.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/math/stats.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/math/vector.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/tools/arrow.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/tools/draw.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/tools/drawCommands.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/tools/editor.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/tools/ellipse.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/tools/filter.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/tools/floodfill.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/tools/freeHand.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/tools/livewire.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/tools/protractor.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/tools/rectangle.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/tools/roi.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/tools/ruler.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/tools/scroll.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/tools/toolbox.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/tools/undo.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/tools/windowLevel.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/tools/zoomPan.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/utils/browser.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/utils/i18n.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/utils/progress.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/utils/string.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/utils/uri.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/src/utils/thread.js"></script>

    <!-- Launch the app -->
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/appgui.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dicoms/applauncher.js"></script>


    <!-- DWV -->
 <div class="page-content-wrapper">
    <div class="page-content">   
    <div id="dwv">


       <h3 class="page-title">
            <?=$menutitle?>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <?=$menutitle?>
                        </a>
                        <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <span>调图</span>
                </li>
            </ul>

        </div>
        <div id="pageHeader">
            <!-- Toolbar -->
            <div class="toolbar"></div>

        </div>
       
        <!-- /pageHeader -->

        <div id="pageMain" >

            <!-- Open file -->
            <div class="openData" title="文件输入">
                <div class="loaderlist"></div>
                <!-- <div id="progressbar"></div> -->
            </div>

            <!-- Toolbox -->
            <div class="toolList" title="工具箱"></div>

            <!-- History -->
            <div class="history" title="历史"></div>

            <!-- Tags -->
            <div class="tags" title="Tags" ></div>

            <!-- DrawList -->
            <div class="drawList" title="Draw list"></div>

            <!-- Help -->
            <div class="help" title="Help"></div>

            <!-- Layer Container -->
            <div class="layerDialog" title="Image">
                <div class="dropBox"></div>
                <div class="layerContainer">
                    <canvas class="imageLayer">Only for HTML5 compatible browsers...</canvas>
                    <div class="drawDiv"></div>
                    <div class="infoLayer">
                        <div class="infotl"></div>
                        <div class="infotc"></div>
                        <div class="infotr"></div>
                        <div class="infocl"></div>
                        <div class="infocr"></div>
                        <div class="infobl"></div>
                        <div class="infobc"></div>
                        <div class="infobr" style="bottom: 64px;"></div>
                        <div class="plot"></div>
                    </div>
                    <!-- /infoLayer -->
                </div>
                <!-- /layerContainer -->
            </div>
            <!-- /layerDialog -->

        </div>
        <!-- /pageMain -->

    </div>
    <!-- /dwv -->
</div></div>

<input type="hidden" name="return_url" id="return_url" value="<?=base_url()?>report/my_report">
<input type="hidden" name="dic_info" id="dic_info" value="<?=base_url()?><?php echo $dicom_url->dicom_file_url; ?>">
