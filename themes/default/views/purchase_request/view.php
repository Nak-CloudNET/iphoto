<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-file"></i><?= lang("purchases_request_no") . '. ' . $inv->id; ?></h2>

        <div class="box-icon">
            <ul class="btn-tasks">
            <?php if ($Owner || $Admin || $GP['purchase_request-edit'] || $GP['purchase_request-export']) { ?>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang("actions") ?>"></i>
                    </a>
                    <ul class="dropdown-menu pull-right" class="tasks-menus" role="menu" aria-labelledby="dLabel">
                        <?php if ($inv->attachment) { ?>
                            <li>
                                <a href="<?= site_url('welcome/download/' . $inv->attachment) ?>">
                                    <i class="fa fa-chain"></i> <?= lang('attachment') ?>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($inv->status != 'approved') { ?>
                        <?php if($Owner || $Admin || $GP['purchase_request-edit']) { ?>
                        <li>
                            <a href="<?= site_url('purchases_request/edit/' . $inv->id) ?>">
                                <i class="fa fa-edit"></i> <?= lang('edit_purchase') ?>
                            </a>
                        </li>
                        <?php } ?>
                        <?php } ?>
						<?php if($Owner || $Admin || $GP['purchase_request-export']) { ?>
                        <li>
                            <a href="<?= site_url('purchases_request/pdf/' . $inv->id) ?>">
                                <i class="fa fa-file-pdf-o"></i> <?= lang('export_to_pdf') ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="print-only col-xs-12">
                    <img src="<?= base_url() . 'assets/uploads/logos/' . $Settings->logo; ?>"
                         alt="<?= $Settings->site_name; ?>">
                </div>
                <div class="well well-sm">
                    <div class="col-xs-4 border-right">

                        <div class="col-xs-2"><i class="fa fa-3x fa-building padding010 text-muted"></i></div>
                        <div class="col-xs-10">
                            <h2 class=""><?= $supplier->company ? $supplier->company : $supplier->name; ?></h2>
                            <?= "Attn: " . $supplier->name ?>

                            <?php
                            echo ($supplier->address ? '<br>'.lang("address") . ": " .$supplier->address : '') . ($supplier->city ? '<br>'.$supplier->city :''). ($supplier->postal_code ? " " .$supplier->postal_code :''). ($supplier->state ? " " .$supplier->state : '') . ($supplier->country ? '<br>' .$supplier->country :'');

                            // echo "<p>";

                            // if ($supplier->cf1 != "-" && $supplier->cf1 != "") {
                            //     echo "<br>" . lang("scf1") . ": " . $supplier->cf1;
                            // }
                            // if ($supplier->cf2 != "-" && $supplier->cf2 != "") {
                            //     echo "<br>" . lang("scf2") . ": " . $supplier->cf2;
                            // }
                            // if ($supplier->cf3 != "-" && $supplier->cf3 != "") {
                            //     echo "<br>" . lang("scf3") . ": " . $supplier->cf3;
                            // }
                            // if ($supplier->cf4 != "-" && $supplier->cf4 != "") {
                            //     echo "<br>" . lang("scf4") . ": " . $supplier->cf4;
                            // }
                            // if ($supplier->cf5 != "-" && $supplier->cf5 != "") {
                            //     echo "<br>" . lang("scf5") . ": " . $supplier->cf5;
                            // }
                            // if ($supplier->cf6 != "-" && $supplier->cf6 != "") {
                            //     echo "<br>" . lang("scf6") . ": " . $supplier->cf6;
                            // }

                            // echo "</p>";
                            echo ($supplier->phone ? "<br>" .lang("tel") . ": " . $supplier->phone : '').($supplier->email? "<br />" . lang("email") . ": " . $supplier->email :'');
                            ?>
                        </div>
                        <div class="clearfix"></div>

                    </div>
                    <div class="col-xs-4">

                        <div class="col-xs-2"><i class="fa fa-3x fa-truck padding010 text-muted"></i></div>
                        <div class="col-xs-10">
                            <h2 class=""><?= $inv->company; ?></h2>
                            <?= "Attn: " . $inv->username; ?>
                            <?=($warehouse->address ? "<br>".lang("address") . ": " .$warehouse->address." " : ''). ($warehouse->city ? $warehouse->city . " " . $warehouse->postal_code . " " . $warehouse->state . " " : '') . ($warehouse->country ? $warehouse->country : ''); ?>
                            <?php
                            echo ($warehouse->phone ? "<br>".lang("tel") . ": " . $warehouse->phone : '') . ($warehouse->email ? "<br>".lang("email") . ": " . $warehouse->email : '');
                            ?>
                            <?= '<br>'.lang("warehouse").": ".$inv->ware_name ?>
                        </div>
                        <div class="clearfix"></div>


                    </div>
                    <div class="col-xs-4 border-left">

                        <div class="col-xs-2"><i class="fa fa-3x fa-file-text-o padding010 text-muted"></i></div>
                        <div class="col-xs-10">
                            <h2 class=""><?= lang("ref"); ?>: <?= $inv->reference_no; ?></h2>

                            <p style="font-weight:bold;"><?= lang("date"); ?>: <?= $this->erp->hrld($inv->date); ?></p>

                            <p style="font-weight:bold;"><?= lang("status"); ?>: <?= lang($inv->status); ?></p>
                        </div>
                        <div class="col-xs-12">
                            <?php $br = $this->erp->save_barcode($inv->reference_no, 'code39', 35, false); ?>
                            <img
                                src="<?= base_url() ?>assets/uploads/barcode<?= $this->session->userdata('user_id') ?>.png"
                                alt="<?= $inv->reference_no ?>"/>
                            <?php $this->erp->qrcode('link', urlencode(site_url('sales/view/' . $inv->id)), 1); ?>
                            <img
                                src="<?= base_url() ?>assets/uploads/qrcode<?= $this->session->userdata('user_id') ?>.png"
                                alt="<?= $inv->reference_no ?>"/>
                        </div>
                        <div class="clearfix"></div>


                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped print-table order-table">
                        <thead>
                        <tr>
                            <th><?= lang("no"); ?></th>
                            <th><?= lang("description"); ?> (<?= lang("code"); ?>)</th>
                            <th><?= lang("unit"); ?></th>
                            <th><?= lang("quantity"); ?></th>
                            <?php
                                if ($inv->status == 'partial') {
                                    echo '<th>'.lang("received").'</th>';
                                }
                            ?>
                            <?php if ($Owner || $Admin || $GP['purchase_request-cost']) { ?>
                                <th style="padding-right:20px;"><?= lang("unit_cost"); ?></th>
                            <?php } ?>
                            <?php
                            if ($Settings->product_discount != 0) {
                                echo '<th style="padding-right:20px; text-align:center; vertical-align:middle;">' . lang("discount") . '</th>';
                            }
                            if ($Settings->tax1) {
                                echo '<th style="padding-right:20px; text-align:center; vertical-align:middle;">' . lang("tax") . '</th>';
                            }
                            ?>
                            <th style="padding-right:20px;"><?= lang("amount").'('.$default_currency->code.')'; ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $r = 1;$amount = 0;
                        foreach ($rows as $row):
                            ?>
                            <tr>
                                <td style="text-align:center; width:40px; vertical-align:middle;"><?= $r; ?></td>
                                <td style="vertical-align:middle;"><?= $row->product_name. " (" . $row->product_code . ")";?>
                                    <?= $row->details ? '<br>' . $row->details : ''; ?>
                                    <?= ($row->expiry && $row->expiry != '0000-00-00') ? '<br>' . $this->erp->hrsd($row->expiry) : ''; ?></td>
                                <td>
                                    <?php if($row->variant){ echo $row->variant;}else{echo $row->pro_unit;}?>
                                </td>
                                <td style="width: 120px; text-align:center; vertical-align:middle;"><?= $this->erp->formatQuantity($row->quantity); ?></td>
                                <?php
                                if ($inv->status == 'partial') {
                                    echo '<td style="text-align:center;vertical-align:middle;width:120px;">'.$this->erp->formatQuantity($row->quantity_received).'</td>';
                                }
                                ?>
                                <?php if ($Owner || $Admin || $GP['purchase_request-cost']) { ?>
                                    <td style="text-align:right; width:120px; padding-right:10px;"><?= $this->erp->formatMoney($row->unit_cost); ?></td>
                                <?php } ?>
                                <?php
                                if ($Settings->product_discount) {
                                $percentage = '%';
                                $discount = $row->discount;
                                $dpos = strpos($discount, $percentage);
                                echo '<td style="width: 100px; text-align:right; vertical-align:middle;">' .($dpos == true ? '<small>('.$discount.')</small>' : '').' '. $this->erp->formatMoney($row->item_discount) . '</td>';
                            }
                                if ($Settings->tax1) {
                                    echo '<td style="width: 120px; text-align:right; vertical-align:middle;">' . ($row->item_tax != 0 && $row->tax_name? '<small>(' . $row->tax_name . ')</small> ' : '') . $this->erp->formatMoney($row->item_tax) . '</td>';
                                }
                                ?>
                                <td style="text-align:right; width:120px; padding-right:10px;"><?= $this->erp->formatMoney($row->subtotal); ?></td>
                            </tr>
                            <?php
                            $r++;
							$amount+=$row->subtotal;
                        endforeach;
                        ?>
                        </tbody>
                        <tfoot>
                        <?php
                        $col = 4;
                        if($Owner || $Admin || $GP['purchase_request-cost']){
                            $col++;
                        }
                        if ($inv->status == 'partial') {
                            $col++;
                        }
                        if ($Settings->product_discount) {
                            $col++;
                        }
                        if ($Settings->tax1) {
                            $col++;
                        }
                        if ($Settings->product_discount && $Settings->tax1) {
                            $tcol = $col - 2;
                        } elseif ($Settings->product_discount) {
                            $tcol = $col - 1;
                        } elseif ($Settings->tax1) {
                            $tcol = $col - 1;
                        } else {
                            $tcol = $col;
                        }
                        ?>
                        <?php if($inv->order_discount != 0 OR ($Settings->tax2 && $inv->order_tax != 0) OR $inv->shipping != 0){ ?>
						<tr>
                            <td colspan="<?= $tcol; ?>"
                                style="text-align:right; padding-right:10px;"><?= lang("total"); ?>
                                (<?= $default_currency->code; ?>)
                            </td>
                            <?php
                            if ($Settings->product_discount) {
                                echo '<td style="text-align:right;">' . $this->erp->formatMoney($inv->product_discount) . '</td>';
                            }
                            if ($Settings->tax1) {
                                echo '<td style="text-align:right;">' . $this->erp->formatMoney($inv->product_tax) . '</td>';
                            }
                            ?>
                            <td style="text-align:right; padding-right:10px;"><?= $this->erp->formatMoney($amount); ?></td>
                        </tr>
						<?php }?>
                        <?php
                        if ($inv->order_discount != 0) {
                            echo '<tr><td colspan="' . $col . '" style="text-align:right; padding-right:10px;;">' . lang("order_discount") . ' (' . $default_currency->code . ')</td><td style="text-align:right; padding-right:10px;">' . $this->erp->formatMoney($inv->order_discount) . '</td></tr>';
                        }
                        if ($Settings->tax2 && $inv->order_tax != 0) {
                            echo '<tr><td colspan="' . $col . '" style="text-align:right; padding-right:10px;;">' . lang("order_tax") . ' (' . $default_currency->code . ')</td><td style="text-align:right; padding-right:10px;">' . $this->erp->formatMoney($inv->order_tax) . '</td></tr>';
                        }
                        if ($inv->shipping != 0) {
                            echo '<tr><td colspan="' . $col . '" style="text-align:right; padding-right:10px;;">' . lang("shipping") . ' (' . $default_currency->code . ')</td><td style="text-align:right; padding-right:10px;">' . $this->erp->formatMoney($inv->shipping) . '</td></tr>';
                        } ?>
                        <tr>
                            <td colspan="<?= $col; ?>" style="text-align:right; padding-right:10px; font-weight:bold;">
                                <?= lang("total_amount"); ?> (<?= $default_currency->code; ?>)
                            </td>
                            <td style="text-align:right; padding-right:10px; font-weight:bold;">
                                <?= $this->erp->formatMoney($inv->grand_total); ?>
                            </td>
                        </tr>
						</tfoot>
                    </table>

                </div>

                <div class="row">
                    <div class="col-xs-7">
                        <?php if ($inv->note || $inv->note != "") { ?>
                            <div class="well well-sm">
                                <p class="bold"><?= lang("note"); ?>:</p>

                                <div><?= $this->erp->decode_html($inv->note); ?></div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-xs-4 col-xs-offset-1">
                        <div class="well well-sm">
                            <p><?= lang("created_by"); ?>
                                : <?= $created_by->first_name . ' ' . $created_by->last_name; ?> </p>

                            <p><?= lang("date"); ?>: <?= $this->erp->hrld($inv->date); ?></p>
                            <?php if ($inv->updated_by) { ?>
                                <p><?= lang("updated_by"); ?>
                                    : <?= $updated_by->first_name . ' ' . $updated_by->last_name;; ?></p>
                                <p><?= lang("update_at"); ?>: <?= $this->erp->hrld($inv->updated_at); ?></p>
                            <?php } ?>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- <?php if (!empty($payments)) { ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                            <tr>
                                <th><?= lang('date') ?></th>
                                <th><?= lang('payment_reference') ?></th>
                                <th><?= lang('paid_by') ?></th>
                                <th><?= lang('amount') ?></th>
                                <th><?= lang('created_by') ?></th>
                                <th><?= lang('type') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($payments as $payment) { ?>
                                <tr>
                                    <td><?= $this->erp->hrld($payment->date) ?></td>
                                    <td><?= $payment->reference_no; ?></td>
                                    <td><?= $payment->paid_by; ?></td>
                                    <td><?= $payment->amount; ?></td>
                                    <td><?= $payment->first_name . ' ' . $payment->last_name; ?></td>
                                    <td><?= $payment->type; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?> -->

        <?php if (!$Supplier || !$Customer) { ?>
            <div class="buttons">
                <?php if ($inv->attachment) { ?>
                    <div class="btn-group">
                        <a href="<?= site_url('welcome/download/' . $inv->attachment) ?>" class="tip btn btn-primary" title="<?= lang('attachment') ?>">
                            <i class="fa fa-chain"></i> <span class="hidden-sm hidden-xs"><?= lang('attachment') ?></span>
                        </a>
                    </div>
                <?php } ?>
                <div class="btn-group btn-group-justified">
                   <!-- <div class="btn-group">
                        <a href="<?= site_url('purchases_request/payments/' . $inv->id) ?>" data-toggle="modal" data-target="#myModal" class="tip btn btn-primary tip" title="<?= lang('view_payments') ?>">
                            <i class="fa fa-money"></i> <span class="hidden-sm hidden-xs"><?= lang('view_payments') ?></span>
                        </a>
                    </div>
                    <div class="btn-group">
                        <a href="<?= site_url('purchases_request/add_payment/' . $inv->id) ?>" class="tip btn btn-primary tip" title="<?= lang('add_payment') ?>" data-target="#myModal" data-toggle="modal">
                            <i class="fa fa-money"></i> <span class="hidden-sm hidden-xs"><?= lang('add_payment') ?></span>
                        </a>
                    </div>-->
                    <?php if($Owner || $Admin || $GP['purchases-email']) { ?>
                    <div class="btn-group">
                        <a href="<?= site_url('purchases/email/' . $inv->id) ?>" data-toggle="modal" data-target="#myModal" class="tip btn btn-primary tip" title="<?= lang('email') ?>">
                            <i class="fa fa-envelope-o"></i> <span class="hidden-sm hidden-xs"><?= lang('email') ?></span>
                        </a>
                    </div>
                    <?php } ?>
                    <?php if($Owner || $Admin || $GP['purchase_request-export']) { ?>
                    <div class="btn-group">
                        <a href="<?= site_url('purchases_request/pdf/' . $inv->id) ?>" class="tip btn btn-primary" title="<?= lang('download_pdf') ?>">
                            <i class="fa fa-download"></i> <span class="hidden-sm hidden-xs"><?= lang('pdf') ?></span>
                        </a>
                    </div>
                    <?php } ?>
                    <?php if($Owner || $Admin || $GP['purchase_request-edit']) { ?>
                    <?php if ($inv->status != 'approved' && $inv->status != 'reject') { ?>
                        <div class="btn-group">
                            <a href="<?= site_url('purchases_request/edit/' . $inv->id) ?>" class="tip btn btn-warning tip" title="<?= lang('edit') ?>">
                                <i class="fa fa-edit"></i> <span class="hidden-sm hidden-xs"><?= lang('edit') ?></span>
                            </a>
                        </div>
                    <?php } ?>
                    <?php } ?>
                    <!--<div class="btn-group">
                        <a href="#" class="tip btn btn-danger bpo" title="<b><?= $this->lang->line("delete_purchase") ?></b>"
                           data-content="<div style='width:150px;'><p><?= lang('r_u_sure') ?></p><a class='btn btn-danger' href='<?= site_url('purchases/delete/' . $inv->id) ?>'><?= lang('i_m_sure') ?></a> <button class='btn bpo-close'><?= lang('no') ?></button></div>"
                           data-html="true" data-placement="top">
                            <i class="fa fa-trash-o"></i> <span class="hidden-sm hidden-xs"><?= lang('delete') ?></span>
                        </a>
                    </div>-->
                </div>
            </div>
        <?php } ?>
    </div>
</div>
