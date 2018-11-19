



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
            <form class="form-horizontal" action="<?= base_url('admin/update_item_delivery')?>"
              enctype="multipart/form-data" method="post">
            <div class="box-header with-border">
              <h3 class="box-title">KODE KIRIM :</h3>
           <!--    <input type="text" class="form-control" value="<?= $code?>" name="code" readonly>
              <input type="hidden" class="form-control" value="<?= $bp?>" name="bp">
              <input type="hidden" class="form-control" value="<?= $toko?>" name="toko"> -->
            
            </div> -->
            <!-- /.box-header -->
            <!-- form start -->


              <div class="box-body">

                 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">NAMA bp</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Jumlah" name="jumlah" required>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">store</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Jumlah" name="jumlah" required>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Date</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Jumlah" name="jumlah" required>
                  </div>
                </div>

              <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Nama item</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="item" required="">
                      <option></option>

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
          
          <th>TOTAL</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
        
        

            <!--   <tr>
                <form class="form-horizontal" action="<?= base_url('Admin/edit_item_delivery2')?>" method="post">
                <td><?= $data1->KODE_PENGIRIMAN?></td>
                <td><?= $data1->ITEM?></td>
                <td>
                  <input type="text" class="form-control" value="<?= $data1->QTY?>" name="jumlah" maxlength="4" size="4">
                  <input type="hidden" class="form-control" value="<?= $data1->ID_PENGIRIMAN?>" name="id_item">
                  <input type="hidden" class="form-control" value="<?= $code?>" name="kode_item">
                </td>
                <td><?= $data1->HARGA?></td>
                <td><?php echo $data1->QTY*$data1->HARGA?></td>
                <td> -->
                 <!--  <input type="submit" value="Simpan" class="btn btn-primary"></input>
                  <a href="<?= base_url("")?>" class="btn btn-danger small">Hapus</a>
 -->
                </td>
                </form>
              </tr>

            <tr>
           <td></td>
           <td></td>
           <td> </td>
              <td><a href="<?= base_url("Admin/update_item_delivery2")?>" class="btn btn-primary small">Edit</a>
                  <a href="<?= base_url("Admin/hapus_item_delivery2")?>" class="btn btn-danger small">Hapus</a></td>
            </tr>
      
        </tbody>
        <tfoot>
        <tr>
         
        </tfoot>
      </table>
        
               
           <a href="<?php echo base_url(); ?>index.php/Admin/view_item_delivery" class="btn btn-success pull-right">Done</a>
    
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
