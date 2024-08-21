<?php
session_start();
require '../libraries/PHPMailer/PHPMailer.php';
require '../libraries/PHPMailer/SMTP.php';
require '../libraries/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Verificar si hay datos del formulario en la sesión
if (!isset($_SESSION['formData'])) {
    echo 'No hay datos para enviar el correo.';
    exit();
}

// Verificar si hay datos del estudiante en la sesión
if (!isset($_SESSION['studentData'])) {
    echo 'Datos del estudiante no disponibles.';
    exit();
}

$formData = $_SESSION['formData'];
$studentData = $_SESSION['studentData'];
$nombreCompleto = $_SESSION['session_fullname'] ?? 'Estudiante';
$emailEstudiante = $studentData['correo_institucional'] ?? 'no_proporcionado@unfv.edu.pe';

// Enviar el PDF por correo electrónico usando PHPMailer
$mail = new PHPMailer(true);

// Habilitar la depuración SMTP (comentar para producción)
// $mail->SMTPDebug = 2; // Activa el modo de depuración
// $mail->Debugoutput = 'html'; // Salida en HTML

try {
    // Configuración del servidor SMTP para Outlook
    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com'; // Servidor SMTP de Outlook
    $mail->SMTPAuth = true;
    $mail->Username = 'oficinaTutoria@outlook.com'; // Tu dirección de correo
    $mail->Password = 'oficinaPsico@789'; // Tu contraseña de correo
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Usa TLS
    $mail->Port = 587; // Puerto para TLS

    // Configuración del correo
    $mail->setFrom('oficinaTutoria@outlook.com', 'Oficina de Tutoría'); // Cambia el nombre si lo deseas
    $mail->addAddress($emailEstudiante, $nombreCompleto); // Dirección del destinatario
    $mail->addReplyTo('oficinaTutoria@outlook.com', 'Oficina de Tutoría'); // Dirección de respuesta

    $mail->isHTML(true);
    $mail->Subject = 'Resultados de la Encuesta Psicopedagogica';
    $mail->Body    = "<p>Estimado(a) $nombreCompleto,</p>
                      <p>Adjunto encontraras el PDF con los resultados de la encuesta psicopedagogica.</p>
                      <p>Saludos cordiales,</p>
                      <p>Equipo Psicopedagógico</p>";

    // Adjuntar el archivo PDF
    $pdfFilePath = realpath('../views/doc_pdf/resultados_encuesta.pdf');
    if (file_exists($pdfFilePath)) {
        $mail->addAttachment($pdfFilePath);
    } else {
        echo 'El archivo no existe: ' . $pdfFilePath;
        exit();
    }

    // Enviar el correo
    $mail->send(); 
    
    // Mostrar un mensaje de confirmación usando SweetAlert2
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Envio de Correo</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>";

    echo "<script>
        Swal.fire({
            title: 'Correo Enviado',
            text: 'El mensaje ha sido enviado exitosamente.',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../views/viewHome1.php'; // Opcional: redirigir después de aceptar
            }
        });
    </script>";

    echo "</body>
    </html>";

} catch (Exception $e) {
    // Mostrar un mensaje de error usando SweetAlert2
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Error de Envio</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>";

    echo "<script>
        Swal.fire({
            title: 'Error',
            text: 'El mensaje no se pudo enviar. Error de Mailer: {$mail->ErrorInfo}',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    </script>";

    echo "</body>
    </html>";

}
?>
