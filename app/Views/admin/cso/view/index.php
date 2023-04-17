<!doctype html>
<html class="no-js" lang="en">
   <head>
      <?php echo view('includes/meta.php') ?>
      <?php echo view('includes/css.php') ?> 
      <style>
         /*CSS*/
               .tree-content {
                  margin: 0px;
                  padding: 0px;
                  width: 100%;
                  height: 180vh;
                  font-family: Helvetica;
                  overflow: hidden;
               }

               #tree {
                  width: 100%;
                  height: 180vh;
               }

               #exTab1 .tab-content {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}

#exTab2 h3 {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}

/* remove border radius for the tab */

#exTab1 .nav-pills > li > a {
  border-radius: 0;
}

/* change border radius for the tab , apply corners on top*/

#exTab3 .nav-pills > li > a {
  border-radius: 4px 4px 0 0 ;
}

#exTab3 .tab-content {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}


      </style>
   </head>
   <body>
      <div class="page-container sbar_collapsed">
         <div class="main-content">
            <?php echo view('admin/cso/view/sections/cso_topbar'); ?>
            <?php echo view('admin/cso/view/sections/cso_breadcrumbs'); ?>
            <div class="main-content-inner">
            <div class="row">
               <div class="col-12 mt-5">
                  <div class="card" style="border: 1px solid; height: 200vh;">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
                              <?php echo view('admin/cso/view/sections/cso_tabs'); ?>
                                 <div class="tab-content clearfix mt-3">
			                           <div class="tab-pane active" id="1a">
                                       <?php echo view('admin/cso/view/sections/cso_information'); ?>  
				                        </div>
				                        <div class="tab-pane" id="2a">
                                       <?php echo view('admin/cso/view/sections/cso_officers'); ?>  
				                        </div>
                              </div>
                           </div>   
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php echo view('admin/cso/view/modals/update_cso_information'); ?> 
      <?php echo view('admin/cso/view/modals/update_officer_modal'); ?> 
      <?php echo view('admin/cso/view_officers/modals/add_officer_modal'); ?>   
      <?php echo view('admin/cso/modals/update_cso_status_modal'); ?> 
     <?php echo view('admin/cso/view/modals/update_cor_modal'); ?> 
     <?php echo view('admin/cso/view/modals/update_bylaws_modal'); ?> 
     <?php echo view('admin/cso/view/modals/update_aoc_modal'); ?> 
     <?php echo view('admin/cso/view/modals/view_file_modal'); ?> 


      <?php echo view('includes/scripts.php') ?> 
      <script src="https://balkan.app/js/OrgChart.js"></script>
      <script>


 var myState = {
            pdf: null,
            currentPage: 1,
            zoom: 3
        }
// var pdf = './../../uploads/cso_files/1/cor/compressed.tracemonkey-pldi-09.pdf';




function render() {
            myState.pdf.getPage(myState.currentPage).then((page) => {
            
                var canvas = document.querySelector('canvas');
                var ctx = canvas.getContext('2d');
     
                var viewport = page.getViewport(myState.zoom);
                canvas.width = viewport.width;
                canvas.height = viewport.height;
         
                page.render({
                    canvasContext: ctx,
                    viewport: viewport
                });
            });
        }


        document.getElementById('go_previous').addEventListener('click', (e) => {
            if(myState.pdf == null || myState.currentPage == 1) 
              return;
            myState.currentPage -= 1;
            document.getElementById("current_page").value = myState.currentPage;
            render();
        });
        document.getElementById('go_next').addEventListener('click', (e) => {
            if(myState.pdf == null || myState.currentPage > myState.pdf._pdfInfo.numPages) 
               return;
            myState.currentPage += 1;
            document.getElementById("current_page").value = myState.currentPage;
            render();
        });
        document.getElementById('current_page').addEventListener('keypress', (e) => {
            if(myState.pdf == null) return;
         
            // Get key code 
            var code = (e.keyCode ? e.keyCode : e.which);
         
            // If key code matches that of the Enter key 
            if(code == 13) {
                var desiredPage = 
                document.getElementById('current_page').valueAsNumber;
                                 
                if(desiredPage >= 1 && desiredPage <= myState.pdf._pdfInfo.numPages) {
                    myState.currentPage = desiredPage;
                    document.getElementById("current_page").value = desiredPage;
                    render();
                }
            }
        });
        // document.getElementById('zoom_in').addEventListener('click', (e) => {
        //     if(myState.pdf == null) return;
        //     myState.zoom += 0.5;
        //     render();
        // });
        // document.getElementById('zoom_out').addEventListener('click', (e) => {
        //     if(myState.pdf == null) return;
        //     myState.zoom -= 0.5;
        //     render();
        // });

$(document).on('click','a#view_cor',function (e) {



          $.ajax({
                            type: "POST",
                            url: base_url + 'api/get-cor',
                            data : {'id' : '<?php echo $_GET['id'] ?>'},
                            cache: false,
                            dataType: 'json', 
                            beforeSend :  function(){

                                    $('#view_cor').html('<div class="loader"></div>');
                            },
                            success: function(data){

                                if (data.resp) {

                                     $('#view_file_modal').modal('show');
                                    pdf = data.file
                                   pdfjsLib.getDocument(pdf).then((pdf) => {  

                                       
                                        myState.pdf = pdf;
                                        render();
                                    });

                                    $('#view_cor').html('View COR');

                                }else {

                                     Toastify({
                                              text: data.message,
                                              className: "info",
                                              style: {
                                                "background" : "linear-gradient(to right, #00b09b, #96c93d)",
                                                "height" : "60px",
                                                "width" : "350px",
                                                "font-size" : "20px"
                                              }
                                            }).showToast();
                                    
                                    $('#view_cor').html('View COR');
                                }
                                       
                            }, error : function(){

                                    alert('error')

                            }

                    })

     
    
});



$(document).on('click','a#view_bylaws',function (e) {



          $.ajax({
                            type: "POST",
                            url: base_url + 'api/get-bylaws',
                            data : {'id' : '<?php echo $_GET['id'] ?>'},
                            cache: true,
                            dataType: 'json', 
                            beforeSend :  function(){

                                    $('#view_bylaws').html('<div class="loader"></div>');
                            },
                            success: function(data){

                                if (data.resp) {

                                     $('#view_file_modal').modal('show');
                                    pdf = data.file
                                   pdfjsLib.getDocument(pdf).then((pdf) => {    
                                        myState.pdf = pdf;
                                        render();
                                    });

                                    $('#view_bylaws').html('View Bylaws');

                                }else {

                                     Toastify({
                                              text: data.message,
                                              className: "info",
                                              style: {
                                                "background" : "linear-gradient(to right, #00b09b, #96c93d)",
                                                "height" : "60px",
                                                "width" : "350px",
                                                "font-size" : "20px"
                                              }
                                            }).showToast();
                                    
                                    $('#view_cor').html('View COR');
                                }
                                       
                            }

                    })

     
    
});




$(document).on('click','a#view_bylaws',function (e) {



          $.ajax({
                            type: "POST",
                            url: base_url + 'api/get-bylaws',
                            data : {'id' : '<?php echo $_GET['id'] ?>'},
                            cache: true,
                            dataType: 'json', 
                            beforeSend :  function(){

                                    $('#view_bylaws').html('<div class="loader"></div>');
                            },
                            success: function(data){

                                if (data.resp) {

                                     $('#view_file_modal').modal('show');
                                    pdf = data.file
                                   pdfjsLib.getDocument(pdf).then((pdf) => {    
                                        myState.pdf = pdf;
                                        render();
                                    });

                                    $('#view_bylaws').html('View Bylaws');

                                }else {

                                     Toastify({
                                              text: data.message,
                                              className: "info",
                                              style: {
                                                "background" : "linear-gradient(to right, #00b09b, #96c93d)",
                                                "height" : "60px",
                                                "width" : "350px",
                                                "font-size" : "20px"
                                              }
                                            }).showToast();
                                    
                                    $('#view_bylaws').html('View COR');
                                }
                                       
                            }

                    })

     
    
});



$(document).on('click','a#view_aoc',function (e) {



          $.ajax({
                            type: "POST",
                            url: base_url + 'api/get-aoc',
                            data : {'id' : '<?php echo $_GET['id'] ?>'},
                            cache: true,
                            dataType: 'json', 
                            beforeSend :  function(){

                                    $('#view_aoc').html('<div class="loader"></div>');
                            },
                            success: function(data){

                                if (data.resp) {

                                     $('#view_file_modal').modal('show');
                                    pdf = data.file
                                   pdfjsLib.getDocument(pdf).then((pdf) => {    
                                        myState.pdf = pdf;
                                        render();
                                    });

                                    $('#view_aoc').html('View Bylaws');

                                }else {

                                     Toastify({
                                              text: data.message,
                                              className: "info",
                                              style: {
                                                "background" : "linear-gradient(to right, #00b09b, #96c93d)",
                                                "height" : "60px",
                                                "width" : "350px",
                                                "font-size" : "20px"
                                              }
                                            }).showToast();
                                    
                                    $('#view_aoc').html('View COR');
                                }
                                       
                            }

                    })

     
    
});





function Validate_file(oInput) {

       

        if (oInput.type == "file") {
            var sFileName = oInput.value;
             if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                         // $('button.update-cor-cso-save').removeClass('d-none')
                        blnValid = true;
                        break;
                         
                         
                    }

                }
                 
                if (!blnValid) {
                    alert("Sorry, " + sFileName + " is invalid, allowed extension is " + _validFileExtensions.join(", ") + ' only');
                    // $('button.update-cor-cso-save').addClass('d-none')
                    oInput.value = "";
                    return false;
                    
                     
                }
            }
        }
        return true;

    }



$('#update_aoc_form').on('submit', function(e) {
        e.preventDefault();

        
        $.ajax({
             type: "POST",
            url: base_url + 'api/update-aoc',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: 'json',
            beforeSend: function() {
                $('.update-aoc-cso').html('<div class="loader"></div>');
                $('.update-aoc-cso').prop("disabled", true);
                
            },
             success: function(data)
            {            
                if (data.response) {
                    $('#update_aoc_modal').modal('hide');
                    $('.update-aoc-cso').prop("disabled", false);
                    $('.update-aoc-cso').text('Save Changes');
                        Toastify({
                                  text: data.message,
                                  className: "info",
                                  style: {
                                    "background" : "linear-gradient(to right, #00b09b, #96c93d)",
                                    "height" : "60px",
                                    "width" : "350px",
                                    "font-size" : "20px"
                                  }
                                }).showToast();

                        
                           
             
                }else {
                    $('.update-aoc-cso').prop("disabled", false);
                    $('.update-aoc-cso').text('Save Changes');
                      Toastify({
                                  text: data.message,
                                  className: "info",
                                  style: {
                                    "background" : "linear-gradient(to right, #00b09b, #96c93d)",
                                    "height" : "60px",
                                    "width" : "350px",
                                    "font-size" : "20px"
                                  }
                                }).showToast();
                   
                }
           },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                 $('.update-aoc-cso').prop("disabled", false);
                 $('.update-aoc-cso').text('Save Changes');
            },

        })


    })


$('#update_bylaws_form').on('submit', function(e) {
        e.preventDefault();

        
        $.ajax({
             type: "POST",
            url: base_url + 'api/update-bylaws',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: 'json',
            beforeSend: function() {
                $('.btn-update-bylaws').html('<div class="loader"></div>');
                $('.btn-update-bylaws').prop("disabled", true);
                
            },
             success: function(data)
            {            
                if (data.response) {
                    $('#update_bylaws_modal').modal('hide');
                    $('.btn-update-bylaws').prop("disabled", false);
                    $('.btn-update-bylaws').text('Save Changes');
                        Toastify({
                                  text: data.message,
                                  className: "info",
                                  style: {
                                    "background" : "linear-gradient(to right, #00b09b, #96c93d)",
                                    "height" : "60px",
                                    "width" : "350px",
                                    "font-size" : "20px"
                                  }
                                }).showToast();

                        
                           
             
                }else {
                    $('.btn-update-bylaws').prop("disabled", false);
                    $('.btn-update-bylaws').text('Save Changes');
                      Toastify({
                                  text: data.message,
                                  className: "info",
                                  style: {
                                    "background" : "linear-gradient(to right, #00b09b, #96c93d)",
                                    "height" : "60px",
                                    "width" : "350px",
                                    "font-size" : "20px"
                                  }
                                }).showToast();
                   
                }
           },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                 $('.btn-update-bylaws').prop("disabled", false);
                 $('.btn-update-bylaws').text('Save Changes');
            },

        })


    })


$('#update_cor_form').on('submit', function(e) {
        e.preventDefault();

        
        $.ajax({
             type: "POST",
            url: base_url + 'api/update-cor',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: 'json',
            beforeSend: function() {
                $('.update-cor-cso-save').html('<div class="loader"></div>');
                $('.update-cor-cso-save').prop("disabled", true);
                
            },
             success: function(data)
            {            
                if (data.response) {
                    $('#update_cor_modal').modal('hide');
                    $('.update-cor-cso-save').prop("disabled", false);
                    $('.update-cor-cso-save').text('Save Changes');
                        Toastify({
                                  text: data.message,
                                  className: "info",
                                  style: {
                                    "background" : "linear-gradient(to right, #00b09b, #96c93d)",
                                    "height" : "60px",
                                    "width" : "350px",
                                    "font-size" : "20px"
                                  }
                                }).showToast();

                        
                           
             
                }else {
                    $('.update-cor-cso-save').prop("disabled", false);
                    $('.update-cor-cso-save').text('Save Changes');
                      Toastify({
                                  text: data.message,
                                  className: "info",
                                  style: {
                                    "background" : "linear-gradient(to right, #00b09b, #96c93d)",
                                    "height" : "60px",
                                    "width" : "350px",
                                    "font-size" : "20px"
                                  }
                                }).showToast();
                   
                }
           },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                 $('.update-cor-cso-save').prop("disabled", false);
                 $('.update-cor-cso-save').text('Save Changes');
            },

        })


    })






$('#add_officer_form').on('submit', function(e) {
    e.preventDefault();

         $.ajax({
            type: "POST",
            url: base_url + 'api/add-officer',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: 'json',
            beforeSend: function() {
                $('.btn-add').text('Please wait...');
                $('.btn-add').attr('disabled','disabled');
            },
             success: function(data)
            {            
                if (data.response) {
                    $('#add_officer_form')[0].reset();
                    $('.btn-add').text('Submit');
                    $('.btn-add').removeAttr('disabled');
                    Toastify({
                                text: data.message,
                                className: "info",
                                style: {
                                    "background" : "linear-gradient(to right, #00b09b, #96c93d)",
                                    "height" : "60px",
                                    "width" : "350px",
                                    "font-size" : "20px"
                                }
                            }).showToast();
                            $('#officers_table').DataTable().destroy();
                            load_organization_chart();
                           
                }else {
                    $('.btn-add').text('Submit');
                    $('.btn-add').removeAttr('disabled');
                    Toastify({
                                text: data.message,
                                className: "info",
                                style: {
                                    "background" : "#e01c0d",
                                    "height" : "60px",
                                    "width" : "350px",
                                    "font-size" : "20px"
                                }
                            }).showToast();
                }
           },
            error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    $('.btn-add').text('Submit');
                    $('.btn-add').removeAttr('disabled');
            },


        });

      });


    



var chart = new OrgChart(document.getElementById("tree"), {
    enableSearch: false,
    enableDragDrop: false, 
    lazyLoading: true, 
    mouseScrool: OrgChart.none,
    menu : {
         pdf : {
            text : 'Export Pdf'
         },
         png: { text: "Export PNG" },
            svg: { text: "Export SVG" },
            csv: { text: "Export CSV" },
            json: { text: "Export JSON" }
         
    },
    tags: {
        "assistant": {
            template: "ula"
        }
    },
   //  mode: "dark",
    anim: {func: OrgChart.anim.outBack, duration: 500},
    
    nodeBinding: {
        field_0: "name",
        field_1: "title",
        img_0: "img"
    }
});

function load_organization_chart(){

   $.ajax({
            url: base_url + 'api/get-officers      ',
            type: "POST",
            data : {cso_id :"<?php echo $_GET['id'] ?>"},
            dataType: "json",
            success: function(data) {

               chart.load(data);
               


               $('#officers_table').DataTable({
                scrollY: 500,
                scrollX: true,
               "ordering" : false,
               "data": data,
               "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                                        "<'row'<'col-sm-12'tr>>" +
                                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        buttons: [
                                  {
                                     extend: 'excel',
                                     text: 'Excel',
                                     className: 'btn btn-default ',
                                     exportOptions: {
                                        columns: 'th:not(:last-child)'
                                     }
                                  },
                                   {
                                     extend: 'pdf',
                                     text: 'pdf',
                                     className: 'btn btn-default',
                                     exportOptions: {
                                        columns: 'th:not(:last-child)'
                                     }
                                  },

                                {
                                     extend: 'print',
                                     text: 'print',
                                     className: 'btn btn-default',
                                     exportOptions: {
                                        columns: 'th:not(:last-child)'
                                     }
                                  },    

                        ],
               'columns': [
                  {
                     // data: "song_title",
                     data: null,
                     render: function (data, type, row) {
                        return row.name;
                     }

                  },
                  {
                     // data: "song_title",
                     data: null,
                     render: function (data, type, row) {
                           return row.title;
                     }

                  },
                  {
                     // data: "song_title",
                     data: null,
                     render: function (data, type, row) {
                           return row.contact_number;
                     }

                  },
                  {
                     // data: "song_title",
                     data: null,
                     render: function (data, type, row) {
                           return row.email_address;
                     }

                  },
                  {
             // data: "song_title",
             data: null,
             render: function (data, type, row) {
                 return '<ul class="d-flex justify-content-center">\
                             <li class="mr-3 ">\
                             <a href="javascript:;" class="text-secondary action-icon" \
                             data-id="'+data['cso_officer_id']+'"  \
                             data-position="'+data['position']+'"  \
                             data-first-name="'+data['first_name']+'"  \
                             data-middle-name="'+data['middle_name']+'"  \
                             data-last-name="'+data['last_name']+'"  \
                             data-extension="'+data['extension']+'"  \
                             data-contact="'+data['contact_number']+'"  \
                             data-email="'+data['email_address']+'"  \
                             id="update-cso-officer"><i class="fa fa-edit"></i></a></li>\
                             <li class="mr-3 ">\
                             <a href="javascript:;" class="text-danger action-icon" \
                             data-id="'+data['cso_officer_id']+'"  \
                             id="delete-cso-officer"><i class="fa fa-trash"></i></a></li>\
                             </ul>';
             }

         },
]

})

            }


   });

// chart.load([
//     { id: 1, name: "Denny Curtis", title: "CEO", img: "https://cdn.balkan.app/shared/2.jpg" },
//     { id: 2, pid: 1, name: "Ashley Barnett", title: "Sales Manager", img: "https://cdn.balkan.app/shared/3.jpg" },
//     { id: 3, pid: 2, name: "Caden Ellison", title: "Dev Manager", img: "https://cdn.balkan.app/shared/4.jpg" },
//     { id: 4, pid: 3, name: "Elliot Patel", title: "Sales", img: "https://cdn.balkan.app/shared/5.jpg" },
//     { id: 5, pid: 4, name: "Lynn Hussain", title: "Sales", img: "https://cdn.balkan.app/shared/6.jpg" },
//     { id: 6, pid: 5, name: "Tanner May", title: "Developer", img: "https://cdn.balkan.app/shared/7.jpg" },
    
// ]);
}



$(document).on('click','a#delete-cso-officer',function (e) {


var id = $(this).data('id');

   
Swal.fire({
        title: "Are you sure?",
        text: "You wont be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
    }).then(function(result) {
        if (result.value) {
            
                    $.ajax({
                            type: "POST",
                            url: base_url + 'api/delete-cso-officer',
                            data: {id: id},
                            cache: false,
                            dataType: 'json', 
                            beforeSend : function(){

                                  Swal.fire({
                                title: "",
                                text: "Please Wait",
                                icon: "",
                                showCancelButton: false,
                                showConfirmButton : false,
                                reverseButtons: false,
                                allowOutsideClick : false
                            })

                            },
                            success: function(data){
                               if (data.response) {

                                  Swal.fire(
                "",
                "Deleted Successfully",
                "success"
            )

                                $('#officers_table').DataTable().destroy();
                                 load_organization_chart();
                                
                               }

                              
                            }
                    })



            // result.dismiss can be "cancel", "overlay",
            // "close", and "timer"
        } else if (result.dismiss === "cancel") {
           swal.close()

        }
    });

})



$('#update_cso_information_form').on('submit', function(e) {
        e.preventDefault();

         $.ajax({
            type: "POST",
            url: base_url + 'api/update-cso-information',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: 'json',
            beforeSend: function() {
                $('.btn-update-cso').text('Please wait...');
                $('.btn-update-cso').attr('disabled','disabled');
            },
             success: function(data)
            {            
                if (data.response) {
                    $('#update_cso_information_modal').modal('hide')
                    $('.btn-update-cso').text('Save Changes');
                    $('.btn-update-cso').removeAttr('disabled');
                    
                   Toastify({
                                text: data.message,
                                className: "info",
                                style: {
                                    "background" : "linear-gradient(to right, #00b09b, #96c93d)",
                                    "height" : "60px",
                                    "width" : "350px",
                                    "font-size" : "20px"
                                }
                            }).showToast();
                    
                    get_cso_information();

                }else {
                    
                     $('.btn-update-cso').text('Save Changes');
                    $('.btn-update-cso').removeAttr('disabled');
                      
                   Toastify({
                                text: data.message,
                                className: "info",
                                style: {
                                    "background" : "linear-gradient(to right, #00b09b, #96c93d)",
                                    "height" : "60px",
                                    "width" : "350px",
                                    "font-size" : "20px"
                                }
                            }).showToast();
                   
                }
           },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                $('.btn-update-cso').text('Save Changes');
                $('.btn-update-cso').removeAttr('disabled');
            },


        });

    });

function get_cso_information(){

          $.ajax({
                            type: "POST",
                            url: base_url + 'api/get-cso-infomation',
                            data : {'id' : '<?php echo $_GET['id'] ?>'},
                            cache: false,
                            dataType: 'json',  
                            success: function(data){
                               $('.cso_code').text(data.cso_code)
                                $('.cso_name').text(data.cso_name)
                                $('.cso_address').text(data.address)
                                $('.contact_person').text(data.contact_person)
                                $('.contact_number').text(data.contact_number)
                                $('.telephone_number').text(data.telephone_number)
                                $('.email').text(data.email_address)
                                $('.classification').html('<span class="status-p sub-button">'+data.type_of_cso+'<span>')
                                $('.cso_status').html(data.cso_status+' '+'<a href="javascript:;" data-id="'+data.cso_id+'" data-status="'+data.status+'"  id="update-cso-status"  class=" text-center ml-3  btn-rounded  pull-right"><i class = "fa fa-edit" aria-hidden = "true"></i> Update Status</a>')
                                $('#update-cso-information').data('id',data.cso_id);



                                $('input[name=cso_idd]').val(data.cso_id);
                                $('input[name=cso_name]').val(data.cso_name);
                                $('input[name=cso_code]').val(data.cso_code);
                                // $('#cso_type option[value='+data.type_of_cso.toString().toLowerCase()+']').attr('selected','selected'); 
                                $('input[name=purok]').val(data.purok_number);
                                $('select[name=barangay]').val(data.barangay);
                                $('select[name=cso_type]').val(data.type_of_cso);

                               
                                $('input[name=contact_person]').val(data.contact_person);
                                $('input[name=contact_number]').val(data.contact_number);
                                $('input[name=telephone_number]').val(data.telephone_number);
                                $('input[name=email_address]').val(data.email_address);
                                




                                       
                            }

                    })

                }

$(document).on('click','a#update-cso-status',function (e) {

      const id = $(this).data('id');
      const status = $(this).data('status');
      $('#update_cso_status_modal').modal('show');
      $('#cso_status option[value='+status+']').attr('selected','selected'); 
      $('input[name=cso_id]').val(id);
});


$(document).on('click','a#update-cso-officer',function (e) {

const id = $(this).data('id'); 
const position = $(this).data('position');  
$('#update_officer_modal').modal('show');
$('select[name=update_cso_position]').val(position);
// $('#cso_status option[value='+position+']').attr('selected','selected'); 
$('input[name=officer_id]').val(id);
$('input[name=cso_id]').val('<?php echo $_GET['id'] ?>');
$('input[name=update_first_name]').val($(this).data('first-name'));
$('input[name=update_middle_name]').val($(this).data('middle-name'));
$('input[name=update_last_name]').val($(this).data('last-name'));
$('input[name=update_extension]').val($(this).data('extension'));
$('input[name=update_contact_number]').val($(this).data('contact'));
$('input[name=update_email]').val($(this).data('email'));
});



$('#update_officer_form').on('submit', function(e) {
        e.preventDefault();

         $.ajax({
            type: "POST",
            url: base_url + 'api/update-officer-information',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: 'json',
            beforeSend: function() {
                $('.btn-update-cso').text('Please wait...');
                $('.btn-update-cso').attr('disabled','disabled');
            },
             success: function(data)
            {            
                if (data.response) {
                    $('#update_officer_modal').modal('hide')
                    $('.btn-update-cso').text('Save Changes');
                    $('.btn-update-cso').removeAttr('disabled');
                    
                   Toastify({
                                text: data.message,
                                className: "info",
                                style: {
                                    "background" : "linear-gradient(to right, #00b09b, #96c93d)",
                                    "height" : "60px",
                                    "width" : "350px",
                                    "font-size" : "20px"
                                }
                            }).showToast();
                     $('#officers_table').DataTable().destroy();
                    load_organization_chart()

                }else {
                    
                     $('.btn-update-cso').text('Save Changes');
                    $('.btn-update-cso').removeAttr('disabled');
                      
                   Toastify({
                                text: data.message,
                                className: "info",
                                style: {
                                    "background" : "linear-gradient(to right, #00b09b, #96c93d)",
                                    "height" : "60px",
                                    "width" : "350px",
                                    "font-size" : "20px"
                                }
                            }).showToast();
                   
                }
           },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                $('.btn-update-cso').text('Save Changes');
                $('.btn-update-cso').removeAttr('disabled');
            },


        });

    });


      $('#update_cso_status_form').on('submit', function(e) {
        e.preventDefault();

         $.ajax({
            type: "POST",
            url: base_url + 'api/update-cso-status',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: 'json',
            beforeSend: function() {
                $('.btn-update-cso-status').text('Please wait...');
                $('.btn-update-cso-status').attr('disabled','disabled');
            },
             success: function(data)
            {            
                if (data.response) {
                    $('#update_cso_status_modal').modal('hide')
                    $('.btn-update-cso-status').text('Save Changes');
                    $('.btn-update-cso-status').removeAttr('disabled');
                    
                   Toastify({
                                text: data.message,
                                className: "info",
                                style: {
                                    "background" : "linear-gradient(to right, #00b09b, #96c93d)",
                                    "height" : "60px",
                                    "width" : "350px",
                                    "font-size" : "20px"
                                }
                            }).showToast();
                  get_cso_information();
                }else {
                    
                     $('.btn-update-cso-status').text('Save Changes');
                    $('.btn-update-cso-status').removeAttr('disabled');
                      
                   Toastify({
                                text: data.message,
                                className: "info",
                                style: {
                                    "background" : "linear-gradient(to right, #00b09b, #96c93d)",
                                    "height" : "60px",
                                    "width" : "350px",
                                    "font-size" : "20px"
                                }
                            }).showToast();
                   
                }
           },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                $('.btn-update-cso-status').text('Save Changes');
                $('.btn-update-cso-status').removeAttr('disabled');
            },


        });

    });
    


get_cso_information();
load_organization_chart();



      </script>
   </body>
</html>