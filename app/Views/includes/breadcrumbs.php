<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left"><?php echo esc($title) ?></h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="">Home</a></li>
                        <li><a href=""><?php echo esc($title) ?></a></li>                      
                    </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            <div class=" pull-right">
                <a href="" class="btn sub-button mb-2 mt-2 mr-2" >Request for Assistance</a>       
                 <a href="" class="btn sub-button mb-2 mt-2 mr-2" >Add Transaction</a>                
                <a href="" style="color: #000; font-size: 20px;"><?php echo session()->get('username') ?></a> 

            </div>
        </div>
    </div>
</div>