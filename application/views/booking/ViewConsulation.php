<?php
foreach ($all_device_room_info as $value):
    if ('1' == $value['room_stauts']) {
        $hrefStatus = 'onclick="return false;"';
    } else {
        $hrefStatus = '';
    }

    if ('1' == $value['room_stauts']) {
        $class_attr = 'bg-blue';
        $disStauts = '检查中';
    } elseif ('2' == $value['room_stauts']) {
        $class_attr = 'bg-green';
        $disStauts = '已结束';
    } elseif ('0' == $value['room_stauts']) {
        $class_attr = 'bg-yellow';
        $disStauts = '待排号';
    } else {
        $class_attr = ' bg-yellow';
        $disStauts = '';
    }
?>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<a <?=$hrefStatus; ?> href="<?=base_url(); ?>booking/detail_roominfo/<?=$value['device_id']; ?>">
		<div class="dashboard-stat2 <?=$class_attr; ?>">
			<div class="display  ">
				<div class="number">
					<h4 class="font-white">
						<span data-counter="counterup" data-value="<?=abs($value['check_count'] - $value['check_totalcount']); ?>"><?=abs($value['check_count'] - $value['check_totalcount']); ?></span>
						<small class="font-white">/
							<?=$value['check_totalcount']; ?>
						</small>
					</h4>
					<h1 class="font-white">
						<?=$value['device_name']; ?>
					</h1>
				</div>
        <div class="icon">
            <h4><?=$disStauts; ?></h4>
        </div>
			</div>
			<div class="progress-info">
				<div class="status font-white">
					<div class="status-title">
						<?=0 == $value['room_stauts'] || 2 == $value['room_stauts'] ? '' : '医生名称：'; ?>
					</div>
					<div class="status-number">
						<?=0 == $value['room_stauts'] ? '' : $value['device_doc_name']; ?>
					</div>
				</div>
			</div>
		</div>
	</a>
</div>
<?php endforeach; ?>
