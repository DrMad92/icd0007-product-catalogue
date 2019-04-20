$(document).ready(function() {
    let category = "all";
    let searchParams = new URLSearchParams(window.location.search);
    if (searchParams.has('category')){
        category = searchParams.get('category');
    }
    if (category != "all") {
        $("#addForm-add-button").show();
    }
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
               success: function(resp)
               {
                    alert(resp.message);
                    window.location.reload();
               }
             });
    });
});
