<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment</title>
  @include('receptionist.css')
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Your+Selected+Font|Another+Font">

  <style>
    .rightsidebar {
    position: fixed;
    top: 60px;
    right: -300px;
    width: 300px;
    height: 100%;
    background: linear-gradient(to bottom, #4a90e2, #2c3e50); 
    color: #fff; 
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5); 
    transition: right 0.3s ease;
    overflow: auto;
}

.rightsidebar.open {
    right: 0;
}

.rightsidebar-content {
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    height: 100%;
    padding: 20px;
}

.section-title {
    font-family: 'Your Selected Font', sans-serif;
    font-size: 24px;
    color: #fff;
    margin-bottom: 10px;
    text-transform: uppercase;
}

p {
    font-family: 'Another Font', sans-serif;
    font-size: 18px;
    margin: 5px 0;
    color: #eee; 
    line-height: 1.5;
}

hr {
    border: none;
    border-top: 1px solid #ddd; /* Light gray separator */
    margin: 10px 0;
}

.checkout-button {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #e74c3c; /* Red background for buttons */
    color: #fff;
    border: none;
    cursor: pointer;
    margin-top: 10px;
    font-size: 18px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.checkout-button:hover {
    background-color: #c0392b; /* Darker red on hover */
}

.checkout-button.cash {
    background-color: #e67e22; /* Orange background for cash option */
}

.checkout-button.card {
    background-color: #2ecc71; /* Green background for card option */
}

    </style>
</head>
<body>
  <div class="container-scroller">
    @include('receptionist.sidebar')
    @include('receptionist.navbar')
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12" style="margin-top: 100px;">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label for="patientIdInput">Patient ID:</label>
                <input type="text" id="patientIdInput" class="form-control" required style="background-color:white; !important">
              </div>
              <button type="button" class="btn btn-success" id="searchButton">Search</button>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-md-12">
          <div class="card mb-4">
            <div class="card-body">
              <h4 class="card-title">Patient Record</h4>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tbody>
                    @foreach ($appointments as $appointment)
                      <tr>
                        <td>Patient ID:</td>
                        <td>{{ $appointment->patient_id }}</td>
                        <td>Patient Name:</td>
                        <td>{{ $appointment->name }}</td>
                      </tr>
                      @break
                    @endforeach
                  </tbody>
                </table>
              </div>
              <h4 class="card-title">Patient Appointments</h4>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Doctor Name</th>
                      <th>Doctor Charges</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $totalAppointmentCharges = 0;
                    @endphp

                    @foreach ($appointments as $appointment)
                      <tr>
                        <td>{{ $appointment->doctor }}</td>
                        <td>{{ $appointment->charges }}</td>
                      </tr>
                      @php
                        $totalAppointmentCharges += $appointment->charges;
                      @endphp
                    @endforeach
                  </tbody>
                </table>
              </div>
              <h4 class="card-title">Patient Reports</h4>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Test Name</th>
                      <th>Test Charges</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php
                      $totalReportCharges  = 0;
                    @endphp
                    @foreach ($reports as $report)
                      <tr>
                        <td>{{ $report->test_names }}</td>
                        <td>{{ $report->test->charges }}</td>
                      </tr>
                      @php
                        $totalReportCharges += $report->charges;
                      @endphp
                    @endforeach
                  </tbody>
                </table>
              </div>
              @php
                      $totalCharges  = $totalAppointmentCharges+$totalReportCharges;
                    @endphp
              
              <h4 class="card-title">Total Charges</h4>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <td colspan="2">Appointment Charges:</td>
                      <td colspan="2">{{ $totalAppointmentCharges }}</td>
                    </tr>
                    <tr>
                      <td colspan="2">Reports Charges:</td>
                      <td colspan="2">{{ $totalReportCharges }}</td>
                    </tr>
                    <tr>
                      <td colspan="2">Total Charges:</td>
                      <td colspan="2">{{ $totalCharges }}</td>
                    </tr>
                    <tr>
                      <td colspan="4" style="text-align: right;">
                      <button type="button" class="btn btn-primary" id="checkoutButton">Checkout</button>

                      </td>
                    </tr>
                  </tbody>
                </table>
             
                <button id="checkoutButton">Checkout</button>
<div id="rightsidebar" class="rightsidebar">
    <div class="rightsidebar-content">
        <div class="patient-info">
            <h4>Patient Name</h4>
            <p>John Doe</p>
            <h4>Patient ID</h4>
            <p>P12345</p>
        </div>
        <hr>
        <div class="appointment-section">
            <h3>Appointment Details</h3>
            <p>Doctor Name: Dr. Smith</p>
            <p>Appointment Charges: $50.00</p>
        </div>
        <div class="report-section">
            <h3>Report Charges</h3>
            <p>Report Charges: $25.00</p>
        </div>
        <hr>
        <div class="total-charges">
            <h3>Total Charges</h3>
            <p>Total Charges: $75.00</p>
        </div>
        <div class="payment-options">
            <h3>Payment Options</h3>
            <button class="checkout-button">Pay via Cash</button>
            <button class="checkout-button">Pay via Card</button>
        </div>
    </div>
</div>


              </div>
            </div>
          </div>
        </div>
      </div>

      @include('receptionist.script')
    </div>
  </div>
  <script>
$(document).ready(function() {
  $("#searchButton").click(function() {
    // Get the input value
    var searchTerm = $("#patientIdInput").val();
    
    // Make an AJAX request to the server
    $.ajax({
      type: "POST", // Use POST method
      url: "{{ route('receptionist.payment') }}", // Specify the URL
      data: {
        _token: "{{ csrf_token() }}", // Include CSRF token
        patient_id: searchTerm, // Include the search term
      },
      success: function(data) {
        // Update the content of different sections with the response data
        $(".card-body .table-responsive").html($(data).find(".card-body .table-responsive").html());
        $(".card-title:contains('Patient Record')").next(".table-responsive").html($(data).find(".card-title:contains('Patient Record')").next(".table-responsive").html());
        $(".card-title:contains('Patient Appointments')").next(".table-responsive").html($(data).find(".card-title:contains('Patient Appointments')").next(".table-responsive").html());
        $(".card-title:contains('Patient Reports')").next(".table-responsive").html($(data).find(".card-title:contains('Patient Reports')").next(".table-responsive").html());
        $(".card-title:contains('Total Charges')").next(".table-responsive").html($(data).find(".card-title:contains('Total Charges')").next(".table-responsive").html());
        console.log(data);
      },
      error: function(error) {
        console.error("Search failed:", error);
      }
    });
  });
});
const checkoutButton = document.getElementById('checkoutButton');
const rightSidebar = document.getElementById('rightsidebar');

// Click event listener for the Checkout button to open the sidebar
checkoutButton.addEventListener('click', function(event) {
    event.stopPropagation(); // Prevent the click event from propagating to the document
    rightSidebar.classList.add('open');
});

// Click event listener for the document to close the sidebar when clicking outside
document.addEventListener('click', function(event) {
    if (!rightSidebar.contains(event.target) && event.target !== checkoutButton) {
        rightSidebar.classList.remove('open');
    }
});


</script>


</body>
</html>
