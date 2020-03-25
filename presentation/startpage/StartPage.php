<?php include "topbar/Main_topbar.php" ?>

<div class="container mt-5">
    <div class="row mx-auto">
        <div class="card d-none d-md-block col-md-8 col-lg-8">
            <img class="img-fluig"
                 src="src/img/inicio.jpg">
        </div>
        <div class="card col-12 col-sm-12 col-md-4 col-lg-4 p-0">
            <div class="card-header">
                <h4 class="segan">Iniciar Sesión</h4>
            </div>
            <div class="card-body">
                <form action="index.php?pid=<?= base64_encode('presentation/Signin.php')?>&nos=true"
                      method="POST">
                    <input type="hidden" name="form_auth" value="form_auth">
                    <div class="form-group">
                        <label for="form_auth_email">
                            <span class="fas fa-envelope"></span>
                            &nbsp;Correo:
                        </label>
                        <input type="email"
                               name="form_auth_email"
                               class="form-control"
                               placeholder="Correo Electrónico"
                               required> <!--poner required -->
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="form_auth_password">
                            <span class="fas fa-key"></span>
                            &nbsp;Contraseña:
                        </label>
                        <input type="password"
                               name="form_auth_password"
                               class="form-control"
                               placeholder="Contraseña"
                               required> <!--poner required -->
                    </div>
                    
                    <input type="submit" class="btn btn-primary" value="Iniciar Sesión">
                    
                    <hr>
                    
                    <a href="index.php?pid=<?= base64_encode('presentation/SignupSupplier.php')?>&nos=true">
                        Eres un proveedor? Regístrate gratis
                    </a>
                    
                </form>
            </div>
        </div>
    </div>
</div>