<link href="<?=base_url()?>assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/css/todo-2.min.css" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
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
			<div class="col-md-12" > 
				<div class="profile-sidebar" style="float:right; margin-left:1em; margin-right:0;">
					<div class="portlet light profile-sidebar-portlet " style=" height: 24em;">
						<div class="col-md-7" >
							<?php if($this->session->userdata('usr_gender') == '1') :?>
							<img src="../assets/images/faces/face1.jpg" class="img-responsive" alt="" style="border-radius:50%"> </div>
							<?php endif?>
							<?php if($this->session->userdata('usr_gender') != '1') :?>
							<img src="../assets/images/faces/face0.jpg" class="img-responsive" alt="" style="border-radius:50%"> </div>
							<?php endif?>
						<div class="col-md-5">
							<div class="profile-usertitle-name" style="margin-top: 2em;margin-left: -2em;">
								<?=$this->session->userdata('usr_name')?>
							</div>
						</div>
						<div  onclick="my_comment()" class="col-md-12" style="text-align:center; margin-top:1em; font-size:18px; font-weight:bold; color:#5a7391;   
							border-bottom: 2px solid #36c6d3;background-color: #ffffff;    width: 10em;  margin-left: 3em;    margin-top: 2em;">
							<i class="fa fa-file-text-o" ></i>&nbsp;&nbsp;&nbsp;我的评论
						</div>
						<div onclick="my_post()" class="col-md-12" style="text-align:center; margin-top:1.2em; font-size:18px; font-weight:bold; color:#5a7391;   
							border-bottom: 2px solid #36c6d3;background-color: #ffffff;    width: 10em;  margin-left: 3em;">
							<i class="fa fa-pencil-square-o" ></i>&nbsp;&nbsp;&nbsp;我的提问
						</div>
						<div  class="col-md-12" style="    font-size: 17px; border-radius: 3px;     margin-top: 2em;   margin-left: 4em;">
							<button type="button" style="margin-left: 3em;" onclick="add_post()" class="btn btn-success">提&nbsp;&nbsp;问</button>
						</div>
						<!-- <div  class="col-md-6" style="    font-size: 17px; border-radius: 3px; margin-top: 1em; ">
							<button type="button" style="margin-left: 1em;" onclick="refresh_page()" class="btn btn-success">回&nbsp;&nbsp;报</button>
						</div> -->
					</div>
				</div>
				<!-- <div class="profile-content" style=" border: 3px solid;border-radius:3px; border-color: #36c6d3;"> -->
				<div class="profile-content" >
					<div class="row">
						<div class="col-md-12">
							<div class="portlet light " style="margin-bottom: 0">
								<div class="portlet-title">
									<div class="col-md-8" style="margin-top: 0.5em;font-size: 20px;font-weight: bold;color: #26344b;" onclick="refresh_page()">
										热门论点
										<span id="search_keyword" style="font-size: 16px; margin-left: 1em; color: #2b4a5c;"></span></span>
									</div>
									<div class="col-md-4" style="margin-top: 1em;">
										<span id="search_icon" onclick="search_reset()" class="glyphicon glyphicon-search form-control-feedback" style="pointer-events: auto;margin-top: 0.3em;"></span>
                                        <input oninput="search(this.value)" style="border-radius: 4px;border: 0.1em solid;border-color: #19559e;width: 15em;float: right;" id="growl_text" type="text" class="col-md-12" placeholder="  你感兴趣的内容" > 
									</div>
								</div>
								<div class="portlet-body" >
									<div class="row" id="post_content_view">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	var base_url = '<?=base_url()?>';
	var startid = 0;
	var comment_startid = 0;
	var page_number = 1;	
	var comment_page_number = 1;
	var isDiscussion=true;
	var isView=true;
	var userid = '<?php  echo $this->session->userdata('id')?>';
	var isMine = true;
	var searchval = '';
	var post_cmt_id;
	var nopost = 99999999;
	$(function(){
		$('#post_content_view').load(base_url + 'post/post_list/' + startid);
	})

	function refresh_page(){
		isMine = true;
		$('#post_content_view').load(base_url + 'post/post_list/' + startid);


	}

	function back_Page(){
		if(page_number > 1){
			page_number = page_number - 1;
			startid = page_number * 5 - 5
			if(searchval !=''){
				$('#post_content_view').load(base_url + 'post/search_list/' + startid + '/?search_val=' + searchval);
			}
			else if(isMine){
				$('#post_content_view').load(base_url + 'post/post_list/' + startid);
			}else{
				$('#post_content_view').load(base_url + 'post/post_list/' + startid + '/'  + userid);
			}
		} else {
			return;
		}
	}
	function next_Page(){
		var pagevalue = document.querySelector('#pagevalue').textContent;
		var allPage = Math.ceil(pagevalue/5) ;
		if(allPage > page_number){
			page_number = page_number + 1;
			startid = page_number * 5 - 5
			if(searchval != ''){
				$('#post_content_view').load(base_url + 'post/search_list/' + startid + '/?search_val=' + searchval);
			}
			else if(isMine){
				$('#post_content_view').load(base_url + 'post/post_list/' + startid);
			}else{
				$('#post_content_view').load(base_url + 'post/post_list/' + startid + '/'  + userid);
			}
			
		} else {
			return;
		}
	}
	function go_Page(){
		var pagevalue = document.querySelector('#pagevalue').textContent;
		var allPage = Math.ceil(pagevalue/5) + 1 ;
		var pagecurrent =document.querySelectorAll('#pageinput')[0].value;
		if(allPage > pagecurrent && pagecurrent > 0){
			page_number = pagecurrent;
			startid = page_number * 5 - 5	
			if(searchval != ''){
				$('#post_content_view').load(base_url + 'post/search_list/' + startid + '/?search_val=' + searchval);
			}
			else if(isMine){
				$('#post_content_view').load(base_url + 'post/post_list/' + startid);
			}else{
				$('#post_content_view').load(base_url + 'post/post_list/' + startid + '/'  + userid);
			}
		} else{
			return;
		}
	}

	function comment_back_Page(){
		if(comment_page_number > 1){
			comment_page_number = comment_page_number - 1;
			comment_startid = comment_page_number * 5 - 5
			if(isMine){
				$('#post_content_view').load(base_url + 'post/post_comment_list/' + comment_startid + '/' + post_cmt_id);
			}else{
				$('#post_content_view').load(base_url + 'post/my_comment_list/' +comment_startid + '/' + userid);
			}
		} else {
			return;
		}
	}
						
	function comment_next_Page(){
		var pagevalue = document.querySelector('#comment_pagevalue').textContent;
		var allPage = Math.ceil(pagevalue/5) ;
		if(allPage > comment_page_number){
			comment_page_number = comment_page_number + 1;
			comment_startid = comment_page_number * 5 - 5
			if(isMine){
				$('#post_content_view').load(base_url + 'post/post_comment_list/' + comment_startid + '/' + post_cmt_id);
			}else{
				$('#post_content_view').load(base_url + 'post/my_comment_list/' +comment_startid + '/' + userid);
			}
			
		} else {
			return;
		}
	}	

	function comment_go_Page(){
		var pagevalue = document.querySelector('#comment_pagevalue').textContent;
		var allPage = Math.ceil(pagevalue/5) + 1 ;
		var pagecurrent =document.querySelectorAll('#comment_pageinput')[0].value;
		if(allPage > pagecurrent && pagecurrent > 0){
			comment_page_number = pagecurrent;
			comment_startid = comment_page_number * 5 - 5	
			if(isMine){
				$('#post_content_view').load(base_url + 'post/post_comment_list/' + comment_startid + '/' + post_cmt_id);
			}else{
				$('#post_content_view').load(base_url + 'post/my_comment_list/' +comment_startid + '/' + userid);
			}
		} else{
			return;
		}
	}
	
	function edit_input(index){
		console.log(index)
		var claanaem = '.comment_edit_' + index;
		if(isDiscussion){
			isDiscussion = false;
			$(claanaem).show();
		}else{
			isDiscussion = true;
			$(claanaem).hide(); 
		}
	}

	function eventonkeypress(index, post_id, doctor_name){
		var id =  '<?=$this->session->userdata('usr_name')?>'
		console.log(index)
		var claanaem = '.comment_edit_' + index;
		if(event.keyCode == 13){
			var pagecurrent =document.querySelectorAll('input[name="pname"]')[index].value;
			var formData = {cmt_pst_id : post_id, cmt_content : pagecurrent , cmt_doctor : doctor_name};
			var base_url = '<?=base_url()?>';
			var strURL = base_url + "Post/submitComment/";
			$.ajax({
				dataType: "json",
				url: strURL,
				data: formData,
				type: 'post',
				success: function (response) {
					if (response.status == 'success') {
						if(isMine){
							$('#post_content_view').load(base_url + 'post/post_list/' + startid);
						}else{
							$('#post_content_view').load(base_url + 'post/post_list/' + startid + '/'  + userid);
						}
					}
					else{
						return;
					}
				}
			});
			$('input[name="pname"]').val("");
			$(claanaem).hide(); 
			isDiscussion = true;
  		}
	}

	function add_right(post_id, val){
		
		if(nopost != post_id){
			var right_val = val + 1;
			var formData = {pst_right : right_val};
			var base_url = '<?=base_url()?>';
			var strURL = base_url + "Post/add_right/" + post_id;
			$.ajax({
				dataType: "json",
				url: strURL,
				data: formData,
				type: 'post',
				success: function (response) {
					if (response.status == 'success') {
						$('#post_content_view').load(base_url + 'post/post_list/' + startid);
					}
					else{
						return;
					}
				}
			});
		}
		nopost = post_id;
		
	}

	function comment_view(post_id){
		post_cmt_id = post_id;
		if(isView){
			isView=false;
			$('#post_content_view').load(base_url + 'post/post_comment_list/' + comment_startid + '/' + post_cmt_id);
		}else{
			isView=true;
			if(isMine){
				$('#post_content_view').load(base_url + 'post/post_list/' + startid);
			}else{
				$('#post_content_view').load(base_url + 'post/post_list/' + startid + '/'  + userid);
			}
		}
	}

	function my_comment(){
		isMine = false;
		startid = 0;
		page_number = 1;
		$('#post_content_view').load(base_url + 'post/my_comment_list/' +comment_startid + '/' + userid);
	}

	function my_post(){
		isMine = false;
		startid = 0;
		page_number = 1;
		$('#post_content_view').load(base_url + 'post/post_list/' + startid + '/'  + userid);
	}
	function add_post() {
		$.confirm({
			title: '发布论点',
			content: '<form action="#" id = "add_postform">\n' +
				'<div class="form-body">\n' +
				'<div class="form-group">' +
				'<label for="pst_title" style="font-size: 15px;">问题标题：</label><br>' +
				'<input type="text" placeholder="请输入..." class="form-control" name="pst_title"  value = "">' + 
				'<input type="hidden" name = "pst_doctor" value="<?=$this->session->userdata('id')?>">' +
				'<input type="hidden" name = "pst_name" value="<?=$this->session->userdata('usr_name')?>">' +
				'</div>' +
				'<div class="form-group">' +
				'<label for="pst_content" style="font-size: 15px;">问题描述：</label>' +
				'<textarea class="form-control" placeholder="描述精确的问题更易得到解答..." name="pst_content" rows="10"></textarea> '+
				'</div>' +
				'<div class="checkbox"><label style="margin-left: 1.5em;font-size: 15px;;font-size: 15px;">' +
				'<input type="checkbox" class="form-control" name="pst_name_check" style="margin-left:-8em;width: 14em; height: 1em;margin-top: 0.2em;" >匿名提问</label></div>'+
				'</div>' +
				'</form>',	
			closeIcon: true,
			type: 'blue',
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
						App.scrollTo(t, -200)
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
						}
					}
				}
			}
		});
	}
	function Add_PostAjax(){
		var formData = $('#add_postform').serialize();
		var base_url = '<?=base_url()?>';
		var strURL = base_url + "Post/add_post_content/";
		$.ajax({
			dataType: "json",
			url: strURL,
			data: formData,
			type: 'post',
			success: function (response) {
				if (response.status == 'success') {
					if(isMine){
						$('#post_content_view').load(base_url + 'post/post_list/' + startid);
					}else{
						$('#post_content_view').load(base_url + 'post/post_list/' + startid + '/'  + userid);
					}
					$.confirm({
						title: '提示',
						content: '数据保存成功',
						type: 'blue',
						typeAnimated: true,
						buttons: {
							tryAgain: {
								text: '确 认',
								btnClass: 'btn-green',
								action: function(){
								}
							},
						}
					});
				}
				else{
					$.confirm({
						title: '提示',
						content: '数据保存失败',
						type: 'blue',
						typeAnimated: true,
						buttons: {
							tryAgain: {
								text: '确 认',
								btnClass: 'btn-green',
								action: function(){
								}
							},
						}
					});
				}
			}
		});
	}
	
	function search(val){
		searchval = val;	
		startid = 0;	
		page_number = 1;
		var keyval;
		if(searchval != ''){
			$('#post_content_view').load(base_url + 'post/search_list/' + startid + '/?search_val=' + searchval);
			keyval = '最近访问 : ' + val;
			document.getElementById("search_keyword").textContent=keyval;
			document.getElementById("search_icon").className = "glyphicon glyphicon-remove form-control-feedback";						
		}else{
			$('#post_content_view').load(base_url + 'post/post_list/' + startid);
			document.getElementById("search_icon").className = "glyphicon glyphicon-search form-control-feedback";	
		}
	}

    function search_reset(){
		var value='';
		search(value);
		document.getElementById("search_icon").className = "glyphicon glyphicon-search form-control-feedback";	
		document.getElementById("growl_text").value = "";
	}

	function less_more(index){
		
		var aclassname = '.readmorebtn_' + index;
		if($(aclassname).html() == '阅读全文'){
			var classname = '.more_' + index;
			$(classname).css({
				'height': 'auto'
			})
			$(aclassname).html('阅读省略');
		}
		else{
			var classname = '.more_' + index;
			$(classname).css({
				'height': '1.5em'
			})
			$(aclassname).html('阅读全文');
		}

	}
</script>
