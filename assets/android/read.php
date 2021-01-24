<?php 
include('db_connect.php');

$sql = "SELECT nama_product, keterangan, harga, gambar FROM tb_product";

$response = mysqli_query($conn, $sql);

$result = array();
$result['read'] = array();

if(mysqli_num_rows($response)===1){
	if($row = mysqli_fetch_assoc($response)){
		$h['nama_product'] = $row['nama_product'];
		$h['harga'] = $row['harga'];
		$h['nama_product'] = $row['nama_product'];
	}
 }?>
