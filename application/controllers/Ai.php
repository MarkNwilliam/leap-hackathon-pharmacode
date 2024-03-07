<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ai extends CI_Controller {

    public function export_to_csv() {
        $result = $this->db->select('*')
                           ->from('product_information')
                           ->get()
                           ->result_array(); // Execute query and get result as array
    
        echo '<script>';
        if (empty($result)) {
            echo 'console.log("Result is empty");';
        } else {
            echo 'console.log(' . json_encode($result) . ');'; // Convert PHP array to JSON for logging
        }
        echo '</script>';
    }
    

    public function chatbot() {
        // Your chatbot implementation logic goes here
        // For example:
        $data['message'] = 'Hello, how can I assist you today?';
        $this->load->view('Ai/chatbot', $data); // Assuming you have a view file named chatbot_view.php
    }

    public function predictive_analysis() {
        // Your predictive analysis implementation logic goes here
        // For example:
        $data['prediction'] = 'Based on our analysis, lets try to see the outcome.';
        $this->load->view('Ai/predictive_analysis', $data); // Assuming you have a view file named predictive_analysis_view.php
    }

    public function customerbot() {
        // Your chatbot implementation logic goes here
        // For example:
        $data['message'] = 'Hello, lets find out more abut our customers?';
        $this->load->view('Ai/customerbot', $data); // Assuming you have a view file named chatbot_view.php
    }

    public function employeebot() {
        // Your predictive analysis implementation logic goes here
        // For example:
        $data['prediction'] = 'let find out more about our employees.';
        $this->load->view('Ai/employeebot', $data); // Assuming you have a view file named predictive_analysis_view.php
    }

    public function manufacturerbot() {
        // Your chatbot implementation logic goes here
        // For example:
        $data['message'] = 'Hello, lets find out more abut our manufacturers?';
        $this->load->view('Ai/manufacturerbot', $data); // Assuming you have a view file named chatbot_view.php
    }

    public function supplierbot() {
        // Your predictive analysis implementation logic goes here
        // For example:
        $data['prediction'] = 'Hello, lets find out more abut our suppliers?';
        $this->load->view('Ai/supplierbot', $data); // Assuming you have a view file named predictive_analysis_view.php
    }

    public function taxbot() {
        // Your predictive analysis implementation logic goes here
        // For example:
        $data['prediction'] = 'Hello, lets find out more abut our taxes?';
        $this->load->view('Ai/taxbot', $data); // Assuming you have a view file named predictive_analysis_view.php
    }


}
