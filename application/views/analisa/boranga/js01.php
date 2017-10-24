<script>
$(function(){
    

    function barchart_reaksi($datasource){
        var ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx,{
            type: "bar",
            data: {
                labels: ["Pencapaian Objektif Kursus", "Kesesuaian tempoh masa", "Bilik kuliah / Dewan", "Nota/Handout", "Teknik penyampaian penceramah", "	Kaedah kursus", "Pencapaian Objectif Kursus"],
                datasets: [{
                    label: "# Pilihan 1",
                    backgroundColor: "#eabd5d",
                    data: [51, 30, 40, 28, 92, 50, 45]
                }, {
                    label: "# of Votes",
                    backgroundColor: "#ac557a",
                    data: [41, 56, 25, 48, 72, 34, 12]
                }, {
                    label: "# of Votes",
                    backgroundColor: "#ac557a",
                    data: [41, 56, 25, 48, 72, 34, 12]
                }, {
                    label: "# of Votes",
                    backgroundColor: "#8d4c7d",
                    data: [41, 56, 25, 48, 72, 34, 12]
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