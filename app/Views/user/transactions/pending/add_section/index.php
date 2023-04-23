<!doctype html>
<html class="no-js" lang="en">
   <head>
      <?php echo view('includes/meta.php') ?>
      <?php echo view('includes/css.php') ?> 

   </head>
   <body>
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
      <script>




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


function get_last_pmas_number(){

      $.ajax({
            url: base_url + 'api/get-last-pmas-number',
            type : 'POST',
            dataType : 'text',
            success: function(result) { 
               $('input[name=pmas_number]').val(parseInt(result) );
            }
         });
}
get_last_pmas_number();


$(document).on('change','select#type_of_activity_select',function (e) {
    $("#select_under_type option").remove();
    var id = $('#type_of_activity_select').find('option:selected').val();
    var text = $('#type_of_activity_select').find('option:selected').text().toString().toLowerCase();
    $('input[name=select_under_type_id]').val('');
    if(!id){
       alert('Please Select Type Of Activity');
    }else {
       

        $.ajax({
            // JSON FILE URL
            url: base_url + 'api/get_under_type_of_activity',
            data : {id : id},
            type : 'POST',
            // Type of Return Data
            dataType: 'json',
            // Error Function
            error: err => {
                console.log(err)
                alert("An error occured")
               
              
            },
            // Succes Function
            success: function(result) {

                if(text == '<?php echo $training_text ?>') {
                
                $('#select_under_activity_modal').modal('show');
                var $dropdown = $("#select_under_type");
                $dropdown.append($("<option />").val('').text('Select Type'));
                $.each(result, function() {
                    $dropdown.append($("<option />").val(this.under_type_act_id).text(this.under_type_act_name));
                });

            }
      
               
            }
        })
        
        
    }


    if(text == '<?php echo $training_text ?>') {
       
        $('#under_type_activity_select').removeAttr('hidden').fadeIn("slow");
        $('.for_training').removeAttr('hidden').fadeIn("slow");
        $('.for_project_monitoring').attr('hidden','hidden');
    }else if(text == '<?php echo  $rgpm_text ?>' ){
       
        $('#under_type_activity_select').attr('hidden','hidden');
        $('.for_training').attr('hidden','hidden');
        $('.for_project_monitoring').removeAttr('hidden').fadeIn("slow");
    }else {
      
        $('#under_type_activity_select').attr('hidden','hidden');
        $('.for_training').attr('hidden','hidden');
        $('.for_project_monitoring').attr('hidden','hidden');

    }

});





$('#select_under_activity_form').on('submit', function(e) {
    e.preventDefault();
   
    $('input[name=select_under_type_id]').val($('#select_under_type').find('option:selected').val());
    $('#select_under_activity_modal').modal('hide')
    
})

$(document).on('click', 'button.close-under-type', function () {


    var text = $('#type_of_activity_select').find('option:selected').text();
    var select_type = $('#select_under_type').find('option:selected').val();

   

    if(!select_type){
        alert('Please Select Type of' + text);
        
    }else {
        $('#select_under_activity_modal').modal('hide');
        $("#select_under_type option").remove();
    }

    // 
});


$('#add_transaction_form').on('submit', function(e) {
    e.preventDefault();
    if ( $('input[name=pmas_number]').val() == '' ) {

        alert('something');

    }else {

      

        $.ajax({
            type: "POST",
            url: base_url + 'api/add-transaction',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
               $('.btn-add-transaction').html('<div class="loader"></div>');
                $('.btn-add-transaction').prop("disabled", true);
            },
            success: function(data)
            {            
                if (data.response) {
                    $('#add_transaction_form')[0].reset();
                    $('.btn-add-transaction').prop("disabled", false);
                    $('.btn-add-transaction').text('Submit');
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

                      

                      $('a.form-wizard-previous-btn').click();
                     
                           
             
                }else {
                    $('.btn-add-transaction').prop("disabled", false);
                    $('.btn-add-transaction').text('Submit');
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

                       $('a.form-wizard-previous-btn').click();
                   
                }
                $('#new_transactions_table').DataTable().destroy();
                list_all_transactions();
                get_last_pmas_number();
           },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                 $('.btn-add-transaction').prop("disabled", false);
                 $('.btn-add-transaction').text('Submit');
            },

            })

    }


    
});

function list_all_transactions(){


    $.ajax({
            url: base_url + 'api/get-all-transactions',
            type: "POST",
            dataType: "json",
            success: function(data) {

                console.log(data);

                $('#new_transactions_table').DataTable({

                     scrollY: 500,
                    scrollX: true,
                    "ordering": false,
                    pageLength: 20,
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
                    return '<a href="javascript:;"   data-id="'+data['res_center_id']+'"  style="color: #000;"  >'+data['name']+'</a>';
                }

            },


                    ]

                })

            }


        })


}

list_all_transactions();

 $(document).on('click','a#reload_all_transactions',function (e) {

                $('#new_transactions_table').DataTable().destroy();
                get_last_pmas_number()
                list_all_transactions();
            
        });


      </script>
   </body>
</html>