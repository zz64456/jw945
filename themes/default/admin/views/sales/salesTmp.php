<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>
    $(document).ready(function () {
        // [庫存正常]
        oTable_sufficient_stock = $('#SLData').dataTable({
            "aaSorting": [[1, "desc"], [2, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?=lang('all')?>"]],
            "iDisplayLength": <?=$Settings->rows_per_page?>,
            'bProcessing': true,
            'bServerSide': true,
            'sAjaxSource': '<?=admin_url('sales/getSalesTmp/1/sufficient_stock'); ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?=$this->security->get_csrf_token_name()?>",
                    "value": "<?=$this->security->get_csrf_hash()?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                var oSettings = oTable_sufficient_stock.fnSettings();
                //$("td:first", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
                nRow.id = aData[0];
                // nRow.setAttribute('data-return-id', aData[11]);
                nRow.className = "invoice_link3";
                //if(aData[7] > aData[9]){ nRow.className = "product_link warning"; } else { nRow.className = "product_link"; }
                return nRow;
            },
            "aoColumns": [{"bSortable": false,"mRender": checkbox_for_tmp_1}, {"mRender": fld}, null, null, {"mRender": currencyFormat}, {"mRender": situation}, {"mRender": upload_status}],
            "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                var gtotal = 0, paid = 0, balance = 0;
                for (var i = 0; i < aaData.length; i++) {
                    gtotal += parseFloat(aaData[aiDisplay[i]][4]);
                }
                var nCells = nRow.getElementsByTagName('th');
                nCells[4].innerHTML = currencyFormat(parseFloat(gtotal));
            }
        }).fnSetFilteringDelay().dtFilter([
            {column_number: 1, filter_default_label: "[<?=lang('date');?> (yyyy-mm-dd)]", filter_type: "text", data: []},
            {column_number: 2, filter_default_label: "[<?=lang('reference_no');?>]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[<?=lang('customer');?>]", filter_type: "text", data: []},
            {column_number: 5, filter_default_label: "[<?=lang('sale_status');?>]", filter_type: "text", data: []},
            {column_number: 6, filter_default_label: "[<?=lang('upload_status');?>]", filter_type: "text", data: []},
        ], "footer");

        // [庫存不足]
        oTable_insufficient = $('#SLData1').dataTable({
            "aaSorting": [[1, "desc"], [2, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?=lang('all')?>"]],
            "iDisplayLength": <?=$Settings->rows_per_page?>,
            'bProcessing': true,
            'bServerSide': true,
            'sAjaxSource': '<?=admin_url('sales/getSalesTmp/1/insufficient_stock'); ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?=$this->security->get_csrf_token_name()?>",
                    "value": "<?=$this->security->get_csrf_hash()?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                var oSettings = oTable_insufficient.fnSettings();
                //$("td:first", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
                nRow.id = aData[0];
                // nRow.setAttribute('data-return-id', aData[11]);
                nRow.className = "invoice_link3";
                //if(aData[7] > aData[9]){ nRow.className = "product_link warning"; } else { nRow.className = "product_link"; }
                return nRow;
            },
            "aoColumns": [{"bSortable": false,"mRender": checkbox_for_tmp_2}, {"mRender": fld}, null, null, {"mRender": currencyFormat}, {"mRender": situation}, {"mRender": upload_status}],
            "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                var gtotal = 0, paid = 0, balance = 0;
                for (var i = 0; i < aaData.length; i++) {
                    gtotal += parseFloat(aaData[aiDisplay[i]][4]);
                }
                var nCells = nRow.getElementsByTagName('th');
                nCells[4].innerHTML = currencyFormat(parseFloat(gtotal));
            }
        }).fnSetFilteringDelay().dtFilter([
            {column_number: 1, filter_default_label: "[<?=lang('date');?> (yyyy-mm-dd)]", filter_type: "text", data: []},
            {column_number: 2, filter_default_label: "[<?=lang('reference_no');?>]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[<?=lang('customer');?>]", filter_type: "text", data: []},
            {column_number: 5, filter_default_label: "[<?=lang('sale_status');?>]", filter_type: "text", data: []},
            {column_number: 6, filter_default_label: "[<?=lang('upload_status');?>]", filter_type: "text", data: []},
        ], "footer");

        // [待確認]
        oTable_wait_to_check = $('#SLData2').dataTable({
            "aaSorting": [[1, "desc"], [2, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?=lang('all')?>"]],
            "iDisplayLength": <?=$Settings->rows_per_page?>,
            'bProcessing': true,
            'bServerSide': true,
            'sAjaxSource': '<?=admin_url('sales/getSalesTmp/1/wait_to_check'); ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?=$this->security->get_csrf_token_name()?>",
                    "value": "<?=$this->security->get_csrf_hash()?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                var oSettings = oTable_wait_to_check.fnSettings();
                //$("td:first", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
                nRow.id = aData[0];
                // nRow.setAttribute('data-return-id', aData[11]);
                nRow.className = "invoice_link3";
                //if(aData[7] > aData[9]){ nRow.className = "product_link warning"; } else { nRow.className = "product_link"; }
                return nRow;
            },
            "aoColumns": [{"bSortable": false,"mRender": checkbox_for_tmp_3}, {"mRender": fld}, null, null, {"mRender": currencyFormat}, {"mRender": situation}, {"mRender": upload_status}],
            "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                var gtotal = 0, paid = 0, balance = 0;
                for (var i = 0; i < aaData.length; i++) {
                    gtotal += parseFloat(aaData[aiDisplay[i]][4]);
                }
                var nCells = nRow.getElementsByTagName('th');
                nCells[4].innerHTML = currencyFormat(parseFloat(gtotal));
            }
        }).fnSetFilteringDelay().dtFilter([
            {column_number: 1, filter_default_label: "[<?=lang('date');?> (yyyy-mm-dd)]", filter_type: "text", data: []},
            {column_number: 2, filter_default_label: "[<?=lang('reference_no');?>]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[<?=lang('customer');?>]", filter_type: "text", data: []},
            {column_number: 5, filter_default_label: "[<?=lang('sale_status');?>]", filter_type: "text", data: []},
            {column_number: 6, filter_default_label: "[<?=lang('upload_status');?>]", filter_type: "text", data: []},
        ], "footer");
    });

</script>



<?php if ($Owner || $Admin || $GP['bulk_actions']) {
    echo admin_form_open('sales/sale_actions', 'id="action-form"');
} ?>
<div class="box">
    <?php if ($Owner || $Admin || $GP['bulk_actions']) { ?>
    <div class="box-header">
        <h2 class="blue">
            <i class="fa-fw fa fa-heart"></i><?=lang('sales_tmp');?>
        </h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang('actions') ?>"></i></a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li>
                            <a href="#" class="bpo" title="<b><?= $this->lang->line('upload_file') ?></b>" data-content="<p><?= lang('r_u_sure') ?></p><button type='button' class='btn btn-danger' id='upload' data-action='upload'><?= lang('i_m_sure') ?></a> <button class='btn bpo-close'><?= lang('no') ?></button>" data-html="true" data-placement="left">
                                <i class="fa fa-upload"></i>
                                <?= $this->lang->line('upload_file') ?>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <?php } ?>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <ul id="dbTab" class="nav nav-tabs">
                    <?php if ($Owner || $Admin || $GP['sales-add']) {
                        ?>
                        <li class=""><a href="#sufficient"><?= lang('sufficient_stock') ?></a></li>
                        <li class=""><a href="#insufficient"><?= lang('insufficient_stock') ?></a></li>
                        <li class=""><a href="#wait"><?= lang('wait_to_check') ?></a></li>
                        <?php
                    }
                        ?>
                </ul>


                <div class="tab-content">


                    <?php if ($Owner || $Admin || $GP['sales-add']) {
                    ?>
                    <div id="sufficient" class="tab-pane fade in">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table id="SLData" class="table table-bordered table-hover table-striped" cellpadding="0" cellspacing="0" border="0">
                                        <thead>
                                        <tr>
                                            <th style="min-width:30px; width: 3%; text-align: center;">
                                                <input class="checkbox checkft_1" type="checkbox" name="check"/>
                                            </th>
                                            <th><?= lang('date'); ?></th>
                                            <th><?= lang('reference_no'); ?></th>
                                            <th><?= lang('customer'); ?></th>
                                            <th><?= lang('grand_total'); ?></th>
                                            <th><?= lang('sale_status'); ?></th>
                                            <th><?= lang('upload_status'); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td colspan="12" class="dataTables_empty"><?= lang('loading_data'); ?></td>
                                        </tr>
                                        </tbody>
                                        <tfoot class="dtFilter">
                                        <tr class="active">
                                            <th style="min-width:30px; width: 3%; text-align: center;">
                                                <input class="checkbox checkft_1" type="checkbox" name="check"/>
                                            </th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    ?>

                    <?php if ($Owner || $Admin || $GP['sales-add']) {
                        ?>
                        <div id="insufficient" class="tab-pane fade in">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table id="SLData1" class="table table-bordered table-hover table-striped" cellpadding="0" cellspacing="0" border="0">
                                            <thead>
                                            <tr>
                                                <th style="min-width:30px; width: 3%; text-align: center;">
                                                    <input class="checkbox checkft_2" type="checkbox" name="check"/>
                                                </th>
                                                <th><?= lang('date'); ?></th>
                                                <th><?= lang('reference_no'); ?></th>
                                                <th><?= lang('customer'); ?></th>
                                                <th><?= lang('grand_total'); ?></th>
                                                <th><?= lang('sale_status'); ?></th>
                                                <th><?= lang('upload_status'); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td colspan="12" class="dataTables_empty"><?= lang('loading_data'); ?></td>
                                            </tr>
                                            </tbody>
                                            <tfoot class="dtFilter">
                                            <tr class="active">
                                                <th style="min-width:30px; width: 3%; text-align: center;">
                                                    <input class="checkbox checkft_2" type="checkbox" name="check"/>
                                                </th>
                                                <th></th><th></th><th></th>
                                                <th><?= lang('grand_total'); ?></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>



                    <?php if ($Owner || $Admin || $GP['sales-add']) {
                        ?>
                        <div id="wait" class="tab-pane fade in">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table id="SLData2" class="table table-bordered table-hover table-striped" cellpadding="0" cellspacing="0" border="0">
                                            <thead>
                                            <tr>
                                                <th style="min-width:30px; width: 3%; text-align: center;">
                                                    <input class="checkbox checkft_3" type="checkbox" name="check"/>
                                                </th>
                                                <th><?= lang('date'); ?></th>
                                                <th><?= lang('reference_no'); ?></th>
                                                <th><?= lang('customer'); ?></th>
                                                <th><?= lang('grand_total'); ?></th>
                                                <th><?= lang('sale_status'); ?></th>
                                                <th><?= lang('upload_status'); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td colspan="12" class="dataTables_empty"><?= lang('loading_data'); ?></td>
                                            </tr>
                                            </tbody>
                                            <tfoot class="dtFilter">
                                            <tr class="active">
                                                <th style="min-width:30px; width: 3%; text-align: center;">
                                                    <input class="checkbox checkft_3" type="checkbox" name="check"/>
                                                </th>
                                                <th></th><th></th><th></th>
                                                <th><?= lang('grand_total'); ?></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($Owner || $Admin || $GP['bulk_actions']) {
    ?>
    <div style="display: none;">
        <input type="hidden" name="form_action" value="" id="form_action"/>
        <?= form_submit('performAction', 'performAction', 'id="action-form-submit"') ?>
    </div>
    <?= form_close() ?>

    <script language="javascript">
        $(document).ready(function () {
            $('#set_admin').click(function () {
                $('#usr-form-btn').trigger('click');
            });

        });
    </script>

    <?php
} ?>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i><?= lang('add_sale_by_csv'); ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <?php
                $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
                echo admin_form_open_multipart('sales/salesTmp', $attrib);
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
                        <?php if ($Owner || $Admin || $GP['sales-delete']) { ?>
                        <a href="<?php echo admin_url('sales/deleteTmps/'); ?>" class="btn btn-danger pull-right" >
                            <i class="icon-download icon-white"></i><?= lang('delete_all'); ?>
                        </a>
                        <?php } ?>
                        <div class="col-md-12">
                            <div class="fprom-group">
                                <?php echo form_submit('add_sale', $this->lang->line('submit'), 'id="add_sale" class="btn btn-primary" style="padding: 6px 15px; margin:15px 0;"'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>