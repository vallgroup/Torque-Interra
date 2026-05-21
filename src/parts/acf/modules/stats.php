<div class="stats">
    <?php
    if (empty($stats)) {
        return;
    }

    foreach ($stats as $row) {
        echo '<div class="single-stat">
            <h3>' . $row['heading'] . '</h3>
            <p>' . $row['content'] . '</p>
        </div>';
    }
    ?>
</div>