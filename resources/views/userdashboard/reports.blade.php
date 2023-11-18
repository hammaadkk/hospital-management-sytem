<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
      margin-top: 80px;
    }
    
    table {  
      margin-right: auto;
    }

    /* Modern-looking datepicker */
    #datepicker {
      background-color: #f5f5f5;
      border: 1px solid #ccc;
      border-radius: 4px;
      padding: 8px;
      color: black;
    }
    .filter-container {
      display: flex;
      align-items: center;
      justify-content: flex-start;
      gap: 20px;
    }
    
    .radiobtn {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 20px;
      margin-left: auto;
      margin-right: auto;
    }
    
  </style>
  @include('userdashboard.css')
</head>
<body>
<div class="container-scroller">
  @include('userdashboard.sidebar')
  @include('userdashboard.navbar')

  <div class="page-section">
    <div class="container">
      <div class="head1">
        <h1>My Reports</h1>
      </div>
      
      <div class="filter-container">
        <label for="datepicker">Select Date</label>
        <input type="text" id="datepicker" placeholder="Search reports by dates" style="color: black;">
      </div>
      <div class="radiobtn">
        <input type="radio" name="statusFilter" value="all" id="filterAll" checked>
        <label for="filterAll">All</label>
        <input type="radio" name="statusFilter" value="uploaded" id="filterUploaded">
        <label for="filterUploaded">Uploaded</label>
        <input type="radio" name="statusFilter" value="inprocess" id="filterInProcess">
        <label for="filterInProcess">In Process</label>
      </div>

      <div align="Center">
        <table>
          <tr class="firstrow">
            <th>Patient id</th>
            <th>Patient name</th>
            <th>Date of appointment</th>
            <th>Doctor</th>
            <th>Status</th>
            <th>Report</th>
            <th>Action</th>
          </tr>
          @foreach($report as $reports)
  <tr class="row2 appointment-row"> 
    <td>{{$reports->patient_id}}</td>
    <td>{{$reports->patient_name}}</td>
    <td>{{$reports->appointment_date}}</td>
    <td>{{$reports->doctor}}</td>
    <td class="status">
      @if (empty($reports->file))
        Not uploaded yet
      @else
        {{$reports->status}}
      @endif
    </td>
    <td class="file"> 
      {{$reports->file}}
    </td>
    <td>
      @if (!empty($reports->file))
        <a href="{{ Storage::url($reports->file) }}" class="btn btn-primary" download>Download</a>
      @endif
    </td>
  </tr>
@endforeach

        </table>
      </div>
    </div>
  </div>

  @include('userdashboard.script')
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      flatpickr("#datepicker", {
        dateFormat: "Y-m-d",
        onChange: function (selectedDates, dateStr) {
          const selectedStatus = document.querySelector('input[name="statusFilter"]:checked').value;
          filterAppointments(selectedStatus, new Date(dateStr));
        },
      });
    });

    function filterAppointments(status, selectedDate) {
      const rows = document.querySelectorAll('.appointment-row');

      rows.forEach(row => {
        const statusCell = row.querySelector('.status');
        const dateCell = row.querySelector('td:nth-child(3)');

        const currentDate = new Date(dateCell.innerText);
        const isSelectedDate = !selectedDate || currentDate.toDateString() === selectedDate.toDateString();

        if ((status === 'all' || (status === 'uploaded' && statusCell.innerText.trim() === 'Uploaded') || (status === 'inprocess' && statusCell.innerText.trim() === 'Not uploaded yet')) && isSelectedDate) {
          row.style.display = 'table-row';
        } else {
          row.style.display = 'none';
        }
      });
    }

    const filterRadios = document.querySelectorAll('input[name="statusFilter"]');
    filterRadios.forEach(radio => {
      radio.addEventListener('change', () => {
        const selectedStatus = document.querySelector('input[name="statusFilter"]:checked').value;
        const selectedDate = document.querySelector('#datepicker').value ? new Date(document.querySelector('#datepicker').value) : null;
        filterAppointments(selectedStatus, selectedDate);
      });
    });

    document.querySelector('#datepicker').addEventListener('change', () => {
      const selectedStatus = document.querySelector('input[name="statusFilter"]:checked').value;
      const selectedDate = document.querySelector('#datepicker').value ? new Date(document.querySelector('#datepicker').value) : null;
      filterAppointments(selectedStatus, selectedDate);
    });
  </script>
</body>
</html>