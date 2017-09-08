(function(){
    $('.datatable').dataTable();

    $("#comPeranan").change(function(){
        if($(this).val() == 3){
            $("#jabatan-penyelaras").show();
        }
        else{
            $("#jabatan-penyelaras").hide();
        }
    });
})();
