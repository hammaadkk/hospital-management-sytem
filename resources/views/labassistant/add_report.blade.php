<!DOCTYPE html>
<html lang="en">
<head>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
   
   <style>
    input[type="text"],
    input[type="email"],
    input[type="date"] {
      background-color: #fff;
      color: #000;
      transition: background-color 0.3s, color 0.3s;
    }

    #doctor {
      background-color: #fff;
      color: #000;
      transition: background-color 0.3s, color 0.3s;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="date"]:focus,
    #doctor:focus,
    textarea:focus {
      background-color: #fff;
      color: #000;
      outline: none;
    }

    #departement {
      background-color: #ffffff;
      color: black;
      font-weight: bold;
      width: 100%;
      text-align: center;
    }

    #message {
      background-color: white;
      color: black;
    }
  </style>

  @include('labassistant.css')
</head>
<body>
  <div class="container-scroller">
   
    @include('labassistant.sidebar')
 
    <div class="container-fluid page-body-wrapper">
      <div class="container" align="center" style="padding-top: 100px;">
        @if(session()->has('message'))
        <div class="alert alert-success">
          <button type="button" class="close" data-bs-dismiss="alert">x</button>
          {{session()->get('message')}}
        </div>
        @endif

        @include('labassistant.navbar')
        
        <style type="text/css">
          .submit-button {
            background-color: #00D9A5;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: left 0.9s ease-in-out;
            width: 100%;
          }

          .submit-button:hover {
            background-color: #596261;
            color: white;
          }

          .form-row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
          }

          .form-row .form-group {
            padding: 0 10px;
          }
        </style>
        <div class="page-section">
          <div class="container">
            <h1 class="text-center wow fadeInUp" style="font-size: 40px !important;">Add Report</h1>

            <form action="{{url('upload_reportfile')}}" method="post" enctype="multipart/form-data">   
              @csrf
              <div class="row mt-5">
                <div class="col-12 wow fadeInLeft">
                  <div class="form-row">
                    <!-- Patient ID field -->
                    <div class="col-md-6 form-group"> 
                      <label for="patientSearch">Patient ID</label>
                      <input type="text" id="patientSearch" class="form-control" placeholder="Search patient ID" name="pid" required>
                      
                      <div id="patient_id"></div>
                      <div id="patient_id_error" class="text-danger"></div> 
                    </div>
                    
                    <!-- Patient Name field -->
                    <div class="col-md-6 form-group">
                      <label for="patientName">Patient Name</label>
                      <input type="text" id="patientName" class="form-control" placeholder="Enter patient name" required name="patient_name" readonly>
                      <div id="patient_name"></div>
                    </div>

                   
                      <!-- Doctor field -->
                      <div class="col-md-6 form-group">
                          <label for="doctorName">Doctor</label>
                          <input type="text" id="doctorName" class="form-control" placeholder="Enter doctor name" required style="color: #000 !important;" readonly name="doctor">
                          <div id="doctor_name_suggestions"></div>
                      </div>


                     <!-- Date field -->      
<div class="col-md-6 form-group">
    <label for="date" style="display: block; text-align: center; margin-top: 10px; margin-bottom:10px;">Date of appointment</label>
    <input type="date" class="form-control" name="date" id="date" required style="color: #000 !important;" readonly>
</div>


                  <div class="card-body">
                   
                    <div class="row">
                      <div class="col-md-12 form-group">
                        <label for="testName">Test Name:</label>
                        <input type="text" name="test_name" id="testName" class="form-control" placeholder="Enter test name" required>
                        <div id="test_name_suggestions"></div>
                        <div id="test_name_error" class="text-danger"></div>
                      </div>

                     

                   
                   

                      </div>
                    </div>
</div>

                  
                  
                  <!-- Submit button -->
                  <button type="submit" class="submit-button wow fadeInLeft">Submit Request</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>





   @include('labassistant.script')
   
   <script>
  $(document).ready(function () {
    // Set up CSRF token for AJAX requests
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    // Function to change the text color of the Patient ID field when clicking outside
    $(document).on('click', function (e) {
      if (!$(e.target).is("#patientSearch") && $("#patientSearch").val() === '') {
        $("#patientSearch").css('color', '#000');
        $("#patient_id").html("");
      }
    });

    // Function to change the text color of the Patient Name field when clicking outside
    $(document).on('click', function (e) {
      if (!$(e.target).is("#patientName") && $("#patientName").val() === '') {
        $("#patientName").css('color', '#000');
        $("#patient_name").html("");
      }
    });

    // Variable to store the reference to the timeout for searching patient IDs
    let patientIdTimeout;

    // AJAX code for searching patients by ID
    $("#patientSearch").on('keyup', function () {
    clearTimeout(patientIdTimeout); // Clear any existing timeout
    var value = $(this).val().trim();
    
    if (value !== '') {
      patientIdTimeout = setTimeout(function() {
        $.ajax({
          url: "{{ route('search.patientsid') }}",
          type: "POST",
          data: { 'patient_id': value },
          success: function (data) {
            $("#patient_id").html(data).show(); // Show suggestions
          }
        });
      }, 500);
    } else {
      $("#patient_id").html("").hide(); // Clear and hide suggestions
    }
  });

    // Event handler for patient ID selection
    $(document).on('click', '#patient_id li', function () {
        var selectedPatientId = $(this).text().trim();
        $("#patientSearch").val(selectedPatientId);

        // Trigger AJAX request to fetch patient name
        fetchPatientName(selectedPatientId);

        // Fetch doctor name and appointment date
        fetchDoctorInfo(selectedPatientId);
    });

    // Function to fetch doctor name and appointment date using AJAX
    function fetchDoctorInfo(patientId) {
        $.ajax({
            url: "{{ route('get.doctor.info') }}",
            type: "POST",
            data: { 'patient_id': patientId },
            success: function (data) {
                // Update doctor name and appointment date fields
                $("#doctorName").val(data.doctor);
                $("#date").val(data.appointment_date);
            }
        });
    }
      // Function to fetch patient name using AJAX
      function fetchPatientName(patientId) {
        $.ajax({
            url: "{{ route('get.patient.name') }}", // Replace with actual route
            type: "POST",
            data: { 'patient_id': patientId },
            success: function (data) {
                // Once fetched, populate the patient name input field
                populatePatientName(data);
            }
        });
    }

      // Function to populate patient name input field
      function populatePatientName(patientName) {
        $("#patientName").val(patientName); // Set the patient name input field
        $("#patientSearch").css('color', '#000'); // Change text color
        $("#patient_id").hide(); // Hide suggestions
    }


    // Variable to store the reference to the timeout for searching test names
    let testNameTimeout;

  // Bind keyup event to document for test name input
  $("#testName").on('keyup', function () {
    clearTimeout(testNameTimeout); // Clear any existing timeout
    var value = $(this).val().trim();
    
    if (value !== '') {
      testNameTimeout = setTimeout(function() {
        $.ajax({
          url: "{{ route('search.tests') }}",
          type: "POST",
          data: { 'test_name': value },
          success: function (data) {
            $("#test_name_suggestions").html(data).show(); // Show suggestions
          }
        });
      }, 500);
    } else {
      $("#test_name_suggestions").html("").hide(); // Clear and hide suggestions
    }
  });



    // Click event handler for selecting test name
    $(document).on('click', '#test_name_suggestions li', function (event) {
    event.preventDefault();
    var value = $(this).text();
    if (value !== 'No Data Found') {
      $("#testName").val(value);
      $("#test_name_suggestions").html("");
      $("#test_name_suggestions").hide();

      $.ajax({
        url: "{{ route('get.test.charges') }}",
        type: "POST",
        data: { 'test_name': value },
        success: function (data) {
          $("#charges").val(data);
          $("#charges").prop("readonly", true);
        }
      });

      // Change the text color of the selected test name and charges
      $("#testName").css('color', '#000');
      $("#charges").css('color', '#000');
    }
  });

  // Add Test button click event handler
  $(document).on('click', '#addTestButton', function () {
    const testName = $("#testName").val();
    const charges = $("#charges").val();
    if (testName && charges) {
      const row = `
        <tr>
          <td>${testName}</td>
          <td>${charges}</td>
        </tr>
      `;
      $("#testTableBody").append(row);
     
      $("#testName").val("");
      $("#charges").val("");
     
      $("#testName").css('color', '#000');
      
      $("#test_name_error").html("");
    } else {
     
      $("#test_name_error").html("Please enter a valid test name.");
    }
  });
});


 

</script>

</body>
</html>
