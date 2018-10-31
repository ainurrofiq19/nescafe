



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
            <form class="form-horizontal" action="<?= base_url('spv/add_news')?>" 
              enctype="multipart/form-data" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Judul berita</label>
                  <div class="col-sm-8">
                    <input type="hidden" class="form-control" placeholder="id" name="id">
                    <input type="text" class="form-control" placeholder="judul" name="judul">
                  </div>
                </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">isi berita</label>
               <div class="col-sm-8">
              
                    <textarea id="editor1" name="isi" rows="10" cols="80">
                    </textarea>
               </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Gambar</label>
                  <div class="col-sm-10">
                    <input type="file" name="gambar" size="20" />  
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


 <script type="text/javascript" src="<?= base_url()?>asset/tinymce/js/tinymce/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?= base_url()?>asset/tinymce/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="<?= base_url()?>asset/tinymce/js/tinymce/init.tinymce.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
