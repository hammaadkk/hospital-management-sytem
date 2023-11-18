<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    table, th, td {
      text-align: center;
      padding: 10px 20px;
    }

    .firstrow {
      background-color: #00D9A5;
      border-top: 2px solid black;
    }

    .row2 {
      background-color: #2C3844;
      color: white;
    }

    .head1 {
      font-size: 40px;
      padding-top: 30px;
      padding-bottom: 20px;
      text-align: center;
      margin-left: 93px;
      margin-right: 93px;
      margin-top: 70px;
    }

    .main {
      margin-left: 40px;
    }

    /* Define different button colors for each status */
    .status-approved {
      background-color: #00FF00;
    }

    .status-cancelled {
      background-color: #FF0000;
    }

    .status-in_progress {
      background-color: #FFA500;
    }
    /* Modern-looking search box */
/* Modern-looking search box */
.modern-search {
  padding: 10px;
  border: none;
  border-radius: 30px;
  background-color: #f2f2f2;
  width: 100%;
  transition: background-color 0.3s, box-shadow 0.3s;
  color: black; /* Text color */
  font-size: 16px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

.modern-search:focus {
  outline: none;
  background-color: white; /* Change background color on focus */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Slightly stronger shadow on focus */
}

.modern-search::placeholder {
  color: #aaa; /* Placeholder text color */
}
  </style>
  @include('userdashboard.css')
</head>
<body>
<div class="container-scroller">
  <!-- partial:partials/_sidebar.html -->
  <!-- sidebar started -->
  @include('userdashboard.sidebar')
  <!-- sidebar ended -->
  <!-- partial -->
  <!-- navbar started -->
  @include('userdashboard.navbar')
  <!-- navbar ended -->
  <!-- partial -->
  <div class="page-section">
    <div class="container">
      <div class="head1">
        <h1>My Appointments</h1>
        <div class="search-container">
          <input type="text" id="searchInput" class="modern-search" placeholder="Search by Patient Name or Doctor Name">
        </div>

      </div>

      <div align="Center" class="main">
        <div class="d-flex">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="statusFilter" id="all" value="all" checked>
            <label class="form-check-label" for="all">All</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="statusFilter" id="inProgress" value="in_progress">
            <label class="form-check-label" for="inProgress">In Progress</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="statusFilter" id="approved" value="approved">
            <label class="form-check-label" for="approved">Approved</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="statusFilter" id="cancelled" value="cancelled">
            <label class="form-check-label" for="cancelled">Cancelled</label>
          </div>
        </div>

        <table>
          <tr class="firstrow">
            <th>Patient name</th>
            <th>Doctor name</th>
            <th>Date</th>
            <th width="300px">Message</th>
            <th>Status</th>
            <th>Cancel Appointment</th>
          </tr>

          @foreach($appoint as $appoints)
  @php
    $isCancelled = $appoints->status === 'Cancelled';
  @endphp
  <tr class="row2">
    <td>{{$appoints->name}}</td>
    <td>{{$appoints->doctor}}</td>
    <td>{{$appoints->date}}</td>
    <td>{{$appoints->message}}</td>
    <td>
      <button disabled
        @if ($appoints->status === 'approved')
          class="btn btn-success font-weight-bold status-approved"
        @elseif ($appoints->status === 'Cancelled')
          class="btn btn-danger font-weight-bold status-cancelled"
        @elseif ($appoints->status === 'in progress')
          class="btn btn-warning font-weight-bold status-in_progress"
        @endif
      >
        {{$appoints->status}}
      </button>
    </td>
    <td>
      @if (!$isCancelled)
        <a href="{{url('cancel_appoint',$appoints->id)}}" class="btn btn-danger"
           onclick="return confirm('Are you sure you want to cancel the Appointment...')">Cancel</a>
      @endif
    </td>
  </tr>
@endforeach
        </table>
      </div>
    </div>
  </div>

  @include('userdashboard.script')

  <script>
     function handleFilterChange() {
      var selectedStatus = document.querySelector('input[name="statusFilter"]:checked').value;
      var rows = document.querySelectorAll('.row2');

      if (selectedStatus === 'all') {
        rows.forEach(function (row) {
          row.style.display = 'table-row';
        });
        return;
      }

      rows.forEach(function (row) {
        var statusCell = row.querySelector('td:nth-child(5)'); // Adjust the index to match the status column
        var status = statusCell.textContent.trim().toLowerCase(); // Convert to lowercase for case-insensitive comparison

        if (selectedStatus === status.replace(' ', '_')) {
          row.style.display = 'table-row';
        } else {
          row.style.display = 'none';
        }
      });
    }

    // Attach the filter change event to the radio buttons
    var filterRadios = document.querySelectorAll('input[name="statusFilter"]');
    filterRadios.forEach(function (radio) {
      radio.addEventListener('change', handleFilterChange);
    });

    function handleSearch() {
      var searchValue = document.getElementById("searchInput").value.toLowerCase();
      var rows = document.querySelectorAll('.row2');

      rows.forEach(function (row) {
        var patientNameCell = row.querySelector('td:nth-child(1)'); // Adjust the index to match the patient name column
        var doctorNameCell = row.querySelector('td:nth-child(2)'); // Adjust the index to match the doctor name column
        var statusCell = row.querySelector('td:nth-child(5)'); // Adjust the index to match the status column

        var patientName = patientNameCell.textContent.trim().toLowerCase();
        var doctorName = doctorNameCell.textContent.trim().toLowerCase();
        var status = statusCell.textContent.trim().toLowerCase();

        if (
          patientName.includes(searchValue) ||
          doctorName.includes(searchValue) ||
          status.includes(searchValue)
        ) {
          row.style.display = 'table-row';
        } else {
          row.style.display = 'none';
        }
      });
    }

    // Attach the search input event
    var searchInput = document.getElementById("searchInput");
    searchInput.addEventListener('input', handleSearch);
  </script>

  <!-- End custom js for this page -->
  <!-- script ended -->
</body>
</html>
