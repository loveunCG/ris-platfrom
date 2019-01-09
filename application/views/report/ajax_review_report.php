<!-- BEGIN CONTENT BODY -->
<link href="<?=base_url()?>assets/global/css/iziModal.min.css" rel="stylesheet" type="text/css" />

<div class="row" id="sortable_portlets">
    <div class="col-md-12 column sortable">
            <div class="row">
            <div class="col-md-12">
                <div class="portlet portlet-sortable box blue-madison ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-magnifier"></i>
                            <span class="caption-subject font-light sbold uppercase">查询条件</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div action="#" method="post" class="form-horizontal" id="search_report_form">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 form-group form-md-line-input">
                                    <form id="searchByTimeform">
                                        <label class="col-md-2 control-label" for="form_control_1">
                                            检查时间:
                                        </label>
                                        <div class="col-md-1">
                                            <select class="form-control" name="time_type">
                                                <option value="1">登记时间</option>
                                                <option value="2">检查时间</option>
                                                <option value="3">预约时间</option>
                                            </select>
                                            <span class="help-block">请输入姓名</span>
                                        </div>
                                        <div class="clearfix col-md-3">
                                            <input type="hidden" name="searchdate" id = "search_date"/>
                                            <button type="button" onclick="serachbydate(1)" class="btn  blue-madison">今天</button>
                                            <button type="button" onclick="serachbydate(2)" class="btn  blue-madison">昨天</button>
                                            <button type="button" onclick="serachbydate(3)" class="btn  blue-madison">最近3天</button>
                                            <button type="button" onclick="serachbydate(4)" class="btn  blue-madison">最近7天</button>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="col-md-3 control-label" for="form_control_1">时间</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control date-picker" name="start_time" placeholder="01/01/2017">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="col-md-3 control-label" for="form_control_1">到</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control date-picker" name="end_time" placeholder="01/01/2017">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <form id = "search_by_device_type_form">
                                    <div class="col-lg-12 col-md-12 form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">
                                            设备类型：
                                        </label>
                                        <div class="col-md-9">
                                            <div class="clearfix">
                                                <button type="button" onclick="search_by_device_type()" class="btn blue-madison ">
                                                    全部
                                                </button>
                                                <?php foreach ($device_class as $values) : ?>
                                                <button type="button" onclick="search_by_device_type('<?=$values->equipment_type?>')" class="btn blue-madison ">
                                                    <?=$values->equipment_type?>
                                                </button>
                                                <?php endforeach;?>
                                                <input type="hidden" name="checkup_type" id = "search_check_type" />

                                                <button type="button" class="btn yellow pull-right" onclick="searchByTime()">
                                                    <span class="glyphicon glyphicon-search"> </span>查询</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <form id="search_by_treat_status_form">
                                    <div class="col-lg-12 col-md-12 form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">
                                            医疗状态：
                                        </label>
                                        <div class="col-md-9">
                                            <div class="clearfix">
                                                <button type="button" onclick="search_by_treat_status()" class="btn blue-madison ">全部
                                                </button>
                                                <?php foreach ($bk_status as $values) : ?>
                                                    <?php if (!$values->person) :
                                                        continue;
                                                    endif;?>
                                                <button type="button" onclick="search_by_treat_status('<?=$values->status?>')" class="btn blue-madison ">
                                                    <?=$values->name?>
                                                </button>
                                                <?php endforeach;?>
                                                <input type="hidden" name="checkup_status" id="search_checkup_status" />
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
        <div class="row">
            <div class="col-md-12">
                <div class="portlet portlet-sortable box blue-madison portlet-datatable ">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="glyphicon glyphicon-list-alt"> </span>
                            <span class="caption-subject font-light sbold uppercase">报告列表</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="clearfix" style="margin-left: 10%;">
                        </div>
                        <table class="table table-striped table-bordered table-hover" style="text-align: center;" id="report_table_info">
                            <thead>
                                <tr>
                                    <th style="text-align: center;width: 8%">操作 </th>
                                    <th style="text-align: center;">序号</th>
                                    <th style="text-align: center;">医疗状态</th>
                                    <th style="text-align: center;">病人姓名</th>
                                    <th style="text-align: center;">性别</th>
                                    <th style="text-align: center;">年龄</th>
                                    <th style="text-align: center;">检查类型</th>
                                    <th style="text-align: center;">检查项目</th>
                                    <th style="text-align: center;">报告医生</th>
                                    <th style="text-align: center;">医院申请医生</th>
                                    <th style="text-align: center;">远程来源</th>
                                    <th style="text-align: center;">接入医院</th>
                                    <th style="text-align: center;">诊断报告时间</th>
                                    <th style="text-align: center;">审核报告时间</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="report_detail_view_modal" data-iziModal-icon="icon-home"/>
<script src="<?=base_url()?>assets/global/scripts/iziModal.min.js" type="text/javascript"></script>
    <script>
        let table = [];
        var base_url = '<?=base_url()?>';
        function make_report(chc_id) {
            var base_url = '<?=base_url()?>';
            var strURL = base_url + "report/dicomProc/" + chc_id;
            var win = window.open(strURL, '_blank');
            var strURL = base_url + "report/reporting/" + chc_id;
            window.location.href = strURL;
            win.focus();
        }

        function reporting_detail_view(chc_id){
            $("#report_detail_view_modal");
            let settings = {
                    "url": base_url+'report/ajax_report_detail_view/'+chc_id,
                    "method": "get"
            };
            $('#report_detail_view_modal').iziModal({
                padding: 15,
                theme: 'material',
                closeButton: true,
                title: '详细信息',
                onOpening: function(modal){
                        modal.startLoading();
                        $.ajax(settings).done(function (response) {
                            // console.log(response)
                            $("#report_detail_view_modal .iziModal-content").html(response);
                            modal.stopLoading();
                        });
                }
            });
            $('#report_detail_view_modal').iziModal('open');
        }

        function clear_search(){
            $('#search_by_device_type_form')[0].reset();
            $('#search_by_treat_status_form')[0].reset();
            $('#searchByTimeform')[0].reset();
            table.ajax.reload();
        }

        function edit_report(chc_id){
            var strURL = base_url + "report/reporting/" + chc_id;
            window.location.href = strURL;
        }

        function remote_contact_proc() {
            var booking_id = $('#booking_id').val();
            var strURL = '<?=base_url()?>contact/select/' + booking_id;
            window.location.href = strURL;
        }

        function review(report_id){

        }

        function searchByTime() {
            var form_data = $('#searchByTimeform').serialize();
            var base_url = '<?=base_url()?>';
            var ajaxurl = base_url + 'report/search_review_report?' + form_data;
            console.log(ajaxurl)
            table.ajax.url(ajaxurl).load();
        }

        function dicom_view(chc_id) {
                var base_url = '<?=base_url()?>';
                var strURL = base_url + "report/dicomProc/" + chc_id;
                var win = window.open(strURL, '_blank');
                win.focus();
        };

        function reportView(chc_id){
            var strURL = base_url + "report/reporting_view/" + chc_id;
            window.location.href = strURL;
        }

        function contact_proc() {
            var booking_id = $("#booking_id").val();
            var base_url = '<?=base_url()?>';
            var strURL = base_url + "contact/" + booking_id;
            window.location.href = strURL;

        };

        function report_detail_view() {
            var booking_id = $("#booking_id").val();
            var base_url = '<?=base_url()?>';
            var strURL = base_url + "report/reporting_view/" + booking_id;
            window.location.href = strURL;

        };

        function search_clear() {
            $('#detail_search_view_field')[0].reset();
        };

        function serachbydate(param){
            $('#search_date').val(param);
            var form_data = $('#searchByTimeform').serialize();
            var base_url = '<?=base_url()?>';
            var ajaxurl = base_url + 'report/search_review_report?' + form_data;
            console.log(ajaxurl)
            table.ajax.url(ajaxurl).load();
            $('#search_date').val(null);

        }

        function search_by_device_type(param){
            $('#search_check_type').val(param);
            var form_data = $('#search_by_device_type_form').serialize();
            var base_url = '<?=base_url()?>';
            var ajaxurl = base_url + 'report/search_review_report?' + form_data;
            console.log(ajaxurl)
            table.ajax.url(ajaxurl).load();
        }

        function search_by_treat_status(param){
            $('#search_checkup_status').val(param);
            var form_data = $('#search_by_treat_status_form').serialize();
            var base_url = '<?=base_url()?>';
            var ajaxurl = base_url + 'report/search_review_report?' + form_data;
            console.log(ajaxurl)
            table.ajax.url(ajaxurl).load();
        }

        $(document).ready(function () {
            var tbl_usr_info = '<?=base_url()?>' + 'report/search_review_report';
            console.log(tbl_usr_info);
            table = $('#report_table_info').DataTable({
                "ajax": tbl_usr_info,
                dom: 'Bfrtip',
                "ordering": false,
                select: true,
                "searching": false,
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
                lengthMenu: [
                    [10, 15, 20, -1],
                    [10, 15, 20, "All"]
                ],
                pageLength: 10,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                pagingType: "bootstrap_full_number",
                columnDefs: [{
                    orderable: !1,
                    targets: [0]
                }, {
                    searchable: !0,
                    targets: [0]
                }]
            });
            var toggle_search_button = true;
            table.buttons().remove();

            $('input[type=radio][name=data_type]').change(function () {
                console.log(this.value)
            });

            $("#search_report_btn").click(function () {
                var base_url = '<?=base_url()?>';
                var formData = $('#detail_search_view_field').serialize();
                var ajaxurl = base_url + 'report/search_review_report?' + formData;
                table.ajax.url(ajaxurl).load();
            });
            $('#detail_search_view_field').hide();

            $(".date-picker").datepicker({
                    rtl: App.isRTL(),
                    orientation: "left",
                    autoclose: !0
            });

            $('#detail_search_view').click(function () {
                if (toggle_search_button) {
                    toggle_search_button = false
                    $('#detail_search_view_field').show();
                    $('#detail_search_view').html('<span class="glyphicon glyphicon-search"> </span>收起查询')
                } else {
                    toggle_search_button = true;
                    $('#detail_search_view_field').hide();
                    $('#detail_search_view').html('<span class="glyphicon glyphicon-search"> </span>更多查询')
                }

            })
        });

    </script>
