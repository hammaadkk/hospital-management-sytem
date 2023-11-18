<!DOCTYPE html>
<html lang="en">
<head>
  @include('labassistant.css')
 
  
  
  <style>
    /* Custom modern styles */
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f7f7f7;
    }

    .dashboard-title {
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 20px;
    }

    .modern-box-card {
      border: none;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      background-color: #fff;
      border-radius: 10px;
      overflow: hidden;
      transition: transform 0.3s ease;
    }

    .modern-box-card:hover {
      transform: scale(1.02);
    }

    .modern-box-card .card-body {
      padding: 20px;
    }

    .modern-box-card .icon-item {
      font-size: 48px;
      color: #3c6df0;
    }

    .modern-box-card h4 {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 5px;
      color: #333;
    }

    .modern-box-card .count-number {
      font-size: 36px;
      font-weight: 700;
      color: #3c6df0;
      text-align: center;
    }

    .modern-box-card .btn-info {
      background-color: #3c6df0;
      color: #fff;
      font-size: 14px;
      padding: 8px 20px;
      border-radius: 4px;
      text-transform: uppercase;
      letter-spacing: 1px;
      transition: background-color 0.3s ease;
    }

    .modern-box-card .btn-info:hover {
      background-color: #304ecf;
    }

    .modern-box-card .btn-info:focus {
      outline: none;
    }

    .quick-links {
      margin-top: 20px;
    }

    .quick-links .card {
      border: none;
      background-color: #f7f7f7;
      border-radius: 10px;
      padding: 15px;
      text-align: center;
      transition: transform 0.3s ease;
    }

    .quick-links .card:hover {
      transform: scale(1.02);
    }

    .quick-links .card h5 {
      font-size: 18px;
      font-weight: 600;
      color: #333;
      margin-bottom: 10px;
    }

    .quick-links .card i {
      font-size: 24px;
      color: #3c6df0;
    }
  .dashboard-title{
    font-size:40px;
  }
    #visitsChartContainer {
      background-color: #191C24;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      padding: 20px;
    }
    .count-number {
    font-size: 36px; 
    font-weight: bold;
  
  }
  </style>
  <link rel="shortcut icon" href="admin/assets/images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    @include('labassistant.sidebar')
    @include('labassistant.navbar')
   
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
    @if (auth('labassistant')->check())
        <h1 class="dashboard-title">Welcome, {{ ucfirst(auth('labassistant')->user()->name) }}! as lab assistant</h1>
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
       <!-- Total Reports -->
          <div class="col-xl-4 col-md-6 col-sm-12 grid-margin stretch-card">
            <div class="card modern-box-card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-8">
                    <div class="d-flex align-items-center">
                      <i class="mdi mdi-clipboard-text-outline text-primary icon-item"></i>
                      <div class="ms-3">
                        <h4>Total Reports</h4>
                        <p class="text-muted mb-0 count-number">{{$totalReports}}</p>
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

 <!-- Total In Process Reports -->
 <div class="col-xl-4 col-md-6 col-sm-12 grid-margin stretch-card">
            <div class="card modern-box-card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-8">
                    <div class="d-flex align-items-center">
                      <i class="mdi mdi-file-document-outline text-primary icon-item"></i>
                      <div class="ms-3">
                        <h4>Total In Process</h4>
                        <p class="text-muted mb-0 count-number">{{ $countInProcessReports }}</p>
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

<!-- tota uploaded tests -->

          <div class="col-xl-4 col-md-6 col-sm-12 grid-margin stretch-card">
    <div class="card modern-box-card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-8">
                    <div class="d-flex align-items-center">
                        <i class="mdi mdi-file-document-outline text-primary icon-item"></i>
                        <div class="ms-3">
                            <h4>Total Uploaded</h4>
                            <p class="text-muted mb-0 count-number">{{ $countUploadedReports }}</p>
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

 <!-- Quick Links -->
 <div class="row quick-links">
          <!-- Quick Link 1 -->
          <div class="col-md-4">
            <div class="card">
              <i class="mdi mdi-calendar-check"></i>
              <h5>Add Report</h5>
              <a href="{{url('/add_report')}}" class="btn btn-sm btn-info">View</a>
            </div>
          </div>

          <!-- Quick Link 2 -->
          <div class="col-md-4">
            <div class="card">
              <i class="mdi mdi-file-document-edit"></i>
              <h5>Upload Report</h5>
              <a href="{{url('/upload_report')}}" class="btn btn-sm btn-info">Create</a>
            </div>
          </div>

          <!-- Quick Link 3 -->
          <div class="col-md-4">
            <div class="card">
              <i class="mdi mdi-history"></i>
              <h5>Add New Test</h5>
              <a href="{{url('/view_all_tests')}}" class="btn btn-sm btn-info">View All</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 mt-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Uploaded Reports Data</h4>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Number of Uploaded Reports</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($uploadedReportsData as $data)
                            <tr>
                                <td>{{ $data->date }}</td>
                                <td>{{ $data->count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



    
    </div>
  
  </div>

@include('labassistant.script')

</body>
</html>