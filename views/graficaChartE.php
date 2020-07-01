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
                            <h1 class="m-0 text-dark">Grafica barras
                            <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-nSede-modal-xl"><i class="fas fa-plus-circle"></i></button></h1>-->
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#" onclick="ruta('home')">Home</a></li>
                                <li class="breadcrumb-item active">Grafica barras</li>
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
                                    </div>
                                    <div class="row">
                                        <div class="col-12" style="height: 58vh; padding-top: 1.5vh">
                                            <div class="card col-12" style="height: 55vh">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

<div id="modalNuevaSede" class="modal fade bd-nSede-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva sede</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="javascript:guardarSede()" id="formNuevaSede">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="" required>
                                </div>
                                <div class="col-6">
                                    <label>Empresa</label>
                                    <select class="form-control" name="empresa" id="empresa" required>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label>Departamento</label>
                                    <select onchange="cargarSelectCiudad();" class="form-control" name="departamento" id="departamento" required>

                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Ciudad</label>
                                    <select class="form-control" name="ciudad" id="ciudad" required>
                                        <option selected disabled>Selecciona un departamento</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-2 offset-10">
                                <!--<button  type="submit" class="btn btn-primary">Submit</button>-->
                                <a style="color: white;" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--            <div class="modal-footer">
            
                        </div>-->
        </div>
    </div>
</div>

<div id="modalEditarSede" class="modal fade bd-eSede-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar sede</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="javascript:editarSede()" id="formEditarSede">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="" required>
                                </div>
                                <div class="col-6">
                                    <label>Empresa</label>
                                    <select class="form-control" name="empresa" id="empresae" required>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label>Departamento</label>
                                    <select onchange="cargarSelectCiudad();" class="form-control" name="departamento" id="departamentoe" required>

                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Ciudad</label>
                                    <select class="form-control" name="ciudad" id="ciudade" required>
                                        <option selected disabled>Selecciona un departamento</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-2 offset-10">
                                <!--<button  type="submit" class="btn btn-primary">Submit</button>-->
                                <a style="color: white;" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                                <button type="submit" class="btn btn-primary">Editar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--            <div class="modal-footer">
            
                        </div>-->
        </div>
    </div>
</div>

<?php include 'views/overalls/footer.php'; ?>

<script>
    //
    $(document).ready(function () {
        //
        cargarConfiguraciones();
    });
</script>