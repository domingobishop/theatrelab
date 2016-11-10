<?php get_header(); ?>

    <div id="banner" class="bc-banner" role="banner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="banner-title">
                        <h1>
                            <?php bloginfo('name'); ?>
                        </h1>
                        <h3>
                            <?php bloginfo('description'); ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main id="main" class="bc-main" role="main">
        <div id="content" class="bc-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="loop-wrap">
                                <?php if (have_posts()) : ?>
                                    <?php /* The loop */ ?>
                                    <?php while (have_posts()) : the_post(); ?>
                                        <article id="post-<?php the_ID(); ?>">
                                            <?php if (has_post_thumbnail() && !post_password_required() && !is_attachment()) : ?>
                                                <div class="entry-thumbnail">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <div class="entry-content-loop">
                                                <h2 class="entry-title">
                                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h2>
                                                <div class="entry-summary">
                                                    <p><?php echo excerpt(32) ; ?></p>
                                                </div>
                                                <a href="<?php the_permalink(); ?>" class="btn-sm btn-default">Read more</a>
                                            </div>
                                        </article>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <h1>No content</h1>
                                <?php endif; ?>
                                <nav>
                                    <ul class="pager">
                                        <li class="previous"><?php next_posts_link( '&#8249; Older posts' ); ?></li>
                                        <li class="next"><?php previous_posts_link( 'Newer posts &#8250;' ); ?></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!-- #content -->
    </main>

<?php get_footer(); ?>