<?php
include "koneksi.php";
include "oop.php";

$go = new oop();
$tabel = 'buku';
$redirect = '?menu=buku';
@$where = "bukuID = $_GET[id]";
        

if(isset($_POST['simpan'])){
    $field = array( 'kode' => @$_POST['kode'],
    				'judul' => @$_POST['judul'],
                    'penerbit' => @$_POST['penerbit'],
                    'pengarang' => @$_POST['pengarang'] 
            );
    $go->simpan($con, $tabel, $field, $redirect);
}

if(isset($_GET['hapus'])){
    $go->hapus($con, $tabel, $where, $redirect);
}

if(isset($_GET['edit'])){
    $edit = $go->edit($con, $tabel, $where);
}

if(isset($_POST['update'])){
	$field = array( 'kode' => @$_POST['kode'],
    				'judul' => @$_POST['judul'],
                    'penerbit' => @$_POST['penerbit'],
                    'pengarang' => @$_POST['pengarang'] 
            );
    $go->ubah($con, $tabel, $field, $where, $redirect);
}

?>

<form method="post">

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Kode Buku</label>
    <input type="text" name="kode" class="form-control" value="<?= @$edit['kode']?>">
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Judul</label>
    <input type="text" name="judul" class="form-control" value="<?= @$edit['judul']?>">
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Pengarang</label>
    <input type="text" name="pengarang" class="form-control" value="<?= @$edit['pengarang']?>">
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Penerbit</label>
    <input type="text" name="penerbit" class="form-control" value="<?= @$edit['penerbit']?>">
  </div>
  
  
    <?php if(@$_GET['id']=="") { ?>
        <button type="submit" class="btn btn-primary" name="simpan">SIMPAN</button>
    <?php } else { ?>
        <button type="submit" class="btn btn-primary" name="update">PERBARUI</button>
        <?php } ?>

</form>

<br>
<h1>Data Katalog Buku Perpustakaan</h1>
<br>
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Buku</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Aksi</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php
            $a = $go->tampil($con, $tabel);
            $no = 0;
            
            if($a == ""){
                echo "<tr> <td>No Record</td> </tr>";
            }else{

            foreach($a as $r){
            $no++;
        ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $r['kode'] ?></td>
            <td><?php echo $r['judul'] ?></td>
            <td><?php echo $r['pengarang'] ?></td>
            <td><?php echo $r['penerbit'] ?></td>
            <td><a href="?menu=buku&hapus&id=<?php echo $r['bukuID'] ?>" onclick="return confirm('Yakin mau hapus data?')">Hapus</a></td>
            <td><a href="?menu=buku&edit&id=<?php echo $r['bukuID'] ?>">Edit</a></td>
        </tr>
        <?php } } ?>
    </tbody>

</table>
