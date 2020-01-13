<?php $this->load->view('layouts/header');?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user');?>">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
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
          <div class="error">
          <?php $this->session->flashdata('error');?>
          </div>
         
          <form action="<?php echo base_url('user/change');?>" id="form" class="form-horizontal" method="POST">
                    <input type="hidden" value="<?php echo $this->session->userdata('id');?>" name="id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">New Password</label>
                            <div class="col-md-9">
                               <input type="password" name="new_password" id="newp">
                                <?php echo form_error('new_password'); ?>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Confirm Password</label>
                            <div class="col-md-9">
                               <input type="password" name="confirm_password" id="cp">
                                <?php echo form_error('confirm_password'); ?>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Current Password</label>
                            <div class="col-md-9">
                               <input type="password" name="current_password" id="current">
                                <?php echo form_error('current_password'); ?>
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