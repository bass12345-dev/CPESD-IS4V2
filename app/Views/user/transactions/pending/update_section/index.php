<!doctype html>
<html class="no-js" lang="en">
   <head>
      <?php echo view('includes/meta.php') ?>
      <?php echo view('includes/css.php') ?> 

       <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

   </head>
   <body>
    <?php echo view('includes/preloader') ?> 
      <div class="page-container sbar_collapsed">
         <div class="main-content">

            <?php echo view('user/transactions/pending/update_section/includes/update_transactions_pending_topbar'); ?>
            <?php echo view('user/transactions/pending/update_section/includes/update_transactions_pending_breadcrumbs'); ?>
            <div class="main-content-inner">
                <div class="row">
                    <div class="col-12 mt-3">
                       <section class="wizard-section" style="background-color: #fff;">
                          <div class="row no-gutters">
                            <?php echo view('user/transactions/pending/update_section/sections/view_transaction'); ?>
                             <?php echo view('user/transactions/pending/update_section/sections/update_form'); ?>
                          </div>
                       </section>
                    </div>
                </div>
            </div>
         </div>
      <?php echo view('user/transactions/pending/update_section/modals/update_select_under_type_of_activity_modal') ?> 
      <?php echo view('includes/scripts.php') ?> 
      <script src="<?php echo base_url(); ?>assets/js/overly.js"></script>
      
      <script>

$(document).ready(function () {
   $('.js-example-basic-single').select2();
});
$('#update_date_and_time').datetimepicker({
   "allowInputToggle": true,
   "showClose": true,
   "showClear": true,
   "showTodayButton": true,
   "format": "YYYY/MM/DD hh:mm:ss A",
});
$('#update_select_under_activity_form').on('submit', function (e) {
   e.preventDefault();
   $('input[name=update_select_under_type_id]').val($('#update_select_under_type').find('option:selected').val());
   $('#update_select_under_activity_modal').modal('hide');
});

function load_transaction_data() {
   $.ajax({
      type: "POST",
      url: base_url + 'api/get-transaction-data',
      data: {
         'id': '<?php echo $_GET['id'] ?>'
      },
      cache: false,
      dataType: 'json',
      success: function (data) {
         $('#project_section').attr('hidden', 'hidden');
         $('#training_section').attr('hidden', 'hidden');
         $('input[name=transaction_id]').val(data.transaction_id);
         $('input[name=update_pmas_number]').val(data.number);
         $('input[name=update_year]').val(data.year);
         $('input[name=update_month]').val(data.month);
         $('select[name=update_responsible_section_id]').val(data.responsible_section_id);
         $('select[name=update_type_of_activity_id]').val(data.type_of_activity_id);
         $('select[name=update_responsibility_center_id]').select2("val", data.responsibility_center_id);
         $('select[name=update_cso_id]').select2("val", data.cso_id);
         $('input[name=update_date_and_time]').val(data.date_and_time);
         $('input[name=update_select_under_type_id]').val(data.under_type_of_activity);
         $('.pmas_no').text(data.pmas_no);
         $('.date_and_time_filed').text(data.date_and_time_filed);
         $('.responsible_section_name').text(data.responsible_section_name);
         $('.type_of_activity_name').text(data.type_of_activity_name);
         $('.responsibility_center_name').text(data.responsibility_center_name);
         $('.cso_name').text(data.cso_name);
         $('.date_and_time').text(data.date_time);
         if (data.training_data.length > 0) {
            $('#under_type_activity_select').removeAttr('hidden').fadeIn("slow");
            $('.for_training').removeAttr('hidden').fadeIn("slow");
            $('.for_project_monitoring').attr('hidden', 'hidden');
            $('input[name=update_title_of_training]').val(data.training_data[0].title_of_training);
            $('input[name=update_number_of_participants]').val(data.training_data[0].number_of_participants);
            $('input[name=update_female]').val(data.training_data[0].female);
            $('input[name=update_over_all_ratings]').val(data.training_data[0].overall_ratings);
            $('input[name=update_name_of_trainor]').val(data.training_data[0].name_of_trainor);
            $('#training_section').removeAttr('hidden');
            $('#project_section').attr('hidden', 'hidden');
            $('.title_of_training').text(data.training_data[0].title_of_training);
            $('.number_of_participants').text(data.training_data[0].number_of_participants);
            $('.female').text(data.training_data[0].female);
            $('.male').text(data.training_data[0].male);
            $('.over_all_ratings').text(data.training_data[0].overall_ratings);
            $('.name_of_trainor').text(data.training_data[0].name_of_trainor);
         }
         if (data.project_monitoring_data.length > 0) {
            $('#under_type_activity_select').attr('hidden', 'hidden');
            $('.for_training').attr('hidden', 'hidden');
            $('.for_project_monitoring').removeAttr('hidden').fadeIn("slow");
            $('input[name=update_project_title]').val(data.project_monitoring_data[0].project_title);
            $('input[name=update_period]').val(data.project_monitoring_data[0].period);
            $('input[name=update_present]').val(data.project_monitoring_data[0].present);
            $('input[name=update_absent]').val(data.project_monitoring_data[0].absent);
            $('input[name=update_delinquent]').val(data.project_monitoring_data[0].delinquent);
            $('input[name=update_overdue]').val(data.project_monitoring_data[0].overdue);
            $('input[name=update_total_production]').val(data.project_monitoring_data[0].total_production);
            $('input[name=update_total_collection]').val(data.project_monitoring_data[0].total_collection_sales);
            $('input[name=update_total_released]').val(data.project_monitoring_data[0].total_released_purchases);
            $('input[name=update_total_deliquent]').val(data.project_monitoring_data[0].total_delinquent_account);
            $('input[name=update_total_overdue]').val(data.project_monitoring_data[0].total_over_due_account);
            $('input[name=update_cash_in_bank]').val(data.project_monitoring_data[0].cash_in_bank);
            $('input[name=update_cash_on_hand]').val(data.project_monitoring_data[0].cash_on_hand);
            $('input[name=update_inventories]').val(data.project_monitoring_data[0].inventories);
            $('#training_section').attr('hidden', 'hidden');
            $('#project_section').removeAttr('hidden');
            $('.project_title').text(data.project_monitoring_data[0].project_title);
            $('.period').text(data.project_monitoring_data[0].period);
            $('.present').text(data.project_monitoring_data[0].present);
            $('.absent').text(data.project_monitoring_data[0].absent);
            $('.delinquent').text(data.project_monitoring_data[0].delinquent);
            $('.overdue').text(data.project_monitoring_data[0].overdue);
            $('.total_production').text('₱ ' + data.project_monitoring_data[0].total_production);
            $('.total_collection_sales').text('₱ ' + data.project_monitoring_data[0].total_collection_sales);
            $('.total_released_purchases').text('₱ ' + data.project_monitoring_data[0].total_released_purchases);
            $('.total_delinquent_account').text('₱ ' + data.project_monitoring_data[0].total_delinquent_account);
            $('.total_over_due_account').text('₱ ' + data.project_monitoring_data[0].total_over_due_account);
            $('.cash_in_bank').text('₱ ' + data.project_monitoring_data[0].cash_in_bank);
            $('.cash_on_hand').text('₱ ' + data.project_monitoring_data[0].cash_on_hand);
            $('.inventories').text('₱ ' + data.project_monitoring_data[0].inventories);
            $('.total_volume_of_business').text('₱ ' + data.project_monitoring_data[0].total_volume_of_business);
            $('.total_cash_position').text('₱ ' + data.project_monitoring_data[0].total_cash_position);
         }
      }
   })
}
load_transaction_data();
$(document).on('click', 'button.close-under-type', function () {
   var text = $('#type_of_activity_select').find('option:selected').text();
   var select_type = $('#select_under_type').find('option:selected').val();
   if (!select_type) {
      alert('Please Select Type of' + text);
   } else {
      $('#select_under_activity_modal').modal('hide');
      $("#select_under_type option").remove();
   }
});
$('#update_transaction_form').on('submit', function (e) {
   e.preventDefault();
   if ($('input[name=update_pmas_number]').val() == '') {
      alert('something');
   } else {
      $.ajax({
         type: "POST",
         url: base_url + 'api/update-transaction',
         data: $(this).serialize(),
         dataType: 'json',
         beforeSend: function () {
            $('.btn-update-transaction').html('<div class="loader"></div>');
            $('.btn-update-transaction').prop("disabled", true);
         },
         success: function (data) {
            if (data.response) {
               $('#update_transaction_form')[0].reset();
               $('.btn-update-transaction').prop("disabled", false);
               $('.btn-update-transaction').text('Submit');
               Toastify({
                  text: data.message,
                  className: "info",
                  style: {
                     "background": "linear-gradient(to right, #00b09b, #96c93d)",
                     "height": "60px",
                     "width": "350px",
                     "font-size": "20px"
                  }
               }).showToast();
               $('a.form-wizard-previous-btn').click();
            } else {
               $('.btn-update-transaction').prop("disabled", false);
               $('.btn-update-transaction').text('Submit');
               Toastify({
                  text: data.message,
                  className: "info",
                  style: {
                     "background": "linear-gradient(to right, #00b09b, #96c93d)",
                     "height": "60px",
                     "width": "350px",
                     "font-size": "20px"
                  }
               }).showToast();
               $('a.form-wizard-previous-btn').click();
            }
            load_transaction_data()
         },
         error: function (xhr) {
            alert("Error occured.please try again");
            $('.btn-update-transaction').prop("disabled", false);
            $('.btn-update-transaction').text('Submit');
         },
      })
   }
});


$(".numbers").keyup(function (e) { checkNumbersOnly($(this)); }); 

function checkNumbersOnly(myfield) { if (/[^\d\.]/g.test(myfield.val())) { myfield.val(myfield.val().replace(/[^\d\.]/g, '')); } }


$(document).on('change', 'select#update_type_of_activity_select', function (e) {
   $("#update_select_under_type option").remove();
   var id = $('#update_type_of_activity_select').find('option:selected').val();
   var text = $('#update_type_of_activity_select').find('option:selected').text().toString().toLowerCase();
   $('input[name=update_select_under_type_id]').val('');
   if (!id) {
      alert('Please Select Type Of Activity');
   } else {
      $.ajax({
         url: base_url + 'api/get_under_type_of_activity',
         data: {
            id: id
         },
         type: 'POST',
         dataType: 'json',
         beforeSend :  function(){

               JsLoadingOverlay.show({
                    'overlayBackgroundColor': '#666666',
                    'overlayOpacity': 0.6,
                    'spinnerIcon': 'ball-atom',
                    'spinnerColor': '#000',
                    'spinnerSize': '2x',
                    'overlayIDName': 'overlay',
                    'spinnerIDName': 'spinner',
                  });

         },
         error: err => {
            console.log(err);
            alert("An error occured");
         },
         success: function (result) {
            if (text == '<?php echo $training_text ?>') {
              
               $('#update_select_under_activity_modal').modal('show');
               var $dropdown = $("#update_select_under_type");
               $dropdown.append($("<option />").val('').text('Select Type'));
               $.each(result, function () {
                  $dropdown.append($("<option />").val(this.under_type_act_id).text(this.under_type_act_name));
               });
            }
             JsLoadingOverlay.hide();
         }
      })
   }
   if (text == '<?php echo $training_text ?>') {
      $('#update_under_type_activity_select').removeAttr('hidden').fadeIn("slow");
      $('.for_training').removeAttr('hidden').fadeIn("slow");
      $('.for_project_monitoring').attr('hidden', 'hidden');
   } else if (text == '<?php echo  $rgpm_text ?>') {
      $('#update_under_type_activity_select').attr('hidden', 'hidden');
      $('.for_training').attr('hidden', 'hidden');
      $('.for_project_monitoring').removeAttr('hidden').fadeIn("slow");
   } else {
      $('#update_under_type_activity_select').attr('hidden', 'hidden');
      $('.for_training').attr('hidden', 'hidden');
      $('.for_project_monitoring').attr('hidden', 'hidden');
   }
});

    
      </script>
   </body>
</html>