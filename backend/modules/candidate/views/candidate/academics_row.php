<tr>
    <td>
        <select class="form-control" name="create[course][]">
            <option value="">Select Course</option>
            <?php foreach ($course_datas as $course_data) { ?>
                <option value="<?= $course_data->id ?>"><?= $course_data->course_name ?></option>
            <?php }
            ?>
        </select>
    </td>
    <td>
        <input type="text" class="form-control" name="create[college][]">
    </td>
    <td>
        <select class="form-control" name="create[country][]">
            <option value="">Select Country</option>
            <?php foreach ($country_datas as $country_data) { ?>
                <option value="<?= $country_data->id ?>"><?= $country_data->country_name ?></option>
            <?php }
            ?>
        </select>
    </td>
    <td>
        <input type="date" name="create[from_date][]" class="form-control">
    </td>
    <td>
        <input type="date" name="create[to_date][]" class="form-control">
    </td>
    <td><a id="ibtnDel" class="eduremove"><i class="fa fa-remove"></i></a></td>
</tr>
