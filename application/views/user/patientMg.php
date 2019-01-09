<div class="page-content-wrapper">
<?php $usrRole = $this->session->userdata('usr_role')?>
	<div class="page-content">
		<h3 class="page-title">
			病人用户管理 </h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="icon-home"></i> 操作管理
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<span>病人用户管理</span>
				</li>
			</ul>

		</div>
		<!-- BEGIN CONTENT BODY -->
		<div class="row" id="sortable_portlets">
			<div class="col-md-12 column sortable">
				<!-- BEGIN VALIDATION STATES-->
				<div class="portlet portlet-sortable box blue-madison">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-magnifier"></i>
							<span class="caption-subject font-light sbold uppercase">病人用户</span>
						</div>
					</div>
					<div class="portlet-body">
						<!-- BEGIN FORM-->
						<form action="#" method="post" id="searchPatientForm" class="form-horizontal">
							<div class="form-body">
								<div class="row">
									<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group form-md-line-input">
										<label class="col-lg-4 col-md-3 control-label" for="form_control_1">姓名 : </label>
										<div class="col-lg-8 col-md-9">
											<input type="text" class="form-control" name="pat_name">
											<div class="form-control-focus"> </div>
											<span class="help-block">请输入姓名</span>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12  form-group form-md-line-input">
										<label class="col-lg-4 col-md-3 control-label" for="form_control_1">年龄:
										</label>
										<div class="col-md-9 col-lg-8">
											<input type="text" class="form-control" placeholder="" name="patient_age">
											<div class="form-control-focus"> </div>
											<span class="help-block">请输入年龄</span>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12  form-group form-md-line-input">
										<label class="col-md-3 col-lg-4 control-label" for="form_control_1">
											<?=$this->lang->line('gender')?>
										</label>
										<div class="col-md-9 col-lg-8">
											<select class="form-control" name="patient_gender">
												<option value="">请选择</option>
												<option value="1">男</option>
												<option value="0">女</option>
											</select>
											<div class="form-control-focus"> </div>

										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group form-md-line-input">
										<label class="col-md-3 col-lg-4 control-label">用户状态</label>
										<div class="col-md-9 col-lg-8">
											<select class="form-control" name="pat_status">
												<option value="">请选择</option>
												<option value="1">已激活</option>
												<option value="2">已注销</option>
											</select>
											<div class="form-control-focus"> </div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group form-md-line-input">
									<label class="control-label col-md-3 col-lg-4">申请时间:</label>
									<div class="col-md-9 col-lg-8">
										<input class="form-control form-control-inline input-medium date-picker" placeholder="01/01/2017" name="start_time" type="text" value=""
										/>
										<!--										<span class="help-block"> 选择日期 </span>-->
									</div>
								</div>
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group form-md-line-input">
									<label class="control-label col-lg-4 col-md-3">至</label>
									<div class="col-md-9 col-lg-8">
										<input class="form-control form-control-inline input-medium date-picker" placeholder="01/01/2017" name="end_time" type="text" value=""
										/>
										<!--										<span class="help-block"> 选择日期 </span>-->
									</div>
								</div>
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group form-md-line-input">
									<label class="col-md-3 col-lg-4 control-label" for="form_control_1">所属医院</label>
									<div class="col-md-9 col-lg-8">
										<select class="form-control" name="hospital_num">
											<option value="">请选择</option>
											<?php foreach ($hospital_info as $value):?>
											<?='<option value="'.$value->hospital_name.'">'.$value->hospital_name.'</option>'?>
												<?php endforeach;?>
										</select>
										<div class="form-control-focus"> </div>

									</div>
								</div>
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group form-md-input">
									<button type="button" class="btn col-md-offset-4 pull-left blue-madison" id="search_patient_btn">
										<i class="fa fa-search"></i>查询</button>
									<button type="button" class="btn pull-right blue-madison" onclick="search_clear()">
										<i class="fa fa-refresh"></i>重置</button>
								</div>
							</div>
						</form>

					</div>
					<!-- END FORM-->
				</div>
			</div>
			<div class="col-md-12 column sortable">
				<div class="portlet portlet-sortable box  blue-madison">
					<div class="portlet-title">
						<div class="caption">
							<i class=" icon-layers font-green"></i>
							<span class="caption-subject font-light sbold uppercase">病人用户列表</span>
						</div>
					</div>

					<div class="portlet-body">
						<div id="result_notification"></div>
						<div class="clearfix">
							<div class="row">
								<div class="col-md-offset-1 col-md-9">
								<?php if ($usrRole == 1||$usrRole == 1024||$this->session->userdata('isActivationPatient')):?>
									<button type="button" class="btn blue-madison" disabled id="set_access_allow">
										<span class="glyphicon glyphicon-play"> </span> 激活</button>
									<button type="button" class="btn blue-madison" disabled id="set_access_denite">
										<span class="glyphicon glyphicon-stop"> </span>注销</button>
								<?php endif;?>
								<?php if ($usrRole == 1||$usrRole == 1024||$this->session->userdata('isDeletePatient')):?>
									<button type="button" class="btn blue-madison" disabled id="deltePatientINfo">
										<span class="glyphicon glyphicon-trash"> </span>删除</button>
								<?php endif ?>
								</div>
							</div>
						</div>
						<table class="table table-striped table-bordered table-hover table-checkable order-column" id="patientMgTable">
							<thead>
								<tr>
									<th>序号</th>
									<th>用户状态</th>
									<th>帐号</th>
									<th>姓名</th>
									<th>性别</th>
									<th>年龄</th>
									<th>身份证号</th>
									<th>所属医院</th>
									<th>联系电话</th>
									<th>申请时间</th>
									<th>激活时间</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="patient_id">
<script>
	function selectPatient(val) {
		$('#patient_id').val(val.id);
		if (val.pat_status == '1') {
			$('#set_access_denite').removeAttr('disabled');
			$('#set_access_allow').attr('disabled', 'true');
		} else {
			$('#set_access_allow').removeAttr('disabled');
			$('#set_access_denite').attr('disabled', 'true');
		}
		$('#deltePatientINfo').removeAttr('disabled');

	}

	function search_clear() {
		$('#searchPatientForm')[0].reset();
	}
	var table = [];
	$(document).ready(function () {
		var hospital_req = '<?=base_url()?>' + 'usermg/getPatientInfo';
		table = $('#patientMgTable').DataTable({
			"ajax": hospital_req,
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

		$('#patientMgTable tbody').on('click', 'tr', function () {
			if ($(this).hasClass('selected')) {
				$(this).removeClass('selected');
			} else {
				table.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}
			var pat_id = $(this).find('.pat_id').val();
			var base_url = '<?= base_url() ?>';
			var strURL = base_url + "usermg/getPatientInfoalone/" + pat_id;
			$.ajax({
				dataType: "json",
				url: strURL,
				success: function (response) {
					selectPatient(response);
				}
			});
		});

		$('#deltePatientINfo').click(function () {
			$.confirm({
				title: '提示',
				content: ' 确定要删除吗？',
				icon: 'fa fa-warning',
				theme: 'material',
				autoClose: 'chancel|10000',
				animation: 'zoom',
				closeAnimation: 'scale',
				draggable: true,
				buttons: {
					confirm: {
						text: '是',
						keys: ['shift', 'alt'],
						action: function () {
							var base_url = '<?= base_url() ?>';
							var pat_id = $('#patient_id').val();
							var strURL = base_url + "usermg/delect_patient";
							$.post(strURL, {
									pat_id: pat_id
								})
								.done(function (data) {
									$.alert('删除已成功了！');
									table.ajax.reload();
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
		})

		$('#set_access_allow').click(function () {
			var pat_id = $('#patient_id').val();
			var base_url = '<?= base_url() ?>';
			var strURL = base_url + "usermg/setPatientAllow/" + pat_id;
			$.ajax({
				dataType: "json",
				url: strURL,
				success: function (response) {
					if (response.status == "success") {
						$.alert({
							title: '报告!',
							content: '该用户已激活!',
							columnClass: 'small',
							icon: 'fa fa-warning',
							theme: 'material',
							buttons: {
								ok: {
									text: '确定',
									btnClass: 'btn-info',
									action: function () {
										table.ajax.reload();
										$('#set_access_denite').attr('disabled', 'true');
										$('#set_access_allow').attr('disabled', 'true');
									}
								}
							}
						});

					} else {
						return true;
					}

				}
			});

		});

		$('#set_access_denite').click(function () {
			var pat_id = $('#patient_id').val();
			var base_url = '<?= base_url() ?>';
			var strURL = base_url + "usermg/setPatientAllow/" + pat_id;
			$.ajax({
				dataType: "json",
				url: strURL,
				success: function (response) {
					if (response.status == "success") {
						$.alert({
							title: '报告!',
							content: '该用户已注销!',
							columnClass: 'small',
							icon: 'fa fa-warning',
							theme: 'material',
							buttons: {
								ok: {
									text: '确定',
									btnClass: 'btn-info',
									action: function () {
										table.ajax.reload();
										$('#set_access_denite').attr('disabled', 'true');
										$('#set_access_allow').attr('disabled', 'true');
									}
								}
							}
						});

					} else {
						return true;
					}

				}
			});


		});

		$("#search_patient_btn").click(function () {
			var base_url = '<?= base_url()?>';
			var formData = $('#searchPatientForm').serialize();
			var ajaxurl = base_url + 'usermg/getPatientInfo?' + formData;
			table.ajax.url(ajaxurl).load();
		});
	});

</script>
