<!-- HEADER.PHP -->
<?php 
  require "header.php"
?>

  <main class="container p-4 bg-light mt-3" style="width: 100%">
    <?php
      // 1. Check User is Logged In + Id passed in via GET
      if(isset($_SESSION['userId']) && isset($_GET['id'])){
        // 2. Connect to DB
        require './includes/connect.inc.php';
  
        // 3. Declare variable called $row to store array with our DB data to display (later)
        $row;
  
        // 4. Collect, escape string & store POST data
        $id = mysqli_real_escape_string($conn, $_GET['id']); 
        $id = intval($id);
  
        // 5. Declare SQL command to extract data from DB relating to post id (Prepared Statements)
        // (i) Declare Template SQL with ? Placeholders to select values for SPECIFIC post id
        $sql = "SELECT title, imageurl ,comment, websitetitle, websiteurl, author FROM posts WHERE id=?";
  
        // (ii) Init SQL statement
        $statement = mysqli_stmt_init($conn);
  
        // (iii) Prepare + send statement to database to check for errors
        if(!mysqli_stmt_prepare($statement, $sql))
        {
          // ERROR: For if something goes wrong when preparing the SQL
          // NOTE: Pass in the id BACK to url & the error message.
          header("Location: editpost.php?id=$id&error=sqlerror"); 
          exit();
        } else {
          // (iv) SUCCESS: Bind our user data with statement
          // NOTE: Bind ONE integer!
          mysqli_stmt_bind_param($statement, "i", $id);
  
          // (v) Execute the SQL Statement (to run in DB)
          mysqli_stmt_execute($statement);
  
          // (vi) SUCCESS: Store result & convert to array ($row declared above at 2.)
          $result = mysqli_stmt_get_result($statement);
          $row = mysqli_fetch_assoc($result);
  
        // 6. NOW: PRE-POPULATE data IF we have it from the $row variable in form below
        }

      // 7. Restrict Access to Edit Page
      } else {
        header("Location: index.php");
        exit();
      }
    ?>

    <?php 
      // 8. DYNAMIC ERROR ALERTS FOR EDIT POST
      if(isset($_GET['error'])){
        // (8.1) Empty fields validation 
        if($_GET['error'] == "emptyfields"){
          $errorMsg = "Please fill in all fields";

        // (8.2) Internal server error 
        } else if ($_GET['error'] == "sqlerror") {
          $errorMsg = "An internal server error has occurred - please try again later";
        }

        // (8.3) Dynamic Error Alert based on Variable Value 
        echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';

        // (8.4). SUCCESS MESSAGE: Post updated successfully to DB -> Then from editpost.inc.php, redirect user to posts.php
      }
    ?>

    <!-- 9. Send ID via GET ALONG with our POST form data to update the DB-->
    <!-- Attach $id to the action using php to make it dynamic -->
    <form action="includes/editpost.inc.php?id=<?php echo $id ?>" method="POST">
      <h2>Edit Post</h2>

      <!-- 1. TITLE -->
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" id="title" class="form-control" name="title" placeholder="Title" value="<?php echo $row['title'] ?>">
      </div>  

      <!-- 2. IMAGE URL -->
      <div class="mb-3">
        <label for="imageurl" class="form-label">Image URL</label>
        <input type="text" id="imageurl" class="form-control" name="imageurl" placeholder="Image URL" value="<?php echo $row['imageurl'] ?>" >
      </div>

      <!-- 3. COMMENT SECTION -->
      <div class="mb-3">
        <label for="comment" class="form-label">Comment</label>
        <textarea id="comment" class="form-control" name="comment" rows="3" placeholder="Comment"><?php echo $row['comment'] ?></textarea>
      </div>

      <!-- 4. WEBSITE TITLE -->
      <div class="mb-3">
        <label for="websitetitle" class="form-label">Website Title</label>
        <input type="text" id="websitetitle" class="form-control" name="websitetitle" placeholder="Website Title" value="<?php echo $row['websitetitle'] ?>" >
      </div>

      <!-- 5. WEBSITE URL -->
      <div class="mb-3">
        <label for="websiteurl" class="form-label">Website URL</label>
        <input type="text" id="websiteurl" class="form-control" name="websiteurl" placeholder="Website URL" value="<?php echo $row['websiteurl'] ?>" >
      </div>

      <!-- 6. WEBSITE AUTHOR -->
      <div class="mb-3">
        <label for="author" id="author" class="form-label">Author</label>
        <input type="text" class="form-control" name="author" placeholder="Author" value="<?php echo $row['author'] ?>" >
      </div>

      <!-- 7. SUBMIT BUTTON -->
      <button type="submit" name="edit-submit" class="btn btn-primary w-100">Edit</button>
    </form>
  </main>

<!-- FOOTER.PHP -->
<?php 
  require "footer.php"
?>