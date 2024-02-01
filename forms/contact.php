<?php
/**
 * Requires the "PHP Email Form" library
 * The "PHP Email Form" library is available only in the pro version of the template
 * The library should be uploaded to: vendor/php-email-form/php-email-form.php
 * For more info and help: https://bootstrapmade.com/php-email-form/
 */

// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'chaimakechtaf7@g.com';

// Check if the PHP Email Form library exists
$php_email_form_path = '../assets/vendor/php-email-form/php-email-form.php';

if (file_exists($php_email_form_path)) {
    include($php_email_form_path);

    // Check if the class PHP_Email_Form exists after inclusion
    if (class_exists('PHP_Email_Form')) {
        // Check if form variables are set
        if (
            isset($_POST['name']) &&
            isset($_POST['email']) &&
            isset($_POST['subject']) &&
            isset($_POST['message'])
        ) {
            // Create an instance of PHP_Email_Form
            $contact = new PHP_Email_Form;
            $contact->ajax = true;

            $contact->to = $receiving_email_address;
            $contact->from_name = $_POST['name'];
            $contact->from_email = $_POST['email'];
            $contact->subject = $_POST['subject'];

            // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
            /*
            $contact->smtp = array(
              'host' => 'example.com',
              'username' => 'example',
              'password' => 'pass',
              'port' => '587'
            );
            */

            // Add messages with basic validation and sanitation
            $contact->add_message(filter_var($_POST['name'], FILTER_SANITIZE_STRING), 'From');
            $contact->add_message(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL), 'Email');
            $contact->add_message(filter_var($_POST['message'], FILTER_SANITIZE_STRING), 'Message', 10);

            // Send the email and echo the result
            echo $contact->send();
        } else {
            echo 'Incomplete form data. Please fill in all the required fields.';
        }
    } else {
        die('The "PHP_Email_Form" class is not found in the library.');
    }
} else {
    die('Unable to load the "PHP Email Form" Library!');
}
?>
