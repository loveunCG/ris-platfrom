<div class="page-content-wrapper">
	<div class="page-content">
      <div class="tabbable-custom ">
        <ul class="nav nav-tabs ">
          <li class="active">
            <a href="#local_report_tab" data-toggle="tab"> 个人诊断 </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="local_report_tab">
          </div>
        </div>
      </div>
	</div>
</div>

<script>
$(function(){
  var local_report_url = '<?=base_url()?>' + 'report/individual_report';
  $( "#local_report_tab" ).load( local_report_url );
});
</script>
