<?php 
require("server.php");

function test_input($input) {
  $input = trim($input);
  $input = stripslashes($input);
  $input = htmlspecialchars($input, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
  return $input;
}

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

  $user_name_err = $user_password_err = "";

  try {
   if(isset($_POST['form_submit'])) {
      $post_username = $_POST['user_name'];  
      $post_password = $_POST['user_password'];
      global $user_password_err, $user_name_err;
      if(!checkPasswordStrength($post_password)) {
      $user_password_err = "Please use lowercases, uppercases, numbers and special characters. 8 characters length minimum.";
      } else if (!trim($post_username) == "" && checkPasswordStrength($post_password)) {
      $user_name = test_input($post_username);
      $post_password = test_input($post_password);
      
      $user_password = password_hash($post_password, PASSWORD_DEFAULT);
      
      $created = date("Y-m-d H:i:s");

      $query_users = $conn->prepare("INSERT INTO users (username, password, created) VALUES (?, ?, ?)")->execute([$user_name, $user_password, $created]);
      unset($user_name, $password, $created);  
    } else {
      $user_name_err = "Please input a valid username.";
      $user_password_err = "Please input a valid username.";
    }
  
  }
} catch(PDOException $e) {echo "error";}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>Validation</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body>
 <div class="container"> 
   
   <div class="col-lg-6">
     
     <h3>Please create an account</h3>
  
  <form action="index.php" method="POST">
  
    <div class="input-group-md">
     <label class="mb-3" for="username">Username</label>
      <input class="form-control mb-2" type="text" name="user_name" placeholder="Please insert a username" required>
     <div class="div-error">
       <p class = "paragraph-error"><?php if(!empty($user_name_err)) { echo "<Span class=\"word-error\">Error: </Span>" . $user_name_err; }?></p>
     </div>
   </div>

   <div class="form-group">
     <label class="mb-3" for="username">Password</label>
     <input class="form-control mb-2" type="password" name="user_password" placeholder="Please insert a password" required>
     <div class="div-error">
       <p class = "paragraph-error"><?php if(!empty($user_password_err)) { echo "<Span class=\"word-error\">Error: </Span>" . $user_password_err; }?></p>
     </div>
    </div>

    <input type="submit" class="btn btn-primary" name="form_submit" value="Submit">
    </form>
  </div>
  </div>
</body>
</html>