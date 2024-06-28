<!-- Left navbar-header -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="user-pro">
                <?php  
                    $key = session()->get('login_type') . '_id';
                    $face_file = 'uploads/' . session()->get('login_type') . '_image/' . session()->get($key) . '.jpg';
                    if (!file_exists($face_file)){
                        $face_file = 'uploads/default.jpg';
                    }
                
                ?>
                <a href="#" class="waves-effect">
                    <img src="<?= base_url($face_file); ?>" alt="user-img"
                    class="img-fluid img-circle"> 
                    <span class="hide-menu">
                        <?php 
                            $crudModel = new \App\Models\CrudModel();
                            $account_type = session()->get('login_type');
                            $account_id = $account_type.'_id';
                            $name = $crudModel->get_type_name_by_id($account_type, session()->get($account_id), 'name');
                            echo $name;
                        
                        ?>
                    </span>
                </a>
            </li>
            <li class="<?php if($page_name == 'dashboard') echo 'active'; ?>"> <a href="<?= base_url('admin/dashboard'); ?>" class="waves-effect"><i class="ti-dashboard p-r-10"></i> <span
                        class="hide-menu"><?= get_phrase("Dashboard"); ?></span></a> </li>
            <li> <a href="javascript:void(0);" class="waves-effect"><i class="ti-calendar p-r-10"></i> <span
                        class="hide-menu"> <?= get_phrase("General Settings"); ?> <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="<?= base_url('setting/system_settings');?>"><?= get_phrase('System Settings')?></a> </li>
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