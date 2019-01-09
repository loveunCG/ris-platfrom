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
			<form action="<?=base_url()?>report/save_delberation" id="report_submit" method="post">
				<div class="row">
					<div class="col-md-12">
						<div class="row col-md-12">
							<div class="col-md-8">
								<div class="portlet mt-element-ribbon light portlet-fit" style="height: 240px">
									<div class="ribbon ribbon-vertical-right ribbon-shadow ribbon-color-primary uppercase">
										<div class="ribbon-sub ribbon-bookmark"></div>
										<i class="fa fa-star"></i>
									</div>
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-user"></i>
											<span class="caption-subject font-green bold uppercase">
												<?=$this->lang->line('patient_info')?>
											</span>
										</div>
									</div>
									<input type="hidden" id="booking_id" name="booking_id" value="<?=$report_table->booking_id?>">
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
															<button type="button" class="btn btn-circle red">
																<?php
                                                          if ($report_table->patient_gender=='1') {
                                                            echo "男";
                                                          }else{
                                                            echo "女";
                                                          }?>
															</button>
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
								<div class="portlet mt-element-ribbon light portlet-fit" style="height: 240px">
									<div class="ribbon ribbon-vertical-right ribbon-shadow ribbon-color-primary uppercase">
										<div class="ribbon-sub ribbon-bookmark"></div>
										<i class="fa fa-star"></i>
									</div>
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-file-text-o"></i>
											<span class="caption-subject font-green bold uppercase">
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
						<div class="col-md-12">
							<!-- BEGIN Portlet PORTLET-->
							<div class="portlet light">
								<div class="portlet-title">
									<div class="caption font-green-sharp">
										<i class="icon-speech font-green-sharp"></i>
										<span class="caption-subject"> 报告信息</span>
									</div>
								</div>
								<div class="portlet-body">
									<div class="scroller" style="height:580px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
										<div class="col-md-4">
											<div class="portlet green-sharp box">
												<div class="portlet-title">
													<div class="caption">
														<i class="fa fa-cogs"></i>
														<?=$this->lang->line('image_expression')?>
													</div>
												</div>
												<div class="portlet-body">
													<div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">

														<p>
															<?=$value->Imaging_performance?>
														</p>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="portlet green-sharp box">
												<div class="portlet-title">
													<div class="caption">
														<i class="fa fa-cogs"></i>
														<?=$this->lang->line('suggestion')?>
													</div>
												</div>
												<div class="portlet-body">
													<div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">

														<p>
															<?=$value->recommend_report?>
														</p>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="portlet green-sharp box">
												<div class="portlet-title">
													<div class="caption">
														<i class="fa fa-cogs"></i>
														<?=$this->lang->line('impression')?>
													</div>
												</div>
												<div class="portlet-body">
													<div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">

														<p>
															<?=$value->impression?>
														</p>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="portlet green-sharp box">
												<div class="portlet-title">
													<div class="caption">
														<i class=" icon-layers font-green"></i>
														<span class="caption-subject font-green bold uppercase">
															<?=$this->lang->line('positive_status')?>
														</span>
													</div>
												</div>
												<div class="portlet-body">
													<div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">

														<div class="form-group form-md-radios">
															<div class="md-radio-inline">
																<div class="md-radio">
																	<input disabled type="radio" id="radio14" name="positive_status" value="1" class="md-radiobtn" <?php if ($value->positive_status=='1') { echo 'checked=""'; } ?>>
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
																<div class="md-radio">
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
										<div class="col-md-8">
											<div class="portlet green-sharp box">
												<div class="portlet-title">
													<div class="caption">
														<i class="fa fa-cogs"></i>
														临床诊断
													</div>
												</div>
												<div class="portlet-body">
													<div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">

														<p>
															<?=$value->clinical_diagnosis?>
														</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- END Portlet PORTLET-->
						</div>

					</div>
				</div>
				<div class="row">
					<div class="m-heading-1 border-green m-bordered">
						<div class="row">
							<a onclick="history.go(-1);" class=" col-md-offset-5 col-md-1 btn-circle btn green">
								<i class="fa fa-undo"></i>返回</a>
							<!-- <button type="button" class="col-md-offset-1  col-md-1 btn red-mint uppercase btn-circle" data-toggle="confirmation" id="bs_confirmation_demo_2"><i class="fa fa-arrow-left"></i>&nbsp;回退</button>

            <button type="button" class="col-md-offset-1  col-md-1 btn yellow-mint uppercase btn-circle" data-toggle="confirmation" id="bs_confirmation_demo_1">审核通过</button> -->

						</div>
					</div>
				</div>
			</form>

	</div>

</div>
<script>
	function set_report_module(val) {
		$('#report_module').val(val);

	}

	function nopass_deli() {
		booking_id = $('#booking_id').val();
		var base_url = '<?= base_url()?>';
		var strURL = base_url + "report/nopass_report/" + booking_id;
		$(location).attr('href', strURL);
	}

	function submit_report() {
		$("#report_submit").submit();
	}

</script>
