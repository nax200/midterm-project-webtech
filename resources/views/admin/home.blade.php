@extends('layouts.main')

@section('content')
    <h1 class="text-center text-3xl">
        Most posts sorted by tags
    </h1>
    <div class="inline-block relative w-100% align-middle">
        <canvas id="tags_most_posts"></canvas>

        <script>

            const data = {
                labels: <?=$tags_name?>,
                datasets: [{
                    data: <?=$tags_posts?>,
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(131,255,86)',
                        'rgb(162,86,255)',
                        'rgb(154,59,79)',
                        'rgb(33,100,145)',
                        'rgb(148,119,50)',
                        'rgb(76,147,50)',
                        'rgb(94,50,147)'
                    ],
                    hoverOffset: 4,
                    responsive: true
                }]
            };

            var options = {
                tooltipTemplate: "<%= value %>",

                showTooltips: true,

                onAnimationComplete: function() {
                    this.showTooltip(this.datasets[0].doughnut, true);
                },
                tooltipEvents: [],
                plugins: {
                    datalabels: {
                        color: 'white',
                        font: {
                            weight: 'bold'
                        }
                    }
                }
            }

            const config = {
                type: 'doughnut',
                data: data,
                options: options
            };

            var ctx = document.getElementById('tags_most_posts').getContext('2d');


            const tags_most_posts = new Chart(
                ctx,
                config
            );



        </script>
    </div>

@endsection
