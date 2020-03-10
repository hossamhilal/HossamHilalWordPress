
<!-- CONTACT WRAPPER  -->
<?php
    $contact_data = get_option('contact_data', true);
?>

<div class="contactWrapper">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-5 col-lg-6">
                <img src="<?php echo $contact_data['image']; ?>" alt="contact" class="img-fluid">
            </div>
            <div class="col-12 col-md-7 col-lg-6">
                <div class="contactBox">
                    <h1> <?= stripslashes($contact_data['title']); ?> </h1>
                    <p>  <?= stripslashes($contact_data['desc']); ?>  </p>

                    <!-- Contact Form  -->
                    <?php get_template_part('templateParts/shared/contactForm'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

