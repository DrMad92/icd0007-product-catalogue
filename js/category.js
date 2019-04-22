$(document).ready(function() {
    // Click on left category list
    $("[id$=-tree]").click(function(){
        var id = $(this).attr('id').replace("-tree", "");
        $(".category").hide();
        $("#" + id + "-title").show();
        $("#" + id).show();
        // Load products page for this category
        $("#" + id).html('<object type="text/html" data="src/products.php?category=' + id + '" ></object>');
    });
    // Submit event
    $("[type=submit]").click(function(e) {
        e.preventDefault();
        var buttonName = $(this).attr('name');
        var form = $(this).parents('form:first');
        var url = form.attr('action');
        var method = form.attr('method');
    
        $.ajax({
               method: method,
               url: url,
               data: form.serialize() + "&" + buttonName + "=",
               error: function(err){
                    alertify.error(err.status + ' ' + err.responseJSON.message, 5);
               },
               success: function(resp)
               {
                    var msg = alertify.success(resp.message, 0, function(){
                        window.location.reload();
                    });
                    $('body').one('click', function(){
                        msg.dismiss();
                    });
               }
             });
    });
});
