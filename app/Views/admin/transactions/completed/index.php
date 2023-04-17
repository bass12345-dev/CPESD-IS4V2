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
                                       <div class="input-group mb-3 col-md-5">
                                                <input type="text" class="form-control pull-right mt-2 mb-2" name="daterange" value="" style="height: 45px;" />
                                             
                                              <div class="input-group-append">
                                                <div class="col-md-12">  <a href="javascript:;" id="reset" class="btn  mb-3 mt-2 sub-button pull-right" >Reload <i class="ti-loop"></i></a> </div>
                                              </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <button class="btn sub-button btn-block">Generate Report</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
      <!--              
                  <div class="row">
                                         <div class="col-md-12"> 
                                            <button class="btn sub-button btn-block">Generate Report</button>
                                          
                                         </div>
                                      </div> -->
        </div>
    </div>     
<?php echo view('includes/scripts.php') ?>   
</body>
</html>
