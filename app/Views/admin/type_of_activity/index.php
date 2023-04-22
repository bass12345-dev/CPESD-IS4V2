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
                    <?php echo view('admin/type_of_activity/sections/type_of_activity_table'); ?> 
                </div>
        </div>
    </div> 
<?php echo view('admin/type_of_activity/modals/under_type_of_activity_modal_table'); ?>    
<?php echo view('admin/type_of_activity/modals/update_type_of_activity_modal'); ?> 
<?php echo view('admin/type_of_activity/modals/update_under_type_of_activity_modal'); ?>      
<?php echo view('includes/scripts.php') ?> 
<script type="text/javascript">


     var activity_table = $('#activity_table').DataTable({

            responsive: false,
            "ajax" : {
                        "url": base_url + 'api/get-activities',
                        "type" : "POST",
                        "dataSrc": "",
            },
             'columns': [
            {
                // data: "song_title",
                data: null,
                render: function (data, type, row) {
                    return '<a href="javascript:;"   data-id="'+data['type_of_activity_id']+'"  style="color: #000;"  >'+data['type_of_activity_name']+'</a>';
                }

            },
            {
                // data: "song_title",
                data: null,
                render: function (data, type, row) {
                    return row.action;
                }

            },
          ]
        });


       $(document).on('click','a#update-activity',function (e) {

        $('input[name=activity_id]').val($(this).data('id'))
        $('input[name=update_type_of_activity]').val($(this).data('name'))
       })


    $(document).on('click','a#delete-activity',function (e) {

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
                            url: base_url + 'api/delete-activity',
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
                                  activity_table.ajax.reload();
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

    $(document).on('click','a#add-under-activity',function (e) {

        $('#add_under_activity_modal').modal('show');
        $('input[id=act_id]').val($(this).data('id'));
        $('.type_of_training_title').text($(this).data('name'));
        $('.under_type_label').text($(this).data('name'));
        load_under_type_of_activity($(this).data('id'));
     });




  

    
      $('#add_activity_form').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
            type: "POST",
            url: base_url + 'api/add-type-of-activity',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('.btn-add-activity').text('Please wait...');
                $('.btn-add-activity').attr('disabled','disabled');
            },
            success: function(data)
            {            
                if (data.response) {
                    $('#add_activity_form')[0].reset();
                    $('.btn-add-activity').text('Submit');
                    $('.btn-add-activity').removeAttr('disabled');
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
                   
                    activity_table.ajax.reload();
                }else {
                    $('.btn-add-activity').text('Submit');
                   $('.btn-add-activity').removeAttr('disabled');
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
                $('.btn-add-activity').text('Submit');
                 $('.btn-add-activity').removeAttr('disabled');
            },
       });



    });



    $('#update_type_of_activity_form').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
            type: "POST",
            url: base_url + 'api/update-type-of-activity',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('.btn-update-activity').text('Please wait...');
                $('.btn-update-activity').attr('disabled','disabled');
            },
            success: function(data)
            {            
                if (data.response) {
                   
                    $('.btn-update-activity').text('Submit');
                    $('.btn-update-activity').removeAttr('disabled');
                     $('#update_type_of_activity_modal').modal('hide');

                     Swal.fire(
                                            "",
                                            data.message,
                                            "success"
                                        )
                            
                   
                    activity_table.ajax.reload();
                }else {

                     Swal.fire(
                                            "",
                                             data.message,
                                             "error"
                                           
                                        )
                    $('.btn-update-activity').text('Submit');
                   $('.btn-update-activity').removeAttr('disabled');
                 
                }
           },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                $('.btn-update-activity').text('Submit');
                 $('.btn-update-activity').removeAttr('disabled');
            },
       });



    });



      $('#add_under_activity_form').on('submit', function(e) {
    e.preventDefault();
    var id = $('input[id=act_id]').val();

             $.ajax({
            type: "POST",
            url: base_url + 'api/add-under-type-of-activity',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('.btn-add-under-activity').text('Please wait...');
                $('.btn-add-under-activity').attr('disabled','disabled');
            },
            success : function(data)
            {

                $('#add_under_activity_form')[0].reset();
                $('.btn-add-under-activity').text('Submit');
                $('.btn-add-under-activity').removeAttr('disabled');
               var alert =  $('.alert-add-under-activity').html(' <div class="alert-dismiss mt-2">\
                                                        <div class="alert alert-success alert-dismissible fade show" role="alert">\
                                                            <strong>'+data.message+'.\
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>\
                                                            </button>\
                                                            </div>\
                                                    </div>');
                

        
                setTimeout(function() { 
                        $('.alert-add-under-activity').html('')
                    }, 3000);
                   
                   load_under_type_of_activity(id)
                

            },
             error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                $('.btn-add-under-activity').text('Submit');
                $('.btn-add-under-activity').removeAttr('disabled');
            },

        })

    })



    function load_under_type_of_activity(id){
          
         
        var table = $('#under_type_activity_table')
        table.find('tbody').html('')
        var tr1 = $('<tr>')
        tr1.html('<th class="py-1 px-2 text-center">Please Wait</th>')
        table.find('tbody').append(tr1)
         setTimeout(() => {

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
            success: function(resp) {
                tr1.html('')
                    table.find('tbody').append(tr1)
                if (resp.length > 0) {
                    // If returned json data is not empty
                    var i = 1;
                    // looping the returned data
                    Object.keys(resp).map(k => {
                        // creating new table row element
                        var tr = $('<tr>')
                         
                            // second column data
                        tr.append('<td class="py-1 px-2">' + resp[k].under_type_act_name + '</td>')
                            // third column data
                        tr.append('<td class="py-1 px-2"><ul class="d-flex justify-content-center">\
                                <li class="mr-3 "><a href="javascript:;" class="text-secondary action-icon" data-idd= "'+resp[k].typ_ac_id+'"  data-id="'+resp[k].under_type_act_id+'" data-name="'+resp[k].under_type_act_name+'"  id="update-under-type-activity" data-toggle="modal" data-target="#update_under_type_of_activity_modal" ><i class="fa fa-edit"></i></a></li>\
                                 <li><a href="javascript:;" data-id="'+resp[k].under_type_act_id+'" data-name="'+resp[k].under_type_act_name+'" data-idd= "'+resp[k].typ_ac_id+'"  id="delete-under-activity"  class="text-danger action-icon"><i class="ti-trash"></i></a></li>\
                                </ul></td>')
                         

                        // Append table row item to table body
                        table.find('tbody').append(tr)
                    })
                } else {
                    // If returned json data is empty
                    var tr = $('<tr>')
                    tr.append('<th class="py-1 px-2 text-center">No data to display</th>')
                    table.find('tbody').append(tr)
                }
              
            }
        })
                
 
             }, 500)
         
     }


        $(document).on('click','a#update-under-type-activity',function (e) {

        $('input[name=under_activity_id]').val($(this).data('id'))
         $('input[name=activ_id]').val($(this).data('idd'))
        $('input[name=under_update_type_of_activity]').val($(this).data('name'))
       });




    $('#update_under_type_of_activity_form').on('submit', function(e) {
    e.preventDefault();

    const id = $('input[name=activ_id]').val();

    $.ajax({
            type: "POST",
            url: base_url + 'api/update-under-type-of-activity',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('.btn-update-under-activity').text('Please wait...');
                $('.btn-update-under-activity').attr('disabled','disabled');
            },
            success: function(data)
            {            
                if (data.response) {
                   
                    $('.btn-update-under-activity').text('Submit');
                    $('.btn-update-under-activity').removeAttr('disabled');
                     $('#update_under_type_of_activity_modal').modal('hide');

                     Swal.fire(
                                            "",
                                            data.message,
                                            "success"
                                        )
                            
                   
                   load_under_type_of_activity(id);
                }else {

                     Swal.fire(
                                            "",
                                             data.message,
                                             "error"
                                           
                                        )
                    $('.btn-update-under-activity').text('Submit');
                   $('.btn-update-under-activity').removeAttr('disabled');
                 
                }
           },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                $('.btn-update-under-activity').text('Submit');
                 $('.btn-update-under-activity').removeAttr('disabled');
            },
       });



    });



    $(document).on('click','a#delete-under-activity',function (e) {

        var id = $(this).data('id');   
        var name = $(this).data('name');
        var idd = $(this).data('idd');

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
                            url: base_url + 'api/delete-under-activity',
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

                                  load_under_type_of_activity(idd)
                                 
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
