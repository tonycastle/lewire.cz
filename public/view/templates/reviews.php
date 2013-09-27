<?php include'header.php'; ?>
<form id="review form" action="/addreview" method="post">
              <h3>Add New Review</h3>
              <label>Name:</label><input type="text" id="name" />
              <label>Review:</label><input type="textarea" id="review" />
              <input type="submit" value="Add Review" />
 </form>
<?php include 'footer.php'; ?>