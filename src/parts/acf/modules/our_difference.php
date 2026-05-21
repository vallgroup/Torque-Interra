<div class="our-difference">
    <h2><?php echo $title; ?></h2>
    <?php
    if (empty($our_difference)) {
        return;
    }
    ?>
    <div class="container">
        <?php
        foreach ($our_difference as $row) {
        ?>
            <div class="single-our-difference">
                <div>
                    <h3><?php echo $row['heading']; ?></h3>
                    <p><?php echo $row['content']; ?></p>
                </div>
                <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['heading']; ?>">
            </div>
        <?php
        }
        ?>
    </div>
</div>