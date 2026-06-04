<div class="featured-cards">
    <div class="container">
        <h2><?php echo $title; ?></h2>
        <?php
        if (empty($cards)) {
            return;
        }
        ?>
        <div class="cards">
            <?php
            foreach ($cards as $row) {
            ?>
                <div class="single-card">
                    <h3><?php echo $row['heading']; ?></h3>
                    <p><?php echo $row['content']; ?></p>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>