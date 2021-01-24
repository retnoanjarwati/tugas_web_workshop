
<?php 
//Notifikasi error
echo validation_errors('<div class = "alert alert-warning">','</div>');

// Form open
echo form_open(base_url('admin/kategori/tambah'), ' class="form-horizontal"');
 ?>

 <div class="form-group form-group-lg">
  <label class="col-md-2 control-label">Nama Kategori</label>

  <div class="col-md-5">
    <input type="text" name="nama_kategori" class="form-control" placeholder="Nama Kategori" value="<?php echo set_value('nama_kategori') ?>" required>
  </div>
</div>

</div>
<div class="form-group">
  <label class="col-md-2 control-label"></label>
  <div class="col-md-5">
    <button class="btn btn-success btn-lg" name="submit" type="submit">
    	<i class="fa fa-save"></i> Simpan
    </button>
    <button class="btn btn-info btn-lg" name="reset" type="reset">
    	<i class="fa fa-times"></i> Reset
    </button>
  </div>
</div>
<hr>

<br><br>
<?php echo form_close(); ?>

<!-- listing -->
<?php 
//notifikasi
if($this->session->flashdata('sukses')){
	echo '<p class="alert alert-success">';
	echo $this->session->flashdata('sukses');
	echo '</div>';
 }
 ?>

 <table class="table table-bordered" id="example1">
 	<thead>
 		<tr>
 			<th>NO</th>
 			<th>NAMA KATEGORI</th>
 			<th>SLUG KATEGORI</th>
 			<th>ACTION</th>
 		</tr>
 	</thead>
 	<tbody>
 		<?php $no=1; foreach ($kategori as $kategori) { ?>
 		<tr>
 			<td><?php echo $no++ ?></td>
 			<td><?php echo $kategori->nama_kategori ?></td>
 			<td><?php echo $kategori->slug_kategori ?></td>
 			<td>
 				<a href="<?php echo base_url('admin/kategori/edit/'.$kategori->id_kategori) ?>" class="btn btn-warning btn-xs" ><i class="fa fa-edit"></i> Edit</a>

 				<a href="<?php echo base_url('admin/kategori/delete/'.$kategori->id_kategori) ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" ><i class="fa fa-trash"></i> Hapus</a>
 			</td>
 		</tr>
 	<?php } ?>
 	</tbody>
 </table>
