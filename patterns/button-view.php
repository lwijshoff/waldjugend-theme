<?php
/**
 * Title: Button View
 * Slug: waldjugend/button-view
 * Categories: Buttons
 * Keywords: button, view, icon
 * 
 * @package waldjugend-theme
 * @since 1.5
 * @author Leonard Wijshoff
 */
?>

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-buttons">
    <!-- wp:button {"className":"is-style-outline"} -->
    <div class="wp-block-button is-style-outline">
        <a class="wp-block-button__link wp-element-button" href="/?post_type=post">
            <img class="wp-image-776" style="width: 32px; vertical-align: middle;" src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/auge_js.svg'); ?>" alt=""> 
            View more
        </a>
    </div>
    <!-- /wp:button -->
</div>
<!-- /wp:buttons -->