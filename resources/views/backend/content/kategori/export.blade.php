<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Kategori</title>
</head>
<body>

    <h3>Data Kategori</h3>


    <table border="1" width="100%">
        <head>
            <tr>
                <th style="text-align: left">No</th>
                <th style="text-align: left">Nama Kategori</th>
            </tr>
        </head>
        <tbody>

            @php
                $no=1;
            @endphp

            @foreach ($kategori  as $row )
            <tr>
                <td>{{ $no++}}</td>
                <td>{{ $row->nama_kategori }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>


</body>
</html>
