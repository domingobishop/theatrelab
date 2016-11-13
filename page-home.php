<?php
/**
 * Template Name: Home
 *
 */
get_header(); ?>


<?php while (have_posts()) : the_post(); ?>
    <div id="content" class="home-content">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>
    </div>
<?php if ( has_post_thumbnail() ) {
    $bg_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
    <div id="home_banner" class="banner" role="banner" style="background: url(<?php echo $bg_img[0]; ?>) no-repeat center center;background-size: cover">
    </div>
<?php } else { ?>
    <div id="home_banner" class="banner" role="banner">
    </div>
<?php } ?>
<?php endwhile; ?>


<?php get_footer(); ?>