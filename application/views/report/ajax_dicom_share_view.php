<div class="row">
	<div class="col-md-8">
		<h3>
			<?=$report_table->patient_name?>&nbsp;
				<?=$report_table->patient_gender?'男':'女'?>&nbsp;
					<?=$report_table->checkup_type?>&nbsp;
						<?=$report_table->checkup_type?>
		</h3>
		<div class="col-md-12">
			<div class="btn-group dicom-share">
				<button type="button" class="btn btn-info">图像匿名</button>
				<button type="button" class="btn btn-default">图像实名</button>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<textarea class="form-control" rows="3" id="dicom_view_url" placeholder=""><?=base_url()?><?=$report_table->qr_code?></textarea>
			</div>
		</div>
		<div class="col-md-12 dicom-share">
			<button type="button" class="btn green pull-left" onclick="opendicomView()">直接打开</button>
			<button type="button" class="btn btn-info pull-right" onclick="copyclipboard()">复制地址</button>
		</div>
	</div>
	<div class="col-md-4">
		<div class="mt-card-item">
      <p>
        手机端访问：
      </p>
			<div class="mt-card-avatar mt-overlay-1">
				<img class="qr-code" src="<?=base_url()?><?=$report_table->qr_code?>" />
			</div>
			<div class="mt-card-content">
				<p class="mt-card-name">扫描二维码，在手机上进行查看在手机上进行二次分享。</p>
			</div>
		</div>
	</div>
</div>
<div id="alert_modal" class="iziModal" data-izimodal-group="alerts">
</div>
<script>
function opendicomView(){
  var base_url = '<?= base_url()?>';
  var strURL = $('#dicom_view_url').html();
  window.location.href = strURL;

}

toastr.options = {
    "closeButton": true,
    "debug": false,
    "positionClass": "toast-bottom-center",
    "onclick": null,
    "showDuration": "1000",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

function copyclipboard(){
  var copyText = document.getElementById("dicom_view_url");
  copyText.select();
  document.execCommand("Copy");
  toastr.info('复制成功了!');

}

</script>
<style>
	.dicom-share {
		padding-bottom: 5%;
	}

	.qr-code {
		width: 150px;
	}

</style>
