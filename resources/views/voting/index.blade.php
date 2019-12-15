@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="voting-list">
                    @foreach($votings as $voting)
                        @php $votingResult = $voting->getResult() @endphp
                        <div class="voting">
                            <a href="{{ route('voting.show', ['voting' => $voting->id]) }}">
                                <div class="">{{ $voting->title }}</div>
                                <div class="">
                                    <div class="voting_info">
                                        <div class="voting_votes">
                                            Total {{ $voting->votes_count }} voted
                                        </div>

                                    </div>

                                    <div class="voting_options">
                                        @foreach($votingResult['options'] as $option)
                                            <div class="option_wrapper">
                                                <div
                                                    class="option inactive">

                                                    <div class="option_title">
                                                        {{ $option['title'] }}
                                                    </div>

                                                    @if(!$votingResult['hidden'])
                                                        <div class="option_result">
                                                            {{(int)$option['votedPercent']."%({$option['voted']})" }}
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
