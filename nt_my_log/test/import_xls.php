<?php
set_time_limit(0); 
header('Content-Type: text/html; charset=utf-8');
 
//Connect DB
// $mysqli = new mysqli('localhost','username','password','db_name');
// if ($mysqli->connect_errno) {
//     die( "Failed to connect to MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
// }
// $mysqli->set_charset("utf8");
 
//File สำหรับ Import
$inputFileName="../tmt/tmt.xls";
 
/** PHPExcel */
require_once '../lib/PHPExcel/Classes/PHPExcel.php';
 
/** PHPExcel_IOFactory - Reader */
include '../lib/PHPExcel/Classes/PHPExcel/IOFactory.php';
 
 
$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
$objReader->setReadDataOnly(true);  
$objPHPExcel = $objReader->load($inputFileName);  
 
$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();
 
$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
$headingsArray = $headingsArray[1];
 
$r = -1;
$namedDataArray = array();
for ($row = 2; $row <= $highestRow; ++$row) {
    $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
        ++$r;
        foreach($headingsArray as $columnKey => $columnHeading) {
            $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
        }
    }
}
 
echo "<pre>";
print_r($namedDataArray);
echo "</pre>";
// foreach ($namedDataArray as $resx) {
//  //Insert
//   $query = " INSERT INTO tbl_name (field1,field2,field3,field4,field5,field6) VALUES
//       (
//        '".$resx['field1']."',
//        '".$resx['field2']."',
//        '".$resx['field3']."',
//        '".$resx['field4']."',
//        '".$resx['field5']."',
//        '".$resx['field6']."'
//       )";
//   $res_i = $mysqli->query($query);
//  //
// }
// $mysqli->close();
?>