<?php
// koneksi
$server = "localhost";
$user = "root";
$password= "";
$database = "dbcrud2022";
// buat koneksi
$koneksi = mysqli_connect ($server, $user, $password, $database) or die (mysqli_error($koneksi));

// fungsi login

// jika tombol simpan di klik

?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> LOKASI RESPONDEN SUSENAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <!-- awal container -->
    <div class="container">
    <h3 class="text-center"><strong>DATA LOKASI RESPONDEN SUSENAS</strong></h3>
    <h3 class="text-center"><strong>BPS KABUPATEN KEPULAUAN YAPEN</strong> </h3>
    <!-- awal row -->
    
    <!-- akhir row -->
    <div class="card mt-3">
    <div class="card-header bg-info text-light">
    <strong>DATA RESPONDEN</strong>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a class="btn btn-danger" href="login.php">Keluar</a>
    </div> 
    </div> 
        <div class="card-body">
          <div class="col-md-6 mx-auto">
          <form method="POST"> 
              <div class="input-group mb-3">
                <input type="text" name="tcari" value="<?= @$_POST['tcari']?>" class="form form-control" placeholder="Masukan NKS">
                <button class="btn btn-primary" name="bcari" type="submit">Cari</button>
                <button class="btn btn-danger" name="breset" type="submit">Reset</button>
              </div>
            </form>
          
          </div>
          <div class="table-responsive">
        <table class="table table-striped table-hover table-border">
          <tr>
            <th>No.</th>
            <th>NKS</th>
            <th>Nama Responden</th>
            <th>Nama PCL</th>
            <th>Nama PML</th>
            <th>lokasi</th>
            <th>Tanggal Pencacahan</th>
          </tr>
          <?php
          // persiapan menampillkan data
          $no = 1;
          // untuk pencarian data
          // jika tombol cari di klik
          if (isset(($_POST['bcari']))){

            $keyword = $_POST['tcari'];
            $q = "SELECT * FROM t_responden WHERE nk like '%$keyword%' or nama like'%$$keyword%' order by id_respoinden desc ";
          }else{
            $q =  "SELECT * FROM t_responden order by id_respoinden desc";
          }
          $tampil = mysqli_query ($koneksi,$q);
          while ($data = mysqli_fetch_array($tampil)):

          ?>
          <tr>
            <td><?= $no++?></td>
            <td><?= $data['nk']?></td>
            <td><?= $data['nama']?></td>
            <td><?= $data['pcl']?></td>
            <td><?= $data['pml']?></td>
            <td><iframe src='https://www.google.com/maps?q=<?php echo $data['latitude']; ?>,<?php echo $data['longitude']; ?>&h1=es;z=14&output=embed'></iframe></td>

            <td><?= $data['tanggal']?></td>
            
          </tr>
          <?php endwhile; ?>
        </table>
        </div>
    <div class="card-footer bg-info">
   </div>
  </div>
</div> 
</div>
<!-- akhir container -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
