(function(){
    var buttonCommon = {
        exportOptions: {
            format: {
                body: function (data, row, column, node) {
                    // Strip $ from salary column to make it numeric
                    return column === 5 ?
                        data.replace(/[$,]/g, '') :
                        data;
                }
            }
        }
    };
    $('.datatable').dataTable({
        dom: "Bfrtip",
        buttons: [
            {
                extend: "csv",
                className: "btn-sm"
            },
            {
                extend: "excel",
                className: "btn-sm"
            },
        ]
    });

    $("#comPeranan").change(function(){
        if($(this).val() == 3){
            $("#jabatan-penyelaras").show();
        }
        else{
            $("#jabatan-penyelaras").hide();
        }
    });
})();
