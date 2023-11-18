<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  @include('labassistant.css')
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
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

    img {
      border-radius: 50%;
      width: 50px;
      height: 50px;
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

    /* Custom styles for file input and upload button */
    .upload-file-button {
      display: none; /* Hide the default file input */
    }

    .custom-file-input {
      display: inline-block;
      padding: 8px 12px;
      cursor: pointer;
      background-color: #00d9a5;
      color: white;
      border: none;
      border-radius: 4px;
      transition: background-color 0.3s ease;
    }

    .custom-file-input:hover {
      background-color: #00c49a;
    }

    .upload-button {
      padding: 8px 12px;
      background-color: #00d9a5;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .upload-button:hover {
      background-color: #00c49a;
    }

    .file-name {
      display: inline-block;
      margin-top: 5px;
    }
  </style>
</head>
<body>
  <div class="container-scroller">
    @include('labassistant.sidebar')
    @include('labassistant.navbar')
    <div class="container-fluid page-body-wrapper">
      <div class="container" align="center" style="padding-top: 10px;">
        @if(session()->has('message'))
        <div class="alert alert-success">
          <button type="button" class="close" data-bs-dismiss="alert">x</button>
          {{ session()->get('message') }}
        </div>
        @endif

        @if(session()->has('error'))
        <div class="alert alert-danger">
          <button type="button" class="close" data-bs-dismiss="alert">x</button>
          {{ session()->get('error') }}
        </div>
        @endif

        <div style="padding-top: 30px;">
          <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search by Customer name or Status">
            <button type="button" id="searchButton">Search</button>
          </div>
          <div class="radio-container" style="margin-left: -70px; margin-bottom: 20px;">
            <label>
              <input type="radio" name="statusFilter" value="All"> All
            </label>
            <label>
              <input type="radio" name="statusFilter" value="In process"> In process
            </label>
            <label>
              <input type="radio" name="statusFilter" value="Uploaded"> Uploaded
            </label>
          </div>
          <table id="nurseTable">
      <tr class="header-row">
        <th>Patient Id</th>
        <th>Patient Name</th>
        <th>Date of Appointment</th>
        <th>Doctor</th>
        <th>Status</th>
        <th>Upload File</th>
        <th>Action</th>
      </tr>
      @foreach($reports as $report)
      <tr class="data-row" data-status="{{ $report->status }}">
        <td>{{ $report->patient_id }}</td>
        <td>{{ $report->patient_name }}</td>
        <td>{{ $report->appointment_date }}</td>
        <td>{{ $report->doctor }}</td>
        <td>{{ $report->status }}</td>
        <td>
          @if ($report->status === 'Uploaded')
            {{ $report->file }}
          @else
            <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <label for="file-upload-{{ $report->id }}" class="custom-file-input">Choose File</label>
              <input type="file" id="file-upload-{{ $report->id }}" name="file" accept=".pdf,.doc,.docx" class="upload-file-button">
              <div class="file-name"></div>
          @endif
        </td>
        <td>
          <input type="hidden" name="report_id" value="{{ $report->id }}">
          @if ($report->status !== 'Uploaded')
            <button type="submit" class="upload-button" style="background-color: #00d9a5;">Upload</button>
          </form>
          @else
            @if (Storage::exists($report->file))
              <a href="{{ Storage::url($report->file) }}" class="btn btn-primary" download>Download</a>
            @else
              File not found
            @endif
          @endif
        </td>
      </tr>
      @endforeach
    </table>
          <!-- Hidden iframe for printing -->
          <iframe id="printFrame" style="display: none;"></iframe>
        </div>
      </div>
    </div>
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  @include('labassistant.script')
  <script>

$(document).ready(function() {
    // Function to show selected file name
    function showFileName(input) {
        var fileName = input.files[0].name;
        $(input).next(".file-name").text(fileName);
    }

    // Trigger the function when a file is selected
    $(".upload-file-button").change(function() {
        showFileName(this);
    });

    function handleSearch() {
        searchAppointments();
    }

    function searchAppointments() {
        var value = $("#searchInput").val().toLowerCase();
        var status = $("input[name='statusFilter']:checked").val();

        $("#nurseTable .data-row").filter(function() {
            var name = $(this).children("td:nth-child(2)").text().toLowerCase(); // Patient Name column
            var id = $(this).children("td:first-child").text().toLowerCase(); // Patient ID column
            var rowStatus = $(this).attr("data-status").toLowerCase();
            var showRow =
                (name.indexOf(value) > -1 || id.indexOf(value) > -1 || rowStatus.indexOf(value) > -1) &&
                (status === undefined ||
                (status === "In process" && (rowStatus === "in process" || rowStatus === "inprogress")) ||
                rowStatus === status.toLowerCase() ||
                status === "All");
            $(this).toggle(showRow);
        });

        // Show all rows if search input and status filter are empty
        if (value === "" && status === undefined) {
            $("#nurseTable .data-row").show();
        }
    }

    $(document).ready(function() {
        $("#searchButton").click(handleSearch);

        // Live search as you type
        $("#searchInput").on("input", handleSearch);

        $("input[name='statusFilter']").change(handleSearch);
    });
});
  </script>
</body>
</html>
