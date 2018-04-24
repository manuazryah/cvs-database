<?php ?>
<form id="move-folder-form" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Rename</h4>
    </div>

    <div class="modal-body">
        <div class="form-group">
            <label for="field-1" class="control-label">New Folder Name</label>
            <input type="hidden" class="form-control" id="candidate_id" value="<?= $candidate_id ?>">
            <input type="text" class="form-control" id="new-folder_name" value="" required>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-info">Move</button>
    </div>
</form>