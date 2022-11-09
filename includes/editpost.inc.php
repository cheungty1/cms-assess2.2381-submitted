<?php
  // 1. Check User Clicked Edit-Submit Button + Logged In
  session_start();
  if(isset($_POST['edit-submit']) && isset($_SESSION['userId'])){
    // 2. Connect to DB
    require 'connect.inc.php';

    // 3. Collect & store POST data
    $id = mysqli_real_escape_string($conn, $_GET['id']); 
    $id = intval($id);
    $title = $_POST['title'];
    $imageURL = $_POST['imageurl'];
    $comment = $_POST['comment'];
    $websiteTitle = $_POST['websitetitle'];
    $websiteURL = $_POST['websiteurl'];
    $author = $_POST['author'];

    // 4. VALIDATION: Check if any fields are empty (v. similar to createpost / login)
    if (empty($id) || empty($title) || empty($imageURL) || empty($comment) || empty($websiteTitle) || empty($websiteURL) || empty($author)) {
      // ERROR: Redirect + error via GET
      header("Location: ../editpost.php?id=$id&error=emptyfields");
      exit();

    // 5. Save (BY UPDATE) Edited Post to DB using Prepared Statements
    } else {
      // (i) Declare Template SQL with ? Placeholders to update values for row in posts table (7 PLACEHOLDERS (including Author))
      $sql = "UPDATE posts SET title=?, imageurl=?, comment=?, websitetitle=?, websiteurl=?, author=? WHERE id=?"; 

      // (ii) Init SQL statement
      $statement = mysqli_stmt_init($conn);

      // (iii) Prepare + send statement to database to check for errors
      if(!mysqli_stmt_prepare($statement, $sql))
      {
        // ERROR: Something wrong when preparing the SQL
        header("Location: ../editpost.php?id=$id&error=sqlerror"); 
        exit();
      } else {
        // (iv) SUCCESS: Bind our user data with statement + escape strings
        // NOTE: We bind SIX strings and ONE integer!
        mysqli_stmt_bind_param($statement, "ssssssi", $title, $imageURL, $comment, $websiteTitle, $websiteURL, $author, $id);

        // (v) Execute the SQL Statement with user data
        mysqli_stmt_execute($statement);

        // (vi) SUCCESS: Edited post is updated for specific row in "posts" table - redirect with success message
        header("Location: ../posts.php?id=$id&edit=success"); 
        exit();
      }
    }

  // 6. Restrict Access to Edit Script Page, user MUST be LOGGED IN & HIT SUBMIT to access
  } else {
    header("Location: ../signup.php");
    exit();
  }
?>