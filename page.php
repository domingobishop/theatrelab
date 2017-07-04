<?php get_header(); ?>

    <?php while (have_posts()) : the_post(); ?>
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
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <?php $images = get_attached_media('image', $post->ID);
                                    $img_count = sizeof( $images );
                                    if ( $bg_img && $img_count > 1 ) { ?>
                                    <div class="img-gallery clearfix text-right">
                                        <?php
                                        $i = 0;
                                        foreach($images as $image) {
                                            if ( $i == 0 ) { ?>
                                                <a href="<?php echo wp_get_attachment_image_src($image->ID,'full')[0]; ?>?image=<?php echo $i ?>" data-toggle="lightbox" data-gallery="hidden-images" class="btn btn-default btn-sm" role="button">
                                                    <span class="glyphicon glyphicon-camera" aria-hidden="true"></span> <small>Image gallery</small>
                                                </a>
                                            <?php } else { ?>
                                                <div data-toggle="lightbox" data-gallery="hidden-images" data-remote="<?php echo wp_get_attachment_image_src($image->ID,'full')[0]; ?>?image=<?php echo $i ?>"></div>
                                            <?php }
                                            $i++;
                                        } ?>
                                    </div>
                                    <?php } ?>
                                <div class="entry">
                                    <div class="entry-header">
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