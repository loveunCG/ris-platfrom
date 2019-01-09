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

        .magnifyTool {
            border: 4px white solid;
            box-shadow: 2px 2px 10px #1e1e1e;
            border-radius: 50%;
            display: none;
            cursor: none;
        }
        /* prevents selection when left click dragging */

        .disable-selection {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        /* prevents cursor from changing to the i bar on the overlays*/

        .noIbar {
            cursor: default;
        }

        .disable-selection {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        /* prevents cursor from changing to the i bar on the overlays*/

        .noIbar {
            cursor: default;
        }

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
        #fourImage1 canvas {
            border: 1px solid #808080;
            background-color: #000000;
        }
        #fourImage2 canvas {
            border: 1px solid #808080;
            background-color: #000000;
        }
        #fourImage3 canvas {
            border: 1px solid #808080;
            background-color: #000000;
        }
        #fourImage4 canvas {
            border: 1px solid #808080;
            background-color: #000000;
        }
        #nineImage1 canvas {
            border: 1px solid #808080;
            background-color: #000000;
        }
        #nineImage2 canvas {
            border: 1px solid #808080;
            background-color: #000000;
        }
        #nineImage3 canvas {
            border: 1px solid #808080;
            background-color: #000000;
        }
        #nineImage4 canvas {
            border: 1px solid #808080;
            background-color: #000000;
        }
        #nineImage5 canvas {
            border: 1px solid #808080;
            background-color: #000000;
        }
        #nineImage6 canvas {
            border: 1px solid #808080;
            background-color: #000000;
        }
        #nineImage7 canvas {
            border: 1px solid #808080;
            background-color: #000000;
        }
        #nineImage8 canvas {
            border: 1px solid #808080;
            background-color: #000000;
        }
        #nineImage9 canvas {
            border: 1px solid #808080;
            background-color: #000000;
        }
        .iconBtnHeader {
            width: 45px;
            height: 45px;
            background-color: transparent;
            border: 0 solid transparent;
            margin: 0;
            top: 0;
            bottom: 0;
        }
        .link-menu-dropicon {
            position: absolute;
            top: 26px;
            right: 6px;
        }

    </style>
    <style>
        .bottomPopToolPanel {
            width: 400px;
            bottom: 100px;
            margin-left: -200px;
            left: 50%;
            border: 1px solid grey;
            background-color: rgba(84,83,83,.6);
            text-align: center;
            position: absolute;
            display: none;
            z-index: 310;
        }
        .viewToolBtn.panelImageBtn {
            width: 40px;
            height: 40px;
            padding: 0;
        }
        .viewToolBtn.active, .viewToolBtn:active {
            color: #fff;
            background-color: transparent;
            border-color: #dadada;
        }
        .viewToolBtn:focus, .viewToolBtn:hover {
            background-color: #2f4f4f;
            border: 0;
        }
        .viewToolBtn {
            background-color: transparent;
            color: #fff;
            padding: 2px;
            border: 0;
            margin: 3px;
            border-radius: 5px;
            width: 80px;
            height: 28px;
            font-size: 12px;
        }
        .messages-block.block {
            border: 1px solid #474b52;
        }
        /*.select {*/
        /*border: 1px solid #337ab7;*/
        /*}*/
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
                    <div class="brand-text brand-big visible text-uppercase">
                        <strong class="text-primary">DICOM</strong>
                        <strong>影像云</strong>
                    </div>
                </a>
            </div>
            <ul class="right-menu list-inline no-margin-bottom">
                <li class="list-inline-item">
                    <a href="#" id="report_make" class="nav-link">
                        <i class="fa fa-address-card-o fa-2x" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="#" class="returnBack nav-link">
                        <i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
                    </a>
                </li>

            </ul>

        </div>
    </nav>
</header>
<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    <nav id="sidebar" class="shrinked">
        <ul class="list-unstyled">
            <li>
                <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse">
                    <img src="<?=base_url()?>assets/dicom/svg/ic-layout11.svg">
                </a>
                <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li id="OneSelectScreen">
                        <a href="#" onclick="OneSelectScreen()">
                            <img src="<?=base_url()?>assets/dicom/svg/ic-layout11.svg">1x1</a>
                    </li>
                    <li id="TwoSelectScreen">
                        <a href="#" onclick="TwoSelectScreen()">
                            <img src="<?=base_url()?>assets/dicom/svg/ic-layout12.svg">1x2
                        </a>
                    </li>
                    <li id="FourSelectScreen">
                        <a href="#" onclick="FourSelectScreen()">
                            <img src="<?=base_url()?>assets/dicom/svg/ic-layout22.svg">2x2
                        </a>
                    </li>
                    <li id="NineSelectScreen">
                        <a href="#" onclick="NineSelectScreen()">
                            <img src="<?=base_url()?>assets/dicom/svg/ic-layout33.svg">3x3
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#exampledropdownDropdown1" aria-expanded="false" data-toggle="collapse">
                    <img src="<?=base_url()?>assets/dicom/svg/ic-layout22.svg">
                </a>
                <ul id="exampledropdownDropdown1" class="collapse list-unstyled ">
                    <li id="Sub_OneSelectScreen">
                        <a href="#" onclick="SubOneSelectScreen();">
                            <img src="<?=base_url()?>assets/dicom/svg/ic-layout11.svg">1x1</a>
                    </li>
                    <li id="Sub_TwoSelectScreen">
                        <a href="#" onclick="SubTwoSelectScreen();">
                            <img src="<?=base_url()?>assets/dicom/svg/ic-layout12.svg">1x2
                        </a>
                    </li>
                    <li id="Sub_FourSelectScreen">
                        <a href="#" onclick="SubFourSelectScreen();">
                            <img src="<?=base_url()?>assets/dicom/svg/ic-layout22.svg">2x2
                        </a>
                    </li>
                    <li id="Sub_NineSelectScreen">
                        <a href="#" onclick="SubNineSelectScreen();">
                            <img src="<?=base_url()?>assets/dicom/svg/ic-layout33.svg">3x3
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#repeatdropdownDropdown" aria-expanded="false" data-toggle="collapse">
                    <i class="fa fa-repeat" aria-hidden="true"></i>
                </a>
                <ul id="repeatdropdownDropdown" class="collapse list-unstyled ">
                    <li>
                        <a href="#" id="lRotate">
                            <i class="fa fa-undo" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="rRotate">
                            <i class="fa fa-repeat" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#filpdropdownDropdown" aria-expanded="false" data-toggle="collapse">
                    <img src="<?=base_url()?>assets/dicom/svg/ic_hor_mirror.svg"> </a>
                <ul id="filpdropdownDropdown" class="collapse list-unstyled ">
                    <li>
                        <a href="#" id="hFlip">
                            <img src="<?=base_url()?>assets/dicom/svg/ic_hor_mirror.svg">
                        </a>
                    </li>
                    <li>
                        <a href="#" id="vFlip">
                            <img src="<?=base_url()?>assets/dicom/svg/ic_ver_mirror.svg">
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" id="invert">
                    <img src="<?=base_url()?>assets/dicom/svg/ic-Inverse.svg">
                </a>
            </li>

            <li>
                <a href="#" id="play">
                    <img src="<?=base_url()?>assets/dicom/svg/ic-play.svg">
                </a>
            </li>
            <li>
                <a href="#" id="">
                    <input type="checkbox" name="chk_info" checked="checked" value="">&nbsp;<img src="<?=base_url()?>assets/dicom/svg/user-info1.svg" style="width:24px;height:24px;">
                </a>
            </li>

        </ul>
    </nav>
    <div class="page-content active">
        <div class="page-header">
            <div class="container-fluid">
                <ul class="right-menu list-inline no-margin-bottom">
                    <li class="list-inline-item">
                        <button type="button" id="" class="viewToolBtn panelImageBtn select_open nav-link">
                            <img src="<?=base_url()?>assets/dicom/svg/ic-select.svg">
                        </button>
                    </li>
                    <li class="list-inline-item">
                        <button type="button" id="" class="viewToolBtn panelImageBtn magnify nav-link">
                            <img src="<?=base_url()?>assets/dicom/svg/ic-zoom.svg">
                        </button>
                    </li>
                    <li class="list-inline-item">
                        <button type="button" id="" class="viewToolBtn panelImageBtn enableWindowLevelTool nav-link">
                            <img src="<?=base_url()?>assets/dicom/svg/ic-wl.svg">
                        </button>
                    </li>
                    <li class="list-inline-item">
                        <button type="button" id="" class="viewToolBtn panelImageBtn pan nav-link">
                            <img src="<?=base_url()?>assets/dicom/svg/ic-pan.svg">
                        </button>
                    </li>
                    <li class="list-inline-item">
                        <button type="button" id="" class="viewToolBtn panelImageBtn rotate nav-link">
                            <img src="<?=base_url()?>assets/dicom/svg/ic-reset.svg">
                        </button>
                    </li>

                    <li class="list-inline-item">
                        <button type="button" id="" class="viewToolBtn panelImageBtn zoom nav-link">
                            <img src="<?=base_url()?>assets/dicom/svg/icon-search-plus.svg">
                        </button>
                    </li>
                    <li class="list-inline-item">
                        <button type="button" id="" class="viewToolBtn panelImageBtn highlight nav-link">
                            <img src="<?=base_url()?>assets/dicom/svg/icon-sun.svg">
                        </button>
                    </li>
                    <!--                        <li class="list-inline-item">-->
                    <!--                            <a href="#" class="search-open nav-link">-->
                    <!--                                <img src="--><?//=base_url()?><!--assets/dicom/svg/ic-wlpreset.svg">-->
                    <!--                            </a>-->
                    <!--                        </li>-->

                    <li class="list-inline-item dropdown">
                        <button type="button" id="dropdowntools" class="viewToolBtn panelImageBtn search-open nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?=base_url()?>assets/dicom/svg/ic-length.svg">
                            <span class="link-menu-dropicon">
                                    <img src="<?=base_url()?>assets/dicom/svg/ic-dropmenu.svg" style="width:6px;height:6px">
                                </span>
                        </button>

                        <div id="length_tools" class="dropdown-menu" aria-labelledby="dropdowntools">
                            <a class="enableLength dropdown-item" href="#"><img src="<?=base_url()?>assets/dicom/svg/ic-length.svg"> 尺子</a>
                            <a class="dropdown-item angle" href="#"><img src="<?=base_url()?>assets/dicom/svg/ic-angle.svg">  角度</a>
                            <a class="dropdown-item probe" href="#"><img src="<?=base_url()?>assets/dicom/svg/ic-annovalue.svg"> 点</a>
                            <a class="dropdown-item rectangleroi" href="#"><img src="<?=base_url()?>assets/dicom/svg/ic-annorect.svg">  四角形</a>
                            <a class="dropdown-item circleroi" href="#"><img src="<?=base_url()?>assets/dicom/svg/ic-ellipse.svg"> 椭圆</a>
                            <a class="dropdown-item annotation" href="#"><img src="<?=base_url()?>assets/dicom/svg/ic-text.svg">  标题</a>
                            <a class="dropdown-item clearToolData" href="#"><img src="<?=base_url()?>assets/dicom/svg/ic-undo.svg">  撤销</a>
                        </div>
                    </li>
                    <li class="list-inline-item">
                        <button type="button" id="save" class="viewToolBtn panelImageBtn nav-link">
                            <img src="<?=base_url()?>assets/dicom/svg/ic-save.svg">
                        </button>

                    </li>
                    <li class="list-inline-item">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons" style="margin-top: 6px;">
                            <label id="active_2d" class="btn btn-secondary btn-sm">
                                <input type="radio" name="options" id="option1" value="2d" autocomplete="off" checked>
                                <img src="<?=base_url()?>assets/dicom/svg/geometry.svg" style="width: 24px;height: 24px;"> 2D
                            </label>
                            <label class="btn btn-secondary  btn-sm">
                                <input type="radio" name="options" id="option2" value="3d" autocomplete="off">
                                <img src="<?=base_url()?>assets/dicom/svg/3d.svg" style="width: 24px;height: 24px;"> 3D
                            </label>
                            <label class="btn btn-secondary  btn-sm">
                                <input type="radio" name="options" id="option3" value="mpr" autocomplete="off">
                                <img src="<?=base_url()?>assets/dicom/svg/mpr.svg" style="width: 24px;height: 24px;"> MPR
                            </label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <section class="no-padding-bottom">
            <div class="row">
                <div class="col-lg-10" style="">
                    <div class="container-fluid">
                        <iframe id='3D_win' width='100%' height='100%' seamless src='' style='overflow: hidden;display: none;'></iframe>
                        <iframe id='MPR_win' width='100%' height='100%' seamless src='' style='overflow: hidden;display: none;'></iframe>
                        <div id="oneOneScreen"  class="row" style="padding-right: 2%;" oncontextmenu="return false;" >
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
                        <div id="oneTwoScreen" class="row">
                            <div  id="compareDicomImage" class="col-lg-6 seriesBox" onclick="onDivClick(this);" oncontextmenu="return false;" ondragover="return false;" ondragenter="return false;" ondrop="drop(this, event);">
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
                            <div id="dicomImageview" class="col-lg-6 seriesBox" onclick="onDivClick(this);" oncontextmenu="return false;" ondragover="return false;" ondragenter="return false;" ondrop="drop(this, event);">
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
                        <div id="oneFourScreen" class="row">
                            <div id="fourImage1" class="col-lg-6 seriesBox" onclick="onDivClick(this);" oncontextmenu="return false;" ondragover="return false;" ondragenter="return false;" ondrop="drop(this, event);">
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
                            <div id="fourImage2" class="col-lg-6 seriesBox" onclick="onDivClick(this);" oncontextmenu="return false;" ondragover="return false;" ondragenter="return false;" ondrop="drop(this, event);">
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
                            <div  id="fourImage3" class="col-lg-6 seriesBox" onclick="onDivClick(this);" oncontextmenu="return false;" ondragover="return false;" ondragenter="return false;" ondrop="drop(this, event);">
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
                            <div id="fourImage4" class="col-lg-6 seriesBox" onclick="onDivClick(this);" oncontextmenu="return false;" ondragover="return false;" ondragenter="return false;" ondrop="drop(this, event);">
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
                        <div id="oneNineScreen" class="row">
                            <div id="nineImage1" class="col-lg-4 seriesBox" onclick="onDivClick(this);" oncontextmenu="return false;" ondragover="return false;" ondragenter="return false;" ondrop="drop(this, event);">
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
                            <div id="nineImage2" class="col-lg-4 seriesBox" onclick="onDivClick(this);" oncontextmenu="return false;" ondragover="return false;" ondragenter="return false;" ondrop="drop(this, event);">
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
                            <div id="nineImage3" class="col-lg-4 seriesBox" onclick="onDivClick(this);" oncontextmenu="return false;" ondragover="return false;" ondragenter="return false;" ondrop="drop(this, event);">
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
                            <div id="nineImage4" class="col-lg-4 seriesBox" onclick="onDivClick(this);" oncontextmenu="return false;" ondragover="return false;" ondragenter="return false;" ondrop="drop(this, event);">
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
                            <div id="nineImage5" class="col-lg-4 seriesBox" onclick="onDivClick(this);" oncontextmenu="return false;" ondragover="return false;" ondragenter="return false;" ondrop="drop(this, event);">
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
                            <div id="nineImage6" class="col-lg-4 seriesBox" onclick="onDivClick(this);" oncontextmenu="return false;" ondragover="return false;" ondragenter="return false;" ondrop="drop(this, event);">
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
                            <div id="nineImage7" class="col-lg-4 seriesBox" onclick="onDivClick(this);" oncontextmenu="return false;" ondragover="return false;" ondragenter="return false;" ondrop="drop(this, event);">
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
                            <div id="nineImage8" class="col-lg-4 seriesBox" onclick="onDivClick(this);" oncontextmenu="return false;" ondragover="return false;" ondragenter="return false;" ondrop="drop(this, event);">
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
                            <div id="nineImage9" class="col-lg-4 seriesBox" onclick="onDivClick(this);" oncontextmenu="return false;" ondragover="return false;" ondragenter="return false;" ondrop="drop(this, event);">
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
                <div class="col-lg-2" style="">
                    <div class="" id="DicomListView" style="overflow: auto;"></div>
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


<div id="playToolPc" style="width: 200px; margin-left: -200px; display: none;" class="bottomPopToolPanel unselectable ng-scope">
    <div>
        <button type="button" id="forwardBtn" onclick="forwardPlayImg()" class="viewToolBtn panelImageBtn"><img src="<?=base_url()?>assets/dicom/svg/ic-backwardPlay.svg""></button>
        <button type="button" id="playBtn" onclick="" class="viewToolBtn panelImageBtn"><img src="<?=base_url()?>assets/dicom/svg/ic-play.svg""></button>
        <button type="button" id="pauseBtn" onclick="" class="viewToolBtn panelImageBtn"><i class="fa fa-pause" aria-hidden="true"></i></button>
        <button type="button" id="backwardBtn" onclick="backwardPlayImg()" class="viewToolBtn panelImageBtn"><img src="<?=base_url()?>assets/dicom/svg/ic-forwardplay.svg""></button>
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
    var html_two =  $('#oneTwoScreen').html();
    var html_four =  $('#oneFourScreen').html();
    var html_nine =  $('#oneNineScreen').html();
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

    var bTwoSelection = false;

    function TwoSelectScreen() {
        if ($("#3D_win").css("display") != "none") return;
        if ($("#MPR_win").css("display") != "none") return;

        $('#pauseBtn').trigger('click');
        $('#oneOneScreen').hide();
        $('#oneTwoScreen').show();
        $('#oneTwoScreen').html(html_two);
        $('#oneFourScreen').hide();
        $('#oneNineScreen').hide();
        $('#3D_win').hide();
        $('#MPR_win').hide();
        $('#TwoSelectScreen').addClass('active');
        $('#OneSelectScreen').removeClass('active');
        $('#FourSelectScreen').removeClass('active');
        $('#NineSelectScreen').removeClass('active');
        $('#Sub_OneSelectScreen').removeClass('active');
        $('#Sub_TwoSelectScreen').removeClass('active');
        $('#Sub_FourSelectScreen').removeClass('active');
        $('#Sub_NineSelectScreen').removeClass('active');
        $('#compareDicomImage').css({
            "width": $('#compareDicomImage').width(),
            "height": $('#compareDicomImage').width()*1.1
        });
        $('#dicomImageview').css({
            "width": $('#dicomImageview').width(),
            "height": $('#dicomImageview').width()*1.1
        });
        if (bTwoSelection == false)
        {
            let element1 = $('#compareDicomImage').get(0);
            let element2 = $('#dicomImageview').get(0);
            cornerstone.enable(element1);
            var cur_1 = localStorage.getItem('current_1');
            if (cur_1.indexOf("--") != -1)
            {
                $(element1).attr("data-src", cur_1);
                dicomDetialView2(element1, cur_1);
            }
            cornerstone.enable(element2);
            $(element1).on("CornerstoneImageRendered", onViewportUpdated);
            $(element2).on("CornerstoneImageRendered", onViewportUpdated);
            $(element1).on("CornerstoneNewImage", onImageNumUpdated);
            $(element2).on("CornerstoneNewImage", onImageNumUpdated);
            loaded = false;
        }

    }
    var bFourSelection = false;
    function FourSelectScreen() {
        if ($("#3D_win").css("display") != "none") return;
        if ($("#MPR_win").css("display") != "none") return;
        $('#pauseBtn').trigger('click');
        $('#oneOneScreen').hide();
        $('#oneTwoScreen').hide();
        $('#oneFourScreen').show();
        $('#oneFourScreen').html(html_four);
        $('#oneNineScreen').hide();
        $('#3D_win').hide();
        $('#MPR_win').hide();
        $('#TwoSelectScreen').removeClass('active');
        $('#OneSelectScreen').removeClass('active');
        $('#FourSelectScreen').addClass('active');
        $('#NineSelectScreen').removeClass('active');
        $('#Sub_OneSelectScreen').removeClass('active');
        $('#Sub_TwoSelectScreen').removeClass('active');
        $('#Sub_FourSelectScreen').removeClass('active');
        $('#Sub_NineSelectScreen').removeClass('active');

        $('#fourImage1').css({
            "width": $('#fourImage1').width()*0.7,
            "height": $('#fourImage1').width()*0.55
        });
        $('#fourImage2').css({
            "width": $('#fourImage2').width()*0.7,
            "height": $('#fourImage2').width()*0.55
        });
        $('#fourImage3').css({
            "width": $('#fourImage3').width()*0.7,
            "height": $('#fourImage3').width()*0.55
        });
        $('#fourImage4').css({
            "width": $('#fourImage4').width()*0.7,
            "height": $('#fourImage4').width()*0.55
        });
        if (bFourSelection == false)
        {
            var element1 = $('#fourImage1').get(0);
            var element2 = $('#fourImage2').get(0);
            var element3 = $('#fourImage3').get(0);
            var element4 = $('#fourImage4').get(0);
            cornerstone.enable(element1);
            var cur_1 = localStorage.getItem('current_1');
            if (cur_1.indexOf("--") != -1)
            {
                $(element1).attr("data-src", cur_1);
                dicomDetialView2(element1, cur_1);
            }
            cornerstone.enable(element2);
            cornerstone.enable(element3);
            cornerstone.enable(element4);
            $(element1).on("CornerstoneImageRendered", onViewportUpdated);
            $(element2).on("CornerstoneImageRendered", onViewportUpdated);
            $(element3).on("CornerstoneImageRendered", onViewportUpdated);
            $(element4).on("CornerstoneImageRendered", onViewportUpdated);
            $(element1).on("CornerstoneNewImage", onImageNumUpdated);
            $(element2).on("CornerstoneNewImage", onImageNumUpdated);
            $(element3).on("CornerstoneNewImage", onImageNumUpdated);
            $(element4).on("CornerstoneNewImage", onImageNumUpdated);
            loaded = false;
//                loadViewDicomUrl(element1);
//                loadViewDicomUrl(element2);
//                loadViewDicomUrl(element3);
//                loadViewDicomUrl(element4);
            //bFourSelection = true;
        }

    }

    var bNineSelection = false;
    function NineSelectScreen() {
        if ($("#3D_win").css("display") != "none") return;
        if ($("#MPR_win").css("display") != "none") return;

        $('#pauseBtn').trigger('click');
        $('#oneOneScreen').hide();
        $('#oneTwoScreen').hide();
        $('#oneFourScreen').hide();
        $('#oneNineScreen').show();
        $('#3D_win').hide();
        $('#MPR_win').hide();
        $('#oneNineScreen').html(html_nine);
        $('#TwoSelectScreen').removeClass('active');
        $('#OneSelectScreen').removeClass('active');
        $('#FourSelectScreen').removeClass('active');
        $('#NineSelectScreen').addClass('active');
        $('#Sub_OneSelectScreen').removeClass('active');
        $('#Sub_TwoSelectScreen').removeClass('active');
        $('#Sub_FourSelectScreen').removeClass('active');
        $('#Sub_NineSelectScreen').removeClass('active');

        $('#nineImage1').css({
            "width": $('#nineImage1').width(),
            "height": $('#nineImage1').width()*0.56
        });
        $('#nineImage2').css({
            "width": $('#nineImage2').width(),
            "height": $('#nineImage2').width()*0.56
        });
        $('#nineImage3').css({
            "width": $('#nineImage3').width(),
            "height": $('#nineImage3').width()*0.56
        });
        $('#nineImage4').css({
            "width": $('#nineImage4').width(),
            "height": $('#nineImage4').width()*0.56
        });
        $('#nineImage5').css({
            "width": $('#nineImage5').width(),
            "height": $('#nineImage5').width()*0.56
        });
        $('#nineImage6').css({
            "width": $('#nineImage6').width(),
            "height": $('#nineImage6').width()*0.56
        });
        $('#nineImage7').css({
            "width": $('#nineImage7').width(),
            "height": $('#nineImage7').width()*0.56
        });
        $('#nineImage8').css({
            "width": $('#nineImage8').width(),
            "height": $('#nineImage8').width()*0.56
        });
        $('#nineImage9').css({
            "width": $('#nineImage9').width(),
            "height": $('#nineImage9').width()*0.56
        });
        if (bNineSelection == false)
        {
            var element1 = $('#nineImage1').get(0);
            var element2 = $('#nineImage2').get(0);
            var element3 = $('#nineImage3').get(0);
            var element4 = $('#nineImage4').get(0);
            var element5 = $('#nineImage5').get(0);
            var element6 = $('#nineImage6').get(0);
            var element7 = $('#nineImage7').get(0);
            var element8 = $('#nineImage8').get(0);
            var element9 = $('#nineImage9').get(0);
            cornerstone.enable(element1);
            var cur_1 = localStorage.getItem('current_1');
            if (cur_1.indexOf("--") != -1)
            {
                $(element1).attr("data-src", cur_1);
                dicomDetialView2(element1, cur_1);
            }
            cornerstone.enable(element2);
            cornerstone.enable(element3);
            cornerstone.enable(element4);
            cornerstone.enable(element5);
            cornerstone.enable(element6);
            cornerstone.enable(element7);
            cornerstone.enable(element8);
            cornerstone.enable(element9);
            $(element1).on("CornerstoneImageRendered", onViewportUpdated);
            $(element2).on("CornerstoneImageRendered", onViewportUpdated);
            $(element3).on("CornerstoneImageRendered", onViewportUpdated);
            $(element4).on("CornerstoneImageRendered", onViewportUpdated);
            $(element5).on("CornerstoneImageRendered", onViewportUpdated);
            $(element6).on("CornerstoneImageRendered", onViewportUpdated);
            $(element7).on("CornerstoneImageRendered", onViewportUpdated);
            $(element8).on("CornerstoneImageRendered", onViewportUpdated);
            $(element9).on("CornerstoneImageRendered", onViewportUpdated);
            $(element1).on("CornerstoneNewImage", onImageNumUpdated);
            $(element2).on("CornerstoneNewImage", onImageNumUpdated);
            $(element3).on("CornerstoneNewImage", onImageNumUpdated);
            $(element4).on("CornerstoneNewImage", onImageNumUpdated);
            $(element5).on("CornerstoneNewImage", onImageNumUpdated);
            $(element6).on("CornerstoneNewImage", onImageNumUpdated);
            $(element7).on("CornerstoneNewImage", onImageNumUpdated);
            $(element8).on("CornerstoneNewImage", onImageNumUpdated);
            $(element9).on("CornerstoneNewImage", onImageNumUpdated);
            loaded = false;
//                loadViewDicomUrl(element1);
//                loadViewDicomUrl(element2);
//                loadViewDicomUrl(element3);
//                loadViewDicomUrl(element4);
//                loadViewDicomUrl(element5);
//                loadViewDicomUrl(element6);
//                loadViewDicomUrl(element7);
//                loadViewDicomUrl(element8);
//                loadViewDicomUrl(element9);
            //bNineSelection = true;
        }

    }

    function OneSelectScreen() {
        if ($("#3D_win").css("display") != "none") return;
        if ($("#MPR_win").css("display") != "none") return;

        $('#pauseBtn').trigger('click');
        $('#OneSelectScreen').addClass('active');
        $('#TwoSelectScreen').removeClass('active');
        $('#FourSelectScreen').removeClass('active');
        $('#NineSelectScreen').removeClass('active');
        $('#Sub_OneSelectScreen').removeClass('active');
        $('#Sub_TwoSelectScreen').removeClass('active');
        $('#Sub_FourSelectScreen').removeClass('active');
        $('#Sub_NineSelectScreen').removeClass('active');
        $('#oneOneScreen').show();
        $('#oneTwoScreen').hide();
        $('#oneFourScreen').hide();
        $('#oneNineScreen').hide();
        $('#3D_win').hide();
        $('#MPR_win').hide();
    }

    function SubOneSelectScreen() {
        if ($("#3D_win").css("display") != "none") return;
        if ($("#MPR_win").css("display") != "none") return;

        $('#pauseBtn').trigger('click');
        $('#Sub_OneSelectScreen').addClass('active');
        $('#Sub_TwoSelectScreen').removeClass('active');
        $('#Sub_FourSelectScreen').removeClass('active');
        $('#Sub_NineSelectScreen').removeClass('active');
        var select_element = $(".seriesBox.select");
        var a = '<div id="sub_oneOneScreen" class="row"> \
                <div  id="sub0_1" class="col-lg-12 seriesBox2" onclick="onSubDivClick(this);" oncontextmenu="return true;" ondragover="return false;" ondragenter="return false;" ondrop="drop(this, event);"> \
                    <div id="mrtopleft_PatName" style="position: absolute;top:3px; left:30px"></div>\
                    <div id="mrtopleft_PatNum" style="position: absolute;top:18px; left:30px"></div>\
                    <div id="mrtopleft_PatAge" style="position: absolute;top:33px; left:30px"></div>\
                    <div id="mrtopleft_PatSex" style="position: absolute;top:48px; left:30px"></div>\
                    <div id="mrbottomright" style="position: absolute;bottom:3px; right:3px"></div> \
                    <div id="mrtopright" style="position: absolute;top:3px; right:3px"></div>\
                    <div id="mrtopright_hospital" style="position: absolute;top:23px; right:3px"></div> \
                    <div id="mrtopright_checktime" style="position: absolute;top:40px; right:3px"></div> \
                    <div id="mrbottomleft" style="position: absolute;bottom:3px; left:30px"></div> \
                </div></div>';

        $(select_element).html(a);
        $('.seriesBox.select > #sub_oneOneScreen > #sub0_1').css({
            "width": $('.seriesBox.select > #sub_oneOneScreen > #sub0_1').width(),
            "height": $(select_element).height()
        });

        var sub_element1 = $('.seriesBox.select > #sub_oneOneScreen > #sub0_1').get(0);
        cornerstone.enable(sub_element1);

        var imageIIds = [];
        var data_src = $(select_element).attr("data-src");
        if (data_src) {
            //console.log("data_src =" + data_src);
            var seriesData1 = JSON.parse(localStorage.getItem(data_src));
            //console.log("seriesData1 = " + seriesData1);
            for (var index in seriesData1) {
                var dicomUrlParam = dicomBaseSearchUrl + '?operation=wado&studyUID=' + seriesData1[index].studyUID + '&seriesUID=' +
                    seriesData1[index].seriesUID + '&objectUID=' + seriesData1[index].objectUID + '&contentType=application/dicom';
                var url1 = "wadouri:" + dicomUrlParam;
                //console.log(dicomUrlParam);
                imageIIds.push(url1);
            }

            var url = imageIIds[0];

            var stack1 = {
                currentImageIdIndex: 0,
                imageIds: imageIIds
            };

            loadViewDicomUrl2(sub_element1, url);

            cornerstoneTools.addStackStateManager(sub_element1, ['stack', 'playClip']);
            cornerstoneTools.addToolState(sub_element1, 'stack', stack1);
            cornerstoneTools.stackScrollWheel.activate(sub_element1);
            cornerstoneTools.zoomWheel.deactivate(sub_element1);
        }


    }

    function SubTwoSelectScreen() {
        if ($("#3D_win").css("display") != "none") return;
        if ($("#MPR_win").css("display") != "none") return;

        $('#pauseBtn').trigger('click');
        if ($("#oneOneScreen").css("display") != "none")
        {
            TwoSelectScreen();
            return;
        }
        $('#Sub_OneSelectScreen').removeClass('active');
        $('#Sub_TwoSelectScreen').addClass('active');
        $('#Sub_FourSelectScreen').removeClass('active');
        $('#Sub_NineSelectScreen').removeClass('active');
        var select_element = $(".seriesBox.select");
        var imageIIds = [];


        var a = '<div id="sub_oneTwoScreen" class="row"> \
                <div  id="sub1_1" class="col-lg-6 seriesBox2" onclick="onSubDivClick(this);" oncontextmenu="return true;" ondragover="return false;" ondragenter="return false;" ondrop="drop2(this, event);"> \
                    <div id="mrtopleft_PatName" style="position: absolute;top:3px; left:30px"></div>\
                    <div id="mrtopleft_PatNum" style="position: absolute;top:18px; left:30px"></div>\
                    <div id="mrtopleft_PatAge" style="position: absolute;top:33px; left:30px"></div>\
                    <div id="mrtopleft_PatSex" style="position: absolute;top:48px; left:30px"></div>\
                    <div id="mrbottomright" style="position: absolute;bottom:3px; right:3px"></div> \
                    <div id="mrtopright" style="position: absolute;top:3px; right:3px"></div>\
                    <div id="mrtopright_hospital" style="position: absolute;top:23px; right:3px"></div> \
                    <div id="mrtopright_checktime" style="position: absolute;top:40px; right:3px"></div> \
                    <div id="mrbottomleft" style="position: absolute;bottom:3px; left:30px"></div> \
                </div> \
                <div id="sub1_2" class="col-lg-6 seriesBox2" onclick="onSubDivClick(this);" oncontextmenu="return true;" ondragover="return false;" ondragenter="return false;" ondrop="drop2(this, event);"> \
                    <div id="mrtopleft_PatName" style="position: absolute;top:3px; left:30px"></div>\
                    <div id="mrtopleft_PatNum" style="position: absolute;top:18px; left:30px"></div>\
                    <div id="mrtopleft_PatAge" style="position: absolute;top:33px; left:30px"></div>\
                    <div id="mrtopleft_PatSex" style="position: absolute;top:48px; left:30px"></div>\
                    <div id="mrbottomright" style="position: absolute;bottom:3px; right:3px"></div> \
                    <div id="mrtopright" style="position: absolute;top:3px; right:3px"></div>\
                    <div id="mrtopright_hospital" style="position: absolute;top:23px; right:3px"></div> \
                    <div id="mrtopright_checktime" style="position: absolute;top:40px; right:3px"></div> \
                    <div id="mrbottomleft" style="position: absolute;bottom:3px; left:30px"></div> \
                </div> \
                </div>';
        $(select_element).html(a);
        $('.seriesBox.select > #sub_oneTwoScreen > #sub1_1').css({
            "width": $('.seriesBox.select > #sub_oneTwoScreen > #sub1_1').width(),
            "height": $(select_element).height()-1
        });
        $('.seriesBox.select > #sub_oneTwoScreen > #sub1_2').css({
            "width": $('.seriesBox.select > #sub_oneTwoScreen > #sub1_2').width(),
            "height": $(select_element).height()-1
        });
        var sub_element1 = $('.seriesBox.select > #sub_oneTwoScreen > #sub1_1').get(0);
        var sub_element2 = $('.seriesBox.select > #sub_oneTwoScreen > #sub1_2').get(0);
        cornerstone.enable(sub_element1);
        cornerstone.enable(sub_element2);

        var data_src = $(select_element).attr("data-src");
        if (data_src) {
            //console.log("data_src =" + data_src);
            var seriesData1 = JSON.parse(localStorage.getItem(data_src));
            //console.log("seriesData1 = " + seriesData1);
            for (var index in seriesData1) {
                var dicomUrlParam = dicomBaseSearchUrl + '?operation=wado&studyUID=' + seriesData1[index].studyUID + '&seriesUID=' +
                    seriesData1[index].seriesUID + '&objectUID=' + seriesData1[index].objectUID + '&contentType=application/dicom';
                var url1 = "wadouri:" + dicomUrlParam;
                //console.log(dicomUrlParam);
                imageIIds.push(url1);
            }

            var url = imageIIds[0];

            var stack1 = {
                currentImageIdIndex: 0,
                imageIds: imageIIds
            };

            loadViewDicomUrl2(sub_element1, url);
            loadViewDicomUrl2(sub_element2, url);

            //cornerstoneTools.mouseInput.enable(sub_element1);
            //cornerstoneTools.mouseWheelInput.enable(sub_element1);
            cornerstoneTools.addStackStateManager(sub_element1, ['stack', 'playClip']);
            cornerstoneTools.addToolState(sub_element1, 'stack', stack1);
            //cornerstoneTools.stackScroll.activate(sub_element1, 1);
            cornerstoneTools.stackScrollWheel.activate(sub_element1);
            //cornerstoneTools.scrollIndicator.enable(sub_element1);
            cornerstoneTools.zoomWheel.deactivate(sub_element1);

            //cornerstoneTools.mouseInput.enable(sub_element2);
            //cornerstoneTools.mouseWheelInput.enable(sub_element2);
            cornerstoneTools.addStackStateManager(sub_element2, ['stack', 'playClip']);
            cornerstoneTools.addToolState(sub_element2, 'stack', stack1);
            //cornerstoneTools.stackScroll.activate(sub_element2, 1);
            cornerstoneTools.stackScrollWheel.activate(sub_element2);
            //cornerstoneTools.scrollIndicator.enable(sub_element2);
            cornerstoneTools.zoomWheel.deactivate(sub_element2);
        }
    }

    function SubFourSelectScreen() {
        if ($("#3D_win").css("display") != "none") return;
        if ($("#MPR_win").css("display") != "none") return;

        $('#pauseBtn').trigger('click');
        if ($("#oneOneScreen").css("display") != "none")
        {
            FourSelectScreen();
            return;
        }
        $('#Sub_OneSelectScreen').removeClass('active');
        $('#Sub_TwoSelectScreen').removeClass('active');
        $('#Sub_FourSelectScreen').addClass('active');
        $('#Sub_NineSelectScreen').removeClass('active');
        var select_element = $(".seriesBox.select");
        var a = '<div id="sub_oneFourScreen" class="row"> \
                <div  id="sub2_1" class="col-lg-6 seriesBox2" onclick="onSubDivClick(this);" oncontextmenu="return true;" ondragover="return false;" ondragenter="return false;" ondrop="drop2(this, event);"> \
                    <div id="mrtopleft_PatName" style="position: absolute;top:3px; left:30px"></div>\
                    <div id="mrtopleft_PatNum" style="position: absolute;top:18px; left:30px"></div>\
                    <div id="mrtopleft_PatAge" style="position: absolute;top:33px; left:30px"></div>\
                    <div id="mrtopleft_PatSex" style="position: absolute;top:48px; left:30px"></div>\
                    <div id="mrbottomright" style="position: absolute;bottom:3px; right:3px"></div> \
                    <div id="mrtopright" style="position: absolute;top:3px; right:3px"></div>\
                    <div id="mrtopright_hospital" style="position: absolute;top:23px; right:3px"></div> \
                    <div id="mrtopright_checktime" style="position: absolute;top:40px; right:3px"></div> \
                    <div id="mrbottomleft" style="position: absolute;bottom:3px; left:30px"></div> \
                </div> \
                <div id="sub2_2" class="col-lg-6 seriesBox2" onclick="onSubDivClick(this);" oncontextmenu="return true;" ondragover="return false;" ondragenter="return false;" ondrop="drop2(this, event);"> \
                    <div id="mrtopleft_PatName" style="position: absolute;top:3px; left:30px"></div>\
                    <div id="mrtopleft_PatNum" style="position: absolute;top:18px; left:30px"></div>\
                    <div id="mrtopleft_PatAge" style="position: absolute;top:33px; left:30px"></div>\
                    <div id="mrtopleft_PatSex" style="position: absolute;top:48px; left:30px"></div>\
                    <div id="mrbottomright" style="position: absolute;bottom:3px; right:3px"></div> \
                    <div id="mrtopright" style="position: absolute;top:3px; right:3px"></div>\
                    <div id="mrtopright_hospital" style="position: absolute;top:23px; right:3px"></div> \
                    <div id="mrtopright_checktime" style="position: absolute;top:40px; right:3px"></div> \
                    <div id="mrbottomleft" style="position: absolute;bottom:3px; left:30px"></div> \
                </div> \
                <div  id="sub2_3" class="col-lg-6 seriesBox2" onclick="onSubDivClick(this);" oncontextmenu="return true;" ondragover="return false;" ondragenter="return false;" ondrop="drop2(this, event);"> \
                    <div id="mrtopleft_PatName" style="position: absolute;top:3px; left:30px"></div>\
                    <div id="mrtopleft_PatNum" style="position: absolute;top:18px; left:30px"></div>\
                    <div id="mrtopleft_PatAge" style="position: absolute;top:33px; left:30px"></div>\
                    <div id="mrtopleft_PatSex" style="position: absolute;top:48px; left:30px"></div>\
                    <div id="mrbottomright" style="position: absolute;bottom:3px; right:3px"></div> \
                    <div id="mrtopright" style="position: absolute;top:3px; right:3px"></div>\
                    <div id="mrtopright_hospital" style="position: absolute;top:23px; right:3px"></div> \
                    <div id="mrtopright_checktime" style="position: absolute;top:40px; right:3px"></div> \
                    <div id="mrbottomleft" style="position: absolute;bottom:3px; left:30px"></div> \
                </div> \
                <div  id="sub2_4" class="col-lg-6 seriesBox2" onclick="onSubDivClick(this);" oncontextmenu="return true;" ondragover="return false;" ondragenter="return false;" ondrop="drop2(this, event);"> \
                    <div id="mrtopleft_PatName" style="position: absolute;top:3px; left:30px"></div>\
                    <div id="mrtopleft_PatNum" style="position: absolute;top:18px; left:30px"></div>\
                    <div id="mrtopleft_PatAge" style="position: absolute;top:33px; left:30px"></div>\
                    <div id="mrtopleft_PatSex" style="position: absolute;top:48px; left:30px"></div>\
                    <div id="mrbottomright" style="position: absolute;bottom:3px; right:3px"></div> \
                    <div id="mrtopright_hospital" style="position: absolute;top:23px; right:3px"></div> \
                    <div id="mrtopright_checktime" style="position: absolute;top:40px; right:3px"></div> \
                    <div id="mrtopright" style="position: absolute;top:3px; right:3px"></div>\
                    <div id="mrbottomleft" style="position: absolute;bottom:3px; left:30px"></div> \
                </div> \
                </div>';
        $(select_element).html(a);
        $('.seriesBox.select > #sub_oneFourScreen > #sub2_1').css({
            "width": $('.seriesBox.select > #sub_oneFourScreen > #sub2_1').width(),
            "height": $(select_element).height()/2
        });
        $('.seriesBox.select > #sub_oneFourScreen > #sub2_2').css({
            "width": $('.seriesBox.select > #sub_oneFourScreen > #sub2_2').width(),
            "height": $(select_element).height()/2
        });
        $('.seriesBox.select > #sub_oneFourScreen > #sub2_3').css({
            "width": $('.seriesBox.select > #sub_oneFourScreen > #sub2_3').width(),
            "height": $(select_element).height()/2
        });
        $('.seriesBox.select > #sub_oneFourScreen > #sub2_4').css({
            "width": $('.seriesBox.select > #sub_oneFourScreen > #sub2_4').width(),
            "height": $(select_element).height()/2
        });
        var sub_element1 = $('.seriesBox.select > #sub_oneFourScreen > #sub2_1').get(0);
        var sub_element2 = $('.seriesBox.select > #sub_oneFourScreen > #sub2_2').get(0);
        var sub_element3 = $('.seriesBox.select > #sub_oneFourScreen > #sub2_3').get(0);
        var sub_element4 = $('.seriesBox.select > #sub_oneFourScreen > #sub2_4').get(0);
        cornerstone.enable(sub_element1);
        cornerstone.enable(sub_element2);
        cornerstone.enable(sub_element3);
        cornerstone.enable(sub_element4);

        var imageIIds = [];
        var data_src = $(select_element).attr("data-src");
        if (data_src) {
            //console.log("data_src =" + data_src);
            var seriesData1 = JSON.parse(localStorage.getItem(data_src));
            //console.log("seriesData1 = " + seriesData1);
            for (var index in seriesData1) {
                var dicomUrlParam = dicomBaseSearchUrl + '?operation=wado&studyUID=' + seriesData1[index].studyUID + '&seriesUID=' +
                    seriesData1[index].seriesUID + '&objectUID=' + seriesData1[index].objectUID + '&contentType=application/dicom';
                var url1 = "wadouri:" + dicomUrlParam;
                //console.log(dicomUrlParam);
                imageIIds.push(url1);
            }

            var url = imageIIds[0];

            var stack1 = {
                currentImageIdIndex: 0,
                imageIds: imageIIds
            };

            loadViewDicomUrl2(sub_element1, url);
            loadViewDicomUrl2(sub_element2, url);
            loadViewDicomUrl2(sub_element3, url);
            loadViewDicomUrl2(sub_element4, url);

            cornerstoneTools.addStackStateManager(sub_element1, ['stack', 'playClip']);
            cornerstoneTools.addToolState(sub_element1, 'stack', stack1);
            cornerstoneTools.stackScrollWheel.activate(sub_element1);
            cornerstoneTools.zoomWheel.deactivate(sub_element1);

            cornerstoneTools.addStackStateManager(sub_element2, ['stack', 'playClip']);
            cornerstoneTools.addToolState(sub_element2, 'stack', stack1);
            cornerstoneTools.stackScrollWheel.activate(sub_element2);
            cornerstoneTools.zoomWheel.deactivate(sub_element2);

            cornerstoneTools.addStackStateManager(sub_element3, ['stack', 'playClip']);
            cornerstoneTools.addToolState(sub_element3, 'stack', stack1);
            cornerstoneTools.stackScrollWheel.activate(sub_element3);
            cornerstoneTools.zoomWheel.deactivate(sub_element3);

            cornerstoneTools.addStackStateManager(sub_element4, ['stack', 'playClip']);
            cornerstoneTools.addToolState(sub_element4, 'stack', stack1);
            cornerstoneTools.stackScrollWheel.activate(sub_element4);
            cornerstoneTools.zoomWheel.deactivate(sub_element4);
        }
    }

    function SubNineSelectScreen() {
        if ($("#3D_win").css("display") != "none") return;
        if ($("#MPR_win").css("display") != "none") return;

        $('#pauseBtn').trigger('click');
        if ($("#oneOneScreen").css("display") != "none")
        {
            NineSelectScreen();
            return;
        }
        $('#Sub_OneSelectScreen').removeClass('active');
        $('#Sub_TwoSelectScreen').removeClass('active');
        $('#Sub_FourSelectScreen').removeClass('active');
        $('#Sub_NineSelectScreen').addClass('active');
        var select_element = $(".seriesBox.select");
        var a = '<div id="sub_oneNineScreen" class="row"> \
                <div  id="sub3_1" class="col-lg-4 seriesBox2" onclick="onSubDivClick(this);" oncontextmenu="return true;" ondragover="return false;" ondragenter="return false;" ondrop="drop2(this, event);"> \
                    <div id="mrtopleft_PatName" style="position: absolute;top:3px; left:30px"></div>\
                    <div id="mrtopleft_PatNum" style="position: absolute;top:18px; left:30px"></div>\
                    <div id="mrtopleft_PatAge" style="position: absolute;top:33px; left:30px"></div>\
                    <div id="mrtopleft_PatSex" style="position: absolute;top:48px; left:30px"></div>\
                    <div id="mrbottomright" style="position: absolute;bottom:3px; right:3px"></div> \
                    <div id="mrtopright" style="position: absolute;top:3px; right:3px"></div>\
                    <div id="mrtopright_hospital" style="position: absolute;top:23px; right:3px"></div> \
                    <div id="mrtopright_checktime" style="position: absolute;top:40px; right:3px"></div> \
                    <div id="mrbottomleft" style="position: absolute;bottom:3px; left:30px"></div> \
                </div> \
                <div id="sub3_2" class="col-lg-4 seriesBox2" onclick="onSubDivClick(this);" oncontextmenu="return true;" ondragover="return false;" ondragenter="return false;" ondrop="drop2(this, event);"> \
                    <div id="mrtopleft_PatName" style="position: absolute;top:3px; left:30px"></div>\
                    <div id="mrtopleft_PatNum" style="position: absolute;top:18px; left:30px"></div>\
                    <div id="mrtopleft_PatAge" style="position: absolute;top:33px; left:30px"></div>\
                    <div id="mrtopleft_PatSex" style="position: absolute;top:48px; left:30px"></div>\
                    <div id="mrbottomright" style="position: absolute;bottom:3px; right:3px"></div> \
                    <div id="mrtopright" style="position: absolute;top:3px; right:3px"></div>\
                    <div id="mrtopright_hospital" style="position: absolute;top:23px; right:3px"></div> \
                    <div id="mrtopright_checktime" style="position: absolute;top:40px; right:3px"></div> \
                    <div id="mrbottomleft" style="position: absolute;bottom:3px; left:30px"></div> \
                </div> \
                <div  id="sub3_3" class="col-lg-4 seriesBox2" onclick="onSubDivClick(this);" oncontextmenu="return true;" ondragover="return false;" ondragenter="return false;" ondrop="drop2(this, event);"> \
                    <div id="mrtopleft_PatName" style="position: absolute;top:3px; left:30px"></div>\
                    <div id="mrtopleft_PatNum" style="position: absolute;top:18px; left:30px"></div>\
                    <div id="mrtopleft_PatAge" style="position: absolute;top:33px; left:30px"></div>\
                    <div id="mrtopleft_PatSex" style="position: absolute;top:48px; left:30px"></div>\
                    <div id="mrbottomright" style="position: absolute;bottom:3px; right:3px"></div> \
                    <div id="mrtopright" style="position: absolute;top:3px; right:3px"></div>\
                    <div id="mrtopright_hospital" style="position: absolute;top:23px; right:3px"></div> \
                    <div id="mrtopright_checktime" style="position: absolute;top:40px; right:3px"></div> \
                    <div id="mrbottomleft" style="position: absolute;bottom:3px; left:30px"></div> \
                </div> \
                <div  id="sub3_4" class="col-lg-4 seriesBox2" onclick="onSubDivClick(this);" oncontextmenu="return true;" ondragover="return false;" ondragenter="return false;" ondrop="drop2(this, event);"> \
                    <div id="mrtopleft_PatName" style="position: absolute;top:3px; left:30px"></div>\
                    <div id="mrtopleft_PatNum" style="position: absolute;top:18px; left:30px"></div>\
                    <div id="mrtopleft_PatAge" style="position: absolute;top:33px; left:30px"></div>\
                    <div id="mrtopleft_PatSex" style="position: absolute;top:48px; left:30px"></div>\
                    <div id="mrbottomright" style="position: absolute;bottom:3px; right:3px"></div> \
                    <div id="mrtopright" style="position: absolute;top:3px; right:3px"></div>\
                    <div id="mrtopright_hospital" style="position: absolute;top:23px; right:3px"></div> \
                    <div id="mrtopright_checktime" style="position: absolute;top:40px; right:3px"></div> \
                    <div id="mrbottomleft" style="position: absolute;bottom:3px; left:30px"></div> \
                </div> \
                <div  id="sub3_5" class="col-lg-4 seriesBox2" onclick="onSubDivClick(this);" oncontextmenu="return true;" ondragover="return false;" ondragenter="return false;" ondrop="drop2(this, event);"> \
                    <div id="mrtopleft_PatName" style="position: absolute;top:3px; left:30px"></div>\
                    <div id="mrtopleft_PatNum" style="position: absolute;top:18px; left:30px"></div>\
                    <div id="mrtopleft_PatAge" style="position: absolute;top:33px; left:30px"></div>\
                    <div id="mrtopleft_PatSex" style="position: absolute;top:48px; left:30px"></div>\
                    <div id="mrbottomright" style="position: absolute;bottom:3px; right:3px"></div> \
                    <div id="mrtopright" style="position: absolute;top:3px; right:3px"></div>\
                    <div id="mrtopright_hospital" style="position: absolute;top:23px; right:3px"></div> \
                    <div id="mrtopright_checktime" style="position: absolute;top:40px; right:3px"></div> \
                    <div id="mrbottomleft" style="position: absolute;bottom:3px; left:30px"></div> \
                </div> \
                <div  id="sub3_6" class="col-lg-4 seriesBox2" onclick="onSubDivClick(this);" oncontextmenu="return true;" ondragover="return false;" ondragenter="return false;" ondrop="drop2(this, event);"> \
                    <div id="mrtopleft_PatName" style="position: absolute;top:3px; left:30px"></div>\
                    <div id="mrtopleft_PatNum" style="position: absolute;top:18px; left:30px"></div>\
                    <div id="mrtopleft_PatAge" style="position: absolute;top:33px; left:30px"></div>\
                    <div id="mrtopleft_PatSex" style="position: absolute;top:48px; left:30px"></div>\
                    <div id="mrbottomright" style="position: absolute;bottom:3px; right:3px"></div> \
                    <div id="mrtopright" style="position: absolute;top:3px; right:3px"></div>\
                    <div id="mrtopright_hospital" style="position: absolute;top:23px; right:3px"></div> \
                    <div id="mrtopright_checktime" style="position: absolute;top:40px; right:3px"></div> \
                    <div id="mrbottomleft" style="position: absolute;bottom:3px; left:30px"></div> \
                </div> \
                <div  id="sub3_7" class="col-lg-4 seriesBox2" onclick="onSubDivClick(this);" oncontextmenu="return true;" ondragover="return false;" ondragenter="return false;" ondrop="drop2(this, event);"> \
                    <div id="mrtopleft_PatName" style="position: absolute;top:3px; left:30px"></div>\
                    <div id="mrtopleft_PatNum" style="position: absolute;top:18px; left:30px"></div>\
                    <div id="mrtopleft_PatAge" style="position: absolute;top:33px; left:30px"></div>\
                    <div id="mrtopleft_PatSex" style="position: absolute;top:48px; left:30px"></div>\
                    <div id="mrbottomright" style="position: absolute;bottom:3px; right:3px"></div> \
                    <div id="mrtopright" style="position: absolute;top:3px; right:3px"></div>\
                    <div id="mrtopright_hospital" style="position: absolute;top:23px; right:3px"></div> \
                    <div id="mrtopright_checktime" style="position: absolute;top:40px; right:3px"></div> \
                    <div id="mrbottomleft" style="position: absolute;bottom:3px; left:30px"></div> \
                </div> \
                <div  id="sub3_8" class="col-lg-4 seriesBox2" onclick="onSubDivClick(this);" oncontextmenu="return true;" ondragover="return false;" ondragenter="return false;" ondrop="drop2(this, event);"> \
                    <div id="mrtopleft_PatName" style="position: absolute;top:3px; left:30px"></div>\
                    <div id="mrtopleft_PatNum" style="position: absolute;top:18px; left:30px"></div>\
                    <div id="mrtopleft_PatAge" style="position: absolute;top:33px; left:30px"></div>\
                    <div id="mrtopleft_PatSex" style="position: absolute;top:48px; left:30px"></div>\
                    <div id="mrbottomright" style="position: absolute;bottom:3px; right:3px"></div> \
                    <div id="mrtopright" style="position: absolute;top:3px; right:3px"></div>\
                    <div id="mrtopright_hospital" style="position: absolute;top:23px; right:3px"></div> \
                    <div id="mrtopright_checktime" style="position: absolute;top:40px; right:3px"></div> \
                    <div id="mrbottomleft" style="position: absolute;bottom:3px; left:30px"></div> \
                </div> \
                <div  id="sub3_9" class="col-lg-4 seriesBox2" onclick="onSubDivClick(this);" oncontextmenu="return true;" ondragover="return false;" ondragenter="return false;" ondrop="drop2(this, event);"> \
                    <div id="mrtopleft_PatName" style="position: absolute;top:3px; left:30px"></div>\
                    <div id="mrtopleft_PatNum" style="position: absolute;top:18px; left:30px"></div>\
                    <div id="mrtopleft_PatAge" style="position: absolute;top:33px; left:30px"></div>\
                    <div id="mrtopleft_PatSex" style="position: absolute;top:48px; left:30px"></div>\
                    <div id="mrbottomright" style="position: absolute;bottom:3px; right:3px"></div> \
                    <div id="mrtopright" style="position: absolute;top:3px; right:3px"></div>\
                    <div id="mrtopright_hospital" style="position: absolute;top:23px; right:3px"></div> \
                    <div id="mrtopright_checktime" style="position: absolute;top:40px; right:3px"></div> \
                    <div id="mrbottomleft" style="position: absolute;bottom:3px; left:30px"></div> \
                </div> \
                </div>';
        $(select_element).html(a);
        $('.seriesBox.select > #sub_oneNineScreen > #sub3_1').css({
            "width": $('.seriesBox.select > #sub_oneNineScreen > #sub3_1').width(),
            "height": $(select_element).height()/3
        });
        $('.seriesBox.select > #sub_oneNineScreen > #sub3_2').css({
            "width": $('.seriesBox.select > #sub_oneNineScreen > #sub3_2').width(),
            "height": $(select_element).height()/3
        });
        $('.seriesBox.select > #sub_oneNineScreen > #sub3_3').css({
            "width": $('.seriesBox.select > #sub_oneNineScreen > #sub3_3').width(),
            "height": $(select_element).height()/3
        });
        $('.seriesBox.select > #sub_oneNineScreen > #sub3_4').css({
            "width": $('.seriesBox.select > #sub_oneNineScreen > #sub3_4').width(),
            "height": $(select_element).height()/3
        });
        $('.seriesBox.select > #sub_oneNineScreen > #sub3_5').css({
            "width": $('.seriesBox.select > #sub_oneNineScreen > #sub3_5').width(),
            "height": $(select_element).height()/3
        });
        $('.seriesBox.select > #sub_oneNineScreen > #sub3_6').css({
            "width": $('.seriesBox.select > #sub_oneNineScreen > #sub3_6').width(),
            "height": $(select_element).height()/3
        });
        $('.seriesBox.select > #sub_oneNineScreen > #sub3_7').css({
            "width": $('.seriesBox.select > #sub_oneNineScreen > #sub3_7').width(),
            "height": $(select_element).height()/3
        });
        $('.seriesBox.select > #sub_oneNineScreen > #sub3_8').css({
            "width": $('.seriesBox.select > #sub_oneNineScreen > #sub3_8').width(),
            "height": $(select_element).height()/3
        });
        $('.seriesBox.select > #sub_oneNineScreen > #sub3_9').css({
            "width": $('.seriesBox.select > #sub_oneNineScreen > #sub3_9').width(),
            "height": $(select_element).height()/3
        });
        var sub_element1 = $('.seriesBox.select > #sub_oneNineScreen > #sub3_1').get(0);
        var sub_element2 = $('.seriesBox.select > #sub_oneNineScreen > #sub3_2').get(0);
        var sub_element3 = $('.seriesBox.select > #sub_oneNineScreen > #sub3_3').get(0);
        var sub_element4 = $('.seriesBox.select > #sub_oneNineScreen > #sub3_4').get(0);
        var sub_element5 = $('.seriesBox.select > #sub_oneNineScreen > #sub3_5').get(0);
        var sub_element6 = $('.seriesBox.select > #sub_oneNineScreen > #sub3_6').get(0);
        var sub_element7 = $('.seriesBox.select > #sub_oneNineScreen > #sub3_7').get(0);
        var sub_element8 = $('.seriesBox.select > #sub_oneNineScreen > #sub3_8').get(0);
        var sub_element9 = $('.seriesBox.select > #sub_oneNineScreen > #sub3_9').get(0);
        cornerstone.enable(sub_element1);
        cornerstone.enable(sub_element2);
        cornerstone.enable(sub_element3);
        cornerstone.enable(sub_element4);
        cornerstone.enable(sub_element5);
        cornerstone.enable(sub_element6);
        cornerstone.enable(sub_element7);
        cornerstone.enable(sub_element8);
        cornerstone.enable(sub_element9);

        var imageIIds = [];
        var data_src = $(select_element).attr("data-src");
        if (data_src) {
            //console.log("data_src =" + data_src);
            var seriesData1 = JSON.parse(localStorage.getItem(data_src));
            //console.log("seriesData1 = " + seriesData1);
            for (var index in seriesData1) {
                var dicomUrlParam = dicomBaseSearchUrl + '?operation=wado&studyUID=' + seriesData1[index].studyUID + '&seriesUID=' +
                    seriesData1[index].seriesUID + '&objectUID=' + seriesData1[index].objectUID + '&contentType=application/dicom';
                var url1 = "wadouri:" + dicomUrlParam;
                //console.log(dicomUrlParam);
                imageIIds.push(url1);
            }

            var url = imageIIds[0];

            var stack1 = {
                currentImageIdIndex: 0,
                imageIds: imageIIds
            };

            loadViewDicomUrl2(sub_element1, url);
            loadViewDicomUrl2(sub_element2, url);
            loadViewDicomUrl2(sub_element3, url);
            loadViewDicomUrl2(sub_element4, url);
            loadViewDicomUrl2(sub_element5, url);
            loadViewDicomUrl2(sub_element6, url);
            loadViewDicomUrl2(sub_element7, url);
            loadViewDicomUrl2(sub_element8, url);
            loadViewDicomUrl2(sub_element9, url);

            cornerstoneTools.addStackStateManager(sub_element1, ['stack', 'playClip']);
            cornerstoneTools.addToolState(sub_element1, 'stack', stack1);
            cornerstoneTools.stackScrollWheel.activate(sub_element1);
            cornerstoneTools.zoomWheel.deactivate(sub_element1);

            cornerstoneTools.addStackStateManager(sub_element2, ['stack', 'playClip']);
            cornerstoneTools.addToolState(sub_element2, 'stack', stack1);
            cornerstoneTools.stackScrollWheel.activate(sub_element2);
            cornerstoneTools.zoomWheel.deactivate(sub_element2);

            cornerstoneTools.addStackStateManager(sub_element3, ['stack', 'playClip']);
            cornerstoneTools.addToolState(sub_element3, 'stack', stack1);
            cornerstoneTools.stackScrollWheel.activate(sub_element3);
            cornerstoneTools.zoomWheel.deactivate(sub_element3);

            cornerstoneTools.addStackStateManager(sub_element4, ['stack', 'playClip']);
            cornerstoneTools.addToolState(sub_element4, 'stack', stack1);
            cornerstoneTools.stackScrollWheel.activate(sub_element4);
            cornerstoneTools.zoomWheel.deactivate(sub_element4);

            cornerstoneTools.addStackStateManager(sub_element5, ['stack', 'playClip']);
            cornerstoneTools.addToolState(sub_element5, 'stack', stack1);
            cornerstoneTools.stackScrollWheel.activate(sub_element5);
            cornerstoneTools.zoomWheel.deactivate(sub_element5);

            cornerstoneTools.addStackStateManager(sub_element6, ['stack', 'playClip']);
            cornerstoneTools.addToolState(sub_element6, 'stack', stack1);
            cornerstoneTools.stackScrollWheel.activate(sub_element6);
            cornerstoneTools.zoomWheel.deactivate(sub_element6);

            cornerstoneTools.addStackStateManager(sub_element7, ['stack', 'playClip']);
            cornerstoneTools.addToolState(sub_element7, 'stack', stack1);
            cornerstoneTools.stackScrollWheel.activate(sub_element7);
            cornerstoneTools.zoomWheel.deactivate(sub_element7);

            cornerstoneTools.addStackStateManager(sub_element8, ['stack', 'playClip']);
            cornerstoneTools.addToolState(sub_element8, 'stack', stack1);
            cornerstoneTools.stackScrollWheel.activate(sub_element8);
            cornerstoneTools.zoomWheel.deactivate(sub_element8);

            cornerstoneTools.addStackStateManager(sub_element9, ['stack', 'playClip']);
            cornerstoneTools.addToolState(sub_element9, 'stack', stack1);
            cornerstoneTools.stackScrollWheel.activate(sub_element9);
            cornerstoneTools.zoomWheel.deactivate(sub_element9);
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
        $(e.target).children('#mrtopleft_PatSex').text("Sex: " + "<?=$booking_data->patient_gender ? 'F' : 'M'?>");
        $(e.target).children('#mrtopright_hospital').text("<?=$booking_data->hospital_name?>");
        $(e.target).children('#mrtopright_checktime').text("<?=$booking_data->checked_time?>");
    }
    $(element).on("CornerstoneImageRendered", onViewportUpdated);
    $(element).on("CornerstoneNewImage", onImageNumUpdated);

    function onDivClick(target_div) {
        $('#pauseBtn').trigger('click');
        $(target_div).siblings().removeClass("select");
        $(".seriesBox").removeClass("select");
        $("div.seriesBox2").removeClass("select2");
        //$("div.seriesBox2").children("canvas").css('border', '1px solid #808080');
        $(target_div).addClass("select");
        //$(this).children("canvas").addClass("select");
        $(target_div).children("canvas").css('border', '2px solid #337ab7');
        $(target_div).siblings().children("canvas").css('border', '1px solid #808080');
        $(target_div).siblings().children().children("div.seriesBox2").children("canvas").css('border', '1px solid #808080');
    };

    function onSubDivClick(target_div) {
        $('#pauseBtn').trigger('click');
        $(target_div).siblings().removeClass("select2");
        $("div.seriesBox").removeClass("select");
        $("div.seriesBox2").removeClass("select2");
        $("div.seriesBox2").children("canvas").css('border', '1px solid #808080');
        $(target_div).addClass("select2");
        //$(this).children("canvas").addClass("select");
        $(target_div).children("canvas").css('border', '2px solid #337ab7');
        //$(target_div).siblings().children("canvas").css('border', '1px solid #808080');
    };

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
            var base_url = '<?=base_url()?>';
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
            "width": $('#oneOneScreen').width()*0.75,
            "height": $('#dicomImageview').width()*1.1
        });
        $('#DicomListView').css({
            "height": $('#dicomImageview').width()*1.1
        });
        cornerstone.enable(element);
        //DicomViewList();
        //downloadAndView();
        $(".seriesBox").each(function () {
            $(this).click(function () {

                $(this).siblings().removeClass("select");
                $(".seriesBox").removeClass("select");
                $(this).addClass("select");
                //$(this).children("canvas").addClass("select");
                $(this).children("canvas").css('border', '2px solid #337ab7');
                $(this).siblings().children("canvas").css('border', '1px solid #808080');
            });
        });

        $("input[name=options]").change(function() {

            var radioValue = $(this).val();

            if (radioValue == "2d") {
                //console.log("2d btn click");
                $('#oneOneScreen').show();
                $('#oneTwoScreen').hide();
                $('#oneFourScreen').hide();
                $('#oneNineScreen').hide();
                $("#playToolPc").hide();
                $('#3D_win').hide();
                $('#MPR_win').hide();
            } else if (radioValue == "3d") {
                //console.log("3d btn click");
                $('#oneOneScreen').hide();
                $('#oneTwoScreen').hide();
                $('#oneFourScreen').hide();
                $('#oneNineScreen').hide();
                $("#playToolPc").hide();
                $('#3D_win').show();
                $('#MPR_win').hide();

                //var 3d_win = document.getElementById('mainwin');
                $("#3D_win").attr('src','<?=base_url()?>assets/dicom/vr_singlepass/index.html');
            } else if (radioValue == "mpr") {
                //console.log("mpr btn click");
                $('#oneOneScreen').hide();
                $('#oneTwoScreen').hide();
                $('#oneFourScreen').hide();
                $('#oneNineScreen').hide();
                $("#playToolPc").hide();
                $('#3D_win').hide();
                $('#MPR_win').show();

                //var 3d_win = document.getElementById('mainwin');
                $("#MPR_win").attr('src','<?=base_url()?>assets/dicom/mpr/index.html');
            }

        });

        $('#3D_win').css({
            "width": $('#oneOneScreen').width(),
            "height": $('#dicomImageview').width()*1.1
        });

        $('#MPR_win').css({
            "width": $('#oneOneScreen').width(),
            "height": $('#dicomImageview').width()*1.1
        });
    });

    function downloadAndView() {
        var url = localStorage.getItem('currentUrl');
        url = "wadouri:" + url;
        //console.log(url);
        loadAndViewImage(url);
    }

    cornerstoneWADOImageLoader.external.cornerstone = cornerstone;
    cornerstoneWADOImageLoader.configure({
        beforeSend: function (xhr) {}
    })
    let loaded = false;

    function loadViewDicomUrl(element) {

        var url = localStorage.getItem('currentUrl');
        // prefix the url with wadouri: so cornerstone can find the image loader
        let imageId = "wadouri:" + url;
        // image enable the dicomImage element and activate a few tools
        try {
            var start = new Date().getTime();
            cornerstone.loadAndCacheImage(imageId).then(function (image) {
                var viewport = cornerstone.getDefaultViewportForImage(element, image);
                cornerstone.displayImage(element, image, viewport);
                if (loaded === false) {
                    cornerstoneTools.mouseInput.enable(element);
                    cornerstoneTools.mouseWheelInput.enable(element);
                    cornerstoneTools.wwwc.activate(element, 1); // ww/wc is the default tool for left mouse button
                    cornerstoneTools.pan.activate(element, 2); // pan is the default tool for middle mouse button
                    cornerstoneTools.zoom.activate(element, 4); // zoom is the default tool for right mouse button
                    cornerstoneTools.zoomWheel.activate(element); // zoom is the default tool for middle mouse wheel
                    cornerstoneTools.probe.enable(element);
                    cornerstoneTools.length.enable(element);
                    cornerstoneTools.ellipticalRoi.enable(element);
                    cornerstoneTools.rectangleRoi.enable(element);
                    cornerstoneTools.angle.enable(element);
                    cornerstoneTools.highlight.enable(element);
                    cornerstoneTools.magnify.enable(element);
                    cornerstoneTools.magnifyTouchDrag.enable(element);
                    loaded = true;
                }
                // helper function used by the tool button handlers to disable the active tool
                // before making a new tool active
                function disableAllTools() {
                    cornerstoneTools.wwwc.disable(element);
                    cornerstoneTools.pan.activate(element, 2); // 2 is middle mouse button
                    cornerstoneTools.zoom.activate(element, 4); // 4 is right mouse button
                    cornerstoneTools.probe.deactivate(element, 1);
                    cornerstoneTools.length.deactivate(element, 1);
                    cornerstoneTools.ellipticalRoi.deactivate(element, 1);
                    cornerstoneTools.rectangleRoi.deactivate(element, 1);
                    cornerstoneTools.magnify.disable(element);
                    cornerstoneTools.magnifyTouchDrag.disable(element);
                    cornerstoneTools.angle.deactivate(element, 1);
                    cornerstoneTools.highlight.deactivate(element, 1);
                    cornerstoneTools.freehand.deactivate(element, 1);
                    cornerstoneTools.freehand.deactivate(element, 1);
                    cornerstoneTools.rotate.disable(element);
                    cornerstoneTools.rotateTouchDrag.disable(element);
                    cornerstoneTools.arrowAnnotate.disable(element);
                    cornerstoneTools.arrowAnnotateTouch.disable(element);

                    //cornerstoneTools.stackScroll.activate(element, 1);
                    //cornerstoneTools.stackScrollWheel.deactivate(element);
                    //cornerstoneTools.scrollIndicator.disable(element);

                }

                // Tool button event handlers that set the new active tool
                $('#hFlip').click(function (e) {
                    viewport = cornerstone.getViewport(element);
                    viewport.hflip = !viewport.hflip;
                    cornerstone.setViewport(element, viewport);
                    var elementDiv = $(element);
                    var rightMid = elementDiv.find('.mrrightmiddle .orientationMarker');
                    var leftMid = elementDiv.find('.mrleftmiddle .orientationMarker');
                    var temp = rightMid.text();
                    rightMid.text(leftMid.text());
                    leftMid.text(temp);
                });

                $('#invert').click(function() {
                    var viewport = cornerstone.getViewport(element);
                    if (viewport.invert === true) {
                        viewport.invert = false;
                    } else {
                        viewport.invert = true;
                    }
                    cornerstone.setViewport(element, viewport);

                    return false;
                });

                $('#vFlip').click(function (e) {
                    viewport = cornerstone.getViewport(element);
                    viewport.vflip = !viewport.vflip;
                    cornerstone.setViewport(element, viewport);
                    var elementDiv = $(element);
                    var topMid = elementDiv.find('.mrtopmiddle .orientationMarker');
                    var bottomMid = elementDiv.find('.mrbottommiddle .orientationMarker');
                    var temp = topMid.text();
                    topMid.text(bottomMid.text());
                    bottomMid.text(temp);
                });

                $('#lRotate').click(function (e) {
                    viewport = cornerstone.getViewport(element);
                    viewport.rotation -=90;
                    cornerstone.setViewport(element, viewport);
                });

                $('#rRotate').click(function (e) {
                    viewport = cornerstone.getViewport(element);
                    viewport.rotation +=90;
                    cornerstone.setViewport(element, viewport);
                });

                // Tool button event handlers that set the new active tool
                $('.enableWindowLevelTool').click(function () {
                    disableAllTools();
                    cornerstoneTools.wwwc.activate(element, 1);
                });
                $('.pan').click(function () {
                    disableAllTools();
                    cornerstoneTools.pan.activate(element, 3); // 3 means left mouse button and middle mouse button
                });
//                    $('.clearToolData').click(function () {
//                        var toolStateManager = cornerstoneTools.getElementToolStateManager(element);
//                        // Note that this only works on ImageId-specific tool state managers (for now)
//                        toolStateManager.clear(element)
//                        cornerstone.updateImage(element);
//                    });
                $('.magnify').click(function () {
                    disableAllTools();

                    var config = {
                        magnifySize: parseInt(350, 10),
                        magnificationLevel: parseInt(5, 10)
                    };
                    cornerstoneTools.magnify.setConfiguration(config);
                    cornerstoneTools.magnify.activate(element, 1);
                    cornerstoneTools.magnifyTouchDrag.activate(element);
                    return false;
                });
                $('.zoom').click(function () {
                    disableAllTools();
                    cornerstoneTools.zoom.activate(element, 5); // 5 means left mouse button and right mouse button
                });
                $('.enableLength').click(function () {
                    disableAllTools();
                    cornerstoneTools.length.activate(element, 1);
                });
                $('.probe').click(function () {
                    disableAllTools();
                    cornerstoneTools.probe.activate(element, 1);
                });
                $('.circleroi').click(function () {
                    disableAllTools();
                    cornerstoneTools.ellipticalRoi.activate(element, 1);
                });
                $('.rectangleroi').click(function () {
                    disableAllTools();
                    cornerstoneTools.rectangleRoi.activate(element, 1);
                });
                $('.angle').click(function () {
                    disableAllTools();
                    cornerstoneTools.angle.activate(element, 1);
                });
                $('.select_open').click(function () {
                    disableAllTools();
                });
                $('.highlight').click(function () {
                    disableAllTools();
                    cornerstoneTools.highlight.activate(element, 1);
                });

                $('#save').click(function() {
                    var filename = 'download.png';
                    cornerstoneTools.saveAs(element, filename);
                    return false;
                });
                $('.freehand').click(function () {
                    disableAllTools();
                    cornerstoneTools.freehand.activate(element, 1);
                });
                $('.rotate').click(function () {
                    disableAllTools();
                    cornerstoneTools.rotate.activate(element, 1);
                    cornerstoneTools.rotateTouchDrag.activate(element);
                    return false;
                });
                $('.annotation').click(function () {
                    disableAllTools();
                    cornerstoneTools.arrowAnnotate.setConfiguration(config);
                    cornerstoneTools.arrowAnnotate.activate(element, 1);
                    cornerstoneTools.arrowAnnotateTouch.activate(element);
                })

            }, function (err) {
                alert(err);
            });
        } catch (err) {
            alert(err);
        }
    }

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
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

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
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

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
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

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
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    viewport = cornerstone.getViewport(target_element);
                    viewport.rotation -=90;
                    cornerstone.setViewport(target_element, viewport);
                });

                $('#rRotate').click(function (e) {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    viewport = cornerstone.getViewport(target_element);
                    viewport.rotation +=90;
                    cornerstone.setViewport(target_element, viewport);
                });

                // Tool button event handlers that set the new active tool
                $('.enableWindowLevelTool').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

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
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

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
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                    cornerstoneTools.zoom.activate(target_element, 5); // 5 means left mouse button and right mouse button
                });
                $('.enableLength').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                    cornerstoneTools.length.activate(target_element, 1);
                });
                $('.probe').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                    cornerstoneTools.probe.activate(target_element, 1);
                });
                $('.circleroi').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                    cornerstoneTools.ellipticalRoi.activate(target_element, 1);
                });
                $('.rectangleroi').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                    cornerstoneTools.rectangleRoi.activate(target_element, 1);
                });
                $('.angle').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                    //cornerstoneTools.angle.activate(target_element, 1);
                    cornerstoneTools.simpleAngle.activate(target_element, 1);
                    //cornerstoneTools.simpleAngleTouch.activate(target_element);
                });
                $('.select_open').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                });
                $('.highlight').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                    cornerstoneTools.highlight.activate(target_element, 1);
                });

                $('#save').click(function() {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    $("#length_tools").hide();
                    var filename = 'download.png';
                    cornerstoneTools.saveAs(target_element, filename);
                    return false;
                });
                $('.freehand').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                    cornerstoneTools.freehand.activate(target_element, 1);
                });
                $('.rotate').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    $("#length_tools").hide();
                    disableAllTools();
                    cornerstoneTools.rotate.activate(target_element, 1);
                    cornerstoneTools.rotateTouchDrag.activate(target_element);
                    return false;
                });
                $('.annotation').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

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

    var bPlaying = false;
    var bShowPlay = false;
    $("#playToolPc").hide();

    $('#play').click(function() {
        if ($("#3D_win").css("display") != "none") return;
        if ($("#MPR_win").css("display") != "none") return;

        //if ( bPlaying == true) return;
        bShowPlay = !bShowPlay;
        if ( bShowPlay == true) $("#playToolPc").show();
        else
        {
            cornerstoneTools.stopClip(element);
            //bPlaying = false;
            $('#pauseBtn').trigger('click');
            $("#playToolPc").hide();
        }

    });

    $('#pauseBtn').click(function() {
        //cornerstoneTools.stopClip(element);
        //bPlaying = false;

        var target_element;
        if ($("#oneOneScreen").css("display") == "none")
        {
            var value = $(".seriesBox.select").find("canvas[class!='magnifyTool'][style*='border: 2px solid rgb(51, 122, 183)']").length;
            if (value)
            {
                target_element = $(".seriesBox.select").find("canvas[class!='magnifyTool'][style*='border: 2px solid rgb(51, 122, 183)']").parent().get(0);
                cornerstoneTools.stopClip(target_element);
            }

        }
        else
        {
            target_element = $('#dicomImage').get(0);
            cornerstoneTools.stopClip(target_element);
        }
    });

    $('#playBtn').click(function() {
        //if ( bPlaying == true) return;
        //cornerstoneTools.playClip(element, 2);
        //var value = $(".seriesBox.select").length;
        var target_element;
        if ($("#oneOneScreen").css("display") == "none")
        {
            var value = $(".seriesBox.select").find("canvas[class!='magnifyTool'][style*='border: 2px solid rgb(51, 122, 183)']").length;
            if (value)
            {
                target_element = $(".seriesBox.select").find("canvas[class!='magnifyTool'][style*='border: 2px solid rgb(51, 122, 183)']").parent().get(0);
                cornerstoneTools.playClip(target_element, 2);
            }

        }
        else
        {
            target_element = $('#dicomImage').get(0);
            cornerstoneTools.playClip(target_element, 2);
        }
    });

    function forwardPlayImg() {
        cornerstoneTools.stopClip(element);
        $('#pauseBtn').trigger('click');
        var targetElement;
        if ($("#oneOneScreen").css("display") == "none")
        {
            var value = $(".seriesBox.select").find("canvas[class!='magnifyTool'][style*='border: 2px solid rgb(51, 122, 183)']").length;
            if (value)
            {
                targetElement = $(".seriesBox.select").find("canvas[class!='magnifyTool'][style*='border: 2px solid rgb(51, 122, 183)']").parent().get(0);
            }

        }
        else
        {
            targetElement = $('#dicomImage').get(0);
        }

        var stackToolDataSource = cornerstoneTools.getToolState(targetElement, 'stack');
        if (stackToolDataSource === undefined) {
            return;
        }
        var stackData = stackToolDataSource.data[0];
        //console.log(stackData.currentImageIdIndex);
        var newImageIdIndex;
        if (stackData.currentImageIdIndex < 1) newImageIdIndex = stackData.imageIds.length - 1;
        else newImageIdIndex = stackData.currentImageIdIndex - 1;
        cornerstone.loadAndCacheImage(stackData.imageIds[newImageIdIndex]).then(function(image) {
            var viewport = cornerstone.getViewport(targetElement);
            stackData.currentImageIdIndex = newImageIdIndex;
            cornerstone.displayImage(targetElement, image, viewport);
        });
    }

    function backwardPlayImg() {
        cornerstoneTools.stopClip(element);
        $('#pauseBtn').trigger('click');
        var targetElement;
        if ($("#oneOneScreen").css("display") == "none")
        {
            var value = $(".seriesBox.select").find("canvas[class!='magnifyTool'][style*='border: 2px solid rgb(51, 122, 183)']").length;
            if (value)
            {
                targetElement = $(".seriesBox.select").find("canvas[class!='magnifyTool'][style*='border: 2px solid rgb(51, 122, 183)']").parent().get(0);
            }

        }
        else
        {
            targetElement = $('#dicomImage').get(0);
        }
        var stackToolDataSource = cornerstoneTools.getToolState(targetElement, 'stack');
        if (stackToolDataSource === undefined) {
            return;
        }
        var stackData = stackToolDataSource.data[0];
        var len = stackData.imageIds.length - 1;
        //console.log(stackData.currentImageIdIndex);
        var newImageIdIndex;
        if (stackData.currentImageIdIndex == len)
        {
            newImageIdIndex = 0;
            //console.log("err: " + stackData.imageIds.length);
        }
        else newImageIdIndex = stackData.currentImageIdIndex + 1;
        //console.log("newImageIdIndex: " + newImageIdIndex);
        cornerstone.loadAndCacheImage(stackData.imageIds[newImageIdIndex]).then(function(image) {
            var viewport = cornerstone.getViewport(targetElement);
            stackData.currentImageIdIndex = newImageIdIndex;
            cornerstone.displayImage(targetElement, image, viewport);
        });
    }


    function loadAndViewImage(imageId) {
        //console.log(imageId);
        try {
            var start = new Date().getTime();
            cornerstone.loadAndCacheImage(imageId).then(function (image) {
                var viewport = cornerstone.getDefaultViewportForImage(element, image);
                cornerstone.displayImage(element, image, viewport);
                if (loaded === false) {
                    cornerstoneTools.mouseInput.enable(element);
                    cornerstoneTools.mouseWheelInput.enable(element);
                    cornerstoneTools.wwwc.activate(element, 1); // ww/wc is the default tool for left mouse button
                    cornerstoneTools.pan.activate(element, 2); // pan is the default tool for middle mouse button
                    cornerstoneTools.zoom.activate(element, 4); // zoom is the default tool for right mouse button
                    //cornerstoneTools.zoomWheel.activate(element); // zoom is the default tool for middle mouse wheel
                    cornerstoneTools.zoomWheel.deactivate(element);
                    cornerstoneTools.probe.enable(element);
                    cornerstoneTools.length.enable(element);
                    cornerstoneTools.ellipticalRoi.enable(element);
                    cornerstoneTools.rectangleRoi.enable(element);
                    cornerstoneTools.angle.enable(element);
                    cornerstoneTools.highlight.enable(element);
                    cornerstoneTools.magnify.enable(element);
                    cornerstoneTools.magnifyTouchDrag.enable(element);
                    loaded = true;
                }
                // helper function used by the tool button handlers to disable the active tool
                // before making a new tool active
                function disableAllTools() {
                    $('#pauseBtn').trigger('click');
                    cornerstoneTools.wwwc.disable(element);
                    cornerstoneTools.pan.activate(element, 2); // 2 is middle mouse button
                    cornerstoneTools.zoom.activate(element, 4); // 4 is right mouse button
                    cornerstoneTools.probe.deactivate(element, 1);
                    cornerstoneTools.length.deactivate(element, 1);
                    cornerstoneTools.ellipticalRoi.deactivate(element, 1);
                    cornerstoneTools.rectangleRoi.deactivate(element, 1);
                    cornerstoneTools.magnify.disable(element);
                    cornerstoneTools.magnifyTouchDrag.disable(element);
                    cornerstoneTools.angle.deactivate(element, 1);
                    cornerstoneTools.highlight.deactivate(element, 1);
                    cornerstoneTools.freehand.deactivate(element, 1);
                    cornerstoneTools.freehand.deactivate(element, 1);
                    cornerstoneTools.rotate.disable(element);
                    cornerstoneTools.rotateTouchDrag.disable(element);
                    cornerstoneTools.arrowAnnotate.disable(element);
                    cornerstoneTools.arrowAnnotateTouch.disable(element);

                }

                $('#hFlip').click(function (e) {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    viewport = cornerstone.getViewport(element);
                    viewport.hflip = !viewport.hflip;
                    cornerstone.setViewport(element, viewport);
                    var elementDiv = $(element);
                    var rightMid = elementDiv.find('.mrrightmiddle .orientationMarker');
                    var leftMid = elementDiv.find('.mrleftmiddle .orientationMarker');
                    var temp = rightMid.text();
                    rightMid.text(leftMid.text());
                    leftMid.text(temp);
                });

                $('#invert').click(function() {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    var viewport = cornerstone.getViewport(element);
                    if (viewport.invert === true) {
                        viewport.invert = false;
                    } else {
                        viewport.invert = true;
                    }
                    cornerstone.setViewport(element, viewport);

                    return false;
                });

                $('#vFlip').click(function (e) {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    viewport = cornerstone.getViewport(element);
                    viewport.vflip = !viewport.vflip;
                    cornerstone.setViewport(element, viewport);
                    var elementDiv = $(element);
                    var topMid = elementDiv.find('.mrtopmiddle .orientationMarker');
                    var bottomMid = elementDiv.find('.mrbottommiddle .orientationMarker');
                    var temp = topMid.text();
                    topMid.text(bottomMid.text());
                    bottomMid.text(temp);
                });

                $('#lRotate').click(function (e) {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    viewport = cornerstone.getViewport(element);
                    viewport.rotation -=90;
                    cornerstone.setViewport(element, viewport);
                });

                $('#rRotate').click(function (e) {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    viewport = cornerstone.getViewport(element);
                    viewport.rotation +=90;
                    cornerstone.setViewport(element, viewport);
                });

                // Tool button event handlers that set the new active tool
                $('.enableWindowLevelTool').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                    cornerstoneTools.wwwc.activate(element, 1);
                });
                $('.pan').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                    cornerstoneTools.pan.activate(element, 3); // 3 means left mouse button and middle mouse button
                });
//                    $('.clearToolData').click(function () {
//                        var toolStateManager = cornerstoneTools.getElementToolStateManager(element);
//                        console.log($(element).attr("id"));
//                        // Note that this only works on ImageId-specific tool state managers (for now)
//                        toolStateManager.clear(element);
//                        cornerstone.updateImage(element);
//                    });
                $('.magnify').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();

                    var config = {
                        magnifySize: parseInt(350, 10),
                        magnificationLevel: parseInt(5, 10)
                    };
                    cornerstoneTools.magnify.setConfiguration(config);
                    cornerstoneTools.magnify.activate(element, 1);
                    cornerstoneTools.magnifyTouchDrag.activate(element);
                    return false;
                });
                $('.zoom').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                    cornerstoneTools.zoom.activate(element, 5); // 5 means left mouse button and right mouse button
                });
                $('.enableLength').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                    cornerstoneTools.length.activate(element, 1);
                });
                $('.probe').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                    cornerstoneTools.probe.activate(element, 1);
                });
                $('.circleroi').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                    cornerstoneTools.ellipticalRoi.activate(element, 1);
                });
                $('.rectangleroi').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                    cornerstoneTools.rectangleRoi.activate(element, 1);
                });
                $('.angle').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                    cornerstoneTools.angle.activate(element, 1);
                });
                $('.select_open').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                });
                $('.highlight').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                    cornerstoneTools.highlight.activate(element, 1);
                });

                $('#save').click(function() {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    $("#length_tools").hide();
                    var filename = 'download.png';
                    cornerstoneTools.saveAs(element, filename);
                    return false;
                });
                $('.freehand').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                    cornerstoneTools.freehand.activate(element, 1);
                });
                $('.rotate').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    $("#length_tools").hide();
                    disableAllTools();
                    cornerstoneTools.rotate.activate(element, 1);
                    cornerstoneTools.rotateTouchDrag.activate(element);
                    return false;
                });
                $('.annotation').click(function () {
                    if ($("#3D_win").css("display") != "none") return;
                    if ($("#MPR_win").css("display") != "none") return;

                    disableAllTools();
                    cornerstoneTools.arrowAnnotate.setConfiguration(config);
                    cornerstoneTools.arrowAnnotate.activate(element, 1);
                    cornerstoneTools.arrowAnnotateTouch.activate(element);
                });

            }, function (err) {
                alert(err);
            });
        } catch (err) {
            alert(err);
        }
    }

    function pause(numberMillis) {
        var now = new Date();
        var exitTime = now.getTime() + numberMillis;


        while (true) {
            now = new Date();
            if (now.getTime() > exitTime)
                return;
        }
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

    function sel_div(target)
    {
        //console.log("test click");
        $(target).css('border', '2px solid #337ab7');
        $(target).siblings().css('border', '1px solid #474b52');
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

    function compareDicomView(param) {
        let wadouri = "wadouri:" + param;
        loadAndCompareView(wadouri);
    }

    function loadAndCompareView(imageId) {
        try {
            var start = new Date().getTime();
            cornerstone.loadAndCacheImage(imageId).then(function (image) {
                var viewport = cornerstone.getDefaultViewportForImage(compareElement, image);
                cornerstone.displayImage(compareElement, image, viewport);
                cornerstoneTools.mouseInput.enable(compareElement);
                cornerstoneTools.mouseWheelInput.enable(compareElement);
                cornerstoneTools.wwwc.activate(compareElement, 1); // ww/wc is the default tool for left mouse button
                cornerstoneTools.pan.activate(compareElement, 2); // pan is the default tool for middle mouse button
                cornerstoneTools.zoom.activate(compareElement, 4); // zoom is the default tool for right mouse button
                cornerstoneTools.zoomWheel.activate(compareElement); // zoom is the default tool for middle mouse wheel
            }, function (err) {
                alert(err);
            });
        } catch (err) {
            alert(err);
        }
    }

    function dicomDetialView(param) {
        localStorage.setItem('vr_cur', param);
        $('#pauseBtn').trigger('click');
        var targetElement;
        if ($("#3D_win").css("display") != "none")
        {
            $("#3D_win").attr('src','<?=base_url()?>assets/dicom/vr_singlepass/index.html');
        }
        else if ($("#MPR_win").css("display") != "none")
        {
            $("#MPR_win").attr('src','<?=base_url()?>assets/dicom/mpr/index.html');
        }
        else if ($("#oneOneScreen").css("display") == "none")
        {
            var value = $(".seriesBox.select").find("canvas[class!='magnifyTool'][style*='border: 2px solid rgb(51, 122, 183)']").length;
            if (value)
            {
                targetElement = $(".seriesBox.select").find("canvas[class!='magnifyTool'][style*='border: 2px solid rgb(51, 122, 183)']").parent().get(0);
                //console.log($(targetElement).attr("id"));
                var tag_id = $(targetElement).attr("id");
                if (tag_id.indexOf("sub") != -1)
                {
                    $(targetElement).parent().parent().attr("data-src", param);
                    var siblings_num = $(targetElement).siblings().length + 1;
                    for (var i=0; i < siblings_num ; i++)
                    {
                        var sub_wnd = $(targetElement).parent().children().eq(i).get(0);
                        //console.log($(target).parent().attr("class"));
                        //console.log($(sub_wnd).attr("class"));
                        dicomDetialView2(sub_wnd, param);
                    }
                }
                else
                {
                    $(targetElement).attr("data-src", param);
                    dicomDetialView2(targetElement, param);
                }
            }

        }
        else
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
            //cornerstoneTools.mouseInput.enable(element);
            //cornerstoneTools.mouseWheelInput.enable(element);
            cornerstoneTools.addStackStateManager(element, ['stack', 'playClip']);
            cornerstoneTools.addToolState(element, 'stack', stack1);
            //cornerstoneTools.stackScroll.activate(element, 1);
            cornerstoneTools.stackScrollWheel.activate(element);
            //cornerstoneTools.scrollIndicator.enable(element);
            cornerstoneTools.zoomWheel.deactivate(element);
        }

    }

    function dicomDetialView2(target, param) {
        $('#pauseBtn').trigger('click');
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
                        sexClass = ' ';
                        break;
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
        $("#active_2d").addClass("active");
        //$('#option1').trigger('click');
    }, time);

</script>

</body>

</html>
