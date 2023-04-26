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
                    <?php echo view('admin/cso/sections/cso_table'); ?> 
                    <?php echo view('admin/cso/sections/per_barangay_table'); ?> 
                </div>
        </div>
    </div> 
<?php echo view('admin/cso/modals/add_cso_modal'); ?>  
<?php echo view('admin/cso/modals/update_cso_status_modal'); ?>     
<?php echo view('includes/scripts.php') ?> 
<script type="text/javascript">

    var cso_status = $('#cso_status option:selected').val();
    var cso_type = $('#cso_type option:selected').val();

    $(document).on('click','button#reload_cso_filter',function (e) {
        $('#cso_table').DataTable().destroy();
        $("select").val('');
        get_cso();
    });


    function per_barangay(){



                $('#per_barangay_table').DataTable({


                         "ajax" : {
                        "url": base_url + 'api/count-cso-per-barangay',
                        "type" : "POST",
                        "dataSrc": "",
                        },

                     
                        scrollX: true,
                        "ordering": false,
                        "paging" :  false,
                        "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                                        "<'row'<'col-sm-12'tr>>" +
                                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        buttons: [
                                  {
                                     extend: 'excel',
                                     text: 'Excel',
                                     className: 'btn btn-default ',
                                     
                                  },
                                   {
                                     extend: 'pdf',
                                     text: 'pdf',
                                     className: 'btn btn-default',
                                     
                                  },

                                {
                                     extend: 'print',
                                     text: 'print',
                                     className: 'btn btn-default',
                                     
                                  },    

                        ],
                        
                        'columns': [

                                    {
                                           
                                        data: 'barangay',
                                        
                                    },
                                     
                                     {
                                           
                                        data: 'active',
                                        
                                    },
                                    {
                                           
                                        data: 'inactive',
                                        
                                    },
              
                        ]

                     })

    }

    per_barangay();

    function get_cso(cso_status = '', cso_type = ''){
            
     $.ajax({
            url: base_url + 'api/get-cso',
            type: "POST",
            data: {
                cso_status: cso_status,
                cso_type: cso_type,
            },
            dataType: "json",
            success: function(data) {


                $('#cso_table').DataTable({

                        scrollY: 600,
                        scrollX: true,
                        "ordering": false,
                        "data": data,
                        "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                                        "<'row'<'col-sm-12'tr>>" +
                                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        buttons: [
                                  {
                                     extend: 'excel',
                                     text: 'Excel',
                                     className: 'btn btn-default ',
                                     exportOptions: {
                                        columns: 'th:not(:last-child)'
                                     }
                                  },
                                   {
                                     extend: 'pdf',
                                     text: 'pdf',
                                     className: 'btn btn-default',
                                     exportOptions: {
                                        columns: 'th:not(:last-child)'
                                     }
                                  },

                                {
                                     extend: 'print',
                                     text: 'print',
                                     className: 'btn btn-default',
                                     exportOptions: {
                                        columns: 'th:not(:last-child)'
                                     }
                                  },    

                        ],
                        
                        'columns': [

                                    {
                                           
                                        data: null,
                                        render: function (data, type, row) {
                                                return '<b><a href="javascript:;"   data-id="'+data['cso_id']+'"  style="color: #000;"  >'+data['cso_code']+'</a></b>';
                                        }

                                    },
                                     {
                                           
                                        data: null,
                                        render: function (data, type, row) {
                                                return '<a href="javascript:;"   data-id="'+data['cso_id']+'"  style="color: #000;"  >'+data['cso_name']+'</a>';
                                        }

                                    },

                                     {
                                           
                                        data: null,
                                        render: function (data, type, row) {
                                                return '<a href="javascript:;"   data-id="'+data['cso_id']+'"  style="color: #000;"  >'+data['address']+'</a>';
                                        }

                                    },
                                     {
                                           
                                        data: null,
                                        render: function (data, type, row) {
                                                return '<a href="javascript:;"   data-id="'+data['cso_id']+'"  style="color: #000;"  >'+data['contact_person']+'</a>';
                                        }

                                    },

                                     {
                                           
                                        data: null,
                                        render: function (data, type, row) {
                                                return '<a href="javascript:;"   data-id="'+data['cso_id']+'"  style="color: #000;"  >'+data['contact_number']+'</a>';
                                        }

                                    },
                                     {
                                           
                                        data: null,
                                        render: function (data, type, row) {
                                                return '<a href="javascript:;"   data-id="'+data['cso_id']+'"  style="color: #000;"  >'+data['telephone_number']+'</a>';
                                        }

                                    },
                                     {
                                           
                                        data: null,
                                        render: function (data, type, row) {
                                                return '<a href="javascript:;"   data-id="'+data['cso_id']+'"  style="color: #000;"  >'+data['email_address']+'</a>';
                                        }

                                    },
                                    {
                                           
                                        data: null,
                                        render: function (data, type, row) {
                                                return '<a href="javascript:;"   data-id="'+data['cso_id']+'"  style="color: #000;"  >'+data['type_of_cso']+'</a>';
                                        }

                                    },
                                     {
                                           
                                        data: null,
                                        render: function (data, type, row) {
                                                return row.status;
                                        }

                                    },
                                     {
                                           
                                        data: null,
                                        render: function (data, type, row) {
                                                    return '<div class="btn-group dropleft">\
                                              <button type="button" class="btn btn-secondary dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\
                                               <i class="ti-settings" style="font-size : 15px;"></i>\
                                              </button>\
                                              <div class="dropdown-menu">\
                                                <a class="dropdown-item" href="javascript:;" data-id="'+data['cso_id']+'"  id="view-cso" > <i class="ti-eye"></i> View/Update Information</a>\
                                                <hr>\
                                                <a class="dropdown-item " href="javascript:;" data-id="'+data['cso_id']+'" data-status="'+data['cso_status']+'"    id="update-cso-status" ><i class="ti-pencil"></i> Update CSO Status</a>\
                                                  <hr>\
                                                <a class="dropdown-item text-danger" href="javascript:;" data-id="'+data['cso_id']+'" data-status="'+data['cso_status']+'" data-name="'+data['cso_name']+'"    id="delete-cso" ><i class="ti-trash"></i> Delete</a>\
                                              </di>';
                                        }

                                    },
                        ]

                     })


                }

            })        
        
    }



         $(document).on('click','a#delete-cso',function (e) {

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
                            url: base_url + 'api/delete-cso',
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

                                 
                                $('#cso_table').DataTable().destroy();
                                get_cso();
                                 
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


    function load_cso_by_type($this ){
        $('#cso_table').DataTable().destroy();
        get_cso($('#cso_status option:selected').val(),$this.value);
    }

    function load_cso_by_status($this){
         $('#cso_table').DataTable().destroy();
         get_cso($this.value,$('#cso_type option:selected').val());
    }


    get_cso();


   


    

    $(document).on('click','a#view-cso',function (e) {

        window.open( base_url + 'admin/cso/cso-information?id=' + $(this).data('id'),'_blank');

        })


    $(document).on('click','a#view-cso-officers',function (e) {

            window.open( base_url + 'admin/cso/view-officers?id=' + $(this).data('id'),'_blank');

      });



    
      $('#update_cso_status_form').on('submit', function(e) {
        e.preventDefault();

         $.ajax({
            type: "POST",
            url: base_url + 'api/update-cso-status',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: 'json',
            beforeSend: function() {
                $('.btn-update-cso-status').text('Please wait...');
                $('.btn-update-cso-status').attr('disabled','disabled');
            },
             success: function(data)
            {            
                if (data.response) {
                    $('#update_cso_status_modal').modal('hide')
                    $('.btn-update-cso-status').text('Save Changes');
                    $('.btn-update-cso-status').removeAttr('disabled');
                    
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
                    $('#cso_table').DataTable().destroy();
                    get_cso();

                }else {
                    
                     $('.btn-update-cso-status').text('Save Changes');
                    $('.btn-update-cso-status').removeAttr('disabled');
                      
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
                $('.btn-update-cso-status').text('Save Changes');
                $('.btn-update-cso-status').removeAttr('disabled');
            },


        });

    });
    

      


    $('#add_cso_form').on('submit', function(e) {
        e.preventDefault();

         $.ajax({
            type: "POST",
            url: base_url + 'api/add-cso',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: 'json',
            beforeSend: function() {
                $('.btn-add-cso').text('Please wait...');
                $('.btn-add-cso').attr('disabled','disabled');
            },
             success: function(data)
            {            
                if (data.response) {
                    $('#add_cso_form')[0].reset();
                    $('.btn-add-cso').text('Submit');
                    $('.btn-add-cso').removeAttr('disabled');
                    
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
                    $('#cso_table').DataTable().destroy();
                    get_cso();

                }else {
                    
                     $('.btn-add-cso').text('Submit');
                    $('.btn-add-cso').removeAttr('disabled');
                      
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
                $('.btn-add-cso').text('Submit');
                $('.btn-add-cso').removeAttr('disabled');
            },


        });

    });
</script>  
</body>
</html>
