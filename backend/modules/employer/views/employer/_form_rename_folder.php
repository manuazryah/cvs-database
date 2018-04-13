<?php ?>
<form id="rename-form" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Rename</h4>
    </div>

    <div class="modal-body">
        <div class="form-group">
            <label for="field-1" class="control-label">New Folder Name</label>
            <input type="hidden" class="form-control" id="old-folder_name" value="<?= $folder_name ?>">
            <input type="hidden" class="form-control" id="emp_id" value="<?= $id ?>">
            <input type="text" class="form-control" id="new-folder_name" value="<?= $folder_name ?>">
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-info">Rename</button>
    </div>
</form>