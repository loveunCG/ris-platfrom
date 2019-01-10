<div class="page-content-wrapper">
    <div class="page-content">
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
                    <span>咨询详细信息</span>
                </li>
            </ul>

        </div>
        <!-- BEGIN CONTENT BODY -->
        <div class="row" id="sortable_portlets">

            <div class="col-md-12">
                <div class="portlet light portlet-sortable">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-puzzle font-grey-gallery"></i>
                            <span class="caption-subject bold font-grey-gallery uppercase">  咨询详细信息 </span>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse"> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                            <a href="" class="reload"> </a>
                            <a href="" class="fullscreen"> </a>
                            <a href="" class="remove"> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-offset-1 col-md-4 col-sm-12">
                                <div class="mt-element-ribbon bg-default">
                                    <div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-round ribbon-border-dash-hor ribbon-color-info uppercase">
                                        <?php

                                        if ($contact_info->contact_type=='1') {
                                            $contact_type = '<span> 远程会诊 </span>';
                                        }elseif ($contact_info->contact_type == '2') {
                                            $contact_type = '<span> 远程门诊 </span>';
                                        }
                                        echo $contact_type;


                                    ?>
                                    </div>
                                    <p>
                                    </p>
                                    <div class="row" style="padding-top: 5%;">
                                        <div class="form-group form-md-line-input col-md-offset-1">
                                            <div class="input-group">
                                                <span class="input-group-btn btn-left">
                                                        <button class="btn red" disabled type="button">附件上传 </button>
                                                    </span>
                                                <div class="input-group-control">
                                                    <input type="text" class="form-control" value="<?=$contact_info->check_result_doc?>">
                                                </div>
                                                <span class="input-group-btn btn-right">
                                                        <button class="btn green-haze" type="button">预览</button>
                                                    </span>
                                            </div>

                                        </div>
                                        <div class="form-group form-md-line-input col-md-offset-1">
                                            <div class="input-group">
                                                <span class="input-group-btn btn-left">
                                                        <button class="btn red" disabled type="button">影像上传 </button>
                                                    </span>
                                                <div class="input-group-control">
                                                    <input type="text" class="form-control" value="<?=$contact_info->checkup_image_upload?>">
                                                </div>
                                                <span class="input-group-btn btn-right">
                                                        <button class="btn green-haze" type="button">预览</button>
                                                    </span>
                                            </div>

                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <div class="input-group">
                                                <span class="input-group-btn btn-left">
                                                        <a class="btn btn default btn-info" disabled type="button"> 申请医生:</a>
                                                    </span>
                                                <div class="input-group-control">
                                                    <input type="text" class="form-control" value="<?=$contact_info->doctor_name?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <div class="input-group">
                                                <span class="input-group-btn btn-left">
                                                        <a class="btn btn default btn-info" disabled type="button"> 申请医院:</a>
                                                    </span>
                                                <div class="input-group-control">
                                                    <input type="text" value="<?=$contact_info->req_hospital?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <div class="input-group">
                                                <span class="input-group-btn btn-left">
                                                        <a class="btn btn default btn-info" disabled type="button"> 申请时间:</a>
                                                    </span>
                                                <div class="input-group-control">
                                                    <input type="text" value="<?=$contact_info->submit_time?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <div class="input-group">
                                                <span class="input-group-btn btn-left">
                                                        <a class="btn btn default btn-info" disabled type="button"> 会诊专家:</a>
                                                    </span>
                                                <div class="input-group-control">
                                                    <input type="text" value="<?=$contact_info->set_hospital.'  '.$contact_info->set_class?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <div class="input-group">
                                                <span class="input-group-btn btn-left">
                                                        <a class="btn btn default btn-info" disabled type="button"> 会诊时间:</a>
                                                    </span>
                                                <div class="input-group-control">
                                                    <input disabled type="text" class="form-control" value="<?=$contact_info->set_check_time?>">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-offset-1 col-md-5 col-sm-12">

                                <div class="mt-element-ribbon bg-default">
                                    <div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-round ribbon-border-dash-hor ribbon-color-info uppercase">
                                        咨询资料
                                    </div>
                                    <p>
                                    </p>
                                    <div class="row" style="padding-top: 5%;">
                                        <div class="form-group ">
                                            <label for="form_control_1">病人描述</label>

                                            <textarea disabled class="form-control" value="" rows="8"><?=$contact_info->disease_summary?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="form_control_1">病人描述</label>

                                            <textarea disabled class="form-control" value="" rows="8"><?=$contact_info->medical_history?></textarea>

                                        </div>
                                        <div class="form-group">
                                            <label for="form_control_1">咨询问题</label>

                                            <textarea disabled class="form-control" value="" rows="8"><?=$contact_info->contact_problem?></textarea>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="row well">
                            <center>
                                <button type="button" class="btn blue" onclick="window.history.go(-1)"><span class="glyphicon glyphicon-arrow-left"> </span>返回</button>
               
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="responsive" class="modal fade" tabindex="-1" data-width="760">
            <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">安排会诊</h4>
            </div>
            <form id="submit_AnpaiInfo_Form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>标题：</label>
                                    <div class="input-icon right">
                                        <i class="fa fa-microphone fa-spin font-blue"></i>
                                        <input type="text" name="nick_name" class="form-control" placeholder="标题">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>密码：</label>
                                    <div class="input-icon right">
                                        <i class="fa fa-microphone fa-spin font-blue"></i>
                                        <input type="password" name="password" class="form-control" placeholder="密码"> </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="input-icon margin-top-10">
                                    <i class="fa fa-search"></i>
                                    <input type="text" name="search_doctorName" class="form-control input-circle" placeholder="请输入找关键字">
                                </div>
                            </div>
                            <div class=" col-md-6" style="margin-top: 10px;">

                                <div class="form-group">
                                    <label class="col-md-8 control-label">
                                已选联系人：
                                </label>
                                    <div class="col-md-4">
                                        <p class="form-control-static" id="people_roomcount"></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 200px;">
                        <div class="col-md-12">
                            <div class="col-md-6" id="hospital_list">
                            </div>
                            <div class="col-md-6" id="room_people_num">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label col-md-4">开始时间：</label>
                                    <div class="col-md-8">
                                        <div class="input-group date form_datetime input-large">
                                            <input type="text" xxxx name="set_check_time" readonly class="form-control">
                                            <span class="input-group-btn">
                                     <button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name = "contact_id" id="contact_id" value="<?=$contact_info->contact_id?>">
                                    <label class="control-label col-md-4">调整时间：</label>
                                    <div class="col-md-8">
                                        <div class="input-group date form_datetime input-large">
                                            <input type="text" xxxx readonly name="control_dataTime" class="form-control">
                                            <span class="input-group-btn">
                                     <button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-4 control-label" for="form_control_1">调整</label>
                                    <div class="col-md-8">
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" id="radio53" name="iscontrol_time" value="yes" class="md-radiobtn">
                                                <label for="radio53">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span>是</label>
                                            </div>
                                            <div class="md-radio has-error">
                                                <input type="radio" id="radio54" name="iscontrol_time" value="no" class="md-radiobtn" checked="">
                                                <label for="radio54">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span>否</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn green">确定</button>
                    <button type="button" data-dismiss="modal" class="btn btn-outline dark">取消</button>
                </div>
            </form>

        </div>
    </div>
    <script>
        function AnPaihuiZhen() {

            $('#responsive').modal();

        }

        $(function () {
            $("#submit_AnpaiInfo_Form").validate({
                rules: {
                    nick_name: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                    start_dataTime: {
                        required: true,
                    },
                    radio2: {
                        required: true,
                    }
                },
                //For custom messages
                messages: {
                    nick_name: {
                        required: " 这是必填字段",
                    },
                    start_dataTime: {
                        required: " 这是必填字段",
                    },
                    radio2: {
                        required: " 这是必填字段.",
                    },
                    password: {
                        required: " 这是必填字段.",
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
                submitHandler: function (e) {
                    AjaxSubmitFormPro();
                }
            });

        });



        function AjaxSubmitFormPro() {
            var form_data = $('#submit_AnpaiInfo_Form').serialize();
            var strURL = '<?=base_url()?>contact/contactAnpaiInfo';
            $.ajax({
                type: 'post',
                data: form_data,
                dataType: "json",
                url: strURL,
                success: function (response) {
                    $.alert(response)
                    $.alert({
                        title: '报告!',
                        content: '已成功安排了',
                        columnClass: 'small',
                        buttons: {
                            ok: function () {
                                window.location.href = "<?=base_url()?>contact/my_contact";
                            },
                        }
                    });
                },
                error: function (response) {
                    $.alert("失败", "失败拒绝.", "error");
                }
            })


        }


        function RejrctHuiZhen() {
            $.confirm({
                title: '拒绝咨询会诊',
                typeAnimated: true,
                theme: 'material',
                columnClass: 'small',
                draggable: true,
                content: '' +
                    '<form action="" class="formName" id ="SubmitMoneyRequestForm">' +
                    '<div class="form-group form-md-line-input form-md-floating-label">' +
                    ' <textarea class="form-control" name = "reject_reason" id = "reject_reason" rows="5"></textarea>' +
                    '<label for="form_control_1">备注</label>' +
                    '</div>' +
                    '</form>',
                buttons: {
                    formSubmit: {
                        text: '确定',
                        btnClass: 'btn green-haze',
                        action: function () {
                            var textarea = $('#reject_reason').val();
                            var form_data = $('#SubmitMoneyRequestForm').serialize();
                            if (textarea == "") {
                                $.alert("请输入拒绝理由", "警告！", "error");
                                return true;
                            }
                            var strURL = "<?=base_url()?>contact/RejrctHuiZhen/" + $('#contact_id').val();
                            $.ajax({
                                type: 'post',
                                data: form_data,
                                dataType: "json",
                                url: strURL,
                                success: function (response) {
                                    $.alert({
                                        title: '报告!',
                                        content: '已成功拒绝',
                                        columnClass: 'small',
                                        buttons: {
                                            ok: function () {
                                                window.location.href =
                                                    "<?=base_url()?>contact/my_contact";
                                            },
                                        }
                                    });
                                },
                                error: function (response) {
                                    $.alert("失败", "失败拒绝.", "error");
                                }
                            });
                        }
                    },
                    cancel: {
                        text: '取消',
                        btnClass: 'btn yellow-mint',
                        action: function () {


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
    </script>