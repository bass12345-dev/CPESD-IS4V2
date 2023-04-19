<div class="row mt-2">
    <div class="col-lg-6 mt-sm-30 mt-xs-30">
        <div class="card">
            <div class="card-body">
                    <div class="col-md-6 pull-right "   >
                        <select class="custom-select" id="admin_year" onchange="load_graph(this)"  >
                            <option selected >2023</option>
                            <option>2024</option>
                            <option>2025</option>
                        </select>
                    </div>
                <canvas id="admin-bar-chart" width="800" height="800"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mt-sm-30 mt-xs-30">
        <div class="card" style="height: 557px;">
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
   
</div>

