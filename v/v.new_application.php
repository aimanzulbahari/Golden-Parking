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
        <style>
            body {
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                min-height: 100vh;
                padding: 20px 0;
            }

            .form-container {
                max-width: 100%;
                margin: 0 auto;
            }

            .main-card {
                background: #ffffff;
                border-radius: 12px;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                border: none;
            }

            .header-section {
                background: linear-gradient(135deg, #0096c7 0%, #03045e 100%);
                color: white;
                padding: 20px 30px;
                position: relative;
            }

            .header-title {
                font-size: 24px;
                font-weight: 700;
                margin: 0;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .header-subtitle {
                font-size: 14px;
                opacity: 0.9;
                margin-top: 5px;
                font-weight: 300;
            }

            .header-controls {
                position: absolute;
                right: 20px;
                top: 50%;
                transform: translateY(-50%);
            }

            .header-controls .btn {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                margin-left: 8px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border: 1px solid rgba(255, 255, 255, 0.3);
                background: rgba(255, 255, 255, 0.1);
                color: white;
                transition: all 0.2s ease;
            }

            .header-controls .btn:hover {
                background: rgba(255, 255, 255, 0.2);
                transform: scale(1.05);
            }

            .form-body {
                padding: 0;
            }

            .form-section {
                border-bottom: 1px solid #f0f0f0;
            }

            .form-section:last-child {
                border-bottom: none;
            }

            .section-header {
                background: #f8f9fa;
                padding: 15px 30px;
                border-left: 4px solid #ffc300;
                margin: 0;
            }

            .section-title {
                font-size: 16px;
                font-weight: 600;
                color: #333;
                margin: 0;
            }

            .section-content {
                padding: 25px 30px;
            }

            .form-row {
                margin-bottom: 20px;
            }

            .form-row:last-child {
                margin-bottom: 0;
            }

            .form-label {
                font-weight: 600;
                color: #555;
                margin-bottom: 6px;
                font-size: 14px;
            }

            .form-control {
                border: 2px solid #e8ecef;
                border-radius: 8px;
                padding: 12px 16px;
                font-size: 14px;
                transition: all 0.3s ease;
                background: #ffffff;
            }

            .form-control:focus {
                border-color: #ffc300;
                box-shadow: 0 0 0 3px rgba(255, 195, 0, 0.1);
                outline: none;
            }

            .form-control[readonly] {
                background: #f8f9fa;
                color: #6c757d;
                border-color: #dee2e6;
            }

            .radio-group {
                display: flex;
                gap: 15px;
                flex-wrap: wrap;
            }

            .radio-option {
                flex: 1;
                min-width: 200px;
            }

            .radio-card {
                border: 2px solid #e8ecef;
                border-radius: 8px;
                padding: 15px;
                cursor: pointer;
                transition: all 0.3s ease;
                background: #ffffff;
                text-align: center;
            }

            .radio-card:hover {
                border-color: #ffc300;
                background: #fffdf5;
            }

            .radio-card.active {
                border-color: #ffc300;
                background: linear-gradient(135deg, #ffd54f 0%, #ffc107 100%);
                color: white;
            }

            .radio-card input[type="radio"] {
                display: none;
            }

            .radio-card .fa {
                font-size: 20px;
                margin-bottom: 8px;
                display: block;
            }

            .radio-card .radio-text {
                font-weight: 600;
                font-size: 14px;
            }

            .input-group-addon {
                background: linear-gradient(135deg, #fdb833 0%, #ffc300 100%);
                border: 2px solid #ffc300;
                color: white;
                border-radius: 0 8px 8px 0;
            }

            .input-group .form-control {
                border-radius: 8px 0 0 8px;
            }

            .file-upload-area {
                border: 2px dashed #dee2e6;
                border-radius: 8px;
                padding: 20px;
                text-align: center;
                background: #f8f9fa;
                transition: all 0.3s ease;
            }

            .file-upload-area:hover {
                border-color: #ffc300;
                background: #fffdf5;
            }

            .file-upload-area .fa {
                font-size: 24px;
                color: #6c757d;
                margin-bottom: 10px;
            }

            .file-upload-text {
                color: #6c757d;
                font-size: 14px;
            }

            .file-upload-area input[type="file"] {
                position: absolute;
                opacity: 0;
                width: 100%;
                height: 100%;
                cursor: pointer;
            }

            .action-section {
                background: #f8f9fa;
                padding: 25px 30px;
                text-align: center;
                border-top: 1px solid #e9ecef;
            }

            .btn-primary,
            .btn-success,
            .btn-danger {
                border: none;
                border-radius: 8px;
                padding: 12px 40px;
                font-weight: 600;
                font-size: 16px;
                transition: all 0.3s ease;
            }

            .btn-secondary {
                background: #6c757d;
                border: none;
                border-radius: 8px;
                padding: 12px 40px;
                font-weight: 600;
                font-size: 16px;
                color: white;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
            }

            .btn-secondary:hover {
                background: #5a6268;
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
            }

            .btn-group-actions {
                display: flex;
                gap: 15px;
                justify-content: center;
                flex-wrap: wrap;
            }

            .help-text {
                font-size: 12px;
                color: #6c757d;
                margin-top: 5px;
            }

            .required-mark {
                color: #dc3545;
                margin-left: 3px;
            }

            @media (max-width: 768px) {
                body {
                    padding: 10px 0;
                }

                .form-container {
                    margin: 0 10px;
                }

                .header-section {
                    padding: 15px 20px;
                }

                .header-title {
                    font-size: 20px;
                }

                .section-content {
                    padding: 20px;
                }

                .radio-group {
                    flex-direction: column;
                }

                .radio-option {
                    min-width: auto;
                }

                .btn-group-actions {
                    flex-direction: column;
                }

                .btn-group-actions .btn {
                    width: 100%;
                }
            }
        </style>

        <body>
            <div class="container-fluid">
                <div class="form-container">
                    <div class="main-card fade-in-up">
                        <!-- Header -->
                        <div class="header-section">
                            <h1 class="header-title"><?php echo lbl('Borang Permohonan Parkir') ?></h1>
                            <p class="header-subtitle"><?php echo lbl('Sila lengkapkan maklumat berikut dengan tepat') ?></p>
                        </div>

                        <div class="form-body">
                            <div class="form-section">
                                <div class="section-header">
                                    <h3 class="section-title">
                                        <i class="fa fa-info-circle"></i> <?php echo lbl('Maklumat Asas Permohonan') ?>
                                    </h3>
                                </div>
                                <div class="section-content">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <label class="form-label"><?php echo lbl('No. Permohonan') ?></label>
                                                <input class="form-control" name="appinfo_no_permohonan" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <label class="form-label"><?php echo lbl('Jenis Permohonan') ?> <span class="required-mark">*</span></label>
                                        <div class="radio-group">
                                            <div class="radio-option">
                                                <div class="radio-card">
                                                    <input type="radio" id="permohonan" name="appinfo_jenis_permohonan" value="1" <?php echo (@$appinfo_jenis_permohonan == 1) ? 'checked' : '' ?> />
                                                    <label for="permohonan" style="cursor: pointer; margin: 0; width: 100%;">
                                                        <i class="fa fa-plus-circle"></i>
                                                        <div class="radio-text"><?php echo lbl('Permohonan Baharu') ?></div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="radio-option">
                                                <div class="radio-card">
                                                    <input type="radio" id="pembaharuan" name="appinfo_jenis_permohonan" value="2" <?php echo (@$appinfo_jenis_permohonan == 2) ? 'checked' : '' ?> />
                                                    <label for="pembaharuan" style="cursor: pointer; margin: 0; width: 100%;">
                                                        <i class="fa fa-refresh"></i>
                                                        <div class="radio-text"><?php echo lbl('Pembaharuan') ?></div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Pemohon -->
                            <div class="form-section">
                                <div class="section-header">
                                    <h3 class="section-title">
                                        <i class="fa fa-user"></i> <?php echo lbl('Maklumat Pemohon') ?>
                                    </h3>
                                </div>
                                <div class="section-content">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-row">
                                                <label class="form-label"><?php echo lbl('Nama Penuh') ?> <span class="required-mark">*</span></label>
                                                <input name="appinfo_nama_pemohon" value="<?php echo @$appinfo_nama_pemohon ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_appinfo_nama_pemohon) ?>"
                                                    placeholder="Nama Penuh Seperti Kad Pengenalan" onkeyup="this.value = this.value.toUpperCase();">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-row">
                                                <label class="form-label"><?php echo lbl('Umur') ?></label>
                                                <input name="appinfo_umur" value="<?php echo @$appinfo_umur ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <label class="form-label"><?php echo lbl('No. Kad Pengenalan') ?> <span class="required-mark">*</span></label>
                                                <input type="text" name="appinfo_no_kp" value="<?php echo @$appinfo_no_kp ?>" maxlength="14" class="form-control <?php echo FwSemak::alert_semak(@$chk_appinfo_no_kp) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <label class="form-label"><?php echo lbl('Pekerjaan') ?> <span class="required-mark">*</span></label>
                                                <input name="appinfo_pekerjaan" value="<?php echo @$appinfo_pekerjaan ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_appinfo_pekerjaan) ?>"
                                                    placeholder="Sila Masukkan Pekerjaan Semasa" onkeyup="this.value = this.value.toUpperCase();">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Maklumat Hubungi -->
                            <div class="form-section">
                                <div class="section-header">
                                    <h3 class="section-title">
                                        <i class="fa fa-phone"></i> <?php echo lbl('Maklumat Perhubungan') ?>
                                    </h3>
                                </div>
                                <div class="section-content">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <label class="form-label"><?php echo lbl('No. Telefon') ?> <span class="required-mark">*</span></label>
                                                <input name="appinfo_no_telefon" value="<?php echo @$appinfo_no_telefon ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_appinfo_no_telefon) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <label class="form-label"><?php echo lbl('Alamat Emel') ?> <span class="required-mark">*</span></label>
                                                <input name="appinfo_emel" value="<?php echo @$appinfo_emel ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_appinfo_emel) ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="form-section">
                                <div class="section-header">
                                    <h3 class="section-title">
                                        <i class="fa fa-home"></i> <?php echo lbl('Alamat Tempat Tinggal') ?>
                                    </h3>
                                </div>
                                <div class="section-content">
                                    <div class="form-row">
                                        <label class="form-label"><?php echo lbl('Alamat Lengkap') ?> <span class="required-mark">*</span></label>
                                        <textarea name="appinfo_alamat" rows="5" class="form-control <?php echo FwSemak::alert_semak(@$chk_appinfo_alamat) ?>" onkeyup="this.value = this.value.toUpperCase();"><?php echo @$appinfo_alamat ?></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-row">
                                                <label class="form-label"><?php echo lbl('Poskod') ?> <span class="required-mark">*</span></label>
                                                <input name="appinfo_poskod" value="<?php echo @$appinfo_poskod ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_appinfo_poskod) ?>"
                                                    onkeyup="this.value = this.value.toUpperCase();">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-row">
                                                <label class="form-label"><?php echo lbl('Bandar') ?> <span class="required-mark">*</span></label>
                                                <input name="appinfo_bandar" value="<?php echo @$appinfo_bandar ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_appinfo_bandar) ?>"
                                                    onkeyup="this.value = this.value.toUpperCase();">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-row">
                                                <label class="form-label"><?php echo lbl('Negeri') ?> <span class="required-mark">*</span></label>
                                                <input name="appinfo_negeri" value="<?php echo @$appinfo_negeri ?>" class="form-control <?php echo FwSemak::alert_semak(@$chk_appinfo_negeri) ?>"
                                                    onkeyup="this.value = this.value.toUpperCase();">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tarikh -->
                            <div class="form-section">
                                <div class="section-header">
                                    <h3 class="section-title">
                                        <i class="fa fa-calendar"></i> <?php echo lbl('Maklumat Tarikh') ?>
                                    </h3>
                                </div>
                                <div class="section-content">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <label class="form-label"><?php echo lbl('Tarikh Permohonan') ?> <span class="required-mark">*</span></label>
                                                <div class="input-group">
                                                    <input type="date" name="appinfo_tarikh_permohonan" value="<?php echo date('Y-m-d'); ?>" class="form-control datepicker <?php echo FwSemak::alert_semak(@$chk_ad_request_date) ?>">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <label class="form-label"><?php echo lbl('Tarikh Sah Sehingga') ?></label>
                                                <input name="appinfo_tarikh_sah_sehingga" value="<?php echo @$appinfo_tarikh_sah_sehingga ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form>
                                <!-- Maklumat Asas -->


                                <!-- Dokumen -->

                            </form>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-section">
                            <div class="btn-group-actions">
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
                                <a onclick="<?php echo ApplicationClass::ajaxclick() ?>;" class="btn btn-primary"><i class="fa fa-save bigger-120"></i> Simpan Draf</a>
                                <a onclick="<?php echo ApplicationClass::ajaxclick() ?>;" class="btn btn-danger"><i class="fa fa-save bigger-120"></i> Batal Permohonan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
            <script>
                function formatIC(input) {
                    let value = input.value.replace(/\D/g, ''); // remove non-digits

                    // Limit to 12 digits
                    if (value.length > 12) value = value.substring(0, 12);

                    // Add dashes: xxxxxx-xx-xxxx
                    let formatted = value;
                    if (value.length > 6) {
                        formatted = value.substring(0, 6) + '-' + value.substring(6);
                    }
                    if (value.length > 8) {
                        formatted = formatted.substring(0, 9) + '-' + formatted.substring(9);
                    }

                    input.value = formatted;
                }

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
                        let prevMonth = new Date(now.getFullYear(), now.getMonth(), 0);
                        ageDays += prevMonth.getDate();
                    }

                    if (ageMonths < 0) {
                        ageYears--;
                        ageMonths += 12;
                    }

                    return `${ageYears} TAHUN ${ageMonths} BULAN ${ageDays} HARI`;
                }

                // On input: format IC and calculate age
                document.querySelector('input[name="appinfo_no_kp"]').addEventListener('input', function() {
                    formatIC(this);
                    const umur = calculateAgeFromIC(this.value);
                    document.querySelector('input[name="appinfo_umur"]').value = umur;
                });

                document.querySelectorAll('.radio-card input[type="radio"]').forEach(radio => {
                    radio.addEventListener('change', function() {
                        document.querySelectorAll('.radio-card').forEach(card => {
                            card.classList.remove('active');
                        });
                        if (this.checked) {
                            this.closest('.radio-card').classList.add('active');
                        }
                    });
                });
            </script>
        </body>
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
