<div class="tabbable-custom ">
	<ul class="nav nav-tabs ">
		<li class="active">
			<a href="#basic_info" data-toggle="tab"> 基本资料 </a>
		</li>
		<li>
			<a href="#pathology_info" data-toggle="tab"> 咨询资料 </a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="basic_info">
			<table class="table table-bordered table-striped table-condensed flip-content" data-toolbar="#transform-buttons" data-height="299">
				<tbody>
					<tr>
						<td class="title-prex">咨询类型</td>
						<td>
							<?=$contact_info->contact_type == '1' ? '远程会诊' : '远程门诊'?>
						</td>
						<td class="title-prex">附件上传</td>
						<td>
							<?=$contact_info->check_result_doc?>
						</td>

					</tr>
					<tr>
						<td class="title-prex">医院申请医生</td>
						<td>
							<?=$contact_info->doctor_name?>
						</td>
						<td class="title-prex">申请医院:</td>
						<td>
							<?=$contact_info->req_hospital?>
						</td>
					</tr>
					<tr>
						<td class="title-prex">预览</td>
						<td>
							<?=$contact_info->checkup_image_upload?>
						</td>
						<td class="title-prex">申请时间</td>
						<td>
							<?=$contact_info->submit_time?>
						</td>
					</tr>
					<tr>
						<td class="title-prex">会诊专家:</td>
						<td>
							<?=$contact_info->set_hospital . '  ' . $contact_info->set_class?>
						</td>
						<td class="title-prex">会诊日期</td>
						<td>
							<?=$contact_info->set_check_time?>
						</td>
					</tr>
				</tbody>
			</table>

		</div>
		<div class="tab-pane" id="pathology_info">
			<div class="form-group">
				<label>病人描述</label>
				<textarea class="form-control" rows="3"><?=$contact_info->disease_summary?></textarea>
			</div>
			<div class="form-group">
				<label>基本病史</label>
				<textarea class="form-control" rows="3"><?=$contact_info->medical_history?></textarea>
			</div>
			<div class="form-group">
				<label>咨询问题</label>
				<textarea class="form-control" rows="3"><?=$contact_info->contact_problem?></textarea>
			</div>

		</div>
	</div>
</div>

<style>
	.title-prex {
		background: aquamarine;
	}

	td {
		text-align: center;
	}

</style>
