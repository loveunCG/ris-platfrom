<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<!-- BEGIN THEME PANEL -->

		<!-- END THEME PANEL -->
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
					<span>我的报告</span>
				</li>
			</ul>

		</div>
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
									<span class="caption-subject font-green sbold uppercase">检查条件</span>
								</div>
							</div>
							<div class="portlet-body">
								<!-- BEGIN FORM-->
								<form action="#" method="post" class="form-horizontal" id="search_report_form" novalidate>
									<div class="form-body">
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
													<?=$this->lang->line('equipment_type')?>
												</label>
												<div class="col-md-9 col-lg-7">
													<select class="form-control" id="checkup_type" name="checkup_type">
														<option value="">请选择</option>
														<?php
                                                    foreach ($device_class as $values) {
                                                        echo '<option value = "'.$values->equipment_type.'">'.$values->equipment_type.'</option>';
                                                    }
                                                     ?>

													</select>
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="col-lg-3 col-md-6 form-group form-md-line-input">
												<label class="col-md-3 col-lg-5 control-label" for="form_control_1">
													<?=$this->lang->line('report_status')?>
												</label>
												<div class="col-md-9 col-lg-7">
													<select class="form-control" id="booking_status" name="booking_status">
														<option value="">请选择</option>
														<option value="2">未提交</option>
														<option value="3">已提交</option>
														<option value="4">已审核</option>
														<option value="5">回退审核</option>
													</select>
													<div class="form-control-focus"> </div>
												</div>
											</div>
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
										</div>
										<div class="row">
											<div class="pull-right col-lg-3 col-md-6 col-sm-12 form-group form-md-input">
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

				<div class="row">
					<div class="col-md-12">

						<div class="portlet portlet-sortable box blue-madison portlet-datatable ">
							<div class="portlet-title">
								<div class="caption">
									<i class=" icon-layers font-green"></i>
									<span class="caption-subject font-green sbold uppercase">我的报告列表</span>
								</div>
							</div>
							<div class="portlet-body">
								<div class="clearfix" style="margin-left: 10%;">
									<button type="button" class="btn blue-hoki" id="report_detail_view" disabled onclick="report_detail_view()">
										<span class="glyphicon glyphicon-eye-open"> </span>查看</button>

									<?php $usrRole = $this->session->userdata('usr_role')?>
									<?php if ($usrRole == 1||$usrRole == 100||$usrRole == 10||$usrRole == 1024||$this->session->userdata('DicomView')):?>
									<button type="button" id="dicom_view_btn" disabled class="btn blue-madison" onclick="dicom_view()">
										<span class="glyphicon glyphicon-picture"> </span>调图</button>
									<?php endif;?>
									<?php if ($usrRole == 1||$usrRole == 100||$usrRole == 10||$usrRole == 1024||$this->session->userdata('MakeReport')):?>
									<button type="button" disabled id="report_btn" onclick="make_report()" disabled class="btn btn-primary">
										<span class="glyphicon glyphicon-send"> </span>诊断报告</button>
									<?php endif;?>
								</div>
								<table class="table table-striped table-bordered table-hover table-checkable order-column" id="report_table_info">
									<thead>
										<tr>
											<th width="2%">序号 </th>
											<th width="5%">病人编号</th>
											<th width="5%">病人姓名</th>
											<th width="2%">性别</th>
											<th width="2%">年龄</th>
											<th width="5%">检查项目</th>
											<th width="5%">远程咨询</th>
											<th width="5%">接入医院</th>
											<th width="5%">病人来源</th>
											<th width="5%">身份证号</th>
											<th width="10%">检查日期</th>
											<th width="5%">医院申请医生</th>
											<th width="5%">报告状态</th>
											<th width="5%">报告医生</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<input type="hidden" id="booking_id">
<input type="hidden" id="buffer_booking_status">
<script>
	function make_report() {
			var booking_id = $("#booking_id").val();
			var base_url = '<?= base_url()?>';
			var strURL = base_url + "report/dicomProc/" + booking_id;
			var win = window.open(strURL, '_blank');
			var strURL = base_url + "report/reporting/" + booking_id;
			window.location.href = strURL;
			win.focus();
	}

	function past_checkup_info(val) {
		var base_url = '<?= base_url()?>';
		var booking_id = $("#booking_id").val(val.delivery_name).val();
		var booking_status = $('#buffer_booking_status').val(val.booking_status).val();
		if (booking_status == '1') {
			$("#report_detail_view").attr("disabled", "true");
			$("#dicom_view_btn").attr("disabled", "true");
			$("#report_btn").attr("disabled", "true");
		} else if (booking_status == '2') {
			$('#report_btn').removeAttr('disabled').html('<span class="glyphicon glyphicon-send"> </span>诊断报告');
			$("#report_detail_view").attr("disabled", "true");
			$('#dicom_view_btn').removeAttr('disabled');

		} else if (booking_status == '3') {
			$('#dicom_view_btn').removeAttr('disabled');
			//    $('#report_btn').removeAttr('disabled').html('<i class="fa fa-edit"></i> &nbsp;编辑');
			$('#report_detail_view').removeAttr('disabled');

		} else if (booking_status == '4') {
			$('#report_detail_view').removeAttr('disabled');
			$("#report_btn").attr("disabled", "true");
			$('#dicom_view_btn').removeAttr('disabled');
		} else if (booking_status == '5') {
			$('#report_detail_view').removeAttr('disabled');
			$('#report_btn').removeAttr('disabled').html('<i class="fa fa-edit"></i> &nbsp;编辑');
			$('#dicom_view_btn').removeAttr('disabled');
		} else if (booking_status == '6') {
			$("#report_detail_view").attr("disabled", "true");
			$("#dicom_view_btn").attr("disabled", "true");
			$("#report_btn").attr("disabled", "true");

		} else if (booking_status == '7') {
			$('#report_btn').removeAttr('disabled').html('<span class="glyphicon glyphicon-send"> </span>诊断报告');
			$("#report_detail_view").attr("disabled", "true");
			$('#dicom_view_btn').removeAttr('disabled');
		}

	};

	function dicom_view() {
		var booking_id = $("#booking_id").val();
		if (booking_id == '') {
			alert("请选择项目！");
		} else {
			var base_url = '<?= base_url()?>';
			var strURL = base_url + "report/dicomProc/" + booking_id;
			var win = window.open(strURL, '_blank');
			win.focus();
			window.location.href = strURL;
		}
	};

	function contact_proc() {
		var booking_id = $("#booking_id").val();
		var base_url = '<?= base_url()?>';
		var strURL = base_url + "contact/" + booking_id;
		window.location.href = strURL;

	};

	function report_detail_view() {
		var booking_id = $("#booking_id").val();
		var base_url = '<?= base_url()?>';
		var strURL = base_url + "report/reporting_view/" + booking_id;
		window.location.href = strURL;

	};

	function search_clear() {
		location.reload();
	};

	$(document).ready(function () {
		var tbl_usr_info = '<?=base_url()?>' + 'report/search_data/my';
		var table = $('#report_table_info').DataTable({
			"ajax": tbl_usr_info,
			"ordering": false,
			'searching': false,
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
				[5, 15, 20, -1],
				[5, 15, 20, "All"]
			],
			pageLength: 5,
			pagingType: "bootstrap_full_number",
			columnDefs: [{
				orderable: !1,
				targets: [0]
			}, {
				searchable: !0,
				targets: [0]
			}]
		});
		table.buttons().remove();
		$('#report_table_info tbody').on('click', 'tr', function () {
			if ($(this).hasClass('selected')) {
				$(this).removeClass('selected');
			} else {
				table.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}
			var device_id = $(this).find('.device_id').val();
			var data = table.row(this).data();
			var base_url = '<?= base_url() ?>';
			var strURL = base_url + "report/get_report_data/" + device_id;
			$.ajax({
				dataType: "json",
				url: strURL,
				success: function (response) {
					past_checkup_info(response);
				}
			});
		});

		$("#search_report_btn").click(function () {
			var base_url = '<?= base_url()?>';
			var formData = $('#search_report_form').serialize();
			var ajaxurl = base_url + 'report/search_data/my?' + formData;
			table.ajax.url(ajaxurl).load();
		});
	});

</script>
