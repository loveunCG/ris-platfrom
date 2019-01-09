<link href="<?=base_url()?>assets/global/css/iziModal.min.css" rel="stylesheet" type="text/css" />

<div class="page-content-wrapper">
	<div class="page-content">
		<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
				<i class="fa fa-gift"></i>学习交流 </div>
				<div class="tools">
					<a href="javascript:;" class="collapse"> </a>
					<a href="#portlet-config" data-toggle="modal" class="config"> </a>
				</div>
			</div>
			<div class="portlet-body tabs-below">
				<ul class="nav nav-tabs">
				<?php if (isset($is_my_school)): ?>
					<li class="active"><a href="#manage_school_table" onclick="click_tab(true)" data-toggle="tab"> 视频教学 </a></li>
				<?php else:?>
					<li class="active"><a href="#manage_my_school_table" data-toggle="tab" onclick="click_tab(false)"> 个人教学 </a></li>
				<?php endif;?>
				</ul>
				<div class="tab-content">
					<?php if (isset($is_my_school)): ?>
					<div class="tab-pane active" id="manage_school_table"/>
					<?php else:?>
					<div class="tab-pane active" id="manage_my_school_table"/>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="check_password_school" data-iziModal-title="确定密码" data-iziModal-icon="fa fa-key" >
    <div class="panel panel-info">
        <div class="panel-body">
            <form id="check_password_form" class="form-horizontal row-border">
                <div class="form-group">
                    <label class="col-md-3 control-label" >密码</label>
                    <div class="col-md-9">
                        <input type="password" name="lession_password" class="form-control">
                    </div>
                    <input type="hidden" name = "lession_id" id="lession_id">
                </div>
            </form>
            <div class="row">
                <div class="col-md-4 col-md-offset-8">
                    <button class="btn-primary btn" type="button" onclick="goto_movie_check()">确定</button>
                    <button class="btn-default btn" data-izimodal-close="" data-izimodal-transitionin="fadeInDown">取消</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>assets/global/scripts/iziModal.min.js" type="text/javascript"></script>
<script>

	var base_url = '<?=base_url()?>';
	var school_manage_url = base_url + 'school/ajax_school_manage';
	var own_school_manage_url = base_url + 'school/ajax_own_school_manage';
	var fisrt_load_url;
	<?php if (isset($is_my_school)): ?>
	fisrt_load_url = school_manage_url;
	<?php else:?>
	fisrt_load_url = own_school_manage_url
	<?php endif;?>

	$(function(){
		<?php if (isset($is_my_school)): ?>
		$( "#manage_school_table" ).load( school_manage_url );
		<?php else:?>
		$( "#manage_my_school_table" ).load( own_school_manage_url );
		<?php endif;?>

	});

	function click_tab(istab){
		if(!istab){
			$( "#manage_school_table" ).html('');
			$( "#manage_my_school_table" ).html('');
			$( "#manage_my_school_table" ).load( own_school_manage_url );
			istab = false;

		}else{
			$( "#manage_my_school_table" ).html('');
			$( "#manage_school_table" ).html('');
			$( "#manage_school_table" ).load( school_manage_url );
			istab = true;
		}

	}

	$(function(){
		$('#check_password_school').iziModal({
			width: 450,
			timeoutProgressbar: false,
		    pauseOnHover: false,
		    timeoutProgressbarColor: 'rgba(255,255,255,0.5)',
		    transitionIn: 'comingIn',
		    transitionOut: 'comingOut'
		});
	})

	function goto_movie(id){
	 window.location = "<?=base_url()?>school/movie/" + id;
	}

	function goto_movie_check(){
		var subData = $('#check_password_form').serialize();
		var strURL = base_url + 'school/check_lession_passwd';
		$.ajax({
			dataType: "json",
			url: strURL,
			data: subData,
			type: 'post',
			success: function (response) {
				$.alert({
					icon: 'fa fa-warning',
					title: '提示!',
					closeIcon: true,
					theme: 'bootstrap',
					columnClass: 'small',
					content: response.message,
					draggable: true,
					animation: 'zoom',
					closeAnimation: 'scale',
					buttons: {
						ok: function () {
							if(response.response_code){
								window.location = "<?=base_url()?>school/movie/" + $('#lession_id').val();
							}else{

							}
						}
					}
				});
			}
		});
	}

	function goto_movie_secret(id){
		console.log(id);
		$('#lession_id').val(id);
		$('#check_password_school').iziModal('open');
	}
</script>
