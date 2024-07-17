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
                        <label for="dataName"><?= get_phrase("Class Name"); ?></label>
                        <input type="text" class="form-control" id="dataName" name="name">
                    </div>
                    <div class="form-group">
                        <label for="dataNickName"><?= get_phrase("Nick Name"); ?></label>
                        <input type="text" class="form-control" id="dataNickName" name="name_numeric">
                    </div>
                    <div class="form-group">
                        <label for="dataTeacher"><?= get_phrase("Teacher"); ?></label>
                        <select class="form-control" id="dataTeacher" name="teacher_id">
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
            success: function(response) {
                $('#dataForm').attr('action', '<?= base_url('admin/classes/update_class/'); ?>' + id);
                $('#dataName').val(response.name);
                $('#dataNickName').val(response.name_numeric);

                // Clear existing options in the select element
                $('#dataTeacher').empty();

                // Add an initial option
                $('#dataTeacher').append('<option value="">Select Teacher</option>');

                // Populate the select element with teachers
                $.ajax({
                    url: '<?= base_url('admin/classes/get_all_teachers'); ?>',
                    type: 'GET',
                    dataType: 'json',
                    success: function(teachers) {
                        teachers.forEach(function(teacher) {
                            const selected = teacher.teacher_id == response.teacher_id ? 'selected' : '';
                            $('#dataTeacher').append('<option value="' + teacher.teacher_id + '" ' + selected + '>' + teacher.name + '</option>');
                        });
                    },
                    error: function() {
                        alert('Error loading teachers.');
                    }
                });

                $('#dataModal').modal('show');
            },
            error: function() {
                alert('Error loading data.');
            }
        });
    }
</script>
