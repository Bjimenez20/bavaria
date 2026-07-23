<?php include 'layouts/head.php'; ?>
<div class="row m-0 align-items-center" style="min-height:100vh;">
    <div class="col-md-6 col-lg-5 col-sm-10 col-xs-10 mx-auto">
        <form id="inicio" action="logica/ini_sesion.php" method="POST">
            <div class="row-reverse">
                <div class="col-10 mx-auto mb-4">
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <span class="iconify" data-icon="carbon:email"></span>
                            </span>
                        </div>
                        <input id="email" name="email" type="email"
                            required class="form-control"
                            placeholder="Correo Electronico">
                    </div>
                </div>

                <div class="col-10 mx-auto mb-4">
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <span class="iconify" data-icon="carbon:password"></span>
                            </span>
                        </div>
                        <input id="Contrasena" name="Contrasena" type="password"
                            required class="form-control"
                            placeholder="Contraseña">
                    </div>
                </div>

                <div class="col-10 mx-auto text-center">
                    <input id="Inicio" name="Inicio" type="submit"
                        value="Iniciar Sesión"
                        class="btn_iniar btn btn-success">
                </div>
            </div>
        </form>
    </div>
</div>
<?php include 'layouts/end.php'; ?>