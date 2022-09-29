<?php
$conn = mysqli_connect("localhost", "root", "", "db_sekolah");
function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows; 
}

function tambah($data){
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $umur = htmlspecialchars($data["umur"]); 
    $alamat = htmlspecialchars($data["alamat"]);
    //$foto = htmlspecialchars($data["foto"]);
    // cek apakah sudah upload foto atau belum
    $tgllahir = htmlspecialchars($data["tgllahir"]);
    $foto = upload_foto();
    if (!$foto) {
        return false;
    }



    $query = "INSERT INTO tb_siswa VALUES ('','$nama','$umur','$alamat','$foto', '$tgllahir')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM tb_siswa WHERE id=$id");
    return mysqli_affected_rows($conn);


}

function ubah($data) { 
    global $conn;
    $id =$_GET['id'];
    $nama = htmlspecialchars ($data["nama"]);
    $umur = htmlspecialchars ($data["umur"]);
    $alamat = htmlspecialchars ($data["alamat"]);
    //$foto  = $data["foto"];
    $tgllahir = htmlspecialchars($data["tgllahir"]);

    $fotoLama       = $data["foto_lama"];
    $noUploadFoto       = $_FILES['foto']['error'];

    if ($noUploadFoto === 4 ) {
        $foto = $fotoLama;
    }else {
        $foto = upload_foto();
    }

    $query = "UPDATE tb_siswa SET nama = '$nama', umur = $umur , alamat = '$alamat' , foto='$foto' , tgllahir='$tgllahir'   WHERE id=$id";

    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
}


        //function untuk menerima foto 
        function upload_foto(){
            $namaFoto = $_FILES['foto']['name']; // menerima nama foto
            $ukuranFoto = $_FILES['foto']['size']; // menerima ukuran foto
            $errorFoto = $_FILES['foto']['error']; // mengetahui error atau tidak
            $tempFoto = $_FILES['foto']['tmp_name']; //menaruh foto sementara 



            //cek upload foto 
            if ($errorFoto === 4) {
                echo "<script>
                alert('Mohon upload foto terlebih dahulu !');
                </script>";
                return false;
            }

            //cek ekstensi file
            $ekstensiFotoValid = ['jpg','jpeg','png','gif']; //
            $ekstensiFoto      = explode ('.', $namaFoto); //
            $ekstensiFoto      = strtolower(end($ekstensiFoto)); //

            //cek gambar atau bukan
            if (!in_array($ekstensiFoto, $ekstensiFotoValid)) {
                echo "<script>
                alert('File yang anda upload bukan gambar !');
                </script>";
                return false;
            }

            //cek ukuran maksimal foto
            if ($ukuranFoto ==2000000) {
                echo "<script>
                alert('Ukuran file terlalu besar  !');
                </script>";
                return false;
            }

            //Jika sudah melewati beberapa validasi, maka file akan disimpan ke storage
            $date = date('YmdHis');
            $kodeUnik = uniqid();
            move_uploaded_file($tempFoto,'img/' . $namaFoto . $date);
            return $namaFoto . $date;

        }
?>