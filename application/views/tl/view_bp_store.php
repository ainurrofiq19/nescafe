



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
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Shopkeeper</th>
                  <th>Name Store</th>
                  <th>Addres</th>
                  <th>City</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($cetak1 as $data1){?>
                  <tr>
                    <td><?= $data1->NAMA_PEG?></td>
                    <td><?= $data1->NAMA_TOKO?></td>
                    <td><?= $data1->ALAMAT_TOKO?></td>
                    <td><?= $data1->KOTA_TOKO?></td>
                    
                    <td>
                      <a href="<?= base_url('Tl/form_edit_jaga/'.$data1->AI_JAGA);?>" class="btn btn-primary">Ubah</a>
                      <a href="<?= base_url('Tl/hapus_jaga/'.$data1->AI_JAGA)?>" class="btn btn-danger"> Delete </a>
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
    </section>
    <!-- /.content -->
  </div>
