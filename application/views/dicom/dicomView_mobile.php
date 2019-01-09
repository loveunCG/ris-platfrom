<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DICOM VIEWER</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?=base_url()?>assets/dicom/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?=base_url()?>assets/dicom/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="<?=base_url()?>assets/dicom/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?=base_url()?>assets/dicom/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?=base_url()?>assets/dicom/css/custom.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/dicom/css/fakeLoader.css">


    <link href="<?=base_url()?>assets/cornerstone/cornerstone.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/cornerstone/dialogPolyfill.css" rel="stylesheet">
    <!-- Favicon-->
    <link rel="icon" href="<?=base_url()?>/assets/images/favicon.png" sizes="32x32">


    <style>
        /* prevents selection when left click dragging */



        .annotationDialog,
        .relabelDialog {
            z-index: 1000;
            position: absolute;
            margin: 0px;
            left: 40%;
            top: 40%;
            width: 300px;
            border: 1px black solid;
            border-radius: 5px;
        }

        .annotationTextInputOptions {
            padding: 5px 0px;
        }

        .annotationTextInput {
            margin-left: 5px;
        }

        .annotationDialogConfirm {
            float: right;
        }

        #compareDicomImage canvas {
            border: 1px solid #808080;
            background-color: #000000;
        }
        #dicomImageview canvas {
            border: 1px solid #808080;
            background-color: #000000;
        }


    </style>
    <style>

        .messages-block.block {
            border: 1px solid #474b52;
        }
        /*.select {*/
        /*border: 1px solid #337ab7;*/
        /*}*/
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            margin-top: 10px;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
    </style>
    <style>
        .preloader-wrap {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            bottom: 0;
            background: rgba(0,0,0,1);
            z-index : 2;
        }

        .percentage {
            z-index: 100;
            border: 1px solid #ccc;
            text-align:center;
            color: #fff;
            line-height: 30px;
            font-size : 15px;
        }

        .loader,
        .percentage{
            height: 30px;
            max-width: 500px;
            border: 2px solid #69AF23;
            border-radius: 20px;
            font-weight: 300;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin : auto;
        }
        .loader:after,
        .percentage:after {
            content: "";
            display: block;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .trackbar {
            width: 100%;
            height: 100%;
            border-radius: 20px;
            color: #fff;
            text-align: center;
            line-height: 30px;
            overflow: hidden;
            position: relative;
            opacity: 0.99;
        }

        .loadbar {
            width: 0%;
            height: 100%;
            background: repeating-linear-gradient(
                    45deg,
                    #008737,
                    #008737 10px,
                    #69AF23 10px,
                    #69AF23 20px
            ); /* Stripes Background Gradient */
            box-shadow: 0px 0px 14px 1px #008737;
            position: absolute;
            top: 0;
            left: 0;
            animation: flicker 5s infinite;
            overflow: hidden;
        }

        .glow {
            width: 0%;
            height: 0%;
            border-radius: 20px;
            box-shadow: 0px 0px 60px 10px #008737;
            position: absolute;
            bottom: -5px;
            animation: animation 5s infinite;
        }

        @keyframes animation {
            10% {
                opacity: 0.9;
            }
            30% {
                opacity: 0.86;
            }
            60% {
                opacity: 0.8;
            }
            80% {
                opacity: 0.75;
            }
        }
    </style>

</head>

<body oncontextmenu="return true;">
<!--<div class="fakeLoader"></div>-->
<div class="preloader-wrap">
    <div class="percentage" id="precent"></div>
    <div class="loader">
        <div class="trackbar">
            <div class="loadbar"></div>
        </div>
        <div class="glow"></div>
    </div>
</div>
<header class="header">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div class="navbar-header">
                <a href="#" class="navbar-brand">
                    <div class="brand-big visible text-uppercase">
                        <strong class="text-primary">DICOM</strong>
                        <strong>影像云</strong>
                    </div>
                </a>
            </div>
            <ul class="right-menu list-inline no-margin-bottom">
                <li class="list-inline-item">
                    <a href="#" id="">
                        <input type="checkbox" name="chk_info" checked="checked" value="">&nbsp;<img src="<?=base_url()?>assets/dicom/svg/user-info1.svg" style="width:24px;height:24px;">
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="#" id="" class="nav-link" onclick="openNav();">
                        <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
                    </a>
                </li>
<!--                <li class="list-inline-item">-->
<!--                    <a href="#" id="report_make" class="nav-link">-->
<!--                        <i class="fa fa-address-card-o fa-2x" aria-hidden="true"></i>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="list-inline-item">-->
<!--                    <a href="#" class="returnBack nav-link">-->
<!--                        <i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>-->
<!--                    </a>-->
<!--                </li>-->

            </ul>

        </div>
    </nav>
</header>
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="" id="DicomListView" style="overflow: auto;"></div>
</div>
<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->

    <div class="page-content" style="padding-top: 10px;">

        <section class="no-padding-bottom">
            <div class="row">
                <div class="col-lg-10" style="">
                    <div class="container-fluid" style="padding-left: 0px;">
                        <div id="oneOneScreen"  class="row" style="padding-right: 4%;" oncontextmenu="return false;" >
                            <div id="dicomImage" class="col-lg-12">
                                <div class="pat_info" id="mrtopleft_PatName" style="position: absolute;top:3px; left:30px"></div>
                                <div class="pat_info" id="mrtopleft_PatNum" style="position: absolute;top:18px; left:30px"></div>
                                <div class="pat_info" id="mrtopleft_PatAge" style="position: absolute;top:33px; left:30px"></div>
                                <div class="pat_info" id="mrtopleft_PatSex" style="position: absolute;top:48px; left:30px"></div>
                                <div class="pat_info" id="mrtopright" style="position: absolute;top:3px; right:3px"></div>
                                <div class="pat_info" id="mrtopright_hospital" style="position: absolute;top:23px; right:3px"></div>
                                <div class="pat_info" id="mrtopright_checktime" style="position: absolute;top:40px; right:3px"></div>
                                <div class="pat_info" id="mrbottomright" style="position: absolute;bottom:3px; right:3px"></div>
                                <div class="pat_info" id="mrbottomleft" style="position: absolute;bottom:3px; left:30px"></div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
        <footer class="footer">
            <div class="footer__block block no-margin-bottom">
                <div class="container-fluid text-center">
                    <p class="no-margin-bottom">2017 &copy;
                        <a href="#">杭州健培科技有限公司   客服：0571-86668666</a>.</p>
                </div>
            </div>
        </footer>
    </div>
</div>

<dialog class="annotationDialog">
    <h5>请输入标题</h5>
    <div class="annotationTextInputOptions">
        <label for="annotationTextInput">标题</label>
        <input name="annotationTextInput" class="annotationTextInput" type="text" />
    </div>
    <a class="annotationDialogConfirm btn btn-sm btn-primary">OK</a>
</dialog>

<!-- Javascript files-->
<script src="<?=base_url()?>assets/dicom/vendor/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="<?=base_url()?>assets/dicom/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/dicom/vendor/jquery.cookie/jquery.cookie.js"></script>
<script src="<?=base_url()?>assets/dicom/js/front.js"></script>
<script src="<?=base_url()?>assets/cornerstone/hammer.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/cornerstone/cornerstone.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/cornerstone/cornerstoneMath.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/cornerstone/cornerstoneTools.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/cornerstone/dicomParser.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/cornerstone/charLS-FixedMemory-browser.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/cornerstone/pako.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/cornerstone/openJPEG-FixedMemory.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/cornerstone/cornerstoneWADOImageLoader.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/cornerstone/uids.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/cornerstone/dialogPolyfill.js" type="text/javascript"></script>
<!--<script src="--><?//=base_url()?><!--assets/dicom/js/fakeLoader.min.js"></script>-->
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
<script>

    let element = $('#dicomImage').get(0);
    let config = {
        minScale: 0.25,
        maxScale: 20.0,
        preventZoomOutsideImage: true,
        getTextCallback: getTextCallback,
        changeTextCallback: changeTextCallback,
        drawHandles: false,
        drawHandlesOnHover: true,
        arrowFirst: true
    }
    var annotationDialog = document.querySelector('.annotationDialog');
    dialogPolyfill.registerDialog(annotationDialog);
    //cornerstoneTools.zoom.setConfiguration(config);
    cornerstoneTools.mouseInput.disable(element);
    cornerstoneTools.mouseWheelInput.disable(element);
    cornerstoneTools.zoom.deactivate(element, 4);

    function getTextCallback(doneChangingTextCallback) {
        var annotationDialog = $('.annotationDialog');
        var getTextInput = annotationDialog.find('.annotationTextInput');
        var confirm = annotationDialog.find('.annotationDialogConfirm');

        annotationDialog.get(0).showModal();

        confirm.off('click');
        confirm.on('click', function () {
            closeHandler();
        });

        annotationDialog.off("keydown");
        annotationDialog.on('keydown', keyPressHandler);

        function keyPressHandler(e) {
            // If Enter is pressed, close the dialog
            if (e.which === 13) {
                closeHandler();
            }
        }

        function closeHandler() {
            annotationDialog.get(0).close();
            doneChangingTextCallback(getTextInput.val());
            // Reset the text value
            getTextInput.val("");
        }
    }
    function changeTextCallback(data, eventData, doneChangingTextCallback) {
        var relabelDialog = $('.relabelDialog');
        var getTextInput = relabelDialog.find('.annotationTextInput');
        var confirm = relabelDialog.find('.relabelConfirm');
        var remove = relabelDialog.find('.relabelRemove');
        getTextInput.val(data.annotationText);
        relabelDialog.get(0).showModal();
        confirm.off('click');
        confirm.on('click', function () {
            relabelDialog.get(0).close();
            doneChangingTextCallback(data, getTextInput.val());
        });
        // If the remove button is clicked, delete this marker
        remove.off('click');
        remove.on('click', function () {
            relabelDialog.get(0).close();
            doneChangingTextCallback(data, undefined, true);
        });

        relabelDialog.off("keydown");
        relabelDialog.on('keydown', keyPressHandler);

        function keyPressHandler(e) {
            // If Enter is pressed, close the dialog
            if (e.which === 13) {
                closeHandler();
            }
        }

        function closeHandler() {
            relabelDialog.get(0).close();
            doneChangingTextCallback(data, getTextInput.val());
            // Reset the text value
            getTextInput.val("");
        }

    }

    function onViewportUpdated(e) {
        var viewport = cornerstone.getViewport(e.target);
        //$('#mrbottomleft').text("WW/WC: " + Math.round(viewport.voi.windowWidth) + "/" + Math.round(viewport.voi.windowCenter));
        //$('#mrbottomright').text("Zoom: " + viewport.scale.toFixed(2));

        var stackToolDataSource = cornerstoneTools.getToolState(e.target, 'stack');
        if (stackToolDataSource === undefined) {
            return;
        }
        var stackData = stackToolDataSource.data[0];
        //console.log(stackData.currentImageIdIndex);
        var ImageIdIndex = stackData.currentImageIdIndex + 1;
        var stack_length = stackData.imageIds.length;
//            if (stackData.currentImageIdIndex < 1) newImageIdIndex = stackData.imageIds.length - 1;
//            else newImageIdIndex = stackData.currentImageIdIndex - 1;
//            cornerstone.loadAndCacheImage(stackData.imageIds[newImageIdIndex]).then(function(image) {
//                var viewport = cornerstone.getViewport(targetElement);
//                stackData.currentImageIdIndex = newImageIdIndex;
//                cornerstone.displayImage(targetElement, image, viewport);
//            });

        $(e.target).children('#mrbottomleft').text("WW/WC: " + Math.round(viewport.voi.windowWidth) + "/" + Math.round(viewport.voi.windowCenter));
        $(e.target).children('#mrbottomright').text("Zoom: " + viewport.scale.toFixed(2));
        //$(e.target).children('#mrtopright').text("ImgNum[" + ImageIdIndex + "/" + stack_length + "]");
    }
    function onImageNumUpdated(e) {
        var stackToolDataSource = cornerstoneTools.getToolState(e.target, 'stack');
        if (stackToolDataSource === undefined) {
            return;
        }
        var stackData = stackToolDataSource.data[0];
        //console.log(stackData.currentImageIdIndex);
        var ImageIdIndex = stackData.currentImageIdIndex + 1;
        var stack_length = stackData.imageIds.length;
        $(e.target).children('#mrtopright').text("ImgNum[" + ImageIdIndex + "/" + stack_length + "]");
        $(e.target).children('#mrtopleft_PatName').text("PatName: " + "<?=$booking_data->patient_name?>");
        $(e.target).children('#mrtopleft_PatNum').text("PatID: " + "<?=$booking_data->image_num?>");
        $(e.target).children('#mrtopleft_PatAge').text("Age: " + "<?=$booking_data->patient_age?>");
        $(e.target).children('#mrtopleft_PatSex').text("Sex: " + "<?=$booking_data->patient_gender?'F':'M'?>");
        $(e.target).children('#mrtopright_hospital').text("<?=$booking_data->hospital_name?>");
        $(e.target).children('#mrtopright_checktime').text("<?=$booking_data->checked_time?>");
    }
    $(element).on("CornerstoneImageRendered", onViewportUpdated);
    $(element).on("CornerstoneNewImage", onImageNumUpdated);


    $(function () {
//        $(".fakeLoader").fakeLoader({
//            timeToHide:3200,
//            bgColor:"#34495e",
//            spinner:"spinner2"
//        });

        $('.returnBack').click(function () {
            window.history.back();

        });

        $('#report_make').click(function () {
            var booking_id = $('#bookingID').val();
            //console.log("booking_id : " + booking_id);
            var base_url = '<?= base_url()?>';
            var strURL = base_url + "report/reporting/" + booking_id;
            var win = window.open(strURL, '_blank');
            win.focus();

        });
        $("input[name='chk_info']").change(function(){
            if($(this).is(":checked")){
                $('#mrbottomleft').show();
                $('#mrbottomright').show();
                $('#mrtopright').show();
                $('#mrtopleft_PatName').show();
                $('#mrtopleft_PatNum').show();
                $('#mrtopleft_PatAge').show();
                $('#mrtopleft_PatSex').show();
                $('#mrtopright_hospital').show();
                $('#mrtopright_checktime').show();
                $('.pat_info').show();
            }else{
                $('.pat_info').hide();
                $('#mrbottomleft').hide();
                $('#mrbottomright').hide();
                $('#mrtopright').hide();
                $('#mrtopleft_PatName').hide();
                $('#mrtopleft_PatNum').hide();
                $('#mrtopleft_PatAge').hide();
                $('#mrtopleft_PatSex').hide();
                $('#mrtopright_hospital').hide();
                $('#mrtopright_checktime').hide();
            }
        });

        $('#dicomImage').css({
            "width": $('#oneOneScreen').width(),
            "height": $('#oneOneScreen').width()
        });
        $('#DicomListView').css({
            "height": $('#dicomImageview').width()*1.1
        });
        cornerstone.enable(element);
        //DicomViewList();
        //downloadAndView();

    });

    cornerstoneWADOImageLoader.external.cornerstone = cornerstone;
    cornerstoneWADOImageLoader.configure({
        beforeSend: function (xhr) {}
    })
    let loaded = false;

    function loadViewDicomUrl2(target_element, url) {

        //var url = localStorage.getItem('currentUrl');
        // prefix the url with wadouri: so cornerstone can find the image loader
        //let imageId = "wadouri:" + url;
        let imageId = url;
        // image enable the dicomImage element and activate a few tools
        try {
            cornerstone.loadAndCacheImage(imageId).then(function (image) {
                var viewport = cornerstone.getDefaultViewportForImage(target_element, image);
                cornerstone.displayImage(target_element, image, viewport);
//                    if (loaded === false) {
                cornerstoneTools.mouseInput.enable(target_element);
                cornerstoneTools.mouseWheelInput.enable(target_element);
                cornerstoneTools.wwwc.activate(target_element, 1); // ww/wc is the default tool for left mouse button
                cornerstoneTools.pan.activate(target_element, 2); // pan is the default tool for middle mouse button
                cornerstoneTools.zoom.activate(target_element, 4); // zoom is the default tool for right mouse button
                //cornerstoneTools.zoomWheel.activate(element); // zoom is the default tool for middle mouse wheel
                cornerstoneTools.probe.enable(target_element);
                cornerstoneTools.length.enable(target_element);
                cornerstoneTools.ellipticalRoi.enable(target_element);
                cornerstoneTools.rectangleRoi.enable(target_element);
                cornerstoneTools.angle.enable(target_element);
                cornerstoneTools.highlight.enable(target_element);
                cornerstoneTools.magnify.enable(target_element);
                cornerstoneTools.magnifyTouchDrag.enable(target_element);
                //cornerstoneTools.simpleAngleTouch.activate(target_element);
                //cornerstoneTools.touchInput.enable(target_element);
//                        loaded = true;
//                    }
                // helper function used by the tool button handlers to disable the active tool
                // before making a new tool active
                function disableAllTools() {
                    $('#pauseBtn').trigger('click');
                    cornerstoneTools.wwwc.disable(target_element);
                    cornerstoneTools.pan.activate(target_element, 2); // 2 is middle mouse button
                    cornerstoneTools.zoom.activate(target_element, 4); // 4 is right mouse button
                    cornerstoneTools.probe.deactivate(target_element, 1);
                    cornerstoneTools.length.deactivate(target_element, 1);
                    cornerstoneTools.ellipticalRoi.deactivate(target_element, 1);
                    cornerstoneTools.rectangleRoi.deactivate(target_element, 1);
                    cornerstoneTools.magnify.disable(target_element);
                    cornerstoneTools.magnifyTouchDrag.disable(target_element);
                    //cornerstoneTools.angle.deactivate(target_element, 1);
                    cornerstoneTools.simpleAngle.deactivate(target_element, 1);
                    cornerstoneTools.simpleAngleTouch.deactivate(target_element, 1);
                    cornerstoneTools.highlight.deactivate(target_element, 1);
                    cornerstoneTools.freehand.deactivate(target_element, 1);
                    cornerstoneTools.freehand.deactivate(target_element, 1);
                    cornerstoneTools.rotate.disable(target_element);
                    cornerstoneTools.rotateTouchDrag.disable(target_element);
                    //cornerstoneTools.arrowAnnotate.disable(target_element);
                    //cornerstoneTools.arrowAnnotateTouch.disable(target_element);
                    cornerstoneTools.arrowAnnotate.deactivate(target_element, 1);
                    cornerstoneTools.arrowAnnotateTouch.deactivate(target_element);

                }

                // Tool button event handlers that set the new active tool
                $('#hFlip').click(function (e) {

                    viewport = cornerstone.getViewport(target_element);
                    viewport.hflip = !viewport.hflip;
                    cornerstone.setViewport(target_element, viewport);
                    var elementDiv = $(target_element);
                    var rightMid = elementDiv.find('.mrrightmiddle .orientationMarker');
                    var leftMid = elementDiv.find('.mrleftmiddle .orientationMarker');
                    var temp = rightMid.text();
                    rightMid.text(leftMid.text());
                    leftMid.text(temp);
                });

                $('#invert').click(function() {

                    var viewport = cornerstone.getViewport(target_element);
                    if (viewport.invert === true) {
                        viewport.invert = false;
                    } else {
                        viewport.invert = true;
                    }
                    cornerstone.setViewport(target_element, viewport);

                    return false;
                });

                $('#vFlip').click(function (e) {

                    viewport = cornerstone.getViewport(target_element);
                    viewport.vflip = !viewport.vflip;
                    cornerstone.setViewport(target_element, viewport);
                    var elementDiv = $(target_element);
                    var topMid = elementDiv.find('.mrtopmiddle .orientationMarker');
                    var bottomMid = elementDiv.find('.mrbottommiddle .orientationMarker');
                    var temp = topMid.text();
                    topMid.text(bottomMid.text());
                    bottomMid.text(temp);
                });

                $('#lRotate').click(function (e) {

                    viewport = cornerstone.getViewport(target_element);
                    viewport.rotation -=90;
                    cornerstone.setViewport(target_element, viewport);
                });

                $('#rRotate').click(function (e) {

                    viewport = cornerstone.getViewport(target_element);
                    viewport.rotation +=90;
                    cornerstone.setViewport(target_element, viewport);
                });

                // Tool button event handlers that set the new active tool
                $('.enableWindowLevelTool').click(function () {

                    disableAllTools();
                    cornerstoneTools.wwwc.activate(target_element, 1);
                });
                $('.pan').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                    cornerstoneTools.pan.activate(target_element, 3); // 3 means left mouse button and middle mouse button
                });
                $('.clearToolData').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    var toolStateManager = cornerstoneTools.getElementToolStateManager(target_element);
                    //console.log($(target_element).attr("id"));
                    // Note that this only works on ImageId-specific tool state managers (for now)
                    //toolStateManager.clear(target_element);
                    cornerstoneTools.clearToolState(target_element, "length");
                    //cornerstoneTools.clearToolState(target_element, "angle");
                    cornerstoneTools.clearToolState(target_element, "simpleAngle");
                    cornerstoneTools.clearToolState(target_element, "probe");
                    cornerstoneTools.clearToolState(target_element, "rectangleRoi");
                    cornerstoneTools.clearToolState(target_element, "ellipticalRoi");
                    cornerstoneTools.clearToolState(target_element, "arrowAnnotate");
                    cornerstoneTools.clearToolState(target_element, "highlight");
                    cornerstone.updateImage(target_element);

                });
                $('.magnify').click(function () {

                    disableAllTools();

                    var config = {
                        magnifySize: parseInt(350, 10),
                        magnificationLevel: parseInt(5, 10)
                    };
                    cornerstoneTools.magnify.setConfiguration(config);
                    cornerstoneTools.magnify.activate(target_element, 1);
                    cornerstoneTools.magnifyTouchDrag.activate(target_element);
                    return false;
                });
                $('.zoom').click(function () {

                    disableAllTools();
                    cornerstoneTools.zoom.activate(target_element, 5); // 5 means left mouse button and right mouse button
                });
                $('.enableLength').click(function () {

                    disableAllTools();
                    cornerstoneTools.length.activate(target_element, 1);
                });
                $('.probe').click(function () {

                    disableAllTools();
                    cornerstoneTools.probe.activate(target_element, 1);
                });
                $('.circleroi').click(function () {

                    disableAllTools();
                    cornerstoneTools.ellipticalRoi.activate(target_element, 1);
                });
                $('.rectangleroi').click(function () {

                    disableAllTools();
                    cornerstoneTools.rectangleRoi.activate(target_element, 1);
                });
                $('.angle').click(function () {

                    disableAllTools();
                    //cornerstoneTools.angle.activate(target_element, 1);
                    cornerstoneTools.simpleAngle.activate(target_element, 1);
                    //cornerstoneTools.simpleAngleTouch.activate(target_element);
                });
                $('.select_open').click(function () {

                    disableAllTools();
                });
                $('.highlight').click(function () {

                    disableAllTools();
                    cornerstoneTools.highlight.activate(target_element, 1);
                });

                $('#save').click(function() {

                    $("#length_tools").hide();
                    var filename = 'download.png';
                    cornerstoneTools.saveAs(target_element, filename);
                    return false;
                });
                $('.freehand').click(function () {

                    disableAllTools();
                    cornerstoneTools.freehand.activate(target_element, 1);
                });
                $('.rotate').click(function () {

                    $("#length_tools").hide();
                    disableAllTools();
                    cornerstoneTools.rotate.activate(target_element, 1);
                    cornerstoneTools.rotateTouchDrag.activate(target_element);
                    return false;
                });
                $('.annotation').click(function () {

                    disableAllTools();
                    cornerstoneTools.arrowAnnotate.setConfiguration(config);
                    cornerstoneTools.arrowAnnotate.activate(target_element, 1);
                    cornerstoneTools.arrowAnnotateTouch.activate(target_element);
                })

            }, function (err) {
                alert(err);
            });
        } catch (err) {
            alert(err);
        }
    }

    function sel_div(target)
    {
        //console.log("test click");
        $(target).css('border', '2px solid #337ab7');
        $(target).siblings().css('border', '1px solid #474b52');
    }

    function drag(target, event) {
        var tagKind = $(target).prop("tagName").toLowerCase();
        if (tagKind == "div"){
            event.dataTransfer.setData('Text', $(target).attr("data-src"));
        }
        if (tagKind == "img"){
            event.dataTransfer.setData('Text', $(target).attr("src"));
        }

    }

    function drop(target, event) {
        var src = event.dataTransfer.getData('Text');
        //console.log("drop_src = " + src);
        $(target).attr("data-src", src);
        dicomDetialView2(target, src);
//            if (src.indexOf('image/jpeg') != -1) {
//                src = src.replace('image/jpeg', 'application/dicom');
//                loadViewDicomUrl2(target, src);
//                event.preventDefault();
//            }

    }

    function drop2(target, event) {
        var src = event.dataTransfer.getData('Text');
        //console.log("drop2_src = " + src);
        //console.log("siblings num = " + $(target).siblings().length);
        //$(target).attr("data-src", src);
        var siblings_num = $(target).siblings().length + 1;
        for (var i=0; i < siblings_num ; i++)
        {
            var sub_wnd = $(target).parent().children().eq(i).get(0);
            //console.log($(target).parent().attr("class"));
            //console.log($(sub_wnd).attr("class"));
            dicomDetialView2(sub_wnd, src);
        }
    }

    function DicomViewList() {
        let DicomViewList = $('#DicomListView');
        let seriesData = JSON.parse(localStorage.getItem('seriesData'));
        var showContent = '';
        for (var index in seriesData) {
            let dicomwadourl = dicomBaseSearchUrl + '?operation=wado&studyUID=' + seriesData[index].studyUID +
                '&seriesUID=' + seriesData[index].seriesUID +'&objectUID=' + seriesData[index].objectUID + '&contentType=image/jpeg';
            let dicomUrlParam = "'" + dicomBaseSearchUrl + '?operation=wado&studyUID=' + seriesData[index].studyUID +'&seriesUID=' +seriesData[index].seriesUID +'&objectUID=' + seriesData[index].objectUID + '&contentType=application/dicom' + "'";
            showContent += '<div class="messages-block block">' +
                '<div class="messages" data-src="' + dicomwadourl + '" draggable="true" ondragstart="drag(this, event)">' +
                '<a href="#" class="message d-flex align-items-center" onclick="dicomDetialView(' + dicomUrlParam + ')">' +
                '<div class="profile">' +
                '<img src="' + dicomwadourl + '" alt="..." class="img-fluid" draggable="true" ondragstart="drag(this, event)"> ' +
                '<div class="status online"></div>' +
                '</div>' +
                '<div class="content" data-src="' + dicomwadourl + '" draggable="true" ondragstart="drag(this, event)">' +
                '<strong class="d-block">'+localStorage.getItem('patient_name')+'</strong>' +
                '<span class="d-block">'+localStorage.getItem('hospitalName')+'</span>' +
                '<small class="date d-block">'+localStorage.getItem('checked_time')+'</small>' +
                '</div>' +
                '</a>' +
                '</div>' +
                '</div>';
        }
        DicomViewList.html(showContent)
    }

    function dicomDetialView(param) {
        localStorage.setItem('vr_cur', param);

        {
            //targetElement = $('#dicomImage').get(0);
            //console.log("dicomDetialView ----" + param);
            localStorage.setItem('current_1', param);
            //loaded = false;
            //downloadAndView();
            var imageIIds = [];

            var seriesData1 = JSON.parse(localStorage.getItem(param));
            for (var index in seriesData1) {
                var dicomUrlParam = dicomBaseSearchUrl + '?operation=wado&studyUID=' + seriesData1[index].studyUID + '&seriesUID=' +
                    seriesData1[index].seriesUID + '&objectUID=' + seriesData1[index].objectUID + '&contentType=application/dicom';
                var url1 = "wadouri:" + dicomUrlParam;
                //console.log(dicomUrlParam);
                imageIIds.push(url1);
            }

            var url = imageIIds[0];
            //url = "wadouri:" + url;
            //console.log(url);
            //loadAndViewImage(url);
            loadViewDicomUrl2(element, url);

            var stack1 = {
                currentImageIdIndex : 0,
                imageIds: imageIIds
            };

            cornerstoneTools.addStackStateManager(element, ['stack', 'playClip']);
            cornerstoneTools.addToolState(element, 'stack', stack1);

            cornerstoneTools.touchInput.enable(element);
            cornerstoneTools.stackScrollTouchDrag.activate(element);
        }
        closeNav();
    }

    function dicomDetialView2(target, param) {

        //console.log("dicomDetialView2 ----" + param);

        var imageIIds = [];
        var seriesData1 = JSON.parse(localStorage.getItem(param));
        //console.log("seriesData1 = " + seriesData1);
        for (var index in seriesData1) {
            var dicomUrlParam = dicomBaseSearchUrl + '?operation=wado&studyUID=' + seriesData1[index].studyUID + '&seriesUID=' +
                seriesData1[index].seriesUID + '&objectUID=' + seriesData1[index].objectUID + '&contentType=application/dicom';
            var url1 = "wadouri:" + dicomUrlParam;
            //console.log(dicomUrlParam);
            imageIIds.push(url1);
        }

        var url = imageIIds[0];
        //url = "wadouri:" + url;
        //console.log("imageIIds[0] = " + url);
        loadViewDicomUrl2(target, url);

        var stack1 = {
            currentImageIdIndex : 0,
            imageIds: imageIIds
        };
        //cornerstoneTools.mouseInput.enable(target);
        //cornerstoneTools.mouseWheelInput.enable(target);
        cornerstoneTools.addStackStateManager(target, ['stack', 'playClip']);
        cornerstoneTools.addToolState(target, 'stack', stack1);
        //cornerstoneTools.stackScroll.activate(target, 1);
        cornerstoneTools.stackScrollWheel.activate(target);
        //cornerstoneTools.scrollIndicator.enable(target);
        cornerstoneTools.zoomWheel.deactivate(target);
        cornerstoneTools.zoom.activate(element, 4); // zoom is the default tool for right mouse button
    }

</script>
<input id="imageID" type="hidden" value="<?=$booking_data->image_num?>">
<input id="bookingID" type="hidden" value="<?=$booking_data->booking_id?>">
<script>

    var dicomBaseSearchUrl = '<?=get_dicom_get_url()?>';
    //var modal = $('#responsive');
    var tmpxmlData = [];
    class DicomSearch {
        constructor(BaseUrl) {
            this.BaseUrl = BaseUrl;
        }
        searchDicomByPatId(patId) {
            var uri = this.BaseUrl + '?operation=cfind&patId=' + patId;
            var buffer = this;
            $.ajax({
                type: "GET",
                url: uri,
                dataType: "xml"
            }).done(function (xml, textStatus, jqXHR) {
                buffer.parseXmlCFind(xml);
            }).always(function () {
            });
        }
        parseXmlCFind(xml) {
            var gwInstance = this;
            //var studyList = $("#studyList");
            var lastPatId = '!';
            var ListData = '';
            $(xml).find("response").sort(function (a, b) {
                // Ordering (I): Patient identifier, as alphanumeric data
                var patIdA = $(a).find("attr[tag=00100020]").text();
                var patIdB = $(b).find("attr[tag=00100020]").text();
                if (patIdA == patIdB) {
                    var studyDateA = $(a).find("attr[tag=00080020]").text();
                    var studyDateB = $(b).find("attr[tag=00080020]").text();
                    // Ordering (II): Study date (more recent come first)
                    return studyDateA < studyDateB ? 1 : -1;
                } else {
                    return patIdA < patIdB ? -1 : 1; // Lower patient id comes first
                };
            }).each(function () {
                var studyData = gwInstance.getStudyData($(this));
                var patSex = studyData["patSex"];
                var sexClass = ' ';
                switch (patSex) {
                    case ('M'):
                        sexClass = 'male';
                        break;
                    case ('F'):
                        sexClass = 'female';
                        break;
                    default:
                        sexclass = '';
                }
                var studyUID = studyData["studyUID"];
                var uri = gwInstance.BaseUrl + "?operation=cfind&studyUID=" + studyUID;
                $.ajax({
                    type: "GET",
                    url: uri,
                    dataType: "xml"
                }).done(function (xml, textStatus, jqXHR) {
                    //$(listToggleContianer).unbind();
                    //console.log(xml);
                    gwInstance.parseXmlStudy(xml);

                }).always(function () {
                    //gwInstance.hideLoading();
                });
            });
        }
        parseXmlStudy(xml) {
            //console.log('tmp is not scale', listToggleContianertmp);
            var gwInstance = this; //  studyID에 의  한
            //var studyDataList = '';
            var series_list = '';
            var nFirstCount = 0;
            var First_Series = '';
            $(xml).find("response").sort(function (a, b) {
                // Se ordena por "Series Number"
                var seriesNumA = Number($(a).find("attr[tag=00200011]").text());
                var seriesNumB = Number($(b).find("attr[tag=00200011]").text());
                return seriesNumA < seriesNumB ? -1 : 1; // Lower numbers come first
            }).each(function () {
                var respNumber = $(this).attr('number');
                var numInstances = $(xml).find("qresponse[qrequest=" + respNumber + "]").length;
                // 20120120: Get series information
                var seriesData = gwInstance.getSeriesData($(this));
                seriesData.numInstances = numInstances;
                var seriesUID = seriesData["seriesUID"]
                var liData = '';
                liData += "" + seriesData["modality"] + " [ " + numInstances + " ]";
                //liData += " - " + seriesData["seriesDescr"];
                //liData += '';
                //studyDataList += "<option value='"+respNumber+"--"+seriesUID+"'>"+liData+"</option>";
                var seriesUID_Str = respNumber+"--"+seriesUID;
                if (nFirstCount == 0) First_Series = seriesUID_Str;
                nFirstCount ++ ;


                var seriesDataArray = [];
                $(xml).find("qresponse[qrequest=" + respNumber + "]").sort(function (a, b) {
                    // Se ordena por "Instance Number"
                    var instanceNumA = Number($(a).find("attr[tag=00200013]").text());
                    var instanceNumB = Number($(b).find("attr[tag=00200013]").text());
                    return instanceNumA < instanceNumB ? -1 : 1; // Primero las instancias con menor num
                }).each(function () {
                    var instanceNum = Number($(this).find("attr[tag=00200013]").text());
                    //console.log("instanceNum: " + instanceNum);
                    //0020000D : Study Instance UID
                    var studyUID = $(this).find("attr[tag=0020000D]").text();
                    // 0020000E : Series Instance UID
                    var seriesUID = $(this).find("attr[tag=0020000E]").text();
                    // 00080018 : SOP Instance UID
                    var objectUID = $(this).find("attr[tag=00080018]").text();
                    var addData = {
                        studyUID: studyUID,
                        seriesUID: seriesUID,
                        objectUID: objectUID
                    }
                    seriesDataArray.push(addData);
                    // add the full instance data / raw xml ???

                });
                localStorage.setItem(seriesUID_Str, JSON.stringify(seriesDataArray));
                var seriesUID_Str1 = "'"+seriesUID_Str+"'";

                var dicomwadourl = dicomBaseSearchUrl + '?operation=wado&studyUID=' + seriesDataArray[0].studyUID +
                    '&seriesUID=' + seriesDataArray[0].seriesUID +'&objectUID=' + seriesDataArray[0].objectUID + '&contentType=image/jpeg';
                var dicomUrlParam = '';
                series_list += '<div class="messages-block block"  onclick="sel_div(this)">' +
                    '<div class="messages" data-src="' + seriesUID_Str + '" draggable="true" ondragstart="drag(this, event)">' +
                    '<a href="#" class="message d-flex align-items-center" onclick="dicomDetialView(' + seriesUID_Str1 + ')">' +
                    '<div class="profile">' +
                    '<img src="' + dicomwadourl + '" alt="..." class="img-fluid" draggable="true" ondragstart="drag(this, event)"> ' +
                    '<div class="status online"></div>' +
                    '</div>' +
                    '<div class="content" data-src="' + seriesUID_Str + '" draggable="true" ondragstart="drag(this, event)">' +
                    '<strong class="d-block">'+ liData +'</strong>' +
                    '<span class="d-block">'+ '</span>' +
                    '<small class="date d-block">' + '</small>' +
                    '</div>' +
                    '</a>' +
                    '</div>' +
                    '</div>';
            });
            //console.log(xml);
//                $('#check_device').append(studyDataList);
            $('#DicomListView').append(series_list);
            dicomDetialView(First_Series);
//                $("#check_device").change(function () {
//                    //console.log($(this).val());
//                    var strTemp = $(this).val();
//                    var strArray = strTemp.split('--');
//                    var seriesData = [];
//                    var seriesUID = strArray[1];
//                    var respNumber = strArray[0];
//                    var numInstances = $(xml).find("qresponse[qrequest=" + respNumber + "]").length;
//                    $(xml).find("qresponse[qrequest=" + respNumber + "]").sort(function (a, b) {
//                        // Se ordena por "Instance Number"
//                        var instanceNumA = Number($(a).find("attr[tag=00200013]").text());
//                        var instanceNumB = Number($(b).find("attr[tag=00200013]").text());
//                        return instanceNumA < instanceNumB ? -1 : 1; // Primero las instancias con menor num
//                    }).each(function () {
//                        var instanceNum = Number($(this).find("attr[tag=00200013]").text());
//                        //console.log("instanceNum: " + instanceNum);
//                        //0020000D : Study Instance UID
//                        var studyUID = $(this).find("attr[tag=0020000D]").text();
//                        // 0020000E : Series Instance UID
//                        var seriesUID = $(this).find("attr[tag=0020000E]").text();
//                        // 00080018 : SOP Instance UID
//                        var objectUID = $(this).find("attr[tag=00080018]").text();
//                        var addData = {
//                            studyUID: studyUID,
//                            seriesUID: seriesUID,
//                            objectUID: objectUID
//                        }
//                        seriesData.push(addData);
//                        // add the full instance data / raw xml ???
//                    });
//                    gwInstance.showDicomList(seriesData);
//                });
        }
        showDicomList(seriesData) {
            localStorage.setItem('seriesData', JSON.stringify(seriesData));

            var dicomUrlParam = this.BaseUrl + '?operation=wado&studyUID=' + seriesData[0].studyUID + '&seriesUID=' +
                seriesData[0].seriesUID +
                '&objectUID=' + seriesData[0].objectUID + '&contentType=application/dicom';
            //console.log(dicomUrlParam);
            dicomDetialView(dicomUrlParam);
            DicomViewList();
            //downloadAndView();

            var imageIIds = [];

            var seriesData1 = JSON.parse(localStorage.getItem('seriesData'));
            for (var index in seriesData1) {
                var dicomUrlParam = dicomBaseSearchUrl + '?operation=wado&studyUID=' + seriesData1[index].studyUID + '&seriesUID=' +
                    seriesData1[index].seriesUID + '&objectUID=' + seriesData1[index].objectUID + '&contentType=application/dicom';
                var url1 = "wadouri:" + dicomUrlParam;
                //console.log(dicomUrlParam);
                imageIIds.push(url1);
            }

            var stack1 = {
                currentImageIdIndex : 0,
                imageIds: imageIIds
            };
            cornerstoneTools.mouseInput.enable(element);
            cornerstoneTools.mouseWheelInput.enable(element);
            cornerstoneTools.addStackStateManager(element, ['stack', 'playClip']);
            cornerstoneTools.addToolState(element, 'stack', stack1);
            cornerstoneTools.stackScroll.activate(element, 1);
            cornerstoneTools.stackScrollWheel.activate(element);
            cornerstoneTools.scrollIndicator.enable(element);
            cornerstoneTools.zoomWheel.deactivate(element);
        }
        getStudyData(xml) {
            var study = {};
            // 00100020 : Patient ID
            study["patId"] = $(xml).find("attr[tag=00100020]").text();
            // 00100010 : Patient's Name
            study["patName"] = $(xml).find("attr[tag=00100010]").text();
            // 00100030 : Patient's Birth Date
            study["patBDate"] = $(xml).find("attr[tag=00100030]").text();
            study["patBDate"] = this.convertDate(study["patBDate"]);
            // 00100040 : Patient's Sex
            study["patSex"] = $(xml).find("attr[tag=00100040]").text();
            // 00080020 : Study Date
            study["studyDate"] = $(xml).find("attr[tag=00080020]").text();
            study["studyDate"] = this.convertDate(study["studyDate"]);
            // 00080061 : Modalities in Study
            study["studyMods"] = $(xml).find("attr[tag=00080061]").text();
            // 00081030 : Study Description
            study["studyDescr"] = $(xml).find("attr[tag=00081030]").text();
            // 00201206 : Number of Study Related Series
            study["studyNumSeries"] = $(xml).find("attr[tag=00201206]").text();
            // 0020000D : Study Instance UID
            study["studyUID"] = $(xml).find("attr[tag=0020000D]").text();
            console.log('this is stuty data....', study);
            return study;
        }
        convertDate(date8) {
            var year = date8.substring(0, 4);
            var month = date8.substring(4, 6);
            var day = date8.substring(6, 8);
            var date10 = year + '-' + month + '-' + day;
            return date10;
        }
        getSeriesData(xml) {
            var series = {};
            // 00200011 : Series Number
            series["seriesNumber"] = $(xml).find("attr[tag=00200011]").text();
            // 00080060 : Modality
            series["modality"] = $(xml).find("attr[tag=00080060]").text();
            // 0008103E : Series Description
            series["seriesDescr"] = $(xml).find("attr[tag=0008103E]").text();
            // 0020000E : Series Instance UID
            series["seriesUID"] = $(xml).find("attr[tag=0020000E]").text();
            // console.log(series);
            return series;
        }
    }
    $(function () {
        var imageID = $('#imageID').val();
        var DCMSearchnew = new DicomSearch(dicomBaseSearchUrl);
        DCMSearchnew.searchDicomByPatId(imageID);
        localStorage.setItem('patient_name', '<?=$booking_data->patient_name?>');
        localStorage.setItem('checked_time', '<?=$booking_data->checked_time?>');
        localStorage.setItem('hospitalName', '<?=$booking_data->hospital_name?>');

    });
</script>

<script>
    var width = 100,
        perfData = window.performance.timing, // The PerformanceTiming interface represents timing-related performance information for the given page.
        EstimatedTime = -(perfData.loadEventEnd - perfData.navigationStart),
        time = parseInt((EstimatedTime/1000)%60)*100;
    //console.log("Time : " + time);

    // Loadbar Animation
    $(".loadbar").animate({
        width: width + "%"
    }, time);

    // Loadbar Glow Animation
    $(".glow").animate({
        width: width + "%"
    }, time);

    // Percentage Increment Animation
    var PercentageID = $("#precent"),
        start = 0,
        end = 100,
        durataion = time;
    animateValue(PercentageID, start, end, durataion);

    function animateValue(id, start, end, duration) {

        var range = end - start,
            current = start,
            increment = end > start? 1 : -1,
            stepTime = Math.abs(Math.floor(duration / range)),
            obj = $(id);

        var timer = setInterval(function() {
            current += increment;
            $(obj).text(current + "%");
            //console.log(current);
            //obj.innerHTML = current;
            if (current == end) {
                clearInterval(timer);
            }
        }, stepTime);
    }

    // Fading Out Loadbar on Finised
    setTimeout(function(){
        $('.preloader-wrap').fadeOut(300);

    }, time);

</script>

</body>

</html>
