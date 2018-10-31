
    <!-- Main content -->
    <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?= base_url()?>asset/user/<?= $bp->FOTO_PEG?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $bp->NAMA_PEG; ?></h3>

              <p class="text-muted text-center">                      <?php
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

                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name"value="<?php echo $bp->ALAMAT_PEG; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email"value="<?php echo $bp->EMAIL_PEG; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Telephone</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name"value="<?php echo $bp->TLP_PEG; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Gender</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name"value="<?php
$t = $bp->JENIS_KELAMIN;

  if ($t =='l') {
    echo "Male";
  }else {
    echo "Female";
  }


?>">
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Birthday</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name"value="<?php echo $bp->TGL_LAHIR; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
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

