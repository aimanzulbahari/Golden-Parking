<?php

class ViewAddUserClass
{

    public static function form_AddUserClass($request)
    {
        global $today;

        $semak = FwSemak::semak(@$request['semak'], @$request['save'], @$request['update']);
        if (is_array($semak)) {
            $request = array_merge($request, $semak);
            extract($request);
            extract($semak);
        }
?>
        <!-- css -->
        <style>
            /* Panel Styling */
            .panel {
                border: 1px solid #dcdcdc;
                border-radius: 8px;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
                background-color: #fff;
                margin-bottom: 20px;
            }

            .panel-heading {
                background-color: #2d353c;
                color: #fff;
                padding: 15px 20px;
                border-top-left-radius: 8px;
                border-top-right-radius: 8px;
                position: relative;
            }

            .panel-heading .panel-title {
                font-size: 16px;
                font-weight: 600;
            }

            .panel-heading-btn .btn {
                color: #fff;
                margin-left: 5px;
            }

            .panel-body {
                padding: 20px;
            }

            /* Table Styling */
            .table {
                width: 100%;
                margin-bottom: 1rem;
                background-color: transparent;
                border-collapse: collapse;
                font-size: 14px;
            }

            .table th,
            .table td {
                padding: 12px 15px;
                text-align: left;
                border-bottom: 1px solid #dee2e6;
                vertical-align: middle;
            }

            .table thead th {
                background-color: #f8f9fa;
                color: #333;
                font-weight: 600;
                text-transform: uppercase;
                font-size: 13px;
            }

            .table-hover tbody tr:hover {
                background-color: #f1f1f1;
            }

            /* Zebra striping */
            .table tbody tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            /* Action buttons */
            .btn-xs {
                padding: 4px 8px;
                font-size: 12px;
                border-radius: 4px;
            }

            .btn-success,
            .btn-danger,
            .btn-info,
            .btn-warning,
            .btn-primary {
                transition: background-color 0.2s ease-in-out;
            }

            .btn-success:hover {
                background-color: #218838;
            }

            .btn-danger:hover {
                background-color: #c82333;
            }

            .btn-info:hover {
                background-color: #117a8b;
            }

            .btn-primary:hover {
                background-color: #0069d9;
            }

            /* Responsive tweaks */
            @media (max-width: 768px) {
                .table-responsive {
                    overflow-x: auto;
                }

                .panel-heading .panel-title {
                    font-size: 14px;
                }

                .table th,
                .table td {
                    padding: 10px;
                }
            }
        </style>
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a onclick="<?php echo AddUserClass::ajaxclick() ?>;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">
                        <?php echo lbl('Pendaftaran Pengguna') ?>
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                        $dataall = AddUserClass::sql_listgrid($request);
                        Pagg::pagging_top(@$dataall['requestgrid'], @$dataall['totalreturned'], AddUserClass::ajaxclick(), array(4, 6, 2));
                        ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><?php echo lbl('#') ?></th>
                                    <th><?php echo lbl('No.Staff') ?></th>
                                    <th><?php echo lbl('Jabatan') ?></th>
                                    <th><?php echo lbl('Nama Penuh') ?></th>
                                    <th><?php echo lbl('Jenis Pengguna') ?></th>
                                    <th><?php echo lbl('Peranan Pengguna') ?></th>
                                    <th><?php echo lbl('Status') ?></th>
                                    <th><?php echo lbl('Dalaman/Luaran') ?></th>
                                    <th width="10%">
                                        <?php if (!@$request['edit']) { ?>
                                            <button type="button" class="btn btn-xs btn-success" onclick="<?php echo AddUserClass::ajaxclick("&add=1") ?>">
                                                <i class="fa fa-plus-circle"></i> <?php echo lbl('TAMBAH') ?>
                                            </button>
                                        <?php } ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (@$request['add'] == 1) {
                                ?>
                                    <tr>
                                        <?php ViewAddUserClass::form_add_edit(@$request); ?>

                                    </tr>
                                    <?php
                                }
                                $count = 1;
                                if (is_array($dataall['fw_senarai'])) {
                                    foreach ($dataall['fw_senarai'] as $row => $value) {
                                        extract($value);
                                        if (!is_array(@$semak)) {
                                            if (is_array($request)) {
                                                $request = array_merge($request, $value);
                                            }
                                        }
                                    ?>
                                        <tr <?php if (@$request['edit'] == @$u_id) {
                                                echo 'class="active"';
                                            } ?>>
                                            <?php
                                            if (@$request['edit'] == @$u_id) {
                                                ViewAddUserClass::form_add_edit(@$request);
                                                $cls_icon = 'fa-save';
                                                $cls_btn = 'btn-primary';
                                                $btn_act = 'update';
                                            } else {
                                            ?>
                                                <td><?php echo $count++ ?></td>
                                                <td><?php echo $u_staffid ?></td>
                                                <td><?php echo $u_staffdept ?></td>
                                                <td><?php echo $u_fullname ?></td>
                                                <td><?php echo $u_user_type ?></td>
                                                <td><?php echo $u_ref_role ?></td>
                                                <td><?php echo $u_status ?></td>

                                            <?php
                                                $cls_icon = 'fa-pencil';
                                                $cls_btn = 'btn-info';
                                                $btn_act = 'edit';
                                                $count++;
                                            }
                                            ?>
                                            <?php
                                            if (@$request['edit'] != @$u_id) {
                                            ?>
                                                <td>
                                                    <button type="button" class="btn btn-xs <?php echo $cls_btn ?>" onclick="<?php echo AddUserClass::ajaxclick("&$btn_act=$u_id") ?>">
                                                        <i class="fa <?php echo $cls_icon ?> bigger-120"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-xs btn-danger" onclick="if(confirm('<?php echo $GLOBALS['fw_lbl_confirm'] ?>'))<?php echo AddUserClass::ajaxclick("&del=$u_id") ?>">
                                                        <i class="fa fa-trash bigger-120"></i>
                                                    </button>
                                                </td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    // Show message when no data is available
                                    echo '<tr><td colspan="9" class="text-center"><span>No data available in table</span></td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

    public static function form_add_edit($data)
    {
        if (is_array($data)) {
            extract($data);
        }
        if (is_array(@$semak)) {
            $data = array_merge($data, $semak);
            extract($data);
            extract($semak);
        }
    ?>
        <td colspan='10'>
            <div class="form-group">
                <label class="col-md-2 control-label"><?php echo lbl('Jenis Pengguna :') ?></label>
                <div class="col-md-10">
                    <input name="u_user_type" value="<?php echo @$u_user_type ?>" class="form-control ">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label"><?php echo lbl('No.Staff :') ?></label>
                <div class="col-md-10">
                    <input name="u_staffid" value="<?php echo @$u_staffid ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_u_staffid) ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label"><?php echo lbl('Jabatan : ') ?></label>
                <div class="col-md-10">
                    <input name="u_staffdept" value="<?php echo @$u_staffdept ?>" class="form-control ">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label"><?php echo lbl('Nama Penuh :') ?></label>
                <div class="col-md-10">
                    <input name="u_fullname" value="<?php echo @$u_fullname ?>" class="form-control ">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label"><?php echo lbl('No.Kad Pengenalan : ') ?></label>
                <div class="col-md-10">
                    <input name="u_ic_no" value="<?php echo @$u_ic_no ?>" class="form-control ">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label"><?php echo lbl('Email : ') ?></label>
                <div class="col-md-10">
                    <input name="u_email" value="<?php echo @$u_email ?>" class="form-control ">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label"><?php echo lbl('No.Telefon : ') ?></label>
                <div class="col-md-10">
                    <input name="u_phone_no" value="<?php echo @$u_phone_no ?>" class="form-control ">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label"><?php echo lbl('Peranan Pengguna : ') ?></label>
                <div class="col-md-10">
                    <input name="u_ref_role" value="<?php echo @$u_ref_role ?>" class="form-control ">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label"><?php echo lbl('Status Pengguna : ') ?></label>
                <div class="col-md-10">
                    <input name="u_status" value="<?php echo @$u_status ?>" class="form-control ">
                </div>
            </div>
             <div class="form-group">
                <label class="col-md-2 control-label"><?php echo lbl('Kata Laluan : ') ?></label>
                <div class="col-md-10">
                    <input name="u_password" value="<?php echo @$u_status ?>" class="form-control ">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <center>
                        <?php
                        if (@$edit != '') {
                            $btn_act = '&update=' . $edit;
                            $lbl_act = 'Update';
                        } else {
                            $btn_act = '&save=1';
                            $lbl_act = 'Save';
                        }
                        ?>
                        <a onclick="<?php echo AddUserClass::ajaxclick($btn_act) ?>;" class="btn btn-primary"><i class="fa fa-save bigger-120"></i> <?php echo $lbl_act ?></a>
                        <a onclick="<?php echo AddUserClass::ajaxclick() ?>;" class="btn btn-warning"><i class="fa fa-times bigger-120"></i> Cancel</a>
                    </center>
                </div>
            </div>
        </td>
<?php
    }
}
