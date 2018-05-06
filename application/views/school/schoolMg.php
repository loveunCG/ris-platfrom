<link href="<?=base_url()?>assets/global/plugins/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>assets/global/plugins/dropzone/basic.min.css" rel="stylesheet" type="text/css" />
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
                    <span>学习管理</span>
                </li>
            </ul>

        </div>
        <!-- BEGIN CONTENT BODY -->
        <div class="row" id="sortable_portlets">
            <div class="col-md-12 column sortable">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet portlet-sortable box blue-chambray">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-magnifier"></i>
                            <span class="caption-subject font-green sbold uppercase">学习管理</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="#" method="post" class="form-horizontal" id="search_lession_form" novalidate>
                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button>
                                    <?=$this->lang->line('form_error')?>
                                </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button>
                                    <?=$this->lang->line('validation_succes')?>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">课程类型                                          </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="lession_class">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">请输入课程类型</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">课程名称
                                                </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" name="lession_title">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">请输入课程名称</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="control-label col-md-3">添加时间</label>
                                        <div class="col-md-9">
                                            <input class="form-control form-control-inline input-medium date-picker" data-date-format="yyyy-mm-dd" name="start_time" size="20" type="text"  />
                                            <span class="help-block"> 选择日期 </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="control-label col-md-3">至</label>
                                        <div class="col-md-9">
                                            <input class="form-control form-control-inline input-medium date-picker" data-date-format="yyyy-mm-dd" name="end_time" size="20" type="text"  />
                                            <span class="help-block"> 选择日期 </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-8 col-md-3">
                                        <button type="button" class="btn  pull-left yellow" id="search_device_btn"><i class="fa fa-search"></i>查询</button>
                                        <button type="button" class="btn  blue pull-right" onclick="search_clear()"><i class="fa fa-refresh"></i>重置</button>
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
                <div class="portlet portlet-sortable box  blue-chambray ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-green sbold uppercase">设备列表</span>
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
                    <div class="portlet-body">
                        <div id="result_notification"></div>
                        <div class="clearfix" style="margin-left: 10%;">
                            <div class="row">
                                <button type="button" class="btn green-haze" data-target="#add_lesssion" data-toggle="modal">新增课程</button>

                                <div id="add_lesssion" class="modal fade" tabindex="-1" data-focus-on="input:first">
                                    <div class="portlet portlet-sortable box blue-ebonyclay">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-user-plus"></i>
                                                <span class="caption-subject font-red sbold uppercase">新增课程</span>
                                            </div>
                                            <div class="actions">
                                                <a data-dismiss="modal" class="btn btn-circle btn-icon-only btn-light" href="javascript:;">
                                                 <i class="fa fa-close"></i>
                                              </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                             <div class="portlet-body form">
                                                <div class="well">
                                                    <div class="row">
                                                        <form id="form_add_lession">
                                                            <div id="result_notification2">
                                                            </div>
                                                            <div class="alert alert-success display-hide">
                                                                <button class="close" data-close="alert"></button>您的表单验证成功！
                                                            </div>                                                    
                                                            <div class="col-md-12">
                                                                <div class="form-group col-md-12 form-md-line-input ">
                                                                    <input type="text" name="lession_title" autocomplete="off" class="form-control">
                                                                    <label for="form_control_1">课程名称</label>
                                                                    <span id="error_message" class="help-block">請輸入课程名称</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group col-md-6 form-md-line-input">
                                                                    <input type="text" class="form-control" name="lession_class">
                                                                    <label for="form_control_1">课程类型</label>
                                                                    <span class="help-block">请输入课程类型</span>
                                                                </div>
                                                                <div class="form-group col-md-6 form-md-line-input ">
                                                                    <input type="text" class="form-control" name="lession_doctor">
                                                                    <label for="form_control_1">老师姓名</label>
                                                                    <span class="help-block">请输入老师姓名</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group col-md-12 form-md-line-input ">
                                                                    <textarea class="form-control" name="lession_content" rows="3"></textarea>
                                                                    <label for="form_control_1">课程描述：</label>
                                                                    <span class="help-block">请输入课程描述</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group  form-md-radios">
                                                                    <div class="form-inline ">
                                                                        <div class="col-md-6 md-radio">
                                                                            <input type="radio" id="radio17" name="uploadfile_type" value="1" class="md-radiobtn">
                                                                            <label for="radio17">
                                                                                <span class="inc"></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> 附件 </label>
                                                                        </div>
                                                                        <div class="col-md-6 md-radio">
                                                                            <input type="radio" id="radio19" name="uploadfile_type" value="2" class="md-radiobtn">
                                                                            <label for="radio19">
                                                                                <span class="inc"></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> 影像 </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-inline">
                                                                    <div class="form-group pull-left form-md-line-input ">
                                                                        <input class="form-control" id="upload_doc_name" placeholder="附件文件" type="text">
                                                                        <input type="hidden" id="upload_doc_file_path"  name="upload_doc_file_path">
                                                                        <div class="form-control-focus"> </div>
                                                                    </div>
                                                                    <div class="form-group pull-right form-md-line-input ">
                                                                        <input class="form-control" id="upload_dicom_name" placeholder="影像文件" type="text">
                                                                        <input type="hidden"  id="upload_dicom_file_path" name="upload_dicom_file_path">
                                                                        <div class="form-control-focus"> </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="well">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <form action="<?=site_url('/contact/upload_file')?>" class="dropzone dropzone-file-area" id="my-dropzone">
                                                    <center><h2>请拖动或点击文件进行上传</h2></center>
                                                            
                                                                <div class="fallback">
                                                                    <input name="file" type="file" multiple />
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <div class="col-md-12" style="padding: 3%;">
                                                            <button type="button" id="form_add_lession_tbn" class="btn blue-soft pull-left">添加</button>
                                                            <a href="javascript:;" data-dismiss="modal" class="btn blue-soft pull-right">返回</a>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <button type="button" class="btn yellow-mint" disabled id="edit_lession_btn" data-target="#edit_user_data" data-toggle="modal">编辑</button>
                            <div id="edit_user_data" class="modal fade" tabindex="-1" data-focus-on="input:first">
                                <div class="portlet portlet-sortable box blue-hoki column sortable">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-user-plus"></i>
                                            <span class="caption-subject font-red sbold uppercase">修改信息</span>
                                        </div>
                                        <div class="actions">
                                            <a data-dismiss="modal" class="btn btn-circle btn-icon-only btn-light" href="javascript:;">
                                                 <i class="fa fa-close"></i>
                                              </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <!-- BEGIN FORM-->
                                        <div class="portlet-body form">
                                        <div id="result_notification2">
                                        </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button>您的表单验证成功！ </div>
                                        <div class="well">
                                            <div class="row">
                                                <form id="update_lession_form">
                                                    <div id="result_notification2">
                                                    </div>
                                                    <div class="alert alert-success display-hide">
                                                        <button class="close" data-close="alert"></button>您的表单验证成功！ </div>                                                   
                                                    <div class="col-md-12">
                                                        <div class="form-group col-md-12 form-md-line-input ">
                                                            <input type="text" name="lession_title" id="lession_title" autocomplete="off" class="form-control">
                                                            <label for="form_control_1">课程名称</label>
                                                            <span id="error_message" class="help-block">請輸入课程名称</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                      <input type="hidden" name = "lession_id" id = "lession_id"/>

                                                        <div class="form-group col-md-6 form-md-line-input">
                                                            <input type="text" class="form-control" name="lession_class" id="lession_class">
                                                            <label for="form_control_1">课程类型</label>
                                                            <span class="help-block">请输入课程类型</span>
                                                        </div>
                                                        <div class="form-group col-md-6 form-md-line-input ">
                                                            <input type="text" class="form-control" name="lession_doctor" id="lession_doctor">
                                                            <label for="form_control_1">老师姓名</label>
                                                            <span class="help-block">请输入老师姓名</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group col-md-12 form-md-line-input ">
                                                            <textarea class="form-control" name="lession_content" id="lession_content" rows="3"></textarea>
                                                            <label for="form_control_1">课程描述：</label>
                                                            <span class="help-block">请输入课程描述</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group  form-md-radios">
                                                            <div class="form-inline ">
                                                                <div class="col-md-6 md-radio">
                                                                    <input type="radio" id="radio1227" name="uploadfile_type1" value="1" class="md-radiobtn">
                                                                    <label for="radio1227">
                                                                    <span class="inc"></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> 附件 </label>
                                                                </div>
                                                                <div class="col-md-6 md-radio">
                                                                    <input type="radio" id="radio1229" name="uploadfile_type1" value="2" class="md-radiobtn">
                                                                    <label for="radio1229">
                                                                    <span class="inc"></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> 影像 </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-inline">
                                                            <div class="form-group pull-left form-md-line-input ">
                                                                <input class="form-control" id="upload_doc_name1" placeholder="附件文件" type="text">
                                                                 <input type="hidden" id="upload_doc_file_path1"  name="upload_doc_file_path">
                                                                <div class="form-control-focus"> </div>
                                                            </div>
                                                            <div class="form-group pull-right form-md-line-input ">
                                                                <input class="form-control" id="upload_dicom_name1" placeholder="影像文件" type="text">
                                                                <input type="hidden"  id="upload_dicom_file_path1" name="upload_dicom_file_path">
                                                                <div class="form-control-focus"> </div>
                                                            </div>
                
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="well">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action="<?=site_url('/contact/upload_file')?>" class="dropzone dropzone-file-area" id="my-dropzone">
                                                    <center><h2>请拖动或点击文件进行上传</h2></center>
                                                        <div class="fallback">
                                                            <input name="file" type="file" multiple />
                                                        </div>
                                                    </form>
                                                </div>
                
                                                <div class="col-md-12" style="padding: 3%;">
                                                    <button type="button" id="equipment_update_bn" class="btn blue-soft pull-left">添加</button>
                                                    <a href="javascript:;" data-dismiss="modal" class="btn blue-soft pull-right">返回</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn red-thunderbird" data-target="#delete_lession" data-toggle="modal" disabled id="delete_lession_btn">删除</button>



                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl_device_info">
                        <thead>
                            <tr>
                                <th >序号</th>
                                <th>课程名称</th>
                                <th>课程类型</th>
                                <th>老师姓名</th>
                                <th>添加时间</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
<script>
    function select_lession(val) {
        $('#lession_title').val(val.lession_title);
        $('#lession_id').val(val.lession_id);
        $('#lession_class').val(val.lession_class);
        $('#lession_content').val(val.lession_content);
        $('#lession_doctor').val(val.lession_doctor);
        $('#lession_title').val(val.lession_title);
        $('#lession_title').val(val.lession_title);
        $('#upload_doc_file_path1').val(val.lession_doc_url);
        $('#upload_dicom_file_path1').val(val.lession_video_url);
        $('#edit_lession_btn').removeAttr('disabled');
        $('#delete_lession_btn').removeAttr('disabled');
    }
    function search_clear() {
        $('#search_lession_form')[0].reset();
        location.reload();
    };
    $(document).ready(function () {
        var tbl_usr_info = '<?=base_url()?>' + 'school/search_lession';
        var table = $('#tbl_device_info').DataTable({
            "ajax": tbl_usr_info,
            dom: 'Bfrtip',
            "ordering": false,
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
            }],
            'searching': false,

            order: [
                [0, "asc"]
            ]
        });
        $('#tbl_device_info tbody').on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
            var device_id = $(this).find('.device_id').val();
            var data = table.row(this).data();
            var base_url = '<?=base_url()?>';
            var strURL = base_url + "school/get_school_info/" + device_id;
            $.ajax({
                dataType: "json",
                url: strURL,
                success: function (response) {
                    select_lession(response);
                }
            });
        });

        $("#search_device_btn").click(function () {
            var base_url = '<?=base_url()?>';
            var formData = $('#search_lession_form').serialize();
            var ajaxurl = base_url + 'school/search_lession?' + formData;
            table.ajax.url(ajaxurl).load();
        });
    });

    function add_lession_proc() {
        var url = "<?=base_url()?>" + 'school/save_lession';
        var form_data = $('#form_add_lession').serialize(); //Encode form elements for submission
        $.ajax({
            url: url,
            type: 'post',
            dataType: "JSON",
            data: form_data,
            success: function (result) {
                if (result.status = 'succes') {
                    $('.alert-success').show().delay(100000);
                    $('#submit_contact_btn').attr('disabled');
                    location.reload();
                } else {
                    $('.alert-error').show().delay(100000);
                }
            }
        });

    }

    function update_lession_proc() {
        var url = "<?=base_url()?>" + 'school/update_lession';
        var form_data = $('#update_lession_form').serialize(); //Encode form elements for submission
        $.ajax({
            url: url,
            type: 'post',
            dataType: "JSON",
            data: form_data,
            success: function (result) {
                if (result.status = 'succes') {
                    $('.alert-success').show().delay(100000);
                    $('#submit_contact_btn').attr('disabled');
                    location.reload();
                } else {
                    $('.alert-error').show().delay(100000);
                }
            }
        });
    }

    $(document).ready(function () {
      

        $('#delete_lession_btn').confirm({
            title: '提示',
            content: '是否要提交撤回申请？',
            buttons: {
                confirm: {
                    text: '是',
                    keys: ['shift', 'alt'],
                    action: function () {
                        var lession_id = $('#lession_id').val();
                        var base_url = '<?=base_url()?>';
                        var strURL = base_url + "school/delete_lession/" + lession_id;
                        $.ajax({
                            dataType: "json",
                            url: strURL,
                            success: function (response) {
                                $.alert("已成功撤回！");
                                location.reload();
                            }
                        });
                    }
                },
                chancel: {
                    text: '否',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function () {}
                }
            }
        });
    });
</script>
<script>
    $(function () {
        $('#form_add_lession_tbn').on('click', function () {
            $('#form_add_lession').submit();

        });
        $('#equipment_update_bn').on('click', function(){
            $('#update_lession_form').submit();
            
        })

    })
</script>

<script src="<?=base_url()?>assets/global/plugins/dropzone/dropzone.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/pages/scripts/form-dropzone.min.js" type="text/javascript"></script>