<?php include 'layouts/head.php'; ?>


<body class="body_background">
    
    <style>
        .body_background {
            background-image: url('layouts/img/background.png');
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0 !important;
            padding: 0 !important;
        }
    </style>
    
    
    <div class="row m-0 p-5">
        <div class="col-md-6 col-lg-5 col-sm-10 col-xs-10 mx-auto m-5">
            <form id="inicio" action="logica/ini_sesion.php" method="POST">
                <div class="row-reverse my-5">
                    <div class="col d-flex justify-content-center align-items-center mb-3">
                        <img src="layouts/img/3.png" alt="" class="w-50">
                    </div>
                    <div class="col-10 mx-auto mb-4">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="usuario" name="usuario" type="text" required="required" class="form-control" placeholder="Nombre de usuario">
                        </div>
                    </div>
                    <div class="col-10 mx-auto mb-4">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="Contrasena" name="Contrasena" type="password" required="required" class="form-control" placeholder="Contrase&ntilde;a">
                        </div>

                    </div>
                    <div class="col-10 mx-auto mb-3 d-flex justify-content-center align-items-center p-3">
                        <input id="Inicio" name="Inicio" type="submit" value="Iniciar Sesi&oacute;n" class="btn_iniar btn btn-success btn-lg" />
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php include 'layouts/end.php'; ?>