
<?php
    // Get custom fields data
    $features_data = get_option('features_array', true);
?>


<!-- FEATURES  -->
<div class="features">
    <div class="container">

        <div class="sectionHeader">
            <h1 class="sectionTitle"> <?= $features_data['title']; ?> </h1>
            <h2 class="sectionDescTitle"> <?= $features_data['sub_title']; ?> </h2>
            <p class="sectionDecription"> <?= $features_data['desc']; ?> </p>
        </div>

        <?php
            // Posts Query
            $args = array(
                'orderby' => 'date',
                'post_type' => 'features',
            );
            $the_query = new WP_Query( $args );

        if ( $the_query->have_posts() ) :
            ?>
            <div class="sectionContent">
                <div class="row">
                    <?php
                        while ( $the_query->have_posts() ) :
                        $the_query->the_post();
                    ?>
                        <div class="col-12 col-sm-4">
                            <div class="featureBox">
                                <div class="featureBoxIcon">
                                    <?php if ( has_post_thumbnail() )
                                        {
                                            the_post_thumbnail('',array('class' => 'img-fluid'));
                                        }
                                    ?>
                                </div>
                                <h2> <?php the_title() ?> </h2>
                                <?php the_content(); ?>
                            </div>
                        </div>
                    <?php endwhile;  ?>
                </div>
            </div>

        <?php
            endif;
            wp_reset_postdata();
        ?>


        <?php get_template_part('templateParts/discover'); ?>

    </div>
</div>
