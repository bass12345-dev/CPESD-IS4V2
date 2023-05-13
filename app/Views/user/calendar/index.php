<!doctype html>
<html class="no-js" lang="en">
   <head>
      <?php echo view('includes/meta.php') ?>
      <?php echo view('includes/css.php') ?> 
      <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/evo-calendar/css/evo-calendar.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/evo-calendar/css/evo-calendar.midnight-blue.css"/>
   </head>
   <body>
      <div class="page-container sbar_collapsed">
         <div class="main-content">

            <?php echo view('user/calendar/sections/calendar_topbar'); ?>
             <?php echo view('user/calendar/sections/calendar_breadcrumbs'); ?>
            <div class="main-content-inner "  style="padding: 50px;" >
                
                      <div class="row">
                        <div class="col-12 ">
                           <div class="card" style="border: 1px solid;  ">
                              <div class="card-body">
                                 <div class="row">
                                    <div class="col-md-12">               
                                          <div id="calendar"></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>    
               
                </div>
            </div>
         </div>
      <?php echo view('includes/scripts.php') ?> 
      <script src="<?= site_url() ?>assets/evo-calendar/js/evo-calendar.js"></script> 
      <script>

         var today = new Date();


         console.log(today)



      function get_pmas_activities(){

         $.ajax({
               url: base_url + 'api/get-pmas-activities',
               type: "POST",
               dataType: "json",
               success: function (data) {


                     $('#calendar').evoCalendar({
                              theme : 'Midnight Blue',
                              format: "MM dd, yyyy",
                                titleFormat: "MM",
                                calendarEvents: data    
                            })


               }

            });
      }


      get_pmas_activities();


   
    // $('#calendar').evoCalendar({
    //   theme : 'Midnight Blue',
    //   format: "MM dd, yyyy",
    //     titleFormat: "MM",
    //     calendarEvents: [  {
    //         id: "in8bha4",
    //         name: "Holiday #2",
    //         description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
    //         date: today,
    //         type: "holiday"
    //     }, {
    //         id: "in8bha4",
    //         name: "Event #2",
    //         date: today,
    //         type: "event"
    //     }]       
    // })

      </script>
   </body>
</html>