<?php

class ViewApplicationClass
{

    public static function form_ApplicationClass($request)
    {
        global $today;

        $semak = FwSemak::semak(@$request['semak'], @$request['save'], @$request['update']);
        if (is_array($semak)) {
            $request = array_merge($request, $semak);
            extract($request);
            extract($semak);
        }
?>
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a onclick="<?php echo ApplicationClass::ajaxclick() ?>;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">
                        <?php echo lbl('Borang Permohonan Parkir') ?>
                    </h4>
                </div>
                <div class="panel-body">
                    <td colspan='15'>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo lbl('Jenis Permohonan :') ?></label>
                            <div class="col-md-10">
                                <label class="radio-inline">
                                    <input type="radio" name="appinfo_jenis_permohonan" value="1"
                                        <?php echo (!empty($appinfo_jenis_permohonan) && $appinfo_jenis_permohonan == '1') ? 'checked' : ''; ?>>
                                    <?php echo lbl('Permohonan Baharu') ?>
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="appinfo_jenis_permohonan" value="2"
                                        <?php echo (!empty($appinfo_jenis_permohonan) && $appinfo_jenis_permohonan == '2') ? 'checked' : ''; ?>>
                                    <?php echo lbl('Pembaharuan Permohonan') ?>
                                </label>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo lbl('No Permohonan : ') ?></label>
                            <div class="col-md-10">
                                <input name="appinfo_no_permohonan" value="<?php echo @$appinfo_no_permohonan ?>" class="form-control " readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo lbl('Nama Pemohon : ') ?></label>
                            <div class="col-md-10">
                                <input name="appinfo_nama_pemohon" value="<?php echo @$appinfo_nama_pemohon ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_appinfo_nama_pemohon) ?>"
                                    onkeyup="this.value = this.value.toUpperCase();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo lbl('No.Kad Pengenalan :') ?></label>
                            <div class="col-md-10">
                                <input name="appinfo_no_kp" value="<?php echo @$appinfo_no_kp ?>" maxlength="14" class="form-control <?php echo FwSemak::alert_semak(@$chk_appinfo_no_kp) ?>"
                                    oninput="formatIC(this); updateAge(this.value);">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo lbl('Umur Pemohon :') ?></label>
                            <div class="col-md-10">
                                <input name="appinfo_umur" value="<?php echo @$appinfo_umur ?>" class="form-control " readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo lbl('No Telefon') ?></label>
                            <div class="col-md-10">
                                <input name="appinfo_no_telefon" value="<?php echo @$appinfo_no_telefon ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_appinfo_no_telefon) ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo lbl('Emel') ?></label>
                            <div class="col-md-10">
                                <input name="appinfo_emel" value="<?php echo @$appinfo_emel ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_appinfo_emel) ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo lbl('Pekerjaan') ?></label>
                            <div class="col-md-10">
                                <input name="appinfo_pekerjaan" value="<?php echo @$appinfo_pekerjaan ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_appinfo_pekerjaan) ?>"
                                    onkeyup="this.value = this.value.toUpperCase();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo lbl('Alamat') ?></label>
                            <div class="col-md-10">
                                <textarea name="appinfo_alamat" value="<?php echo @$appinfo_alamat ?>" rows="5" class="form-control <?php echo FwSemak::alert_semak(@$chk_appinfo_alamat) ?>"
                                    onkeyup=" this.value=this.value.toUpperCase();"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo lbl('Poskod') ?></label>
                            <div class="col-md-10">
                                <input name="appinfo_poskod" value="<?php echo @$appinfo_poskod ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_appinfo_poskod) ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo lbl('Bandar') ?></label>
                            <div class="col-md-10">
                                <input name="appinfo_bandar" value="<?php echo @$appinfo_bandar ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_appinfo_bandar) ?>"
                                    onkeyup="this.value = this.value.toUpperCase();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo lbl('Negeri') ?></label>
                            <div class="col-md-10">
                                <input name="appinfo_negeri" value="<?php echo @$appinfo_negeri ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_appinfo_negeri) ?>"
                                    onkeyup="this.value = this.value.toUpperCase();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo lbl('Tarikh Permohonan') ?></label>
                            <div class="col-md-10">
                                <input type="date" name="appinfo_tarikh_permohonan" value="<?php echo date('Y-m-d'); ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_appinfo_tarikh_permohonan) ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo lbl('Tarikh Sah Sehingga') ?></label>
                            <div class="col-md-10">
                                <input name="appinfo_tarikh_sah_sehingga" value="<?php echo @$appinfo_tarikh_sah_sehingga ?>" class="form-control " readonly>
                            </div>
                        </div>

                        <!-- Dokumen Sokongan -->
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo lbl('Salinan Kad Pengenalan :') ?></label>
                            <div class="col-md-10">
                                <input type="file" name="kad_pengenalan" class="form-control ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo lbl('Salinan Lesen Memandu :') ?></label>
                            <div class="col-md-10">
                                <input type="file" name="lesen_memandu" class="form-control ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo lbl('Salinan Geran Pendaftaran Kenderaan :') ?></label>
                            <div class="col-md-10">
                                <input type="file" name="geran_kenderaan" class="form-control ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo lbl('Salinan Bil Cukai Taksiran :') ?></label>
                            <div class="col-md-10">
                                <input type="file" name="cukai_taksiran" class="form-control ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo lbl('Slip Tiada Sekatan Urusniaga (iSekat) :') ?></label>
                            <div class="col-md-10">
                                <input type="file" name="isekat"    class="form-control ">
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
                                        $lbl_act = 'Hantar Permohonan';
                                    }
                                    ?>
                                    <a onclick="<?php echo ApplicationClass::ajaxclick($btn_act) ?>;" class="btn btn-success"><i class="fa fa-save bigger-120"></i> <?php echo $lbl_act ?></a>
                                    <a onclick="<?php echo ApplicationClass::ajaxclick() ?>;" class="btn btn-warning"><i class="fa fa-times bigger-120"></i> Batal Permohonan</a>
                                </center>
                            </div>
                        </div>
                    </td>
                </div>
            </div>
        </div>
        <script>
            // Format IC with dashes (xxxxxx-xx-xxxx)
            function formatIC(input) {
                let value = input.value.replace(/\D/g, '');
                if (value.length > 12) value = value.substring(0, 12);

                let formatted = value;
                if (value.length > 6) {
                    formatted = value.substring(0, 6) + '-' + value.substring(6);
                }
                if (value.length > 8) {
                    formatted = formatted.substring(0, 9) + '-' + formatted.substring(9);
                }

                input.value = formatted;
            }

            // Calculate Age from IC
            function calculateAgeFromIC(ic) {
                ic = ic.replace(/\D/g, '');
                if (ic.length < 6) return '';

                let yy = parseInt(ic.substring(0, 2), 10);
                let mm = parseInt(ic.substring(2, 4), 10) - 1;
                let dd = parseInt(ic.substring(4, 6), 10);

                let now = new Date();
                let fullYear = yy > 49 ? 1900 + yy : 2000 + yy;
                let birthDate = new Date(fullYear, mm, dd);

                if (isNaN(birthDate)) return '';

                let ageYears = now.getFullYear() - birthDate.getFullYear();
                let ageMonths = now.getMonth() - birthDate.getMonth();
                let ageDays = now.getDate() - birthDate.getDate();

                if (ageDays < 0) {
                    ageMonths--;
                    ageDays += new Date(now.getFullYear(), now.getMonth(), 0).getDate();
                }

                if (ageMonths < 0) {
                    ageYears--;
                    ageMonths += 12;
                }

                return `${ageYears} TAHUN ${ageMonths} BULAN ${ageDays} HARI`;
            }

            // Update the age field
            function updateAge(ic) {
                const age = calculateAgeFromIC(ic);
                document.querySelector('[name="appinfo_umur"]').value = age;
            }

            function setExpiryDateTwoYearsFromToday() {
                const today = new Date();
                const expiry = new Date(today);
                expiry.setFullYear(expiry.getFullYear() + 2);

                // Format to YYYY-MM-DD
                const yyyy = expiry.getFullYear();
                const mm = String(expiry.getMonth() + 1).padStart(2, '0');
                const dd = String(expiry.getDate()).padStart(2, '0');
                const formatted = `${dd}/${mm}/${yyyy}`;

                document.querySelector('[name="appinfo_tarikh_sah_sehingga"]').value = formatted;
            }

            // Run when the page loads
            window.addEventListener('DOMContentLoaded', setExpiryDateTwoYearsFromToday);
        </script>
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
