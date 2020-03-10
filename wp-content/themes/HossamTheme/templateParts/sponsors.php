
<?php
    $args = array(
        'orderby' => 'date',
        'post_type' => 'sponsors',
    );
    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) :
?>

    <div class="supponsers">
        <div class="container">
            <div class="owl-carousel owl-theme supponsersOwl">

                <?php
                    while ( $the_query->have_posts() ) :
                    $the_query->the_post();
                ?>
                    <div class="item">
                        <div class="suponserBox">
                            <?php if ( has_post_thumbnail() ) : the_post_thumbnail('',array('class' => 'img-fluid')); endif; ?>
                        </div>
                    </div>
                <?php endwhile;  ?>
            </div>
        </div>
    </div>

<?php  endif; wp_reset_postdata(); ?>
