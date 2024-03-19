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


<?php

if (is_category()):
$category = get_category( get_query_var( 'cat' ) );
$cat_id = $category->cat_ID;
?>
<header>
<h1 class="archives__heading"><?php echo $category->cat_name; ?></h1>
</header>
<?php
				$args = array(
					'post_type'      => 'post',
					'post_status'    => 'publish',
					'posts_per_page' => -1,
					'cat' => $cat_id,
				);

				$arke_posts = new WP_Query( $args );

				if ( $arke_posts->have_posts() ) :

					echo '<ul class="archives__list">';

					while ( $arke_posts->have_posts() ) :
						$arke_posts->the_post();

						echo '<li><a href="' . esc_url( get_the_permalink() ) . '">' . get_the_title() . '</a><span>' . esc_attr( get_the_time( 'F j, Y' ) ) . '</span></li>';

					endwhile;

					echo '</ul>';

					wp_reset_postdata();

				else :
						echo '<p>' . esc_html__( 'Sorry, no posts matched your criteria.', 'arke' ) . '</p>';
				endif;

else:

if (is_search()) { 
global $query_string;

$args = explode("&", $query_string);
$search_query = array();

foreach($query_args as $key => $string) {
	$query_split = explode("=", $string);
	$search_query[$query_split[0]] = $query_split[1];
} // foreach

                                $arke_posts = new WP_Query( $args );

                                if ( $arke_posts->have_posts() ) :

                                        echo '<ul class="archives__list">';

                                        while ( $arke_posts->have_posts() ) :
                                                $arke_posts->the_post();

                                                echo '<li><a href="' . esc_url( get_the_permalink() ) . '">' . get_the_title() . '</a><span>' . esc_attr( get_the_time( 'F j, Y' ) ) . '</span></li>';

                                        endwhile;

                                        echo '</ul>';

                                        wp_reset_postdata();

                                else :
                                                echo '<p>' . esc_html__( 'Sorry, no posts matched your criteria.', 'arke' ) . '</p>';
                                endif;


} else {
?>

	<?php arke_thumbnail( 'arke-blog' ); ?>

	<header class="entry-header">

		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
?>
 <span class="nv-meta-list">
                <span class="meta date posted-on">
                    <time class="entry-date published"><?php the_date(); ?> / </
time>
                </span>
                <span class="meta category">
                        <span class="category"><?php the_category(', ','multiple
', false); ?></span>
                </span>
            </span>
<?php

		else :
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
<center style="font-size: 125%;">&middot; &middot; &middot;</center>
<?php
}
endif;
?>
</article><!-- #post-## -->

<?php if(is_single()) {
related_posts();
}
?>

