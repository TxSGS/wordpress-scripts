<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The Template for displaying all single Speaker post types.
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */

weaverii_get_header('single');
if ( weaverii_getopt('wii_infobar_location') == 'top' ) get_template_part('infobar');
weaverii_inject_area('premain');
echo("\t<div id=\"main\">\n");
weaverii_trace_template(__FILE__);
global $weaverii_cur_post_id;
$weaverii_cur_post_id = get_the_ID();
weaverii_get_sidebar_left('single');
?>
		<div id="container_wrap"<?php weaverii_get_page_class('single', 'container-single'); ?>>
<?php
        if (weaverii_getopt('wii_infobar_location') == 'content') get_template_part('infobar');
		weaverii_inject_area('precontent'); ?>
		<div id="container">
<?php		weaverii_get_sidebar_top('single'); ?>
			<div id="content" role="main">

<?php 		weaverii_post_count_clear();
		$cats = weaverii_getopt_checked('wii_single_nav_link_cats');
		while ( have_posts() ) {
			the_post(); ?>
				<nav id="nav-above" class="navigation">
				<h3 class="assistive-text"><?php echo __( 'Post navigation','weaver-ii'); ?></h3>
<?php			    if (weaverii_getopt('wii_single_nav_style')=='prev_next') {
?>
					<div class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous','weaver-ii'), $cats ); ?></div>
				<div class="nav-next"><?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>','weaver-ii'), $cats); ?></div>
<?php			    } else {
?>
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link','weaver-ii') . '</span> %title', $cats ); ?></div>
				<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link','weaver-ii') . '</span>' , $cats); ?></div>
<?php			    }
?>
				</nav><!-- #nav-above -->

<?php 			    get_template_part( 'content', 'single' ); ?>


<!— *** Begin Speaker Profile Template *** —>

<div id="speaker-profile">

<h2>Speakers Bureau Profile</h2>

<p>TxSGS Speakers Bureau Profile for [name].</p>

<h3>Contact Information</h3>

	<ul>


	<?php 
	// Queries the speaker's full address.
		$speakerAddress = get_post_meta($post->ID, 'full-address', true); 
	// If a full address exist, displays it as a bullet point.
		if ($speakerAddress) {
	    	echo "<li><strong>Full Address: </strong>$speakerAddress</li>";
		}
	?>





	<?php 
	// Queries the speaker's phone number.
		$speakerPhone = get_post_meta($post->ID, 'wpcf-phone-number', true); 
	// If a phone number exist, displays it as a bullet point.
		if ($speakerPhone) {
	    	echo "<li><strong>Phone: </strong>$speakerPhone</li>";
		}
	?>

		


	<?php
	$speaker_email_address = types_render_field('wpcf-email', array("output"=>"html"));
	echo($speaker_email_address);
	?>


	<?php 
	// Queries if the speaker has a website.
		$speakerWebsite = get_post_meta($post->ID, 'wpcf-website', true); 
	// If a website exists, displays it as a bullet point.
		if ($speakerWebsite) {
		echo "<li><strong>Website: </strong><a title='$speakerWebsite' href='$speakerWebsite'>$speakerWebsite</a></li>";
		}
	?>

	</ul>



<h3>Speaking Details</h3>

<ul>
	<?php 
	// Queries if the speaker has a PDF profile.
		$speakerResume = get_post_meta($post->ID, 'wpcf-resume', true); 
	// If a PDF profile exists, displays it as a bullet point.
		if ($speakerResume) {
	    	echo "<li><strong>Printable Profile: </strong> <a href='$speakerResume'>Download PDF</a></li>";
		}
	?>

	<li>
	<?php 
	// Displays speaker topics in alpha order. Not optional, each speaker must have assigned topics.
	the_terms( $post->ID, 'speaking-topic', '<strong>Speaking Topics:</strong> ', ', ' ); 
	?>
	</li>
</ul>

<!—Displays the last date modified, more useful here than date created.—>
<p>Last modified: <?php the_modified_date(); ?></p>

</div>
<!— *** End Speaker Profile Template *** —>


				

<?php
                comments_template( '', true ); ?>

<?php 		} // end of the loop. ?>

			</div><!-- #content -->
<?php		weaverii_get_sidebar_bottom('single'); ?>
		</div><!-- #container -->
		</div><!-- #container_wrap -->

<?php	weaverii_get_sidebar_right('single');
	weaverii_get_footer('single'); ?>
