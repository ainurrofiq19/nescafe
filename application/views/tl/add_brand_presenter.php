



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
            <form class="form-horizontal" action="<?= base_url('tl/add_brand_presenter')?>" 
              enctype="multipart/form-data" method="post">
              <div class="box-body">
               <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NIP</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="NIP" name="nip">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Brand Presenter</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Nama" name="namapeg">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Password" name="pass">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Alamat Brand Presenter</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="alamat" name="alamatpeg">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">E-mail</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="email" name="emailpeg">
                  </div>
                </div>
              <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Telephone Brand Presenter</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="telephone" name="tlppeg">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">jenis kelamin</label>
                  <div class="col-sm-8">
                       <select class="form-control" name="kelaminpeg">
                     
                        <option value="l">Male</option>
                        <option value="p">Female</option>
                 
                     
                    </select>
                  </div>
                </div>
               <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Tgl lahir</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control" placeholder="Tgl lahir" name="tgllahirpeg">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Tgl MASUk</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control" placeholder="Tgl lahir" name="tglmasuk">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Penempatan</label>
                  <div class="col-sm-8" >
                    <select class="form-control" name="toko">
                      <?php foreach($kat->result_array() as $cat){ ?>
                        <option value="<?= $cat['ID_TOKO'] ?>"><?= $cat['NAMA_TOKO'] ?></option>
                      <?php } ?>
                    </select> 
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">FOTO</label>
                  <div class="col-sm-10">
                    <input type="file" name="gambar" size="20" />  
                  </div>
                </div>

              </div>


              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">SAVE ITEM</button>
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

