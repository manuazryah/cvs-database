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
                <input id="exp_from_date-<?= $i ?>" type="date" name="expcreate[from_date][]" class="form-control exp-from-date" placeholder="Join From" value="<?= date('Y-m-d', strtotime('-1 month')) ?>">
                <input id="exp_present_status-<?= $i ?>" type="hidden" name="expcreate[present_status][]" class="form-control exp-from-date" placeholder="Join From" value="">
                                                            <input id="exp_present_status_btn-<?= $i ?>" type="radio" name="present_status" value="male"> I Currently Work Here
            </div>
        </div>
        <div class="col-md-3">
            <div id="ispresent-<?= $i ?>" class="ispresent" style="display: none">
                Present
            </div>
            <div id="notpresent-<?= $i ?>" class="notpresent">
                <input id="exp_to_date-<?= $i ?>"  type="date" name="expcreate[to_date][]" class="form-control exp-to-date" placeholder="End on" value="<?= date('Y-m-d')?>">
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
                <textarea class="textarea form-control" name="expcreate[job_responsibility][]" placeholder="Job Responsibility"></textarea>
            </div>
        </div>
    </div>
</div>
