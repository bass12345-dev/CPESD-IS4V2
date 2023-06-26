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
                                                <div class="col-md-12"> 
                                                   
                                                    <button  class="btn  mb-3 mt-2 sub-button pull-right mr-2" id="reload_admin_pending_rfa" > Reload <i class="ti-loop"></i></button>
                                                </div>
                                            </div>
                                    <div class="row">

                                         <?php echo view('admin/rfa/pending/sections/rfa_pending_transactions_table')  ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>   

<?php echo view('admin/rfa/pending/modals/refer_to_modal')  ?>  
<?php echo view('admin/rfa/pending/modals/view_action_to_be_taken')  ?>  
<?php echo view('includes/scripts.php') ?>  

<script src="<?php echo site_url() ?>assets/js/tinymce/js/tinymce/tinymce.js"></script>
<script type="text/javascript">
tinymce.init({ selector: 'textarea#action_taken', height: 500, plugins: ['advlist', 'autolink', 'lists', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media', 'table', 'help', 'wordcount'], toolbar: 'undo redo | blocks | ' + 'bold italic backcolor | alignleft aligncenter ' + 'alignright alignjustify | bullist numlist outdent indent | ' + 'removeformat | help', content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }' }); function load_admin_pending_rfa() { $('#rfa_pending_table').DataTable({ responsive: false, "ordering": false, "ajax": { "url": base_url + 'api/get-admin-pending-rfa', "type": "POST", "dataSrc": "", }, 'columns': [{ data: "ref_number", }, { data: "name", }, { data: "address", }, { data: "type_of_request_name", }, { data: "type_of_transaction", }, { data: "status1", }, { data: "encoded_by", }, { data: "action1", }, ] }); } load_admin_pending_rfa(); $(document).on('click', 'button#reload_admin_pending_rfa', function (e) { $('#rfa_pending_table').DataTable().destroy(); load_admin_pending_rfa(); count_total_rfa_pending(); }); $(document).on('click', 'a#refer_to', function (e) { $('input[name=rfa_id]').val($(this).data('id')); }); $('#update_refer_form').on('submit', function (e) { e.preventDefault(); var myContent = tinymce.get("action_taken").getContent(); var id = $('input[name=rfa_id]').val(); var refer_to = $('#refer_to_id :selected').val(); var name = $('#refer_to_id :selected').text(); Swal.fire({ title: "", text: "Refer to " + name, icon: "warning", showCancelButton: true, confirmButtonText: "Yes", cancelButtonText: "No, cancel!", reverseButtons: true }).then(function (result) { if (result.value) { $.ajax({ type: "POST", url: base_url + 'api/refer-to', data: { action_taken: myContent, rfa_id: id, reffered_to: refer_to }, dataType: 'json', beforeSend: function () { $('.btn-refer').text('Please wait...'); $('.btn-refer').attr('disabled', 'disabled'); }, success: function (data) { if (data.response) { $('.btn-refer').text('Submit'); $('.btn-refer').removeAttr('disabled'); $('#refer_to_modal').modal('hide'); Swal.fire("", data.message, "success"); $('#rfa_pending_table').DataTable().destroy(); load_admin_pending_rfa(); } else { Swal.fire("", data.message, "error"); $('.btn-refer').text('Submit'); $('.btn-refer').removeAttr('disabled'); } }, error: function (xhr) { alert("Error occured.please try again"); $('.btn-refer').text('Submit'); $('.btn-refer').removeAttr('disabled'); }, }); } }); }); $(document).on('click', 'a#view_action', function (e) { $.ajax({ type: "POST", url: base_url + 'api/view-action', data: { id: $(this).data('id') }, dataType: 'json', beforeSend: function () { $('div#action_to_be_taken').addClass('.loader'); }, success: function (data) { $("#view_action_to_be_taken_modal").modal('show'); $('div#action_to_be_taken').find('p').html(data.action_to_be_taken); } }) }); $(document).on('click', 'a#approved', function (e) { var id = $(this).data('id'); var name = $(this).data('name'); Swal.fire({ title: "", text: "Approved RFA Reference No. " + name, icon: "warning", showCancelButton: true, confirmButtonText: "Yes", cancelButtonText: "No, cancel!", reverseButtons: true }).then(function (result) { if (result.value) { $.ajax({ type: "POST", url: base_url + 'api/approved-rfa', data: { id: id }, cache: false, dataType: 'json', beforeSend: function () { Swal.fire({ title: "", text: "Please Wait", icon: "", showCancelButton: false, showConfirmButton: false, reverseButtons: false, allowOutsideClick: false }); }, success: function (data) { if (data.response) { Swal.fire("", "Success", "success"); $('#rfa_pending_table').DataTable().destroy(); load_admin_pending_rfa(); count_total_rfa_pending(); } else { Swal.fire("", data.message, "error"); } } }) } else if (result.dismiss === "cancel") { swal.close() } }); });




</script> 
</body>
</html>
