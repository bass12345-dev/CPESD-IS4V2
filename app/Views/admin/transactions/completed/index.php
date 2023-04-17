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
                                      <div class="col-md-6">
                                        <select class="custom-select mt-2" style="height: 45px;" id="filter_type_of_activity">
                                            <option value="">Select Type Of Activity</option> 
                                                <?php  foreach ($activities as $row) : ?>
                                            <option value="<?php echo $row->type_of_activity_id  ?>"><?php echo $row->type_of_activity_name ?></option>
                                                <?php  endforeach; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="row">
                                        <button class="btn sub-button btn-block" id="generate-pmas-report">Generate Report</button>
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


$(document).on('click','button#generate-pmas-report',function (e) {

    var date_filter = $('input[name="daterange_completed_filter"]').val();
    var filter_type_of_activity = $('#filter_type_of_activity option:selected').val();

    generate_pmas_report(date_filter,filter_type_of_activity);

})

function generate_pmas_report(date_filter,filter_type_of_activity){



    $.ajax({

            url: base_url + 'api/admin/generate-pmas-report',
            type: "POST",
            data: {
                date_filter,
               filter_type_of_activity
            },
            dataType: "json",
            success: function(data) {


                    
            }

    })

    
}   
    
</script>
</body>
</html>
