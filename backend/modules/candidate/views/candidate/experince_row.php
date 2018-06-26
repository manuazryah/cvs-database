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
                <label for="chkispresent">
                    <input type="checkbox" id="chkispresent-<?= $i ?>" class="chkispresent" name="expcreate[present_status][]"/>
                    I currently work here
                </label>
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
                <textarea class="textarea form-control" name="expcreate[job_responsibility][]" placeholder="Job Responsibility" style="width:100%;height: 150px;"></textarea>
            </div>
        </div>
    </div>
</div>
