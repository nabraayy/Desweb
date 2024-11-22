<form method=POST action=/comments/{{$cid}}>
    <input type=hidden name=method value=PATCH>
    <input name=comment value='{{$id}}'>
    <input type=submit>
</form>
@include('footer')