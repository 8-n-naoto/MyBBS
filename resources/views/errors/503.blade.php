@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable'))

<p>レンタルサーバーの同時アクセス数の制限をこえた</p>
