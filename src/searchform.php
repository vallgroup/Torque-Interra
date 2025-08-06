<div class="wrap-search">
    <form action="/" method="get" class="searchform">
        <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" aria-label="Search" />
        <button type="submit" class="search-button">
            submit
        </button>
    </form>
    <button type="button" id="mobile-search-button" aria-haspopup="true" aria-expanded="false">Open search form</button>
</div>