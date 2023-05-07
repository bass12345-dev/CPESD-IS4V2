<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php echo view('includes/meta.php') ?>
    <?php echo view('includes/css.php') ?> 
</head>

<body>
   
 <?php echo view('includes/preloader') ?> 
    <div class="page-container">       
    <?php echo view('includes/sidebar.php') ?> 
        <div class="main-content">           
            <?php echo view('includes/topbar.php') ?>           
            <?php echo view('includes/breadcrumbs.php') ?> 
                <div class="main-content-inner">
                      <div class="row">
                           <div class="col-12 mt-5">
                              <div class="card" style="border: 1px solid;">
                                 <div class="card-body">
                                    
                                    <div class="row">
                                       <?= view('user/rfa/completed/sections/completed_rfa_table'); ?>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                </div>
        </div>
    </div>     
<?php echo view('includes/scripts.php') ?>   
<script type="text/javascript">
$('#rfa_completed_table').DataTable({ responsive: false, "ordering": false, "ajax" : { "url": base_url + 'api/user/get-user-completed-rfa', "type" : "POST", "dataSrc": "", }, 'columns': [ { data: "ref_number", }, { data: "name", }, { data: "address", }, { data: "type_of_request_name", }, { data: "type_of_transaction", }, { data: null, render: function (data, type, row) { return '<ul class="d-flex justify-content-center">\ <li><a href="javascript:;" data-id="'+data['rfa_id']+'"   id="view_rfa_"  class="text-secondary action-icon"><i class="ti-eye"></i></a></li>\ </ul>'; } }, ] });
</script>
</body>
</html>
