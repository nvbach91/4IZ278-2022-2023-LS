@extends('layout')

@section('content')
    <h1>Dashboard</h1>
    <div class="card">
        <div class="card-header bg-dark text-light">
            <h2>Nejnovější projekty</h2>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($projects as $project)
                    @component('components.project-card', ['project' => $project])
                    @endcomponent
                @endforeach
            </div>
        </div>
    </div>

    

    


    <div class="container-fluid row mt-4">
        <div class="col-md-4 col-sm-10 mx-auto">
            <h1>Statistika tagů</h1>
            <canvas id="tagChart" width="400" height="400"></canvas>
        </div>
        <div class="col-md-4 col-sm-10 mx-auto">
            <h1>Přehled úkolů</h1>
            <canvas id="taskChart" width="400" height="400"></canvas>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const tagChart = document.getElementById('tagChart');
        const taskChart = document.getElementById('taskChart');


        var tags = {!! json_encode($tags) !!}
        var tag_names = [];
        var tag_colors = [];

        var tagCounts = {!! json_encode($tagCounts) !!}
        var taskCounts = {!! json_encode($taskCounts) !!}



        for (var i = 0; i < tags.length; i++) {

            tag_names[i] = tags[i].name;
            tag_colors[i] = '#' + tags[i].color;
        }


        new Chart(tagChart, {
            type: 'bar',
            data: {
                labels: tag_names,
                datasets: [{
                    label: 'Počet projektů',
                    data: tagCounts,
                    borderWidth: 1,
                    backgroundColor: tag_colors,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(taskChart, {
            type: 'doughnut',
            data: {
                labels: ['dokončené', 'nedokončené'],
                datasets: [{
                    label: 'Počet úkolů',
                    data: taskCounts
                }]
            }
        });
    </script>
@endsection
