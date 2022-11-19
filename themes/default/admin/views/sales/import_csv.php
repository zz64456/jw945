<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-tasks"></i> <?= lang('import_data') ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-md-12">

                <ul id="dbTab" class="nav nav-tabs">
                    <?php if ($Owner || $Admin || $GP['sufficient_stock-index']) {
                        ?>
                        <li class=""><a href="#sales"><?= lang('sufficient_stock') ?></a></li>
                        <?php
                    } if ($Owner || $Admin || $GP['insufficient_stock-index']) {
                        ?>
                        <li class=""><a href="#sales"><?= lang('insufficient_stock') ?></a></li>
                        <?php
                    } if ($Owner || $Admin || $GP['wait_to_check-index']) {
                        ?>
                        <li class=""><a href="#purchases"><?= lang('wait_to_check') ?></a></li>
                        <?php
                    } ?>
                </ul>

                <div class="tab-content">
                    <?php if ($Owner || $Admin || $GP['sufficient_stock-index']) {
                        ?>

                        <div id="sales" class="tab-pane fade in">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table id="sales-tbl" cellpadding="0" cellspacing="0" border="0"
                                               class="table table-bordered table-hover table-striped"
                                               style="margin-bottom: 0;">
                                            <thead>
                                            <tr>
                                                <th style="width:30px !important;">#</th>
                                                <th><?= $this->lang->line('date'); ?></th>
                                                <th><?= $this->lang->line('reference_no'); ?></th>
                                                <th><?= $this->lang->line('customer'); ?></th>
                                                <th><?= $this->lang->line('total'); ?></th>
                                                <th><?= $this->lang->line('status'); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if (!empty($sales)) {
                                                $r = 1;
                                                foreach ($sales as $order) {
                                                    echo '<tr id="' . $order->id . '" class="' . ($order->pos ? 'receipt_link' : 'invoice_link') . '"><td>' . $r . '</td>
                                                            <td>' . $this->sma->hrld($order->date) . '</td>
                                                            <td>' . $order->reference_no . '</td>
                                                            <td>' . $order->customer . '</td>
                                                            <td>' . row_status($order->sale_status) . '</td>
                                                            <td class="text-right">' . $this->sma->formatMoney($order->grand_total) . '</td>
                                                            <td>' . row_status($order->payment_status) . '</td>
                                                            <td class="text-right">' . $this->sma->formatMoney($order->paid) . '</td>
                                                        </tr>';
                                                    $r++;
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="7"
                                                        class="dataTables_empty"><?= lang('no_data_available') ?></td>
                                                </tr>
                                                <?php
                                            } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    } if ($Owner || $Admin || $GP['insufficient_stock-index']) {
                        ?>

                        <div id="quotes" class="tab-pane fade">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table id="quotes-tbl" cellpadding="0" cellspacing="0" border="0"
                                               class="table table-bordered table-hover table-striped"
                                               style="margin-bottom: 0;">
                                            <thead>
                                            <tr>
                                                <th style="width:30px !important;">#</th>
                                                <th><?= $this->lang->line('date'); ?></th>
                                                <th><?= $this->lang->line('reference_no'); ?></th>
                                                <th><?= $this->lang->line('customer'); ?></th>
                                                <th><?= $this->lang->line('status'); ?></th>
                                                <th><?= $this->lang->line('amount'); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if (!empty($quotes)) {
                                                $r = 1;
                                                foreach ($quotes as $quote) {
                                                    echo '<tr id="' . $quote->id . '" class="quote_link"><td>' . $r . '</td>
                                                        <td>' . $this->sma->hrld($quote->date) . '</td>
                                                        <td>' . $quote->reference_no . '</td>
                                                        <td>' . $quote->customer . '</td>
                                                        <td>' . row_status($quote->status) . '</td>
                                                        <td class="text-right">' . $this->sma->formatMoney($quote->grand_total) . '</td>
                                                    </tr>';
                                                    $r++;
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="6"
                                                        class="dataTables_empty"><?= lang('no_data_available') ?></td>
                                                </tr>
                                                <?php
                                            } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        } if ($Owner || $Admin || $GP['wait_to_check-index']) {
                        ?>
                        <div id="purchases" class="tab-pane fade in">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table id="purchases-tbl" cellpadding="0" cellspacing="0" border="0"
                                               class="table table-bordered table-hover table-striped"
                                               style="margin-bottom: 0;">
                                            <thead>
                                            <tr>
                                                <th style="width:30px !important;">#</th>
                                                <th><?= $this->lang->line('date'); ?></th>
                                                <th><?= $this->lang->line('reference_no'); ?></th>
                                                <th><?= $this->lang->line('supplier'); ?></th>
                                                <th><?= $this->lang->line('status'); ?></th>
                                                <th><?= $this->lang->line('amount'); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if (!empty($purchases)) {
                                                $r = 1;
                                                foreach ($purchases as $purchase) {
                                                    echo '<tr id="' . $purchase->id . '" class="purchase_link"><td>' . $r . '</td>
                                                    <td>' . $this->sma->hrld($purchase->date) . '</td>
                                                    <td>' . $purchase->reference_no . '</td>
                                                    <td>' . $purchase->supplier . '</td>
                                                    <td>' . row_status($purchase->status) . '</td>
                                                    <td class="text-right">' . $this->sma->formatMoney($purchase->grand_total) . '</td>
                                                </tr>';
                                                    $r++;
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="6"
                                                        class="dataTables_empty"><?= lang('no_data_available') ?></td>
                                                </tr>
                                                <?php
                                            } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i><?= lang('import_csv'); ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <?php
                $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
                echo admin_form_open_multipart('sales/import_csv', $attrib);
                ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= lang('csv_file', 'csv_file') ?>
                                <input id="csv_file" type="file" data-browse-label="<?= lang('browse'); ?>" name="userfile" required="required"
                                       data-show-upload="false" data-show-preview="false" class="form-control file">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="fprom-group">
                                <?php echo form_submit('add_sale', $this->lang->line('submit'), 'id="add_sale" class="btn btn-primary" style="padding: 6px 15px; margin:15px 0;"'); ?>
<!--                                <button type="button" class="btn btn-danger" id="reset">--><?//= lang('reset') ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo form_close(); ?>

            </div>

        </div>
    </div>
</div>