<?php $this->load->view('layouts/header');?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Purchase List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user');?>">Home</a></li>
              <li class="breadcrumb-item active">Purchase List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Purchase List</h3>
            <div class="card-tools"><a href="<?php echo base_url('purchase/add');?>" class="btn btn-success"><i class="fas fa-plus"></i> Add Purchase</a></div>
          </div>
        
          <!-- /.card-header -->
          <div class="card-body">
            
            
              <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
            
                  <th>ID</th>
                  <th>Nama Produk</th>
                  <th>Nama Supplier/th>
                  <th>QTY</th>
                  <th>Tanggal Purchase</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = $this->uri->segment('3') + 1; 
                foreach($list as $rows):

                ?>
                <tr>
                <td><?php echo $rows->id;?></td>
                <td><?php echo $rows->nama_produk;?></td>
                <td><?php echo $rows->nama_supplier;?></td>
                <td><?php echo $rows->qty;?></td>
                <td><?php echo $rows->tanggal_purchase;?></td>
                <td><a href class="btn btn-primary"><i class="fas fa-search"></i></a></td>
                </tr>
                  <?php  endforeach; ?>
                </tbody>

                <tfoot>
                <tr>
                
                <th>ID</th>
                  <th>Produk ID</th>
                  <th>Supplier ID</th>
                  <th>QTY</th>
                  <th>Tanggal Purchase</th>
                  <th>Actions</th>
                </tr>
                </tfoot>
              </table>
              <?php 
                  echo $this->pagination->create_links();?>
              </div>
            </div>
            </div>
        </div>
        </div>
        </div>
        </div>
    </section>
<?php $this->load->view('layouts/footer');?>