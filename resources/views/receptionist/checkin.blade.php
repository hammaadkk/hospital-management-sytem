<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Check in</title>
  @include('receptionist.css')
  
</head>
<body>
  <div class="container-scroller">
    @include('receptionist.sidebar')
    
    @include('receptionist.navbar')
    <div class="content-wrapper">
      
      <div class="row">
        
        <div class="col-md-12" style="margin-top: 100px;">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Check in</h4>
              @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-bs-dismiss="alert">x</button>
            {{ session()->get('message') }}
        </div>
    @endif
              <form id="checkinForm" action="{{ route('storeCheckin') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="cnicInput">Patient Cnic/Name:</label>
                  <input type="text" name="cnic_no" id="cnicInput" class="form-control" required autocomplete="off" style="color: #000 !important; background-color:white;">
                  <div id="cnic_suggestions" class="suggestions"></div>
                </div>
                <button type="submit" class="btn btn-success" style="margin-top: 25px;">Check In</button>
              </form>

          
    @include('receptionist.script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
    <script>
  $(document).ready(function() {
    $('#cnicInput').on('keyup', function() {
      var value = $(this).val();
      if (value === '') {
        $('#cnic_suggestions').empty(); // Clear suggestions if the input is empty
      } else {
        $.ajax({
          url: "{{ route('search') }}",
          type: 'GET',
          data: { 'cnic_no': value },
          success: function(data) {
            $('#cnic_suggestions').html(data);
          }
        });
      }
    });

    // Handle click event on suggestion
    $(document).on('click', '.list-group-item', function() {
      var selectedValue = $(this).text();
      $('#cnicInput').val(selectedValue);
      $('#cnic_suggestions').empty(); // Clear suggestions
    });
  });
</script>

</body>
</html>
