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
                                  
                                        <?php echo view('global/clients/sections/clients_table'); ?> 
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>  
</div>   
<?php echo view('includes/scripts.php') ?>   
<?php echo view('global/clients/modals/update_client_modal'); ?>    
<script type="text/javascript">

var rfa_clients_table = $('#rfa_clients_table').DataTable({ responsive: false, "ajax" : { "url": base_url + 'api/get-clients', "type" : "POST", "dataSrc": "", }, 'columns': [ { data: "full_name" , }, { data: "address", }, { data: "contact_number", }, { data: "age", }, { data: "employment_status", }, { data: null, render: function (data, type, row) { return '<div class="btn-group dropleft">\ <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\ <i class="ti-settings" style="font-size : 15px;"></i>\ </button>\ <div class="dropdown-menu">\ <a  href="javascript:;" class="dropdown-item completed text-danger" id="delete-client" data-name="'+data['full_name']+'" data-id="'+data['rfa_client_id']+'"   ><i class="fa fa-trash"></i> Delete</a>\ <a  href="javascript:;" class="dropdown-item completed text-secondary" id="update-client" data-toggle="modal" data-target="#update_client_modal" data-name="'+data['full_name']+'" \ data-id="'+data['rfa_client_id']+'"  \ data-first-name="'+data['first_name']+'"  \ data-middle-name="'+data['middle_name']+'"  \ data-last-name="'+data['last_name']+'"  \ data-extension="'+data['extension']+'"  \ data-purok="'+data['purok']+'"  \ data-barangay="'+data['barangay']+'"  \ data-contact="'+data['contact_number']+'"  \ data-age="'+data['age']+'"  \ data-employment-status="'+data['employment_status']+'"  \ ><i class="fa fa-edit"></i> Update</a>\ </di>'; } }, ] });$(document).on('click','a#update-client',function (e) { $('input[name=client_id_]').val($(this).data('id')); $('input[name=update_first_name]').val($(this).data('first-name')); $('input[name=update_middle_name]').val($(this).data('middle-name')); $('input[name=update_last_name]').val($(this).data('last-name')); $('input[name=update_extension]').val($(this).data('extension')); $('input[name=update_purok]').val($(this).data('purok')); $('select[name=update_barangay]').val($(this).data('barangay')); $('input[name=update_contact_number]').val($(this).data('contact')); $('input[name=update_age]').val($(this).data('age')); $('select[name=update_employment_status]').val($(this).data('employment-status')); });$('#update_client_form').on('submit', function(e){ e.preventDefault(); $.ajax({ type: "POST", url: base_url + 'api/update-client', data: $(this).serialize(), cache: false, dataType: 'json', beforeSend: function() { $('.btn-update-client').text('Please wait...'); $('.btn-update-client').attr('disabled','disabled'); }, success: function(data) { if (data.response) { $('#update_client_modal').modal('hide'); $('.btn-update-client').text('Update'); $('.btn-update-client').removeAttr('disabled'); Toastify({ text: data.message, className: "info", style: { "background" : "linear-gradient(to right, #00b09b, #96c93d)", "height" : "60px", "width" : "350px", "font-size" : "20px" } }).showToast(); rfa_clients_table.ajax.reload(); }else { $('.btn-update-client').text('Save Changes'); $('.btn-update-client').removeAttr('disabled'); Toastify({ text: data.message, className: "info", style: { "background" : "linear-gradient(to right, #00b09b, #96c93d)", "height" : "60px", "width" : "350px", "font-size" : "20px" } }).showToast(); } }, error: function(xhr) { alert("Error occured.please try again"); } }) });$(document).on('click','a#delete-client',function (e) { var id = $(this).data('id'); var name = $(this).data('name'); Swal.fire({ title: "", text: "Delete " + name, icon: "warning", showCancelButton: true, confirmButtonText: "Yes", cancelButtonText: "No, cancel!", reverseButtons: true }).then(function(result) { if (result.value) { $.ajax({ type: "POST", url: base_url + 'api/delete-client', data: {id:id}, cache: false, dataType: 'json', beforeSend : function(){ Swal.fire({ title: "", text: "Please Wait", icon: "", showCancelButton: false, showConfirmButton : false, reverseButtons: false, allowOutsideClick : false }) }, success: function(data){ if (data.response) { Swal.fire( "", "Success", "success" ); rfa_clients_table.ajax.reload() }else { Swal.fire( "", data.message, "error" ); } } }) } else if (result.dismiss === "cancel") { swal.close() } }); });

    
</script>

</body>
</html>
