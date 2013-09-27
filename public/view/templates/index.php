
  <div>
      <?php include'nav.php'; ?>
      <?php echo $this->translator->getLang(); ?>
      <div id="dogs welcome">Bring your well behaved dog</div>
      <?php echo $this->tr("test"); ?>
      <div id="reviews">
          <section>
              <header>Reviews for Reka</header>
             <?php if(!$result){echo "There are no reviews for Reka yet. Be the first to add one";
             }else{
                 foreach($result as $review){
                 echo "<p>Name: {$review['name']}</p>";
                 echo "<p>Review: {$review['review']}</p>";
                 echo "<p>Date added: {$review['date']}</p>";
             };
             }?>

          </section>
          
      </div>
      <div id="services"></div>

