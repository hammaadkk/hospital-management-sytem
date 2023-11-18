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

}

.submit-button:hover {
  background-color: #596261;
  color: white;
}

.calendar-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        #calendar {
            position: absolute;
            top: 100%;
            left: 0;
            display: none;
            background: white;
            border: 1px solid #ccc;
            z-index: 1;
            width: 100%; /* Align with the text field */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            border-radius: 4px;
            padding: 10px;
        }

        .calendar-container.active #calendar {
            display: block;
        }

        .calendar-container input[type="text"] {
            width: 100%; /* Align with the text field */
            padding-right: 30px; /* Add space for the dropdown icon */
            cursor: pointer; /* Hand pointer on the text field */
        }

        .calendar-container .dropdown-icon {
            position: absolute;
            top: 0;
            right: 20px;
            bottom: 0;
            width: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer; /* Hand pointer on the icon */
            pointer-events: none; /* Ensure the icon doesn't block interaction with the input field */
        }

        table {
            width: 100%;
            text-align: center;
            border-collapse: collapse;
        }

        th {
            background: #007bff;
            color: #fff;
            font-weight: bold;
        }

        th, td {
            padding: 5px;
            border: 1px solid #ccc;
        }

        td {
            cursor: pointer;
        }

        .holiday {
            background: #f2dede; /* Red background for holidays */
            color: #a94442; /* Text color for holidays */
            cursor: not-allowed; /* Disable pointer events for holidays */
        }
        .not-available-legend {
    display: inline-block;
    width: 15px;
    height: 15px;
    background-color: red;
    margin-right: 5px;
}

/* Style for available (green) legend */
.available-legend {
    display: inline-block;
    width: 15px;
    height: 15px;
    background-color: green;
    margin-right: 5px;
}

/* Hide the legend by default */
/* #availability-legend {
    display: none;
} */
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="page-section" id="appointmentmake">
    <div class="container">
      <h1 class="text-center wow fadeInUp" style="font-size:40px;" !important>Make an Appointment</h1>

      <form class="main-form" action="{{url('appointment')}}" method="POST" id="checkvalidate">
        @csrf
        <div id="availability-legend" class="hidden" style="margin-bottom: -40px;">
    <span class="not-available-legend"></span> Available.
    <span class="available-legend"></span> Not Available.
</div>

        <div class="row mt-5 ">
           <!-- name -->
        <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
        <input type="text" class="form-control" placeholder="Enter Your Full Name" name="name" id="nameInput">
        <div class="invalid-feedback">
          Please enter a valid name (alphabets and spaces only).
        </div>
      </div>
         <!--Father name -->
      <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
        <input type="text" class="form-control" placeholder="Enter Your Father Name" name="fname" id="fnameInput">
        <div class="invalid-feedback">
          Please enter a valid name (alphabets and spaces only).
        </div>
      </div>

      <!--Cnic no -->
      <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
        <input type="text" class="form-control" placeholder="Enter Your CNIC Number" name="cnic_no" id="cnicInput" maxlength="15">
        <div class="invalid-feedback">
          Please enter a valid CNIC number (only numbers allowed).
        </div>
      </div>
          <!-- email address -->
        <div class="col-12 col-sm-6 py-2 wow fadeInRight">
          <input type="email" class="form-control" placeholder="Email address.." name="email" id="emailInput">
          <div class="invalid-feedback">
            Please enter a valid email address.
          </div>
        </div>
        <!-- date -->
        <div class="calendar-container col-12 col-sm-6 py-2 wow fadeInRight">
        <input type="text" class="form-control" placeholder="Select date address.." name="date" id="dateInput" readonly>
        <i class="dropdown-icon fas fa-caret-down"></i>
        <div class="invalid-feedback">
            Please Select A Date.
        </div>
        <div id="calendar" class="hidden">
            <!-- Calendar content will be displayed here -->
        </div>
    </div>

          <!-- doctor -->
          <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
            <select name="doctor" id="doctor_id" class="custom-select" >
              <option value="">---select doctor---</option>
              @foreach($doctor as $doctors)
              <option value="{{$doctors->name}}">{{$doctors->name}} --Speciality-- {{$doctors->speciality}}</option>
              @endforeach
            </select>
          </div>
          
       <!-- number -->
          <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
          <input type="text" class="form-control" placeholder="Enter Mobile Number.." name="number">
          <div class="invalid-feedback">
            Please enter a valid mobile number in the format +92XXXXXXXXXX.
          </div>
        </div>
          <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
          <textarea name="message" id="message" class="form-control" rows="6" placeholder="Enter message.."  ></textarea>
          <div class="invalid-feedback">
            Please enter a message without special characters.
          </div>
          </div>
        </div>

  <button type="submit" class="submit-button wow fadeInLeft">Submit Request</button>


      </form>
    </div>
  </div>
  <script>
       const dateInput = document.getElementById('dateInput');
        const calendarContainer = document.querySelector('.calendar-container');
        const calendar = calendarContainer.querySelector('#calendar');

        dateInput.addEventListener('click', (event) => {
            event.stopPropagation(); // Prevent the click event from reaching the document
            calendarContainer.classList.toggle('active');
            calendar.innerHTML = generateCalendar();
        });
        dateInput.addEventListener('keydown', (event) => {
    if (event.key === ' ') {
        event.preventDefault();
        dateInput.click();
    }
});


        // Function to generate the calendar for the selected month and year
        function generateCalendar() {
            const now = new Date();
            const year = now.getFullYear();
            const month = now.toLocaleString('default', { month: 'long' });

            const firstDay = new Date(year, now.getMonth(), 1);
            const lastDay = new Date(year, now.getMonth() + 1, 0);

            let calendarHTML = '<table border="1"><tr><th colspan="7">' + month + ' ' + year + '</th></tr>';
            calendarHTML += '<tr><td>S</td><td>M</td><td>T</td><td>W</td><td>Th</td><td>F</td><td>Sa</td></tr>';

            let day = 1;
            let dayOfWeek = firstDay.getDay();

            for (let i = 0; i < 6; i++) {
                calendarHTML += '<tr>';
                for (let j = 0; j < 7; j++) {
                    if (i === 0 && j < dayOfWeek) {
                        calendarHTML += '<td></td>';
                    } else if (day <= lastDay.getDate()) {
                        const dateStr = `${month} ${day} ${year}`;
                        const isHoliday = (j === 0 || j === 6); // Saturday (0) and Sunday (6) are holidays
                        const cellClass = isHoliday ? 'holiday' : '';
                        calendarHTML += '<td class="' + cellClass + '" data-date="' + dateStr + '">' + day + '</td>';
                        day++;
                    }
                }
                calendarHTML += '</tr>';
                if (day > lastDay.getDate()) {
                    break;
                }
            }

            calendarHTML += '</table>';
            return calendarHTML;
        }

        // Add a click event listener to the document to close the calendar when clicking outside
        document.addEventListener('click', (event) => {
            if (!calendarContainer.contains(event.target)) {
                calendarContainer.classList.remove('active');
            }
        });

        // Add a click event listener to the calendar cells to update the input field
        calendar.addEventListener('click', (event) => {
            const target = event.target;
            if (target && target.tagName === 'TD' && target.dataset.date && !target.classList.contains('holiday')) {
              const selectedDate = new Date(target.dataset.date);
              const formattedDate = selectedDate.toISOString().split('T')[0];

              dateInput.value = formattedDate;
              calendarContainer.classList.remove('active');
            }
        });
</script>

