

<!DOCTYPE html>
<html lang="en">
  <head>
    <style>
      /* CSS for input fields */
      input[type="text"],
      input[type="email"],
      input[type="date"]
       {
        background-color: #fff; /* Set background color to white */
        color: #000; /* Set text color to black */
        transition: background-color 0.3s, color 0.3s; /* Add transition effect */
      }
    
      /* CSS for input fields when focused */
      input[type="text"]:focus,
      input[type="email"]:focus,
      input[type="date"]:focus,
      textarea:focus {
        background-color: #fff; /* Set background color to white */
        color: #000; /* Set text color to black */
        outline: none; /* Remove default focus outline */
      }
      #departement{
        background-color: #ffffff;
        color: black;
        font-weight: bold;
        width: 100%;
        text-align: center;
      }
      #message{
        background-color: white;
        color: black;
      }
    </style>
    
   <!-- Required meta tags -->
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
      <h1 class="text-center wow fadeInUp" style="font-size:40px;" !important>Make an Appointment</h1>

      <form action="{{url('upload_appoint')}}" method="post" enctype="multipart/form-data" id="checkvalidate">
        @csrf
        <div class="row mt-5 ">
           <!-- name -->
        <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
        <input type="text" class="form-control" placeholder="Enter Your Full Name" name="name" id="nameInput" required>
        <div class="invalid-feedback">
          Please enter a valid name (alphabets and spaces only).
        </div>
      </div>

          <!-- email address -->
        <div class="col-12 col-sm-6 py-2 wow fadeInRight">
          <input type="email" class="form-control" placeholder="Email address.." name="email" id="emailInput" required>
          <div class="invalid-feedback">
            Please enter a valid email address.
          </div>
        </div>
       <!-- date -->
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="date" class="form-control" name="date" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" required>
          </div>
                <!-- doctor -->
        
          <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
            <select name="doctor" id="departement" class="custom-select" required>
              <option value="">---select doctor---</option>
              @foreach($doctor as $doctors)
              <option value="{{$doctors->name}}">{{$doctors->name}} --Speciality-- {{$doctors->speciality}}</option>
              @endforeach
            </select>
          </div>

          <!-- number -->
          <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
          <input type="text" class="form-control" placeholder="Enter Mobile Number.." name="number" pattern="^\+92\d{10}$" title="Please enter a valid mobile number in the format +92XXXXXXXXXX" value="+92" required oninput="validateMobileNumber(event)" maxlength="13">
          <div class="invalid-feedback">
            Please enter a valid mobile number in the format +92XXXXXXXXXX.
          </div>
        </div>
        <!-- message -->
        <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
          <textarea name="message" id="message" class="form-control" rows="6" placeholder="Enter message.." oninput="validateMessage(event)" required></textarea>
          <div class="invalid-feedback">
            Please enter a message without special characters.
          </div>
        </div>

  <button type="submit" class="submit-button wow fadeInLeft">Submit Request</button>


        <!-- <button type="submit" class="btn btn-primary mt-3 wow zoomIn">Submit Request</button> -->
      </form>
    </div>
  </div>
    <!-- body ended -->
   <!-- script started -->
 <!-- plugins:js -->
 @include('userdashboard.script')

   <script>

function validateName(event) {
  const input = event.target;
  const regex = /^[A-Za-z\s]+$/;
  if (!regex.test(input.value)) {
    input.classList.add('is-invalid');
  } else {
    input.classList.remove('is-invalid');
  }
}

// Add event listener to the name input field to validate it on input
const nameInput = document.getElementById('nameInput');
nameInput.addEventListener('input', validateName);

// Get the form element
const form = document.getElementById('checkvalidate'); // Replace 'yourFormId' with the actual ID of your form element

// Add event listener to the form's submit event
form.addEventListener('submit', function (event) {
  // Get all inputs with the 'is-invalid' class
  const invalidInputs = form.querySelectorAll('.is-invalid');

  // If there are invalid inputs, prevent the form submission
  if (invalidInputs.length > 0) {
    event.preventDefault();
  }
});

function validateEmail(event) {
  const input = event.target;
  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!regex.test(input.value)) {
    input.classList.add('is-invalid');
  } else {
    input.classList.remove('is-invalid');
  }
}

// Add event listener to the email input field to validate it on input
const emailInput = document.getElementById('emailInput');
emailInput.addEventListener('input', validateEmail);

function validateMobileNumber(event) {
  const input = event.target;
  const regex = /^\+92\d{10}$/;
  if (!regex.test(input.value)) {
    input.classList.add('is-invalid');
  } else {
    input.classList.remove('is-invalid');
  }
}

// Add event listener to the mobile number input field to validate it on input
const mobileInput = document.querySelector('input[name="number"]');
mobileInput.addEventListener('input', validateMobileNumber);

// Prevent backspacing on the mobile number input field
mobileInput.addEventListener('keydown', function (event) {
  if (event.key === 'Backspace' && event.target.selectionStart <= 3) {
    event.preventDefault();
  }
});

// Prevent removing +92 when the field is emptied
mobileInput.addEventListener('blur', function (event) {
  if (event.target.value.trim() === '') {
    event.target.value = '+92';
  }
});

function validateMessage(event) {
  const input = event.target;
  const regex = /^[A-Za-z0-9\s]+$/;
  if (!regex.test(input.value)) {
    input.classList.add('is-invalid');
  } else {
    input.classList.remove('is-invalid');
  }
}

// Add event listener to the message textarea to validate it on input
const messageInput = document.getElementById('message');
messageInput.addEventListener('input', validateMessage);


 </script>


    <!-- End custom js for this page -->
   <!-- script ended -->
  </body>
</html>