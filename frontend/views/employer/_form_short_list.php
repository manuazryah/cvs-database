<form id="shortlist-form" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Shortlist CV</h4>
    </div>

    <div class="modal-body">
        <div class="form-group">
            <label for="field-1" class="control-label">Choose Folder Name</label>

            <input type="hidden" class="form-control" id="shortlist-candate_id" value="<?= $candidate_id ?>">
            <input type="text" class="form-control" id="shortlist-folder_name" placeholder="Folder Name">
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-info">Submit</button>
    </div>
</form>