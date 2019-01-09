<link href="<?=base_url()?>assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">

		<h3 class="page-title">
			<?=$menutitle?>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="#">
						<?=$menutitle?>
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<span>讨论郊区</span>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">

				<div class="profile-content">
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN PORTLET -->
							<div class="portlet light ">
								<div class="portlet-title">
									<div class="caption caption-md">
										<i class="icon-bar-chart theme-font hide"></i>
										<span class="caption-subject font-blue-madison bold uppercase">热门论点</span>
									</div>
									<div class="actions">
										<div class="btn-group btn-group-devided" data-toggle="buttons">
											<label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
												<input type="radio" name="options" class="toggle" id="option1">最近访问： CT MR RF
											</label>
										</div>
									</div>
								</div>
								<div class="portlet-body">
									<table class="table table-striped table-hover" id="lesson_table_view">
										<thead>
											<tr>
												<th>留言数</th>
												<th>发布人</th>
												<th>标题</th>
												<th>时间</th>
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
								<div class="profile-sidebar">
					<!-- PORTLET MAIN -->
					<div class="portlet light profile-sidebar-portlet ">
						<!-- SIDEBAR USERPIC -->
						<div class="profile-userpic">
							<img src="../assets/pages/media/profile/profile_user.jpg" class="img-responsive" alt=""> </div>
						<!-- END SIDEBAR USERPIC -->
						<!-- SIDEBAR USER TITLE -->
						<div class="profile-usertitle">
							<div class="profile-usertitle-name">
								医生名称：
								<?php echo $this->session->userdata('usr_name'); ?>
							</div>
							<div class="profile-usertitle-job"> 医院名称：
								<?php echo $this->session->userdata('hospital_name'); ?> </div>
						</div>
						<!-- END SIDEBAR USER TITLE -->
						<!-- SIDEBAR BUTTONS -->
						<div class="profile-userbuttons">
							<button type="button" onclick="my_post_view()" class="btn btn-circle green btn">
								<span class="glyphicon glyphicon-eye-open"> </span>我发起的论点</button>
							<button type="button" onclick="lesson_post_view()" class="btn btn-circle blue btn">
								<span class="glyphicon glyphicon-edit"> </span>我发表的评论</button>

						</div>
						<!-- END SIDEBAR BUTTONS -->
						<!-- SIDEBAR MENU -->
						<div class="profile-usermenu">
							<center>
								<button type="button" onclick="add_post()" class="btn btn-circle blue btn">
									<span class="glyphicon glyphicon-send"> </span>发布</button>
							</center>


						</div>
						<!-- END MENU -->
					</div>
					<!-- END PORTLET MAIN -->
					<!-- PORTLET MAIN -->

					<!-- END PORTLET MAIN -->
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" id="lesson_id" value="">
	<script type="text/javascript">
		var table = [];
		$(document).ready(function () {
			var tbl_usr_info = '<?=base_url()?>' + 'school/get_PostList';
			table = $('#lesson_table_view').DataTable({
				"ajax": tbl_usr_info,

				dom: 'Bfrtip',
				language: {
					aria: {
						sortAscending: ": activate to sort column ascending",
						sortDescending: ": activate to sort column descending"
					},
					emptyTable: "没有数据",
					info: "显示 _START_ 到 _END_ 的 _TOTAL_ 条记录",
					infoEmpty: "找不到",
					search: "查询：",
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
				lengthMenu: [
					[5, 15, 20, -1],
					[5, 15, 20, "All"]
				],
				pageLength: 10,
				pagingType: "bootstrap_full_number",
                "aaSorting": [[0,'desc']]

			});
			table.buttons().remove();
			$('#lesson_table_view tbody').on('click', 'tr', function () {
				if ($(this).hasClass('selected')) {
					$(this).removeClass('selected');
				} else {
					table.$('tr.selected').removeClass('selected');
					$(this).addClass('selected');
				}
			});
		});

		function my_post_view() {
			location.href = '<?=base_url()?>school/my_post_view'
		}

		function add_post() {
			$.confirm({
				title: '发布论点',
				content: '<form action="#" id = "add_postform">\n' +
					'<div class="form-body">\n' +
					'<div class="form-group form-md-line-input">' +
					'<input type="text" class="form-control" name="pst_title" id="pst_title" value = "">' +
					'<label for="pst_title">论点标题*</label>' +
					'</div>' + '<div class="form-group form-md-line-input ">' +
					'<input type="text" class="form-control" name="pst_name" id="pst_name" value = "">' +
					'<label for="pst_name">您的姓名\t</label>' +
					'</div>' + '<div class="form-group form-md-line-input ">' +
					'<textarea class="form-control" name="pst_content" rows="10"></textarea><input type="hidden" name = "pst_doctor" value="<?=$this->session->userdata('
				id ')?>">' +
				'<label for="pst_content">论点内容*</label>' +
				'</div>' +
				'</div>' +
				'</form>',
				theme: 'material',
				columnClass: 'small',
				closeIcon: true,
				type: 'red',
				typeAnimated: true,
				draggable: true,
				icon: 'glyphicon glyphicon-edit',
				onContentReady: function () {
					$("#add_postform").validate({
						errorElement: "span",
						errorClass: "help-block help-block-error",
						focusInvalid: !1,
						messages: {
							pst_title: {
								required: "这是必填字段",
								maxlength: $.validator.format("最多可以输入 {0} 个字符"),
								minlength: $.validator.format("最少要输入 {0} 个字符"),

							},
							pst_content: {
								required: "这是必填字段.",
								maxlength: $.validator.format("最多可以输入 {0} 个字符"),
								minlength: $.validator.format("最少要输入 {0} 个字符")
							}
						},
						rules: {
							pst_title: {
								minlength: 4,
								maxlength: 64,
								required: !0,
							},
							pst_content: {
								required: !0,
								minlength: 6,
								maxlength: 1024
							}
						},
						invalidHandler: function (e, t) {
							App.scrollTo(r, -200)
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
							Add_PostAjax();
						}
					});
				},
				buttons: {
					formSubmit: {
						text: '提交',
						btnClass: 'btn blue',
						action: function () {
							var res = $('#add_postform').submit();
							if (res) {
								$(this).remove();
								table.ajax.reload();
							}
						}
					},
					cancel: {
						text: '返回',
						btnClass: 'btn green',
						action: function () {
						}
					}

				}
			});
		}

		function Add_PostAjax() {
			var formData = $('#add_postform').serialize();
			var base_url = '<?=base_url()?>';
			var strURL = base_url + "school/addPost/";
			$.ajax({
				dataType: "json",
				url: strURL,
				data: formData,
				type: 'post',
				success: function (response) {
					if (response.status == 'success') {
						$.alert({
							icon: 'fa fa-warning',
							title: '提示!',
							closeIcon: true,
							theme: 'bootstrap',
							columnClass: 'small',
							content: '已成功发布了！',
							draggable: true,
							animation: 'zoom',
							closeAnimation: 'scale'
						});
					} else {
						$.alert({
							icon: 'fa fa-warning',
							title: '提示!',
							closeIcon: true,
							theme: 'bootstrap',
							columnClass: 'small',
							content: '失败发布了！',
							draggable: true,
							animation: 'zoom',
							closeAnimation: 'scale'
						});
					}

					return true;
				}
			});

		}

		function lesson_post_view() {

			location.href = '<?=base_url()?>school/lesson_post_view/';
		}

		function  commentProc(val) {
            $.confirm({
                title: '添加评论',
                content: '<form action="#" id = "add_commentForm">\n' +
                '<div class="form-body"><input type="hidden" name = "cmt_pst_id" value="'+val+'">' +
                '<div class="form-group form-md-line-input">' +
                '<textarea class="form-control" name="cmt_content" rows="10"></textarea>'+
                '<input type="hidden" name = "cmt_doctor" value="<?=$this->session->userdata('id')?>">' +
                '<label for="pst_content">评论内容*</label>' +
                '</div>' +
                '</div>' +
                '</form>',
                theme: 'material',
                columnClass: 'small',
                closeIcon: true,
                type: 'blue',
                typeAnimated: true,
                draggable: true,
                icon: 'glyphicon glyphicon-edit',
                onContentReady: function () {
                    $("#add_commentForm").validate({
                        errorElement: "span",
                        errorClass: "help-block help-block-error",
                        focusInvalid: !1,
                        messages: {
                            cmt_content: {
                                required: "这是必填字段",
                                maxlength: $.validator.format("最多可以输入 {0} 个字符"),
                                minlength: $.validator.format("最少要输入 {0} 个字符"),

                            }
                        },
                        rules: {
                            cmt_content: {
                                minlength: 4,
                                maxlength: 512,
                                required: !0,
                            }
                        },
                        invalidHandler: function (e, t) {
                            App.scrollTo(r, -200)
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
                            submitComment();
                        }
                    });
                },
                buttons: {
                    formSubmit: {
                        text: '提交',
                        btnClass: 'btn blue',
                        action: function () {
                            var res = $('#add_commentForm').submit();
                        }
                    },
                    cancel: {
                        text: '返回',
                        btnClass: 'btn green',
                        action: function () {
                        }
                    }

                }
            });


        }

        function submitComment() {
            var strURL = '<?=base_url()?>' + 'school/submitComment/';
            var subData = $('#add_commentForm').serialize();
            $.ajax({
                dataType: "json",
                url: strURL,
                data: subData,
                type: 'post',
                success: function (response) {
                    if (response.status == 'success') {
                        $.alert({
                            icon: 'fa fa-warning',
                            title: '提示!',
                            closeIcon: true,
                            theme: 'bootstrap',
                            columnClass: 'small',
                            content: '已成功留言了！',
                            draggable: true,
                            animation: 'zoom',
                            closeAnimation: 'scale',
                            buttons:{
                                ok:function () {
                                    table.ajax.reload();

                                }
                            }
                        });
                    } else {
                        $.alert({
                            icon: 'fa fa-warning',
                            title: '提示!',
                            closeIcon: true,
                            theme: 'bootstrap',
                            columnClass: 'small',
                            content: '失败留言了！',
                            draggable: true,
                            animation: 'zoom',
                            closeAnimation: 'scale'
                        });
                    }
                }
            });
        }

	</script>
