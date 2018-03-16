<?php

use yii\helpers\Html;
?>
<style>
    .appoint{
        width: 100%;
    }
    .appoint .value{
        font-weight: bold;
        text-align: left;
    }
    .appoint .labell{
        text-align: left;
    }
    .appoint .colen{

    }
    .appoint td{
        padding: 10px;

    }
    .appoint  .labell{
        width:10% !important;
    }
</style>
<table class="appoint">
    <tr>
        <td class="labell">DATE </td><td class="value">:
            <?= $Order->date; ?>
        </td>
        <td class="labell">VESSEL-NAME </td><td class="value">:
            <?php
            if (isset($Order->vessel)) {
                $vessel = common\models\Ships::findOne($Order->vessel);
                if (isset($vessel))
                    echo $vessel->name;
            }
            ?>

        </td>
        <td class="labell">REFERENCE NO </td><td class="value">:
            <?= $Order->reference_no; ?>
        </td>
    </tr>
    <tr>
        <td class="labell">QUATATION REF NO </td><td class="value">:
            <?= $Order->invoice_no; ?>
        </td>
        <td class="labell">APPOINTMENT NO </td><td class="value">:
            <?php
            if (isset($Order->appointment_no)) {
                $appointment_no = \common\models\Appointment::findOne($Order->appointment_no);
                if (isset($appointment_no))
                    echo $appointment_no->appointment_number;
            }
            ?>
        </td>
        <td class="labell">SUPPLIER-NAME </td><td class="value">:
            <?php
            if (isset($Order->attenssion)) {
                $contacts = common\models\Contacts::findOne($Order->attenssion);
                if (isset($contacts))
                    echo $contacts->name;
            }
            ?>

        </td>
    </tr>

</table>


