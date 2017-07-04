<?php
/**
 * Template Name: Page of posts
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
    <div class="col-lg-10 col-lg-offset-1">
        <article id="page-<?php echo $post->ID; ?>">
            <div class="entry">
                <div class="entry-header clearfix">
                    <h1>
                        <?php the_title(); ?>
                    </h1>
                </div>
            </div>
        </article>
        <div class="entry">
        <div class="equal-heights-flex-box row">
        <?php query_posts('category_name=' . get_the_title() . '&post_status=publish,future'); ?>
        <?php if (have_posts()) : ?>
            <?php /* The loop */ ?>
            <?php while (have_posts()) : the_post(); ?>
                    <div class="col-sm-4">
                        <article id="post-<?php the_ID(); ?>">
                            <h3 class="entry-title">
                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <div class="entry-summary">
                                <p><?php echo excerpt(14); ?></p>
                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" class="btn btn-default btn-sm" role="button">Read more</a>
                            </div>
                            <!-- .entry-summary -->
                        </article>
                    </div>
            <?php endwhile; ?>
        <?php else : ?>
            <h2>No content</h2>
        <?php endif; ?>
        </div>
        </div>

    </div>
    </div>
    </div>
    </div>


<?php get_footer(); ?>