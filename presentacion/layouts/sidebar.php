<div class="sidebar" style="background: #1D5C75">
    <div class="logo">
        <div class="row">
            <div class="col " style="display: none" id="logo_mini">
                <a href="https://www.peoplemarketing.com/" class="simple-text logo-mini">
                    <img src="./../presentacion/imagenes/13.png" alt="" class="w-100">
                </a>
            </div>
            <div class="col d-flex justify-content-center">
                <a href="https://www.peoplemarketing.com/" class="simple-text logo-normal">
                    <div class="row-reverse">
                        <div class="col d-flex justify-content-center">
                            <img class="img" src="./../presentacion/imagenes/13.png" alt="" id="logo_max" style="width:70%;">
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#minimizeSidebar').click(function() {
                $('#logo_mini').toggle();
            })
        })
    </script>
    <div class="sidebar-wrapper" style="max-height: 70vh; overflow-x: hidden">
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="javascript:;" onclick="call_back()">
                    <i class="material-icons">home</i>
                    <p> Inicio </p>
                </a>
            </li>
            <script>
                function call_back() {
                    var iframe = document.getElementById('info');
                    iframe.src = '';

                    $('#info').hide('slow');
                    $('#content_welcome').show('slow');
                }
            </script>
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#pagesExamples5">
                    <i class="material-icons">person_add</i>
                    <p> Visitas
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="pagesExamples5">
                    <ul class="nav">
                        <li class="nav-item select_menu">
                            <a class="nav-link" href="../presentacion/form_paciente_nuevo.php" target="info">
                                <i class="material-icons">person_add</i>
                                <p> Crear visita </p>
                            </a>
                        </li>
                        <li class="nav-item select_menu">
                            <a class="nav-link" href="../presentacion/form_paciente_seguimiento.php" target="info">
                                <i class="material-icons">list</i>
                                <p> Seguimiento visita </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#pagesExamples3">
                    <i class="material-icons">pie_chart</i>
                    <p> Reportes
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="pagesExamples3">
                    <ul class="nav">
                        <li class="nav-item select_menu">
                            <a class="nav-link" href="../scriptcase" target="info">
                                <span class="sidebar-mini"> RS </span>
                                <span class="sidebar-normal"> Otros reportes </span>
                            </a>
                        </li>
                        <li class="nav-item select_menu">
                            <a class="nav-link" href="../presentacion/form_bi.php" target="info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="material-icons">leaderboard </i>
                                <span class="sidebar-normal"> BI </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#pagesExamples4">
                    <i class="material-icons">settings</i>
                    <p> Configuración
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="pagesExamples4">
                    <ul class="nav">
                        <li class="nav-item select_menu">
                            <a class="nav-link" href="../presentacion/form_usuarios.php" target="info">
                                <i class="material-icons">person_add</i>
                                <span class="sidebar-normal"> Usuarios </span>
                            </a>
                        </li>
                        <li class="nav-item select_menu">
                            <a class="nav-link" href="../presentacion/form_cuenta_usuario.php" target="info">
                                <i class="material-icons">person</i>
                                <span class="sidebar-normal"> Mi cuenta </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item ">
                <a class="nav-link logout" href="../logica/cerrar_sesion.php">
                    <i class="material-icons">logout</i>
                    <p> Cerrar sesión </p>
                </a>
                <style>
                    .logout:hover {
                        color: white !important;
                        font-weight: 700;
                        text-shadow: 1px 1px 2px black;
                    }
                </style>
            </li>
            <!-- <li class="nav-item ">
                <a class="nav-link" href="https://www.peoplemarketing.com/" target="_blank">
                    <img src="./../presentacion/layouts/img/people.png" alt="" class="w-100">
                </a>
            </li> -->
        </ul>
    </div>
</div>