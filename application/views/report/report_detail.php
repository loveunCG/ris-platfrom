<link href="<?=base_url()?>assets/global/css/iziModal.min.css" rel="stylesheet" type="text/css" />

<div class="page-content-wrapper" id="outprint">
    <div class="page-content">
        <div id="sortable_portlets">
            <div class="row">
                <div class="portlet box light col-md-12">
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-8 report-detail-left" style="margin-top: 3%;">
                                <ul class="media-list">
                                    <li class="media">
                                        <a class="pull-right " href="#">
                                            <img class="media-object Qr-code-image" src="<?=base_url().$report_data->qr_code?> "
                                                alt="this is QR" data-src="../assets/global/plugins/holder.js/64x64" style="width:140px"> 微信扫一扫提取电子胶片
                                        </a>
                                        <div class="media-body">
                                            <h1 class="hospital-name"><?=$report_data->hospital_name?></h1>
                                            <h3 class="hospital-name"> <?=$report_data->checkup_type?> 诊断报告 </h3>
                                        </div>
                                    </li>
                                </ul>
                                <div class="report-base-info">
                                    <div class="row">
                                        <div class="col-md-4 report-element">
                                            患者编辑: <?=$report_data->patient_code?>
                                        </div>
                                        <div class="col-md-4  report-element">
                                            病历号: <?=$report_data->patient_code?>
                                        </div>
                                        <div class="col-md-4  report-element">
                                            登记时间: <?=$report_data->booking_time?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3  report-element">
                                            姓名: <?=$report_data->patient_name?>
                                        </div>
                                        <div class="col-md-3  report-element">
                                            性别: <?=$report_data->patient_gender==1?"男":"女"?>
                                        </div>
                                        <div class="col-md-3">
                                            年龄: <?=$report_data->patient_age?>
                                        </div>
                                        <div class="col-md-3">
                                            科室: <?=$report_data->room_num?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            病床号: <?=$report_data->bed_num?>
                                        </div>
                                        <div class="col-md-6">
                                            检查项目: <?=$report_data->checkup_item?>
                                        </div>
                                    </div>
                                </div>
                                <div class="report-contents">
                                    <div class="form-group report-contents" style="padding-top: 18px;" >
                                        <label>影像所见：</label>
                                        <textarea disabled class="form-control" rows="5"><?=$report_data->Imaging_performance?></textarea>
                                    </div>
                                    <div class="form-group report-contents">
                                        <label>影像诊断：</label>
                                        <textarea disabled class="form-control" rows="5"><?=$report_data->recommend_report?></textarea>
                                    </div>
                                </div>
                                <div class="report-footer">
                                    <div class="row">
                                        <div class="col-md-4" disabled>
                                            审核医生： <?=isset($report_data->doctor_name)? $report_data->doctor_name:''?>
                                        </div>
                                        <div class="col-md-4" disabled>
                                            报告医生： <?=get_user_name($report_data->report_doc_name)?>
                                        </div>

                                        <div class="col-md-4">
                                            报告时间: <?=$report_data->report_time?>
                                        </div>
                                    </div>
                                </div>

																<div class="report-certification">
																	<div class="row">
																		<span style="padding-top: 15px;">******此报告仅供本院医生参考，不作证明用******</span>
																	</div>
																	<div class="row">
																		<img class="media-bar-code" src="<?=base_url()?>assets/images/barcode.gif">
																	</div>
																</div>
                            </div>
														<div class="col-md-4" style="margin-top: 3%; position:relative; height: 70vh;">
															<div class="col-md-12 report-class-width" >
																<ul>
																	<li>
																		<i class="icon-check"></i> 阴阳性:    <?=$report_data->urgency_status==0?'阴性':'阳性'?>
																	</li>
																</ul>
															</div>
															<div class="col-md-12">
																<div class="col-md-6">
																	<center>
																		<button class="btn normal-button" onclick="dicom_view()" <?=check_role('DicomView')?'':'disabled'?>>调 图</button>
																	</center>
																</div>
																<div class="col-md-6 ">
																	<center>
																		<button class="btn normal-button" onclick="print_report()">打 印</button>
																	</center>
																</div>
                              </div>
                              <?php if ($isreview&&$report_data->checkup_status ==4) : ?>
                              <div class="col-md-12 review-button-group">
                                <div class="col-md-6">
                                  <center>
                                    <button class="btn normal-button" onclick="review_proc_view()" >审核通过</button>
                                  </center>
                                </div>
                                <div class="col-md-6">
                                  <center>
                                    <button class="btn normal-button" onclick="review_proc_view()">审核回退</button>
                                  </center>
                                </div>
                              </div>
                            <?php endif;?>
                            <?php if ($report_log):?>
                              <div class="col-md-12">
                                <h4> 历史报告</h4>
                                <table class="table centered table-bordered">
                                  <thead style="text-align: center; ">
                                    <th style="text-align: center; ">报告医生</th>
                                    <th style="text-align: center; ">报告时间</th>
                                  </thead>
                                  <tbody style="text-align: center; ">
                                    <?php foreach ($report_log as $value):?>
                                    <tr>
                                      <td><?=get_user_name($report_data->report_doc_name)?></td>
                                      <td><?=$value->created_at?></td>
                                    </tr>
                                  <?php endforeach;?>
                                  </tbody>
                                </table>
                              </div>
                            <?php endif;?>
                            <?php if ($report_data->checkup_status ==6||$report_data->checkup_status ==5):?>
                            <div class="col-md-12 review-content">
                              <div class="form-group">
                                <label for="form_control_1"><i class="fa fa-sticky-note-o"></i>&nbsp;&nbsp;备注：</label>
                                  <textarea class="form-control" rows="6" readonly><?=$report_data->deliberation_content?></textarea>
                              </div>
                            </div>
                            <?php endif;?>
                              <div class="col-md-12 footer-button">
                                <?php if ($report_data->checkup_status ==6):?>
                                  <center>
                                    <button class="btn normal-button normal-button" onclick="edit_report()">重新编辑</button>
                                  </center>
                                  <?php endif;?>
                                  <div class="col-md-12" style="padding-top: 30px;">
                                    <center>
                                      <button class="btn  normal-button normal-button" onclick="window.history.go(-1)">返回</button>
                                    </center>
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
    <style>
        .hospital-name {
            text-align: center;
        }

        .Qr-code-image {
            width: 100%;
            height: auto;
        }
        .normal-button{
          width: 150px;
          background-color: rgb(51, 153, 153);
          font-size: 14px;
          font-weight: 400;
          font-style: normal;
          text-decoration: none;
          font-family: 微软雅黑;
          color: rgb(255, 255, 255);
          padding: 0px;
          margin: 0px;
          word-break: break-word;
        }

				.report-contents {
						border: hidden;
						height: auto;
				}
        .footer-button {
          position:absolute; right:0px; bottom:0px;
        }

        .review-button-group {
          padding: 20px;
        }
        .review-content {
          padding: 30px;

        }
        .report-base-info {
            font-size: 16px;
            border-style: solid hidden solid hidden;
            border-width: 2px;
            padding: 15px;
        }

        .under-line {
            border-style: solid hidden hidden hidden;
            border-width: 2px;
            margin: 17px;
        }
        .media-bar-code {
          width:200px;
          height: 40px;
        }

        .report-detail-left {
            border-style: hidden solid hidden hidden;
        }

				.report-footer{
					border-style: hidden hidden solid hidden;
					border-width: 2px;
					padding: 15px;
				}
				.report-certification{
					text-align: center;
				}

        .report-element {}
    </style>
    <script src="<?=base_url()?>assets/global/scripts/iziModal.min.js" type="text/javascript"></script>
    <div id="review_modal" data-iziModal-icon="icon-home"/>

    <script>
    var base_url = '<?= base_url()?>';
    function dicom_view() {
				var strURL = base_url + "report/dicomProc/" + <?=$report_data->chc_id?>;
				var win = window.open(strURL, '_blank');
				win.focus();
		}
    function edit_report(){
      var strURL = base_url + "report/reporting/" + <?=$report_data->chc_id?>;
      window.location.href = strURL;
    }

    function review_proc_view(){
			let settings = {
					"url": base_url+'report/ajax_review/'+ '<?=$report_data->report_id?>',
					"method": "get"
			};
			$('#review_modal').iziModal({
				padding: 15,
				theme: 'material',
				closeButton: true,
				title: '报告审核',
				width: 800,
				onOpening: function(modal){
						modal.startLoading();
						$.ajax(settings).done(function (response) {
              console.log(settings)
              $(".iziModal-content").html(response);
							modal.stopLoading();
						});
					}
			});
			$('#review_modal').iziModal('open');
		}

    function print_report(){
      window.print();
    }

    $(function(){

    })
    </script>
