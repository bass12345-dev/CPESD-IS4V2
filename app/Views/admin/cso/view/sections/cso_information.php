<div class="row">
	<div class="col-md-12">
		<table class="tablesaw table-bordered table-hover table" data-tablesaw-mode="swipe" data-tablesaw-sortable data-tablesaw-sortable-switch data-tablesaw-minimap data-tablesaw-mode-switch id="_table">
			<tr>
				<td colspan="2"> <a href="javascript:;" class="mt-2  mb-2 btn sub-button text-center  btn-rounded btn-md btn-block"><i class = "fa fa-user" aria-hidden = "true"></i> CSO Information</a> 
				<a href="javascript:;" id="update-cso-information" class="mt-2  mb-2  text-center  btn-rounded btn-md btn-block" data-toggle="modal" data-target="#update_cso_information_modal"><i class = "fa fa-edit" aria-hidden = "true" ></i> Update CSO Information</a> </td>
			</tr>
			<tr>
				<td>CSO Code</td>
				<td class="cso_code"></td>
			</tr>
			<tr>
				<td>CSO</td>
				<td class="cso_name"></td>
			</tr>
			<tr>
				<td>Address</td>
				<td class="cso_address"></td>
			</tr>
			<tr>
				<td>Contact Person</td>
				<td class="contact_person"></td>
			</tr>
			<tr>
				<td>Contact Number</td>
				<td class="contact_number"></td>
			</tr>
			<tr>
				<td>Telephone Number</td>
				<td class="telephone_number"></td>
			</tr>
			<tr>
				<td>Email Address</td>
				<td class="email"></td>
			</tr>
			<tr>
				<td>CSO Classification</td>
				<td class="classification"></td>
			</tr>
			<tr>
				<td>CSO Status</td>
				<td class="cso_status"> </td>
			</tr>
			<tr>
				<td>COR</td>
				<td>
					<a href="javascript:;" class="view-pdf" id="view_cor" data-type="cor">View COR </a> 
					<a href="javascript:;" class="btn btn-rounded btn-secondary pull-right" data-toggle="modal" data-target="#update_cor_modal">Update COR</a>

				</td>
			</tr>
			<tr>
				<td>Bylaws</td>
				<td>
					<a href="javascript:;" class="view-pdf" id="view_bylaws" data-type="bylaws">View Bylaws</a> <a href="javascript:;" class="btn btn-rounded btn-secondary pull-right" data-toggle="modal" data-target="#update_bylaws_modal">Update Bylaws</a>
				</td>
			</tr>
			<tr>
				<td>Article</td>
				<td>
					<a href="javascript:; " class="view-pdf" id="view_aoc" data-type="articles">View AOC/AOI </a> 
					<a href="javascript:;" class="btn btn-rounded btn-secondary pull-right" id="update_article" data-toggle="modal" data-target="#update_aoc_modal" >Update AOC/AOI </a>
				</td>
			</tr>
		<!-- 	<tr>
				<td>Other Docs</td>
				<td><a href="javascript:; " class="view-pdf" id="view_article" data-type="articles">View Docs</a> <a href="javascript:;" class="btn btn-rounded btn-secondary pull-right" id="update_article">Update Article</a></td>
			</tr> -->
		</table>
	</div>
	<!-- <div class="col-md-6 tree-content">
        <div class="col-md-12"><h1>PDF Viewer</h1></div>
		<div id="canvas_container">
			<div id="pdf_alert"></div>
			<canvas id="pdf_renderer" style="width: 100%;"></canvas>
		</div>
	</div> -->
</div>


<div class="row">
    <div class="col-md-12">
        <div class="data-tables">
            <button class="btn sub-button pull-right mb-3 " data-toggle="modal" data-target="#add_project_modal">Add Project</button>
                <table id="project_table" style="width:100%" class="text-center mb-3">
                    <thead class="bg-light text-capitalize" style="width:100%"  >
                        <tr>
                            <th>Title Of Project</th>  
                            <th>Amount</th> 
                            <th>Year</th>                                                     
                            <th>Funding Agency</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table> 
        </div>
    </div>
</div>