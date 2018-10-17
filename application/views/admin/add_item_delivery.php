



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
<div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Horizontal Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?= base_url('admin/add_item')?>" 
              enctype="multipart/form-data" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Code pengiriman</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Code Item" name="code">
                  </div>
                </div>
              <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Nama item</label>
                  <div class="col-sm-10">
                    <select class="form-control" >
                      <?php foreach($itkat->result_array() as $itcat){ ?>
                        <option value="<?= $itcat['ID_ITEM'] ?>"><?= $itcat['NAMA_ITEM'] ?></option>
                      <?php } ?>
                    </select> 
                  </div>
                </div>        
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">qty</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Harga" name="jumlah">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">store</label>
                  <div class="col-sm-10">
                    <select class="form-control" >
                      <?php foreach($kat->result_array() as $cat){ ?>
                        <option value="<?= $cat['ID_TOKO'] ?>"><?= $cat['NAMA_TOKO'] ?></option>
                      <?php } ?>
                    </select> 
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">brand presenter</label>
                  <div class="col-sm-10">
                    <select class="form-control" >
                      <?php foreach($bpkat->result_array() as $bpcat){ ?>
                        <option value="<?= $bpcat['NIP'] ?>"><?= $bpcat['NAMA_PEG'] ?></option>
                      <?php } ?>
                    </select> 
                  </div>
                </div>                
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">status</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Harga" name="status">
                  </div>
                </div>                
                
              </div>


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
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($cetak1 as $data1){?>
                  <tr>
                    <td><?= $data1->ID_PENGIRIMAN?></td>
                    <td><?= $data1->NAMA_PENGIRIMAN?></td>
                    <td><?= $data1->QTY?></td>
                    <td><?= $data1->TANGGAL?></td>
                    <td><?= $data1->TOKO?></td>
                    <td><?= $data1->BP?></td>
                    <td><?= $data1->STATUS?></td>
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
                  <th>Engine version</th>
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

