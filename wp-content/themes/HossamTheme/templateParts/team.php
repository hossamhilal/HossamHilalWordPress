<!-- TEAM   -->

<?php
    $team_data = get_option('team_data', true);
    $theme_data = get_option('theme_setting_data', true);

    $args = array(
        'orderby' => 'date',
        'post_type' => 'team',
    );
    $the_query = new WP_Query( $args );
?>


<?php if ( $the_query->have_posts() ) : ?>
    <div class="team">
        <div class="container">

            <div class="sectionHeader">
                <h1 class="sectionTitle"> <?= $team_data['title']; ?> </h1>
                <h2 class="sectionDescTitle"> <?= $team_data['sub_title']; ?> </h2>
                <p class="sectionDecription">  <?= $team_data['desc']; ?> </p>
            </div>


            <div class="teamSlider">
                <div class="owl-carousel owl-theme teamOwl">

                    <?php
                    while ( $the_query->have_posts() ) :
                        $the_query->the_post();
                        $job        = get_post_meta($post->ID, 'job', true);
                        $facebook   = get_post_meta($post->ID, 'facebook', true);
                        $twitter    = get_post_meta($post->ID, 'twitter', true);
                        $behance    = get_post_meta($post->ID, 'behance', true);
                        $instagram  = get_post_meta($post->ID, 'instagram', true);


                        ?>
                        <div class="item">
                            <div class="teamBox">
                                <div class="imgBox">
                                    <?php if ( has_post_thumbnail() ) {
                                        the_post_thumbnail('',array('class' => 'img-fluid'));
                                    } else { ?>
                                        <img src="<?php echo $theme_data['teamImage']; ?>" alt="Default Image" class="img-fluid w-100">
                                    <?php  }?>
                                    <div class="teamSocial">
                                        <ul>
                                            <?php if ($facebook) : ?>
                                                <li> <a href="<?= $facebook; ?>"> <i class="icofont-facebook"></i> </a></li>
                                            <?php endif; ?>
                                            <?php if ($twitter) : ?>
                                                <li> <a href="<?= $twitter; ?>"> <i class="icofont-twitter"></i> </a></li>
                                            <?php endif; ?>
                                            <?php if ($instagram) : ?>
                                                <li> <a href="<?= $instagram; ?>"> <i class="icofont-instagram"></i> </a></li>
                                            <?php endif; ?>
                                            <?php if ($behance) : ?>
                                                <li> <a href="<?= $behance; ?>"> <i class="icofont-behance"></i> </a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="teamData">
                                    <h3> <?php the_title(); ?> </h3>
                                    <h5> <?= $job; ?> </h5>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;  ?>

                </div>
            </div>
        </div>
    </div>
<?php endif; wp_reset_postdata(); ?>