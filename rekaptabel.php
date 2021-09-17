<?php
    $connect = new PDO("mysql:host=localhost;dbname=db_asmente", "root", "");
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
        <div class="row justify-content-md-center">
            <h1>Rekap Material</h1>
        </div>
        <div class="row justify-content-md-center mt-3">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Nomor</th>
                    <th scope="col">Nama Material</th>
                    <th scope="col">UP3 MS</th>
                    <th scope="col">UP3 MU</th>
                    <th scope="col">UP3 PL</th>
                    <th scope="col">UP3 PG</th>
                    <th scope="col">UP3 PR</th>
                    <th scope="col">UP3 WP</th>
                    <th scope="col">UP3 BB</th>
                    <th scope="col">UP3 BK</th>
                    <th scope="col">UP3 KD</th>
                    <th scope="col">UP3 MJ</th>
                    <th scope="col">UIW SSTB</th>
                    </tr>
            </thead>
            <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>MTR;kWH E;;3P;230/400V;5-80A;1;;4W</td>
                    <!--UP3 MS-->
                    <td><?php
                            $queryms = "SELECT SUM(unrestrictedusestock) FROM ms_rekapmaterial WHERE nomormaterial = '000000002190218'";
                            $stmtms = $connect->prepare($queryms);
                            $stmtms->execute();
                            $stockms = $stmtms->fetchAll();
                            //print_r($stockms);
                            echo $stockms[0][0];
                        ?>
                    </td>
                    <!--UP3 MU-->
                    <td><?php
                            $querymu = "SELECT SUM(unrestrictedusestock) FROM mu_rekapmaterial WHERE nomormaterial = '000000002190218'";
                            $stmtmu = $connect->prepare($querymu);
                            $stmtmu->execute();
                            $stockmu = $stmtmu->fetchAll();
                            //print_r($stockms);
                            echo $stockmu[0][0];
                        ?>
                    </td>
                    <!--UP3 PL-->
                    <td><?php
                            $querypl = "SELECT SUM(unrestrictedusestock) FROM pl_rekapmaterial WHERE nomormaterial = '000000002190218'";
                            $stmtpl = $connect->prepare($querypl);
                            $stmtpl->execute();
                            $stockpl = $stmtpl->fetchAll();
                            //print_r($stockms);
                            echo $stockpl[0][0];
                        ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!--UIW SSTB-->
                    <td><?php
                            echo (int)$stockms[0][0] + (int)$stockpl[0][0];
                        ?>
                    </td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>MTR;kWH E-PR;;1P;230V;5-60A;1;;2W</td>
                    <!--UP3 MS-->
                    <td><?php
                            $queryms = "SELECT SUM(unrestrictedusestock) FROM ms_rekapmaterial WHERE nomormaterial = '000000002190224'";
                            $stmtms = $connect->prepare($queryms);
                            $stmtms->execute();
                            $stockms = $stmtms->fetchAll();
                            //print_r($stockms);
                            echo $stockms[0][0];
                        ?>
                    </td>
                    <!--UP3 MU-->
                    <td><?php
                            $querymu = "SELECT SUM(unrestrictedusestock) FROM mu_rekapmaterial WHERE nomormaterial = '000000002190224'";
                            $stmtmu = $connect->prepare($querymu);
                            $stmtmu->execute();
                            $stockmu = $stmtmu->fetchAll();
                            //print_r($stockms);
                            echo $stockmu[0][0];
                        ?>
                    </td>
                    <!--UP3 PL-->
                    <td><?php
                            $querypl = "SELECT SUM(unrestrictedusestock) FROM pl_rekapmaterial WHERE nomormaterial = '000000002190224'";
                            $stmtpl = $connect->prepare($querypl);
                            $stmtpl->execute();
                            $stockpl = $stmtpl->fetchAll();
                            //print_r($stockms);
                            echo $stockpl[0][0];
                        ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!--UIW SSTB-->
                    <td>
                    <?php
                        echo (int)$stockms[0][0] + (int)$stockpl[0][0];
                    ?>
                    </td>
                    </tr>
            </tbody>
            </table>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   <!--JAVASCRIPT UNTUK MENGAMBIL NILAI TOTAL UIW-->
    <script>

    </script>
  </body>
</html>