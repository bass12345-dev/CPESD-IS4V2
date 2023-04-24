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
                                    
                                       <?php echo view('user/transactions/completed/sections/completed_transactions_table'); ?>       
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
        </div>
    </div>     
<?php echo view('includes/scripts.php') ?>   
<script type="text/javascript">
      function fetch_user_completed_transactions(){

           $.ajax({
            url: base_url + 'api/user/get-user-completed-transactions',
            type: "POST",
            dataType: "json",
            success: function(data) {

                
                    $('#user_completed_transactions_table').DataTable({

                   
                    "ordering": false,
                    "data": data,
                    'columns': [
            {
                // data: "song_title",
                data: null,
                render: function (data, type, row) {
                    return '<b><a href="javascript:;"   data-id="'+data['res_center_id']+'"  style="color: #000;"  >'+data['pmas_no']+'</a></b>';
                }

            },
             {
                // data: "song_title",
                data: null,
                render: function (data, type, row) {
                    return '<a href="javascript:;"   data-id="'+data['res_center_id']+'"  style="color: #000;"  >'+data['date_and_time_filed']+'</a>';
                }

            },
        
             {
                // data: "song_title",
                data: null,
                render: function (data, type, row) {
                    return '<a href="javascript:;"   data-id="'+data['res_center_id']+'"  style="color: #000;"  >'+data['type_of_activity_name']+'</a>';
                }

            },

            {
                // data: "song_title",
                data: null,
                render: function (data, type, row) {
                    return '<a href="javascript:;"   data-id="'+data['res_center_id']+'"  style="color: #000;"  >'+data['cso_name']+'</a>';
                }

            },

       
            {
                // data: "song_title",
                data: null,
                render: function (data, type, row) {
                    return '<a href="javascript:;"   data-id="'+data['res_center_id']+'"  style="color: #000;"  >'+data['name']+'</a>';
                }

            },

               {
                // data: "song_title",
                data: null,
                render: function (data, type, row) {
                    return '<ul class="d-flex justify-content-center">\
                                <li class="mr-3 "><a href="javascript:;" class="text-secondary action-icon" data-id="'+data['transaction_id']+'"   id="view_transaction"><i class="fa fa-eye"></i></a></li>\
                                </ul>';
                }
            }


            
          ]

                })


            }

        })
    }

    fetch_user_completed_transactions()
</script>
</body>
</html>
