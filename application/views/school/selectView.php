<?php foreach ($study_info as $value):?>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="padding-bottom: 1%;">
        <a class="dashboard-stat dashboard-stat-v2 green" id="<?=$value->lession_id?>" onclick="selectschool('<?=$value->lession_id?>')" ondblclick="javascript: goto_movie('<?php echo $value->lession_id; ?>');"
           href="#" <?php if($value->lession_status) echo 'style="background-color:rgb(0,0,255)"'; ?> >
            <div class="visual">
                <i class="fa fa-file-text-o"></i>
            </div>
            <div class="details">
                <div class="number">
					<span data-counter="counterup" value="<?= $value->lession_title; ?> ">
								<?=$value->lession_title; ?>
					</span>
                </div>
                <div class="desc">
                    <?=$value->usr_hospital?>&nbsp;:&nbsp;<?=$value->usr_name?>
                </div>
                <div class="desc">
                    开始时间&nbsp;:&nbsp;<?= $value->start_time; ?>
                </div>
            </div>
        </a>
    </div>
<?php endforeach;?>

