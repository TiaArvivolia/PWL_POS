<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 6px 20px;
            line-height: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td, th {
            padding: 4px 3px;
        }
        th {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .border-all, .border-all th, .border-all td {
            border: 1px solid;
        }
        .font-10 {
            font-size: 10pt;
        }
        .font-12 {
            font-size: 12pt;
        }
        .border-bottom-header {
            border-bottom: 1px solid;
        }
    </style>
</head>
<body>
    <h3 class="text-center">LAPORAN DATA USER</h3>
    
    <table class="border-all">
        <thead>
            <tr>
                <th class="text-center">No</th>
                {{-- <th>User ID</th> --}}
                <th>Level</th> <!-- Change this column header -->
                <th>Username</th>
                <th>Nama</th>
                {{-- <th>Password</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                {{-- <td>{{ $user->user_id }}</td> --}}
                <td>{{ $user->level->level_nama }}</td> <!-- Display level_nama -->
                <td>{{ $user->username }}</td>
                <td>{{ $user->nama }}</td>
                {{-- <td>{{ $user->password }}</td> <!-- Be cautious about displaying passwords --> --}}
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
