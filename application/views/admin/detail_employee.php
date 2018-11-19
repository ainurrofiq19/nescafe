
 <!-- Main content -->
    <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">

          <!-- Profile Image -->
         <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" style=" width: 220px "  src="<?= base_url()?>asset/user/<?= $bp->FOTO_PEG?>" alt="User profile picture">

              <h3 class="profile-username text-center" ><?php echo $bp->NAMA_PEG; ?></h3>

              <p class="profile-username text-center" >                     
               <?php
                $t = $bp->LEVEL;

                  if ($t =='1') {
                    echo "Admin";
                  } elseif ($t =='2') {
                    echo "Brand presenter";
                  } elseif ($t =='3') {
                    echo "Team Leader";
                  }else {
                    echo "Supervisor";
                  }


                ?></p>


                <form class="form-horizontal" >
                   <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">NIP</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name"value="<?php echo $bp->NIP; ?>" readonly>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Assignment</label>

                    <div class="col-sm-10">
                         <?php foreach ($tok->result() as $cetok){ ?>
                      <?php $set = $cetok->NIP ;?>                    
                      <input type="text" class="form-control" id="inputName" placeholder="Name"value="<?php echo $cetok->NAMA_TOKO; ?>" readonly>
                      <?php } ?>

                    </div>
                  </div>

                   <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name"value="<?php  echo $bp->ALAMAT_PEG; ?>" readonly>
                    </div>
                  </div>
        
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">E-mail</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name"value="<?php  echo $bp->EMAIL_PEG; ?>" readonly>
                    </div>
                  </div>

                    <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Telephone</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name"value="<?php  echo $bp->TLP_PEG; ?>" readonly>
                    </div>
                  </div>
                 
                 <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Date of birth</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name"value="<?php  echo $bp->TGL_LAHIR ?>" readonly>
                    </div>
                  </div>
                 
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Gender</label>

                    <div class="col-sm-10">
                     
                       <input type="text" class="form-control" id="inputName" placeholder="Name"value=" <?php
                          $t = $bp->JENIS_KELAMIN;

                            if ($t =='l') {
                              echo "Male";
                            }else {
                              echo "Female";
                            }


                          ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">First Day Working</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name"value="<?php  echo $bp->TGL_MASUK; ?>" readonly>
                    </div>
                  </div>
                   

                </form>
               <a class="btn btn-success" href="<?php echo site_url('Admin/view_employee')?>">Back</a>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
    <!-- /.content -->
  </div>

