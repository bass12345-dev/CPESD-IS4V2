<div class="row mt-2">
    <div class="col-lg-12 mt-sm-30 mt-xs-30">
        <div class="card">
            <div class="card-body">
                    <div class="col-md-6 pull-right "   >
                        <select class="custom-select" id="admin_year" onchange="load_graph(this)"  >
                            <option selected >2023</option>
                            <option>2024</option>
                            <option>2025</option>
                        </select>
                    </div>
                <canvas id="admin-bar-chart" height="100">></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-12 mt-sm-30 mt-xs-30">
        <div class="card" >
            <div class="card-body">
                <div class="col-md-12 mt-2 mb-2">
                     <h2>New RFA Transactions</h2>
                </div>
                 <div class="data-tables">
                    <table id="pending_transactions_table_limit" style="width:100%" class="text-center stripe">
                       <thead class="bg-light text-capitalize" >
                           <tr>
                              <th>Reference Number</th>
                              <th>Name of Client</th>
                              <th>Complete Address</th>
                              <th>Type of Request</th>
                              <th>Type of Transaction</th>
                              
                              <th>Created By</th>
                               
                           </tr>
                       </thead>                                      
                   </table>   
                </div>     
            </div>
        </div>
    </div>
</div>