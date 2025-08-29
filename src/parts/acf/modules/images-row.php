<div class="images-row">
    <?php
    if (empty($images)) {
        return;
    }

    foreach ($images as $row) {
        echo '<img src="' . $row['image'] . '" alt="">';
    }
    ?>
</div>