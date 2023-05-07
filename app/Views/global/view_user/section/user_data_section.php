<section style="background-color: #eee;">
                                            <div class="container py-5">
                                             

                                              <div class="row">
                                                <div class="col-lg-4">
                                                  <div class="card mb-4">
                                                    <div class="card-body text-center">
                                                      <img src="" alt="avatar"
                                                        class="rounded-circle img-fluid" id="profile_picture" >
                                                      <h5 class="my-3 name"></h5>
                                                      <p class="text-muted mb-1">CPESD Member</p>
                                                      <!-- <p class="text-muted mb-4">Bay Area, San Francisco, CA</p> -->
                                                        <?php if (session()->user_id == $_GET['id']) {
                                                          // code...
                                                         ?>
                                                        <div class="d-flex justify-content-center mb-2">
                                                      
                                                        <button type="button"  data-toggle="modal" data-target="#update_profile_picture" class="btn btn-outline-primary ms-1">Update Profile Picture</button>

                                                      </div>
                                                      <div class="d-flex justify-content-center mb-2">
                                                        <button type="button" data-toggle="modal" data-target="#update_information_modal" class="btn btn-outline-primary ms-1">Update Information</button>

                                                      </div>
                                                      <div class="d-flex justify-content-center mb-2">
                                                      
                                                        <button type="button"  data-toggle="modal" data-target="#old_password_modal" class="btn btn-outline-primary ms-1">Change Password</button>

                                                      </div>

                                                    <?php }  ?>
                                                    </div>
                                                  </div>
                                                 
                                                </div>
                                                <div class="col-lg-8">
                                                  <div class="card mb-4">
                                                    <div class="card-body">
                                                      <div class="row">
                                                        <div class="col-sm-3">
                                                          <p class="mb-0">Username</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                          <p class="text-muted mb-0 username "></p>
                                                        </div>
                                                      </div>
                                                      <hr>
                                                      <div class="row">
                                                        <div class="col-sm-3">
                                                          <p class="mb-0">Full Name</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                          <p class="text-muted mb-0 name "></p>
                                                        </div>
                                                      </div>
                                                      <hr>
                                                      <div class="row">
                                                        <div class="col-sm-3">
                                                          <p class="mb-0">Address</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                          <p class="text-muted mb-0 address"></p>
                                                        </div>
                                                      </div>
                                                      <hr>
                                                      <div class="row">
                                                        <div class="col-sm-3">
                                                          <p class="mb-0">Email Address</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                          <p class="text-muted mb-0 email_address"></p>
                                                        </div>
                                                      </div>
                                                      <hr>
                                                      <div class="row">
                                                        <div class="col-sm-3">
                                                          <p class="mb-0">Contact Number</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                          <p class="text-muted mb-0 contact_number"></p>
                                                        </div>
                                                      </div>
                                                      <hr>
                                                  
                                                     
                                              
                                                    </div>
                                                  </div>
                                                 
                                                </div>
                                              </div>
                                            </div>
                                          </section>