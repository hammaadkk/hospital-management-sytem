

<!DOCTYPE html>
<html lang="en">
  <head>
  <style>
        label{
            display: inline-block;
            width: 400px;
            margin-bottom:10px;
            text-align:left;
        }
        /* CSS for input fields */
      input[type="text"],
      input[type="email"],
      input[type="date"]
       {
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
      #departement, #experience, #shift{
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
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      @include('admin.sidebar')
      @include('admin.navbar')
      <div class="container-fluid page-body-wrapper">

        

<div class="container" align="center">
<div style="margin-top: 30px;  font-size: 45px; border: 1px solid #00d9a5; background-color: #00d9a5; border-radius: 5px;">Add Receptionist</div>
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
            <form action="upload_receptionist" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mt-5 ">
                    <!-- name -->
                    <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
              <label for="">Name</label>
          <input type="text" class="form-control" placeholder="Enter Your Full Name" name="name" id="nameInput" required>
          </div>
          <!-- email -->
          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
              <label for="">Email</label>
            <input type="email" class="form-control" placeholder="Email address.." name="email" required>
          </div>
           <!-- address -->
          
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
          <label for="">Address</label>
          <input type="text" class="form-control" placeholder="Enter Your Address" name="address" id="addressInput" required>
          </div>
          <!-- gender -->
          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
          <label for="">Gender</label>
          <select name="gender" id="departement" class="custom-select" required>
              <option value="">---select---</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option> 
            </select>
          </div>
           <!-- dob -->
           <div class="col-12 col-sm-6 py-2 wow fadeInRight">
           <label for="">Date of Birth</label>
            <input type="date" class="form-control" name="dob" required>
          </div>
          <!-- employee id -->
          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
          <label for="">Employee Id</label>
            <input type="text" class="form-control" placeholder="Enter employee id.." name="emid" required>
          </div>
           <!--Shift -->
           <div class="col-12 col-sm-6 py-2 wow fadeInRight">
           <label for="">Shift</label>
          <select name="shift" id="shift" class="custom-select" required>
          <option value="">---select---</option>
              <option value="morning">---Morning---</option>
              <option value="night">Night</option>
            </select>
          </div>
          <!-- job start date -->
          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
          <label for="">Job Starting date</label>
            <input type="date" class="form-control" name="jobstart" required>
          </div>
          <!-- qualification -->
          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
          <label for="">Qualification</label>
            <input type="text" class="form-control" placeholder="Enter employee education details.." name="education" required>
          </div>
          <!--experience -->
          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
          <label for="">Experience</label>
          <select name="experience" id="experience" class="custom-select" required>
          <option value="">---select---</option>
              <option value="1 year">---One year---</option>
              <option value="2 years">---two years---</option>
              <option value="3 years">---Three years---</option>
              <option value="4 years">---Four years---</option>
              <option value="More then 5">---More then 5 years---</option>
              
            </select>
            </div>
             <!-- Password -->
          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
          <label for="">Password</label>
            <input type="password" class="form-control" placeholder="Enter password here " name="pass" required>
          </div>
            
          
          <!-- Photo -->
          <div class="col-12 col-sm-6 py-2 mt-4 wow fadeInRight">
            
          <input type="file" name="file" required>
          </div>
          <div class="col-12 py-2 wow fadeInLeft">
            <button type="submit" class="submit-button">Add Nurse</button>
          </div>     
            </form>
        </div>
   @include('admin.script')
  </body>
</html>