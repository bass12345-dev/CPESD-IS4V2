<!doctype html>
<html class="no-js" lang="en">
   <head>
      <?php echo view('includes/meta.php') ?>
      <?php echo view('includes/css.php') ?> 

   </head>
   <body>
      <div class="page-container sbar_collapsed">
         <div class="main-content">

            <?php echo view('global/view_transaction/includes/view_transaction_topbar'); ?>
            <?php echo view('global/view_transaction/includes/view_transaction_breadcrumbs'); ?>
            <div class="main-content-inner "  style="padding: 100px;" >
                
                      <div class="row">
                        <div class="col-12 ">
                           <div class="card" style="border: 1px solid;  ">
                              <div class="card-body">
                                 <div class="row">
                                    <div class="col-md-12">               
                                        <?php echo view('global/view_transaction/section/view_transaction'); ?>
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

      function load_transaction_data(){ $.ajax({ type: "POST", url: base_url + 'api/get-transaction-data', data : {'id' : '<?php echo $_GET['id'] ?>'}, cache: false, dataType: 'json', success: function(data){ $('#project_section').attr('hidden','hidden'); $('#training_section').attr('hidden','hidden'); $('.pmas_no').text(data.pmas_no); $('.date_and_time_filed').text(data.date_and_time_filed); $('.responsible_section_name').text(data.responsible_section_name); $('.type_of_activity_name').text(data.type_of_activity_name); $('.responsibility_center_name').text(data.responsibility_center_name); $('.date_and_time').text(data.date_time); if (data.training_data.length > 0) { $('#under_type_activity_select').removeAttr('hidden').fadeIn("slow"); $('.for_training').removeAttr('hidden').fadeIn("slow"); $('.for_project_monitoring').attr('hidden','hidden'); $('#training_section').removeAttr('hidden'); $('#project_section').attr('hidden','hidden'); $('.title_of_training').text(data.training_data[0].title_of_training); $('.number_of_participants').text(data.training_data[0].number_of_participants); $('.female').text(data.training_data[0].female); $('.male').text(data.training_data[0].male); $('.over_all_ratings').text(data.training_data[0].overall_ratings); $('.name_of_trainor').text(data.training_data[0].name_of_trainor); } if (data.project_monitoring_data.length > 0) { $('#under_type_activity_select').attr('hidden','hidden'); $('.for_training').attr('hidden','hidden'); $('.for_project_monitoring').removeAttr('hidden').fadeIn("slow"); $('input[name=update_project_title]').val(data.project_monitoring_data[0].project_title); $('#training_section').attr('hidden','hidden'); $('#project_section').removeAttr('hidden'); $('.project_title').text(data.project_monitoring_data[0].project_title); $('.period').text(data.project_monitoring_data[0].period); $('.present').text(data.project_monitoring_data[0].present); $('.absent').text(data.project_monitoring_data[0].absent); $('.delinquent').text(data.project_monitoring_data[0].delinquent); $('.overdue').text(data.project_monitoring_data[0].overdue); $('.total_production').text('₱ '+data.project_monitoring_data[0].total_production ); $('.total_collection_sales').text('₱ '+data.project_monitoring_data[0].total_collection_sales); $('.total_released_purchases').text('₱ '+data.project_monitoring_data[0].total_released_purchases); $('.total_delinquent_account').text('₱ '+data.project_monitoring_data[0].total_delinquent_account); $('.total_over_due_account').text('₱ '+data.project_monitoring_data[0].total_over_due_account); $('.cash_in_bank').text('₱ '+data.project_monitoring_data[0].cash_in_bank); $('.cash_on_hand').text('₱ '+data.project_monitoring_data[0].cash_on_hand); $('.inventories').text('₱ '+data.project_monitoring_data[0].inventories); $('.total_volume_of_business').text('₱ '+data.project_monitoring_data[0].total_volume_of_business); $('.total_cash_position').text('₱ '+data.project_monitoring_data[0].total_cash_position); } } }) } load_transaction_data();


      </script>
   </body>
</html>