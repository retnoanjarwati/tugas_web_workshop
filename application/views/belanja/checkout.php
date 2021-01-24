<!-- Cart -->
  <section class="cart bgwhite p-t-100 p-b-100">
    <div class="container">
      <!-- Cart item -->
      <div class="container-table-cart pos-relative">
        <div class="wrap-table-shopping-cart bgwhite">
          <h1><?php echo $title ?></h1><hr> 
          <div class="clearfix"></div>
          
          <br>
          <?php 
          $kode_transaksi = date('dmY').strtoupper(random_string('alnum',8));
          if($this->session->flashdata('sukses')){
            echo '<div class="alert alert-warning">';
            echo $this->session->flashdata('sukses');
            echo '</div>';
          } ?>
          <div class="invoice-title">
          <h6>
            <table>
              <thead>
                <tr>
                  <th><label>Nama Penerima</label></th>
                  <th><label>: <?php echo $distributor->nama_distributor ?></label></th>
                </tr>
                <tr>
                  <th><label>Email Penerima</label></th>
                  <th><label>: <?php echo $distributor->email ?></label></th>
                </tr>
                <tr>
                  <th><label>Telephon</label></th>
                  <th><label>: <?php echo $distributor->telephon ?></label></th>
                </tr>
                <tr>
                  <th><label>Alamat Penerima</label></th>
                  <th><label>: <?php echo $distributor->alamat ?></label></th>
                </tr>
                <tr>
                  <th><a href="<?php echo base_url('dashboard/profil') ?>" name="ganti_alamat" class="btn btn-success btn-sm">
                      <i class="fa fa-edit"></i> Ganti Alamat
                      </button></th>
                </tr>
              </thead>
            </table>
            </h6>
            <h6 class="pull-right">
            <address>
            <label><strong>Kode Transaksi:</strong></label><br>
              <label><?php echo $kode_transaksi ?></label><br>
              
            </address></h6>
        </div>
          <table class="table-shopping-cart">
            <tr class="table-head" text-align="center">
              <th class="column-1">GAMBAR</th>
              <th class="column-2">PRODUCT</th>
              <th class="column-3 column-4 p-l-30">HARGA (Per Kg)</th>
              <th class="column-4 p-l-30">JUMLAH (Per Kwintal)</th>
              <th class="column-5 column-4 p-l-70">SUB TOTAL</th>
            </tr>
            <?php 
            //looping data keranjang belanja
            foreach ($keranjang as $keranjang) {
              //ambil data produk
              $id_product = $keranjang['id'];
              $product  = $this->product_model->detail($id_product);
              $tot_berat = count($this->cart->contents());
              //$total    = $this->cart->total() * 100;
             ?>
              <tr class="table-row">
              <td class="column-1">
                <div class="cart-img-product b-rad-4 o-f-hidden">
                  <img src="<?php echo base_url('assets/upload/image/thumbs/'.$product->gambar) ?>" alt="<?php echo $keranjang['name'] ?>">
                </div>
              </td>
              <td class="column-2" text-align="center"><?php echo $keranjang['name'] ?></td>
              <td class="column-3" text-align="center"><?php echo 'Rp. '.number_format($keranjang['price'],'0',',','.') ?></td>
              <td class="column-4"><?php echo $keranjang['qty'] ?> KW</td>
              <td class="column-5">Rp. 
                <?php 
                $sub_total = ($keranjang['price'] * $keranjang['qty']) * 100;
                echo number_format($sub_total,'0',',','.');
                 ?>
              </td>
            </tr>
          <?php 
          //end looping
            }
          
           ?>
          </table>
        </div>
      </div>
       <div class="row">
        <div class="col-sm-8">
          <br><br><br>
          <div class="row">
          <div class="col-sm-6">
          <div class="form-group">
            <strong><label>Provinsi</label></strong>
            <select id="form_prov" name="provinsi" class="form-control">
              <?php foreach ($wilayah as $wilayah) { ?>
                <option value="<?php echo $wilayah->kode ?>"><?php echo $wilayah->nama ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <strong><label>Kabupaten</label></strong>
            <select id="form_kab" name="provinsi" class="form-control"></select>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <strong><label>Kecamatan</label></strong>
            <select id="form_kec" name="provinsi" class="form-control"></select>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <strong><label>Ekspedisi</label></strong>
            <select id="form_des" name="provinsi" class="form-control"></select>
          </div>
        </div>
      <!-- Total 
        <div class="col-sm-6">
          <div class="form-group">
            <strong><label>Ekspedisi</label></strong>
            <select id="ongkir" name="provinsi" class="form-control"></select>
          </div>
        </div>-->

        </div>
        
    </div>
      <!-- Total -->
      <div class="bo9 w-size10 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
        

        <!--  -->
        <div class="flex-w flex-sb-sm bo10 p-t-5 p-b-12">
          <span class="s-text18 w-size19 w-full-sm">
            Total Belanja:
          </span>

          <span class="m-text21 w-size20 w-full-sm">
            <?php echo 'Rp. '.number_format($this->cart->total() * 100, '0',',','.'); ?>
          </span>
        </div>

        <!--  -->
        <div class="flex-w flex-sb bo10 p-t-15 p-b-20">
          <span class="s-text18 w-size19 w-full-sm">
            Berat:
          </span>

          <span  class="m-text21 w-size20 w-full-sm">
            <?php echo $this->cart->total_items(); ?> KW
          </span>
        </div>

        <!--  -->
        <div class="flex-w flex-sb bo10 p-t-15 p-b-20">
          <span class="s-text18 w-size19 w-full-sm">
            Ongkir:
          </span>

          <span id="ongkir" class="m-text21 w-size20 w-full-sm">
            
            
          </span>
        </div>

        <!--  -->
        <div class="flex-w flex-sb bo10 p-t-15 p-b-20">
          <span class="m-text22 w-size19 w-full-sm">
            Total Bayar:
          </span>

          <span id="total_bayar" class="m-text21 w-size20 w-full-sm">
            
          </span>
        </div>

        <div class="size15 trans-0-4">
          <?php 
          echo form_open(base_url('belanja/checkout'));
          //$kode_transaksi = date('dmY').strtoupper(random_string('alnum',8));
          ?>
          <input type="hidden" name="kode_transaksi" class="form-control" value="<?php echo $kode_transaksi ?>">
          <input type="hidden" name="nama_distributor" class="form-control" value="<?php echo $distributor->nama_distributor ?>">
          <input type="hidden" name="email" class="form-control" value="<?php echo $distributor->email ?>">
          <input type="hidden" name="telephon" class="form-control" value="<?php echo $distributor->telephon ?>">
          <input type="hidden" name="alamat" class="form-control" value="<?php echo $distributor->alamat ?>">
          <input type="hidden" name="id_distributor" value="<?php echo $distributor->id_distributor; ?>">
          <input type="hidden" name="jumlah_transaksi" value="<?php echo $this->cart->total() * 100 ?>">
          <input type="hidden" name="tanggal_transaksi" value="<?php echo date('Y-m-d'); ?>">
          <input type="hidden" name="expedisi">
          <input type="hidden" name="ongkir">
          <input type="hidden" name="total">

          <!-- Button -->
          <button class="btn flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4 btn-lg">
            Checkout Sekarang
          </button>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){

      // sembunyikan form kabupaten, kecamatan dan desa
      // $("#form_kab").hide();
      // $("#form_kec").hide();
      // $("#form_des").hide();

      // ambil data kabupaten ketika data memilih provinsi
      $('body').on("change","#form_prov",function(){
        var id = $(this).val();
        var data = "id="+id+"&data=kabupaten";
        $.ajax({
          type: 'POST',
          url: '<?php echo base_url('wilayah/get_wilayah'); ?>',
          data: data,
          success: function(hasil) {
            $("#form_kab").html(hasil);
            // $("#form_kab").show();
            // $("#form_kec").hide();
            // $("#form_des").hide();
          }
        });
      });

      // ambil data kecamatan/kota ketika data memilih kabupaten
      $('body').on("change","#form_kab",function(){
        var id = $(this).val();
        var data = "id="+id+"&data=kecamatan";
        $.ajax({
          type: 'POST',
          url: "<?php echo base_url('wilayah/get_wilayah'); ?>",
          data: data,
          success: function(hasil) {
            $("#form_kec").html(hasil);
            // $("#form_kec").show();
             //$("#form_des").hide();
          }
        });
      });

      // ambil data desa ketika data memilih kecamatan/kota
      $('body').on("change","#form_kab",function(){
        var id = $(this).val();
        var data = "id="+id+"&data=desa";
        $.ajax({
          type: 'POST',
          url: "<?php echo base_url('wilayah/ongkir'); ?>",
          data: data,
          success: function(hasil) {
            $("#form_des").html(hasil);
             //$("#form_des").show();
          }
        });
      });

      // ambil data desa ketika data memilih kecamatan/kota
      $('body').on("change","#form_des",function(){
        var id = $(this).val();
        var data = "id="+id+"&data=ongkir";
        $.ajax({
          type: 'POST',
          url: "<?php echo base_url('wilayah/get_ongkir'); ?>",
          data: data,
          success: function(hasil) {
            $("#ongkir").html(hasil);
            
             //$("#form_des").show();
          }
        });
      });

      // ambil data desa ketika data memilih kecamatan/kota
      $('body').on("change","#form_des",function(){
        var dataongkir = $("option:selected", this).attr('dataongkir');
         var expedisi = $("option:selected", this).attr('expedisi');
        var total_bayar = parseInt(dataongkir)+parseInt(<?= $this->cart->total() * 100 ?>);
          $("#total_bayar").html(total_bayar);
        
        $("input[name=total]").val(total_bayar);
        $("input[name=expedisi]").val(expedisi);
        $("input[name=ongkir]").val(dataongkir);
      });
    });
  </script> 
  </section>

 