<div class="row">
  <div class="col-md-12">
    <h3 style="text-align: center;">上传诊断</h3>
    <h5>影响号: <?=$report_table->image_num?> <span style="float: right">检查时间：<?=$report_table->checkup_time?></span></h5>
    <form id="upload_dicom_form" action="" method="post">
      <input type="hidden" name="chc_id" value="<?=$report_table->chc_id?>"/>
      <table class="table table-bordered table-hover">
        <tr>
          <td class="active">  患者姓名</td>
          <td>  <?=$report_table->patient_name?></td>
          <td class="active">性别</td>
          <td><?=$report_table->patient_gender==0?'男':'女'?></td>
          <td class="active">年龄</td>
          <td><?=$report_table->patient_age?></td>
        </tr>
        <tr>
          <td class="active">检查类型</td>
          <td><?=$report_table->checkup_type?></td>
          <td class="active">检查部位</td>
          <td><?=$report_table->checkup_equipment?></td>
          <td class="active">检查项目</td>
          <td><?=$report_table->checkup_item?></td>
        </tr>
      </table>
      <div class="form-actions col-md-10 col-md-offset-1">
          <button type="button" class="btn blue pull-left" onclick="upload_submit()">确认上传</button>
          <button type="button" data-izimodal-close="" data-izimodal-transitionout="bounceOutDown" class="btn default pull-right">取消</button>
      </div>
    </form>
  </div>
</div>
