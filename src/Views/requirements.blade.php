@extends('vendor.installer.layouts.master')

@section('title', trans('installer_messages.requirements.title'))
@section('container')
    <ul class="list">
        <li class="list__item {{ $phpSupportInfo['supported'] ? 'success' : 'error' }}">
                <strong>
                    <small>
                        (version {{ $phpSupportInfo['minimum'] }} required)
                    </small>
                </strong>
                <span class="float-right">
                        <strong>
                            {{ $phpSupportInfo['current'] }}
                        </strong>
                        <i class="fa fa-fw fa-{{ $phpSupportInfo['supported'] ? 'check-circle-o' : 'exclamation-circle' }} row-icon" aria-hidden="true"></i>
                    </span>
        </li>

        @foreach($requirements['requirements'] as $extention => $enabled)
        <li class="list__item {{ $enabled ? 'success' : 'error' }}">{{ $extention }}</li>
        @endforeach
    </ul>

    @if ( ! isset($requirements['errors']))
        <div class="buttons">
            <a class="button" href="{{ route('LaravelInstaller::permissions') }}">
                {{ trans('installer_messages.next') }}
            </a>
        </div>
    @endif
@stop
