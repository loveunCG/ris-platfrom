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
					<span>
						<?=$page_title?>
					</span>
				</li>
			</ul>
		</div>
		<?php
            foreach ($report_data as $value) {
            $report_table = $value;
            }
            ?>
			<form action="<?=base_url()?>report/save_delberation" id="deliberation_submit" method="post">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-8">
								<div class="portlet mt-element-ribbon portlet-sortable box blue-madison portlet-fit">
									<div class="ribbon ribbon-vertical-right ribbon-shadow ribbon-color-primary uppercase">
										<div class="ribbon-sub ribbon-bookmark"></div>
										<i class="fa fa-star"></i>
									</div>
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-user"></i>
											<span class="caption-subject font-light bold uppercase">
												<?=$this->lang->line('patient_info')?>
											</span>
										</div>
									</div>
									<input type="hidden" id="booking_id" name="booking_id" value="<?=$report_table->delivery_name?>">
									<div class="portlet-body">
										<table class="table table-hover">
											<tbody>
												<tr>
													<td>
														<?=$this->lang->line('patient_code')?>:&nbsp;&nbsp;&nbsp;
															<?=$report_table->patient_code?>
													</td>
													<td>
														<?=$this->lang->line('checkup_time')?>:&nbsp;&nbsp;&nbsp;
															<?=$report_table->checkup_time?>
													</td>
													<td>
														<?=$this->lang->line('checkup_item')?>:&nbsp;&nbsp;&nbsp;
															<?=$report_table->checkup_item?>
													</td>

												</tr>
												<tr>
													<td>
														<?=$this->lang->line('patient_name')?>:&nbsp;&nbsp;&nbsp;
															<?=$report_table->patient_name?>
													</td>
													<td>
														<?=$this->lang->line('gender')?>:&nbsp;&nbsp;&nbsp;
															<?php
                                                                if ($report_table->patient_gender == '0') {
                                                                    echo '<button type="button" class="btn btn-circle btn-icon-only yellow"><span aria-hidden="true" class="icon-symbol-male"></span></button>';
                                                                } else {
                                                                    echo '<button type="button" class="btn btn-circle btn-icon-only red"><span aria-hidden="true" class="icon-symbol-female"></span></button>';
                                                                }
                                                        ?>
													</td>
													<td>
														<?=$this->lang->line('age')?>:&nbsp;&nbsp;&nbsp;
															<?=$report_table->patient_age?>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>

							</div>
							<div class="col-md-4">
								<div class="portlet mt-element-ribbon portlet-sortable box blue-madison portlet-fit">
									<div class="ribbon ribbon-vertical-right ribbon-shadow ribbon-color-primary uppercase">
										<div class="ribbon-sub ribbon-bookmark"></div>
										<i class="fa fa-star"></i>
									</div>
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-file-text-o"></i>
											<span class="caption-subject font-light bold uppercase">
												<?=$this->lang->line('hospital_inner_log')?>
											</span>
										</div>
									</div>
									<div class="portlet-body">
										<table class="table table-hover">
											<thead>
												<tr>
													<th>
														<?=$this->lang->line('checkup_date')?>
													</th>
													<th>
														<?=$this->lang->line('checkup_item')?>
													</th>
												</tr>
											</thead>
											<tbody>
												<?php  foreach ($past_report_data as $value) {?>
												<tr>
													<td>
														<?=$value->checkup_time?>
													</td>
													<td>
														<?=$value->checkup_item?>
													</td>
												</tr>
												<?php
                                                 } ?>
											</tbody>
										</table>
									</div>
								</div>

							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
								<div class="portlet mt-element-ribbon portlet-sortable box blue-madison portlet-fit ">
									<div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
										<div class="ribbon-sub ribbon-clip ribbon-right"></div>
										<?=$this->lang->line('image_expression')?>
									</div>
									<div class="portlet-title">
										<div class="caption">
											<i class=" icon-layers font-light"></i>
											<span class="font-light bold uppercase">
												<?=$this->lang->line('image_expression')?>
											</span>
										</div>
									</div>
									<div class="portlet-body">
										<div class="portlet-body form">
											<div class="form-horizontal form-bordered">
												<div class="form-body">
													<div class="form-group last">
														<div class="form-group">
															<textarea class="form-control autosizeme col-md-12 bg-white" disabled name="Imaging_performance" rows="8"><?=$value->Imaging_performance?>
															</textarea>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="portlet mt-element-ribbon portlet-sortable box blue-madison portlet-fit ">
									<div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
										<div class="ribbon-sub ribbon-clip ribbon-right"></div>
										<?=$this->lang->line('positive_status')?>
									</div>
									<div class="portlet-title">
										<div class="caption">
											<i class=" icon-layers font-green"></i>
											<span class="caption-subject font-green bold uppercase">
												<?=$this->lang->line('positive_status')?>
											</span>
										</div>
									</div>
									<div class="portlet-body">
										<div class="form-group form-md-radios">
											<div class="md-radio-inline">
												<div class="md-radio">
													<input type="radio" disabled id="radio14" name="positive_status" value="1" class="md-radiobtn" <?php if ($value->positive_status=='1') { echo 'checked=""'; } ?>>
													<label for="radio14">
														<span class="inc"></span>
														<span class="check"></span>
														<span class="box"></span> 阳性 </label>
												</div>
												<div class="md-radio has-error">
													<input disabled type="radio" id="radio15" value="2" name="positive_status" class="md-radiobtn" <?php if ($value->positive_status=='2') { echo 'checked=""'; }?>>
													<label for="radio15">
														<span class="inc"></span>
														<span class="check"></span>
														<span class="box"></span> 阴性</label>
												</div>
												<div class="md-radio has-warning">
													<input disabled type="radio" id="radio16" value="3" name="positive_status" class="md-radiobtn" <?php if ($value->positive_status=='3') { echo 'checked=""'; }?>>
													<label for="radio16">
														<span class="inc"></span>
														<span class="check"></span>
														<span class="box"></span> 未知 </label>
												</div>
											</div>
										</div>
										<div class="form-group form-md-radios">
											<label>危急性</label>
											<div class="md-radio-inline">
												<div class="md-radio">
													<input disabled type="radio" id="radio17" name="urgency_status" value="0" class="md-radiobtn" <?php if ($value->urgency_status=='0') { echo 'checked=""'; }?>>
													<label for="radio17">
														<span class="inc"></span>
														<span class="check"></span>
														<span class="box"></span> 是 </label>
												</div>
												<div class="md-radio has-error">
													<input disabled type="radio" id="radio19" name="urgency_status" value="1" class="md-radiobtn" <?php if ($value->urgency_status=='1') { echo 'checked=""'; }?>>
													<label for="radio19">
														<span class="inc"></span>
														<span class="check"></span>
														<span class="box"></span> 否 </label>
												</div>
											</div>
										</div>

										<div class="form-group form-md-line-input has-info">
											<select disabled class="form-control" name="image_degree">
												<option value="1" <?php if ($value->image_degree=='1') { echo 'selected'; }?>>甲
												</option>
												<option value="2" <?php if ($value->image_degree=='2') { echo 'selected'; }?>>乙
												</option>
												<option value="3" <?php if ($value->image_degree=='3') { echo 'selected'; }?>>丙
												</option>
											</select>
											<label>
												<?=$this->lang->line('image_degree')?>
											</label>
										</div>
									</div>
								</div>

							</div>
						</div>
						<div class="row">
							<div class="col-md-6">

								<div class="portlet mt-element-ribbon portlet-sortable box blue-madison portlet-fit ">
									<div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
										<div class="ribbon-sub ribbon-clip ribbon-right"></div>
										<?=$this->lang->line('impression')?>
									</div>
									<div class="portlet-title">
										<div class="caption">
											<i class=" icon-layers font-green"></i>
											<span class="caption-subject font-green bold uppercase">
												<?=$this->lang->line('clinical_diagnosis')?>
											</span>
										</div>
									</div>
									<div class="portlet-body">
										<div class="portlet-body form">
											<div class="form-horizontal form-bordered">
												<div class="form-body">
													<div class="form-group last">
														<div class="form-group">
															<textarea class="form-control autosizeme  col-md-12 bg-white" name="impression" disabled rows="6"><?=$value->impression?>
															</textarea>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>
								</div>


							</div>
							<div class="col-md-6">
								<div class="portlet mt-element-ribbon portlet-sortable box blue-madison portlet-fit ">
									<div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
										<div class="ribbon-sub ribbon-clip ribbon-right"></div>
										<?=$this->lang->line('suggestion')?>
									</div>
									<div class="portlet-title">
										<div class="caption">
											<i class=" icon-layers font-green"></i>
											<span class="caption-subject font-light bold uppercase">
												<?=$this->lang->line('suggestion')?>
											</span>
										</div>
									</div>
									<div class="portlet-body">
										<div class="portlet-body form">
											<div class="form-horizontal form-bordered">
												<div class="form-body">
													<div class="form-group last">
														<div class="form-group">
															<textarea class="form-control autosizeme col-md-12 bg-white" name="recommend_report" disabled rows="6"><?=$value->recommend_report?>
															</textarea>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="portlet mt-element-ribbon portlet-sortable box blue-madison portlet-fit ">
									<div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
										<div class="ribbon-sub ribbon-clip ribbon-right"></div>
										报告审核
									</div>
									<div class="portlet-title">
										<div class="caption">
											<i class=" icon-layers font-green"></i>
											<span class="caption-subject font-green bold uppercase">报告审核</span>
										</div>
									</div>
									<div class="portlet-body">
										<div class="portlet-body form">
											<div class="form-horizontal form-bordered">
												<div class="form-body">
													<div class="row">
														<div class="form-group col-md-12">
															<label class="control-label">备注：</label>
															<div class="input-group col-md-12">
																<textarea class="form-control" id="deliberation_content" name="deliberation_content" rows="6"></textarea>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
				<input type="hidden" name="report_id" value="<?=$report_table->report_CC_id?>">
				<div class="row">
					<div class="m-heading-1 border-green m-bordered">
						<div class="row">
							<a onclick="history.go(-1);" class=" col-md-offset-3 col-md-1 btn green">
								<span class="glyphicon glyphicon-chevron-left"> </span>返回</a>
							<!-- <a href="javascript:;" class=" col-md-offset-1 col-md-1 btn-circle btn green" onclick="save_report()"><i class="fa fa-save"></i>保存</a> -->
							<!-- <a href="javascript:;" class="col-md-offset-1   col-md-1 btn-circle btn yellow"><i class="fa fa-dedent"></i>调图</i></a> -->
							<button type="button" class="col-md-offset-1  col-md-1 btn red-mint uppercase " onclick="nopass_deli(<?=$report_table->delivery_name?>)">
								<span class="glyphicon glyphicon-share-alt"></span>回退</button>
							<button type="button" id="submit_deliberation_btn" class="col-md-offset-1 col-md-1 btn yellow-mint uppercase">
								<span class="glyphicon glyphicon-floppy-saved"> </span>审核通过</button>

						</div>
					</div>
				</div>

			</form>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('#submit_deliberation_btn').confirm({
			title: '提示',
			content: '您真通过报告审核吗？',
			icon: 'fa fa-spinner fa-spin',
			theme: 'material',
			animation: 'zoom',
			closeAnimation: 'scale',
			columnClass: 'small',
			containerFluid: true,
			autoClose: 'cancelAction|8000',
			buttons: {
				confirm: {
					text: '确定',
					keys: ['shift', 'alt'],
					action: function () {
						$("#deliberation_submit").submit();
					}
				},
				cancelAction: {
					text: '返回',
					btnClass: 'btn-blue',
					keys: ['enter', 'shift'],
					action: function () {}
				}
			}
		});
	});

	function set_report_module(val) {
		$('#report_module').val(val);

	}

	function nopass_deli(val) {
		$.confirm({
			title: '提示',
			content: '您真回退这个报告吗？',
			icon: 'fa fa-spinner fa-spin',
			theme: 'material',
			animation: 'zoom',
			closeAnimation: 'scale',
			columnClass: 'small',
			autoClose: 'cancelAction|8000',
			buttons: {
				confirm: {
					text: '确定',
                    btnClass: 'btn-info',

                    action: function () {
						booking_id = $('#booking_id').val();
						var base_url = '<?= base_url()?>';
						var strURL = base_url + "report/nopass_report/" + val;
						$(location).attr('href', strURL);
					}
				},
				cancelAction: {
					text: '返回',
					btnClass: 'btn-warning',
					action: function () {
					}
				}
			}
		});

	}

	function submit_report() {
		$("#deliberation_submit").submit();
	}

</script>
