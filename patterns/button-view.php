<?php
/**
 * Title: Fancy Centered Button
 * Slug: waldjugend-theme/fancy-button
 * Categories: waldjugend-buttons
 * Block Types: core/buttons
 * Keywords: button, centered, call to action
 */

return [
    'title'      => __('Fancy Centered Button', 'waldjugend-theme'),
    'categories' => ['waldjugend-buttons'],
    'content'    => '
        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
        <div class="wp-block-buttons">
            <!-- wp:button {"className":"is-style-outline"} -->
            <div class="wp-block-button is-style-outline">
                <a class="wp-block-button__link">' . esc_html__('Click Me!', 'waldjugend-theme') . '</a>
            </div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
    ',
];