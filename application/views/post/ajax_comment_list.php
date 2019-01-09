<div class="col-md-12 col-sm-12" >
    <div class="todo-tasklist">
        <?php if($post_Info != '0'):?>
        <div class="todo-tasklist-item todo-tasklist-item-border-blue" style="border: 0 solid ;border-radius: 3px;background-color: #e6f5f2;">
            <div class="col-md-12">
                <div class="col-md-9" style="font-size: 14px;">
                    <img class="todo-userpic pull-left" src="<?=base_url()?>assets/images/faces/face100.png" width="32px" height="32px">
                    <div class="todo-tasklist-item-title">
                        <?=$post_Info[0]->pst_name?>   
                    </div>
                </div>
                <div class="col-md-3" style="text-align: right;">
                    <span ><span > <?=$post_Info[0]->pst_time?></span></span>
                </div>
                <div class="col-md-12" style="margin:0">
                    <h4 style="font-weight: bold;"><?=$post_Info[0]->pst_title?> </h4>
                    <p style="font-size: 16px; margin: 0;"><?=$post_Info[0]->pst_content?></p>
                </div>
                <div class="col-md-9">
                        <button type="button"  class="btn btn-icon-only default">
                            <i class="fa fa-thumbs-o-up" style="font-size: 14px;">&nbsp;&nbsp;<?=$post_Info[0]->pst_right?></i>
                        </button>
                        <span class="view" onclick="comment_view(<?=$post_Info[0]->post_id?>)" 
                        style="font-size: 15px;">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-commenting-o" ></i>&nbsp;收起评论</span>
                </div>
            </div>
        </div>
        <div class="todo-tasklist-item todo-tasklist-item-border-blue" style="border: 0 solid ;border-radius: 3px;background-color: #e6f5f2;">
            <?php echo $post_list_count;?>条评论
        </div>
        <?php endif; ?>
        <?php foreach ($comment_Info as $value): ?>
            <div class="todo-tasklist-item todo-tasklist-item-border-blue" style="border: 0 solid ;border-radius: 3px;background-color: #e6f5f2;">
                <div class="col-md-12">
                    <div class="col-md-9" style="font-size: 14px;">
                        <img class="todo-userpic pull-left" src="<?=base_url()?>assets/images/faces/face100.png" width="32px" height="32px">
                        <div class="todo-tasklist-item-title">
                            <?=$value->usr_name?>
                        </div>
                    </div>
                    <div class="col-md-3" style="text-align: right;">
                        <span > <?=$value->cmt_time?></span>
                    </div>
                    <div class="col-md-12" style="margin:0">
                        <p style="font-size: 16px; margin: 0;"><?=$value->cmt_content?></p>
                    </div>
                </div>
                <!-- <div style="margin-left:1em">
                    <span style="font-size: 15px;">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-mail-reply" ></i>&nbsp;条评论</span>
                </div> -->
            </div>
        <?php endforeach;?>
        <?php if($post_list_count> 5) : ?>
            <div class="col-md-12" style="text-align:center; font-size:14px">
                <button onclick="comment_back_Page()" type="button" style="width: 2.3em; height:2.3em; border-radius:50%;border: 0 solid;background-color: #36c6d3;"><i class="fa fa-step-backward"></i></button>
                <font style="text-align:right;">&nbsp;&nbsp; <?=$post_page?> &nbsp;&nbsp;</font>
                <button type="button" onclick="comment_next_Page()" style="width: 2.3em; height:2.3em; border-radius:50%;border: 0 solid;background-color: #36c6d3;"><i class="fa fa-step-forward"></i></button>
                <span>&nbsp;1/<?=$post_allpage?>&nbsp;</span>
                <input type="text" id="comment_pageinput" style="border: 0.1em solid #36c6d3;border-radius: 1%; width: 3em;  height:2.3em"> 
                <button id="forword" onclick="comment_go_Page()" type="button" class="btn btn-success" style="width: 2em, height:1em">go</button>
            </div>
            <div hidden id = "comment_pagevalue" class="col-md-1"><?=$post_list_count?><div>     
        <?php endif; ?>
    </div>
</div>