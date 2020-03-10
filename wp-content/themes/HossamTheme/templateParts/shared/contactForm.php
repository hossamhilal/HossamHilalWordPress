
<form id="new_post" name="new_post_form" method="post">
    <div class="flexField">
        <div class="inputField"> <input type="text" name="name" id="name" placeholder="Name"> </div>
        <div class="inputField"> <input type="text" name="website" id="website" placeholder="Website Link"> </div>
    </div>
    <div class="inputField"> <input type="email" name="email" id="email" placeholder="Email"> </div>
    <div class="inputField textareaField"> <textarea name="message" id="message" placeholder="Message"></textarea> </div>
    <div class="agree">
        <label class="customCheckbox">
            <input type="checkbox" checked="checked">
            <span class="checkmark"></span>
        </label>
        <p> You agree with <a href="#"> Terms Of Service </a> &  <a href="#"> Privacy Policy </a> </p>
    </div>
    <button class="orangeBtn" id="contact_submit" type="submit">  <span> send </span> </button>

    <input type="hidden" name="action" value="new_post">



    <?php
        if( !empty($_SESSION['errors'])){
            foreach ($_SESSION['errors'] as $error=>$val) : ?>
                <div class="form-text alert alert-danger"> <?php echo $val ?></div>
            <?php endforeach;
        }
        if( !empty($_SESSION['success'])) { ?>
            <div class="form-text alert alert-success"> <?= $_SESSION['success'] ; ?> </div>
        <?php } ?>

</form>
