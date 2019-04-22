$(document).ready(function() {
    // Datatables object for products page
    $('#products-table').DataTable({
        select: true,
        "columnDefs": [
            {
              "data": null,
              "defaultContent": "<button>Edit</button>",
              "targets": -1
            }
          ],
        dom: 'Bfrtip',
        // Delete and Add new buttons definition
        buttons: [
            {
                text: 'Delete selected',
                action: function ( e, dt, node, config ) {
                    var data = dt.rows('.selected').data();
                    $("#remove-list tbody").empty();
                    if (data.length == 0){
                        $("#deleteForm").find("h1").html('Please select product');
                        $("#deleteForm").find("[name=delete]").hide();
                        $("#remove-list").hide();
                    }else {
                        $("#deleteForm").find("h1").html('Delete these products?');
                        $("#deleteForm").find("[name=delete]").show();
                        $("#remove-list").show();
                        for(i=0;i<data.length;i++){;
                            $("#remove-list tbody").append("<tr><td>" + data[i][0] +"</td><td>"+ data[i][2] +"</td></tr>");
                            $("#remove-list tbody").append('<input type="hidden" name="id[]" value="' + data[i][0] + '"/>');
                        }
                    };
                    $("#deleteForm").show();
                }
            },
            {
                text: 'Add new',
                action: function () {
                    $("#addForm").show();
                }
            }
        ],
    });
    // Click on edit button event
    $('#products-table tbody').on( 'click', 'button', function () {
        var row = $(this).closest('tr');
        var id = row.find("td:nth-child(1)").text();
        alert( 'edit:'  + id );
    } );
    // Form close button event
    $("[id$=Form-close-button]").click(function(){
        var id = $(this).attr('id').replace("-close-button","");
        $("#" + id).hide();
    });
    // Form submit event, captures submit button name as well
    $("[type=submit]").click(function(e) {
        e.preventDefault();
        var buttonName = $(this).attr('name');
        var form = $(this).parents('form:first');
        var url = form.attr('action');
        var method = form.attr('method');
    
        $.ajax({
               method: method,
               url: url,
               data: form.serialize() + "&" + buttonName + "=", // different actions depending on button clicked
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
