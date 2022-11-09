<!-- HEADER.PHP -->
<?php 
  require "header.php"
?>

  <main class="container" style="width: 100%">

    <?php
      // 1. QUERY DATABASE for ALL POSTS

      // (i) Connect to Database
      require './includes/connect.inc.php';

      // (ii) Declare SQL command to DB to retrieve ALL rows from posts table in DB
      $sql = "SELECT id, title, imageurl, comment, websitetitle, websiteurl, author FROM posts";

      // (iii) Call query & store result in variable
      $result = mysqli_query($conn, $sql);
    ?>

    <?php 
      // DYNAMIC MESSAGE FOR POST CREATION
      if(isset($_GET['post']) == "success"){
        echo '<div class="alert alert-success" role="alert">
          Post created!
        </div>';  
      } else if(isset($_GET['edit']) == "success"){
        echo '<div class="alert alert-success" role="alert">
          Post edited!
        </div>'; 
      }

      // DYNAMIC ERROR/SUCCESS MESSAGES FOR DELETE
      if(isset($_GET['error'])){
        // (i) Internal server error 
        if ($_GET['error'] == "sqlerror") {
          $errorMsg = "An internal server error has occurred - please try again later";
        }

        // (ii) Dynamic Error Alert based on Variable Value 
        echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';

      // (iii) Display SUCCESS message for correct login
      } else if (isset($_GET['delete']) == "success"){
        echo '<div class="alert alert-success" role="alert">
          Post successfully deleted!
        </div>';    
      }
    ?>
    <!-- Bootstrap custom classes for resposive cards -->
    <div class="row row-cols-1 row-cols-md-3 g-4">

    <?php
      // 2. CHECK FOR POSTS RETURNED RESULT & DISPLAY ON SUCCESS
      // (2.1) Success: Display Posts
      if(mysqli_num_rows($result) > 0){

        // 3. LOOP DATA INTO OUR BOOTSTRAP CARD TEMPLATE
        // (3.1) New variable with default state
        $output = "";

        // (3.2) Take result -> convert to array & then insert into While Loop
        while($row = mysqli_fetch_assoc($result)) {

          // (3.3) Join output cards together with .=
          $output .= 

          // (3.4) Dynamic Data into Cards using Concatenation of Variables
          // Variables: id, imageurl, title, comment, author, websiteurl, websitetitle
          // Added extra field of author
          '
            <div class="col">
              <div class="card" id="' . $row['id'] . '">
                <img src="' . $row['imageurl'] . '" class="card-img-top post-image" alt="' . $row['title'] . '">
                <div class="card-body">
                  <h5 class="card-title">' . $row['title'] . '</h5>
                  <p class="card-text">' . $row['comment'] . '</p>
                  <p class="card-text">' . $row['author'] . '</p>
                  <a href="' . $row['websiteurl'] . '" class="btn btn-primary w-100">' . $row['websitetitle'] . '</a>';
                  
                  // (3.5) Restrict Edit/Delete Button ONLY to logged in users (can see by default!)
                  // (3.6) Setup Edit/ Delete Pages
                  if(isset($_SESSION['userId'])){
                    $output .= '
                    <div class="admin-btn">
                      <a href="editpost.php?id=' . $row['id'] . '" class="btn btn-secondary mt-2">Edit</a>
                      <a href="includes/deletepost.inc.php?id=' . $row['id'] . '" class="btn btn-danger mt-2">Delete</a>
                    </div>';
                  }

            $output .= 
            '
                </div>
              </div>
            </div>
            ';
        }
        // (3.iii) Echo out the result of the loop
        echo $output;

      // (2.ii) Error: Template Error Message
      } else {
        echo "0 results";
      }
      // (2.iii) Close Connection
      mysqli_close($conn);
    ?>
      <!-- Close off div, for Bootstrap custom classes for resposive cards -->
      </div>
  </main>

<!-- FOOTER.PHP -->
<?php 
  require "footer.php"
?>