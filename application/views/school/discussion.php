<link href="<?=base_url()?>assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />

<div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PROFILE SIDEBAR -->
                            <div class="profile-sidebar">
                                <!-- PORTLET MAIN -->
                                <div class="portlet light profile-sidebar-portlet ">
                                    <!-- SIDEBAR USERPIC -->
                                    <div class="profile-userpic">
                                        <img src="../assets/pages/media/profile/profile_user.jpg" class="img-responsive" alt=""> </div>
                                    <!-- END SIDEBAR USERPIC -->
                                    <!-- SIDEBAR USER TITLE -->
                                    <div class="profile-usertitle">
                                        <div class="profile-usertitle-name"><?php echo $this->session->userdata('usr_name'); ?></div>
                                        <!-- <div class="profile-usertitle-job"> Developer </div> -->
                                    </div>
                                    <!-- END SIDEBAR USER TITLE -->
                                    <!-- SIDEBAR BUTTONS -->
                                    <div class="profile-userbuttons">
<!--                                         <button type="button" class="btn btn-circle green btn-sm">Follow</button>
                                        <button type="button" class="btn btn-circle red btn-sm">Message</button> -->
                                    </div>
                                    <!-- END SIDEBAR BUTTONS -->
                                    <!-- SIDEBAR MENU -->
                                    <div class="profile-usermenu">
                                        <ul class="nav" >
                                            <li >
                                                <a href="javascript:my_post_view();">
                                                <i class="fa fa-book"></i> 我发起的论点 </a>
                                            </li>
                                            <li>
                                                <a href="javascript:lesson_post_view();">
                                                <i class="fa fa-pencil-square"></i>我发表的评论</a>
                                            </li>

                                        </ul>
                                    </div>
                                    <!-- END MENU -->
                                </div>
                                <!-- END PORTLET MAIN -->
                                <!-- PORTLET MAIN -->

                                <!-- END PORTLET MAIN -->
                            </div>
                            <!-- END BEGIN PROFILE SIDEBAR -->
                            <!-- BEGIN PROFILE CONTENT -->
                            <div class="profile-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- BEGIN PORTLET -->
                                        <div class="portlet light ">
                                            <div class="portlet-title">
                                                <div class="caption caption-md">
                                                    <i class="icon-bar-chart theme-font hide"></i>
                                                    <span class="caption-subject font-blue-madison bold uppercase">热门论点</span>
                                                    <!-- <span class="caption-helper hide">weekly stats...</span> -->
                                                </div>
                                                <div class="actions">
                                                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                                                        <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                                                            <input type="radio" name="options" class="toggle" id="option1">最近访问： CT    MR    RF</label>
<!--                                                         <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                                                            <input type="radio" name="options" class="toggle" id="option2">Week</label>
                                                        <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                                                            <input type="radio" name="options" class="toggle" id="option2">Month</label> -->
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="portlet-body">

                                                <div class="table-scrollable table-scrollable-borderless">
                                                    <table class="table table-striped table-hover table-checkable order-column" id="lesson_table_view">
                                                        <thead>
                                                            <tr>                                                               
                                                                <th > 发布人 </th>
                                                                <th >Posting count</th>
                                                                <th >标题</th>
                                                                <th >时间</th>
                                                            </tr>
                                                        </thead>
<!--                                                         <tr>
                                                            <td class="fit">
                                                                <img class="user-pic" src="../assets/pages/media/users/avatar4.jpg"> </td>
                                                            <td>
                                                                <a href="javascript:;" class="primary-link">Brain</a>
                                                            </td>
                                                            <td> $345 </td>
                                                            <td> 45 </td>
                                                            <td> 124 </td>
                                                            <td>
                                                                <span class="bold theme-font">80%</span>
                                                            </td>
                                                        </tr> -->

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END PORTLET -->
                                    </div>
                                </div>
                                

                            </div>
                            <!-- END PROFILE CONTENT -->
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <input type="hidden" id="lesson_id" value="">


<script type="text/javascript">
    $(document).ready(function(){
      var tbl_usr_info = '<?=base_url()?>'+'school/lesson_table_info';
      var table = $('#lesson_table_view').DataTable( {
           "ajax": tbl_usr_info,
            dom: 'Bfrtip',"ordering": false,
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
            pageLength: 10,
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

       $('#lesson_table_view tbody').on('click', 'tr', function () {
         if ( $(this).hasClass('selected') ) {
             $(this).removeClass('selected');
         }
         else {
             table.$('tr.selected').removeClass('selected');
             $(this).addClass('selected');
         }
            var device_id = $(this).find('.device_id').val();
            $('#lesson_id').val(device_id);
            // var data = table.row( this ).data();
            // var base_url = '<?= base_url() ?>';
            // var strURL = base_url + "usermg/get_hospital_info/"+device_id;
            // $.ajax({
            //   dataType: "json",
            //   url: strURL,
            //   success: function(response){
            //     select_item(response);
            //   }
            // });
        } );


      });

    function my_post_view(){
       location.href = '<?= base_url() ?>school/my_post_view'
    }

    function lesson_post_view(){
        var lesson_id = $('#lesson_id').val();
        if (lesson_id=='') {
            return;
        }
        location.href = '<?= base_url() ?>school/lesson_post_view/'+lesson_id;
    }
</script>           