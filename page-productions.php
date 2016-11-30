<?php
/**
 * Template Name: Productions landing
 *
 */
get_header(); ?>

    <?php global $post; ?>

        <div id="content" class="page-landing">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                            <article id="page-<?php echo $post->ID; ?>">
                                <?php
                                $args = array(
                                    'post_parent' => $post->ID,
                                    'post_type' => 'page',
                                    'posts_per_page' => -1,
                                    'orderby' => 'menu_order',
                                    'order' => 'ASC'
                                );
                                $child_query = new WP_Query( $args );
                                while ( $child_query->have_posts() ) : $child_query->the_post(); ?>
                                    <div <?php post_class( array('row', 'production-item') ); ?>>
                                        <div class="col-md-4">
                                            <?php if ( has_post_thumbnail() ) {
                                                the_post_thumbnail('thumbnail', array( 'class' => 'img-responsive' ));
                                            } ?>
                                        </div>
                                        <div class="col-md-8">
                                            <h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                            <?php echo excerpt(28); ?>
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