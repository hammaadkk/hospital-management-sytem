

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->

    <base href="/public">
    <style>
        label{
            display: inline-block;
            width: 200px;
        }
    </style>
  @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
     
        @include('admin.sidebar')
      
      @include('admin.navbar')
     
      <div class="container-fluid page-body-wrapper">

        

        <div class="container" align="center" style="padding: top 100px;">

       @if(session()->has('message'))

        <div class="alert alert-success"> 
        <button type="button" class="close" data-bs-dismiss="alert">x</button> 
            {{session()->get('message')}}
        </div>
       @endif

            <form action="{{url('sendemail',$data->id)}}" method="POST">
                @csrf

                <div style="padding:15px ;">
                    <label for="">Greeting</label>
                    <input type="text" style="color:black;" name="greeting" placeholder="Write the name" required>
                </div>

                <div style="padding:15px ;">
                    <label for="">Body</label>
                    <input type="text" style="color:black;" name="body" required>
                </div>

               

                <div style="padding:15px ;">
                    <label for="">Action Text</label>
                    <input type="text" style="color:black;" name="actiontext" required>
                </div>


                <div style="padding:15px ;">
                    <label for="">Action Url</label>
                    <input type="text" style="color:black;" name="actionurl" required>
                </div>

                <div style="padding:15px ;">
                    <label for="">End Part</label>
                    <input type="text" style="color:black;" name="endpart" required>
                </div>
                
                

                <div style="padding:15px ;">
                    <input type="submit" class="btn btn-success">
                </div>

            </form>
        </div>
    
    <!-- container-scroller -->
    <!-- plugins:js -->
        <!-- End custom js for this page -->
  </body>
  @include('admin.script')
</html>