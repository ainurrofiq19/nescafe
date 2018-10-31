



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
                  <th>Judul</th>
                  <th>Isi</th>
                  <th>Foto</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($cetak1 as $data1){?>
                  <tr>
                    <td><?= $data1->JUDUL?></td>
                    <td><?= $data1->ISI?></td>
                    <!-- <td><?= $data1->FOTO?></td> -->
                     <td>
                      <img style="width: 50px" src="<?= base_url()?>asset/berita/<?= $data1->FOTO?>" >
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                </tfoot>
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

