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
            <?php $i=1;foreach ($transaksi_tengkulak as $transaksi_tengkulak) { ?>
            <tr>
              <td><?php echo $i++; ?></td>
              <td><?php echo $transaksi_tengkulak->nama_distributor ?>
                <br><small>
                  Telephon: <?php echo $transaksi_tengkulak->telephon ?>
                  <br>Email: <?php echo $transaksi_tengkulak->email ?>
                  <br>Alamat Kirim: <br><?php echo nl2br($transaksi_tengkulak->alamat) ?>
                </small>
              </td>
              <td><?php echo $transaksi_tengkulak->kode_transaksi ?></td>
              <td><?php echo date('d-m-Y', strtotime($transaksi_tengkulak->tanggal_transaksi)) ?></td>
              <td><?php echo number_format($transaksi_tengkulak->jumlah_transaksi) ?></td>
              <td><?php echo $transaksi_tengkulak->total_item ?></td>
              <td><?php echo $transaksi_tengkulak->status_bayar ?></td>
              <td>
                <div class="btn-group">
                  <a href="<?php echo base_url('transaksi/detail/'.$transaksi_tengkulak->kode_transaksi) ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Detail</a>
                  <a href="<?php echo base_url('admin/transaksi/cetak/'.$transaksi_tengkulak->kode_transaksi) ?>" target="_blank" class="btn btn-info btn-xs" ><i class="fa fa-print"></i> Cetak</a>  
                </div>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>