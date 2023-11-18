

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <style>
      
        label{
            display: inline-block;
            width: 200px;
        }
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
  @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
        @include('admin.sidebar')
      @include('admin.navbar')
      <div class="container-fluid page-body-wrapper">

        

        <div class="container" align="center" style="padding-top :40px;">

        <div style=" font-size: 45px; border: 1px solid #00d9a5; background-color: #00d9a5; border-radius: 5px;">Add Doctor</div>
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
input[type="number"]:focus 
{
        background-color: #fff;
        color: #000;
    }
</style>

            <form action="{{url('upload_doctor')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mt-5 ">
                <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
                    <label for="">Doctor Name</label>
                    <input type="text" style="color:black;" class="form-control" name="name" placeholder="Write the name" required>
                </div>

                <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
                    <label for="">Phone</label>
                    <input type="number" class="form-control" style="color:black;" name="number" placeholder="Write the number" required>
                </div>

                <!--experience -->
                    <div class="col-12 col-sm-6 py-2 wow fadeInRight">
                    <label for="">Speciality</label>
                    <select name="speciality" id="departement" class="custom-select" required>
                    <option value="">---select---</option>
                        <option value="skin">---Skin---</option>
                        <option value="eyes">---Eyes---</option>
                        <option value="heart">---Heart---</option>
                        <option value="heart">---Nose---</option>
                        <option value="Ear">---Ear---</option>
                        
                        </select>
                        
                    </div>

                <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
                    <label for="">Room no</label>
                    <input type="number" class="form-control" style="color:black;" name="room" placeholder="Write Room no" required>
                </div>
                
                <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
                    <label for="">Doctor Image</label>
                    <input type="file" name="file" required>
                </div>

                <div class="col-12 py-2 wow fadeInLeft">
            <button type="submit" class="submit-button">Add Doctor</button>
          </div> 

            </form>
        </div>
    
    <!-- container-scroller -->
    <!-- plugins:js -->
        <!-- End custom js for this page -->
  </body>
  @include('admin.script')
</html>