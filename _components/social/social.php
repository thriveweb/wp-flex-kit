<?php
/**
* Social links
*
* Gets HTML for this specific component
*
* @param    (none)
* @return   (none)      HTML of this compnent
*/
function social_links() {
    ob_start(); ?>
    <ul class="social flex-row">
        <?php if (get_field('facebook', 'options')): ?>
            <li><a target="_blank" class="social" href="<?php the_field('facebook', 'options') ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <?php endif; ?>
        <?php if (get_field('instagram', 'options')): ?>
            <li><a target="_blank" class="social" href="<?php the_field('instagram', 'options') ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
        <?php endif; ?>
        <?php if (get_field('twitter', 'options')): ?>
            <li><a target="_blank" class="social" href="<?php the_field('twitter', 'options') ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        <?php endif; ?>
        <?php if (get_field('linkedin', 'options')): ?>
            <li><a target="_blank" class="social" href="<?php the_field('linkedin', 'options') ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
        <?php endif; ?>
        <?php if (get_field('youtube', 'options')): ?>
            <li><a target="_blank" class="social" href="<?php the_field('youtube', 'options') ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
        <?php endif; ?>
        <?php if (get_field('email', 'options')): ?>
            <li><a class="social" target="_blank" href="mailto:<?php the_field('email', 'options') ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li>
        <?php endif; ?>
    </ul>
<?php return ob_get_clean(); ?>

<?php
    //// Options Page
    add_action( 'init', 'social' );
    function social(){
        //// ACF Options Page
        if( function_exists('acf_add_options_page') ) {
            acf_add_options_page(array(
                'page_title' => 'Social Links',
                'icon_url' => 'dashicons-megaphone',
                'position' => 54
            ));
        }
    }
?>
