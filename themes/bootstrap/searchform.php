<form class="navbar-form" role="search" action="<?php echo site_url('/'); ?>" method="get" >
    <div class="input-group">
        <input class="form-control" type="text" placeholder="<?php _e('Enter search term ...', 'bootstrap'); ?>" aria-label="<?php _e('Enter search term ...', 'bootstrap'); ?>" aria-describedby="button-search" name="s" id="search" value="<?php the_search_query(); ?>" />
        <div class="input-group-btn">
            <button class="btn btn-primary" id="button-search" type="submit"><?php _e('Go !', 'bootstrap'); ?></button>
        </div>
    </div>
</form>