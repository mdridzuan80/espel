<script>
$(function(){
    
    $.ajax({
        url: base_url + 'api/analisa_reaksi',
        beforeSend: function(jqXHR, settings){
            $("body").css("cursor", "progress");
        },
        success: function(data, textStatus, jqXHR){
            barchart_reaksi(data);
        },
        complete: function(jqXHR,textStatus){
            $("body").css("cursor", "default");
        }
    });

    function barchart_reaksi(datasource){
        var ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx,{
            type: "bar",
            data: {
                labels: ['Pencapaian Objektif Kursus', 'Kesesuaian tempoh masa', 'Bilik kuliah / Dewan', 'Nota/Handout', 'Teknik penyampaian penceramah', 'Kaedah kursus', 'Kandungan kursus', 'Urusetia kursus'],
                datasets: [{
                    label: "Tidak Memuaskan",
                    backgroundColor: "#eabd5d",
                    data: [datasource['b1-1'], datasource['b2-1'], datasource['b3-1'], datasource['b4-1'], datasource['b5-1'], datasource['b6-1'], datasource['b7-1'], datasource['b8-1']]
                }, {
                    label: "Memuaskan",
                    backgroundColor: "#ac557a",
                    data: [datasource['b1-2'], datasource['b2-2'], datasource['b3-2'], datasource['b4-2'], datasource['b5-2'], datasource['b6-2'], datasource['b7-2'], datasource['b8-2']]
                }, {
                    label: "Baik",
                    backgroundColor: "#ac557a",
                    data: [datasource['b1-3'], datasource['b2-3'], datasource['b3-3'], datasource['b4-3'], datasource['b5-3'], datasource['b6-3'], datasource['b7-3'], datasource['b8-3']]
                }, {
                    label: "Cemerlang",
                    backgroundColor: "#8d4c7d",
                    data: [datasource['b1-4'], datasource['b2-4'], datasource['b3-4'], datasource['b4-4'], datasource['b5-4'], datasource['b6-4'], datasource['b7-4'], datasource['b8-4']]
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: !0
                        }
                    }]
                }
            }
        })
    }
});
</script>