<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .container,.table{
            width:100%;
        }
        .text-center{
            text-align: center;
        }
        @page {
            header: page-header;
            footer: page-footer;
        }
       
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        #total{
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <div>
            <table>
                <tr>
                    <td><img src="{{ public_path('logo1.png') }}" style="width: 200px; height: 100px"></td>
                    <td><h3 style="font-size: 25px;">Diginity Health Products Supply</h3></td>
                </tr>
            </table>
            <p style="text-align: center;"><b>{{$month}}'s Sale List<b></p>
            <hr>
            <table style="width: 100%;">
                <th style="font-size: 14pt;">
                    <tr>
                        <td>Products Name</td>
                        <td>Quantity</td>
                    </tr>
                </th>
                @foreach($data as $key=>$value)
                <tr style="font-size: 12pt;">
                    <td>{{$key}}</td>
                    <td>{{$value}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

</body>
</html>