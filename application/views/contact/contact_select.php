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
				        <img src="<?=base_url()?>assets/images/4.png" alt="Chicago" style="width:100%;">
				        <div class="carousel-caption">
				          <h3>Chicago</h3>
				          <p>Thank you, Chicago!</p>
				        </div>
				      </div>
				      <div class="item active">
				        <img src="<?=base_url()?>assets/images/1.png" alt="Los Angeles" style="width:100%;">
				        <div class="carousel-caption">
				          <h3>Los Angeles</h3>
				          <p>LA is always so much fun!</p>
				        </div>
				      </div>

				      <div class="item">
							<img src="<?=base_url()?>assets/images/2.png" alt="Chicago" style="width:100%;">
							<div class="carousel-caption">
								<h3>Chicago</h3>
								<p>Thank you, Chicago!</p>
							</div>
						</div>
						<div class="item">
				        <img src="<?=base_url()?>assets/images/3.png" alt="Chicago" style="width:100%;">
				        <div class="carousel-caption">
				          <h3>Chicago</h3>
				          <p>Thank you, Chicago!</p>
				        </div>
				      </div>


				      <div class="item">
				        <img src="<?=base_url()?>assets/images/bg.jpg" alt="New York" style="width:100%;">
				        <div class="carousel-caption">
				          <h3>New York</h3>
				          <p>We love the Big Apple!</p>
				        </div>
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

    	<a href="<?=base_url()?>contact/contact_start/<?=$booking_id?>" class="btn btn-primary col-md-offset-2 col-md-3 btn-lg active"  role="button" aria-pressed="true"><span class="glyphicon glyphicon-share"> </span>远程诊断</a>
    	<a href="<?=base_url()?>contact/outpatient/<?=$booking_id?>" class="btn btn-primary col-md-offset-2 col-md-3 btn-lg active"  role="button" aria-pressed="true"><span class="glyphicon glyphicon-facetime-video"> </span>远程门诊</a>
    </div>
    </div>
    </div>
  </div>
</div>
