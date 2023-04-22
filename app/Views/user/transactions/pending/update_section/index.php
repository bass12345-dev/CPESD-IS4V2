<!doctype html>
<html class="no-js" lang="en">
   <head>
      <?php echo view('includes/meta.php') ?>
      <?php echo view('includes/css.php') ?> 

   </head>
   <body>
      <div class="page-container sbar_collapsed">
         <div class="main-content">

            <?php echo view('user/transactions/pending/update_section/includes/update_transactions_pending_topbar'); ?>
            <?php echo view('user/transactions/pending/update_section/includes/update_transactions_pending_breadcrumbs'); ?>
            <div class="main-content-inner">
                <div class="row">
                    <div class="col-12 mt-3">
                       <section class="wizard-section" style="background-color: #fff;">
                          <div class="row no-gutters">
                            <?php echo view('user/transactions/pending/update_section/sections/view_transaction'); ?>
                             <?php echo view('user/transactions/pending/update_section/sections/update_form'); ?>
                          </div>
                       </section>
                    </div>
                </div>
            </div>
         </div>
      <?php echo view('includes/scripts.php') ?> 
      <script>

    
      </script>
   </body>
</html>