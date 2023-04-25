<!doctype html>
<html class="no-js" lang="en">
   <head>
      <?php echo view('includes/meta.php') ?>
      <?php echo view('includes/css.php') ?> 

   </head>
   <body>
      <div class="page-container sbar_collapsed">
         <div class="main-content">

            <?php echo view('user/request_for_assistance/includes/add_rfa_topbar'); ?>
           <?php echo view('user/request_for_assistance/includes/add_rfa_breadcrumbs'); ?>
            <div class="main-content-inner">
                <div class="row">
                    <div class="col-12 mt-3">
                       <section class="wizard-section" style="background-color: #fff;">
                          <div class="row no-gutters">
                              <?php echo view('user/request_for_assistance/sections/rfa_table'); ?>
                              <?php echo view('user/request_for_assistance/sections/add_rfa_form'); ?>
                          </div>
                       </section>
                    </div>
                </div>
            </div>
         </div>


<?php echo view('user/request_for_assistance/modal/search_name_modal'); ?>
<?php echo view('user/request_for_assistance/modal/add_client_modal'); ?>
<?php echo view('user/request_for_assistance/modal/view_client_information_modal'); ?>
<?php echo view('includes/scripts.php') ?> 

<script>

function list_all_rfa_transactions(){
 $('#request_table').DataTable({

        scrollY: 500,
        scrollX: true,
        "ordering": false,
        pageLength: 20,

        "ajax" : {
                        "url": base_url + 'api/get-all-rfa-transactions',
                        "type" : "POST",
                        "dataSrc": "",
        },
        
        'columns': [
                     {
                data: "ref_number",
                

            },
             {
                data: "rfa_date_filed",
               

            },
             {
                data: "name",
               
            },


                    ]
})

}

list_all_rfa_transactions()


$('#add_rfa_form').on('submit', function(e) {
    e.preventDefault();

 if ($('input[name=client_id]').val() == '') {

         alert('Error');

    }else{

      

        $.ajax({
            type: "POST",
            url: base_url + 'api/add-rfa',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
               $('.btn-add-rfa').html('<div class="loader"></div>');
                $('.btn-add-rfa').prop("disabled", true);
            },
            success: function(data)
            {            
                if (data.response) {
                    $('#add_rfa_form')[0].reset();
                    $('.btn-add-rfa').prop("disabled", false);
                    $('.btn-add-rfa').text('Submit');
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

                $('#request_table').DataTable().destroy();
               list_all_rfa_transactions()
                   
             
                }else {
                    $('.btn-add-rfa').prop("disabled", false);
                    $('.btn-add-rfa').text('Submit');
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
                
                get_last_reference_number();
           },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                 $('.btn-add-rfa').prop("disabled", false);
                 $('.btn-add-rfa').text('Submit');
            },

            })

    }


    
});






    function get_last_reference_number(){

      $.ajax({
            url: base_url + 'api/get-last-reference-number',
            type : 'POST',
            dataType : 'text',
            success: function(result) { 
               $('input[name=reference_number]').val(parseInt(result) );
            }
         });
}


get_last_reference_number();


      $('#add_client_form').on('submit', function(e) {
        e.preventDefault();

         $.ajax({
            type: "POST",
            url: base_url + 'api/add-client',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: 'json',
            beforeSend: function() {
                $('.btn-add-client').text('Please wait...');
                $('.btn-add-client').attr('disabled','disabled');
            },
             success: function(data)
            {            
                if (data.response) {
                    $('#add_client_modal').modal('hide')
                    $('#add_client_form')[0].reset();
                    $('.btn-add-client').text('Save Changes');
                    $('.btn-add-client').removeAttr('disabled');
                    
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
                    


                }else {
                    
                     $('.btn-add-client').text('Save Changes');
                    $('.btn-add-client').removeAttr('disabled');
                      
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
                $('.btn-add-client').text('Save Changes');
                $('.btn-add-client').removeAttr('disabled');
            },


        });

    });

$('input[name=name_of_client]').click(function(e) {
  e.preventDefault();
 $('#search_name_modal').modal('show')
})


 $(document).on('click','button#add_client',function (e) {

   $('#add_client_modal').modal('show');

 })

 $(document).on('click','button#search_client',function (e) {

      var first_name =   $('input[name=search_first_name]').val();
      var last_name  =  $('input[name=search_last_name]').val();
      $('#search_name_result_table').DataTable().destroy();

      if (first_name == '' && last_name == '' ) {

         alert('please input First Name or Last Name');

      }else {

      
      search_name_result(first_name,last_name)

         
      }


        
    });


function search_name_result(first_name,last_name){
        $.ajax({

            url: base_url + 'api/search-names',
            type: "POST",
            data: {
               first_name : first_name,
               last_name : last_name
            },
            dataType: "json",
            success: function(data) {

               $('#search_name_result').removeAttr('hidden');

               $('#search_name_result_table').DataTable({

                  "ordering": false,
                  search: true,
                  "data": data,

                  'columns': [
            {
             
                data: 'first_name',
                

            },
            {
             
                data: 'last_name',
                

            },
            {
             
                data: 'middle_name',
                

            },
            {
             
                data: 'extension',
                

            },
             {
                // data: "song_title",
                data: null,
                render: function (data, type, row) {
                    return '<ul class="d-flex justify-content-center">\
                                <li class="mr-3 "><a href="javascript:;" class="text-success action-icon" data-id="'+data['rfa_client_id']+'" \
                                data-name="'+data['first_name']+' '+data['middle_name']+' '+data['last_name']+' '+data['extension']+'"  \
                                 id="confirm-client"><i class="fa fa-check"></i></a></li>\
                                <li><a href="javascript:;" \
                                \
                                data-id="'+data['rfa_client_id']+'"  \
                                data-name="'+data['first_name']+' '+data['middle_name']+' '+data['last_name']+' '+data['extension']+'"  \
                                data-address="'+data['address']+'"  \
                                data-number="'+data['contact_number']+'"  \
                                data-age="'+data['age']+'"  \
                                data-status="'+data['employment_status']+'"  \
                                id="view-client-data"  class="text-secondary action-icon"><i class="ti-eye"></i></a></li>\
                                </ul>';
                }

            },
      

            ]



               })

            }

         })
}




$(document).on('click','a#confirm-client',function (e) {

     $('#search_name_modal').modal('hide');
    $('input[name=search_first_name]').val('');
    $('input[name=search_last_name]').val('');
     $('#search_name_result').attr("hidden",true);

      $('input[name=name_of_client]').val($(this).data('name'));
      $('input[name=client_id]').val($(this).data('id'));



})

$(document).on('click','a#view-client-data',function (e) {

    
    $('#view_client_information_modal').modal('show');
    $('.complete_name').text($(this).data('name'));
    $('.address').text($(this).data('address'));
    $('.contact_number').text($(this).data('number'));
    $('.age').text($(this).data('age'));
    $('.employment_status').text($(this).data('status'));


})

$(document).on('click','button#close_search_client',function (e) {

  
   $('#search_name_result').attr("hidden",true);

})




</script>
   </body>
</html>