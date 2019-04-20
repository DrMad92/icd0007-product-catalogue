$(document).ready(function() {
    $("[id$=-tree]").click(function(){
        var id = $(this).attr('id').replace("-tree", "");
        $(".category").hide();
        $("#" + id + "-title").show();
        $("#" + id).show();
        $("#" + id).html('<object type="text/html" data="static/products.html?category=' + id + '" ></object>');
    });
    $("#addForm-add-button").click(function(){
        $("#addForm").show();
    });
    $("#addForm-close-button").click(function(){
        $("#addForm").hide();
    });
    $("#addForm-submit").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
    
        $.ajax({
               method: method,
               url: url,
               data: form.serialize(),
               error: function(err){
                    alert(err.responseJSON.message);
               },
               success: function(resp)
               {
                    alert(resp.message);
                    window.location.reload();
               }
             });
    });
});
