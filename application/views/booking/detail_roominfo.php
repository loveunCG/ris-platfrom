<div class="page-content-wrapper">
  <div class="page-content">
    <h3 class="page-title">
      诊室排号
    </h3>
    <div class="page-bar">
      <ul class="page-breadcrumb">
        <li>
          <i class="icon-home"></i> 病人信息管理
          </a>
          <i class="fa fa-angle-right"></i>
        </li>
        <li>
          <span>诊室排号</span>
        </li>
      </ul>

    </div>
    <!-- BEGIN CONTENT BODY -->
    <div class="row" id="sortable_portlets">
      <div class="col-md-12 column sortable">

        <div class="row">
          <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet portlet-sortable box blue-chambray ">
              <div class="portlet-title">
                <div class="caption">
                  <i class="icon-magnifier"></i>
                  <span class="caption-subject font-green sbold uppercase">排队叫号</span>
                </div>
              </div>
              <div class="portlet-body ">
                <div class="row">
                  <div class="col-md-2 alert" style="text-align: center;">
                    <strong>医生：</strong><span class="btn btn-default "> Default </span>
                  </div>
                  <div class="col-md-2 alert" style="text-align: center;">
                    <strong>诊室：</strong> <span class="btn btn-default "> <?=$room_only_info->equioment_room?> </span>
                  </div>
                  <div class="col-md-2 alert" style="text-align: center;">
                    <strong>检查类型：</strong> <span class="btn btn-default "> <?=$room_only_info->equipment_type?> </span>
                  </div>
                  <div class="col-md-2 alert" style="text-align: center;">
                    <strong>检查设备：</strong> <span class="btn btn-default "> <?=$room_only_info->equipment_num?> </span>
                  </div>
                  <div class="col-md-4 alert " style="text-align: center;">
                    <strong>当时时间：</strong> <span id="clock_display" class="btn btn-default ">  </span>
                  </div>
                  <div class="row">
                    <div class="col-md-offset-8 col-md-2 alert" style="text-align: center;">
                      <strong><i class="fa fa-phone"></i> &nbsp;已呼叫：</strong>
                      <span class="btn btn-default "> <?php
                              $yi_hujiao = 0;
                              $dai_hujiao = 0;
                              foreach ($room_info as $value) {
                                if ($value->checkup_time > date('Y-m-d h:i:s')) {
                                  ++$yi_hujiao;
                                }else{
                                  ++$dai_hujiao;
                                }
                              }
                               ?>
                               <?=$yi_hujiao?>
                             </span>

                    </div>
                    <div class="col-md-2 alert " style="text-align: center;">
                      <strong><i class="fa fa-hourglass-1"></i> &nbsp;待呼叫：</strong> <span class="btn btn-default "> <?=$dai_hujiao?> </span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="clearfix col-md-offset-1 col-md-4">
                      <button type="button" id="make_checkup_btn" disabled onclick="update_booking(2)" class="btn blue"> <span class="glyphicon glyphicon-ok"> </span> 重新排号</button>
                      <button type="button" id="prev_item_btn" disabled onclick="prev_item()" class="btn green-turquoise">上移一位<span class="glyphicon glyphicon-arrow-up"> </span></button>
                      <button type="button" id="next_item_btn" disabled onclick="next_item()" class="btn green-turquoise">下移一位<span class="glyphicon glyphicon-arrow-down"> </span></button>
                    </div>
                    <div class="clearfix col-md-offset-4 col-md-2">
                      <button type="button" id="take_checkup_btn" disabled onclick="update_booking(1)" class="btn green-turquoise"> <span class="glyphicon glyphicon-play"> </span>开始排号</button>
                      <button type="button" id="new_make_checkup_btn" disabled onclick="update_booking(0)" class="btn blue"> <span class="glyphicon glyphicon-retweet"> </span> 重呼</span></i></button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="portlet light ">
                        <div class="portlet-title">
                          <div class="caption font-dark">
                          </div>
                          <div class="tools"> </div>
                        </div>
                        <div class="portlet-body">
                          <div id="notification_result">
                          </div>
                          <table class="table table-striped table-bordered table-hover" id="room_detail_table">
                            <thead class=" bg-font-default">
                              <tr>
                                <th width="5%" >序号</th>
                                  <th> 病人编号 </th>
                                  <th> 姓名 </th>
                                  <th> 性别 </th>
                                  <th> 年龄 </th>
                                  <th> 检查设备</th>
                                  <th> 检查项目</th>
                                  <th> 检查日期</th>
                                  <th> 检查状态</th>
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
  </div>
  <input type="hidden" id="prev_item" value="">
  <input type="hidden" id="total_item" value="<?=count($room_info)?>">
  <input type="hidden" id="next_item" value="">
  <input type="hidden" id="curt_item" value="">
  <script>

  var table = '';
    $(document).ready(function () {
        var tbl_usr_info = '<?=base_url()?>' + 'booking/room_detail/<?=$room_id?>';
        table = $('#room_detail_table').DataTable({
            "ajax": tbl_usr_info,
            dom: 'Bfrtip',
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
            pageLength: 20,
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
        $('#room_detail_table tbody').on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
            var data = table.row(this).data();
            var order_num = data[0];
            var check_id = $(this).find('.check_id').val();
            var base_url = '<?= base_url() ?>';
            var strURL = base_url + "booking/get_checklist_info/" + check_id;
            $.ajax({
                dataType: "json",
                url: strURL,
                success: function (response) {
                    select_booking(response, order_num);
                }
            });
        });

        $("#search_contact_info").click(function () {
            var base_url = '<?=base_url()?>';
            var formData = $('#search_contact_info_form').serialize();
            var ajaxurl = base_url + 'contact/search_my_contact?' + formData;
            table.ajax.url(ajaxurl).load();
        });
    });
   
    function select_booking(val, order_num) {
      var chc_id = val.chc_id;
      var checkup_status = val.checkup_status;
      var max_count = parseInt($('#total_item').val());
      var prev_order_num = parseInt(order_num) - 1;
      var next_order_num = parseInt(order_num) + 1;
      var prev_item_select = '#checkupinfo' + prev_order_num;
      var prev_check_info = $(prev_item_select).val();
      var next_item_select = '#checkupinfo' + next_order_num;
      var nxt_check_info= $(next_item_select).val();
      if(prev_check_info){
         var prev_status = prev_check_info.split("_")[1];
      }
      if(nxt_check_info){
         var nxt_status = nxt_check_info.split("_")[1];

      }
      $('#curt_item').val(val.chc_id);
      $('#prev_item').val($(prev_item_select).val());
      $('#next_item').val($(next_item_select).val());
      if (checkup_status == '0') {
        $('#new_make_checkup_btn').attr('disabled', 'true');
        $('#make_checkup_btn').attr('disabled', 'true');
        $('#prev_item_btn').removeAttr('disabled');
        $('#next_item_btn').removeAttr('disabled');
        $('#take_checkup_btn').removeAttr('disabled');
        
        if (prev_status == '0') {
          $('#prev_item_btn').removeAttr('disabled');
          $('#next_item_btn').removeAttr('disabled');
        }else if (prev_status != '0') {
          $('#prev_item_btn').attr('disabled', 'true');
          $('#next_item_btn').removeAttr('disabled');
        }
      }else if(checkup_status == '1'){
        $('#take_checkup_btn').attr('disabled', 'true');      
        $('#make_checkup_btn').removeAttr('disabled');

      }else if(checkup_status == '2'){
        $('#new_make_checkup_btn').removeAttr('disabled');
        $('#make_checkup_btn').attr('disabled', 'true');
        $('#take_checkup_btn').attr('disabled', 'true');
        
        

      }

      if (next_order_num > max_count) {
        $('#prev_item_btn').removeAttr('disabled');
        $('#next_item_btn').attr('disabled', 'true');
      }
       if (prev_order_num < 1) {
          $('#prev_item_btn').attr('disabled', 'true');
          $('#next_item_btn').removeAttr('disabled');
        }

    }
    function next_item() {
      var crut_chc_id = $('#curt_item').val();
      var res_nxt_item = $('#next_item').val();
      var nxt_list = res_nxt_item.split("_");
      var nxt_chc_id = nxt_list[0];
      var base_url = '<?= base_url() ?>';
      var strURL = base_url + "booking/change_order";
      $.post(strURL, {
          chn_chc_id: nxt_chc_id,
          crut_chc_id: crut_chc_id
        })
        .done(function (data) {
          $.alert({
                        title: '报告!',
                        content: '已成功下移了',
                        columnClass: 'small',
                        buttons: {
                            ok: function () {
                              table.ajax.reload()
                            },
                        }
                    });
        });
    }
    function update_booking(val) {
      var res_curt_item = $('#curt_item').val();
      var base_url = '<?= base_url() ?>';
      var strURL = base_url + "booking/update_booking";
      $.post(strURL, {
          c_id: res_curt_item,
          booking_status: val
        })
        .done(function (data) {
           $.alert({
             title: '报告!',
             content: '已成功下移了',
             columnClass: 'small',
             buttons: {
              ok: function () {
                  table.ajax.reload()
              },
             }
            });          
        });
    }
    function prev_item() {
      var crut_chc_id = $('#curt_item').val();
      var res_prev_item = $('#prev_item').val();
      var prev_list = res_prev_item.split("_");      
      var prev_chc_id = prev_list[0];
      var base_url = '<?= base_url() ?>';
      var strURL = base_url + "booking/change_order";
      $.post(strURL, {
          chn_chc_id: prev_chc_id,
          crut_chc_id: crut_chc_id
        })
        .done(function (data) {
           $.alert({
                        title: '报告!',
                        content: '已成功上移了',
                        columnClass: 'small',
                        buttons: {
                            ok: function () {
                              table.ajax.reload()
                            },
                        }
                    });
        });
    }
  </script>
