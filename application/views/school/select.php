<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <h3 class="page-title">学习交流</h3>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet portlet-sortable box blue-chambray ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-magnifier"></i>
                            <span class="caption-subject font-green sbold uppercase">在线视频教学</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                        <?php foreach ($study_info as $value) { ?>
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-6">
                                    <div class="color-demo tooltips" data-original-title="Click to view demos for this color" data-toggle="modal" onclick="javascript: goto_movie('<?php echo $value->lession_id; ?>');">
                                        <div class="color-view bg-green-soft bg-font-green-soft bold uppercase"> <?php echo $value->lession_title; ?> </div>
                                        <div class="color-info bg-white c-font-14 sbold"> <?php echo $value->usr_name; ?> </div>
                                    </div>
                                </div>
                        <?php } ?>                                
                        </div>

                    </div>                
                </div>
            </div>
        </div>        
    </div>
    <!-- END CONTENT BODY -->
</div>

<script type="text/javascript">
    function goto_movie(id) {
        window.location = "<?=base_url()?>school/movie/"+id;
    }
</script>

