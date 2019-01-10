<div class="page-content-wrapper">

    <div class="page-content">


        <h3 class="page-title">
            病人信息管理 </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i> 病人信息管理
                    </a>
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
                  <div class="alert alert-danger display-hide">
                      <button class="close" data-close="alert"></button>你有一些表单错误。 请检查下面
                  </div>
                    <div class="row">
                        <div class="col-lg-9 col-md-6">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="portlet portlet-sortable box blue-madison">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-plus"></i>
                                                <?=$this->lang->line('patient_info')?>
                                            </div>
                                        </div>
                                        <div class="portlet-body" style="display: block;">
                                            <div class="form-group " zzzz>
                                                <label class="col-lg-3 col-md-5 control-label" for="form_control_1"><?=$this->lang->line('image_num')?>:
                                                </label>
                                                <div class="col-lg-9 col-md-7">
                                                    <input type="text" class="form-control" value="<?php if ($booking_edit_info->image_num) {
                                                        echo $booking_edit_info->image_num;
                                                    } else {
                                                        echo $image_num;
                                                    }
                                                    ?>" id="image_num" name="image_num" readonly>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group " zzzz>
                                                <label class="col-lg-3 col-md-5 control-label" for="form_control_1"><?=$this->lang->line('patient_name')?>:
                                                </label>
                                                <div class="col-lg-9 col-md-7">
                                                    <input type="text" class="form-control" value="<?=$booking_edit_info->patient_name?>"   id="patient_name" name="patient_name">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group " zzzz>
                                                <label class="col-lg-3 col-md-5 control-label" for="form_control_1"><?=$this->lang->line('gender')?>:</label>
                                                <div class="col-lg-9 col-md-7">
                                                    <select class="form-control" id="patient_gender" value="<?=$booking_edit_info->patient_gender?>" name="patient_gender">
                                                        <option value="">请选择</option>
                                                        <option <?php if ($booking_edit_info->patient_gender == '0') {
                                                                    echo 'selected';
                                                                }?> value="0"><?=$this->lang->line('man')?></option>
                                                        <option <?php if ($booking_edit_info->patient_gender == '1') {
                                                                    echo 'selected';
                                                                }?> value="1"><?=$this->lang->line('woman')?></option>
                                                      </select>
                                                    <div class="form-control-focus"></div>
                                                </div>
                                            </div>
                                            <div class="form-group " zzzz>
                                                <label class="col-lg-3 col-md-5 control-label" for="form_control_1"><?=$this->lang->line('patient_type')?>:</label>
                                                <div class="col-lg-9 col-md-7">
                                                    <select class="form-control" id="patient_type" value="<?=$booking_edit_info->patient_type?>" name="patient_type">
                                                        <option value="">请选择</option>
                                                        <option <?php if ($booking_edit_info->patient_type == '0') {
                                                                        echo 'selected';
                                                                    }?> value="0">平诊</option>
                                                        <option <?php if ($booking_edit_info->patient_type == '1') {
                                                                    echo 'selected';
                                                                }?> value="1">急诊</option>
                                                        <option <?php if ($booking_edit_info->patient_type == '2') {
                                                                    echo 'selected';
                                                                }?> value="2">VIP</option>
                                                      </select>
                                                    <div class="form-control-focus"></div>
                                                </div>
                                            </div>
                                            <div class="form-group " zzzz>
                                                <label class="col-lg-3 col-md-5 control-label" for="form_control_1"><?=$this->lang->line('age')?>:</label>
                                                <div class="col-lg-5 col-md-3">
                                                    <input type="text" class="form-control"   value="<?=$booking_edit_info->patient_age?>" id="patient_age" name="patient_age">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                                <div class="col-lg-4 col-md-5">
                                                    <select class="form-control" id="agetype" name="agetype">
                                                        <option value="<?=$this->lang->line('year')?>"><?=$this->lang->line('year')?></option>
                                                        <option value="<?=$this->lang->line('month')?>"><?=$this->lang->line('month')?></option>
                                                        <option value="<?=$this->lang->line('day')?>"><?=$this->lang->line('day')?></option>
                                                      </select>
                                                    <div class="form-control-focus"></div>
                                                </div>
                                            </div>
                                            <div class="form-group " zzzz>
                                                <label class="col-lg-3 col-md-5 control-label" for="form_control_1"><?=$this->lang->line('birthday')?>:
                                                </label>
                                                <div class="col-lg-9 col-md-7">
                                                    <input type="text" class="form-control form-control-inline" value="<?=$booking_edit_info->patient_birthday?>" name="patient_birthday"
                                                        id="patient_birthday">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group " zzzz>
                                                <label class="col-lg-3 col-md-5 control-label" for="form_control_1"><?=$this->lang->line('phone')?>:
                                                </label>
                                                <div class="col-lg-9 col-md-7">
                                                    <input type="text" class="form-control"  value="<?=$booking_edit_info->patient_phone_num?>" id="patient_phone_num" name="patient_phone_num">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group " zzzz>
                                                <label class="col-lg-3 col-md-5 control-label" for="form_control_1"><?=$this->lang->line('license')?>:
                                                </label>
                                                <div class="col-lg-9 col-md-7">
                                                    <input type="text" class="form-control"  value="<?=$booking_edit_info->license_num?>" id="license_num" name="license_num">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group " zzzz>
                                                <label class="col-lg-3 col-md-5 control-label" for="form_control_1"><?=$this->lang->line('patient_source')?>:</label>
                                                <div class="col-lg-9 col-md-7">
                                                    <select class="form-control" id="patient_source" name="patient_source">
                                                        <option value="">请选择</option>
                                                        <option <?php if ($booking_edit_info->patient_source == '0') {
                                                                    echo 'selected';
                                                                }?> value="0">门诊</option>
                                                        <option <?php if ($booking_edit_info->patient_source == '1') {
                                                                        echo 'selected';
                                                                    }?> value="1">住院</option>
                                                        <option <?php if ($booking_edit_info->patient_source == '2') {
                                                                    echo 'selected';
                                                                }?> value="2">体检</option>
                                                      </select>
                                                    <div class="form-control-focus"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="portlet portlet-sortable box blue-madison">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-plus"></i>
                                                <?=$this->lang->line('checkup_info')?>
                                            </div>
                                        </div>
                                        <div class="portlet-body" style="display: block;">
                                            <div class="form-group " zzzz>
                                                <label class="col-lg-3 col-md-5 control-label" for="form_control_1"><?=$this->lang->line('patient_num')?>:
                                                </label>
                                                <div class="col-lg-9 col-md-7">
                                                    <input type="text" class="form-control"  id="patient_code" value = "<?=$booking_edit_info->patient_code?>" name="patient_code">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group " zzzz>
                                                <label class="col-lg-3 col-md-5 control-label" for="form_control_1"><?=$this->lang->line('pinyin')?>:
                                                </label>
                                                <div class="col-lg-9 col-md-7">
                                                    <input type="text" class="form-control"  id="patient_pinyin" value="<?=$booking_edit_info->patient_pinyin?>" name="patient_pinyin">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group " zzzz>
                                                <label class="col-lg-3 col-md-5 control-label" for="form_control_1"><?=$this->lang->line('req_doctor')?>:
                                                </label>
                                                <div class="col-lg-9 col-md-7">
                                                    <input type="text" class="form-control"  readonly id="req_doctor_name" value="<?=$this->session->userdata('usr_id')?>" name="req_doctor_name">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group " zzzz>
                                                <label class="col-lg-3 col-md-5 control-label" for="form_control_1"><?=$this->lang->line('req_field')?>:
                                                </label>
                                                <div class="col-lg-9 col-md-7">
                                                    <input type="text" class="form-control"  id="req_branch" value="<?=$booking_edit_info->req_branch?>" name="req_branch">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group " zzzz>
                                                <label class="col-lg-3 col-md-5 control-label" for="form_control_1"><?=$this->lang->line('hos_num')?>:
                                                </label>
                                                <div class="col-lg-9 col-md-7">
                                                    <input type="text" class="form-control"  id="hospital_num" value="<?=$booking_edit_info->hospital_num?>" name="hospital_num">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group " zzzz>
                                                <label class="col-lg-3 col-md-5 control-label" for="form_control_1"><?=$this->lang->line('depart_num')?>:
                                                </label>
                                                <div class="col-lg-9 col-md-7">
                                                    <input type="text" class="form-control"  id="room_num" value="<?=$booking_edit_info->room_num?>" name="room_num">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group " zzzz>
                                                <label class="col-lg-3 col-md-5 control-label" for="form_control_1"><?=$this->lang->line('bed_num')?>:
                                                </label>
                                                <div class="col-lg-9 col-md-7">
                                                    <input type="text" class="form-control"  id="bed_num" value="<?=$booking_edit_info->bed_num?>" name="bed_num">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group " zzzz>
                                                <label class="col-lg-3 col-md-5 control-label" for="form_control_1"><?=$this->lang->line('cost_type')?>:</label>
                                                <div class="col-lg-9 col-md-7">
                                                    <select class="form-control" id="cost_type"  value="<?=$booking_edit_info->cost_type?>" name="cost_type">
                                                      <option value="">请选择</option>
                                                      <option <?php if ($booking_edit_info->cost_type == '0') {
                                                            echo 'selected';
                                                        }?> value="0">公费</option>
                                                      <option <?php if ($booking_edit_info->cost_type == '1') {
                                                                echo 'selected';
                                                            }?> value="1">自费</option>
                                                    </select>
                                                    <div class="form-control-focus"></div>
                                                </div>
                                            </div>
                                            <div class="form-group " zzzz>
                                                <label class="col-lg-3 col-md-5 control-label" for="form_control_1"><?=$this->lang->line('clinical_diagnosis')?>:
                                                </label>
                                                <div class="col-lg-9 col-md-7">
                                                    <input type="text" class="form-control"  value="<?=$booking_edit_info->clinical_diagnosis?>" id="clinical_diagnosis" name="clinical_diagnosis">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="portlet portlet-sortable box blue-madison">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-plus"></i>
                                                <?=$this->lang->line('other_info')?>
                                            </div>
                                        </div>
                                        <div class="portlet-body" style="display: block;">
                                            <fieldset>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group " zzzz>
                                                        <label class="control-label"><?=$this->lang->line('health_insurance_num')?>：</label>
                                                        <div class="inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input name="health_insurance_num" id="health_insurance_num" value="<?=$booking_edit_info->health_insurance_num?>"  class="form-control" type="text">
                                                                <div class="form-control-focus"> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group " zzzz>
                                                        <label class="control-label"><?=$this->lang->line('clinic_num')?>：</label>
                                                        <div class="inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input name="clinic_num" id="clinic_num" value="<?=$booking_edit_info->clinic_num?>"  class="form-control" type="text">
                                                                <div class="form-control-focus"> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group " zzzz>
                                                        <label class="control-label"><?=$this->lang->line('social_security_num')?>：</label>
                                                        <div class="inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input name="social_security_num" id="social_security_num" value="<?=$booking_edit_info->social_security_num?>"  class="form-control" type="text">
                                                                <div class="form-control-focus"> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group " zzzz>
                                                        <label class="control-label"><?=$this->lang->line('address')?>：</label>
                                                        <div class="inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input name="patient_address" id="patient_address" value="<?=$booking_edit_info->patient_address?>"  class="form-control" type="text">
                                                                <div class="form-control-focus"> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group " zzzz>
                                                        <label class="control-label"><?=$this->lang->line('remark')?>：</label>
                                                        <textarea id="patient_remark" name="patient_remark" class="form-control autosizeme" value="<?=$booking_edit_info->patient_remark?>" rows="2"  data-autosize-on="true"
                                                            style="overflow: hidden; word-wrap: break-word; resize: horizontal; "><?=$booking_edit_info->patient_remark?></textarea>
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="portlet portlet-sortable box blue-madison">
                                        <div class="portlet-title"></div>
                                        <div class="portlet-body">
                                            <div class="clearfix">
                                                <div class="btn-group col-md-offset-1" data-toggle="buttons">
                                                    <?php for ($i = 0; $i < 5; $i++) {?>
                                                    <label class="btn green  btn-outline">
                                                      <input type="radio" name="tettttt" onchange="select_checkup_date(this.value)" value="<?=date("Y-m-d", strtotime("+$i day"));?>" class="toggle"> <?=date("Y-m-d", strtotime("+$i day"));?></label>
                                                    <?php }?>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <th>检查类型</th>
                                                        <?php for ($i = 0; $i < count($equip_type); $i++) {?>
                                                        <th>检查设备</th>
                                                        <?php }?>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($equipment_type as $value) {
	                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn dark sbold uppercase" disabled><?=$value->equipment_type?></button>
                                                            </td>
                                                            <?php foreach ($all_device_info as $device) {
                                                                if ($device->equipment_type == $value->equipment_type) {
                                                                    $status = 'disabled data-toggle="tooltip" data-placement="left" title="设备没开动"';
                                                                    $class_status = 'red';
                                                                    if ($device->equipment_status == '1') {
                                                                        $status = '';
                                                                        $class_status = 'btn-outline';
                                                                    }
                                                                    echo '<td><button type="button" class="btn sbold uppercase ' . $class_status . '"  ' . $status . '  onclick="selelct_checkup_device(' . $device->id . ')">' . $device->equipment_num . '&nbsp;&nbsp;<span class="badge badge-info" id = "device' . $device->id . '"></span></button></td>';
                                                                }
                                                            }?>
                                                        </tr>
                                                        <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <input id="checkup_equipment" name="checkup_equipment" value="<?=$booking_edit_info->checkup_equipment?>" class="form-control" type="hidden">
                                            <input id="checkup_time" name="checkup_time" value="<?=$booking_edit_info->checkup_time?>" class="form-control" type="hidden">
                                            <input id="checkup_num"    class="form-control" type="hidden">
                                            <input id="checkup_type" value="<?=$booking_edit_info->checkup_type?>" class="form-control" type="hidden">
                                            <input id="checkup_date" name="checkup_date" laceholder="" class="form-control" type="hidden">
                                            <input id="checkup_cost"   class="form-control" type="hidden">
                                            <input id="checkup_count"   class="form-control" type="hidden">
                                            <input id="booking_id" name="booking_id"  class="form-control" type="hidden" value="<?=$booking_edit_info->booking_id?>">
                                            <input id="checkup_device"   class="form-control" type="hidden">
                                            <input id="patient_hospital_name" name="hospital_name"  value="<?=$this->session->userdata('hospital_name')?>" class="form-control" type="hidden">
                                            <div id="selelct_checkup_time" class="modal fade" tabindex="-1" data-width="760">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-green-haze">
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
                                                        <button type="button" data-dismiss="modal" onclick="select_checkupsetting()" class="btn red">确定</button>
                                                        <button type="button" data-dismiss="modal" class="btn dark btn-outline">取消</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="portlet portlet-sortable box blue-madison">
                                        <div class="portlet-title">
                                        </div>
                                        <div class="portlet-body" data-autosize-on="true" style="overflow: show;word-wrap: break-word; resize: horizontal;">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label"><?=$this->lang->line('checkup_item')?></label>
                                                <div class="col-md-4 inputGroupContainer">
                                                    <div class="input-group">
                                                        <input name="checkup_item" id="checkup_item" value="<?=$booking_edit_info->checkup_item?>"  class="form-control" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">



                                                    <div class="dropdown inline clearfix">
                                                      <ul  class="dropdown-menu" role="menu" id = "menu-1">
                                                        <?php foreach ($module_class as $value) {
	                                                        ?>
                                                        <li>
                                                            <a role="menuitem" tabindex="1" value="">
                                                                <?=$value->class_name?>
                                                                    <span class="badge badge-white"><i class="fa fa-arrow-circle-o-right"></i></span>
                                                            </a>

                                                            <ul style="width:200px;">

                                                              <?php foreach ($module_data as $check_item):
                                                                    if ($value->class_id == $check_item->checkup_class):
                                                                    ?>
	                                                                    <li onclick="select_item(<?=$check_item->id?>)"> <?=$check_item->check_item?></li>
	                                                              <?php
                                                                        endif;
                                                                            endforeach;?>
                                                            </ul>
                                                        </li>
                                                        <?php }?>
                                                      </ul>

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="well bg-white" id="module_view"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <div class="portlet portlet-sortable blue-madison box">
                                <div class="portlet-title">
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
                                                            <th>检查价格
                                                            </th>
                                                            <th>
                                                                操作
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="checkup_info_table">
                                                      <?php if ($booking_edit_info):
                                                      $i = 123112312312323;
                                                        foreach($booking_check_info as $bookinginfo):
                                                        $i++; ?>
                                                      <tr id = "<?=$i?>">
                                                        <td><input type="hidden" name = "checkup_type[]" value="<?=$bookinginfo->checkup_type?>"><?=$bookinginfo->checkup_type?></td>
                                                        <td><input type="hidden" name = "checkup_item[]" value="<?=$bookinginfo->checkup_item?>"><?=$bookinginfo->checkup_item?></td>
                                                        <td><input type="hidden" name = "checkup_equipment[]" value="<?=$bookinginfo->checkup_equipment?>"><?=$bookinginfo->checkup_equipment?></td>
                                                        <td><input type="hidden" name = "checkup_time[]" value="<?=$bookinginfo->checkup_time?>"><?=$bookinginfo->checkup_time?></td>
                                                        <td><input type="hidden" name = "checkup_cost[]" value="<?=$bookinginfo->checkup_cost?>"><?=$bookinginfo->checkup_cost?></td>
                                                        <td><button type="button"  onclick= "delect_checkup_device(<?=$i?>)" class="btn blue">删除</button></td>
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
                    <div class="col-lg-3 col-md-6">
                        <div class="portlet box portlet-sortable box blue-madison">
                            <div class="portlet-title">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#portlet_tabs_1" data-toggle="tab"><?=$this->lang->line('booking_table')?></a>
                                    </li>
                                    <li>
                                        <a href="#portlet_tabs_2" data-toggle="tab"><?=$this->lang->line('HIS_info_table')?></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body" data-autosize-on="true" style="overflow: hidden; word-wrap: break-word; resize: horizontal;">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="portlet_tabs_1">
                                        <div class="portlet-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed flip-content">
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
                                                        <?php $i = 0;
                                                            if (!empty($booking_list)): foreach ($booking_list as $booking): ?>

	                                                        <tr>
	                                                            <td style="text-align: center;">
	                                                                <?php
	                                                                echo ++$i ?>
	                                                            </td>
	                                                            <td style="text-align: center;">
	                                                                <?php echo $booking->patient_name ?>
	                                                            </td>
	                                                            <td style="text-align: center;">
	                                                                <?php if ($booking->patient_gender == 0) {?> 男
	                                                                <?php } elseif ($booking->patient_gender == 1) {?> 女
                                                                <?php }?>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <?php echo $booking->patient_age ?>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <?php echo $booking->patient_birthday ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                            endforeach;
                                                            ?>
                                                            <?php else: ?>
                                                            <td colspan="3">
                                                                <strong>没有数据可以显示</strong>
                                                            </td>
                                                            <?php endif;?>
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
                <div class="col-md-9">
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group " zzzz>
                            <label class="col-lg-5 col-md-5 control-label" for="form_control_1"><?=$this->lang->line('total_cost')?>:
                                            </label>
                            <div class="col-lg-7 col-md-7">
                                <input type="text" class="form-control"  id="cost_amount" value="<?=$booking_edit_info->cost_amount?>" name="cost_amount" readonly="">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <div class="col-md-7">
                                <div class="input-group">
                                    <div class="icheck-list">
                                        <label>
                                              <input name="" type="checkbox" class="icheck"> <?=$this->lang->line('special_item')?>
                                            </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="icheck-list">
                                    <label>
                                              <input name="special_item" type="checkbox" class="icheck"> <?=$this->lang->line('special_item')?>
                                            </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="icheck-list">
                                    <label>
                                              <input name="special_item" type="checkbox" class="icheck"> <?=$this->lang->line('special_item')?>
                                            </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <button type="button"  class="btn btn-circle col-md-4 green-jungle pull-left" onclick="clearForm();">清 空</button>
                    <button type="submit" id= "subit_add_patient" class="btn col-md-offset-1 col-md-4 btn-circle grey-mint pull-right">保存</a>
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
        <p><div id = "result_notification"></div></p>
    </div>
    <div class="modal-footer">
        <a type="button" href="<?=base_url()?>booking/booking_listview" class="btn grey-mint btn-outline sbold uppercase">病人列表</a>
    </div>
</div>
<script>

function clearForm(){
    $('#patient_info_submit')[0].reset();
}

function select_menu(val) {
    $(".alert-danger").hide();
    var base_url = '<?=base_url()?>';
    var strURL = base_url + "booking/get_module/" + val;
    $.post(strURL).done(function (data) {
        checkup_date_data = JSON.parse(data);
        var display_data = "";
        if (checkup_date_data) {
            display_data = '<ul class="list-group" data-toggle="buttons">';
            var count = Object.keys(checkup_date_data.tdata).length;
            for (var i = 0; i < count; i++) {
              if(checkup_date_data.tdata[i].id){
                display_data += '<li class="list-group-item btn purple-sharp btn-outline sbold uppercase" onclick="select_item(' + checkup_date_data.tdata[i].id + ')"> ' + checkup_date_data.tdata[i].check_item + '</li>';
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
    $.post(strURL).done(function (data) {
        checkup_date_data = JSON.parse(data);
        var display_data = "";
        if (checkup_date_data) {
            var count = Object.keys(checkup_date_data.tdata).length;
            for (var i = 0; i < count; i++) {
                $('#checkup_item').val(checkup_date_data.tdata[i].check_item);
                $('#cost_amount').val(checkup_date_data.tdata[i].checkup_cost);
                $('#checkup_cost').val(checkup_date_data.tdata[i].checkup_cost);
                $('#checkup_count').val(checkup_date_data.tdata[i].checkup_count);
                $('#checkup_type').val(checkup_date_data.tdata[i].device_type);
            }
        } else {}
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
            content: '请选择日期和检查项目',
            draggable: true,
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
            if (data) {
                checkup_date_data = JSON.parse(data);
                if (checkup_date_data) {
                    var display_data = "";
                    var count = Object.keys(checkup_date_data.tdata).length;
                    for (var i = 0; i < count; i++) {
                        if (checkup_date_data.tdata[i].checkup_interval_status == 'on') {
                            tr_class = 'bg-grey-silver';
                            status = '';
                        } else {
                            status = 'disabled checked';
                            tr_class = 'bg-green-haze';
                        }
                        var val_id = RondomId();
                        display_data += '<tr class="'+tr_class+'">';
                        display_data += "<td>" + (i + 1) + "</td>";
                        display_data += "<td>" + checkup_date_data.tdata[i].checkup_equipment + "</td>";
                        display_data += "<td>" + check_item + "</td>";
                        display_data += "<td>" + checkup_date + ' ' + checkup_date_data.tdata[i].checkup_interval + "</td>";
                        var checkup_time = checkup_date + ' ' + checkup_date_data.tdata[i].checkup_interval;
                        display_data += "<td>" + '<input type="radio" id = "'+val_id+'" name="select'+status+'" ' + status + ' onchange="select_device(this.value)" value = "' + checkup_time +'_'+checkup_date_data.tdata[i].checkup_equipment+'_'+val_id+'"/>预约</td>';
                        display_data += '</tr>';
                    }

                } else {}
            } else {

            }
            $('#booking_time_selection').html(display_data);
            a.modal();
        });
    }
}

function RondomId() {
    return ( Math.floor((Math.random() * 10000000000000000) + 1));
}

function select_checkupsetting(val){
    var checkup_type = $('#checkup_type').val();
    var checkup_item = $('#checkup_item').val();
    var checkup_equipment = $('#checkup_equipment').val();
    var checkup_time = $('#checkup_time').val();
    var checkup_cost = $('#checkup_cost').val();
   
    var trId = RondomId();
    var display_checkup_info = '<tr id = "'+trId+'"><td><input type="hidden" name = "checkup_type[]" value="'+checkup_type+'">'+checkup_type+'</td>';
    display_checkup_info += '<td><input type="hidden" name = "checkup_item[]" value="'+checkup_item+'">'+checkup_item+'</td>';
    display_checkup_info += '<td><input type="hidden" name = "checkup_equipment[]" value="'+checkup_equipment+'">'+checkup_equipment+'</td>';
    display_checkup_info += '<td><input type="hidden" name = "checkup_time[]" value="'+checkup_time+'">'+checkup_time+'</td>';
    display_checkup_info += '<td><input type="hidden" name = "checkup_cost[]" value="'+checkup_cost+'">'+checkup_cost+'</td>';
    display_checkup_info+='<td><button type="button" onclick= "delect_checkup_device('+trId+')" class="btn blue">删除</button></td><tr>';
    $('#checkup_info_table').append(display_checkup_info);

}

function select_device(val) {
    var res = val.split("_");
    var checkup_time = res['0'];
    var val_id = res['2'];
    var valid = '#' + $.trim(val_id);
    $(valid).attr('disabled','true');
    var checkup_equipment = res['1'];
    $('#checkup_time').val(checkup_time);
    $('#checkup_equipment').val(checkup_equipment);
}
function delect_checkup_device(val){
    var valid = '#'+val;
    $(valid).html('') ;
    $('#checkup_item').val('');
    $('#cost_amount').val('');
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
                  var find_id = '#device'+checkup_date_data.tdata[i].device_id;
                  var insert_value = checkup_date_data.tdata[i].check_count+'/'+checkup_date_data.tdata[i].check_totalcount;
                  $(find_id).html(insert_value);
                }
              }

          } else {

          }
        });
}


function add_patient(val) {
    var formData = $('#patient_info_submit').serialize();
    var base_url = '<?=base_url()?>';
    var strURL = base_url + "booking/save_patient";
     $.ajax({
     dataType: "json",
     url: strURL,
     type: 'get',
     data: formData,
     success: function (response) {
         $.alert({
             title: '报告!',
             content: '登记已成功！',
             columnClass: 'small',
             theme: 'dark',
             buttons: {
             ok: function () {
                 window.location.href = "<?=base_url()?>booking/booking_listview";
             }      
            }
         });

     }
    });
    //   var patient_name = $('#patient_name').val();
//   var image_num = $('#image_num').val();
//   var patient_gender = $('#patient_gender').val();
//   var patient_type = $('#patient_type').val();
//   var patient_age = $('#patient_age').val();
//   var patient_birthday = $('#patient_birthday').val();
//   var patient_phone_num = $('#patient_phone_num').val();
//   var patient_source = $('#patient_source').val();
//   var patient_code = $('#patient_code').val();
//   var patient_pinyin = $('#patient_pinyin').val();
//   var req_doctor_name = $('#req_doctor_name').val();
//   var req_branch = $('#req_branch').val();
//   var room_num = $('#room_num').val();
//   var bed_num = $('#bed_num').val();
//   var cost_type = $('#cost_type').val();
//   var clinical_diagnosis = $('#clinical_diagnosis').val();
//   var health_insurance_num = $('#health_insurance_num').val();
//   var social_security_num = $('#social_security_num').val();
//   var patient_address = $('#patient_address').val();
//   var patient_remark = $('#patient_remark').val();
//   var checkup_equipment = $('#checkup_device').val();
//   var checkup_time = $('#checkup_time').val();
//   var checkup_num = $('#checkup_num').val();
//   var checkup_type = $('#checkup_type').val();
//   var cost_amount = $('#cost_amount').val();
//   var agetype = $('#agetype').val();
//   var license_num = $('#license_num').val();
//   var hospital_num = $('#hospital_num').val();
//   var checkup_item = $('#checkup_item').val();
//   var clinic_num =$('#clinic_num').val();
//   var hospital_name = $('#patient_hospital_name').val();
//   var booking_id = $('#booking_id').val();
//   var a =   $('#result_notification');
//   var b = $('#save_patient_confirm');
//   var message = '<div class="alert alert-danger display"><button class="close" data-close="alert"></button>';
//   $.post(strURL, {
//     patient_name: patient_name,
//     hospital_num:hospital_num,
//     clinic_num:clinic_num,
//     image_num: image_num,
//     patient_type: patient_type,
//     patient_gender: patient_gender,
//     patient_age: patient_age,
//     booking_id: booking_id,
//     patient_birthday: patient_birthday,
//     patient_phone_num: patient_phone_num,
//     patient_source: patient_source,
//     patient_code: patient_code,
//     patient_pinyin: patient_pinyin,
//     req_doctor_name: req_doctor_name,
//     req_branch: req_branch,
//     room_num: room_num,
//     bed_num: bed_num,
//     cost_type: cost_type,
//     clinical_diagnosis: clinical_diagnosis,
//     health_insurance_num: health_insurance_num,
//     social_security_num: social_security_num,
//     patient_address: patient_address,
//     patient_remark: patient_remark,
//     checkup_equipment: checkup_equipment,
//     checkup_time: checkup_time,
//     checkup_num: checkup_num,
//     checkup_type: checkup_type,
//     cost_amount: cost_amount,
//     license_num:license_num,
//     checkup_item: checkup_item,
//     hospital_name: hospital_name
//   }).done(function (data) {
//       if (data) {
//         $('#booking_id').val(data);
//         // message += "登记已成功了！</div>";
//         // a.html(message);
//         // $('#subit_add_patient').attr('disabled');
//         // b.modal();
//         location.href = "<?=base_url()?>booking/booking_listview";
//       } else {
//       }
//   });

}

$(function() {
  $( "#menu-1" ).menu();
  select_checkup_date("<?=date('Y-m-d')?>");
  $( "input[value='<?=date('Y-m-d')?>']" ).parent().addClass('active');

});

</script>
