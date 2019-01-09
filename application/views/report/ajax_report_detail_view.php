<link href="<?=base_url()?>assets/global/iconfont/material-icons.css" rel="stylesheet" type="text/css"/>
<div class="tabbable-custom ">
	<ul class="nav nav-tabs ">
		<li class="active">
			<a href="#basic_info" data-toggle="tab"> 基本资料 </a>
		</li>
		<li>
			<a href="#send_checkup_info" data-toggle="tab"> 送检信息 </a>
		</li>
		<li>
			<a href="#checkup_info" data-toggle="tab"> 检查信息 </a>
		</li>
		<li>
			<a href="#pathology_info" data-toggle="tab"> 病列信息 </a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="basic_info">
			<table class="table table-bordered table-striped table-condensed flip-content" data-toolbar="#transform-buttons" data-height="299">
				<tbody>
					<tr>
						<td class="title-prex">患者姓名</td>
						<td><?=$report_table->patient_name?></td>
            <td class="title-prex">拼音</td>
            <td><?=$report_table->patient_pinyin?></td>
            <td class="title-prex">性别</td>
            <td><?=$report_table->patient_gender==0?'男':'女'?></td>
					</tr>
          <tr>
						<td class="title-prex">出生日期</td>
						<td><?=$report_table->patient_birthday?></td>
            <td class="title-prex">年龄</td>
            <td><?=$report_table->patient_age?></td>
            <td class="title-prex">民族</td>
            <td><?=$report_table->patient_birthday?></td>
					</tr>
          <tr>
            <td class="title-prex">证件类型</td>
            <td><?=$report_table->patient_birthday?></td>
            <td class="title-prex">证件号码</td>
            <td><?=$report_table->license_num?></td>
            <td class="title-prex">联系电话</td>
            <td><?=$report_table->patient_phone_num?></td>
          </tr>
          <tr>
						<td class="title-prex">现在地址</td>
						<td><?=$report_table->patient_address?></td>
					</tr>

				</tbody>
			</table>

		</div>
		<div class="tab-pane" id="send_checkup_info">
      <table class="table table-bordered table-striped table-condensed flip-content" data-height="299">
        <tbody>
          <tr>
            <td class="title-prex">申请单号</td>
            <td><?=$report_table->image_num?></td>
            <td class="title-prex">患者来源</td>
            <td><?=$report_table->patient_source?></td>
            <td class="title-prex">患者类型</td>
            <td><?=$report_table->patient_type==0?'男':'女'?></td>
          </tr>
          <tr>
            <td class="title-prex">医院申请医生</td>
            <td><?=get_user_name($report_table->req_doctor_name)?></td>
            <td class="title-prex">申请科室</td>
            <td><?=$report_table->room_num?></td>
            <td class="title-prex">送检单</td>
            <td><?=$report_table->patient_birthday?></td>
          </tr>
          <tr>
            <td class="title-prex">住院号</td>
            <td><?=$report_table->hospital_num?></td>
            <td class="title-prex">门诊号</td>
            <td><?=$report_table->clinic_num?></td>
            <td class="title-prex">床位号</td>
            <td><?=$report_table->bed_num?></td>
          </tr>
          <tr>
            <td class="title-prex">病情描述</td>
            <td><?=$report_table->clinical_diagnosis?></td>
          </tr>

        </tbody>
      </table>
		</div>
		<div class="tab-pane" id="checkup_info">
      <table class="table table-bordered table-striped table-condensed flip-content" data-height="299">
        <tbody>
          <tr>
            <td class="title-prex">检查类型</td>
            <td><?=$report_table->checkup_type?></td>
            <td class="title-prex">检查部位</td>
            <td><?=$report_table->checkup_equipment?></td>
            <td class="title-prex">检查项目</td>
            <td><?=$report_table->checkup_item?></td>
          </tr>
          <tr>
            <td class="title-prex">检查科室</td>
            <td><?=$report_table->checkup_equipment?></td>
            <td class="title-prex">检查时间</td>
            <td><?=$report_table->checkup_time?></td>
          </tr>
        </tbody>
      </table>
		</div>
		<div class="tab-pane" id="pathology_info">
      <div class="form-group">
          <label>患者主术</label>
          <textarea class="form-control" rows="3"></textarea>
      </div>
      <div class="form-group">
          <label>会诊目的</label>
          <textarea class="form-control" rows="3"></textarea>
      </div>
      <div class="form-group">
          <label>体格检查</label>
          <textarea class="form-control" rows="3"></textarea>
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
