



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       VIEW STOCK
        <small>Lihat stok </small>
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
              <h3 class="box-title">Find a Store</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form class="form-horizontal" action="<?= base_url('admin/view_stock_toko/')?>"
                enctype="multipart/form-data" method="post">
                <div class="box-body">

                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Name Store</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="toko" required>
                        <option></option>
                        <?php foreach($cetak1 as $cat){ ?>
                          <option value="<?= $cat->ID_TOKO ?>"><?= $cat->NAMA_TOKO ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>


                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-info pull-right">View Stock</button>
                </div>
                <!-- /.box-footer -->
              </form>
            </div>
          </div>
        </div>

<?php if ($a == 0): ?>


        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <?php foreach($cetak3 as $data1){?> <?php } ?>
              <h3 class="box-title">LIST OF PRODUCT AVAILABLE ON <?= $data1->NAMA_TOKO?> </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Product Code</th>
                  <th>Product Name</th>
                  <th>QTY</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($cetak2 as $data1){?>
                  <?php if ($data1->JUMLAH < 2): ?>
                    <tr>
                      <td ><?= $data1->ID_BARANG?></td>
                      <td><?= $data1->NAMA?></td>
                      <td bgcolor="#eb4d4b"><?= $data1->JUMLAH?></td>
                      <td><a href="<?= base_url('Admin/view_item_delivery')?>" class="btn btn-danger">Kirim</a></td>
                    </tr>
                  <?php else: ?>
                    <tr>
                      <td><?= $data1->ID_BARANG?></td>
                      <td><?= $data1->NAMA?></td>
                      <td><?= $data1->JUMLAH?></td>
                      <td><a href="<?= base_url('Admin/view_item_delivery')?>" class="btn btn-primary">Kirim</a></td>
                    </tr>
                  <?php endif; ?>

                <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <?php endif; ?>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
