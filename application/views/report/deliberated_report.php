<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN THEME PANEL -->

        <!-- END THEME PANEL -->
        <h3 class="page-title">
            <?=$menutitle?>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                        <?=$menutitle?>
                    </a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <span><?=$page_title?></span>
                </li>
            </ul>

        </div>
        <!-- BEGIN CONTENT BODY -->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-magnifier"></i>
                            <span class="caption-subject font-green sbold uppercase">检查条件</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="#" class="form-horizontal" id="form_sample_1" novalidate="novalidate">
                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button>
                                    <?=$this->lang->line('form_error')?>
                                </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button>
                                    <?=$this->lang->line('validation_succes')?>
                                </div>
                                <div class="row">

                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1"><?=$this->lang->line('name')?>
                                                </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" name="patient_name">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">输入您的姓名</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1"><?=$this->lang->line('image_num')?>
                                                </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" name="image_num">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                    <div class=" col-md-3  form-group form-md-line-input">
                                        <label class="col-md-5 control-label" for="form_control_1"><?=$this->lang->line('clinic_hos')?>
                                                </label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" placeholder="" name="clinic_hos">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                    <div class=" col-md-3 form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1"><?=$this->lang->line('patient_source')?>
                                                </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" name="patient_source">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 form-group form-md-line-input">
                                        <label class="col-md-5 control-label" for="form_control_1"><?=$this->lang->line('patient_source')?></label>
                                        <div class="col-md-7">
                                            <select class="form-control" name="delivery">
                                                        <option value="">Select</option>
                                                        <option value="2">Option 1</option>
                                                        <option value="3">Option 2</option>
                                                        <option value="4">Option 3</option>
                                                    </select>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 form-group form-md-line-input">
                                        <label class="col-md-5 control-label" for="form_control_1"><?=$this->lang->line('checkup_part')?>
                                                </label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" placeholder="" name="checkup_part">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 form-group form-md-line-input">
                                        <div class="col-md-12">
                                            <select class="form-control" name="period">
                                                        <option value="1">--自定义日期--</option>
                                                        <option value="2">Option 1</option>
                                                        <option value="3">Option 2</option>
                                                        <option value="4">Option 3</option>
                                                    </select>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <div class="col-md-6">
                                            <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                                <input type="text" class="form-control" name="from">
                                                <span class="input-group-addon"> 至 </span>
                                                <input type="text" class="form-control" name="to"> </div>
                                            <!-- /input-group -->
                                            <span class="help-block"> 选择日期范围</span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 form-md-checkboxes">
                                        <div class="md-checkbox-inline">
                                            <div class="md-checkbox">
                                                <input type="checkbox" id="checkbox1_5" name="search_condition_save" value="1" class="md-check">
                                                <label for="checkbox1_5">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span><?=$this->lang->line('search_condition_save')?> </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 form-group form-md-input">
                                        <button type="submit" class="btn col-md-12 blue btn-circle">查询</button>
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
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">报告列表</span>
                        </div>

                    </div>
                    <div class="clearfix" style="margin-top:1%">
                        <!-- Standard gray button with gradient -->
                        <div class="col-md-4">
                            <button type="button" class="btn btn-circle btn-success"><?=$this->lang->line('dicom_view')?></button>
                            <button type="button" class="btn btn-circle btn-success"><?=$this->lang->line('report')?></button>
                            <button type="button" class="btn btn-circle btn-success"><?=$this->lang->line('remote_contact')?></button>
                            <button type="button" class="btn btn-circle btn-success"><?=$this->lang->line('image_macth')?></button>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="table-container">

                            <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="2%">
                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                <span></span>
                                            </label>
                                        </th>
                                        <th width="5%">病人编号</th>
                                        <th width="5%">状态</th>
                                        <th width="5%">病人姓名</th>
                                        <th width="5%">性别</th>
                                        <th width="5%">年龄</th>
                                        <th width="5%">病人类型</th>
                                        <th width="5%">放射编号</th>
                                        <th width="5%">检查时间</th>
                                        <th width="5%">检查设备类型</th>
                                        <th width="5%">打印状态</th>
                                        <th width="5%">病区</th>
                                        <th width="5%">申请部门</th>
                                        <th width="5%">远程咨询</th>
                                    </tr>
                                    <!-- <tr role="row" class="filter">
                                        <td> </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="order_id">                                            </td>
                                        <td>
                                            <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                                <input type="text" class="form-control form-filter input-sm" readonly name="order_date_from" placeholder="From">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-sm default" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                            </div>
                                            <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                                <input type="text" class="form-control form-filter input-sm" readonly name="order_date_to" placeholder="To">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-sm default" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="order_customer_name">                                            </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="order_ship_to">                                            </td>
                                        <td>
                                            <div class="margin-bottom-5">
                                                <input type="text" class="form-control form-filter input-sm" name="order_price_from" placeholder="From" />                                                </div>
                                            <input type="text" class="form-control form-filter input-sm" name="order_price_to" placeholder="To" />                                            </td>
                                        <td>
                                            <div class="margin-bottom-5">
                                                <input type="text" class="form-control form-filter input-sm margin-bottom-5 clearfix" name="order_quantity_from" placeholder="From"
                                                /> </div>
                                            <input type="text" class="form-control form-filter input-sm" name="order_quantity_to" placeholder="To" />                                            </td>
                                        <td>
                                            <select name="order_status" class="form-control form-filter input-sm">
                                                <option value="">Select...</option>
                                                <option value="pending">Pending</option>
                                                <option value="closed">Closed</option>
                                                <option value="hold">On Hold</option>
                                                <option value="fraud">Fraud</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="margin-bottom-5">
                                                <button class="btn btn-sm green btn-outline filter-submit margin-bottom">
                                                    <i class="fa fa-search"></i> Search</button>
                                            </div>
                                            <button class="btn btn-sm red btn-outline filter-cancel">
                                                <i class="fa fa-times"></i> Reset</button>
                                        </td>
                                    </tr> -->
                                </thead>
                                <tbody> </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End: life time stats -->
            </div>
        </div>
        <div class="row">

                    <div class="col-md-6">
                        <!-- Begin: life time stats -->
                        <div class="portlet box purple">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-list-ol"></i>
                                    <?=$this->lang->line('past_checkup')?>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                    <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                                    <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">状态</th>
                                                <th scope="col">病人编号</th>
                                                <th scope="col">放射编号</th>
                                                <th scope="col">病人姓名</th>
                                                <th scope="col">性别</th>
                                                <th scope="col">年龄</th>
                                                <th scope="col"> 病人类型</th>
                                                <th scope="col">设备类型</th>
                                                <th scope="col">检查</th>
                                                <th scope="col">检查时间</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> Table data </td>
                                                <td> Table data </td>
                                                <td> Table data </td>
                                                <td> Table data </td>
                                                <td> Table data </td>
                                                <td> Table data </td>
                                                <td> Table data </td>
                                                <td> Table data </td>
                                                <td> Table data </td>
                                                <td> Table data </td>
                                            </tr>
                                            <tr>
                                                <td> Table data </td>
                                                <td> Table data </td>
                                                <td> Table data </td>
                                                <td> Table data </td>
                                                <td> Table data </td>
                                                <td> Table data </td>
                                                <td> Table data </td>
                                                <td> Table data </td>
                                                <td> Table data </td>
                                                <td> Table data </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- End: life time stats -->
                    </div>
                    <div class="col-md-3">
                        <!-- BEGIN Portlet PORTLET-->
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-file-image-o"></i>
                                    <?=$this->lang->line('image_expression')?>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                    <a href="javascript:;" data-load="true" data-url="portlet_ajax_content_1.html" class="reload" data-original-title="" title=""> </a>
                                    <a href="javascript:;" class="fullscreen" data-original-title="" title=""> </a>
                                    <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                                </div>
                            </div>
                            <div class="portlet-body portlet-empty">
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 300px;">
                                    <div class="scroller" style="height: 300px; overflow: hidden; width: auto;" data-rail-visible="1" data-initialized="1">
                                        <p> Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio
                                            sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis,
                                            est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec
                                            elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non
                                            commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. </p>
                                    </div>
                                    <div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 195.228px;"></div>
                                    <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px; display: none;"></div>
                                </div>
                                <script>
                                    jQuery(document).ready(function () {
                                        App.initAjax();
                                    });
                                </script>
                            </div>
                        </div>
                        <!-- END Portlet PORTLET-->
                    </div>
                    <div class="col-md-3">
                        <!-- BEGIN Portlet PORTLET-->
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-stethoscope"></i>
                                    <?=$this->lang->line('impression')?>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                    <a href="javascript:;" data-load="true" data-url="portlet_ajax_content_1.html" class="reload" data-original-title="" title=""> </a>
                                    <a href="javascript:;" class="fullscreen" data-original-title="" title=""> </a>
                                    <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                                </div>
                            </div>
                            <div class="portlet-body portlet-empty">
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 300px;">
                                    <div class="scroller" style="height: 300px; overflow: hidden; width: auto;" data-rail-visible="1" data-initialized="1">
                                        <p> Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio
                                            sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis,
                                            est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec
                                            elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non
                                            commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. </p>
                                    </div>
                                    <div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 195.228px;"></div>
                                    <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px; display: none;"></div>
                                </div>
                                <script>
                                    jQuery(document).ready(function () {
                                        App.initAjax();
                                    });
                                </script>
                            </div>
                        </div>
                        <!-- END Portlet PORTLET-->
                    </div>
                <!-- END Portlet PORTLET-->
        </div>
    </div>

</div>
</div>
