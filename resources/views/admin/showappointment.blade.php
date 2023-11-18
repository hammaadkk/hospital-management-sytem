<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
      table {
        width: 100%;
        border-collapse: collapse;
        margin-left: -70px;
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
      @include('admin.sidebar')
      @include('admin.navbar')
      <div class="container-fluid page-body-wrapper">
        <div style="padding-top: 30px;">
          <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search by Customer name or Status" onkeyup="handleSearch(event)">
            <button type="button" id="searchButton">Search</button>
          </div>
          <table id="nurseTable">
            <tr class="header-row">
              <th>Customer name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Doctor Name</th>
              <th>Date</th>
              <th>Message</th>
              <th>Status</th>
              <th>Actions</th>
              <th>Send Mail</th>
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
                  @endif
                >
                  {{$appoint->status}}
                </button>
              </td>
              <td class="btn-container"><a href="{{url('approved', $appoint->id)}}" class="btn btn-success">Approved</a>
              <a href="{{url('Cancelled', $appoint->id)}}" class="btn btn-danger">Cancelled</a></td>
              <td><a href="{{url('emailview', $appoint->id)}}" class="btn btn-primary">Send Mail</a></td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
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
      });
    </script>
  </body>
</html>
