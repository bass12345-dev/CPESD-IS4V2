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
                        
                        return '<div class="btn-group dropleft">\
                                              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\
                                               <i class="ti-settings" style="font-size : 15px;"></i>\
                                              </button>\
                                              <div class="dropdown-menu">\
                                                <a  href="javascript:;" class="dropdown-item completed" id="delete-client" data-name="'+data['full_name']+'" data-id="'+data['rfa_client_id']+'"   ><i class="fa fa-trash"></i> Delete</a>\
                                              </di>';
                }

            },

          
          ]
        });   

    


  $(document).on('click','a#delete-client',function (e) {

        var id = $(this).data('id');   
        var name = $(this).data('name');
       

          Swal.fire({
        title: "",
        text: "Delete " + name,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
    }).then(function(result) {
        if (result.value) {
            
                    $.ajax({
                            type: "POST",
                            url: base_url + 'api/delete-client',
                            data: {id:id},
                            cache: false,
                            dataType: 'json', 
                            beforeSend : function(){

                                  Swal.fire({
                                title: "",
                                text: "Please Wait",
                                icon: "",
                                showCancelButton: false,
                                showConfirmButton : false,
                                reverseButtons: false,
                                allowOutsideClick : false
                            })

                            },
                            success: function(data){
                               if (data.response) {

                                  Swal.fire(
                                            "",
                                            "Success",
                                            "success"
                                        )

                                 

                                 rfa_clients_table.ajax.reload()
                                 
                               }else {

                                 Swal.fire(
                                            "",
                                             data.message,
                                             "error"
                                           
                                        )

                               }

                              
                          
                            }
                    })



            // result.dismiss can be "cancel", "overlay",
            // "close", and "timer"
        } else if (result.dismiss === "cancel") {
           swal.close()

        }
    });
     });

    
</script>

</body>
</html>
