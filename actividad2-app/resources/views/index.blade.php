<h1>Series</h1>

@foreach ($pepitos as $serie)
    <h2>{{$serie->title}}  </h2>
    <p> {{ $serie->year}} </p>
@endforeach




