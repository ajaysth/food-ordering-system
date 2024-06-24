<?php
require 'vendor/autoload.php';
require 'fetch_data.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function generate_excel($table, $data) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle(ucfirst($table));

    $columnIndex = 'A';
    foreach (array_keys($data[0]) as $heading) {
        $sheet->setCellValue($columnIndex . '1', $heading);
        $columnIndex++;
    }

    $rowIndex = 2;
    foreach ($data as $row) {
        $columnIndex = 'A';
        foreach ($row as $column) {
            $sheet->setCellValue($columnIndex . $rowIndex, $column);
            $columnIndex++;
        }
        $rowIndex++;
    }

    $writer = new Xlsx($spreadsheet);
    $fileName = "$table.xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=$fileName");
    $writer->save('php://output');
}

if (isset($_GET['table'])) {
    $table = $_GET['table'];
    $data = fetch_data($table);
    generate_excel($table, $data);
}
?>
