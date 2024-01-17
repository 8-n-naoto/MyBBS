@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))

<p>アクセス権がない、または認証に失敗</p>

