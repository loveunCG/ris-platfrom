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
                    <span><?=$page_title?></span>
                </li>
            </ul>
        </div>
        <?php
        foreach ($report_data as $value) {
            $report_table = $value;
        }
        ?>

      <form action="<?=base_url()?>report/save_report" id="report_submit" method="post">
          <div class="row">

              <div class="col-md-12">
                <?php if ($success_status) {
            ?>
                  <div class="alert alert-success display">
                      <button class="close" data-close="alert"></button>
                      <span> <?=$success_status?>  </span>
                  </div>
                  <?php
        }?>

                  <div class="row">
                      <div class="col-md-8">
                          <div class="portlet mt-element-ribbon light portlet-fit" style="height: 240px">
                              <div class="ribbon ribbon-vertical-right ribbon-shadow ribbon-color-primary uppercase">
                                  <div class="ribbon-sub ribbon-bookmark"></div>
                                  <i class="fa fa-star"></i>
                              </div>
                              <div class="portlet-title">
                                  <div class="caption">
                                      <i class="fa fa-user"></i>
                                      <span class="caption-subject font-green bold uppercase"><?=$this->lang->line('patient_info')?></span>
                                  </div>
                              </div>
                              <input type="hidden" name="booking_id" value="<?=$report_table->booking_id?>">
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
                                                    <button type="button" class="btn btn-circle red"><?php
                                                    if ($report_table->patient_gender=='1') {
                                                        echo "男";
                                                    } else {
                                                        echo "女";
                                                    }?></button>
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
                                      <span class="caption-subject font-green bold uppercase"><?=$this->lang->line('hospital_inner_log')?></span>
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
                                          <?php  foreach ($past_report_data as $value) {
                                                        ?>
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
                          <div class="portlet mt-element-ribbon light portlet-fit ">
                              <div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
                                  <div class="ribbon-sub ribbon-clip ribbon-right"></div>
                                  <?=$this->lang->line('image_expression')?>
                              </div>
                              <div class="portlet-title">
                                  <div class="caption">
                                      <i class=" icon-layers font-green"></i>
                                      <span class="caption-subject font-green bold uppercase"><?=$this->lang->line('image_expression')?></span>
                                  </div>
                              </div>
                              <div class="portlet-body">
                                  <div class="portlet-body form">
                                      <div class="form-horizontal form-bordered">
                                          <div class="form-body">
                                            <div class="form-group last">
                                                <div class="col-md-12">
                                                    <textarea class="ckeditor form-control" name="Imaging_performance" rows="6">  <?=$value->Imaging_performance?></textarea>
                                                </div>
                                            </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="portlet mt-element-ribbon light portlet-fit ">
                              <div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
                                  <div class="ribbon-sub ribbon-clip ribbon-right"></div>
                                  <?=$this->lang->line('positive_status')?>
                              </div>
                              <div class="portlet-title">
                                  <div class="caption">
                                      <i class=" icon-layers font-green"></i>
                                      <span class="caption-subject font-green bold uppercase"><?=$this->lang->line('positive_status')?> </span>
                                  </div>
                              </div>
                              <div class="portlet-body">
                                  <div class="form-group form-md-radios">
                                      <div class="md-radio-inline">
                                          <div class="md-radio">
                                              <input type="radio" id="radio14" name="positive_status" value="1" class="md-radiobtn" <?php if ($value->positive_status=='1') {
                                                        echo 'checked=""';
                                                    } ?>>
                                              <label for="radio14">
                                                  <span class="inc"></span>
                                                  <span class="check"></span>
                                                  <span class="box"></span> 阳性 </label>
                                          </div>
                                          <div class="md-radio has-error">
                                              <input type="radio" id="radio15" value="2" name="positive_status" class="md-radiobtn" <?php if ($value->positive_status=='2') {
                                                        echo 'checked=""';
                                                    }?>>
                                              <label for="radio15">
                                                  <span class="inc"></span>
                                                  <span class="check"></span>
                                                  <span class="box"></span> 阴性</label>
                                          </div>
                                          <div class="md-radio has-warning">
                                              <input type="radio" id="radio16" value="3" name="positive_status" class="md-radiobtn" <?php if ($value->positive_status=='3') {
                                                        echo 'checked=""';
                                                    }?>>
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
                                              <input type="radio" id="radio17" name="urgency_status" value="0" class="md-radiobtn" <?php if ($value->urgency_status=='0') {
                                                        echo 'checked=""';
                                                    }?>>
                                              <label for="radio17">
                                                  <span class="inc"></span>
                                                  <span class="check"></span>
                                                  <span class="box"></span> 是 </label>
                                          </div>
                                          <div class="md-radio has-error">
                                              <input type="radio" id="radio19" name="urgency_status" value="1" class="md-radiobtn" <?php if ($value->urgency_status=='1') {
                                                        echo 'checked=""';
                                                    }?>>
                                              <label for="radio19">
                                                  <span class="inc"></span>
                                                  <span class="check"></span>
                                                  <span class="box"></span> 否 </label>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="form-group form-md-line-input has-info">
                                      <select class="form-control" name="image_degree">
                                    <option value="1" <?php if ($value->image_degree=='1') {
                                                        echo 'selected';
                                                    }?>>甲</option>
                                    <option value="2"<?php if ($value->image_degree=='2') {
                                                        echo 'selected';
                                                    }?>>乙</option>
                                    <option value="3"<?php if ($value->image_degree=='3') {
                                                        echo 'selected';
                                                    }?>>丙</option>
                                  </select>
                                      <label><?=$this->lang->line('image_degree')?></label>
                                  </div>

                              </div>
                          </div>

                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-8">
                          <div class="row">
                              <div class="portlet mt-element-ribbon light portlet-fit ">
                                  <div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
                                      <div class="ribbon-sub ribbon-clip ribbon-right"></div>
                                      <?=$this->lang->line('impression')?>
                                  </div>
                                  <div class="portlet-title">
                                      <div class="caption">
                                          <i class=" icon-layers font-green"></i>
                                          <span class="caption-subject font-green bold uppercase"><?=$this->lang->line('impression')?></span>
                                      </div>
                                  </div>
                                  <div class="portlet-body">
                                      <div class="portlet-body form">

                                          <div class="form-horizontal form-bordered">
                                              <div class="form-body">
                                                    <div class="form-group last">
                                                <div class="col-md-12">
                                                    <textarea class="ckeditor form-control" name="impression" rows="6">  <?=$value->impression?></textarea>
                                                </div>
                                            </div>
                                              </div>
                                          </div>

                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="portlet mt-element-ribbon light portlet-fit ">
                                  <div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
                                      <div class="ribbon-sub ribbon-clip ribbon-right"></div>
                                      <?=$this->lang->line('suggestion')?>
                                  </div>
                                  <div class="portlet-title">
                                      <div class="caption">
                                          <i class=" icon-layers font-green"></i>
                                          <span class="caption-subject font-green bold uppercase"><?=$this->lang->line('suggestion')?></span>
                                      </div>
                                  </div>
                                  <div class="portlet-body">
                                      <div class="portlet-body form">
                                          <div class="form-horizontal form-bordered">
                                              <div class="form-body">
                                                      <div class="form-group last">
                                                <div class="col-md-12">
                                                    <textarea class="ckeditor form-control" name="recommend_report" rows="6">  <?=$value->recommend_report?></textarea>
                                                </div>
                                            </div>

                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-social-dribbble font-blue-sharp"></i>
                                <span class="caption-subject font-blue-sharp bold uppercase"><?=$this->lang->line('report_module')?></span>
                            </div>
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default" data-target="#config_report_module" data-toggle="modal">
                                    <i class="fa fa-cog"></i>
                                </a>
                            </div>
                            <div id="config_report_module" class="modal container fade" tabindex="-1" data-focus-on="input:first">
                                <div class="portlet light portlet-fit portlet-form ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-user-plus"></i>
                                            <span class="caption-subject font-red sbold uppercase">模块管理</span>
                                        </div>
                                        <div class="actions">
                                            <a data-dismiss="modal" class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                                                       <i class="fa fa-close"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="modal-header">
                                          <div id="template_notification"></div>
                                            <div class="row col-md-12">
                                                <div class="col-md-offset-1 col-md-2">
                                                    <button type="button" onclick="new_template_click()" class="btn default">
                                                  <i class="fa fa-file-o"></i>新建模板
                                                </button>
                                                <input type="hidden" id ="template_id">

                                                </div>
                                                <!-- <div class="col-md-2">
                                                    <button id="update_template_click" onclick="update_template_click()" class="btn blue">
                                                          <i class="fa fa-edit"></i> 修改模板
                                                      </button>
                                                </div> -->
                                                <div class="col-md-2">
                                                    <button onclick="delete_template()" class="btn red">
                                                    <i class="fa fa-recycle"></i>    删除模板
                                                  </button>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" href="javascript:;" class="btn green" id="save_template" onclick="save_template()">
                                              <i class="fa fa-save"></i>                       保存模板
                                            </button>
                                                    </a>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" onclick="apply_template()" class="btn dark">
                                                  <i class="fa fa-check-square"></i> 应用模板
                                                </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4 ">
                                                  <div class="portlet box green">
                                                      <div class="portlet-title">
                                                      </div>
                                                      <div class="portlet-body">
                                                        <div class="form-group form-md-line-input">
                                                            <label class="col-md-5 control-label" for="form_control_1">请选择报告类别</label>
                                                            <div class="col-md-7">
                                                                <select class="form-control" name="class_id_select">
                                                                    <?php foreach ($device_class as $value) {
                                                        echo '<option value="'.$value->id.'">'.$value->equipment_type.'</option>';
                                                    }?>
                                                                </select>
                                                                <div class="form-control-focus"> </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-light">
                                                            <div class="panel-body">
                                                              <div class="panel-group accordion" id="accordion2">
                                                              <?php foreach ($module_class as $val_class) {
                                                        ?>
                                                                  <div class="panel panel-default">
                                                                      <div class="panel-heading">
                                                                          <h4 class="panel-title">
                                                                              <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?=$val_class->class_id?>"> <?=$val_class->class_name?> </a>
                                                                          </h4>
                                                                      </div>
                                                                      <div id="collapse<?=$val_class->class_id?>" class="panel-collapse in">
                                                                          <div class="panel-body">
                                                                            <div class="clearfix">

                                                                            <?php foreach ($module as $module_value) {
                                                            if ($module_value->module_class==$val_class->class_id) {
                                                                ?>
                                                                              <button type="button" class="col-md-12 btn blue btn-block btn-default "  onclick="select_module_class('<?=$module_value->module_id?>')"><?=$module_value->module_name?></button>

                                                                             <?php
                                                            }
                                                        } ?>
                                                                             </div>

                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                            <?php
                                                    } ?>
                                                          </div>

                                                            </div>
                                                        </div>
                                                      </div>
                                                  </div>
                                                </div>
                                                <div class="col-md-8">
                                                  <div class="col-md-12 portlet box green">
                                                      <div class="portlet-title">
                                                          <div class="tools">
                                                              <a href="javascript:;" class="collapse"> </a>
                                                              <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                          </div>
                                                      </div>
                                                      <div class="portlet-body">
                                                          <div class="table-scrollable">
                                                              <table class="table table-striped table-hover">
                                                                  <thead>
                                                                      <tr>
                                                                          <th></th>
                                                                          <th> 模板编码 </th>
                                                                          <th> 模板名称 </th>
                                                                      </tr>
                                                                  </thead>
                                                                  <tbody id="template_table">
                                                                  </tbody>
                                                              </table>
                                                          </div>
                                                          <div class="panel panel-light" style="display:none;" id="template_edit_pannel">
                                                              <div class="panel-body">
                                                                <form action="#" class="form-horizontal" >
                                                                    <div class="form-body">
                                                                      <div class="row col-md-12">
                                                                        <div class="form-group col-md-6 form-md-line-input">
                                                                            <input type="text" class="form-control" id="template_name" >
                                                                            <label for="form_control_1">模板名称</label>
                                                                        </div>
                                                                        <div class="form-group col-md-6 form-md-line-input">
                                                                            <input type="text" class="form-control" id="checkup_name" >
                                                                            <label for="form_control_1">检查名称</label>
                                                                        </div>
                                                                      </div>
                                                                      <div class="row col-md-12">
                                                                          <div class="form-group col-md-6 form-md-line-input">
                                                                              <select class="form-control" onchange="select_class_id(this.value)" id="select_class_id">
                                                                                <?php foreach ($module_class as $value) {
                                                        echo '<option value="'.$value->class_id.'">'.$value->class_name.'</option>';
                                                    }?>
                                                                              </select>
                                                                              <label for="form_control_1">检查部位</label>
                                                                          </div>
                                                                          <div class="form-group col-md-6 form-md-line-input ">
                                                                              <select class="form-control" id="report_module_id">
                                                                              </select>
                                                                              <label for="form_control_1">二级分类</label>
                                                                          </div>
                                                                          <script>
                                                                              function select_class_id(val) {
                                                                                 var base_url = '<?= base_url() ?>';
                                                                                 var strURL = base_url + "report/select_class/";
                                                                                 $.post(strURL, {
                                                                                         select_class_id: val
                                                                                     })
                                                                                     .done(function (data) {
                                                                                         class_data = JSON.parse(data);
                                                                                         var count = Object.keys(class_data.module).length;
                                                                                         display_data = '';
                                                                                          for (var i = 0; i < count; i++) {
                                                                                              display_data += '<option value = "' + class_data.module[i].module_id + '">'+class_data.module[i].module_name+'</option>';
                                                                                          }
                                                                                          $('#report_module_id').html(display_data)
                                                                                     });
                                                                             };

                                                                          </script>
                                                                      </div>

                                                                      <div class="form-group col-md-12 form-md-line-input">

                                                                          <textarea class="form-control" id="image_expression"  name="" rows="3"></textarea>
                                                                          <label for="form_control_1">影像学表现</label>
                                                                      </div>
                                                                      <div class="form-group col-md-12 form-md-line-input">
                                                                          <textarea class="form-control" id="recommended_report"  name="" rows="3"></textarea>
                                                                          <label for="form_control_1">诊断建议</label>
                                                                      </div>
                                                                    </div>
                                                                </form>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <input type="hidden" id="report_module" name="report_module">
                        <div class="portlet-body">
                          <div class="panel-group accordion" id="accordion1">
                          <?php foreach ($module_class as $val_class) {
                                                        ?>
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h4 class="panel-title">
                                          <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_3_<?=$val_class->class_id?>"> <?=$val_class->class_name?> </a>
                                      </h4>
                                  </div>
                                  <div id="collapse_3_<?=$val_class->class_id?>" class="panel-collapse in">
                                      <div class="panel-body">
                                        <div class="clearfix">

                                        <?php foreach ($module as $module_value) {
                                                            if ($module_value->module_class==$val_class->class_id) {
                                                                ?>
                                          <button type="button" class="col-md-12 btn blue btn-block btn-default "  onclick="set_module_value('<?=$module_value->module_id?>')"><?=$module_value->module_name?></button>

                                         <?php
                                                            }
                                                        } ?>
                                         </div>

                                      </div>
                                  </div>
                              </div>
                        <?php
                                                    } ?>
                      </div>



                        </div>
                    </div>
                </div>
                  </div>
                  <input type="hidden" name="report_id" value="<?=$report_table->report_id?>">
                  <div class="row">
                      <div class="m-heading-1 border-green m-bordered">
                          <div class="row">
                              <a onclick="history.go(-1);"  class=" col-md-offset-3 col-md-1 btn-circle btn green"><i class="fa fa-undo"></i>返回</a>
                              <!-- <a href="javascript:;" class=" col-md-offset-1 col-md-1 btn-circle btn green" onclick="save_report()"><i class="fa fa-save"></i>保存</a> -->
                              <!-- <a href="javascript:;" class=" col-md-offset-1  col-md-1 btn-circle btn blue" onclick="submit_report()"><i class="fa fa-paper-plane"></i>修改 </a> -->
                              <button type="button" class="col-md-offset-1  col-md-1 btn yellow-mint uppercase btn-circle" data-toggle="confirmation" id="bs_confirmation_demo_1">修改</button>

                              <!-- <a href="javascript:;" class="col-md-offset-1   col-md-1 btn-circle btn yellow"><i class="fa fa-dedent"></i>调图</i></a> -->
                              <a href="javascript:;" class=" col-md-offset-1  col-md-1  btn-circle btn green"><i class="fa fa-print"></i>打印</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </form>

    </div>

</div>
</div>
<script>

function new_template_click(){
  $('#template_id').val("");
  $('#template_name').val("");
  $('#report_module_id').val('');
  $('#checkup_name').val('');
  $('#image_expression').val('');
  $('#recommended_report').val('');
  $('#template_edit_pannel').css("display","block").fadeIn( 1000 );
  $('#save_template').removeAttr('disabled');
  $('#save_template').html('<i class="fa fa-save"></i> 保存模板');
}

function update_template_click(){
  if ($('#template_id').val()) {
    $('#template_edit_pannel').css("display","block");

  }else if($('#template_id').val()==""){
        var message = '<div class="alert alert-danger display"><button class="close" data-close="alert"></button>';
        message+="请选择项目！</div>";
        $('#update_template_click').attr("disabled", "true");
        $('#template_notification').html(message).delay( 800 ).slideUp(800);
        $('#template_notification').html();
  }


}
function save_template(){
  var base_url = '<?= base_url()?>';
  var strURL = base_url + "report/add_template/";
  var template_name = $("#template_name").val();
  var template_id = $("#template_id").val();
  var checkup_name = $("#checkup_name").val();
  var report_module_id = $("#report_module_id").val();
  var image_expression = $("#image_expression").val();
  var recommended_report = $("#recommended_report").val();
  var message = '<div class="alert alert-danger display"><button class="close" data-close="alert"></button>';
  if (template_name==""||checkup_name=="") {
           message+="有必填字段！ 檢查輸入項目</div>";
           $('#save_template').attr("disabled", "true");
           $('#template_notification').html(message).delay( 800 ).slideUp(800);
           $('#template_notification').html();
           $('#template_edit_pannel').delay(1000).slideUp(1000);

  }else{
  $.post(strURL, {
               template_name: template_name,
               template_id: template_id,
               checkup_name: checkup_name,
               report_module_id: report_module_id,
               image_expression: image_expression,
               recommended_report: recommended_report
           }).done(function (data) {
                 if (data) {
                     message+="添加成功了！</div>";
                     $('#save_template').attr("disabled", "true");
                     $('#template_notification').html(message).delay( 800 ).slideUp(800);
                     $('#template_edit_pannel').delay(1000).slideUp(1000);
                     select_module_class(report_module_id);
                 } else {
                     message+="添加失败了！</div>";
                     $('#template_notification').fadeIn( 400 );
                     $('#template_notification').html(message).delay(800).slideUp(800);
                 }
    });
           }

}

function delete_template(){
  var template_id = $('#template_id').val();
  var base_url = '<?= base_url()?>';
  var report_module_id = $('#report_module_id');
  var strURL = base_url + "report/delete_template/";
  var message = '<div class="alert alert-danger display"><button class="close" data-close="alert"></button>';
              $.post(strURL, {
                  template_id: template_id
              }).done(function (data) {
                if (data) {
                    message+="删除成功了！</div>";
                    $('#save_template').attr("disabled", "true");
                    $('#template_notification').html(message).delay( 800 ).slideUp(800);
                    $('#template_edit_pannel').delay(1000).slideUp(1000);
                    select_module_class(report_module_id);
                } else {
                    message+="删除失败了！</div>";
                    $('#template_notification').fadeIn( 400 );
                    $('#template_notification').html(message).delay(800).slideUp(800);
                }
              });

}

function select_template_item(val){
    var res = val.split("_");
    var template_id = res['0'];
    var template_name = res['1'];
    var report_module_id = res['2'];
    var checkup_name = res['3'];
    var image_expression = res['4'];
    var recommended_report = res['5'];
    $('#template_id').val(template_id);
    $('#report_module_id').val(report_module_id);
    $('#checkup_name').val(checkup_name);
    $('#image_expression').val(image_expression);
    $('#recommended_report').val(recommended_report);
    $('#save_template').removeAttr("disabled");
    $('#template_edit_pannel').css("display","block").fadeIn( 1400 );
    $("#save_template").html('<i class="fa fa-save"></i> 修改模板');
}


function select_module_class(val){
  var base_url = '<?= base_url()?>';
  var strURL = base_url + "report/get_template_data/";
              $.post(strURL, {
                  report_module_id: val
              }).done(function (data) {
                  report_data = JSON.parse(data);
                  var display_data = "";
                  if (report_data) {
                      var count = Object.keys(report_data.tdata).length;
                      for (var i = 0; i < count; i++) {
                          var select_device = report_data.tdata[i].template_id + "_" + report_data.tdata[i].template_name +
                              "_" + report_data.tdata[i].report_module_id + "_" + report_data.tdata[i].checkup_name +
                              "_" + report_data.tdata[i].image_expression + "_" + report_data.tdata[i].recommended_report;
                          display_data +=
                              '<tr><td><label class="mt-radio mt-radio-single mt-radio-outline"><input type="radio" name=selected_report class="md-radiobtn" onchange="select_template_item(this.value)" value="' +
                              select_device + '" /><span></span></label></td>';
                          display_data += "<td>" + report_data.tdata[i].template_id + "</td>";
                          display_data += "<td>" + report_data.tdata[i].template_name + "</td></td></tr>";
                      }
                  } else {
                      display_data = "<tr>没有资料</tr>";
                  }
                  $("#template_table").html(display_data);
              });

}
function set_module_value(val){
      $('#report_module').val(val);

    }

function submit_report() {
        $("#report_submit").submit();
    }
</script>
