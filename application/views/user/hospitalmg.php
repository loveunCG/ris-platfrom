<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">
            子医院管理 </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i> 子医院管理
                    </a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <span>子医院管理</span>
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
                            <span class="caption-subject font-green sbold uppercase">子医院管理</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="#" method="post" class="form-horizontal" id="search_hospital_form" novalidate>
                            <div class="form-body">

                                <div class="row">
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="col-md-5 control-label" for="form_control_1">医院编号 :                                          </label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" id="s_hospital_code" name="equipment_type">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">请输入医院编号</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="col-md-5 control-label" for="form_control_1">医院名称:
                                                </label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" placeholder="" id="s_hospital_name" name="equipment_num">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">请输入医院名称</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">所属省会:</label>
                                        <div class="col-md-9" data-toggle="distpicker">
                                            <div class="col-md-6">
                                                <select class="form-control" name="location_sheng" data-province="---- 选择省 ----"></select>
                                            </div>
                                            <div class="col-md-6">
                                                <select class=" form-control" name="location_city" data-city="---- 选择市 ----"></select>
                                            </div>

                                        </div>
                                        <div class="form-control-focus"> </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group form-md-line-input">
                                    <label class="control-label col-md-5">添加时间:</label>
                                    <div class="col-md-7">
                                        <input class="form-control form-control-inline input-medium " id="start_time" name="start_time" size="20" type="text" value=""
                                        />
                                        <span class="help-block"> 选择日期 </span>
                                    </div>
                                </div>
                                <div class="col-md-3 form-group form-md-line-input">
                                    <label class="control-label col-md-5">至</label>
                                    <div class="col-md-5">
                                        <input class="form-control form-control-inline input-medium " id="end_time" name="end_time" size="17" type="text" value=""
                                        />
                                        <span class="help-block"> 选择日期 </span>
                                    </div>
                                </div>
                                <div class="col-md-4 form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">状态</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="s_hospital_status" name="hospital_status">
                                                        <option value="">请选择</option>
                                                        <option value="3">审核通过</option>
                                                        <option value="1">未审核</option>
                                                        <option value="2">未通过</option>
                                       </select>
                                        <div class="form-control-focus"> </div>

                                    </div>
                                </div>
                                <div class="col-md-2 form-group form-md-input">
                                    <button type="button" class="btn col-md-4 blue  yellow" id="search_hospital_btn"><i class="fa fa-search"></i>查询</button>
                                    <button type="button" class="btn col-md-offset-4 col-md-4 blue" onclick="search_clear()"><i class="fa fa-refresh"></i>重置</button>
                                </div>
                            </div>
                    </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <div class="col-md-12 column sortable">
                <div class="portlet portlet-sortable box  blue-steel ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-green sbold uppercase">医院列表</span>
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
                        <div class="clearfix">
                            <input type="hidden" id="hospital_id" value="">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-2">
                                    <button type="button" class="btn green-haze pull-left" data-target="#add_user" data-toggle="modal"><span class="glyphicon glyphicon-plus"> </span>新增子医院</button>
                                    <button type="button" disabled class="btn yellow-mint pull-right" id="edit_user_data_btn" data-target="#edit_user_data" data-toggle="modal"><span class="glyphicon glyphicon-pencil"> </span>编辑</button>
                                </div>
                                <div id="add_user" class="modal fade" tabindex="-1" data-focus-on="input:first">
                                    <div class="portlet portlet-sortable box blue-ebonyclay">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-user-plus"></i>
                                                <span class="caption-subject font-red sbold uppercase">新增子医院</span>
                                            </div>
                                            <div class="actions">
                                                <a data-dismiss="modal" class="btn btn-circle btn-icon-only blue-ebonyclay" href="javascript:;">
                                                 <i class="fa fa-close"></i>
                                              </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <!-- BEGIN FORM-->
                                            <form action="#" method="post" id="add_hospital">
                                                <div class="form-body col-md-12">
                                                    <div id="result_notification2">
                                                    </div>
                                                    <div class="alert alert-success display-hide">
                                                        <button class="close" data-close="alert"></button>您的表单验证成功！ </div>
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-12 form-md-line-input ">
                                                            <input type="text" name="hospital_name" autocomplete="off" class="form-control" id="n_hospital_name">
                                                            <label for="form_control_1">医院名称</label>
                                                            <span id="error_message" class="help-block">請輸入医院名称</span>
                                                        </div>
                                                    </div>

                                                    <div class="row col-md-12 " data-toggle="distpicker">
                                                        <div class="form-group  col-md-12 form-md-line-input">
                                                            <select class="form-control" name="location_sheng" id="n_location_sheng" data-province="---- 选择省 ----"></select>
                                                            <label for="form_control_1">所属省会</label>
                                                        </div>
                                                        <div class="form-group  col-md-12 form-md-line-input">
                                                            <select class="form-control" name="location_city" id="n_location_city" data-city="---- 选择市 ----"></select>
                                                            <label for="form_control_1">所属地区</label>
                                                        </div>
                                                    </div>

                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-12 form-md-line-input ">
                                                            <input type="text" class="form-control" name="location_detail" id="n_location_detail">
                                                            <label for="form_control_1">地址</label>
                                                            <span class="help-block">请输入地址</span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-offset-1 col-md-10">
                                                            <button type="submit" id="submit_button" class="btn blue-soft pull-left"><span class="glyphicon glyphicon-plus"> </span>添加</button>
                                                            <a href="javascript:;" data-dismiss="modal" onclick = "AddUserClose()" class="btn blue-soft pull-right"><span class="glyphicon glyphicon-off"> </span>返回</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                            <form action="#" method="post" id="update_hospital">
                                                <div class="form-body col-md-12">
                                                    <div id="result_notification3">
                                                    </div>
                                                    <div class="alert alert-success display-hide">
                                                        <button class="close" data-close="alert"></button>您的表单验证成功！ </div>
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-12 form-md-line-input ">
                                                            <input type="text" name="hospital_name" autocomplete="off" class="form-control" id="hospital_name">
                                                            <label for="form_control_1">医院名称</label>
                                                            <span id="error_message" class="help-block">請輸入医院名称</span>
                                                        </div>
                                                    </div>

                                                    <div class="row col-md-12 " data-toggle="distpicker">
                                                        <div class="form-group  col-md-12 form-md-line-input">
                                                            <select class="form-control" name="location_sheng" id="location_sheng" data-province="---- 选择省 ----"></select>
                                                            <label for="form_control_1">所属省会</label>
                                                        </div>
                                                        <div class="form-group  col-md-12 form-md-line-input">
                                                            <select class="form-control" name="location_city" id="location_city" data-city="---- 选择市 ----"></select>
                                                            <label for="form_control_1">所属地区</label>
                                                        </div>
                                                    </div>

                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-12 form-md-line-input ">
                                                            <input type="text" class="form-control" name="location_detail" id="location_detail">
                                                            <label for="form_control_1">地址</label>
                                                            <span class="help-block">请输入地址</span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-offset-1 col-md-9">
                                                            <button type="submit" id="submit_button" class="btn blue-soft pull-left">修改</button>
                                                            <a href="javascript:;" data-dismiss="modal" onclick = "EditCloseUser()" class="btn blue-soft pull-right">返回</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl_hospital_info">
                            <thead>
                                <tr>
                                    <th>序号</th>
                                    <th>医院编号</th>
                                    <th>医院名称</th>
                                    <th>所属省会</th>
                                    <th>所属地区</th>
                                    <th>地址</th>
                                    <th>状态</th>
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
        function AddUserClose() {
            $('#add_user').find('.help-block-error').remove();
            $('#add_user').find('.form-group').removeClass('has-error');
        }

        function EditCloseUser() {
            $('#edit_user_data').find('.help-block-error').html('');
            $('#edit_user_data').find('.form-group').removeClass('has-error');
        }
        var table = '';

        function select_item(val) {
            var hospital_id = val.hospital_id;
            var hospital_code = val.hospital_code;
            var hospital_name = val.hospital_name;
            var location_sheng = val.location_sheng;
            var location_city = val.location_city;
            var location_detail = val.location_detail;
            var hospital_status = val.hospital_status;
            $('#hospital_id').val(hospital_id);
            $('#hospital_code').val(hospital_code);
            $('#location_detail').val(location_detail);
            $('#location_sheng').val(location_sheng);
            $('#hospital_name').val(hospital_name);
            $('#location_city').val(location_city);
            $('#hospital_status').val(hospital_status);
            $("#delect_device").removeAttr("disabled");
            $("#edit_user_data_btn").removeAttr("disabled");
        }

        function update_hospital_proc() {

            var base_url = '<?=base_url()?>';
            var strURL = base_url + "usermg/update_hospital/";
            var hospital_id = $("#hospital_id").val();
            var hospital_name = $("#hospital_name").val();
            var location_sheng = $("#location_sheng").val();
            var location_city = $("#location_city").val();
            var location_detail = $("#location_detail").val();
            var message = '<div class="alert alert-danger display"><button class="close" data-close="alert"></button>';
            if (!hospital_name || !location_sheng || !location_city || !location_detail) {
                message += "所有信息均?必</div>";
                $('#result_notification3').html(message);
            } else {
                $.post(strURL, {
                    hospital_name: hospital_name,
                    location_sheng: location_sheng,
                    location_city: location_city,
                    location_detail: location_detail,
                    hospital_id: hospital_id
                }).done(function (data) {
                    if (data) {
                        message += "修改成功了！</div>";
                        $('#result_notification3').html(message).delay(800);
                        location.reload();

                    } else {
                        message += "修改失败了！</div>";
                        $('#result_notification3').html(message);
                    }
                });
            }
        }

        function add_hospital_proc() {
            var base_url = '<?=base_url()?>';
            var strURL = base_url + "usermg/add_hospital/";
            var hospital_name = $("#n_hospital_name").val();
            var location_sheng = $("#n_location_sheng").val();
            var location_city = $("#n_location_city").val();
            var location_detail = $("#n_location_detail").val();
            var message = '<div class="alert alert-danger display"><button class="close" data-close="alert"></button>';
            if (!hospital_name || !location_sheng || !location_city || !location_detail) {
                message += "所有信息均?必</div>";
                $('#result_notification2').html(message);

            } else {
                $.post(strURL, {
                    hospital_name: hospital_name,
                    location_sheng: location_sheng,
                    location_city: location_city,
                    location_detail: location_detail
                }).done(function (data) {
                    if (data) {
                        message += "添加成功了！</div>";
                        $('#submit_button').attr("disabled", "true");
                        $('#result_notification2').html(message).delay(1000);
                        $('#add_user').slideUp(3000);
                        table.ajax.reload();

                    } else {
                        message += "添加失败了！</div>";
                        $('#result_notification2').html(message);
                    }
                });


            }


        };



        function search_clear() {
            $('#search_hospital_form')[0].reset();
            table.ajax.reload();
        };

        var originalModal1 = $('#add_user').clone();
        var originalModal = $('#edit_user_data').clone();
        $(document).ready(function () {
            // $('#add_user').on('hidden.bs.modal', function (e) {
            //     $('#add_user').remove();
            //     var myClone = originalModal1.clone();
            //     $('body').append(myClone);
            // });
            // $('#edit_user_data').on('hidden.bs.modal', function (e) {
            //     $('#edit_user_data').remove();
            //     var myClone = originalModal.clone();
            //     location.reload();
            // });
            var tbl_usr_info = '<?=base_url()?>' + 'usermg/search_hospital';
            table = $('#tbl_hospital_info').DataTable({
                "ajax": tbl_usr_info,
                select: true,
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
                order: [
                    [0, "asc"]
                ]
            });
            $('#tbl_hospital_info tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
                var device_id = $(this).find('.device_id').val();
                var data = table.row(this).data();
                var base_url = '<?= base_url() ?>';
                var strURL = base_url + "usermg/get_hospital_info/" + device_id;
                $.ajax({
                    dataType: "json",
                    url: strURL,
                    success: function (response) {
                        select_item(response);
                    }
                });
            });

            $("#search_hospital_btn").click(function () {
                var base_url = '<?= base_url()?>';
                var formData = $('#search_hospital_form').serialize();
                var ajaxurl = base_url + 'usermg/search_hospital?' + formData;
                table.ajax.url(ajaxurl).load();
            });
        });
    </script>