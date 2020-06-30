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
                            <h1 class="m-0 text-dark">Usuarios <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-nUsuario-modal-xl"><i class="fas fa-plus-circle"></i></button></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#" onclick="ruta('home')">Home</a></li>
                                <li class="breadcrumb-item active">Usuarios</li>
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
                                <table id="tablaUsuarios" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Documento</th>
                                            <th>Correo</th>
                                            <th>Rol</th>
                                            <th>Sede</th>
                                            <th>Estado</th>
                                            <th>Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyTablaUsuarios" class="bodyTabla">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Documento</th>
                                            <th>Correo</th>
                                            <th>Rol</th>
                                            <th>Sede</th>
                                            <th>Estado</th>
                                            <th>Editar</th>
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

<div id="modalNuevoUsuario" class="modal fade bd-nUsuario-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="javascript:guardarUsuario()" id="formNuevoUsuario">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="nombres">Nombres</label>
                                    <input type="text" class="form-control" name="nombres" placeholder="Nombres" value="" required>
                                </div>
                                <div class="col-6">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="telefono">Documento</label>
                                    <input type="text" class="form-control" name="documento" placeholder="Documento" value="" required>
                                </div>
                                <div class="col-6">
                                    <label for="correo">Correo</label>
                                    <input type="text" class="form-control" name="correo" placeholder="Correo" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label>Rol</label>
                                    <select class="form-control" name="rol" required>
                                        <option selected disabled>Selecciona</option>
                                        <option value="Administrador">Administrador</option>
                                        <option value="Funcionario">Funcionario</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Sede</label>
                                    <select class="form-control" id="sede" name="sede" required>
                                        <option value="0" selected>Selecciona empresa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="password">Contraseña</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" value="" required>
                                </div>
                                <div class="col-6">
                                    <label for="passwordC">Confirmar contraseña</label>
                                    <input type="password" class="form-control" id="passwordC" placeholder="Confirmar contraseña" value="" required>
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

<div id="modalEditarUsuario" class="modal fade bd-eUsuario-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="javascript:editarUsuario()" id="formEditarUsuario">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="documento">Documento</label>
                                    <input type="text" class="form-control" name="documento" id="documento" placeholder="Documento" required>
                                </div>
                                <div class="col-6">
                                    <label for="exampleInputFile">Foto</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="file">
                                            <label class="custom-file-label" for="exampleInputFile" id="fileLabel">Selecciona imagen</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Subir</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="nombres">Nombres</label>
                                    <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombres" value="" required>
                                </div>
                                <div class="col-6">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="correo">Correo</label>
                                    <input type="text" class="form-control" name="correo" id="correo" placeholder="Correo" value="" required>
                                </div>
                                <div class="col-6">
                                    <label for="telefono">Telefono</label>
                                    <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label>Departamento</label>
                                    <select onchange="cargarSelectCiudades(1)" class="form-control" id="departamentose" name="departamento" required>
                                        <option selected disabled>Selecciona</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Ciudad</label>
                                    <select class="form-control" id="ciudadese" name="ciudad" required>
                                        <option selected disabled>Selecciona un departamento</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="direccion">Direccion</label>
                                    <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion" value="" required>
                                </div>
                                <div class="col-6">
                                    <label for="exampleInputFile">Soportes</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="soporte">
                                            <label class="custom-file-label" for="exampleInputFile" id="soporteLabel">Selecciona archivo</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Subir</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="password">Contraseña</label>
                                    <input type="password" class="form-control" name="password" id="passworde" placeholder="Contraseña" value="" required>
                                </div>
                                <div class="col-6">
                                    <label for="passwordCe">Confirmar contraseña</label>
                                    <input type="password" class="form-control" id="passwordCe" placeholder="Confirmar contraseña" value="">
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