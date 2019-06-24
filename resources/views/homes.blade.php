@extends('base')
@section('content')
<header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active" style="background-image: url('0.jpeg')">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('4.jpeg')">
                <div class="carousel-caption d-none d-md-block">
                    <p>Изучай теоретические материалы</p>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('2.jpeg')">
                <div class="carousel-caption d-none d-md-block">
                    <p>Проверь свои знания, изучив теорию</p>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('3.jpeg')">
                <div class="carousel-caption d-none d-md-block">
                    <p>Выполни все лабораторные работы</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</header>
<div class="container">
    <br>
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <h4 class="card-header">Теоретический раздел</h4>
                <div class="card-body">
                    <p class="card-text">Данный раздел содержит в себе теоретические материалы по дисциплине</p>
                </div>
                <div class="card-footer">
                    <a href="/theory" class="btn btn-primary">Перейти</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <h4 class="card-header">Практический раздел</h4>
                <div class="card-body">
                    <p class="card-text">В данном разделе находятся лабораторные работы для дальнейшего выполнения</p>
                </div>
                <div class="card-footer">
                    <a href="/practice" class="btn btn-primary">Перейти</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <h4 class="card-header">Раздел контроля знаний</h4>
                <div class="card-body">
                    <p class="card-text">В этом разделе есть возможность проверить свои знания, пройдя лекцию</p>
                </div>
                <div class="card-footer">
                    <a href="/tests" class="btn btn-primary">Перейти</a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row mb-4">
        <div class="col-md-8">
            <p>Также в ЭУМК есть вспомогательный раздел. В этом разделе находится календарно-учебный план и учебную программу. </p>
        </div>
        <div class="col-md-4">
            <a class="btn btn-lg btn-secondary btn-block" href="/supporting">Перейти</a>
        </div>
    </div>
</div>
@endsection
