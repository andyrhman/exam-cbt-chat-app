<!-- Left navbar-header -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="user-pro">
                <?php
                $key = session()->get('login_type') . '_id';
                $face_file = 'uploads/' . session()->get('login_type') . '_image/' . session()->get($key) . '.jpg';
                if (!file_exists($face_file)) {
                    $face_file = 'uploads/default.jpg';
                }

                ?>
                <a href="#" class="waves-effect">
                    <img src="<?= base_url($face_file); ?>" alt="user-img" class="img-fluid img-circle">
                    <span class="hide-menu">
                        <?php
                        $crudModel = new \App\Models\CrudModel();
                        $account_type = session()->get('login_type');
                        $account_id = $account_type . '_id';
                        $name = $crudModel->get_type_name_by_id($account_type, session()->get($account_id), 'name');
                        echo $name;

                        ?>
                    </span>
                </a>
            </li>
            <li class="<?php if ($page_name == 'dashboard')
                echo 'active'; ?>"> <a href="<?= base_url('admin/dashboard'); ?>" class="waves-effect"><i
                        class="ti-dashboard p-r-10"></i>
                    <span class="hide-menu"><?= get_phrase("Dashboard"); ?></span></a> </li>

            <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-home p-r-10"></i> <span
                        class="hide-menu"> <?= get_phrase("Manage Class"); ?> <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li <?php if ($page_name == 'classes')
                        echo 'active'; ?>> <a
                            href="<?= base_url('admin/classes'); ?>"><?= get_phrase('New Class') ?></a>
                    </li>
                    <li <?php if ($page_name == 'section')
                        echo 'active'; ?>> <a
                            href="<?= base_url('admin/section'); ?>"><?= get_phrase('New Section') ?></a>
                </ul>
            </li>  

            <li class="<?php if ($page_name == 'subject')
                echo 'active'; ?>"> <a href="<?= base_url('admin/subject'); ?>" class="waves-effect"><i
                        class="fa fa-plus p-r-10"></i>
                    <span class="hide-menu"><?= get_phrase("Manage Subject"); ?></span></a> </li>

            <li class="<?php if ($page_name == 'teacher')
                echo 'active'; ?>"> <a href="<?= base_url('admin/teacher'); ?>" class="waves-effect"><i
                        class="fa fa-users p-r-10"></i>
                    <span class="hide-menu"><?= get_phrase("Manage Teacher"); ?></span></a> </li>

            <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users p-r-10"></i> <span
                        class="hide-menu"> <?= get_phrase("Manage Student"); ?> <span
                            class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li <?php if ($page_name == 'student')
                        echo 'active'; ?>> <a
                            href="<?= base_url('admin/student'); ?>"><?= get_phrase('New Student') ?></a>
                    </li>
                </ul>
            </li>

            <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-link p-r-10"></i> <span
                        class="hide-menu"> <?= get_phrase("Manage Exam"); ?> <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li <?php if ($page_name == 'create_online_exam')
                        echo 'active'; ?>> <a
                            href="<?= base_url('admin/create_online_exam'); ?>"><?= get_phrase('Create Online Exam') ?></a>
                    </li>
                    <li <?php if ($page_name == 'manage_online_exam')
                        echo 'active'; ?>> <a
                            href="<?= base_url('admin/manage_online_exam'); ?>"><?= get_phrase('Manage Online Exam') ?></a>

                </ul>
            </li>

            <li> <a href="javascript:void(0);" class="waves-effect"><i class="ti-calendar p-r-10"></i> <span
                        class="hide-menu"> <?= get_phrase("General Settings"); ?> <span
                            class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li <?php if ($page_name == 'system_settings')
                        echo 'active'; ?>> <a
                            href="<?= base_url('setting/system_settings'); ?>"><?= get_phrase('System Settings') ?></a>
                    </li>
                </ul>
            </li>

            <li class="<?php if ($page_name == 'manage_profile')
                echo 'active'; ?>">
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