<!-- HEADER.PHP -->
<?php 
  require "header.php"
?>

<!--Body Section-->
<main>
  <section>
    <div class="container text-center">
      <div id= "bg"><p></p>
      </div>
    </div>
      
        <!--Bootstrap container class & title-->
    <div class="container mt-3 text-center">
      <h1 class="display-4">
        <i class="text-dark"></i>
          <strong>Travel</strong><em>Pedia</em>
      </h1>
    </div>

    <div class="container text-center">
      <p><em>Welcome to TravelPedia - </em><br>
        <em>Find, Post and Blog about your favourite Travel Destinations and reviews!</em>
          <br>Home page: 
        <em>Please Login or Signup to continue using CMS!</em></p>
      </div>

    <!-- 1. CONDITIONAL Log In and Sign Up button displayed if not Logged In -->
  <?php 
    if(!isset($_SESSION['userId'])){ 
      echo '<div class="container text-center"><button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#login-modal">
      Login
    </button>&nbsp;<a href="signup.php" class="btn btn-primary">Signup</a></div>';} 
  ?> 

  <div class="container mt-3" style="width: 100%">
    <!-- 2. CONDITIONAL Logged In/Logged Out Alerts -->
    <?php 
      // Checks the $_SESSION for user variable
      if(isset($_SESSION['userId'])){
        echo '<div class="alert alert-success" role="alert">You are logged in!</div>';
      }
      else
      {
        echo '<div class="alert alert-warning" role="alert">You are not logged in</div>';
      }
    ?>
  </div>
  </section>
  </main>



<!-- FOOTER.PHP -->
<?php 
  require "footer.php"
?>