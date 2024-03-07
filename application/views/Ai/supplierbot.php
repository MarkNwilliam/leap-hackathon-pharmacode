<!-- Include Bootstrap CSS from CDN -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Chatbot section start -->
<div class="content-wrapper">
    <style>
        /* Custom CSS for Chatbot section */
        .chatbot-section {
            text-align: center;
            padding: 20px;
        }

        .chatbot-title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .breadcrumb {
            justify-content: center;
        }

        .breadcrumb .breadcrumb-item {
            padding: 0;
        }

        .user-input {
            margin-top: 20px;
        }

        .user-input input[type="text"] {
            margin-bottom: 10px;
        }

        .user-input button#sendMessage {
            margin-top: 10px;
            background-color: #28a745; /* Green color */
            color: #fff; /* White text */
            border: none; /* No border */
            border-radius: 5px; /* Rounded corners */
            padding: 10px 20px; /* Padding */
            cursor: pointer; /* Cursor style on hover */
            transition: background-color 0.3s; /* Smooth background color transition */
        }

        .user-input button#sendMessage:hover {
            background-color: #218838; /* Darker green color on hover */
        }

        /* Custom class to style the "Home" text */
        .green-text {
            color: #28a745; /* Green color */
        }
    </style>

    <section class="content-header chatbot-section">
        <div class="header-icon">
            <i class="fa fa-comments"></i>
        </div>
        <div class="header-title">
            <h1 class="chatbot-title">Suppiler bot</h1>
            <small>Interactive Chat Interface</small>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/pharmacy_test/" class="green-text"><i class="pe-7s-home"></i> Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chatbot</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="content">
        <!-- Chatbot UI -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Chatbot Interface</h3>
                    </div>

                    <div class="panel-body">
                        <!-- Display product information -->
                       
        <!-- Display content of each row -->
<?php
// Load database if not already loaded
$this->load->database();

// Fetch product information from the database
$query = $this->db->get('supplier_information');
$result = $query->result_array();
?>




                    <div class="panel-body">
                        <!-- Prompt window -->
                        <div class="prompt-window">
                            <div class="prompt">
                                <p>Welcome! How can I assist you today?</p>
                            </div>
                        </div>
                        <!-- Response window -->
                        <div class="response-window">
                            <!-- Chatbot response messages will appear here -->
                        </div>
                        <!-- User input -->
                        <div class="user-input">
                            <input type="text" id="userMessage" class="form-control" placeholder="Type your message...">
                            <button id="sendMessage" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Chatbot section end -->

<!-- Include Bootstrap JS from CDN -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Log data to browser console
    console.log(<?php echo json_encode($result); ?>);

    // Parse the JSON string to a JavaScript object
    var result = <?php echo json_encode($result); ?>

    console.log(result);

    var resultString = JSON.stringify(result);

     // Check if the result variable is a string
     if (typeof resultString === 'string') {
        console.log('resultString is a string');
    } else {
        console.log('resultString is not a string');
    }


    document.getElementById('sendMessage').addEventListener('click', function() {
        var userMessage = document.getElementById('userMessage').value;

        // Create JSON data with prompt
        var requestData = {
            "prompt": userMessage,
            "csvData": resultString 
        };

        // Send AJAX request to the FastAPI server
        fetch('http://localhost:8000/generate-response', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(requestData)
        })
        .then(response => response.json())
        .then(data => {
            // Display bot response
            var responseMessageElement = document.createElement('div');
            responseMessageElement.textContent = 'Bot: ' + data.message;
            document.querySelector('.response-window').appendChild(responseMessageElement);

            // Clear user input field
            document.getElementById('userMessage').value = '';
        })
        .catch(error => console.error('Error:', error));
    });
</script>