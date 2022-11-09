<!-- HEADER.PHP -->
<?php 
  require "header.php"
?>

  <main class="container" style="width: 100%">
    <!-- createpost.inc.php - Will process the data from this form-->
    <form action="includes/createpost.inc.php" method="POST">
      <h2>Create Post</h2>

      <!-- 1. DYNAMIC ERROR MESSAGE -->
      <?php
        // VALIDATION: Check that Error Message Type exists in GET superglobal
        if(isset($_GET['error'])){
          // (1.1) Empty fields validation 
          if($_GET['error'] == "emptyfields"){
            $errorMsg = "Please fill in all fields";

          // (1.2) Internal server error 
          } else if ($_GET['error'] == "sqlerror") {
            $errorMsg = "An internal server error has occurred - please try again later";
          }

          // (1.3) Dynamic Error Alert based on Variable Value 
          echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';

          // (iv). SUCCESS MESSAGE: Post saved successfully to DB
        }
      ?>
      
      <!-- 1. TITLE -->
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" id="title" class="form-control" name="title" placeholder="Title" value="">
      </div>  

      <!-- 2. IMAGE URL -->
      <div class="mb-3">
        <label for="imageurl" class="form-label">Image URL</label>
        <input type="text" id="imageurl" class="form-control" name="imageurl" placeholder="Image URL" value="" >
      </div>

      <!-- 3. COMMENT SECTION -->
      <div class="mb-3">
        <label for="comment" class="form-label">Comment</label>
        <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Comment" ></textarea>
      </div>

      <!-- 4. WEBSITE TITLE -->
      <div class="mb-3">
        <label for="websitetitle" class="form-label">Website Title</label>
        <input type="text" id="websitetitle" class="form-control" name="websitetitle" placeholder="Website Title" value="" >
      </div>

      <!-- 5. WEBSITE URL -->
      <div class="mb-3">
        <label for="websiteurl" class="form-label">Website URL</label>
        <input type="text" id="websiteurl" class="form-control" name="websiteurl" placeholder="Website URL" value="" >
      </div>

      <!-- 6. WEBSITE AUTHOR -->
      <div class="mb-3">
        <label for="author" class="form-label">Author</label>
        <input type="text" id="author" class="form-control" name="author" placeholder="Author" value="" >
      </div>

      <!-- 7. SUBMIT BUTTON -->
      <button type="submit" name="post-submit" class="btn btn-primary w-100">Post</button>
    </form>
  </main>

<!-- FOOTER.PHP -->
<?php 
  require "footer.php"
?>