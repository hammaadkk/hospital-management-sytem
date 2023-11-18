

<!DOCTYPE html>
<html lang="en">
  <head>
  <style>
  label {
    display: inline-block;
    width: 200px;
    margin-bottom: 10px;
    margin-left:-100px;
    text-align: left;
  }

  /* CSS for input fields */
  input[type="text"],
  input[type="email"],
  input[type="date"],
  input[type="password"] {
    background-color: #fff;
    color: #000;
    transition: background-color 0.3s, color 0.3s;
  }

  /* CSS for input fields when focused */
  input[type="text"]:focus,
  input[type="email"]:focus,
  input[type="date"]:focus,
  input[type="password"]:focus,
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

  /* CSS for date of birth field text color */
  input[type="date"] {
    color: #000;
  }
</style>

    <!-- Required meta tags -->
    <base href="/public">
  @include('admin.css')

  <style type="text/css">
    label{
      display: inline-block;
      width: 200px;
    }
  </style>
  </head>
  <body>
    <div class="container-scroller">
     
        @include('admin.sidebar')
      
      @include('admin.navbar')
     
       <div class="container-fluid page-body-wrapper">



        <div class="container" align="center" style="padding: 100px">
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
       <form action="{{url('editbed',$data->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mt-5 ">
                     <!--general ward -->
            <div class="col-12 col-sm-6 py-2 wow fadeInRight">
              <label for="">General Ward:</label>
              <select name="ward_id" id="departement" class="custom-select" required>
                <option value="">Select General Ward</option>
                @foreach ($generalWards as $ward)
                <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                @endforeach
              </select>
            </div>
          <!-- Bed no -->
          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
              <label for="">Bed no</label>
            <input type="text" class="form-control" placeholder="Email address.." name="bedno" value="{{$data->bed_number}}" required>
          </div>
          
        
        
          <div class="col-12 py-2 wow fadeInLeft">
            <input type="submit" class="submit-button" value="update bed">
          </div>   
  <!-- <button type="submit" class="submit-button wow fadeInLeft">Submit Request</button> -->

            </form>
        </div>
       </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
   @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>