<?php

class ClassUserType {

    public static function ajaxclick($get = '') {
        $idform = 'ClassUserType';
        $divajax = 'divClassUserType';
        $urlajax = Db::CFAjax('ClassUserType', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            
            $table = 'ref_user_type';
            $semak = chkwajib($_POST, 'rut_acronym,rut_desc,rut_status_ind');

            if (@$save || isset($data['update'])) {
                
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $condition = "rut_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }

            if (isset($data['del'])) {
                $condition = "rut_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }

        ViewClassUserType::form_ClassUserType(@$data);
    }

    public static function sql_listgrid($request) {
        $table = 'ref_user_type';
        $field = 'rut_id,rut_acronym,rut_desc,rut_status_ind';
        $condition = "1=1";
            $order = 'rut_acronym';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>