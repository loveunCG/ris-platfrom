<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">
            子医院审核 </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i> 子医院审核
                    </a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <span>子医院审核</span>
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
                            <span class="caption-subject font-green sbold uppercase">子医院审核</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="#" method="post" class="form-horizontal" id="search_hospital_form" novalidate>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 form-group form-md-line-input">
                                        <label class="col-lg-4 col-md-4 control-label" for="form_control_1">医院编号 : </label>
                                        <div class="col-lg-7 col-md-8">
                                            <input type="text" class="form-control" id="s_hospital_code" name="equipment_type">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">请输入医院编号</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 form-group form-md-line-input">
                                        <label class="col-md-4 col-lg-4 control-label" for="form_control_1">医院名称:
                                        </label>
                                        <div class="col-md-8 col-lg-7">
                                            <input type="text" class="form-control" placeholder="" id="s_hospital_name" name="equipment_num">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">请输入医院名称</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 form-group form-md-line-input">
                                        <label class="col-md-2 col-lg-3 control-label" for="form_control_1">所属省会:</label>
                                        <div class="col-md-10 col-lg-9" data-toggle="distpicker">
                                            <div class="col-md-6 col-lg-6">
                                                <select class="form-control" name="location_sheng" data-province="---- 选择省 ----"></select>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <select class=" form-control" name="location_city" data-city="---- 选择市 ----"></select>
                                            </div>

                                        </div>
                                        <div class="form-control-focus"> </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 form-group form-md-line-input">
                                    <label class="control-label col-md-4 col-lg-5">添加时间:</label>
                                    <div class="col-md-8 col-lg-7">
                                        <input class="form-control form-control-inline input-medium " placeholder="01/01/2017" name="start_time" type="text" value=""
                                        />
                                        <!--										<span class="help-block"> 选择日期 </span>-->
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 form-group form-md-line-input">
                                    <label class="control-label col-lg-5 col-md-4">至</label>
                                    <div class="col-md-8 col-lg-7">
                                        <input class="form-control form-control-inline input-medium " placeholder="01/01/2017" name="end_time" type="text" value=""
                                        />
                                        <!--										<span class="help-block"> 选择日期 </span>-->
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 form-group form-md-line-input">
                                    <label class="col-md-4 col-lg-5 control-label" for="form_control_1">状态</label>
                                    <div class="col-md-8 col-lg-7">
                                        <select class="form-control" id="s_hospital_status" name="hospital_status">
                                            <option value="">请选择</option>
                                            <option value="3">审核通过</option>
                                            <option value="1">未审核</option>
                                            <option value="2">未通过</option>
                                        </select>
                                        <div class="form-control-focus"> </div>

                                    </div>
                                </div>
                                <div class="col-lg-2 col-offset-md-3 col-offset-xs-6 col-offset-sm-6 col-md-6 col-sm-6 col-xs-6 form-group form-md-input">
                                    <button type="button"  class="btn  pull-left yellow" id="search_hospital_btn">
                                        <i class="fa fa-search"></i>查询</button>
                                    <button type="button" class="btn pull-right blue" onclick="search_clear()">
                                        <i class="fa fa-refresh"></i>重置</button>
                                </div>
                            </div>
                        </form>
                    </div>
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

                        </div>
                    </div>

                    <div class="portlet-body">
                        <div id="result_notification"></div>
                        <div class="clearfix">
                            <input type="hidden" id="hospital_id" value="">
                            <div class="row">
                                <div class="col-md-offset-1 col-md-2">
                                    <button type="button" class="btn green-haze pull-left" data-target="#add_user" disabled id="hospital_deliberation" data-toggle="modal">
                                        <span class="glyphicon glyphicon-envelope"> </span>审核</button>
                                </div>
                                <div id="add_user" class="modal fade" tabindex="-1" data-focus-on="input:first">
                                    <div class="portlet portlet-sortable box blue">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <span class="caption-subject font-light sbold uppercase">审核详情</span>
                                            </div>
                                            <div class="actions">
                                                <a data-dismiss="modal" class="btn btn-circle btn-icon-only" onclick="AddUserClose()" href="javascript:;">
                                                    <i class="fa fa-close"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <!-- BEGIN FORM-->
                                            <form action="#" method="post" id="hospital_deli">

                                                <div class="form-body col-md-12">
                                                    <div id="result_notification3">
                                                    </div>
                                                    <div class="alert alert-success display-hide">
                                                        <button class="close" data-close="alert"></button>您的表单验证成功！ </div>
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-12 form-md-line-input ">
                                                            <input type="text" name="hospital_name" readonly autocomplete="off" class="form-control" id="hospital_name">
                                                            <label for="form_control_1">医院名称</label>
                                                            <span id="error_message" class="help-block">請輸入医院名称</span>
                                                        </div>
                                                    </div>
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-12 form-md-line-input ">
                                                            <input type="text" class="form-control" readonly name="location_detail" id="location_detail">
                                                            <label for="form_control_1">医院地址</label>
                                                            <span class="help-block">请输入地址</span>
                                                        </div>
                                                    </div>

                                                    <div class="row col-md-12 ">
                                                        <div class="form-group  col-md-12 form-md-line-input">
                                                            <input type="text" class="form-control" readonly id="location_sheng" name="location_sheng">
                                                            </select>
                                                            <label for="form_control_1">所属省会</label>
                                                        </div>
                                                        <div class="form-group  col-md-12 form-md-line-input">
                                                            <input type="text" class="form-control" readonly id="location_city" name="location_city">
                                                            </select>
                                                            <label for="form_control_1">所属地区</label>
                                                        </div>
                                                    </div>

                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-12 form-md-line-input ">
                                                            <input type="text" class="form-control" readonly name="add_time" id="add_time" vlaue="<?=date('Y-m-d')?>">
                                                            <label for="form_control_1">申请时间</label>
                                                            <span class="help-block">请输入申请时间</span>
                                                        </div>
                                                    </div>
                                                    <div class="row col-md-12">
                                                        <div class="form-group form-md-line-input ">
                                                            <select class="form-control" id="deli_recommend" name="deli_recommend">
                                                                <option value="">请选择</option>
                                                                <option value="3">审核通过</option>
                                                                <option value="2">未通过</option>
                                                                <option value="1">未审核</option>
                                                            </select>
                                                            <label for="form_control_1">审核人意见</label>
                                                        </div>
                                                    </div>
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-12 form-md-line-input ">
                                                            <input type="text" class="form-control" readonly name="hospital_code" id="hospital_code">
                                                            <label for="form_control_1">医院编号</label>
                                                            <span class="help-block">请输入医院编号</span>
                                                        </div>
                                                    </div>
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-12 form-md-line-input ">
                                                            <input type="text" class="form-control" name="deli_remark" id="deli_remark">
                                                            <label for="form_control_1">备注</label>
                                                            <span class="help-block">请输入备注</span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-offset-1 col-md-10">
                                                            <button type="submit" id="submit_button" class="btn blue-soft pull-left">
                                                                <span class="glyphicon glyphicon-send"> </span>审核</button>
                                                            <a href="javascript:;" data-dismiss="modal" onclick="AddUserClose()" class="btn red-soft pull-right">
                                                                <span class="glyphicon glyphicon-log-out"> </span>返回</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="hospital_req_table">
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
        var table = [];

        function AddUserClose() {
            $('#add_user').find('.help-block-error').remove();
            $('#add_user').find('.form-group').removeClass('has-error');
        }

        function select_item(val) {
            var hospital_id = val.hospital_id;
            var hospital_code = val.hospital_code;
            var hospital_name = val.hospital_name;
            var location_sheng = val.location_sheng;
            var location_city = val.location_city;
            var location_detail = val.location_detail;
            var deli_recommend = val.deli_recommend;
            var hospital_status = val.hospital_status;
            $('#hospital_id').val(hospital_id);
            $('#hospital_code').val(hospital_code);
            $('#location_sheng').val(location_sheng);
            $('#hospital_name').val(hospital_name);
            $('#location_detail').val(location_detail);
            $('#deli_recommend').val(deli_recommend).change();
            $('#location_city').val(location_city);
            $('#hospital_status').val(hospital_status);
            $('#add_time').val('<?=date("Y-m-d h:i:s")?>');
            if (hospital_status == '1') {
                $("#hospital_deliberation").removeAttr("disabled").html(
                    '<span class="glyphicon glyphicon-envelope"> </span>审核');

            } else if (hospital_status == '2') {
                $("#hospital_deliberation").removeAttr("disabled").html(
                    '<span class="glyphicon glyphicon-envelope"> </span>再审核');

            } else {
                $("#hospital_deliberation").attr("disabled", 'true');


            }
        }

        function hospital_deliproc() {
            var base_url = '<?=base_url()?>';
            var strURL = base_url + "usermg/hospital_deli/";
            var hospital_id = $("#hospital_id").val();
            var hospital_name = $("#hospital_name").val();
            var location_sheng = $("#location_sheng").val();
            var location_city = $("#location_city").val();
            var deli_recommend = $("#deli_recommend").val();
            var deli_remark = $("#deli_remark").val();
            var location_detail = $("#location_detail").val();
            $.post(strURL, {
                hospital_name: hospital_name,
                location_sheng: location_sheng,
                location_city: location_city,
                location_detail: location_detail,
                deli_recommend: deli_recommend,
                deli_remark: deli_remark,
                hospital_id: hospital_id
            }).done(function (data) {
                if (data) {
                    $.alert({
                        title: '报告!',
                        content: '医院已审核!',
                        columnClass: 'small',
                        theme: 'material',
                        icon: 'fa fa-check-square',
                        buttons: {
                            ok: function () {
                                location.reload();
                            }
                        }
                    });
                } else {

                }
            });
        };

        function search_clear() {
            $('#search_hospital_form')[0].reset();
        };


        $(document).ready(function () {
            var hospital_req = '<?=base_url()?>' + 'usermg/hospital_req';
            table = $('#hospital_req_table').DataTable({
                "ajax": hospital_req,
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
            table.buttons().remove();
            $('#hospital_req_table tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
                var device_id = $(this).find('.device_id').val();
                var base_url = '<?=base_url()?>';
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
                var base_url = '<?=base_url()?>';
                var formData = $('#search_hospital_form').serialize();
                var ajaxurl = base_url + 'usermg/hospital_req?' + formData;
                table.ajax.url(ajaxurl).load();
            });

        });
    </script>
