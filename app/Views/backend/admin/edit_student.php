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
                <form id="dataForm" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="dataName"><?= get_phrase("Student Name"); ?></label>
                        <input type="text" class="form-control" id="dataName" name="name">
                    </div>
                    <div class="form-group">
                        <label for="dataEmail"><?= get_phrase("Student Email"); ?></label>
                        <input type="email" class="form-control" id="dataEmail" name="email">
                    </div>
                    <div class="form-group">
                        <label for="dataPhone"><?= get_phrase("Student Phone"); ?></label>
                        <input type="text" class="form-control" id="dataPhone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Student Gender"); ?></label>
                        <input type="text" class="form-control" id="dataGender" name="sex" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Student Address"); ?></label>
                        <input type="text" class="form-control" id="dataAddress" name="address" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Class"); ?></label>
                        <select name="class_id" class="form-control" id="dataClass" onchange="get_class_sections_edit(this.value);">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= get_phrase("Section"); ?></label>
                        <select name="section_id" id="section_holder" class="form-control">
                            <option value="">Select Class First</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="currentImage">Current Image</label><br>
                        <img id="currentImage" src="" alt="Current Image" width="100" height="100"><br><br>
                    </div>
                    <div class="form-group">
                        <label for="dataImage">New Image</label>
                        <input type="file" class="form-control" id="dataImage" name="userfile" onchange="previewImageEdit(event);">
                        <img id="newImageEdit" src="" alt="New Image" width="100" height="100" style="display:none; margin-top: 10px;">
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function get_class_sections_edit(class_id) {
        $.ajax({
            url: '<?= base_url('admin/get_class_sections/') ?>' + class_id,
            type: 'GET',
            success: function(response) {
                console.log('Response:', response); // Debugging line to check the response
                if (response.trim() === '') {
                    $('#section_holder').html('<option value="">No Sections Available</option>');
                    $('#section_holder').prop('disabled', true);
                } else {
                    $('#section_holder').html(response);
                    $('#section_holder').prop('disabled', false);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
                console.error('Status: ' + status);
                console.error('Response: ' + xhr.responseText);
            }
        });
    }

    function showModal(data_type, id) {
        $.ajax({
            url: '<?= base_url('modal/popup/'); ?>' + data_type + '/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    alert(response.error);
                    return;
                }
                $('#dataForm').attr('action', '<?= base_url('admin/student/update_student/'); ?>' + id);
                $('#dataName').val(response.name);
                $('#dataEmail').val(response.email);
                $('#dataPhone').val(response.phone);
                $('#dataGender').val(response.sex);
                $('#dataAddress').val(response.address);

                // * Classroom data
                $('#dataClass').empty();
                $('#dataClass').append('<option value="">Select Classroom</option>');

                $.ajax({
                    url: '<?= base_url('admin/classes/get_all_classes'); ?>',
                    type: 'GET',
                    dataType: 'json',
                    success: function(classes) {
                        classes.forEach(function(c) {
                            const selected = c.class_id == response.class_id ? 'selected' : '';
                            $('#dataClass').append('<option value="' + c.class_id + '" ' + selected + '>' + c.name + '</option>');
                        });

                        // Populate sections if class is already selected
                        if (response.class_id) {
                            get_class_sections(response.class_id);
                        }
                    },
                    error: function() {
                        alert('Error loading classroom.');
                    }
                });

                $('#currentImage').attr('src', '<?= base_url('uploads/student_image/'); ?>' + id + '.jpg');
                $('#dataModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
                console.error('Status: ' + status);
                console.error('Response: ' + xhr.responseText);
                alert('Error loading data.');
            }
        });
    }
</script>