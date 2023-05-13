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

                     <?php echo view('user/dashboard/sections/count_section'); ?>
                     <?php echo view('user/dashboard/sections/graph_section'); ?>
                     <?php echo view('includes/dashboard_section/user_list'); ?>


                </div>
        </div>
    </div>     
<?php echo view('includes/scripts.php') ?>   

<script type="text/javascript">
        
    var year = $('#user_year option:selected').val();function load_user_graph($this){load_user_chart($this.value)}function load_user_chart(year){ $.ajax({ url : base_url + 'api/load-user-chart-transaction-data', data:{year : year}, method : 'POST', dataType : 'json',beforeSend : function(){ $('.loader-alert').html('Fetching Data....'); }, success : function(data) { try{ $('.loader-alert').html(''); new Chart(document.getElementById("user-bar-chart"), { type: 'bar', data: { labels: data.label, datasets: [ { label               : 'Completed Transactions', backgroundColor    :  "rgb(5, 176, 133)", borderColor: 'rgb(23, 125, 255)', data                : data.data_completed }, { label               : 'Pending Transactions', backgroundColor    :  'rgb(216, 88, 79)', borderColor: 'rgb(23, 125, 255)', data                : data.data_pending } ] }, options: { legend: { position: 'top', labels: { padding: 10, fontColor: '#007bff', } }, responsive: true, title: { display: true, text: 'Transactions in year ' + year }, scales: { y: { beginAtZero: true } }, } }); }catch(error) { } },error: function (xhr, status, error) { }, }) }load_user_chart(year);


</script>
</body>
</html>
