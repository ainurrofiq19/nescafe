



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       VIEW STOCK
        <small>Lihat Stok</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">VIEW STOCK</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">



        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">LIST OF PRODUCT AVAILABLE</h3>
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
                     
                      <td><a href="<?= base_url('Bp/view_item_request')?>" class="btn btn-danger">Minta</a></td>
                    </tr>
                  <?php else: ?>
                    <tr>
                      <td><?= $data1->ID_BARANG?></td>
                      <td><?= $data1->NAMA?></td>
                      <td><?= $data1->JUMLAH?></td>
                     
                      <td><a href="<?= base_url('Bp/view_item_request')?>" class="btn btn-primary">Minta</a></td>
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

        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
