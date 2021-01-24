<div class="row">
<div class="col-md-12">
  <!-- Custom Tabs -->
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab">Transaksi Baru</a></li>
      <li><a href="#tab_2" data-toggle="tab">Transaksi diproses</a></li>
      <li><a href="#tab_3" data-toggle="tab">Transaksi Dikirim</a></li>
      <li><a href="#tab_4" data-toggle="tab">Transaksi Selesai</a></li>

    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab_1">
        
        <table class="table table-bordered" width="100%">
        <thead>
            <tr class="bg-success">
              <th>NO</th>
              <th>PELANGGAN</th>
              <th>KODE</th>
              <th>TANGGAL</th>
              <th>JUMLAH TOTAL</th>
              <th>JUMLAH ITEM</th>
              <th>STATUS BAYAR</th>
              <th>ACTION</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=1;foreach ($All_transaksi as $All_transaksi) { ?>
            <tr>
              <td><?php echo $i++; ?></td>
              <td><?php echo $All_transaksi->nama_distributor ?>
                <br><small>
                  Telephon: <?php echo $All_transaksi->telephon ?>
                  <br>Email: <?php echo $All_transaksi->email ?>
                  <br>Alamat Kirim: <br><?php echo nl2br($All_transaksi->alamat) ?>
                </small>
              </td>
              <td><?php echo $All_transaksi->kode_transaksi ?></td>
              <td><?php echo date('d-m-Y', strtotime($All_transaksi->tanggal_transaksi)) ?></td>
              <td><?php echo number_format($All_transaksi->jumlah_transaksi) ?></td>
              <td><?php echo $All_transaksi->total_item ?></td>
              <td><?php echo $All_transaksi->status_bayar ?></td>
              <td>
                <div class="btn-group">
                  <a href="<?php echo base_url('transaksi/detail/'.$All_transaksi->kode_transaksi) ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Detail</a>
                  <a href="<?php echo base_url('admin/transaksi/cetak/'.$All_transaksi->kode_transaksi) ?>" target="_blank" class="btn btn-info btn-xs" ><i class="fa fa-print"></i> Cetak</a>
                  <?php if($All_transaksi->status_bayar == 'Sudah Bayar'){ ?>
                    <a href="<?php echo base_url('transaksi/diproses/'.$All_transaksi->kode_transaksi) ?>" class="btn btn-warning btn-xs"><i class="fa fa-check"></i> Proses</a>
                  <?php } ?>  
                </div>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- diproses -->
      <div class="tab-pane" id="tab_2">
        <table class="table table-bordered" width="100%">
        <thead>
            <tr class="bg-success">
              <th>NO</th>
              <th>PELANGGAN</th>
              <th>KODE</th>
              <th>TANGGAL</th>
              <th>JUMLAH TOTAL</th>
              <th>JUMLAH ITEM</th>
              <th>STATUS BAYAR</th>
              <th>ACTION</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=1;foreach ($diproses as $diproses) { ?>
            <tr>
              <td><?php echo $i++; ?></td>
              <td><?php echo $diproses->nama_distributor ?>
                <br><small>
                  Telephon: <?php echo $diproses->telephon ?>
                  <br>Email: <?php echo $diproses->email ?>
                  <br>Alamat Kirim: <br><?php echo nl2br($diproses->alamat) ?>
                </small>
              </td>
              <td><?php echo $diproses->kode_transaksi ?></td>
              <td><?php echo date('d-m-Y', strtotime($diproses->tanggal_transaksi)) ?></td>
              <td><?php echo number_format($diproses->jumlah_transaksi) ?></td>
              <td><?php echo $diproses->total_item ?></td>
              <td><?php echo $diproses->status_bayar ?></td>
              <td>
                <div class="btn-group">
                  <a href="<?php echo base_url('transaksi/detail/'.$diproses->kode_transaksi) ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Detail</a>
                  <a href="<?php echo base_url('admin/transaksi/cetak/'.$diproses->kode_transaksi) ?>" target="_blank" class="btn btn-info btn-xs" ><i class="fa fa-print"></i> Cetak</a>
                  <?php if($diproses->status_bayar == 'Diproses'){ ?>
                    <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#kirim<?= $diproses->kode_transaksi?>"><i class="fa fa-check"></i> Kirim</button>
                  <?php } ?>  
                </div>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="tab_3">
        <table class="table table-bordered" width="100%">
        <thead>
            <tr class="bg-success">
              <th>NO</th>
              <th>PELANGGAN</th>
              <th>KODE</th>
              <th>TANGGAL</th>
              <th>JUMLAH TOTAL</th>
              <th>JUMLAH ITEM</th>
              <th>STATUS BAYAR</th>
              <th>ACTION</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=1;foreach ($dikirim as $dikirim) { ?>
            <tr>
              <td><?php echo $i++; ?></td>
              <td><?php echo $dikirim->nama_distributor ?>
                <br><small>
                  Telephon: <?php echo $dikirim->telephon ?>
                  <br>Email: <?php echo $dikirim->email ?>
                  <br>Alamat Kirim: <br><?php echo nl2br($dikirim->alamat) ?>
                </small>
              </td>
              <td><?php echo $dikirim->kode_transaksi ?></td>
              <td><?php echo date('d-m-Y', strtotime($dikirim->tanggal_transaksi)) ?></td>
              <td><?php echo number_format($dikirim->jumlah_transaksi) ?></td>
              <td><?php echo $dikirim->total_item ?></td>
              <td><?php echo $dikirim->status_bayar ?></td>
              <td>
                <div class="btn-group">
                  <a href="<?php echo base_url('transaksi/detail/'.$dikirim->kode_transaksi) ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Detail</a>
                  <a href="<?php echo base_url('admin/transaksi/cetak/'.$dikirim->kode_transaksi) ?>" target="_blank" class="btn btn-info btn-xs" ><i class="fa fa-print"></i> Cetak</a>  
                </div>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="tab_4">
        <table class="table table-bordered" width="100%">
        <thead>
            <tr class="bg-success">
              <th>NO</th>
              <th>PELANGGAN</th>
              <th>KODE</th>
              <th>TANGGAL</th>
              <th>JUMLAH TOTAL</th>
              <th>JUMLAH ITEM</th>
              <th>STATUS BAYAR</th>
              <th>ACTION</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=1;foreach ($selesai as $selesai) { ?>
            <tr>
              <td><?php echo $i++; ?></td>
              <td><?php echo $selesai->nama_distributor ?>
                <br><small>
                  Telephon: <?php echo $selesai->telephon ?>
                  <br>Email: <?php echo $selesai->email ?>
                  <br>Alamat Kirim: <br><?php echo nl2br($selesai->alamat) ?>
                </small>
              </td>
              <td><?php echo $selesai->kode_transaksi ?></td>
              <td><?php echo date('d-m-Y', strtotime($selesai->tanggal_transaksi)) ?></td>
              <td><?php echo number_format($selesai->jumlah_transaksi) ?></td>
              <td><?php echo $selesai->total_item ?></td>
              <td><?php echo $selesai->status_bayar ?></td>
              <td>
                <div class="btn-group">
                  <a href="<?php echo base_url('transaksi/detail/'.$selesai->kode_transaksi) ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Detail</a>
                  <a href="<?php echo base_url('admin/transaksi/cetak/'.$selesai->kode_transaksi) ?>" target="_blank" class="btn btn-info btn-xs" ><i class="fa fa-print"></i> Cetak</a>  
                </div>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
  </div>
  <!-- nav-tabs-custom -->
</div>

<?php foreach ($trans as $trans) { ?>
<div class="modal fade" id="kirim<?php echo$trans->kode_transaksi?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><strong><?php echo $trans->kode_transaksi ?></strong></h4>
              </div>
              <div class="modal-body">
                <?php echo form_open(base_url('transaksi/dikirim/'.$trans->kode_transaksi)); ?>
                <form role="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <table class="table">
                    <tr>
                      <th width="25%">Expedisi</th>
                      <th>: <?php echo $trans->expedisi ?></th>
                    </tr>
                    <tr>
                      <th width="25%">Expedisi</th>
                      <th>: Rp. <?php echo number_format($trans->ongkir) ?></th>
                    </tr>
                    <tr>
                      <th width="25%">No Resi</th>
                      <td><input  class="form-control" name="no_resi" placeholder="No Resi"></td>
                    </tr>
                  </table>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" name="kirim" class="btn btn-success"> Kirim</button>
              </div>
              <?php echo form_close(); ?>
                
              </div>
            </form>
                
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      <?php } ?>
        