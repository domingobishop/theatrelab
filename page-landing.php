<?php
/**
 * Template Name: Landing
 *
 */
get_header(); ?>

<?php global $post; ?>

    <div id="content" class="page-landing">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <article id="page-<?php echo $post->ID; ?>">
                        <div class="entry-header clearfix">
                            <h1>
                                <?php the_title(); ?>
                            </h1>
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
                                    <h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="entry-excerpt">
                                        <p><?php echo excerpt(28); ?></p>
                                        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" class="btn btn-default btn-sm" role="button">Read more</a>
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