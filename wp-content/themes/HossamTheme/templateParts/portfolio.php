<!-- PORTFOLIO  -->

<?php
    $portfolio_details = get_option('portfolio_array', true);
    $theme_data = get_option('theme_setting_data', true);

    $args = array(
        'orderby' => 'date',
        'post_type' => 'portfolio',
    );
    $the_query = new WP_Query( $args );
?>

<div class="portfolioWrapper">
    <div class="container">

        <div class="sectionHeader">
            <h1 class="sectionTitle">  <?= $portfolio_details['title']; ?> </h1>
            <h2 class="sectionDescTitle">  <?= $portfolio_details['sub_title']; ?> </h2>
            <p class="sectionDecription">  <?= $portfolio_details['desc']; ?> </p>
        </div>


        <?php if ( $the_query->have_posts() ) : ?>
            <div class="portfolioFilter">
                <div class="portfolioFilterList">
                    <ul>
                        <?php
                            $all_categories = get_categories(array(
                                'hide_empty' => true
                            ));
                        ?>
                        <?php foreach($all_categories as $category): ?>
                            <li> <a href="#" data-filter=".<?php echo $category->slug; ?>"><?php echo $category->name; ?> </a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="portfolioFilterContent">
                    <div class="row">
                        <?php
                            $count = 0;
                            while ( $the_query->have_posts() ) :
                            $the_query->the_post();
                            $portfolio_post_avatar = get_post_meta($post->ID, 'portfolio_post_avatar', true);
                            $categories = get_the_category();
                            $slugs = wp_list_pluck($categories, 'slug');
                            $class_names = join(' ', $slugs);
                            $count++;
                            if ($count<9) :
                        ?>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mix<?php if ($class_names) { echo ' ' . $class_names;} ?>">
                                <div class="portfolioBox">
                                    <?php if ( $portfolio_post_avatar) { ?>
                                        <img src="<?= $portfolio_post_avatar;?>" alt="avatar" class="img-fluid w-100">
                                    <?php } else { ?>
                                        <img src="<?php echo $theme_data['serviceImage']; ?>" alt="Default Image" class="img-fluid w-100">
                                    <?php  }?>
                                    <div class="hoverBlock">
                                        <h3> <?php the_title() ?> </h3>
                                        <div class="portfolioBoxFtter">
                                            <a href="<?php the_permalink(); ?>" class="readMoreArrow"> <i class="icofont-long-arrow-right"></i> </a>
                                            <div class="zoom">
                                                <?php
                                                    $featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');
                                                    echo '<a href="'.$featured_img_url.'" data-fancybox="gallery">';
                                                        the_post_thumbnail('thumbnail');
                                                    echo '</a>';
                                                ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/icon-zoom.svg" alt="zoom" class="img-fluid zoomIcon">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; endwhile; ?>
                        <?php if ($count>= 9) : ?>
                            <div class="col-12">
                                <div class="show-all-box">
                                    <a href="#" class="orangeBtn"> <span> See All  </span> </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</div>
