@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card voting">
                    <div class="card-header">{{ $voting->title }}</div>

                    <div class="card-body">
                        <div class="voting_info">

                            <div class="voting_description">
                                {{ $voting->description }}
                            </div>

                            <div class="voting_votes">
                                Total {{ $voting->votes_count }} voted
                            </div>

                        </div>

                        <div class="voting_options">
                            @foreach($votingResult['options'] as $option)

                                @if($votingResult['hidden'])
                                    <form method="post" id="option_{{ $option['id']}}"
                                          action="{{ route('vote.store') }}">
                                        @csrf
                                        <input name="voting_option_id" value="{{ $option['id'] }}" type="hidden">
                                    </form>
                                @endif

                                <div class="option_wrapper">
                                    <div
                                        class="option @if(!$votingResult['hidden']) inactive @if($votedOption->id == $option['id']) selected @endif @endif"

                                        @if($votingResult['hidden'])

                                        onclick="
                                            form = document.getElementById('option_{{ $option['id'] }}');
                                            form.submit();
                                            " @endif>

                                        <div class="option_title">
                                            {{ $option['title'] }}
                                        </div>

                                        @if(!$votingResult['hidden'])
                                            <div class="option_result">
                                                {{"{$option['votedPercent']}%({$option['voted']})" }}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
