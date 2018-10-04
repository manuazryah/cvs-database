<?php if (!empty($model)) { ?>
<table style="border: 1px solid black;width: 100%;border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border-collapse: collapse;border: 1px solid black;">Name</th>
                <th style="border-collapse: collapse;border: 1px solid black;">Email</th>
                <th style="border-collapse: collapse;border: 1px solid black;">Reference Number</th>
                <th style="border-collapse: collapse;border: 1px solid black;">Phone</th>
                <th style="border-collapse: collapse;border: 1px solid black;">Address</th>
                <th style="border-collapse: collapse;border: 1px solid black;">Alternate Phone</th>
                <th style="border-collapse: collapse;border: 1px solid black;">Alternate Address</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($model as $value) { ?>
            <tr>
                <td style="border-collapse: collapse;border: 1px solid black;"><?= $value->user_name ?></td>
                <td style="border-collapse: collapse;border: 1px solid black;"><?= $value->email ?></td>
                <td style="border-collapse: collapse;border: 1px solid black;"><?= $value->user_id ?></td>
                <td style="border-collapse: collapse;border: 1px solid black;"><?= $value->phone ?></td>
                <td style="border-collapse: collapse;border: 1px solid black;"><?= $value->address ?></td>
                <td style="border-collapse: collapse;border: 1px solid black;"><?= $value->alternate_phone ?></td>
                <td style="border-collapse: collapse;border: 1px solid black;"><?= $value->alternate_address ?></td>
            </tr>
          <?php  }
            ?>
        </tbody>
    </table>
    <?php
}
?>
