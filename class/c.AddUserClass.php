<?php

class AddUserClass {

    public static function ajaxclick($get = '') {
        $idform = 'AddUserClass';
        $divajax = 'divAddUserClass';
        $urlajax = Db::CFAjax('AddUserClass', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            
            $table = 'users';
            $semak = chkwajib($_POST, 'u_staffid');

            if (@$save || isset($data['update'])) {
                
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        $data['u_insert_by'] = $currUser;
                        $data['u_insert_timestamp'] = date('Y-m-d h:i:sa');
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $data['u_update_by'] = $currUser;
                        $data['u_update_timestamp'] = date('Y-m-d h:i:sa');
                        $condition = "u_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }

            if (isset($data['del'])) {
                $condition = "u_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }

        ViewAddUserClass::form_AddUserClass(@$data);
    }

    public static function sql_listgrid($request) {
        $table = 'users';
        $field = 'u_id,u_staffid,u_staffdept,u_fullname,u_ic_no,u_email,u_phone_no,u_user_type,u_ref_role,u_status';
        $condition = "1=1";
            $order = 'u_staffid';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>