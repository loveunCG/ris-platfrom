<div class="page-content-wrapper">
	<div class="page-content">
		<h3 class="page-title">
			学习交流
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="icon-home"></i> 学习管理
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<span>学习交流</span>
				</li>
			</ul>

		</div>
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN VALIDATION STATES-->
				<div class="portlet portlet-sortable box blue-madison ">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-magnifier"></i>
							<span class="caption-subject font-light sbold uppercase">查询条件</span>
						</div>
					</div>
					<div class="portlet-body">
						<!-- BEGIN FORM-->
						<form action="#" method="post" class="form-horizontal" id="search_school_form" novalidate>
							<div class="form-body">
								<div class="row">
									<div class="col-md-3 col-lg-3 form-group form-md-line-input">
										<label class="col-md-5 col-lg-3 control-label" for="form_control_1">
											标题
										</label>
										<div class="col-md-7 col-lg-9">
											<input type="text" class="form-control" name="lession_title">
											<div class="form-control-focus"> </div>
<!--											<span class="help-block">请输入标题</span>-->
										</div>
									</div>
									<div class="col-md-3 col-lg-3 form-group form-md-line-input">
										<label class="col-md-5 col-lg-5 control-label" for="form_control_1">
											医生姓名
										</label>
										<div class="col-md-7 col-lg-7">
											<input type="text" class="form-control" name="lession_doctor">
											<div class="form-control-focus"> </div>
<!--											<span class="help-block">请输入医生姓名</span>-->
										</div>
									</div>
									<div class="col-md-3 col-lg-3 form-group form-md-line-input">
										<label class="col-md-5 col-lg-5 control-label" for="form_control_1">
											科室
										</label>
										<div class="col-md-7 col-lg-7">
											<select class="form-control" name="lession_class">
												<option value="">请选择</option>
												<?php
                                                foreach ($device_class as $values) {
                                                    echo '<option value = "'.$values->equipment_type.'">'.$values->equipment_type.'</option>';
                                                }
                                                ?>

											</select>
											<div class="form-control-focus"> </div>
										</div>
									</div>
									<div class="col-md-3 col-lg-3 form-group form-md-line-input">
										<label class="col-md-5 col-lg-5 control-label" for="form_control_1">
											部位
										</label>
										<div class="col-md-7 col-lg-7">
											<select class="form-control" name="lession_type">
												<option value="">请选择</option>
												<?php
                                                foreach ($module_class as $values) {
                                                    echo '<option value = "'.$values->class_id.'">'.$values->class_name.'</option>';
                                                }
                                                ?>
											</select>
											<div class="form-control-focus"> </div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-9 "></div>
									<div class="col-md-3 form-group form-md-input">
										<button type="button" class="pull-left btn col-md-4 blue  yellow" onclick="loadSchoolView()">
											<span class="glyphicon glyphicon-search"> </span>查询</button>
										<button type="button" class="btn pull-right col-md-4 blue " onclick="$('#search_school_form')[0].reset()">
											<span class="glyphicon glyphicon-refresh"> </span>重置</button>
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
        <input type="hidden" id="lession_id">
		<div class="row" id="sortable_portlets">
			<div class="col-md-12">
				<!-- BEGIN VALIDATION STATES-->
				<div class="portlet portlet-sortable box blue-madison">
					<div class="portlet-title">
						<div class="caption">
							<span class="glyphicon glyphicon-th-large"> </span>
							<span class="caption-subject font-white sbold uppercase">在线视频教学</span>
						</div>
					</div>
					<div class="portlet-body">
						<div class="row">
							<div class="clearfix" style="margin-left: 10%;">
								<div class="col-md-12">

                                    <?php $usrRole = $this->session->userdata('usr_role')?>
                                    <?php if ($usrRole == 1||$usrRole == 1024||$usrRole == 2||$usrRole == 100||$usrRole == 10||$this->session->userdata('NewOnlineVideoTeaching')):?>
                                        <button type="button" class="btn green-haze" id="add_lesssion"><span class="glyphicon glyphicon-plus"> </span>新增课程</button>

                                    <?php endif;?>
                                    <?php $usrRole = $this->session->userdata('usr_role')?>
                                    <?php if ($usrRole == 1||$usrRole == 1024||$usrRole == 2||$usrRole == 100||$usrRole == 10||$this->session->userdata('EditOnlineVideoTeaching')):?>
                                        <button type="button" class="btn blue" disabled id="edit_lesssion_btn"><span class="glyphicon glyphicon-edit"> </span>编辑</button>
                                    <?php endif;?>
                                    <?php if ($usrRole == 1||$usrRole == 1024||$usrRole == 2||$usrRole == 100||$usrRole == 10||$this->session->userdata('DeleteOnlineVideoTeaching')):?>
                                        <button type="button" class="btn red-haze" disabled id="delete_lession_btn"><span class="glyphicon glyphicon-trash"> </span>删除</button>
                                    <?php endif;?>
                                    <button type="button" class="btn purple" disabled id="enter_lession_btn"><span class="glyphicon glyphicon-play"> </span>进入</button>

								</div>
							</div>
						</div>
						<div class="row" id="school_selectField" style="margin-top: 2%">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var dis_equipment_type = '';
	<?php foreach ($device_class as $values):?>
	dis_equipment_type += '<option value = "<?=$values->equipment_type?>"><?=$values->equipment_type?></option>';
	<?php endforeach; ?>
	var dis_checkup_type = '';
	<?php foreach ($module_class as $values):?>
	dis_checkup_type += '<option value = "<?=$values->class_id?>"><?=$values->class_name?></option>';
	<?php endforeach; ?>

    function editLession(data) {
        $.confirm({
            title: '编辑视频课程',
            draggable: true,
            content: '<form id="form_add_lession">' +
            '<div class="col-md-12">' +
            '<div class="form-group col-md-12 form-md-line-input ">' +
            '<input type="text" name="lession_title" id = "lession_title" class="form-control" value="'+data.lession_title+'">' +
            '<label for="form_control_1">课程名称</label>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-12">' +
            '<div class="form-group col-md-12 form-md-line-input ">' +
            '<select class="form-control" name="lession_class" value="'+data.lession_class+'" id = "lession_class">' +
            '<option value="">请选择</option>' +dis_equipment_type+
            '</select>' +
            '<label for="form_control_1">科室</label>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-12">' +
            '<div class="form-group col-md-12 form-md-line-input ">' +
            '<select class="form-control" value="'+data.lession_type+'" name="lession_type" id = "lession_type">' +
            '<option value="">请选择</option>' +dis_checkup_type+
            '</select>' +
            '<label for="form_control_1">部位</label>' +
            '</div>' +
            '</div>'+
            '<div class="col-md-12">' +
            '<div class="form-group col-md-12 form-md-line-input ">' +
            '<input type="time" name="start_time" value="'+data.start_time+'" id="start_time" class="form-control">' +
            '<label for="form_control_1">开始时间</label>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-12">' +
            '<div class="form-group col-md-12 form-md-line-input ">' +
            '<select class="form-control"  name="lession_during" id="lession_during" >' +
            '<option value="">请选择</option><option value="45">45分钟</option><option value="60">60分钟</option><option value="90">90分钟</option>' +
            '</select>' +
            '<label for="form_control_1">讲课时间</label>' +
            '</div>' +
            '</div>'+
            '<input type="hidden" name="lession_doctor" value="<?=$this->session->userdata('id')?>">' +
            '<input type="hidden" name="lession_id" value="'+data.lession_id+'">' +
            '</form>',
            theme: 'material',
            columnClass: 'small',
            closeIcon: true,
            typeAnimated: true,
            icon: 'glyphicon glyphicon-edit',
            onContentReady:function(){
                $('#lession_type').val(data.lession_type).change();
                $('#lession_class').val(data.lession_class).change();
                $('#lession_during').val(data.lession_during).change();
            },
            buttons: {
                ok: {
                    text: '修改',
                    btnClass: 'btn blue',
                    action: function () {
                        if($('#lession_type').val()==''||$('#lession_title').val()==''||$('#lession_class').val()==''){
                            $.alert({
                                icon: 'fa fa-warning',
                                title: '警告!',
                                closeIcon: true,
                                theme: 'material',
                                columnClass: 'small',
                                content: '请输入正确的信息',
                                draggable: true,
                                animation: 'zoom',
                                closeAnimation: 'scale'
                            });
                            return true;
                        }
                        var ajax_form = $('#form_add_lession').serialize();
                        var ajaxsetting = {
                            "url": '<?=base_url()?>' + "school/update_lession",
                            "method": "POST",
                            "dataType": 'json',
                            "data": ajax_form
                        }
                        jQuery.ajax(ajaxsetting).success(function(response) {
                            $.alert({
                                title: '报告!',
                                content: '添加成功了！',
                                columnClass: 'small',
                                icon: 'fa fa-warning',
                                theme: 'material',
                                buttons: {
                                    ok: {
                                        text: '确定',
                                        btnClass: 'btn-info',
                                        action:function () {
                                            loadSchoolView();
                                            $(this).remove();
                                        }
                                    }
                                }
                            });
                        });
                    }
                },
                cancel: {
                    text: '返回',
                    btnClass: 'btn yellow',
                    action: function () {
                        //close
                    }
                }

            }
        });

    }

	$(function () {
		$('#add_lesssion').click(function () {
			$.confirm({
				title: '新添加视频课程',
                draggable: true,
                content: '<form id="form_add_lession">' +
					'<div class="col-md-12">' +
					'<div class="form-group col-md-12 form-md-line-input ">' +
					'<input type="text" name="lession_title"  id="lession_title" class="form-control">' +
					'<label for="form_control_1">课程名称</label>' +
					'</div>' +
					'</div>' +
					'<div class="col-md-12">' +
					'<div class="form-group col-md-12 form-md-line-input ">' +
					'<select class="form-control" name="lession_class" id="lession_class" >' +
					'<option value="">请选择</option>' +dis_equipment_type+
					'</select>' +
					'<label for="form_control_1">科室</label>' +
					'</div>' +
					'</div>' +
					'<div class="col-md-12">' +
					'<div class="form-group col-md-12 form-md-line-input ">' +
					'<select class="form-control" name="lession_type" id="lession_type" >' +
					'<option value="">请选择</option>' +dis_checkup_type+
					'</select>' +
					'<label for="form_control_1">部位</label>' +
					'</div>' +
					'</div>'+
                    '<div class="col-md-12">' +
                    '<div class="form-group col-md-12 form-md-line-input ">' +
                    '<input type="time" name="start_time"  id="start_time" class="form-control form-control-inline">' +
                    '<label for="form_control_1">开始时间</label>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-12">' +
                    '<div class="form-group col-md-12 form-md-line-input ">' +
                    '<select class="form-control" name="lession_during" id="lession_during" >' +
                    '<option value="">请选择</option>' +
                    '<option value="45">45分钟</option>' +
                    '<option value="60">60分钟</option>' +
                    '<option value="90">90分钟</option>' +
                    '</select>' +
                    '<label for="form_control_1">讲课时间</label>' +
                    '</div>' +
                    '</div>'+
                    '<input type="hidden" name="lession_doctor" value="<?=$this->session->userdata('id')?>">' +
					'</form>',
				theme: 'material',
				columnClass: 'small',
				closeIcon: true,
				typeAnimated: true,
				icon: 'glyphicon glyphicon-edit',
				buttons: {
					ok: {
						text: '发起',
						btnClass: 'btn blue',
						action: function () {
						    if($('#lession_type').val()==''||$('#lession_title').val()==''||$('#lession_class').val()==''){
                                $.alert({
                                    title: '报告!',
                                    draggable: true,
                                    content: '请输入正确的信息！',
                                    columnClass: 'small',
                                    icon: 'fa fa-warning',
                                    theme: 'material',
                                    buttons: {
                                        ok: {
                                            text: '确定',
                                            btnClass: 'btn-info',
                                            action:function () {
                                                $(this).remove();

                                            }
                                        }
                                    }
                                });
                                return false;
                            }else{
                                var ajax_form = $('#form_add_lession').serialize();
                                var ajaxsetting = {
                                    "url": '<?=base_url()?>' + "school/save_lession",
                                    "method": "POST",
                                    "dataType": 'json',
                                    "data": ajax_form
                                }
                                jQuery.ajax(ajaxsetting).success(function(response) {
                                    $.alert({
                                        title: '报告!',
                                        content: '添加成功了！',
                                        columnClass: 'small',
                                        icon: 'fa fa-warning',
                                        theme: 'material',
                                        buttons: {
                                            ok: {
                                                text: '确定',
                                                btnClass: 'btn-info',
                                                action:function () {
                                                    loadSchoolView();
                                                    $(this).remove();
                                                }
                                            }
                                        }
                                    });
                                });
                            }
						}
					},
					cancel: {
						text: '返回',
						btnClass: 'btn yellow',
						action: function () {
							//close
						}
					}

				}
			});

		});

        $('#edit_lesssion_btn').click(function () {
            var lession_id = $('#lession_id').val();
            var ajaxsetting = {
                "url": '<?=base_url()?>' + "school/getSchoolInfo/"+lession_id,
                "method": "POST",
                "dataType": 'json'
            }
            jQuery.ajax(ajaxsetting).success(function(response) {
                editLession(response);
            });
        });

        $('#enter_lession_btn').click(function () {
                var lession_id = $('#lession_id').val();
                goto_movie(lession_id);
        });
        loadSchoolView();

        $('#delete_lession_btn').confirm({
            title: '提示',
            content: '你真删除该课程？',
            closeIcon: true,
            animationBounce: 1.5,
            theme: 'material',
            buttons: {
                confirm: {
                    text: '是',
                    keys: ['shift', 'alt'],
                    btnClass: 'btn-success',
                    action: function () {
                        var lession_id = $('#lession_id').val();
                        var base_url = '<?=base_url()?>';
                        var strURL = base_url + "school/delete_lession/" + lession_id;
                        $.ajax({
                            dataType: "json",
                            url: strURL,
                            success: function (response) {
                                $.alert("已删除！");
                                loadSchoolView();
                            }
                        });
                    }
                },
                chancel: {
                    text: '否',
                    btnClass: 'btn-warning',
                    keys: ['enter', 'shift'],
                    action: function () {}
                }
            }
        });
	});

	function loadSchoolView() {
	    var formData = $('#search_school_form').serialize();
        $('#school_selectField').load('<?=base_url()?>school/selectView/?'+ formData);

    }

    function selectschool(val){

        var formData = $('#search_school_form').serialize();
        $('#school_selectField').load('<?=base_url()?>school/selectView/?'+ formData, function () {
            if ($('#'+val).hasClass('selected')) {
                $('#'+val).removeClass('selected');
                $('#'+val).css("background-color", "#32c5d2");

            } else {
                $('#'+val).removeClass('selected');
                $('#'+val).addClass('selected');
                $('#'+val).css("background-color", "#E08283");

            }
            $('#lession_id').val(val);

            var flag = 0;
            var enter_flag = 0;
            <?php foreach ($study_info as $value) {
                                                    ?>
                //alert('<?=$value->usr_hospital?>');
                    if(<?=$this->session->userdata('id')?> == <?=$value->lession_doctor?> && val == <?=$value->lession_id?>) {
                        flag = 1;
                    }
                    if(<?=$value->lession_status?> == 1 && val == <?=$value->lession_id?>){
                        enter_flag = 1;
                    }
            <?php
                                                }
            ?>
            if(flag){
                $('#delete_lession_btn').removeAttr('disabled');
                $('#edit_lesssion_btn').removeAttr('disabled');
                $('#enter_lession_btn').removeAttr('disabled');
            }
            else{
                $('#delete_lession_btn').attr('disabled','true');
                $('#edit_lesssion_btn').attr('disabled','true');
                $('#enter_lession_btn').attr('disabled','true');
            }
            if(enter_flag){
                $('#enter_lession_btn').removeAttr('disabled');
            }
        });

    }

	function goto_movie(id) {
		window.location = "<?=base_url()?>school/movie/" + id;
	}

</script>
