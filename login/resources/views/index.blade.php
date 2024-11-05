
@if ($superarray == NULL)

    <p>No hay comentarios

 @else
            
        <ul>
            @foreach($superarray as $comment)
             <li><a hred='/comments/$id'>{{$comment}}</a></li>
            @endforeach
        </ul>
@endif
<a href=/comments/create>Crear</a>
@include('footer')