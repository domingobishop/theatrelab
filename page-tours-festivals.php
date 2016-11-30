<?php
/**
 * Template Name: Tours & Festivals landing
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
                                    'category_name' => 'tours-and-festivals',
                                    'post_type' => 'page',
                                    'posts_per_page' => -1,
                                    'orderby' => 'date menu_order',
                                    'order' => 'ASC'
                                );
                                $child_query = new WP_Query( $args );
                                while ( $child_query->have_posts() ) : $child_query->the_post(); ?>
                                    <div <?php post_class( array('row', 'production-item') ); ?>>
                                        <div class="col-md-4">
                                            <?php if ( has_post_thumbnail() ) {
                                                the_post_thumbnail('thumbnail', array( 'class' => 'img-responsive' ));
                                            } else { ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/img/thumb.jpg" class="img-responsive">
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-8">
                                            <h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                            <p><?php echo excerpt(14); ?></p>
                                            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" class="btn btn-default btn-sm" role="button">Read more</a>
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