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
                <div class="portlet portlet-sortable box blue-steel">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-magnifier"></i>
                            <span class="caption-subject font-green sbold uppercase">设备管理</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="<?=base_url()?>report/search_data" method="post" class="form-horizontal" id="search_device_form" novalidate>
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
                                        <label class="col-md-3 control-label" for="form_control_1">设备类型
                                        </label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="s_equipment_type" name="equipment_type">
                                              <option value="">请选择</option>
                                                          <?php foreach ($get_device_type as $report){
                                                            echo '<option value="'.$report->equipment_type.'">'.$report->equipment_type.'</option>';
                                                          } ?>
                                              </select>
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">请输入设备类型</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">设备型号
                                                </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" id="s_equipment_num" name="equipment_num">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">请输入设备型号</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">所属科室</label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="s_equipment_deaprtment" name="equipment_deaprtment">
                                                        <option value="">请选择</option>
                                                            <?php foreach ($equipment_deaprtment as $var_report){
                                                              echo '<option value="'.$var_report->equipment_deaprtment.'">'.$var_report->equipment_deaprtment.'</option>';
                                                            } ?>
                                                    </select>
                                            <span class="help-block">请输入设备型号</span>

                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">诊室号</label>
                                        <div class="col-md-9">
                                            <input class="form-control" id="s_equioment_room" name="equioment_room">
                                            <span class="help-block">请输入设备型号</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="control-label col-md-3">添加时间</label>
                                        <div class="col-md-9">
                                            <input class="form-control form-control-inline input-medium" id="start_time" name="start_time" size="20" type="text" value=""
                                            />
                                            <span class="help-block"> 选择日期 </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="control-label col-md-3">至</label>
                                        <div class="col-md-9">
                                            <input class="form-control form-control-inline input-medium" id="end_time" name="end_time" size="20" type="text" value=""
                                            />
                                            <span class="help-block"> 选择日期 </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group form-md-input">
                                        <button type="button" class="col-md-offset-9 btn  pull-left yellow" id="search_device_btn"><span class="glyphicon glyphicon-search"> </span>查询</button>
                                        <button type="button" class="btn  blue pull-right" onclick="search_clear()"><span class="glyphicon glyphicon-refresh"> </span>重置</button>
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
                <div class="portlet portlet-sortable box  blue-steel ">
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
                            <input type="hidden" id="device_dat_id" value="">
                            <input type="hidden" id="">
                            <div class="row">
                                <button type="button" class="btn green-haze" data-target="#add_user" data-toggle="modal"><span class="glyphicon glyphicon-plus-sign"> </span>新增设备</button>

                                <div id="add_user" class="modal fade" tabindex="-1" data-focus-on="input:first">
                                    <div class="portlet portlet-sortable box blue">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-user-plus"></i>
                                                <span class="caption-subject font-light sbold uppercase">新增设备</span>
                                            </div>
                                            <div class="actions">
                                                <a data-dismiss="modal" class="btn btn-circle btn-icon-only btn-light" href="javascript:;">
                                                 <i class="fa fa-close"></i>
                                              </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <!-- BEGIN FORM-->
                                            <form action="#" method="post" id="form_add_device">
                                                <div class="form-body col-md-12">
                                                    <div id="result_notification2">
                                                    </div>
                                                    <div class="alert alert-success display-hide">
                                                        <button class="close" data-close="alert"></button>您的表单验证成功！ </div>
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-12 form-md-line-input ">
                                                            <input type="text" name="equipment_type" autocomplete="off" class="form-control" id="n_equipment_type">
                                                            <label for="form_control_1">设备类型</label>
                                                            <span id="error_message" class="help-block">請輸入设备类型</span>
                                                        </div>
                                                    </div>
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-6 form-md-line-input  has-success">
                                                            <input type="text" class="form-control" onchange = "duplication_num(this.value)" name="equipment_num" id="n_equipment_num">
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
                                                                        $("#error_check_duplication").css("display","block");
                                                                        $("#error_check_duplication").html(data);
                                                                        $("#submit_button").attr("disabled","true");
                                                                    } else {
                                                                        $("#error_check_duplication").css("display", "none");
                                                                        $("#submit_button").removeAttr("disabled");
                                                                    }
                                                                });
                                                         }
                                                        </script>
                                                        <div class="form-group col-md-6 form-md-line-input ">
                                                            <select class="form-control" name="equipment_deaprtment" id="n_equipment_deaprtment">
                                                                <option value=" ">请选择</option>
                                                                <?php foreach ($department_info as $value) {
                                                                  echo '<option value="'.$value->department_name.'">'.$value->department_name.'</option>';


                                                                }
                                                                 ?>
                                                            </select>
                                                            <label for="form_control_1">所属科室</label>
                                                            <span class="help-block">请输入所属科室</span>
                                                        </div>
                                                    </div>
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-6 form-md-line-input ">
                                                            <input type="text" class="form-control" name="equioment_room" id="n_equioment_room">
                                                            <label for="form_control_1">诊室号</label>
                                                            <span class="help-block">请输入诊室号</span>
                                                        </div>
                                                        <div class="form-group  col-md-6 form-md-line-input ">
                                                            <input type="text" class="form-control" name="ip_address" id="n_ip_address">
                                                            <label for="form_control_1">IP地址</label>
                                                            <span class="help-block">请输入IP地址</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group  col-md-12 form-md-line-input  ">
                                                        <input type="text" class="form-control" name="dicom_port" id="n_dicom_port">
                                                        <label for="form_control_1">DICOM接口号</label>
                                                        <span class="help-block">请输入DICOM接口号</span>
                                                    </div>
                                                    <div class="form-group  col-md-12 form-md-line-input">
                                                        <select class="form-control" id="n_AETitle" name="AETitle">
                                                                        <option value="Worklist">Worklist</option>
                                                                        <option value="Storage">Storage</option>
                                                                        <option value="Print">Print</option>
                                                          </select>
                                                        <label for="form_control_1">AETitle</label>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-offset-1 col-md-10">
                                                            <button type="submit" id="submit_button" class="btn blue-soft pull-left"><span class="glyphicon glyphicon-plus"> </span>添加</button>
                                                            <a href="javascript:;" data-dismiss="modal" onclick="AddUserClose()" class="btn blue-soft pull-right"><span class="glyphicon glyphicon-repeat"> </span>返回</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <button type="button" class="btn yellow-mint" disabled id="edit_user_data_btn" data-target="#edit_user_data" data-toggle="modal"><span class="glyphicon glyphicon-pencil"> </span>编辑</button>

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
                                            <form action="#" method="post" id="update_device">
                                                <div class="form-body">
                                                    <div id="result_notification1">
                                                    </div>
                                                    <div class="alert alert-success display-hide">
                                                        <button class="close" data-close="alert"></button>您的表单验证成功！ </div>
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-12 form-md-line-input ">
                                                            <input type="text" name="equipment_type" autocomplete="off" class="form-control" id="equipment_type">
                                                            <label for="form_control_1">设备类型</label>
                                                            <span id="error_message" class="help-block">請輸入账号</span>
                                                        </div>
                                                    </div>
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-6 form-md-line-input  has-success">
                                                            <input type="text" class="form-control" name="equipment_num" id="equipment_num">
                                                            <label for="form_control_1">设备型号</label>
                                                            <span class="help-block">请输入姓名</span>
                                                        </div>
                                                        <div class="form-group col-md-6 form-md-line-input ">
                                                            <select class="form-control" name="equipment_deaprtment" id="equipment_deaprtment">
                                                                <option value=" ">请选择</option>
                                                                <?php foreach ($department_info as $value) {
                                                                  echo '<option value="'.$value->department_name.'">'.$value->department_name.'</option>';


                                                                }
                                                                 ?>
                                                            </select>
                                                            <label for="form_control_1">所属科室</label>
                                                            <span class="help-block">请输入所属科室</span>
                                                        </div>
                                                    </div>
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-6 form-md-line-input ">
                                                            <input type="text" class="form-control" name="equioment_room" id="equioment_room">
                                                            <label for="form_control_1">诊室号</label>
                                                            <span class="help-block">请输入年龄</span>
                                                        </div>
                                                        <div class="form-group  col-md-6 form-md-line-input ">
                                                            <input type="text" class="form-control" name="ip_address" id="ip_address">
                                                            <label for="form_control_1">IP地址</label>
                                                            <span class="help-block">请输入联系方式</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group  col-md-12 form-md-line-input  ">
                                                        <input type="text" class="form-control" name="dicom_port" id="dicom_port">
                                                        <label for="form_control_1">DICOM接口号</label>
                                                        <span class="help-block">请输入联系方式</span>
                                                    </div>

                                                    <div class="form-group  col-md-12 form-md-line-input">
                                                        <select class="form-control" id="u_AETitle" name="AETitle">
                                                                        <option value="Worklist">Worklist</option>
                                                                        <option value="Storage">Storage</option>
                                                                        <option value="Print">Print</option>
                                                          </select>
                                                        <label for="form_control_1">请输入AETitle</label>
                                                    </div>
                                                </div>

                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-10 col-md-offset-1">
                                                            <button type="submit" id="equipment_update_bn" class="btn blue-sharp pull-left"><span class="glyphicon glyphicon-edit"> </span>改修</button>
                                                            <a href="javascript:;" data-dismiss="modal" onclick = "EditCloseUser()" class="btn blue-sharp pull-right"><span class="glyphicon glyphicon-repeat"> </span>返回</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <button type="button" class="btn green-sharp" disabled data-toggle="modal" onclick="start_device()" id="start_device"><span class="glyphicon glyphicon-play"> </span>开启</button>

                                <button type="button" class="btn grey-gallery" id="stop_device" onclick="stop_device()"><span class="glyphicon glyphicon-pause"> </span>禁用</button>


                                <button type="button" class="btn red-thunderbird" disabled id="delect_device"><span class="glyphicon glyphicon-trash"> </span>删除</button>
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


                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl_device_info">
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
    <script>
        var table = '';
        var originalModal = $('#add_user').clone();
        var originalModal1 = $('#edit_user_data').clone();

         function AddUserClose() {
            $('#add_user').find('.help-block-error').remove();
            $('#add_user').find('.form-group').removeClass('has-error');
        }

        function EditCloseUser() {
            $('#edit_user_data').find('.help-block-error').html('');
            $('#edit_user_data').find('.form-group').removeClass('has-error');
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
            table.buttons().remove();
            $('#tbl_device_info tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
                var device_id = $(this).find('.device_id').val();
                var data = table.row(this).data();
                var base_url = '<?= base_url() ?>';
                var strURL = base_url + "usermg/get_device_info/" + device_id;
                $.ajax({
                    dataType: "json",
                    url: strURL,
                    success: function (response) {
                        select_device(response);
                    }
                });
            });

            // $('#add_user').on('hidden.bs.modal', function (e) {
            //     $('#add_user').remove();
            //     var myClone = originalModal.clone();
            //     $('body').append(myClone);
            // });
            //  $('#edit_user_data').on('hidden.bs.modal', function (e) {
            //     $('#edit_user_data').remove();
            //     var myClone = originalModal1.clone();
            //     $('body').append(myClone);
            // });

            $("#search_device_btn").click(function () {
                var base_url = '<?= base_url()?>';
                var formData = $('#search_device_form').serialize();
                var ajaxurl = base_url + 'usermg/search_device?' + formData;
                table.ajax.url(ajaxurl).load();
            });
        });
        $(function () {
            $('#delect_device').click(function () {
                $.confirm({
                    title: '提示',
                    content: ' 确定要删除吗？',
                    theme: 'material',
                    autoClose: 'chancel|10000',
                    draggable: true,
                    buttons: {
                        confirm: {
                            text: '是',
                            keys: ['shift', 'alt'],
                            action: function () {
                                var base_url = '<?= base_url() ?>';
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
        })

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
            $('#dicom_port').val(dicom_port);
            $('#equipment_status').val(equipment_status);
            $('#u_AETitle').val(AETitle);

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
            var base_url = '<?= base_url()?>';
            var strURL = base_url + "usermg/update_device/";
            var id = $("#device_dat_id").val();
            var equipment_type = $("#equipment_type").val();
            var equipment_num = $("#equipment_num").val();
            var equioment_room = $("#equioment_room").val();
            var equipment_deaprtment = $("#equipment_deaprtment").val();
            var ip_address = $("#ip_address").val();
            var dicom_port = $("#dicom_port").val();
            var u_AETitle = $('#u_AETitle').val();
            var message = '<div class="alert alert-danger display"><button class="close" data-close="alert"></button>';
            $.post(strURL, {
                id: id,
                equipment_type: equipment_type,
                equioment_room: equioment_room,
                equipment_deaprtment: equipment_deaprtment,
                ip_address: ip_address,
                dicom_port: dicom_port,
                equipment_num: equipment_num,
                AETitle: u_AETitle,
            }).done(function (data) {
                if (data) {
                    message += "修改成功了！</div>";
                    $('#result_notification1').html(message).delay(800);
                    table.ajax.reload();
                } else {
                    message += "修改失败了！</div>";
                    $('#result_notification1').html(message);
                }
            });


        }

        function add_equipmentinfo() {

            var base_url = '<?= base_url()?>';
            var strURL = base_url + "usermg/add_equipment/";
            var equipment_type = $("#n_equipment_type").val();
            var equipment_num = $("#n_equipment_num").val();
            var equioment_room = $("#n_equioment_room").val();
            var equipment_deaprtment = $("#n_equipment_deaprtment").val();
            var ip_address = $("#n_ip_address").val();
            var dicom_port = $("#n_dicom_port").val();
            var AETitle = $("#n_AETitle").val();
            var message = '<div class="alert alert-danger display"><button class="close" data-close="alert"></button>';
            $.post(strURL, {
                equipment_type: equipment_type,
                equioment_room: equioment_room,
                equipment_deaprtment: equipment_deaprtment,
                ip_address: ip_address,
                dicom_port: dicom_port,
                equipment_num: equipment_num,
                AETitle: AETitle
            }).done(function (data) {
                if (data) {
                    message += "添加成功了！</div>";
                    $('#submit_button').attr("disabled", "true");
                    $('#result_notification2').html(message).delay(1000);
                    $('#add_user').slideUp(1000);
                    $("#stop_device").attr("disabled", "true");
                    table.ajax.reload();
                    $('#add_user').removeData();



                } else {
                    message += "添加失败了！</div>";
                    $('#result_notification2').html(message);
                }
            });


        };

        function start_device() {
            var base_url = '<?= base_url() ?>';
            val = $('#device_dat_id').val();
            var strURL = base_url + "usermg/start_device";
            var message = '<div class="alert alert-danger display"><button class="close" data-close="alert"></button>';
            $.post(strURL, {
                    device_dat_id: val
                })
                .done(function (data) {
                    if (data) {
                        message += "激活已成功了！</div>";
                        $('#result_notification').html(message).delay(800).slideUp(3000);
                        $('#start_device').attr("disabled", "true");
                        table.ajax.reload();
                    } else {
                        message += "激活失败了！</div>";
                        $('#result_notification').html(message).slideUp(1000);
                        table.ajax.reload();

                    }
                });
        };

        function stop_device() {
            var base_url = '<?= base_url() ?>';
            val = $('#device_dat_id').val();
            var strURL = base_url + "usermg/stop_device";
            var message = '<div class="alert alert-danger display"><button class="close" data-close="alert"></button>';
            $.post(strURL, {
                    device_dat_id: val
                })
                .done(function (data) {
                    if (data) {
                        message += "禁用已成功了！</div>";
                        $('#result_notification').html(message).delay(800).slideUp(300);
                        $('#stop_device').attr("disabled", "true");
                        table.ajax.reload();

                    } else {
                        message += "禁用失败了！</div>";
                        $('#result_notification').html(message).slideUp(2000);
                        table.ajax.reload();

                    }
                });
        };

        function delect_device() {

        };

        function search_clear() {
            $('#search_device_form')[0].reset();
            table.ajax.reload();
        };
    </script>
