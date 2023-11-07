<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New order</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <style>

    </style>
</head>
<body class="antialiased">
<div class="content">
    <table>
        @foreach($data->products as $product)
            <tr>
                <td>
                    <a href="{{config('app')['url'].'/product/'.$product->id}}">
                        <img src="{{$product->getFirstMediaUrl('main_image')}}" alt="{{$product->title}}" width="100">
                    </a>
                </td>
                <td>{{$product->title . ' - '.$product->price}}AMD</td>
            </tr>
        @endforeach
        <tr>
            <td>full name:</td>
            <td>{{$data->first_name.' '.$data->last_name}}</td>
        </tr>
        <tr>
            <td>email:</td>
            <td>{{$data->email}}</td>
        </tr>
        <tr>
            <td>tel:</td>
            <td>{{$data->tel}}</td>
        </tr>
        <tr>
            <td>comment:</td>
            <td>{{$data->comment}}</td>
        </tr>
        <tr>
            <td>date:</td>
            <td>{{$data->start_date.' - '.$data->end_date}}</td>
        </tr>
        <tr>
            <td>total price:</td>
            <td>{{$data->total_price}}AMD</td>
        </tr>
    </table>
</div>
</body>
</html>
