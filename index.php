<?php
require_once 'setting.php';
session_destroy();
//Include google login configuration
include_once 'google_login.php';
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title>Gold Parking System</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
    <link href="assets/css/animate.min.css" rel="stylesheet" />
    <link href="assets/css/style.min.css" rel="stylesheet" />
    <link href="assets/css/style-responsive.min.css" rel="stylesheet" />
    <link href="assets/css/theme/default.css" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE CSS ================== -->
    <link href="assets/plugins/bootstrap-social/bootstrap-social.css" rel="stylesheet" />
    <!-- ================== END PAGE CSS ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
</head>
<style>
    body {
        background-color: #023e8a;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        padding: 20px;
    }

    .login-container {
        max-width: 400px;
        width: 100%;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        padding: 40px 30px;
        animation: fadeSlideUp 1s ease-out;
    }

    @keyframes fadeSlideUp {
        0% {
            opacity: 0;
            transform: translateY(40px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .company-logo {
        text-align: center;
        margin-bottom: 30px;
    }

    .logo-container {
        display: inline-block;
        background: white;
        border-radius: 50%;
        padding: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .company-logo-img {
        max-width: 80px;
        height: auto;
    }

    .login-title {
        font-size: 24px;
        margin-bottom: 30px;
        color: #2c3e50;
        font-weight: 600;
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .input-group-addon {
        background-color: #f8f9fa;
        border-right: none;
    }

    .form-control {
        border-left: none;
        box-shadow: none;
        height: 42px;
    }

    .btn-primary {
        background-color: #0066cc;
        border-color: #0066cc;
        width: 100%;
        padding: 12px;
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        transition: all 0.3s ease;
        height: 48px;
    }

    .btn-primary:hover {
        background-color: #0052a3;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .signup-link {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
    }

    .info-icon {
        position: absolute;
        top: 15px;
        right: 15px;
        cursor: pointer;
        color: #667eea;
        font-size: 20px;
        transition: color 0.3s;
    }

    .info-icon:hover {
        color: #764ba2;
    }

    .modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 4px 4px 0 0;
    }

    .modal-header .close {
        color: white;
        opacity: 0.8;
    }

    .modal-header .close:hover {
        opacity: 1;
    }

    .info-item {
        margin-bottom: 15px;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 4px;
        border-left: 4px solid #667eea;
    }

    .info-item h5 {
        margin: 0 0 5px 0;
        color: #333;
        font-weight: 600;
    }

    .info-item p {
        margin: 0;
        color: #666;
        font-size: 14px;
    }
</style>

<body>
    <div class="login-container">
        <div class="company-logo">
            <div class="logo-container">
                <img src="/logo/Shah_Alam_Emblem.svg.png" alt="Company Logo" class="company-logo-img">
            </div>
        </div>

        <h3 class="login-title">Log Masuk</h3>

        <form action="action.check" method="POST">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon-envelope"></i></span>
                    <input type="text" name="user" class="form-control" placeholder="Email Address" required>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon-lock"></i></span>
                    <input type="password" name="pass" class="form-control" placeholder="Kata Laluan" required>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="icon-signin"></i> Log Masuk
                </button>
            </div>

            <div class="signup-link">
                Belum Mempunyai Akaun? <a href="/signup.html" style="color: #0066cc;">Daftar Akaun</a>
            </div>
        </form>
    </div>

    <!-- Information Modal -->
    <!-- <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="infoModalLabel">
                        <i class="fa fa-info-circle"></i> Maklumat Sistem
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="info-item">
                        <h5><i class="fa fa-shield"></i> Keselamatan</h5>
                        <p>Sistem ini dilindungi dengan protokol keselamatan yang tinggi. Pastikan kata laluan anda kuat dan jangan kongsikan dengan orang lain.</p>
                    </div>

                    <div class="info-item">
                        <h5><i class="fa fa-clock-o"></i> Waktu Operasi</h5>
                        <p>Sistem beroperasi 24/7. Untuk sokongan teknikal, hubungi kami pada waktu pejabat (9:00 AM - 5:00 PM).</p>
                    </div>

                    <div class="info-item">
                        <h5><i class="fa fa-question-circle"></i> Lupa Kata Laluan?</h5>
                        <p>Jika anda lupa kata laluan, hubungi pentadbir sistem atau gunakan fungsi 'Reset Password' jika tersedia.</p>
                    </div>

                    <div class="info-item">
                        <h5><i class="fa fa-phone"></i> Hubungi Kami</h5>
                        <p>Email: support@shahalam.gov.my<br>
                            Telefon: +603-5510-3000<br>
                            Waktu: Isnin - Jumaat, 9:00 AM - 5:00 PM</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div> -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
    <script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
    <script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
    <!-- ================== END BASE JS ================== -->

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="assets/js/login-v2.demo.min.js"></script>
    <script src="assets/js/apps.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <script>
        $(document).ready(function() {
            App.init();
            LoginV2.init();
        });
    </script>
    <script>
        // Auto show modal when page loads
        $(document).ready(function() {
            $('#infoModal').modal('show');
        });
    </script>
</body>

</html>