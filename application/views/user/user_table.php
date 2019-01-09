<div class="page-content-wrapper">
    <div class="page-content">

    <?php $usrRole = $this->session->userdata('usr_role')?>
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
                    <span>
                        <?=$menutitle?>
                    </span>
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
                            <span class="caption-subject font-default uppercase">用户管理</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="#" method="post" class="form-horizontal" id="search_user_info_form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group form-md-line-input">
                                        <label class="col-lg-4  col-md-3 control-label" for="form_control_1">
                                            <?=$this->lang->line('name')?>
                                        </label>
                                        <div class=" col-lg-8 col-md-9">
                                            <input type="text" class="form-control" id="s_usr_name" name="usr_name">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">请输入姓名</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group form-md-line-input">
                                        <label class="col-lg-4  col-md-3 control-label" for="form_control_1">
                                            <?=$this->lang->line('age')?>
                                        </label>
                                        <div class="col-lg-8 col-md-9">
                                            <input type="text" class="form-control" placeholder="" id="s_usr_age" name="usr_age">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">请输入
                                                <?=$this->lang->line('age')?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group form-md-line-input">
                                        <label class="col-md-3 col-lg-4 control-label" for="form_control_1">
                                            <?=$this->lang->line('gender')?>
                                        </label>
                                        <div class="col-md-9 col-lg-8">
                                            <select class="form-control" id="s_usr_gender" name="usr_gender">
                                                <option value="">请选择</option>
                                                <option value="1">男</option>
                                                <option value="0">女</option>
                                            </select>
                                            <div class="form-control-focus"> </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group form-md-line-input">
                                        <label class="col-lg-5 col-md-3 control-label" for="form_control_1">用户状态</label>
                                        <div class="col-lg-7 col-md-9">
                                            <select class="form-control" id="s_usr_status" name="usr_status">
                                                <option value="">请选择</option>
                                                <option value="1">已激活</option>
                                                <option value="0">未激活</option>
                                                <option value="2">已注销</option>

                                            </select>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group form-md-line-input">
                                        <label class="control-label col-lg-4 col-md-3">申请时间</label>
                                        <div class="col-lg-8 col-md-9">
                                            <input class="form-control form-control-inline input-medium date-picker" placeholder="01/01/2017" name="start_time" type="text"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group form-md-line-input">
                                        <label class="control-label col-lg-4 col-md-3">至</label>
                                        <div class="col-lg-8 col-md-9">
                                            <input class="form-control form-control-inline input-medium date-picker" placeholder="01/01/2017" name="end_time" type="text"/>

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group form-md-line-input">
                                        <label class="col-md-3 col-lg-4 control-label" for="form_control_1">科室</label>
                                        <div class="col-md-9 col-lg-8">
                                            <input type="text" class="form-control" id="s_usr_department" name="usr_department">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                    <div class=" col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group form-md-input">
                                        <div class="clearfix">
                                            <button type="button" class="btn pull-left user-button" id="search_user_btn">
                                                <span class="glyphicon glyphicon-search"> </span>查询</button>
                                            <button type="button" class="btn pull-right user-button" onclick="search_clear()">
                                                <span class="glyphicon glyphicon-refresh"> </span>重置</button>
                                        </div>
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
                            <span class="caption-subject font-light uppercase">用户列表</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="result_notification"></div>
                        <div class="clearfix" style="margin-left: 10%;">
                            <div class="row">
                            <?php if (check_role('isNewUser')) : ?>
                                <button type="button" class="btn user-button" data-target="#add_user" data-toggle="modal">
                                    <span aria-hidden="true" class="icon-user-follow"></span>&nbsp;新增用户</button>
                                <div id="add_user" class="modal fade" tabindex="-1" data-focus-on="input:first">
                                    <div class="portlet box blue-madison portlet-sortable sortable">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-user-plus"></i>
                                                <span class="caption-subject font-light sbold uppercase">新增用户</span>
                                            </div>
                                            <div class="actions">
                                                <a data-dismiss="modal" onclick="AddUserClose()" class="btn btn-circle btn-icon-only btn-light">
                                                    <i class="fa fa-close"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <form action="#" method="post" id="form_new_user">
                                                <div class="form-body">
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-6 form-md-line-input ">
                                                            <input type="text" name="usr_id" autocomplete="off" onchange="check_duplication(this.value)" class="form-control" id="n_usr_id">
                                                            <label for="form_control_1">账号</label>
                                                            <span id="error_check_duplication"></span>
                                                        </div>
                                                        <div class="form-group col-md-6 form-md-line-input ">
                                                            <select class="form-control" onchange="changeUserRole(this.value)" name="usr_role" id="n_usr_role">
                                                                <option value="">请选择</option>
                                                                <?=$this->session->userdata('usr_role') == 1024 ? '<option value="1">院管理员</option>' : ''?>
                                                                <?=$this->session->userdata('usr_role') == 1 || $this->session->userdata('usr_role') == 1024 ? '<option value="10">子医院管理员</option>' : ''?>
                                                                <option value="1000">医生</option>
                                                            </select>
                                                            <label for="form_control_1">职务</label>
                                                            <span class="help-block">请输入职务</span>
                                                        </div>
                                                    </div>
                                                    <div class="row  col-md-12">
                                                        <div class="form-group col-md-6 form-md-line-input  ">
                                                            <input type="password" class="form-control" autocomplete="off" id="register_password" name="usr_passwd" id="n_usr_passwd">
                                                            <label for="form_control_1">密码</label>
                                                            <span class="help-block">請輸入密码</span>
                                                        </div>
                                                        <div class="form-group col-md-6 form-md-line-input ">
                                                            <input type="password" class="form-control" autocomplete="off" id="rusr_passwd" name="rusr_passwd">
                                                            <label for="form_control_1">确认密码</label>
                                                            <span class="help-block">請輸入确认密码</span>
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
                                                                <option value="">请选择</option>
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
                                                        <div class="form-group col-md-6 form-md-line-input">
                                                            <select class="form-control" name="usr_hospital" id="n_usr_hospital">
                                                                <option value="<?=$this->session->userdata('hospital_name')?>">
                                                                    <?=$this->session->userdata('hospital_name')?>
                                                                </option>
                                                            </select>
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
                                                                <button type="button" id="add_user_button" onclick="add_user_submit()" class="btn user-button pull-left">
                                                                    <span class="glyphicon glyphicon-plus"> </span>添加</button>
                                                                <a data-dismiss="modal" onclick="AddUserClose()" class="btn user-button pull-right">
                                                                    <span class="glyphicon glyphicon-log-out"> </span>返回</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>
                            <?php if ($usrRole == 1 || $usrRole == 1024 || $this->session->userdata('isAvailableRole')) : ?>
                                <button type="button" class="btn  user-button " disabled data-target="#accession" data-toggle="modal" id="set_user_access">
                                    <span class="glyphicon glyphicon-lock"> </span>&nbsp;权限</button>
                                <div id="accession" class="modal fade" tabindex="-1" data-focus-on="input:first">
                                    <div class="portlet box blue-madison portlet-sortable ">
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
                                            <form action="#" id="premissionForm" method="post">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input type="hidden" name="user_data_id" id="user_data_id" />
                                                            <div class="form-group col-md-12 form-md-line-input">
                                                                <label for="multiple" class="control-label">权限功能</label>
                                                                <input type="hidden" name="permissionList" id="permission_list_array">
                                                                    <div id="permission_tree" class="tree-demo"> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-10 col-md-offset-1">
                                                            <button type="button" id="set_access_button" onclick="set_access()" class="btn user-button pull-left">
                                                                <span class="glyphicon glyphicon-send"> </span>更新</button>
                                                            <a data-dismiss="modal" onclick="table.ajax.reload();" class="btn user-button pull-right">
                                                                <span class="glyphicon glyphicon-log-out"> </span>返回</a>
                                                        </div>
                                                    </div>
                                                </div>


                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>
                            <?php if (check_role('isActivation')) : ?>
                                <button type="button" class="btn user-button " disabled data-toggle="modal" onclick="set_access_allow()" id="set_access_allow">
                                    <span class="glyphicon glyphicon-play"> </span> 激活</button>
                                <button type="button" class="btn user-button" disabled id="set_access_denite" onclick="set_access_denite()">
                                    <span class="glyphicon glyphicon-stop"> </span>注销</button>
                            <?php endif;?>
                            <?php if (check_role('isEditableUser')) : ?>
                                <button type="button" class="btn user-button" disabled id="edit_user_data_btn" data-target="#edit_user_data" data-toggle="modal">
                                    <span class="glyphicon glyphicon-edit"> </span>编辑</button>
                                <div id="edit_user_data" class="modal fade" tabindex="-1" data-focus-on="input:first">
                                    <div class="portlet box blue-madison portlet-sortable ">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-edit"></i>
                                                <span class="caption-subject font-light sbold uppercase">修改用户信息</span>
                                            </div>
                                            <div class="actions">
                                                <a data-dismiss="modal" onclick="EditCloseUser()" class="btn btn-circle btn-icon-only btn-light">
                                                    <i class="fa fa-close"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div id="result_edit_user_info"></div>
                                            <form action="#" method="post" id="update_user_info">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group col-md-6 form-md-line-input ">
                                                                <input type="text" name="usr_id" disabled id="usr_id" autocomplete="off" class="form-control">
                                                                <label for="form_control_1">账号</label>
                                                                <span id="error_message" class="help-block">請輸入账号</span>
                                                            </div>
                                                            <div class="form-group col-md-6 form-md-line-input ">
                                                                <select class="form-control" name="usr_role" id="usr_role">
                                                                    <option value="">请选择</option>
                                                                    <?=$this->session->userdata('usr_role') == 1 || $this->session->userdata('usr_role') == 1024 ? '<option value="10">子医院管理员</option>' : ''?>
                                                                    <option value="1000">医生</option>
                                                                </select>
                                                                <label for="form_control_1">职务</label>
                                                                <span class="help-block">请输入职务</span>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="usr_update_id" id="usr_update_id">
                                                        <div class="col-md-12">
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
                                                        <div class="col-md-12">
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
                                                                    <?php foreach ($department_info as $value) {
                                                                        echo '<option value="' . $value->department_name . '">' . $value->department_name . '</option>';
}
?>
                                                                </select>
                                                                <label for="form_control_1">所属科室</label>
                                                                <span class="help-block">请输入所属科室</span>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-12">
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
                                                </div>

                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-10 col-md-offset-1">
                                                            <button type="submit" id="user_update_button" class="btn user-button pull-left">
                                                                <span class="glyphicon glyphicon-pencil"> </span>修改</button>
                                                            <a data-dismiss="modal" onclick="EditCloseUser()" class="btn user-button pull-right">
                                                                <span class="glyphicon glyphicon-log-out"> </span>返回</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>
                            <?php if (check_role('isResetPasswordUser')) : ?>
                                <button type="button" class="btn user-button" disabled id="set_passwd">
                                    <span aria-hidden="true" class="icon-key"></span>重置密码</button>
                            <?php endif;?>
                            <?php if (check_role('isDeleteUser')) : ?>
                                <button type="button" class="btn user-button" disabled id="deleteUser">
                                    <span aria-hidden="true" class="glyphicon glyphicon-trash"></span>删除</button>
                            <?php endif;?>
                            </div>
                        </div>


                        <table class="table-striped table-bordered table-hover" id="serach_user_data">
                            <thead>
                                <tr>
                                    <th>序号</th>
                                    <th>用户状态</th>
                                    <th>ID</th>
                                    <th>姓名</th>
                                    <th>性别</th>
                                    <th>年龄</th>
                                    <th>身份</th>
                                    <th>所属科室</th>
                                    <th>所属医院</th>
                                    <th>联系电话</th>
                                    <th>申请时间</th>
                                    <th>激活时间</th>
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
    <style media="screen">
        .user-button {
            width: 100px;
            background-color: rgb(51, 153, 153);
            font-size: 14px;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: 微软雅黑;
            color: rgb(255, 255, 255);
            padding: 0px;
            margin: 0px;
            word-break: break-word;
        }
    </style>
    <script>
        var table = '';
        var originalModal = '';
        var hospitalInfo = '';
        var isTotal = false;
        var totalhospitalInfo = '';
        var hosClass = '';
        var e = $("#form_new_user"),
            r = $(".alert-danger", e),
            i = $(".alert-success", e);
        function changeUserRole(params) {
            if (params == 1) {
                $("#n_usr_hospital").html(localStorage.getItem('hosclass'));
                $("#n_usr_hospital").removeAttr('disabled')
            } else if (params == 10) {
                if (isTotal) {
                    $("#n_usr_hospital").html(localStorage.getItem('hosTotal'));
                    $("#n_usr_hospital").removeAttr('disabled')
                } else {
                    $("#n_usr_hospital").html(localStorage.getItem('hosList'));
                    $("#n_usr_hospital").removeAttr('disabled')
                }
            } else {
                $("#n_usr_hospital").html('<option value="<?=$this->session->userdata('hospital_name')?>"><?=$this->session->userdata('hospital_name')?><option>');
            }

        }

        $(function () {
            <?php if ($this->session->userdata('usr_role') != 1024) : ?>
            <?php foreach ($hospital_info as $value) : ?>
            <?php if ($value->hospital_class == $this->session->userdata('hospital_name')) : ?>
            hospitalInfo += '<option value= "<?=$value->hospital_name?>" ><?=$value->hospital_name?></option>';
            <?php endif;?>
            <?php endforeach;?>
            <?php else : ?>
            <?php foreach ($hospital_info as $value) : ?>
            totalhospitalInfo += '<option value= "<?=$value->hospital_name?>" ><?=$value->hospital_name?></option>';
            <?php endforeach;?>
            isTotal = true;
            <?php foreach ($hospitalClass as $hosClass) : ?>
            hosClass += '<option value= "<?=$hosClass->hospital_class?>" ><?=$hosClass->hospital_class?></option>';
            <?php endforeach;?>
            <?php endif;?>
            localStorage.setItem('hosList', hospitalInfo);
            localStorage.setItem('hosclass', hosClass);
            localStorage.setItem('hosTotal', totalhospitalInfo);
            $('#set_passwd').click(function () {
                $.confirm({
                    title: '提示!',
                    icon: 'fa fa-unlock-alt',
                    theme: 'material',
                    content: '' +
                        '<form action="" class="formName">' +
                        '<div class="form-group form-md-line-input">' +
                        '<label>密码：</label>' +
                        '<input type="password" name="password" id = "reset_password" class="form-control" required />' +
                        '</div>' +
                        '<div class="form-group form-md-line-input">' +
                        '<label>确认密码：</label>' +
                        '<input type="password" name="rpassword" id = "repeat_password" class="form-control" required />' +
                        '</div>' +
                        '</form>',
                    buttons: {
                        formSubmit: {
                            text: '设置',
                            btnClass: 'btn-success',
                            action: function () {
                                if ($('#reset_password').val() == ''||$('#reset_password').val()!=$('#repeat_password').val()) {
                                    $.alert('请确认不合适密码');
                                    return true;
                                }

                                update_passwd($('#reset_password').val());
                            }
                        },
                        cancel: {
                            text: '返回',
                            btnClass: 'btn-warning',
                            action: function () {

                            }
                        },
                    },
                    onContentReady: function () {
                        // bind to events
                        var jc = this;
                        this.$content.find('form').on('submit', function (e) {
                            // if the user submits the form by pressing enter in the field.
                            e.preventDefault();
                            jc.$$formSubmit.trigger('click'); // reference the button and click it
                        });
                    }
                });
            });
            $('#deleteUser').click(function () {
                $.confirm({
                    title: '提示',
                    content: ' 确定删除该账号？',
                    icon: 'fa fa-warning',
                    theme: 'material',
                    autoClose: 'chancel|10000',
                    animation: 'zoom',
                    closeAnimation: 'scale',
                    draggable: true,
                    buttons: {
                        confirm: {
                            text: '是',
                            keys: ['shift', 'alt'],
                            action: function () {
                                var base_url = '<?=base_url()?>';
                                var val = $('#user_data_id').val();
                                var strURL = base_url + "usermg/deleteUser";
                                $.post(strURL, {
                                    usr_id: val
                                }).done(function (data) {
                                    $.alert('删除已成功了！');
                                    table.ajax.reload();
                                });
                            }
                        },
                        chancel: {
                            text: '否',
                            action: function () {
                                $(this).remove();
                            }

                        }
                    }
                });
            });

            $('#permission_tree').jstree({
                'plugins': ["wholerow", "json_data", "checkbox", "types"],
                 "checkbox": {
                        real_checkboxes: true,
                        two_state: true,
                        checked_parent_open: true,
                        three_state: true,
                        "keep_selected_style" : true
                },
                'core': {
                    "themes" : {
                        "responsive": false
                    },
                    'data': {
                        'type': 'POST',
                        'url': '<?=base_url()?>usermg/get_permission_tree',
                        "dataType": "json"
                    }
                },
                "types" : {
                    "default" : {
                        "icon" : "fa fa-suitcase icon-state-warning icon-lg"
                    },
                    "file" : {
                        "icon" : "fa fa-file icon-state-warning icon-lg"
                    }
                }
            }).on("changed.jstree", function (e, data) {
                $('#permission_list_array').val(JSON.stringify(data.selected));
            });


        });

        function AddUserClose() {
            $('#add_user').find('.help-block-error').remove();
            $('#add_user').find('.form-group').removeClass('has-error');
        }

        function upDatePasswd() {
            $('#change_passwd_form').find('.help-block-error').remove();
            $('#change_passwd_form').find('.form-group').removeClass('has-error');
        }

        function EditCloseUser() {
            $('#edit_user_data').find('.help-block-error').html('');
            $('#edit_user_data').find('.form-group').removeClass('has-error');
            $('#edit_user_data_btn').attr('disabled', 'true');
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
                    usr_role: {
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
                        minlength: 2,
                        maxlength: 16,
                        required: !0,
                        pattern: '[A-Za-z0-9\w]{4,20}'
                    },
                    usr_passwd: {
                        required: !0,
                        minlength: 6,
                        maxlength: 16
                    },
                    usr_role: {
                        required: true
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

            $(".modal").draggable({
                handle: ".portlet-title"
            });
            originalModal = $('#add_user').clone();

            $('#add_user').on('hidden.bs.modal', function (e) {
                $('#add_user').remove();
                var myClone = originalModal.clone();
                $('body').append(myClone);
            });

            var tbl_usr_info = '<?=base_url()?>' + 'usermg/search_user';
            table = $('#serach_user_data').DataTable({
                "ajax": tbl_usr_info,
                "dom": 'Bfrtip',
                "ordering": false,
                'searching': false,
                pageLength: 10,
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
                columnDefs: [{
                    targets: 0,
                    orderable: !1,
                    searchable: !0
                },  {"className": "dt-center", "targets": "_all"}],
                lengthMenu: [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"]
                ],
                pagingType: "bootstrap_full_number",
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
            var usr_role = $("#usr_role").val();
            var formData = $('#update_user_info').serialize();
            $.post(strURL, {
                usr_update_id: id,
                usr_id: usr_id,
                usr_passwd: usr_passwd,
                usr_gender: usr_gender,
                usr_name: usr_name,
                usr_age: usr_age,
                usr_role: usr_role,
                usr_department: usr_department,
                usr_hospital: usr_hospital,
                usr_phone_num: usr_phone_num
            }).done(function (data) {
                if (data) {
                    $.alert({
                        title: '报告!',
                        content: '编辑成功了！',
                        columnClass: 'small',
                        icon: 'fa fa-warning',
                        theme: 'material',
                        buttons: {
                            ok: {
                                text: '确定',
                                btnClass: 'btn-info',
                                action: function () {
                                    table.ajax.reload();
                                    $('#edit_user_data').modal('toggle');
                                }
                            }
                        }
                    });
                } else {}
            });

        };

        function add_user() {
            var base_url = '<?=base_url()?>';
            var strURL = base_url + "usermg/add_user/";
            var formData = $('#form_new_user').serialize();
            $.post(strURL, formData).done(function (data) {
                if (data) {
                    $('#submit_button').attr("disabled", "true");
                    $('#form_new_user')[0].reset();
                    $.alert({
                        title: '报告!',
                        content: data.message,
                        columnClass: 'small',
                        theme: 'material',
                        buttons: {
                            ok: {
                                text: '确定',
                                btnClass: 'btn-yellow',
                                action: function () {
                                    table.ajax.reload();
                                    $('#add_user').modal('toggle');
                                }
                            }
                        }
                    });
                }
            });
        }

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
            var base_url = '<?=base_url()?>';
            var strURL = base_url + "usermg/update_passwd";
            var usr_id = $('#usr_id').val();
            $.post(strURL, {
                    new_passwd: val,
                    usr_id: usr_id
                })
                .done(function (data) {
                    if (data) {
                        $.alert({
                            title: '报告!',
                            content: '重置成功了！',
                            columnClass: 'small',
                            theme: 'material',
                            buttons: {
                                ok: function () {
                                    table.ajax.reload();
                                    $('#set_passwd_model').modal('toggle');
                                },
                            }
                        });
                        $('#change_passwd_form')[0].reset();
                    } else {
                        $("#queren_mima").css("display", "none");
                        $('#update_result_no').removeClass('display-hide');
                    }
                });

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
            var usr_role = val.usr_role;
            $('#user_data_id').val(id);
            $('#usr_role').val(usr_role).change();
            $('#usr_update_id').val(id);
            $('#usr_id').val(usr_id);
            $('#usr_name').val(usr_name);
            $('#usr_age').val(usr_age);
            $('#usr_gender').val(usr_gender);
            $('#usr_department').val(usr_department);
            $('#usr_hospital').val(usr_hospital);
            $('#usr_phone_num').val(usr_phone_num);
            $('#permission_tree').jstree(true).settings.core.data.url = '<?=base_url()?>usermg/get_permission_tree/' + id;
            $("#permission_tree").jstree(true).load_node('#');
            if (usr_status == '1') {
                $("#set_access_allow").attr("disabled", "true");
                $("#set_access_denite").removeAttr("disabled");
                $("#set_user_access").removeAttr("disabled");
                $("#set_passwd").removeAttr("disabled");
                $("#deleteUser").removeAttr("disabled");
                $("#edit_user_data_btn").removeAttr("disabled");
            } else if (usr_status == '2') {
                $("#set_access_denite").attr("disabled", "true");
                $("#set_passwd").attr("disabled", "true");
                $("#set_access_allow").removeAttr("disabled");
                $("#edit_user_data_btn").attr("disabled", "true");
                $("#set_user_access").attr("disabled", "true");
                $("#deleteUser").removeAttr("disabled");
            } else {
                $("#set_access_allow").removeAttr("disabled");
                $("#set_access_denite").attr("disabled", "true");
                $("#set_user_access").removeAttr("disabled");
                $("#set_passwd").removeAttr("disabled");
                $("#deleteUser").removeAttr("disabled");
                $("#edit_user_data_btn").removeAttr("disabled");

            }
            if (usr_role == 100 || usr_role == 1) {
                $("#set_user_access").attr("disabled", "true");
            } else if (usr_role == 1) {
                $("#edit_user_data_btn").attr("disabled", "true");
            }
        }

        function set_access_allow() {
            var base_url = '<?=base_url()?>';
            var val = $('#user_data_id').val();
            var strURL = base_url + "usermg/update_activity";
            $.post(strURL, {
                    user_data_id: val
                })
                .done(function (data) {
                    if (data) {
                        $.alert({
                            title: '报告!',
                            content: '该用户已激活!',
                            columnClass: 'small',
                            icon: 'fa fa-warning',
                            theme: 'material',
                            buttons: {
                                ok: {
                                    text: '确定',
                                    btnClass: 'btn-info',
                                    action: function () {
                                        table.ajax.reload();
                                    }
                                }
                            }
                        });
                    } else {

                    }
                });
        }

        function set_access_user() {
            var base_url = '<?=base_url()?>';
            var val = $('#user_data_id').val();
            var strURL = base_url + "usermg/set_access_denite";
            $.post(strURL, {
                    user_data_id: val
                })
                .done(function (data) {
                    if (data) {
                        $.alert({
                            title: '报告!',
                            content: '该用户已注销!',
                            columnClass: 'small',
                            theme: 'material',
                            icon: 'fa fa-warning',
                            buttons: {
                                ok: {
                                    text: '确定',
                                    btnClass: 'btn-info',
                                    action: function () {
                                        table.ajax.reload();
                                    }
                                }
                            }
                        });
                    } else {


                    }
                });
        }

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
                        $.alert({
                            title: '报告!',
                            content: '该用户已注销!',
                            theme: 'material',
                            columnClass: 'small',
                            buttons: {
                                ok: {
                                    text: '确定',
                                    btnClass: 'btn-info',
                                    action: function () {
                                        table.ajax.reload();
                                    }
                                }
                            }
                        });
                    } else {
                        message += "激活失败了！</div>";
                        $('#result_notification').html(message);
                    }
                });
        }

        function set_access() {
            var formData = $('#premissionForm').serialize();
            var base_url = '<?=base_url()?>';
            var strURL = base_url + "usermg/set_access";
            console.log(formData);
            $.post(strURL, formData).done(function (data) {
                if (data.response_code) {
                    console.log('that is response data',data.data);
                    $.alert({
                        title: '报告!',
                        content: data.message,
                        columnClass: 'small',
                        theme: 'material',
                        buttons: {
                            ok: {
                                text: '确定',
                                btnClass: 'btn-info',
                                action: function () {
                                    table.ajax.reload();
                                    $('#accession').modal('toggle');
                                }
                            }
                        }
                    });

                } else {
                    $.alert({
                        title: '警告!',
                        content: data.message,
                        columnClass: 'small',
                        theme: 'material',
                        buttons: {
                            ok: {
                                text: '确定',
                                btnClass: 'btn-info',
                                action: function () {
                                    table.ajax.reload();
                                    $('#accession').modal('toggle');
                                }
                            }
                        }
                    });
                }
            });
        }
        function search_clear() {
            $('#search_user_info_form')[0].reset();
            table.ajax.reload();
        }
    </script>
