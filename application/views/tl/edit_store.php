



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
<div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Horizontal Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?= base_url('Tl/edit_store')?>" 
              enctype="multipart/form-data" method="post">
              <div class="box-body">
                <!-- <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">ID TOKO</label>
                  <div class="col-sm-8">
                     
                </div> -->
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama store</label>
                  <div class="col-sm-8">
                    <input type="hidden" class="form-control" placeholder="Nama" name="idtoko" value="<?php echo $toko->ID_TOKO; ?>">
                    <input type="text" class="form-control" placeholder="Nama" name="namatoko" value="<?php echo $toko->NAMA_TOKO; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Alamat Store</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="alamat" name="alamattoko" value="<?php echo $toko->ALAMAT_TOKO; ?>">
                  </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Telephone Store</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" placeholder="telephone" name="tlptoko" value="<?php echo $toko->TLP_TOKO; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">City Store</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" placeholder="kota" name="kotatoko" value="<?php echo $toko->KOTA_TOKO; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Email Store</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" placeholder="Email" name="emailtoko" value="<?php echo $toko->EMAIL_TOKO; ?>">
                    </div>
                  </div>
                
              </div>


              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">SAVE STORE</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->

          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

