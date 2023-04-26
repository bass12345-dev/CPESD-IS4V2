<!doctype html>
<html class="no-js" lang="en">
   <head>
      <?php echo view('includes/meta.php') ?>
      <?php echo view('includes/css.php') ?> 

   </head>
   <body>
      <div class="page-container sbar_collapsed">
         <div class="main-content">

            <?php echo view('global/view_rfa/sections/view_rfa_topbar'); ?>
             <?php echo view('global/view_rfa/sections/view_rfa_breadcrumbs'); ?>
            <div class="main-content-inner "  style="padding: 100px;" >
                
                      <div class="row">
                        <div class="col-12 ">
                           <div class="card" style="border: 1px solid;  ">
                              <div class="card-body">
                                 <div class="row">
                                    <div class="col-md-12">               
                                        <?php echo view('global/view_rfa/view_rfa_data'); ?>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>    
               
                </div>
            </div>
         </div>
      <?php echo view('includes/scripts.php') ?> 
      <script>

      

        function load_rfa_data(){

               $.ajax({
                            type: "POST",
                            url: base_url + 'api/view-rfa-data',
                            data : {'id' : '<?php echo $_GET['id'] ?>'},
                            cache: false,
                            dataType: 'json',  
                            success: function(data){
                                    
                                    $('.reference_no').text(data.ref_number)
                                    $('.name_of_client').text(data.client_name)
                                    $('.type_of_request').text(data.type_of_request_name)
                                    $('.type_of_transaction').text(data.type_of_transaction)
                                    $('.date_and_time').text(data.date_time_filed)

                                    $('.approve_date').text(data.approved_date)
                                    $('.encoded_by').text(data.encoded_by);

                                    $('.referred_to').text(data.referred_name);
                                     $('.status').html(data.status);
                                    

                                    
                                 
                                 }
                        })


            }
                                       
                            


         load_rfa_data();




      </script>
   </body>
</html>