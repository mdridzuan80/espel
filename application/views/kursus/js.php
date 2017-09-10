<script>
(function(){
    var tahun = <?=$this->uri->segment(3, date('Y'))?>;
    var bulan = <?=$this->uri->segment(4, date('m'))?>;
    for(var i=1;i<=31;i++)
    {
        $.ajax({
            url: base_url + "api/get_event/" + tahun + "/" + bulan + "/" + i ,
            success: genCell(i)
        });
    }
    function genCell(i){
        return function(data, textStatus, jqXHR ){
            var text = "";
            var tkhMula;
            var tkhTamat;

            if(data){
                data.forEach(function(kursus){
                    tkhMula = moment(kursus.tkh_mula);
                    tkhTamat = moment(kursus.tkh_tamat);
                    text = text + "<div class=\"event\"> \
                            <div class=\"event-desc\"> " + kursus.tajuk + "\
                            </div> \
                            <div class=\"event-time\"> \
                                " + tkhMula.format("h:mm a") + " to " + tkhTamat.format("h:mm a") + " \
                            </div> \
                        </div>";
                });
                $("#cell-"+i).parent().append(text);
            }
        }
    }
})();
</script>
