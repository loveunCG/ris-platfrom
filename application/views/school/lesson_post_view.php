<link href="<?= base_url() ?>assets/css/todo-2.min.css" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
	<div class="page-content">
		<h3 class="page-title">
			<?=$menutitle?>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="/">
						<?=$menutitle?>
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<span>我发表的评论</span>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="todo-content">
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption">
								<span class="glyphicon glyphicon-send"> </span>
								<span class="caption-subject font-green-sharp bold uppercase">我发表的评论</span>
							</div>

						</div>
						<!-- end PROJECT HEAD -->
						<div class="portlet-body">
							<div class="row">
								<div class="col-md-5 col-sm-4">
									<div class="todo-tasklist">
										<?php foreach ($all_post_Info as $value):
                                            $src = $this->session->userdata('id') == $value->pst_doctor ? 'assets/layouts/layout2/img/avatar3.jpg':'assets/pages/media/users/avatar'.rand(1, 10).'.jpg';
                                            ?>
										<div class="todo-tasklist-item todo-tasklist-item-border-blue" onclick="viewCommentList('<?=$value->post_id?>');">
											<img class="todo-userpic pull-left" src="<?=base_url().$src?>" width="27px" height="27px">
											<div class="todo-tasklist-item-title">
												<?=$value->pst_title?>
											</div>
											<div class="todo-tasklist-item-text">
												<?=$value->pst_content?>
											</div>
											<div class="todo-tasklist-controls pull-left">
												<span class="todo-tasklist-date">
													<i class="fa fa-calendar"></i>
													<?=$value->pst_time?>
												</span>
												<span class="todo-tasklist-badge badge badge-roundless">论点</span>
											</div>
										</div>
										<?php endforeach;?>
									</div>
								</div>
								<div class="col-md-7 col-sm-8" id="commentViewField">

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>


<script>
	function viewCommentList(val) {
		var strURL = '<?=base_url()?>' + 'school/commentView/' + val;
		$('#commentViewField').load(strURL);
	}

	function submitComment() {
		var subData = $('#commentForm').serialize();
		var strURL = '<?=base_url()?>' + 'school/submitComment/';
		$.ajax({
			dataType: "json",
			url: strURL,
			data: subData,
			type: 'post',
			success: function (response) {
				if (response.status == 'success') {
					$.alert({
						icon: 'fa fa-warning',
						title: '提示!',
						closeIcon: true,
						theme: 'bootstrap',
						columnClass: 'small',
						content: '已成功留言了！',
						draggable: true,
						animation: 'zoom',
						closeAnimation: 'scale',
						buttons: {
							ok: function () {
								viewCommentList($('#cmt_pst_id').val());

							}
						}
					});
				} else {
					$.alert({
						icon: 'fa fa-warning',
						title: '提示!',
						closeIcon: true,
						theme: 'bootstrap',
						columnClass: 'small',
						content: '失败留言了！',
						draggable: true,
						animation: 'zoom',
						closeAnimation: 'scale'
					});
				}
			}
		});

	}

</script>
