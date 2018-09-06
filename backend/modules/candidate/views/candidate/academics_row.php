<div class="append-box">
    <a class="ibtnDel remove"><i class="fa fa-close"></i></a>
    <div class="row">
        <div class="col-md-6">
            <div class="formrow">
                <select class="form-control" name="create[qualification][]">
                    <option value="">Select Qualification</option>
                    <?php foreach ($course_datas as $course_data) { ?>
                        <option value="<?= $course_data->id ?>"><?= $course_data->course_name ?></option>
                    <?php }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="formrow">
                <input type="text" class="form-control" name="create[course][]" placeholder="Course Name">
            </div>
        </div>
        <div class="col-md-12">
            <div class="formrow">
                <input type="text" class="form-control" name="create[college][]" placeholder="College / University">
            </div>
        </div>
        <div class="col-md-3">
            <div class="formrow">
                <input id="edu_from_date-<?= $j ?>" type="date" name="create[from_date][]" class="form-control edu-from-date" placeholder="Join From" value="<?= date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d')))); ?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="formrow">
                <input id="edu_to_date-<?= $j ?>" type="date" name="create[to_date][]" class="form-control edu-to-date" placeholder="Join From" value="<?= date('Y-m-d') ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="formrow">
                <select class="form-control" name="create[country][]">
                    <option value="">Select Country</option>
                    <?php foreach ($country_datas as $country_data) { ?>
                        <option value="<?= $country_data->id ?>"><?= $country_data->country_name ?></option>
                    <?php }
                    ?>
                </select>
            </div>
        </div>
    </div>
</div>