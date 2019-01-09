<div class="page-footer">
	<div class="footer">
		2017 &copy;
		<span> 网址：www.jianpeicn.com 邮箱： yingxiangyun@jianpeicn.com 杭州健培科技有限公司 客服：0571-86668666</span>

	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<script src="<?=base_url()?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/scripts/jquery-confirm.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/scripts/materialize.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/pages/scripts/portlet-draggable.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>

<script>
	$(document).ready(function () {
		$('a.log-out').confirm({
			title: '您确定要退出吗?',
			content: '您确定要退出吗？',
			autoClose: 'cancel|6000',
			type: 'material',
			typeAnimated: true,
			animationSpeed: 1000,
			buttons: {
				ok: {
					text: '是',
					action: function () {
						var strURL = '<?=base_url()?>' + 'login/logout';
						window.location.href = strURL;
					}
				},
				cancel: {
					text: '否'
				}
			}
		});
		setInterval(CheckSession, 5000);
	});

	function CheckSession() {
		var base_url = '<?=base_url()?>';
		var strURL = base_url + "patient/getPatientsession/";
		$.ajax({
			dataType: "json",
			url: strURL,
			success: function (response) {
			}
		});
	}

</script>
