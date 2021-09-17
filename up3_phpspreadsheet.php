<!DOCTYPE html>
<html>
   <head>
     <title>HALAMAN UPLOAD UP3</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
   </head>
   <body>
     <div class="container">
      <br />
      <h3 align="center">Halaman Upload File .XLSX / CSV Gudang UP3</h3>
      <br />
        <div class="panel panel-default">
          <div class="panel-heading">Upload File hasil download dari SAP di sini</div>
          <div class="panel-body">
          <div class="table-responsive">
           <span id="message"></span>
              <form method="post" id="import_excel_form" enctype="multipart/form-data">
                <div class="form-row">
                  <select id="kodeunit" class="form-control" name="kodeunit">
                    <option selected>UNIT</option>
                    <option>UP3 MAKASSAR SELATAN</option>
                    <option>UP3 MAKASSAR UTARA</option>
                    <option>UP3 PALOPO</option>
                    <option>UP3 PINRANG</option>
                    <option>UP3 PARE PARE</option>
                    <option>UP3 WATAMPONE</option>
                    <option>UP3 MAMUJU</option>
                    <option>UP3 KENDARI</option>
                    <option>UP3 BAU BAU</option>
                    <option>UP3 BULUKUMBA</option>
                    <option>UP2D</option>
                    <option>UIW SULSELRABAR</option>
                  </select>
                </div>
                <table class="table">
                  <tr>
                    <td width="25%" align="right">Pilih File Excel</td>
                    <td width="50%"><input type="file" name="import_excel" /></td>
                    <td width="25%"><input type="submit" name="import" id="import" class="btn btn-primary" value="Import" /></td>
                  </tr>
                </table>
              </form>
           <br />
          </div>
          </div>
        </div>
     </div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  </body>
</html>
<script>
$(document).ready(function(){
  $('#import_excel_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      //Ganti tergantung file PHP yang akan digunakan untuk eksekusi database
      //url:"importup3.php",
      url:"updateimporup3.php",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#import').attr('disabled', 'disabled');
        $('#import').val('Importing...');
      },
      success:function(data)
      {
        $('#message').html(data);
        $('#import_excel_form')[0].reset();
        $('#import').attr('disabled', false);
        $('#import').val('Import');
      }
    })
  });
});
</script>