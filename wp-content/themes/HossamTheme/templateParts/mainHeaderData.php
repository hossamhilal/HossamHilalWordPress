
<?php  $header_data = get_option('header_details', true); ?>

    <div class="mainHeaderData">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="dataBox">
                    <h2> <?= $header_data['sub_title']; ?> </h2>
                    <h1 class="typedHere"> <?= stripslashes($header_data['title']); ?> </h1>
                    <p> <?= $header_data['desc']; ?> </p>

                    <div class="mainHeaderDataBtns">
                        <a class="orangeBtn startBtn" href="<?= $header_data['get_started_link']; ?>">  <span> get started </span> </a>
                        <a class="transparentBtn" href="<?= $header_data['read_more']; ?>"> <span> read more </span> </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <img src="<?php echo $header_data['image']; ?>" alt="vector" class="img-fluid">
            </div>
        </div>
    </div>
