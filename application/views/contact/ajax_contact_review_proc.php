<form class = "submit_AnpaiInfo_Form">
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6">
					<div class="form-group">
						<label>标题：</label>
						<div class="input-icon right">
							<i class="fa fa fa-user font-blue"></i>
							<input type="text" name="contact_title" class="form-control" placeholder="标题">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>密码：</label>
						<div class="input-icon right">
							<i class="fa fa-unlock-alt font-blue"></i>
							<input type="password" name="password" class="form-control" placeholder="密码"> </div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6">
					<div class="input-icon">
						<i class="fa fa-search"></i>
						<input type="text" name = "search_doctorName" onchange="searchDoctor(this.value)" class="form-control input-circle" placeholder="请输入找关键字">
					</div>
					<div class="col-md-12" style="margin-top: 10px;">
						<div class="scroller" style="height:350px">
							<div class="list_hospital tree-demo">
							</div>
						</div>
					</div>
				</div>
				<div class=" col-md-6" style="margin-top: 10px;">
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user font-green"></i>
								<span class="caption-subject font-green bold uppercase">联系人</span>
							</div>
						</div>
						<div class="portlet-body">
							<div class="scroller" style="height:200px">
								<div class="mt-element-list">
									<div class="mt-list-container list-simple">
										<ul class = "addoctorField">
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-8">
					<div class="form-group">
						<label class="control-label col-md-4">开始时间：</label>
						<div class="col-md-8">
							<div class="input-group date form_datetime input-large">
								<input type="text"  name="set_check_time" value="<?=$contact_info->set_check_time?>" readonly class="form-control">
								<span class="input-group-btn">
									<button class="btn default date-set" type="button">
										<i class="fa fa-calendar"></i>
									</button>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<input type="hidden" name="contact_id" value="<?=$contact_info->contact_id?>">
						<label class="control-label col-md-4">调整时间：</label>
						<div class="col-md-8">
							<div class="input-group date form_datetime input-large">
								<input type="text"  readonly name="control_dataTime" class="form-control">
								<span class="input-group-btn">
									<button class="btn default date-set" type="button">
										<i class="fa fa-calendar"></i>
									</button>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group form-md-line-input">
						<label class="col-md-4 control-label" for="form_control_1">调整</label>
						<div class="col-md-8">
							<div class="md-radio-inline">
								<div class="md-radio">
									<input type="radio" id="123123123123123123" name="iscontrol_time" value="yes" class="md-radiobtn">
									<label for="123123123123123123">
										<span></span>
										<span class="check"></span>
										<span class="box"></span>是</label>
								</div>
								<div class="md-radio">
									<input type="radio" name="iscontrol_time" id = "radio5323234234" value="no" class="md-radiobtn" checked="">
									<label for="radio5323234234">
										<span></span>
										<span class="check"></span>
										<span class="box"></span>否</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-6">
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn green"><i class = "fa fa-check-square"></i>确定</button>
		<button type="button" class="btn red" data-izimodal-open="#another-modal" data-izimodal-transitionout="bounceOutDown" data-izimodal-zindex="20000" data-izimodal-preventclose=""><span class="glyphicon glyphicon-ban-circle"> </span>取消</button>
	</div>
</form>
<script src="<?=base_url()?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<script>
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
			$('.addoctorField').append(Dis_data);
			localStorage.setItem(id, 'true');
		}).error(function (data) {
			$.alert({
				title: '警告!',
				content: '没有这些账号',
				confirm: function () {}
			});
			$( "input[name='search_doctorName']" ).val('');

		});

	}

	function RondomId() {
		return (Math.floor((Math.random() * 1000000000) + 1));
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
		$('.addoctorField').append(Dis_data);
		localStorage.setItem(id, 'true');
	}

	function deleteaddr(val, id) {
		id = 'doctor_' + id;
		localStorage.removeItem(id);
		$('#' + val).remove();
	}
	function contactDeilclose() {
		$('.submit_AnpaiInfo_Form').find('.help-block-error').remove();
		$('.submit_AnpaiInfo_Form').find('.form-group').removeClass('has-error');
	}

	$(function () {
		localStorage.clear();
    $(".form_datetime").datetimepicker({
        autoclose: true,
        isRTL: App.isRTL(),
        format: "yyyy-mm-dd hh:ii",
        pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left")
    });
		$(".list_hospital").jstree({
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
		$(".submit_AnpaiInfo_Form").validate({
			errorElement: "span",
			errorClass: "help-block help-block-error",
			focusInvalid: !1,
			ignore: "",
			rules: {
				contact_title: {
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
				contact_title: {
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
		var form_data = $('.submit_AnpaiInfo_Form').serialize();
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
					theme: 'material',
					buttons: {
						ok: function () {
							window.location.href = "<?=base_url()?>contact/my_contact";
						},
					}
				});
			},
			error: function (response) {
				$.alert("提交不正确!", "失败审核.", "error");
			}
		})
	}

</script>
