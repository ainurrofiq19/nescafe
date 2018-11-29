



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     ITEM REQUEST1
      <small>Permintaan Barang</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Tables</a></li>
      <li class="active">Data tables</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">

      <div class="col-xs-12">

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">FORM SURAT JALAN</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form class="form-horizontal" action="<?= base_url('Bp/add_sellout_date')?>"
              enctype="multipart/form-data" method="post">
              <div class="box-body">

                <?php foreach ($jaga->result() as $cetak2){ ?>
                  <input type="hidden" class="form-control" value="<?= $cetak2->ID_TOKO_JAGA ?>" name="toko" readonly>
                <?php } ?>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Buat Laporan</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?= date('d/m/Y')?>" readonly>
                    <input type="hidden" name="tgl" value="<?= date('Y-m-d')?>">
                  </div>
                </div>

              </div>


              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Buat Laporan</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
      </div>

      <div class="col-xs-12">

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">DATA PENGIRIMAN BARANG</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Penjualan Tanggal</th>
                <th>Toko</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach($cetak1 as $data1){?>
                <tr>
                  <td><?= $data1->LAPORAN_DATE?></td>
                  <td><?= $data1->NAMA_TOKO?></td>
                  <td>
                    <a href="<?= base_url("Bp/export/$data1->LAPORAN_DATE")?>" class="btn btn-warning">Print</a>
                    <a href="<?= base_url("Bp/detail_item_sellout/$data1->AI_LAPORAN")?>" class="btn btn-success">Detail</a>
                    <a href="<?= base_url("Bp/add_sellout_item/$data1->LAPORAN_DATE")?>" class="btn btn-primary">Update</a>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
