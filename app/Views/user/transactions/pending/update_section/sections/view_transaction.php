<div class="col-md-6 ">
   <div class="data-tables">
      <table class="tablesaw table-bordered table-hover table" >
         <tr>
            <td colspan = "2">
               <a  href    = "javascript:;" class = "mt-2  mb-2 btn sub-button text-center  btn-rounded btn-md btn-block"><i class = "fa fa-user" aria-hidden = "true"></i>PMAS Information</a>
           
            </td>
         </tr>
         <tr>
            <td class="t_title">PMAS Number</td>
            <td class="cso_name"><?php echo date('Y', strtotime($transaction_data->date_and_time_filed)).' - '.date('m', strtotime($transaction_data->date_and_time_filed)).' - '.$transaction_data->number ?><td>
         </tr>
         <tr>
            <td class="t_title">Date & Time Filed</td>
            <td class="cso_address"><?php echo date('F d Y', strtotime($transaction_data->date_and_time_filed)).' '.date('h:i a', strtotime($transaction_data->date_and_time_filed)) ?></td>
         </tr>
         <tr>
            <td class="t_title">Responsible Section</td>
            <td class="contact_person"><?php echo $transaction_data->responsible_section_name ?></td>
         </tr>
         <tr>
            <td class="t_title">Type of Activity</td>
            <td class="contact_number"><?php echo $transaction_data->type_of_activity_name ?></td>
         </tr>
         <tr>
            <td class="t_title">Responsibility Center</td>
            <td class="email"><?php echo $transaction_data->responsibility_center_name ?></td>
         </tr>
         <tr>
            <td class="t_title">Date & Time</td>
            <td class="email"><?php echo date('F d Y', strtotime($transaction_data->date_and_time)) ?></td>
         </tr>


         <?php
               if ($transaction_data->is_training == 1) {

                  $db = \Config\Database::connect();
                  $builder = $db->table('trainings');
                  $builder->where(array('training_transact_id' => $transaction_data->transaction_id));
                  $query = $builder->get()->getResult()[0];
               ?>
    
         <tr class="training_section">
            <td colspan = "2">
               <a  href    = "javascript:;" class = "mt-2  mb-2 btn sub-button text-center  btn-rounded btn-md btn-block">About Training</a>
            </td>
         </tr>
         <tr>
            <td class="t_title">Title of Training</td>
            <td class="cso_name"><?php echo $query->title_of_training ?></td>
         </tr>
         <tr>
            <td class="t_title">Number of Participants</td>
            <td class="cso_address"><?php echo $query->number_of_participants ?></td>
         </tr>
         <tr >
            <td class="t_title">Female</td>
            <td class="contact_person"><?php echo $query->female ?></td>
         </tr>
         <tr>
            <td class="t_title">Male</td>
            <td class="contact_number"><?php echo $query->number_of_participants - $query->female ?></td>
         </tr>
         <tr >
            <td class="t_title">Over All Ratings</td>
            <td class="email"><?php echo $query->overall_ratings ?></td>
         </tr>
         <tr>
            <td class="t_title">Name of Trainor</td>
            <td class="email"><?php echo $query->name_of_trainor ?></td>
         </tr>

      <?php  } ?> 

      <?php
               if ($transaction_data->is_project_monitoring == 1) {


                  $db = \Config\Database::connect();
                  $builder = $db->table('project_monitoring');
                  $builder->where(array('project_transact_id' => $transaction_data->transaction_id));
                  $query = $builder->get()->getResult()[0];

               ?>
        
         <tr class="training_section">
            <td colspan = "2">
               <a  href    = "javascript:;" class = "mt-2  mb-2 btn sub-button text-center  btn-rounded btn-md btn-block">Project Monitoring</a>
            </td>
         </tr>
         <tr>
            <td>Project Title</td>
            <td class="cso_name"><?php echo $query->project_title ?></td>
         </tr>
         <tr>
            <td>Period (Mo - Year)/as of</td>
            <td class="cso_address"><?php echo date('F d Y', strtotime($query->period )) ?></td>
         </tr>
         <tr class="training_section">
            <td colspan = "2">
               <h5  class = "  text-center">Attendance</h5>
            </td>
         </tr>
         <tr>
            <td>Present</td>
            <td class="contact_person"><?php echo $query->attendance_present  ?></td>
         </tr>
         <tr>
            <td>Absent</td>
            <td class="contact_person"><?php echo $query->attendance_absent  ?></td>
         </tr>
         <tr class="training_section">
            <td colspan = "2">
               <h5  class = "  text-center">Nom - Borrowers</h5>
            </td>
         </tr>
         <tr>
            <td>Delinquent</td>
            <td class="contact_person"><?php echo $query->nom_borrowers_delinquent  ?></td>
         </tr>
         <tr>
            <td>Overdue</td>
            <td class="contact_person"><?php echo $query->nom_borrowers_overdue  ?></td>
         </tr>
         <tr>
            <td>Total Production</td>
            <td class="contact_person"><?php echo $query->total_production  ?></td>
         </tr>
         <tr>
            <td>Total Collection/Sales</td>
            <td class="contact_person">&#8369;  <?php echo $query->total_collection_sales  ?></td>
         </tr>
         <tr>
            <td>Total Released/Purchases</td>
            <td class="contact_person"> &#8369; <?php echo $query->total_released_purchases  ?></td>
         </tr>
         <tr>
            <td>Total Delinquent Account</td>
            <td class="contact_person"> &#8369; <?php echo $query->total_delinquent_account  ?></td>
         </tr>
         <tr>
            <td>Total Over-due Account</td>
            <td class="contact_person">&#8369; <?php echo $query->total_over_due_account  ?></td>
         </tr>
         <tr>
            <td>Cash in bank</td>
            <td class="contact_person"> &#8369; <?php echo $query->cash_in_bank  ?></td>
         </tr>
         <tr>
            <td>Cash on hand</td>
            <td class="contact_person"> &#8369; <?php echo   $query->cash_on_hand  ?></td>
         </tr>
         <tr>
            <td>Inventories(Store)</td>
            <td class="contact_person"><?php echo $query->inventories  ?></td>
         </tr>
         <tr>
            <td><b>Total Volume of Business</b></td>
            <td style="font-weight: bold;"> &#8369; <?php echo $query->total_collection_sales + $query->total_released_purchases  ?></td>
         </tr>
         <tr>
            <td><b>Total Cash Position</b></td>
            <td style="font-weight: bold;"> &#8369; <?php echo $query->cash_in_bank + $query->cash_on_hand + $query->inventories  ?></td>
         </tr>

      <?php }  ?>
         
      </table>
   </div>
</div>