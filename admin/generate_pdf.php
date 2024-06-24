<?php
require 'vendor/autoload.php';
require 'fetch_data.php';

use TCPDF as TCPDF;

function generate_pdf($table, $data) {
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 12);

    $html = '<h1>' . ucfirst($table) . '</h1>';
    $html .= '<table border="1" cellpadding="3">';
    $html .= '<tr>';

    foreach (array_keys($data[0]) as $heading) {
        $html .= '<th>' . $heading . '</th>';
    }

    $html .= '</tr>';

    foreach ($data as $row) {
        $html .= '<tr>';
        foreach ($row as $column) {
            $html .= '<td>' . $column . '</td>';
        }
        $html .= '</tr>';
    }

    $html .= '</table>';
    $pdf->writeHTML($html);
    $pdf->Output("$table.pdf", 'D');
}

if (isset($_GET['table'])) {
    $table = $_GET['table'];
    $data = fetch_data($table);
    generate_pdf($table, $data);
}
?>
