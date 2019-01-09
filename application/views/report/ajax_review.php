<div class="row">
	<div class="col-md-12">
		<div class="col-md-9">
			<h3> 基础信息</h3>
			<table class="table table-bordered table-striped table-condensed flip-content" data-toolbar="#transform-buttons" data-height="299">
				<tbody>
					<tr>
						<td class="title-prex">患者姓名</td>
						<td>
							<?=$report_data->patient_name?>
						</td>
						<td class="title-prex">拼音</td>
						<td>
							<?=$report_data->patient_pinyin?>
						</td>
						<td class="title-prex">性别</td>
						<td>
							<?=$report_data->patient_gender==0?'男':'女'?>
						</td>
					</tr>
					<tr>
						<td class="title-prex">出生日期</td>
						<td>
							<?=$report_data->patient_birthday?>
						</td>
						<td class="title-prex">年龄</td>
						<td>
							<?=$report_data->patient_age?>
						</td>
						<td class="title-prex">民族</td>
						<td>
							<?=$report_data->patient_birthday?>
						</td>
					</tr>
					<tr>
						<td class="title-prex">证件类型</td>
						<td>
							<?=$report_data->patient_birthday?>
						</td>
						<td class="title-prex">证件号码</td>
						<td>
							<?=$report_data->license_num?>
						</td>
						<td class="title-prex">联系电话</td>
						<td>
							<?=$report_data->patient_phone_num?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-3">
			<div class="mt-card-item">
				<div class="mt-card-avatar mt-overlay-1">
					<img class="qr-code" src="<?=base_url()?><?=$report_data->qr_code?>" />
				</div>
				<div class="mt-card-content">
					<center>
						<button type="button" class="btn green" onclick="opendicomView()">调图</button>
					</center>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="form-group">
			<label>影像所见</label>
			<textarea class="form-control" rows="3" disabled><?=$report_data->Imaging_performance?></textarea>
		</div>
		<div class="form-group">
			<label>影像诊断</label>
			<textarea class="form-control" disabled rows="3"><?=$report_data->recommend_report?></textarea>
		</div>
		<form id="review_form">
			<input name="report_id" value="<?=$report_data->report_id?>" type="hidden">
			<input name="deliberation_id" value="<?=isset($report_data->deliberation_id)?$report_data->deliberation_id:''?>" type="hidden">
			<input name="chc_id" value="<?=$report_data->chc_id?>" type="hidden">
			<div class="form-group">
				<label>备注</label>
				<textarea name="content" class="form-control" rows="3"></textarea>
			</div>
		</form>

	</div>
	<div class="col-md-8">
		<button type="button" class="btn green pull-right" onclick="accept_review()">审核通过</button>
	</div>
	<div class="col-md-3">
		<button type="button" class="btn red pull-right" onclick="reject_view()">回退审核</button>
	</div>
</div>

<style>
	.title-prex {
		background: aquamarine;
	}

	td {
		text-align: center;
	}

	.qr-code {
		width: 150px;
	}

</style>

<script>
	var base_url = '<?=base_url()?>'

	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "positionClass": "toast-bottom-center",
	  "onclick": null,
	  "showDuration": "1000",
	  "hideDuration": "1000",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	};
	function accept_review() {
		$.confirm({
			title: '警告!',
			content: '您真通过该检查报告?',
			icon: 'fa fa-warning',
			theme: 'material',
			columnClass: 'small',
			timeoutProgressbar: true,
			draggable: true,
			buttons: {
				OK: {
					text: '确定',
					btnClass: 'btn',
					action: function () {
						var form_data = $('#review_form').serialize();
						var base_url = '<?=base_url()?>';
						console.log(form_data);
						var strURL = base_url + "report/review_proc/";
						$.ajax({
							dataType: "json",
							url: strURL,
							type: 'post',
							data: form_data,
							success: function (response) {
								console.log(response)
								toastr.info(response.message);
								if (response.response_code) {
									setTimeout(function(){
										var base_url = '<?= base_url()?>';
										var strURL = base_url + "report";
										window.location.href = strURL;
									}, 3000);
								}else{

								}
							}
						});

					}
				},
				somethingElse: {
					text: '返回',
					btnClass: 'btn-default',
					keys: ['enter', 'shift'],
					action: function () {
						return true;
					}
				}
			}
		});
	}
	function opendicomView(){
		var strURL = base_url + "report/dicomProc/" + <?=$report_data->chc_id?>;
		var win = window.open(strURL, '_blank');
		win.focus();
	}
	function reject_view() {
		$.confirm({
				title: '警告!',
				content: '您真回退该检查报告?',
				icon: 'fa fa-warning',
				theme: 'material',
				columnClass: 'small',
				draggable: true,
				buttons: {
					OK: {
						text: '确定',
						btnClass: 'btn-default',
						action: function () {
							var form_data = $('#review_form').serialize();
							var base_url = '<?=base_url()?>';
							var strURL = base_url + "report/review_proc/" + 'reject';
							$.ajax({
								dataType: "json",
								url: strURL,
								type: 'post',
								data: form_data,
								success: function (response) {
									toastr.info(response.message);
									if (response.response_code) {
										setTimeout(function(){
											var base_url = '<?= base_url()?>';
											var strURL = base_url + "report";
											window.location.href = strURL;
										}, 3000);
									}else{

									}
								}
							});
					}
				},
				somethingElse: {
					text: '返回',
					btnClass: 'btn-default',
					keys: ['enter', 'shift'],
					action: function () {
						return true;
					}
				}
			}
		});
	}

</script>
