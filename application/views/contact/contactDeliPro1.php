<link href="<?=base_url()?>assets/global/css/iziModal.min.css" rel="stylesheet" type="text/css" />

<div class="page-content-wrapper">
	<div class="page-content">
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
					<span>咨询详细信息</span>
				</li>
			</ul>

		</div>
		<!-- BEGIN CONTENT BODY -->
		<div class="row" id="sortable_portlets">

			<div class="col-md-12">
				<div class="portlet light portlet-sortable">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-puzzle font-grey-gallery"></i>
							<span class="caption-subject bold font-grey-gallery uppercase"> 咨询详细信息 </span>
						</div>
					</div>
					<div class="portlet-body bg-grey-cararra">
						<div class="row ">
							<div class="col-md-4 col-md-offset-1 col-sm-12 ">
								<div class="mt-element-ribbon">
									<div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-round ribbon-border-dash-hor ribbon-color-info uppercase">
										<?php
if ($contact_info->contact_type == '1') {
    $contact_type = '<span> 远程会诊 </span>';
} elseif ($contact_info->contact_type == '2') {
    $contact_type = '<span> 远程门诊 </span>';
}
echo $contact_type;
?>
									</div>
									<p>
									</p>
									<div class="row" style="padding-top: 5%;">
										<div class="form-group form-md-line-input col-md-offset-1">
											<div class="input-group">
												<span class="input-group-btn btn-left">
													<button class="btn red" disabled type="button">附件上传 </button>
												</span>
												<div class="input-group-control">
													<input type="text" disabled class="form-control" value="<?=$contact_info->check_result_doc?>">
												</div>
												<span class="input-group-btn btn-right">
													<button class="btn green-haze" type="button">预览</button>
												</span>
											</div>

										</div>
										<div class="form-group form-md-line-input col-md-offset-1">
											<div class="input-group">
												<span class="input-group-btn btn-left">
													<button class="btn red" disabled type="button">影像上传 </button>
												</span>
												<div class="input-group-control">
													<input type="text" disabled class="form-control" value="<?=$contact_info->checkup_image_upload?>">
												</div>
												<span class="input-group-btn btn-right">
													<button class="btn green-haze" type="button">预览</button>
												</span>
											</div>

										</div>
										<div class="form-group form-md-line-input">
											<div class="input-group">
												<span class="input-group-btn btn-left">
													<a class="btn btn default btn-info" disabled type="button"> 医院申请医生:</a>
												</span>
												<div class="input-group-control">
													<input type="text" disabled class="form-control" value="<?=$contact_info->usr_name?>">
												</div>
											</div>
										</div>
										<div class="form-group form-md-line-input">
											<div class="input-group">
												<span class="input-group-btn btn-left">
													<a class="btn btn default btn-info" disabled type="button"> 申请医院:</a>
												</span>
												<div class="input-group-control">
													<input type="text" disabled value="<?=$contact_info->req_hospital?>" class="form-control">
												</div>
											</div>
										</div>
										<div class="form-group form-md-line-input">
											<div class="input-group">
												<span class="input-group-btn btn-left">
													<a class="btn btn default btn-info" disabled type="button"> 申请时间:</a>
												</span>
												<div class="input-group-control">
													<input type="text" disabled value="<?=$contact_info->submit_time?>" class="form-control">
												</div>
											</div>
										</div>
										<div class="form-group form-md-line-input">
											<div class="input-group">
												<span class="input-group-btn btn-left">
													<a class="btn btn default btn-info" disabled type="button"> 会诊专家:</a>
												</span>
												<div class="input-group-control">
													<input type="text" disabled value="<?=$contact_info->set_hospital . '  ' . $contact_info->set_class?>" class="form-control">
												</div>
											</div>
										</div>
										<div class="form-group form-md-line-input">
											<div class="input-group">
												<span class="input-group-btn btn-left">
													<a class="btn btn default btn-info" disabled type="button"> 会诊日期:</a>
												</span>
												<div class="input-group-control">
													<input disabled type="text" disabled class="form-control" value="<?=$contact_info->set_check_time?>">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class=" col-md-7 col-sm-12">
								<div class="mt-element-ribbon">
									<div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-round ribbon-border-dash-hor ribbon-color-info uppercase">
										咨询资料
									</div>
									<p>
									</p>
									<div class="row" style="padding-top: 5%;">
										<div class="form-group ">
											<label for="form_control_1">病人描述</label>
											<textarea disabled class="form-control" value="" rows="8"><?=$contact_info->disease_summary?></textarea>
										</div>
										<div class="form-group">
											<label for="form_control_1">病人描述</label>
											<textarea disabled class="form-control" value="" rows="8"><?=$contact_info->medical_history?></textarea>

										</div>
										<div class="form-group">
											<label for="form_control_1">咨询问题</label>
											<textarea disabled class="form-control" value="" rows="8"><?=$contact_info->contact_problem?></textarea>
										</div>
									</div>
								</div>


							</div>
						</div>
						<div class="row">
							<center>
								<button type="button" class="btn blue" onclick="window.history.go(-1)">
									<span class="glyphicon glyphicon-arrow-left"> </span>返回</button>
								<button type="button" class="btn green" onclick="DeliContact('<?=$contact_info->contact_id?>')">
									<span class="glyphicon glyphicon-eye-open"> </span>安排会诊</button>
								<button type="button" class="btn red" onclick="RejrctHuiZhen()">
									<span class="glyphicon glyphicon-ban-circle"> </span>拒绝</button>
							</center>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="contact_review_proc_view" data-iziModal-icon="icon-home"/>
	<script src="<?=base_url()?>assets/global/scripts/iziModal.min.js" type="text/javascript"></script>

	<script>
		var base_url = '<?=base_url()?>';
		function searchDoctor(val) {
			var settings = {
				"url": '<?=base_url()?>' + "contact/get_DoctorInfo/" + val,
				"processData": false,
				"dataType": "json",
				"contentType": false
			}

			jQuery.ajax(settings).success(function (response) {
				var Doc_id = response.id;
				var id = 'doctor_' + Doc_id;
				if (localStorage.getItem(id) == 'true') return true;
				var randID = RondomId();
				var Dis_data = '<li class="mt-list-item" id="' + randID + '">' +
					'<div class="list-icon-container done">' +
					'<i class="fa fa-user"></i>' +
					'</div>' +
					'<input name = "doctor_id[]" value="' + Doc_id + '" type="hidden"/>' +
					'<div class="list-datetime"> <a class="btn btn-circle btn-icon-only light" onclick="deleteaddr(' + randID + ', ' +
					Doc_id + ')"><i class="fa fa-close"></i></a></div>' +
					'<div class="list-item-content">' +
					'<h4 class="uppercase">' +
					'<a href="javascript:;">' + response.usr_id + '</a>' +
					'</h4>' +
					'</div>' +
					'</li>';


				$('#addoctorField').append(Dis_data);

				localStorage.setItem(id, 'true');
			}).error(function (data) {
				$.alert({
					title: '警告!',
					content: '没有这些账号',
					confirm: function () {}
				});
				$('#search_doctorName').val('');

			});


		}

		function RondomId() {
			return (Math.floor((Math.random() * 1000000000000) + 1));

		}

		function selectDoctor(id, name) {
			if (!id) return true;
			var isdoctor = id.split('_')[0];
			var Doc_id = id.split('_')[1];
			if (isdoctor != 'doctor') return true;
			if (localStorage.getItem(id) == 'true') return true;
			var randID = RondomId();
			var Dis_data = '<li class="mt-list-item" id="' + randID + '">' +
				'<div class="list-icon-container done">' +
				'<i class="fa fa-user"></i>' +
				'</div>' +
				'<input name = "doctor_id[]" value="' + Doc_id + '" type="hidden"/>' +
				'<input value="' + Doc_id + '" id = "" type="hidden"/>' +
				'<div class="list-datetime"> <a value="' + id + '" class="btn btn-circle btn-icon-only light" onclick="deleteaddr(' +
				randID + ', ' + Doc_id + ')"><i class="fa fa-close"></i></a></div>' +
				'<div class="list-item-content">' +
				'<h4 class="">' +
				'<a href="javascript:;">' + name + '</a>' +
				'</h4>' +
				'</div>' +
				'</li>';
			$('#addoctorField').append(Dis_data);
			localStorage.setItem(id, 'true');

		}

		function deleteaddr(val, id) {
			id = 'doctor_' + id;
			localStorage.removeItem(id);
			$('#' + val).remove();
		}

		function AnPaihuiZhen() {

			$('#responsive').modal();

		}

		function DeliContact(contact_id) {
		  let settings = {
		      "url": base_url+'contact/ajax_contact_review_proc/'+contact_id,
		      "method": "get"
		  };
		  $('#contact_review_proc_view').iziModal({
		    padding: 15,
		    theme: 'material',
		    closeButton: true,
		    title: '咨询详细信息',
		    width: 800,
		    onOpening: function(modal){
		        modal.startLoading();
		        $.ajax(settings).done(function (response) {
		          $(".iziModal-content").html(response);
		          modal.stopLoading();
		        });
		      }
		  });
		  $('#contact_review_proc_view').iziModal('open');
		}

		function contactDeilclose() {
			$('#submit_AnpaiInfo_Form').find('.help-block-error').remove();
			$('#submit_AnpaiInfo_Form').find('.form-group').removeClass('has-error');
		}

		$(function () {
			localStorage.clear();
			$("#list_hospital").jstree({
				"core": {
					"themes": {
						"responsive": false
					},
					"check_callback": true,
					'data': {
						'type': 'POST',
						'url': '<?=base_url()?>contact/get_hostipal_tree',
						"dataType": "json"
					}
				},
				"types": {
					"default": {
						"icon": "fa fa-folder icon-state-warning icon-lg"
					},
					"file": {
						"icon": "fa fa-file icon-state-warning icon-lg"
					}
				},
				"state": {
					"key": "demo3"
				},
				"plugins": ["dnd", "state", "json_data", "types"]
			}).on("changed.jstree", function (e, data) {
				selectDoctor(data.instance.get_node(data.selected[0]).id, data.instance.get_node(data.selected[0]).text);
			});

			$(".modal").draggable({
				handle: ".modal-header"
			});
			$("#submit_AnpaiInfo_Form").validate({
				errorElement: "span",
				errorClass: "help-block help-block-error",
				focusInvalid: !1,
				ignore: "",
				rules: {
					nick_name: {
						required: true,
					},
					password: {
						required: true,
					},
					start_dataTime: {
						required: true,
					},
					radio2: {
						required: true,
					}
				},
				messages: {
					nick_name: {
						required: " 这是必填字段",
					},
					start_dataTime: {
						required: " 这是必填字段",
					},
					radio2: {
						required: " 这是必填字段.",
					},
					password: {
						required: " 这是必填字段.",
					}
				},
				errorPlacement: function (error, element) {
					var placement = $(element).data('error');
					if (placement) {
						$(placement).append(error)
					} else {
						error.insertAfter(element);
					}
				},
				highlight: function (e) {
					$(e).closest(".form-group").addClass("has-error")
				},
				unhighlight: function (e) {
					$(e).closest(".form-group").removeClass("has-error")
				},
				success: function (e) {
					e.closest(".form-group").removeClass("has-error")
				},
				submitHandler: function (e) {
					AjaxSubmitFormPro();
				}
			});

		});

		function AjaxSubmitFormPro() {
			var form_data = $('#submit_AnpaiInfo_Form').serialize();
			var strURL = '<?=base_url()?>contact/contactAnpaiInfo';
			$.ajax({
				type: 'post',
				data: form_data,
				dataType: "json",
				url: strURL,
				success: function (response) {
					$.alert({
						title: '报告!',
						content: '已成功安排了',
						columnClass: 'small',
						buttons: {
							ok: function () {
								window.location.href = "<?=base_url()?>contact/my_contact";
							},
						}
					});
				},
				error: function (response) {
					$.alert("失败", "失败拒绝.", "error");
				}
			})
		}

		function RejrctHuiZhen() {
			$.confirm({
				title: '拒绝咨询会诊',
				typeAnimated: true,
				theme: 'material',
				columnClass: 'small',
				draggable: true,
				content: '' +
					'<form action="" class="formName" id ="SubmitMoneyRequestForm">' +
					'<div class="form-group form-md-line-input form-md-floating-label">' +
					' <textarea class="form-control" name = "reject_reason" id = "reject_reason" rows="5"></textarea>' +
					'<label for="form_control_1">备注</label>' +
					'</div>' +
					'</form>',
				buttons: {
					formSubmit: {
						text: '确定',
						btnClass: 'btn green-haze',
						action: function () {
							var textarea = $('#reject_reason').val();
							var form_data = $('#SubmitMoneyRequestForm').serialize();
							if (textarea == "") {
								$.alert("请输入拒绝理由", "警告！", "error");
								return true;
							}
							var strURL = "<?=base_url()?>contact/RejrctHuiZhen/" + $('#contact_id').val();
							$.ajax({
								type: 'post',
								data: form_data,
								dataType: "json",
								url: strURL,
								success: function (response) {
									$.alert({
										title: '报告!',
										content: '已成功拒绝',
										columnClass: 'small',
										buttons: {
											ok: function () {
												window.location.href =
													"<?=base_url()?>contact/my_contact";
											},
										}
									});
								},
								error: function (response) {
									$.alert("失败", "失败拒绝.", "error");
								}
							});
						}
					},
					cancel: {
						text: '取消',
						btnClass: 'btn yellow-mint',
						action: function () {
						}
					}
				},
				onContentReady: function () {
					// bind to events
					var jc = this;
					this.$content.find('form').on('submit', function (e) {
						// if the user submits the form by pressing enter in the field.
						e.preventDefault();
						jc.$$formSubmit.trigger('click'); // reference the button and click it
					});
				}
			});

		}

	</script>
