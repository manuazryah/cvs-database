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
                <textarea class="form-control" name="about-company" placeholder="Job Responsibility"></textarea>
            </div>
        </div>
    </div>
</div>
