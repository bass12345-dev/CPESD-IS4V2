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
                   <?php echo view('admin/rfa_dashboard/sections/rfa_count_section'); ?>
                     <?php echo view('admin/rfa_dashboard/sections/rfa_graph_section'); ?>
                </div>
        </div>
    </div>     
<?php echo view('includes/scripts.php') ?> 
<script type="text/javascript">
var year = $('#admin_year option:selected').val(); function load_graph($this) { load_admin_chart($this.value) } function load_admin_chart(year) { $.ajax({ url: base_url + 'api/load-admin-chart-rfa-transaction-data', data: { year: year }, method: 'POST', dataType: 'json', beforeSend : function(){ $('.loader-alert').html('Fetching Data....'); }, success: function (data) { try { $('.loader-alert').html(''); new Chart(document.getElementById("admin-bar-chart"), { type: 'bar', data: { labels: data.label, datasets: [{ label: 'Completed Transactions', backgroundColor: "rgb(5, 176, 133)", borderColor: 'rgb(23, 125, 255)', data: data.data_completed }, { label: 'Pending Transactions', backgroundColor: 'rgb(216, 88, 79)', borderColor: 'rgb(23, 125, 255)', data: data.data_pending }] }, options: { legend: { position: 'top', labels: { padding: 10, fontColor: '#007bff', } }, responsive: true, title: { display: true, text: 'Transactions in year ' + year }, scales: { y: { beginAtZero: true } }, } }); } catch (error) {} }, error: function (xhr, status, error) {}, }) } $('#pending_transactions_table_limit').DataTable({ "ordering": false, responsive: false, "pageLength": 3, "ajax": { "url": base_url + 'api/get-pending-rfa-transaction-limit', "type": "POST", "dataSrc": "", }, 'columns': [{ data: null, render: function (data, type, row) { return '<span href="javascript:;"    style="color: #000;" >' + data['ref_number'] + '</span>'; } }, { data: null, render: function (data, type, row) { return '<a href="javascript:;"       style="color: #000;"  >' + data['name'] + '</a>'; } }, { data: null, render: function (data, type, row) { return '<a href="javascript:;"       style="color: #000;"  >' + data['address'] + '</a>'; } }, { data: null, render: function (data, type, row) { return '<a href="javascript:;"       style="color: #000;"  >' + data['type_of_request_name'] + '</a>'; } }, { data: null, render: function (data, type, row) { return '<a href="javascript:;"       style="color: #000;"  >' + data['type_of_transaction'] + '</a>'; } }, { data: null, render: function (data, type, row) { return '<a href="javascript:;"       style="color: #000;"  >' + data['created_by'] + '</a>'; } }, ] }); load_admin_chart(year);

</script>  
</body>
</html>