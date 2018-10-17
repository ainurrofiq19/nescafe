



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
            <form class="form-horizontal" action="<?= base_url('admin/add_item')?>" 
              enctype="multipart/form-data" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Code Item</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Code Item" name="code">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Item</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Nama" name="item">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Harga</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" placeholder="Harga" name="harga">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">kategori</label>
                  <div class="col-sm-8" >
                    <select class="form-control" name="kategori">
                      <?php foreach($kat->result_array() as $cat){ ?>
                        <option value="<?= $cat['ID_KATEGORI'] ?>"><?= $cat['NAMA_KATEGORI'] ?></option>
                      <?php } ?>
                    </select> 
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Gambar</label>
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

