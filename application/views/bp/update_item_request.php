



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
            <form class="form-horizontal" action="<?= base_url('Bp/update_item_request/'.$code)?>"
              enctype="multipart/form-data" method="post">
            <div class="box-header with-border">
              <h3 class="box-title">KODE KIRIM :</h3>
              <input type="text" class="form-control" value="<?= $code?>" name="code" readonly>
              <?php foreach ($jaga->result() as $cetak3){ ?>
                <input type="hidden" class="form-control" value="<?= $cetak3->NIP_JAGA?>" name="bp">
                <input type="hidden" class="form-control" value="<?= $cetak3->ID_TOKO_JAGA?>" name="toko">
              <?php } ?>

              <?php foreach($cetak1 as $data2){?>
                <input type="hidden" name="id" value="<?= $data2->ID_PERMINTAAN?>">
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->


              <div class="box-body">

              <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Nama item</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="item" required="">
                      <option></option>
                      <?php foreach($itkat->result_array() as $itcat){ ?>
                        <option value="<?= $itcat['ID_ITEM'] ?>"><?= $itcat['NAMA_ITEM'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">qty</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Jumlah" name="jumlah" required>
                  </div>
                </div>




              </div>

              <!-- /.box-body -->
              <div class="box-footer">

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
          <?php if ($tanda == $data1->ID_PERMINTAAN) { ?>

              <tr>
                <form class="form-horizontal" action="<?= base_url('Bp/edit_item_request2')?>" method="post">
                <td><?= $data1->KODE_PERMINTAAN?></td>
                <td><?= $data1->ITEM?></td>
                <td>
                  <input type="text" class="form-control" value="<?= $data1->QTY?>" name="jumlah" maxlength="4" size="4">
                  <input type="hidden" class="form-control" value="<?= $data1->ID_PERMINTAAN?>" name="id_item">
                  <input type="hidden" class="form-control" value="<?= $code?>" name="kode_item">
                </td>
                <td><?= $data1->HARGA?></td>
                <td><?php echo $data1->QTY*$data1->HARGA?></td>
                <td>
                  <input type="submit" value="Simpan" class="btn btn-primary"></input>
                  <a href="<?= base_url("Bp/hapus_item_request/$data1->KODE_PERMINTAAN/$code")?>" class="btn btn-danger small">Hapus</a>

                </td>
                </form>
              </tr>

          <?php  }else { ?>
            <tr>
              <td><?= $data1->KODE_PERMINTAAN ?></td>
              <td><?= $data1->ITEM?></td>
              <td><?= $data1->QTY?></td>
              <td><?= $data1->HARGA?></td>
              <td><?php echo $tot?></td>
              <td><a href="<?= base_url("Bp/update_item_request2/$code/$data1->ID_PERMINTAAN")?>" class="btn btn-primary small">Edit</a>
                  <a href="<?= base_url("Bp/hapus_item_request2/$data1->KODE_PERMINTAAN/$code")?>" class="btn btn-danger small">Hapus</a></td>
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


           <a href="<?php echo base_url(); ?>index.php/Bp/view_item_request" class="btn btn-success pull-right">Done</a>

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
