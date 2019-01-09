<div class="page-content-wrapper">
	<div class="page-content">
		<h3 class="page-title">
			<?=$menutitle?>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="/">
						<?=$menutitle?>
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<span>新报告</span>
				</li>
			</ul>
		</div>
		<div class="row" id="sortable_portlets">
			<div id="notification_report_save"></div>
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div class="m-heading-1 border-green m-bordered">
							<div class="row">
								<a onclick="history.go(-1);" class=" col-md-offset-1 col-md-1  btn green">
									<i class="fa fa-undo"></i>返回</a>
								<a href="javascript:;" class=" col-md-offset-1 col-md-1  btn green" onclick="save_report()">
									<i class="fa fa-save"></i>保存</a>
								<button type="button" <?=check_role('MakeReport')?'':'disabled '?> class="col-md-offset-1  col-md-1  btn blue" id="submit_func_btn">
									<i class="fa fa-paper-plane"></i>提交 </button>
								<a href="<?=base_url()?>report/dicomProc/<?=$report_table->chc_id?>" <?=check_role('DicomView')?'':'disabled '?> class="col-md-offset-1 col-md-1  btn yellow">
									<i class="fa fa-dedent"></i>调图</i>
								</a>
								<a href="javascript:;" class=" col-md-offset-1  col-md-1   btn green">
									<i class="fa fa-print"></i>打印</a>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="portlet portlet-sortable box blue-madison">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-user"></i>
									<span class="caption-subject font-white bold uppercase">
										<?=$this->lang->line('patient_info')?>
									</span>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-condensed ">
									<tbody>
										<thead>
											<tr style="text-align: center; ">
												<th style="text-align: center; width:18%">病人编号</th>
												<th style="text-align: center; width:18%">病人姓名</th>
												<th style="text-align: center; width:18%">性别</th>
												<th style="text-align: center; width:10%">年龄</th>
												<th style="text-align: center; width:10%">病人类型</th>
												<th style="text-align: center; width:18%">检查时间</th>
											</tr>
										</thead>
										<tr style="text-align: center; ">
											<td>
												<?=$report_table->patient_code?>
											</td>
											<td>
												<?=$report_table->patient_name?>
											</td>
											<td>
												<?=$report_table->patient_gender == 0 ? '<button type="button" class="btn btn-circle btn-icon-only yellow"><span aria-hidden="true" class="icon-symbol-male"></span></button>' : '<button type="button" class="btn btn-circle btn-icon-only red"><span aria-hidden="true" class="icon-symbol-female"></span></button>'?>
											</td>
											<td>
												<?=$report_table->patient_age?>
											</td>
											<td>
												<?php
if ($report_table->patient_source == '0') {
    $patient_source = '<span type="button" class="btn btn red">门诊</span>';
} elseif ($report_table->patient_source == '1') {
    $patient_source = '<button type="button" class="btn btn blue">住院</button>';
} else {
    $patient_source = '<button type="button" class="btn btn dark">体检</button>';
}
?>
													<?=$patient_source?>
											</td>
											<td>
												<?=$report_table->checked_time?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<form action="#" id="report_submit" method="post">
							<div class="col-md-4">
								<div class="col-md-12 col-sm-12">
									<div class="portlet portlet-sortable box blue-madison ">
										<div class="portlet-title">
											<div class="caption">
												<i class="icon-social-dribbble"></i>
												<span class="caption-subject bold font-light uppercase">
													<?=$this->lang->line('report_module')?>
												</span>
											</div>
											<div class="actions">
												<a class="btn btn-circle btn-icon-only btn-lighr" data-target="#config_report_module" data-toggle="modal">
													<i class="fa fa-lg fa-cog"></i>
												</a>
											</div>

										</div>
										<input type="hidden" id="report_module" name="report_module">
										<div class="portlet-body">
											<div class="scroller" style="height:175px">
												<div id="tree_1" class="tree-demo">
													<ul>
														<li> 常用模块
															<ul>

																<?php foreach ($device_class as $value): ?>
																<li data-jstree='{ "open" : true }'>
																	<a href="javascript:;">
																		<?=$value->equipment_type?>
																	</a>
																	<?php foreach ($module_class as $class_module):
    $module_id = $class_module->class_id;
    ?>
																							<ul>
																								<li data-jstree='{ "disabled" : false }'>
																									<?=$class_module->class_name?>
																										<ul>
																											<?php foreach ($template as $template_value): ?>
																											<?php

    if (($template_value->device_type == $value->equipment_type) && ($template_value->module_class == $module_id)):
    ?>
																												<li data-jstree='{ "type" : "file" }' ondblclick="select_template(<?=$template_value->template_id?>)">
																													<?=$template_value->template_name?>
																												</li>
																												<?php endif;
endforeach;?>
																				</ul>
																		</li>
																	</ul>
																	<?php endforeach;?>
																</li>
																<?php endforeach;?>

															</ul>
														</li>
													</ul>
												</div>
												<div id="tree_2" class="tree-demo">
													<ul>
														<li> 个人自定义模块
															<ul>
																<?php foreach ($device_class as $value): ?>
																<li data-jstree='{ "open" : true }'>
																	<a href="javascript:;">
																		<?=$value->equipment_type?>
																	</a>
																	<?php foreach ($module_class as $class_module):
    $module_id = $class_module->class_id;
    ?>
																							<ul>
																								<li data-jstree='{ "disabled" : false }'>
																									<?=$class_module->class_name?>
																										<ul>
																											<?php foreach ($template as $template_value): ?>
																											<?php

    if (($template_value->device_type == $value->equipment_type) && ($template_value->module_class == $module_id)):
    ?>
																												<li data-jstree='{ "type" : "file" }' ondblclick="select_template(<?=$template_value->template_id?>)">
																													<?=$template_value->template_name?>
																												</li>
																												<?php endif;
endforeach;?>
																				</ul>
																		</li>
																	</ul>
																	<?php endforeach;?>
																</li>
																<?php endforeach;?>

															</ul>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="portlet mt-element-ribbon portlet-sortable box blue-madison portlet-fit" >
										<div class="portlet-title">
											<div class="caption">
												<i class=" icon-layers font-white"></i>
												<span class="caption-subject font-white bold uppercase">
													<?=$this->lang->line('positive_status')?>
												</span>
											</div>
										</div>
										<div class="portlet-body">
											<div class="form-group form-md-radios">
												<div class="md-radio-inline">
													<div class="md-radio">
														<input type="radio" id="radio14" name="positive_status" value="1" class="md-radiobtn" <?=$report_table->positive_status == '1' ? 'checked' : ''?>>
														<label for="radio14">
															<span class="inc"></span>
															<span class="check"></span>
															<span class="box"></span> 阳性 </label>
													</div>
													<div class="md-radio has-error">
														<input type="radio" id="radio15" value="2" name="positive_status" class="md-radiobtn" <?=$report_table->positive_status == '2' ? 'checked' : ''?>>
														<label for="radio15">
															<span class="inc"></span>
															<span class="check"></span>
															<span class="box"></span> 阴性</label>
													</div>
													<div class="md-radio has-warning">
														<input type="radio" id="radio16" value="3" name="positive_status" class="md-radiobtn" <?=$report_table->positive_status == '3' ? 'checked' : ''?>>
														<label for="radio16">
															<span class="inc"></span>
															<span class="check"></span>
															<span class="box"></span> 未知 </label>
													</div>
												</div>
											</div>
											<div class="form-group form-md-radios">
												<label>危急性</label>
												<div class="md-radio-inline">
													<div class="md-radio">
														<input type="radio" id="radio17" name="urgency_status" value="0" class="md-radiobtn" <?=$report_table->urgency_status == '0' ? 'checked' : ''?>>
														<label for="radio17">
															<span class="inc"></span>
															<span class="check"></span>
															<span class="box"></span> 是 </label>
													</div>
													<div class="md-radio has-error">
														<input type="radio" id="radio19" name="urgency_status" value="1" class="md-radiobtn" <?=$report_table->urgency_status == '1' ? 'checked' : ''?>>
														<label for="radio19">
															<span class="inc"></span>
															<span class="check"></span>
															<span class="box"></span> 否 </label>
													</div>
												</div>
											</div>
											<div class="form-group form-md-line-input has-info">
												<select class="form-control" name="image_degree">
													<option value="1" <?=$report_table->image_degree == '1' ? 'selected' : ''?>>甲</option>
													<option value="1" <?=$report_table->image_degree == '2' ? 'selected' : ''?>>乙</option>
													<option value="1" <?=$report_table->image_degree == '3' ? 'selected' : ''?>>丙</option>
												</select>
												<label>
													<?=$this->lang->line('image_degree')?>
												</label>
											</div>
										</div>
									</div>

								</div>
							</div>
							<div class="col-md-8">
								<div class="col-md-12 col-sm-12">
									<div class="portlet mt-element-ribbon portlet-sortable box blue-madison portlet- ">
										<div class="portlet-title">
											<div class="caption">
												<input type="hidden" name="checkup_id" value="<?=$report_table->chc_id?>">
												<i class=" icon-layers font-white"></i>
												<span class="caption-subject font-white bold uppercase">
													<?=$this->lang->line('image_expression')?>
												</span>
											</div>
										</div>
										<div class="portlet-body">
											<div class="portlet-body form">
												<div class="form-horizontal form-bordered">
													<div class="form-body">
														<div class="form-group last">
															<div class="form-group">
																<textarea class="form-control autosizeme" name="Imaging_performance" id="Imaging_performance" rows="7" placeholder=""><?=$report_table->Imaging_performance?></textarea>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="portlet mt-element-ribbon portlet-sortable box blue-madison portlet-fit ">
										<div class="portlet-title">
											<div class="caption">
												<i class=" icon-layers font-white"></i>
												<span class="caption-subject font-white bold uppercase">
													<?=$this->lang->line('clinical_diagnosis')?>
												</span>
											</div>
										</div>
										<div class="portlet-body">
											<div class="portlet-body form">
												<div class="form-horizontal form-bordered">
													<div class="form-body">
														<div class="form-group last">
															<div class="form-group">
																<textarea class="form-control autosizeme" name="recommend_report" id="clinical_diagnosis" rows="7" placeholder=""><?=$report_table->recommend_report?></textarea>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<input type="hidden" name="report_id" value="<?=$report_table->report_id?>">
						</form>
					</div>
					<div class="col-md-12">
						<div class="portlet mt-element-ribbon portlet-sortable box blue-madison portlet-fit">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-file-text-o"></i>
									<span class="caption-subject font-white bold uppercase">
										<?=$this->lang->line('hospital_inner_log')?>
									</span>
								</div>
							</div>
							<div class="portlet-body">
								<div class="row">
									<div class="col-md-6">
										<table class="table" id="past_checlup_table">
											<thead>
												<tr>
													<th style="text-align: center; width:8%">NO</th>
													<th style="text-align: center; width:18%">病人编号</th>
													<th style="text-align: center; width:18%">检查日期</th>
													<th style="text-align: center; width:10%">检查类型</th>
													<th style="text-align: center; width:10%">检查项目</th>
													<th style="text-align: center; width:10%">放射编号</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
									<div class="col-md-3">
										<!-- BEGIN Portlet PORTLET-->
										<div class="portlet portlet-sortable box blue-madison">
											<div class="portlet-title">
												<div class="caption">
													<i class="fa fa-gift"></i>
													<?=$this->lang->line('image_expression')?>
												</div>
											</div>
											<div class="portlet-body">
												<div class="scroller" style="height:100px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
													<span id="pastImaging_performance"></span>
												</div>
											</div>
										</div>
										<!-- END Portlet PORTLET-->

									</div>
									<div class="col-md-3">
										<!-- BEGIN Portlet PORTLET-->
										<div class="portlet portlet-sortable box blue-madison">
											<div class="portlet-title">
												<div class="caption">
													<i class="fa fa-gift"></i>
													<?=$this->lang->line('clinical_diagnosis')?>
												</div>
											</div>
											<div class="portlet-body">
												<div class="scroller" style="height:100px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
													<span id="pastclinical_diagnosis"></span>
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
		</div>
	</div>
</div>
<div id="config_report_module" class="modal container fade" tabindex="-1" data-focus-on="input:first">
	<div class="portlet portlet-sortable box blue-madison portlet-fit portlet-form ">
		<div class="portlet-title">
			<div class="caption">
				<span class="glyphicon glyphicon-align-justify"> </span>
				<span class="caption-subject sbold uppercase">模块管理</span>
			</div>
			<div class="actions">
				<a data-dismiss="modal" class="btn btn-circle btn-icon-only btn-light" href="javascript:;">
					<i class="fa fa-close"></i>
				</a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="modal-header">
				<div id="template_notification"></div>
				<div class="row col-md-12">

					<button type="button" onclick="new_template_click()" class="btn default">
						<span class="glyphicon glyphicon-plus"> </span>
						</i>新建模板
					</button>
					<button disabled onclick="delete_template()" id="delete_template_btn" class="btn red">
						<span class="glyphicon glyphicon-trash"> </span> 删除模板
					</button>
					<button type="button" href="javascript:;" class="btn green" id="save_template" onclick="submit_form()">
						<span class="glyphicon glyphicon-floppy-disk"> </span>保存模板
					</button>
					<button type="button" disabled id="apply_template_btn" onclick="apply_template()" class="btn dark">
						<span class="glyphicon glyphicon-saved"> </span> 应用模板
					</button>
					<button type="button" id="new_template_class_btn" onclick="new_template_class()" class="btn grey">
						<span class="glyphicon glyphicon-plus"> </span> 新增目录
					</button>
					<input type="hidden" id="tmp_module_id" />
					<button type="button" disabled id="edit_template_class_btn" onclick="edit_template_class()" class="btn blue">
						<span class="glyphicon glyphicon-pencil"> </span> 修改目录
					</button>
					<button type="button" disabled id="delete_template_class_btn" onclick="delete_template_class()" class="btn red">
						<span class="glyphicon glyphicon-trash"> </span> 删除目录
					</button>
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-4 ">
						<div class="portlet box green">
							<div class="portlet-title">
							</div>
							<div class="portlet-body">
								<div class="panel panel-light">
									<div class="panel-body">

										<div class="row">
											<div class="col-md-12">
												<div class="form-group form-md-line-input form-md-floating-label has-info">
													<select class="form-control edited" onchange="change_device_type(this.value)" name="sdevice_type" id="sdevice_type">
														<option value="">请选择设备类型</option>
														<?php foreach ($device_class as $var_report) {
    echo '<option value="' . $var_report->equipment_type . '">' . $var_report->equipment_type . '</option>';
}?>
													</select>
													<label for="form_control_1">请选选择报告类别</label>
												</div>
											</div>
											<div class="col-md-12">
												<div id="report_module_tree" class="tree-demo">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="col-md-12 portlet box green">
							<div class="portlet-title">
								<div class="tools">
									<a href="javascript:;" class="collapse"> </a>
									<a href="#portlet-config" data-toggle="modal" class="config"> </a>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-bordered table-hover table-checkable order-column" id="template_table">
									<thead>
										<tr>
											<th> 模板编码 </th>
											<th> 模板名称 </th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<div class="panel panel-light" style="display:none;" id="template_edit_pannel">
									<form action="#" method="post" id="report_module_form">
										<div class="panel-body">
											<div class="form-body">
												<div class="row col-md-12">
													<div class="form-group col-md-6 form-md-line-input">
														<input type="text" class="form-control" id="template_name" name="template_name">
														<label for="form_control_1">模板名称</label>
													</div>
													<div class="form-group col-md-6 form-md-line-input">
														<input type="text" class="form-control" name="checkup_name" id="checkup_name">
														<label for="form_control_1">检查名称</label>
													</div>
												</div>
												<div class="row col-md-12">
													<div class="form-group col-md-4 form-md-line-input">
														<select class="form-control" name="device_type" id="device_type">
															<?php foreach ($device_class as $value) {
    echo '<option value="' . $value->equipment_type . '">' . $value->equipment_type . '</option>';
}?>
														</select>
														<label for="form_control_1">检查设备类型</label>
													</div>
													<div class="form-group col-md-4 form-md-line-input">
														<select class="form-control" onchange="select_class_id(this.value)" name="select_class" id="select_class">
															<?php foreach ($module_class as $value) {
    echo '<option value="' . $value->class_id . '">' . $value->class_name . '</option>';
}?>
														</select>
														<label for="form_control_1">检查部位</label>
													</div>
													<input type="hidden" name="template_id" id="template_id">
													<div class="form-group col-md-4 form-md-line-input ">
														<select class="form-control" name="report_module_id" id="report_module_id">
															<?php foreach ($module_view as $value) {
    echo '<option value="' . $value->module_id . '">' . $value->module_name . '</option>';
}?>
														</select>
														<label for="form_control_1">二级分类</label>
													</div>
												</div>
												<div class="form-group col-md-12 form-md-line-input">
													<textarea class="form-control" id="image_expression" name="image_expression" rows="3"></textarea>
													<label for="form_control_1">影像学表现</label>
												</div>
												<div class="form-group col-md-12 form-md-line-input">
													<textarea class="form-control" id="recommended_report" name="recommended_report" rows="3"></textarea>
													<label for="form_control_1">诊断建议</label>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="currentSearchReportClass" />
<input type="hidden" id="tmpClassId" />
<script>
	var table = [];
	var optiondispaly = '';
	<?php foreach ($module_class as $value): ?>
	optiondispaly += '<option value="<?=$value->class_id?>"> <?=$value->class_name?></option>';
	<?php endforeach;?>
	var deviceClass = '';
	<?php foreach ($device_class as $var_report): ?>
	deviceClass += '<option value="<?=$var_report->equipment_type?>"><?=$var_report->equipment_type?></option>';
	<?php endforeach;?>

	function edit_template_class() {
		var tmp_module_id = $('#tmp_module_id').val();
		if (tmp_module_id == '') {
			$.alert({
				title: '警告!',
				icon: 'fa fa-warning',
				columnClass: 'small',
				content: '请选择检查目录',
				theme: 'material'
			});
			return true;
		}
		var base_url = '<?=base_url()?>';
		var strURL = base_url + "report/get_module_Info/" + tmp_module_id;
		$.ajax({
			dataType: "json",
			url: strURL,
			success: function (response) {
				onEditModule(response);
			}
		});


	}

	function onEditModule(val) {

		var module_id = val.module_id;
		var module_class = val.module_class;
		var module_name = val.module_name;
		var report_class = val.report_class;

		$.confirm({
			title: '编辑检查目录',
			content: '<form action="#" id = "edit_device_checkup">\n' +
				'<div class="form-body">\n' +
				'<div class="form-group form-md-line-input">' +
				'<select class="form-control" name="report_class" id="updatereport_class">' +
				' <option value="">请选择</option>' +
				deviceClass + '</select>' +
				'<label for="report_class">报告类别</label>' +
				'</div>' +
				'<div class="form-group form-md-line-input"><input type="hidden" name="module_id" value="' + module_id +
				'" id="update_module_id">' +
				'<select class="form-control" name="module_class" id="updatemodule_class">' +
				' <option value="">请选择</option>' +
				optiondispaly +
				'<label for="checkup_type">检查类型</label></select>' +
				'</div>' + '<div class="form-group form-md-line-input ">' +
				'<input type="text" class="form-control" name="module_name" id="update_module_name" value="' +
				module_name + '">' +
				'<label for="this_checkup_item">检查项目</label>' +
				'</div>' +
				'</div>' +
				'</form>',
			theme: 'material',
			onContentReady: function () {
				$('#updatemodule_class').val(module_class).change();
				$('#updatereport_class').val(report_class).change();
			},
			columnClass: 'small',
			closeIcon: true,
			type: 'red',
			typeAnimated: true,
			draggable: true,
			icon: 'glyphicon glyphicon-edit',
			buttons: {
				formSubmit: {
					text: '添加',
					btnClass: 'btn blue',
					action: function () {
						if ($('#nmodule_name').val() == '') {
							$.alert({
								title: '警告!',
								icon: 'fa fa-warning',
								columnClass: 'small',
								content: '请输入检查目录',
							});
							return true;
						}
						var formdata = $('#edit_device_checkup').serialize();
						var strURL = '<?=base_url()?>' + "report/save_reportmodule_class/";
						$.ajax({
							url: strURL,
							type: 'post',
							data: formdata,
							success: function (data) {
								$.alert({
									title: '提示',
									content: '添加成功了！',
									columnClass: 'small',
									theme: 'material',
									buttons: {
										ok: function () {
											$(this).remove();
											reload_Jstree();
											return true;
										}
									}
								});

							},
							error: function (e) {}
						});

					}
				},
				cancel: {
					text: '返回',
					btnClass: 'btn green',
					action: function () {}
				}

			}
		});

	}

	function delete_template_class() {
		var tmp_module_id = $('#tmp_module_id').val();
		if (tmp_module_id == '') {
			$.alert({
				title: '警告!',
				icon: 'fa fa-warning',
				columnClass: 'small',
				content: '请选择检查目录',
			});
			return true;
		}

		$.confirm({
			title: '警告!',
			content: '您真删除该检查目录?',
			typeAnimated: true,
			theme: 'material',
			columnClass: 'small',
			draggable: true,
			buttons: {
				OK: {
					text: '确定',
					action: function () {
						var base_url = '<?=base_url()?>';
						var strURL = base_url + "report/delete_module/";
						$.post(strURL, {
							module_id: tmp_module_id
						}).done(function (data) {
							if (data) {
								$.alert({
									title: '警告!',
									icon: 'fa fa-warning',
									columnClass: 'small',
									content: '删除成功了',
								});
								reload_Jstree();

							} else {
								$.alert({
									title: '警告!',
									icon: 'fa fa-warning',
									columnClass: 'small',
									content: '删除失败了',
								});

							}
							return true;
						});

					}
				},
				somethingElse: {
					text: '返回',
					keys: ['enter', 'shift'],
					action: function () {
						return true;

					}
				}
			}
		});
	}

	function new_template_class() {
		$.confirm({
			title: '添加检查目录',
			content: '<form action="#" id = "edit_device_checkup">\n' +
				'<div class="form-body">' +
				'<div class="form-group form-md-line-input">' +
				'<select class="form-control" name="report_class" id="nreport_class">' +
				deviceClass + '</select>' +
				'<label for="report_class">报告类别</label>' +
				'</div>' +
				'<div class="form-group form-md-line-input">' +
				'<select class="form-control" name="module_class" id="nmodule_class">' +
				optiondispaly + '</select>' +
				'<label for="module_class">检查类型</label>' +
				'</div>' + '<div class="form-group form-md-line-input ">' +
				'<input type="text" class="form-control" name="module_name" id="nmodule_name">' +
				'<label for="this_checkup_item">检查项目</label>' +
				'</div>' +
				'</div>' +
				'</form>',
			theme: 'material',
			columnClass: 'small',
			closeIcon: true,
			type: 'red',
			typeAnimated: true,
			draggable: true,
			icon: 'glyphicon glyphicon-edit',
			buttons: {
				formSubmit: {
					text: '添加',
					btnClass: 'btn blue',
					action: function () {
						if ($('#nmodule_name').val() == '') {
							$.alert({
								title: '警告!',
								icon: 'fa fa-warning',
								columnClass: 'small',
								content: '请输入检查目录',
							});
							return true;
						}
						var formdata = $('#edit_device_checkup').serialize();
						var strURL = '<?=base_url()?>' + "report/save_reportmodule_class/";
						$.ajax({
							url: strURL,
							type: 'post',
							data: formdata,
							success: function (data) {
								$.alert({
									title: '提示',
									content: '添加成功了！',
									columnClass: 'small',
									theme: 'material',
									buttons: {
										ok: function () {
											$(this).remove();
											reload_Jstree();
											return true;
										}
									}
								});

							},
							error: function (e) {}
						});

					}
				},
				cancel: {
					text: '返回',
					btnClass: 'btn green',
					action: function () {}
				}

			}
		});

	}

	function new_template_click() {
		$('#report_module_form')[0].reset();
		$('#template_id').val('');
		$('#report_module_form').find('.help-block-error').remove();
		$('#report_module_form').find('.form-group').removeClass('has-error');
		$('#template_edit_pannel').css("display", "block").fadeIn(1000);
		$('#save_template').removeAttr('disabled');
		changeNewTemplatePage();
	}

	function changeNewTemplatePage() {
		$('#device_type').val($('#sdevice_type').val()).change();
		$('#select_class').val($('#tmpClassId').val()).change();

	}

	function search_device(val) {


	}

	function update_template_click() {
		if ($('#template_id').val()) {
			$('#template_edit_pannel').css("display", "block");
		} else if ($('#template_id').val() == "") {
			var message =
				'<div class="alert alert-danger display"><button class="close" data-close="alert"></button>';
			message += "请选择项目！</div>";
			$('#update_template_click').attr("disabled", "true");
			$('#template_notification').html(message).delay(800).slideUp(800);
			$('#template_notification').html();
		}

	}

	function submit_form() {
		$('#report_module_form').submit();

	}

	function save_template() {
		var url = "<?=base_url()?>" + 'report/add_template/';
		var form_data = $('#report_module_form').serialize(); //Encode form elements for submission
		$.ajax({
			url: url,
			type: 'post',
			dataType: "JSON",
			data: form_data,
			success: function (result) {
				if (result.status = 'succes') {
					$.alert({
						title: '警告!',
						icon: 'fa fa-warning',
						columnClass: 'small',
						content: '添加成功了',
					});
					$('#report_module_form')[0].reset();
					$('#report_module_form').find('.help-block-error').remove();
					$('#report_module_form').find('.form-group').removeClass('has-error');
					$('#template_edit_pannel').delay(1000).slideUp(1000);
					select_module_class('module_' + $('#tmp_module_id').val());
				} else {
					message += "添加失败了！</div>";
					$('#template_notification').fadeIn(400);
					$('#template_notification').html(message).delay(800).slideUp(800);
				}
			}
		});
	}

	function delete_template() {

		$.confirm({
			title: '警告!',
			content: '您真删除该检查项目?',
			typeAnimated: true,
			theme: 'material',
			columnClass: 'small',
			draggable: true,
			buttons: {
				OK: {
					text: '确定',
					action: function () {
						var template_id = $('#template_id').val();
						var base_url = '<?=base_url()?>';
						var report_module_id = $('#report_module_id');
						var strURL = base_url + "report/delete_template/";
						$.post(strURL, {
							template_id: template_id
						}).done(function (data) {
							if (data) {
								$.alert({
									title: '警告!',
									icon: 'fa fa-warning',
									columnClass: 'small',
									content: '删除成功了',
								});
								$('#report_module_form')[0].reset();
								$('#report_module_form').find('.help-block-error').remove();
								$('#report_module_form').find('.form-group').removeClass('has-error');
								$('#template_edit_pannel').css("display", "").fadeIn(1000);
								select_module_class('module_' + $('#tmp_module_id').val());
							} else {
								$.alert({
									title: '警告!',
									icon: 'fa fa-warning',
									columnClass: 'small',
									content: '删除失败了',
								});

							}
							return true;
						});

					}
				},
				somethingElse: {
					text: '返回',
					keys: ['enter', 'shift'],
					action: function () {
						return true;

					}
				}
			}
		});

	}

	function select_template_item(val) {
		$('#report_module_form').find('.help-block-error').remove();
		$('#report_module_form').find('.form-group').removeClass('has-error');
		var template_id = val.template_id;
		var template_name = val.template_name;
		var device_type = val.device_type;
		var report_module_id = val.report_module_id;
		var select_class = val.class_id;
		var checkup_name = val.checkup_name;
		var image_expression = val.image_expression;
		var recommended_report = val.recommended_report;
		$('#template_id').val(template_id);
		$('#select_class').val(select_class).change();
		$('#report_module_id').val(report_module_id).change();
		$('#device_type').val(device_type).change();
		$('#template_name').val(template_name);
		$('#checkup_name').val(checkup_name);
		$('#image_expression').val(image_expression);
		$('#recommended_report').val(recommended_report);
		$('#save_template').removeAttr("disabled");
		$('#delete_template_btn').removeAttr("disabled");
		$('#apply_template_btn').removeAttr('disabled');
		$('#template_edit_pannel').css("display", "block").fadeIn(1400);
	}

	function select_module_class(val) {
		var base_url = '<?=base_url()?>';
		if (!val) return true;
		$res = val.split('_');
		if ($res[0] != 'module') {
			$('#tmpClassId').val($res[1]);
			return true;

		}
		var module_id = $res[1];
		$('#tmp_module_id').val(module_id);
		var strURL = base_url + "report/get_template_data/" + module_id;
		table.ajax.url(strURL).load();
		$('#edit_template_class_btn').removeAttr('disabled');
		$('#delete_template_class_btn').removeAttr('disabled');
		var strURL1 = base_url + "report/get_module_Info/" + module_id;
		$.ajax({
			dataType: "json",
			url: strURL1,
			success: function (response) {
				$('#tmpClassId').val(response.class_id);
				changeNewTemplatePage();
			}
		});
	}

	function set_module_value(val) {
		$('#report_module').val(val);
	}

	function select_template(val) {
		var base_url = '<?=base_url()?>';
		var strURL = base_url + "report/get_template_info/" + val;
		$.ajax({
			dataType: "json",
			url: strURL,
			success: function (response) {
				$('#Imaging_performance').html(response.image_expression);
				$('#clinical_diagnosis').html(response.recommended_report);

			}
		});
	}

	function change_device_type(val) {
		$('#currentSearchReportClass').val(val);
		reload_Jstree(val);
		var base_url = '<?=base_url()?>';
		var module_id = $('#tmp_module_id').val();
		var strURL = base_url + "report/get_template_data/" + module_id + '/' + val;
		table.ajax.url(strURL).load();


	}

	function select_class_id(val) {
		var base_url = '<?=base_url()?>';
		var strURL = base_url + "report/select_class/";
		$.post(strURL, {
				select_class_id: val,
				selectDevice: $('#device_type').val()
			})
			.done(function (data) {
				class_data = JSON.parse(data);
				var count = Object.keys(class_data.module).length;
				display_data = '';
				for (var i = 0; i < count; i++) {
					display_data += '<option value = "' + class_data.module[i].module_id + '">' + class_data.module[
						i].module_name + '</option>';
				}
				$('#report_module_id').html(display_data);


				$('#report_module_id').val($('#tmp_module_id').val()).change();


			});
	};

	function apply_template() {
		var paramater = $('#template_id').val();
		select_template(paramater);
		$('#config_report_module').modal('hide');

	}

	function save_report() {
		$.confirm({
			title: '提示',
			icon: 'fa fa-spinner fa-spin',
			theme: 'material',
			animation: 'zoom',
			closeAnimation: 'scale',
			content: '您真保存报告吗？',
			containerFluid: true,
			autoClose: 'cancelAction|6000',
			buttons: {
				confirm: {
					text: '是',
					keys: ['shift', 'alt'],
					action: function () {
						var url = "<?=base_url()?>" + 'report/save_report/save';
						var form_data = $('#report_submit').serialize();
						console.log(form_data);
						$.ajax({
							url: url,
							type: 'post',
							dataType: "JSON",
							data: form_data,
							success: function (result) {
									$.alert({
										title: '提示',
										content: result.message,
										columnClass: 'small',
										icon: 'fa fa-warning',
										theme: 'material',
										buttons: {
											ok: function () {
												if(result.response_code){
													 window.location.href = "<?=base_url()?>report/individual";
												}else{
												}
											}
										}
									});
							}
						});
					}
				},
				cancelAction: {
					text: '否',
					btnClass: 'btn-blue',
					keys: ['enter', 'shift'],
					action: function () {}
				}
			}
		});

	}

	function reload_Jstree(vl) {
		var val = $('#currentSearchReportClass').val();
		$('#report_module_tree').jstree(true).settings.core.data.url = '<?=base_url()?>report/get_module_tree/' + val;
		$("#report_module_tree").jstree(true).refresh();

	}

	function save_report_info() {
		var url = "<?=base_url()?>" + 'report/save_report/';
		var form_data = $('#report_submit').serialize();
		$.ajax({
			url: url,
			type: 'post',
			dataType: "JSON",
			data: form_data,
			success: function (result) {
				console.log(result)
				if (result.status = 'success') {
					$.alert({
						title: '提示',
						content: '提交成功了！',
						columnClass: 'small',
						icon: 'fa fa-warning',
						theme: 'material',
						buttons: {
							ok: function () {
								window.location.href = "<?=base_url()?>report/individual";
							}
						}
					});
				} else {
					$.alert("提交失败了！");
				}
			}
		});
	}

	$(document).ready(function () {
		var base_url = '<?=base_url()?>';
		var strURL = base_url + "report/get_template_data/";
		table = $('#template_table').DataTable({
			"ajax": strURL,
			"ordering": false,
			'searching': false,
			select: true,
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
			columnDefs: [{
				orderable: !1,
				targets: [0]
			}, {
				searchable: !0,
				targets: [0]
			}],
			order: [
				[0, "asc"]
			]
		});
		$('#template_table_length').hide();
		$('#template_table_paginate').hide();
		$('#template_table_info').hide();
		$('#template_table tbody').on('click', 'tr', function () {
			if ($(this).hasClass('selected')) {
				$(this).removeClass('selected');
			} else {
				table.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}
			var data = table.row(this).data();
			var module_id = data[0];
			var base_url = '<?=base_url()?>';
			var strURL = base_url + "report/get_template_info/" + module_id;
			$.ajax({
				dataType: "json",
				url: strURL,
				success: function (response) {
					select_template_item(response);
				}
			});
		});
		$("#report_module_tree").jstree({
			"core": {
				"themes": {
					"responsive": false
				},
				"check_callback": true,
				'data': {
					'type': 'POST',
					'url': '<?=base_url()?>report/get_module_tree',
					"dataType": "json"
				}
			},
			"types": {
				"default": {
					"icon": "fa fa-suitcase icon-state-warning icon-lg"
				},
				"file": {
					"icon": "fa fa-file icon-state-warning icon-lg"
				}
			},
			"state": {
				"key": "demo3"
			},
			"plugins": ["dnd", "state", "json_data", "types"]
		}).on("changed.jstree", function (e, data) {
			select_module_class(data.instance.get_node(data.selected[0]).id);
		});

		$(".modal").draggable({
			handle: ".portlet-title"
		});
		$('#submit_func_btn').confirm({
			title: '提示',
			icon: 'fa fa-spinner fa-spin',
			theme: 'material',
			animation: 'zoom',
			closeAnimation: 'scale',
			columnClass: 'col-md-4 col-md-offset-4',
			content: '您真提交报告吗？',
			containerFluid: true,
			autoClose: 'cancelAction|8000',
			buttons: {
				confirm: {
					text: '是',
					keys: ['shift', 'alt'],
					action: function () {
						$("#report_submit").submit();
					}
				},
				cancelAction: {
					text: '否',
					btnClass: 'btn-blue',
					keys: ['enter', 'shift'],
					action: function () {}
				}
			}
		});
		var pattableurl = '<?=base_url()?>' + 'report/pastcheckup/' + '<?=$report_table->patient_code?>'

		var pastCheckup = $('#past_checlup_table').DataTable({
			"ajax": pattableurl,
			"ordering": false,
			'searching': false,
			select: true,
			language: {
				aria: {
					sortAscending: ": activate to sort column ascending",
					sortDescending: ": activate to sort column descending"
				},
				emptyTable: " ",
				info: "显示 _START_ 到 _END_ 的 _TOTAL_ 条记录",
				infoEmpty: " ",
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
			bStateSave: !0,
			columnDefs: [{
				targets: 0,
				orderable: !1,
				searchable: !0
			}],
			columnDefs: [{
				orderable: !1,
				targets: [0]
			}, {
				searchable: !0,
				targets: [0]
			}],
			order: [
				[0, "asc"]
			]
		});

		$('#past_checlup_table tbody').on('click', 'tr', function () {
			if ($(this).hasClass('selected')) {
				$(this).removeClass('selected');
			} else {
				pastCheckup.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}
			var report_id = $(this).find('.report_id').val();
			var base_url = '<?=base_url()?>';
			var strURL = base_url + "report/getPastReport/" + report_id;
			$.ajax({
				dataType: "json",
				url: strURL,
				success: function (response) {
					$('#pastImaging_performance').html(response.Imaging_performance);
					$('#pastclinical_diagnosis').html(response.recommend_report);
				}
			});
		});
	});
</script>
