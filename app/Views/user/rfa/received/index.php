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
                    <div class="row">
                        <div class="col-12 mt-5">
                            <div class="card " style="border: 1px solid;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <div class="row">
                                                <div class="col-md-12"> 
                                                   
                                                    <button  class="btn  mb-3 mt-2 sub-button pull-right mr-2" id="reload_user_pending_transaction" > Reload <i class="ti-loop"></i></button>
                                                </div>
                                            </div>
                                            <div class="data-tables">
                                                <table id="rfa_received_table" style="width:100%" class="text-center">
                                                    <thead class="bg-light text-capitalize">
                                                       <tr>
                                                       
                                                          <th>Name of Client</th>
                                                          <th>Complete Address</th>
                                                          <th>Type of Request</th>
                                                          <th>Type of Transaction</th>
                                                           <th>Action</th>
                                                       </tr>
                                                    </thead>
                                                 </table>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>     

<?php echo view('user/rfa/received/modals/action_taken_modal') ?>  
<?php echo view('includes/scripts.php') ?>  
 <script src="https://cdn.tiny.cloud/1/ds0fhm6q5wk0i2dye0vxwap3wi77umvl550koo9laumyhtg1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.tiny.cloud/1/ds0fhm6q5wk0i2dye0vxwap3wi77umvl550koo9laumyhtg1/tinymce/5/jquery.tinymce.min.js" referrerpolicy="origin"></script>
<script>


 $('textarea#action_taken_textarea').tinymce({
        height: 500,
        menubar: false,
        plugins: [
          'advlist autolink lists link image charmap print preview anchor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help'
      });


     var rfa_pending_table = $('#rfa_received_table').DataTable({

            responsive: false,
            "ajax" : {
                        "url": base_url + 'api/get-user-received-rfa',
                        "type" : "POST",
                        "dataSrc": "",
            },
             'columns': [
            {
                data: "name",
                

            },
              {
                data: "address",
               
            },
              {
                data: "type_of_request_name",
               

            },
              {
                data: "type_of_transaction",
               

            },
            {
                // data: "song_title",
                data: null,
                render: function (data, type, row) {
                    return '<ul class="d-flex justify-content-center">\
                                <li><a href="javascript:;" data-id="'+data['tracking_code']+'" data-type="'+data['type_of_transaction']+'"  id="received-rfa"  class="text-secondary action-icon mr-2"><i class="fa fa-share"></i></a></li>\
                                <li><a href="javascript:;" data-id="'+data['type_of_activity_id']+'"  id="delete-activity"  class="text-danger action-icon"><i class="ti-trash"></i></a></li>\
                                </ul>';
                }

            },
          ]
        });

      

$(document).on('click','a#received-rfa',function (e) {

    $('input[name=transaction_type]').val($(this).data('type'));
     $('input[name=rfa_id]').val($(this).data('id'));
    if ($(this).data('type').toLowerCase() != 'simple') {
        $('.select_user').removeAttr('hidden');
    }else {
         $('.select_user').attr('hidden','hidden');
    }
    $('#add_action_taken_modal').modal('show');

        
})




$('#add_action_taken_form').on('submit', function(e) {
    e.preventDefault();


        var myContent = tinymce.get("action_taken_textarea").getContent();
        var tracking_code = $('input[name=rfa_id]').val();
        var type = $('input[name=transaction_type]').val();



            $.ajax({
            type: "POST",
            url: base_url + 'api/add-rfa-action-taken',
            data: {

                content : myContent,
                tracking_code : tracking_code,
                type : type
            },
     
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('.btn-update-cso-status').text('Please wait...');
                $('.btn-update-cso-status').attr('disabled','disabled');
            },
             success: function(data)
            {            
                if (data.response) {
                    $('#add_action_taken_modal').modal('hide')
                    $('.btn-add-rfa-action-taken').text('Save Changes');
                    $('.btn-add-rfa-action-taken').removeAttr('disabled');
                    
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
                    // $('#cso_table').DataTable().destroy();
                    // get_cso();

                }else {
                    
                     $('.btn-add-rfa-action-taken').text('Save Changes');
                    $('.btn-add-rfa-action-taken').removeAttr('disabled');
                      
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
                $('.btn-add-rfa-action-taken').text('Save Changes');
                $('.btn-add-rfa-action-taken').removeAttr('disabled');
            },


        });



    });


</script> 
</body>
</html>
