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
                                   <div class="col-md-6">
                                        <div class="input-group mb-3 ">
                                            <input type="text" class="form-control pull-right mt-2 mb-2" name="daterange_completed_filter" value="" style="height: 45px;" />
                                                <div class="input-group-append">
                                                    <div class="col-md-12">  <a href="javascript:;" id="reset" class="btn  mb-3 mt-2 sub-button pull-right" ><i class="ti-calendar"></i></a> 
                                                    </div>
                                                </div>
                                              
                                            </div>
                                    </div>
                <button class="btn sub-button btn-block mt-2 mb-2" style="width: 100%;" id="generate-rfa-report">Generate Report</button>


                            <div id="generate_rfa_report_section" hidden="true">
                                <div class="row mt-2">
                                    <div class="col-md-12"> 
                                        <button class="btn  mb-3 mt-2 btn-danger pull-right" id="close_rfa_report_section" ><i class="ti-close "></i></button>   
                                    </div>
                                </div>
                                <div class="row">
                                            <div class="col-12 mt-2">
                                                <table id="completed_transactions_table" class="text-center stripe ">
                                                   <thead class="bg-light text-capitalize" >
                                                       <tr>
                                                          <th>Reference Number</th>
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
<?php echo view('includes/scripts.php') ?>  

<script type="text/javascript">
    

    $(function() {

  $('input[name="daterange_completed_filter"]').daterangepicker({
            opens: 'right',
             ranges:{
            'Today' : [moment(), moment()],
            'Yesterday' : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days' : [moment().subtract(29, 'days'), moment()],
            'This Month' : [moment().startOf('month'), moment().endOf('month')],
            'Last Month' : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        format : 'YYYY-MM-DD'
          }, function(start, end, label) {
          
            // $('#pending_transactions_table').DataTable().destroy();
            // fetch_pending_transactions(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'),filter = true );
          });
        });



    $(document).on('click','button#generate-rfa-report',function (e) {

    var date_filter = $('input[name="daterange_completed_filter"]').val();
    $('#completed_transactions_table').DataTable().destroy();
    generate_rfa_report(date_filter);

});


    $(document).on('click','button#close_rfa_report_section',function (e) {

    $('#generate_rfa_report_section').attr("hidden",true);

})



 function   generate_rfa_report(date_filter){


     $.ajax({

            url: base_url + 'api/admin/generate-rfa-report',
            type: "POST",
            data: {
                date_filter,
               
            },
            dataType: "json",
            success: function(data) {

                $('#generate_rfa_report_section').removeAttr('hidden');

           



                $('#completed_transactions_table').DataTable({


                    
                    "ordering": false,
                     "paging": true,
                     search: true,
                     autoWidth: true,
                      
                        responsive: false,
                    "data": data,
                     "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                                        "<'row'<'col-sm-12'tr>>" +
                                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        buttons: [
                                  {
                                     extend: 'excel',
                                     text: 'Excel',
                                     className: 'btn btn-default ',
                                     footer: true,
                                     exportOptions: {
                                        columns: 'th:not(:last-child)'
                                     }
                                  },
                                   {
                                     extend: 'pdf',
                                     text: 'pdf',
                                     className: 'btn btn-default',
                                     footer: true,
                                     exportOptions: {
                                        columns: 'th:not(:last-child)'
                                     }
                                  },

                                {
                                     extend: 'print',
                                     text: 'print',
                                     className: 'btn btn-default',
                                     footer: true,
                                     exportOptions: {
                                        columns: 'th:not(:last-child)'
                                     }
                                  },    

                        ],


                         'columns': [
               

                 {
                data: null,
                render: function (data, type, row) {
                    return '<span href="javascript:;"    style="color: #000;" >'+data['ref_number']+'</span>';
                }

            },
             {
                data: null,
                render: function (data, type, row) {
                    return '<a href="javascript:;"       style="color: #000;"  >'+data['name']+'</a>';
                }

            },
              {
                data: null,
                render: function (data, type, row) {
                    return '<a href="javascript:;"       style="color: #000;"  >'+data['address']+'</a>';
                }

            },

            {
                data: null,
                render: function (data, type, row) {
                    return '<a href="javascript:;"       style="color: #000;"  >'+data['type_of_request_name']+'</a>';
                }

            },

            {
                data: null,
                render: function (data, type, row) {
                    return '<a href="javascript:;"       style="color: #000;"  >'+data['type_of_transaction']+'</a>';
                }

            },

           {
                // data: "song_title",
                data: null,
                render: function (data, type, row) {
                    return '<ul class="d-flex justify-content-center">\
                                <li><a href="javascript:;" data-id="'+data['rfa_id']+'"   id="view_rfa_"  class="text-secondary action-icon"><i class="ti-eye"></i></a></li>\
                                </ul>';
                }

            },

            ],




                  

       
            


                    })

                    
            }

    })

    }
</script> 
</body>
</html>
