<?php

class ApplicationTypeClass {

    public static function ajaxclick($get = '') {
        $idform = 'ApplicationTypeClass';
        $divajax = 'divApplicationTypeClass';
        $urlajax = Db::CFAjax('ApplicationTypeClass', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            
            $table = 'application_ref_type';
            $semak = chkwajib($_POST, 'art_desc,art_status_ind');

            if (@$save || isset($data['update'])) {
                
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $condition = "art_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }

            if (isset($data['del'])) {
                $condition = "art_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }

        ViewApplicationTypeClass::form_ApplicationTypeClass(@$data);
    }

    public static function sql_listgrid($request) {
        $table = 'application_ref_type';
        $field = 'art_id,art_desc,art_status_ind';
        $condition = "1=1";
            $order = 'art_desc';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>