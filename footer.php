<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package waldjugend-theme
 * @since 1.5
 * @author Leonard Wijshoff
 */
?>	
    <div style="clear:both;"></div>
	</div> <!-- #forbottom -->

	<footer id="footer" role="contentinfo">
		<div id="colophon">
		
			<?php get_sidebar( 'footer' );?>
			
		</div><!-- #colophon -->
        
        <!-- Custom Waldjugend implementation -->
        
		<div id="footer2">
            <div class="footer-inner">
                
                <!-- Navigation Links -->
                <nav class="footer-nav">
                    <a href="/">Home</a>
                    <a href="/features">Features</a>
                    <a href="/pricing">Pricing</a>
                    <a href="/faqs">FAQs</a>
                    <a href="/about">About</a>
                </nav>

                <!-- Divider -->
                <hr class="footer-divider" />

                <!-- Logo + Slogan -->
                <div class="footer-centerpiece">
                    <a href="/">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/Logo-footer.png" alt="Footer Logo" class="footer-logo" width="250">
                    </a>
                </div>

                <!-- Dynamic copyright -->
                <div class="footer-bottom">
                    <?php
                        if (function_exists('waldjugend_generate_footer_html')) {
                            echo waldjugend_generate_footer_html();
                        } else {
                            echo '&copy; '.date('Y').' <a href="https://github.com/lwijshoff">Leonard Wijshoff</a>';
                        }
                    ?>
                </div>

            </div>
        </div>

		<!-- Custom Waldjugend implementation -->

	</footer><!-- #footer -->

	</div><!-- #main -->
</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>