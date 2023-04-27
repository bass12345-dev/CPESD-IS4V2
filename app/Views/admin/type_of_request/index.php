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
                                    <?php echo view('admin/type_of_request/sections/type_of_request_table'); ?> 
                                      <?php echo view('admin/type_of_request/sections/add_request'); ?> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  

<?php echo view('admin/type_of_request/modal/update_type_of_request_modal'); ?>     
<?php echo view('includes/scripts.php') ?>   
<script type="text/javascript">
    

     var request_table = $('#request_table').DataTable({


           "ajax" : {
                        "url": base_url + 'api/get-request',
                        "type" : "POST",
                        "dataSrc": "",
            },
             'columns': [
            {
                // data: "song_title",
                data: null,
                render: function (data, type, row) {
                    return '<span href="javascript:;"   data-id="'+data['type_of_request_id']+'"  style="color: #000;" class="table-font-size" >'+data['type_of_request_name']+'</span>';
                }

            },
            {
                // data: "song_title",
                data: null,
                render: function (data, type, row) {
                    return '<ul class="d-flex justify-content-center">\
                                <li class="mr-3 "><a href="javascript:;" class="text-secondary action-icon" data-id="'+data['type_of_request_id']+'" data-name="'+data['type_of_request_name']+'" data-toggle="modal" data-target="#update_type_of_request_modal" id="update-type-of-request"><i class="fa fa-edit"></i></a></li>\
                                <li><a href="javascript:;" data-name="'+data['type_of_request_name']+'" data-id="'+data['type_of_request_id']+'"  id="delete-type-of-request"  class="text-danger action-icon"><i class="ti-trash"></i></a></li>\
                                </ul>';
                }

            },
          ]

    });




       $(document).on('click','a#update-type-of-request',function (e) {

        $('input[name=type_of_request_id]').val($(this).data('id'))
        $('input[name=update_type_of_request]').val($(this).data('name'))
       })




$('#update_type_of_request_form').on('submit', function(e) {
    e.preventDefault();





    $.ajax({
            type: "POST",
            url: base_url + 'api/update-type-of-request',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('.btn-update-request').text('Please wait...');
                $('.btn-update-request').attr('disabled','disabled');
            },
            success: function(data)
            {            
                if (data.response) {
                   
                    $('.btn-update-request').text('Submit');
                    $('.btn-update-request').removeAttr('disabled');
                     $('#update_type_of_request_modal').modal('hide');

                     Swal.fire(
                                            "",
                                            data.message,
                                            "success"
                                        )
                            
                   
                    request_table.ajax.reload();
                }else {

                     Swal.fire(
                                            "",
                                             data.message,
                                             "error"
                                           
                                        )
                    $('.btn-update-request').text('Submit');
                   $('.btn-update-request').removeAttr('disabled');
                 
                }
           },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                $('.btn-update-request').text('Submit');
                 $('.btn-update-request').removeAttr('disabled');
            },
       });





})    





$('#add_type_of_request_form').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
            type: "POST",
            url: base_url + 'api/add-type-of-request',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('.btn-add-request').text('Please wait...');
                $('.btn-add-request').attr('disabled','disabled');
            },
             success: function(data)
            {            
                if (data.response) {
                    $('#add_type_of_request_form')[0].reset();
                    $('.btn-add-request').text('Submit');
                    $('.btn-add-request').removeAttr('disabled');
                    $('.alert').html(' <div class="alert-dismiss mt-2">\
                                                        <div class="alert alert-success alert-dismissible fade show" role="alert">\
                                                            <strong>'+data.message+'.\
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>\
                                                            </button>\
                                                            </div>\
                                                    </div>');
                    
                    setTimeout(function() { 
                        $('.alert').html('')
                    }, 3000);
                    request_table.ajax.reload();
                }else {
                    $('.btn-add-request').text('Submit');
                   $('.btn-add-request').removeAttr('disabled');
                     $('.alert').html(' <div class="alert-dismiss mt-2">\
                                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">\
                                                            <strong>'+data.message+'.\
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>\
                                                            </button>\
                                                            </div>\
                                                    </div>');
                }
           },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                $('.btn-add-request').text('Submit');
                 $('.btn-add-request').removeAttr('disabled');
            },


        });

    });




  $(document).on('click','a#delete-type-of-request',function (e) {

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
                            url: base_url + 'api/delete-request',
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

                                 

                                 request_table.ajax.reload()
                                 
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
