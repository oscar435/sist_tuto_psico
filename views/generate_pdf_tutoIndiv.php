<?php
require '../libraries/fpdf/fpdf.php';

// Iniciar la sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluye el archivo para cargar los datos del estudiante
require 'fetch_student_data.php'; // Esto carga los datos en la sesión, sin emitir JSON

// Verificar si hay datos del formulario en la sesión
if (!isset($_SESSION['tutoria_individual'])) {
    echo 'No hay datos para generar el PDF.';
    exit();
}

$formData = $_SESSION['tutoria_individual'];

// Verificar los datos del estudiante en la sesión
if (!isset($_SESSION['studentData'])) {
    echo 'Datos del estudiante no disponibles.';
    exit();
}

$studentData = $_SESSION['studentData'];



// Datos del estudiante
$userInfo = [
    'nombre_completo' => $_SESSION['session_fullname'] ?? 'No proporcionado',
    'telefono' => $studentData['telefono'] ?? 'No proporcionado',
    'correo_personal' => $studentData['correo_institucional'] ?? 'No proporcionado',
    'codigo_estudiante' => $_SESSION['session_codigo'] ?? 'No proporcionado',
    'escuela' => $studentData['nombre_escuela'] ?? 'No proporcionado', 
    'semestre' => $studentData['semestre'] ?? 'No proporcionado'
];

// Generar el PDF con FPDF
class PDF extends FPDF
{
    function __construct($orientation = 'P', $unit = 'mm', $size = 'A4')
    {
        parent::__construct($orientation, $unit, $size);
        $this->AddFont('ArialUnicodeFont', '', 'ArialUnicodeFont.php');
    }

    function Header()
    {
        $this->Image('../images/iconos/unfvLogoV.png', 15, 5, 50);
        $this->Image('../images/iconos/logofiei_2021.png', 145, 5, 50);
        $this->SetDrawColor(184, 116, 116);
        $this->SetLineWidth(1);
        $this->Line(10, 25, 200, 25);
        $this->Ln(15);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('ArialUnicodeFont', '', 8);
        $this->Cell(0, 10, mb_convert_encoding('Jr. Iquique Nº 127 - Breña Central Telefónica 748-0888 Anexo 9872', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
        $this->Cell(0, 10, mb_convert_encoding('Página ' . $this->PageNo(), 'ISO-8859-1', 'UTF-8'), 0, 0, 'R');
    }

    function ChapterTitle($num, $label)
    {
        $this->SetFillColor(83, 59, 57);
        $this->SetTextColor(255, 255, 255);
        $this->Ln(2.5);
        $this->Rect(10, $this->GetY(), 190, 8, 'F');
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, "$label", 0, 1, 'C', false);
        $this->Ln(4);
    }

    function DiagnosticTitle($label)
    {
        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 10, $label, 0, 1, 'L');
        $this->Ln(0.5);
    }

    function PersonalAndAcademicData($userInfo)
    {
        $this->SetFont('Arial', 'B', 9);
        $this->SetTextColor(50, 60, 100);
        $this->Cell(90, 10, mb_convert_encoding('Datos Personales', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $this->Cell(90, 10, mb_convert_encoding('Información Académica', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C');
        $this->SetFont('Arial', '', 9);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(90, 8, 'Nombre completo: ' . $userInfo['nombre_completo'], 0, 1);
        $this->Cell(90, 8, mb_convert_encoding('Número de teléfono: ', 'ISO-8859-1', 'UTF-8') . $userInfo['telefono'], 0, 1);
        $this->Cell(90, 8, 'Correo institucional: ' . $userInfo['correo_personal'], 0, 1);

        $x = 103;
        $y = $this->GetY() - 24;

        $this->SetXY($x, $y);
        $this->Cell(90, 8, mb_convert_encoding('Código de estudiante: ', 'ISO-8859-1', 'UTF-8') . $userInfo['codigo_estudiante'], 0, 1);
        $this->SetXY($x, $y + 8);
        $this->Cell(90, 8, mb_convert_encoding(': ', 'ISO-8859-1', 'UTF-8') . $userInfo[''], 0, 1);
        $this->SetXY($x, $y + 16);
        $this->Cell(90, 8, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8') . $userInfo[''], 0, 1);
        $this->Ln(0.5);
    }

    function TutoriaDetails($formData)
    {
        $this->SetFont('Arial', 'B', 10);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 10, mb_convert_encoding('Motivo de la Tutoria', 'ISO-8859-1', 'UTF-8'), 0, 1);
        $this->SetFont('Arial', '', 9);
        $this->MultiCell(0, 10, isset($formData['motivo']) ? $formData['motivo'] : 'No respondido', 0, 'L');
        $this->Ln(10);
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->ChapterTitle(1, 'FORMULARIO DE TUTORIA INDIVIDUAL');
$pdf->PersonalAndAcademicData($userInfo);
$pdf->DiagnosticTitle(mb_convert_encoding('Detalles de la Tutoria:', 'ISO-8859-1', 'UTF-8'));
$pdf->TutoriaDetails($formData);

$pdfFilePath = '../views/doc_pdf/resultados_tutoria.pdf';
$pdf->Output('F', $pdfFilePath);

// Verificar si el archivo se guardó correctamente
if (file_exists($pdfFilePath)) {
    header('Location: send_tutoria_email.php');
    exit();
} else {
    echo 'Error al generar el PDF.';
}
