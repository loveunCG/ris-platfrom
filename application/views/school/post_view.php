
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
                    <span>我发起的论点</span>
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
                                        <?php foreach ($my_post_Info as $value): ?>
                                            <div class="todo-tasklist-item todo-tasklist-item-border-blue">
                                                <img class="todo-userpic pull-left" src="<?=base_url()?>assets/layouts/layout2/img/avatar3.jpg" width="32px" height="32px">
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
                                <div class="col-md-7 col-sm-8">
                                    <form action="#" class="form-horizontal">
                                        <div class="tabbable-line">
                                            <ul class="nav nav-tabs ">
                                                <li class="active">
                                                    <a href="#tab_1" data-toggle="tab"> 我的评论 </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_1">
                                                    <!-- TASK COMMENTS -->
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <ul class="media-list">
                                                                <?php foreach ($all_post_Info as $value):
                                                                    $src = $this->session->userdata('id') == $value->pst_doctor ? 'assets/layouts/layout2/img/avatar3.jpg':'assets/pages/media/users/avatar2.jpg';

                                                                    ?>
                                                                    <li class="media">
                                                                        <a class="pull-left" href="javascript:;">
                                                                            <img class="todo-userpic" src="<?=base_url().$src?>" width="32px" height="32px"> </a>
                                                                        <div class="media-body todo-comment">
                                                                            <button type="button" class="todo-comment-btn btn btn-circle btn-default btn-sm">再评论</button>
                                                                            <p class="todo-comment-head">
																			<span class="todo-comment-username">
																				<?=$value->pst_title?>
																			</span> &nbsp;
                                                                                <span class="todo-comment-date">
																				<?=$value->pst_time?>
																			</span>
                                                                            </p>
                                                                            <p class="todo-text-color">
                                                                                <?=$value->pst_content?>
                                                                            </p>
                                                                            <!-- Nested media object -->
                                                                            <?php foreach ($my_comment_Info as $cmtData):
                                                                                if($cmtData->cmt_pst_id == $value->post_id):
                                                                                    ?>
                                                                                    <div class="media">
                                                                                        <a class="pull-left" href="javascript:;">
                                                                                            <img class="todo-userpic" src="<?=base_url()?>assets/pages/media/users/avatar<?=rand(1,10)?>.jpg" width="27px" height="27px"> </a>
                                                                                        <div class="media-body">
                                                                                            <p class="todo-comment-head">
																					<span class="todo-comment-username">
																					</span> &nbsp;
                                                                                                <span class="todo-comment-date">
																						<?=$cmtData->cmt_time?>
																					</span>
                                                                                            </p>
                                                                                            <p class="todo-text-color">
                                                                                                <?=$cmtData->cmt_content?>
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php  endif;
                                                                            endforeach;?>
                                                                        </div>
                                                                    </li>
                                                                <?php endforeach;?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <!-- END TASK COMMENT FORM -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END TODO CONTENT -->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<script>
    function delect_post(val) {

        $.confirm({
            title: '警告!',
            content: '您真删除该论点?',
            typeAnimated: true,
            theme: 'light',
            columnClass: 'small',
            draggable: true,
            buttons: {
                OK: {
                    text: '确定',
                    action: function () {
                        var base_url = '<?= base_url() ?>';
                        var strURL = base_url + "school/deletePost/"+val;
                        $.ajax({
                            dataType: "json",
                            url: strURL,
                            success: function(response){
                                if (response.status == 'success'){
                                    $.alert({
                                        icon: 'fa fa-warning',
                                        title: '提示!',
                                        closeIcon: true,
                                        theme: 'bootstrap',
                                        columnClass: 'small',
                                        content: '已删除了！',
                                        draggable: true,
                                        animation: 'zoom',
                                        closeAnimation: 'scale',
                                        buttons: {
                                            ok: function () {
                                                window.location.reload();
                                            }
                                        }
                                    });
                                }else{
                                    $.alert({
                                        icon: 'fa fa-warning',
                                        title: '提示!',
                                        closeIcon: true,
                                        theme: 'bootstrap',
                                        columnClass: 'small',
                                        content: '失败发布了！',
                                        draggable: true,
                                        animation: 'zoom',
                                        closeAnimation: 'scale'
                                    });
                                }
                                return true;
                            }
                        });


                    }
                },
                somethingElse: {
                    text: '返回',
                    keys: ['enter', 'shift'],
                    action: function () {
                        return true;

                    }
                }
            }
        });


    }
</script>
