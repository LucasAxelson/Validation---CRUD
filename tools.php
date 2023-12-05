<?php

// Validates and Sanitizes Data before input into server.
function test_input($input) {
  $input = trim($input);
  $input = stripslashes($input);
  $input = htmlspecialchars($input, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
  return $input;
}

// Verifies Password Strength prior to acceptance into system.
function checkPasswordStrength ($data) {
  //Define password strength requirements using regular expressions.
   $uppercase = preg_match('@[A-Z]@', $data);
   $lowercase = preg_match('@[a-z]@', $data);
   $number = preg_match('@[0-9]@', $data);
   $specialChar = preg_match('@[^\w]@', $data);
   
   // Define minimum length for the password
   $minLength = 8;
   
   // Check if the password meets all the requirements
   if ($uppercase && $lowercase && $number && $specialChar && strlen($data) >= $minLength) {
       return true;
   } else {
       return false;
   }
}

function displayError($error) {
  if(!empty($error)) { echo "<Span class=\"word-error\">Error: </Span>" . $error; }
}

function inputUser($username = NULL, $password = NULL, $created = NULL) {
  global $conn;
  if($query_users = $conn->prepare("INSERT INTO users (username, password, created) VALUES (?, ?, ?)")->execute([$username, $password, $created])) {
        unset($username, $password, $created);  
        header("Location: http://localhost/projects/validation/overview.php");
        exit();
  } else { echo "Redirect unsuccessful."; }
}

function prepareUser($errors) {

global $errors;

  try {
    if(isset($_POST['form_submit'])) {
       $post_username = $_POST['user_name'];  
       $post_password = $_POST['user_password'];
       if(!checkPasswordStrength($post_password)) {
        $errors['password_err'] = "Please use lowercases, uppercases, numbers and special characters. 8 characters length minimum.";
        return $errors;
       } else if (!trim($post_username) == "" && checkPasswordStrength($post_password)) {
       $username = test_input($post_username);
       
       $post_password = test_input($post_password);
       $password = password_hash($post_password, PASSWORD_DEFAULT);
       
       $created = date("Y-m-d H:i:s");
       
       inputUser($username, $password, $created);

     }  else if (trim($post_username) == "") {
      $errors['username_err'] = "Please input a valid username.";     
    } else {
       $errors['password_err'] = "Please input a valid password.";
      }
   
   }
 } catch(PDOException $e) {echo "error";}
}
?>