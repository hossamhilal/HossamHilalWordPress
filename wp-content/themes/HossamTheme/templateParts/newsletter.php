<!-- SUBSCRIBE  -->

<?php   $newsletter_data = get_option('newsletter_data', true); ?>

<div class="subscribeWrapper">
    <div class="container">

        <div class="sectionHeader">
            <h1 class="sectionTitle"> <?= $newsletter_data['title']; ?> </h1>
            <h2 class="sectionDescTitle"> <?= $newsletter_data['sub_title']; ?> </h2>
            <p class="sectionDecription"> <?= stripslashes($newsletter_data['desc']); ?> </p>
        </div>

        <!-- Newsletter Form  -->
        <?php get_template_part('templateParts/shared/newsletterForm'); ?>

    </div>
</div>
