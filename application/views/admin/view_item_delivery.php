  <?php

    foreach ($lastcode->result_array() as $code) {
      $printcode = $code['KODE_PENGIRIMAN'];
    }
    $a = 'MSD-SBY-DO-';
    $b = date('Y-');
    $x = substr($printcode,16);
    $i = array($x,1)
  ?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       ITEM DELIVERY
        <small>Pengiriman Barang</small>
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
              <form class="form-horizontal" action="<?= base_url('admin/add_code_delivery')?>"
                enctype="multipart/form-data" method="post">
                <div class="box-body">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Kode Pengiriman</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" value="<?= $a.$b?><?=array_sum($i)?>" name="code" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Toko Penerima</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="toko" required>
                        <option></option>
                        <?php foreach($kat->result_array() as $cat){ ?>
                          <option value="<?= $cat['ID_TOKO'] ?>"><?= $cat['NAMA_TOKO'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">BP Penerima</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="bp" required>
                         <option></option>
                        <?php foreach($bpkat->result_array() as $bpcat){ ?>
                          <option value="<?= $bpcat['NIP'] ?>"><?= $bpcat['NAMA_PEG'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
                    <div class="col-sm-8">
                      <input type="date" class="form-control" name="tgl" required>
                    </div>
                  </div>



                </div>


                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-default">Cancel</button>
                  <button type="submit" class="btn btn-info pull-right">Buat Pengiriman</button>
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
                    <td><?= $data1->KODE_PENGIRIMAN?></td>
                    <td><?= $data1->TANGGAL?></td>
                    <td><?= $data1->TOKO?></td>
                    <td><?= $data1->BP?></td>
                    <td><?= $data1->STATUS?></td>
                    <td>
                    <?php 
                    if ($data1->STATUS == 2 ) { ?>
                      <a href="<?= base_url("Admin/detail_item_delivery/$data1->KODE_PENGIRIMAN")?>" class="btn btn-success">Detail</a>
                      <a  class="btn btn-default">Be Accepted</a>
                <?php    }else{ ?>
                      <a href="<?= base_url("Admin/detail_item_delivery/$data1->KODE_PENGIRIMAN")?>" class="btn btn-success">Detail</a>
                      <a href="<?= base_url("Admin/update_item_delivery/$data1->KODE_PENGIRIMAN")?>" class="btn btn-primary">Update</a>
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
