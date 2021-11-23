<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @link       https://codex.wordpress.org/Template_Hierarchy
 *
 * @package    Arke
 * @copyright  Copyright (c) 2018, Danny Cooper
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

get_template_part( 'header' );

if (is_archive()): $category=get_the_category(); echo '<center><h1 class="category-title">Articles in ' . $category[0]->cat_name . '</h1></center>'; endif;
if (is_home() || is_archive()) {
 $args_single = array(
                                        'post_type'      => 'post',
                                        'post_status'    => 'publish',
                                        'posts_per_page' => 1,
                                );
if (is_archive()): $category=get_the_category(); $args_single["category_name"]=$category[0]->cat_name; endif;

                                $arke_posts_first = new WP_Query( $args_single );

				if ( $arke_posts_first->have_posts() ) :

					while ( $arke_posts_first->have_posts() ) :

						$arke_posts_first->the_post();

						get_template_part( 'content' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile;

				else :

					get_template_part( 'content', 'none' );

				endif;

} // is_home
 else
{

                                if (have_posts() ) :

                                        while ( have_posts() ) :

                                                the_post();

                                                get_template_part( 'content' );

                                                // If comments are open or we have at least one comment, load up the comment template.
                                                if ( comments_open() || get_comments_number() ) :
                                                        comments_template();
                                                endif;

                                        endwhile;

                                else :

                                        get_template_part( 'content', 'none' );

                                endif;
}
				?>


<?php if(is_home() || is_archive()) { ?>
<header>
                                        <h1 class="archives__heading"><?php single_post_title(); ?></h1>
                                </header>

<h2>More Articles <?php if(is_archive()): echo ' in '; the_category(',','',false); endif;?></h2>

                                <?php
                                $args = array(
                                        'post_type'      => 'post',
                                        'post_status'    => 'publish',
                                        'posts_per_page' => 9999,
					'offset' => 1,
					
                                );
if(is_archive()): $category= get_the_category(); $args["category_name"]=$category[0]->cat_name; endif;
//print_r($args);
                                $arke_posts = new WP_Query( $args );

                                if ( $arke_posts->have_posts() ) :

                                        //echo '<ul class="archives__list">';
echo '<div class="archives__list__div__wrap">';                                        
while ( $arke_posts->have_posts() ) :
                                                $arke_posts->the_post();
                                                echo '<div class="archives__list__div"><div class="archives__title"><a href="' . esc_url(get_the_permalink() ) . '">' . get_the_title() . '</a></div><div class="archives__date">' . esc_attr( get_the_time( 'd-M-y' ) ) . '</div></div>';

                                        endwhile;

                                        echo '</div>';

                                        wp_reset_postdata();

                                else :
                                                echo '<p>' . esc_html__( 'Sorry, no posts matched your criteria.', 'arke' ) . '</p>';
                                endif;


} // if is home
                                ?>

				</div><!-- .content-area -->
			<footer class="site-footer">
			&copy; 2021 Rich Kreider</footer><!-- .site-footer -->

		</div><!-- .site-content -->
		<?php wp_footer(); ?>
	</body>
</html>
