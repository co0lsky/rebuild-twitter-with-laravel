@extends('layouts.profile')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tweets</div>

                <div class="panel-body">
                    <div class="list-group">
                    @forelse ($user->tweets()->get() as $tweet)
                        <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading">{{ $tweet->body }}</h4>
                            <p class="list-group-item-text">{{ $tweet->created_at }}</p>
                        </a>
                    @empty
                        <p>No tweet</p>
                    @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
