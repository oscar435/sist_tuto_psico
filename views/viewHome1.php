<?php
session_start();
if (!isset($_SESSION['session_codigo'])) {
    header("Location: ../views/viewLoginEstudiante.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../assets/css/home/home1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include '../includes/headerHome1.php'; ?>
    <div class="container">
    </div>
    <div>
        <div class="row" style="margin-bottom:60px">


            <div class="col-4 align-buttons-center">
                
                <button class="btn btn-primary button-estudiante-opciones" onclick="window.location.href='get_all_tutorias_bandeja.php'">
                <i class="fa-solid fa-book"></i>    
                <span>TUTORIAS</span>
                </button>

            </div>

            <div class="col-4 align-buttons-center">
                <button  class="btn btn-primary button-estudiante-opciones" onclick="window.location.href='viewFormPsico.php'">
                    <!-- <img src="../images/icon_psicopedagogia.png" alt="Ayuda Psicopedagógica" class="button-icon"> -->
                    <i class="fa-solid fa-users"></i>
                    <span>AYUDA PSICOPEDAGOGICA</span>
                </button>
            </div>

            <div class="col-4 align-buttons-center">
                <button class="btn btn-primary button-estudiante-opciones" onclick="window.location.href='../includes/infofinal.php'">
                    <!-- <img src="../images/icon_info.png" alt="Información" class="button-icon"> -->
                    <i class="fa-solid fa-circle-info"></i>
                    <span>ACERCA DE</span>
                </button>
            </div>
        </div>
        <div id="footer">
            <?php include('../includes/footer.php'); ?>
        </div>

</body>

</html>