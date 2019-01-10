<?php
foreach($contact_info as $value){
    $contact_info = $value;
}

 ?>
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="#">
                        远程诊断
                    </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>远程会诊</span>
                    </li>
                </ul>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box portlet-sortable blue-chambray" id="form_wizard_1">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-light"></i>
                                <span class="caption-subject font-light bold uppercase"> 远程会诊 <span class="step-title"></span>
                                </span>
                            </div>
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-light" href="javascript:;">
                                <i class="icon-cloud-upload"></i>
                                        </a>
                                <a class="btn btn-circle btn-icon-only btn-light" href="javascript:;">
                                <i class="icon-wrench"></i>
                                        </a>
                                <a class="btn btn-circle btn-icon-only btn-light" href="javascript:;">
                                <i class="icon-trash"></i>
                                        </a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form class="form-horizontal" action="#" id="submit_form" method="POST">
                                <div class="form-wizard">
                                    <div class="form-body">
                                        <ul class="nav nav-pills nav-justified steps">
                                            <li>
                                                <a href="#tab1" data-toggle="tab" class="step">
                                                <span class="number"> 1 </span>
                                                     <span class="desc">
                                                          <i class="fa fa-check"></i><?=$this->lang->line('input_contact_info')?>
                                                     </span>
                                             </a>
                                            </li>
                                            <li>
                                                <a href="#tab2" data-toggle="tab" class="step">
                                                    <span class="number"> 2 </span>
                                                    <span class="desc">
                                                          <i class="fa fa-check"></i> <?=$this->lang->line('select_export')?>
                                                    </span>
                                             </a>
                                            </li>
                                        </ul>

                                        <div id="bar" class="progress progress-striped" role="progressbar">
                                            <div class="progress-bar progress-bar-success"> </div>
                                        </div>
                                        <div class="tab-content">

                                            <div class="alert alert-danger display-none">
                                                <button class="close" data-dismiss="alert"></button> 你有一些表单错误。 请检查下面。 </div>
                                            <div class="alert alert-success display-none">
                                                <button class="close" data-dismiss="alert"></button> 您的表单验证成功！ </div>
                                            <div class="alert alert-success display-none" id="notification">
                                                <button class="close" data-dismiss="alert"></button> 找不到病人信息！
                                            </div>

                                            <div class="tab-pane active" id="tab1">
                                                <input type="hidden" id="booking_id" name="booking_id" value="<?=$booking_id==''?$contact_info->booking_id: $booking_id ?>"
                                                />
                                                <?php if(!$booking_id): ?>
                                                <div class="row" style="padding-bottom: 2%">
                                                    <div class="col-xs-12 col-sm-3 col-lg-3">
                                                        <label class="control-label col-md-3">病人编号:
                                                  </label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" onchange="search_patient_info(this.value)" value="<?=$contact_info->patient_code?>"
                                                                name="patient_code" id="patient_code" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-9 col-lg-9">
                                                        <div class="form-group col-md-3 ">
                                                            <label class="control-label col-md-4"><?=$this->lang->line('patient_name')?>:
                                                      </label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" readonly name="patient_name" value="<?=$contact_info->patient_name?>" id="patient_name"
                                                                />
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3 ">
                                                            <label class="control-label col-md-4"><?=$this->lang->line('gender')?>:
                                                      </label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" readonly value="<?=$contact_info->patient_gender=='1' ? '男':$contact_info->patient_gender=='0'?'女':''?>"
                                                                    name="patient_gender" id="patient_gender" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3 ">
                                                            <label class="control-label col-md-4"><?=$this->lang->line('age')?>:
                                                      </label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" value="<?=$contact_info->patient_age?>" readonly name="patient_age" id="patient_age"
                                                                />
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3 ">
                                                            <label class="control-label col-md-4">身份证号:
                                                      </label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" readonly value="<?=$contact_info->license_num?>" name="license_num" id="license_num"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <?php endif; ?>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-3 col-lg-3">
                                                        <form method="post" enctype="multipart/form-data" id="form_upload_doc">
                                                            <div class="col-md-offset-2 col-md-9  form-group">
                                                                <div class="col-md-offset-5  fileinput fileinput-new" data-provides="fileinput">
                                                                    <span class="btn green btn-file">
                                                                 <span class="fileinput-new">附件上传 </span>
                                                                    <span class="fileinput-exists"> 换一下 </span>
                                                                    <input type="hidden" id="upload_doc_file_path" value="<?=$contact_info->check_result_doc?>" name="upload_doc_file_path">
                                                                    <input type="file" id="upload_doc" name="upload_doc">
                                                                    </span>
                                                                    <span class="fileinput-filename"></span> &nbsp;
                                                                    <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                                                    <button type="button" id="upload_doc_btn" class="btn btn-circle btn-icon-only green"><i class="icon-cloud-upload"></i></button>
                                                                    <div id="upload_doc_notification">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <div class="col-md-offset-2 col-md-9 form-group">
                                                            <div class="col-md-offset-5  fileinput fileinput-new" data-provides="fileinput">
                                                                <span class="btn green btn-file">
                                                            <span class="fileinput-new"> 影像上传</span>
                                                                <span class="fileinput-exists"> 换一下 </span>
                                                                <input type="hidden" value="" id="upload_dicom_file_path" value="<?=$contact_info->checkup_image_upload?>" name="upload_dicom_file_path">
                                                                <input type="file" id="upload_dicom" name="upload_dicom">                                                                </span>
                                                                <span class="fileinput-filename"></span> &nbsp;
                                                                <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                                                <button type="button" id="upload_dicom_btn" class="btn btn-circle btn-icon-only green"><i class="icon-cloud-upload"></i></button>
                                                                <div id="upload_dicom_notification">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12 ">
                                                            <label class="control-label col-md-4"><?=$this->lang->line('req_doctor_name')?>:
                                                            </label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" readonly value="<?=$this->session->userdata('usr_id')?>" name="req_doctor_name" id="req_doctor_name"
                                                                />
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12" style="margin-top: 2%;">
                                                            <label class="control-label col-md-4"><?=$this->lang->line('req_hospital')?>:
                                                              </label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" readonly value="<?=$this->session->userdata('hospital_name')?>" name="req_hospital"
                                                                    id="req_hospital" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-9 col-lg-9">

                                                        <div class="row" style="margin-top: 2%;">
                                                            <div class="form-group col-md-12">
                                                                <label class="control-label col-md-2">病情描述
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-10">
                                                                    <textarea class="form-control" name="disease_summary" value="" id="disease_summary" rows="5"><?=$contact_info->disease_summary?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label class="control-label col-md-2">基本病史
                                                                <span class="required"> * </span>
                                                            </label>
                                                                <div class="col-md-10">
                                                                    <textarea class="form-control" name="medical_history" id="medical_history" rows="5"><?=$contact_info->medical_history?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label class="control-label col-md-2">咨询提问
                                                                <span class="required"> * </span>
                                                            </label>
                                                                <div class="col-md-10">
                                                                    <textarea class="form-control" name="contact_problem" id="contact_problem" rows="5"><?=$contact_info->contact_problem?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane" id="tab2">
                                                <div class="row">
                                                    <div class="col-md-offset-2 col-md-2">
                                                        <a href="javascript:;" class="btn btn-circle btn-lg green">咨询专家</a>
                                                    </div>
                                                    <div class="col-md-3 form-group form-md-line-input">
                                                        <label class="col-md-3 control-label" for="form_control_1">医院：</label>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="set_hospital" id="set_hospital">
                                                              <option value="">请选择</option>
                                                              <?php foreach ($hospital_info as $value) {?>
                                                              <option value="<?=$value->hospital_name?>" <?=$contact_info->set_hospital==$value->hospital_name?'selected':''?>><?=$value->hospital_name?></option>
                                                            <?php }?>
                                                        </select>
                                                            <div class="form-control-focus"> </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 form-group form-md-line-input">
                                                        <label class="col-md-3 control-label" for="form_control_1">类别：</label>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="set_class" id="set_class">
                                                            <option value="">请选择</option>
                                                            <option <?=$contact_info->set_class=='内科'?'selected':''?> value="内科">内科</option>
                                                            <option <?=$contact_info->set_class=='外科'?'selected':''?> value="外科">外科</option>
                                                            <option <?=$contact_info->set_class=='神经外科'?'selected':''?> value="神经外科">神经外科</option>
                                                            <option <?=$contact_info->set_class=='骨科'?'selected':''?> value="骨科">骨科</option>
                                                        </select>
                                                            <div class="form-control-focus"> </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-offset-2 col-md-2">
                                                        <a href="javascript:;" class="btn btn-circle btn-lg green">会诊时间</a>
                                                    </div>
                                                    <div class="col-md-3 form-group form-md-line-input">
                                                        <label class="col-md-3 control-label" for="form_control_1">日期:</label>
                                                        <div class="col-md-7">
                                                            <div class="input-group form-md-line-input">
                                                                <input type="text" name="set_date" id="to" value="<?=$value->set_check_time?>" class="form-control">
                                                                <input type="hidden" name="contact_type" value="<?=$contact_info->contact_type=='null'?'1':$contact_info->contact_type?>"
                                                                />
                                                                <input type="hidden" name="contact_id" value="<?=$contact_info->contact_id?>" />
                                                                <span class="input-group-btn">
                                                        </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 form-md-line-input input-group form-group">
                                                        <label class="col-md-3 control-label" for="form_control_1">时间：</label>
                                                        <div class="col-md-7 ">
                                                            <div class="input-icon">
                                                                <i class="fa fa-clock-o"></i>
                                                                <input type="text" name="set_time" id="set_time" class="form-control timepicker timepicker-default">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-5 col-md-6">
                                                <a href="javascript:;" class="btn  green-meadow button-previous">
                                                  <i class="fa fa-angle-left"></i>
                                                  <?=$this->lang->line('prev')?>
                                            </a>
                                                <a href="javascript:;" id="next_prifirm" class="btn  green-meadow button-next">
                                                    <?=$this->lang->line('next')?>
                                                        <i class="fa fa-angle-right"></i>
                                                </a>
                                                <button type="button" id="submit_contact_btn" onclick="submit_contact()" class="btn green button-submit">
                                                <?=$this->lang->line('pay_submit_contact')?>
                                                     <i class="fa fa-check"></i>
                                            </button>
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
    </div>
    <script>
        $(function () {
            $('#set_time').val('');
        });

        function search_patient_info() {
            var booking_code = $('#patient_code').val();
            var url = "<?=base_url()?>" + 'contact/search_patient_info/' + booking_code;
            $.ajax({
                url: url,
                type: 'post',
                dataType: "JSON",
                booking_code: booking_code,
                success: function (result) {
                    if (result.booking_id) {
                        $('#patient_name').val(result.patient_name);
                        $('#patient_age').val(result.patient_age);
                        var patient_gender = result.patient_gender;
                        if (patient_gender == '1') {
                            $('#patient_gender').val('男');
                        } else {
                            $('#patient_gender').val('女');
                        }
                        $('#license_num').val(result.license_num);
                        $('#booking_id').val(result.booking_id);
                        $('#next_prifirm').removeAttr('disabled');

                    } else {
                        $.alert({
                            title: '警告!',
                            icon: 'fa fa-warning',
                            columnClass: 'small',
                            content: '请输入病人编码',
                            buttons: {
                                ok: function () {
                                    $('#next_prifirm').attr('disabled', 'true');
                                    $('#patient_name').val('');
                                    $('#patient_age').val('');
                                    $('#license_num').val('');
                                    $('#booking_id').val('');
                                    $('#patient_gender').val('');
                                },
                            }

                        });
                    }


                }
            });

        }

        function submit_contact() {
            if ($('#set_hospital').val() == '' || $('#set_class').val() == '' || $('#set_date').val() == '' || $(
                    '#set_time').val() == '') {
                $.alert({
                    title: '警告!',
                    icon: 'fa fa-warning',
                    columnClass: 'small',
                    content: '请输入远程咨询信息',
                });
                return true;

            } else {
                var url = "<?=base_url()?>" + 'contact/save_contact';
                var form_data = $('#submit_form').serialize();
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: "JSON",
                    data: form_data,
                    success: function (result) {
                        if (result.status = 'success') {
                            $.alert({
                                title: '标示!',
                                icon: 'fa fa-check',
                                columnClass: 'small',
                                content: '远程会诊请求已提交...',
                                buttons: {
                                    ok: function () {
                                        window.location.href =
                                            "<?=base_url()?>contact/my_contact";
                                    },
                                }
                            });
                        } else {
                            $('.alert-error').show().delay(100000);
                        }
                    }
                });
            }


        }
    </script>