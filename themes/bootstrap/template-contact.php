<?php
/* Template name: Contact */

get_header(); ?>


<?php 

$error = get_query_var( 'error_message' );

if($error){
    if ($error === 'stingy') {
        echo '<div class="alert alert-danger">';
        _e('You cannot give me less than or equal to 0 coffees. I don\'t live only on love and fresh water.', 'bootstrap');
        echo '</div>';
    }else{
        if($error === 'success'){
            echo '<div class="alert alert-success">';
            echo __('Thank\'s for this coffee, more energy drink ^^', 'bootstrap') . ' ' . __('Total coffees drunk so far : ', 'bootstrap') . get_option('current_give_value');;
            echo '</div>';
        }
    }
} ?>

<?php

/* Start the Loop */
while (have_posts()) :
    the_post();

    the_content();

?>

    <form action="#" method="POST" class="give-form mb-5">
        <?php
        // wp_nonce_field() permet de vérifier que le contenu d'une requête d'un formulaire provient bien du site actuel
        wp_nonce_field('do-give', 'give-check');
        ?>

        <div class="form-group">
            <label for="give"><?php _e('Give value :', 'bootstrap'); ?></label>
            <input id="give" type="number" name="give" value="5" class="form-control" aria-describedby="giveHelp" placeholder="<?php _e('Enter give value', 'bootstrap'); ?>" />
            <small id="giveHelp" class="form-text text-muted"><?php _e('How many coffee offer me ?', 'bootstrap'); ?></small>
        </div>
        <button type="submit" class="btn btn-primary" name="give-send" id="submit"><?php _e('Send', 'bootstrap'); ?></button>
    </form>
<?php

    $horaires_douverture = get_field('horaires_douverture');

    echo '<div class="alert alert-primary" role="alert">' . $horaires_douverture . '</div>';
endwhile; // End of the loop.

get_footer();
