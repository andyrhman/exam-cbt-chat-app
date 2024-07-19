<div class="row">
    <div class="col-md-5">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <?= form_open(base_url('admin/student/create_student'), ['class' => 'form-horizontal form-groups-bordered', 'enctype' => 'multipart/form-data']); ?>
                    <div class="form-group">
                        <label for="name"><?= get_phrase("Student Name"); ?></label>
                        <input type="text" class="form-control" name="name" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="email"><?= get_phrase("Student Email"); ?></label>
                        <input type="email" class="form-control" name="email" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="email"><?= get_phrase("Student Password"); ?></label>
                        <input type="password" class="form-control" name="password" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Student Phone"); ?></label>
                        <input type="text" class="form-control" name="phone" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Student Gender"); ?></label>
                        <input type="text" class="form-control" name="sex" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Student Address"); ?></label>
                        <input type="text" class="form-control" name="address" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Class"); ?></label>
                        <select name="class_id" class="form-control" onchange="get_class_sections(this.value);">
                            <option value="">Select Class</option>
                            <?php

                            $classModel = new \App\Models\ClassModel();
                            $classes = $classModel->selectClass();

                            ?>
                            <?php foreach ($classes as $class) : ?>
                                <option value="<?= $class['class_id']; ?>"><?= $class['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Section"); ?></label>
                        <select name="section_id" id="section_id" class="form-control">
                            <option value="">Select Class First</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="userfile"><?= esc(get_phrase("Student Image")); ?></label>
                        <input type="file" class="form-control" name="userfile" onchange="previewImage(event);" required>
                        <img id="newImage" src="" alt="New Image" width="100" height="100" style="display:none; margin-top: 10px;">
                    </div>
                    <button type="submit" class="btn btn-success btn-rounded btn-sm btn-block"><?= get_phrase("Save"); ?></button>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="panel panel-info">
            <div class="panel-body table-responsive">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('List Students'); ?>
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
                        <?php foreach ($students as $student) : ?>
                            <tr>
                                <td>
                                    <?php
                                    $crudModel = new \App\Models\CrudModel();
                                    $image_url = $crudModel->get_image_url('student', $student['student_id']);
                                    ?>
                                    <img src="<?= $image_url; ?>" class="img-circle" width="30" alt="<?= $student['name']; ?>">
                                </td>
                                <td><?= $student['name']; ?></td>
                                <td><?= $student['email']; ?></td>
                                <td><?= $student['phone']; ?></td>
                                <td>
                                    <button class="btn btn-info btn-rounded btn-sm" onclick="showModal('student', <?= $student['student_id']; ?>)">Edit</button>
                                    <button class="btn btn-danger btn-rounded btn-sm" onclick="confirm_modal('<?= base_url('admin/student/delete/' . $student['student_id']); ?>')">Delete</button>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<script>
    function get_class_sections(class_id) {
        $.ajax({
            url: '<?= base_url('admin/get_class_sections/') ?>' + class_id,
            success: function(response) {
                if (response.trim() === '') {
                    $('#section_id').html('<option value="">No Sections Available</option>');
                    $('#section_id').prop('disabled', true);
                } else {
                    $('#section_id').html(response);
                    $('#section_id').prop('disabled', false);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
                console.error('Status: ' + status);
                console.error('Response: ' + xhr.responseText);
            }
        });
    }
</script>
<?php include "edit_student.php"; ?>