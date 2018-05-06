<div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true"
        data-slide-speed="200" style="font-size:14px">
        <?php
    if ($this->session->userdata('m_booking') == 'true'){?>

            <?php if($menutitle==$this->lang->line('booking')) {?>
            <li class="nav-item start active open">
                <?php } else { ?>
                <li class="nav-item">
                    <?php } ?>
                    <a href="javascript:;" class="nav-link nav-toggle">
                  <i class="fa fa-medkit"></i>
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
                        <li class="nav-item  ">
                            <a href="<?=base_url()?>booking/booking_listview" class="nav-link ">
                                          <i class="fa fa-cubes"></i>
                                            <span class="title">诊室排号</span>
                                        </a>
                        </li>

                    </ul>
                </li>
                <?php } ?>

                <?php  if($this->session->userdata('m_report')=='true'){ ?>
                <?php if($menutitle==$this->lang->line('report')) {?>
                <li class="nav-item start active open">
                    <?php } else { ?>
                    <li class="nav-item">
                        <?php } ?>
                        <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-pencil-square"></i>
                        <span class="title"><?=$this->lang->line('report')?></span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item  ">
                                <a href="<?=base_url()?>report" class="nav-link ">
                                  <i class="fa fa-share-alt-square"></i>
                                    <span class="title">报告列表</span>s
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="<?=base_url()?>report/my_report" class="nav-link ">
                                  <i class="fa fa-user-md"></i>
                                    <span class="title">我的报告</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="<?=base_url()?>report/delberation" class="nav-link ">
                                  <i class="fa fa-paper-plane-o"></i>
                                    <span class="title">审核报告</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                </li>
                <?php } ?>


                <?php if($this->session->userdata('m_contact') =="true") {?>
                 <?php if($menutitle==$this->lang->line('remote_contact')) {?>
                <li class="nav-item start active open">
                    <?php } else { ?>
                    <li class="nav-item">
                        <?php } ?>
                        <a href="javascript:;" class="nav-link nav-toggle">
<i class="fa fa-slideshare"></i>                              <span class="title">远程诊断咨询</span>
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

                            <li class="nav-item  ">
                                <a href="<?=base_url()?>contact/contactDeli" class="nav-link ">
                                      <i class="fa fa-share"></i>
                                        <span class="title">远程咨询审核</span>
                                    </a>
                            </li>

                        </ul>
                    </li>
                </li>
                <<?php } ?>

                    <?php if($this->session->userdata('m_learn') =="true") {?>
                    <?php if($menutitle==$this->lang->line('remote_contact')) {?>
                    <li class="nav-item start active open">
                        <?php } else { ?>
                        <li class="nav-item">
                            <?php } ?>
                            <a href="javascript:;" class="nav-link nav-toggle">
<i class="fa fa-bank"></i>                              <span class="title">学习交流</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="<?=base_url()?>study" class="nav-link ">
<i class="fa fa-book"></i>                                        <span class="title">在线视频教学</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="<?=base_url()?>study" class="nav-link ">
                                      <i class="fa fa-user-md"></i>
                                        <span class="title">讨论交流区 </span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="<?=base_url()?>study" class="nav-link ">
<i class="fa fa-comments"></i>                                        <span class="title">资料共享 </span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    </li>
                    <?php } ?>
                    <?php if($menutitle==$this->lang->line('statistics')) {?>
                    <li class="nav-item start active open">
                        <?php } else { ?>
                        <li class="nav-item">
                            <?php } ?>
                            <a href="<?=base_url()?>statistics" class="nav-link nav-toggle">
                            <i class="fa fa-bar-chart-o"></i>
                              <span class="title"><?=$this->lang->line('statistics')?></span>
                                    <span class="arrow"></span>
                                </a>
                        </li>
                    </li>
            </li>
    </ul>
</div>
