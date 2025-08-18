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
	</div>
		<footer id="footer" role="contentinfo">
			<div id="colophon">
			
				<?php get_sidebar( 'footer' );?>
				
			</div>
			
			<div id="claim">
				<img class="aufinsabenteuer" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/Logo-footer.png" alt="Auf ins Abenteuer" width="250">
			</div>
			
			<div id="main-footer">
				<?php
				if (function_exists('waldjugend_generate_main_footer_html')) {
					echo waldjugend_generate_main_footer_html();
				}
				?>
			</div>

			<div id="bottom-footer">
				<div id="site-copyright">
					<p align="center">
						<?php
						if (function_exists('waldjugend_generate_bottom_footer_html')) {
							echo waldjugend_generate_bottom_footer_html();
						} else {
							echo '&copy; ' . date('Y') . ' <a href="https://github.com/lwijshoff">Leonard Wijshoff</a>';
						}
						?>
					</p>
				</div>
			</div>

		</footer>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>