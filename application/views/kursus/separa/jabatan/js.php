<script>
    $(function(){
        $('.comPeruntukan').change(function(e){
            console.log(this);
            if($(this).val() == '0') {
                $('.elPeruntukan').hide('fast');
            }
            else
            {
                $('.elPeruntukan').show('fast');
            }
        });
    });
</script>