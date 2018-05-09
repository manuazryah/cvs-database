<?php

use dosamigos\ckeditor\CKEditor;
?>
<tr>
    <td>
        <input type="text" class="form-control" name="expcreate[designation][]">
    </td>
    <td>
        <input type="text" class="form-control" name="expcreate[company_name][]">
    </td>
    <td>
        <select class="form-control" name="expcreate[country][]">
            <option value="">Select Country</option>
            <?php foreach ($country_datas as $country_data) { ?>
                <option value="<?= $country_data->id ?>"><?= $country_data->country_name ?></option>
            <?php }
            ?>
        </select>
    </td>
    <td>
        <input type="date" name="expcreate[from_date][]" class="form-control">
    </td>
    <td>
        <input type="date" name="expcreate[to_date][]" class="form-control">
    </td>
    <td>
        <textarea name="expcreate[job_responsibility][]" rows="4"></textarea>
    </td>
    <td><a id="ibtnDele"><i class="fa fa-remove"></i></a></td>
</tr>
