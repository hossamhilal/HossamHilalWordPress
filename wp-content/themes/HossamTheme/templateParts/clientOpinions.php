
<?php
    $opinions_data = get_option('portfolio_array', true);

    $args = array(
        'orderby' => 'date',
        'post_type' => 'opinions',
    );
    $the_query = new WP_Query( $args );
?>


<!-- TESTIMONIAL -->
<div class="testimonial">
    <div class="container-fluid">

        <div class="sectionHeader">
            <h1 class="sectionTitle">  <?= $opinions_data['title']; ?> </h1>
            <h2 class="sectionDescTitle">  <?= $opinions_data['sub_title']; ?> </h2>
            <p class="sectionDecription">  <?= $opinions_data['desc']; ?> </p>
        </div>

        <?php if ( $the_query->have_posts() ) : ?>
            <div class="testimonialSlider">
                <div class="owl-carousel owl-theme testimonialOwl">
                    <?php
                        while ( $the_query->have_posts() ) :
                        $the_query->the_post();
                        $client_image = get_post_meta($post->ID, 'client_image', true);
                        $client_name = get_post_meta($post->ID, 'client_name', true);
                        $client_job = get_post_meta($post->ID, 'client_job', true);
                        $client_opinion = get_post_meta($post->ID, 'client_opinion', true);
                    ?>
                        <div class="item">
                            <div class="testimonialBlock">
                                <div class="icon"> <i class="icofont-quote-right"></i> </div>
                                <p>  <?= $client_opinion; ?>  </p>
                                <div class="testimonialUser">
                                    <img src="<?= $client_image ?>" alt="user" class="img-fluid">
                                    <div class="data">
                                        <h5> <?= $client_name; ?>  </h5>
                                        <h6> <?= $client_job; ?>  </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;  ?>
                </div>
            </div>
        <?php endif; wp_reset_postdata(); ?>

    </div>
</div>


