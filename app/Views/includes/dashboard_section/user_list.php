<div class="row">


   <?php if (session()->get('user_type') == 'admin') {
      // code...
    ?>
   <div class="col-lg-7 mt-sm-30 mt-xs-30">
        <div class="card" >
            <div class="card-body">
                <div class="col-md-12 mt-2 mb-2">
                     <h2>New Transactions</h2>
                </div>
                 <div class="data-tables">
                    <table id="pending_transactions_table_limit" style="width:100%" class="text-center stripe">
                       <thead class="bg-light text-capitalize" >
                           <tr>
                               <th>PMAS NO</th>
                               <th>Date & Time Filed</th>
                               <th>Type of Activity</th>
                               <th>CSO</th>
                               <th>Person Responsible</th>
                               
                           </tr>
                       </thead>                                      
                   </table>   
                </div>     
            </div>
        </div>
    </div>

 <?php } ?>
   <div class="col-xl-<?php echo session()->get('user_type') == 'admin' ? '5' : '12' ?> col-lg-5 col-md-12 ">
      <div class="card">
         <div class="card-body">
            <div class="d-sm-flex flex-wrap justify-content-between mb-4 align-items-center">
               <h4 class="header-title mb-0">CPESD Members</h4>
            </div>
            <div class="member-box" id="user_list">

         <?php  foreach ($users_list as $row) {
            // code...
          ?>
          <div class="s-member">
                  <div class="media align-items-center">
                     <!-- <img src="" class="d-block ui-w-30 rounded-circle" alt=""> -->
                     <div class="media-body ml-5">
                        <p><?php echo $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension ?></p>
                        <span><?php echo $row->user_type ?></span>
                     </div>
                     <div class="tm-social">
                        <a href="javascript:;" id="view_user" data-id="<?php echo $row->user_id ?>"><i class="fa fa-eye"></i></a>
                        
                     </div>
                  </div>
               </div> 

            <?php }  ?> 

            </div>
         </div>
      </div>
   </div>
</div>