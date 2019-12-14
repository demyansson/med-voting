@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit voting</div>

                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif

                        <voting-form title="{{ $voting->title }}" description="{{ $voting->description }}"
                                     options-json="{{ json_encode($voting->options->toArray()) }}" method="put"
                                     csrf="{{ csrf_token() }}"
                                     action="{{ route('voting.update', ['voting' => $voting->id]) }}"></voting-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
