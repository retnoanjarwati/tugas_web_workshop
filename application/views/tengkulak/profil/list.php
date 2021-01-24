<h2><?php echo $title ?></h2>
<hr>
<?php 

//display error
echo validation_errors('<div class = "alert alert-warning">','</div>');
//echo form_open(base_url('admin/kategori/edit/'.$kategori->id_kategori), ' class="form-horizontal"');

//form open
echo form_open(base_url('admin/tengkulak/profil'),' class="form-horizontal"'); ?>
<table class="table">
	<tbody>
		<tr>
			<td>Nama Tengkulak</td>
			<td><input type="text" name="nama_tengkulak" class="form-control" placeholder="Nama Lengkap" value="<?php echo $tengkulak->nama_tengkulak ?>" required></td>
		</tr>
	
		<tr>
			<td>Telephon</td>
			<td><input type="text" name="telephon" class="form-control" placeholder="Telephon" value="<?php echo $tengkulak->telephon ?>" required></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td><textarea name="alamat" class="form-control" placeholder="Alamat"><?php echo $tengkulak->alamat ?></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<button class="btn btn-success btn-lg" type="submit">
					<i class="fa fa-save"></i> Update Profil
				</button>
				<button class="btn btn-default btn-lg" type="reset">
					<i class="fa fa-times"></i> Reset
				</button>
			</td>
		</tr>
	</tbody>
</table>

<?php echo form_close(); ?>