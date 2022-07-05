<?php
// Global result of form validation
$valid = false;
// Global array of validation messages. For valid fields, message is ""
$val_messages = Array();
$count = 0;

// Output the results if all fields are valid.
function the_results()
{
  global $valid;

  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    if ($valid == true){
      echo "<div class = 'results'>";
      echo "<p class = 'result-text'>email";
      echo "<br>";
      echo "animals";
      echo "<br>";
      echo "date</p>";
      echo "</div>";
    }
  }
}

// Check each field to make sure submitted data is valid. If no boxes are checked, isset() will return false
function validate()
{
    global $valid;
    global $val_messages;
    global $count;

    if($_SERVER['REQUEST_METHOD']== 'POST')
    {
      // Use the following patterns to validate email and date or come up with your own.
      // email: '#^(.+)@([^\.].*)\.([a-z]{2,})$#'
      // date: '#^\d{4}/((0[1-9])|(1[0-2]))/((0[1-9])|([12][0-9])|(3[01]))$#'

      $date = $_POST("date");
      $email = $_POST("email");
      $animals = $_POST["animals"];
      if (empty($_POST[$email])){
        array_push($val_messages, "You must enter an email!");
      }

      else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($val_messages, "The format of your email is WRONG!");
      }

      else {
        $count++;
        array_push($val_messages, "");
      }

      if (isset($_POST[$animals])){
        array_push($val_messages, "You must choose at least 3!");
      }

      else {
        $count++;
      }

      if (preg_match("#^\d{4}/((0[1-9])|(1[0-2]))/((0[1-9])|([12][0-9])|(3[01]))$#", $date)){
        $count++;
      }
      
      if ($count == 3){
        $valid = true;
      }
    }
}

// Display error message if field not valid. Displays nothing if the field is valid.
function the_validation_message($type) {

  global $val_messages;

  if($_SERVER['REQUEST_METHOD']== 'POST')
  {
    if ($valid == false){
      echo $val_messages;
    }
  }
}
