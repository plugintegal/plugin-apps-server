@extends('beautymail::templates.sunny')

@section('content')
    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'Selamat Datang '.$name,
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')
        <img src="{!!$message->embedData(QrCode::format('png')->merge('/public/images/zerotwo.png', .3)->size(400)->errorCorrection('H')->generate($name), 'QrCode.png', 'image/png')!!}">
        <p>scan qr</p>




    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
        	'title' => 'Click me',
        	'link' => 'http://google.com'
    ])

@stop
