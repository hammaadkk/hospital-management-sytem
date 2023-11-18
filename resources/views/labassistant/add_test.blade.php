<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Test</title>
  @include('labassistant.css')
  <style>

    #test_name:focus{
      background-color:white;
    }
    #charges:focus{
      background-color:white;
    }
    /* Styles for the print page */
    @media print {
      .no-print {
        display: none;
      }
      .print-table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
      }
      .print-table th,
      .print-table td {
        padding: 8px;
        text-align: left;
        border: 1px solid #ddd;
      }
      .print-table th {
        background-color: #f2f2f2;
      }
    }
  </style>
</head>
<body>
  <div class="container-scroller">
    @include('labassistant.sidebar')
    @include('labassistant.navbar')
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12" style="margin-top: 100px;">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Add Test</h4>
              <form id="addTestForm">
                <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="test_name">Test Name:</label>
                    <input type="text" name="test_name" id="test_name" class="form-control" required autocomplete="off" style="color: #000 !important;">
                    <div id="test_suggestions" class="suggestions"></div>
                  </div>

                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="charges">Charges:</label>
                      <input type="number" name="charges" id="charges" class="form-control" required style="color: #000 !important;" readonly>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <button type="button" class="btn btn-success" onclick="addTest()" style="margin-top: 25px;">Add Test</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-12" style="margin-top: 30px;">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Test List</h4>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Test No</th>
                    <th>Test Name</th>
                    <th>Charges</th>
                    <th class="no-print">Action</th> <!-- Hide in print page -->
                  </tr>
                </thead>
                <tbody id="testList">
                  <!-- Test rows will be dynamically generated here -->
                </tbody>
              </table>
              <div class="mt-4">
                <h5 id="totalTests">Total Tests: 0</h5>
                <h5 id="totalCharges">Total Charges: 0</h5>
              </div>
              <div class="row mt-4">
                <div class="col-md-6">
                  <button type="button" class="btn btn-primary" onclick="printTests()">Print</button>
                  <button type="button" class="btn btn-danger" onclick="clearTests()">Clear</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
    @include('labassistant.script')
        <!-- Include the JavaScript code -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
          // Define the tests array to store the added tests
          var tests = [];
          var totalTestCharges = 0;
    
          function addTest() {
            // Get the values from the form inputs
            var testName = document.getElementById('test_name').value;
            var charges = parseFloat(document.getElementById('charges').value);
    
            // Check if the test name and charges are provided
            if (testName.trim() === '' || isNaN(charges)) {
              alert('Please provide a valid test name and charges.');
              return;
            }
    
            // Create a new test object
            var test = {
              testName: testName,
              charges: charges
            };
    
            // Add the test to the tests array
            tests.push(test);
    
            // Update the test list table
            updateTestList();
    
            // Clear the form inputs
            document.getElementById('test_name').value = '';
            document.getElementById('charges').value = '';
    
            // Calculate and update the total charges
            calculateTotalCharges();
          }
    
          function updateTestList() {
            // Get the test list table body element
            var testListTable = document.getElementById('testList');
    
            // Clear the table body
            testListTable.innerHTML = '';
    
            // Loop through the tests array and add rows to the table
            tests.forEach(function(test, index) {
              var row = testListTable.insertRow();
              var cellTestNo = row.insertCell(0);
              var cellTestName = row.insertCell(1);
              var cellCharges = row.insertCell(2);
              var cellAction = row.insertCell(3);
    
              cellTestNo.innerHTML = index + 1;
              cellTestName.innerHTML = test.testName;
              cellCharges.innerHTML = test.charges.toFixed(2);
              cellAction.innerHTML = '<button type="button" class="btn btn-danger btn-sm" onclick="removeTest(' + index + ')">Remove</button>';
            });
          }
    
          function removeTest(index) {
            // Remove the test from the tests array
            tests.splice(index, 1);
    
            // Update the test list table
            updateTestList();
    
            // Calculate and update the total charges
            calculateTotalCharges();
          }
    
          function calculateTotalCharges() {
            // Calculate the total charges
            totalTestCharges = tests.reduce(function(total, test) {
              return total + test.charges;
            }, 0);
    
            // Update the total charges display
            document.getElementById('totalTests').innerHTML = 'Total Tests: ' + tests.length;
            document.getElementById('totalCharges').innerHTML = 'Total Charges: ' + totalTestCharges.toFixed(2);
          }
    
          function printTests() {
            // Hide the print button and other elements not to be printed
            document.getElementById('totalTests').style.display = 'none';
            document.getElementById('totalCharges').style.display = 'none';
            document.querySelector('.no-print').style.display = 'none';
    
            // Create the HTML content for printing
            let htmlContent = `
              <h2>Test List</h2>
              <table class="print-table">
                <thead>
                  <tr>
                    <th>Test No</th>
                    <th>Test Name</th>
                    <th>Charges</th>
                  </tr>
                </thead>
                <tbody>
            `;
    
            // Add the test rows to the HTML content
            tests.forEach(function(test, index) {
              htmlContent += `
                <tr>
                  <td>${index + 1}</td>
                  <td>${test.testName}</td>
                  <td>${test.charges}</td>
                </tr>
              `;
            });
    
            // Add the total counters to the HTML content
            htmlContent += `
                </tbody>
              </table>
              <h4>Total Tests: ${tests.length}</h4>
              <h4>Total Charges: ${totalTestCharges.toFixed(2)}</h4>
            `;
    
            // Create a new window for printing
            var printWindow = window.open('', '_blank');
    
            // Set the HTML content of the print window
            printWindow.document.open();
            printWindow.document.write(`
              <html>
                <head>
                  <title>Print</title>
                  <style>
                    @media print {
                      .no-print {
                        display: none;
                      }
                      .print-table {
                        border-collapse: collapse;
                        width: 100%;
                        margin-bottom: 20px;
                      }
                      .print-table th,
                      .print-table td {
                        padding: 8px;
                        text-align: left;
                        border: 1px solid #ddd;
                      }
                      .print-table th {
                        background-color: #f2f2f2;
                      }
                    }
                  </style>
                </head>
                <body>
                  ${htmlContent}
                </body>
              </html>
            `);
            printWindow.document.close();
    
            // Print the window
            printWindow.print();
    
            // Restore the original content and display
            printWindow.onafterprint = function() {
              document.getElementById('totalTests').style.display = 'block';
              document.getElementById('totalCharges').style.display = 'block';
              document.querySelector('.no-print').style.display = 'block';
              printWindow.close();
            };
          }
    
          function clearTests() {
            // Clear the tests array and total charges
            tests = [];
            totalTestCharges = 0;
    
            // Update the test list table and total charges display
            updateTestList();
            calculateTotalCharges();
          }
// test name suggestions start here
$(document).ready(function(){
    $('#test_name').on('keyup', function(){
        var val = $(this).val();
        
        if (val.trim() !== '') {
            $.ajax({
                url: "{{ route('search.testsname') }}",
                type: "GET",
                data: { 'test_name': val },
                success: function (data){
                    $("#test_suggestions").html(data);

                    // Attach click event handler to list items
                    $("#test_suggestions li").click(function() {
                        var selectedValue = $(this).text();
                        $("#test_name").val(selectedValue);
                        $("#test_name").css("color", "black");
                        $("#test_suggestions").empty();
                        
                        // Fetch charges using another Ajax request
                        $.ajax({
                            url: "{{ route('fetch.testcharges') }}",
                            type: "GET",
                            data: { 'test_name': selectedValue },
                            success: function (charges){
                                // Convert charges to number and set in input field
                                $("#charges").val(parseFloat(charges));
                            }
                        });
                    });
                }
            });
        } else {
            $("#test_suggestions").empty();
        }
    });
});


        </script>
      </div>
    </div>
   
  </div>
</body>
</html>
