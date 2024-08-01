<?php
    $server ="localhost";
    $user ="root";
    $pass ="";
    $dbname ="proyekkd";
    //ini untuk pariabel koneksi 
    $koneksi = mysqli_connect($server, $user, $pass, $dbname) or die(mysqli_error($koneksi));
    //kondisi untuk melihat true atau false 
    if ($koneksi->connect_error) 
        die("Koneksi gagal: " . $koneksi->connect_error);

    if ($koneksi == TRUE){
        // echo  "berhasi terhubung";

    }else{
        // echo  "gagal terhubung";
    }



?>