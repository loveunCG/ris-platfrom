<div class="page-content-wrapper">
	<div class="page-content">
		<h3 class="page-title">
			诊室排号
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="icon-home"></i> 操作员
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					诊室排号
				</li>
			</ul>

		</div>
		<div class="row" id="sortable_portlets">
			<div class="col-md-12 column sortable">
				<div class="row">
					<div class="col-md-12">
						<div class="portlet portlet-sortable box " style="background-color: rgb(0, 153, 153);">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-magnifier"></i>
									<span class="caption-subject font-white sbold uppercase">检查条件</span>
								</div>
							</div>
							<div class="portlet-body">
								<form action="#" method="post" class="form-horizontal" id="search_hospitalForm" novalidate>
									<div class="form-body">
										<div class="row">
											<div class="col-lg-3 col-md-6 form-group form-md-line-input">
												<label class="col-lg-5 col-md-3 control-label" for="form_control_1">检查类型
												</label>
												<div class="col-lg-7 col-md-9">
													<select class="form-control" id="equipment_type" name="equipment_type" value="">
														<<option value="">请选择</option>
															<?php foreach ($device_type as $value): ?>
															<option value="<?=$value->equipment_type?>">
																<?=$value->equipment_type?>
															</option>
															<?php endforeach;?>
													</select>
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="col-lg-3 col-md-6 form-group form-md-line-input">
												<label class="col-lg-5 col-md-3 control-label" for="form_control_1">检查部位
												</label>
												<div class="col-lg-7 col-md-9">
													<input type="text" class="form-control" id="check_item" name="check_item" value="">
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="col-lg-3 col-md-6 form-group form-md-line-input">
												<label class="col-lg-5 col-md-3 control-label" for="form_control_1">所属科室
												</label>
												<div class="col-lg-7 col-md-9">
													<select class="form-control" placeholder="" id="equipment_deaprtment" name="equipment_deaprtment">
														<option value="">请选择</option>
														<?php foreach ($department_type as $value): ?>
														<option value="<?=$value->equipment_deaprtment?>">
															<?=$value->equipment_deaprtment?>
														</option>
														<?php endforeach;?>
													</select>
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="col-lg-3 col-md-6 form-group form-md-line-input">
												<label class="col-md-3 col-lg-5 control-label" for="form_control_1">诊室号
												</label>
												<div class="col-lg-7 col-md-9">
													<input type="text" class="form-control" placeholder="" id="equioment_room" name="equioment_room" value="">
													<div class="form-control-focus"> </div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-3 col-md-6 form-group form-md-line-input">
												<label class="col-md-3 col-lg-5 control-label" for="form_control_1">诊室状态</label>
												<div class="col-md-9 col-lg-7">
													<select class="form-control" id="equipment_status" name="equipment_status" value="">
														<option value="" selected>请选择</option>
														<option value="0">待排号</option>
														<option value="1">检查中</option>
														<option value="2">已结束</option>
													</select>
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="col-lg-3 col-md-6 form-group form-md-line-input">
												<label class="col-lg-5 col-md-3 control-label" for="form_control_1">预约时间</label>
												<div class="col-md-9 col-lg-7">
													<input type="text" class="form-control form-control-inline date-picker" placeholder="01/01/2017" name="start_time" value="">
													<div class="form-control-focus"> </div>
												</div>
											</div>
											<div class="col-md-6 col-lg-3 form-group form-md-line-input">
												<label class="col-lg-5 col-md-3 control-label" for="form_control_1">到</label>
												<div class="col-md-9 col-lg-7">
													<input type="text" class="form-control form-control-inline date-picker" placeholder="01/01/2017" name="end_time"  value="">
													<div class="form-control-focus"> </div>
												</div>
											</div>

											<div class=" col-md-3 form-group form-md-input">
												<button type="button" id="search_btn" class="btn col-md-4" style="background-color: rgb(51, 153, 153);">
													<i class="fa fa-search"></i>查询</button>
												<a type="button" class="btn col-md-offset-4 col-md-4 " onclick="search_clear()" style="background-color: rgb(51, 153, 153);">
													<i class="fa fa-refresh"></i>重置</a>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet portlet-sortable box portlet-datatable " style="background-color: rgb(0, 153, 153);">
							<div class="portlet-title">
								<div class="caption">
									<i class=" icon-layers font-green"></i>
									<span class="caption-subject font-white sbold uppercase">排号首页</span>
								</div>
							</div>
							<div class="portlet-body">
								<div class="row" id="consultationfield">
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
	function search_clear() {
		$('#search_hospitalForm')[0].reset();
		$('#equipment_type').val('');
		$('#check_item').val('');
		$('#equipment_deaprtment').val('');
		$('#equioment_room').val('');
		$('#equipment_status').val('');
		$('#from').val('');
		$('#to').val('');
	};
	$(function () {
		$('#consultationfield').load('<?=base_url()?>booking/viewConsulation');
		$('#search_btn').click(function () {
			reloadscreen();
		});
	});
	function reloadscreen() {
		var formData = $('#search_hospitalForm').serialize();
		$('#consultationfield').load('<?=base_url()?>booking/viewConsulation/?' + formData);
	}
</script>
