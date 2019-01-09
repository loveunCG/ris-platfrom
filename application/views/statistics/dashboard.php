<script src="<?=base_url()?>assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/horizontal-timeline/horozontal-timeline.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">  <?=$this->lang->line('Statistics_model')?>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a> 首面</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <span><?=$this->lang->line('Statistics_model')?></span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="<?=count($user_info)?>"><?=count($user_info)?></span>
                        </div>
                        <div class="desc">已登记医生数 </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="<?=$Tamount?>"><?=(int) $Tamount?></span>￥ </div>
                        <div class="desc"> 总检查费</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="<?=$totaldevicenum?>"><?=$totaldevicenum?>台</span>
                        </div>
                        <div class="desc"> 总检查设备数 </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="<?=$totalyiyuan?>"><?=$totalyiyuan?></span></div>
                        <div class="desc"> 子医院总数 </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row widget-row">
            <div class="col-md-3">
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">今天报告数</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-green fa fa-book"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">报告数</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?=count($jintian_report_data)?>"><?=count($jintian_report_data)?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">总报告数</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-red fa fa-book"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">报告数</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?=count($report_data)?>"><?=count($report_data)?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">今天登记数</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-purple fa fa-cart-plus"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">登记数</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?=count($jintian_booking_data)?>"><?=count($jintian_booking_data)?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">总登记数</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-blue fa fa-cart-plus"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">登记数</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?=count($booking_data)?>"><?=count($booking_data)?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-sm-6">
              <div class="portlet light ">
                  <div class="portlet-title">
                      <div class="caption">
                          <span class="caption-subject bold uppercase font-dark">检查与报告进度</span>
                      </div>
                  </div>
                  <div class="portlet-body">
                      <div id="dashboard_amchart_3" class="CSSAnimationChart"></div>
                  </div>
              </div>
          </div>
            <div class="col-md-6 col-sm-6">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption ">
                            <span class="caption-subject font-dark bold uppercase">登记状态表</span>
                        </div>
                        <div class="actions">

                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="amchart_4" class="CSSAnimationChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>