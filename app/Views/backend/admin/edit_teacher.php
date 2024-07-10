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
                        <label for="dataName">Name</label>
                        <input type="text" class="form-control" id="dataName" name="name">
                    </div>
                    <div class="form-group">
                        <label for="dataEmail">Email</label>
                        <input type="email" class="form-control" id="dataEmail" name="email">
                    </div>
                    <div class="form-group">
                        <label for="dataPhone">Phone</label>
                        <input type="text" class="form-control" id="dataPhone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="currentImage">Current Image</label><br>
                        <img id="currentImage" src="" alt="Current Image" width="100" height="100"><br><br>
                    </div>
                    <div class="form-group">
                        <label for="dataImage">New Image</label>
                        <input type="file" class="form-control" id="dataImage" name="userfile"
                            onchange="previewImage(event);">
                        <img id="newImage" src="" alt="New Image" width="100" height="100"
                            style="display:none; margin-top: 10px;">
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>