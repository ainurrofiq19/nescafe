



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
              <form class="form-horizontal" action="<?= base_url('admin/add_code_delivery')?>"
                enctype="multipart/form-data" method="post">
                <div class="box-body">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Kode Pengiriman</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" placeholder="Code Item" name="code">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Toko Penerima</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="toko">
                        <?php foreach($kat->result_array() as $cat){ ?>
                          <option value="<?= $cat['ID_TOKO'] ?>"><?= $cat['NAMA_TOKO'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">BP Penerima</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="bp">
                        <?php foreach($bpkat->result_array() as $bpcat){ ?>
                          <option value="<?= $bpcat['NIP'] ?>"><?= $bpcat['NAMA_PEG'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
                    <div class="col-sm-8">
                      <input type="date" class="form-control" name="tgl">
                    </div>
                  </div>



                </div>


                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-default">Cancel</button>
                  <button type="submit" class="btn btn-info pull-right">Buat Pengiriman</button>
                </div>
                <!-- /.box-footer -->
              </form>
            </div>
          </div>
        </div>

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
                  <th>KODE PENGIRIMAN</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                  <th>CSS grade</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($cetak1 as $data1){?>
                  <tr>
                    <td><?= $data1->KODE_PENGIRIMAN?></td>
                    <td><?= $data1->TANGGAL?></td>
                    <td><?= $data1->TOKO?></td>
                    <td><?= $data1->BP?></td>
                    <td><?= $data1->STATUS?></td>
                    <td><a href="<?= base_url("Admin/add_item_delivery/$data1->KODE_PENGIRIMAN")?>" class="btn btn-primary">Check</a></td>
                  </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                  <th>CSS grade</th>
                </tr>
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
