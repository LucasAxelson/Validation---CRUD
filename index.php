<?php require("server.php"); ?>
<?php require("tools.php"); ?>
<?php require("includes/header.php"); ?>

<?php

$errors = Array ( 
  'username_err' => "",
  'password_err' => "",
);

$user_name = $user_password = $created = "";

prepareUser($errors);

?>

<body>
 <div class="container d-flex justify-content-center"> 
  <div class="col-lg-6 d-flex flex-column">
     
     <h2 class="text-center my-4" >Please create an account</h2>
  
    <form action="index.php" method="POST">

      <div class="input-group-md">
        <input class="form-control py-2 my-4" type="text" name="user_name" placeholder="Please insert a username" required>
      
        <div class="div-error">
          <p class = "paragraph-error"><?php displayError($errors['username_err']) ?></p>
        </div>
      </div>

      <div class="form-group">
        <input class="form-control py-2 my-4" type="password" name="user_password" placeholder="Please insert a password" required>
      
        <div class="div-error">
         <p class = "paragraph-error"><?php displayError($errors['password_err']) ?></p>
        </div>
   
      </div>

      <input type="submit" class="btn btn-primary" name="form_submit" value="Submit">
    </form>
  </div>

<?php require("includes/footer.php"); ?>
