<?php
use CodeIgniter\Database\Config;

$db = Config::connect();

$system_name = $db->table('settings')->getWhere(['type' => 'system_name'])->getRow()->description;
$system_address = $db->table('settings')->getWhere(['type' => 'address'])->getRow()->description;
$footer = $db->table('settings')->getWhere(['type' => 'footer'])->getRow()->description;
$text_align = $db->table('settings')->getWhere(['type' => 'text_align'])->getRow()->description;
$skin_colour = $db->table('settings')->getWhere(['type' => 'skin_colour'])->getRow()->description;
$loginType = session()->get('login_type');
helper('form');

?>
<?php include 'css.php'; ?>

<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">


    <?php include 'header.php'; ?>
    <?php include $loginType . '/navigation.php'; ?>
    <?php include 'page_info.php'; ?>

    <!-- // * Showing the main page template -->
    <?php include $loginType . '/' . $page_name . '.php'; ?>

    <?php // include 'dashboard.php'; ?>

    <!-- .right-sidebar -->
    <div class="right-sidebar" style="background:url(<?php echo base_url(); ?>assets/images/10.png); opacity: 0.9;">
        <div class="slimscrollright">
            <div class="rpanel-title">Current Mesage Thread<span><i class="ti-close right-side-toggle"></i></span>
            </div>
            <div class="r-panel-body">

                <ul class="m-t-20 chatonline">

                    <li>

                    </li>

                </ul>
            </div>
        </div>
    </div>
    <!-- /.right-sidebar -->
</div>
<!-- /.container-fluid -->

<?php include 'footer.php'; ?>

</div>
<!-- /#page-wrapper -->
</div>
<?php include 'modal.php'; ?>
<?php include 'js.php'; ?>