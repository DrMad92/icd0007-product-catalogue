$(document).ready(function() {
    $("[id$=-tree]").click(function(){
        var id = $(this).attr('id').replace("-tree", "");
        $(".category").hide();
        $("#" + id + "-title").show();
        $("#" + id).show();
        $("#" + id).html('<object type="text/html" data="src/products.php?category=' + id + '" ></object>');
    });
    $("[id$=Form-open-button]").click(function(){
        var id = $(this).attr('id').replace("-open-button","");
        $("#" + id).show();
    });
    $("[id$=Form-close-button]").click(function(){
        var id = $(this).attr('id').replace("-close-button","");
        $("#" + id).hide();
    });
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
                    alert(err.responseJSON.message);
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
