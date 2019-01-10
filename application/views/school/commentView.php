<form action="#" class="form-horizontal" id="commentForm">
	<div class="tabbable-line">
		<ul class="nav nav-tabs ">
			<li class="active">
				<a href="#tab_1" data-toggle="tab"> 评论 </a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tab_1">
				<!-- TASK COMMENTS -->
				<div class="form-group">
					<div class="col-md-12">
						<ul class="media-list">
							<?php foreach ($commentInfo as $value):
                                $src = $this->session->userdata('id') == $value->cmt_doctor ? 'assets/layouts/layout2/img/avatar3.jpg':'assets/pages/media/users/avatar2.jpg';
                                $statusbtn = $this->session->userdata('id') == $value->pst_doctor ? 'disabled':'';
                                ?>
							<li class="media">
								<a class="pull-left" href="javascript:;">
									<img class="todo-userpic" src="<?=base_url().$src?>" width="32px" height="32px"> </a>
								<div class="media-body todo-comment">
									<button type="button" class="todo-comment-btn btn btn-circle btn-default btn-sm">再评论</button>
									<p class="todo-comment-head">
										<span class="todo-comment-username">
											<?=$value->usr_name?>
										</span> &nbsp;
										<span class="todo-comment-date">
											<?=$value->cmt_time?>
										</span>
									</p>
									<p class="todo-text-color">
										<?=$value->cmt_content?>
									</p>
									<!-- Nested media object -->
								</div>
							</li>
							<?php endforeach;?>
						</ul>
					</div>
				</div>
				<div class="col-md-12">
					<ul class="media-list">
						<li class="media">
							<a class="pull-left" href="javascript:;">
								<img class="todo-userpic" src="<?=base_url()?>assets/pages/media/users/avatar2.jpg" width="32px" height="32px"> </a>
							<div class="media-body">
                                <input name="cmt_pst_id" id="cmt_pst_id" type="hidden" value="<?=$post_id?>">
                                <input name="cmt_doctor" id="cmt_doctor" type="hidden" value="<?=$this->session->userdata('id')?>">
								<textarea class="form-control todo-taskbody-taskdesc" rows="4" name="cmt_content" placeholder="请输入评论儿..."></textarea>
							</div>
						</li>
					</ul>
					<button type="button" class="pull-right btn btn btn-circle green" <?=$statusbtn?> onclick="submitComment()">
						<span class="glyphicon glyphicon-send"> </span>提交
					</button>
				</div>
			</div>
		</div>
	</div>
</form>
