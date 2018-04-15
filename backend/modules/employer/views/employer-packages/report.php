<?php ?>
<div id="print">
    <style type="text/css">
        tfoot{display: table-footer-group;}
        table { page-break-inside:auto;}
        tr{ page-break-inside:avoid; page-break-after:auto; }

        @page {
            size: A4;
        }
        @media print {
            thead {display: table-header-group;}
            tfoot {display: table-footer-group}
            /*tfoot {position: absolute;bottom: 0px;}*/
            .main-tabl{width: 100%}
            .footer {position: fixed ; left: 0px; bottom: 0px; right: 0px; font-size:10px; }
            .main-tabl{
                -webkit-print-color-adjust: exact;
                margin: auto;
                /*tr{ page-break-inside:avoid; page-break-after:auto; }*/
            }

        }
        @media screen{
            .main-tabl{
                width: 60%;
            }
        }
        body h6,h1,h2,h3,h4,h5,p,b,tr,td,span,div{
            color:#525252 !important;
        }
        .main-tabl{
            margin: auto;
        }
        .main-left{
            float: left;
        }
        .main-right{
            float: right;

        }
        .heading{
            width: 100%;
            text-align: center;
            font-weight: bold;
            font-size: 17px;
        }
        .print{
            margin-top: 20px;
            margin-left: 530px;
        }
        .save{
            margin-top: 18px;
            margin-left: 6px !important;
        }
        .heading p{
            font-size: 11px;
            line-height: 5px;
        }
        .left-address p{
            font-size: 11px;
            line-height: 5px;
        }
        .footer {
            width: 100%;
            display: inline-block;
            font-size: 15px;
            color: #4e4e4e;
            border-top: 1px solid #a09c9c;
            padding: 9px 0px 3px 0px;
        }
        .footer p {
            text-align: center;
            font-size: 9px;
            margin: 0px !important;
            color: #525252 !important;
            font-weight: 600;
        }
        .invoice-head p{
            line-height: 0px;
        }
        .invoice-head{
            padding: 0px 15px;
        }
    </style>
    <table class="main-tabl" border="0" style="font-family: Roboto, sans-serif !important;">
        <thead>
            <tr>
                <th style="width:100%">
                    <div class="header">
                        <div style="text-align:center;">
                            <img width="" height="" src="<?= Yii::$app->homeUrl ?>../dash/images/site-logo.png"/>
                        </div>
                        <br/>
                    </div>
                </th>
            </tr>

        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="heading"><h2 style="font-size:17px;letter-spacing: 4px;padding-top: 10px;">INVOICE</h2></div>
                    <br/>
                    <div class="close-estimate-heading-top" style="margin-bottom:30px;">
                        <div class="main-left left-address" style="padding-top: 10px;">
                            <table class="tb2">
                                <tr>
                                    <td style="max-width: 405px;font-size: 11px;">
                                        <p><strong><?= $employer->company_name ?></strong></p>
                                        <p><?= $employer->address ?></p>
                                        <p><?= $employer->location ?> , <?= $employer->country != '' ? common\models\Country::findOne($employer->country)->country_name : '' ?></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right" style="">
                            <table class="tb2">
                                <tr>
                                    <td style="max-width: 405px;">
                                        <table>
                                            <tr style="font-size: 11px;">
                                                <td>Phone No</td>
                                                <td style="padding: 0px 10px;">:</td>
                                                <td><?= $employer->company_phone_number ?></td>
                                            </tr>
                                            <tr style="font-size: 11px;">
                                                <td>Email</td>
                                                <td style="padding: 0px 10px;">:</td>
                                                <td><?= $employer->company_email ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br/>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="invoice-details"style="margin-top: 10px;min-height: 300px;">
                        <table style="width:100%;border-collapse: collapse;text-align: center;">
                            <tr style="background: #4e5254;color: white !important;">
                                <th style="font-size: 12px;padding: 10px 5px;">Package Name</th>
                                <th style="font-size: 12px;padding: 10px 2px;">Transaction</th>
                                <th style="font-size: 12px;padding: 10px 2px;">Start Date</th>
                                <th style="font-size: 12px;padding: 10px 2px;">End Date</th>
                                <th style="font-size: 12px;padding: 10px 2px;">Credit Remaining</th>
                                <th style="font-size: 12px;padding: 10px 2px;">Status</th>
                                <th style="font-size: 12px;padding: 10px 2px;">Amount</th>
                            </tr>
                            <tr>
                                <td style="font-size: 12px;padding: 10px 5px;"><?= $package->package_name ?></td>
                                <td style="font-size: 12px;padding: 10px 2px;"><?= $package_history->transaction_id ?></td>
                                <td style="font-size: 12px;padding: 10px 2px;"><?= $package_history->start_date ?></td>
                                <td style="font-size: 12px;padding: 10px 2px;"><?= $package_history->end_date ?></td>
                                <td style="font-size: 12px;padding: 10px 2px;"><?= $package_history->remaining_credits ?> / <?= $package_history->total_credits ?></td>
                                <td style="font-size: 12px;padding: 10px 2px;">
                                    <?php
                                    if ($package_history->status == 0) {
                                        echo 'Expired / 0 Credits Remaining';
                                    } else {
                                        echo '';
                                    }
                                    ?>
                                </td>
                                <td style="font-size: 12px;padding: 10px 2px;"><?= $package->package_price ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="invoice-details"style="margin-top: 10px;">
                        <table style="width:100%;border-collapse: collapse;text-align: left;">
                            <tr style="border-top: 1px solid #a09c9c;">
                                <th style="font-size: 12px;padding: 10px 2px;"></th>
                                <th style="font-size: 12px;padding: 10px 2px;"></th>
                                <th style="font-size: 12px;padding: 10px 2px;"></th>
                                <th style="font-size: 12px;padding: 10px 2px;"></th>
                                <th style="font-size: 12px;padding: 10px 2px;"></th>
                                <th style="font-size: 12px;padding: 10px 2px;"></th>
                                <th style="font-size: 12px;padding: 10px 2px;"></th>
                            </tr>
                            <tr>
                                <th style="width: 10%;font-size: 12px;padding: 10px 2px;"></th>
                                <th style="width: 10%;font-size: 12px;padding: 10px 2px;"></th>
                                <th style="width: 10%;font-size: 12px;padding: 10px 2px;"></th>
                                <th style="width: 10%;font-size: 12px;padding: 10px 2px;"></th>
                                <th style="width: 10%;font-size: 12px;padding: 10px 2px;"></th>
                                <th style="width: 40%;font-size: 12px;padding: 10px 2px;background: #4e5254;color: white;text-align: right;">Total</th>
                                <th style="font-size: 12px;padding: 10px 8px;background: #4e5254;color: white;text-align: right;"><?= $package->package_price ?></th>
                            </tr>
                            <tr style="">
                                <th colspan="7" style="width: 100%;font-size: 12px;padding: 10px 2px;text-align: right;"><?php echo ucwords(Yii::$app->NumToWord->ConvertNumberToWords($package->package_price)) . ' Only'; ?></th>
                            </tr>
                        </table>
                    </div>
                    <div style="clear:both"></div>
                </td></tr>
        </tbody>
        <tfoot>
            <tr>
                <td style="width:100%">
                    <div class="footer">
                        <span>
                            <p style="font-size:11px;font-weight: 600;">Package Invoice</p>
                        </span>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
<script>
    function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
        window.close();
    }
</script>
<div class="print">
    <?php
    if ($print) {
        ?>
        <button onclick="printContent('print')" style="font-weight: bold !important;">Print</button>
        <?php
    }
    ?>
    <button onclick="window.close();" style="font-weight: bold !important;">Close</button>
</div>