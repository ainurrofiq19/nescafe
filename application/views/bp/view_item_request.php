<?php

  foreach ($lastcode->result_array() as $code) {
    $printcode = $code['KODE_PERMINTAAN'];
  }
  $a = 'MSD-SBY-RI-';
  $b = date('Y-');
  $x = substr($printcode,16);
  $i = array($x,1)
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     ITEM REQUEST
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
            <form class="form-horizontal" action="<?= base_url('Bp/add_code_request')?>"
              enctype="multipart/form-data" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Delivery Code</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?= $a.$b?><?=array_sum($i)?>" name="code" readonly>
                  </div>
                </div>
                <?php foreach ($jaga->result() as $cetak2){ ?>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Receiver store</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" value="<?= $cetak2->ID_TOKO_JAGA ?>" name="toko" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">receiver Brand prasenter</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" value="<?= $cetak2->NIP_JAGA ?>" name="bp" readonly>
                    </div>
                  </div>
                <?php } ?>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Date</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control" name="tgl" required>
                  </div>
                </div>



              </div>


              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Add Delivery</button>
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
                <th>No Order</th>
                <th>Date</th>
                <th>Store</th>
                <th>Brand Presenter</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach($cetak1 as $data1){?>
                <tr>
                  <td><?= $data1->KODE_PERMINTAAN?></td>
                  <td><?= $data1->TANGGAL?></td>
                  <td><?= $data1->TOKO?></td>
                  <td><?= $data1->BP?></td>
                  <td>
                    <?php
                          $t = $data1->STATUS;

                            if ($t =='1') {
                              echo "Delivery";
                            } elseif ($t =='2') {
                              echo "Be Accepted";
                            }

                       ?></td>                  
                  <td>
                
                  
                   <?php 
                    if ($data1->STATUS == 2 ) { ?>
                     <a href="<?= base_url("Bp/detail_item_request/$data1->KODE_PERMINTAAN")?>" class="btn btn-success">Detail</a>
                      <a  class="btn btn-default">Be Accepted</a>
                <?php    }else{ ?>
                      <a href="<?= base_url("Bp/detail_item_request/$data1->KODE_PERMINTAAN")?>" class="btn btn-success">Detail</a>
                      <a href="<?= base_url("Bp/update_item_request/$data1->KODE_PERMINTAAN")?>" class="btn btn-primary">Update</a>
                  <?php  }
                  ?>
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
