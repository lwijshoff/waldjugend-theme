<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package waldjugend-theme
 * @since 1.4
 * @author Leonard Wijshoff
 */
?>	<div style="clear:both;"></div>
	</div> <!-- #forbottom -->

	<footer id="footer" role="contentinfo">
		<div id="colophon">
		
			<?php get_sidebar( 'footer' );?>
			
		</div><!-- #colophon -->
        
        <!-- Custom Waldjugend implementation -->
        
		<div id="footer2">
		
			<div id="footer2-inside">
			    <!-- Custom Waldjugend implementation -->
			    <div id="site-copyright">
			        <a href="/">
                        <img class="aufinsabenteuer" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/Logo-footer.png" alt="FooterDWJ" width="250">
                        <!-- Comment here to see if it actually updated (for testing) -->
			        </a>
			        <?php include 'config.php'; ?>
                    <p align="center">
                        Die Waldjugend <?php echo $horst; ?> ist eine Ortsgruppe der 
                        <a href="//<?php echo $lvb_url; ?>"><?php echo $lvb; ?></a> - 
                        <a href="/impressum">Impressum</a>
                    </p>
			    </div>
			    
			</div> <!-- #footer2-inside -->
			
		</div><!-- #footer2 -->
		
		<!-- Custom Waldjugend implementation -->

	</footer><!-- #footer -->

	</div><!-- #main -->
</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>