<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golondrive</title>
    <style>
        header {
            background: linear-gradient(135deg, #c165dd, #84f18a);
            color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        h1 {
            font-family: fantasy;
            color: rgb(73, 73, 73);
            margin: 0;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 15px;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
        }

        nav ul li a {
            font-family: fantasy;
            color: rgb(117, 172, 117);
            text-decoration: none;
        }

        nav ul li a:hover {
            text-decoration: underline;
            color: rgb(89, 150, 89);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
            color: #333;
            font-weight: bold;
            padding: 12px;
            border-bottom: 2px solid #ddd;
        }

        tr {
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            padding: 12px;
            vertical-align: middle;
        }

        a {
            text-decoration: none;
            color: #007bff;
            transition: color 0.2s ease-in-out;
        }

        a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        a[href*="/delete/"] {
            color: #d9534f;
        }

        a[href*="/delete/"]:hover {
            color: #c9302c;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }

            td, th {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>GOLONDRIVE</h1>
        <nav class="inicio">
            <ul>
                @auth
                    <li>{{ Auth::user()->name }}</li>
                    <li><a href="/logout">Logout</a></li>
                @else
                    <li><a href="/register">Register</a></li>
                    <li><a href="/login">Login</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    @can('upload', App\Models\File::class)
        <form method="POST" action="/upload" enctype="multipart/form-data" style="margin: 20px 0;">
            @csrf
            <input type="file" name="uploaded_file" />
            <input type="submit" value="Upload" />
        </form>
    @endcan    

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Size</th>
                <th>Owner</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $f)
                <tr>
                    <td><a href="/download/{{$f->id}}">{{$f->name}}</a></td>
                    <td>{{$f->size()}}</td>
                    <td>{{$f->user->name}}</td>
                    <td>{{$f->create_at}}</td>
                    <td>{{$f->update_at}}</td>
                    <td>
                        @can('delete', $f)
                            <a href="/delete/{{$f->id}}">Delete</a>
                        @endcan
                    </td>
                </tr>    
            @endforeach
        </tbody>
    </table>
</body>
</html>
