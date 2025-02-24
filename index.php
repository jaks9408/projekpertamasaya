
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

if (isset($_POST['bsimpan'])){
  //fungsi edit 
  if(isset($_GET ['hal'])=="edit"){
// data akan di edit
$edit = mysqli_query($koneksi,"UPDATE t_responden SET
                              nk = '$_POST[tnks]',
                              nama= '$_POST[tnama]',
                              latitude= '$_POST[tlatitude]',
                              longitude= '$_POST[tlongitude]',
                              pcl = '$_POST[tpcl]',
                              pml = '$_POST[tpml]',
                              tanggal = '$_POST[tcacah]'
                          WHERE  id_respoinden = '$_GET[id]'  
                              ");
if($edit) {
  echo"<script> alert('Edit data sukses');
  document.location = 'index.php';
  </script>";
  } else{
    echo"<script> alert('Edit data gagal');
  document.location = 'index.php';
  </script>
    ";
  }

  }else{

    // data akan di simpan baru
  $simpan = mysqli_query($koneksi," INSERT INTO t_responden (nk, nama, pcl, pml, tanggal, latitude, longitude)
                                                  VALUE ( '$_POST[tnks]',
                                                          '$_POST[tnama]',
                                                          '$_POST[tpcl]',
                                                          '$_POST[tpml]',
                                                          '$_POST[tcacah]',
                                                          '$_POST[tlatitude]',
                                                          '$_POST[tlongitude]')
                                                  ");
// uji simpan
if($simpan) {
  echo"<script> alert('Simpan data sukses');
  document.location = 'index.php';
  </script>";
} else{
    echo"<script> alert('Simpan data gagal');
  document.location = 'index.php';
  </script>
    ";
  }

  }

  
}

// deklarasi variabel data yanhg akan di edit
$vnk ="";
$vnama ="";
$vlatitude ="";
$vlongitude ="";
$vpcl ="";
$vpml ="";
$vtanggal ="";


// uji tombol edit dan hapus di klik
if (isset(($_GET['hal']))){
  // uji edit data
  if($_GET['hal']=="edit"){
// tampil data
$tampil = mysqli_query($koneksi,"SELECT * FROM t_responden WHERE id_respoinden= '$_GET[id]' ");
$data = mysqli_fetch_array($tampil);
if($data){

  // jika data ditemukan
  $vnk = $data['nk'];
  $vnama = $data['nama'];
  $vlatitude = $data['latitude'];
  $vlongitude = $data['longitude'];
  $vpcl = $data['pcl'];
  $vpml = $data['pml'];
  $vtanggal = $data['tanggal'];

}
  } else if ($_GET ['hal']== "hapus"){
    // hapus data
    $hapus = mysqli_query($koneksi,"DELETE FROM t_responden WHERE id_respoinden = '$_GET[id]' ");
  
    if($hapus) {
      echo"<script> alert('Hapus data sukses');
      document.location = 'index.php';
      </script>";
    } else{
        echo"<script> alert('Hapus data gagal');
      document.location = 'index.php';
      </script>
        ";
      }}
}


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOKASI RESPONDEN SUSENAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <!-- awal container -->
    <div class="container">
    <h3 class="text-center"><strong>ENTRI DATA LOKASI RESPONDEN SUSENAS</strong></h3>
    <h3 class="text-center"><strong>BPS KABUPATEN KEPULAUAN YAPEN</strong> </h3>
    <!-- awal row -->
    <div class="row">
        <div class="col-md-8 mx-auto">
        <div class="card">
  <div class="card-header bg-info text-light">
    <b>INPUT DATA RESPONDEN</b> 
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a class="btn btn-danger" href="login.php">Keluar</a>
    </div> 
  </div>
  
<div class="card-body">
    <!-- Awal Fom -->
    <form method="POST">
    <div class="mb-3">
<label  class="form-label">NKS</label>
  <input type="text" name="tnks"  value="<?=$vnk?>" class="form-control"  placeholder="Input Kode NKS">
</div>
<div class="mb-3">
  <label  class="form-label">Nama Responden</label>
  <input type="text" name="tnama" value="<?=$vnama?>" class="form-control"  placeholder="Nama Responden">
</div>
<div class="mb-3">
  <label  class="form-label">Latidude</label>
  <input type="text" name="tlatitude" value="<?=$vlatitude?>" class="form-control"  placeholder="Latitude">
</div>
<div class="mb-3">
  <label  class="form-label">Longitude</label>
  <input type="text" name="tlongitude" value="<?=$vlongitude?>" class="form-control"  placeholder="Longitude">
</div>

<div class="row">
    <div class="col">
    <div class="mb-2">
  <label  class="form-label">Desa</label>
  <input type="text" name="tpcl" value="<?=$vpcl?>" class="form-control"  placeholder="Desa">
</div>
        </div>
    <div class="col">
    <div class="mb-2">
  <label  class="form-label">Blok Sensus</label>
  <input type="text" name="tpml" value="<?=$vpml?>" class="form-control"  placeholder="Blok Sensus">
</div>
        </div>
    <div class="col">
        <div class="mb-2">
            <label  class="form-label">Tanggal Pencacahan</label>
            <input type="date" name="tcacah" value="<?=$vtanggal?>" class="form-control"  placeholder="Tanggal Pencacahan">
        </div>
    </div>

    <div class="text-center">

    <hr>
    <button class="btn btn-primary" name="bsimpan" type="submit">Simpan</button>
    <button class="btn btn-danger" name="bkosongkan" type="submit">Kosongkan</button>      
  </div>
    
</div>
    </form>
    <!-- Akhir Fom -->
    </div>
  <div class="card-footer bg-info">
  </div>
</div>
        </div>
    </div>
    <!-- akhir row -->
    <div class="card mt-3">
    <div class="card-header bg-info text-light">
    <strong>DATA RESPONDEN</strong>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a class="btn btn-success" href="user.php">Lihat Selengkapnya</a>
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
            <th>Desa</th>
            <th>Blok Sensus</th>
            <th>lokasi</th>
            <th>Tanggal Pencacahan</th>
            <th>Aksi</th>
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
            <td>
              <a href="index.php?hal=edit&id=<?=$data['id_respoinden']?>" class="btn btn-warning">Edit</a>

              <a href="index.php?hal=hapus&id=<?=$data['id_respoinden']?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Menghapus Data Ini?')" >Hapus</a>
            </td>
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