<!doctype html>
<html class="no-js" lang="en">
   <head>
      <?php echo view('includes/meta.php') ?>
      <?php echo view('includes/css.php') ?> 

   </head>
   <body>
      <div class="page-container sbar_collapsed">
         <div class="main-content">

            <?php echo view('global/view_user/includes/view_user_topbar'); ?>
            <?php echo view('global/view_user/includes/view_user_breadcrumbs'); ?>
            <div class="main-content-inner "  style="padding: 100px;" >
                
                      <div class="row">
                        <div class="col-12 ">
                           <div class="card" style="border: 1px solid;  ">
                              <div class="card-body">
                                 <div class="row">
                                    <div class="col-md-12"> 



                                         <?php echo view('global/view_user/section/user_data_section'); ?>
                                       
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


      <script type="text/javascript">
         function load_user_data(){

               $.ajax({
                            type: "POST",
                            url: base_url + 'api/get-user-data',
                            data : {'id' : '<?php echo $_GET['id'] ?>'},
                            cache: false,
                            dataType: 'json',  
                            success: function(data){

                                 $('.name').text(data.name)
                                  $('.email_address').text(data.email_address)
                                   $('.contact_number').text(data.contact_number)

                            }
                     })
         }

         load_user_data();
      </script>

   </body>
</html>