<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include 'views/overalls/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include 'views/overalls/menu.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Reportes</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#" onclick="ruta('home')">Home</a></li>
                                <li class="breadcrumb-item active">Reportes</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-body" style="padding: 0px;">
                                <form role="form" action="javascript:generarReporte()" id="formReporte">
                                    <div class="form-group">
                                        <div class="row">    
                                            <div class="col-4">
                                                <label>Fecha Inicial</label>
                                                <input type="date" class="form-control" name="fechaInicial" id="fechaInicial" required>
                                            </div>
                                            <div class="col-4">
                                                <label>Fecha Final</label>
                                                <input type="date" class="form-control" name="fechaFinal" id="fechaFinal" required>
                                            </div>
                                            <div class="col-4">
                                                <button type="submit" class="btn btn-primary" style="margin-top: 4.5vh;">Consultar</button>
                                                <a id="btnExcel" onclick="" class="btn btn-success" style="margin-top: 4.5vh; color: white;"><i class="fas fa-cloud-download-alt"></i> Excel</a>
                                                <a id="btnPdf" onclick="" class="btn btn-danger" style="margin-top: 4.5vh; color: white;"><i class="fas fa-cloud-download-alt"></i> Pdf</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12" style="height: 58vh; padding-top: 1.5vh">
                                                <div class="card col-12" style="height: 55vh">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- /.col-md-6 -->
                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?php include 'views/overalls/footerP.php'; ?>

    </div>

    <!-- ./wrapper -->
</body>

<?php include 'views/overalls/footer.php'; ?>

<script>
    //
    $(document).ready(function () {
        //
        cargarConfiguraciones();
    });
</script>