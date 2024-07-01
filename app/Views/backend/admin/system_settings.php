<?php
use CodeIgniter\Database\Config;

$db = Config::connect();

$session = $db->table('settings')->getWhere(['type' => 'session'])->getRow()->description;
$system_name = $db->table('settings')->getWhere(['type' => 'system_name'])->getRow()->description;
$system_title = $db->table('settings')->getWhere(['type' => 'system_title'])->getRow()->description;
$phone = $db->table('settings')->getWhere(['type' => 'phone'])->getRow()->description;
$currency = $db->table('settings')->getWhere(['type' => 'currency'])->getRow()->description;
$system_email = $db->table('settings')->getWhere(['type' => 'system_email'])->getRow()->description;
$text_align = $db->table('settings')->getWhere(['type' => 'text_align'])->getRow()->description;
$paypal_email = $db->table('settings')->getWhere(['type' => 'paypal_email'])->getRow()->description;
$address = $db->table('settings')->getWhere(['type' => 'address'])->getRow()->description;
$footer = $db->table('settings')->getWhere(['type' => 'footer'])->getRow()->description;

?>
<div class="row">
    <div class="col-md-6">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <?= form_open(base_url('setting/system_settings/update'), ['class' => 'form-horizontal form-groups-bordered', 'method' => 'post']); ?>
                    <div class="form-group">
                        <label for="name"><?= get_phrase("System Name"); ?></label>
                        <input type="text" class="form-control" name="system_name" value="<?= $system_name ?>">
                    </div>
                    <div class="form-group">
                        <label for="email"><?= get_phrase("System Title"); ?></label>
                        <input type="text" class="form-control" name="system_title" value="<?= $system_title ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Phone"); ?></label>
                        <input type="text" class="form-control" name="phone" value="<?= $phone ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("System Currency"); ?></label>
                        <input type="text" class="form-control" name="currency" value="<?= $currency ?>">
                    </div>

                    <div class="form-group">
                        <label for="phone"><?= get_phrase("System Email"); ?></label>
                        <input type="email" class="form-control" name="system_email" value="<?= $system_email ?>">
                    </div>

                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Paypal Email"); ?></label>
                        <input type="email" class="form-control" name="paypal_email" value="<?= $paypal_email ?>">
                    </div>

                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Session"); ?></label>
                        <select class="form-control" name="session">
                            <?php
                            for ($i = 0; $i < 10; $i++) {
                                ?>
                                <option value="<?= (2020 + $i); ?>-<?= (2020 + $i + 1); ?>" <?php if ($session == (2020 + $i) . '-' . (2020 + $i + 1))
                                              echo 'selected'; ?>>
                                    <?= (2020 + $i); ?>-<?= (2020 + $i + 1); ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Text Align"); ?></label>
                        <select class="form-control" name="text_align">
                            <option value="left-to-right" <?php if ($text_align == 'left-to-right')
                                echo 'selected'; ?>>
                                <?= get_phrase("Left to Right"); ?>
                            </option>
                            <option value="right-to-left" <?php if ($text_align == 'right-to-left')
                                echo 'selected'; ?>>
                                <?= get_phrase("Right to Left"); ?>
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Address"); ?></label>
                        <input type="text" class="form-control" name="address" value="<?= $address ?>">
                    </div>

                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Footer Message"); ?></label>
                        <input type="text" class="form-control" name="footer" value="<?= $footer ?>">
                    </div>
                    <button type="submit"
                        class="btn btn-success btn-rounded btn-sm btn-block"><?= get_phrase("Save"); ?></button>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="white-box">

            <?= form_open(base_url('setting/system_settings/logo'), array('class' => 'form-horizontal form-groups-bordered', 'enctype' => 'multipart/form-data')); ?>
            <div class="form-group">
                <label for="userfile"><?= esc(get_phrase("System Logo")); ?></label>
                <input type="file" class="form-control" name="userfile" onchange="readURL(this);">
                <?php
                $imagePath = 'uploads/logo.png';
                $imageExists = file_exists($imagePath);
                ?>
                <img id="blahblah" src="<?= $imageExists ? base_url($imagePath) : ''; ?>" height="200" width="200"
                    style="<?= !$imageExists ? 'display:none;' : '' ?>">
            </div>

            <button type="submit"
                class="btn btn-success btn-rounded btn-sm btn-block"><?= get_phrase("Save"); ?></button>
            <?= form_close(); ?>

            <hr>
            <?= get_phrase('Theme'); ?>
            <?= form_open(base_url('setting/system_settings/theme'), array('class' => 'form-horizontal form-groups-bordered')); ?>
            <div class="radio radio-custom">
                <input type="radio" <?php if ($skin = $db->table('settings')->getWhere(array('type' => 'skin_colour'))->getRow()->description == 'default')
                    echo 'checked'; ?> name="skin_colour" id="radio2"
                    value="default">
                <label for="radio2"> Default </label>
            </div>

            <div class="radio radio-success">
                <input type="radio" <?php if ($skin = $db->table('settings')->getWhere(array('type' => 'skin_colour'))->getRow()->description == 'green')
                    echo 'checked'; ?> name="skin_colour" id="radio3"
                    value="green">
                <label for="radio3"> Green </label>
            </div>

            <div class="radio radio-gray">
                <input type="radio" <?php if ($skin = $db->table('settings')->getWhere(array('type' => 'skin_colour'))->getRow()->description == 'gray')
                    echo 'checked'; ?> name="skin_colour" id="radio4"
                    value="gray">
                <label for="radio4"> Gray </label>
            </div>

            <div class="radio radio-black">
                <input type="radio" <?php if ($skin = $db->table('settings')->getWhere(array('type' => 'skin_colour'))->getRow()->description == 'black')
                    echo 'checked'; ?> name="skin_colour" id="radio5"
                    value="black">
                <label for="radio5"> Black </label>
            </div>

            <div class="radio radio-purple">
                <input type="radio" <?php if ($skin = $db->table('settings')->getWhere(array('type' => 'skin_colour'))->getRow()->description == 'purple')
                    echo 'checked'; ?> name="skin_colour" id="radio6"
                    value="purple">
                <label for="radio6"> Purple </label>
            </div>

            <div class="radio radio-info">
                <input type="radio" <?php if ($skin = $db->table('settings')->getWhere(array('type' => 'skin_colour'))->getRow()->description == 'blue')
                    echo 'checked'; ?> name="skin_colour" id="radio7"
                    value="blue">
                <label for="radio7"> Blue </label>
            </div>
            <br>
            <button type="submit"
                class="btn btn-success btn-rounded btn-sm btn-block"><?= get_phrase("Save"); ?></button>
        </div>
        <?= form_close(); ?>
    </div>
</div>
</div>