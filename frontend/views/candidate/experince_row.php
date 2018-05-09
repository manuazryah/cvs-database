<div class="append-box">
    <a class="ibtnDele remove"><i class="fa fa-close"></i></a>
    <div class="row">
        <div class="col-md-6">
            <div class="formrow">
                <input type="text" name="expcreate[company_name][]" class="form-control" placeholder="Company">
            </div>
        </div>
        <div class="col-md-6">
            <div class="formrow">
                <input type="text" name="expcreate[designation][]" class="form-control" placeholder="Designation">
            </div>
        </div>
        <div class="col-md-3">
            <div class="formrow">
                <input type="date" name="expcreate[from_date][]" class="form-control" placeholder="Join From">
            </div>
        </div>
        <div class="col-md-3">
            <div class="formrow">
                <input type="date" name="expcreate[to_date][]" class="form-control" placeholder="End on">
            </div>
        </div>
        <div class="col-md-6">
            <div class="formrow">
                <select class="form-control" name="expcreate[country][]">
                    <option value="">Select Country</option>
                    <?php foreach ($country_datas as $country_data) { ?>
                        <option value="<?= $country_data->id ?>"><?= $country_data->country_name ?></option>
                    <?php }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="formrow">
                <textarea name="expcreate[job_responsibility][]"  id="position-description" class="ember-text-area pe-form-field__textarea ember-view" data-gramm="true" data-txt_gramm_id="34c8503a-4791-55af-a79a-9f7626398fb9" data-gramm_id="34c8503a-4791-55af-a79a-9f7626398fb9" spellcheck="false" data-gramm_editor="true" style="z-index: auto; position: relative; line-height: 20px; font-size: 14px; transition: none; background: transparent !important;" placeholder="Job Responsibility"><?= $datas->job_responsibility ?></textarea>
            </div>
        </div>
    </div>
</div>
