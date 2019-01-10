<div class="page-content-wrapper">
	<div class="page-content">
		<div class="full-height-content full-height-content-scrollable">
			<div class="full-height-content-body">
				<div class="row">
					<div class="container">
						<div id="myCarousel" class="carousel slide" data-ride="carousel">
							<!-- Indicators -->
							<ol class="carousel-indicators">
								<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
								<li data-target="#myCarousel" data-slide-to="1"></li>
								<li data-target="#myCarousel" data-slide-to="2"></li>
							</ol>
							<!-- Wrapper for slides -->
							<div class="carousel-inner">

								<div class="item">
									<img src="<?=base_url()?>assets/images/4.png" style="width:100%;">
								</div>
								<div class="item active">
									<img src="<?=base_url()?>assets/images/1.png" style="width:100%;">
								</div>
								<div class="item">
									<img src="<?=base_url()?>assets/images/2.png" style="width:100%;">

								</div>
								<div class="item">
									<img src="<?=base_url()?>assets/images/3.png" style="width:100%;">

								</div>


								<div class="item">
									<img src="<?=base_url()?>assets/images/bg.jpg" style="width:100%;">

								</div>

							</div>

							<!-- Left and right controls -->
							<a class="left carousel-control" href="#myCarousel" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#myCarousel" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
				</div>
				<div class="row" style="margin-top: 3%;">
					<?php $usrRole = $this->session->userdata('usr_role')?>
					<?php if ($usrRole == 1||$usrRole == 1024||$usrRole == 2||$usrRole == 100||$usrRole == 10||$this->session->userdata('RemoteConsultation')):?>
					<a href="<?=base_url()?>contact/contact_start/<?=$booking_id?>" class="btn btn-primary col-md-offset-2 col-md-3 btn-lg active"
					role="button" aria-pressed="true">
						<span class="glyphicon glyphicon-share"> </span>远程会诊</a>
					<?php endif;?>
					<?php if ($usrRole == 1||$usrRole == 1024||$usrRole == 2||$usrRole == 10||$usrRole == 100||$this->session->userdata('RemoteOutpatient')):?>
					<a href="<?=base_url()?>contact/outpatient/<?=$booking_id?>" class="btn btn-primary col-md-offset-2 col-md-3 btn-lg active"
					role="button" aria-pressed="true">
						<span class="glyphicon glyphicon-facetime-video"> </span>远程门诊</a>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
</div>
