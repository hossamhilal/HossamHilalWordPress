<?php
    // Services
    $args = array(
        'orderby' => 'date',
        'post_type' => 'Services',
    );
    $the_query = new WP_Query( $args );

    $theme_data = get_option('theme_setting_data', true);
?>

<!-- FOOTER  -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-5">
                <div class="footerLogo"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"> <img src="<?php echo $theme_data['footerLogo']; ?>" alt="logo" class="img-fluid"> </a> </div>
                <div class="description">
                    <p> <?= $theme_data['desc']; ?>  </p>
                </div>
            </div>
            <div class="col-12 col-md-4">

                <div class="footerLinks">
                    <?php
                        if ( $the_query->have_posts() ) :
                    ?>
                        <div class="linksBlock">
                            <h3> Services </h3>
                            <ul>
                                <?php
                                    while ( $the_query->have_posts() ) :
                                    $the_query->the_post();
                                ?>
                                    <li> <a href="<?php the_permalink(); ?>"> <?php the_title() ?> </a> </li>
                                <?php endwhile;  ?>
                            </ul>
                        </div>
                    <?php endif;  wp_reset_postdata();  ?>

                    <?php if ( has_nav_menu( 'footer' ) ) : ?>
                    <div class="linksBlock">
                        <h3> Helpful Links </h3>
                        <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'footer',
                                    'menu_class'     => 'footer-menu',
                                    'depth'          => 1,
                                )
                            );
                        ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="contactInfo">
                    <h3> Contact info </h3>
                    <ul>
                        <li> <img src="<?php echo get_template_directory_uri(); ?>/images/icon-map.png" alt="icon"> Adress : <?= $theme_data['address']; ?> </li>
                        <li> <img src="<?php echo get_template_directory_uri(); ?>/images/icon-envelope.png" alt="icon"> E-mail : <?= $theme_data['email']; ?></li>
                        <li> <img src="<?php echo get_template_directory_uri(); ?>/images/icon-call.png" alt="icon"> Mobile : <?= $theme_data['phone']; ?> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- COPRRIGHT  -->
<div class="copyright">
    <div class="container">
        <div class="data">
            <p> Copyright © 2019 <span> <?= $theme_data['title']; ?> </span>  All Right Reserved. </p>
            <div class="follow">
                <label> Follow Us </label>
                <ul>
                    <li> <a href="<?= $theme_data['facebook']; ?>"> <i class="icofont-facebook"></i> </a></li>
                    <li> <a href="<?= $theme_data['instagram']; ?>"> <i class="icofont-instagram"></i> </a></li>
                    <li> <a href="<?= $theme_data['twitter']; ?>"> <i class="icofont-twitter"></i> </a></li>
                    <li> <a href="<?= $theme_data['behance']; ?>"> <i class="icofont-behance"></i> </a></li>
                    <li> <a href="<?= $theme_data['whatsapp']; ?>"> <i class="icofont-whatsapp"></i> </a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>
