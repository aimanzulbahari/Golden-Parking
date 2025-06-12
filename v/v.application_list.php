<?php

class ViewApplicationList
{

    public static function form_ApplicationList($request)
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
            /* Existing styles */
            th {
                text-transform: uppercase;
            }
        </style>
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a onclick="<?php echo ApplicationList::ajaxclick() ?>;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">
                        <?php echo lbl('Senarai Permohonan') ?>
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                        $dataall = ApplicationList::sql_listgrid($request);
                        Pagg::pagging_top(@$dataall['requestgrid'], @$dataall['totalreturned'], ApplicationList::ajaxclick(), array(4, 6, 2));
                        ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><?php echo lbl('#') ?></th>
                                    <th><?php echo lbl('No.Permohonan') ?></th>
                                    <th><?php echo lbl('Jenis Permohonan') ?></th>
                                    <th><?php echo lbl('Nama Pemohon') ?></th>
                                    <th><?php echo lbl('Tarikh Permohonan') ?></th>
                                    <th><?php echo lbl('Tarikh Sah Sehingga') ?></th>
                                    <th><?php echo lbl('Status Permohonan') ?></th>
                                    <th width="10%"><?php echo lbl('Tindakan') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (@$request['add'] == 1) {
                                ?>
                                    <tr>
                                        <?php ViewApplicationList::form_add_edit(@$request); ?>
                                        <td>
                                            <a onclick="<?php echo ApplicationList::ajaxclick("&save=1") ?>;" class="btn btn-xs btn-primary"><i class="fa fa-save bigger-120"></i></a>
                                            <a onclick="<?php echo ApplicationList::ajaxclick() ?>;" class="btn btn-xs btn-warning"><i class="fa fa-times bigger-120"></i></a>
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
                                        <tr <?php if (@$request['edit'] == @$appinfo_id) {
                                                echo 'class="active"';
                                            } ?>>
                                            <?php
                                            if (@$request['edit'] == @$appinfo_id) {
                                                ViewApplicationList::form_add_edit(@$request);
                                                $cls_icon = 'fa-save';
                                                $cls_btn = 'btn-primary';
                                                $btn_act = 'update';
                                            } else {
                                            ?>
                                                <td><?php echo $count ?></td>
                                                <td><?php echo $appinfo_no_permohonan ?></td>
                                                <td>
                                                    <?php
                                                    $JenisPermohonan = Db::chkval('gp_db.ref_application_type', 'rat_desc', "rat_id='$appinfo_jenis_permohonan'");

                                                    // Default color
                                                    $badge_style = 'background-color: #adb5bd;'; // Lain-Lain

                                                    switch ((int)$appinfo_jenis_permohonan) {
                                                        case 1: // Permohonan Baharu
                                                            $badge_style = 'background-color: #3a86ff;';
                                                            break;
                                                        case 2: // Pembaharuan Permohonan
                                                            $badge_style = 'background-color: #ff006e;';
                                                            break;
                                                        default:
                                                            $badge_style = 'background-color: #adb5bd;';
                                                            break;
                                                    }

                                                    echo "<span class='badge' style='$badge_style; color: white;'>$JenisPermohonan</span></div>";
                                                    ?>
                                                </td>
                                                <td><?php echo $appinfo_nama_pemohon ?></td>
                                                <td><?php echo $appinfo_tarikh_permohonan ?></td>
                                                <td><?php echo $appinfo_tarikh_sah_sehingga ?></td>
                                                <td>
                                                    <?php
                                                    $StatusPermohonan = Db::chkval('gp_db.ref_applicaton_status', 'ras_desc', "ras_id='$appinfo_status_permohonan'");

                                                    // Default color
                                                    $badge_style = 'background-color: #adb5bd;'; // Lain-Lain

                                                    switch ((int)$appinfo_status_permohonan) {
                                                         case 1: // Draf
                                                            $badge_style = 'background-color: #3a86ff;';
                                                            break;
                                                        case 2: // Hantar
                                                            $badge_style = 'background-color: #3a86ff;';
                                                            break;
                                                        case 3: // Diluluskan
                                                            $badge_style = 'background-color: #ff006e;';
                                                            break;
                                                        case 4: // Dibatalkan
                                                            $badge_style = 'background-color: #ff006e;';
                                                            break;
                                                        default:
                                                            $badge_style = 'background-color: #adb5bd;';
                                                            break;
                                                    }
                                                    echo "<span class='badge' style='$badge_style; color: white;'>$StatusPermohonan</span>";
                                                    ?>
                                                </td>

                                            <?php
                                                $cls_icon = 'fa-pencil';
                                                $cls_btn = 'btn-info';
                                                $btn_act = 'edit';
                                                $count++;
                                            }
                                            ?>
                                            <td>
                                                <button type="button" class="btn btn-xs <?php echo $cls_btn ?>" onclick="<?php echo ApplicationList::ajaxclick("&$btn_act=$appinfo_id") ?>">
                                                    <i class="fa <?php echo $cls_icon ?> bigger-120"></i>
                                                </button>
                                                <?php
                                                if (@$request['edit'] == @$appinfo_id) {
                                                ?>
                                                    <button type="button" class="btn btn-xs btn-warning" onclick="<?php echo ApplicationList::ajaxclick() ?>">
                                                        <i class="fa fa-close bigger-120"></i>
                                                    </button>
                                                <?php
                                                } else { ?>
                                                    <button type="button" class="btn btn-xs btn-danger" onclick="if(confirm('<?php echo $GLOBALS['fw_lbl_confirm'] ?>'))<?php echo ApplicationList::ajaxclick("&del=$appinfo_id") ?>">
                                                        <i class="fa fa-trash bigger-120"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-xs btn-info" onclick="if(confirm('<?php echo $GLOBALS['fw_lbl_confirm'] ?>'))<?php echo ApplicationList::ajaxclick("&del=$appinfo_id") ?>">
                                                        <i class="fa fa-eye bigger-120"></i>
                                                    </button>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Show message if no data here -->
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
<?php
    }
}
