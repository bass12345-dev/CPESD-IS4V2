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



     var rfa_pending_table = $('#rfa_pending_table').DataTable({

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
                data: "status1",
               

            },
            {
                data: "action1",
               

            },

           
          ]
        });


 $(document).on('click','a#received-document',function (e) {
            e.preventDefault();

    const id = $(this).data('id');

  
    Swal.fire({
        title: "",
        text: "Receive RFA",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
    }).then(function(result) {
        if (result.value) {



         $.ajax({
            type: "POST",
            url: base_url + 'api/received-rfa',
            data: {id : id},
            dataType: 'json',
            
            success: function(data)
            { 
                if (data.response) {
             
       
                        Toastify({
                                  text: 'Success',
                                  className: "info",
                                  style: {
                                    "background" : "linear-gradient(to right, #00b09b, #96c93d)",
                                    "height" : "60px",
                                    "width" : "350px",
                                    "font-size" : "20px"
                                  }
                                }).showToast();

                      
                       
                         
                        
                           
             
                }else {
                  
                      Toastify({
                                  text: data.message,
                                  className: "info",
                                  style: {
                                    "background" : "linear-gradient(to right, #00b09b, #96c93d)",
                                    "height" : "60px",
                                    "width" : "350px",
                                    "font-size" : "20px"
                                  }
                                }).showToast();
                        }

                
           },

            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                
            },
            
            })
         
       



        } else if (result.dismiss === "cancel") {
           swal.close()

        }
    });

        });



                       
                   

</script>
</body>
</html>
