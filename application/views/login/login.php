<!DOCTYPE html>
<html lang="utf-8">

<head>
	<meta charset="utf-8" />
	<title>
		<?=$this->lang->line('login_title')?>
	</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link rel="icon" href="<?=base_url()?>/assets/images/favicon.png" sizes="32x32">
	<link href="<?=base_url()?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"
	/>
	<link href="<?=base_url()?>assets/global/css/jquery-confirm.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"
	/>
	<link href="<?=base_url()?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"
	/>
	<link href="<?=base_url()?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css"
	/>
	<link href="<?=base_url()?>assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css"
	/>
	<link href="<?=base_url()?>assets/pages/css/login-4.min.css" rel="stylesheet" type="text/css" />

	<body class=" login">
		<div class="logo">
		</div>
		<div class="content" style="margin-top: 5%;">
			<form class="login-form" action="<?=base_url()?>login/check_user" method="post">
				<h2 class="form-title">云平台登录 &nbsp;
					<i class="fa fa-key"></i>
				</h2>
				<?php if ($login_status == 'error') {
    ?>
				<div class="alert alert-danger">
						<button class="close" data-close="alert"></button>
						<span><?=$error_content?>	</span>
				</div>
			  <?php
} else {
        ?>
							<div class="alert alert-danger display-hide">
								<button class="close" data-close="alert"></button>
								<span> 请输入用户名和密码 </span>
							</div>
			  <?php
    } ?>
				<div class="form-group">
					<div class="input-group input-group">
						<span class="input-group-btn btn-left">
							<button class="btn blue-madison" disabled type="button">用户名</button>
						</span>
						<div class="input-group-control">
							<input type="text" class="form-control input" name="username" placeholder="用户名">
							<div class="form-control-focus"> </div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group input-group">
						<span class="input-group-btn btn-left">
							<button class="btn blue-madison" disabled type="button">密码&nbsp;&nbsp;&nbsp;</button>
						</span>
						<div class="input-group-control">
							<input type="password" class="form-control input" placeholder="密码" name="password">
							<div class="form-control-focus"> </div>
						</div>
					</div>
				</div>
				<div class="form-actions">
					<div class="pull-right">
						<button type="submit" class="btn btn-circle blue"> 登录 </button>
						<button type="button" id="register-btn" class="btn-circle btn green">注册</button>
					</div>
				</div>
				<div class="forget-password">
					<h4>忘记密码了吗 ？</h4>
					<p> 不用担心 请点击
						<a href="javascript:;" id="forget-password"> 这里 </a> 重置您的密码 </p>
				</div>
			</form>
			<form class="forget-form" id="forgetPassword" action="#" method="post">
				<h3>忘记密码 ？</h3>
				<p> </p>
				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">手机号</label>
					<div class="input-icon">
						<i class="fa fa-mobile-phone"></i>
						<input class="form-control placeholder-no-fix" type="text" placeholder="手机号" name="username" id="fusername" /> </div>
					<span id="fusernameInput-error"></span>

				</div>
				<div class="row">
					<div class="form-group col-md-8 col-sm-12">
						<label class="control-label visible-ie8 visible-ie9">验证码</label>
						<div class="input-icon">
							<i class="fa fa-check-square-o"></i>
							<input class="form-control placeholder-no-fix" type="text" placeholder="验证码" name="VerificationNum" id="Verification" />
						</div>
					</div>
					<div class="form-group col-md-4 col-sm-12">
						<input type="button" id="GetVerificationForgetbtn" class="btn green" value="获取验证码 " />
					</div>

				</div>
				<div class="row">
					<div class="col-md-6 form-group">
						<label class="control-label visible-ie8 visible-ie9">密码</label>
						<div class="input-icon">
							<i class="fa fa-lock"></i>
							<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="forget_password" placeholder="密码" name="password"
							/> </div>
					</div>
					<div class="form-group col-md-6">
						<label class="control-label visible-ie8 visible-ie9">确认密码</label>
						<div class="controls">
							<div class="input-icon">
								<i class="fa fa-check"></i>
								<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="确认密码" name="rfpassword" /> </div>
						</div>
					</div>
				</div>
				<div class="form-actions">
					<button type="button" id="back-btn" class="btn red btn-outline">返回</button>
					<button type="button" class="btn green pull-right" id="ChangePassword_btn"> 修改密码 </button>
				</div>
			</form>
			<form class="register-form" id="register_form" method="post">
				<h3>
					<span class="glyphicon glyphicon-user"> </span> &nbsp;用户注册</h3>
				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">姓名：</label>
					<div class="input-icon">
						<i class="fa fa-font"></i>
						<input class="form-control placeholder-no-fix" type="text" placeholder="姓名" name="fullname" /> </div>
				</div>
				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">身份证号</label>
					<div class="input-icon">
						<i class="fa fa-credit-card"></i>
						<input class="form-control placeholder-no-fix" type="text" placeholder="身份证号" name="IDCardNum" id="IDCardNum" /> </div>
				</div>
				<span id="IDCardNum-error"></span>
				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">手机号</label>
					<div class="input-icon">
						<i class="fa fa-mobile-phone"></i>
						<input class="form-control placeholder-no-fix" type="text" placeholder="手机号" name="phoneNum" id="phone_num" /> </div>
					<span id="usernameInput-error"></span>

				</div>
				<div class="row">
					<div class="form-group col-md-8 col-sm-12">
						<label class="control-label visible-ie8 visible-ie9">验证码</label>
						<div class="input-icon">
							<i class="fa fa-check-square-o"></i>
							<input class="form-control placeholder-no-fix" type="text" placeholder="验证码" name="VerificationNum" id="VerificationNum"
							/>
						</div>
					</div>
					<div class="form-group col-md-4 col-sm-12">
						<input type="button" id="GetVerificationbtn" class="btn green" value="获取验证码 " />
					</div>

				</div>
				<div class="row">
					<div class="col-md-6 form-group">
						<label class="control-label visible-ie8 visible-ie9">密码</label>
						<div class="input-icon">
							<i class="fa fa-lock"></i>
							<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="密码"
							name="password" /> </div>
					</div>
					<div class="form-group col-md-6">
						<label class="control-label visible-ie8 visible-ie9">确认密码</label>
						<div class="controls">
							<div class="input-icon">
								<i class="fa fa-check"></i>
								<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="确认密码" name="rpassword" /> </div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="mt-checkbox mt-checkbox-outline">
						<input type="checkbox" name="tnc" value="1000" /> 我同意
						<a href="javascript:;">服务条款 </a>
						<span></span>
					</label>
					<div id="register_tnc_error"> </div>
				</div>
				<div class="form-actions">
					<button id="register-back-btn" type="button" class="btn red"> 返回 </button>
					<button type="submit" id="register-submit-btn" class="btn green pull-right"> 注册 </button>
				</div>
			</form>
		</div>
		<div class="copyright"> 2017 &copy; 杭州健培科技有限公司 </div>
		<!--[if lt IE 9]>
				<script src="<?=base_url()?>assets/global/plugins/respond.min.js"></script>
				<script src="<?=base_url()?>assets/global/plugins/excanvas.min.js"></script>
		<![endif]-->

		<script src="<?=base_url()?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/global/scripts/jquery-confirm.min.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/pages/scripts/login-4.min.js" type="text/javascript"></script>
	</body>
</html>
<script type="text/javascript">
	var base_url = '<?=base_url()?>';
	$(function () {
		$('#GetVerificationbtn').click(function () {
			var InterValObj; //timer变量，控制时间
			var count = 70; //间隔函数，1秒执行
			var curCount; //当前剩余秒数
			curCount = count;
			var phone_num = $('#phone_num').val();
			if (phone_num == '') {
				$.alert({
					title: '报告!',
					content: '请正确的输入手机号码',
					icon: 'fa fa-warning',
					columnClass: 'small',
					theme: "material",
					buttons: {
						ok: function () {
							return true;

						}
					}
				});

			}
			var base_url = "<?=base_url();?>";
			var url = base_url + "login/send_sms/" + phone_num;
			$.ajax({url: url, success: function(result){
				console.log(result);
				if (!result.response_code) {
					$.alert({
						title: '报告!',
						content: '发送失败. 请正确的输入手机号码， 再发送',
						icon: 'fa fa-warning',
						columnClass: 'small',
						theme: "material",
						buttons: {
							ok: function () {
								return true;
							}
						}
					});
				} else {
					var time = 70;
					function timeCountDown() {
						if (time == 0) {
							clearInterval(timer);
							$("#GetVerificationbtn").removeAttr("disabled"); //启用按钮
							$("#GetVerificationbtn").val("重新发送");
							return true;
						}
						$('#GetVerificationbtn').val(time + "秒后重试");
						time--;
						return false;
					}
					$("#GetVerificationbtn").attr("disabled", "true");
					timeCountDown();
					var timer = setInterval(timeCountDown, 1000);
					$.alert({
						title: '标示!',
						icon: 'fa fa-check',
						columnClass: 'small',
						content: '已发送。。。',
						buttons: {
							ok: function () {
								return true;
							}
						}
					});
				}
	    }});
		});

		$('#GetVerificationForgetbtn').click(function () {
			var InterValObj; //timer变量，控制时间
			var count = 70; //间隔函数，1秒执行
			var curCount; //当前剩余秒数
			curCount = count;
			var phone_num = $('#fusername').val();
			if (phone_num == '') {
				$.alert({
					title: '报告!',
					content: '请正确的输入手机号码',
					icon: 'fa fa-warning',
					columnClass: 'small',
					theme: "material",
					buttons: {
						ok: function () {
							return true;
						}
					}
				});

			}
			var base_url = "<?=base_url();?>";
			var url = base_url + "login/send_sms/" + phone_num;
			$.post(url, function (result) {
				console.log(result);
				if (!result.response_code) {
					$.alert({
						title: '报告!',
						content: '发送失败. 请正确的输入手机号码， 再发送',
						icon: 'fa fa-warning',
						columnClass: 'small',
						theme: "material",
						buttons: {
							ok: function () {
								return true;
							}
						}
					});
				} else {
					var time = 70;
					function timeCountDown() {
						if (time == 0) {
							clearInterval(timer);
							$("#GetVerificationForgetbtn").removeAttr("disabled"); //启用按钮
							$("#GetVerificationForgetbtn").val("重新发送");
							return true;
						}
						$('#GetVerificationForgetbtn').val(time + "秒后重试");
						time--;
						return false;
					}
					$("#GetVerificationForgetbtn").attr("disabled", "true");
					timeCountDown();
					var timer = setInterval(timeCountDown, 1000);
					$.alert({
						title: '标示!',
						icon: 'fa fa-check',
						columnClass: 'small',
						content: '已发送。。。',
						buttons: {
							ok: function () {
								return true;
							}
						}
					});
				}
			})
		});


		$('#ChangePassword_btn').click(function () {
			var strURL = base_url + 'login/forgetPassword';
			var formData = $('#forgetPassword').serialize();
			$.ajax({
				dataType: "json",
				url: strURL,
				type: "post",
				data: formData,
				success: function (response) {
					if(response.response_code){
						$.alert({
							title: '报告!',
							content: response.message,
							icon: 'fa fa-warning',
							columnClass: 'small',
							theme: "material",
							buttons: {
								ok: function () {
									location.reload();
								}
							}
						});

					}else{
						$.alert({
							title: '警告!',
							content: response.message,
							icon: 'fa fa-warning',
							columnClass: 'small',
							theme: "material",
							buttons: {
								ok: function () {
									return true;
								}
							}
						});
					}
				}
			});
		});

		$('#IDCardNum').change(function () {
			var strURL = base_url + 'login/checkDuplicationIDCard/' + this.value;
			$.ajax({
				dataType: "json",
				url: strURL,
				success: function (response) {
					if (response.result == null) {
						$('#IDCardNum-error').html(response.result);
						$('#register-submit-btn').removeAttr('disabled');
					} else {
						$('#IDCardNum-error').html(response.result);
						$('#register-submit-btn').attr('disabled', 'true');
					}
				}
			});
		});

		$('#phone_num').change(function () {
			var strURL = base_url + 'login/checkDuplicationUser/' + this.value;
			$.ajax({
				dataType: "json",
				url: strURL,
				success: function (response) {
					if (response != null) {
						$('#usernameInput-error').html(response.result);
						$('#register-submit-btn').removeAttr('disabled');
					} else {
						$('#usernameInput-error').html("");
						$('#register-submit-btn').attr('disabled', 'true');
					}
				}
			});


		})

	});

	function registerPatient() {
		var formData = $('#register_form').serialize();
		var strUrl = base_url + 'login/registerPatient';
		$.ajax({
			dataType: "json",
			type: "post",
			url: strUrl,
			data: formData,
			success: function (response) {
				if (response.response_cod) {
					$.alert({
						title: '成功!',
						columnClass: 'small',
						content: '已成功注册了！.',
						theme: "material",
						buttons: {
							ok: function () {
								window.location.reload();
							}
						}
					});
				} else {
					$.alert({
						title: '报告!',
						content: response.message,
						icon: 'fa fa-warning',
						columnClass: 'small',
						theme: "material",
						buttons: {
							ok: function () {

							}
						}
					});
				}
			}
		});
	}

</script>
