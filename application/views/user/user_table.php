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
                    <span><?=$menutitle?></span>
                </li>
            </ul>

        </div>
        <!-- BEGIN CONTENT BODY -->
        <div class="row" id="sortable_portlets">
            <div class="col-md-12 column sortable">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet portlet-sortable box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-magnifier"></i>
                            <span class="caption-subject font-light sbold uppercase">用户管理</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="#" method="post" class="form-horizontal" id="search_user_info_form">
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
                                            <input type="text" class="form-control" id="s_usr_name" name="usr_name">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">请输入姓名</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1"><?=$this->lang->line('age')?>
                                                </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" id="s_usr_age" name="usr_age">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">请输入<?=$this->lang->line('age')?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1"><?=$this->lang->line('gender')?></label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="s_usr_gender" name="usr_gender">
                                                        <option value="">请选择</option>
                                                        <option value="1">男</option>
                                                        <option value="0">女</option>
                                                    </select>
                                            <div class="form-control-focus"> </div>

                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">用户状态</label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="s_usr_status" name="usr_status">
                                                        <option value="">请选择</option>
                                                        <option value="1">已激活</option>
                                                        <option value="0">未激动</option>
                                                        <option value="2">已注销</option>

                                             </select>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="control-label col-md-3">申请时间</label>
                                        <div class="col-md-9">
                                            <input class="form-control form-control-inline input-medium " id="start_time" name="start_time" size="20" type="text" value=""
                                            />
                                            <span class="help-block"> 选择日期 </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="control-label col-md-3">至</label>
                                        <div class="col-md-9">
                                            <input class="form-control form-control-inline input-medium " id="end_time" name="end_time" size="20" type="text" value=""
                                            />
                                            <span class="help-block"> 选择日期 </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">科室</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="s_usr_department" name="usr_department">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                    <div class=" col-md-3 form-group form-md-input">
                                        <button type="button" class="btn col-md-offset-2 col-md-4 blue yellow" id="search_user_btn"><span class="glyphicon glyphicon-search"> </span>查询</button>
                                        <button type="button" class="btn col-md-offset-2 col-md-4 blue" onclick="search_clear()"><span class="glyphicon glyphicon-refresh"> </span>重置</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 column sortable">

                <div class="portlet portlet-sortable box blue-madison ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-light"></i>
                            <span class="caption-subject font-light sbold uppercase">用户列表</span>
                        </div>
                    </div>

                    <div class="portlet-body">
                        <div id="result_notification"></div>
                        <div class="clearfix" style="margin-left: 10%;">
                            <input type="hidden" id="user_data_id" value="">
                            <div class="row">
                                <button type="button" class="btn blue-madison" data-target="#add_user" data-toggle="modal"><span aria-hidden="true" class="icon-user-follow"></span>&nbsp;新增用户</button>
                                <div id="add_user" class="modal fade" tabindex="-1" data-focus-on="input:first">
                                    <div class="portlet box blue-madison portlet-fit portlet-form ">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-user-plus"></i>
                                                <span class="caption-subject font-light sbold uppercase">新增用户</span>
                                            </div>
                                            <div class="actions">
                                                <a data-dismiss="modal" class="btn btn-circle btn-icon-only btn-light" href="javascript:;">
                                                 <i class="fa fa-close"></i>
                                              </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <form action="#" method="post" id="form_new_user">
                                                <div class="form-body">
                                                    <div class="alert alert-danger display-hide">
                                                        <button class="close" data-close="alert"></button>你有一些表单错误。 请检查下面。
                                                    </div>
                                                    <div id="result_notification2"> </div>
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-12 form-md-line-input ">
                                                            <input type="text" name="usr_id" autocomplete="off" onchange="check_duplication(this.value)" class="form-control" id="n_usr_id">
                                                            <label for="form_control_1">账号</label>
                                                            <span id="error_check_duplication"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row  col-md-12">
                                                        <div class="form-group col-md-6 form-md-line-input  ">
                                                            <input type="password" class="form-control" autocomplete="off" id="register_password" name="usr_passwd" id="n_usr_passwd">
                                                            <label for="form_control_1">密码</label>
                                                            <span class="help-block">請輸入账号</span>
                                                        </div>
                                                        <div class="form-group col-md-6 form-md-line-input ">
                                                            <input type="password" class="form-control" autocomplete="off" id="rusr_passwd" name="rusr_passwd">
                                                            <label for="form_control_1">确认密码</label>
                                                            <span class="help-block">請輸入账号</span>
                                                        </div>

                                                    </div>
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-6 form-md-line-input  ">
                                                            <input type="text" class="form-control" name="usr_name" id="n_usr_name">
                                                            <label for="form_control_1">姓名</label>
                                                            <span class="help-block">请输入姓名</span>
                                                        </div>
                                                        <div class="form-group col-md-6 form-md-line-input  ">
                                                            <input type="number" class="form-control" name="usr_age" id="n_usr_age">
                                                            <label for="form_control_1">年龄</label>
                                                            <span class="help-block">请输入年龄</span>
                                                        </div>
                                                    </div>
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-6 form-md-line-input  ">
                                                            <select class="form-control" name="usr_gender" id="n_usr_gender">
                                                          <option value=""></option>
                                                          <option value="1">男</option>
                                                          <option value="0">女</option>
                                                          </select>
                                                            <label for="form_control_1">性别</label>
                                                            <span class="help-block">请输入性别</span>
                                                        </div>
                                                        <div class="form-group col-md-6 form-md-line-input  ">
                                                            <select class="form-control" name="usr_department" id="n_usr_department">
                                                              <option value="">请选择</option>
                                                              <?php foreach ($department_info as $value) {
                                                                    echo '<option value="' . $value->department_name . '">' . $value->department_name . '</option>';
                                                                }
                                                              ?>
                                                          </select>
                                                            <label for="form_control_1">所属科室</label>
                                                            <span class="help-block">请输入所属科室</span>
                                                        </div>
                                                    </div>
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-6 form-md-line-input  ">
                                                            <input type="text" class="form-control" readonly value="<?=$this->session->userdata('hospital_name')?>" name="usr_hospital"
                                                                id="n_usr_hospital">
                                                            <label for="form_control_1">所属医院</label>
                                                            <span class="help-block">请输入所属医院</span>
                                                        </div>
                                                        <div class="form-group  col-md-6 form-md-line-input  ">
                                                            <input type="text" class="form-control" name="usr_phone_num" id="n_usr_phone_num">
                                                            <label for="form_control_1">联系方式</label>
                                                            <span class="help-block">请输入联系方式</span>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        function check_duplication(val) {
                                                            var base_url = '<?=base_url()?>';
                                                            var strURL = base_url + "usermg/check_id";
                                                            $.post(strURL, {
                                                                    usr_id: val
                                                                })
                                                                .done(function (data) {
                                                                    if (data) {
                                                                        $("#error_check_duplication").css("display",
                                                                            "block");
                                                                        $("#error_check_duplication").html(data);
                                                                        $("#add_user_button").attr("disabled",
                                                                            "true");
                                                                    } else {
                                                                        $("#error_check_duplication").css("display",
                                                                            "none");
                                                                        $("#add_user_button").removeAttr("disabled");
                                                                    }
                                                                });

                                                        }
                                                    </script>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <button type="button" id="add_user_button" onclick="add_user_submit()" class="btn dark pull-left">添加</button>
                                                                <a href="javascript:;" data-dismiss="modal" onclick = "AddUserClose()" class="btn default pull-right">返回</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn  grey-silver " disabled data-target="#accession" data-toggle="modal" id="set_user_access"><span class="glyphicon glyphicon-lock"> </span>&nbsp;权限</button>

                                <div id="accession" class="modal fade" tabindex="-1" data-focus-on="input:first">
                                    <div class="portlet box blue-madison portlet-form ">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-user-plus"></i>
                                                <span class="caption-subject font-light sbold uppercase">选择权限</span>
                                            </div>
                                            <div class="actions">
                                                <a data-dismiss="modal" class="btn btn-circle btn-icon-only btn-light">
                                                 <i class="fa fa-close"></i>
                                              </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <form action="<?=base_url()?>usermg/add_user" method="post" id="form_sample_1">
                                                <div class="form-body">
                                                    <div id="set_access_notification"></div>
                                                    <div class="row">
                                                        <div class="form-group form-md-checkboxes">
                                                            <label>权限分配</label>
                                                            <div class="md-checkbox-list">
                                                                <div class="md-checkbox ">
                                                                    <input type="checkbox" id="booking_check" class="md-check">
                                                                    <label for="booking_check">
                                                                      <span></span>
                                                                      <span class="check"></span>
                                                                      <span class="box"></span>登记列表 </label>
                                                                </div>
                                                                <div class="md-checkbox ">
                                                                    <input type="checkbox" id="report_check" class="md-check">
                                                                    <label for="report_check">
                                                                      <span></span>
                                                                      <span class="check"></span>
                                                                      <span class="box"></span> 报告列表 </label>
                                                                </div>
                                                                <div class="md-checkbox ">
                                                                    <input type="checkbox" id="deliberation_check" class="md-check">
                                                                    <label for="deliberation_check">
                                                                      <span></span>
                                                                      <span class="check"></span>
                                                                      <span class="box"></span> 审核权限 </label>
                                                                </div>
                                                                <div class="md-checkbox ">
                                                                    <input type="checkbox" id="remote_check" class="md-check">
                                                                    <label for="remote_check">
                                                                      <span></span>
                                                                      <span class="check"></span>
                                                                      <span class="box"></span> 远程诊断请求</label>
                                                                </div>
                                                                <div class="md-checkbox ">
                                                                    <input type="checkbox" id="my_data_check" class="md-check">
                                                                    <label for="my_data_check">
                                                                      <span></span>
                                                                      <span class="check"></span>
                                                                      <span class="box"></span> 我的咨询 </label>
                                                                </div>
                                                                <div class="md-checkbox ">
                                                                    <input type="checkbox" id="learn_check" class="md-check">
                                                                    <label for="learn_check">
                                                                      <span></span>
                                                                      <span class="check"></span>
                                                                      <span class="box"></span> 在线视教学</label>
                                                                </div>
                                                                <div class="md-checkbox ">
                                                                    <input type="checkbox" id="contact_check" class="md-check">
                                                                    <label for="contact_check">
                                                                      <span></span>
                                                                      <span class="check"></span>
                                                                      <span class="box"></span> 讨论交流区</label>
                                                                </div>
                                                                <div class="md-checkbox ">
                                                                    <input type="checkbox" id="shareinfo_check" class="md-check">
                                                                    <label for="shareinfo_check">
                                                                      <span></span>
                                                                      <span class="check"></span>
                                                                      <span class="box"></span> 资科共享</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="button" id="set_access_button" onclick="set_access()" class="btn dark pull-left">更新</button>
                                                            <a data-dismiss="modal" onclick="table.ajax.reload();" class="btn default pull-right">返回</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-primary " disabled data-toggle="modal" onclick="set_access_allow()" id="set_access_allow"><span class="glyphicon glyphicon-play"> </span> &nbsp;激活</button>

                                <button type="button" class="btn blue-madison " disabled id="set_access_denite" onclick="set_access_denite()"><span class="glyphicon glyphicon-stop"> </span>&nbsp;注销</button>

                                <button type="button" class="btn btn-success" disabled id="edit_user_data_btn" data-target="#edit_user_data" data-toggle="modal"><span class="glyphicon glyphicon-edit"> </span>编辑</button>

                                <div id="edit_user_data" class="modal fade" tabindex="-1" data-focus-on="input:first">
                                    <div class="portlet box blue-madison portlet-fit portlet-form ">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-edit"></i>
                                                <span class="caption-subject font-light sbold uppercase">修改用户信息</span>
                                            </div>
                                            <div class="actions">
                                                <a data-dismiss="modal" class="btn btn-circle btn-icon-only btn-light" href="javascript:;">
                                                 <i class="fa fa-close"></i>
                                              </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <!-- BEGIN FORM-->
                                            <div id="result_edit_user_info"></div>
                                            <form action="#" method="post" id="update_user_info">
                                                <div class="form-body">
                                                    <div class="alert alert-danger display-hide">
                                                        <button class="close" data-close="alert"></button>你有一些表单错误。 请检查下面。
                                                    </div>
                                                    <div class="alert alert-success display-hide">
                                                        <button class="close" data-close="alert"></button>您的表单验证成功！ </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12 form-md-line-input ">
                                                            <input type="text" name="usr_id" disabled id="usr_id" autocomplete="off" class="form-control">
                                                            <label for="form_control_1">账号</label>
                                                            <span id="error_message" class="help-block">請輸入账号</span>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="usr_update_id" id="usr_update_id">
                                                    <div class="row">
                                                        <div class="form-group col-md-6 form-md-line-input  has-success">
                                                            <input type="text" class="form-control" id="usr_name" name="usr_name">
                                                            <label for="form_control_1">姓名</label>
                                                            <span class="help-block">请输入姓名</span>
                                                        </div>
                                                        <div class="form-group col-md-6 form-md-line-input  ">
                                                            <input type="number" class="form-control" id="usr_age" name="usr_age">
                                                            <label for="form_control_1">年龄</label>
                                                            <span class="help-block">请输入年龄</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6 form-md-line-input  ">
                                                            <select class="form-control" id="usr_gender" name="usr_gender">
                                                          <option value=""></option>
                                                          <option value="1">男</option>
                                                          <option value="0">女</option>
                                                          </select>
                                                            <label for="form_control_1">性别</label>
                                                            <span class="help-block">请输入性别</span>
                                                        </div>
                                                        <div class="form-group col-md-6 form-md-line-input  ">
                                                            <select class="form-control" name="usr_department" id="usr_department">
                                                              <option value="">请选择</option>
                                                              <option value="内科">内科</option>
                                                                <?php foreach ($department_info as $value) {
                                                                        echo '<option value="' . $value->department_name . '">' . $value->department_name . '</option>';
                                                                    }
                                                                    ?>
                                                          </select>
                                                            <label for="form_control_1">所属科室</label>
                                                            <span class="help-block">请输入所属科室</span>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6 form-md-line-input  ">
                                                            <input type="text" readonly id="usr_hospital" class="form-control" name="usr_hospital">
                                                            <label for="form_control_1">所属医院</label>
                                                            <span class="help-block">请输入所属医院</span>
                                                        </div>
                                                        <div class="form-group  col-md-6 form-md-line-input  ">
                                                            <input type="text" class="form-control" id="usr_phone_num" name="usr_phone_num">
                                                            <label for="form_control_1">联系方式</label>
                                                            <span class="help-block">请输入联系方式</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" id="user_update_button" class="btn dark pull-left">修改</button>
                                                            <a href="javascript:;" data-dismiss="modal" onclick="EditCloseUser()" class="btn default pull-right">返回</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn blue-hoki" data-target="#set_passwd_model" data-toggle="modal" disabled id="set_passwd"><span aria-hidden="true" class="icon-key">&nbsp;</span>重置密码</button>

                                <div id="set_passwd_model" class="modal fade" tabindex="-1" data-focus-on="input:first">
                                    <div class="portlet box green portlet-fit portlet-form ">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-key"></i>
                                                <span class="caption-subject font-light sbold uppercase">修改密码</span>
                                            </div>
                                            <div class="actions">
                                                <a data-dismiss="modal" class="btn btn-circle btn-icon-only btn-light" href="javascript:;">
                                                 <i class="fa fa-close"></i>
                                              </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <!-- BEGIN FORM-->
                                            <form action="#" class="form-horizontal" id="change_passwd_form">
                                                <div class="form-body">
                                                    <div id="notification_update_passwd"></div>

                                                    <div class="alert alert-danger display-hide">
                                                        <button class="close" data-close="alert"></button>你有一些表单错误。 请检查下面。
                                                    </div>
                                                    <div class="alert alert-success display-hide">
                                                        <button class="close" data-close="alert"></button>您的表单验证成功！ </div>
                                                    <div class="form-group form-md-line-input">
                                                        <label class="control-label col-md-3">旧密码</label>
                                                        <div class="col-md-9">
                                                            <div class="input-icon right">
                                                                <input type="password" name="old_passwd" onchange="check_passwd(this.value)" class="form-control" />
                                                                <span id="error_message1"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-md-line-input">
                                                        <label class="control-label col-md-3">新密码</label>
                                                        <div class="col-md-9">
                                                            <div class="input-icon right">
                                                                <input type="password" name="new_passwd" id="new_passwd" class="form-control" />                                                                </div>
                                                            <span id="queren_mima"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-md-line-input">
                                                        <label class="control-label col-md-3">确定密码</label>
                                                        <div class="col-md-9">
                                                            <div class="input-icon right">
                                                                <input type="password" name="new_r_passwd" id="new_r_passwd" class="form-control" />                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn green pull-left" id="update_passwd_button">修改</button>
                                                            <button type="button" data-dismiss="modal" class="btn default pull-right">返回</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="serach_user_data">
                            <thead>
                                <tr>
                                    <th width="2%">序号</th>
                                    <th width="2%">用户状态</th>
                                    <th width="5%">ID</th>
                                    <th width="5%">姓名</th>
                                    <th width="1%">性别</th>
                                    <th width="5%">年龄</th>
                                    <th width="5%">所属科室</th>
                                    <th width="5%">所属医院</th>
                                    <th width="5%">联系电话</th>
                                    <th width="5%">申请时间</th>
                                    <th width="5%">激活时间</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script>
        var table = '';
        var originalModal = '';
        var e = $("#form_new_user"),
            r = $(".alert-danger", e),
            i = $(".alert-success", e);
        function AddUserClose() {
            $('#add_user').find('.help-block-error').remove();
            $('#add_user').find('.form-group').removeClass('has-error');
        }

        function EditCloseUser() {
            $('#edit_user_data').find('.help-block-error').html('');
            $('#edit_user_data').find('.form-group').removeClass('has-error');
        }
        

        function SaveModal() {
            $('#add_user').remove();
            var myClone = originalModal.clone();
            $('body').append(myClone);
        }
        function add_user_submit() {
            $("#form_new_user").validate({
                errorElement: "span",
                errorClass: "help-block help-block-error",
                focusInvalid: !1,
                ignore: "",
                messages: {
                    required: "这是必填字段",
                    remote: "请修正此字段",
                    email: "请输入有效的电子邮件地址",
                    url: "请输入有效的网址",
                    date: "请输入有效的日期",
                    dateISO: "请输入有效的日期 (YYYY-MM-DD)",
                    number: "请输入有效的数字",
                    digits: "只能输入数字",
                    creditcard: "请输入有效的信用卡号码",
                    equalTo: "你的输入不相同",
                    extension: "请输入有效的后缀",
                    maxlength: $.validator.format("最多可以输入 {0} 个字符"),
                    minlength: $.validator.format("最少要输入 {0} 个字符"),
                    rangelength: $.validator.format("请输入长度在 {0} 到 {1} 之间的字符串"),
                    range: $.validator.format("请输入范围在 {0} 到 {1} 之间的数值"),
                    max: $.validator.format("请输入不大于 {0} 的数值"),
                    min: $.validator.format("请输入不小于 {0} 的数值"),
                    usr_id: {
                        required: "这是必填字段",
                        maxlength: $.validator.format("最多可以输入 {0} 个字符"),
                        minlength: $.validator.format("最少要输入 {0} 个字符"),
                        pattern: '只能为英文或者数字'

                    },
                    usr_passwd: {
                        required: "这是必填字段.",
                        equalTo: "你的输入不相同",
                        maxlength: $.validator.format("最多可以输入 {0} 个字符"),
                        minlength: $.validator.format("最少要输入 {0} 个字符")
                    },
                    rusr_passwd: {
                        required: "这是必填字段",
                        equalTo: "你的输入不相同"
                    },
                    usr_name: {
                        required: "这是必填字段"
                    },
                    usr_age: {
                        required: "这是必填字段"

                    },
                    usr_gender: {
                        required: "这是必填字段"

                    },
                    usr_department: {
                        required: "这是必填字段"

                    },
                    usr_phone_num: {
                        required: "这是必填字段",
                        maxlength: $.validator.format("最多可以输入 {0} 个字符"),
                        minlength: $.validator.format("最少要输入 {0} 个字符")
                    }
                },
                rules: {
                    usr_id: {
                        minlength: 4,
                        maxlength: 16,
                        required: !0,
                        pattern: '[A-Za-z0-9\w]{4,20}'
                    },
                    usr_passwd: {
                        required: !0,
                        minlength: 6,
                        maxlength: 16
                    },
                    rusr_passwd: {
                        equalTo: "#register_password"
                    },
                    new_passwd: {
                        required: !0,
                    },
                    usr_gender: {
                        required: !0,
                    },
                    new_r_passwd: {
                        equalTo: "#new_passwd"
                    },
                    usr_name: {
                        required: !0,
                    },
                    usr_department: {
                        required: !0,
                    },
                    usr_phone_num: {
                        required: !0,
                        minlength: 10,
                        maxlength: 15
                    },
                    usr_age: {
                        required: !0,
                        number: !0
                    }
                },
                invalidHandler: function (e, t) {
                    i.hide(), r.show(), App.scrollTo(r, -200)
                },
                errorPlacement: function (e, r) {
                    r.is(":checkbox") ? e.insertAfter(r.closest(
                            ".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline")) :
                        r.is(":radio") ? e.insertAfter(r.closest(
                            ".md-radio-list, .md-radio-inline, .radio-list,.radio-inline")) : e.insertAfter(
                            r)
                },
                highlight: function (e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function (e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
                success: function (e) {
                    e.closest(".form-group").removeClass("has-error")
                },
                submitHandler: function (e) {
                    add_user();
                }
            });
            $('#form_new_user').submit();



        }

        $(document).ready(function () {
            originalModal = $('#add_user').clone();

            $('#add_user').on('hidden.bs.modal', function (e) {
                $('#add_user').remove();
                var myClone = originalModal.clone();
                $('body').append(myClone);
            });

            var tbl_usr_info = '<?=base_url()?>' + 'usermg/search_user';
            table = $('#serach_user_data').DataTable({
                "ajax": tbl_usr_info,
                dom: 'Bfrtip',
                "ordering": false,
                "ordering": false,
                'searching': false,
                pageLength: 5,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                pagingType: "bootstrap_full_number",
                select: true,
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "没有数据",
                    info: "显示 _START_ 到 _END_ 的 _TOTAL_ 条记录",
                    infoEmpty: "找不到",
                    search: "",
                    infoFiltered: "(filtered1 from _MAX_ total records)",
                    lengthMenu: "显示 _MENU_",
                    zeroRecords: "找不到匹配的记录",
                    paginate: {
                        previous: "Prev",
                        next: "Next",
                        last: "Last",
                        first: "First"
                    }
                },
                buttons: [{
                    extend: "print",
                    className: "btn dark btn-outline",
                    text: "打印"
                }, {
                    extend: "copy",
                    className: "btn red btn-outline",
                    text: "复制"

                }, {
                    extend: "pdf",
                    className: "btn green btn-outline",
                    text: "pdf"
                }, {
                    extend: "excel",
                    className: "btn yellow btn-outline "
                }, {
                    extend: "csv",
                    className: "btn purple btn-outline "
                }],
                bStateSave: !0,
                columnDefs: [{
                    targets: 0,
                    orderable: !1,
                    searchable: !0
                }],
                lengthMenu: [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"]
                ],
                pageLength: 5,
                pagingType: "bootstrap_full_number",
                columnDefs: [{
                    orderable: !1,
                    targets: [0]
                }, {
                    searchable: !0,
                    targets: [0]
                }],
                order: [
                    [0, "asc"]
                ]
            });

            table.buttons().remove();
            $('#serach_user_data tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
                var data = table.row(this).data();
                var user_id = data[2];
                var base_url = '<?=base_url()?>';
                var strURL = base_url + "usermg/get_user_info/" + user_id;
                $.ajax({
                    dataType: "json",
                    url: strURL,
                    success: function (response) {
                        select_user(response);
                    }
                });
            });

            $("#search_user_btn").click(function () {
                var base_url = '<?=base_url()?>';
                var formData = $('#search_user_info_form').serialize();
                var ajaxurl = base_url + 'usermg/search_user?' + formData;
                table.ajax.url(ajaxurl).load();
            });
        });

        function update_user() {
            var base_url = '<?=base_url()?>';
            var strURL = base_url + "usermg/update_user/";
            var id = $('#user_data_id').val();
            var usr_id = $("#usr_id").val();
            var usr_passwd = $("#usr_passwd").val();
            var usr_name = $("#usr_name").val();
            var usr_age = $("#usr_age").val();
            var usr_gender = $("#usr_gender").val();
            var usr_department = $("#usr_department").val();
            var usr_hospital = $("#usr_hospital").val();
            var usr_phone_num = $("#usr_phone_num").val();
            var message = '<div class="alert alert-danger display"><button class="close" data-close="alert"></button>';
            $.post(strURL, {
                usr_update_id: id,
                usr_id: usr_id,
                usr_passwd: usr_passwd,
                usr_name: usr_name,
                usr_age: usr_age,
                usr_department: usr_department,
                usr_hospital: usr_hospital,
                usr_phone_num: usr_phone_num
            }).done(function (data) {
                if (data) {
                    message += "添加成功了！</div>";
                    $('#submit_button').attr("disabled", "true");
                    $('#result_edit_user_info').html(message).delay(1000);
                    $('#edit_user_data').slideUp(1000);
                    table.ajax.reload();
                } else {
                    message += "添加失败了！</div>";
                    $('#result_edit_user_info').html(message).delay(1000).slideUp(1000);
                }
            });

        };

        function add_user() {
            var base_url = '<?=base_url()?>';
            var strURL = base_url + "usermg/add_user/";
            var usr_id = $("#n_usr_id").val();
            var usr_passwd = $("#register_password").val();
            var usr_name = $("#n_usr_name").val();
            var usr_age = $("#n_usr_age").val();
            var usr_gender = $("#n_usr_gender").val();
            var usr_department = $("#n_usr_department").val();
            var usr_hospital = $("#n_usr_hospital").val();
            var usr_phone_num = $("#n_usr_phone_num").val();
            var rusr_passwd = $('#rusr_passwd').val();
            var message = '<div class="alert alert-danger display"><button class="close" data-close="alert"></button>';
            if (usr_id && usr_passwd && usr_passwd == rusr_passwd && usr_age && usr_gender && usr_phone_num &&
                usr_department && usr_hospital) {
                $.post(strURL, {
                    usr_id: usr_id,
                    usr_gender: usr_gender,
                    usr_passwd: usr_passwd,
                    usr_name: usr_name,
                    usr_age: usr_age,
                    usr_department: usr_department,
                    usr_hospital: usr_hospital,
                    usr_phone_num: usr_phone_num
                }).done(function (data) {
                    if (data) {
                        message += "添加成功了！</div>";
                        $('#submit_button').attr("disabled", "true");
                        $('#result_notification2').html(message).delay(1000);
                        $('#form_new_user')[0].reset();
                        table.ajax.reload();
                    } else {
                        message += "添加失败了！</div>";
                        $('#result_notification2').html(message).delay(2000);
                    }
                });
            } else if (usr_passwd != rusr_passwd) {
                message += "密码不一样的</div>";
                $('#result_notification2').html(message).delay(1000);

            } else {
                message += "每项均为必填</div>";
                $('#result_notification2').html(message).delay(1000);
            }



        };

        function check_passwd(val) {
            var base_url = '<?=base_url()?>';
            var strURL = base_url + "usermg/check_passwd";
            var usr_id = $('#usr_id').val();
            $.post(strURL, {
                    passwd: val,
                    usr_id: usr_id
                })
                .done(function (data) {
                    if (data) {
                        $("#error_message1").css("display", "block");
                        $("#error_message1").html(data);
                        $("#update_passwd_button").attr("disabled", "true");
                    } else {
                        $("#error_message1").css("display", "none");
                        $("#update_passwd_button").removeAttr("disabled");
                    }
                });
        }

        function update_passwd(val) {
            var new_passwd = $('#new_passwd').val();
            var new_r_passwd = $('#new_r_passwd').val();
            $('#update_result_no').addClass('display-hide');
            if (new_r_passwd != new_passwd) {
                $("#queren_mima").css("display", "block");
                $("#queren_mima").html('<small style="padding-left:10px;color:red;font-size:14px">你的输入不相同</small>');
            } else {
                var base_url = '<?=base_url()?>';
                var strURL = base_url + "usermg/update_passwd";
                var usr_id = $('#usr_id').val();
                $.post(strURL, {
                        new_passwd: new_passwd,
                        usr_id: usr_id
                    })
                    .done(function (data) {
                        if (data) {
                            $("#queren_mima").css("display", "none");
                            $('#notification_update_passwd').html(
                                '<div class="alert alert-danger display"><button class="close" data-close="alert"></button><small style="padding-left:10px;color:red;font-size:14px">密码修改成功了</small></div>'
                            );
                            $("#update_passwd_button").attr("disabled", "true");
                            $('#change_passwd_form')[0].reset();
                            table.ajax.reload();
                        } else {
                            $("#queren_mima").css("display", "none");
                            $('#update_result_no').removeClass('display-hide');
                        }
                    });

            }

        }

        function select_user(val) {
            var id = val.id;
            var usr_id = val.usr_id;
            var usr_name = val.usr_name;
            var usr_age = val.usr_age;
            var usr_gender = val.usr_gender;
            var usr_department = val.usr_department;
            var usr_hospital = val.usr_hospital;
            var usr_phone_num = val.usr_phone_num;
            var usr_status = val.usr_status;
            var m_booking = val.m_booking;
            var m_report = val.m_report;
            var m_deliberation = val.m_deliberation;
            var m_share = val.m_share;
            var m_contact = val.m_contact;
            var m_learn = val.m_learn;
            var m_mydata = val.m_mydata;
            var m_remote = val.m_remote;
            $('#user_data_id').val(id);
            $('#usr_update_id').val(id);
            $('#usr_id').val(usr_id);
            $('#usr_name').val(usr_name);
            $('#usr_age').val(usr_age);
            $('#usr_gender').val(usr_gender);
            $('#usr_department').val(usr_department);
            $('#usr_hospital').val(usr_hospital);
            $('#usr_phone_num').val(usr_phone_num);
            if (usr_status == '1') {
                $("#set_access_allow").attr("disabled", "true");
                $("#set_access_denite").removeAttr("disabled");
                $("#set_user_access").removeAttr("disabled");
                $("#set_passwd").removeAttr("disabled");
                $("#edit_user_data_btn").removeAttr("disabled");
            } else if (usr_status == '2') {
                $("#set_access_denite").attr("disabled", "true");
                $("#set_passwd").attr("disabled", "true");
                $("#set_access_allow").removeAttr("disabled");
                $("#edit_user_data_btn").attr("disabled", "true");
                $("#set_user_access").attr("disabled", "true");
            } else {
                $("#set_access_allow").removeAttr("disabled");
                $("#set_access_denite").attr("disabled", "true");
                $("#set_user_access").removeAttr("disabled");
                $("#set_passwd").removeAttr("disabled");
                $("#edit_user_data_btn").removeAttr("disabled");

            }

            if (m_booking == 'true') {
                $("#booking_check").prop("checked", true);
            } else {
                $("#booking_check").prop("checked", false);
            }
            if (m_report == 'true') {
                $("#report_check").prop("checked", true);
            } else {
                $("#report_check").prop("checked", false);


            }
            if (m_deliberation == 'true') {
                $("#deliberation_check").prop("checked", true);
            } else {
                $("#deliberation_check").prop("checked", false);


            }
            if (m_remote == 'true') {
                $("#remote_check").prop("checked", true);
            } else {
                $("#remote_check").prop("checked", false);


            }
            if (m_mydata == 'true') {
                $("#my_data_check").prop("checked", true);
            } else {
                $("#my_data_check").prop("checked", false);


            }
            if (m_learn == 'true') {
                $("#learn_check").prop("checked", true);
            } else {
                $("#learn_check").prop("checked", false);


            }
            if (m_contact == 'true') {
                $("#contact_check").prop("checked", true);
            } else {
                $("#contact_check").prop("checked", false);


            }
            if (m_share == 'true') {
                $("#shareinfo_check").prop("checked", true);
            } else {
                $("#shareinfo_check").prop("checked", false);


            }
        }

        function set_access_allow() {
            var base_url = '<?=base_url()?>';
            val = $('#user_data_id').val();
            var strURL = base_url + "usermg/update_activity";
            var message = '<div class="alert alert-danger display"><button class="close" data-close="alert"></button>';
            $.post(strURL, {
                    user_data_id: val
                })
                .done(function (data) {
                    if (data) {
                        message += "激活已成功了！</div>";
                        $('#result_notification').html(message).slideUp(1000);
                        table.ajax.reload();
                    } else {
                        message += "激活失败了！</div>";
                        $('#result_notification').html(message).slideUp(1000);
                    }
                });
        };

        function set_access_user() {
            var base_url = '<?=base_url()?>';
            val = $('#user_data_id').val();
            var strURL = base_url + "usermg/set_access_denite";
            var message = '<div class="alert alert-danger display"><button class="close" data-close="alert"></button>';
            $.post(strURL, {
                    user_data_id: val
                })
                .done(function (data) {
                    if (data) {
                        message += "激活已成功了！</div>";
                        $('#result_notification').html(message).slideUp(1000);
                        table.ajax.reload();
                    } else {
                        message += "激活失败了！</div>";
                        $('#result_notification').html(message).slideUp(1000);

                    }
                });
        };

        function set_access_denite() {
            var base_url = '<?=base_url()?>';
            val = $('#user_data_id').val();
            var strURL = base_url + "usermg/set_access_denite";
            var message = '<div class="alert alert-danger display"><button class="close" data-close="alert"></button>';
            $.post(strURL, {
                    user_data_id: val
                })
                .done(function (data) {
                    if (data) {
                        message += "激活已成功了！</div>";
                        $('#result_notification').html(message);
                        table.ajax.reload();
                    } else {
                        message += "激活失败了！</div>";
                        $('#result_notification').html(message);
                    }
                });
        };

        function set_access() {
            var booking_check = $("#booking_check").is(':checked');
            var report_check = $("#report_check").is(':checked');
            var deliberation_check = $("#deliberation_check").is(':checked');
            var remote_check = $("#remote_check").is(':checked');
            var my_data_check = $("#my_data_check").is(':checked');
            var learn_check = $("#learn_check").is(':checked');
            var contact_check = $("#contact_check").is(':checked');
            var shareinfo_check = $("#shareinfo_check").is(':checked');
            var val = $('#user_data_id').val();
            var base_url = '<?=base_url()?>';
            var strURL = base_url + "usermg/set_access";
            var message = '<div class="alert alert-danger display"><button class="close" data-close="alert"></button>';
            $.post(strURL, {
                m_booking: booking_check,
                m_report: report_check,
                m_deliberation: deliberation_check,
                m_remote: remote_check,
                m_mydata: my_data_check,
                m_learn: learn_check,
                m_contact: contact_check,
                m_share: shareinfo_check,
                usr_data_id: val
            }).done(function (data) {
                if (data) {
                    message += "设置成功了！</div>";
                    $('#set_access_notification').html(message).delay(400);
                    table.ajax.reload();
                } else {
                    message += "设置失败了！</div>";
                    $('#set_access_notification').html(message);
                }

            });


        }

        function search_clear() {
            $('#search_user_info_form')[0].reset();
            table.ajax.reload();
        }
    </script>