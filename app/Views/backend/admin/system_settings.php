
<div class="row">
    <div class="col-md-6">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <?= form_open(base_url('setting/system_settings/update'), ['class' => 'form-horizontal form-groups-bordered', 'method' => 'post']); ?>
                    <div class="form-group">
                        <label for="name"><?= get_phrase("System Name"); ?></label>
                        <input type="text" class="form-control" name="system_name" value="">
                    </div>
                    <div class="form-group">
                        <label for="email"><?= get_phrase("System Title"); ?></label>
                        <input type="text" class="form-control" name="system_title" value="">
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Phone"); ?></label>
                        <input type="text" class="form-control" name="phone" value="">
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("System Currency"); ?></label>
                        <input type="text" class="form-control" name="currency" value="">
                    </div>
                    
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("System Email"); ?></label>
                        <input type="email" class="form-control" name="system_email" value="">
                    </div>
                    
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Paypal Email"); ?></label>
                        <input type="email" class="form-control" name="paypal_email" value="">
                    </div>

                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Session"); ?></label>
                        <select class="form-control" name="session">
                            <?php 
                                use CodeIgniter\Database\Config;
                                $db = Config::connect(); 

                                $session = $db->table('settings')->getWhere(['type' => 'session'])->getRow()->description;

                            ?>
                            <?php 
                                for($i = 0; $i < 10; $i++) {
                                    ?>
                                    <option value="<?= (2020+$i); ?>-<?= (2020+$i+1); ?>" <?php if($session == (2020+$i).'-'.(2020+$i+1)) echo 'selected';?>>
                                        <?= (2020+$i); ?>-<?= (2020+$i+1); ?>
                                    </option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Text Align"); ?></label>
                        <select class="form-control" name="text_align">
                            <option value="left-to-right"><?= get_phrase("Left to Right"); ?></option>
                            <option value="right-to-left"><?= get_phrase("Right to Left"); ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Address"); ?></label>
                        <input type="text" class="form-control" name="adress" value="">
                    </div>
                    
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Footer Message"); ?></label>
                        <input type="text" class="form-control" name="footer" value="">
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
            <?= form_open(base_url('admin/manage_profile/changePassword'), array('class' => 'form-horizontal form-groups-bordered')); ?>
            <div class="form-group row">
                <label for="inputPassword1"
                    class="col-md-12"><?= get_phrase("Current Password"); ?></label>
                <div class="col-sm-12">
                    <input type="password" class="form-control" name="password">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword2"
                    class="col-md-12"><?= get_phrase("Confirm Password"); ?></label>
                <div class="col-sm-12">
                    <input type="password" class="form-control" name="confirm_password">
                </div>
            </div>
            <button type="submit"
                class="btn btn-success btn-rounded btn-sm btn-block"><?= get_phrase("Save"); ?></button>
            <?= form_close(); ?>
        </div>
    </div>
</div>