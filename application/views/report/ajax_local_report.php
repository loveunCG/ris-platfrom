<!-- BEGIN CONTENT BODY -->
<div class="row" id="sortable_portlets">
	<div class="col-md-12 column sortable">
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN VALIDATION STATES-->
				<div class="portlet portlet-sortable box blue-madison ">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-magnifier"></i>
							<span class="caption-subject font-light sbold uppercase">查询条件</span>
						</div>
					</div>
					<div class="portlet-body">
						<!-- BEGIN FORM-->
						<div action="#" method="post" class="form-horizontal" id="search_report_form" novalidate>
							<!-- <div class="row">
								<div class="col-lg-12 col-md-12 form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">数据类型：</label>
									<div class="col-md-10">
										<div class="md-radio-inline">
											<div class="md-radio">
												<input type="radio" id="radio53" name="data_type" value="local" class="md-radiobtn">
												<label for="radio53">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> 本院数据 </label>
											</div>
											<div class="md-radio has-error">
												<input type="radio" id="radio54" name="data_type" value="remote" class="md-radiobtn" checked>
												<label for="radio54">
													<span></span>
													<span class="check"></span>
													<span class="box"></span> 医联体</label>
											</div>
										</div>
									</div>
								</div>
							</div> -->
							<div class="row">
								<div class="col-lg-12 col-md-12 form-group form-md-line-input">
									<form id="searchByTimeform">
										<label class="col-md-2 control-label" for="form_control_1">
											检查时间:
										</label>
										<div class="col-md-1">
											<select class="form-control" name="time_type">
												<option value="1">登记时间</option>
												<option value="2">检查时间</option>
												<option value="3">预约时间</option>
											</select>
											<span class="help-block">请输入姓名</span>
										</div>
										<div class="clearfix col-md-3">
											<input type="hidden" name="searchdate" id = "search_date"/>
											<button type="button" onclick="serachbydate(1)" class="btn blue-madison ">今天</button>
											<button type="button" onclick="serachbydate(2)" class="btn blue-madison ">昨天</button>
											<button type="button" onclick="serachbydate(3)" class="btn blue-madison ">最近3天</button>
											<button type="button" onclick="serachbydate(4)" class="btn blue-madison ">最近7天</button>
										</div>
										<div class="form-group col-md-3">
											<label class="col-md-3 control-label" for="form_control_1">时间</label>
											<div class="col-md-9">
												<input type="text" class="form-control date-picker" name="start_time" placeholder="01/01/2017">
											</div>
										</div>
										<div class="form-group col-md-3">
											<label class="col-md-3 control-label" for="form_control_1">到</label>
											<div class="col-md-9">
												<input type="text" class="form-control date-picker" name="end_time" placeholder="01/01/2017">
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="row">
								<form id = "search_by_device_type_form">
									<div class="col-lg-12 col-md-12 form-group form-md-line-input">
										<label class="col-md-2 control-label" for="form_control_1">
											设备类型：
										</label>
										<div class="col-md-9">
											<div class="clearfix">
												<button type="button" onclick="search_by_device_type()" class="btn blue-madison">
													全部
												</button>
												<?php foreach ($device_class as $values): ?>
												<button type="button" onclick="search_by_device_type('<?=$values->equipment_type?>')" class="btn blue-madison">
													<?=$values->equipment_type?>
												</button>
											  <?php endforeach;?>
												<input type="hidden" name="checkup_type" id = "search_check_type" />
												<button type="button" class="btn blue-madison pull-right" onclick="searchByTime()">
													<span class="glyphicon glyphicon-search"> </span>查询</button>
											</div>
										</div>
									</div>
								</form>
							</div>
							<div class="row">
								<form id="search_by_treat_status_form">
									<div class="col-lg-12 col-md-12 form-group form-md-line-input">
										<label class="col-md-2 control-label" for="form_control_1">
											医疗状态：
										</label>
										<div class="col-md-9">
											<div class="clearfix">
												<button type="button" onclick="search_by_treat_status()" class="btn blue-madison">全部
												</button>
												<?php foreach ($bk_status as $values): ?>
												<button type="button" onclick="search_by_treat_status('<?=$values->status?>')" class="btn blue-madison">
													<?=$values->name?>
												</button>
												<?php endforeach;?>
												<input type="hidden" name="checkup_status" id="search_checkup_status" />
												<button type="button" class="btn yellow pull-right" id="detail_search_view">
													<span class="glyphicon glyphicon-search"> </span>更多查询</button>
											</div>
										</div>
									</div>
								</form>
							</div>
							<form id="detail_search_view_field">
								<div class="row">
									<div class="col-lg-3 col-md-6 form-group form-md-line-input">
										<label class="col-lg-5 col-md-3 control-label" for="form_control_1">
											<?=$this->lang->line('name')?>
										</label>
										<div class="col-md-9 col-lg-7">
											<input type="text" class="form-control" id="patient_name" name="patient_name">
											<div class="form-control-focus"> </div>
											<span class="help-block">请输入姓名</span>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 form-group form-md-line-input">
										<label class="col-md-3 col-lg-5 control-label" for="form_control_1">
											<?=$this->lang->line('image_num')?>
										</label>
										<div class="col-md-9 col-lg-7">
											<input type="text" class="form-control" placeholder="" id="image_num" name="image_num">
											<div class="form-control-focus"> </div>
											<span class="help-block">请输入
												<?=$this->lang->line('image_num')?>
											</span>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 form-group form-md-line-input">
										<label class="col-md-3 col-lg-5 control-label" for="form_control_1">
											<?=$this->lang->line('age')?>
										</label>
										<div class="col-md-9 col-lg-7">
											<input type="text" class="form-control" id="patient_age" name="patient_age">
											<div class="form-control-focus"> </div>
											<span class="help-block">请输入
												<?=$this->lang->line('age')?>
											</span>

										</div>
									</div>
									<div class="col-lg-3 col-md-6 form-group form-md-line-input">
										<label class="col-md-3 col-lg-5 control-label" for="form_control_1">
											<?=$this->lang->line('gender')?>
										</label>
										<div class="col-md-9 col-lg-7">
											<select class="form-control" id="patient_gender" name="patient_gender">
												<option value="">请选择</option>
												<option value="0">男</option>
												<option value="1">女</option>
											</select>
											<div class="form-control-focus"> </div>

										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-3 col-md-6 form-group form-md-line-input">
										<label class="col-md-3 col-lg-5 control-label" for="form_control_1">
											<?=$this->lang->line('remote_contact')?>
										</label>
										<div class="col-md-9 col-lg-7">
											<select class="form-control" id="remote_status" name="remote_status">
												<option value="">请选择</option>
												<option value="1">是</option>
												<option value="0">否</option>
											</select>
											<div class="form-control-focus"> </div>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 form-group form-md-line-input">
										<label class="col-md-3 col-lg-5 control-label" for="form_control_1">
											<?=$this->lang->line('patient_source')?>
										</label>
										<div class="col-md-9 col-lg-7">
											<select class="form-control" id="patient_source" name="patient_source">
												<option value="">请选择</option>
												<option value="0">门诊</option>
												<option value="1">住院</option>
												<option value="2">体检</option>
											</select>
											<div class="form-control-focus"> </div>
										</div>
									</div>
									<div class="col-lg-4 col-md-12 col-sm-12">
										<div class=" pull-right form-group form-md-input">
											<div class="col-md-6 col-sm-12">
												<button type="button" class="btn yellow" id="search_report_btn">
													<span class="glyphicon glyphicon-search"> </span>查询</button>
											</div>
											<div class="col-md-6 col-sm-12">
												<button type="button" class="btn blue " onclick="search_clear()">
													<span class="glyphicon glyphicon-refresh"> </span>重置</button>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet portlet-sortable box blue-madison portlet-datatable ">
					<div class="portlet-title">
						<div class="caption">
							<span class="glyphicon glyphicon-list-alt"> </span>
							<span class="caption-subject font-light sbold uppercase">报告列表</span>
						</div>
					</div>
					<div class="portlet-body">
						<div class="clearfix" style="margin-left: 10%;">
							<?php $usrRole = $this->session->userdata('usr_role')?>
						</div>
						<table class="table table-striped table-bordered table-hover" style="text-align: center;" id="report_table_info">
							<thead>
								<tr>
									<th style="text-align: center;">操作 </th>
									<th style="text-align: center;">序号</th>
									<th style="text-align: center;">医疗状态</th>
									<th style="text-align: center;">患者编号</th>
									<th style="text-align: center;">姓名</th>
									<th style="text-align: center;">年龄</th>
									<th style="text-align: center;">性别</th>
									<th style="text-align: center;">检查类型</th>
									<th style="text-align: center;">检查项目</th>
									<th style="text-align: center;">检查时间</th>
									<th style="text-align: center;">接入医院</th>
									<th style="text-align: center;">报告书写医生</th>
									<th style="text-align: center;">报告审核医生</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="report_detail_view_modal" data-iziModal-icon="icon-home"/>
	<div id="dicom_share_modal" data-iziModal-icon="icon-home"/>
	<div id="review_modal" data-iziModal-icon="icon-home"/>
	<div id="report_upload_modal" data-iziModal-icon="icon-home"/>
	<script>
		let table = [];
		var base_url = '<?=base_url()?>';
		let report_detail_view_modal;

		function make_report(chc_id) {
			var base_url = '<?=base_url()?>';
			var strURL = base_url + "report/dicomProc/" + chc_id;
			var win = window.open(strURL, '_blank');
			var strURL = base_url + "report/reporting/" + chc_id;
			window.location.href = strURL;
			win.focus();
		}

		function edit_report(chc_id){
			var strURL = base_url + "report/reporting/" + chc_id;
			window.location.href = strURL;
		}

		function remote_contact_proc(booking_id) {
			var strURL = '<?=base_url()?>contact/select/' + booking_id;
			window.location.href = strURL;
		}

		function uploadDicom(chc_id){

				let settings = {
						"url": base_url+'report/ajax_report_upload_dicom/'+chc_id,
						"method": "get"
				};
				$('#report_upload_modal').iziModal({
					padding: 30,
					theme: 'material',
					closeButton: true,
					title: '上传影像',
					onOpening: function(modal){
							modal.startLoading();
							$.ajax(settings).done(function (response) {
								$("#report_upload_modal .iziModal-content").html(response);
								modal.stopLoading();
							});
					}
				});
				$('#report_upload_modal').iziModal('open');
		}

		function review(report_id){
			let settings = {
					"url": base_url+'report/ajax_review/'+report_id,
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
							// console.log(response)
							$("#review_modal .iziModal-content").html(response);
							modal.stopLoading();
						});
					}
			});
			$('#review_modal').iziModal('open');

		}

		function searchByTime() {
			var form_data = $('#searchByTimeform').serialize();
			var base_url = '<?=base_url()?>';
			var ajaxurl = base_url + 'report/search_report?' + form_data;
			table.ajax.url(ajaxurl).load();
		}

		function dicom_view(chc_id) {
				var base_url = '<?=base_url()?>';
				var strURL = base_url + "report/dicomProc/" + chc_id;
				var win = window.open(strURL, '_blank');
				win.focus();
		};

		function reportView(chc_id){
			var strURL = base_url + "report/reporting_view/" + chc_id;
			window.location.href = strURL;

		}
		function reporting_detail_view(chc_id){
			report_detail_view_modal = $("#report_detail_view_modal");
			let settings = {
					"url": base_url+'report/ajax_report_detail_view/'+chc_id,
					"method": "get"
			};
			$('#report_detail_view_modal').iziModal({
				padding: 15,
				theme: 'material',
				width: 600,
				closeButton: true,
				title: '详细信息',
				onOpening: function(modal){
						modal.startLoading();
						$.ajax(settings).done(function (response) {
							// console.log(response)
							$("#report_detail_view_modal .iziModal-content").html(response);
							modal.stopLoading();
						});
				}
			});
			report_detail_view_modal.iziModal('open');
		}

		function sharedicom(chc_id){
			let settings = {
					"url": base_url+'report/ajax_dicom_share_view/'+chc_id,
					"method": "get"
			};
			$('#dicom_share_modal').iziModal({
				padding: 15,
				theme: 'material',
				closeButton: true,
				title: '分享影像',
				onOpening: function(modal){
						modal.startLoading();
						$.ajax(settings).done(function (response) {
							// console.log(response)
							$("#dicom_share_modal .iziModal-content").html(response);
							modal.stopLoading();
						});
				}
			});
			$('#dicom_share_modal').iziModal('open');
		}

		function contact_proc() {
			var booking_id = $("#booking_id").val();
			var base_url = '<?=base_url()?>';
			var strURL = base_url + "contact/" + booking_id;
			window.location.href = strURL;

		};

		function report_detail_view() {
			var booking_id = $("#booking_id").val();
			var base_url = '<?=base_url()?>';
			var strURL = base_url + "report/reporting_view/" + booking_id;
			window.location.href = strURL;

		};

		function search_clear() {
			$('#detail_search_view_field')[0].reset();
		};

		function serachbydate(param){
			$('#search_date').val(param);
			var form_data = $('#searchByTimeform').serialize();
			var base_url = '<?=base_url()?>';
			var ajaxurl = base_url + 'report/search_report?' + form_data;
			table.ajax.url(ajaxurl).load();
			$('#search_date').val(null);

		}

		function search_by_device_type(param){
			$('#search_check_type').val(param);
			var form_data = $('#search_by_device_type_form').serialize();
			var base_url = '<?=base_url()?>';
			var ajaxurl = base_url + 'report/search_report?' + form_data;
			table.ajax.url(ajaxurl).load();
		}

		function search_by_treat_status(param){
			$('#search_checkup_status').val(param);
			var form_data = $('#search_by_treat_status_form').serialize();
			var base_url = '<?=base_url()?>';
			var ajaxurl = base_url + 'report/search_report?' + form_data;
			table.ajax.url(ajaxurl).load();
		}

		$(document).ready(function () {

			var tbl_usr_info = '<?=base_url()?>' + 'report/search_report';
			table = $('#report_table_info').DataTable({
				"ajax": tbl_usr_info,
				dom: 'Bfrtip',
				"ordering": false,
				select: true,
				"searching": false,
				language: {
					aria: {
						sortAscending: ": activate to sort column ascending",
						sortDescending: ": activate to sort column descending"
					},
					emptyTable: "没有数据",
					info: "显示 _START_ 到 _END_ 的 _TOTAL_ 条记录",
					infoEmpty: "找不到",
					search: "",
					infoFiltered: "(filtered1 from _MAX_ total records)",
					lengthMenu: "显示 _MENU_",
					zeroRecords: "找不到匹配的记录",
					paginate: {
						previous: "Prev",
						next: "Next",
						last: "Last",
						first: "First"
					}
				},
				buttons: [{
					extend: "print",
					className: "btn dark btn-outline",
					text: "打印"
				}, {
					extend: "copy",
					className: "btn red btn-outline",
					text: "复制"

				}, {
					extend: "pdf",
					className: "btn green btn-outline",
					text: "pdf"
				}, {
					extend: "excel",
					className: "btn yellow btn-outline "
				}, {
					extend: "csv",
					className: "btn purple btn-outline "
				}],
				bStateSave: !0,
				columnDefs: [{
					targets: 0,
					orderable: !1,
					searchable: !0
				}],
				lengthMenu: [
					[10, 15, 20, -1],
					[10, 15, 20, "All"]
				],
				pageLength: 10,
				dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
				pagingType: "bootstrap_full_number",
				columnDefs: [{
					orderable: !1,
					targets: [0]
				}, {
					searchable: !0,
					targets: [0]
				}]
			});
			var toggle_search_button = true;
			table.buttons().remove();

			$('input[type=radio][name=data_type]').change(function () {
				console.log(this.value)
			});

			$("#search_report_btn").click(function () {
				var base_url = '<?=base_url()?>';
				var formData = $('#detail_search_view_field').serialize();
				var ajaxurl = base_url + 'report/search_report?' + formData;
				table.ajax.url(ajaxurl).load();
			});

			$('#detail_search_view_field').hide();

			$(".date-picker").datepicker({
					rtl: App.isRTL(),
					orientation: "left",
					autoclose: !0
			});

			$('#detail_search_view').click(function () {
				if (toggle_search_button) {
					toggle_search_button = false
					$('#detail_search_view_field').show();
					$('#detail_search_view').html('<span class="glyphicon glyphicon-search"> </span>收起查询')
				} else {
					toggle_search_button = true;
					$('#detail_search_view_field').hide();
					$('#detail_search_view').html('<span class="glyphicon glyphicon-search"> </span>更多查询')
				}

			})
		});

	</script>
