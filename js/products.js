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
              "defaultContent": '<a href="#editForm" rel="modal:open">Edit</a>',
              "targets": -1
            },
            {"width": "10%", "targets": -2},
            { "orderable": false, "targets": [3,5] },
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
    $('#products-table tbody').on( 'click', 'a', function () {
        $(this).closest('form').find("input[type=text], textarea").val("");
        var row = $(this).closest('tr');
        var id = row.find("td:nth-child(1)").text();
        var pid = row.find("td:nth-child(2)").text();
        var pname = row.find("td:nth-child(3)").text();
        var description = row.find("td:nth-child(4)").text();
        var category = row.find("td:nth-child(5)").text();
        $("#editForm-submit input[name='id']").val(id);
        $("#editForm-submit input[name='name']").val(pname);
        $("#editForm-submit input[name='pid']").val(pid);
        $("#editForm-submit textarea[name='description']").val(description);
        $("#editForm-submit select[name='category']").val(category).change();
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
