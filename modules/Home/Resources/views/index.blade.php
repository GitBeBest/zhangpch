@extends('home::layouts.master')
@include('home::layouts.header')
<head>
    <link rel="stylesheet" type="text/css" href="/modules/home/css/index.css">
</head>
@section('content')
    <div class="container">
        @include('home::index.article')
        @include('home::index.right')
    </div>
@stop