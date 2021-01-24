<?php 
//error upload
if(isset($error)){
  echo '<p class="alert alert-warning">';
  echo $error;
  echo '</p>';
}
//Notifikasi error
echo validation_errors('<div class = "alert alert-warning">','</div>');

// Form open
echo form_open_multipart(base_url('admin/product/edit/'.$product->id_product), ' class="form-horizontal"');
 ?>

 <div class="form-group">
  <label class="col-md-2 control-label">Nama Product</label>

  <div class="col-md-5">
    <input type="text" name="nama_product" class="form-control" placeholder="Nama Product" value="<?php echo $product->nama_product ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Kode Product</label>

  <div class="col-md-5">
    <input type="text" name="kode_product" class="form-control" placeholder="Kode Product" value="<?php echo $product->kode_product ?>" required>
  </div>
</div>


<div class="form-group">
  <label class="col-md-2 control-label">Kategori Product</label>

  <div class="col-md-5">
    <select name="id_kategori" class="form-control">
      <?php foreach ($kategori as $kategori) { ?>
      <option value="<?php echo $kategori->id_kategori ?>"<?php if($product->id_kategori==$kategori->id_kategori){ echo "selected"; } ?>>
       <?php echo $kategori->nama_kategori ?> 
      </option>
    <?php } ?>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Harga Product</label>

  <div class="col-md-5">
    <input type="number" name="harga" class="form-control" placeholder="Harga Product" value="<?php echo $product->harga ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Stok Product</label>

  <div class="col-md-5">
    <input type="number" name="stok" class="form-control" placeholder="Stok Product" value="<?php echo $product->stok ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Keterangan Product</label>

  <div class="col-md-10">
    <textarea name="keterangan" class="form-control" placeholder="Keterangan" id="editor"><?php echo $product->keterangan ?></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Upload Gambar Product</label>

  <div class="col-md-10">
    <input type="file" name="gambar" class="form-control" placeholder="Gambar Product" value="<?php echo $product->gambar ?>">
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Status Product</label>

  <div class="col-md-5">
    <select name="status_product" class="form-control">
      <option value="Publish">Publikasikan</option>
      <option value="Draft" <?php if($product->status_product=="Draft") {echo "selected"; } ?>>Simpan Sebagai Draft</option>
    </select>
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
<?php echo form_close(); ?>