<?php if (!empty($model)) { ?>
    <table style="border: 1px solid black;width: 100%;border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border-collapse: collapse;border: 1px solid black;">First Name</th>
                <th style="border-collapse: collapse;border: 1px solid black;">Last Name</th>
                <th style="border-collapse: collapse;border: 1px solid black;">Email</th>
                <th style="border-collapse: collapse;border: 1px solid black;">Phone</th>
                <th style="border-collapse: collapse;border: 1px solid black;">Company Name</th>
                <th style="border-collapse: collapse;border: 1px solid black;">Company Email</th>
                <th style="border-collapse: collapse;border: 1px solid black;">Company Phone</th>
                <th style="border-collapse: collapse;border: 1px solid black;">Position</th>
                <th style="border-collapse: collapse;border: 1px solid black;">Country</th>
                <th style="border-collapse: collapse;border: 1px solid black;">Location</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model as $value) { ?>
                <tr>
                    <td style="border-collapse: collapse;border: 1px solid black;"><?= $value->first_name ?></td>
                    <td style="border-collapse: collapse;border: 1px solid black;"><?= $value->last_name ?></td>
                    <td style="border-collapse: collapse;border: 1px solid black;"><?= $value->email ?></td>
                    <td style="border-collapse: collapse;border: 1px solid black;"><?= $value->phone ?></td>
                    <td style="border-collapse: collapse;border: 1px solid black;"><?= $value->company_name ?></td>
                    <td style="border-collapse: collapse;border: 1px solid black;"><?= $value->company_email ?></td>
                    <td style="border-collapse: collapse;border: 1px solid black;"><?= $value->company_phone_number ?></td>
                    <td style="border-collapse: collapse;border: 1px solid black;"><?= $value->position ?></td>
                    <td style="border-collapse: collapse;border: 1px solid black;"><?= $value->country != '' ? \common\models\Country::findOne($value->country)->country_name : '' ?></td>
                    <td style="border-collapse: collapse;border: 1px solid black;"><?= $value->location ?></td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
    <?php
}
?>
