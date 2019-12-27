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
            
          </div>
        
          <!-- /.card-header -->
          <div class="card-body">
            
            
              <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
            
                  <th>ID</th>
                  <th>Produk ID</th>
                  <th>Supplier ID</th>
                  <th>QTY</th>
                  <th>Tanggal Purchase</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
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
              </div>
            </div>
            </div>
        </div>
        </div>
        </div>
        </div>
    </section>
<?php $this->load->view('layouts/footer');?>
<script type="text/javascript">
 
var save_method; //for save method string
var table;
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('purchase/get_list')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],
 
    });
 
    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
 
});
 
</script>