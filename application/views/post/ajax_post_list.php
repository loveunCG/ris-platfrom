<div class="col-md-12 col-sm-12" >
    <div class="todo-tasklist">
        <?php $index = 0; ?>
        <?php foreach ($post_Info as $value): ?>
            <div class="todo-tasklist-item todo-tasklist-item-border-blue" style="border: 0 solid ;border-radius: 3px;background-color: #e6f5f2;">
                <div class="col-md-12">
                    <div class="col-md-9" style="font-size: 14px;">
                        <img class="todo-userpic pull-left" src="<?=base_url()?>assets/images/faces/face100.png" width="32px" height="32px">
                        <div class="todo-tasklist-item-title">
                            <?=$value->pst_name?>
                        </div>
                    </div>
                    <div class="col-md-3" style="text-align: right;">
                        <span > <?=$value->pst_time?></span>
                    </div>
                    <!-- <div class="col-md-12" style="margin:0;     word-wrap: break-word;">
                        <h4 style="font-weight: bold;"> <?=$value->pst_title?></h4>
                        <p class="text show-more-height" style="font-size: 16px; margin: 0;"><?=$value->pst_content?></p>
                    </div> -->
                    <div class="col-md-12" style="margin:0;     word-wrap: break-word;">
                        <div class="wrap" style="margin:0;     word-wrap: break-word;">
                            <p  style="font-weight: bold;font-size: 20px;"><?=$value->pst_title?></p>
                            <?php $pname='more_' . (string)$index;?>
                            <p style="font-size: 16px; margin: 0;    height:1.5em;     overflow: hidden;" class='<?=$pname?>'><?=$value->pst_content?></p>
                            <?php $aname='readmorebtn_' . (string)$index;?>
                            <?php if(strlen($value->pst_content)> 100) : ?>
                            <a class='<?=$aname?>' onclick="less_more(<?=$index;?>)" style="float: right; font-weight: bold;">阅读全文</a> 
                            <?php endif; ?>                           
                        </div>
                    </div>
                    <div class="col-md-9">
                        <button type="button" onclick="add_right(<?=$value->post_id?>,<?=$value->pst_right?> )" class="btn btn-icon-only default" style="    width: 3.5em;">
                            <i class="fa fa-thumbs-o-up" style="font-size: 14px;">&nbsp;&nbsp;<?=$value->pst_right?></i>
                        </button>
                        <span class="view" onclick="comment_view(<?=$value->post_id?>)" style="font-size: 15px;">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-commenting-o" ></i>&nbsp;<?=$value->cmt_num?> 条评论</span>
                    </div>
                    <div class="col-md-3" style="text-align: right;">
                        <button type="button" onclick="edit_input(<?=$index;?>)" class="btn btn-success">评论</button>
                    </div>
                </div>
                <?php $classname='comment_edit_' . (string)$index;?>
                <input class="<?=$classname?>" hidden name="pname" type="text" onkeypress="eventonkeypress(<?=$index;?>, <?=$value->post_id?>,  <?=$value->pst_doctor?>)" class="colorpicker-default form-control" 
                    style="border: 0 solid #36c6d3;border-radius: 1%; width: 95%; margin-left: 1em;margin-top: 1em; height: 2em;"> 
            </div>
            <?php $index++;?>
        <?php endforeach;?>
        <?php if($post_Count> 5) : ?>
            <div class="col-md-12" style="text-align:center; font-size:14px">
                <button id="backword"  onclick="back_Page()" type="button" style="width: 2.3em; height:2.3em;border-radius:50%;border: 0 solid;background-color: #36c6d3;"><i class="fa fa-step-backward"></i></button>
                <font id="current_page" style="text-align:right;">&nbsp;&nbsp; <?=$post_page?> &nbsp;&nbsp;</font>
                <button type="button" onclick="next_Page()" style="width: 2.3em; height:2.3em; border-radius:50%;border: 0 solid;background-color: #36c6d3; "><i class="fa fa-step-forward"></i></button>
                <span>&nbsp;1/<?=$post_allpage?>&nbsp;</span>
                <input type="text" id="pageinput" style="border: 0.1em solid #36c6d3;border-radius: 1%; width: 3em;  height:2.3em"> 
                <button id="forword" onclick="go_Page()" type="button" class="btn btn-success" style="width: 2em, height:1em">go</button>
            </div>
            <div hidden id = "pagevalue" class="col-md-1"><?=$post_Count?><div>     
        <?php endif; ?>
        <div>
    </div>
</div>