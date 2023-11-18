<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  @include('receptionist.css')
  <style>
    table {
    
      margin-left:-90px;
     
    }

    th,
    td {
      padding: 10px;
      text-align: center;
      border: 1px solid #ddd;
    }

    .header-row {
      background-color: #00d9a5;
      color: black;
    }

    .data-row {
      background-color: #f7f7f7;
      color: black;
      font-family: "Helvetica Neue", Arial, sans-serif;
      font-size: 14px;
    }

    .data-row:nth-child(even) {
      background-color: #e6e6e6;
      color: black;
    }


    .btn-container {
      display: flex;
      justify-content: center;
    }

    .btn-container a {
      margin: 5px;
    }

    .search-container {
      text-align: center;
      margin-bottom: 20px;
    }

    .search-container input[type="text"] {
      padding: 10px;
      width: 300px;
      color: black;
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 4px;
      margin-right: 10px;
    }

    .search-container button {
      padding: 10px;
      background-color: #00d9a5;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    /* New styles for print page */
    .print-container {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .print-left {
      flex-basis: 50%;
    }

    .print-right {
      flex-basis: 50%;
      text-align: right;
    }

    .print-line {
      margin-top: 20px;
      margin-bottom: 20px;
      border-top: 1px solid #333;
    }

    .print-rx {
      font-weight: bold;
      margin-bottom: 10px;
      font-size: 60px;
      color: rgba(0, 0, 0, 0.3);
      text-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
    }
    .hidden {
      display: none;
    }
  </style>
</head>
<body>
  <div class="container-scroller">
  @include('receptionist.sidebar')
    @include('receptionist.navbar')

    <div class="container-fluid page-body-wrapper">
      <div style="padding-top: 30px;">
        <div class="search-container">
          <input type="text" id="searchInput" placeholder="Search by Customer name or Status">
          <button type="button" id="searchButton">Search</button>
        </div>
        <div class="radio-container" style="margin-left:255px; margin-bottom:20px;">
        <label class="show-all-label">
            <input type="radio" name="statusFilter" value="ShowAll">  All
          </label>
          <label>
            <input type="radio" name="statusFilter" value="Cancelled"> Cancelled
          </label>
          <label>
            <input type="radio" name="statusFilter" value="Pending"> Pending
          </label>
          <label>
            <input type="radio" name="statusFilter" value="Approved"> Approved
          </label>
        </div>
        <table id="nurseTable">
          <tr class="header-row">
           
            <th>Patient ID</th>
            
            <th width="300px">Name</th>
            <th>Cnic No</th>
            <th>Father Name</th>
            <th>Phone</th>
            <th>Doctor</th>
            <th>Date</th>
            <th>Status</th>
            <th width="300px">Action</th>
          </tr>
          @foreach($data as $appoint)
            <tr class="data-row" data-status="{{$appoint->status}}">
              
            <td>
      @if(isset($appoint->patient_id))
        {{$appoint->patient_id}}
      @else
        {{$appoint->id}}
      @endif
    </td>
              
              <td>{{$appoint->name}}</td>
              <td>{{$appoint->cnic_no}}</td>
              <td>{{$appoint->father_name}}</td>
              <td>{{$appoint->phone}}</td>
              <td>{{$appoint->doctor}}</td>
              <td>{{$appoint->date}}</td>
              <td>
                <button disabled
                  @if ($appoint->status === 'approved')
                    class="btn btn-success font-weight-bold"
                  @elseif ($appoint->status === 'Cancelled')
                    class="btn btn-danger font-weight-bold"
                  @elseif ($appoint->status === 'in progress')
                    class="btn btn-warning font-weight-bold"
                  @endif>
                  {{$appoint->status}}
                </button>
              </td>
              <td style="display: none;">
                @if(isset($appoint->user_id) && isset($appoint->id))
                  Registered
                @else
                  Not Registered
                @endif
              </td>
              <td>
                @if ($appoint->status === 'approved')
                  <a href="#" class="btn btn-success print-button" data-userid="{{ isset($appoint->patient_id) ? $appoint->patient_id : 'Not assigned' }}" data-name="{{$appoint->name}}" data-father_name="{{$appoint->father_name}}" data-phone="{{$appoint->phone}}" data-doctor="{{$appoint->doctor}}" data-date="{{$appoint->date}}" data-message="{{$appoint->message}}" data-cnic="{{$appoint->cnic_no}}">Print</a>
              



      @endif
              </td>
            </tr>
          @endforeach
        </table>
        <!-- Hidden iframe for printing -->
        <iframe id="printFrame" style="display:none;"></iframe>
      </div>
    </div>
  </div>

  
  <script>
   function handleSearch() {
    searchAppointments();
  }

  function handleSearch() {
      searchAppointments();
    }

    function searchAppointments() {
      var searchValue = $("#searchInput").val().toLowerCase();
      var status = $("input[name='statusFilter']:checked").val();

      $("#nurseTable .data-row").filter(function() {
        var name = $(this).children("td:nth-child(2)").text().toLowerCase();
        var cnic = $(this).children("td:nth-child(3)").text().toLowerCase();
        var rowStatus = $(this).attr("data-status").toLowerCase();

        var nameMatch = name.indexOf(searchValue) > -1;
        var cnicMatch = cnic.indexOf(searchValue) > -1;

        var showRow = (nameMatch || cnicMatch) && (status === undefined || status === "ShowAll" || (status === "Pending" && (rowStatus === "pending" || rowStatus === "in progress")) || rowStatus === status.toLowerCase());
        $(this).toggle(showRow);
      });

      // Show all rows if search input and status filter are empty
      if (searchValue === "" && status === undefined) {
        $("#nurseTable .data-row").show();
      }
    }

    $(document).ready(function() {
      $("#searchButton").click(searchAppointments);
      $("#searchInput").on("input", searchAppointments);
      $("input[name='statusFilter']").change(searchAppointments);

    $(".print-button").click(function (e) {
      e.preventDefault();
      var id = $(this).closest("tr").children("td:nth-child(1)").text();
      var userId = $(this).data("userid");
      var name = $(this).data("name");
      var father_name = $(this).data("father_name");
      var phone = $(this).data("phone");
      var doctor = $(this).data("doctor");
      var date = $(this).data("date");
      var message = $(this).data("message");
      var cnic = $(this).data("cnic");

      var currentDate = new Date().toLocaleDateString();
  var content = `
    <style>
      body {
        font-family: Arial, sans-serif;
        color: #333;
        margin: 0;
        padding: 20px;
      }
      
      h1 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
      }
      
      .print-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
      }
      
      .print-left {
        flex-basis: 50%;
      }
      
      .print-right {
        flex-basis: 50%;
        text-align: right;
      }
      
      .print-line {
        margin-top: 20px;
        margin-bottom: 20px;
        border-top: 1px solid #333;
      }
      
      .print-rx {
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 60px;
        color: rgba(0, 0, 0, 0.3);
        text-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
      }
    </style>
    
    <div class="print-container">
      <div class="print-left">
        <h1>Hospital name</h1>
        <sub>Tagline</sub>
        <p>Patient ID: ${userId}</p>
        <p>ID: ${id}</p>
        <p>Date: ${date}</p>
        </div>
        <div class="print-right">
        <h1>Doctor: ${doctor}</h1>
        <p>Name: ${name}</p>
        <p>Father Name: ${father_name}</p>
        <p>Phone: ${phone}</p>
        <p>CNIC: ${cnic}</p>
        
      </div>
    </div>
    <div class="print-line"></div>
    <p class="print-rx" style="font-weight:100;">RX</p>
  `;

  // Set the content of the hidden iframe
  var printFrame = $("#printFrame")[0].contentWindow;
  printFrame.document.open();
  printFrame.document.write(content);
  printFrame.document.close();

  // Trigger print functionality of the iframe
  printFrame.focus();
  printFrame.print();

}); 

$(".visit-button").click(function() {
    var appointmentId = $(this).data("appointment-id");
    var patientId = $(this).data("patient-id");
    
    $.ajax({
        url: "/storeCheckin",
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        data: {
            appointment_id: appointmentId,
            patient_id: patientId
        },
        success: function(response) {
            console.log("Check-in data stored successfully");
        },
        error: function(xhr, status, error) {
            console.error("Error storing check-in data:", error);
        }
    });
});

  });
  </script>
</body>
</html>
