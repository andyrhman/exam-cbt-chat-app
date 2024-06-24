<!-- /.row -->
<div class="row">
    <div class="col-md-6">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <?= form_open(base_url('admin/manage_profile/update'), array('class' => 'form-horizontal form-groups-bordered', 'enctype'=>'multipart/form-data'));?>
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?= get_phrase("Admin Name"); ?></label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?= get_phrase("Admin Email"); ?></label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?= get_phrase("Admin Phone"); ?></label>
                            <input type="text" class="form-control" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?= get_phrase("Admin Image"); ?></label>
                            <input type="file" class="form-control" name="userfile" onChange="readURL(this);">
                            <img id="blah" src="" alt="" height="200" width="200" style="display:none;">
                        </div>
                        <button type="submit" class="btn btn-success btn-rounded btn-sm btn-block">Submit</button>
                    <?= form_close();?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="white-box">
            <?= form_open(base_url('admin/manage_profile/update'), array('class' => 'form-horizontal form-groups-bordered'));?>
                <div class="form-group row">
                    <label for="inputPassword3"
                        class="col-sm-3 control-label col-form-label"><?= get_phrase("Current Password"); ?></label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3"
                        class="col-sm-3 control-label col-form-label"><?= get_phrase("Confirm Password"); ?></label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="confirm_password">
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-rounded btn-sm btn-block">Submit</button>
            <?= form_close();?>
        </div>
    </div>
</div>