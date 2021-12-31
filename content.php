<?php
/**
 * Template part for displaying posts
 *
 * @link       https://codex.wordpress.org/Template_Hierarchy
 *
 * @package    Arke
 * @copyright  Copyright (c) 2018, Danny Cooper
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

?>

<article <?php post_class(); ?>>

	<?php arke_thumbnail( 'arke-blog' ); ?>

	<header class="entry-header">

		<?php
		if ( is_single() ) : ?>
<div class="nv-post-cover alignfull" style="background-image:url(<?php the_post_thumbnail_url(); ?>);">
    <div class="nv-overlay"></div>
    <div class="container">
        <div class="nv-title-meta-wrap nv-is-boxed">
            <h1 class="title entry-title"><?php the_title(); ?></h1>
            <span class="nv-meta-list">
                <span class="meta date posted-on">
                    <time class="entry-date published"><?php the_date(); ?> / </time>
                </span>
		<span class="meta category">
			<span class="category"><?php the_category(', ','multiple', false); ?></span>
		</span>
            </span>
        </div>
    </div>
</div>
		<?php else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content( esc_html__( 'Continue reading &rarr;', 'arke' ) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'arke' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->

<?php if(is_single()) { 
//related_posts();
}
?>
