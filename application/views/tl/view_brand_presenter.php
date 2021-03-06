



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
                  <th>Nip</th>
                  <th>Nama</th>
                  <th>Addres</th>
                  <th>Phone</th>
                  <th>E-mail</th>
                  <th>Gender</th>
                  <th>Date Of Birth</th>
                  <th>First Day Working</th>
                  <th>Assigment</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($cetak1 as $data1){?>
                  <tr>
                    <td><?= $data1->NIP?></td>
                    <td><?= $data1->NAMA_PEG?></td>
                    <td><?= $data1->ALAMAT_PEG?></td>
                    <td><?= $data1->TLP_PEG?></td>
                    <td><?= $data1->EMAIL_PEG?></td>
                    <td>
                       <?php
                          $t = $data1->JENIS_KELAMIN;

                            if ($t =='l') {
                              echo "Male";
                            }else {
                              echo "Female";
                            }
                          ?>
                    </td>
                     <td><?= $data1->TGL_LAHIR?></td>
                    <td><?= $data1->TGL_MASUK?></td>
                    <td><?= $data1->NAMA_TOKO?></td>
                    <td>
                      <!-- 'admin/products/edit/'.$product->pro_id, -->
                      <a href="<?php echo base_url(); ?>index.php/Tl/edit_brand_presenter/<?php echo $data1->NIP; ?>" class="btn btn-primary">Edit</a>
                      <a href="<?php echo base_url(); ?>index.php/Tl/hapus_brand_presenter/<?php echo $data1->NIP; ?>" class="btn btn-danger"> Delete </a>
                      <a href="<?php echo site_url('Tl/detail_brand_presenter/'.$data1->NIP);?>" class="btn btn-success">Detail</a>
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

