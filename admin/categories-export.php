<?php

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php"); 

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Tipo');
$sheet->setCellValue('B1', 'Concepto');
$sheet->setCellValue('C1', 'Categoría');

$cat = array();

// Obtener categorías principales
$query = "SELECT * FROM accountingCategories WHERE parent = '0'";
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $cat[$row['id']]['name'] = $row['name'];

    // Obtener subcategorías de primer nivel
    $query2 = "SELECT * FROM accountingCategories WHERE parent = '{$row['id']}'";
    $result2 = mysqli_query($con, $query2);

    while ($row2 = mysqli_fetch_assoc($result2)) {
        $cat[$row['id']]['sub'][$row2['id']]['name'] = $row2['name'];

        // Obtener subcategorías de segundo nivel
        $query3 = "SELECT * FROM accountingCategories WHERE parent = '{$row2['id']}'";
        $result3 = mysqli_query($con, $query3);

        while ($row3 = mysqli_fetch_assoc($result3)) {
            $cat[$row['id']]['sub'][$row2['id']]['sub'][$row3['id']] = $row3['name'];
        }
    }
}

// Escribir los datos en el archivo Excel
$xlsRow = 2;
foreach ($cat as $id => $mainCategory) {
    $tipo = $mainCategory['name'];

    if (isset($mainCategory['sub'])) {
        foreach ($mainCategory['sub'] as $subId => $subCategory) {
            $concepto = $subCategory['name'];

            if (isset($subCategory['sub'])) {
                foreach ($subCategory['sub'] as $subSubId => $subSubCategory) {
                    $sheet->setCellValue('A' . $xlsRow, $tipo);
                    $sheet->setCellValue('B' . $xlsRow, $concepto);
                    $sheet->setCellValue('C' . $xlsRow, $subSubCategory);
                    $xlsRow++;
                }
            } else {
                $sheet->setCellValue('A' . $xlsRow, $tipo);
                $sheet->setCellValue('B' . $xlsRow, $concepto);
                $sheet->setCellValue('C' . $xlsRow, '');
                $xlsRow++;
            }
        }
    } else {
        $sheet->setCellValue('A' . $xlsRow, $tipo);
        $sheet->setCellValue('B' . $xlsRow, '');
        $sheet->setCellValue('C' . $xlsRow, '');
        $xlsRow++;
    }
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="tiempos-global.xlsx"');
header('Cache-Control: max-age=0');
header('Expires: 0');
header('Pragma: public');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>