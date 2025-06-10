<?php

class ApplicationList {

    public static function ajaxclick($get = '') {
        $idform = 'ApplicationList';
        $divajax = 'divApplicationList';
        $urlajax = Db::CFAjax('ApplicationList', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            
            $table = 'application_info';
            

            if (@$save || isset($data['update'])) {
                
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $condition = "appinfo_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }

            if (isset($data['del'])) {
                $condition = "appinfo_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }

        ViewApplicationList::form_ApplicationList(@$data);
    }

    public static function sql_listgrid($request) {
        $table = 'application_info';
        $field = 'appinfo_id,appinfo_no_permohonan,appinfo_jenis_permohonan,appinfo_nama_pemohon,appinfo_no_kp,appinfo_umur,appinfo_no_telefon,appinfo_emel,appinfo_pekerjaan,appinfo_alamat,appinfo_poskod,appinfo_bandar,appinfo_negeri,appinfo_tarikh_permohonan,appinfo_tarikh_sah_sehingga,appinfo_status_permohonan';
        $condition = "1=1";
            $order = 'appinfo_no_permohonan';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>