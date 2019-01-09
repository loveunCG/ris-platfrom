<script src="<?=base_url()?>assets/global/scripts/pinyin.js" type="text/javascript"></script>
<div class="page-content-wrapper">
	<div class="page-content">
		<h3 class="page-title">
			病人信息管理 </h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="icon-home"></i> 病人信息管理
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<span>登记检查</span>
				</li>
			</ul>
		</div>
		<div class="full-height-content" id="sortable_portlets">
			<div class="full-height-content-body">
				<form class="well form-horizontal" action="#" method="post" id="patient_info_submit">
					<div class="row">
						<div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
							<div class="row">
								<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
									<div class="portlet portlet-sortable box blue-madison">
										<div class="portlet-title">
											<div class="caption">
												<i class="fa fa-plus"></i>
												<?=$this->lang->line('patient_info')?>
											</div>
										</div>
										<div class="portlet-body" style="display: block;">
											<div class="form-group ">
												<label class="col-lg-4 col-md-4 pull-left control-label" for="form_control_1">
													<?=$this->lang->line('image_num')?>:
												</label>
												<div class="col-lg-8 col-md-8">
													<input type="text" class="form-control" value="<?=isset($booking_edit_info->image_num) ? $booking_edit_info->image_num : $image_num?>"
													id="image_num" name="image_num" readonly>
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="form-group ">
												<label class="col-lg-4 col-md-4 control-label" for="form_control_1">
													<?=$this->lang->line('patient_name')?>:
												</label>
												<div class="col-lg-8 col-md-8">
													<input type="text" class="form-control" onchange="convertpinyin(this.value)" value="<?=isset($booking_edit_info->patient_name) ? $booking_edit_info->patient_name : ''?>"
													id="patient_name" name="patient_name">
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="form-group ">
												<label class="col-lg-4 col-md-4 control-label" for="form_control_1">
													<?=$this->lang->line('gender')?>:</label>
												<?php $patient_gender = isset($booking_edit_info->patient_gender) ? $booking_edit_info->patient_gender : ''?>
												<div class="col-lg-8 col-md-8">
													<select class="form-control" id="patient_gender" value="<?=isset($booking_edit_info->patient_gender) ? $booking_edit_info->patient_gender : ''?>"
													name="patient_gender">
														<option value="">请选择</option>
														<option <?=$patient_gender=='0' ? 'selected' : ''?> value="0">
															<?=$this->lang->line('man')?>
														</option>
														<option <?=$patient_gender=='1' ? 'selected' : ''?> value="1">
															<?=$this->lang->line('woman')?>
														</option>
													</select>
													<div class="form-control-focus"></div>
												</div>
											</div>
											<div class="form-group ">
												<label class="col-lg-4 col-md-4 control-label" for="form_control_1">
													<?=$this->lang->line('patient_type')?>:</label>
												<?php $patient_type = isset($booking_edit_info->patient_type) ? $booking_edit_info->patient_type : ''?>
												<div class="col-lg-8 col-md-8">
													<select class="form-control" id="patient_type" value="<?=$patient_type?>" name="patient_type">
														<option value="">请选择</option>
														<option <?=$patient_type=='0' ? 'selected' : ''?> value="0">平诊</option>
														<option <?=$patient_type=='1' ? 'selected' : ''?> value="1">急诊</option>
														<option <?=$patient_type=='2' ? 'selected' : ''?> value="2">VIP</option>
													</select>
													<div class="form-control-focus"></div>
												</div>
											</div>
											<div class="form-group ">
												<label class="col-lg-4 col-md-4 control-label" for="form_control_1">
													<?=$this->lang->line('age')?>:</label>
												<div class="col-lg-4 col-md-4">
													<?php $patient_age = isset($booking_edit_info->patient_age) ? $booking_edit_info->patient_age : ''?>
													<input type="text" class="form-control" value="<?=$patient_age?>" id="patient_age" name="patient_age">
													<div class="form-control-focus"> </div>
												</div>
												<div class="col-lg-4 col-md-4">
													<select class="form-control" id="agetype" name="agetype">
														<option value="<?=$this->lang->line('year')?>">
															<?=$this->lang->line('year')?>
														</option>
														<option value="<?=$this->lang->line('month')?>">
															<?=$this->lang->line('month')?>
														</option>
														<option value="<?=$this->lang->line('day')?>">
															<?=$this->lang->line('day')?>
														</option>
													</select>
													<div class="form-control-focus"></div>
												</div>
											</div>
											<div class="form-group ">
												<label class="col-lg-4 col-md-4 control-label" for="form_control_1">
													<?=$this->lang->line('birthday')?>:
												</label>
												<div class="col-lg-8 col-md-8">
													<?php $patient_birthday = isset($booking_edit_info->patient_birthday) ? $booking_edit_info->patient_birthday : ''?>
													<input type="text" class="form-control form-control-inline date-picker" value="<?=$patient_birthday?>" name="patient_birthday"
													id="patient_birthday">
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="form-group ">
												<label class="col-lg-4 col-md-4 control-label" for="form_control_1">
													<?=$this->lang->line('phone')?>:
												</label>
												<div class="col-lg-8 col-md-8">
													<?php $patient_phone_num = isset($booking_edit_info->patient_phone_num) ? $booking_edit_info->patient_phone_num : ''?>

													<input type="text" class="form-control" value="<?=$patient_phone_num?>" id="patient_phone_num" name="patient_phone_num">
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="form-group ">
												<label class="col-lg-4 col-md-4 control-label" for="form_control_1">
													<?=$this->lang->line('license')?>:
												</label>
												<div class="col-lg-8 col-md-8">
													<?php $license_num = isset($booking_edit_info->license_num) ? $booking_edit_info->license_num : ''?>

													<input type="text" class="form-control" value="<?=$license_num?>" id="license_num" name="license_num">
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="form-group ">
												<label class="col-lg-4 col-md-4 control-label" for="form_control_1">
													<?=$this->lang->line('patient_source')?>:</label>
												<div class="col-lg-8 col-md-8">
													<select class="form-control" id="patient_source" name="patient_source">
														<?php $patient_source = isset($booking_edit_info->patient_source) ? $booking_edit_info->patient_source : ''?>

														<option value="">请选择</option>
														<option <?=$patient_source==0 ? 'selected ' : ''?>value="0">门诊</option>
														<option <?=$patient_source==1 ? 'selected ' : ''?> value="1">住院</option>
														<option <?=$patient_source==2 ? 'selected ' : ''?>value="2">体检</option>
													</select>
													<div class="form-control-focus"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
									<div class="portlet portlet-sortable box blue-madison">
										<div class="portlet-title">
											<div class="caption">
												<i class="fa fa-plus"></i>
												<?=$this->lang->line('checkup_info')?>
											</div>
										</div>
										<div class="portlet-body" style="display: block;">
											<div class="form-group ">
												<label class="col-lg-4 col-md-4 control-label" for="form_control_1">
													<?=$this->lang->line('patient_num')?>:
												</label>
												<div class="col-lg-8 col-md-8">
													<?php $patient_code = isset($booking_edit_info->patient_code) ? $booking_edit_info->patient_code : ''?>

													<input type="text" class="form-control" id="patient_code" value="<?=$patient_code?>" name="patient_code">
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-4 col-md-4 control-label" for="form_control_1">
													<?=$this->lang->line('pinyin')?>:
												</label>
												<div class="col-lg-8 col-md-8">
													<?php $patient_pinyin = isset($booking_edit_info->patient_pinyin) ? $booking_edit_info->patient_pinyin : ''?>

													<input type="text" class="form-control" id="patient_pinyin" value="<?=$patient_pinyin?>" name="patient_pinyin">
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-4 col-md-4 control-label" for="form_control_1">
													<?=$this->lang->line('req_doctor')?>:
												</label>
												<div class="col-lg-8 col-md-8">
													<input type="text" class="form-control" readonly value="<?=$this->session->userdata('usr_name')?>">
													<input type="hidden" class="form-control" readonly id="req_doctor_name" value="<?=$this->session->userdata('usr_id')?>" name="req_doctor_name">
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="form-group ">
												<label class="col-lg-4 col-md-4 control-label" for="form_control_1">
													<?=$this->lang->line('req_field')?>:
												</label>
												<div class="col-lg-8 col-md-8">
													<?php $req_branch = isset($booking_edit_info->req_branch) ? $booking_edit_info->req_branch : ''?>

													<input type="text" class="form-control" id="req_branch" value="<?=$req_branch?>" name="req_branch">
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="form-group ">
												<label class="col-lg-4 col-md-4 control-label" for="form_control_1">
													<?=$this->lang->line('hos_num')?>:
												</label>
												<div class="col-lg-8 col-md-8">
													<?php $hospital_num = isset($booking_edit_info->hospital_num) ? $booking_edit_info->hospital_num : ''?>

													<input type="text" class="form-control" id="hospital_num" value="<?=$hospital_num?>" name="hospital_num">
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="form-group ">
												<label class="col-lg-4 col-md-4 control-label" for="form_control_1">
													<?=$this->lang->line('depart_num')?>:
												</label>
												<div class="col-lg-8 col-md-8">
													<?php $room_num = isset($booking_edit_info->room_num) ? $booking_edit_info->room_num : ''?>

													<input type="text" class="form-control" id="room_num" value="<?=$room_num?>" name="room_num">
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="form-group ">
												<label class="col-lg-4 col-md-4 control-label" for="form_control_1">
													<?=$this->lang->line('bed_num')?>:
												</label>
												<div class="col-lg-8 col-md-4">
													<?php $bed_num = isset($booking_edit_info->bed_num) ? $booking_edit_info->bed_num : ''?>

													<input type="text" class="form-control" id="bed_num" value="<?=$bed_num?>" name="bed_num">
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-4 col-md-4 control-label" for="form_control_1">
													<?=$this->lang->line('cost_type')?>:</label>
												<div class="col-lg-8 col-md-8">
													<?php $ecost_type = isset($booking_edit_info->cost_type) ? $booking_edit_info->cost_type : ''?>

													<select class="form-control" name="cost_type">
														<option value="">请选择</option>
														<option <?=$ecost_type==0 ? 'selected' : ''?> value="0">公费</option>
														<option <?=$ecost_type==1 ? 'selected' : ''?> value="1">自费</option>
													</select>
													<div class="form-control-focus"></div>
												</div>
											</div>
											<div class="form-group ">
												<label class="col-lg-4 col-md-4 control-label" for="form_control_1">
													<?=$this->lang->line('clinical_diagnosis')?>:
												</label>
												<div class="col-lg-8 col-md-8">
													<?php $clinical_diagnosis = isset($booking_edit_info->clinical_diagnosis) ? $booking_edit_info->clinical_diagnosis : ''?>

													<input type="text" class="form-control" value="<?=$clinical_diagnosis?>" id="clinical_diagnosis" name="clinical_diagnosis">
													<div class="form-control-focus"> </div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
									<div class="portlet portlet-sortable box blue-madison">
										<div class="portlet-title">
											<div class="caption">
												<i class="fa fa-plus"></i>
												<?=$this->lang->line('other_info')?>
											</div>
										</div>
										<div class="portlet-body" style="display: block;">
											<fieldset>
												<div class="form-group ">
													<label class="col-lg-4 col-md-4 control-label">
														<?=$this->lang->line('health_insurance_num')?>:</label>
													<div class=" col-lg-8 col-md-8 inputGroupContainer">
														<div class="input-group">
															<span class="input-group-addon"></span>
															<?php $health_insurance_num = isset($booking_edit_info->health_insurance_num) ? $booking_edit_info->health_insurance_num : ''?>

															<input name="health_insurance_num" id="health_insurance_num" value="<?=$health_insurance_num?>" class="form-control" type="text">
															<div class="form-control-focus"> </div>
														</div>
													</div>
												</div>
												<div class="form-group ">
													<label class="col-lg-4 col-md-4 control-label">
														<?=$this->lang->line('clinic_num')?>：</label>
													<div class="col-lg-8 col-md-8 inputGroupContainer">
														<div class="input-group">
															<span class="input-group-addon"></span>
															<?php $clinic_num = isset($booking_edit_info->clinic_num) ? $booking_edit_info->clinic_num : ''?>

															<input name="clinic_num" id="clinic_num" value="<?=$clinic_num?>" class="form-control" type="text">
															<div class="form-control-focus"> </div>
														</div>
													</div>
												</div>
												<div class="form-group ">
													<label class="col-lg-4 col-md-4 control-label">
														<?=$this->lang->line('social_security_num')?>：</label>
													<div class="col-lg-8 col-md-8 inputGroupContainer">
														<div class="input-group">
															<span class="input-group-addon"></span>
															<?php $social_security_num = isset($booking_edit_info->social_security_num) ? $booking_edit_info->social_security_num : ''?>

															<input name="social_security_num" id="social_security_num" value="<?=$social_security_num?>" class="form-control" type="text">
															<div class="form-control-focus"> </div>
														</div>
													</div>
												</div>
												<div class="form-group ">
													<label class=" col-lg-4 col-md-4 control-label">
														<?=$this->lang->line('address')?>：</label>
													<div class="col-lg-8 col-md-8 inputGroupContainer">
														<div class="input-group">
															<span class="input-group-addon"></span>
															<?php $patient_address = isset($booking_edit_info->patient_address) ? $booking_edit_info->patient_address : ''?>

															<input name="patient_address" id="patient_address" value="<?=$patient_address?>" class="form-control" type="text">
															<div class="form-control-focus"> </div>
														</div>
													</div>
												</div>
												<div class="form-group ">
													<label class=" col-lg-4 col-md-4 control-label">
														<?=$this->lang->line('remark')?>：</label>
													<div class="col-lg-8 col-md-8">
														<?php $patient_remark = isset($booking_edit_info->patient_remark) ? $booking_edit_info->patient_remark : ''?>
														<textarea id="patient_remark" name="patient_remark" class="form-control autosizeme" rows="2" data-autosize-on="true">
															<?=$patient_remark?>
														</textarea>
													</div>
													<div class="form-control-focus"> </div>
												</div>
											</fieldset>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
									<div class="portlet portlet-sortable box blue-madison">
										<div class="portlet-title">
											<div class="caption">
												<span class="glyphicon glyphicon-compressed"> </span>
												检查设备
											</div>
										</div>
										<div class="portlet-body">
											<div class="clearfix">
												<div class="btn-group col-md-offset-1" data-toggle="buttons">
													<?php for ($i = 0; $i < 7; $i++): ?>
													<label class="btn green  btn-outline <?=$i == 0 ? 'active' : ''?>">
														<input type="radio" name="SelectCheckupDate" onchange="select_checkup_date(this.value)" value="<?=date(" Y-m-d
														", strtotime("+$i day "))?>" class="toggle">
														<?=date("Y-m-d", strtotime("+$i day"));?>
													</label>
													<?php endfor;?>
												</div>
											</div>
											<div class="table-responsive">
												<table class="table table-striped table-advance table-hover">
													<!-- <thead>
														<th>类型</th>
														<?php for ($i = 0; $i < $list_type_num; $i++): ?>
														<th style="width: <?=100 / $list_type_num?>%">设备</th>
														<?php endfor;?>
													</thead> -->
													<tbody>
														<?php foreach ($equipment_type as $value): ?>
														<tr>
															<td>
																<button type="button" class="btn dark sbold uppercase" disabled>
																	<?=$value->equipment_type?>
																</button>
															</td>
															<?php foreach ($all_device_info as $device):
                                                                if ($device->equipment_type == $value->equipment_type):
                                                                    $status = 'disabled data-toggle="tooltip" data-placement="left" title="设备故障"';
                                                                    $class_status = 'red';
                                                                    if ($device->equipment_status == '1'):
                                                                        $status = '';
                                                                        $class_status = 'btn-outline';
                                                                    endif;
                                                                    echo '<td id="' . $device->id . 'btn"><button type="button" class="btn sbold uppercase ' . $class_status . '"  ' . $status . '  onclick="selelct_checkup_device(' . $device->id . ')">' . $device->equipment_num . '&nbsp;&nbsp;<span class="badge badge-info" id = "device' . $device->id . '"></span></button></td>';
                                                                endif;
                                                            endforeach;?>
														</tr>
														<?php endforeach;?>
													</tbody>
												</table>
											</div>
											<input id="checkup_equipment" name="checkup_equipment" type="hidden">
											<input id="tmp_checkup_time" type="hidden">
											<input id="checkup_type" type="hidden">
											<input id="checkup_time" type="hidden">
											<input id="tmp_checkup_type" type="hidden">
											<input id="checkup_num" type="hidden">
											<input id="checkup_date" name="checkup_date" value="<?=date('Y-m-d')?>" type="hidden">
											<input id="checkup_cost" type="hidden">
											<input id="checkup_count" type="hidden">
											<input id="booking_id" name="booking_id" type="hidden" value="<?=isset($booking_edit_info->booking_id) ? $booking_edit_info->booking_id : ''?>">
											<input id="checkup_device" type="hidden">
											<input id="patient_hospital_name" name="hospital_name" value="<?=$this->session->userdata('hospital_name')?>" class="form-control"
											type="hidden">
											<div id="selelct_checkup_time" class="modal fade" tabindex="-1" data-width="640">
												<div class="modal-content">
													<div class="modal-header bg-blue">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
														<h4 class="modal-title">预约</h4>
													</div>
													<div class="modal-body">
														<div class="row">
															<div class="col-md-12">
																<div class="table-responsive">
																	<table class="table" id="table">
																		<thead>
																			<tr>
																				<th>序号</th>
																				<th>检查设备</th>
																				<th>检查项目</th>
																				<th>预约时间</th>
																				<th data-radio="true">预约状态</th>
																			</tr>
																		</thead>
																		<tbody id="booking_time_selection">
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" data-dismiss="modal" onclick="select_checkupsetting()" class="btn btn-info">确定</button>
														<button type="button" data-dismiss="modal" class="btn btn-warning">取消</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
									<div class="portlet portlet-sortable box blue-madison">
										<div class="portlet-title">
											<div class="caption">
												<span class="glyphicon glyphicon-tasks"> </span>
												检查项目
											</div>
										</div>
										<div class="portlet-body" data-autosize-on="true">
											<div class="form-group">
												<label class="col-md-4 control-label">
													<?=$this->lang->line('checkup_item')?>
												</label>
												<div class="col-md-6 inputGroupContainer">
													<div class="input-group">
														<input name="checkup_item" id="checkup_item" value="" class="form-control" type="text">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12 col-md-12">
													<div class="dropdown inline clearfix">
														<ul class="dropdown-menu" role="menu" id="menu-1">
															<?php foreach ($module_class as $value):?>
															<li>
																<a role="menuitem" tabindex="1" value="">
																	<?=$value->class_name?>
																		<span class="badge badge-white">
																			<i class="fa fa-arrow-circle-o-right"></i>
																		</span>
																</a>

																<ul style="width:200px;">
																	<?php foreach ($module_data as $check_item):
                                                                        if ($value->class_id == $check_item->checkup_class):?>
																	<li onclick="select_item(<?=$check_item->id?>)">
																		<?=$check_item->check_item?>
																	</li>
																	<?php
                                                                    endif;
                                                                    endforeach;?>
																</ul>
															</li>
															<?php endforeach;?>
														</ul>

													</div>
												</div>
												<div class="col-lg-12 col-md-12">
													<div class="well bg-white" id="module_view"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">

									<div class="portlet portlet-sortable blue-madison box">
										<div class="portlet-title">
											<div class="caption">
												<span class="glyphicon glyphicon-list"> </span>
												检查项目列表
											</div>
										</div>
										<div class="portlet-body" data-autosize-on="true" style="overflow: hidden; word-wrap: break-word; resize: horizontal;">
											<div class="tab-content">
												<div class="portlet-body">
													<div class="table-responsive">
														<table class="table" id="check_view">
															<thead>
																<tr>
																	<th> 检查类型 </th>
																	<th>检查项目</th>
																	<th>检查设备</th>
																	<th>检查时间</th>
																	<th>检查价格 </th>
																	<th>操作 </th>
																</tr>
															</thead>
															<tbody id="checkup_info_table">
																<?php if (isset($booking_edit_info)):
                                                                $i = 5555;
                                                                foreach ($booking_check_info as $bookinginfo):
                                                                    $i++;?>
																<tr id="<?=$i?>">
																	<td>
																		<input type="hidden" name="checkup_type[]" value="<?=$bookinginfo->checkup_type?>">
																		<span>
																			<?=$bookinginfo->checkup_type?>
																		</span>
																	</td>
																	<td>
																		<input type="hidden" name="checkup_item[]" value="<?=$bookinginfo->checkup_item?>">
																		<span>
																			<?=$bookinginfo->checkup_item?>
																		</span>
																	</td>
																	<td>
																		<input type="hidden" name="checkup_equipment[]" value="<?=$bookinginfo->checkup_equipment?>">
																		<span>
																			<?=$bookinginfo->checkup_equipment?>
																		</span>
																	</td>
																	<td>
																		<input type="hidden" name="checkup_time[]" value="<?=$bookinginfo->checkup_time?>">
																		<span>
																			<?=$bookinginfo->checkup_time?>
																		</span>
																	</td>
																	<td>
																		<input type="hidden" name="checkup_cost[]" value="<?=$bookinginfo->checkup_cost?>">
																		<span>
																			<?=$bookinginfo->checkup_cost?>
																		</span>
																	</td>
																	<td>
																		<button type="button" onclick="edit_checkup_device(<?=$i?>)" class="btn btn-circle btn-icon-only green">
																			<i class="fa fa-edit"> </i>
																		</button>
																		<button type="button" onclick="delect_checkup_device(<?=$i?>)" class="btn btn-circle btn-icon-only red">
																			<i class="fa fa-trash"></i>
																		</button>
																	</td>
																</tr>
																<?php
                                                                    endforeach;
                                                                endif;?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
							<div class="portlet box portlet-sortable box blue-madison">
								<div class="portlet-title">
									<ul class="nav nav-tabs">
										<li class="active">
											<a href="#portlet_tabs_1" data-toggle="tab">
												<?=$this->lang->line('booking_table')?>
											</a>
										</li>
										<li>
											<a href="#portlet_tabs_2" data-toggle="tab">
												<?=$this->lang->line('HIS_info_table')?>
											</a>
										</li>
									</ul>
								</div>
								<div class="portlet-body" data-autosize-on="true">
									<div class="tab-content">
										<div class="tab-pane active" id="portlet_tabs_1">
											<div class="portlet-body">
												<div class="table-responsive">
													<table class="table table-striped table-condensed flip-content" id="patient_info_table">
														<thead>
															<tr>
																<th style="width:20%; text-align: center;">
																	<?=$this->lang->line('noma')?>
																</th>
																<th style="text-align: center;">
																	<?=$this->lang->line('name')?>
																</th>
																<th style="width:20%; text-align: center;">
																	<?=$this->lang->line('gender')?>
																</th>
																<th style="text-align: center;">
																	<?=$this->lang->line('age')?>
																</th>
																<th style="text-align: center;">
																	<?=$this->lang->line('birthday')?>
																</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="portlet_tabs_2">
											<div class="portlet-body">
												<div class="table-responsive">
													<table class="table">
														<thead>
															<tr>
																<th>
																	<?=$this->lang->line('noma')?>
																</th>
																<th>
																	<?=$this->lang->line('name')?>
																</th>
																<th>
																	<?=$this->lang->line('gender')?>
																</th>
																<th>
																	<?=$this->lang->line('age')?>
																</th>
																<th>
																	<?=$this->lang->line('birthday')?>
																</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="well bg-white row">
						<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
							<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group " zzzz>
									<label class="col-lg-5 col-md-5 control-label" for="form_control_1">
										<?=$this->lang->line('total_cost')?>:
									</label>
									<div class="col-lg-7 col-md-7">
										<input type="text" class="form-control" id="cost_amount" value="<?=!isset($booking_edit_info->cost_amount) ? '0' : $booking_edit_info->cost_amount?>"
										name="cost_amount">
										<div class="form-control-focus"> </div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<div class="col-md-7">
										<div class="input-group">
											<div class="icheck-list">
												<label>
													<input name="" type="checkbox" class="icheck">
													<?=$this->lang->line('special_item')?>
												</label>
											</div>
										</div>
									</div>
								</div>

							</div>
							<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<div class="input-group">
										<div class="icheck-list">
											<label>
												<input name="special_item" type="checkbox" class="icheck">
												<?=$this->lang->line('special_item')?>
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<div class="input-group">
										<div class="icheck-list">
											<label>
												<input name="special_item" type="checkbox" class="icheck">
												<?=$this->lang->line('special_item')?>
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
							<button type="button" class="btn  col-md-4 default-color contact-button pull-left" onclick="clearForm();" style="background-color: rgb(51, 153, 153);">清空</button>
							<?php $booking_status = isset($booking_edit_info) ? $booking_edit_info->booking_status : null?>
							<button type="submit" id="subit_add_patient" <?=$booking_status !=2 || !($booking_status) ? '' : 'disabled'?> class="btn col-md-offset-1 col-md-4 contact-button pull-right" style="background-color: rgb(51, 153, 153);">提交</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="save_patient_confirm" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-attention-animation="false">
	<div class="modal-header bg-green-haze">登记结果</div>
	<div class="modal-body">
		<p>
			<div id="result_notification"></div>
		</p>
	</div>
	<div class="modal-footer">
		<a type="button" href="<?=base_url()?>booking/booking_listview" class="btn grey-mint btn-outline sbold uppercase">病人列表</a>
	</div>
</div>
<input type="hidden" id="tmp_show_device_id">
<script>
	function clearForm() {
		$('#patient_info_submit')[0].reset();
		$('#checkup_info_table').html('');
	}

	function select_menu(val) {
		$(".alert-danger").hide();
		var base_url = '<?=base_url()?>';
		var strURL = base_url + "booking/get_module/" + val;
		$.post(strURL).done(function (data) {
			var checkup_date_data = JSON.parse(data);
			var display_data = "";
			if (checkup_date_data) {
				display_data = '<ul class="list-group" data-toggle="buttons">';
				var count = Object.keys(checkup_date_data.tdata).length;
				for (var i = 0; i < count; i++) {
					if (checkup_date_data.tdata[i].id) {
						display_data +=
							'<li class="list-group-item btn purple-sharp btn-outline sbold uppercase" onclick="select_item(' +
							checkup_date_data.tdata[i].id + ')"> ' + checkup_date_data.tdata[i].check_item + '</li>';
					}
				}
				display_data += '  </ul>';

			} else {
				display_data = "";
			}
			if (display_data == "") {
				$("#module_view").html();

			}
			$("#module_view").html(display_data);
		});
	};

	function select_item(val) {
		var base_url = '<?=base_url()?>';
		var strURL = base_url + "booking/get_checkinfo/" + val;
		$.ajax({
			dataType: "json",
			url: strURL,
			success: function (response) {
				if (response) {
					$('#checkup_item').val(response.check_item);
					$('#checkup_cost').val(response.checkup_cost);
					$('#checkup_count').val(response.checkup_count);
					$('#checkup_type').val(response.device_type);
					$('#tmp_show_device_id').val(response.device_id)
				}
			}
		});

	}

	function selelct_checkup_device(val) {
		var checkup_date = $('#checkup_date').val();
		var check_item = $('#checkup_item').val();
		var checkup_device = val;
		$("#checkup_device").val(val);
		var current_checkup_time = $('#checkup_time').val();
		if (!check_item) {
			$.alert({
				icon: 'fa fa-warning',
				title: '警告!',
				closeIcon: true,
				columnClass: 'small',
				content: '请选择检查项目!',
				draggable: true,
				theme: 'material',
				animation: 'zoom',
				closeAnimation: 'scale'
			});
			return false;
		} else {
			var a = $("#selelct_checkup_time");
			var strURL = "<?=base_url()?>" + "booking/check_checkup_time";
			$.post(strURL, {
				check_item: check_item,
				checkup_equipment: checkup_device,
				checkup_date: checkup_date
			}).done(function (data) {
				if (data == 'error') {
					$.alert({
						icon: 'fa fa-warning',
						title: '警告!',
						closeIcon: true,
						columnClass: 'small',
						content: '选择日期不是工作区间!',
						draggable: true,
						theme: 'material',
						animation: 'zoom',
						closeAnimation: 'scale'
					});
					return false;
				} else if (data) {
					try {
						checkup_date_data = JSON.parse(data)
					} catch (e) {
						console.log(e)
					}
					var tmp_check_time = $('#tmp_checkup_time').val().split("_");
					if (checkup_date_data) {
						var display_data = "";
						var firstselect = '';
						var temp = 0;
						var count = Object.keys(checkup_date_data.tdata).length;
						for (var i = 0; i < count; i++) {
							if (checkup_date_data.tdata[i].checkup_interval_status == 'on') {
								tr_class = 'bg-grey-cararra';
								status = 'c';
							} else {
								status = 'disabled checked';
								tr_class = 'bg-grey';
							}
							var checkup_time = checkup_date + ' ' + checkup_date_data.tdata[i].checkup_interval;
							var device_num = checkup_date_data.tdata[i].check_type;
							var checkup_type = checkup_date_data.tdata[i].checkup_equipment;
							for (var cr_time = 0 in tmp_check_time) {
								if (device_num + checkup_time == tmp_check_time[cr_time]) status = 'disabled', tr_class =
									'bg-green';
							}
							if (status == 'c') {
								temp++;

							}
							var val_id = RondomId();
							if (temp == 1) firstselect = val_id;
							display_data += '<tr class="' + tr_class + '">';
							display_data += "<td>" + (i + 1) + "</td>";
							display_data += "<td>" + checkup_type + "</td>";
							display_data += "<td>" + check_item + "</td>";
							display_data += "<td>" + checkup_time + "</td>";
							display_data += "<td>" + '<input type="radio" id = "' + val_id + '" name="select' + status + '" ' + status +
								' onchange="select_device(this.value)" value = "' + checkup_time + '_' + checkup_date_data.tdata[i].checkup_equipment +
								'_' + val_id + val + '"/>预约</td>';
							display_data += '</tr>';
						}

					} else {}
				} else {

				}
				$('#tmp_checkup_type').val(device_num);
				$('#booking_time_selection').html(display_data);
				$('#' + firstselect).attr('checked', 'true');
				$('#' + firstselect).change();
				a.modal();
			}).error(function () {
				$.alert({
					icon: 'fa fa-warning',
					title: '警告!',
					closeIcon: true,
					columnClass: 'small',
					content: '选择日期不是工作区间!',
					draggable: true,
					theme: 'material',
					animation: 'zoom',
					closeAnimation: 'scale'
				});
				return false;
			});
		}
	}

	function RondomId() {
		return (Math.floor((Math.random() * 1000000000000) + 1));
	}

	function select_checkupsetting(val) {
		var val = $("#checkup_device").val();
		var checkup_type = $('#checkup_type').val();
		var checkup_item = $('#checkup_item').val();
		var checkup_equipment = $('#checkup_equipment').val();
		var checkup_time = $('#checkup_time').val();
		var checkup_cost = $('#checkup_cost').val();
		var trId = RondomId();
		var display_checkup_info = '<tr id = "' + trId + '"><td><input type="hidden" name = "checkup_type[]" value="' +
			checkup_type + '"><span>' + checkup_type + '</span></td>';
		display_checkup_info += '<td><input type="hidden" name = "checkup_item[]" value="' + checkup_item + '"><span>' +
			checkup_item + '</span></td>';
		display_checkup_info += '<td><input type="hidden" name = "checkup_equipment[]" value="' + checkup_equipment +
			'"><span>' +
			checkup_equipment + '</span></td>';
		display_checkup_info += '<td><input type="hidden" name = "checkup_time[]" value="' + checkup_time + '"><span>' +
			checkup_time + '</span></td>';
		display_checkup_info += '<td><input type="hidden" name = "checkup_cost[]" value="' + checkup_cost + '"><span>' +
			checkup_cost + '<span></td>';
		display_checkup_info += '<td><button type="button" onclick= "edit_checkup_device(' + trId +
			',' + val +
			')" class="btn btn-circle btn-icon-only green"><i class="fa fa-edit"> </i></button><button type="button" onclick= "delect_checkup_device(' +
			trId +
			',' + val + ')" class="btn btn-circle btn-icon-only red"><i class="fa fa-trash"></i></button></td><tr>';
		$('#checkup_info_table').append(display_checkup_info);
		$('#cost_amount').val(parseInt($('#cost_amount').val()) + parseInt(checkup_cost));
		$('#tmp_checkup_time').val($('#tmp_checkup_time').val() + '_' + $('#tmp_checkup_type').val() + checkup_time);
		var devicefind = "#device" + $("#checkup_device").val();
		var countamount = parseInt($(devicefind).html().split('/')[0]) + 1;
		var total_count = $(devicefind).html().split('/')[1];
		countamount = countamount < total_count ? countamount : parseInt($(devicefind).html().split('/')[0]);
		$(devicefind).html(countamount + '/' + total_count);
	}

	function edit_checkup_device(val, id) {
		var valid = '#' + val;
		var this_checkup_cost = $(valid).find('input[name="checkup_cost[]"]').val();
		var this_checkup_type = $(valid).find('input[name="checkup_type[]"]').val();
		var this_checkup_item = $(valid).find('input[name="checkup_item[]"]').val();
		var this_checkup_equipment = $(valid).find('input[name="checkup_equipment[]"]').val();
		var this_checkup_time = $(valid).find('input[name="checkup_time[]"]').val();

		$.confirm({
			title: '编辑检查信息',
			content: '<form action="#" id = "edit_device_checkup">\n' +
				'<div class="form-body">\n' +
				'<div class="form-group form-md-line-input">' +
				'<input type="text" class="form-control" name="this_checkup_type" id="this_checkup_type" value = "' +
				this_checkup_type + '">' +
				'<label for="checkup_type">检查类型</label>' +
				'</div>' + '<div class="form-group form-md-line-input ">' +
				'<input type="text" class="form-control" name="this_checkup_item" id="this_checkup_item" value = "' +
				this_checkup_item + '">' +
				'<label for="this_checkup_item">\t检查项目</label>' +
				'</div>' + '<div class="form-group form-md-line-input ">' +
				'<input type="text" class="form-control" name="this_checkup_equipment" id="this_checkup_equipment" value = "' +
				this_checkup_equipment + '">' +
				'<label for="this_checkup_equipment">检查设备\t</label>' +
				'</div>' + '<div class="form-group form-md-line-input date form_datetime input-large">' +
				'<input type="text" class="form-control" name="this_checkup_time" id="this_checkup_time" value = "' +
				this_checkup_time + '">' +
				'<label for="this_checkup_time">检查时间</label>' +
				'</div>' + '<div class="form-group form-md-line-input ">' +
				'<input type="number" class="form-control" name="this_checkup_cost" id="this_checkup_cost" value = "' +
				this_checkup_cost + '">' +
				'<label for="this_checkup_cost">检查价格</label>' +
				'</div>' +
				'</div>' +
				'</form>',
			theme: 'material',
			columnClass: 'small',
			closeIcon: true,
			typeAnimated: true,
			draggable: true,
			icon: 'glyphicon glyphicon-edit',
			buttons: {
				formSubmit: {
					text: '改修',
					btnClass: 'btn blue',
					action: function () {
						if ($("#this_checkup_cost").val() == '' || $("#this_checkup_type").val() == '' || $("#this_checkup_item").val() ==
							'' || $("#this_checkup_equipment").val() == '' || $("#this_checkup_time").val() == '') {
							$.alert({
								icon: 'fa fa-warning',
								title: '警告!',
								closeIcon: true,
								theme: 'material',
								columnClass: 'small',
								content: '请输入正确的信息',
								draggable: true,
								animation: 'zoom',
								closeAnimation: 'scale'
							});
							return true;
						}
						$(valid).find('input[name="checkup_cost[]"]').val($("#this_checkup_cost").val());
						$(valid).find('input[name="checkup_type[]"]').val($('#this_checkup_type').val());
						$(valid).find('input[name="checkup_item[]"]').val($('#this_checkup_item').val());
						$(valid).find('input[name="checkup_equipment[]"]').val($('#this_checkup_equipment').val());
						$(valid).find('input[name="checkup_time[]"]').val($('#this_checkup_time').val());
						$(valid).find('input[name="checkup_cost[]"]').next().html($("#this_checkup_cost").val());
						$(valid).find('input[name="checkup_type[]"]').next().html($("#this_checkup_type").val());
						$(valid).find('input[name="checkup_item[]"]').next().html($("#this_checkup_item").val());
						$(valid).find('input[name="checkup_equipment[]"]').next().html($("#this_checkup_equipment").val());
						$(valid).find('input[name="checkup_time[]"]').next().html($("#this_checkup_time").val());
						var update_cost = parseInt($('#cost_amount').val()) - parseInt(this_checkup_cost) + parseInt($(
							"#this_checkup_cost").val());
						$('#cost_amount').val(update_cost);

					}
				},
				cancel: {
					text: '推出',
					btnClass: 'btn green',
					action: function () {
						//close
					}
				}

			},
			onContentReady: function () {
				// bind to events
				var jc = this;
				this.$content.find('form').on('submit', function (e) {
					// if the user submits the form by pressing enter in the field.
					e.preventDefault();
					jc.$$formSubmit.trigger('click'); // reference the button and click it
				});
			}
		});
	}

	function select_device(val) {
		var res = val.split("_");
		var checkup_time = res['0'];
		var val_id = res['2'];
		var valid = '#' + $.trim(val_id);
		$(valid).attr('disabled', 'true');
		var checkup_equipment = res['1'];
		$('#checkup_time').val(checkup_time);
		$('#checkup_equipment').val(checkup_equipment);

	}

	function delect_checkup_device(val, id) {
		$('#checkup_equipment').val('');
		$.confirm({
			title: '警告!',
			content: '您真删除该检查项目?',
			typeAnimated: true,
			icon: 'fa fa-warning',
			theme: 'material',
			columnClass: 'small',
			draggable: true,
			buttons: {
				OK: {
					text: '确定',
					btnClass: 'btn-blue',
					action: function () {
						var valid = '#' + val;
						var thisamount = $(valid).find('input[name="checkup_cost[]"]').val();
						var thischeck_type = $(valid).find('input[name="checkup_equipment[]"]').val();
						var thischeck_time = $(valid).find('input[name="checkup_time[]"]').val();
						$('#cost_amount').val(parseInt($('#cost_amount').val()) - parseInt(thisamount));
						$(valid).html('');
						var tmp_checkup_timelist = $('#tmp_checkup_time').val().replace(thischeck_type + thischeck_time, ' ');
						$('#tmp_checkup_time').val(tmp_checkup_timelist);
						if (id) {
							var devicefind = "#device" + id;
							var countamount = parseInt($(devicefind).html().split('/')[0]) - 1;
							countamount = countamount > 0 ? countamount : 0;
							var total_count = $(devicefind).html().split('/')[1];
							$(devicefind).html(countamount + '/' + total_count);
						} else {}
					}
				},
				somethingElse: {
					text: '返回',
					btnClass: 'btn-warning',
					keys: ['enter', 'shift'],
					action: function () {
						return true;
					}
				}
			}
		});
	}

	function select_checkup_date(val) {
		$('#checkup_date').val(val);
		var base_url = '<?=base_url()?>';
		var strURL = base_url + "booking/check_device_timelist";
		$.post(strURL, {
				checkup_date: val
			})
			.done(function (data) {
				if (data) {
					checkup_date_data = JSON.parse(data);
					if (checkup_date_data) {
						var display_data = "";
						var count = Object.keys(checkup_date_data.tdata).length;
						for (var i = 0; i < count; i++) {
							var find_id = '#device' + checkup_date_data.tdata[i].device_id;
							var insert_value = checkup_date_data.tdata[i].check_count + '/' + checkup_date_data.tdata[i].check_totalcount;
							$(find_id).html(insert_value);
						}
						for (var index in checkup_date_data.workInt) {
							//$('#tmp_show_device_id').val()==checkup_date_data.workInt[index].device_id
							if (checkup_date_data.workInt[index].status == false) {
								$("#" + checkup_date_data.workInt[index].device_id + 'btn').show();
							} else {
								$("#" + checkup_date_data.workInt[index].device_id + 'btn').hide();
							}
						}
					}
				} else {

				}
			});
	}

	function convertpinyin(val) {
		var pinyin = codefans_net_CC2PY(val);
		$('#patient_pinyin').val(pinyin);
	}

	function add_patient() {
		console.log('there');
		var formData = $('#patient_info_submit').serialize();
		console.log(formData);
		var base_url = '<?=base_url()?>';
		var strURL = base_url + "booking/save_patient";
		$.ajax({
			dataType: "json",
			url: strURL,
			type: 'get',
			data: formData,
			success: function (response) {
				console.log(response)
				$.alert({
					title: '提示',
					content: response.message,
					columnClass: 'small',
					icon: 'fa fa-warning',
					theme: 'material',
					buttons: {
						ok: function () {
							if (response.response_code) {
								window.location.href = "<?=base_url()?>booking/booking_listview";
							} else {

							}
						},
						cancel: function () {
							return true;
						}
					}
				});
			}
		});

	}
	var table = {};
	$(function () {
		$("#menu-1").menu();
		select_checkup_date("<?=date('Y-m-d')?>");
		$("#edit_device_checkup").validate({
			rules: {
				this_checkup_type: {
					required: true,
				},
				this_checkup_item: {
					required: true,
				},
				this_checkup_equipment: {
					required: true,
					minlength: 6
				},
				this_checkup_time: {
					required: true,
				},
				this_checkup_cost: {
					required: true
				}
			},
			//For custom messages
			messages: {
				this_checkup_type: {
					required: "这是必填字段",
					equalTo: "你的输入不相同"
				},
				this_checkup_item: {
					required: "这是必填字段"
				},
				this_checkup_equipment: {
					required: "这是必填字段"

				},
				this_checkup_time: {
					required: "这是必填字段"
				},
				this_checkup_cost: {
					required: "这是必填字段"
				}

			},
			errorElement: 'div',
			errorPlacement: function (error, element) {
				var placement = $(element).data('error');
				if (placement) {
					$(placement).append(error)
				} else {
					error.insertAfter(element);
				}
			},
			submitHandler: function (e) {}
		});
		var booking_table_url = '<?=base_url()?>' + 'booking/patient_info_table';
		table = $('#patient_info_table').DataTable({
			"ajax": booking_table_url,
			"ordering": false,
			'searching': false,
			language: {
				aria: {
					sortAscending: ": activate to sort column ascending",
					sortDescending: ": activate to sort column descending"
				},
				emptyTable: "没有数据",
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
			columnDefs: [{
				orderable: !1,
				targets: [0]
			}, {
				targets: [0]
			}],
			"bInfo": false,
			order: [
				[0, "asc"]
			]
		});
	});

</script>
