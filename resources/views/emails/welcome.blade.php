@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'Hello!',
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

        <p align="center" style="margin-bottom: 50px">Today will be a great day!</p>


    @include('beautymail::templates.sunny.contentEnd')
  @stop
  @section('footer')
  <p align="center" style="margin-bottom: 3px">Contact Person</p>
  <p align="center">
    <a style="display: inline; text-decoration: none; border: none;" href="https://api.whatsapp.com/send?phone=6287848114793" target="_blank" >
      <img style="display: inline;" src="https://freepngimg.com/thumb/whatsapp/4-2-whatsapp-transparent-thumb.png" width="15px" height="15px" />
      Felix Yulianto
    </a>
    <br>
    <a style="display: inline; text-decoration: none; border: none;" href="https://api.whatsapp.com/send?phone=6287848114793" target="_blank" >
      <img style="display: inline;" src="https://freepngimg.com/thumb/whatsapp/4-2-whatsapp-transparent-thumb.png" width="15px" height="15px" />
      Felix Yulianto
    </a>
  </p>
  @stop
