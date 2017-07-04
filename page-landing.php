<?php
/**
 * Template Name: Landing
 *
 */
get_header(); ?>

<?php global $post; ?>
<?php if ( has_post_thumbnail() ) {
    $bg_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
    $with_banner = 'banner-offset';
    $bg_img_position = get_post_meta( $post->ID, 'bg_img_position', true );
    ?>
    <div id="page_banner" class="banner" role="banner" style="background: url(<?php echo $bg_img[0]; ?>) no-repeat center <?php echo $bg_img_position; ?>;background-size: cover">
    </div>
<?php } else {
    $with_banner = '';
}?>
    <div id="content" class="page-content <?php echo $with_banner ?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <article id="page-<?php echo $post->ID; ?>">
                        <div class="entry">
                            <div class="entry-header clearfix">
                                <h1>
                                    <?php the_title(); ?>
                                </h1>
                            </div>
                        </div>
                        <?php
                        $args = array(
                            'post_parent' => $post->ID,
                            'post_type' => 'page',
                            'posts_per_page' => -1,
                            'orderby' => 'date menu_order',
                            'order' => 'DESC'
                        );
                        $child_query = new WP_Query( $args );
                        while ( $child_query->have_posts() ) : $child_query->the_post(); ?>
                            <div <?php post_class( array('row', 'production-item') ); ?>>
                                <div class="col-sm-12">
                                    <div class="entry">
                                        <h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="entry-excerpt">
                                            <p><?php echo excerpt(28); ?></p>
                                            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" class="btn btn-default btn-sm" role="button">Read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </article>
                </div>
            </div>
        </div>
    </div>


<?php get_footer(); ?>