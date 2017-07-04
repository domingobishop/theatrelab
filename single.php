<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

    <div id="content" class="post-content">
    <div class="container">
    <div class="row">
    <div class="col-lg-8 col-lg-offset-2">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry">
            <div class="entry-header clearfix">
                <h1>
                    <?php the_title(); ?>
                </h1>
            </div>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </div>
    </article>
<?php endwhile; ?>
    </div>
    </div>
    </div>
    </div>


<?php get_footer(); ?>