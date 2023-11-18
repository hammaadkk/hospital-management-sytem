<!DOCTYPE html>
<html lang="en">
  <head>
    <style>
      table {
        width: 100%;
        border-collapse: collapse;
      }

      th,
      td {
        padding: 10px 20px;
        text-align: center;
        border: 1px solid #ddd;
      }

      .header-row {
        background-color: #00d9a5;
        border-top: 2px solid black;
        color: black;
        text-align: center;
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

      .image-cell {
        width: 100px;
        height: 100px;
        
      }

      .image-cell img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
      }
      .btn-container {
        display: flex;
        justify-content: center;
      }

      .btn-container a {
        margin: 5px;
      }

      .search-container {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        margin-bottom: 20px;
      }

      .search-container input[type="text"] {
        padding: 8px;
        border: none;
        border-radius: 5px;
        width: 300px;
        margin-right: 10px;
        font-size: 14px;
        color: black;
      }

      .search-container button {
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        background-color: #00d9a5;
        color: white;
        font-size: 14px;
      }
    </style>
    <!-- Required meta tags -->
    @include('admin.css')
    
  </head>
  <body>
    <div class="container-scroller">
      @include('admin.sidebar')
      @include('admin.navbar')

      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row">
            <div class="search-container">
              <input type="text" id="searchInput" placeholder="Search by Lab Assistant name or Employee Id" onkeyup="handleSearch(event)">
              <button type="button" id="searchButton">Search</button>
            </div>
            <table id="nurseTable">
            <tr class="header-row">
              <th>Room Number</th>
              <th>Availibility</th>
              <th>Actions</th>
            </tr>
            @foreach($data as $room)
            <tr class="data-row">
                <td>{{ $room->room_number }}</td>
                <td>{{ $room->availibility }}</td>
                <td>
                  <div class="btn-container">
                    <a onclick="return confirm('Are you sure to delete this room?')" href="{{ url('deleteroom', $room->id) }}" class="btn btn-danger">Delete</a>
                    <a href="{{ url('updateroom', $room->id) }}" class="btn btn-primary">Update</a>
                  </div>
                </td>
              </tr>

            @endforeach
          </table>
          </div>
        </div>
      </div>
    </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->

    <script>
      function handleLiveSearch(event) {
        const searchValue = event.target.value.toLowerCase();
        const doctorsTable = document.getElementById("doctorsTable");
        const rows = doctorsTable.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
          const name = rows[i].cells[0].innerText.toLowerCase();
          const employeeId = rows[i].cells[3].innerText.toLowerCase();

          if (name.includes(searchValue) || employeeId.includes(searchValue)) {
            rows[i].style.display = "";
          } else {
            rows[i].style.display = "none";
          }
        }
      }

      function handleSearch(event) {
        if (event.keyCode === 13) {
          searchDoctors();
        }
      }

      function searchDoctors() {
        const searchValue = document.getElementById("searchInput").value.toLowerCase();
        const doctorsTable = document.getElementById("doctorsTable");
        const rows = doctorsTable.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
          const name = rows[i].cells[0].innerText.toLowerCase();
          const specialty = rows[i].cells[2].innerText.toLowerCase();

          if (name.includes(searchValue) || specialty.includes(searchValue)) {
            rows[i].style.display = "";
          } else {
            rows[i].style.display = "none";
          }
        }

        // Show all rows if search input is empty
        if (searchValue === "") {
          for (let i = 1; i < rows.length; i++) {
            rows[i].style.display = "";
          }
        }
      }

      function clearSearch() {
        document.getElementById("searchInput").value = "";
        searchDoctors();
      }

      // Attach event listener to search input for live search
      const searchInput = document.getElementById("searchInput");
      searchInput.addEventListener("keyup", handleLiveSearch);

      // Attach event listener to search button
      const searchButton = document.getElementById("searchButton");
      searchButton.addEventListener("click", searchDoctors);

     
    </script>
  </body>
</html>