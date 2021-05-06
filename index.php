<?php
session_start();
ob_start();
require_once('includes/load.php');
if ($session->isUserLoggedIn(true)) {
    redirect('home.php', false);
}
?>
<!DOCTYPE html>
<html lang="en">

<style>
body {
  background-image: url('https://wallup.net/wp-content/uploads/2018/10/09/132636-cats-dogs-pets.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}
</style>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

<head><meta charset="euc-jp">
    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Dashboard Experto</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/app.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/bundles/bootstrap-social/bootstrap-social.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='<?= BASE_URL ?>/assets/img/favicon.ico' />
</head>


<body>
    <div class="loader"></div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                       
                        <div class="login-brand">
                        <img alt="image" src="assets/img/logo.png" >
                        </div>
                       
                        <div class="card card-primary">
                    
                            <div class="card-header">
                                <h4>Acceso</h4>
                            </div>
                            <div class="card-body">                            
                                <form method="POST" action="auth.php" class="needs-validation" novalidate="">
                                    <div class="form-group">
                                        <label for="email">Nombre de usuario</label>
                                        <input id="email" type="text" class="form-control" name="email" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Por favor ingrese su nombre de usuario
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Contraseña</label>                                          
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            por favor ingrese su contraseña
                                        </div>
                                    </div>                                   
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Entrar
                                        </button>
                                    </div>
                                </form>                             
                            </div>
                        </div>  
                                
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- General JS Scripts -->
    <script src="<?= BASE_URL ?>/assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="<?= BASE_URL ?>/assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="<?= BASE_URL ?>/assets/js/custom.js"></script>
</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

</html>