
<link href="<?=base_url()?>assets/global/css/iziModal.min.css" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
	<div class="page-content">
      <div class="tabbable-custom ">
        <ul class="nav nav-tabs ">
          <li class="active">
            <a href="#local_report_tab"  onclick="click_tab(1)" data-toggle="tab"> 本地诊断 </a>
          </li>
          <li>
            <a href="#remote_report_tab" onclick="click_tab(2)" data-toggle="tab"> 远程诊断 </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="local_report_tab">
          </div>
          <div class="tab-pane" id="remote_report_tab">
          </div>
					<div class="tab-pane" id="review_report_tab">
          </div>
        </div>
      </div>
	</div>
</div>
<script src="<?=base_url()?>assets/global/scripts/iziModal.min.js" type="text/javascript"></script>
<script>
var local_report_url = '<?=base_url()?>' + 'report/local_report';
var remote_report_url = '<?=base_url()?>' + 'report/remote_report';
var review_report_url = '<?=base_url()?>' + 'report/review_report';
$(function(){
	$( "#local_report_tab" ).load( local_report_url );
});

function click_tab(istab){
	if(istab==1){
		$( "#local_report_tab" ).load( local_report_url );
		$( "#remote_report_tab" ).html('');
		$( "#review_report_tab" ).html('');
	}else if(istab==2){
		$( "#remote_report_tab" ).load( remote_report_url );
		$( "#local_report_tab" ).html('');
		$( "#review_report_tab" ).html('');
	}else if(istab==3){
		$( "#review_report_tab" ).load( review_report_url );
		$( "#local_report_tab" ).html('');
		$( "#remote_report_tab" ).html('');
	}

}



</script>
