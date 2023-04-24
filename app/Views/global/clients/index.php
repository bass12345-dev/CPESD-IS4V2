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
                                  
                                        <?php echo view('global/clients/sections/clients_table'); ?> 
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

    var rfa_clients_table = $('#rfa_clients_table').DataTable({
            responsive: false,
            "ajax" : {
                        "url": base_url + 'api/get-clients',
                        "type" : "POST",
                        "dataSrc": "",
            },
            'columns': [
             {
              
                data: "full_name" ,
               

            },
             {
               
                data: "address",
               

            },
             {
               
                data: "contact_number",
                

            },
            {
                
                data: "age",
               
            },
            {
               
                data: "employment_status",
               

            },

            {
              
                data: null,
                render: function (data, type, row) {
                    return '<ul class="d-flex justify-content-center">\
                                <li><a href="javascript:;" data-id="'+data['rfa_client_id']+'"  id="update-client"  class="text-secondary action-icon mr-2"><i class="fa fa-edit"></i></a></li>\
                                 <li><a href="javascript:;" data-id="'+data['rfa_client_id']+'"  id="update-client"  class="text-secondary action-icon"><i class="fa fa-eye"></i></a></li>\
                                </ul>';
                }

            },

          
          ]
        });   
    
</script>

</body>
</html>
