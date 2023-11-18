<style>
  .nav .sub-menu ul,
  .nav .sub-sub-menu ul {
    padding: 0;
    margin-bottom: 5px;
  }
</style>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="{{url('/')}}"><img src="admin/assets/images/logo.svg" alt="logo" /></a>
    <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="{{ asset('admin/assets/images/logo.svg') }}" alt="logo" /></a>
  </div>
  <ul class="nav">
    <li class="nav-item profile">
      <!-- Profile content here -->
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" href="{{url('home')}}">
        <span class="menu-icon">
          <i class="mdi mdi-file-document-box"></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    
<li class="nav-item menu-items">
  <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" aria-controls="addEmployeeDropdown">
    <span class="menu-icon">
      <i class="mdi mdi-file-document-box"></i>
    </span>
    <span class="menu-title">Add Employee</span>
    <i class="menu-arrow"></i>
  </a>
 
    <ul class="nav flex-column sub-menu">
      <li class="nav-item"> <!-- Add Doctors -->
        <a class="nav-link" href="{{url('add_doctor_view')}}">Add Doctors</a>
      </li>
      <li class="nav-item"> <!-- Add Nurses -->
        <a class="nav-link" href="{{url('add_nurses')}}">Add Nurses</a>
      </li>
      <li class="nav-item"> <!-- Add Receptionists -->
        <a class="nav-link" href="{{url('add_receptionists')}}">Add Receptionist</a>
      </li>
      <li class="nav-item"> <!-- Add Lab Assistants -->
        <a class="nav-link" href="{{url('add_labassistants')}}">Add Lab Assistant</a>
      </li>
    </ul>
  
</li>
    <!-- <li class="nav-item menu-items">
      <a class="nav-link" href="{{url('add_room')}}">
        <span class="menu-icon">
          <i class="mdi mdi-file-document-box"></i>
        </span>
        <span class="menu-title">Add Room</span>
      </a>
    </li> -->

 
    
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{url('showappointment')}}">
        <span class="menu-icon">
          <i class="mdi mdi-file-document-box"></i>
        </span>
        <span class="menu-title">All Appointments</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" href="{{url('showdoctor')}}">
        <span class="menu-icon">
          <i class="mdi mdi-file-document-box"></i>
        </span>
        <span class="menu-title">All Doctors</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" href="{{url('shownurse')}}">
        <span class="menu-icon">
          <i class="mdi mdi-file-document-box"></i>
        </span>
        <span class="menu-title">All Nurses</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" href="{{url('showreceptionist')}}">
        <span class="menu-icon">
          <i class="mdi mdi-file-document-box"></i>
        </span>
        <span class="menu-title">All Receptionists</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" href="{{url('showlabassistant')}}">
        <span class="menu-icon">
          <i class="mdi mdi-file-document-box"></i>
        </span>
        <span class="menu-title">All Lab Assistants</span>
      </a>
    </li>

   

   
<!-- 
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{url('showroom')}}">
        <span class="menu-icon">
          <i class="mdi mdi-file-document-box"></i>
        </span>
        <span class="menu-title">All Rooms</span>
      </a>
    </li> -->

  </ul>
</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>


<script>
  $(document).ready(function() {
    // Initialize Bootstrap collapse plugin
    $('[data-toggle="collapse"]').on('click', function(e) {
      e.preventDefault();
      var $this = $(this);
      var $collapse = $this.closest('.nav-item').find('.collapse');
      if (!$collapse.hasClass('show')) {
        $('.collapse.show').removeClass('show');
      }
      $collapse.toggleClass('show');
    });
  });
</script>
