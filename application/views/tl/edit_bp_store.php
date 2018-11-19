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



  <!-- Content Wrapper. Contains page content -->


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Horizontal Form</h3>
            </div>
            <?php foreach ($cetak3 as $data){
              $a = $data->AI_JAGA;
              $b = $data->NIP_JAGA;
              $c = $data->ID_TOKO_JAGA;
            } ?>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?= base_url('tl/form_edit_jaga/'.$a)?>"
              enctype="multipart/form-data" method="post">


              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Penjaga</label>
                  <div class="col-sm-8" >
                    <select class="form-control" name="nip" required readonly>
                      <option></option>
                      <?php foreach($cetak2->result() as $bp){ ?>
                        <?php if ($bp->NIP == $b ){ ?>
                          <option value="<?= $bp->NIP?>" selected><?= $bp->NAMA_PEG?></option>
                        <?php }else { ?>
                          <option value="<?= $bp->NIP?>"><?= $bp->NAMA_PEG?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama store</label>
                  <div class="col-sm-8">

                      <input type="hidden" name="kode_jaga" value="<?= $a?>">


                    <select class="form-control" name="toko" required>
                      <option></option>
                      <?php foreach($cetak1->result() as $toko){ ?>
                        <?php if ($toko->ID_TOKO == $c){ ?>
                          <option value="<?= $toko->ID_TOKO?>" selected><?= $toko->NAMA_TOKO?></option>
                        <?php }else { ?>
                          <option value="<?= $toko->ID_TOKO?>"><?= $toko->NAMA_TOKO?></option>
                        <?php } ?>

                      <?php } ?>
                    </select>
                  </div>
                </div>

                



              </div>


              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">UBAH DATA</button>
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
