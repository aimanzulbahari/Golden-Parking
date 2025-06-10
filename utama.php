<style>
        body {
            background-color: #f5f5f5;
        }
        
        .panel-inverse {
            border-color: #333;
        }
        
        .panel-inverse > .panel-heading {
            background-color: #333;
            border-color: #333;
            color: #fff;
        }
        
        .status-card {
            margin-bottom: 20px;
            transition: transform 0.2s ease-in-out;
        }
        
        .status-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .card-body {
            padding: 20px;
            text-align: center;
        }
        
        .card-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
        
        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .card-count {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .btn-card {
            margin-top: 10px;
        }
        
        /* Card color themes */
        .card-new {
            border-left: 4px solid #5bc0de;
        }
        
        .card-new .card-icon {
            color: #5bc0de;
        }
        
        .card-review {
            border-left: 4px solid #f0ad4e;
        }
        
        .card-review .card-icon {
            color: #f0ad4e;
        }
        
        .card-approved {
            border-left: 4px solid #5cb85c;
        }
        
        .card-approved .card-icon {
            color: #5cb85c;
        }
        
        .card-cancelled {
            border-left: 4px solid #d9534f;
        }
        
        .card-cancelled .card-icon {
            color: #d9534f;
        }
        
        .page-header {
            margin-bottom: 30px;
        }
    </style>
<div class="row">
    <!-- Permohonan Baharu -->
    <div class="col-md-3 col-sm-6">
        <div class="panel panel-default status-card card-new">
            <div class="panel-body card-body">
                <div class="card-icon">
                    <i class="fa fa-file-text-o"></i>
                </div>
                <div class="card-title">Permohonan Baharu</div>
                <div class="card-count">24</div>
                <a href="#permohonan-baharu" class="btn btn-info btn-sm btn-card">
                    <i class="fa fa-eye"></i> Lihat Detail
                </a>
            </div>
        </div>
    </div>

    <!-- Dalam Semakan -->
    <div class="col-md-3 col-sm-6">
        <div class="panel panel-default status-card card-review">
            <div class="panel-body card-body">
                <div class="card-icon">
                    <i class="fa fa-search"></i>
                </div>
                <div class="card-title">Dalam Semakan</div>
                <div class="card-count">12</div>
                <a href="#dalam-semakan" class="btn btn-warning btn-sm btn-card">
                    <i class="fa fa-eye"></i> Lihat Detail
                </a>
            </div>
        </div>
    </div>

    <!-- Lulus -->
    <div class="col-md-3 col-sm-6">
        <div class="panel panel-default status-card card-approved">
            <div class="panel-body card-body">
                <div class="card-icon">
                    <i class="fa fa-check-circle"></i>
                </div>
                <div class="card-title">Lulus</div>
                <div class="card-count">85</div>
                <a href="#lulus" class="btn btn-success btn-sm btn-card">
                    <i class="fa fa-eye"></i> Lihat Detail
                </a>
            </div>
        </div>
    </div>

    <!-- Batal -->
    <div class="col-md-3 col-sm-6">
        <div class="panel panel-default status-card card-cancelled">
            <div class="panel-body card-body">
                <div class="card-icon">
                    <i class="fa fa-times-circle"></i>
                </div>
                <div class="card-title">Batal</div>
                <div class="card-count">7</div>
                <a href="#batal" class="btn btn-danger btn-sm btn-card">
                    <i class="fa fa-eye"></i> Lihat Detail
                </a>
            </div>
        </div>
    </div>
</div>