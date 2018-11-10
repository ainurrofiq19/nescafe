 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url()?>asset/user/<?=$this->session->userdata('gambar')?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
           <p>
            <?php
              echo $this->session->userdata('nickname');
              $level = $this->session->userdata('level');

            ?>

          </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dasboard</span>
          </a>
        </li>
        <?php if($level == "1"){?>
         <li class="treeview">
          <a href="">
            <i class="fa fa-pie-chart"></i>
            <span>Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('Admin/view_item')?>"><i class="fa fa-circle-o"></i>View Product </a></li>
            <li><a href="<?= base_url('Admin/add_item')?>"><i class="fa fa-circle-o"></i> Add Product</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Employee</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('Admin/view_employee')?>"><i class="fa fa-circle-o"></i>View Employee</a></li>
            <li><a href="<?= base_url('Admin/add_employee')?>"><i class="fa fa-circle-o"></i>Add Employee</a></li>
          </ul>
        </li>
        <li>
          <a href="<?= base_url('Admin/accepting_item_request')?>"><i class="fa fa-circle-o"></i> Accepting Product Request</a>
        </li>
       
            <li >
              <a href="<?= base_url('Admin/view_item_delivery')?>"><i class="fa fa-laptop"></i>Product delivery</a>
            </li>
         
        <li><a href="<?= base_url('Admin/view_monthly_report')?>"><i class="fa fa-circle-o text-red"></i> <span>monthly report</span></a></li>
               

 <?php }elseif($level == "2"){  ?>

            <li><a href="<?= base_url('Bp/view_item_request')?>"><i class="fa fa-pie-chart"></i>Product request</a></li>
        
            <li><a href="<?= base_url('Bp/accepting_item_delivery')?>"><i class="fa fa-pie-chart"></i>accepting Product delivery</a></li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('Bp/view_report')?>"><i class="fa fa-circle-o"></i>view report</a></li>
            <li><a href="<?= base_url('Bp/add_report')?>"><i class="fa fa-circle-o"></i>Add report</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Product reture</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('Bp/view_item_reture')?>"><i class="fa fa-circle-o"></i>view Product reture</a></li>
            <li><a href="<?= base_url('Bp/add_item_reture')?>"><i class="fa fa-circle-o"></i>Add Product reture</a></li>
          </ul>
        </li>
                <?php }elseif($level == "3"){  ?>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>brand presenter</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('Tl/view_brand_presenter')?>"><i class="fa fa-circle-o"></i>view brand presenter</a></li>
            <li><a href="<?= base_url('Tl/add_brand_presenter')?>"><i class="fa fa-circle-o"></i>Add brand presenter</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>store</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('Tl/view_store')?>"><i class="fa fa-circle-o"></i>view store</a></li>
            <li><a href="<?= base_url('Tl/add_store')?>"><i class="fa fa-circle-o"></i>Add store</a></li>
          </ul>
        </li>
         <li><a href="<?= base_url('Tl/view_report')?>"><i class="fa fa-circle-o text-yellow"></i> <span>report</span></a></li>
         <li><a href="<?= base_url('Tl/view_monthly_report')?>"><i class="fa fa-circle-o text-red"></i> <span>monthly report</span></a></li>
                 <?php }elseif($level = "4"){ ?>

         <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>item reture</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('Spv/view_item_reture')?>"><i class="fa fa-circle-o"></i>view item reture</a></li>
            <li><a href="<?= base_url('Spv/accepting_item_reture')?>"><i class="fa fa-circle-o"></i>accepting item reture</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>news</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('Spv/view_news')?>"><i class="fa fa-circle-o"></i>view news</a></li>
            <li><a href="<?= base_url('Spv/add_news')?>"><i class="fa fa-circle-o"></i>Add news</a></li>
          </ul>
        </li>
        <li><a href="<?= base_url('Spv/view_report')?>"><i class="fa fa-circle-o text-aqua"></i> <span>report</span></a></li>
        <li><a href="<?= base_url('Spv/view_monthly_report')?>"><i class="fa fa-circle-o text-red"></i> <span>monthly report</span></a></li>
        <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
