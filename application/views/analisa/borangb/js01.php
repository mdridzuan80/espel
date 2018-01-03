<script>
$(function(){
    
    $.ajax({
        url: base_url + 'api/analisab_reaksi/<?= $kursus_id ?>',
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

    $.ajax({
        url: base_url + 'api/analisab_pembelajaran/<?= $kursus_id ?>',
        beforeSend: function(jqXHR, settings){
            $("body").css("cursor", "progress");
        },
        success: function(data, textStatus, jqXHR){
            barchart_pembelajaran(data);
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
                labels: ['Tahap kemahiran menjalani tugas harian', 'Komitmen terhadap tugas', 'Memberi keutamaan kerjasama kepada kerja bepasukan', 'Kepekaan terhadap persekitaran kerja', 'Keupayaan mengaplikasikan kemahiran dalam tugas harian', 'Keyakinan menyumbangkan pendapat/idea kepada organisasi'],
                datasets: [{
                    label: "Tidak Memuaskan",
                    backgroundColor: "#eabd5d",
                    data: [datasource['b1-1'], datasource['b2-1'], datasource['b3-1'], datasource['b4-1'], datasource['b5-1'], datasource['b6-1']]
                }, {
                    label: "Memuaskan",
                    backgroundColor: "#ac557a",
                    data: [datasource['b1-2'], datasource['b2-2'], datasource['b3-2'], datasource['b4-2'], datasource['b5-2'], datasource['b6-2']]
                }, {
                    label: "Baik",
                    backgroundColor: "#ac557a",
                    data: [datasource['b1-3'], datasource['b2-3'], datasource['b3-3'], datasource['b4-3'], datasource['b5-3'], datasource['b6-3']]
                }, {
                    label: "Cemerlang",
                    backgroundColor: "#8d4c7d",
                    data: [datasource['b1-4'], datasource['b2-4'], datasource['b3-4'], datasource['b4-4'], datasource['b5-4'], datasource['b6-4']]
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

    function barchart_pembelajaran(datasource){
        var ctx = document.getElementById('myChart2').getContext('2d');
        new Chart(ctx,{
            type: "bar",
            data: {
                labels: ['Perkongsian ilmu telah dilaksanakan dalam organisasi', 'Meningkatkan kecekapan kerja harian', 'Meningkatkan etika kerja', 'Melakukan tugasan dengan lebih rapi dan terancang','Pegawai menyumbangkan kepada produktiviti organisasi','Latihan sejajar dengan pembangunan kerjaya pegawai','Latihan yang dihadiri menguntungkan organisasi'],
                datasets: [{
                    label: "Tidak Memuaskan",
                    backgroundColor: "#eabd5d",
                    data: [datasource['c1-1'], datasource['c2-1'], datasource['c3-1'], datasource['c4-1'], datasource['c5-1'], datasource['c6-1'], datasource['c7-1']]
                }, {
                    label: "Memuaskan",
                    backgroundColor: "#ac557a",
                    data: [datasource['c1-2'], datasource['c2-2'], datasource['c3-2'], datasource['c4-2'], datasource['c5-2'], datasource['c6-2'], datasource['c7-2']]
                }, {
                    label: "Baik",
                    backgroundColor: "#ac557a",
                    data: [datasource['c1-3'], datasource['c2-3'], datasource['c3-3'], datasource['c4-3'], datasource['c5-3'], datasource['c6-3'], datasource['c7-3']]
                }, {
                    label: "Cemerlang",
                    backgroundColor: "#8d4c7d",
                    data: [datasource['c1-4'], datasource['c2-4'], datasource['c3-4'], datasource['c4-4'], datasource['c5-4'], datasource['c6-4'], datasource['c7-4']]
                }]
            },
            options: {
                legend: {
                    display: false
                },
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