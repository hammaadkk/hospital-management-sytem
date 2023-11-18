<style>
    .custom-card {
        background-color: #2c3e50;
        border: none;
        transition: transform 0.2s, box-shadow 0.2s;
        cursor: pointer;
        border-radius: 10px;
        color: #fff;
    }

    .custom-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .custom-card .card-body {
        padding: 1px;
    }

    .custom-icon {
        font-size: 36px;
        margin-bottom: 10px;
    }

    .custom-title {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .custom-text {
        font-size: 24px; 
        color: #ff5733; 
        margin-top: 10px; 
        font-weight: bold;
    }

    .custom-text strong {
        font-weight: bold;
    }
</style>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card corona-gradient-card">
                    <div class="card-body py-0 px-0 px-sm-3">
                        <div class="row align-items-center">
                            <div class="col-4 col-sm-3 col-xl-2">
                            <img src="{{ asset('admin/assets/images/dashboard/ab.png') }}" alt="Image Alt Text" class="gradient-corona-img img-fluid" alt="">
                            </div>
                            <div class="col-5 col-sm-7 col-xl-8 p-0">
                                <h1 style="font-size:40px; text-align: center;">Welcome to Admin Dashboard</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card custom-card">
                    <div class="card-body text-center">
                        <i class="mdi mdi-doctor custom-icon"></i>
                        <h4 class="card-title custom-title">Total Doctors</h4>
                        <p class="card-text custom-text"><strong>{{ $doctorsCount }}</strong></p>
                    </div>
                </div>
            </div>
           


            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card custom-card">
                    <div class="card-body text-center">
                        <i class="mdi mdi-account-circle custom-icon"></i>
                        <h4 class="card-title custom-title">Total Receptionists</h4>
                        <p class="card-text custom-text"><strong>{{ $ReceptionistsCount }}</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card custom-card">
                    <div class="card-body text-center">
                        <i class="mdi mdi-hospital-marker custom-icon"></i>
                        <h4 class="card-title custom-title">Total Lab Assistants</h4>
                        <p class="card-text custom-text"><strong>{{ $LabassistantsCount }}</strong></p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card custom-card">
        <div class="card-body text-center">
            <i class="mdi mdi-calendar-multiple custom-icon"></i>
            <h4 class="card-title custom-title">Total Appointments</h4>
            <p class="card-text custom-text"><strong>{{ $AppointmentsCount }}</strong></p>
        </div>
    </div>
</div>

<div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card custom-card">
        <div class="card-body text-center">
            <i class="mdi mdi-check-circle custom-icon"></i>
            <h4 class="card-title custom-title">Approved Appointments</h4>
            <p class="card-text custom-text"><strong>{{ $approvedAppointmentsCount }}</strong></p>
        </div>
    </div>
</div>


<div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card custom-card">
        <div class="card-body text-center">
            <i class="mdi mdi-clock-outline custom-icon"></i>
            <h4 class="card-title custom-title">In Progress Appointments</h4>
            <p class="card-text custom-text"><strong>{{ $inprogessAppointmentsCount }}</strong></p>
        </div>
    </div>
</div>

              
<div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card custom-card">
        <div class="card-body text-center">
            <i class="mdi mdi-close-circle-outline custom-icon"></i>
            <h4 class="card-title custom-title">Cancelled Appointments</h4>
            <p class="card-text custom-text"><strong>{{ $CancelledAppointmentsCount }}</strong></p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Quick Actions</h4>
                <ul class="quick-actions">
                    <li><a href="#">Add Doctor</a></li>
                    <li><a href="#">Add Nurse</a></li>
                    <li><a href="#">Add Receptionist</a></li>
                    <li><a href="#">Add Lab Assistant</a></li>
                    <li><a href="#">Approve Appointments</a></li>
                    <li><a href="#">Cancel Appointments</a></li>
                    <li><a href="#">Delete Records</a></li>
                    <li><a href="#">Update Records</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

              
              
            </div> 
          </div>
        </div>
      </div> 
    </div>