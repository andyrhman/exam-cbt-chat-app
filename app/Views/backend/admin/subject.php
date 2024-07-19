<?php use CodeIgniter\Database\Config; ?>

<div class="row">
    <div class="col-md-5">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <?= form_open(base_url('admin/subject/create_subject'), ['class' => 'form-horizontal form-groups-bordered']); ?>
                    <div class="form-group">
                        <label for="name"><?= get_phrase("Subject Name"); ?></label>
                        <input type="text" class="form-control" name="name" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Teacher"); ?></label>
                        <select name="teacher_id" class="form-control">
                            <option value="">Select Teacher</option>
                            <?php

                            $teacherModel = new \App\Models\TeacherModel();
                            $teachers = $teacherModel->selectTeacher();

                            ?>
                            <?php foreach ($teachers as $teacher): ?>
                                <option value="<?= $teacher['teacher_id']; ?>"><?= $teacher['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Class"); ?></label>
                        <select name="class_id" class="form-control">
                            <option value="">Select Class</option>
                            <?php

                            $classModel = new \App\Models\ClassModel();
                            $classes = $classModel->selectClass();

                            ?>
                            <?php foreach ($classes as $class): ?>
                                <option value="<?= $class['class_id']; ?>"><?= $class['name']; ?></option>
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
                <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('List Subjects'); ?>
                <hr>
                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>
                                <div><?php echo get_phrase('Name'); ?></div>
                            </th>
                            <th>
                                <div><?php echo get_phrase('Teacher'); ?></div>
                            </th>
                            <th>
                                <div><?php echo get_phrase('Class'); ?></div>
                            </th>
                            <th>
                                <div><?php echo get_phrase('Actions'); ?></div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subjects as $subject): ?>
                            <tr>
                                <td><?= $subject['name']; ?></td>
                                <td>
                                    <?php
                                    $crudModel = new \App\Models\CrudModel();
                                    echo $crudModel->get_type_name_by_id('teacher', $subject['teacher_id']);

                                    // * Alternative
                                    // ? $db = Config::connect();
                                    // ? echo $db->table('teacher')->getWhere(['teacher_id' => $subject['teacher_id']])->getRow()->name;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $crudModel = new \App\Models\CrudModel();
                                    echo $crudModel->get_type_name_by_id('class', $subject['class_id']);

                                    // * Alternative
                                    // ? $db = Config::connect();
                                    // ? echo $db->table('class')->getWhere(['class_id' => $subject['class_id']])->getRow()->name;
                                    ?>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-rounded btn-sm"
                                        onclick="showModal('subject', <?= $subject['subject_id']; ?>)">Edit</button>
                                    <button class="btn btn-danger btn-rounded btn-sm"
                                        onclick="confirm_modal('<?= base_url('admin/subject/delete/' . $subject['subject_id']); ?>')">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "edit_subject.php"; ?>