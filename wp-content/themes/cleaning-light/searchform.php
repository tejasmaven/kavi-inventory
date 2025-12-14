<form name="search-form" class="widget-search" action="<?php echo esc_url( home_url() ); ?>">
    <input type="search" name="s" value="<?php echo esc_attr(apply_filters('the_search_query', get_search_query())); ?>"/>
    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
</form>