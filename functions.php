<?php 

function koneksi()
{
    //koneksi ke database dan pilih database
    return mysqli_connect('localhost', 'root', '', 'web');
}

function query($query)
{
    $conn = koneksi();

    $result = mysqli_query($conn, $query);

    // //jika hasilnya ada 1 data
    if(mysqli_num_rows($result)==1){
        return mysqli_fetch_assoc($result);
    }

    $rows = []; 
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function Tambah($data){
    $conn = koneksi();

    $Gambar = htmlspecialchars($data['Gambar']);
    $Nama = htmlspecialchars($data['Nama']);
    $Nim = htmlspecialchars($data['Nim']);
    $Email = htmlspecialchars($data['Email']);
    $Departemen = htmlspecialchars($data['Departemen']);
    
    $query = "INSERT INTO mahasiswa VALUES (null, '$Gambar', '$Nama', '$Nim', '$Email', '$Departemen');";

    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);

}

function Hapus($Id){
    $conn = koneksi();

    mysqli_query($conn, "DELETE FROM mahasiswa WHERE Id = $Id") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function Ubah($data){
    $conn = koneksi();

    $Id = ($data['Id']);
    $Gambar = htmlspecialchars($data['Gambar']);
    $Nama = htmlspecialchars($data['Nama']);
    $Nim = htmlspecialchars($data['Nim']);
    $Email = htmlspecialchars($data['Email']);
    $Departemen = htmlspecialchars($data['Departemen']);

    $query = "UPDATE mahasiswa SET
                Gambar = '$Gambar',
                Nama = '$Nama',
                Nim = '$Nim',
                Email = '$Email',
                Departemen = '$Departemen'
              WHERE Id = $Id";

    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function Cari($keyword){
    $conn = koneksi();

    $query = "SELECT * FROM mahasiswa WHERE 
                Nama LIKE '%$keyword%' OR
                Nim LIKE '%$keyword%' OR
                Email LIKE '%$keyword%' OR
                Departemen LIKE '%$keyword%'";
    
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }

    return $rows;
}
?>