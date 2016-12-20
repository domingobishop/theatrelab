<?php
/**
 * Template Name: News
 *
 */
get_header(); ?>
<?php global $post; ?>
    <div id="content" class="news-content">
    <div class="container">
    <div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <article id="page-<?php echo $post->ID; ?>">
            <div class="entry-header clearfix">
                <h1>
                    <?php the_title(); ?>
                </h1>
            </div>
        </article>
        <div class="news-items">
        <?php query_posts('category_name=' . get_the_title() . '&post_status=publish,future'); ?>
        <?php if (have_posts()) : ?>
            <?php /* The loop */ ?>
            <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" class="news-item">
                            <h3 class="entry-title">
                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <div class="entry-summary">
                                <p><?php echo excerpt(36); ?></p>
                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" class="btn btn-default btn-sm" role="button">Read more</a>
                            </div>
                            <!-- .entry-summary -->
                        </article>
            <?php endwhile; ?>
        <?php else : ?>
            <h2>No content</h2>
        <?php endif; ?>
        </div>

    </div>
    </div>
    </div>
    </div>


<?php get_footer(); ?>