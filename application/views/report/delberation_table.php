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
                    <span>审核列表</span>
                </li>
            </ul>

        </div>
        <!-- BEGIN CONTENT BODY -->
        <div class="row" id="sortable_portlets">
          <div class="col-md-12 column sortable">

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet portlet-sortable box blue-madison ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-magnifier"></i>
                            <span class="caption-subject font-light sbold uppercase">检查条件</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="#" method="post" class="form-horizontal" id="search_report_form" novalidate>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1"><?=$this->lang->line('name')?>
                                                </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="patient_name" name="patient_name">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">请输入姓名</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1"><?=$this->lang->line('image_num')?>
                                                </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" id="image_num" name="image_num">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">请输入<?=$this->lang->line('image_num')?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3  form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1"><?=$this->lang->line('age')?>
                                                </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="patient_age" name="patient_age">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">请输入<?=$this->lang->line('age')?></span>

                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1"><?=$this->lang->line('gender')?></label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="patient_gender" name="patient_gender">
                                                        <option value="">请选择</option>
                                                        <option value="0">男</option>
                                                        <option value="1">女</option>
                                                    </select>
                                            <div class="form-control-focus"> </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1"><?=$this->lang->line('equipment_type')?></label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="checkup_equipment" name="checkup_equipment">
                                                        <option value="">请选择</option>
                                                        <?php
                                                        foreach ($device_class as $values) {
                                                          echo '<option value = "'.$values->equipment_type.'">'.$values->equipment_type.'</option>';
                                                        }
                                                         ?>

                                                    </select>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1"><?=$this->lang->line('report_status')?></label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="booking_status" name="booking_status">
                                                        <option value="">请选择</option>
                                                        <option value="3">已提交</option>
                                                        <option value="4">已审核</option>
                                                        <option value="5">回退审核</option>
                                            </select>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1"><?=$this->lang->line('remote_contact')?></label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="remote_status" name="remote_status">
                                                        <option value="">请选择</option>
                                                        <option value="1">是</option>
                                                        <option value="0">否</option>
                                            </select>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                    <div class=" col-md-3 form-group form-md-input">
                                        <button type="button" class="btn col-md-4 blue pull-left  yellow" id="search_report_btn"><span class="glyphicon glyphicon-search"> </span>检查</button>
                                        <button type="button" class="btn col-md-4 blue pull-right" onclick="search_clear()"><span class="glyphicon glyphicon-refresh"> </span>重置</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END VALIDATION STATES-->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="portlet portlet-sortable box blue-madison portlet-datatable ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-light sbold uppercase">审核列表</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="clearfix" style="margin-left: 10%;">
                          <button type="button" class="btn blue-hoki" id="deliberation_detail_view"  disabled onclick="deliberation_view()"><span class="glyphicon glyphicon-eye-open"> </span>查看</button>
                           <button type="button" disabled id= "make_deliberation_btn" onclick="make_deliberation()"  class="btn btn-primary"><span class="glyphicon glyphicon-send"> </span>审核</button>
                         </div>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="report_table_info">
                            <thead>
                                <tr>
                                    <th width="2%">序号 </th>
                                    <th width="5%">病人编号</th>
                                    <th width="5%">病人姓名</th>
                                    <th width="2%">性别</th>
                                    <th width="2%">年龄</th>
                                    <th width="5%">检查项目</th>
                                    <th width="5%">远程咨询</th>
                                    <th width="5%">接入医院</th>
                                    <th width="5%">身份证号</th>
                                    <th width="10%">检查日期</th>
                                    <th width="5%">申请医生</th>
                                    <th width="5%">报告状态</th>
                                    <th width="5%">报告医生</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- Begin: life time stats -->
                <div class="portlet portlet-sortable box blue-madison ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list-ol"></i>
                            <span class="caption-subject font-light sbold uppercase">  <?=$this->lang->line('past_checkup')?></span>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-hover" id="past_report_table">
                                <thead>
                                    <tr>
                                      <th scope="col"></th>
                                        <th scope="col">病人编号</th>
                                        <th scope="col">放射编号</th>
                                        <th scope="col">病人姓名</th>
                                        <th scope="col">性别</th>
                                        <th scope="col">年龄</th>
                                        <th scope="col">病人类型</th>
                                        <th scope="col">设备类型</th>
                                        <th scope="col">报告医生</th>
                                        <th scope="col">检查时间</th>
                                    </tr>
                                </thead>
                                <tbody id="past_report_body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End: life time stats -->
            </div>
            <div class="col-md-3">
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet portlet-sortable box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>
                            <?=$this->lang->line('image_expression')?>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
                            <strong> <?=$this->lang->line('image_expression')?>:</strong>
                            <br/> <span id="Imaging_performance"></span> </div>
                    </div>
                </div>
                <!-- END Portlet PORTLET-->

            </div>
            <div class="col-md-3">
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet portlet-sortable box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>
                            <?=$this->lang->line('impression')?>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
                            <strong> <?=$this->lang->line('impression')?>:</strong>
                            <br/> <span id="impression"></span> </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="booking_id" />
            <input type="hidden" id="buffer_booking_status" />
        </div>
      </div>
      </div>
    </div>
    <script>
  function make_deliberation() {
    var booking_id = $("#booking_id").val();
    var base_url = '<?= base_url()?>';
    var strURL = base_url + "report/deliberating/" + booking_id;
    window.location.href = strURL;

  }

  function past_checkup_info(val) {
      var base_url = '<?= base_url()?>';
      var booking_id = $("#booking_id").val(val.delivery_name).val();
      var booking_status = $('#buffer_booking_status').val(val.booking_status).val();
      if (booking_status == '3') {
        $("#make_deliberation_btn").removeAttr("disabled").html('<span class="glyphicon glyphicon-send"> </span>审核');

        $("#deliberation_detail_view").removeAttr("disabled");
      }else if(booking_status=='5'){
        $("#make_deliberation_btn").html('<span class="glyphicon glyphicon-send"> </span>再审核');
        $("#deliberation_detail_view").removeAttr("disabled");
        $("#make_deliberation_btn").removeAttr("disabled");
      }else{
        $("#deliberation_detail_view").removeAttr("disabled");
        $("#make_deliberation_btn").attr("disabled", "true");
      }


      var strURL = base_url + "report/past_get_report/" + booking_id;
      $.post(strURL).done(function (data) {
          report_data = JSON.parse(data);
          var display_data = "";
          if (report_data) {
              var count = Object.keys(report_data.tdata).length;
              for (var i = 0; i < count; i++) {
                  if (report_data.tdata[i].remote_status == '1') {
                      var remote_status = '<button type="button" class="btn btn-circle red">是</button>';
                  } else {
                      var remote_status = '<button type="button" class="btn btn-circle blue">否</button>';
                  }
                  if (report_data.tdata[i].patient_gender == '1') {
                      var gender = '<button type="button" class="btn btn-circle btn-icon-only red"><span aria-hidden="true" class="icon-symbol-female"></span></button>';
                  } else {
                      var gender = '<button type="button" class="btn btn-circle btn-icon-only yellow"><span aria-hidden="true" class="icon-symbol-male"></span></button>';
                  }
                  display_data += '<tr><td><label class="mt-radio mt-radio-single mt-radio-outline"><input type="radio" name=selected_past_report class="md-radiobtn" onchange="selected_past_report(this.value)" value="' +
                      report_data.tdata[i].report_id + '" /><span></span></label></td>';

                  display_data += "<td>" + report_data.tdata[i].patient_code + "</td>" + "<td>" + report_data.tdata[i].booking_code + "</td><td>" + report_data
                      .tdata[i].patient_name + "</td>" + "<td>" + gender +
                      "</td>" + "<td>" + report_data.tdata[i].patient_age +
                      "</td>" + "<td>" +
                      report_data.tdata[i].checkup_equipment + "</td>";
                  display_data += "<td>" + report_data.tdata[i].report_doc_name + "</td>" + "<td>" +
                      "<td>" + report_data.tdata[i].report_time +
                      "</td></tr>";
                  var impression = report_data.tdata[0].impression;
                  var Imaging_performance = report_data.tdata[0].Imaging_performance;
                  $("#impression").html(impression);
                  $("#Imaging_performance").html(Imaging_performance);
              }
          } else {
              display_data = "";
              $("#impression").html("");

              $("#Imaging_performance").html("");
          }
          $("#past_report_body").html(display_data);
      });
  };

  function selected_past_report(val) {
      var base_url = '<?= base_url()?>';
      var booking_id = val;
      var strURL = base_url + "report/get_past_reportinfo/" + val;
      $.post(strURL).done(function (data) {
          report_data = JSON.parse(data);
          if (report_data) {
              var count = Object.keys(report_data.tdata).length;
              for (var i = 0; i < count; i++) {
                  var impression = report_data.tdata[0].impression;
                  var Imaging_performance = report_data.tdata[0].Imaging_performance;
              }
              $("#impression").html(impression);
              $("#Imaging_performance").html(Imaging_performance);
          } else {
              $("#impression").html("");

              $("#Imaging_performance").html("");
          }
      });
  };

  function dicom_view() {
      var booking_id = $("#booking_id").val();
      if (booking_id == '') {
          alert("请选择项目！");
      } else {
          var base_url = '<?= base_url()?>';
          var strURL = base_url + "report/dicom_view/" + booking_id;
          window.location.href = strURL;
      }
  };

  function contact_proc() {
      var booking_id = $("#booking_id").val();
      var base_url = '<?= base_url()?>';
      var strURL = base_url + "contact/" + booking_id;
      window.location.href = strURL;

  };

  function deliberation_view() {
      var booking_id = $("#booking_id").val();
      var base_url = '<?= base_url()?>';
      var strURL = base_url + "report/report_detail_view/" + booking_id;
      window.location.href = strURL;

  };
  function search_clear() {
      location.reload();
  };
  $(document).ready(function(){
    var tbl_usr_info = '<?=base_url()?>'+'report/search_data/deli';
    var table = $('#report_table_info').DataTable( {
         "ajax": tbl_usr_info,
          dom: 'Bfrtip',"ordering": false,
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
          dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
          columnDefs: [{
              orderable: !1,
              targets: [0]
          }, {
              searchable: !0,
              targets: [0]
          }]
     });
     table.buttons().remove();
     $('#report_table_info tbody').on('click', 'tr', function () {
       if ( $(this).hasClass('selected') ) {
           $(this).removeClass('selected');
       }
       else {
           table.$('tr.selected').removeClass('selected');
           $(this).addClass('selected');
       }
          var device_id = $(this).find('.device_id').val();
          var data = table.row( this ).data();
          var base_url = '<?= base_url() ?>';
          var strURL = base_url + "report/get_report_data/"+device_id;
          $.ajax({
            dataType: "json",
            url: strURL,
            success: function(response){
              past_checkup_info(response);
            }
          });
      } );

     $("#search_report_btn").click(function(){
          var base_url = '<?= base_url()?>';
          var formData = $('#search_report_form').serialize();
          var ajaxurl = base_url+'report/search_data/deli?'+formData;
          table.ajax.url( ajaxurl).load();
      });
    });

    </script>
