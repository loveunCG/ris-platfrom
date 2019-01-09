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
					<?=$menutitle?>1
						<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<span>设备管理</span>
				</li>
			</ul>

		</div>
		<!-- BEGIN CONTENT BODY -->
		<div class="row" id="sortable_portlets">
			<div class="col-md-12 column sortable">
				<!-- BEGIN VALIDATION STATES-->
				<div class="portlet portlet-sortable box blue-madison">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-magnifier"></i>
							<span class="caption-subject font-light sbold uppercase">设备管理</span>
						</div>
					</div>
					<div class="portlet-body">
						<!-- BEGIN FORM-->
						<form action="<?=base_url()?>report/search_data" method="post" class="form-horizontal" id="search_device_form" novalidate>
							<div class="form-body">
								<div class="row">
									<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group form-md-line-input">
										<label class="col-lg-4 col-md-3 control-label" for="form_control_1">设备类型
										</label>
										<div class="col-md-9 col-lg-8">
											<select class="form-control" id="s_equipment_type" name="equipment_type">
												<option value="">请选择</option>
												<?php foreach ($get_device_type as $report) {
    echo '<option value="' . $report->equipment_type . '">' . $report->equipment_type . '</option>';
}?>
											</select>
											<div class="form-control-focus"> </div>
											<!--											<span class="help-block">请输入设备类型</span>-->
										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group form-md-line-input">
										<label class="col-md-3 col-lg-4 control-label" for="form_control_1">设备型号
										</label>
										<div class="col-md-9 col-lg-8">
											<input type="text" class="form-control" placeholder="" id="s_equipment_num" name="equipment_num">
											<div class="form-control-focus"> </div>
											<!--											<span class="help-block">请输入设备型号</span>-->
										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group form-md-line-input">
										<label class="col-md-3 col-lg-4 control-label" for="form_control_1">所属科室</label>
										<div class="col-md-9 col-lg-8">
											<select class="form-control" id="s_equipment_deaprtment" name="equipment_deaprtment">
												<option value="">请选择</option>
												<?php foreach ($equipment_deaprtment as $var_report) {
    echo '<option value="' . $var_report->equipment_deaprtment . '">' . $var_report->equipment_deaprtment . '</option>';
}?>
											</select>
											<!--											<span class="help-block">请输入设备型号</span>-->

										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group form-md-line-input">
										<label class="col-md-3 col-lg-4 control-label" for="form_control_1">诊室号</label>
										<div class="col-md-9 col-lg-8">
											<input class="form-control" id="s_equioment_room" name="equioment_room">
											<!--											<span class="help-block">请输入设备型号</span>-->

										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group form-md-line-input">
										<label class="control-label col-lg-4 col-md-3">添加时间</label>
										<div class="col-md-9 col-lg-8">
											<input class="form-control form-control-inline input-medium" placeholder="01/01/2017" name="start_time" size="20" type="text"
											value="" />
											<!--											<span class="help-block"> 选择日期 </span>-->
										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group form-md-line-input">
										<label class="control-label col-lg-4 col-md-3">至</label>
										<div class="col-md-9 col-lg-8">
											<input class="form-control form-control-inline input-medium" placeholder="01/01/2017" name="end_time" size="20" type="text"
											value="" />
											<!--											<span class="help-block"> 选择日期 </span>-->
										</div>
									</div>

									<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 form-group form-md-input">
										<button type="button" class="btn col-lg-offset-3 btn col-sm-offset-3 btn col-xs-offset-3 col-md-offset-6 blue-madison" id="search_device_btn">
											<span class="glyphicon glyphicon-search"> </span>查询</button>
										<button type="button" class="btn  blue-madison pull-right" onclick="search_clear()">
											<span class="glyphicon glyphicon-refresh"> </span>重置</button>
									</div>
								</div>
							</div>
						</form>
						<!-- END FORM-->
					</div>
				</div>
				<!-- END VALIDATION STATES-->
			</div>
			<div class="col-md-12 column sortable">
				<div class="portlet portlet-sortable box  blue-madison ">
					<div class="portlet-title">
						<div class="caption">
							<i class=" icon-layers font-green"></i>
							<span class="caption-subject font-light sbold uppercase">设备列表</span>
						</div>
						<div class="actions">

						</div>
					</div>

					<div class="portlet-body">
						<div id="result_notification"></div>
						<div class="clearfix" style="margin-left: 10%;">
							<input type="hidden" id="">
							<div class="row">
							<?php if ($usrRole == 1||$usrRole == 1024||$this->session->userdata('isNewDevice')):?>
								<button type="button" class="btn blue-madison" data-target="#add_device" onclick="refreshForm()" data-toggle="modal">
									<span class="glyphicon glyphicon-plus-sign"> </span>新增设备</button>

								<div id="add_device" class="modal fade" tabindex="-1" data-focus-on="input:first">
									<div class="portlet portlet-sortable box blue-madison">
										<div class="portlet-title">
											<div class="caption">
												<i class="fa fa-user-plus"></i>
												<span class="caption-subject font-light sbold uppercase">新增设备</span>
											</div>
											<div class="actions">
												<a data-dismiss="modal" onclick="AddDeviceClose()" class="btn btn-circle btn-icon-only btn-light">
													<i class="fa fa-close"></i>
												</a>
											</div>
										</div>
										<div class="portlet-body">
											<!-- BEGIN FORM-->
											<form action="#" method="post" id="form_add_device">
												<div class="form-body col-md-12">
													<div class="row col-md-12">
														<div class="form-group col-md-6 form-md-line-input ">
															<input type="text" name="equipment_type" autocomplete="off" class="form-control" id="n_equipment_type">
															<label for="form_control_1">设备类型</label>
															<span id="error_message" class="help-block">請輸入设备类型</span>
														</div>
														<div class="form-group col-md-6 form-md-line-input  has-success">
															<input type="text" class="form-control" onchange="duplication_num(this.value)" name="equipment_num" id="n_equipment_num">
															<label for="form_control_1">设备型号</label>
															<span class="help-block">请输入设备型号</span>
															<div id="error_check_duplication"></div>
														</div>
														<script>
															function duplication_num(val) {
																var base_url = '<?=base_url()?>';
																var strURL = base_url + "usermg/duplication_num";
																$.post(strURL, {
																		num_id: val
																	})
																	.done(function (data) {
																		if (data) {
																			$("#error_check_duplication").css("display", "block");
																			$("#error_check_duplication").html(data);
																			$("#submit_button").attr("disabled", "true");
																		} else {
																			$("#error_check_duplication").css("display", "none");
																			$("#submit_button").removeAttr("disabled");
																		}
																	});
															}

														</script>
													</div>
													<div class="row col-md-12">
														<div class="form-group col-md-6 form-md-line-input ">
															<input type="text" class="form-control" name="equioment_room" id="n_equioment_room">
															<label for="form_control_1">诊室号</label>
															<span class="help-block">请输入诊室号</span>
														</div>
														<div class="form-group col-md-6 form-md-line-input ">
															<select class="form-control" name="equipment_deaprtment" id="n_equipment_deaprtment">
																<option value=" ">请选择</option>
																<?php foreach ($department_info as $value) {
    echo '<option value="' . $value->department_name . '">' . $value->department_name . '</option>';
}
                                                                                ?>
															</select>
															<label for="form_control_1">所属科室</label>
															<span class="help-block">请输入所属科室</span>
														</div>
													</div>
													<div class="row col-md-12">

														<div class="form-group  col-md-6 form-md-line-input ">
															<input type="text" class="form-control" name="ip_address" id="n_ip_address">
															<label for="form_control_1">IP地址</label>
															<span class="help-block">请输入IP地址</span>
														</div>
														<div class="form-group  col-md-6 form-md-line-input  ">
															<input type="text" class="form-control" name="dicom_port" id="n_dicom_port">
															<label for="form_control_1">DICOM接口号</label>
															<span class="help-block">请输入DICOM接口号</span>
														</div>
													</div>

													<div class="form-group col-md-12 form-md-line-input">
														<label for="multiple1" class="control-label">工作日</label>
														<select id="multiple1" name="workingInterval[]" class="form-control form-md-line-input select2-multiple" multiple>
															<optgroup label="选择星期">
																<option value="Mon">星期一</option>
																<option value="Tue">星期二</option>
																<option value="Wed">星期三</option>
																<option value="Thu">星期四</option>
																<option value="Fri">星期五</option>
																<option value="Sat">星期六</option>
																<option value="Sun">星期天</option>
															</optgroup>
														</select>
													</div>
													<div class="row">
														<div class="col-md-12">
															<h4>每日工作时间：</h4>
															<div class="form-group col-md-6 form-md-line-input">
																<div class="input-group">
																	<input name="mornstart" value="" type="text" class="form-control timepicker timepicker-24">
																	<span class="input-group-btn">
																		<button class="btn default" type="button">
																			<i class="fa fa-clock-o"></i>
																		</button>
																	</span>
																	<label class="control-label">上午</label>
																</div>
															</div>
															<div class="form-group col-md-6 form-md-line-input">
																<div class="input-group">
																	<input type="text" name="mornend" value="" class="form-control timepicker timepicker-24">
																	<span class="input-group-btn">
																		<button class="btn default" type="button">
																			<i class="fa fa-clock-o"></i>
																		</button>
																	</span>
																	<label class="control-label">至</label>
																</div>
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group col-md-6 form-md-line-input">
																<div class="input-group">
																	<input name="noonstart" type="text" value="" class="form-control timepicker timepicker-24">
																	<span class="input-group-btn">
																		<button class="btn default" type="button">
																			<i class="fa fa-clock-o"></i>
																		</button>
																	</span>
																	<label class="control-label">下午</label>
																</div>
															</div>
															<div class="form-group col-md-6 form-md-line-input">
																<div class="input-group">
																	<input name="noonend" type="text" value="" class="form-control timepicker timepicker-24">
																	<span class="input-group-btn">
																		<button class="btn default" type="button">
																			<i class="fa fa-clock-o"></i>
																		</button>
																	</span>
																	<label class="control-label">至</label>
																</div>
															</div>

														</div>
													</div>
													<div class="row col-md-12">

														<div class="form-group  col-md-6 form-md-line-input ">
															<input type="text" class="form-control" name="check_interval" id="n_check_interval">
															<label for="form_control_1">每个人检查时间</label>
															<span class="help-block">请输入每个人检查时间</span>
														</div>
														<div class="form-group  col-md-6 form-md-line-input  ">
															<input type="text" class="form-control" name="limitpatient" id="n_limitpatient">
															<label for="form_control_1">每天检查人数</label>
															<span class="help-block">请输入每天检查人数</span>
														</div>
													</div>

                                                    <div class="row col-md-12">
                                                        <div class="form-group  col-md-6 form-md-line-input ">
                                                            <input type="text" class="form-control" id="n_AETitle" name="AETitle">
                                                            <label for="form_control_1">AETitle</label>
                                                        </div>
                                                        <div class="form-group form-md-radios">
                                                            <label>MPPS 服务</label>
                                                            <div class="md-radio-inline">
                                                                <div class="md-radio">
                                                                    <input type="radio" value="1" id="radio6" name="ismpps" class="md-radiobtn">
                                                                    <label for="radio6">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> 是 </label>
                                                                </div>
                                                                <div class="md-radio">
                                                                    <input type="radio" value="2" id="radio7" name="ismpps" class="md-radiobtn" checked>
                                                                    <label for="radio7">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> 否 </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

												</div>
												<div class="form-actions">
													<div class="row">
														<div class="col-md-offset-1 col-md-10">
															<button type="submit" id="submit_button" class="btn blue-madison pull-left">
																<span class="glyphicon glyphicon-plus"> </span>添加</button>
															<a data-dismiss="modal" onclick="AddDeviceClose()" class="btn blue-madisonpull-right">
																<span class="glyphicon glyphicon-log-out"> </span>返回</a>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							<?php endif;?>
							<?php if ($usrRole == 1||$usrRole == 1024||$this->session->userdata('isActivationDevice')):?>
								<button type="button" class="btn blue-madison" disabled id="edit_user_data_btn" data-target="#edit_user_data" data-toggle="modal">
									<span class="glyphicon glyphicon-pencil"> </span>编辑</button>

								<div id="edit_user_data" class="modal fade" tabindex="-1" data-focus-on="input:first">
									<div class="portlet portlet-sortable box blue-madison column sortable">
										<div class="portlet-title">
											<div class="caption">
												<i class="fa fa-user-plus"></i>
												<span class="caption-subject font-red sbold uppercase">修改信息</span>
											</div>
											<div class="actions">
												<a data-dismiss="modal" onclick="EditDeviceClose()" class="btn btn-circle btn-icon-only btn-light">
													<i class="fa fa-close"></i>
												</a>
											</div>
										</div>
										<div class="portlet-body">
											<!-- BEGIN FORM-->
											<form action="#" method="post" id="update_device">
												<div class="form-body">
													<div class="row col-md-12">
														<input type="hidden" name="device_dat_id" id="device_dat_id">
														<div class="form-group col-md-6 form-md-line-input ">
															<input type="text" name="equipment_type" autocomplete="off" class="form-control" id="equipment_type">
															<label for="form_control_1">设备类型</label>
															<!--															<span id="error_message" class="help-block">請輸入设备类型</span>-->
														</div>
														<div class="form-group col-md-6 form-md-line-input">
															<input type="text" class="form-control" name="equipment_num" id="equipment_num">
															<label for="form_control_1">设备型号</label>
															<!--															<span class="help-block">请输入设备型号</span>-->
														</div>

													</div>
													<div class="row col-md-12">
														<div class="form-group col-md-6 form-md-line-input ">
															<input type="text" class="form-control" name="equioment_room" id="equioment_room">
															<label for="form_control_1">诊室号</label>
															<!--															<span class="help-block">请输入年龄</span>-->
														</div>

														<div class="form-group col-md-6 form-md-line-input ">
															<select class="form-control" name="equipment_deaprtment" id="equipment_deaprtment">
																<option value="">请选择</option>
																<?php foreach ($department_info as $value) {
                                                                                    echo '<option value="' . $value->department_name . '">' . $value->department_name . '</option>';
                                                                                }
                                                                    ?>
															</select>
															<label for="form_control_1">所属科室</label>
															<!--															<span class="help-block">请输入所属科室</span>-->
														</div>
													</div>
													<div class="row col-md-12">
														<div class="form-group  col-md-6 form-md-line-input ">
															<input type="text" class="form-control" name="ip_address" id="ip_address">
															<label for="form_control_1">IP地址</label>
															<!--															<span class="help-block">请输入联系方式</span>-->
														</div>
														<div class="form-group  col-md-6 form-md-line-input  ">
															<input type="text" class="form-control" name="dicom_port" id="dicom_port">
															<label for="form_control_1">DICOM接口号</label>
															<!--															<span class="help-block">请输入联系方式</span>-->
														</div>

													</div>

													<div class="form-group col-md-12 form-md-line-input">
														<label for="multiple" class="control-label">工作日</label>
														<select id="multiple" name="workingInterval[]" class="form-control select2-multiple" multiple>
															<optgroup label="选择星期">
																<option value="Mon">星期一</option>
																<option value="Tue">星期二</option>
																<option value="Wed">星期三</option>
																<option value="Thu">星期四</option>
																<option value="Fri">星期五</option>
																<option value="Sat">星期六</option>
																<option value="Sun">星期天</option>
															</optgroup>
														</select>
													</div>

													<div class="row">
														<div class="col-md-12">
															<h4>工作时间：</h4>

															<div class="form-group col-md-6 form-md-line-input">
																<div class="input-group">
																	<input name="mornstart" id="mornstart" type="text" class="form-control timepicker timepicker-24">
																	<span class="input-group-btn">
																		<button class="btn default" type="button">
																			<i class="fa fa-clock-o"></i>
																		</button>
																	</span>
																	<label class="control-label">上午</label>
																</div>
															</div>
															<div class="form-group col-md-6 form-md-line-input">
																<div class="input-group">
																	<input type="text" name="mornend" id="mornend" class="form-control timepicker timepicker-24">
																	<span class="input-group-btn">
																		<button class="btn default" type="button">
																			<i class="fa fa-clock-o"></i>
																		</button>
																	</span>
																	<label class="control-label">至</label>
																</div>
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group col-md-6 form-md-line-input">
																<div class="input-group">
																	<input name="noonstart" id="noonstart" type="text" class="form-control timepicker timepicker-24">
																	<span class="input-group-btn">
																		<button class="btn default" type="button">
																			<i class="fa fa-clock-o"></i>
																		</button>
																	</span>
																	<label class="control-label">下午</label>
																</div>
															</div>
															<div class="form-group col-md-6 form-md-line-input">
																<div class="input-group">
																	<input name="noonend" id="noonend" type="text" class="form-control timepicker timepicker-24">
																	<span class="input-group-btn">
																		<button class="btn default" type="button">
																			<i class="fa fa-clock-o"></i>
																		</button>
																	</span>
																	<label class="control-label">至</label>
																</div>
															</div>

														</div>
													</div>

													<div class="row col-md-12">

														<div class="form-group  col-md-6 form-md-line-input ">
															<input type="text" class="form-control" name="check_interval" id="check_interval">
															<label for="check_interval">每个人检查时间</label>
														</div>
														<div class="form-group  col-md-6 form-md-line-input  ">
															<input type="text" class="form-control" name="limitpatient" id="limitpatient">
															<label for="limitpatient">每天检查人数</label>
														</div>
													</div>

                                                    <div class="row col-md-12">
                                                        <div class="form-group  col-md-6 form-md-line-input ">
                                                            <input type="text" class="form-control" id="u_AETitle" name="AETitle">
                                                            <label for="AETitle">AETitle</label>
                                                        </div>
                                                        <div class="form-group form-md-radios">
                                                            <label>MPPS 服务</label>
                                                            <div class="md-radio-inline">
                                                                <div class="md-radio">
                                                                    <input type="radio" value="1" id="mppstrue" name="ismpps" class="md-radiobtn">
                                                                    <label for="mppstrue">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> 是 </label>
                                                                </div>
                                                                <div class="md-radio">
                                                                    <input type="radio" value="2" id="mppsfalse" name="ismpps" class="md-radiobtn">
                                                                    <label for="mppsfalse">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> 否 </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
												</div>

												<div class="form-actions">
													<div class="row">
														<div class="col-md-10 col-md-offset-1">
															<button type="submit" id="equipment_update_bn" class="btn blue-madison pull-left">
																<span class="glyphicon glyphicon-edit"> </span>修改</button>
															<a data-dismiss="modal" onclick="EditDeviceClose()" class="btn blue-madison pull-right">
																<span class="glyphicon glyphicon-log-out"> </span>返回</a>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							<?php endif;?>
							<?php if ($usrRole == 1||$usrRole == 1024||$this->session->userdata('isEditableDevice')):?>
								<button type="button" class="btn blue-madison" disabled data-toggle="modal" onclick="start_device()" id="start_device">
									<span class="glyphicon glyphicon-play"> </span>开启</button>
								<button type="button" class="btn blue-madison" id="stop_device" onclick="stop_device()">
									<span class="glyphicon glyphicon-stop"> </span>禁用</button>
							<?php endif;?>
							<?php if ($usrRole == 1||$usrRole == 1024||$this->session->userdata('isDeleteDevice')):?>
								<button type="button" class="btn blue-madison" disabled id="delect_device">
									<span class="glyphicon glyphicon-trash"> </span>删除</button>
								<div id="delect_device——m" class="modal fade box " tabindex="-1" data-backdrop="static" data-keyboard="false" data-attention-animation="false">
									<div class="modal-header bg-blue-soft">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
										<h4 class="modal-title">提示</h4>
									</div>
									<div class="modal-body">
										<p> 确定要删除吗？ </p>
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-outline dark">否</button>
										<a type="button" class="btn btn-primary mt-ladda-btn ladda-button" onclick="delect_device()" data-style="expand-right">
											<span class="ladda-label"> 是</span>
										</a>
									</div>
								</div>
							<?php endif;?>

							</div>
						</div>
						<table class="table table-striped table-bordered table-hover" id="tbl_device_info">
							<thead>
								<tr>
									<th>序号</th>
									<th>设备状态</th>
									<th>设备类型</th>
									<th>设备型号</th>
									<th>所属科室</th>
									<th>诊室号</th>
									<th>AETitle</th>
									<th>IP地址</th>
                  <th>DICOM接口号</th>
                  <th>MPPS状态</th>
									<th>添加时间</th>
									<th>禁用时间</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>

	var table = [];

	function refreshForm() {
		$('#form_add_device')[0].reset();
	}

	function AddDeviceClose() {
		$('#error_check_duplication').html('');
		$('#form_add_device').find('.help-block-error').remove();
		$('#form_add_device').find('.form-group').removeClass('has-error');
		$('#form_add_device')[0].reset();
		$('#multiple1').select2("val", [
			' ', ' '
		]);
	}

	function EditDeviceClose() {
		$('#edit_user_data').find('.help-block-error').html('');
		$('#edit_user_data').find('.form-group').removeClass('has-error');
		$('#edit_user_data_btn').attr('disabled', 'true');

	}

	$(document).ready(function () {
		var tbl_usr_info = '<?=base_url()?>' + 'usermg/search_device';

		table = $('#tbl_device_info').DataTable({
			"ajax": tbl_usr_info,
			dom: 'Bfrtip',
			"ordering": false,
			select: true,
			dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
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
			},
				{"className": "dt-center", "targets": "_all"}
			],
			lengthMenu: [
				[5, 15, 20, -1],
				[5, 15, 20, "All"]
			],
			pageLength: 10,
			pagingType: "bootstrap_full_number",
			'searching': false,
			order: [
				[0, "asc"]
			]
		});

		table.buttons().remove();

		$('#tbl_device_info tbody').on('click', 'tr', function () {
			if ($(this).hasClass('selected')) {
				$(this).removeClass('selected');
			} else {
				table.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}
			var device_id = $(this).find('.device_id').val();
			var base_url = '<?=base_url()?>';
			var strURL = base_url + "usermg/get_device_info/" + device_id;
			$.ajax({
				dataType: "json",
				url: strURL,
				success: function (response) {
					select_device(response);
				}
			});
		});

		$("#search_device_btn").click(function () {
			var base_url = '<?=base_url()?>';
			var formData = $('#search_device_form').serialize();
			var ajaxurl = base_url + 'usermg/search_device?' + formData;
			table.ajax.url(ajaxurl).load();
		});

		$(".modal").draggable({
			handle: ".portlet-title"
		});

		$('#delect_device').click(function () {
			$.confirm({
				title: '提示',
				content: ' 确定要删除吗？',
				icon: 'fa fa-warning',
				theme: 'material',
				autoClose: 'chancel|10000',
				animation: 'zoom',
				closeAnimation: 'scale',
				draggable: true,
				buttons: {
					confirm: {
						text: '是',
						keys: ['shift', 'alt'],
						action: function () {
							var base_url = '<?=base_url()?>';
							val = $('#device_dat_id').val();
							var strURL = base_url + "usermg/delect_device";
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

	function select_device(val) {
		var equipment_type = val.equipment_type;
		var equipment_num = val.equipment_num;
		var equipment_deaprtment = val.equipment_deaprtment;
		var ip_address = val.ip_address;
		var equioment_room = val.equioment_room;
		var dicom_port = val.dicom_port;
		var equipment_status = val.equipment_status;
		var AETitle = val.AETitle;
		var id = val.id;
		$('#device_dat_id').val(id);
		$('#equipment_num').val(equipment_num);
		$('#equipment_type').val(equipment_type);
		$('#equipment_deaprtment').val(equipment_deaprtment);
		$('#equioment_room').val(equioment_room);
		$('#ip_address').val(ip_address);
		$('#mornstart').val(val.mornstart);
		$('#mornend').val(val.mornend);
		$('#noonstart').val(val.noonstart);
		$('#noonend').val(val.noonend);
		$('#check_interval').val(val.check_interval);
		$('#limitpatient').val(val.limitpatient);
		$('#dicom_port').val(dicom_port);
		$('#equipment_status').val(equipment_status);
		$('#u_AETitle').val(AETitle);
		if(val.ismpps == '1'){
            $('#mppstrue').attr('checked',true);
            $('#mppsfalse').removeAttr('checked');
            $('#mppstrue').click();


        }else{
            $('#mppsfalse').attr('checked', true);
            $('#mppsfalse').click();
            $('#mppstrue').removeAttr('checked');

        }
		$('#multiple').select2("val", [
			val.is_sunday == null ? ' ' : val.is_sunday,
			val.is_monday == null ? ' ' : val.is_monday,
			val.is_tuesday == null ? ' ' : val.is_tuesday,
			val.is_wendnesday == null ? ' ' : val.is_wendnesday,
			val.is_thursday == null ? ' ' : val.is_thursday,
			val.is_friday == null ? ' ' : val.is_friday,
			val.is_saturday == null ? ' ' : val.is_saturday
		]);
		if (equipment_status == '1') {
			$("#start_device").attr("disabled", "true");
			$("#stop_device").removeAttr("disabled");
			$("#edit_user_data_btn").removeAttr("disabled");

		} else if (equipment_status == '2') {
			$("#stop_device").attr("disabled", "true");
			$("#edit_user_data_btn").attr("disabled", "true");
			$("#start_device").removeAttr("disabled");
		} else {
			$("#edit_user_data_btn").removeAttr("disabled");
			$("#start_device").removeAttr("disabled");
			$("#stop_device").attr("disabled", "true");
		}
		$("#delect_device").removeAttr("disabled");
	}

	function update_equipmentinfo() {
		var base_url = '<?=base_url()?>';
		var strURL = base_url + "usermg/update_device/";
		var formData = $('#update_device').serialize();
		var mornstart = $('#update_device').find('input[name="mornstart"]').val();
		var mornend = $('#update_device').find('input[name="mornend"]').val();
		var noonstart = $('#update_device').find('input[name="noonstart"]').val();
		var noonend = $('#update_device').find('input[name="noonend"]').val();
		$.post(strURL, formData).done(function (data) {
			if (data) {
				$.alert({
					title: '报告!',
					content: data.message,
					columnClass: 'small',
					closeIcon: true,
					theme: 'material',
					draggable: true,
					animation: 'zoom',
					closeAnimation: 'scale',
					buttons: {
						ok: function () {
							table.ajax.reload();
							if(data.response_code){
								$('#edit_user_data').modal('toggle');
							}else{

							}
						}
					}
				});
			} else {}
		});
	}

	function add_equipmentinfo() {
		var base_url = '<?=base_url()?>';
		var strURL = base_url + "usermg/add_equipment/";
		var formData = $('#form_add_device').serialize();
		var mornstart = $('#form_add_device').find('input[name="mornstart"]').val();
		var mornend = $('#form_add_device').find('input[name="mornend"]').val();
		var noonstart = $('#form_add_device').find('input[name="noonstart"]').val();
		var noonend = $('#form_add_device').find('input[name="noonend"]').val();
		conole.log(mornstart);
		$.post(strURL, formData).done(function (data) {
			if (data) {
				$.alert({
					title: '报告!',
					content: data.message,
					columnClass: 'small',
					theme: 'material',
					buttons: {
						ok: function () {
							table.ajax.reload();
							if(data.response_code){
								$('#add_device').modal('toggle');
								$('#form_add_device')[0].reset();
							}else{

							}
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
						content: '该设备已激活了',
						columnClass: 'small',
						icon: 'fa fa-warning',
						theme: 'material',
						buttons: {
							ok: function () {
								table.ajax.reload();
							},
						}
					});
				} else {
					table.ajax.reload();
				}
			});
	}

	function stop_device() {
		var base_url = '<?=base_url()?>';
		val = $('#device_dat_id').val();
		var strURL = base_url + "usermg/stop_device";
		$.post(strURL, {
				device_dat_id: val
			})
			.done(function (data) {
				if (data) {

					$.alert({
						title: '报告!',
						content: '该设备已注销',
						theme: 'material',
						icon: 'fa fa-warning',
						columnClass: 'small',
						buttons: {
							ok: function () {
								table.ajax.reload();
							},
						}
					});

				} else {
					table.ajax.reload();
				}
			});
	}

	function search_clear() {
		$('#search_device_form')[0].reset();
		table.ajax.reload();
	}

</script>
