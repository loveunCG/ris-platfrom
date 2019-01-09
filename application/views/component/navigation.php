c	<!-- BEGIN HEADER -->
	<div class="page-header navbar navbar-fixed-top">
		<!-- BEGIN HEADER INNER -->
		<div class="page-header-inner ">
			<!-- BEGIN LOGO -->
			<div class="page-logo">
				<a href="<?=base_url()?>">
					<img src="<?=base_url()?>assets/layouts/layout2/img/logo-default.png" alt="logo" class="logo-default" /> </a>
				<div class="menu-toggler sidebar-toggler">
				</div>
			</div>
			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
			<!-- BEGIN PAGE TOP -->
			<div class="page-top">
				<!-- BEGIN TOP NAVIGATION MENU -->
				<div class="top-menu">
					<ul class="nav navbar-nav pull-right">
						<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<i class="icon-bell"></i>
								<span class="badge badge-default" id="notificationcount"> 0 </span>
							</a>
							<ul class="dropdown-menu">
								<li class="external">
									<h3>
										<span class="bold badge badge-default" id="notification_count"></span> 通知</h3>
									<a href="#" class="btn btn-circle">
										<i class="fa fa-send"></i>
									</a>

								</li>
								<li>
									<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283" id="notificationfield">

									</ul>
								</li>
							</ul>
						</li>
						<!-- BEGIN INBOX DROPDOWN -->
						<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
						<li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<i class="icon-envelope-open"></i>
								<span class="badge badge-default" id="alram_count">0 </span>
							</a>
							<ul class="dropdown-menu">
								<li class="external">
									<h3>您有
										<span class="bold" id="alram_this_count"> 0 </span>个 咨询通知</h3>
								</li>
								<li>
									<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283" id="alram_field_view">

									</ul>
								</li>
							</ul>
						</li>
						<li class="dropdown dropdown-user">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<img alt="" class="img-circle" src="<?=base_url()?>assets/layouts/layout2/img/avatar3.jpg" />
								<span class="username username-hide-on-mobile">
									<?=$this->session->userdata('usr_name')?>
								</span>
								<i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-default">
								<li>
									<a data-toggle="modal" href="#user_profile">
										<i class="icon-user"></i> 我的账户 </a>
								</li>
								<li>
									<a type="button" id="change_password">
										<span class="glyphicon glyphicon-wrench"> </span> 修改密码 </a>
								</li>
								<li>
									<a class="log-out" data-toggle="modal">
										<span class="glyphicon glyphicon-log-out"> </span> 退出 </a>
								</li>
							</ul>
						</li>
						<div id="user_profile" class="modal fade" tabindex="-1" data-focus-on="input:first">
							<div class="modal-header bg-blue">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title font-light">我的信息</h4>
							</div>
							<div class="modal-body">
								<div class="table-scrollable table-scrollable-borderless">
									<table class="table table-hover table-light">
										<thead>
											<tr class="uppercase">
												<th colspan="2"> 姓名 </th>
												<th> 医院名称</th>
												<th> 职称 </th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="fit">
													<img class="user-pic" src="<?=base_url()?>assets/pages/media/users/avatar4.jpg"> </td>
												<td>
													<?=$this->session->userdata('usr_name')?>
												</td>
												<td>
													<?=$this->session->userdata('hospital_name')?>
												</td>
												<td>
													<?php
                                                    $usr_role = $this->session->userdata('usr_role');
                                                    if($usr_role==1){
                                                        echo '管理员';
                                                    }elseif($usr_role==10){
                                                        echo '子医院管理员';

                                                    }elseif($usr_role==100){
                                                        echo '主任';

                                                    }elseif($usr_role==1024){
                                                        echo '总管理员';
                                                    }else{
                                                        echo '医院';
                                                    }
                                                    ?>
												</td>
											</tr>

										</tbody>
									</table>
								</div>
								<div class="modal-footer">
									<button type="button" data-dismiss="modal" class="btn blue-chambray">返回</button>
								</div>
							</div>
						</div>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<script>

        var usr_id = '<?=$this->session->userdata('id')?>';

		$(function () {
			var strURL = '<?=base_url()?>report/notification';
			setInterval(function () {
				$.ajax({
					dataType: "json",
					url: strURL,
					success: function (response) {
						var current_count = $('#notificationcount').val();
						$('#notificationcount').html(response.count);
						$('#notificationfield').html(response.content);
						$('#notification_count').html(response.count);
					}
				});
			}, 3000);

			setInterval(AlramContact(), 20000);

			$('#change_password').click(function () {
				$.confirm({
					title: '修改密码',
					content: '<form action="#" id = "change_passwdForm">\n' +
						'<div class="form-body">\n' +
						'<div class="form-group form-md-line-input">' +
						'<input type="password" class="form-control" name="old_password" id="old_password">' +
						'<label for="pst_title">旧密码*</label>' +
						'</div>' + '<div class="form-group form-md-line-input ">' +
						'<input type="password" class="form-control" name="new_passwd" id="new_passwd" value = "">' +
						'<label for="pst_name">新密码</label>' +
						'</div>' + '<div class="form-group form-md-line-input ">' +
						'<input type="password" class="form-control" name="rnew_passwd" id="rnew_passwd" value = "">' +
						'<input type="hidden" name="usr_id" value = "<?=$this->session->userdata('usr_id')?>">' +
					'<label for="pst_content">确认密码</label>' +
					'</div>' +
					'</div>' +
					'</form>',
					theme: 'material',
					columnClass: 'small',
					closeIcon: true,
					typeAnimated: true,
					draggable: true,
					icon: 'glyphicon glyphicon-wrench',
					onContentReady: function () {
						var e = $("#change_passwdForm"),
							r = $(".alert-danger", e),
							i = $(".alert-success", e);
						$("#change_passwdForm").validate({
							errorElement: "span",
							errorClass: "help-block help-block-error",
							focusInvalid: !1,
							messages: {
								old_password: {
									required: "这是必填字段"
								},
								new_passwd: {
									required: "这是必填字段.",
									minlength: $.validator.format("最少要输入 {0} 个字符")
								},
								rnew_passwd: {
									required: "这是必填字段",
									equalTo: "你的输入不相同"
								}
							},
							rules: {
								old_password: {
									required: !0,
								},
								new_passwd: {
									minlength: 4,
									required: !0
								},
								rnew_passwd: {
									equalTo: "#new_passwd",
									required: !0
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
								changePassWd();
							}
						});
						$('#old_password').change(function (event) {
							var val = $(this).val();
							var base_url = '<?=base_url()?>';
							var strURL = base_url + "usermg/check_passwd";
							var usr_id = '<?=$this->session->userdata('usr_id')?>';
							$.post(strURL, {
								passwd: val,
								usr_id: usr_id
							}).done(function (data) {
								if (data) {
									$.alert({
										title: '报告!',
										content: '旧密码错了。 再输入。。',
										theme: 'material',
										columnClass: 'small',
										buttons: {
											ok: function () {
												$('#old_password').val('');
											}
										}
									});
								} else {
									return true;

								}
							});
						});
					},
					buttons: {
						formSubmit: {
							text: '提交',
							btnClass: 'btn blue',
							action: function () {
								$('#change_passwdForm').submit();
							}
						},
						cancel: {
							text: '返回',
							btnClass: 'btn green',
							action: function () {}
						}

					}
				});
			});

            AlramContact();

        });

		function AlramContact() {
			var setting = {
				"async": false,
				"url": '<?=base_url()?>' + "contact/get_alramInfo/" + usr_id,
				"method": "POST",
				"dataType": "json",
				"processData": false
			};
			jQuery.ajax(setting).success(function (response) {
				if (response.length == 0) return true;
				var alramView = $('#alram_field_view');
				var alram_count = $('#alram_count');
				var index1;
                var display ='';
				for (index1 in response) {

                    display += '<li>' +
						'<a href="<?=base_url()?>contact/contactRoom/' + response[index1].contact_id + '/' + response[index1].password +
						'">' +
						'<span class="photo">' +
						'<img src="<?=base_url()?>assets/layouts/layout/img/avatar2.jpg" class="img-circle" alt=""> </span>' +
						'<span class="subject">' +
						'<span class="from"> ' + response[index1].contact_title + ' </span>' +
						'<span class="time">' + response[index1].set_check_time + ' </span>' +
						'</span>' +
						'<span class="message"> ' + response[index1].req_hospital + ' </span>' +
						'</a>' +
						'</li>';
				}
                alramView.html(display);
                alram_count.html(parseInt(index1) + 1);
				$('#alram_this_count').html(parseInt(index1) + 1);
			});
		}

		function changePassWd() {
			var formData = $('#change_passwdForm').serialize();
			var settings = {
				"url": '<?=base_url()?>' + "usermg/changePasswd/",
				"dataType": "json",
				"data": formData,
				"method": "POST"
			};

			jQuery.ajax(settings).success(function (response) {
				if (response.status == 'success') {
					$.alert({
						title: '提示!',
						content: '修改成功了',
						columnClass: 'small',
						buttons: {
							ok: function () {
								return true;
							}
						}
					});
				}
			});
		}
	</script>
