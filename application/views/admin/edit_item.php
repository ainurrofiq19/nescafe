



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
              <h3 class="box-title">Horizorm</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php foreach ($item->result() as $cetak){ ?>
            <?php $set = $cetak->ID_ITEM ;?>
            <form class="form-horizontal" action="<?= base_url('Admin/edit_item/'.$cetak->ID_ITEM)?>"
              enctype="multipart/form-data" method="post">



              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Product Code </label>
                  <div class="col-sm-8">

                    <input type="text" class="form-control" value="<?= $cetak->ID_ITEM ?>" name="code">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Product Name</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?= $cetak->NAMA_ITEM ?>" name="item">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Price</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" value="<?= $cetak->HARGA_ITEM ?>" name="harga">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Category</label>
                  <div class="col-sm-8" >
                    <select class="form-control" name="kategori">
                      <?php foreach($kat->result_array() as $cat){ ?>
                        <option value="<?= $cat['ID_KATEGORI'] ?>"><?= $cat['NAMA_KATEGORI'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label"> Product Photo</label>

                    <img src="<?= base_url()?>asset/item/<?= $cetak->FOTO_ITEM ?>" height="142" width="142">

                    <input type="hidden" name="gambarasli" value="<?= $cetak->FOTO_ITEM ?>" />
                    <input type="file" name="gambar" size="20" />


                </div>

              </div>
            <?php } ?>


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
