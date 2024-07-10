<!-- Teacher List View -->


<div class="row">
    <div class="col-md-5">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <?= form_open(base_url('admin/classes/create_class'), ['class' => 'form-horizontal form-groups-bordered']); ?>
                    <div class="form-group">
                        <label for="name"><?= get_phrase("Class Name"); ?></label>
                        <input type="text" class="form-control" name="name" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="email"><?= get_phrase("Nick Name"); ?></label>
                        <input type="text" class="form-control" name="name_numeric" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Teacher"); ?></label>
                        <select name="teacher_id" class="form-control">
                            <option value="">Select Teacher</option>
                            <?php

                            $teacherModel = new \App\Models\TeacherModel();
                            $teachers = $teacherModel->selectTeacher()

                                ?>
                            <?php foreach ($teachers as $teacher): ?>
                                <option value="<?= $teacher['teacher_id']; ?>"><?= $teacher['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
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
                                <div><?php echo get_phrase('Name'); ?></div>
                            </th>
                            <th>
                                <div><?php echo get_phrase('Nick Name'); ?></div>
                            </th>
                            <th>
                                <div><?php echo get_phrase('Teacher'); ?></div>
                            </th>
                            <th>
                                <div><?php echo get_phrase('Actions'); ?></div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($classes as $class): ?>
                            <tr>
                                <td><?= $class['name']; ?></td>
                                <td><?= $class['name_numeric']; ?></td>
                                <td>   
                                    <?php
                                        $crudModel = new \App\Models\CrudModel();
                                        echo $crudModel->get_type_name_by_id('teacher', $class['teacher_id'])
                                    ?>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-rounded btn-sm"
                                        onclick="showModal('class', <?= $class['class_id']; ?>)">Edit</button>
                                    <button class="btn btn-danger btn-rounded btn-sm"
                                        onclick="confirm_modal('<?= base_url('admin/classes/delete/' . $class['class_id']); ?>')">Delete</button>

                                </td>
                            </tr>
                        <?php endforeach; ?>


                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<?php include "edit_teacher.php"; ?>