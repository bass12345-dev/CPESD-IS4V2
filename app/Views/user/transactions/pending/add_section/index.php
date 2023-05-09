<!doctype html>
<html class="no-js" lang="en">
   <head>
      <?php echo view('includes/meta.php') ?>
      <?php echo view('includes/css.php') ?> 

      <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->


   </head>
   <body>
    <?php echo view('includes/preloader') ?> 
    
      <div class="page-container sbar_collapsed">
         <div class="main-content">

            <?php echo view('user/transactions/pending/add_section/sections/add_transactions_pending_topbar'); ?>
            <?php echo view('user/transactions/pending/add_section/sections/add_transactions_pending_breadcrumbs'); ?>
            <div class="main-content-inner">
                <div class="row">
                    <div class="col-12 mt-3">
                       <section class="wizard-section" style="background-color: #fff;">
                          <div class="row no-gutters">
                             <?php echo view('user/transactions/pending/add_section/sections/transactions_table'); ?>
                             <?php echo view('user/transactions/pending/add_section/sections/add_form'); ?>
                          </div>
                       </section>
                    </div>
                </div>
            </div>
         </div>
      <?php echo view('user/transactions/pending/add_section/modals/select_under_type_of_activity_modal') ?> 
      <?php echo view('includes/scripts.php') ?> 
      <script src="<?php echo base_url(); ?>assets/js/overly.js"></script>

      <script>


$(document).ready(function () {
   $('.js-example-basic-single').select2();
});
$('#date_and_time').datetimepicker({
   "allowInputToggle": true,
   "showClose": true,
   "showClear": true,
   "showTodayButton": true,
   "format": "YYYY/MM/DD hh:mm:ss A",
});
$('#id_1').datetimepicker({
   "allowInputToggle": true,
   "showClose": true,
   "showClear": true,
   "showTodayButton": true,
   "format": "YYYY/MM/DD hh:mm:ss A",
});
$('#id_2').datetimepicker({
   "allowInputToggle": true,
   "showClose": true,
   "showClear": true,
   "showTodayButton": true,
   "format": "YYYY/MM/DD hh:mm:ss A",
});

function get_last_pmas_number() {
   $.ajax({
      url: base_url + 'api/get-last-pmas-number',
      type: 'POST',
      dataType: 'text',
      success: function (result) {
         $('input[name=pmas_number]').val(result);
      }
   });
}
get_last_pmas_number();
$(document).on('change', 'select#type_of_activity_select', function (e) {
   $("#select_under_type option").remove();
   var id = $('#type_of_activity_select').find('option:selected').val();
   var text = $('#type_of_activity_select').find('option:selected').text().toString().toLowerCase();
   $('input[name=select_under_type_id]').val('');
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
               JsLoadingOverlay.hide();
               $('#select_under_activity_modal').modal('show');
               var $dropdown = $("#select_under_type");
               $dropdown.append($("<option />").val('').text('Select Type'));
               $.each(result, function () {
                  $dropdown.append($("<option />").val(this.under_type_act_id).text(this.under_type_act_name));
               });
            }
         }
      })
   }
   if (text == '<?php echo $training_text ?>') {
      $('#under_type_activity_select').removeAttr('hidden').fadeIn("slow");
      $('.for_training').removeAttr('hidden').fadeIn("slow");
      $('.for_project_monitoring').attr('hidden', 'hidden');
   } else if (text == '<?php echo  $rgpm_text ?>') {
      $('#under_type_activity_select').attr('hidden', 'hidden');
      $('.for_training').attr('hidden', 'hidden');
      $('.for_project_monitoring').removeAttr('hidden').fadeIn("slow");
   } else {
      $('#under_type_activity_select').attr('hidden', 'hidden');
      $('.for_training').attr('hidden', 'hidden');
      $('.for_project_monitoring').attr('hidden', 'hidden');
   }
});
$('#select_under_activity_form').on('submit', function (e) {
   e.preventDefault();
   $('input[name=select_under_type_id]').val($('#select_under_type').find('option:selected').val());
   $('#select_under_activity_modal').modal('hide')
});
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
$('#add_transaction_form').on('submit', function (e) {
   e.preventDefault();
   if ($('input[name=pmas_number]').val() == '') {
      alert('something');
   } else {
      Swal.fire({
         title: "",
         text: "Review first before submitting",
         icon: "warning",
         showCancelButton: true,
         confirmButtonText: "Yes",
         cancelButtonText: "No, cancel!",
         reverseButtons: true
      }).then(function (result) {
         if (result.value) {
            $.ajax({
               type: "POST",
               url: base_url + 'api/add-transaction',
               data: $('#add_transaction_form').serialize(),
               dataType: 'json',
               beforeSend: function () {
                  $('.btn-add-transaction').html('<div class="loader"></div>');
                  $('.btn-add-transaction').prop("disabled", true);
               },
               success: function (data) {
                  if (data.response) {
                     $('#add_transaction_form')[0].reset();
                     $('select[name=responsibility_center_id]').select2("val", '0');
                     $('select[name=cso_id]').select2("val", '0');
                     $('input[name=date_time]').val('');
                     $('.btn-add-transaction').prop("disabled", false);
                     $('.btn-add-transaction').text('Submit');
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
                     $('.btn-add-transaction').prop("disabled", false);
                     $('.btn-add-transaction').text('Submit');
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
                  $('#new_transactions_table').DataTable().destroy();
                  list_all_transactions();
                  get_last_pmas_number();
               },
               error: function (xhr) {
                  alert("Error occured.please try again");
                  $('.btn-add-transaction').prop("disabled", false);
                  $('.btn-add-transaction').text('Submit');
               },
            })
         } else if (result.dismiss === "cancel") {
            swal.close()
         }
      });
   }
});

function list_all_transactions() {
   $.ajax({
      url: base_url + 'api/get-all-transactions',
      type: "POST",
      dataType: "json",
      success: function (data) {
         console.log(data);
         $('#new_transactions_table').DataTable({
            scrollY: 500,
            scrollX: true,
            "ordering": false,
            pageLength: 20,
            "data": data,
            'columns': [{
               data: null,
               render: function (data, type, row) {
                  return '<b><a href="javascript:;"   data-id="' + data['res_center_id'] + '"  style="color: #000;"  >' + data['pmas_no'] + '</a></b>';
               }
            }, {
               data: null,
               render: function (data, type, row) {
                  return '<a href="javascript:;"   data-id="' + data['res_center_id'] + '"  style="color: #000;"  >' + data['date_and_time_filed'] + '</a>';
               }
            }, {
               data: null,
               render: function (data, type, row) {
                  return '<a href="javascript:;"   data-id="' + data['res_center_id'] + '"  style="color: #000;"  >' + data['name'] + '</a>';
               }
            }, ]
         })
      }
   })
}
list_all_transactions();
$(document).on('click', 'a#reload_all_transactions', function (e) {
   $('#new_transactions_table').DataTable().destroy();
   get_last_pmas_number();
   list_all_transactions();
});
$(".numbers").keyup(function (e) {
   checkNumbersOnly($(this));
});

function checkNumbersOnly(myfield) {
   if (/[^\d\.]/g.test(myfield.val())) {
      myfield.val(myfield.val().replace(/[^\d\.]/g, ''));
   }
}


      </script>
   </body>
</html>