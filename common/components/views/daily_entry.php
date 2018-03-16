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
                <td class="labell">Received Date </td><td class="value">:
                        <?= $daily_entry->received_date; ?>
                </td>
                <td class="labell">Material </td><td class="value">:
                        <?php
                        if (isset($daily_entry->material)) {
                                $material = common\models\Materials::findOne($daily_entry->material);
                                if (!empty($material))
                                        echo $material->name;
                        }
                        ?>
                </td>
                <td class="labell">Supplier </td>
                <td class="value">:
                        <?php
                        if (isset($daily_entry->supplier)) {
                                $supplier = common\models\Contacts::findOne($daily_entry->supplier);
                                if (!empty($supplier))
                                        echo $supplier->name;
                        }
                        ?>
                </td>
        </tr>

        <tr>
                <td class="labell">Transporter</td><td class="value">:
                        <?php
                        if (isset($daily_entry->transport)) {
                                $transport = common\models\Contacts::findOne($daily_entry->transport);
                                if (!empty($transport))
                                        echo $transport->name;
                        }
                        ?>
                </td>
                <td class="labell">Payment Status</td><td class="value">:
                        <?php
                        if (isset($daily_entry->payment_status)) {
                                if ($daily_entry->payment_status == 1) {
                                        echo 'Due';
                                } elseif ($daily_entry->payment_status == 2) {
                                        echo 'Paid';
                                } else {
                                        echo '';
                                }
                        }
                        ?>
                </td>
                <td class="labell">Yard</td><td class="value">:
                        <?php
                        if (isset($daily_entry->yard_id)) {
                                $yard = common\models\Yard::findOne($daily_entry->yard_id);
                                if (!empty($yard))
                                        echo $yard->name;
                        }
                        ?>
                </td>
        </tr>

</table>

