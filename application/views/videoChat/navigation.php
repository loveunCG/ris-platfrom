
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner ">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="<?=base_url()?>">
					<img src="<?=base_url()?>assets/layouts/layout2/img/logo-default.png" alt="logo" class="logo-default" /> </a>
			<div class="menu-toggler sidebar-toggler">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>

		<!-- END PAGE ACTIONS -->
		<!-- BEGIN PAGE TOP -->
		<div class="page-top">

			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					<!-- BEGIN NOTIFICATION DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="material-icons dp48">visibility</i>
                        </a>
						<ul class="dropdown-menu">
							<li class="external">
								<h3>
									<span class="bold badge badge-default" id="notification_count"></span> 通知</h3>
								<a href="<?= base_url() ?>report/" class="btn-circle btn-icon-only">
																	<i class="fa fa-eye"></i>
								</a>

							</li>
						</ul>
					</li>
					<li class="dropdown dropdown-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<img alt="" class="img-circle" src="<?=base_url()?>assets/layouts/layout2/img/avatar3.jpg" />
								<span class="username username-hide-on-mobile"> <?=$this->session->userdata('usr_name')?> </span>
								<i class="fa fa-angle-down"></i>
							</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<a class="log-out" data-toggle="modal"><i class="log-out icon-key"></i> 退出 </a>
							</li>
						</ul>
					</li>

					<li class="dropdown dropdown-extended quick-sidebar-toggler">
							<span class="sr-only">Toggle Quick Sidebar</span>
							<i class="icon-logout"></i>
					</li>
					<div id="user_profile" class="modal fade" tabindex="-1" data-focus-on="input:first">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">我的信息</h4>
						</div>
						<div class="modal-body">
							<div class="table-scrollable table-scrollable-borderless">
								<table class="table table-hover table-light">
									<thead>
										<tr class="uppercase">
											<th colspan="2"> 姓名 </th>
											<th> 状态</th>
											<th> 等级 </th>
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
												<?=$this->session->userdata('usr_status')?>
											</td>
											<td>
												<?=$this->session->userdata('usr_degree')?>
											</td>
										</tr>

									</tbody>
								</table>
							</div>
							<div class="modal-footer">
								<button type="button" data-dismiss="modal" class="btn btn-outline dark">推出</button>
							</div>
						</div>
					</div>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"> </div>

<script>
	$(function () {

		var strURL = '<?=base_url()?>report/notification';
		$.ajax({
			dataType: "json",
			url: strURL,
			success: function (response) {
				$('#notificationcount').html(response.count);
				$('#notificationfield').html(response.content);
				$('#notification_count').html(response.count);

			}
		});
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
		}, 30000);


	});

</script>
