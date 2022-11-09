<?php
  // 1. Check User is Logged In + Id passed in via GET (before they can delete - proper authorisation)
  session_start();
  if(isset($_SESSION['userId']) && isset($_GET['id'])){
    // 2. Connect to DB
    require 'connect.inc.php';

    // 3. Collect, escape string & store POST data
    $id = mysqli_real_escape_string($conn, $_GET['id']); 

    // 4. Check that data is an integer (ensure random letters/symbols aren't passed in!)
    $id = intval($id);

    // 5. Delete Post from DB (Prepared Statements)
    // Use PREPARED STATEMENTS to defend against SQL injections
    // (i) Declare Template SQL with ? Placeholders to delete values from table
    $sql = "DELETE FROM posts WHERE id=?"; 

    // (ii) Init SQL statement
    $statement = mysqli_stmt_init($conn);

    // (iii) Prepare + send statement to database to check for errors
    if(!mysqli_stmt_prepare($statement, $sql))
    {
      // ERROR: Something wrong when preparing the SQL
      // NOTE: Pass in the id BACK to url & the error message
      header("Location: ../posts.php?id=$id&error=sqlerror"); 
      exit();
    } else {
      // (iv) SUCCESS: Bind our user data with statement + escape integer
      // NOTE: Bind ONE integer!
      mysqli_stmt_bind_param($statement, "i", $id);

      // (v) Execute the SQL Statement (to run in DB)
      mysqli_stmt_execute($statement);

      // (vi) SUCCESS: Post is deleted from "posts" table - redirect with success message
      header("Location: ../posts.php?id=$id&delete=success"); 
      exit();
    }

  // 6. Restrict Access to Script Page, user MUST be LOGGED IN to access
  } else {
    header("Location: ../signup.php");
    exit();
  }
?>