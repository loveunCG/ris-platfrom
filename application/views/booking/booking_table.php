<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">
            <?=$menutitle?>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <?=$this->lang->line('booking')?>
                        </a>
                        <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <span>
                    病人列表
                    </span>
                </li>
            </ul>
        </div>
        <div class="full-height-content">
            <div class="full-height-content-body " id="sortable_portlets">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet  portlet-sortable box blue-madison">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-magnifier"></i>
                                    <span class="caption-subject font-light sbold uppercase">查询条件</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <form action="#" method="post" id="patient_search">
                                <div id = "notification_result"></div>
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 form-group form-md-line-input">
                                                <label class="col-lg-3 col-md-5 control-label" for="form_control_1"><?=$this->lang->line('image_num')?>
                                        </label>
                                                <div class="col-lg-9 col-md-7">
                                                    <input type="text" class="form-control" name="image_num" id="image_num">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 form-group form-md-line-input">
                                                <label class="col-md-4 control-label" for="form_control_1"><?=$this->lang->line('name')?>
                                        </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="patient_name" id="patient_name">
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">输入您的姓名</span>
                                                </div>
                                            </div>

                                            <div class="col-md-3 form-group form-md-line-input">
                                                <label class="col-md-4 control-label" for="form_control_1"><?=$this->lang->line('age')?>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="patient_age" id="patient_age">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 form-group form-md-line-input">
                                                <label class="col-md-4 control-label" for="form_control_1"><?=$this->lang->line('gender')?></label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="patient_gender" id="patient_gender">
                                                <option value="">请选择</option>
                                                <option value="0"  <?php if($patient_gender=="0") echo "selected" ;?>><?=$this->lang->line('man')?></option>
                                                <option value="1" <?php if($patient_gender=="1") echo "selected" ;?>><?=$this->lang->line('woman')?></option>
                                            </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 form-group form-md-line-input">
                                                <label class="col-lg-3 col-md-6 control-label" for="form_control_1">设备类型</label>
                                                <div class="col-lg-9 col-md-6">
                                                    <select class="form-control" name="device_type" id="device_type">
                                                <option value="">请选择</option>
                                                <?php foreach ($all_device_info as $value) {
                                                  if ($device_type == $value->equipment_type) {
                                                    $status = 'selected';
                                                    # code...
                                                  }
                                                  echo '<option value="'.$value->equipment_type.'" '.$status.'>'.$value->equipment_type.'</option>';
                                                  # code...
                                                }?>
                                            </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4 form-group form-md-line-input">
                                                <label class="col-lg-3 col-md-6 control-label" for="form_control_1"><?=$this->lang->line('patient_source')?></label>
                                                <div class="col-lg-9 col-md-6">
                                                    <select class="form-control" name="patient_source" id="patient_source">
                                                <option value="">请选择</option>
                                                <option value="0"  <?php if($patient_source=="0") echo "selected" ;?>>门诊</option>
                                                <option value="1"  <?php if($patient_source=="1") echo "selected" ;?>>住院</option>
                                                <option value="2"  <?php if($patient_source=="2") echo "selected" ;?>>体检</option>
                                            </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4 form-group form-md-line-input">
                                                <label class="col-lg-3 col-md-6 control-label" for="form_control_1">远程咨询</label>
                                                <div class="col-lg-9 col-md-6">
                                                    <select class="form-control" name="remote_status" id="remote_status">
                                                <option value="">请选择</option>
                                                <option value="1" <?php if($remote_status=="1") echo "selected" ;?>>是</option>
                                                <option value="0" <?php if($remote_status=="0") echo "selected" ;?>>否</option>

                                            </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 form-group form-md-line-input">
                                                <label class="col-md-4 control-label" for="form_control_1">时间</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-inline" name="start_time" id="from">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 form-group form-md-line-input">
                                                <label class="col-md-4 control-label" for="form_control_1">到</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-inline" name="end_time" id="to">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>

                                            <div class="col-md-offset-2 col-md-3 form-group form-md-input">
                                                <button type="button" class="btn col-md-3 blue pull-left" id="booking_table_search"><span class="glyphicon glyphicon-search"> </span>查询</button>
                                                <button type="button" onclick="search_clear()" class="btn col-md-3 pull-right blue "><span class="glyphicon glyphicon-refresh"> </span>重置</a>
                                            </div>


                                        </div>


                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="portlet  portlet-sortable box blue-madison">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class=" icon-layers font-light"></i>
                                    <span class="caption-subject font-light sbold uppercase">病人信息列表</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" style="text-align: center;" id="booking_table">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">序号</th>
                                            <th style="text-align: center;">病人编号</th>
                                            <th style="text-align: center;">姓名</th>
                                            <th style="text-align: center;">年龄</th>
                                            <th style="text-align: center;">性别</th>
                                            <th style="text-align: center;">检查项目</th>
                                            <th style="text-align: center;">远程咨询</th>
                                            <th style="text-align: center;">身份证号</th>
                                            <th style="text-align: center;">检查日期</th>
                                            <th style="text-align: center;">病人来源</th>
                                            <th style="text-align: center;">接入医院</th>
                                            <th style="text-align: center;">申请医生</th>
                                            <th style="text-align: center;">报告医生</th>
                                            <th style="text-align: center;">操作</th>
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
var table ='';
    function search_clear() {
        $('#patient_search')[0].reset();
        table.ajax.reload();
    };

    function delete_patient(val){
         var strUrl = '<?=base_url()?>'+'booking/delete_patient/'+val;
         $.confirm({
            title: '警告',
            content: '你真这个病人信息吗?',
            theme: 'dark',
            autoClose: 'chancel|10000',
            columnClass: 'small',
            draggable: true,
            buttons: {
                confirm: {
                    text: '是',
                    keys: ['shift', 'alt'],
                    action: function () {
                        $.ajax({
                            dataType: "json",
                            url: strUrl,
                            success: function (response) {
                                $.alert({
                                    title: '成功!',
                                    columnClass: 'small',
                                    content: '已成功删除了！.',
                                    columnClass: 'small',

                                });
                                table.ajax.reload();
                                $(this).remove();
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


    }

    $(document).ready(function () {
        var booking_table_url = '<?=base_url()?>' + 'booking/booking_table';
        table = $('#booking_table').DataTable({
            "ajax": booking_table_url,
            "ordering": false,
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
        $("#booking_table_search").click(function () {
            var base_url = '<?=base_url()?>';
            var formData = $('#patient_search').serialize();
            var ajaxurl = base_url + 'booking/booking_table?' + formData;
            table.ajax.url(ajaxurl).load();
        });
    });
</script>
