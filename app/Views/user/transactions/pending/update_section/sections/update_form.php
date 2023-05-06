<div class="col-lg-6 col-md-6">
	<div class="form-wizard">
		<form id="update_transaction_form">
			<fieldset class="wizard-fieldset show">
				<h5>Update Information</h5>
				<div class="form-group">
					<label>PMAS NO</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<input type="text" name="update_year" class="form-control" value="" readonly> </div>
						<div class="input-group-prepend">
							<input type="text" name="update_month" class="form-control" value="" readonly> </div>
						<input type="number" class="form-control  wizard-required input "  name="update_pmas_number" readonly>


							<input type="hidden"  name="transaction_id">
						 </div>

					<div class="wizard-form-error"></div>
				</div>
				<div class="form-group clearfix">
					<button type="button" class="form-wizard-next-btn float-right" id="first-next">Next</button>
				</div>
			</fieldset>
			<fieldset class="wizard-fieldset">
				<h5>Information</h5>
				<div class="form-group">
					
					<div class="form-group">
					<div class="col-12">Responsible Section</div>
						<select class="custom-select input wizard-required" name="update_responsible_section_id">
						<option value="">Select Responsible Section</option> 
						<?php 

								foreach ($responsible as $row) : ?>

								<option value="<?php echo $row->responsible_section_id  ?>"><?php echo $row->responsible_section_name ?></option>

								<?php endforeach;?>
                        </select>
					</div>
					<div class="wizard-form-error"></div>
				</div>
				<div class="form-group">
					
					<div class="form-group">
					<div class="col-12">Type of Activity</div>
						<input type="hidden" name="update_select_under_type_id" >
						<select class="custom-select input wizard-required " id="update_type_of_activity_select"  name="update_type_of_activity_id" required> 
						<option value="">Select Type Of Activity</option> 
						<?php 

								foreach ($activities as $row) :
									

								?>

								<option value="<?php echo $row->type_of_activity_id  ?>"><?php echo $row->type_of_activity_name ?></option>

								<?php 

								endforeach;
								?>
                        </select>
					</div>
					<div class="wizard-form-error"></div>
				</div>
				
				<div class="form-group">
					
					<div class="form-group">
					<div class="col-12">Responsibility Center</div>
						<select class="custom-select js-example-basic-single input responsibility wizard-required" name="update_responsibility_center_id" style="width: 100%;" required>
						<option value="">Select Responsibility Center</option> 
						<?php 

							foreach ($responsibility_centers as $row) :
							?>
							<option value="<?php echo $row->responsibility_center_id ?>"><?php echo $row->responsibility_center_code ?> - <?php echo $row->responsibility_center_name ?></option>
							<?php 

							endforeach;
							?>       
                        </select>
					</div>
					<div class="wizard-form-error"></div>
				</div>
				<div class="form-group">
					
					<div class="form-group">
					<div class="col-12">Select CSO</div>
						<select class="custom-select input cso wizard-required js-example-basic-single " name="update_cso_id" style="width: 100%;"> 
						<option value="">Select CSO</option> 
						<?php 

							foreach ($cso as $row) :
							?>
							<option value="<?php echo $row->cso_id ?>"><?php echo $row->cso_code.' - '.$row->cso_name ?></option>
							<?php 

							endforeach;
							?>       
						</select>
					</div>
					<div class="wizard-form-error"></div>
				</div>
				<div class="form-group">
					<div class="col-12">Date And Time</div>
					<div class="input-group date" id="update_date_and_time">
						<input type="text" value="05/16/2018 12:31:00 AM" class="form-control input" name="update_date_and_time" onkeypress="return false;" required />
						<div class="input-group-addon input-group-append">
							<div class="input-group-text"> <i class="glyphicon glyphicon-calendar fa fa-calendar"></i> </div>
						</div>
					</div>
					<div class="wizard-form-error"></div>
				</div>
				    <?php echo view('user/transactions/pending/update_section/sections/update_for_training'); ?>
					<?php echo view('user/transactions/pending/update_section/sections/update_for_project_monitoring'); ?>
						<div class="form-group clearfix">
							<button type="submit" class="form-wizard-submit float-right btn-update-transaction"> Submit</button> <a href="javascript:;" class="form-wizard-previous-btn float-left">Previous</a> 
                        </div>
        </fieldset>
		</form>
		</div>
	</div>