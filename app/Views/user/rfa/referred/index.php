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
                              <div class="card" style="border: 1px solid;">
                                 <div class="card-body">
                                    <div class="row">
                                                <div class="col-md-12"> 
                                                   
                                                    <button  class="btn  mb-3 mt-2 sub-button pull-right mr-2" id="reload_user_reffered_rfa" > Reload <i class="ti-loop"></i></button>
                                                </div>
                                            </div>
                                    <div class="row">
                                       <?php echo view('user/rfa/referred/sections/rfa_reffered_table'); ?>       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>     
<?php echo view('user/rfa/referred/modals/accomplished_modal')  ?> 
<?php echo view('user/rfa/referred/modals/view_action_taken_modal')  ?> 
<?php echo view('includes/scripts.php') ?>   
<script src="https://cdn.tiny.cloud/1/ds0fhm6q5wk0i2dye0vxwap3wi77umvl550koo9laumyhtg1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.tiny.cloud/1/ds0fhm6q5wk0i2dye0vxwap3wi77umvl550koo9laumyhtg1/tinymce/5/jquery.tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">


 $('textarea#action_to_be_taken').tinymce({
        height: 500,
        menubar: false,
        plugins: [
          'advlist autolink lists link image charmap print preview anchor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help'
      });

    $(document).on('click','button#reload_user_reffered_rfa',function (e) {

        $('#rfa_reffered_table').DataTable().destroy();
        load_user_reffered_rfa();
        count_total_reffered_rfa();
        count_total_rfa_pending()
})

    function load_user_reffered_rfa() {
    $('#rfa_reffered_table').DataTable({

            responsive: false,
            "ordering": false,
            "ajax" : {
                        "url": base_url + 'api/get-user-reffered-rfa',
                        "type" : "POST",
                        "dataSrc": "",
            },
             'columns': [

                 {
                data: "ref_number",
                

            },
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
                data: "status1",
               

            },
              {
                data: "action1",
               

            },
             
           
          ]
        });

}

load_user_reffered_rfa()





      $(document).on('click','a#accomplished',function (e) {

              
             $('input[name=rfa_id]').val($(this).data('id'));
               
      });





      $(document).on('click','a#view_action_taken_admin',function (e) {

              

               $.ajax({
                    type: "POST",
                    url: base_url + 'api/view-action-taken',
                    data: {id : $(this).data('id')},
                    dataType: 'json',
                    beforeSend: function() {
                         
                           $('div#action_taken').addClass('.loader');
                    },
                    success: function(data)
                    {           


                        $('#view_action_taken_modal').modal('show');
                        $('div#action_taken').find('p').html(data.action_taken);
                        

                    }
            })


            
               
      });




 $('#action_to_be_taken_form').on('submit', function(e) {
    e.preventDefault();



    var myContent = tinymce.get("action_to_be_taken").getContent();
    var id = $('input[name=rfa_id]').val();


    if (myContent == '') {

        alert('Please Fill up Action To Be Taken')
    }else {

    $.ajax({
            type: "POST",
            url: base_url + 'api/accomplish-rfa',
            data: {action_to_be_taken : myContent,rfa_id : id},
            dataType: 'json',
            beforeSend: function() {
                $('.btn-refer').text('Please wait...');
                $('.btn-refer').attr('disabled','disabled');
            },
            success: function(data)
            {            
                if (data.response) {
                   
                    $('.btn-refer').text('Submit');
                    $('.btn-refer').removeAttr('disabled');
                     $('#accomplished_modal').modal('hide');

                     Swal.fire(
                                            "",
                                            data.message,
                                            "success"
                                        )
                            
                     $('#rfa_reffered_table').DataTable().destroy();
                    load_user_reffered_rfa()
                }else {

                     Swal.fire(
                                            "",
                                             data.message,
                                             "error"
                                           
                                        )
                    $('.btn-refer').text('Submit');
                   $('.btn-refer').removeAttr('disabled');
                 
                }
           },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                $('.btn-refer').text('Submit');
                 $('.btn-refer').removeAttr('disabled');
            },
       });


}


    });

                       
                   

</script>
</body>
</html>
