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
                            <h1 class="m-0 text-dark">Tvs <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-nTv-modal-xl"><i class="fas fa-plus-circle"></i></button></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#" onclick="ruta('home')">Home</a></li>
                                <li class="breadcrumb-item active">Tvs</li>
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
                                <table id="tablaTvs" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Videos</th>
                                            <th>Estado</th>
                                            <th>Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyTablaTvs" class="bodyTabla">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Videos</th>
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

<div id="modalNuevoTv" class="modal fade bd-nTv-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo tv</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="javascript:guardarTv()" id="formNuevoTv">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="" required>
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

<div id="modalEditarTv" class="modal fade bd-eTv-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar tv</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="javascript:editarTv()" id="formEditarTv">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="" required>
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

<!--MODAL videos PARA el tv-->
<div id="modalVideosTv" class="modal fade bd-videosTv-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Videos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="javascript:guardarVideo()" id="formVideo">
                    <div class="card-body">
                        <div class="form-group" style="margin-bottom: 0px;">
                            <div class="row">
                                <div class="col-4">
                                    <label for="nombre">Orden</label>
                                    <input type="text" class="form-control" name="orden" id="orden" placeholder="Orden" value="" required>
                                </div>
                                <div class="col-4">
                                    <label for="exampleInputFile">Video</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="file" required>
                                            <label class="custom-file-label" for="exampleInputFile">Selecciona video</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Subir</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label>Volumen</label>
                                    <select class="form-control" name="volumen" id="volumen" required>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 5px;">
                                <table id="tablaVideosTv" class="table table-bordered table-striped" style="overflow: auto;">
                                    <thead>
                                        <tr>
                                            <th>Orden</th>
                                            <th>Nombre</th>
                                            <th>Volumen</th>
                                            <th>Estado</th>
                                            <th>Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyTablaVideosTv" class="bodyTabla">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Orden</th>
                                            <th>Nombre</th>
                                            <th>Volumen</th>
                                            <th>Estado</th>
                                            <th>Editar</th>
                                        </tr>
                                    </tfoot>
                                </table>
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
        </div>
    </div>
</div>

<!--MODAL editar videos-->
<div id="modalEditarVideo" class="modal fade bd-eVideoTv-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar videos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="javascript:editarVideo()" id="formEditarVideo">
                    <div class="card-body">
                        <div class="form-group" style="margin-bottom: 0px;">
                            <div class="row">
                                <div class="col-4">
                                    <label for="nombre">Orden</label>
                                    <input type="text" class="form-control" name="orden" id="ordene" placeholder="Orden" value="" required>
                                </div>
                                <div class="col-4">
                                    <label for="exampleInputFile">Video</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="file" required>
                                            <label class="custom-file-label" for="exampleInputFile" id="fileLabel">Selecciona video</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Subir</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label>Volumen</label>
                                    <select class="form-control" name="volumen" id="volumene" required>
                                        
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
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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