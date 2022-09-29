<?php
// echo "Hello World!";
// function Salam($nama)
// {
//     return "Halo $nama";
// }

$datasiswa = [
    [
        "nama" => "Wahyu",
        "umur" => "16",
        "alamat" => "Kudus",
        "foto" => "foto.jpg"
    ],
    [
        "nama" => "Kalam",
        "umur" => "17",
        "alamat" => "Yogyakarta",
        "foto" => "foto.jpg"
    ],
    [
        "nama" => "Firdan",
        "umur" => "16",
        "alamat" => "Kudus",
        "foto" => "foto.jpg"
    ]
];
require "function.php";

$datasiswa2 = mysqli_query($conn, "SELECT * FROM  tb_siswa")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar PHP Dasar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <style>
        body {
            width: 100%;
            height: 150vh;
            background-color: white;
        }

        .container {
            justify-content: center;
        }

        h1 {
            width: 100%;
            text-align: center;
            font-weight: 800;
        }

        tbody tr:nth-child(odd) {
            background-color: #f5f5f5;
        }
        
    </style>
</head>
<body>
    
    <?php 
    include "navbar.php";
    ?>

    <div class="container">
        <br>
        <h1>DATA SISWA 11 PPLG 1</h1><br>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                    <a type="button" href="tambah.php" class="btn btn-dark float-lg-end">Tambah Data</a>
                    <br> <br>
                        <table class="table table-bordered table-hover" style="text-align: center; vertical-align: middle; font-weight: bold; font-size: 20px;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Alamat</th>
                                <th>Aksi</th>    
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no=1;
                            foreach($datasiswa2 as $siswa) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $siswa["nama"]; ?></td>
                                    <td> <?= $siswa["umur"]; ?></td>
                                    <td><?= $siswa["alamat"]; ?></td>
                                    <td>
                                        <a type="button" class="btn btn-info"  href="" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $siswa['id']; ?>">Detail</a>
                                        <a type="button" class="btn btn-warning" href="ubah.php?id=<?=$siswa['id']?>"onclick="return confirm('Yakin Ingin Mengubah Data?');">Ubah</a>
                                        <a type="button" class="btn btn-danger" href="delete.php?id=<?=$siswa['id']?>" onclick="return confirm('Yakin Ingin Menghapus Data?');" class="btn btn-danger float-md-none">Hapus</a>
                                        <!-- <img src=img/<?= $siswa["foto"]; ?> alt="<?= $siswa["nama"]; ?>" width="100" height="100"> -->
                                    </td>
                                </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?= $siswa['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Data Siswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                        <label>Nama</label>
                                        <input required type="text" name="nama" id="nama" class="form-control mb-3" value="<?= $siswa['nama'] ?>" readonly>
                                        <input required type="number" name="umur" id="umur" placeholder="Masukkan umur"   class="form-control mb-3" value="<?= $siswa['umur'] ?>" readonly>
                                        <label>Alamat</label>
                                        <input required type="text" name="alamat" id="alamat" placeholder="Masukkan alamat"  class="form-control mb-3"value="<?= $siswa['alamat'] ?>" readonly>
                                        <label>Tanggal Lahir</label>
                                        <input required type="date" name="tgllahir" id="tgllahir" placeholder="Masukkan tanggal lahir"  class="form-control mb-3"value="<?= $siswa['tgllahir'] ?>" readonly>
                                        <label>Foto</label> <br>
                                        <img src="img/<?= $siswa["foto"]; ?>" alt="<?= $siswa["nama"]; ?>" width="100" height="100"> 
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a type="button" class="btn btn-warning" href="ubah.php?id=<?=$siswa['id']?>"onclick="return confirm('Yakin Ingin Mengubah Data?');">Ubah</a>
                                </div>
                                </div>
                            </div>
                            </div>
                            <?php endforeach; ?>
                        </body>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</body>

</html>