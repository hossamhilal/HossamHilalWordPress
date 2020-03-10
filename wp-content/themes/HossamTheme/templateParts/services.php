
<?php

// Get custom fields data
$service_data = get_option('services_array', true);

// Posts Query
$args = array(
    'orderby' => 'date',
    'post_type' => 'Services',
);
$the_query = new WP_Query( $args );



if ( $the_query->have_posts() ) :
?>

<div class="services">
    <div class="container">

        <div class="sectionHeader">
            <h1 class="sectionTitle"> <?= $service_data['title']; ?> </h1>
            <h2 class="sectionDescTitle"> <?= $service_data['sub_title']; ?> </h2>
            <p class="sectionDecription">  <?= $service_data['desc']; ?> </p>
        </div>



            <div class="sectionContent">
                <div class="row">

                    <?php
                        while ( $the_query->have_posts() ) :
                        $the_query->the_post();
                    ?>

                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="serviceBox">
                                <div class="serviceBoxIcon">
                                    <div class="iconImage">
                                        <?php if ( has_post_thumbnail() ) {
                                            the_post_thumbnail('',array('class' => 'img-fluid'));
                                        } else { ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/fikra-default.jpg" alt="Default Image" class="img-fluid w-100">
                                        <?php  }?>
                                    </div>
                                </div>
                                <h2> <?php the_title() ?> </h2>
                                <p>
                                    <?php
                                        $content = get_the_content();
                                        echo mb_strimwidth($content, 0, 150, '...');
                                    ?>
                                </p>
                                <a href="<?php the_permalink(); ?>" class="readMoreArrow"> <i class="icofont-long-arrow-right"></i> </a>
                            </div>
                        </div>

                    <?php endwhile;  ?>

                </div>
            </div>

    </div>
</div>


<?php
endif;
wp_reset_postdata();
?>