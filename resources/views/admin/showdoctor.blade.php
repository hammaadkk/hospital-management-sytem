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
      font-weight: bold;
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
      width: 70px;
      height: 70px;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      border-radius: 50%;
      margin-left:50px;
    }
    .image-cell img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .btn-container {
      display: flex;
      justify-content: center;
    }

    .btn-container a {
      margin: 5px;
      text-decoration: none;
      font-size: 14px;
      padding: 6px 12px;
      border-radius: 4px;
    }

    .btn-danger {
      background-color: #ff5c5c;
      color: white;
      border: none;
    }

    .btn-danger:hover {
      background-color: #d14444;
    }

    .btn-primary {
      background-color: #007bff;
      color: white;
      border: none;
    }

    .btn-primary:hover {
      background-color: #0056b3;
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
      transition: border-color 0.3s, background-color 0.3s;
    }

    .search-container button {
      padding: 8px 15px;
      border: none;
      border-radius: 5px;
      background-color: #00d9a5;
      color: white;
      font-size: 14px;
    }

    .search-container input[type="text"]:focus {
      border-color: #00d9a5;
      background-color: #fff;
    }

    .search-container button:hover {
      background-color: #007d71;
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
              <input
                type="text"
                id="searchInput"
                placeholder="Search by doctor name or speciality"
                onkeyup="handleSearch(event)"
              />
              <button type="button" id="searchButton">Search</button>
            </div>
            <table id="doctorsTable">
              <tr class="header-row">
                <th width="200px">Doctor name</th>
                <th width="200px">Phone</th>
                <th>Speciality</th>
                <th>Room no</th>
                <th width="200px">Image</th>
                <th>Delete</th>
                <th>Update</th>
              </tr>
              @foreach($data as $doctor)
              <tr class="data-row">
                <td>{{ $doctor->name }}</td>
                <td>{{ $doctor->phone }}</td>
                <td>{{ $doctor->speciality }}</td>
                <td>{{ $doctor->room }}</td>
                <td>
                  <div class="image-cell">
                    <img src="doctorimage/{{ $doctor->image }}" alt="Doctor Image" />
                  </div>
                </td>
                <td>
                  <a
                    onclick="return confirm('Are you sure to delete this doctor?')"
                    href="{{ url('deletedoctor', $doctor->id) }}"
                    class="btn btn-danger"
                  >
                    Delete
                  </a>
                </td>
                <td>
                  <a href="{{ url('updatedoctor', $doctor->id) }}" class="btn btn-primary">Update</a>
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

      if (name.includes(searchValue)) {
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

      if (name.includes(searchValue)) {
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
