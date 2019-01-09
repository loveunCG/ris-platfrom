<div class="page-content-wrapper">
	<div class="page-content">
		<?php $usrRole = $this->session->userdata('usr_role')?>
		<h3 class="page-title">
			<?=$menutitle?>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="icon-home"></i>
					<?=$this->lang->line('checkmg')?>
						<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<span>管理检查项目</span>
				</li>
			</ul>

		</div>
		<!-- BEGIN CONTENT BODY -->
		<div class="row" id="sortable_portlets">
			<div class="col-md-12">
				<div class="portlet portlet-sortable blue-madison box portlet-fit portlet-form ">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-magnifier"></i>
							<span class="caption-subject font-light sbold uppercase">
								<?=$this->lang->line('checkmg')?>
							</span>
						</div>
					</div>
					<div class="portlet-body">
						<!-- BEGIN FORM-->
						<form action="" id="search_checkup_item_form" method="post" class="form-horizontal" novalidate>
							<div class="form-body">
								<div class="row">
									<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12  form-group form-md-line-input">
										<label class="col-md-5 control-label" for="form_control_1">设备类型</label>
										<div class="col-md-7">
											<select class="form-control" id="s_device_type" name="device_type">
												<option value="">请选择</option>
												<?php foreach ($get_device_type as $var_report) {
    echo '<option value="' . $var_report->equipment_type . '">' . $var_report->equipment_type . '</option>';
}?>
											</select>
											<div class="form-control-focus"> </div>

										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12  form-group form-md-line-input">
										<label class="col-md-5 control-label" for="form_control_1">项目分类</label>
										<div class="col-md-7">
											<select class="form-control" id="s_checkup_class" name="checkup_class">
												<option value="">请选择</option>
												<?php foreach ($get_module_class as $var_report) {
    echo '<option value="' . $var_report->class_id . '">' . $var_report->class_name . '</option>';
}?>
											</select>
											<div class="form-control-focus"> </div>

										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12  form-group form-md-line-input">
										<label class="col-md-5 control-label" for="form_control_1">检查项目
										</label>
										<div class="col-md-7">
											<input type="text" class="form-control" id="s_check_item" name="check_item">
											<div class="form-control-focus"> </div>
											<span class="help-block">请输入设备类型</span>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12  form-group form-md-line-input">
										<label class="col-md-5 control-label" for="form_control_1">价格
										</label>
										<div class="col-md-7">
											<input type="text" class="form-control" id="s_checkup_cost" name="checkup_cost">
											<div class="form-control-focus"> </div>
											<span class="help-block">请输入设备类型</span>
										</div>
									</div>
								</div>
								<div class="row">
									<button type="button" class="btn col-md-offset-9 btn-sm col-md-1 blue-madison pull-left" id="search_checkup_item_btn">
										<span class="glyphicon glyphicon-search"> </span>查询</button>
									<button type="button" class="btn col-md-1 blue-madison btn-sm pull-right" onclick="search_clear()">
										<span class="glyphicon glyphicon-refresh"> </span>重置</button>
								</div>
							</div>
						</form>
						<!-- END FORM-->
					</div>
				</div>
				<!-- END VALIDATION STATES-->
			</div>
			<div class="col-md-12">
				<div class="portlet portlet-sortable blue-madison box portlet-fit portlet-datatable ">
					<div class="portlet-title">
						<div class="caption">
							<i class=" icon-layers font-light"></i>
							<span class="caption-subject font-light sbold uppercase">管理检查项目</span>
						</div>
						<div class="actions">
						</div>
					</div>

					<div class="portlet-body">
						<div class="clearfix" style="margin-left: 10%;">
							<input type="hidden" id="device_dat_id" value="">
							<div class="row">
							<?php if ($usrRole == 1||$usrRole == 1024||$this->session->userdata('isNewItem')):?>
								<button type="button" class="btn blue-madison" data-target="#add_user" data-toggle="modal">
									<span class="glyphicon glyphicon-plus"> </span>新增项目</button>

								<div id="add_user" class="modal fade" tabindex="-1" data-focus-on="input:first">
									<div class="portlet box blue-madison">
										<div class="portlet-title">
											<div class="caption">
												<i class="fa fa-user-plus"></i>
												<span class="caption-subject font-light sbold uppercase">新增项目</span>
											</div>
											<div class="actions">
												<a data-dismiss="modal" class="btn btn-circle btn-icon-only btn-light" onclick="AddUserClose()" href="javascript:;">
													<i class="fa fa-close"></i>
												</a>
											</div>
										</div>
										<div class="portlet-body">
											<!-- BEGIN FORM-->
											<form action="#" method="post" id="add_checkIteminfo">
												<div class="form-body">

													<div class="row col-md-12">
														<div class="form-group col-md-6 form-md-line-input ">
															<select class="form-control" id="n_device_type" name="device_type">
																<option value="">请选择</option>
																<?php foreach ($get_device_type as $var_report) {
    echo '<option value="' . $var_report->equipment_type . '">' . $var_report->equipment_type . '</option>';
}?>
															</select>
															<label for="form_control_1">设备类型</label>
															<span id="error_message" class="help-block">請輸入设备类型</span>
														</div>
														<div class="form-group col-md-6 form-md-line-input ">
															<select class="form-control" id="n_checkup_device" name="checkup_device">
																<option value="">请选择</option>

															</select>
															<label for="n_checkup_device">检查设备</label>
															<span id="error_message" class="help-block">請輸入检查设备</span>
														</div>
													</div>
													<div class="row col-md-12">
														<div class="form-group col-md-6 form-md-line-input ">
															<input type="text" class="form-control" name="check_item" id="n_check_item">
															<label for="form_control_1">检查项目</label>
															<span class="help-block">请输入检查项目</span>
														</div>
														<div class="form-group col-md-6 form-md-line-input ">
															<select class="form-control" id="n_checkup_class" name="checkup_class">
																<option value="">请选择</option>
																<?php foreach ($get_module_class as $var_report) {
    echo '<option value="' . $var_report->class_id . '">' . $var_report->class_name . '</option>';
}?>
															</select>
															<label for="form_control_1">检查部位</label>
														</div>
													</div>
													<div class="row col-md-12">
														<div class="form-group col-md-6 form-md-line-input ">
															<input type="number" class="form-control" disabled value="1" name="checkup_count" id="n_checkup_count">
															<label for="form_control_1">人次</label>
															<span class="help-block">请输入人次</span>
														</div>
														<div class="form-group  col-md-6 form-md-line-input ">
															<input type="number" class="form-control" name="checkup_cost" id="n_checkup_cost">
															<label for="form_control_1">收费价格</label>
															<span class="help-block">请输入收费价格</span>
														</div>
													</div>
												</div>
												<div class="form-actions">
													<div class="row">
														<div class="col-md-12">
															<button type="submit" id="submit_button" class="btn blue-madison pull-left">
																<span class="glyphicon glyphicon-plus"> </span>添加</button>
															<a href="javascript:;" data-dismiss="modal" onclick="AddUserClose()" class="btn blue-madison pull-right">
																<span class="glyphicon glyphicon-log-out"> </span>返回</a>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							<?php endif;?>
							<?php if ($usrRole == 1||$usrRole == 1024||$this->session->userdata('isEditableItem')):?>

								<button type="button" class="btn blue-madison" disabled id="edit_user_data_btn" data-target="#edit_user_data" data-toggle="modal">
									<span class="glyphicon glyphicon-edit"> </span>编辑</button>

								<div id="edit_user_data" class="modal fade" tabindex="-1" data-focus-on="input:first">
									<div class="portlet blue-madison box portlet-fit portlet-form ">
										<div class="portlet-title">
											<div class="caption">
												<i class="fa fa-user-plus"></i>
												<span class="caption-subject font-light sbold uppercase">修改信息</span>
											</div>
											<div class="actions">
												<a data-dismiss="modal" onclick="EditCloseUser()" class="btn btn-circle btn-icon-only btn-light" href="javascript:;">
													<i class="fa fa-close"></i>
												</a>
											</div>
										</div>
										<div class="portlet-body">
											<!-- BEGIN FORM-->
											<form action="#" method="post" id="update_checkIteminfo">
												<div class="form-body">
													<div id="result_notification1">
													</div>
													<div class="alert alert-success display-hide">
														<button class="close" data-close="alert"></button>您的表单验证成功！ </div>
													<div class="row col-md-12">
														<div class="form-group col-md-6 form-md-line-input ">
															<select class="form-control" id="device_type" name="device_type">
																<option value="">请选择</option>
																<?php foreach ($get_device_type as $var_report) {
    echo '<option value="' . $var_report->equipment_type . '">' . $var_report->equipment_type . '</option>';
}?>
															</select>
															<label for="form_control_1">设备类型</label>
															<span id="error_message" class="help-block">請輸入设备类型</span>
														</div>
														<div class="form-group col-md-6 form-md-line-input ">
															<select class="form-control" id="checkup_device" name="checkup_device">
																<option value="">请选择</option>

															</select>
															<label for="n_checkup_device">检查设备</label>
															<span id="error_message" class="help-block">請輸入检查设备</span>
														</div>
													</div>
													<div class="row col-md-12">

														<div class="form-group col-md-6 form-md-line-input  has-success">
															<input type="text" class="form-control" name="check_item" id="check_item">
															<label for="form_control_1">检查项目</label>
															<span class="help-block">请输入检查项目</span>
														</div>
														<div class="form-group col-md-6 form-md-line-input ">
															<select class="form-control" id="checkup_class" name="checkup_class">
																<option value="">请选择</option>
																<?php foreach ($get_module_class as $var_report) {
    echo '<option value="' . $var_report->class_id . '">' . $var_report->class_name . '</option>';
}?>
															</select>
															<label for="form_control_1">检查部位</label>
															<span class="help-block">请输入检查部位</span>
														</div>
													</div>
													<div class="row col-md-12">
														<div class="form-group col-md-6 form-md-line-input ">
															<input type="number" disabled class="form-control" name="checkup_count" id="checkup_count">
															<label for="form_control_1">人次</label>
															<span class="help-block">请输入人次</span>
														</div>
														<div class="form-group  col-md-6 form-md-line-input ">
															<input type="number" class="form-control" name="checkup_cost" id="checkup_cost">
															<label for="form_control_1">收费价格</label>
															<span class="help-block">请输入收费价格</span>
														</div>
													</div>
												</div>

												<div class="form-actions">
													<div class="row">
														<div class="col-md-12">
															<button type="submit" id="submit_button" class="btn blue-madison pull-left">
																<span class="glyphicon glyphicon-edit"> </span>改修</button>
															<a href="javascript:;" data-dismiss="modal" onclick="EditCloseUser()" class="btn blue-madison pull-right">
																<span class="glyphicon glyphicon-log-in"> </span>返回</a>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							<?php endif;?>

     						<?php if ($usrRole == 1||$usrRole == 1024||$this->session->userdata('isDeleteItem')):?>
								<button type="button" class="btn blue-hoki" disabled id="delect_checkup_item">
									<span class="glyphicon glyphicon-trash"> </span>删除</button>
							<?php endif;?>
								<button type="button" class="btn blue-hoki " disabled data-toggle="modal" onclick="start_device()" id="start_device">
									<span class="glyphicon glyphicon-print"> </span>打印</button>
							</div>
						</div>
						<table class="table-striped table-bordered table-hover table" id="tbl_checkup_item_info">
							<thead>
								<tr>
									<th>序号</th>
									<th>检查部位</th>
									<th>设备类型</th>
									<th>检查设备</th>
									<th>项目分类</th>
									<th>人次</th>
									<th>收费价格</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		var table = [];

		function AddUserClose() {
			$('#add_user').find('.help-block-error').remove();
			$('#add_user').find('.form-group').removeClass('has-error');
			$('#add_checkIteminfo')[0].reset();

		}

		function EditCloseUser() {
			$('#edit_user_data').find('.help-block-error').html('');
			$('#edit_user_data').find('.form-group').removeClass('has-error');
			$('#edit_user_data_btn').attr('disabled', 'true');
		}

		function select_device(val) {
			var check_item = val.check_item;
			var device_type = val.device_type;
			var checkup_device = val.checkup_device;
			var checkup_class = val.checkup_class;
			var checkup_count = val.checkup_count;
			var checkup_cost = val.checkup_cost;
			var id = val.id;
			$('#device_dat_id').val(id);
			$('#check_item').val(check_item);
			$('#device_type').val(device_type);
			$('#checkup_class').val(checkup_class);
			$('#checkup_device').html('<option value="' + checkup_device + '">' + checkup_device + '</option>');
			$('#checkup_device').val(checkup_device);
			$('#checkup_count').val(checkup_count);
			$('#checkup_cost').val(checkup_cost);
			$("#delect_checkup_item").removeAttr("disabled");
			$("#edit_user_data_btn").removeAttr("disabled");
		}

		function update_checkIteminfo_proc() {
			var base_url = '<?=base_url()?>';
			var strURL = base_url + "usermg/update_checkIteminfo/";
			var id = $("#device_dat_id").val();
			var device_type = $("#device_type").val();
			var check_item = $("#check_item").val();
			var checkup_class = $("#checkup_class").val();
			var checkup_count = $("#checkup_count").val();
			var checkup_cost = $("#checkup_cost").val();
			var checkup_device = $("#checkup_device").val();
			$.post(strURL, {
				id: id,
				device_type: device_type,
				check_item: check_item,
				checkup_class: checkup_class,
				checkup_count: checkup_count,
				checkup_cost: checkup_cost,
				checkup_device: checkup_device
			}).done(function (data) {
				if (data) {
					$.alert({
						title: '报告!',
						content: '修改成功了！',
						columnClass: 'small',
						icon: 'glyphicon glyphicon-info-sign',
						theme: 'light',
						buttons: {
							ok: function () {
								table.ajax.reload();
								$('#edit_user_data').modal('toggle');
								$('#update_checkIteminfo')[0].reset();
							},
						}
					});
				} else {

				}
			});
		}

		function add_checkIteminfo_new() {
			var base_url = '<?=base_url()?>';
			var strURL = base_url + "usermg/add_checkIteminfo/";
			var formData = $('#add_checkIteminfo').serialize();
			$.post(strURL, formData).done(function (data) {
				if (data.response_code) {
					$.alert({
						title: '报告!',
						content: data.message,
						columnClass: 'small',
						icon: 'glyphicon glyphicon-info-sign',
						theme: 'light',
						buttons: {
							ok: function () {
								table.ajax.reload();
								$('#add_user').modal('toggle');
								$('#add_checkIteminfo')[0].reset();
							}
						}
					});
				} else {
					$.alert({
						title: '警告!',
						content: data.message,
						columnClass: 'small',
						icon: 'glyphicon glyphicon-info-sign',
						theme: 'light',
						buttons: {
							ok: function () {
								table.ajax.reload();
								$('#add_user').modal('toggle');
								$('#add_checkIteminfo')[0].reset();
							}
						}
					});
				}
			});
		}

		function start_device() {
			var base_url = '<?=base_url()?>';
			val = $('#device_dat_id').val();
			var strURL = base_url + "usermg/start_device";
			$.post(strURL, {
					device_dat_id: val
				})
				.done(function (data) {
					if (data) {
						$.alert({
							title: '报告!',
							content: '该项目已激活',
							columnClass: 'small',
							icon: 'glyphicon glyphicon-info-sign',
							theme: 'light',
							buttons: {
								ok: function () {
									table.ajax.reload();
								},
							}
						});

					} else {

					}
				});
		}

		function search_clear() {
			$('#search_checkup_item_form')[0].reset();
			table.ajax.reload();
		}

		$(document).ready(function () {
			$('#n_device_type').change(function () {
				let strURL = '<?=base_url()?>usermg/selectCheckupDeviceType';
				$.ajax({
					dataType: "json",
					url: strURL,
					type: 'post',
					data: {
						device_dat_id: $(this).val()
					},
					success: function (response) {
						var disData = '<option value="">请选择</option>'
						for (var index in response) {
							disData += '<option value="' + response[index].eq_num + '"> ' + response[index].eq_num + '</option>';
						}
						$('#n_checkup_device').html(disData)
					}
				});
			});
			$('#device_type').change(function () {
				let strURL = '<?=base_url()?>usermg/selectCheckupDeviceType';
				$.ajax({
					dataType: "json",
					url: strURL,
					type: 'post',
					data: {
						device_dat_id: $(this).val()
					},
					success: function (response) {
						var disData = ''
						for (var index in response) {
							disData += '<option value="' + response[index].eq_num + '"> ' + response[index].eq_num + '</option>';
						}
						$('#checkup_device').html(disData)
					}
				});
			});
			$(".modal").draggable({
				handle: ".portlet-title"
			});
			var tbl_usr_info = '<?=base_url()?>' + 'usermg/search_checkup_item';
			table = $('#tbl_checkup_item_info').DataTable({
				"ajax": tbl_usr_info,
				select: true,
				dom: 'Bfrtip',
				"ordering": false,
				pagingType: "bootstrap_full_number",
				pageLength: 20,
				sClass: "text-center",
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
				lengthMenu: [
					[5, 15, 20, -1],
					[5, 15, 20, "All"]
				],
				'searching': false,
				columnDefs: [
					{
					orderable: !1,
					targets: [0],
				},
				{
					searchable: !0,
					targets: [0]
				},
				{"className": "dt-center", "targets": "_all"}
				],
				order: [
					[0, "asc"]
				]
			});
			table.buttons().remove();
			$('#tbl_checkup_item_info tbody').on('click', 'tr', function () {
				if ($(this).hasClass('selected')) {
					$(this).removeClass('selected');
				} else {
					table.$('tr.selected').removeClass('selected');
					$(this).addClass('selected');
				}
				var device_id = $(this).find('.device_id').val();
				var data = table.row(this).data();
				var base_url = '<?= base_url() ?>';
				var strURL = base_url + "usermg/get_checkup_item_info/" + device_id;
				$.ajax({
					dataType: "json",
					url: strURL,
					success: function (response) {
						select_device(response);
					}
				});
			});
			var originalModal = $('#add_user').clone();
			$("#search_checkup_item_btn").click(function () {
				var base_url = '<?= base_url()?>';
				var formData = $('#search_checkup_item_form').serialize();
				var ajaxurl = base_url + 'usermg/search_checkup_item?' + formData;
				table.ajax.url(ajaxurl).load();
			});

			$('#delect_checkup_item').click(function () {
				$.confirm({
					title: '提示',
					content: ' 确定要删除吗？',
					theme: 'light',
					autoClose: 'chancel|10000',
					draggable: true,
					buttons: {
						confirm: {
							text: '是',
							keys: ['shift', 'alt'],
							action: function () {
								var base_url = '<?=base_url()?>';
								val = $('#device_dat_id').val();
								var strURL = base_url + "usermg/delect_checkup_item";
								$.post(strURL, {
										device_dat_id: val
									})
									.done(function (data) {
										$.alert('删除已成功了！');
										table.ajax.reload();
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


			});
		});

	</script>
