
<!-- Blog Post -->

<div class="blogBox">
    <?php if ( has_post_thumbnail() ) {
        the_post_thumbnail('',array('class' => 'img-fluid'));
    } else { ?>
        <img src="<?php echo get_template_directory_uri(); ?>/images/fikra-default.jpg" alt="Default Image" class="img-fluid w-100">
    <?php  }?>
    <div class="blogBoxData">
        <h6> <i class="icofont-clock-time"></i> Date : <?php echo get_the_date( 'Y-m-d' ); ?> </h6>
        <h2> <?php the_title() ?> </h2>
        <p>
            <?php
            $content = get_the_content();
            echo mb_strimwidth($content, 0, 200, '...');
            ?>
        </p>
        <a href="<?php the_permalink(); ?>" class="readMoreArrow"> <i class="icofont-long-arrow-right"></i> </a>
    </div>
</div>
