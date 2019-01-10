<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN THEME PANEL -->

        <!-- END THEME PANEL -->
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
        <!-- BEGIN CONTENT BODY -->
        <div class="row" id="sortable_portlets">
            <div class="col-md-12 column sortable">

                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN VALIDATION STATES-->
                        <div class="portlet portlet-sortable box blue-chambray ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-magnifier"></i>
                                    <span class="caption-subject font-green sbold uppercase">检查条件</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <!-- BEGIN FORM-->
                                <form action="<?=base_url()?>booking/search_room" method="post" class="form-horizontal" id="search_hospitalForm" novalidate>
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-3 form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">检查类型
                                                </label>
                                                <div class="col-md-9">
                                                    <select class="form-control" id="equipment_type" name="equipment_type" value="<?=$equipment_type?>">
                                              <<option value="">请选择</option>
                                              <?php foreach ($device_type as $value):?>
                                                <option value="<?=$value->equipment_type?>" <?=$equipment_type==$value->equipment_type? 'selected':''?>><?=$value->equipment_type?></option>
                                              <?php endforeach; ?>

                                            </select>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">请输入检查类型</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3  form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">检查部位
                                                </label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="check_item" name="check_item" value="<?=$check_item?>">
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">请输入检查部位</span>

                                                </div>
                                            </div>
                                            <div class="col-md-3 form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">所属科室
                                                </label>
                                                <div class="col-md-9">
                                                    <select class="form-control" placeholder="" id="equipment_deaprtment" name="equipment_deaprtment" value="<?=$equipment_deaprtment?>">
                                              <option value="">请选择</option>
                                              <?php foreach ($department_type as $value):?>
                                                <option value="<?=$value->equipment_deaprtment?>" <?=$equipment_deaprtment==$value->equipment_deaprtment? 'selected':''?>><?=$value->equipment_deaprtment?></option>
                                              <?php endforeach; ?>
                                            </select>

                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">请输入所属科室</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">诊室号
                                                </label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="" id="equioment_room" name="equioment_room" value="<?=$equioment_room?>">
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">请输入诊室号</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">诊室状态</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" id="equipment_status" name="equipment_status" value="<?=$equipment_status?>">
                                                      <option value="">请选择</option>
                                                      <option <?=$equipment_status==1?'selected':''?> value="1">待排号</option>
                                                      <option <?=$equipment_status==2?'selected':''?> value="2">检查中</option>
                                                      <option <?=$equipment_status==3?'selected':''?> value="3">已结束</option>

                                                  </select>
                                                    <div class="form-control-focus"> </div>

                                                </div>
                                            </div>
                                            <div class="col-md-3 form-group form-md-line-input">
                                                <label class="col-md-4 control-label" for="form_control_1">预约时间</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-inline" placeholder="" name="start_time" id="from" value="<?php echo $start_time; ?>">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 form-group form-md-line-input">
                                                <label class="col-md-4 control-label" for="form_control_1">到</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-inline" placeholder="" name="end_time" id="to" value="<?php echo $end_time; ?>">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>

                                            <div class=" col-md-3 form-group form-md-input">
                                                <button type="submit" class="btn col-md-4 blue btn-circle yellow"><i class="fa fa-search"></i>查询</button>
                                                <a type="button" class="btn col-md-offset-4 col-md-4 blue btn-circle" onclick="search_clear()"><i class="fa fa-refresh"></i>重置</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>
                        </div>
                        <!-- END VALIDATION STATES-->
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet portlet-sortable box blue-chambray portlet-datatable ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class=" icon-layers font-green"></i>
                                    <span class="caption-subject font-green sbold uppercase">排号首页</span>
                                </div>
                            </div>

                            <div class="portlet-body">
                                <div class="row">
                                    <?php  foreach ($all_device_room_info as $value):?>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                                        <?php if ($value['device_sataus'] =='1') {
                              $class_attr = ' bg-grey-steel';
                              # code...
                            }elseif ($value['check_count'] =='0') {
                              $class_attr = ' bg-red-mint';
                            }
                            else{
                              $class_attr = ' bg-yellow-soft';

                            } ?>
                                        <div class="dashboard-stat2 <?=$class_attr?>">
                                            <div class="display  ">
                                                <div class="number">
                                                    <h4 class="font-green-sharp">
                                                        <span data-counter="counterup" data-value="<?=$value['check_count']?>">0</span>
                                                        <small class="font-green-sharp">/<?=$value['check_totalcount']?></small>
                                                    </h4>
                                                    <h1>
                                                        <?=$value['device_name']?>
                                                    </h1>
                                                </div>
                                                <div class="icon">
                                                    <a href="<?=base_url()?>booking/detail_roominfo/<?=$value['device_id']?>" class="btn btn-circle btn-icon-only purple-plum">
                                            <i class="fa fa-h-square"></i>
                                        </a>
                                                </div>
                                            </div>
                                            <div class="progress-info">
                                                <div class="progress">
                                                    <span style="width: <?=100-$value['check_count']/$value['check_totalcount']*100?>%;" class="progress-bar progress-bar-success green-sharp">
                                                                      <span class="sr-only"><?=100-$value['check_count']/$value['check_totalcount']*100?>% </span>
                                                    </span>
                                                </div>
                                                <div class="status">
                                                    <div class="status-title"> 利用率 </div>
                                                    <div class="status-number">
                                                        <?=100-$value['check_count']/$value['check_totalcount']*100?>%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
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
            };
        </script>