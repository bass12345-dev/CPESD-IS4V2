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

<script type="text/javascript">
    
</script>

</body>
</html>
