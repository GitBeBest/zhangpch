@extends('home::layouts.master')
@include('home::layouts.header')
<head>
    <link rel="stylesheet" type="text/css" href="/modules/home/css/index.css">
</head>
@section('content')
    <div class="container">
        @include('home::article.detail')
        @include('home::index.right')
    </div>
    <script type="text/javascript" src="/modules/home/js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="/modules/home/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="/modules/home/js/index.js"></script>
@stop