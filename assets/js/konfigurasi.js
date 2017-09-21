(function(){
    $('#comLogin').change(function(event) {
        var login = $(this).val();
        if(login == 'T') {
            $('#input-username').show();
            $('#input-password').show();
        }
        else {
            $('#input-username').hide();
            $('#input-password').hide();
        }
    });

    $('#comSecurity').change(function(event) {
        var security = $(this).val();
        switch(security) {
            case 'NONE':
                $('#txtPort').val(25)
                break;
            case 'TLS':
                $('#txtPort').val(587)
                break;
            case 'SSL':
                $('#txtPort').val(465)
                break;
        }
    });
})();
