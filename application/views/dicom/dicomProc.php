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

</style>

<div class="page-content-wrapper">

	<div class="page-content">
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
					<span>DICOM 调图</span>
				</li>
			</ul>

		</div>
		<!-- BEGIN CONTENT BODY -->
		<div class="row" id="sortable_portlets">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box grey-mint portlet-fit ">
							<div class="portlet-title">
								<div class="caption">
									<i class=" icon-layers font-white"></i>
									<span class="caption-subject font-white bold uppercase">DICOM 调图</span>
								</div>
							</div>
							<div class="portlet-body">
								<div class="row">
									<div class="col-lg-12 pull-right" style="padding-bottom: 1%">
										<div class="btn-group btn-group btn-group-solid">
											<button type="button" class=" enableWindowLevelTool btn-icon-only btn blue-ebonyclay">
												<i class="fa fa-adjust"></i>
											</button>
											<button type="button" class="pan btn-icon-only btn blue-ebonyclay">
												<i class="fa fa-arrows"></i>
											</button>
											<button type="button" class="zoom btn btn-icon-only blue-ebonyclay">
												<i class="fa fa-search-plus"></i>
											</button>
											<button type="button" class="enableLength btn btn-icon-only blue-ebonyclay">
												<i class="fa fa-i-cursor"></i>
											</button>
											<button type="button" class="probe btn btn-icon-only blue-ebonyclay">
												<i class="fa fa-map-marker"></i>
											</button>
											<button type="button" class="circleroi btn btn-icon-only blue-ebonyclay">
												<i class="fa fa-circle-thin"></i>
											</button>
											<button type="button" class="rectangleroi btn btn-icon-only blue-ebonyclay">
												<i class="fa fa-square-o"></i>
											</button>
											<button type="button" class="angle btn btn-icon-only blue-ebonyclay">
												<i class="fa fa-compass"></i>
											</button>
											<button type="button" class="highlight btn btn-icon-only blue-ebonyclay">
												<i class="fa fa-lightbulb-o"></i>
											</button>
											<button type="button" class="freehand btn btn-icon-only blue-ebonyclay">
												<i class="fa fa-share-alt"></i>
											</button>
											<button type="button" class="rotate btn btn-icon-only blue-ebonyclay">
												<i class="fa fa-rotate-left"></i>
											</button>
											<button type="button" class="annotation btn btn-icon-only blue-ebonyclay">
												<i class="fa fa-code-fork"></i>
											</button>
											<button type="button" class="clearToolData btn btn-icon-only blue-ebonyclay">
												<i class="fa fa-eraser"></i>
											</button>
											<button type="button" class="magnify btn btn-icon-only blue-ebonyclay">
												<i class="fa fa-search"></i>
											</button>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
										<div class="mt-element-list" id="DicomListView">
										</div>
									</div>
									<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
										<div class="col-lg-6 col-md-12">
											<div class="portlet box grey-mint " id="dicomViewerContianer">
												<div class="portlet-title ">
													<div class="caption">
														<i class="fa fa-gift "></i>DICOM影像
													</div>
													<div class="actions">
														<span id="dicomIamgeControllViewer" style = "display:none;">
															<button type="button" class=" enableWindowLevelTool btn-icon-only btn blue-ebonyclay">
																<i class="fa fa-adjust"></i>
															</button>
															<button type="button" class="pan btn-icon-only btn blue-ebonyclay">
																<i class="fa fa-arrows"></i>
															</button>
															<button type="button" class="zoom btn btn-icon-only blue-ebonyclay">
																<i class="fa fa-search-plus"></i>
															</button>
															<button type="button" class="enableLength btn btn-icon-only blue-ebonyclay">
																<i class="fa fa-i-cursor"></i>
															</button>
															<button type="button" class="probe btn btn-icon-only blue-ebonyclay">
																<i class="fa fa-map-marker"></i>
															</button>
															<button type="button" class="circleroi btn btn-icon-only blue-ebonyclay">
																<i class="fa fa-circle-thin"></i>
															</button>
															<button type="button" class="rectangleroi btn btn-icon-only blue-ebonyclay">
																<i class="fa fa-square-o"></i>
															</button>
															<button type="button" class="angle btn btn-icon-only blue-ebonyclay">
																<i class="fa fa-compass"></i>
															</button>
															<button type="button" class="highlight btn btn-icon-only blue-ebonyclay">
																<i class="fa fa-lightbulb-o"></i>
															</button>
															<button type="button" class="freehand btn btn-icon-only blue-ebonyclay">
																<i class="fa fa-share-alt"></i>
															</button>
															<button type="button" class="rotate btn btn-icon-only blue-ebonyclay">
																<i class="fa fa-rotate-left"></i>
															</button>
															<button type="button" class="annotation btn btn-icon-only blue-ebonyclay">
																<i class="fa fa-code-fork"></i>
															</button>
															<button type="button" class="clearToolData btn btn-icon-only blue-ebonyclay">
																<i class="fa fa-eraser"></i>
															</button>
															<button type="button" class="magnify btn btn-icon-only blue-ebonyclay">
																<i class="fa fa-search"></i>
															</button>
														</span>
														<a class="btn btn-circle btn-icon-only btn fullscreen" href="javascript:;">
															<i class="fa fa-expand"></i>
														</a>
													</div>
												</div>
												<div class="portlet-body" id="dicomImageContianer">
													<div id="dicomImage"></div>
												</div>
											</div>
										</div>
										<div class="col-lg-6 col-md-12">
											<div class="portlet box grey-mint">
												<div class="portlet-title">
													<div class="caption">
														<i class="fa fa-gift"></i>比较影像
													</div>
												</div>
												<div class="portlet-body" id="dicomcompareImageContianer">
													<div id="compareDicomImage"></div>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
							<div class="clearfix col-md-6" style="margin-top: 2%">
								<button type="button" onclick="history.go(-1);  return false;" class="btn dark pull-right">返回</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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

<script>
	let element = $('#dicomImage').get(0)
	let compareElement = $('#compareDicomImage').get(0)
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
	var triggle = 1;
	var annotationDialog = document.querySelector('.annotationDialog')
	dialogPolyfill.registerDialog(annotationDialog)
	cornerstoneTools.zoom.setConfiguration(config)

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
		var viewport = cornerstone.getViewport(e.target)
		$('#mrbottomleft').text("WW/WC: " + Math.round(viewport.voi.windowWidth) + "/" + Math.round(viewport.voi.windowCenter));
		$('#mrbottomright').text("Zoom: " + viewport.scale.toFixed(2));
	};
	$(element).on("CornerstoneImageRendered", onViewportUpdated);
	$(function () {
		$('#dicomImage').css({
			"width": $('#dicomImageContianer').width(),
			"height": $('#dicomImageContianer').width() * 9 / 16
		})

		$('#compareDicomImage').css({
			"width": $('#dicomcompareImageContianer').width(),
			"height": $('#dicomcompareImageContianer').width() * 9 / 16
		})

		$('.fullscreen').click(function () {
			if (triggle % 2 == 0) {
				$('#dicomViewerContianer').removeClass('portlet-fullscreen')
				$('#dicomImage').css({
					"width": $('#dicomImageContianer').width(),
					"height": $('#dicomImageContianer').width() * 9 / 16
				})
				$('#dicomIamgeControllViewer').hide()

			} else {
				$('#dicomViewerContianer').addClass('portlet-fullscreen')
				$('#dicomImage').css({
					"width": $('#dicomViewerContianer').width(),
					"height": $('#dicomViewerContianer').height()
				})
				$('#dicomIamgeControllViewer').show()
			}
			triggle++;
			let element = $('#dicomImage').get(0)
			cornerstone.enable(element)
			loaded = false;
			// downloadAndView();

		})

		cornerstone.enable(element);
		cornerstone.enable(compareElement);
		DicomViewList();
		downloadAndView();
	})

	function downloadAndView() {
		var url = localStorage.getItem('currentUrl');
		// prefix the url with wadouri: so cornerstone can find the image loader
		url = "wadouri:" + url;
		// image enable the dicomImage element and activate a few tools
		loadAndViewImage(url);
	}
	cornerstoneWADOImageLoader.external.cornerstone = cornerstone
	cornerstoneWADOImageLoader.configure({
		beforeSend: function (xhr) {}
	})
	let loaded = false;

	function loadAndViewImage(imageId) {
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

				}

				// Tool button event handlers that set the new active tool
				$('.enableWindowLevelTool').click(function () {
					disableAllTools();
					cornerstoneTools.wwwc.activate(element, 1);
				});
				$('.pan').click(function () {
					disableAllTools();
					cornerstoneTools.pan.activate(element, 3); // 3 means left mouse button and middle mouse button
				});
				$('.clearToolData').click(function () {
					var toolStateManager = cornerstoneTools.getElementToolStateManager(element);
					// Note that this only works on ImageId-specific tool state managers (for now)
					toolStateManager.clear(element)
					cornerstone.updateImage(element);
				});
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
				$('.highlight').click(function () {
					disableAllTools();
					cornerstoneTools.highlight.activate(element, 1);
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

	function DicomViewList() {
		let DicomViewList = $('#DicomListView')
		let seriesData = JSON.parse(localStorage.getItem('seriesData'))
		var showContent = '<div class="mt-list-head list-news ext-1 font-white bg-grey-mint">\n' +
			'    <div class="list-head-title-container">\n' +
			'        <h3 class="list-title">DICOM</h3>\n' +
			'    </div>\n' +
			'    <div class="list-count pull-right bg-green">' + seriesData.length + '</div>\n' +
			'</div>';
		showContent +=
			'<div class="scroller" style="height:600px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd"><div class="mt-list-container list-news ext-1">' +
			'<ul>';
		for (var index in seriesData) {
			let dicomwadourl = localStorage.getItem('baseDicomUrl') + '?operation=wado&studyUID=' + seriesData[index].studyUID +
				'&seriesUID=' +
				seriesData[index].seriesUID +
				'&objectUID=' + seriesData[index].objectUID + '&contentType=image/jpeg';
			let dicomUrlParam = "'" + localStorage.getItem('baseDicomUrl') + '?operation=wado&studyUID=' + seriesData[index].studyUID +
				'&seriesUID=' +
				seriesData[index].seriesUID +
				'&objectUID=' + seriesData[index].objectUID + '&contentType=application/dicom' + "'"
			showContent += '<li class="mt-list-item">\n' +
				'            <div class="list-icon-container">\n' +
				'                <a href="javascript:;">\n' +
				'                    <i class="fa fa-angle-right"></i>\n' +
				'                </a>\n' +
				'            </div>\n' +
				'            <div class="list-thumb">\n' +
				'                <a  href="javascript:;" onclick="dicomDetialView(' + dicomUrlParam + ')">\n' +
				'                    <img alt="" src="' + dicomwadourl + '" />\n' +
				'                </a>\n' +
				'            </div>\n' +
				'            <div class="list-datetime bold uppercase font-red">请选择比较影像</div>\n' +
				'            <div class="list-item-content">\n' +
				'                <h3 class="uppercase">\n' +
				'                    <a  onclick="compareDicomView(' + dicomUrlParam + ')" href="javascript:;">点击这里。。</a>\n' +
				'                </h3>\n' +
				'            </div>\n' +
				'        </li>';
		}
		showContent += '</ul></div></div>'
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
		localStorage.setItem('currentUrl', param)
		loaded = false;
		downloadAndView();
	}

</script>
