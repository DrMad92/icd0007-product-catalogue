$(document).ready(function() {
    // Datatables object for products page
    $('#products-table').DataTable({
        autoWidth: false,
        "columnDefs": [
            { "width": "5%", "targets": 0 },
            { "width": "10%", "targets": 1 },
            {
              "data": null,
              "width": "5%",
              "defaultContent": "<button>Edit</button>",
              "targets": -1
            },
            {"width": "10%", "targets": -2}
        ],
        select: {
            style:    'os',
            selector: 'td:not(:last-child)'
        },
        dom: 'Bfrtip',
        // Delete and Add new buttons definition
        buttons: [
            {
                text: 'Delete selected',
                tag: 'a',
                attr:  {
                    rel: 'modal:open',
                    href: '#deleteForm'
                },
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
                }
            },
            {
                text: 'Add new',
                tag: 'a',
                attr:  {
                    rel: 'modal:open',
                    href: '#addForm'
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
