<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Golondrive</title>
<head>
<body>
    <header>
        <h1>GOLONDRIVE</h1>
        <nav class="inicio">
            <ul>
                @auth
                 {{Auth::user()->name}}
                @else 
                <li><a href="/register">Register</a></li>
                <li><a href="/login">Login</a></li>
                 @endauth
        </nav>
        <nav>
            <ul>
                <ol><a href="/logout">Logout</a></li>
        </nav>

    </header>
    @can('upload', App\Models\File::class)
    <form method="POST" action="/upload" enctype="multipart/form-data">
        @csrf
        <input type="file" name="uploaded_file"/>
        <input type="submit" value="upload"/>
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
        @foreach ($files as $f)
        <tr>
            <td>
                @can('delete',$f)
                <a href="/delete/{{$f->id}}">Delete</a></td>
                @endcan
            <td><a href="/download/{{$f->id}}">{{$f->name}}</td>
            <td>{{$f->size()}}</td>
            <td>{{$f->user->name}}</td>
            <td>{{$f->create_at}}</td>
            <td>{{$f->update_at}}</td>
        </tr>    
            
        @endforeach
     </table>
</body>  
<style>
    header{
        background: linear-gradient(135deg, #c165dd, 
        #84f18a);
            color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    h1{
        
        font-family:fantasy; 
        color: rgb(73, 73, 73);
    }
    nav ul li a{
        font-family: fantasy;
        color: rgb(117, 172, 117);
    }
/* General styles for the table container */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 16px;
    text-align: left;
}

/* Style for table headers */
th {
    background-color: #f4f4f4;
    color: #333;
    font-weight: bold;
    padding: 12px;
    border-bottom: 2px solid #ddd;
}

/* Style for table rows */
tr {
    border-bottom: 1px solid #ddd;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f1f1;
}

/* Style for table cells */
td {
    padding: 12px;
    vertical-align: middle;
}

/* Style for links */
a {
    text-decoration: none;
    color: #007bff;
    transition: color 0.2s ease-in-out;
}

a:hover {
    color: #0056b3;
    text-decoration: underline;
}

/* Style for delete link specifically */
a[href*="/delete/"] {
    color: #d9534f;
}

a[href*="/delete/"]:hover {
    color: #c9302c;
    text-decoration: underline;
}

/* Responsive styling */
@media (max-width: 768px) {
    table {
        font-size: 14px;
    }

    td, th {
        padding: 8px;
    }
}

    

</style>
