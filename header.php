<?php
/**
 * The Header
 * Note: This is a child theme Header
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package waldjugend-theme
 * @since 1.4
 * @author Leonard Wijshoff
 */
 ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php  cryout_meta_hook(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
 	cryout_header_hook();
	wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php cryout_body_hook(); ?>
<?php /* wp_body_open() call is hooked into cryout_body_hook */ ?>

<div id="wrapper" class="hfeed">
<div id="topbar" ><div id="topbar-inner"> <?php cryout_topbar_hook(); ?> </div></div>
<?php cryout_wrapper_hook(); ?>

<div id="header-full">
	<header id="header">
		<div id="masthead">
		<?php cryout_masthead_hook(); ?>
		<!-- Custom Waldjugend implementation -->
			<div class="branding" role="banner" > <!-- Used to be id="branding" -->
    			<div id=header_logo >
    				<?php cryout_branding_hook();?>
    				<?php cryout_header_widgets_hook(); ?>
    				<div style="clear:both;"></div>
    				<a href="/">
        				<h1>
                            <img class="logo" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/Logo-header.png" alt="LogoDWJ">
                        </h1>
                    </a>
                    <?php
                    $horst = function_exists('waldjugend_get_config') ? waldjugend_get_config('horst') : 'Horst Kleve';
                    ?>
                    <div id="header_description">
                        <p>der Schutzgemeinschaft Deutscher Wald</p>
                        <p><?php echo esc_html($horst); ?></p>
                    </div>
                </div>
			</div><!-- #branding -->
		<!-- Custom Waldjugend implementation -->
			<button id="nav-toggle"><span>&nbsp;</span></button>
			<nav id="<?php echo apply_filters( 'nirvana_mainnav_id', 'access' ) ?>" class="<?php echo apply_filters( 'nirvana_mainnav_class', 'jssafe' ) ?>" role="navigation">
				<?php cryout_access_hook();?>
			</nav><!-- #access -->


		</div><!-- #masthead -->
	</header><!-- #header -->
</div><!-- #header-full -->

<div style="clear:both;height:0;"> </div>
<?php cryout_breadcrumbs_hook();?>
<div id="main">
		<?php cryout_main_hook(); ?>
	<div  id="forbottom" >
		<?php cryout_forbottom_hook(); ?>

		<div style="clear:both;"> </div>