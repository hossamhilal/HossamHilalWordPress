

<?php
    $discover_data = get_option('discover_array', true);
    $discover_list = get_option('discover_list', true);
?>

<div class="discover">
    <div class="row">
            <div class="col-12 col-lg-6">
                <div class="dicoverVector">
                    <img src="<?php echo $discover_data['image']; ?>" alt="image" class="img-fluid">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <h5> <?= $discover_data['title']; ?> </h5>
                <h1> <?= $discover_data['sub_title']; ?> </h1>
                <p>  <?= stripslashes($discover_data['desc']); ?> </p>
                <div class="list">
                    <?php if ($discover_list) : ?>
                         <ul>
                             <?php foreach ( $discover_list as $key => $value) { ?>
                                <li> <img src="<?php echo get_template_directory_uri(); ?>/images/icon-checkd.png" alt="icon"> <?php echo $value; ?> </li>
                             <?php } ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="flexBtns">
                    <a href="#" class="orangeBtn readMore"> <span> Read More </span> </a>
                    <a href="#" class="watch">
                        <div class="watchIcon"> <span> <img src="<?php echo get_template_directory_uri(); ?>/images/play-button.png" alt="icon"> </span> </div> watch video
                    </a>
                </div>
            </div>
    </div>
</div>

