<?php

use yii\helpers\Html;
use common\models\Vessel;
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
                <td class="labell">VESSEL-NAME </td><td class="value">:
                        <?php
                        if (isset($appointment->vessel)) {
                                $vessel = common\models\Ships::findOne($appointment->vessel);
                                if (isset($vessel))
                                        echo $vessel->name;
                        }
                        ?>

                </td>
                <td class="labell">PORT OF CALL </td><td class="value">:
                        <?php
                        if (isset($appointment->port_of_call)) {
                                $ports = common\models\Ports::findOne($appointment->port_of_call);
                                if (isset($ports))
                                        echo $ports->port_name;
                        }
                        ?>
                </td>
                <td class="labell">TERMINAL </td><td class="value">: <?= $appointment->terminal; ?> </td>
        </tr>

        <tr>
                <td class="labell">BERTH NUMBER </td><td class="value">: <?= $appointment->berth_number; ?> </td>
                <td class="labell">MATERIAL </td><td class="value">:
                        <?php
                        if (isset($appointment->material)) {
                                $material = common\models\Materials::findOne($appointment->material);
                                if (isset($material))
                                        echo $material->name;
                        }
                        ?>
                </td>
                <td class="labell">QUANTITY </td><td class="value">: <?= $appointment->quantity; ?> </td>

        </tr>

</table>

