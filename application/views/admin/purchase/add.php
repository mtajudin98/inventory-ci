<?php $this->load->view('layouts/header');?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Purchase Add</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user');?>">Home</a></li>
              <li class="breadcrumb-item active">Purchase Add</li>
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
          </div>
        
          <!-- /.card-header -->
          <div class="card-body">
          <form action="<?php echo base_url('purchase/add');?>" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <input type="hidden" value="1" name="user_id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Produk</label>
                            <div class="col-md-9">
                                <select name="nama_produk" class="form-control">
                                <option value="-">-- Pilih Produk --</option>
                                <?php foreach($list1 as $pro):?>
                                
                                <option value="<?php echo $pro->id;?>"><?php echo $pro->nama_produk;?></option>
                                <?php endforeach;?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Supplier</label>
                            <div class="col-md-9">
                            <select name="nama_supplier" placeholder="Nama Supplier" class="form-control">
                            <option value="-">-- Pilih Supplier --</option>
                                <?php foreach($list2 as $sup):?>
                                <option value="<?php echo $sup->id;?>"><?php echo $sup->nama_supplier;?></option>
                                <?php endforeach;?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">QTY Produk</label>
                            <div class="col-md-9">
                            <input name="qty" placeholder="QTY Produk" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                           
                            <div class="col-md-9">
                            <button type="submit" class="btn btn-primary">Save</button>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
          </div>
            </div>
            </div>
        </div>
        </div>
        </div>
        </div>
    </section>
<?php $this->load->view('layouts/footer');?>