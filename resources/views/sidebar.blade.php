<h2 class="text-center">TOP VOTING</h2>
<div class="voting-list top">
    @foreach($votings as $voting)
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
                        @foreach($voting->options as $option)
                            <div class="option_wrapper">
                                <div
                                    class="option inactive">

                                    <div class="option_title">
                                        {{ $option->title }}
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
