<?php

//import.php

include 'vendor/autoload.php';

$connect = new PDO("mysql:host=localhost;dbname=db_asmente", "root", "");
$kdunit = "";

if($_FILES["import_excel"]["name"] != ''){
 $allowed_extension = array('xls', 'csv', 'xlsx');
 $file_array = explode(".", $_FILES["import_excel"]["name"]);
 $file_extension = end($file_array);

 if(in_array($file_extension, $allowed_extension)){
  //Get Kode Unitnya
  $kdunit = $_POST['kodeunit'];
  if($kdunit == "UP3 PALOPO"){
      $kdunit = 'pl_rekapmaterial';
  }
  elseif($kdunit == "UP3 MAKASSAR SELATAN"){
      $kdunit = 'ms_rekapmaterial';
  }
  elseif($kdunit == "UP3 MAKASSAR UTARA"){
    $kdunit = 'mu_rekapmaterial';
  }
  elseif($kdunit == "UP3 PINRANG"){
    $kdunit = 'pg_rekapmaterial';
  }
  elseif($kdunit == "UP3 PARE PARE"){
    $kdunit = 'pr_rekapmaterial';
  }
  elseif($kdunit == "UP3 WATAMPONE"){
    $kdunit = 'wp_rekapmaterial';
  }
  elseif($kdunit == "UP3 MAMUJU"){
    $kdunit = 'mj_rekapmaterial';
  }
  elseif($kdunit == "UP3 KENDARI"){
    $kdunit = 'kd_rekapmaterial';
  }
  elseif($kdunit == "UP3 BAU BAU"){
    $kdunit = 'bb_rekapmaterial';
  }
  elseif($kdunit == "UP3 BULUKUMBA"){
    $kdunit = 'bk_rekapmaterial';
  }
  elseif($kdunit == "UP2D"){
    $kdunit = 'up2d_rekapmaterial';
  }
  else{
      $kdunit = "";
  }

  //Get Property file yang di upload
  $file_name = time() . '.' . $file_extension;
  move_uploaded_file($_FILES['import_excel']['tmp_name'], $file_name);
  $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
  $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

  $spreadsheet = $reader->load($file_name);

  unlink($file_name);

  $data = $spreadsheet->getActiveSheet()->toArray();
  //Hitung jika jumlah array kosong
  $number_rows = count($data);

   //Cek Apakah database kosong atau sudah ada isinya
    //Siapkan Variabel query yang akan digunakan
    $query = "";
    //Query untuk cek apakah tabel kosong atau tidak
    $querycheck = "SELECT * FROM ".$kdunit." WHERE 1";
    $stmtcheck = $connect->prepare($querycheck);
    $stmtcheck->execute();
   //Jika Query tidak kosong
    if(!empty($stmtcheck->fetchAll())){
        for($i = 0; $i < $number_rows; $i++){
           //Query
            $query = "UPDATE ".$kdunit." SET companycode = ".$data[$i][0]."
            ,codedescription = '".$data[$i][1]."'
            ,plant = ".$data[$i][2]."
            ,plantdescription = '".$data[$i][3]."'
            ,storagelocation = ".$data[$i][4]."
            ,storagelocationdesc = '".$data[$i][5]."'
            ,materialtype = '".$data[$i][6]."'
            ,materialtypedesc = '".$data[$i][7]."'
            ,nomormaterial = '".$data[$i][8]."'
            ,deskripsimaterial = '".$data[$i][9]."'
            ,materialgroup = '".$data[$i][10]."'
            ,baseunit = '".$data[$i][11]."'
            ,valuationtype = '".$data[$i][12]."'
            ,unrestrictedusestock = ".$data[$i][13]."
            ,qualityinspectionstock = ".$data[$i][14]."
            ,blockedstock = ".$data[$i][15]."
            ,intransitstock = ".$data[$i][16]."
            ,valuationclass = ".$data[$i][17]."
            ,description = '".$data[$i][18]."'
            WHERE id = ".($i);
           //Eksekusi Query
            $statement = $connect->prepare($query);
            $statement->execute();
        }
    }
   //Jika Query kosong
    else{
        for($i = 0; $i < $number_rows; $i++){
            //echo "Array ".$kdunit." is  empty";
            //echo "Jumlah rows = ".$number_rows." Nilai i ke - ".$i;
            $query = "INSERT INTO ".$kdunit." (companycode, codedescription, plant, plantdescription, storagelocation, storagelocationdesc,
            materialtype, materialtypedesc, nomormaterial, deskripsimaterial, materialgroup, baseunit, valuationtype, unrestrictedusestock,
            qualityinspectionstock, blockedstock, intransitstock, valuationclass, description)
            VALUES (".$data[$i][0].",'".$data[$i][1]."',".$data[$i][2].",'".$data[$i][3]."',".$data[$i][4].
            ",'".$data[$i][5]."','".$data[$i][6]."','".$data[$i][7]."','".$data[$i][8]."','".$data[$i][9].
            "','".$data[$i][10]."','".$data[$i][11]."','".$data[$i][12]."',".$data[$i][13].",".$data[$i][14].
            ",".$data[$i][15].",".$data[$i][16].",".$data[$i][17].",'".$data[$i][18]."')";
           //Eksekusi Query
            $statement = $connect->prepare($query);
            $statement->execute();
        }
    }

 }
}

?>