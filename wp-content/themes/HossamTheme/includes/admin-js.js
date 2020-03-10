var $ = jQuery;
jQuery(document).ready(function () {


    // INPUT FOCUS ANIMATION
    $('.InputBox').focus(function(){
        $(this).parent('.FormField').addClass('focused');
    });

    $('.InputBox').each(function() {
        if ($(this).val() != "") {
            $(this).parent('.FormField').addClass('focused');
        }
    });

    $('.InputBox').focusout(function(){
        if($(this).val() === "")
            $(this).parent('.FormField').removeClass('focused');
    });

    // upload image
   $('.uploadImageBtn', this).click(function () {
        var e = jQuery(this);
        tb_show('', 'media-upload.php?type=file&amp;TB_iframe=true');

        window.send_to_editor = function (html) {  // when insert into post is clicked

            $('.reviewImageBox').show();
            var a = jQuery(html); // we get path to file
            fileurl = a.attr('href'); // if you are using type=image then use 'src' instead of 'href'
            var fileName = jQuery(a[0]).text();

            e.parents('.FieldImage').find('.reviewImageBox img').attr('src',fileurl);
            e.parents('.FieldImage').find('.reviewImageBox img').attr('alt',fileName);
            e.parent('.FieldImageButtons').prev('.file_url').val(fileurl).attr('value',fileurl);
            e.hide();
            e.next('.removeImage').show();
            tb_remove();
        }
        return false;
    });

    //  delete image
    $('.removeImage', this).click(function () {
        var e = jQuery(this);
        e.parents('.FieldImage').find('.reviewImageBox').hide();
        e.parents('.FieldImage').find('.reviewImageBox img').attr('src',"");
        e.parents('.FieldImage').find('.reviewImageBox img').attr('alt',"");
        e.parent('.FieldImageButtons').prev('.file_url').val(' ').attr('value'," ");
        e.hide();
        e.prev('.uploadImageBtn').show();
    });


    // Add Items To Discover List
    $('.list-btn', this).click(function () {
        var appendedBox = ('<div class="list-box-item">\n' +
            '                            <input type="text" class="list-input" name="discover_list[]"  value="">\n' +
            '                            <span class="delete-Btn"> Delete  </span>\n' +
            '                        </div>');
        $(appendedBox).appendTo('.list-box');
    });

    // DELETE Items From Discover List 
    $('.delete-Btn', this).click(function () {
        var e = jQuery(this);
        e.parent('.list-box-item').find('input').val(' ').attr('value',"");
        e.parent('.list-box-item').remove();
    });




});