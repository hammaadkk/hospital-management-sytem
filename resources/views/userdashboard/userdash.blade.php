<!DOCTYPE html>
<html lang="en">
<head>
  
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Corona Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="admin/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="admin/assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="admin/assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="admin/assets/css/style.css">
  <!-- End layout styles -->
  <style>
    .dashboard-title {
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 20px;
    }
    /* Modern styling for the pie chart section */
    #visitsChartContainer {
      background-color: #191C24;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      padding: 20px;
    }
    .count-number {
    font-size: 36px; /* Increase the font size */
    font-weight: bold;
    /* text-align: center; */
  }
  </style>
  <link rel="shortcut icon" href="admin/assets/images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    @include('userdashboard.sidebar')
    @include('userdashboard.navbar')
   
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card corona-gradient-card">
              <div class="card-body py-0 px-0 px-sm-3">
                <div class="row align-items-center">
                  <div class="col-md-4 col-sm-12 col-xl-2">
                    <img src="assets/images/dashboard/Group126@2x.png" class="gradient-corona-img img-fluid" alt="">
                  </div>
                  <div class="col-md-8 col-sm-12 col-xl-10 p-0">
                  @if (auth('web')->check())
        <h1 class="dashboard-title">Welcome {{ ucfirst(auth('web')->user()->name) }} to Patient Dashboard</h1>
    @else
        <h1 class="dashboard-title">Welcome to the lab assistant Dashboard</h1>
    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
        <!-- Total Appointments -->
<div class="col-xl-3 col-md-6 col-sm-12 grid-margin stretch-card">
    <div class="card modern-box-card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-8">
                    <div class="d-flex align-items-center">
                        <i class="mdi mdi-clipboard-text-outline text-primary icon-item"></i>
                        <div class="ms-3">
                            <h4 class="mb-0">Total Appointments</h4>
                            <p class="text-muted mb-0 count-number">{{ $totalAppointments }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-4 text-end">
                    <i class="mdi mdi-arrow-top-right text-success icon-item"></i>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- Total Reports -->
<div class="col-xl-3 col-md-6 col-sm-12 grid-margin stretch-card">
    <div class="card modern-box-card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-8">
                    <div class="d-flex align-items-center">
                        <i class="mdi mdi-file-document-outline text-primary icon-item"></i>
                        <div class="ms-3">
                            <h4 class="mb-0">Total Reports</h4>
                            <p class="text-muted mb-0 count-number">{{ $totalReports }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-4 text-end">
                    <i class="mdi mdi-arrow-top-right text-success icon-item"></i>
                </div>
            </div>
            
        </div>
    </div>
</div>
          <div class="col-xl-3 col-md-6 col-sm-12 grid-margin stretch-card">
            <div class="card modern-box-card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-8">
                    <div class="d-flex align-items-center">
                      <i class="mdi mdi-account-multiple-outline text-primary icon-item"></i>
                      <div class="ms-3">
                        <h4 class="mb-0">Pending Reports</h4>
                        <p class="text-muted mb-0 count-number ">{{ $pendingReportsCount }}</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <i class="mdi mdi-arrow-top-right text-success icon-item"></i>
                  </div>
                </div>
               

              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 col-sm-12 grid-margin stretch-card">
    <div class="card modern-box-card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-8">
                    <div class="d-flex align-items-center">
                        <i class="mdi mdi-calendar-check text-primary icon-item"></i>
                        <div class="ms-3">
                            <h4 class="mb-0">Pending Appointments</h4>
                            <p class="text-muted mb-0 count-number ">{{ $pendingAppointmentsCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-4 text-end">
                    <i class="mdi mdi-arrow-bottom-left text-danger icon-item"></i>
                </div>
            </div>

           
        </div>
    </div>
</div>


            
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div id="visitsChart" style="height: 400px;"></div>
            </div>
          </div>
        </div>
      </div>
     

      </div>
     
    </div>
   
  </div>

<script src="https://www.gstatic.com/charts/loader.js"></script>
<script>

  google.charts.load('current', {'packages': ['corechart']});
  google.charts.setOnLoadCallback(drawVisitsChart);
  function drawVisitsChart() {
    var jsonData = JSON.parse(`{!! $lineChartData !!}`);
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Month');
    data.addColumn('number', 'Number of Visits');
    for (var i = 0; i < jsonData.length; i++) {
      data.addRow([jsonData[i].month, jsonData[i].count]);
    }

   
    var options = {
      title: 'Number of Visits per Month',
      backgroundColor: 'transparent',
      legend: {
        position: 'none'
      },
      chartArea: { width: '80%', height: '80%' },
      hAxis: {
        textStyle: {
          color: '#ffffff'
        }
      },
      vAxis: {
        title: 'Number of Visits',
        titleTextStyle: {
          color: '#ffffff'
        },
        textStyle: {
          color: '#ffffff'
        },
        gridlines: {
          color: '#4d4d4d'
        }
      },
      colors: ['#F15F36'],
      curveType: 'function'
    };

   
    var chart = new google.visualization.LineChart(document.getElementById('visitsChart'));
    chart.draw(data, options);
  }
</script>
@include('userdashboard.script')
 
</body>
</html>