<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .error-message {
            color: red;
            font-weight: bold;
        }

        #bedNoInput {
            background-color: #fff;
            color: #000;
        }
        #ageSelect{
            background-color: #fff;
            color: #000;
        }
        
        #bedNoInput {
            background-color: #fff;
            color: #000;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="time"] {
            background-color: #fff;
            color: #000;
            transition: background-color 0.3s, color 0.3s;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus,
        input[type="time"]:focus,
        textarea:focus {
            background-color: #fff;
            color: #000;
            outline: none;
        }

        #departement {
            background-color: #ffffff;
            color: black;
            font-weight: bold;
            width: 100%;
            text-align: center;
        }

        #message {
            background-color: white;
            color: black;
        }
    </style>

    @include('receptionist.css')
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    <!-- sidebar started -->
    @include('receptionist.sidebar')
    <!-- sidebar ended -->
    <!-- partial -->
    <!-- navbar started -->
    <div class="container-fluid page-body-wrapper">
        <div class="container" align="center" style="padding-top :100px;">
            @if(session()->has('message'))

            <div class="alert alert-success">
                <button type="button" class="close" data-bs-dismiss="alert">x</button>
                {{session()->get('message')}}
            </div>
            @endif

            <!-- partial:partials/_navbar.html -->
            @include('userdashboard.navbar')

            <!-- navbar ended -->
            <!-- partial -->


            <!-- body started -->
            <style type="text/css">
                .submit-button {
                    background-color: #00D9A5;
                    border: none;
                    color: white;
                    padding: 10px 20px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin-top: 10px;
                    cursor: pointer;
                    border-radius: 5px;
                    transition: left 0.9s ease-in-out;
                    width: 100%;
                }

                .submit-button:hover {
                    background-color: #596261;
                    color: white;
                }

            </style>
            <div class="page-section">
                <div class="container">
                    <h1 class="text-center wow fadeInUp" style="font-size:40px;" !important>Book Bed</h1>

                    <form method="POST" action="{{ url('receptionist/upload_bed') }}" enctype="multipart/form-data">

                        @csrf

                        <div class="row mt-5">
                            <!-- User ID -->
                            <div class="col-4 col-sm-6 py-2 wow fadeInLeft">
                                <div class="form-group">
                                    <label for="userIdInput">User ID</label>
                                    <input type="text" class="form-control" placeholder="Enter User ID" name="user_id" id="userIdInput" onblur="fetchPatientName()" required>
                                    <div id="nameError" class="error-message"></div>
                                </div>
                            </div>

                            <!-- Patient name -->
                            <div class="col-4 col-sm-6 py-2 wow fadeInLeft">
                                <div class="form-group">
                                    <label for="nameInput">Patient Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Patient Name" name="name" id="nameInput" readonly required>
                                    <div id="nameError" class="error-message"></div>
                                </div>
                            </div>
                            <!-- Age -->
                            <div class="col-4 col-sm-6 py-2 wow fadeInLeft">
                                <div class="form-group">
                                    <label for="ageSelect">Age</label>
                                    <select class="form-control" name="age" id="ageSelect" required>
                                        <option value="">--Select Age--</option>
                                        <option value="above18">Above 18</option>
                                        <option value="below18">Below 18</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Patient CNIC -->
                            <div id="cnicField" class="col-4 col-sm-6 py-2 wow fadeInLeft" style="display: none;">
                                <div class="form-group">
                                    <label for="cnicInput">Patient CNIC</label>
                                    <input type="text" class="form-control" placeholder="Enter Patient CNIC (e.g., XXXXX-XXXXXXX-X)" name="cnic" id="cnicInput">
                                    <div id="cnicError" class="error-message"></div>
                                </div>
                            </div>
                            <!-- Guardian Name -->
                            <div id="guardianNameField" class="col-4 col-sm-6 py-2 wow fadeInLeft" style="display: none;">
                                <div class="form-group">
                                    <label for="guardianNameInput">Guardian Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Guardian Name" name="guardian_name" id="guardianNameInput">
                                    <div id="guardianNameError" class="error-message"></div>
                                </div>
                            </div>
                            <!-- Guardian CNIC -->
                                <div id="guardianCnicField" class="col-4 col-sm-6 py-2 wow fadeInLeft" style="display: none;">
                                    <div class="form-group">
                                        <label for="guardianCnicInput">Guardian CNIC</label>
                                        <input type="text" class="form-control" placeholder="Enter Guardian CNIC (e.g., XXXXX-XXXXXXX-X)" name="guardian_cnic" id="guardianCnicInput">
                                        <div id="guardianCnicError" class="error-message"></div>
                                    </div>
                                </div>

                            <!-- ward name -->
                            <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
                                <label for="departement">Select Ward</label>
                                <select name="ward" id="departement" class="custom-select" required>
                                    <option value="">--Select Ward--</option>
                                    @foreach($ward as $wards)
                                        <option value="{{$wards->name}}">{{$wards->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Bed no -->
                            <div class="col-4 col-sm-6 py-2 wow fadeInRight">
                                <div class="form-group">
                                    <label for="bedNoInput">Bed No</label>
                                    <select name="bed_no" id="bedNoInput" class="form-control" required>
                                        <option value="">Select Ward First</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Date -->
                            <div class="col-4 col-sm-6 py-2 wow fadeInRight">
                                <div class="form-group">
                                    <label for="Date">Select Date of booking</label>
                                    <input type="date" class="form-control" name="date" id="Date" required>
                                </div>
                            </div>
                            <!-- Time -->
                            <div class="col-4 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="900ms">
                                <div class="form-group">
                                    <label for="timeInput">Time</label>
                                    <input type="time" class="form-control" name="time" id="timeInput">
                                </div>
                            </div>

                            <div class="col-12 py-2 wow fadeInLeft" data-wow-delay="900ms">
                                <button type="submit" class="submit-button wow fadeInLeft">Submit Request</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- body ended -->

            <!-- script started -->
            <!-- plugins:js -->
            @include('receptionist.script')

            <!-- End custom js for this page -->
            <!-- script ended -->
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Get the current time
    var currentTime = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

    // Set the current time as the default value for the time input field
    document.getElementById("timeInput").value = currentTime;

    $(document).ready(function() {
        // When the user ID input changes
        $('#userIdInput').on('input', function() {
            var userId = $(this).val();

            // Fetch the name for the entered user ID via AJAX
            $.ajax({
                url: "{!! url('receptionist/fetch_name') !!}",
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { userId: userId },

                success: function(response) {
                    $('#nameInput').val(response.name);
                }
            });
        });

        // When the ward selection changes
        $('#departement').on('change', function() {
            var wardName = $(this).val();

            // Fetch the booked beds for the selected ward via AJAX
            $.ajax({
                url: "{{ url('receptionist/available_beds') }}",
                type: "GET",
                data: { wardName: wardName, "_token": "{{ csrf_token() }}" },
                success: function(response) {
                    var bookedBeds = response.bookedBeds;
                    var capacity = response.capacity;
                    var bedNoInput = $('#bedNoInput');
                    bedNoInput.empty(); // Clear the current bed options

                    // Generate the available bed options
                    for (var i = 1; i <= capacity; i++) {
                        // Check if the bed is already booked
                        if (bookedBeds.indexOf(i.toString()) === -1) {
                            var option = new Option(i, i);
                            bedNoInput.append(option);
                        }
                    }
                }
            });
        });

        // When the age selection changes
        $('#ageSelect').on('change', function() {
            var age = $(this).val();
            var cnicField = $('#cnicField');
            var guardianNameField = $('#guardianNameField');
            var guardianCnicField = $('#guardianCnicField');

            if (age === 'above18') {
                cnicField.show();
                guardianNameField.hide();
                guardianCnicField.hide();
            } else if (age === 'below18') {
                cnicField.hide();
                guardianNameField.show();
                guardianCnicField.show();
            }
        });

        $('#cnicInput').on('input', function(event) {
            var input = event.target;
            var value = input.value;

            // Remove any non-digit characters
            var digitsOnly = value.replace(/[^0-9]/g, '');

            // Add dashes after the first 5 characters and after the next 7 characters
            var formattedValue = '';
            for (var i = 0; i < digitsOnly.length; i++) {
                if (i === 5 || i === 12) {
                    formattedValue += '-';
                }
                formattedValue += digitsOnly.charAt(i);
            }

            input.value = formattedValue;
        });

        $('#cnicInput').on('input', function() {
            var cnicInput = $(this);
            var cnic = cnicInput.val();

            // Send an AJAX request to check CNIC validity
            $.ajax({
                url: "{{ url('receptionist/check_cnic') }}",
                type: "GET",
                data: { cnic: cnic, "_token": "{{ csrf_token() }}" },
                success: function(response) {
                    if (response.available) {
                        $('#cnicError').text('');
                    } else {
                        $('#cnicError').text('Invalid CNIC or already booked');
                    }
                }
            });
        });

        $('#guardianCnicInput').on('input', function() {
            var guardianCnicInput = $(this);
            var cnic = guardianCnicInput.val();

            // Send an AJAX request to check CNIC validity
            $.ajax({
                url: "{{ url('receptionist/check_cnic') }}",
                type: "GET",
                data: { cnic: cnic, "_token": "{{ csrf_token() }}" },
                success: function(response) {
                    if (response.available) {
                        $('#guardianCnicError').text('');
                    } else {
                        $('#guardianCnicError').text('Invalid CNIC or already booked');
                    }
                }
            });
        });
    });

    function fetchPatientName() {
        var userId = document.getElementById("userIdInput").value;

        // Fetch the name for the entered user ID via AJAX
        $.ajax({
            url: "{!! url('receptionist/fetch_name') !!}",
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { userId: userId },
            success: function(response) {
                $('#nameInput').val(response.name);
            }
        });
    }
</script>

</body>
</html>
