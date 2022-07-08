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
     // Task B
    // CHECK TO SEE IF THE PAGE HAS VALIDATED
    /**
     * 1. Check if $valid is true  i.e ALL form fields are valid
     * 2. If yes, output the <div class = 'results'> provided in sample-output.html
     * 3. Remember to update the hardcoded fields with PHP variables
     *      a. For date and email, you can simply echo the values stored in $_POST
     *      b. For favorite animals, you can loop through the animals array and print out an <ul> where each animal is an <li>
     **/
    if ($valid == true){
      // TODO: add <?php> tags for all the variables
      echo "
      <div class = 'results'>
      <div class = 'result-text'>Your email address is: <?php $_POST["email"]?> </div>
      <div class = 'result-text'>Your favorite animals are: <ul>"; // Use foreach
      foreach($_POST("animals") as $value){
        echo "<li>".$value."</li>";
      }
      echo "</ul></div>
      <div class = 'result-text'>Your favourite date is: <?php $_POST["date"]?> </div>
      </div>
      ";
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

      // Task A start
      // Check if form in correct format
      /**
       * 1. Check if the "email" and "date" values aree set in $_POST: eg. if(isset($_POST["email"] ....))
       * 2. If yes, do the following:
       *    a. Loop through $_POST. For instance you could use foreach($_POST as $type => $value)
       *    b. if the $type is email, use the regex pattern provided to check if the form field is valid.
       *        i. If yes, set the $val_messages[$type] to "" - indicating that the field is valid.
       *        ii. Else, set the $val_messages[$type] to an error message - indicating that the field is invalid.
       *    c. Use the same approach for validating the $date field with the regex pattern provided.
       * 3. Else, echo an error message.
       * 4. Now finally validate the animals checkbox.
       *    a. Similar to date and email, check if $_POST['animals'] is set.
       *    b. Additionally, also check if >= 3 checboxes have been checked. Hint: you can use count() to get the length of $_POST['animals']
       *        i. If the above avaluates to true - this means the field is valid - so set an empty message in $val_messages['animals']
       *        ii. Otherwise, set an error message.
       * 5. If you code reaches this state, it means all fields are valid - we can set the global $valid variable to true and return.
       * */

      // VARIABLES
      // $date = $_POST["date"];
      // $email = $_POST("email");
      // $animals = $_POST["animals"];
      // $checkboxes = $_POST["checkbox"];

      // EMAIL
      // if (empty($_POST[$email])){
      if(isset($_POST["email"]) && isset($_POST["date"])){
        // array_push($val_messages, "You must enter an email!");
        foreach($_POST as $type => $value){
          if ($type == "email"){
            $email = $_POST["email"];
            $eChecker= '#^(.+)@([^\.].*)\.([a-z]{2,})$#';
            if(preg_match($eChecker, $email)){
              $val_messages[$email] = "";
            }
            else {
              $val_messages[$email] = "Nice try on attempting to scam me with an invalid email!";
            }
          }
          if ($type == "date"){
            $date = $_POST["date"];
            $dChecker = '#^\d{4}/((0[1-9])|(1[0-2]))/((0[1-9])|([12][0-9])|(3[01]))$#';
            if (preg_match($dChecker, $date)){
              $val_messages[$date] = "";
            }
            else{
              $val_messages[$date] = "Are you playing dumb? That is not the correct format for a date!";
            }
          }
        }
      }

      // DATE
      // if (isset($_POST["date"])){
      //   foreach($_POST as $type => $value){
          // if (preg_match('#^\d{4}/((0[1-9])|(1[0-2]))/((0[1-9])|([12][0-9])|(3[01]))$#', $_POST($type))){
          //   $val_messages[$type] = "";
          // }
          // else{
          //   $val_messages[$type] = "Are you playing dumb? That is not the correct format for a date!";
          // }
      //   }
      // }
      // else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
      //   array_push($val_messages, "The format of your email is WRONG!");
      // }

      // else {
      //   $count++;
      //   array_push($val_messages, "");
      // }

      // ANIMALS
      if (isset($_POST["animals"])){
        if (count($_POST["animals"]) >= 3){
          $val_messages["animals"] = "";
        }
        else {
          $val_messages["animals"] = "Oi! Did you read the instructions? Choose 3 or more!";
        }
      }
      // if (count($checkboxes) < 3){
      //   array_push($val_messages, "You must choose at least 3!");
      // }

      // else {
      //   $count++;
      // }

      // if (preg_match("#^\d{4}/((0[1-9])|(1[0-2]))/((0[1-9])|([12][0-9])|(3[01]))$#", $date)){
      //   $count++;
      // }
      
      // if ($count == 3){
      //   $valid = true;
      // }
      foreach($val_messages as $value){
        if ($value != ""){
          return;
        }
      }

      $valid = true;
    }
}

// Display error message if field not valid. Displays nothing if the field is valid.
function the_validation_message($type) {

  global $val_messages;

  if($_SERVER['REQUEST_METHOD']== 'POST')
  {
    // TODO: Task C
    /**
     * 1. If the global val_messages array has a value set (e.g please choose at least three animals) for a particular $type, return a <p> tag with value stored: $val_messages[$type]
     * 2. For the <p> tag, you should use the 'failure-message' class provided in the CSS file.
     * */
    // TODO: add isset and if type is animals
    if (isset($val_messages[$type]) || (type == "animals" && isset($_POST["animals"]))){
      echo "<p class = 'failure-message'>";
      $toPrint = $val_messages[$type];
      echo $toPrint;
      echo "</p>";
    }
  }
}
