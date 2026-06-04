<div class="headline-and-content-2-columns">
  <div class="container">
    <h2><?php echo $headline; ?></h2>

    <?php
    if (empty($columns_wrapper)) {
      return;
    }
    ?>
    <div class="columns">
      <?php
      foreach ($columns_wrapper as $row) {
      ?>
        <div class="single-column">
          <h3><?php echo $row['title']; ?></h3>
          <p><?php echo $row['content']; ?></p>
        </div>
      <?php
      }
      ?>
    </div>
  </div>

</div>