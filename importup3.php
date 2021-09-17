<?php

//import.php

include 'vendor/autoload.php';

$connect = new PDO("mysql:host=localhost;dbname=db_asmente", "root", "");
$kdunit = "";

if($_FILES["import_excel"]["name"] != '')
{
 $allowed_extension = array('xls', 'csv', 'xlsx');
 $file_array = explode(".", $_FILES["import_excel"]["name"]);
 $file_extension = end($file_array);

 if(in_array($file_extension, $allowed_extension))
 {
  //Get Kode Unitnya
  $kdunit = $_POST['kodeunit'];
  if($kdunit == "UP3 PALOPO"){
      $kdunit = 'pl_rekapmaterial';
  }

  //Get Property file yang di upload
  $file_name = time() . '.' . $file_extension;
  move_uploaded_file($_FILES['import_excel']['tmp_name'], $file_name);
  $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
  $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

  $spreadsheet = $reader->load($file_name);

  unlink($file_name);

  $data = $spreadsheet->getActiveSheet()->toArray();

  foreach($data as $row)
  {
   $insert_data = array(
    ':companycode' => $row[0],
    ':codedescription' => $row[1],
    ':plant' => $row[2],
    ':plantdescription' => $row[3],
    ':storagelocation' => $row[4],
    ':storagelocationdesc' => $row[5],
    ':materialtype' => $row[6],
    ':materialtypedesc' => $row[7],
    ':nomormaterial'  => $row[8],
    ':deskripsimaterial'  => $row[9],
    ':materialgroup' => $row[10],
    ':baseunit' => $row[11],
    ':valuationtype' => $row[12],
    ':unrestrictedusestock' => $row[13],
    ':qualityinspectionstock' => $row[14],
    ':blockedstock' => $row[15],
    ':intransitstock' => $row[16],
    ':valuationclass' => $row[17],
    ':description' => $row[18]
   );

   $query = "
   INSERT INTO ".$kdunit."
   (companycode, codedescription, plant, plantdescription, storagelocation, storagelocationdesc, materialtype, materialtypedesc,
   nomormaterial, deskripsimaterial, materialgroup, baseunit, valuationtype,
   unrestrictedusestock, qualityinspectionstock, blockedstock, intransitstock, valuationclass, description)
   VALUES (:companycode, :codedescription, :plant, :plantdescription, :storagelocation, :storagelocationdesc, :materialtype, :materialtypedesc,
   :nomormaterial, :deskripsimaterial, :materialgroup, :baseunit, :valuationtype,
   :unrestrictedusestock, :qualityinspectionstock, :blockedstock, :intransitstock, :valuationclass, :description)
   ";

   $statement = $connect->prepare($query);
   $statement->execute($insert_data);
  }
  $message = '<div class="alert alert-success">Data Imported Successfully</div>';

 }
 else
 {
  $message = '<div class="alert alert-danger">Only .xls .csv or .xlsx file allowed</div>';
 }
}
else
{
 $message = '<div class="alert alert-danger">Please Select File</div>';
}

echo $message;

?>