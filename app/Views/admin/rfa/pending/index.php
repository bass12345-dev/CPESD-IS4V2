<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php echo view('includes/meta.php') ?>
    <?php echo view('includes/css.php') ?> 
</head>

<body>
   
 
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
                                         <?php echo view('admin/rfa/pending/sections/rfa_pending_transactions_table')  ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>     
<?php echo view('includes/scripts.php') ?>  

<script>
    

        var rfa_pending_table = $('#rfa_pending_table').DataTable({

            responsive: false,
            "ajax" : {
                        "url": base_url + 'api/get-admin-pending-rfa',
                        "type" : "POST",
                        "dataSrc": "",
            },
             'columns': [
            {
                data: "name",
                

            },
              {
                data: "address",
               
            },
              {
                data: "type_of_request_name",
               

            },
              {
                data: "type_of_transaction",
               

            },
            {
                data: "type_of_transaction",
               

            },
            {
                data: "type_of_request_name",
               

            },

           
          ]
        });
</script> 
</body>
</html>
