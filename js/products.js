$(document).ready(function() {
    $('#products-table').DataTable({
        select: true,
        colReorder: {
            fixedColumnsLeft: 1,
            fixedColumnsRight: 1
        },
        "columnDefs": [
            {
              "data": null,
              "defaultContent": "<button>Edit</button>",
              "targets": -1
            }
          ],
        dom: 'Bfrtip',
        buttons: [
            {
                text: 'Delete selected',
                action: function ( e, dt, node, config ) {
                    // dt.ajax.reload();
                    alert('delete', dt);
                }
            },
            {
                text: 'Add new',
                action: function () {
                    $("#addForm-add-button").click();
                }
            }
        ],
    });
    $('#products-table tbody').on( 'click', 'button', function () {
        var row = $(this).closest('tr');
        var id = row.find("td:nth-child(1)").text();
        alert( 'edit:'  + id );
    } );
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
