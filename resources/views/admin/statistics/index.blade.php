@extends('layouts.dashboard')

@section('admin.content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col 12">
            <h1 class="mb-5 text-center ">Statistiche ristorante</h1>

            <canvas id="myCanvasMonth" ></canvas>
            <canvas id="myCanvasYear" ></canvas>

        </div>
    </div>
</div>



<script>



let myCanvasMonth = document.getElementById("myCanvasMonth").getContext('2d');
let myLabelsMonth = ["Gen", "Feb", "Mar", "Apr", "Mag", "Giu", "Lug", "Ago","Set", "Ott", "Nov", "Dic"];
let myDataMonth = [50, 70, 80, 20, 15, 35, 65, 90, 150, 200, 175, 300]
let thisYear = new Date().getFullYear();

// global options
Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;
Chart.defaults.global.defaultFontColor = "#777";

let chartMonth = new Chart(myCanvasMonth, {
    type: "bar",
    data: {
        labels: myLabelsMonth,
        datasets:[{
            label: "Numero ordini",
            data: myDataMonth,
            backgroundColor: [
                "#0d47a1",
                "#1565c0",
                "#1976d2",
                "#1e88e5",
                "#2196f3",
                "#42a5f5",
                "#64b5f6",
                "#90caf9",
                "#bbdefb",
                "#b6bde8",
                "#00c1b2",
                "#00f2b2"
            ],
        }]
    },

    options:{
        title: {
            display: true,
            text: "Ordini mensili del ristorante per l'anno " + thisYear ,
            fontSize: 25,
        },
        legend: {
            display: true,
            position: "right",
        },
        layout:{
            padding: 40,
        },
        tooltips:{
            enabled: true,
        }
    },
});



let myCanvasYear = document.getElementById("myCanvasYear").getContext('2d');
let myLabelsYear = ["2015", "2016", "2017","2018", "2019", "2020", "2021"];
let myDataYear = [500, 600, 700, 800, 900, 1000, 1100]

// global options
Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;
Chart.defaults.global.defaultFontColor = "#777";

let chartYear = new Chart(myCanvasYear, {
    type: "horizontalBar",
    data: {
        labels: myLabelsYear,
        datasets:[{
            label: "Numero ordini",
            data: myDataYear,
            backgroundColor: [
                "#0d47a1",
                "#1565c0",
                "#1976d2",
                "#1e88e5",
                "#2196f3",
                "#42a5f5",
                "#64b5f6",
                "#90caf9",
                "#bbdefb",
                "#b6bde8",
                "#00c1b2",
                "#00f2b2"
            ],
        }]
    },

    options:{
        title: {
            display: true,
            text: "Ordini annuali del ristorante",
            fontSize: 25,
        },
        legend: {
            display: true,
            position: "right",
        },
        layout:{
            padding: 40,
        },
        tooltips:{
            enabled: true,
        }
    },
});



</script>
@endsection
