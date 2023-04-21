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
                            <div class="card " style="border: 1px solid;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <div class="row">
                                                <div class="col-md-12"> 
                                                   
                                                    <button  class="btn  mb-3 mt-2 sub-button pull-right mr-2" id="reload_user_pending_transaction" > Reload <i class="ti-loop"></i></button>
                                                </div>
                                            </div>
                                            <div class="data-tables">
                                                <table id="rfa_received_table" style="width:100%" class="text-center">
                                                    <thead class="bg-light text-capitalize">
                                                       <tr>
                                                       
                                                          <th>Name of Client</th>
                                                          <th>Complete Address</th>
                                                          <th>Type of Request</th>
                                                          <th>Type of Transaction</th>
                                                           <th>Action</th>
                                                       </tr>
                                                    </thead>
                                                 </table>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>     

<?php echo view('user/transactions/pending/modals/view_remark_modal') ?>  
<?php echo view('includes/scripts.php') ?>  
<script>



     var rfa_pending_table = $('#rfa_received_table').DataTable({

            responsive: false,
            "ajax" : {
                        "url": base_url + 'api/get-user-received-rfa',
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
                // data: "song_title",
                data: null,
                render: function (data, type, row) {
                    return '<ul class="d-flex justify-content-center">\
                                <li><a href="javascript:;" data-id="'+data['type_of_activity_id']+'"  id="delete-activity"  class="text-secondary action-icon mr-2"><i class="fa fa-share"></i></a></li>\
                                <li><a href="javascript:;" data-id="'+data['type_of_activity_id']+'"  id="delete-activity"  class="text-danger action-icon"><i class="ti-trash"></i></a></li>\
                                </ul>';
                }

            },
          ]
        });

      



</script> 
</body>
</html>
