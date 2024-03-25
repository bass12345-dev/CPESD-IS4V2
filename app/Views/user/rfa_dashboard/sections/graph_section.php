<div class="row mt-2">
    <div class="col-lg-12 mt-sm-30 mt-xs-30">
        <div class="card">
            <div class="card-body">
                <div class="col-md-6 pull-left ">
                    <div class="loader-alert"></div>
                </div>
                <div class="col-md-6 pull-right ">
                    <select class="custom-select" id="user_year" onchange="load_user_graph(this)">
                        <?php for ($i = 2023; $i <= 2030; $i++) {

                            $selected = $i == date('Y') ? "selected" : "";

                            echo '<option ' . $selected . '>' . $i . '</option>';

                        } ?>
                    </select>
                </div>
                <canvas id="bar-chart" width="800" height="450"></canvas>
            </div>
        </div>
    </div>



</div>