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
                            <h1 class="m-0 text-dark">Sedes <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-nSede-modal-xl"><i class="fas fa-plus-circle"></i></button></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#" onclick="ruta('home')">Home</a></li>
                                <li class="breadcrumb-item active">Sedes</li>
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
                                <table id="tablaSedes" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Empresa</th>
                                            <th>Ciudad</th>
                                            <th>Estado</th>
                                            <th>Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyTablaSedes" class="bodyTabla">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Empresa</th>
                                            <th>Ciudad</th>
                                            <th>Estado</th>
                                            <th>Editar</th
                                        </tr>
                                    </tfoot>
                                </table>
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
                            <div class="col-8"></div>
                            <div class="col-2" style="text-align: right">
                                <a style="color: white;" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                            </div>
                            <div class="col-2">
                                <!--<button  type="submit" class="btn btn-primary">Submit</button>-->
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
                            <div class="col-8"></div>
                            <div class="col-2" style="text-align: right">
                                <a style="color: white;" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                            </div>
                            <div class="col-2">
                                <!--<button  type="submit" class="btn btn-primary">Submit</button>-->
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