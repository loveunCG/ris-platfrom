<div class="page-content-wrapper">
	<div class="page-content">
		<h3 class="page-title">
			<?=$menutitle?>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="icon-home"></i>
					<?=$this->lang->line('booking')?>
						</a>
						<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<span>
						病人列表
					</span>
				</li>
			</ul>
		</div>
		<div class="full-height-content">
			<div class="full-height-content-body " id="sortable_portlets">
				<div class="row">
					<div class="col-md-12">
						<div class="portlet  portlet-sortable box blue-madison">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-magnifier"></i>
									<span class="caption-subject font-light sbold uppercase">查询条件</span>
								</div>
							</div>
							<div class="portlet-body">
								<form action="#" method="post" class="form-horizontal" id="patient_search">

									<div class="form-body">
										<div class="row">
											<div class="col-lg-3 col-md-6 form-group form-md-line-input">
												<label class="col-lg-4 col-md-5 control-label" for="form_control_1">
													<?=$this->lang->line('image_num')?>
												</label>
												<div class="col-lg-8 col-md-6">
													<input type="text" class="form-control" name="image_num" id="image_num">
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="col-lg-3 col-md-6 form-group form-md-line-input">
												<label class="col-lg-4 col-md-3  control-label" for="form_control_1">
													<?=$this->lang->line('name')?>
												</label>
												<div class=" col-lg-8 col-md-8">
													<input type="text" class="form-control" name="patient_name" id="patient_name">
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="col-lg-3 col-md-6 form-group form-md-line-input">
												<label class="col-lg-4 col-md-3 control-label" for="form_control_1">
													<?=$this->lang->line('age')?>
												</label>
												<div class="col-lg-8 col-md-9">
													<input type="text" class="form-control" name="patient_age" id="patient_age">
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="col-lg-3 col-md-6 form-group form-md-line-input">
												<label class="col-lg-4 col-md-3 control-label" for="form_control_1">
													<?=$this->lang->line('gender')?>
												</label>
												<div class="col-lg-8 col-md-9">
													<select class="form-control" name="patient_gender" id="patient_gender">
														<option value="">请选择</option>
														<option value="0">
															<?=$this->lang->line('man')?>
														</option>
														<option value="1">
															<?=$this->lang->line('woman')?>
														</option>
													</select>
													<div class="form-control-focus"> </div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-3 col-md-6 form-group form-md-line-input">
												<label class="col-lg-4 col-md-3 control-label" for="form_control_1">设备类型</label>
												<div class="col-lg-8 col-md-9">
													<select class="form-control" name="device_type" id="device_type">
														<option value="">请选择</option>
															<?php foreach ($all_device_info as $value) {
	if ($device_type == $value->equipment_type) {
		$status = 'selected';
	}
	echo '<option value="' . $value->equipment_type . '" ' . $status . '>' . $value->equipment_type . '</option>';
}?>
																</select>
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="col-lg-3 col-md-6 form-group form-md-line-input">
												<label class="col-lg-4 col-md-3 control-label" for="form_control_1">
													<?=$this->lang->line('patient_source')?>
												</label>
												<div class="col-lg-8 col-md-9">
													<select class="form-control" name="patient_source" id="patient_source">
														<option value="">请选择</option>
														<option value="0">门诊</option>
														<option value="1">住院</option>
														<option value="2">体检</option>
													</select>
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="col-lg-3 col-md-6 form-group form-md-line-input">
												<label class="col-lg-4 col-md-3 control-label" for="form_control_1">远程咨询</label>
												<div class="col-lg-8 col-md-9">
													<select class="form-control" name="remote_status" id="remote_status">
														<option value="">请选择</option>
														<option value="1">是</option>
														<option value="0">否</option>
													</select>
													<div class="form-control-focus"> </div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-lg-3 form-group form-md-line-input">
												<label class="col-lg-4 control-label" for="form_control_1">时间</label>
												<div class="col-lg-8">
													<input type="text" class="form-control form-control-inline date-picker" name="start_time" placeholder="01/01/2017">
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="col-md-6 col-lg-3 form-group form-md-line-input">
												<label class="col-lg-4 control-label" for="form_control_1">到</label>
												<div class="col-lg-8">
													<input type="text" class="form-control form-control-inline date-picker" name="end_time" placeholder="01/01/2017">
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="col-md-3 form-group">
												<button type="button" class="btn  pull-left" id="booking_table_search" style="background-color: rgb(51, 153, 153);">
													<span class="glyphicon glyphicon-search"> </span>查询</button>
												<button type="button" onclick="search_clear()" class="btn pull-right " style="background-color: rgb(51, 153, 153);">
													<span class="glyphicon glyphicon-refresh"> </span>重置</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="portlet  portlet-sortable box blue-madison">
							<div class="portlet-title">
								<div class="caption">
									<i class=" icon-layers font-light"></i>
									<span class="caption-subject font-light sbold uppercase">病人信息列表</span>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-bordered table-hover"  id="booking_table">
									<thead>
										<tr>
											<th >序号</th>
											<th >病人编号</th>
											<th >姓名</th>
											<th >年龄</th>
											<th >性别</th>
											<th >远程咨询</th>
											<th >身份证号</th>
											<th >检查日期</th>
											<th >病人来源</th>
											<th >接入医院</th>
											<th >医院申请医生</th>
											<th >报告医生</th>
											<th >操作</th>
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
<script>
	var table = '';

	function search_clear() {
		$('#patient_search')[0].reset();
		table.ajax.reload();
	};

	function delete_patient(val) {
		var strUrl = '<?=base_url()?>' + 'booking/delete_patient/' + val;
		$.confirm({
			title: '警告',
			content: '你真这个病人信息吗?',
			theme: 'material',
			autoClose: 'chancel|10000',
			columnClass: 'small',
			draggable: true,
			buttons: {
				confirm: {
					text: '是',
					keys: ['shift', 'alt'],
					action: function () {
						$.ajax({
							dataType: "json",
							url: strUrl,
							success: function (response) {
								$.alert({
									title: '成功!',
									columnClass: 'small',
									content: '已成功删除了！.',
									columnClass: 'small',
								});
								table.ajax.reload();
								$(this).remove();
							}
						});
					}
				},
				chancel: {
					text: '否',
					action: function () {
						$(this).remove();
					}

				}
			}
		});
	}
	$(document).ready(function () {
		var booking_table_url = '<?=base_url()?>' + 'booking/booking_table';
		table = $('#booking_table').DataTable({
			"ajax": booking_table_url,
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
				className: "btn dark btn-outline"
			}, {
				extend: "copy",
				className: "btn red btn-outline"
			}, {
				extend: "pdf",
				className: "btn green btn-outline"
			}, {
				extend: "excel",
				className: "btn yellow btn-outline "
			}, {
				extend: "csv",
				className: "btn purple btn-outline "
			}, {
				extend: "colvis",
				className: "btn dark btn-outline",
				text: "Columns"
			}],
			bStateSave: !0,
			lengthMenu: [
				[5, 15, 20, -1],
				[5, 15, 20, "All"]
			],
			pageLength: 5,
			columnDefs: [	{"className": "dt-center", "targets": "_all"}],
			order: [
				[0, "asc"]
			]
		});

		$("#booking_table_search").click(function () {
			var base_url = '<?=base_url()?>';
			var formData = $('#patient_search').serialize();
			var ajaxurl = base_url + 'booking/booking_table?' + formData;
			table.ajax.url(ajaxurl).load();
		});
	});

</script>
