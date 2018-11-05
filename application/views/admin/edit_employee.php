



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
            <?php foreach ($bp->result() as $cetak){ ?>
            <?php $set = $cetak->NIP ;?>
            <form class="form-horizontal" action="<?= base_url('Admin/edit_employee')?>" 
              enctype="multipart/form-data" method="post">
              <div class="box-body">
               <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NIP</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="NIP"value="<?=$cetak->NIP ?>" name="nip">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Nama" value="<?=$cetak->NAMA_PEG ?>" name="namapeg">
                    <input type="hidden" class="form-control" placeholder="Password"value="<?=$cetak->PASSWORD ?>" name="pass">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Employee position</label>
                  <div class="col-sm-8">
                    <select class="form-control"  name="kategori">
                      <?php

                      $ctg=$cetak->LEVEL;

                      if ($ctg=='1') { echo'
                                              <option value="1" selected>Admin</option>
                                              <option value="2">Brand Presenter</option>
                                              <option value="3">Team leader</option>
                                              <option value="4">Supervisor</option>
                                        ';}
                    else if ($ctg=='2') { echo'
                                              <option value="1">Admin</option>
                                              <option value="2" selected>Bp</option>
                                              <option value="3">Team leader</option>
                                              <option value="4">Supervisor</option>
                                             '; }
                    else if ($ctg=='3') { echo'
                                              <option value="1">Admin</option>
                                              <option value="2">Brand Presen</option>
                                              <option value="3" selected>Team leader</option>
                                              <option value="4">Supervisor</option>
                                             '; }
                    else if ($ctg=='4') { echo'
                                              <option value="1">Admin</option>
                                              <option value="2">Brand Presenter</option>
                                              <option value="3">Team leader</option>
                                              <option value="4" selected>Supervisor</option>
                                             '; }


                      ?> 
                    </select> 
                   
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Addres</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="alamat"value="<?=$cetak->ALAMAT_PEG ?>" name="alamatpeg">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">E-mail</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="email" value="<?=$cetak->EMAIL_PEG ?>" name="emailpeg">
                  </div>
                </div>
              <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Telephone</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="telephone" value="<?=$cetak->TLP_PEG ?>" name="tlppeg">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Gender</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="jenis kelamin"value="<?=$cetak->JENIS_KELAMIN ?>" name="kelaminpeg">
                  </div>
                </div>
               <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Brithday</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control" placeholder="Tgl lahir" value="<?=$cetak->TGL_LAHIR ?>" name="tgllahirpeg">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">FOTO</label>

                    <img src="<?= base_url()?>asset/user/<?= $cetak->FOTO_PEG ?>" height="142" width="142">

                    <input type="hidden" name="gambarasli" value="<?= $cetak->FOTO_PEG ?>" />
                    <input type="file" name="gambar" size="20" />


                </div>

 <!--                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">FOTO</label>
                  <div class="col-sm-10">
                    <input type="file" name="gambar" size="20" />  
                  </div>
                </div>

              </div> -->

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

