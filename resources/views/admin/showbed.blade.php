<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
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

        .search-container select {
            padding: 8px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            color: black;
            background-color: #fff;
            width: 200px;
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
                    <select id="wardFilter" onchange="handleWardFilter()">
                        <option value="">All Wards</option>
                        @foreach($gn as $gnn)
                            <option value="{{ $gnn->id }}">{{ $gnn->name }}</option>
                        @endforeach
                    </select>
                </div>
                <table id="nurseTable">
                    <tr class="header-row">
                        <th>General Ward Name</th>
                        <th>Bed Number</th>
                        <th>Availibility</th>
                        <th>Action</th>
                    </tr>
                    @foreach($data as $bed)
                        <tr class="data-row" data-ward-id="{{ $bed->general_ward_id }}">
                            <td>
                                @foreach($gn as $gnn)
                                    @if($gnn->id == $bed->general_ward_id)
                                        {{ $gnn->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $bed->bed_number }}</td>
                            <td>{{ $bed->availibility }}</td>
                            <td>
                                <div class="btn-container">
                                    <a onclick="return confirm('Are you sure to delete this bed?')"
                                       href="{{ url('deletebed', $bed->id) }}" class="btn btn-danger">Delete</a>
                                    <a href="{{ url('updatebed', $bed->id) }}" class="btn btn-primary">Update</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.script')

<script>
    function handleWardFilter() {
        const wardFilter = document.getElementById("wardFilter");
        const selectedWardId = wardFilter.value;
        const rows = document.getElementsByClassName("data-row");

        for (let i = 0; i < rows.length; i++) {
            const wardId = rows[i].getAttribute("data-ward-id");

            if (selectedWardId === "" || wardId === selectedWardId) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
</script>
</body>
</html>
