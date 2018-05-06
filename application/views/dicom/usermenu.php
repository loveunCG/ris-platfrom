<div class="page-sidebar navbar-collapse collapse">
<ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true"
    data-slide-speed="200" style="font-size:14px">



    <?php if($menutitle==$this->lang->line('usermg')) {?>
    <li class="nav-item start active open">
        <?php } else { ?>
        <li class="nav-item">
            <?php } ?>
            <a href="javascript:;" class="nav-link nav-toggle">
                         <i class="fa fa-users"></i>
                            <span class="title">操作员</span>
                            <span class="arrow"></span>
                        </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="<?=base_url()?>usermg/" class="nav-link ">
                <i class="fa fa-user-plus"></i>
                                                        <span class="title">用户管理</span>
                                </a>
                </li>
                <li class="nav-item  ">
                    <a href="<?=base_url()?>usermg/equipment" class="nav-link ">
                <i class="fa fa-gears"></i>
                                    <span class="title"><?=$this->lang->line('equipmentmg')?></span>
                                </a>
                </li>
                <li class="nav-item  ">
                    <a href="<?=base_url()?>usermg/checkmg" class="nav-link ">
              <i class="fa fa-wrench"></i>
                                    <span class="title"><?=$this->lang->line('checkmg')?></span>
                                </a>
                </li>

            </ul>
        </li>
            <?php if($menutitle==$this->lang->line('booking')) {?>
        <li class="nav-item start active open">
            <?php } else { ?>
            <li class="nav-item">
                <?php } ?>
                <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-diamond"></i>
                                <span class="title"><?=$this->lang->line('booking')?></span>
                                <span class="arrow"></span>
                            </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="<?=base_url()?>booking/booking_checkup" class="nav-link ">
                                      <i class="fa fa-cart-arrow-down"></i>
                                        <span class="title"><?=$this->lang->line('booking_checkup')?></span>
                                    </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?=base_url()?>booking/booking_listview" class="nav-link ">
                                      <i class="fa fa-table"></i>
                                        <span class="title"><?=$this->lang->line('booking_table')?></span>
                                    </a>
                    </li>

                </ul>
            </li>

            <?php if($menutitle==$this->lang->line('statistics')) {?>
            <li class="nav-item start active open">
                <?php } else { ?>
                <li class="nav-item">
                    <?php } ?>
                    <a href="<?=base_url()?>statistics" class="nav-link nav-toggle">
<i class="fa fa-bar-chart-o"></i>                               <span class="title"><?=$this->lang->line('statistics')?></span>
                                <span class="arrow"></span>
                            </a>
                </li>
            <?php if($menutitle==$this->lang->line('report')) {?>
            <li class="nav-item start active open">
                <?php } else { ?>
                <li class="nav-item">
                    <?php } ?>
                    <a href="<?=base_url()?>report" class="nav-link nav-toggle">
                                <i class="fa fa-medkit"></i>
                                <span class="title"><?=$this->lang->line('report')?></span>
                                <span class="arrow"></span>
                            </a>
                </li>
                <?php if($menutitle==$this->lang->line('remote_contact')) {?>
                <li class="nav-item start active open">
                    <?php } else { ?>
                    <li class="nav-item">
                        <?php } ?>
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="fa fa-share-alt"></i>
                              <span class="title"><?=$this->lang->line('remote_contact')?></span>
                                <span class="arrow"></span>
                            </a>
                        <ul class="sub-menu">
                            <li class="nav-item  ">
                                <a href="<?=base_url()?>contact" class="nav-link ">
                                      <i class="fa fa-share-alt-square"></i>
                                        <span class="title"><?=$this->lang->line('contact_start')?></span>
                                    </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="<?=base_url()?>contact/my_contact" class="nav-link ">
                                      <i class="fa fa-user-md"></i>
                                        <span class="title"><?=$this->lang->line('my_contact')?></span>
                                    </a>
                            </li>

                        </ul>
                    </li>
                </li>
            </li>
        </li>
</ul>
</div>
