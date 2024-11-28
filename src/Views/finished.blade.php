@extends('vendor.installer.layouts.master')

@section('title', trans('installer_messages.final.title'))
@section('container')
    <p class="paragraph" style="text-align: center; color: #0b9b5d">
        {{ session('installer')['message'] ?? trans('installer_messages.final.finished') }}
    </p>
    <div class="buttons">
        <a href="{{ url('/') }}" class="button">{{ trans('installer_messages.final.exit') }}</a>
    </div>
@stop
