<form method=post action=/comments>
    @csrf
    <input name=comentario>
    <input type=submit>
</form>
@include('footer')