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
                                       <?php echo view('user/rfa/pending/sections/pending_rfa_transactions_table'); ?>       
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



     var activity_table = $('#rfa_pending_table').DataTable({

            responsive: false,
            "ajax" : {
                        "url": base_url + 'api/get-user-pending-rfa',
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
