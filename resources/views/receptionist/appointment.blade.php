<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  @include('receptionist.css')
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
        <table id="nurseTable">
          <tr class="header-row">
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Doctor</th>
            <th>Date</th>
            <th>Message</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          @foreach($data as $appoint)
          <tr class="data-row">
            <td>{{$appoint->name}}</td>
            <td>{{$appoint->email}}</td>
            <td>{{$appoint->phone}}</td>
            <td>{{$appoint->doctor}}</td>
            <td>{{$appoint->date}}</td>
            <td>{{$appoint->message}}</td>
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
            <td>
              @if ($appoint->status === 'approved')
                <a href="#" class="btn btn-success print-button" data-name="{{$appoint->name}}" data-email="{{$appoint->email}}" data-phone="{{$appoint->phone}}" data-doctor="{{$appoint->doctor}}" data-date="{{$appoint->date}}" data-message="{{$appoint->message}}">Print</a>
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
  <!-- container-scroller -->
  <!-- plugins:js -->
  @include('receptionist.script')
  <!-- End custom js for this page -->
  <script>
    function handleSearch() {
      searchAppointments();
    }

    function searchAppointments() {
      var value = $("#searchInput").val().toLowerCase();
      $("#nurseTable .data-row").filter(function() {
        var name = $(this).children("td:nth-child(1)").text().toLowerCase();
        var status = $(this).children("td:nth-child(7)").text().toLowerCase();
        var showRow = name.indexOf(value) > -1 || status.indexOf(value) > -1;
        $(this).toggle(showRow);
      });

      // Show all rows if search input is empty
      if (value === "") {
        $("#nurseTable .data-row").show();
      }
    }

    $(document).ready(function() {
      $("#searchButton").click(searchAppointments);

      // Live search as you type
      $("#searchInput").on("input", searchAppointments);

      $(".print-button").click(function(e) {
        e.preventDefault();
        var name = $(this).data("name");
        var email = $(this).data("email");
        var phone = $(this).data("phone");
        var doctor = $(this).data("doctor");
        var date = $(this).data("date");
        var message = $(this).data("message");

        // Generate printable page content with CSS styles
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
            
            .details {
              display: flex;
              justify-content: space-between;
              margin-bottom: 20px;
            }
            
            .details-column {
              flex-basis: 50%;
            }
            
            .details-column p {
              margin: 5px 0;
            }
          </style>
          <h1>Appointment Details</h1>
          <div class="details">
            <div class="details-column">
              <p><strong>Name:</strong> ${name}</p>
              <p><strong>Phone:</strong> ${phone}</p>
            </div>
            <div class="details-column">
              <p><strong>Email:</strong> ${email}</p>
              <p><strong>Doctor:</strong> ${doctor}</p>
              <p><strong>Date:</strong> ${date}</p>
            </div>
          </div>
          
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
    });
  </script>
  </body>
</html>
