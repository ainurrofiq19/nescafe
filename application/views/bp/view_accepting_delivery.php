



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
                  <th>No Order</th>
                  <th>Date</th>
                  <th>Brand Presenter</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($cetak1->result() as $data1){?>
                  <tr>
                    <td><?= $data1->KODE_PENGIRIMAN?></td>
                    <td><?= $data1->TGL_PENGIRIMAN?></td>
                    <td><?= $data1->BP_PENGIRIMAN?></td>
                    <td>
                        <?php
                          $t = $data1->STATUS_PENGIRIMAN;

                            if ($t =='1') {
                              echo "Delivery";
                            } elseif ($t =='2') {
                              echo "Be Accepted";
                            }

                       ?>
                    <td>
                      <?php if ($data1->STATUS_PENGIRIMAN == "1"||$data1->STATUS_PENGIRIMAN == "3" ){ ?>
                        <a href="<?= base_url("Bp/detail_item_delivery/$data1->KODE_PENGIRIMAN")?>" class="btn btn-primary">Detail</a>
                        <a href="<?= base_url('Bp/accepting_item_delivery2/'.$data1->KODE_PENGIRIMAN);?>" class="btn btn-success"> Accept </a>
                      <?php }elseif ($data1->STATUS_PENGIRIMAN == "2") { ?>
                         <a href="<?= base_url("Bp/detail_item_delivery/$data1->KODE_PENGIRIMAN")?>" class="btn btn-primary">Detail</a>
                      <?php } ?>
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
