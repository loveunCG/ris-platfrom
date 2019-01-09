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
					<span>DICOM列表</span>
				</li>
			</ul>
		</div>
		<!-- BEGIN CONTENT BODY -->
		<div class="row" id="sortable_portlets">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div class="portvar light portlet-fit ">
							<div class="portlet-title">
								<div class="caption">
									<i class=" icon-layers font-green"></i>
									<span class="caption-subject font-green bold uppercase">DICOM列表</span>
								</div>
							</div>
							<div class="portlet-body">
								<div class="row">.
									<div class="col-md-12">
										<div class="mt-element-list">
											<div class="mt-list-head list-todo green">
												<div class="list-head-title-container">
													<h3 class="list-title">影像号码：
														<?=$booking_data->image_num?>
													</h3>
													<div class="list-head-count">
														<div class="list-head-count-item">
															<i class="fa fa-user"></i>&nbsp;患者名称：
															<?=$booking_data->patient_name?>
														</div>
														<div class="list-head-count-item">
															<i class="fa fa-cog"></i>&nbsp;患者年龄：
															<?=$booking_data->patient_age?>
														</div>
														<div class="list-head-count-item">
															<i class="fa fa-cog"></i>&nbsp;检查时间：
															<?=$booking_data->checked_time?>
														</div>
													</div>
												</div>
											</div>
											<div class="mt-list-container list-todo">
												<div class="list-todo-line"></div>
												<ul id="studyList">
												</ul>
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
	</div>
</div>
<div class="modal fade modal-dialog modal-lg" id="responsive">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">DICOM列表</h4>
		</div>
		<div class="modal-body">
			<div class="scroller" style="height:400px" data-always-visible="1" data-rail-visible1="1">
				<div class="mt-element-list" id="DicomListView">

				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn dark btn-outline" data-dismiss="modal">返回</button>
		</div>
	</div>
</div>
<input id="imageID" type="hidden" value="<?=$booking_data->image_num?>">
<script>

	let dicomBaseSearchUrl = 'https://www.healthviewcn.com:5002/getDicom';
	let modal = $('#responsive');
    let tmpxmlData = [];
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
			var studyList = $("#studyList");
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
				ListData += '<li class="mt-list-item">' +
					'<div class="list-todo-icon bg-white">' +
					'    <i class="fa fa-database"></i>' +
					'</div>' +
					'<div class="list-todo-item dark">' +
					'    <a class="list-toggle-container" data-toggle="collapse" href="#task-1" aria-expanded="false">' +
					'        <div class="list-toggle done uppercase">' +
					'            <div class="list-toggle-title bold" studyUID="' + studyData["studyUID"] + '">' + studyData[
						"studyDate"] + ' 检查设备- ' + studyData["studyMods"] + '&nbsp;' +
					studyData["studyDescr"] + '&nbsp;' + studyData["studyNumSeries"] +
					'</div>' +
					'        </div>' +
					'    </a>' +
					'    <div class="task-list panel-collapse collapse in" >' +
					'    </div>' +
					'</div>' +
					'</li>';
				studyList.append(ListData)
				$('.list-toggle-container').click(function () {;
					var taskList = $(this).next();
					var listToggleContianer = this;
					var studyUID = $(this).find('.list-toggle-title').attr('studyUID');
					var uri = gwInstance.BaseUrl + "?operation=cfind&studyUID=" + studyUID;
					$.ajax({
						type: "GET",
						url: uri,
						dataType: "xml"
					}).done(function (xml, textStatus, jqXHR) {
						$(listToggleContianer).unbind();
						gwInstance.parseXmlStudy(xml, taskList);

					}).always(function () {
						//gwInstance.hideLoading();
					});
				});
			});
		}
		parseXmlStudy(xml, listToggleContianer) {
			$(listToggleContianer).unbind('click')
			var listToggleContianertmp = $(listToggleContianer).find('.task-list')
			console.log('tmp is not scale', listToggleContianertmp);
			var gwInstance = this; //  studyID에 의  한
			var studyDataList = '';
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
				liData += " - " + seriesData["seriesDescr"];
				liData += '';
				studyDataList += '<li class="task-list-item done" respNumber="' + respNumber + '" seriesUID="' + seriesUID +
					'">\n' +
					'    <div class="task-icon">\n' +
					'        <a href="javascript:;">\n' +
					'             <i class="fa fa-eye"></i>' +
					'        </a>\n' +
					'    </div>\n' +
					'    <div class="task-status">\n' +
					'        <a class="done" href="javascript:;">\n' +
					'            <i class="fa fa-check"></i>\n' +
					'        </a>\n' +
					'        <a class="pending" href="javascript:;">\n' +
					'            <i class="fa fa-close"></i>\n' +
					'        </a>\n' +
					'    </div>\n' +
					'    <div class="task-content">\n' +
					'        <h4 class="uppercase bold">\n' +
					'            <a href="javascript:;">' + liData + '</a>\n' +
					'        </h4>\n' +
					'        <p></p>\n' +
					'    </div>\n' +
					'</li>';
			});
			$('<ul></ul>').html(studyDataList).appendTo(listToggleContianer);
			$("li.task-list-item").click(function () {
				var seriesData = [];
				var seriesUID = $(this).attr('seriesUID');
				var respNumber = $(this).attr('respNumber');
				// console.log("click: " + seriesUID + ", respNumber: " + respNumber);
				var numInstances = $(xml).find("qresponse[qrequest=" + respNumber + "]").length;
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
					seriesData.push(addData)
					// add the full instance data / raw xml ???
				});
				gwInstance.showDicomList(seriesData)
			});
		}
		showDicomList(seriesData) {
            localStorage.setItem('seriesData', JSON.stringify(seriesData));
            //기정으로 첫번째 dicom파일이 로드되게 한다
            var dicomUrlParam = this.BaseUrl + '?operation=wado&studyUID=' + seriesData[0].studyUID + '&seriesUID=' +
                    seriesData[0].seriesUID +
                    '&objectUID=' + seriesData[0].objectUID + '&contentType=application/dicom';
            //console.log(dicomUrlParam);
            dicomDetialView(dicomUrlParam);
            //dicomDetialView('https://www.healthviewcn.com:5005/getDicom?operation=wado&studyUID=1.2.840.113619.2.135.2025.3758228.7500.1433029882.900&seriesUID=1.2.840.113619.2.135.2025.3758228.7076.1433029950.699&objectUID=1.2.840.113619.2.135.2025.3758228.7076.1433029950.765&contentType=application/dicom');
//			var DicomListView = $('#DicomListView')
//			var showContent = '';
//			showContent = '<div class="mt-list-head list-news ext-1 font-white bg-grey-gallery">\n' +
//				'    <div class="list-head-title-container">\n' +
//				'        <h3 class="list-title">DICOM</h3>\n' +
//				'    </div>\n' +
//				'    <div class="list-count pull-right bg-red">' + seriesData.length + '</div>\n' +
//				'</div>';
//			showContent += '<div class="mt-list-container list-news ext-1">' +
//				'<ul>';
//			for (var index in seriesData) {
//				var dicomwadourl = this.BaseUrl + '?operation=wado&studyUID=' + seriesData[index].studyUID + '&seriesUID=' +
//					seriesData[index].seriesUID +
//					'&objectUID=' + seriesData[index].objectUID + '&contentType=image/jpeg';
//				var dicomUrlParam = "'" + this.BaseUrl + '?operation=wado&studyUID=' + seriesData[index].studyUID + '&seriesUID=' +
//                    seriesData[index].seriesUID +
//                    '&objectUID=' + seriesData[index].objectUID + '&contentType=application/dicom'+"'"
//				showContent += '<li class="mt-list-item">\n' +
//					'            <div class="list-icon-container">\n' +
//					'                <a href="javascript:;">\n' +
//					'                    <i class="fa fa-angle-right"></i>\n' +
//					'                </a>\n' +
//					'            </div>\n' +
//					'            <div class="list-thumb">\n' +
//					'                <a  href="javascript:;" onclick="dicomDetialView('+dicomUrlParam+')">\n' +
//					'                    <img alt="" src="' + dicomwadourl + '" />\n' +
//					'                </a>\n' +
//					'            </div>\n' +
//					'            <div class="list-datetime bold uppercase font-red" onclick="dicomDetialView()"> <?//=$booking_data->checked_time?>// </div>\n' +
//					'            <div class="list-item-content">\n' +
//					'                <h3 class="uppercase">\n' +
//					'                    <a href="javascript:;">点击这里。。</a>\n' +
//					'                </h3>\n' +
//					'            </div>\n' +
//					'        </li>';
//			}
//			showContent += '</ul></div>'
//			DicomListView.html(showContent)
//			modal.modal()
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
	function dicomDetialView(param) {
        localStorage.setItem('currentUrl', param);
        localStorage.setItem('baseDicomUrl', dicomBaseSearchUrl);
	    var Data = JSON.parse(localStorage.getItem('seriesData'));
        window.location.href = '<?=base_url()?>report/dicomProc';
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
