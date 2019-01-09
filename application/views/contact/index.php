<link href="<?=base_url()?>assets/global/css/iziModal.min.css" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
	<div class="page-content">
      <div class="tabbable-custom ">
        <ul class="nav nav-tabs ">
					<?php if ($contact == 'my'):?>
						<li <li class="active">
							<a href="#contact_tab" onclick="#" data-toggle="tab"> 个人咨询 </a>
						</li>
						<?php endif?>
					<?php if ($contact == 'remote'):?>
						<li class="active">
							<a href="#remote_tab" onclick="#" data-toggle="tab"> 远程协作 </a>
						</li>
					<?php endif?>
					<?php if ($contact == 'review'):?>
						<li class="active">
							<a href="#review_tab" onclick="#" data-toggle="tab"> 咨询审核 </a>
						</li>
					<?php endif?>
        </ul>
        <div class="tab-content">
					<?php if ($contact == 'my'):?>
						  <div class="tab-pane active" id="contact_tab"></div>
						<?php endif?>
					<?php if ($contact == 'remote'):?>
						<div class="tab-pane active" id="remote_tab"></div>
					<?php endif?>
					<?php if ($contact == 'review'):?>
						<div class="tab-pane active" id="review_tab"></div>
					<?php endif?>
      </div>
	</div>
</div>
<div id="contact_review_proc_view" data-iziModal-icon="icon-home"/>
<style>
	.contact-button {
			width: 80px;
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
<script src="<?=base_url()?>assets/global/scripts/iziModal.min.js" type="text/javascript"></script>
<script>
	var base_url = '<?=base_url()?>'
  var contact_url = '<?=base_url()?>' + 'contact/ajax_contact_my_table';
	var remote_contact_url = '<?=base_url()?>' + 'contact/ajax_contact_remote_table';
  var review_contact_url = '<?=base_url()?>' + 'contact/ajax_review_contact_table';
  $(function(){
		if('<?php echo $contact?>' == 'remote'){
			$( "#remote_tab" ).load( remote_contact_url );
		}else if('<?php echo $contact?>' == 'my'){
			$( "#contact_tab" ).load( contact_url );
		} else {
				$( "#review_tab" ).load( review_contact_url );
		}
  });

	function contactDetailView(contact_id){
		var base_url = '<?= base_url()?>';
		var strURL = base_url + "contact/contactDetail/" + contact_id;
		window.location.href = strURL;
	}

	function DeliContact(contact_id){
		var base_url = '<?= base_url()?>';
		var strURL = base_url + "contact/contactDeliPro/" + contact_id;
		window.location.href = strURL;

	}

  // function DeliContact(contact_id) {
  //   let settings = {
  //       "url": base_url+'contact/ajax_contact_review_proc/'+contact_id,
  //       "method": "get"
  //   };
  //   $('#contact_review_proc_view').iziModal({
  //     padding: 15,
  //     theme: 'material',
  //     closeButton: true,
  //     title: '咨询详细信息',
  //     width: 800,
  //     onOpening: function(modal){
  //         modal.startLoading();
  //         $.ajax(settings).done(function (response) {
  //           $(".iziModal-content").html(response);
  //           modal.stopLoading();
  //         });
  //       }
  //   });
  //   $('#contact_review_proc_view').iziModal('open');
  // }

</script>
