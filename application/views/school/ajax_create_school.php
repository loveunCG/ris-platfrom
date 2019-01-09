<form action="#" method="post" class="add_school_from" id="add_school_from_id">
	<div class="form-body" >
		<div class="col-md-12">
			<div class="form-group form-md-line-input ">
				<input type="text" class="form-control" value="<?=isset($lession->lession_title) ? $lession->lession_title : ''; ?>" name="lession_title">
				<label for="form_control_1">教学主题</label>
			</div>
      <div class="form-group form-md-line-input">
          <textarea class="form-control" name="lession_content" rows="3"><?=isset($lession->lession_content) ? $lession->lession_content : ''; ?></textarea>
          <label for="form_control_1">内容描述</label>
          <span class="help-block">请输入...</span>
      </div>
		</div>
		<div class="col-md-12">
			<div class="form-group col-md-6 form-md-line-input ">
				<input type="text" class="form-control" readonly value="<?=isset($lession->lession_doctor_name) ? $lession->lession_doctor_name : $this->session->userdata('usr_name'); ?>" name="lession_doctor_name">
				<label for="form_control_1">教学导师</label>
			</div>
			<div class="form-group  col-md-6 form-md-line-input ">
				<input type="hidden" name="lession_id" value="<?=isset($lession->lession_id) ? $lession->lession_id : ''; ?>"/>
				<input type="text" class="form-control form_datetime" value="<?=isset($lession->start_time) ? $lession->start_time : ''; ?>" name="start_time" >
				<label for="form_control_1">开始时间</label>
			</div>
		</div>
		<div class="col-md-12">

			<div class="form-group col-md-6 form-md-line-input ">
				<select class="form-control" value="<?=isset($lession->lession_class) ? $lession->lession_class : ''; ?>" name="lession_class">
					<option value="1">公开教学</option>
					<option value="2">私密教学</option>
				</select>
				<label for="form_control_1">教学类型</label>
			</div>

			<div class="form-group col-md-6 form-md-line-input ">
				<input type="password" class="form-control" value="<?=isset($lession->lession_password) ? $lession->lession_password : ''; ?>" name="lession_password">
				<label for="form_control_1">密码</label>
			</div>
		</div>
	</div>
	<div class="form-actions">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<button type="button" onclick="addSchoolProc()" class="btn btn-info pull-left">
				<span class="glyphicon glyphicon-plus"> </span>添加</button>
				<button data-izimodal-close="" data-izimodal-transitionout="bounceOutDown" class="btn btn-info pull-right">
					<span class="glyphicon glyphicon-log-out"> </span>返回</a>
				</div>
			</div>
		</div>
	</div>
</form>

<script>
	$(".form_datetime").datetimepicker({
			autoclose: !0,
			isRTL: App.isRTL(),
			startDate: "2017-02-14 10:00",
			format: "yyyy-mm-dd hh:ii",
			pickerPosition: App.isRTL() ? "bottom-right" : "bottom-left"
	})


</script>
