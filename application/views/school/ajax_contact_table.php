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
									<div class="col-lg-3 col-md-6 form-group form-md-line-input">
										<label class="col-lg-5 col-md-3 control-label" for="form_control_1">
											<?=$this->lang->line('name')?>:
										</label>
										<div class="col-lg-7 col-md-9">
											<input type="text" class="form-control" name="patient_name">
											<div class="form-control-focus"> </div>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 form-group form-md-line-input">
										<label class="col-md-3 col-lg-5 control-label" for="form_control_1">
											<?=$this->lang->line('age')?>:
										</label>
										<div class="col-md-9 col-lg-7">
											<input type="text" class="form-control" placeholder=""  name="patient_age">
											<div class="form-control-focus"> </div>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 form-group form-md-line-input">
										<label class="col-md-3 col-lg-5 control-label" for="form_control_1">
											<?=$this->lang->line('gender')?>:</label>
										<div class="col-md-9 col-lg-7">
											<select class="form-control" name="patient_gender">
												<option value="">请选择</option>
												<option value="0">男</option>
												<option value="1">女</option>
											</select>
											<div class="form-control-focus"> </div>

										</div>
									</div>
									<div class="col-lg-3 col-md-6 form-group form-md-line-input">
										<label class="col-md-3 col-lg-5 control-label" for="form_control_1">医疗状态:</label>
										<div class="col-md-9 col-lg-7">
											<select class="form-control" name="contact_status">
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
									<div class="col-lg-3 col-md-3 form-group form-md-line-input">
										<label class="control-label col-lg-5 col-md-4">发起时间:</label>
										<div class="col-lg-7">
											<input class="form-control form-control-inline date-picker" placeholder="01/01/2017" name="start_time" type="text" />
										</div>
									</div>
									<div class="col-lg-3 col-md-3 form-group form-md-line-input">
										<label class="col-lg-1 control-label col-md-3">至</label>
										<div class="col-md-9 col-lg-7">
											<input class="form-control form-control-inline date-picker" placeholder="01/01/2017" name="end_time" type="text" />
										</div>
									</div>
									<div class="col-lg-3 col-md-3 form-group form-md-line-input">
										<label class="col-md-3 control-label col-lg-5" for="form_control_1">咨询类型:</label>
										<div class="col-md-9 col-lg-7">
											<select class="form-control" name="contact_type">
												<option value="">请选择</option>
												<option value="1">远程会珍</option>
												<option value="2">远程门诊</option>
											</select>
											<div class="form-control-focus"> </div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 form-group form-md-input">
										<button type="button" class="btn col-md-offset-2 col-md-4 blue yellow" id="search_contact_info">
											<i class="fa fa-search"></i>查询</button>
										<button type="button" class="btn col-md-offset-2 col-md-4 blue" onclick="search_clear()">
											<i class="fa fa-refresh"></i>重置</button>
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
						<div class="row">
							<div class="col-md-2" style=" font-size: 1.5em; margin-top: 0.4em;">
								<i class=" icon-layers font-green"></i>
								<span class="caption-subject font-green sbold uppercase">我的咨询</span>
							</div>
							<div class="col-md-8" >
							<?php $usrRole = $this->session->userdata('usr_role')?>
							<?php if (check_role('RemoteConsultation')):?>
							<a href="<?=base_url()?>contact/contact_start/" style="width: 150px; margin-right: 15px;" class="btn contact-button col-md-offset-2 col-md-3"
							role="button" aria-pressed="true"><span class="glyphicon glyphicon-share"> </span>远程会诊</a>
							<?php endif;?>
							<?php if (check_role('RemoteOutpatient')):?>
							<a href="<?=base_url()?>contact/outpatient/" style="width: 150px;" class="btn contact-button col-md-offset-2 col-md-3"
							role="button" aria-pressed="true">
								<span class="glyphicon glyphicon-facetime-video"> </span>远程门诊</a>
							<?php endif;?>
							</div>
						</div>
					</div>
					<div class="clearfix col-md-offset-1">
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover" style="text-align: center;" id="contact_info_table">
							<thead>
								<tr>
									<th style="text-align: center;">操作</th>
									<th style="text-align: center;">序号</th>
									<th style="text-align: center;">会诊编号</th>
									<th style="text-align: center;">医疗状态</th>
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
<div id="contact_review_proc_view" data-iziModal-icon="icon-home"/>

<script>
	var base_url = '<?=base_url()?>';
	function search_clear() {
		$('#search_contact_info_form')[0].reset();
	}
	var table = '';
	$(document).ready(function () {
	    $(".date-picker").datepicker({
	        rtl: App.isRTL(),
	        orientation: "left",
	        autoclose: !0
	    });
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
		$("#search_contact_info").click(function () {
			var base_url = '<?=base_url()?>';
			var formData = $('#search_contact_info_form').serialize();
			console.log(formData);
			var ajaxurl = base_url + 'contact/search_my_contact?' + formData;
			table.ajax.url(ajaxurl).load();
		});
	});

	function deleteContact(contact_id){
        var strURL = base_url + "contact/deleteContact/" + contact_id;
        $.confirm({
            title: '提示',
            content: ' 确定要删除吗？',
            icon: 'fa fa-warning',
            theme: 'bootstrap',
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
	}

    function startContact(contact_id){
        var strURL = base_url + "contact/get_contact_info/" + contact_id;
        $.ajax({
            dataType: "json",
            url: strURL,
            success: function (response) {
                 $.ajax({
                    url: base_url + 'Contact/start_contact_enable',
                    type: 'GET',
                    dataType: 'json',
                    data: {'contact_id': contact_id},
                    cache: false,
                    success: function(data){
                        //alert(data.open);
                        if(1){
                        //if(data.open){//会诊时间已到
                            var strURL = base_url + "contact/contactRoom/" + contact_id +'/'+response.password;
                            window.location.href = strURL;
                        }
                        else{//会诊时间还没到
                            $.alert({
                                title: '提示!',
                                content: '会诊时间还没到！',
                                columnClass: 'small',
                                buttons: {
                                    ok: function () {
                                        window.location.href = base_url + 'contact/my_contact';
                                    }
                                }
                            });
                        }

                    },
                    error: function(request, textStatus, errorThrown){
                        alert('start_contact_error');
                    }
                });
            }
        });
    }

	function EditContact(contact_id) {
		var base_url = '<?=base_url()?>';
		var strURL = base_url + "contact/editContactInfo/" + contact_id;
		window.location.href = strURL;
	}

	function contactDetailView(contact_id) {
	    let settings = {
	        "url": base_url+'contact/ajax_contact_detail/'+contact_id,
	        "method": "get"
	    };
	    $('#contact_detail_info_view').iziModal({
	      padding: 15,
	      theme: 'bootstrap',
	      closeButton: true,
	      title: '咨询详细信息',
	      width: 800,
	      onOpening: function(modal){
	          modal.startLoading();
	          $.ajax(settings).done(function (response) {
	            $("#contact_detail_info_view .iziModal-content").html(response);
	            modal.stopLoading();
	          });
	        }
	    });
	    $('#contact_detail_info_view').iziModal('open');
	 }

</script>
