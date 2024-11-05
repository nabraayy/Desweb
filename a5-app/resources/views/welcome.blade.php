<div style="background-color: rgb(125, 196, 125); display: flex">
@auth
{{ Auth::user()->name}}|
    <a href="/login">Logout</a>    
@else
    <a href="/login">Login</a>
      
@endauth
</div>
@can('upload',App\Models\Fichero::class)
<form method="POST" action="/upload" enctype="multipart/form-data">
    @csrf
    <input type="file" name="uploaded_file"/>
    <input type="submit" value="Upload"/>
</form>    
@endcan

<table>
    <tr>
        <th>Name</th>
        <th>Size</th>
        <th>Owner</th>
        <th>Created at</th>
        <th>Updated at</th>
    </tr>    
  
    @foreach ($fichero as $f)
    <tr>
        <td>
            @can('delete', $f)
                <a href="/delete/{{$f->id}}">Borrar</a></td>
            @endcan     
        <td><a href="/download/{{$f->id}}">{{$f->name}}</td>
        <td>{{$f->size()}}</td>
        <td>{{$f->user->name}}</td>
        <td>{{$f->create_at}}</td>
        <td>{{$f->update_at}}</td>
    </tr>   
    @endforeach
</table> 