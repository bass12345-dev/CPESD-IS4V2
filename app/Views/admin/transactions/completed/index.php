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
                                    <div class="col-md-6">
                                       <div class="input-group mb-3 ">
                                                <input type="text" class="form-control pull-right mt-2 mb-2" name="daterange_completed_filter" value="" style="height: 45px;" />
                                             
                                              <div class="input-group-append">
                                                <div class="col-md-12">  <a href="javascript:;" id="reset" class="btn  mb-3 mt-2 sub-button pull-right" ><i class="ti-calendar"></i></a> </div>
                                              </div>
                                        </div>
                                      </div>
                                      <div class="col-md-5">
                                        <select class="custom-select mt-2 mb-2" style="height: 45px;" id="filter_type_of_activity">
                                            <option value="">Select Type Of Activity</option> 
                                                <?php  foreach ($activities as $row) : ?>
                                            <option value="<?php echo $row->type_of_activity_id  ?>"><?php echo $row->type_of_activity_name ?></option>
                                                <?php  endforeach; ?>
                                        </select>
                                      </div>
                                       <div class="col-md-1">
                                             <button class="btn sub-button btn-block mt-2 mb-2" style="height: 45px;" id="reset-filter-options"><i class="ti-reload"></i></button>
                                      </div>
                                    </div>

                                    <div id="select_cso_section" hidden>
                                        <select class="custom-select mt-2 mb-2 pull-right" style="height: 45px;" id="select_cso">
                                            <option value="">Select CSO</option> 
                                                <?php  foreach ($cso as $row) : ?>
                                            <option value="<?php echo $row->cso_id  ?>"><?php echo $row->cso_name ?></option>
                                                <?php  endforeach; ?>
                                        </select>
                                    </div>
                                    
                                  
                                        <button class="btn sub-button btn-block mt-2 mb-2" style="width: 100%;" id="generate-pmas-report">Generate Report</button>
                                   
                                    <div id="generate_pmas_report_section" hidden="true">
                                        <div class="row mt-2">

                                            <div class="col-md-12"> 
                                                <button class="btn  mb-3 mt-2 btn-danger pull-right" id="close_pmas_report_section" ><i class="ti-close "></i></button>   
                                               
                                             </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mt-2">
                                                <table id="completed_transactions_table" class="text-center stripe ">
                                                   <thead class="bg-light text-capitalize" >
                                                       <tr>
                                                           <th>PMAS NO</th>
                                                           <th>Date & Time Filed</th>
                                                           <th>Type of Activity</th>
                                                           <th>CSO</th>
                                                           <th>Person Responsible</th>
                                                            <th>Action</th>
                                                       </tr>
                                                   </thead> 

                                                   <!--  <tfoot>
                                                        <tr>
                                                            
                                                            <th></th>
                                                           <th>Date & Time Filed</th>
                                                           <th>Type of Activity</th>
                                                           <th>CSO</th>
                                                           <th>Person Responsible</th>
                                                        </tr>
                                                    </tfoot>               -->                       
                                               </table>   
                                            </div>
                                            <div id="total_section" hidden>
                                            <div class="col-12"><h5>Total Volume of Business : <span class="all_total_volume_of_business"></span></h5> </div>
                                            <div class="col-12"><h5>Total Cash Position :   <span class="all_total_cash_position"></span></h5></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>   
<?php echo view('admin/transactions/completed/modals/view_project_monitoring_data_modal') ?>       
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


$(document).on('click','button#generate-pmas-report',function (e) {

    var date_filter = $('input[name="daterange_completed_filter"]').val();
    var filter_type_of_activity = $('#filter_type_of_activity option:selected').val();
    var cso = $('#select_cso option:selected').val();
    $('#completed_transactions_table').DataTable().destroy();
    generate_pmas_report(date_filter,filter_type_of_activity,cso);


   if (cso != '') {
     // load_total(date_filter,filter_type_of_activity,cso);
   }else {

   }
   

})

$(document).on('click','button#close_pmas_report_section',function (e) {

    $('#generate_pmas_report_section').attr("hidden",true);

})


$(document).on('click','button#reset-filter-options',function (e) {


    $('select[id=filter_type_of_activity]').val('');
    $('input[name=daterange_completed_filter]').val(moment().format("MM/DD/YYYY")+' - '+moment().format("MM/DD/YYYY"));


});


$(document).on('change','select#filter_type_of_activity',function (e) {

   var text = $('#filter_type_of_activity').find('option:selected').text().toString().toLowerCase();

   if(text == '<?php echo  $rgpm_text ?>' ){
       
       $('#select_cso_section').removeAttr('hidden');
       $('#total_section').removeAttr('hidden');
       

    }else {
         $('#total_section').attr('hidden','hidden');
        $('#select_cso_section').attr('hidden','hidden');
    }

})






$(document).on('click','a#view_project_monitoring',function (e) {

    const id = $(this).data('id');
    const title = $(this).data('title');
    $.ajax({
            type: "POST",
            url: base_url + 'api/get-project-transaction-data',
            data: {id : id},
            dataType: 'json',
            success: function(data)
            {  

                $("#view_project_monitoring_modal").modal('show');
                $('.cso_title').text(title);
                $('.project_title').html(data.project_title);
                $('.delinquent').text('₱ ' +data.delinquent)
                $('.overdue').text('₱ ' +data.overdue)
                $('.total_production').text('₱ ' +data.total_production)
                $('.total_collection_sales').text('₱ ' +data.total_collection_sales)
                $('.total_released_purchases').text('₱ ' +data.total_released_purchases)
                $('.total_delinquent_account').text('₱ ' +data.total_delinquent_account)
                $('.total_over_due_account').text('₱ ' +data.total_over_due_account)
                $('.cash_in_bank').text('₱ ' +data.cash_in_bank)
                $('.cash_on_hand').text('₱ ' +data.cash_on_hand)
                $('.inventories').text('₱ ' +data.inventories)
                // $('.total_project_data').text('₱ ' +data.total);

                $('.total_volume_of_business_').text('₱ ' +data.total_volume_of_business)
                $('.total_cash_position_').text('₱ ' +data.total_cash_position)

            }

        })

    



})



function load_total(date_filter,filter_type_of_activity,cso){



        $.ajax({

            url: base_url + 'api/admin/get_total_report',
            type: "POST",
            data: {
                date_filter,
                filter_type_of_activity,
                cso
            },
            dataType: "json",
            success: function(data) {


            }


        })

}



function generate_pmas_report(date_filter,filter_type_of_activity,cso){



    $.ajax({

            url: base_url + 'api/admin/generate-pmas-report',
            type: "POST",
            data: {
                date_filter,
               filter_type_of_activity,
               cso
            },
            dataType: "json",
            success: function(data) {

                $('#generate_pmas_report_section').removeAttr('hidden');

            var total_volume_of_business = 0;
            var total_cash_position = 0;

            for (var i = 0; i < data.length; i++) {
                
                total_volume_of_business = total_volume_of_business + parseInt(data[i].total_volume_of_business)
                
            }

            $('.all_total_volume_of_business').text(total_volume_of_business);


            for (var i = 0; i < data.length; i++) {
                
                total_cash_position = total_cash_position + parseInt(data[i].total_cash_position)
                
            }


            $('.all_total_cash_position').text(total_cash_position);


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
                                     // exportOptions: {
                                     //    columns: 'th:not(:last-child)'
                                     // }
                                  },
                                   {
                                     extend: 'pdf',
                                     text: 'pdf',
                                     className: 'btn btn-default',
                                     // exportOptions: {
                                     //    columns: 'th:not(:last-child)'
                                     // }
                                  },

                                {
                                     extend: 'print',
                                     text: 'print',
                                     className: 'btn btn-default',
                                     // exportOptions: {
                                     //    columns: 'th:not(:last-child)'
                                     // }
                                  },    

                        ],


                         'columns': [
            {
             
                data: 'pmas_no',
                

            },
             {
                data: 'date_and_time_filed',
               

            },

             {
                data: "type_of_activity_name",
                
               
            },


             {

                data: 'cso_name',
               
            },

              {
              
                data: 'name',
                

            },

            {
              
                data: 'name',
                

            },

            ],


        //     initComplete: function () {
        //     this.api()
        //         .columns()
        //         .every(function () {
        //             var column = this;
        //             var select = $('<select class="custom-select"><option value="" ></option></select>')
        //                 .appendTo($(column.footer()).empty())
        //                 .on('change', function () {
        //                     var val = $.fn.dataTable.util.escapeRegex($(this).val());
 
        //                     column.search(val ? '^' + val + '$' : '', true, false).draw();
        //                 });
 
        //             column
        //                 .data()
        //                 .unique()
        //                 .sort()
        //                 .each(function (d, j) {
        //                     select.append('<option value="' + d + '">' + d + '</option>');
        //                 });
        //         });
        // },

       // "footerCallback": function (row, data, start, end, display) {
       //              var api = this.api(), data;

       //              // Remove the formatting to get integer data for summation
       //              var intVal = function (i) {
       //                  return typeof i === 'string' ?
       //                          i.replace(/[\$,]/g, '') * 1 :
       //                          typeof i === 'number' ?
       //                          i : 0;
       //              };
       //              // Total over this page
       //              pageTotal = api
       //                      .column(3, {page: 'current'})
       //                      .data()
       //                      .reduce(function (a, b) {
       //                          return intVal(a) + intVal(b);
       //                      }, 0);

       //              // Update footer
       //              $(api.column(3).footer()).html('$' + pageTotal);
       //          }




       
            


                    })

                    
            }

    })

    
}   
    
</script>
</body>
</html>
