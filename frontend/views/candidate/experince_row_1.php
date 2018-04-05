<?php

use dosamigos\ckeditor\CKEditor;
?>
<tr>
    <td>
        <input type="text" class="form-control" name="expcreate[company_name][]">
    </td>
    <td>
        <input type="text" class="form-control" name="expcreate[designation][]">
    </td>
    <td>
        <input type="date" name="expcreate[from_date][]" class="form-control">
    </td>
    <td>
        <input type="date" name="expcreate[to_date][]" class="form-control">
    </td>
    <td>
        <?=
        CKEditor::widget([
            'name' => 'expcreate[job_responsibility][]',
            'id' => 'expcreate-responsibility',
            'options' => ['rows' => 0],
            'preset' => 'basic',
            'clientOptions' => ['height' => 100]
        ]);
        ?>
    </td>
    <td><a id="ibtnDele"><i class="fa fa-remove"></i></a></td>
</tr>
