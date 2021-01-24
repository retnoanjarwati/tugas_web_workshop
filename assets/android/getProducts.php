<?php

include('db_connect.php');

$stmt = $conn->prepare("SELECT nama_product, keterangan, harga, gambar FROM tb_product");

$stmt ->execute();
$stmt -> bind_result($nama_product, $keterangan, $harga, $gambar);

$products = array();

while($stmt ->fetch()){

    $temp = array();
	
	$temp['nama_product'] = $nama_product;
	$temp['harga'] = $harga;
	$temp['keterangan'] = $keterangan;
	$temp['gambar'] = "http://192.168.1.13/tokoSayur_fix/assets/upload/image/thumbs/".$gambar;

	array_push($products,$temp);
	}

	echo json_encode($products);

?>