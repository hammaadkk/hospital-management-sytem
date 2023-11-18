<!DOCTYPE html>
<html lang="en">
<head>
    @include('labassistant.css')
    <style>
        #newTestName:focus{
            background-color: white;
            color: black;
        }
        #newCharges:focus{
            background-color: white;
            color: black;
        }

.editable {
    background-color: #ffdb58; /* Change to the desired background color */
}
        .action-buttons {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px; /* Adjust the gap as needed */
}

        /* Add this to your existing styles */
.button-group {
    display: flex;
    gap: 5px; /* Adjust the gap as needed */
    align-items: center;
}

        /* General styling */
        body {
            font-family: "Helvetica Neue", Arial, sans-serif;
            font-size: 16px;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .header-row {
            background-color: #00d9a5;
            color: black;
        }

        .data-row {
            background-color: #f7f7f7;
            color: black;
        }

        .data-row:nth-child(even) {
            background-color: #e6e6e6;
        }

        /* Search bar styling */
        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-container input[type="text"] {
            padding: 10px;
            width: 300px;
            color: black;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-right: 10px;
        }

        .search-container button {
            padding: 10px;
            background-color: #00d9a5;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Radio button styling */
        .radio-container {
            text-align: center;
            margin: 20px 0;
        }

        /* Action buttons styling */
        .action-buttons button {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
        }

        .action-buttons button.delete {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        @include('labassistant.sidebar')
        @include('labassistant.navbar')

        <div class="container-fluid page-body-wrapper">
        <div style="padding-top: 30px;">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
                <button type="button" class="close" data-bs-dismiss="alert">x</button>
            </div>
            @endif
            <!-- Add the message container here -->
            <div class="alert-message-container"></div>
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search by Test Name">
            </div>
            <form action="{{ url('add') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Add the section for adding a new record -->
                <div class="add-record-container p-4 rounded border">
                    <h2 class="mb-3">Add New Test</h2>
                    <div class="form-group mb-3">
                        <label for="newTestName">Test Name:</label>
                        <input type="text" id="newTestName" class="form-control" placeholder="Enter Test Name" style="color: black;" name="newTestName" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="newCharges">Charges:</label>
                        <input type="text" id="newCharges" class="form-control" placeholder="Enter Charges" style="color: black;" name="newCharges" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="addRecordButton" class="btn btn-success">Add Record</button>
                    </div>
                </div>
            </form>
            
                <table id="nurseTable">
                    <tr class="header-row">
                        <th width="500px">Test Name</th>
                        <th width="200px">Charges</th>
                        <th width="300px">Action</th>
                    </tr>
                    @foreach($data as $test)
                    <tr class="data-row" data-id="{{ $test->id }}">
                        <td class="test-name">{{ $test->test_name }}</td>
                        <td class="charges">{{ $test->charges }}</td>
                        <td class="action-buttons">
                            <div class="button-group">
                                <button class="edit-button btn btn-primary" data-id="{{ $test->id }}">Edit</button>
                                <button class="update-button btn btn-danger" data-id="{{ $test->id }}" style="display: none;">Update</button>
                                <button class="cancel-button btn btn-danger" data-id="{{ $test->id }}" style="display: none;">Cancel</button>
                                <button class="delete-button btn btn-secondary" data-id="{{ $test->id }}">Delete</button>
                            </div>
                            
                        </td>
                    </tr>

                    @endforeach

                </table>
            </div>
        </div>
    </div>
    @include('labassistant.script')
   <!-- Include Axios library -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
      // Function to handle edit button click
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('edit-button')) {
            const row = event.target.closest('.data-row');
            const testNameCell = row.querySelector('.test-name');
            const chargesCell = row.querySelector('.charges');
            const updateButton = row.querySelector('.update-button');
            const cancelButton = row.querySelector('.cancel-button');
            const deleteButton = row.querySelector('.delete-button');

            testNameCell.contentEditable = true;
            chargesCell.contentEditable = true;
            testNameCell.classList.add('editable');
            chargesCell.classList.add('editable');
            updateButton.style.display = 'block';
            cancelButton.style.display = 'block'; // Show the cancel button
            deleteButton.style.display = 'none';
            event.target.style.display = 'none';
            testNameCell.focus();
        }
    });


      // Function to handle cancel button click
      document.addEventListener('click', function(event) {
        if (event.target.classList.contains('cancel-button')) {
            const row = event.target.closest('.data-row');
            const testNameCell = row.querySelector('.test-name');
            const chargesCell = row.querySelector('.charges');
            const updateButton = row.querySelector('.update-button');
            const cancelButton = row.querySelector('.cancel-button');
            const editButton = row.querySelector('.edit-button');
            const deleteButton = row.querySelector('.delete-button');

            // Revert changes and hide the cancel button
            testNameCell.contentEditable = false;
            chargesCell.contentEditable = false;
            testNameCell.classList.remove('editable');
            chargesCell.classList.remove('editable');
            updateButton.style.display = 'none';
            cancelButton.style.display = 'none';
            editButton.style.display = 'block';
            deleteButton.style.display = 'block';
        }
    });

        // Function to handle update button click
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('update-button')) {
                const row = event.target.closest('.data-row');
                const testId = row.getAttribute('data-id');
                const testNameCell = row.querySelector('.test-name');
                const chargesCell = row.querySelector('.charges');

                const updatedTestName = testNameCell.textContent;
                const updatedCharges = chargesCell.textContent;

                axios.put('/update/' + testId, {
                    test_name: updatedTestName,
                    charges: updatedCharges
                })
                .then(function(response) {
                    // Handle success, e.g., show success message
                    console.log(response.data.message);

                    testNameCell.classList.remove('editable');
                    chargesCell.classList.remove('editable');

                    testNameCell.contentEditable = false;
                    chargesCell.contentEditable = false;

                    row.querySelector('.edit-button').style.display = 'block';
                    row.querySelector('.delete-button').style.display = 'block';
                    row.querySelector('.update-button').style.display = 'none';

                    const messageContainer = document.querySelector('.alert-message-container');
                    messageContainer.innerHTML = `
                        <div class="alert alert-success">
                            <button type="button" class="close" data-bs-dismiss="alert">x</button>
                            ${response.data.message}
                        </div>`;
                })
                .catch(function(error) {
                    console.error(error);
                });
            }
        });

        // Function to handle delete button click
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-button')) {
                const testId = event.target.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this record?')) {
                    axios.delete('/delete/' + testId)
                        .then(function(response) {
                            const row = document.querySelector('.data-row[data-id="' + testId + '"]');
                            if (row) {
                                row.remove();
                                const successMessage = response.data.message;
                                const messageContainer = document.querySelector('.alert-message-container');
                                messageContainer.innerHTML = `
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-bs-dismiss="alert">x</button>
                                        ${successMessage}
                                    </div>`;
                            }
                        })
                        .catch(function(error) {
                            console.error(error);
                        });
                }
            }
        });

        // Function to filter and display rows based on search input
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchInput = this.value.toLowerCase();
        const rows = document.querySelectorAll('.data-row');

        rows.forEach(row => {
            const testNameCell = row.querySelector('.test-name').textContent.toLowerCase();
            if (testNameCell.includes(searchInput)) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    });

   
</script>

</body>
</html>
