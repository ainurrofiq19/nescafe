



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Employee List
        <small>Daftar Pegawai</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Employee</a></li>
        <li class="active">Employee List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Employee List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>NIP</th>
                  <th>Employee position</th>
                  <th>Address</th>
                  <th>Telephone</th>
                  <th>E-mail</th>
                  <th>Gender</th>
                  <th>Assigment</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($cetak1 as $data1){?>
                  <tr>
                    <td><?= $data1->NAMA_PEG?></td>
                    <td><?= $data1->NIP?></td>
                    <td>

                      <?php
                          $t = $data1->LEVEL;

                            if ($t =='1') {
                              echo "Admin";
                            } elseif ($t =='2') {
                              echo "Brand presenter";
                            } elseif ($t =='3') {
                              echo "Team Leader";
                            }else {
                              echo "Supervisor";
                            }
                       ?>
                    </td>
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
                    <td><?= $data1->NAMA_TOKO?></td>
                    <td>
                      <!-- 'admin/products/edit/'.$product->pro_id, -->
                      <a href="<?php echo base_url(); ?>index.php/Admin/edit_employee/<?php echo $data1->NIP; ?>" class="btn btn-primary">Edit</a>
                      <a href="<?php echo base_url(); ?>index.php/Admin/hapus_employee/<?php echo $data1->NIP; ?>" class="btn btn-danger"> Delete </a>
                      <a href="<?php echo site_url('Admin/detail_employee/'.$data1->NIP);?>" class="btn btn-success">Detail</a>
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

