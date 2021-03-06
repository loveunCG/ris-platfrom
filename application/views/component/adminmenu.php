<div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu page-sidebar-menu-compact" data-auto-scroll="true"
    data-slide-speed="200">
        <?php if (check_role('isAvailableUser') || check_role('isAvailablePatient') || check_role('isAvailableDevice') || check_role('isAvailableHospital') || check_role('isAvailableItemList') || check_role('isAvailableReview')) : ?>
        <li class="nav-item <?=($menutitle == $this->lang->line('usermg')) ? 'start active open' : ''?>">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-users"></i>
                <span class="title">操作员</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <?php if (check_role('isResetPasswordUser') || check_role('isNewUser') || check_role('isDeleteUser') || check_role('isAvailableRole') || check_role('isActivation') || check_role('isEditableUser')) : ?>
                <li class="nav-item">
                    <a href="<?=base_url()?>usermg/" class="nav-link ">
                        <i class="fa fa-user-plus"></i>
                        <span class="title">用户管理</span>
                    </a>
                </li>
                <?php endif;?>
                <?php if (check_role('isAvailablePatient') || check_role('isDeletePatient') || check_role('isActivationPatient')) : ?>
                <li class="nav-item">
                    <a href="<?=base_url()?>usermg/patientMg" class="nav-link ">
                        <i class="fa fa-user-plus"></i>
                        <span class="title">病人用户管理</span>
                    </a>
                </li>
                <?php endif;?>
                <?php if (check_role('isAvailableDevice') || check_role('isNewDevice') || check_role('isEditableDevice') || check_role('isDeleteDevice') || check_role('isActivationDevice')) : ?>
                <li class="nav-item  ">
                    <a href="<?=base_url()?>usermg/equipment" class="nav-link ">
                        <i class="fa fa-gears"></i>
                        <span class="title">
                            <?=$this->lang->line('equipmentmg')?>
                        </span>
                    </a>
                </li>
                <?php endif;?>
                <?php if (check_role('isAvailableItemList') || check_role('isEditableItem') || check_role('isNewItem') || check_role('isDeleteItem')) : ?>
                <li class="nav-item  ">
                    <a href="<?=base_url()?>usermg/checkmg" class="nav-link ">
                        <i class="fa fa-wrench"></i>
                        <span class="title">项目及收费</span>
                    </a>
                </li>
                <?php endif;?>
                <?php if (check_role('isNewHospital') || check_role('isAvailableHospital') || check_role('isEditableHospital') || check_role('isDeleteHospital')) : ?>
                <li class="nav-item  ">
                    <a href="<?=base_url()?>usermg/hospitalmg" class="nav-link ">
                        <i class="fa fa-hospital-o"></i>
                        <span class="title">子医院管理</span>
                    </a>
                </li>
                <?php endif;?>
                <?php if (check_role('isAvailableReview')) : ?>
                <li class="nav-item  ">
                    <a href="<?=base_url()?>usermg/hosdelmg" class="nav-link ">
                        <i class="fa fa-ambulance"></i>
                        <span class="title">子医院审核</span>
                    </a>
                </li>
                <?php endif;?>
            </ul>
        </li>
        <?php endif;?>
        <?php if (check_role('Booking') || check_role('BookingTable') || check_role('Arrangement')) : ?>
        <li class="nav-item <?=$menutitle == $this->lang->line('booking') ? 'start active open' : ''?>">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-medkit"></i>
                <span class="title">
                    <?=$this->lang->line('booking')?>
                </span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <?php if (check_role('Booking')) : ?>
                <li class="nav-item  ">
                    <a href="<?=base_url()?>booking/booking_checkup" class="nav-link ">
                        <i class="fa fa-cart-arrow-down"></i>
                        <span class="title">
                            <?=$this->lang->line('booking_checkup')?>
                        </span>
                    </a>
                </li>
                <?php endif;?>
                <?php if (check_role('BookingTable')) : ?>
                <li class="nav-item  ">
                    <a href="<?=base_url()?>booking/booking_listview" class="nav-link ">
                        <i class="fa fa-table"></i>
                        <span class="title">
                            <?=$this->lang->line('booking_table')?>
                        </span>
                    </a>
                </li>
                <?php endif;?>
                <?php if (check_role('Arrangement')) : ?>
                <li class="nav-item  ">
                    <a href="<?=base_url()?>booking/consultation" class="nav-link ">
                        <i class="fa fa-cubes"></i>
                        <span class="title">诊室排号</span>
                    </a>
                </li>
                <?php endif;?>
            </ul>
        </li>
        <?php endif;?>

        <?php if (check_role('report_table') || check_role('MyReport') || check_role('AuditReport')) : ?>
        <li class="nav-item <?=$menutitle == $this->lang->line('report') ? 'start active open' : ''?>">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-pencil-square"></i>
                <span class="title">
                    <?=$this->lang->line('report')?>
                </span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <?php if (check_role('report_table')) : ?>
                <li class="nav-item  ">
                    <a href="<?=base_url()?>report" class="nav-link ">
                        <i class="fa fa-share-alt-square"></i>
                        <span class="title">报告列表</span>
                    </a>
                </li>
                <?php endif;?>
                <?php if (check_role('MyReport')) : ?>
                <li class="nav-item  ">
                    <a href="<?=base_url()?>report/individual" class="nav-link ">
                        <i class="fa fa-user-md"></i>
                        <span class="title">我的报告</span>
                    </a>
                </li>
                <?php endif;?>
                <?php if (check_role('AuditReport')) : ?>
                <li class="nav-item  ">
                    <a href="<?=base_url()?>report/delberation" class="nav-link ">
                        <i class="fa fa-paper-plane-o"></i>
                        <span class="title">审核报告</span>
                    </a>
                </li>
                <?php endif;?>
            </ul>
        </li>
        <?php endif;?>

        <?php if (check_role('remote_table') || check_role('MyAdvice') || check_role('DeliContact')) : ?>
        <li class="nav-item <?=$menutitle == $this->lang->line('remote_contact') ? 'start active open' : ''?>">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-slideshare"></i>
                <span class="title">远程诊断咨询</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <?php if (check_role('remote_table') || check_role('InitiateConsultation') || check_role('RemoteOutpatient')
                || check_role('RemoteConsultation')) : ?>
                <li class="nav-item ">
                    <a href="<?=base_url()?>contact/remote_contact" class="nav-link ">
                        <i class="fa fa-tablet"></i>
                        <span class="title">
                            远程协作
                        </span>
                    </a>
                </li>
                <?php endif;?>
                <?php if (check_role('MyAdvice')) : ?>
                <li class="nav-item  ">
                    <a href="<?=base_url()?>contact/my_contact" class="nav-link ">
                        <i class="fa fa-user-md"></i>
                        <span class="title">
                            我的咨询
                        </span>
                    </a>
                </li>
                <?php endif;?>
                <?php if (check_role('DeliContact')) : ?>
                <li class="nav-item  ">
                    <a href="<?=base_url()?>contact/review" class="nav-link ">
                        <i class="fa fa-user-md"></i>
                        <span class="title">
                            咨询审核
                        </span>
                    </a>
                </li>
                <?php endif;?>
            </ul>
        </li>
        <?php endif;?>
        <?php if (check_role('OnlineVideoTeaching') || check_role('OnlineVideoTeaching') || check_role('ExchangeDiscussionArea') || check_role('DataSharing')) : ?>
        <li class="nav-item <?=$menutitle == $this->lang->line('school') ? 'start active open' : ''?>">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-bank"></i>
                <span class="title">学习交流</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <?php if (check_role('OnlineVideoTeaching')) : ?>
                <li class="nav-item  ">

                    <a href="<?=base_url()?>school" class="nav-link ">
                        <i class="fa fa-book"></i>
                        <span class="title">视频教学</span>
                    </a>
                </li>
                <?php endif;?>
                <?php if (check_role('OnlineVideoTeaching')) : ?>
                <li class="nav-item  ">
                    <a href="<?=base_url()?>school/my_school" class="nav-link ">
                        <i class="fa fa-book"></i>
                        <span class="title">我的教学</span>
                    </a>
                </li>
                <?php endif;?>
                <?php if (check_role('ExchangeDiscussionArea')) : ?>
                <li class="nav-item  ">
                    <a href="<?=base_url()?>post/" class="nav-link ">
                        <i class="fa fa-user-md"></i>
                        <span class="title">讨论交流区 </span>
                    </a>
                </li>
                <?php endif;?>
                <?php if (check_role('DataSharing')) : ?>
                <li class="nav-item  ">
                    <a href="<?=base_url()?>school/DataShareMg" class="nav-link ">
                        <i class="fa fa-comments"> </i>
                        <span class="title">资料共享 </span>
                    </a>
                </li>
                <?php endif;?>
            </ul>
        </li>
        <?php endif;?>
        <?php if (check_role('bookingStatistics') || check_role('diagnosisStatistics') || check_role('remoteStatistics')) : ?>
        <li class="nav-item <?=$this->uri->segment(1) == 'statistics' ? 'start active open' : ''?>">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-bar-chart-o"></i>
                <span class="title">数据统计与分析</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <?php if (check_role('bookingStatistics')) : ?>
                <li class="nav-item">
                    <a href="<?=base_url()?>statistics/bookingStatistics" class="nav-link ">
                        <i class="fa fa-book"></i>
                        <span class="title">登记情况统计</span>
                    </a>
                </li>
                <?php endif;?>
                <?php if (check_role('diagnosisStatistics')) : ?>
                <li class="nav-item  ">
                    <a href="<?=base_url()?>statistics/diagnosisStatistics" class="nav-link ">
                        <i class="fa fa-book"></i>
                        <span class="title">诊断报告统计 </span>
                    </a>
                </li>
                <?php endif;?>
                <?php if (check_role('remoteStatistics')) : ?>
                <li class="nav-item  ">
                    <a href="<?=base_url()?>statistics/remoteStatistics" class="nav-link ">
                        <i class="fa fa-book"> </i>
                        <span class="title">远程咨询统计 </span>
                    </a>
                </li>
                <?php endif;?>
            </ul>
        </li>
        <?php endif;?>
    </ul>
</div>
