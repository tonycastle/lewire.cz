<?php include'header.php'; ?>
<?php include'nav.php'; ?>
<form id="review form" action="/addreview" method="post">
              <h3>Contact me</h3>
              <label>Name:</label><input type="text" id="name" />
              <label>Email:</label><input type="text" id="email" />
              <label>Query:</label><input type="textarea" id="query" />
              <input type="submit" value="Add Review" />
 </form>
<?php include 'footer.php'; ?>