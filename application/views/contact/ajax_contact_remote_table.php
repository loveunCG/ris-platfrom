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
						<form action="#" method="post" class="form-horizontal" id="search_contact_review_info_form">
							<div class="form-body">
								<div class="row" style="margin-left: 5em;">
									<div class="col-lg-3 col-md-6 form-group form-md-line-input">
										<label class="col-lg-5 col-md-3 control-label" for="form_control_1">
											编号:
										</label>
										<div class="col-lg-7 col-md-9">
											<input type="text" class="form-control" name="patient_code">
											<div class="form-control-focus"> </div>
										</div>
									</div>
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
											<input type="text" class="form-control" name="patient_age">
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
								</div>
								<div class="row">
									<div class="col-lg-12 col-md-12 form-group form-md-line-input">
										<form id="searchByTimeform">
											<label class="col-md-2 control-label" for="form_control_1">
												查询时间:
											</label>
											<div class="col-md-1">
												<select class="form-control" name="time_type">
													<option value="1">申请时间</option>
													<option value="2">预约时间</option>
												</select>
											</div>
											<div class="clearfix col-md-3">
												<input type="hidden" name="searchdate" id = "search_date"/>
												<button type="button" onclick="serachbydate(1)" class="btn contact-button" style="width:4.5em">今天</button>
												<button type="button" onclick="serachbydate(2)" class="btn contact-button" style="width:4.5em">昨天</button>
												<button type="button" onclick="serachbydate(3)" class="btn contact-button" style="width:5.5em">最近3天</button>
												<button type="button" onclick="serachbydate(4)" class="btn contact-button" style="width:5.5em">最近7天</button>
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
									<div class="col-lg-12 col-md-12 form-group form-md-line-input">
										<label class="col-md-2 control-label" for="form_control_1">
											咨询类型：
										</label>
										<div class="col-md-9">
											<div class="clearfix">
												<button type="button" onclick="search_by_search_contact_type(0)" class="btn contact-button">
													全部
												</button>
												<button type="button" onclick="search_by_search_contact_type('1')" class="btn contact-button">
													远程会诊
												</button>
												<button type="button" onclick="search_by_search_contact_type('2')" class="btn contact-button">
													远程门诊
												</button>
												<input type="hidden" name="contact_type" id = "search_contact_type" />
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 col-md-12 form-group form-md-line-input">
										<label class="col-md-2 control-label" for="form_control_1">
											医疗状态：
										</label>
										<div class="col-md-6">
											<div class="clearfix">
												<button type="button" onclick="search_by_contact_status('')" class="btn contact-button">全部</button>
												<button type="button" onclick="search_by_contact_status(3)" class="btn  contact-button">
													已安排
												</button>
												<button type="button" onclick="search_by_contact_status(6)" class="btn contact-button">
													会诊中
												</button>
												<button type="button" onclick="search_by_contact_status(5)" class="btn  contact-button ">
													已结束
												</button>
												<input type="hidden" name="contact_status" id = "search_contact_status" />
											</div>
										</div>
										<div class=" col-lg-3 col-md-6 form-group form-md-input">
											<button type="button" class="btn col-md-offset-3 col-md-4  contact-button" id="search_contact_review_info">
												<i class="fa fa-search"></i>查询</button>
											<button type="button" class="btn col-md-offset-3 col-md-4  contact-button" onclick="search_clear()" style="margin-left: 1em;">
												<i class="fa fa-refresh"></i>重置</button>
										</div>
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
					<div class="row">
							<div class="col-md-2" style=" font-size: 1.5em; margin-top: 0.4em;    margin-left: 1em;">
								<i class=" icon-layers font-green"></i>
								<span class="caption-subject font-green sbold uppercase"> 远程协作 </span>
							</div>
							<div class="col-md-8" >
								<?php $usrRole = $this->session->userdata('usr_role')?>
								<?php if (check_role('RemoteConsultation')): ?>
								<a href="<?=base_url()?>contact/contact_start/" style="width: 150px; margin-right: 15px;" class="btn contact-button col-md-offset-2 col-md-3"
								role="button" aria-pressed="true"><span class="glyphicon glyphicon-share"> </span>远程会诊</a>
								<?php endif;?>
								<?php if (check_role('RemoteOutpatient')): ?>
								<a href="<?=base_url()?>contact/outpatient/" style="width: 150px;" class="btn contact-button col-md-offset-2 col-md-3"
								role="button" aria-pressed="true">
									<span class="glyphicon glyphicon-facetime-video"> </span>远程门诊</a>
								<?php endif;?>
							</div>
						</div>
					<div class="clearfix col-md-offset-1">
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover" style="text-align: center;" id="contact_review_table">
							<thead>
								<tr>
									<th style="text-align: center;width: 15%;">操作</th>
									<th style="text-align: center;">序号</th>
									<th style="text-align: center;">医疗状态</th>
									<th style="text-align: center;">患者编号</th>
									<th style="text-align: center;">姓名</th>
									<th style="text-align: center;">性别</th>
									<th style="text-align: center;">年龄</th>
									<th style="text-align: center;">咨询类型</th>
									<th style="text-align: center;">标题</th>
									<th style="text-align: center;">会诊开始时间</th>
									<th style="text-align: center;">医院申请医生</th>
									<th style="text-align: center;">申请时间</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="contact_detail_info_view" data-iziModal-icon="icon-home"/>
<script src="<?=base_url()?>assets/global/scripts/socket.io.js" type="text/javascript"></script>
<script>
	function search_clear() {
		$('#search_contact_review_info_form')[0].reset();
		document.getElementById("search_contact_type").value = '';
		document.getElementById("search_date").value = '';
		document.getElementById("search_contact_type").value = '';
	}
	var table = '';
	$(document).ready(function () {
		$(".date-picker").datepicker({
			rtl: App.isRTL(),
			orientation: "left",
			autoclose: !0
		});
		var tbl_usr_info = '<?=base_url()?>' + 'contact/serach_remote_contact';
		table = $('#contact_review_table').DataTable({
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
		$("#search_contact_review_info").click(function () {
			var base_url = '<?=base_url()?>';
			var formData = $('#search_contact_review_info_form').serialize();
			var ajaxurl = base_url + 'contact/serach_remote_contact?' + formData;
			table.ajax.url(ajaxurl).load();
		});
	}); 

function search_by_search_contact_type(contact_type){
	$('#search_contact_review_info_form')[0].reset();
	if(contact_type != 0){
		document.getElementById("search_contact_type").value = contact_type;
	}
	else{
		document.getElementById("search_contact_type").value = '';
	}
	var base_url = '<?=base_url()?>';
	var formData = $('#search_contact_review_info_form').serialize();
	var ajaxurl = base_url + 'contact/serach_remote_contact?' + formData;
	table.ajax.url(ajaxurl).load();
  }

  function search_by_contact_status(contact_type){
	$('#search_contact_review_info_form')[0].reset();
	document.getElementById("search_contact_status").value = contact_type;
	var base_url = '<?=base_url()?>';
	var formData = $('#search_contact_review_info_form').serialize();
	var ajaxurl = base_url + 'contact/serach_remote_contact?' + formData;
	table.ajax.url(ajaxurl).load();
  }

  function serachbydate(day){
	// $('#search_contact_review_info_form')[0].reset();
	document.getElementById("search_date").value = day;
	var base_url = '<?=base_url()?>';
	var formData = $('#search_contact_review_info_form').serialize();
	var ajaxurl = base_url + 'contact/serach_remote_contact?' + formData;
	table.ajax.url(ajaxurl).load();
  }

	var my_contact = io('<?=get_socket_url()?>');
	my_contact.on('contact_start', function(data){
	var base_url = '<?=base_url()?>';
	var formData = $('#search_contact_info_form').serialize();
	console.log(formData);
	var ajaxurl = base_url + 'contact/serach_remote_contact?' + formData;
	table.ajax.url(ajaxurl).load();
	});

</script>
