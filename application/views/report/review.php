
<link href="<?=base_url()?>assets/global/css/iziModal.min.css" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
	<div class="page-content">
      <div class="tabbable-custom ">
        <ul class="nav nav-tabs ">
          <li class="active">
            <a href="#review_report_tab" data-toggle="tab"> 报告审核 </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="review_report_tab">
          </div>
        </div>
      </div>
	</div>
</div>
<script src="<?=base_url()?>assets/global/scripts/iziModal.min.js" type="text/javascript"></script>
<script>
var review_report_url = '<?=base_url()?>' + 'report/review_report';
$(function(){
	$( "#review_report_tab" ).load( review_report_url );
});
</script>
