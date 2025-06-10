<?php

class ApplicationClass
{

    public static function ajaxclick($get = '')
    {
        $idform = 'ApplicationClass';
        $divajax = 'divApplicationClass';
        $urlajax = Db::CFAjax('ApplicationClass', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data)
    {
        pr($data);
        if (is_array($data)) {
            extract($data);
            $currUser = $_SESSION[$GLOBALS['fw_sistem']]['username'];

            $table = 'application_info';
            // $semak = chkwajib($_POST, 'appinfo_jenis_permohonan,appinfo_nama_pemohon,appinfo_no_kp,appinfo_umur,appinfo_no_telefon,appinfo_emel,appinfo_pekerjaan,appinfo_alamat,appinfo_poskod,appinfo_bandar,appinfo_negeri,appinfo_tarikh_permohonan');

            if (@$save || isset($data['update'])) {
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        $data['appinfo_insert_by'] = $currUser;
                        $data['appinfo_insert_timestamp'] = date('Y-m-d h:i:sa');
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $data['appinfo_update_by'] = $currUser;
                        $data['appinfo_update_timestamp'] = date('Y-m-d h:i:sa');
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

        ViewApplicationClass::form_ApplicationClass(@$data);
    }

    public static function sql_datalist($request)
    {
        $table = 'application_info';
        $field = 'appinfo_id,appinfo_no_permohonan,appinfo_jenis_permohonan,appinfo_nama_pemohon,appinfo_no_kp,appinfo_umur,appinfo_no_telefon,appinfo_emel,appinfo_pekerjaan,appinfo_alamat,appinfo_poskod,appinfo_bandar,appinfo_negeri,appinfo_tarikh_permohonan,appinfo_tarikh_sah_sehingga';
        $condition = "1=1 ORDER BY appinfo_no_permohonan";;

        return Db::data_list($table, $field, $condition, 'Y');
    }
}
