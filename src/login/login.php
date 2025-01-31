<!-- -->
<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="icon" type="image/png" href="../../assets/img/img_pg/SWEVEN-ADVISOR_ColorNegro.png" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../assets/login/css/bootstrap.min.css" />
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="../../assets/login/css/all.min.css" />
    <link rel="stylesheet" href="../../assets/login/css/uf-style.css" />
    <title>Inicio de Sesión</title>
</head>

<body>
    <div class="uf-form-signin">
        <div class="text-center">
            <a href="#"><img src="../../assets/img/img_pg/SWEVEN-ADVISOR.png" alt="" width="100" height="100" /></a>
            <h1 class="text-white h3">Iniciar Sesión</h1>
        </div>


        <?php
        session_start();
        if (isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
            unset($_SESSION['error_message']); // Limpiar el mensaje después de mostrarlo
        }
        ?>


        <form action="../controllers/loginController.php" method="post" class="mt-4">
            <div class="input-group uf-input-group input-group-lg mb-3">
                <span class="input-group-text fa fa-user"></span>
                <input type="text" class="form-control" name="email" placeholder="Correo electronico" />
            </div>
            <div class="input-group uf-input-group input-group-lg mb-3">
                <span class="input-group-text fa fa-lock"></span>
                <input type="password" class="form-control" name="password" placeholder="Password" />
            </div>
            <div class="d-flex mb-3 justify-content-between">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input uf-form-check-input" id="exampleCheck1" />
                    <label class="form-check-label text-white" for="exampleCheck1">Remember Me</label>
                </div>
                <a href="#">Forgot password?</a>
            </div>
            <div class="d-grid mb-4">
                <button type="submit" class="btn uf-btn-primary btn-lg">
                    Iniciar Sesión
                </button>
            </div>

        </form>
    </div>

    <style>
        .contentMsjError {
            display: flex;
            justify-content: center;
            gap: 4px;

        }

        .contentMsjError .msjColor {
            width: 8px;
            height: 24px;
            background-color: red;
        }
    </style>

    <!-- JavaScript -->

    <!-- Separate Popper and Bootstrap JS -->
    <script src="../../assets/login/js/popper.min.js"></script>
    <script src="../../assets/login/js/bootstrap.min.js"></script>
</body>

</html>