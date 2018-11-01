<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       DETAIL PRODUCT DELIVERY
        <small>detail Pengiriman Barang</small>
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
         
            <!-- /.box-header -->
            <div class="box-body">
               <div class="col-xs-12">
          <h3 style="text-align: center;">DELIVERY ORDER</h3>
<h4 style="text-align: center; "><i class="form-group "></i> Surat Jalan</h4>
<hr />
<br />
<div class="row">
   <div class="col-md-2">
      <b>No </b>
   </div>
   <div class="col-md-2">
      <b>:<?php echo $deliv->KODE_PENGIRIMAN; ?></b>
   </div>
   </div>
   <div class="row">
   <div class="col-md-2">
      <b>Date/Tanggal </b>
   </div>
   <div class="col-md-2">
      <b>:<?php echo $deliv->TANGGAL; ?></b>
   </div>
</div>
 <div class="row">
   <div class="col-md-2">
      <b>To/Tujuan</b>
   </div>
   <div class="col-md-2">
      <b>:<?php echo $deliv->NAMA_TOKO; ?></b>
    <br>
      <b><?php echo $deliv->ALAMAT_TOKO; ?></b>

   </div>
</div>
<div class="row">
   <div class="col-md-2">
      <b>Brand Presenter</b>
   </div>
   <div class="col-md-2">
      <b>:<?php echo $deliv->NAMA_PEG; ?></b>
   </div>
</div>
 <div class="box-body">
      <table  class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>NO</th>
          <th>Product Code / kode produk</th>
          <th>Product Name / Nama Produk</th>
          <th>Qty / Jumlah</th>

        </tr>
        </thead>
        <tbody>
          <?php $hargatotal = 0 ; $jumlahtotal = 0 ;$total = 0 ?>
          <?php $no =0 ;?>
          <?php foreach($cetak1 as $data1){?>


            <?php
              $no++;
              $hargatotal += $data1->HARGA;
              $jumlahtotal += $data1->QTY;
              $total += $data1->QTY*$data1->HARGA;
              $tot = $data1->QTY*$data1->HARGA;
            ?>
   
            <tr>
              <td><?=  $no  ?></td>
              <td><?= $data1->KODE_PENGIRIMAN ?></td>
              <td><?= $data1->ITEM?></td>
              <td><?= $data1->QTY?></td>

            </tr>
          <?php } ?>
        
        </tbody>
        <tfoot>
        <tr>
          <th> </th>
          <th></th>
          <th></th>
          <th>TOTAL QTY : <?= $jumlahtotal?></th>
        </tr>
        </tfoot>
      </table>
    </div>
<br />
<div class="right">
   <button type="button" class="btn red" onclick="window.history.go(-1)">Kembali</button>
</div>
<br/>
</div>
</div>
</div>
</div>
</div>
</div>
</section>