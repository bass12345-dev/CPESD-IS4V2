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


   jQuery(document).ready(function() {
    // click on next button
    jQuery('.form-wizard-next-btn').click(function() {
        var parentFieldset = jQuery(this).parents('.wizard-fieldset');
        var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
        var next = jQuery(this);
        var nextWizardStep = true;
        parentFieldset.find('.wizard-required').each(function(){
            var thisValue = jQuery(this).val();

            console.log(thisValue)

            if( thisValue == "") {
                jQuery(this).siblings(".wizard-form-error").slideDown();
                nextWizardStep = false;
            }
            else {
                jQuery(this).siblings(".wizard-form-error").slideUp();
            }
        });
        if( nextWizardStep) {
            next.parents('.wizard-fieldset').removeClass("show","400");
            currentActiveStep.removeClass('active').addClass('activated').next().addClass('active',"400");
            next.parents('.wizard-fieldset').next('.wizard-fieldset').addClass("show","400");


           


            jQuery(document).find('.wizard-fieldset').each(function(){
                if(jQuery(this).hasClass('show')){
                    var formAtrr = jQuery(this).attr('data-tab-content');
                    jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function(){
                        if(jQuery(this).attr('data-attr') == formAtrr){
                            jQuery(this).addClass('active');
                            var innerWidth = jQuery(this).innerWidth();
                            var position = jQuery(this).position();
                            jQuery(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});





                        }else{
                            jQuery(this).removeClass('active');
                        }
                    });
                }
            });
        }
    });
    //click on previous button
    jQuery('.form-wizard-previous-btn').click(function() {
        var counter = parseInt(jQuery(".wizard-counter").text());;
        var prev =jQuery(this);
        var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
        prev.parents('.wizard-fieldset').removeClass("show","400");
        prev.parents('.wizard-fieldset').prev('.wizard-fieldset').addClass("show","400");
        currentActiveStep.removeClass('active').prev().removeClass('activated').addClass('active',"400");
        jQuery(document).find('.wizard-fieldset').each(function(){
            if(jQuery(this).hasClass('show')){
                var formAtrr = jQuery(this).attr('data-tab-content');
                jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function(){
                    if(jQuery(this).attr('data-attr') == formAtrr){
                        jQuery(this).addClass('active');
                        var innerWidth = jQuery(this).innerWidth();
                        var position = jQuery(this).position();
                        jQuery(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});
                    }else{
                        jQuery(this).removeClass('active');
                    }
                });
            }
        });
    });
    //click on form submit button
    jQuery(document).on("click",".form-wizard .form-wizard-submit" , function(){
        var parentFieldset = jQuery(this).parents('.wizard-fieldset');
        var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
        parentFieldset.find('.wizard-required').each(function() {
            var thisValue = jQuery(this).val();
            if( thisValue == "" ) {
                jQuery(this).siblings(".wizard-form-error").slideDown();
            }
            else {
                jQuery(this).siblings(".wizard-form-error").slideUp();
            }
        });
    });
    // focus on input field check empty or not
    jQuery(".form-control").on('focus', function(){
        var tmpThis = jQuery(this).val();
        if(tmpThis == '' ) {
            jQuery(this).parent().addClass("focus-input");
        }
        else if(tmpThis !='' ){
            jQuery(this).parent().addClass("focus-input");
        }
    }).on('blur', function(){
        var tmpThis = jQuery(this).val();
        if(tmpThis == '' ) {
            jQuery(this).parent().removeClass("focus-input");
            jQuery(this).siblings('.wizard-form-error').slideDown("3000");
        }
        else if(tmpThis !='' ){
            jQuery(this).parent().addClass("focus-input");
            jQuery(this).siblings('.wizard-form-error').slideUp("3000");
        }
    });
});

</script>
   </body>
</html>