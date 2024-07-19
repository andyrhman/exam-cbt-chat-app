<div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataModalLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="dataForm" method="post">
                    <div class="form-group">
                        <label for="dataName"><?= get_phrase("Subject Name"); ?></label>
                        <input type="text" class="form-control" id="dataName" name="name">
                    </div>
                    <div class="form-group">
                        <label for="dataTeacher"><?= get_phrase("Teacher"); ?></label>
                        <select class="form-control" id="dataTeacher" name="teacher_id">
                            <!-- Options will be populated by JavaScript -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dataClass"><?= get_phrase("Class"); ?></label>
                        <select class="form-control" id="dataClass" name="class_id">
                            <!-- Options will be populated by JavaScript -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function showModal(data_type, id) {
        $.ajax({
            url: '<?= base_url('modal/popup/'); ?>' + data_type + '/' + id,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $('#dataForm').attr('action', '<?= base_url('admin/subject/update_subject/'); ?>' + id);
                $('#dataName').val(response.name);

                // * Teacher Data
                // Clear existing options in the select element
                $('#dataTeacher').empty();

                // Add an initial option
                $('#dataTeacher').append('<option value="">Select Teacher</option>');

                // Populate the select element with teachers
                $.ajax({
                    url: '<?= base_url('admin/teacher/get_all_teachers'); ?>',
                    type: 'GET',
                    dataType: 'json',
                    success: function (teachers) {
                        teachers.forEach(function (teacher) {
                            const selected = teacher.teacher_id == response.teacher_id ? 'selected' : '';
                            $('#dataTeacher').append('<option value="' + teacher.teacher_id + '" ' + selected + '>' + teacher.name + '</option>');
                        });
                    },
                    error: function () {
                        alert('Error loading teacher.');
                    }
                });

                // * Classroom data
                $('#dataClass').empty();

                $('#dataClass').append('<option value="">Select Classroom</option>');

                $.ajax({
                    url: '<?= base_url('admin/classes/get_all_classes'); ?>',
                    type: 'GET',
                    dataType: 'json',
                    success: function (classes) {
                        classes.forEach(function (c) {
                            const selected = c.class_id == response.class_id ? 'selected' : '';
                            $('#dataClass').append('<option value="' + c.class_id + '" ' + selected + '>' + c.name + '</option>');
                        });
                    },
                    error: function () {
                        alert('Error loading classroom.');
                    }
                });

                $('#dataModal').modal('show');
            },
            error: function () {
                alert('Error loading data.');
            }
        });
    }
</script>