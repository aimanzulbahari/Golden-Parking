<?php

class ViewClassUserType
{

    public static function form_ClassUserType($request)
    {
        global $today;

        $semak = FwSemak::semak(@$request['semak'], @$request['save'], @$request['update']);
        if (is_array($semak)) {
            $request = array_merge($request, $semak);
            extract($request);
            extract($semak);
        }
?>
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
                        <a onclick="<?php echo ClassUserType::ajaxclick() ?>;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">
                        <?php echo lbl('Senarai Jenis Pengguna') ?>
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><?php echo lbl('#') ?></th>
                                    <th><?php echo lbl('Acronym') ?></th>
                                    <th><?php echo lbl('Description') ?></th>
                                    <th><?php echo lbl('Status') ?></th>
                                    <th width="10%">
                                        <?php if (!@$request['edit']) { ?>
                                            <button type="button" class="btn btn-xs btn-success" onclick="<?php echo ClassUserType::ajaxclick("&add=1") ?>">
                                                <i class="fa fa-plus-circle"></i> <?php echo lbl('TAMBAH') ?>
                                            </button>
                                        <?php } ?>
                                    </th>
                                </tr>
                            </thead>
                            <?php
                            $dataall = ClassUserType::sql_listgrid($request);
                            Pagg::pagging_top(@$dataall['requestgrid'], @$dataall['totalreturned'], ClassUserType::ajaxclick(), array(4, 6, 2));
                            ?>
                            <tbody>
                                <?php
                                if (@$request['add'] == 1) {
                                ?>
                                    <tr>
                                        <?php ViewClassUserType::form_add_edit(@$request); ?>
                                        <td>
                                            <a onclick="<?php echo ClassUserType::ajaxclick("&save=1") ?>;" class="btn btn-xs btn-primary"><i class="fa fa-save bigger-120"></i></a>
                                            <a onclick="<?php echo ClassUserType::ajaxclick() ?>;" class="btn btn-xs btn-warning"><i class="fa fa-times bigger-120"></i></a>
                                        </td>
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
                                        <tr <?php if (@$request['edit'] == @$rut_id) {
                                                echo 'class="active"';
                                            } ?>>
                                            <?php
                                            if (@$request['edit'] == @$rut_id) {
                                                ViewClassUserType::form_add_edit(@$request);
                                                $cls_icon = 'fa-save';
                                                $cls_btn = 'btn-primary';
                                                $btn_act = 'update';
                                                $count++;
                                            } else {
                                            ?>
                                                <td><?php echo $count ?></td>
                                                <td><?php echo $rut_acronym ?></td>
                                                <td><?php echo $rut_desc ?></td>
                                                <td><?php echo Db::chkval('gp_db.ref_status', 'rs_desc', "rs_id='$rut_status_ind'") ?></td>

                                            <?php
                                                $cls_icon = 'fa-pencil';
                                                $cls_btn = 'btn-info';
                                                $btn_act = 'edit';
                                                $count++;
                                            }
                                            ?>
                                            <td>
                                                <button type="button" class="btn btn-xs <?php echo $cls_btn ?>" onclick="<?php echo ClassUserType::ajaxclick("&$btn_act=$rut_id") ?>">
                                                    <i class="fa <?php echo $cls_icon ?> bigger-120"></i>
                                                </button>
                                                <?php
                                                if (@$request['edit'] == @$rut_id) {
                                                ?>
                                                    <button type="button" class="btn btn-xs btn-warning" onclick="<?php echo ClassUserType::ajaxclick() ?>">
                                                        <i class="fa fa-close bigger-120"></i>
                                                    </button>
                                                <?php
                                                } else { ?>
                                                    <button type="button" class="btn btn-xs btn-danger" onclick="if(confirm('<?php echo $GLOBALS['fw_lbl_confirm'] ?>'))<?php echo ClassUserType::ajaxclick("&del=$rut_id") ?>">
                                                        <i class="fa fa-trash bigger-120"></i>
                                                    </button>
                                                <?php
                                                }
                                                ?>
                                            </td>
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
        <td><?php echo $count ?></td>
        <td><input name="rut_acronym" value="<?php echo @$rut_acronym ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_rut_acronym) ?>"></td>
        <td><input name="rut_desc" value="<?php echo @$rut_desc ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_rut_desc) ?>"></td>
        <td>
            <?php
            $sql = "SELECT rs_id, rs_desc FROM gp_db.ref_status";
            Db::droplist($sql, 'rut_status_ind', 'rs_id', 'rs_desc', @$ru_status_ind, $class = 'form-control ' . FwSemak::alert_semak(@$chk_rut_status_ind), $others = '', $null = '');
            ?>
        </td>

<?php
    }
}
