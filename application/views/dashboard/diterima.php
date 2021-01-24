<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#diterima-<?php echo $detail_transaksi->kode_transaksi?>"><i class="fa fa-check"></i> Diterima</button>

<div class="modal fade" id="diterima-<?php echo $detail_transaksi->kode_transaksi ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Pesanan Diterima</h4>
      </div>
      <div class="modal-body">
        Apakah Anda Yakin Pesanan Telah Diterima?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <a href="<?php echo base_url('dashboard/selesai/'.$detail_transaksi->kode_transaksi) ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i> Ya, Saya Yakin</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->