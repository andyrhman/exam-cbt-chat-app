<!-- Teacher List View -->


<div class="row">
    <div class="col-md-5">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <?= form_open(base_url('admin/teacher/create_teacher'), ['class' => 'form-horizontal form-groups-bordered', 'enctype' => 'multipart/form-data']); ?>
                    <div class="form-group">
                        <label for="name"><?= get_phrase("Teacher Name"); ?></label>
                        <input type="text" class="form-control" name="name" value="">
                    </div>
                    <div class="form-group">
                        <label for="email"><?= get_phrase("Teacher Email"); ?></label>
                        <input type="text" class="form-control" name="email" value="">
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Teacher Phone"); ?></label>
                        <input type="text" class="form-control" name="phone" value="">
                    </div>
                    <div class="form-group">
                        <label for="userfile"><?= esc(get_phrase("Teacher Image")); ?></label>
                        <input type="file" class="form-control" name="userfile" onChange="readURL(this);">
                    </div>
                    <button type="submit"
                        class="btn btn-success btn-rounded btn-sm btn-block"><?= get_phrase("Save"); ?></button>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="panel panel-info">
            <div class="panel-body table-responsive">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('List Teachers'); ?>
                <hr>
                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>
                                <div><?php echo get_phrase('Image'); ?></div>
                            </th>
                            <th>
                                <div><?php echo get_phrase('Name'); ?></div>
                            </th>
                            <th>
                                <div><?php echo get_phrase('Email'); ?></div>
                            </th>
                            <th>
                                <div><?php echo get_phrase('Phone'); ?></div>
                            </th>
                            <th>
                                <div><?php echo get_phrase('Actions'); ?></div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($teachers as $teacher): ?>
                            <tr>
                                <td>
                                    <?php
                                    $crudModel = new \App\Models\CrudModel();
                                    $image_url = $crudModel->get_image_url('teacher', $teacher['teacher_id']);
                                    ?>
                                    <img src="<?= $image_url; ?>" class="img-circle" width="30"
                                        alt="<?= $teacher['name']; ?>">
                                </td>
                                <td><?= $teacher['name']; ?></td>
                                <td><?= $teacher['email']; ?></td>
                                <td><?= $teacher['phone']; ?></td>
                                <td>
                                    <button class="btn btn-info btn-rounded btn-sm"
                                        onclick="showModal('teacher', <?= $teacher['teacher_id']; ?>)">Edit</button>
                                    <button class="btn btn-danger btn-rounded btn-sm"><?= get_phrase("Delete"); ?></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>


                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>