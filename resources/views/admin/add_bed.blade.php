<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    label {
      display: inline-block;
      width: 400px;
      margin-bottom: 10px;
      text-align: left;
    }

    /* CSS for input fields */
    input[type="text"],
    input[type="email"],
    input[type="date"] {
      background-color: #fff;
      color: #000;
      transition: background-color 0.3s, color 0.3s;
    }

    /* CSS for input fields when focused */
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="date"]:focus,
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

    .submit-button {
      background-color: #00d9a5;
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
  @include('admin.css')
</head>
<body>
  <div class="container-scroller">
    @include('admin.sidebar')
    @include('admin.navbar')
    <div class="container-fluid page-body-wrapper">
      <div class="container" align="center">
        <div style="margin-top: 30px; font-size: 45px; border: 1px solid #00d9a5; background-color: #00d9a5; border-radius: 5px;">Add Bed</div>
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        @if(session()->has('message'))
        <div class="alert alert-success">
          <button type="button" class="close" data-bs-dismiss="alert">x</button>
          {{session()->get('message')}}
        </div>
        @endif
        <style>
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
        <form action="upload_bed" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row mt-5">
            <!--general ward -->
            <div class="col-12 col-sm-6 py-2 wow fadeInRight">
              <label for="">General Ward:</label>
              <select name="ward" id="departement" class="custom-select" required>
                <option value="">Select General Ward</option>
                @foreach ($generalward as $ward)
                <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                @endforeach
              </select>
            </div>

            <!-- bed no -->
            <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
              <label for="">Bed no</label>
              <input type="text" class="form-control" placeholder="Enter Your Bed number" name="bedno" id="nameInput" required>
            </div>

            <!-- Availability -->
            <div class="col-12 col-sm-6 py-2 wow fadeInRight">
              <label for="availability">Availability:</label>
              <select name="availability" id="departement" class="custom-select" required>
                <option value="available">Available</option>
                <option value="not available">Not Available</option>
              </select>
            </div>

            <div class="col-12 py-2 wow fadeInLeft">
              <button type="submit" class="submit-button">Add Bed</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  @include('admin.script')
</body>
</html>
