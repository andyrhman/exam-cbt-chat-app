<!-- Left navbar-header -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
                        <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li class="user-pro">
                <a href="#" class="waves-effect"><img src="../plugins/images/users/d1.jpg" alt="user-img"
                        class="img-circle"> <span class="hide-menu">Dr. Steve Gection<span
                            class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="javascript:void(0)"><i class="ti-user"></i> My Profile</a></li>
                    <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li>
                    <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li>
                    <li><a href="javascript:void(0)"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
            </li>
            <li class="<?php if($page_name == 'dashboard') echo 'active'; ?>"> <a href="<?= base_url('admin/dashboard'); ?>" class="waves-effect"><i class="ti-dashboard p-r-10"></i> <span
                        class="hide-menu"><?= get_phrase("Dashboard"); ?></span></a> </li>
            <li> <a href="javascript:void(0);" class="waves-effect"><i class="ti-calendar p-r-10"></i> <span
                        class="hide-menu"> Appointment <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="doctor-schedule.html">Doctor Schedule</a> </li>
                    <li> <a href="book-appointment.html">Book Appointment</a> </li>
                </ul>
            </li>
            <li class="<?php if($page_name == 'manage_profile') echo 'active';?>">
                <a href="<?= base_url('admin/manage_profile'); ?>" class="waves-effect"><i class="fa fa-edit"></i>
                    <span class="hide-menu">
                        <?= get_phrase("Manage Profile"); ?>
                    </span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('login/logout'); ?>" class="waves-effect"><i class="icon-logout fa-fw"></i>
                    <span class="hide-menu">
                        <?= get_phrase("Logout"); ?>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- Left navbar-header end -->