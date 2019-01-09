<!-- BEGIN CONTENT BODY -->
<div class="row" id="sortable_portlets">
	<div class="col-md-12 column sortable">
		<div class="row">
			<div class="col-md-12">
				<form action="#" method="post" class="form-horizontal" id="search_school_form">
					<div class="row">
						<div class="col-lg-12 col-md-12 form-group form-md-line-input">
							<div class="col-lg-5 col-md-6 form-group form-md-line-input">
								<label class="col-lg-5 col-md-3 control-label" for="form_control_1">
									教学主题：
								</label>
								<div class="col-md-9 col-lg-7">
									<input type="text" class="form-control" name="lession_title">
									<div class="form-control-focus"> </div>
								</div>
							</div>
							<div class="col-lg-5 col-md-6 form-group form-md-line-input">
								<label class="col-md-3 col-lg-5 control-label" for="form_control_1">
									教学导师：
								</label>
								<div class="col-md-9 col-lg-7">
									<input type="text" class="form-control" name="image_num">
									<div class="form-control-focus"> </div>
									<span class="help-block">请输入
										<?=$this->lang->line('image_num')?>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">
								检查时间:
							</label>
							<div class="col-md-1">
								<select class="form-control" name="time_type">
									<option value="1">开始时间</option>
								</select>
								<span class="help-block">请输入姓名</span>
							</div>
							<div class="clearfix col-md-3">
								<input type="hidden" name="searchdate" id="search_date" />
								<button type="button" onclick="serachbydate(1)" class="btn btn-info">今天</button>
								<button type="button" onclick="serachbydate(2)" class="btn btn-info">昨天</button>
								<button type="button" onclick="serachbydate(3)" class="btn btn-info">最近3天</button>
								<button type="button" onclick="serachbydate(4)" class="btn btn-info">最近7天</button>
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
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">
								医疗状态：
							</label>
							<div class="col-md-6">
								<div class="clearfix">
									<button type="button" onclick="search_by_status(3)" class="btn btn-info">全部</button>
									<button type="button" onclick="search_by_status(2)" class="btn btn-info">已结束</button>
									<button type="button" onclick="search_by_status(1)" class="btn btn-info">已开始</button>
									<button type="button" onclick="search_by_status(0)" class="btn btn-info">未开始</button>
								</div>
							</div>
							<div class=" pull-right form-group col-md-3">
								<div class="col-md-6 col-sm-12">
									<button type="button" class="btn btn-info" onclick="search_school()">
										<span class="glyphicon glyphicon-search"> </span>查询</button>
								</div>
								<div class="col-md-6 col-sm-12">
									<button type="button" class="btn btn-info " onclick="search_clear()">
										<span class="glyphicon glyphicon-refresh"> </span>重置</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet portlet-sortable light">
						<div class="portlet-title">
							<div class="caption">
							</div>
						</div>
						<div class="portlet-body">
							<div class="row">
								<?php if (check_role('NewOnlineVideoTeaching')):?>
								<div class="col-md-2">
									<button type="button" onclick="createSchoolModal()" class="btn btn-info pull-right">新建教学</button>
								</div>
								<?php endif; ?>
							</div>
							<table class="table table-striped table-bordered table-hover" style="text-align: center;" id="report_table_info">
								<thead>
									<tr>
										<th style="text-align: center;">序号</th>
										<th style="text-align: center;">教学主题</th>
										<th style="text-align: center;">内容描述</th>
										<th style="text-align: center;">教学老师</th>
										<th style="text-align: center;">开始时间</th>
										<th style="text-align: center;">结束时间</th>
										<th style="text-align: center;">教学状态</th>
										<th style="text-align: center;width: 15%">操作 </th>
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
<div id="add_school_view_modal" data-iziModal-icon="icon-home" />
<div id="dicom_share_modal" data-iziModal-icon="icon-home" />
<div id="review_modal" data-iziModal-icon="icon-home" />
<script>
	let table = [];
	var base_url = '<?=base_url()?>';
	let add_school_view_modal;
	var tbl_usr_info = '<?=base_url()?>' + 'school/search_lession_table/is';

	function createSchoolModal(lession_id){
		add_school_view_modal = $("#add_school_view_modal");
		let settings = {
			"url": base_url+'school/ajax_create_school/'+ lession_id,
			"method": "get"
		};
		$('#add_school_view_modal').iziModal({
			padding: 25,
			theme: 'material',
			closeButton: true,
			title: '详细信息',
			onOpening: function(modal){
				modal.startLoading();
				$.ajax(settings).done(function (response) {
					// console.log(response)
					$(".iziModal-content").html(response);
					modal.stopLoading();
				});
			}
		});
		add_school_view_modal.iziModal('open');
	}


	function contact_proc() {
		var booking_id = $("#booking_id").val();
		var base_url = '<?=base_url()?>';
		var strURL = base_url + "contact/" + booking_id;
		window.location.href = strURL;

	};


	function search_clear() {
		$('#search_school_form')[0].reset();
	};

	function serachbydate(param) {
		var ajaxurl = tbl_usr_info + '?datestep=' + param;
		console.log(ajaxurl);
		table.ajax.url(ajaxurl).load();
	}

	function search_by_status(param) {
		var ajaxurl = tbl_usr_info + '?status=' + param;
		table.ajax.url(ajaxurl).load();
	}

	function addSchoolProc() {
		$('.add_school_from').submit();

		var form_data = $('.add_school_from').serialize();
		var url = '<?=base_url()?>' + 'school/save_lession';
		$.ajax({
			url: url,
			type: 'post',
			dataType: "JSON",
			data: form_data,
			success: function (result) {
				console.log(result)
				$.alert({
					title: '提示!',
					content: result.message,
					columnClass: 'small',
					icon: 'fa fa-warning',
					closeIcon: true,
					animationBounce: 1.5,
					theme: 'light',
					buttons: {
						ok: function () {
							if (result.response_code) {
								console.log(result)
								$("#add_school_view_modal").iziModal('close');
								table.ajax.reload()
							} else {
								return
							}
						}
					}
				});
			}
		});
	}

	function search_school(){
		var formData = $('#search_school_form').serialize();
		var ajaxurl = tbl_usr_info + '?' + formData;
		table.ajax.url(ajaxurl).load();
	}

	function end_lession(lession_id){
		var url = '<?=base_url()?>' + 'school/end_lession/' + lession_id;
		$.ajax({
			url: url,
			type: 'post',
			dataType: "JSON",
			success: function (result) {
				console.log(result)
				$.alert({
					title: '提示!',
					content: result.message,
					columnClass: 'small',
					icon: 'fa fa-warning',
					closeIcon: true,
					animationBounce: 1.5,
					theme: 'light',
					buttons: {
						ok: function () {
							if (result.response_code) {
								console.log(result)
								$("#add_school_view_modal").iziModal('close');
								table.ajax.reload()
							} else {
								return
							}
						}
					}
				});
			}
		});

	}

	$(document).ready(function () {
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
			bStateSave: !0,
			columnDefs: [{
				targets: 0,
				orderable: !1,
				searchable: !0
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
		table.buttons().remove();
		$(".date-picker").datepicker({
			rtl: App.isRTL(),
			orientation: "left",
			autoclose: !0
		});

	});

</script>
