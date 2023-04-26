<div class="page-title-area">
               <div class="row align-items-center">
                  <div class="col-sm-6">
                     <div class="breadcrumbs-area clearfix">
                        <h4 class="page-title pull-left"><?php echo $title ?></h4>
                        <ul class="breadcrumbs pull-left">
                             <li><a href="<?php echo session()->get('user_type') == 'admin'  ? base_url().'admin/dashboard' : base_url().'user/dashboard' ?> ">Home</a></li>
                           <li><a href="">View Transaction</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>