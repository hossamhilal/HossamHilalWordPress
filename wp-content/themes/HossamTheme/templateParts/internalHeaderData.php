
<?php
    $page_description = get_post_meta($post->ID, 'page_description', true);
?>

<div class="pageInfo">
    <h1> <?php the_title() ?> </h1>
    <p> <?= $page_description; ?>  </p>

    <?php get_template_part('templates-parts/shared/breadcrumb'); ?>
</div>