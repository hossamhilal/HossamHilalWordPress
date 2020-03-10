<!-- HOME BLOG -->

<?php
    $blog_data = get_option('blog_array', true);

    $args = array(
        'orderby' => 'date',
        'post_type' => 'blog',
    );
    $the_query = new WP_Query( $args );
?>


<div class="homeBlogs">
    <div class="container">

        <div class="sectionHeader">
            <h1 class="sectionTitle">  <?= $blog_data['title']; ?> </h1>
            <h2 class="sectionDescTitle">  <?= $blog_data['sub_title']; ?> </h2>
            <p class="sectionDecription">  <?= $blog_data['desc']; ?> </p>
        </div>

        <?php if ( $the_query->have_posts() ) : ?>
            <div class="homeBlogsContent">
                <div class="row">
                    <?php
                        $count = 0;
                        while ( $the_query->have_posts() ) :
                        $the_query->the_post();
                        $count++;
                        if ($count<4) :
                    ?>
                        <div class="col-12 col-sm-6 col-md-4">
                            <?php get_template_part('templateParts/shared/blogPost'); ?>
                        </div>
                    <?php endif; endwhile; ?>
                    <?php if ($count>= 4) : ?>
                        <div class="col-12">
                            <div class="show-all-box">
                                <a href="#" class="orangeBtn"> <span> See All  </span> </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; wp_reset_postdata(); ?>

    </div>
</div>

