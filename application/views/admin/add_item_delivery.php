



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Tables
        <small>advanced tables</small>
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
<div class="col-md-4">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <form class="form-horizontal" action="<?= base_url('admin/add_item_delivery/'.$code)?>"
              enctype="multipart/form-data" method="post">
            <div class="box-header with-border">
              <h3 class="box-title">KODE KIRIM :</h3>
              <input type="text" class="form-control" value="<?= $code?>" name="code" readonly>
              <input type="hidden" class="form-control" value="<?= $bp?>" name="bp">
              <input type="hidden" class="form-control" value="<?= $toko?>" name="toko">
            </div>
            <!-- /.box-header -->
            <!-- form start -->


              <div class="box-body">

              <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Nama item</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="item" >
                      <?php foreach($itkat->result_array() as $itcat){ ?>
                        <option value="<?= $itcat['ID_ITEM'] ?>"><?= $itcat['NAMA_ITEM'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">qty</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Jumlah" name="jumlah">
                  </div>
                </div>


                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">status</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="status">

                        <option value="">Kirim</option>
                        <option value="">Terima Request</option>

                    </select>
                  </div>
                </div>

              </div>


              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">ADD ITEM</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->

          <!-- /.box -->
        </div>
<div class="col-md-8" >
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Table With Full Features</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>KODE BARANG</th>
          <th>NAMA BARANG</th>
          <th>JUMLAH</th>
          <th>HARGA</th>
          <th>TOTAL</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
          <?php $hargatotal = 0 ; $jumlahtotal = 0 ;$total = 0 ?>
          <?php foreach($cetak1 as $data1){?>
            <?php
              $hargatotal += $data1->HARGA;
              $jumlahtotal += $data1->QTY;
              $total += $data1->QTY*$data1->HARGA;
              $tot = $data1->QTY*$data1->HARGA;
            ?>
          <?php if ($tanda == $data1->ID_PENGIRIMAN) { ?>

            <tr>
              <td><?= $data1->KODE_PENGIRIMAN?></td>
              <td><?= $data1->ITEM?></td>
              <td>
                <form >
                    <input type="text" class="form-control" value="<?= $data1->QTY?>" name="jumlah" maxlength="4" size="4">
                </form>
              </td>
              <td><?= $data1->HARGA?></td>
              <td><?php echo $data1->QTY*$data1->HARGA?></td>
              <td><a href="<?= base_url("Admin/add_item_delivery2/$code/$data1->ID_PENGIRIMAN")?>" class="btn btn-primary small">Simpan</a>
                <a href="" class="btn btn-danger small">Hapus</a></td>
            </tr>
          <?php  }else { ?>
            <tr>
              <td><?= $data1->KODE_PENGIRIMAN?></td>
              <td><?= $data1->ITEM?></td>
              <td><?= $data1->QTY?></td>
              <td><?= $data1->HARGA?></td>
              <td><?php echo $tot?></td>
              <td><a href="<?= base_url("Admin/add_item_delivery2/$code/$data1->ID_PENGIRIMAN")?>" class="btn btn-primary small">Edit</a>
                <a href="" class="btn btn-danger small">Hapus</a></td>
            </tr>
          <?php } ?>

        <?php } ?>
        </tbody>
        <tfoot>
        <tr>
          <th>TOTAL Rp. </th>
          <th></th>
          <th><?= $jumlahtotal?></th>
          <th><?= $hargatotal?></th>
          <th><?= $total?></th>
          <th></th>
        </tr>
        </tfoot>
      </table>
    </div>

    <!-- /.box-body -->
  </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>





  <!-- Content Wrapper. Contains page content -->
