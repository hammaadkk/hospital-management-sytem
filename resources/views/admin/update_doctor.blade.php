

<!DOCTYPE html>
<html lang="en">
  <head>
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
          <form action="{{url('editdoctor',$data->id)}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div style="padding:15px;">
                    <label for="">Doctor Name</label>
                    <input type="text" style="color:black;" name="name"value="{{$data->name}}">
                </div>

                <div style="padding:15px ;">
                    <label for="">Phone</label>
                    <input type="number" style="color:black;" name="number" value="{{$data->phone}}">
                </div>

                <div style="padding:15px ;">
                    <label>Speciality</label>
                   <select name="speciality" id="" style="color:black ; width:200px;" value="{{$data->speciality}}">
                    <option value="">--Select--</option>
                    <option value="skin">skin</option>
                    <option value="eyes">eyes</option>
                    <option value="heart">heart</option>
                    <option value="nose">nose</option>
                    <option value="ear">ear</option>
                   </select>
                </div>

                <div style="padding:15px ;">
                    <label for="">Room no.</label>
                    <input type="text" style="color:black;" name="room" value="{{$data->room}}">
                </div>
                
                <div style="padding:15px ;">
                    <label for="">Old Image</label>
                    <img src="doctorimage/{{$data->image}}" height="150px" width="150px">
                </div>

                <div style="padding:15px ;">
                  <label>Change image</label>
                    <input type="file" name="file">
                </div>
                 <div style="padding:15px ;">
                  
                    <input type="submit" class="btn btn-primary">
                </div>

            </form>
        </div>
       </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
   @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>