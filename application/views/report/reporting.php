<?php
            foreach ($report_data as $value) {
                $report_table = $value;
            }?>

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
                        <span>新报告</span>
                    </li>
                </ul>
            </div>
            <div class="row" id="sortable_portlets">
                <div id="notification_report_save"></div>
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
                                        <span class="caption-subject font-white bold uppercase"><?=$this->lang->line('patient_info')?></span>
                                    </div>
                                </div>
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
                                        <span class="caption-subject font-white bold uppercase"><?=$this->lang->line('hospital_inner_log')?></span>
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
                                            <td>
                                                <?=$report_table->checkup_time?>
                                            </td>
                                            <td>
                                                <?=$report_table->checkup_item?>
                                            </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                    <form action="#" id="report_submit" method="post">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="portlet mt-element-ribbon portlet-sortable box blue-madison portlet- ">
                                    <div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
                                        <div class="ribbon-sub ribbon-clip ribbon-right"></div>
                                        <?=$this->lang->line('image_expression')?>
                                    </div>
                                    <div class="portlet-title">
                                        <div class="caption">
                                          <input type="hidden" name="booking_id" value="<?=$report_table->bking_id?>">

                                            <i class=" icon-layers font-white"></i>
                                            <span class="caption-subject font-white bold uppercase"><?=$this->lang->line('image_expression')?></span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="portlet-body form">
                                            <div class="form-horizontal form-bordered">
                                                <div class="form-body">
                                                    <div class="form-group last">
                                                        <div class="form-group">
                                                            <textarea class="form-control autosizeme" name="Imaging_performance" id="Imaging_performance" rows="6" placeholder=""><?=$report_table->Imaging_performance?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="portlet mt-element-ribbon portlet-sortable box blue-madison portlet-fit ">
                                    <div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
                                        <div class="ribbon-sub ribbon-clip ribbon-right"></div>
                                        <?=$this->lang->line('suggestion')?>
                                    </div>
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class=" icon-layers font-white"></i>
                                            <span class="caption-subject font-white bold uppercase"><?=$this->lang->line('suggestion')?></span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="portlet-body form">
                                            <div class="form-horizontal form-bordered">
                                                <div class="form-body">
                                                    <div class="form-group last">
                                                        <div class="form-group">
                                                            <textarea class="form-control autosizeme" name="recommend_report" id="recommend_report" rows="6" placeholder=""><?=$report_table->recommend_report?></textarea>
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
                                            <i class=" icon-layers font-white"></i>
                                            <span class="caption-subject font-white bold uppercase"><?=$this->lang->line('positive_status')?> </span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="form-group form-md-radios">
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio" id="radio14" name="positive_status" value="1" class="md-radiobtn" <?php if ($value->positive_status
                                                    == '1') {echo 'checked=""';}?>>
                                                    <label for="radio14">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> 阳性 </label>
                                                </div>
                                                <div class="md-radio has-error">
                                                    <input type="radio" id="radio15" value="2" name="positive_status" class="md-radiobtn" <?php if ($value->positive_status
                                                    == '2') {echo 'checked=""';}?>>
                                                    <label for="radio15">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> 阴性</label>
                                                </div>
                                                <div class="md-radio has-warning">
                                                    <input type="radio" id="radio16" value="3" name="positive_status" class="md-radiobtn" <?php if ($value->positive_status
                                                    == '3') {echo 'checked=""';}?>>
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
                                                    <input type="radio" id="radio17" name="urgency_status" value="0" class="md-radiobtn" <?php if ($value->urgency_status
                                                    == '0') {echo 'checked=""';}?>>
                                                    <label for="radio17">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> 是 </label>
                                                </div>
                                                <div class="md-radio has-error">
                                                    <input type="radio" id="radio19" name="urgency_status" value="1" class="md-radiobtn" <?php if ($value->urgency_status
                                                    == '1') {echo 'checked=""';}?>>
                                                    <label for="radio19">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> 否 </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group form-md-line-input has-info">
                                            <select class="form-control" name="image_degree">
                                          <option value="1" <?php if ($value->image_degree == '1') {
                                                                        echo 'selected';
                                                                    }?>>甲</option>
                                          <option value="2"<?php if ($value->image_degree == '2') {
                                                            echo 'selected';
                                                        }?>>乙</option>
                                            <option value="3"<?php if ($value->image_degree == '3') {
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
                                <div class="portlet mt-element-ribbon portlet-sortable box blue-madison portlet-fit ">
                                    <div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
                                        <div class="ribbon-sub ribbon-clip ribbon-right"></div>
                                        <?=$this->lang->line('impression')?>
                                    </div>
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class=" icon-layers font-white"></i>
                                            <span class="caption-subject font-white bold uppercase"><?=$this->lang->line('clinical_diagnosis')?></span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="portlet-body form">
                                            <div class="form-horizontal form-bordered">
                                                <div class="form-body">
                                                    <div class="form-group last">
                                                        <div class="form-group">
                                                            <textarea class="form-control autosizeme" name="impression" rows="6" placeholder=""><?=$report_table->impression?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="portlet portlet-sortable box blue-madison ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-social-dribbble"></i>
                                            <span class="caption-subject bold font-light uppercase"><?=$this->lang->line('report_module')?></span>
                                        </div>
                                        <div class="actions">
                                            <a class="btn btn-circle btn-icon-only btn-lighr" data-target="#config_report_module" data-toggle="modal">
                                                    <i class="fa fa-lg fa-cog"></i>
                                                </a>
                                        </div>

                                    </div>
                                    <input type="hidden" id="report_module" name="report_module">
                                    <div class="portlet-body">
                                        <div id="tree_1" class="tree-demo">
                                            <ul>
                                                <li> 常用模块
                                                    <ul>

                                                        <?php foreach ($device_class as $value): ?>
                                                        <li data-jstree='{ "open" : true }'>
                                                            <a href="javascript:;">
                                                                <?=$value->equipment_type?>
                                                            </a>
                                                            <?php foreach ($module_class as $class_module):
                                                                $module_id = $class_module->class_id;
                                                                ?>
                                                            <ul>
                                                                <li data-jstree='{ "disabled" : false }'>
                                                                    <?=$class_module->class_name?>
                                                                        <ul>
                                                                            <?php foreach ($template as $template_value): ?>
                                                                            <?php

                                                            if (($template_value->device_type == $value->equipment_type) && ($template_value->module_class == $module_id)):
                                                            ?>
                                                                                <li data-jstree='{ "type" : "file" }' ondblclick="select_template(<?=$template_value->template_id?>)">
                                                                                    <?=$template_value->template_name?>
                                                                                </li>
                                                                                <?php endif;
                                                                        endforeach;?>
                                                                        </ul>
                                                                </li>
                                                            </ul>
                                                            <?php endforeach;?>
                                                        </li>
                                                        <?php endforeach;?>

                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div id="tree_2" class="tree-demo">
                                            <ul>
                                                <li> 个人自定义模块
                                                    <ul>
                                                        <?php foreach ($device_class as $value): ?>
                                                        <li data-jstree='{ "open" : true }'>
                                                            <a href="javascript:;">
                                                                <?=$value->equipment_type?>
                                                            </a>
                                                            <?php foreach ($module_class as $class_module):
                                                                $module_id = $class_module->class_id;
                                                                ?>
                                                            <ul>
                                                                <li data-jstree='{ "disabled" : false }'>
                                                                    <?=$class_module->class_name?>
                                                                        <ul>
                                                                            <?php foreach ($template as $template_value): ?>
                                                                            <?php

                                                            if (($template_value->device_type == $value->equipment_type) && ($template_value->module_class == $module_id)):
                                                            ?>
                                                                                <li data-jstree='{ "type" : "file" }' ondblclick="select_template(<?=$template_value->template_id?>)">
                                                                                    <?=$template_value->template_name?>
                                                                                </li>
                                                                                <?php endif;
                                                                        endforeach;?>
                                                                        </ul>
                                                                </li>
                                                            </ul>
                                                            <?php endforeach;?>
                                                        </li>
                                                        <?php endforeach;?>

                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="report_id" value="<?=$report_table->report_id?>">
                        <div class="row">
                            <div class="m-heading-1 border-green m-bordered">
                                <div class="row">
                                    <a onclick="history.go(-1);" class=" col-md-offset-1 col-md-1  btn green"><i class="fa fa-undo"></i>返回</a>
                                    <a href="javascript:;" class=" col-md-offset-1 col-md-1  btn green" onclick="save_report()"><i class="fa fa-save"></i>保存</a>
                                    <button type="button" class="col-md-offset-1  col-md-1  btn blue" id="submit_func_btn"><i class="fa fa-paper-plane"></i>提交 </button>
                                    <a href="<?=base_url()?>report/dicom_view/<?=$report_table->booking_id?>" class="col-md-offset-1   col-md-1  btn yellow"><i class="fa fa-dedent"></i>调图</i></a>
                                    <a href="javascript:;" class=" col-md-offset-1  col-md-1   btn green"><i class="fa fa-print"></i>打印</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
    </div>
    <div id="config_report_module" class="modal container fade" tabindex="-1" data-focus-on="input:first">
        <div class="portlet portlet-sortable box blue-madison portlet-fit portlet-form ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user-plus"></i>
                    <span class="caption-subject sbold uppercase">模块管理</span>
                </div>
                <div class="actions">
                    <a data-dismiss="modal" class="btn btn-circle btn-icon-only btn-light" href="javascript:;">
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

                        </div>
                        <div class="col-md-2">
                            <button disabled onclick="delete_template()" id="delete_template_btn" class="btn red">
                            <i class="fa fa-recycle"></i>    删除模板
                          </button>
                        </div>
                        <div class="col-md-2">
                            <button type="button" href="javascript:;" class="btn green" id="save_template" onclick="submit_form()">
                              <i class="fa fa-save"></i>                       保存模板
                            </button>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <button type="button" disabled id="apply_template_btn" onclick="apply_template()" class="btn dark">
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
                                    <div class="panel panel-light">
                                        <div class="panel-body">
                                            <div id="tree_left" class="tree-demo">
                                                <ul>
                                                    <?php foreach ($device_class as $value): ?>
                                                    <li data-jstree='{ "open" : true }'>
                                                        <a href="javascript:;">
                                                            <?=$value->equipment_type?>
                                                        </a>
                                                        <?php foreach ($module_class as $class_module):
                                                                $module_id = $class_module->class_id;
                                                                                                                    ?>
                                                        <ul>
                                                            <li data-jstree='{ "disabled" : false }'>
                                                                <?=$class_module->class_name?>
                                                                    <ul>
                                                                        <?php foreach ($template as $template_value): ?>
                                                                        <?php

                                                                             if (($template_value->device_type == $value->equipment_type) && ($template_value->module_class == $module_id)):
                                                                        ?>
                                                                            <li data-jstree='{ "type" : "file" }' onclick="select_module_class(<?=$template_value->report_module_id?>)">
                                                                                <?=$template_value->template_name?>
                                                                            </li>
                                                                            <?php endif;
                                                                    endforeach;?>
                                                                    </ul>
                                                            </li>
                                                        </ul>
                                                        <?php endforeach;?>
                                                    </li>
                                                    <?php endforeach;?>

                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                    </form>
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
                                        <form action="#" method="post" id="report_module_form">
                                            <div class="panel-body">
                                                <div class="form-body">
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-6 form-md-line-input">
                                                            <input type="text" class="form-control" id="template_name" name="template_name">
                                                            <label for="form_control_1">模板名称</label>
                                                        </div>
                                                        <div class="form-group col-md-6 form-md-line-input">
                                                            <input type="text" class="form-control" name="checkup_name" id="checkup_name">
                                                            <label for="form_control_1">检查名称</label>
                                                        </div>
                                                    </div>
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-4 form-md-line-input">
                                                            <select class="form-control" name="device_type" id="device_type">
                                                              <?php foreach ($device_class as $value) {
                                                                  	echo '<option value="' . $value->equipment_type . '">' . $value->equipment_type . '</option>';
                                                                  }?>
                                                            </select>
                                                            <label for="form_control_1">检查设备类型</label>
                                                        </div>
                                                        <div class="form-group col-md-4 form-md-line-input">
                                                            <select class="form-control" onchange="select_class_id(this.value)" name="select_class" id="select_class">
                                                                <?php foreach ($module_class as $value) {
                                                                  	echo '<option value="' . $value->class_id . '">' . $value->class_name . '</option>';
                                                                  }?>
                                                              </select>
                                                            <label for="form_control_1">检查部位</label>
                                                        </div>
                                                        <input type="hidden" name="template_id" id="template_id">
                                                        <div class="form-group col-md-4 form-md-line-input ">
                                                            <select class="form-control" name="report_module_id" id="report_module_id">
                                                                <?php foreach ($module_view as $value) {
                                                                    echo '<option value="' . $value->module_id . '">' . $value->module_name . '</option>';
                                                                  }?>
                                                            </select>
                                                            <label for="form_control_1">二级分类</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 form-md-line-input">
                                                        <textarea class="form-control" id="image_expression" name="image_expression" rows="3"></textarea>
                                                        <label for="form_control_1">影像学表现</label>
                                                    </div>
                                                    <div class="form-group col-md-12 form-md-line-input">
                                                        <textarea class="form-control" id="recommended_report" name="recommended_report" rows="3"></textarea>
                                                        <label for="form_control_1">诊断建议</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
    <script>
        function new_template_click() {
            $('#template_id').val("");
            $('#template_name').val("");
            $('#report_module_id').val('');
            $('#checkup_name').val('');
            $('#image_expression').val('');
            $('#recommended_report').val('');
            $('#template_edit_pannel').css("display", "block").fadeIn(1000);
            $('#save_template').removeAttr('disabled');
        }

        function update_template_click() {
            if ($('#template_id').val()) {
                $('#template_edit_pannel').css("display", "block");
            } else if ($('#template_id').val() == "") {
                var message =
                    '<div class="alert alert-danger display"><button class="close" data-close="alert"></button>';
                message += "请选择项目！</div>";
                $('#update_template_click').attr("disabled", "true");
                $('#template_notification').html(message).delay(800).slideUp(800);
                $('#template_notification').html();
            }

        }

        function submit_form() {
            $('#report_module_form').submit();

        }

        function save_template() {
            var url = "<?=base_url()?>" + 'report/add_template/';
            var form_data = $('#report_module_form').serialize(); //Encode form elements for submission
            var message = '<div class="alert alert-danger display"><button class="close" data-close="alert"></button>';
            $.ajax({
                url: url,
                type: 'post',
                dataType: "JSON",
                data: form_data,
                success: function (result) {
                    if (result.status = 'succes') {
                        message += "添加成功了！</div>";
                        $('#save_template').attr("disabled", "true");
                        $('#template_notification').html(message).delay(800).slideUp(800);
                        $('#template_edit_pannel').delay(1000).slideUp(1000);
                        select_module_class(report_module_id);
                    } else {
                        message += "添加失败了！</div>";
                        $('#template_notification').fadeIn(400);
                        $('#template_notification').html(message).delay(800).slideUp(800);
                    }
                }
            });
        }

        function delete_template() {
            var template_id = $('#template_id').val();
            var base_url = '<?=base_url()?>';
            var report_module_id = $('#report_module_id');
            var strURL = base_url + "report/delete_template/";
            var message = '<div class="alert alert-danger display"><button class="close" data-close="alert"></button>';
            $.post(strURL, {
                template_id: template_id
            }).done(function (data) {
                if (data) {
                    message += "删除成功了！</div>";
                    $('#save_template').attr("disabled", "true");
                    $('#template_notification').html(message).delay(800).slideUp(800);
                    $('#template_edit_pannel').delay(1000).slideUp(1000);
                    select_module_class(report_module_id);
                } else {
                    message += "删除失败了！</div>";
                    $('#template_notification').fadeIn(400);
                    $('#template_notification').html(message).delay(800).slideUp(800);
                }
            });

        }

        function select_template_item(val) {
            var res = val.split("_");
            var template_id = res['0'];
            var template_name = res['1'];
            var report_module_id = res['2'];
            var checkup_name = res['3'];
            var image_expression = res['4'];
            var recommended_report = res['5'];
            $('#template_id').val(template_id);
            $('#report_module_id').val(report_module_id);
            $('#template_name').val(template_name);
            $('#checkup_name').val(checkup_name);
            $('#image_expression').val(image_expression);
            $('#recommended_report').val(recommended_report);
            $('#save_template').removeAttr("disabled");
            $('#delete_template_btn').removeAttr("disabled");
            $('#apply_template_btn').removeAttr('disabled');

            $('#template_edit_pannel').css("display", "block").fadeIn(1400);
        }

        function select_module_class(val) {
            var base_url = '<?=base_url()?>';
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

        function set_module_value(val) {
            $('#report_module').val(val);

        }

        function select_template(val) {
            var base_url = '<?=base_url()?>';
            var strURL = base_url + "report/get_template_info/" + val;
            $.ajax({
                dataType: "json",
                url: strURL,
                success: function (response) {
                    $('#Imaging_performance').html(response.image_expression);
                    $('#recommend_report').html(response.recommended_report);

                }
            });
        }

        function change_device_type(val) {
            var base_url = '<?=base_url()?>';
            var strURL = base_url + "report/getModuleLeftView/" + val;
            $.ajax({
                url: strURL,
                success: function (response) {
                    $('#module_left_view').html(response);
                }
            });
        }

        function select_class_id(val) {
            var base_url = '<?=base_url()?>';
            var strURL = base_url + "report/select_class/";
            $.post(strURL, {
                    select_class_id: val
                })
                .done(function (data) {
                    class_data = JSON.parse(data);
                    var count = Object.keys(class_data.module).length;
                    display_data = '';
                    for (var i = 0; i < count; i++) {
                        display_data += '<option value = "' + class_data.module[i].module_id + '">' + class_data.module[
                            i].module_name + '</option>';
                    }
                    $('#report_module_id').html(display_data)
                });
        };

        function apply_template() {
            var paramater = $('#template_id').val();
            select_template(paramater);
            $('#config_report_module').modal('hide');

        }


        $(function(){



        })
        function save_report_info() {
            var url = "<?=base_url()?>" + 'report/save_report/';
            var form_data = $('#report_submit').serialize();
            alert(form_data);
            var message = '<div class="alert alert-info display"><button class="close" data-close="alert"></button>';
            $.ajax({
                url: url,
                type: 'post',
                dataType: "JSON",
                data: form_data,
                success: function (result) {
                    if (result.status = 'succes') {
                        message += "提交成功了！</div>";
                        $('#submit_func_btn').attr("disabled", "true");
                        $('#notification_report_save').html(message).delay(5000);
                        $.alert("提交成功了！");
                        window.location.href = "<?=base_url()?>report/";
                    } else {
                        message += "提交失败了！</div>";
                        $.alert("提交失败了！");
                        $('#notification_report_save').html(message).delay(800);
                    }
                }
            });
        }

        $(document).ready(function () {
            $('#submit_func_btn').confirm({
                title: '提示',
                icon: 'fa fa-spinner fa-spin',
                theme: 'dark',
                animation: 'zoom',
                closeAnimation: 'scale',
                columnClass: 'col-md-4 col-md-offset-4',
                content: '您真提交报告吗？',
                containerFluid: true,
                autoClose: 'cancelAction|8000',
                buttons: {
                    confirm: {
                        text: '是',
                        keys: ['shift', 'alt'],
                        action: function () {
                            $("#report_submit").submit();
                        }
                    },
                    cancelAction: {
                        text: '否',
                        btnClass: 'btn-blue',
                        keys: ['enter', 'shift'],
                        action: function () {}
                    }
                }
            });
        });
    </script>
