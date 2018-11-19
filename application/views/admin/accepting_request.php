
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
  
    <div class="row">

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
                              echo "Order";
                            } elseif ($t =='2') {
                              echo "Be Accepted";
                            }

                       ?></td>                  
                  <td>
                
                  
                   <?php 
                    if ($data1->STATUS == 2 ) { ?>
                     <a href="<?= base_url("Admin/detail_item_request/$data1->KODE_PERMINTAAN")?>" class="btn btn-success">Detail</a>
                      <a  class="btn btn-default">Be Accepted</a>
                <?php    }else{ ?>
                      <a href="<?= base_url("Admin/detail_item_request/$data1->KODE_PERMINTAAN")?>" class="btn btn-success">Detail</a>
                      <a href="<?= base_url("Admin/accept_to_delive/$data1->KODE_PERMINTAAN")?>" class="btn btn-primary">Accept</a>
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
  
  <!-- /.content -->
</div>
