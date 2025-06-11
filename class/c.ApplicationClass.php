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

            $table = 'application_info';
            $semak = chkwajib($_POST, 'appinfo_jenis_permohonan,appinfo_nama_pemohon,appinfo_no_kp,appinfo_no_telefon,appinfo_emel,appinfo_pekerjaan,appinfo_alamat,appinfo_poskod,appinfo_bandar,appinfo_negeri,appinfo_tarikh_permohonan');

            if (@$save || isset($data['update'])) {

                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);
                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    // ============ INSERT NEW RECORD ============
                    if (@$save) {
                        // Generate reference number if empty
                        if (empty($data['appinfo_no_permohonan'])) {
                            $data['appinfo_no_permohonan'] = self::GetRefNo();
                        }

                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        // ============ UPDATE EXISTING RECORD ============
                        $condition = "appinfo_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }

            // ============ DELETE RECORD ============
            if (isset($data['del'])) {
                $condition = "appinfo_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }

            // Auto-generate ref no if displaying new form and not saving/updating
            if (empty($data['appinfo_no_permohonan'])) {
                $data['appinfo_no_permohonan'] = self::GetRefNo();
            }
        }

        ViewApplicationClass::form_ApplicationClass(@$data);
    }



    public static function sql_listgrid($request)
    {
        $table = 'application_info';
        $field = 'appinfo_id,appinfo_no_permohonan,appinfo_jenis_permohonan,appinfo_nama_pemohon,appinfo_no_kp,appinfo_umur,appinfo_no_telefon,appinfo_emel,appinfo_pekerjaan,appinfo_alamat,appinfo_poskod,appinfo_bandar,appinfo_negeri,appinfo_tarikh_permohonan,appinfo_tarikh_sah_sehingga';
        $condition = "1=1";
        $order = 'appinfo_no_permohonan';

        return Db::list_grid($table, $field, $condition, 'Y');
    }

    // Generate automated ref no
    public static function GetRefNo()
    {
        $prefix = 'MBSA/GP';
        $year = date('Y');
        $like = "$prefix/$year/%";

        $rows = Db::data_list("
        SELECT appinfo_no_permohonan 
        FROM application_info 
        WHERE appinfo_no_permohonan LIKE '{$like}' 
        ORDER BY appinfo_no_permohonan DESC 
        LIMIT 1
    ", 'Y');

        // Safety: make sure $rows is an array
        if (!is_array($rows) || empty($rows[0]['appinfo_no_permohonan'])) {
            $newNum = '00001';
        } else {
            $lastNum = (int)substr($rows[0]['appinfo_no_permohonan'], -5);
            $newNum = str_pad($lastNum + 1, 5, '0', STR_PAD_LEFT);
        }

        return "$prefix/$year/$newNum";
    }
}
