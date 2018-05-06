<div class="page-content-wrapper">
    <div class="page-content">

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
                    <span>我的咨询</span>
                </li>
            </ul>

        </div>
        <!-- BEGIN CONTENT BODY -->
        <div class="full-height-content full-height-content-scrollable">
            <div class="full-height-content-body" id="sortable_portlets">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet portlet-sortable light portlet-fit">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-magnifier"></i>
                                    <span class="caption-subject font-light sbold uppercase">咨询查询</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <!-- BEGIN FORM-->
                                <form action="#" method="post" class="form-horizontal" id="search_contact_info_form">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-3 form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1"><?=$this->lang->line('name')?>:
                                              </label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="patient_name" name="patient_name">
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">请输入姓名</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1"><?=$this->lang->line('age')?>:
                                              </label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="" id="patient_age" name="patient_age">
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">请输入<?=$this->lang->line('age')?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1"><?=$this->lang->line('gender')?>:</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" id="patient_gender" name="patient_gender">
                                                      <option value="">请选择</option>
                                                      <option value="1">男</option>
                                                      <option value="0">女</option>
                                                  </select>
                                                    <div class="form-control-focus"> </div>

                                                </div>
                                            </div>
                                            <div class="col-md-3 form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">咨询状态:</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" id="contact_status" name="contact_status">
                                                      <option value="">请选择</option>
                                                      <option value="1">已提交</option>
                                                      <option value="2">草稿</option>
                                                      <option value="3">已接受</option>
                                                      <option value="4">已拒绝</option>
                                                      <option value="5">已结束</option>
                                           </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 form-group form-md-line-input">
                                                <label class="control-label col-md-4">发起时间：</label>
                                                <div class="col-md-8">
                                                    <input class="form-control form-control-inline input-medium " id="start_time" name="start_time" size="27" type="text" value=""
                                                    />
                                                    <span class="help-block"> 选择日期 </span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 form-group form-md-line-input">
                                                <label class="control-label col-md-3">至</label>
                                                <div class="col-md-9">
                                                    <input class="form-control form-control-inline input-medium " id="end_time" name="end_time" size="20" type="text" value=""
                                                    />
                                                    <span class="help-block"> 选择日期 </span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">咨询类型:</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" id="contact_type" name="contact_type">
                                                      <option value="">请选择</option>
                                                      <option value="1">远程会珍</option>
                                                      <option value="2">远程门诊</option>
                                           </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class=" col-md-3 form-group form-md-input">
                                                <button type="button" class="btn col-md-offset-2 col-md-4 blue yellow" id="search_contact_info"><i class="fa fa-search"></i>查询</button>
                                                <button type="button" class="btn col-md-offset-2 col-md-4 blue" onclick="search_clear()"><i class="fa fa-refresh"></i>重置</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light portlet-sortable portlet-fit portlet-datatable ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class=" icon-layers font-green"></i>
                                    <span class="caption-subject font-green sbold uppercase">我的咨询</span>
                                </div>
                            </div>
                            <div class="clearfix col-md-offset-1">
                                <button type="button" onclick="contactDetail()" disabled id="contactDetail_btn" class="btn dark  sbold uppercase"><span class="glyphicon glyphicon-th-list"> </span>查看</button>
                                <button type="button" onclick="EditContact()" disabled id="EditContact_btn" class="btn dark  sbold uppercase"><span class="glyphicon glyphicon-pencil"> </span>编辑</button>
                                <button type="button" class="btn red" disabled id="deleteContact"><span class="glyphicon glyphicon-trash"> </span>删除</button>
                                <button type="button" class="btn blue col-md-offset-6 sbold uppercase" disabled id="StartContact_btn"><span class="glyphicon glyphicon-play"> </span>开始会诊</button>

                                <input type="hidden" id="contact_id" />

                            </div>

                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" style="text-align: center;" id="contact_info_table">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">序号</th>
                                            <th style="text-align: center;">会诊编号</th>
                                            <th style="text-align: center;">咨询状态</th>
                                            <th style="text-align: center;">姓名</th>
                                            <th style="text-align: center;">性别</th>
                                            <th style="text-align: center;">年龄</th>
                                            <th style="text-align: center;">远程专家</th>
                                            <th style="text-align: center;">远程预约开始时间</th>
                                            <th style="text-align: center;">远程预约结束时间</th>
                                            <th style="text-align: center;">远程咨询发起时间</th>
                                            <th style="text-align: center;">咨询类别</th>

                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function search_clear() {
        $('#search_contact_info_form')[0].reset();
    }
    var table = '';
    $(document).ready(function () {
        var tbl_usr_info = '<?=base_url()?>' + 'contact/search_my_contact';
        table = $('#contact_info_table').DataTable({
            "ajax": tbl_usr_info,
            dom: 'Bfrtip',
            "ordering": false,
            "ordering": false,
            "searching": false,
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
                className: "btn dark ",
                text: "打印"
            }, {
                extend: "copy",
                className: "btn red ",
                text: "复制"

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
                targets: [0]
            }],
            order: [
                [0, "asc"]
            ]
        });
        table.buttons().remove();
        $('#return_contact_btn').confirm({
            title: '提示',
            content: '是否要提交撤回申请？',
            icon: 'fa fa-warning',
            theme: 'dark',
            buttons: {
                confirm: {
                    text: '是',
                    keys: ['shift', 'alt'],
                    action: function () {
                        var contact_id = $('#contact_id').val();
                        var base_url = '<?= base_url() ?>';
                        var strURL = base_url + "contact/set_contact_status/" + contact_id;
                        $.ajax({
                            dataType: "json",
                            url: strURL,
                            success: function (response) {
                                $.alert("已成功撤回！");
                                table.ajax.reload();


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
        $('#contact_info_table tbody').on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
            var data = table.row(this).data();
            var device_id = $(this).find('.contact_id').val();
            var base_url = '<?= base_url() ?>';
            var strURL = base_url + "contact/get_contact_info/" + device_id;
            $.ajax({
                dataType: "json",
                url: strURL,
                success: function (response) {
                    select_contact(response);
                }
            });
        });

        $("#search_contact_info").click(function () {
            var base_url = '<?=base_url()?>';
            var formData = $('#search_contact_info_form').serialize();
            var ajaxurl = base_url + 'contact/search_my_contact?' + formData;
            table.ajax.url(ajaxurl).load();
        });
        $('#deleteContact').click(function () {
            var contact_id = $('#contact_id').val();
            var base_url = '<?=base_url()?>';
            var strURL = base_url + "contact/deleteContact/" + contact_id;
            $.confirm({
                title: '提示',
                content: ' 确定要删除吗？',
                icon: 'fa fa-warning',
                theme: 'dark',
                autoClose: 'chancel|10000',
                draggable: true,
                buttons: {
                    confirm: {
                        text: '是',
                        keys: ['shift', 'alt'],
                        action: function () {
                            $.ajax({
                                dataType: "json",
                                url: strURL,
                                success: function (response) {
                                    $.alert("已成功删除！");
                                    table.ajax.reload();

                                }
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


        $('#StartContact_btn').click(function () {
            var base_url = '<?= base_url() ?>';
            var strURL = base_url + "contact/contactRoom/" + $('#contact_id').val();
            window.location.href = strURL;
        });
    });

    function select_contact(val) {
        var isvalued = $('#contact_id').val(val.contact_id).val();
        $('#deleteContact').removeAttr('disabled');
        $('#EditContact_btn').removeAttr('disabled');
        $('#return_contact_btn').removeAttr('disabled');

        if (isvalued) {
            $('#contactDetail_btn').removeAttr('disabled');

        } else {
            $('#contactDetail_btn').attr('disabled', 'true');

        }
        if (val.contact_status == '4') {
            $('#return_contact_btn').removeAttr('disabled');

        } else if (val.contact_status == '3') {
            $('#StartContact_btn').removeAttr('disabled');
            $('#EditContact_btn').attr('disabled', 'true');

        } else {
            $('#return_contact_btn').attr('disabled', 'true');
        }
    }

    function EditContact() {
        var base_url = '<?= base_url() ?>';
        var strURL = base_url + "contact/editContactInfo/" + $('#contact_id').val();
        window.location.href = strURL;

    }

    function contactDetail() {
        var base_url = '<?= base_url() ?>';
        var strURL = base_url + "contact/contactDetail/" + $('#contact_id').val();
        window.location.href = strURL;
    }
</script>