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
                    console.log(err);
                    alert(err.responseJSON.message + "\nCode: " + err.status);
               },
               success: function(resp)
               {
                    console.log(resp);
                    alert(resp.message);
                    window.location.reload();
               }
             });
    });
});
