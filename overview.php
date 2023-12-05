<?php require("server.php"); ?>
<?php require("tools.php"); ?>
<?php require("includes/header.php"); ?>


<body>
  <main>
    <h2>Overview of Users</h2>

    <div class="container">

      <div class="row">
        <div class="input-group flex-nowrap mb-3">
          <?php if(!empty($user_name)) { echo "<span class=\"input-group-text\" id=\"basic-addon1\">Username: </span><p>" . $user_name . "</p>"; }?>
       </div>
        <div class="col-6">
          <?php if(!empty($user_name)) { echo "<span class=\"input-group-text\" id=\"basic-addon1\">Username: </span><p>" . $user_name . "</p>"; }?>
        </div>
      </div>

    </div>
  </main>
</body>
</html>

<?php require("includes/footer.php"); ?>
