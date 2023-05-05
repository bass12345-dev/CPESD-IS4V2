<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php echo view('includes/meta.php') ?>
    <?php echo view('includes/css.php') ?> 
</head>

<body>
   
 <?php echo view('includes/preloader') ?> 
    <div class="page-container">       
    <?php echo view('includes/sidebar.php') ?> 
        <div class="main-content">           
            <?php echo view('includes/topbar.php') ?>           
            <?php echo view('includes/breadcrumbs.php') ?> 
                <div class="main-content-inner">
                   
                         <?php echo view('user/rfa_dashboard/sections/rfa_count_section'); ?>
                          <?php echo view('user/rfa_dashboard/sections/graph_section'); ?>
                     
                </div>
        </div>
    </div>     
<?php echo view('includes/scripts.php') ?>   
<script type="text/javascript">
        var year = $('#user_year option:selected').val();    
    function load_user_graph($this){load_user_rfa_chart($this.value)}



       function load_user_rfa_chart(year){

      $.ajax({
                url : base_url + 'api/load-user-chart-rfa-transaction-data',
                data:{year : year},
                method : 'POST',
                dataType : 'json',
                success : function(data)
                {

                     try{
                                 new Chart(document.getElementById("bar-chart"), {
                                    type: 'bar',
                                    data: {
                                      labels: data.label,
                                      datasets: [
                                        {
                                            label               : 'Completed Transactions',
                                            backgroundColor    :  "rgb(5, 176, 133)",
                                             borderColor: 'rgb(23, 125, 255)',
                                            data                : data.data_completed
                                        },
                                        {
                                            label               : 'Pending Transactions',
                                             backgroundColor    :  'rgb(216, 88, 79)',
                                             borderColor: 'rgb(23, 125, 255)',
                                            data                : data.data_pending
                                        }
                                      ]
                                    },
                                    options: {

                                     legend: {
                                                position: 'top',
                                                labels: {
                                                    padding: 10,
                                                    fontColor: '#007bff',
                                                }
                                            },
                                            

                                     responsive: true,
                                      title: {
                                        display: true,
                                        text: 'Transactions in year ' + year
                                      },

                                      scales: {
                                            y: {
                                                
                                                    beginAtZero: true
                                                
                                            }
                                        },
                                                  
                                    }
                                });
                    }catch(error) {

                    }
                },error: function (xhr, status, error) {
                // error here...
            },

            })
    
}

load_user_rfa_chart(year)

</script>
</body>
</html>
