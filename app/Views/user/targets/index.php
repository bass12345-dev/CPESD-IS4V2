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
                                  
                                    <?php echo view('user/targets/sections/filter'); ?>
                                 
                                
                            </div>
                        </div>
                    </div>
                </div>
                   
                        
                     
                </div>
        </div>
    </div>     
<?php echo view('includes/scripts.php') ?>   
<script type="text/javascript">
$(document).ready(function () {
   $('.js-example-basic-single').select2();
});
$(function () {
   $('input[name="daterange_completed_filter"]').daterangepicker({
      opens: 'right',
      ranges: {
         'Today': [moment(), moment()],
         'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
         'Last 7 Days': [moment().subtract(6, 'days'), moment()],
         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
         'This Month': [moment().startOf('month'), moment().endOf('month')],
         'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      format: 'YYYY-MM-DD'
   }, function (start, end, label) {});
});
</script>

</body>
</html>
