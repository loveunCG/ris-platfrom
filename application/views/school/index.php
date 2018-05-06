<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN THEME PANEL -->

        <!-- END THEME PANEL -->
        <h3 class="page-title">
            <?=$menutitle?>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                        <?=$menutitle?>
                    </a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <span><?=$page_title?></span>
                </li>
            </ul>

        </div>
        <!-- BEGIN CONTENT BODY -->
        <div class="row" id="sortable_portlets">
          <div class="col-md-12 column sortable">

        <div class="row">
            <div class="col-md-12">
                <div class="portlet portlet-sortable box blue-chambray portlet-datatable ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-green sbold uppercase">视频教学</span>
                        </div>
                    </div>

                    <div class="portlet-body">
                        <div class="row">
                          <?php foreach ($lession_info as $value):?>
                          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                <div class="visual">
                                    <i class="fa fa-comments"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$value->lession_title?>"><?=$value->lession_title?></span>
                                    </div>
                                    <div class="desc"> <?=$value->lession_doctor?> </div>
                                </div>
                            </a>
                          </div>
                        <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
      </div>
      </div>
    </div>
