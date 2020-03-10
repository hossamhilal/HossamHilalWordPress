<!-- HOME Markting   -->


<?php
// Posts Query
$args = array(
    'orderby' => 'date',
    'post_type' => 'homemarketing',
);
$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) :
?>

<div class="homeMarkting">
    <div class="container">

        <?php while ($the_query->have_posts()):
            $the_query->the_post() ?>
            <?php if ($the_query->current_post % 2 !== 0): ?>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <?php if ( has_post_thumbnail() )
                        {
                            the_post_thumbnail('',array('class' => 'img-fluid'));
                        }
                        ?>
                    </div>
                    <div class="col-12 col-lg-6">
                        <h1>  <?php the_title() ?> </h1>
                        <?php the_content(); ?>
                        <a href="<?php the_permalink(); ?>" class="orangeBtn"> <span> Get Started </span> </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <h1>  <?php the_title() ?> </h1>
                        <?php the_content(); ?>
                        <a href="<?php the_permalink(); ?>" class="orangeBtn"> <span> Get Started </span> </a>
                    </div>
                    <div class="col-12 col-lg-6">
                        <?php if ( has_post_thumbnail() )
                        {
                            the_post_thumbnail('',array('class' => 'img-fluid'));
                        }
                        ?>
                    </div>
                </div>
            <?php endif ?>
        <?php endwhile ?>

    </div>
</div>


<?php
endif;
wp_reset_postdata();
?>