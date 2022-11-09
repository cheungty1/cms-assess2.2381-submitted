<?php
  // 1. Start Session: 
  // NOTE: Only allow users to create posts if logged in
  session_start();

  // 2. Check user clicked submit button from createpost form + user is logged in
  if(isset($_POST['post-submit']) && isset($_SESSION['userId'])){
    // 3. Connect to database
    require 'connect.inc.php';

    // 4. Collect & store POST data
    $title = $_POST['title'];
    $imageURL = $_POST['imageurl'];
    $comment = $_POST['comment'];
    $websiteTitle = $_POST['websitetitle'];
    $websiteURL = $_POST['websiteurl'];
    $author = $_POST['author'];

    // 5. VALIDATION: Check if any fields are empty (v. similar to login)
    if (empty($title ) || empty($imageURL) || empty($comment) || empty($websiteTitle) || empty($websiteURL) || empty($author)) {
      // ERROR: Redirect + error via GET
      header("Location: ../createpost.php?error=emptyfields");
      exit();

    // 6. Save Post to DB using Prepared Statements
    } else {
      // (i) Declare Template SQL with ? Placeholders to save values to table
      $sql = "INSERT INTO posts VALUES (NULL, ?, ?, ?, ?, ?, ?)"; 

      // (ii) Init SQL statement
      $statement = mysqli_stmt_init($conn);

      // (iii) Prepare + send statement to database to check for errors
      if(!mysqli_stmt_prepare($statement, $sql))
      {
        // ERROR: Something wrong when preparing the SQL
        header("Location: ../createpost.php?error=sqlerror"); 
        exit();
      } else {
        // (iv) SUCCESS: Bind our user data with statement + escape strings
        // NOTE: Six strings - Added extra parameter of Author
        mysqli_stmt_bind_param($statement, "ssssss", $title, $imageURL, $comment, $websiteURL, $websiteTitle, $author);

        // (v) Execute the SQL Statement with user data
        mysqli_stmt_execute($statement);

        // (vi) SUCCESS: Post is saved to "posts" table - redirect with success message
        header("Location: ../posts.php?post=success"); 
        exit();
      }
    }

  // 7. Restrict Access to Script Page, user MUST be LOGGED IN & MUST CLICK SUBMIT 
  } else {
    header("Location: ../index.php");
    exit();
  }
?>
