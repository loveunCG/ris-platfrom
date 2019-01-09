<script src="<?=base_url()?>assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/horizontal-timeline/horozontal-timeline.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">
            数据统计与分析
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i> 数据统计与分析
                    </a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <span>每日远程咨询统计</span>
                </li>
            </ul>
        </div>
        <div class="row" id="sortable_portlets">
            <div class="col-md-12 column sortable">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet portlet-sortable box blue-madison ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class=""></i>
                                    <span class="caption-subject font-light sbold uppercase">每日远程咨询统计</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <!-- BEGIN FORM-->
                                    <form action="#" method="post" class="form-horizontal" id="search_form">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 form-group form-md-line-input">
                                                    <label class="col-lg-4 col-md-4 control-label">
                                                        登记日期
                                                    </label>
                                                    <div class="col-lg-3 col-md-3">
                                                        <input type="text" class="form-control form-control-inline" placeholder="01/01/2017" name="start_time">
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                                    <label class="col-lg-1 col-md-1 control-label">
                                                        至
                                                    </label>
                                                    <div class="col-lg-3 col-md-3">
                                                        <input type="text" class="form-control form-control-inline" placeholder="01/01/2017" name="end_time">
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 form-group form-md-line-input">
                                                    <label class="col-lg-5 col-md-6  control-label">
                                                        申请医院
                                                    </label>
                                                    <div class="col-lg-7 col-md-6">
                                                        <input type="text" class="form-control" placeholder="请输入" id="hospital_name" name="hospital_name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 form-group form-md-line-input">
                                                    <label class="col-lg-5 col-md-6 control-label">
                                                        咨询类型
                                                    </label>
                                                    <div class="col-lg-7 col-md-6">
                                                        <select class="form-control" id="patient_source" name="contact_type">
                                                            <option value="">全部</option>
                                                            <option value="0">远程会诊</option>
                                                            <option value="1">远程门诊</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-3 form-group form-md-line-input">
                                                    <button type="button" class="pull-left btn col-md-6 green" id="search_btn">
                                                        <span class="glyphicon glyphicon-search"> </span>查询</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 style="text-align: center; color: #32c5d2;"><b>每日远程咨询统计</b></h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="btn-group col-lg-offset-10 col-md-offset-9">
                                        <button type="button" class="btn btn-success" id="column" value="1" onclick="setType(this.value);">条形图</button>
                                        <button type="button" class="btn btn-default" id="line" value="2" onclick="setType(this.value);">折线图</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="register_chart" class="CSSAnimationChart"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-scrollable">
                                            <table class="table table-striped table-bordered table-hover" id="remote_table">
                                                <thead>
                                                <tr><th >序号</th><th>病人编号</th><th >姓名</th><th>性别</th><th>年龄</th><th>申请时间</th><th>申请医院</th>
                                                    <th>咨询类型</th><th>申请医师</th><th>审核医师</th><th>操作</th>
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
        </div>
    </div>
</div>
<script>
    var chart;
    $(document).ready(function () {
        $(function () {
            $.ajax({
                url: '<?=base_url()?>' + 'statistics/get_remote_amount',
                type: 'GET',
                dataType: 'json',
                data: '',
                cache: false,
                success: function(data){
                    chart=AmCharts.makeChart("register_chart", {
                        "type": "serial",
                        "categoryField": "date",
                        "startDuration": 1,
                        "fontSize": 12,
                        "theme": "light",
                        "categoryAxis": {
                            "autoRotateAngle": 0,
                            "gridPosition": "start",
                            "color": "#000000",
                            "fontSize": 15,
                            "minHorizontalGap": 70,
                            "minorTickLength": 0,
                            "title": "（日）",
                            "titleColor": "#32c5d2",
                            "titleFontSize": 13,
                            "titleRotation": 0
                        },
                        "graphs": [
                            {
                                "fillAlphas": 1,
                                "fillColors": "#32c5d2",
                                "id": "barGraph",
                                "labelText": "[[value]]",
                                "lineColor": "#32c5d2",
                                "minBulletSize": 8,
                                "showBalloon": false,
                                "type": "column",
                                "valueField": "people_num_1"
                            },
                            {
                                "bullet": "round",
                                "fillColors": "#32c5d2",
                                "id": "lineGraph",
                                "labelText": "[[value]]",
                                "lineColor": "#32c5d2",
                                "lineThickness": 2,
                                "valueField": "people_num_2",
                                "hidden":true
                            }
                        ],
                        "valueAxes": [
                            {
                                "axisTitleOffset": 0,
                                "id": "ValueAxis-1",
                                "autoRotateCount": 0,
                                "minHorizontalGap": 74,
                                "minVerticalGap": 34,
                                "title": "（次）",
                                "titleColor": "#32c5d2",
                                "integersOnly": true,
                                "titleRotation": 0
                            }
                        ],
                        "allLabels": [],
                        "balloon": {},
                        "dataProvider": data
                    });
                },
                error: function(request, textStatus, errorThrown){
                    alert('서버와 연결할수 없습니다.');
                }
            });

        });
        var tbl_usr_info = '<?=base_url()?>' + 'statistics/get_remote_data';
        var table = $('#remote_table').DataTable({
            ajax: tbl_usr_info,
            ordering: false,
            select: true,
            searching: false,
            language: {
                aria: {
                    sortAscending: ": activate to sort column ascending",
                    sortDescending: ": activate to sort column descending"
                },
                emptyTable: "没有数据",
                info: "显示 _START_ 到 _END_ 的 _TOTAL_ 条记录",
                infoEmpty: "找不到",
                search: "",
                lengthMenu: "显示 _MENU_",
                zeroRecords: "找不到匹配的记录",
                paginate: {
                    previous: "Prev",
                    next: "Next",
                    last: "Last",
                    first: "First"
                }
            },
            bStateSave: !0,
            columnDefs: [
              	{"className": "dt-center", "targets": "_all"},{
                targets: 0,
                orderable: !1,
                searchable: !0
            }],
            lengthMenu: [
                [10, 15, 20, -1],
                [10, 15, 20, "All"]
            ],
            pageLength: 10,
            pagingType: "bootstrap_full_number"            
        });

        $("#search_btn").click(function () {
            var base_url = '<?=base_url()?>';
            var formData = $('#search_form').serialize();
            var ajaxurl = base_url + 'statistics/search_remote_data?' + formData;
            console.log(ajaxurl)
            table.ajax.url(ajaxurl).load();

            $(function () {
                $.ajax({
                    url: '<?=base_url()?>' + 'statistics/search_remote_amount?' + formData,
                    type: 'GET',
                    dataType: 'json',
                    data: '',
                    cache: false,
                    success: function(data){
                        chart=AmCharts.makeChart("register_chart", {
                            "type": "serial",
                            "categoryField": "date",
                            "startDuration": 1,
                            "fontSize": 12,
                            "theme": "light",
                            "categoryAxis": {
                                "autoRotateAngle": 0,
                                "gridPosition": "start",
                                "color": "#000000",
                                "fontSize": 15,
                                "minHorizontalGap": 70,
                                "minorTickLength": 0,
                                "title": "（日）",
                                "titleColor": "#32c5d2",
                                "titleFontSize": 13,
                                "titleRotation": 0
                            },
                            "graphs": [
                                {
                                    "fillAlphas": 1,
                                    "fillColors": "#32c5d2",
                                    "id": "barGraph",
                                    "labelText": "[[value]]",
                                    "lineColor": "#32c5d2",
                                    "minBulletSize": 8,
                                    "showBalloon": false,
                                    "type": "column",
                                    "valueField": "people_num_1"
                                },
                                {
                                    "bullet": "round",
                                    "fillColors": "#32c5d2",
                                    "id": "lineGraph",
                                    "labelText": "[[value]]",
                                    "lineColor": "#32c5d2",
                                    "lineThickness": 2,
                                    "valueField": "people_num_2",
                                    "hidden":true
                                }
                            ],
                            "valueAxes": [
                                {
                                    "axisTitleOffset": 0,
                                    "id": "ValueAxis-1",
                                    "autoRotateCount": 0,
                                    "minHorizontalGap": 74,
                                    "minVerticalGap": 34,
                                    "title": "（次）",
                                    "titleColor": "#32c5d2",
                                    "integersOnly": true,
                                    "titleRotation": 0
                                }
                            ],
                            "allLabels": [],
                            "balloon": {},
                            "dataProvider": data
                        });
                    },
                    error: function(request, textStatus, errorThrown){
                        alert('not connected network.');
                    }
                });

            });
        });
    });
    function setType(type) {
        switch (type) {
            case '1':
                chart.graphs[0].hidden = false;
                chart.graphs[1].hidden = true;
                $('#column').removeClass('btn-default');
                $('#column').addClass('btn-success');
                $('#line').removeClass('btn-success');
                $('#line').addClass('btn-default');
                chart.validateNow();
                break;
            case '2':
                chart.graphs[0].hidden = true;
                chart.graphs[1].hidden = false;
                $('#column').removeClass('btn-success');
                $('#column').addClass('btn-default');
                $('#line').removeClass('btn-default');
                $('#line').addClass('btn-success');
                chart.validateNow();
                break;
        }
    }
</script>
