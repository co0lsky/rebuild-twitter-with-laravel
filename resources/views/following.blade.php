@extends('layouts.profile')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Following</div>

                <div class="panel-body">
                    <div class="list-group">
                    @forelse ($list as $following)
                        <a href="{{ url('/' . $following->username) }}" class="list-group-item">
                            <h4 class="list-group-item-heading">{{ $following->name }}</h4>
                            <p class="list-group-item-text">{{ $following->username }}</p>
                        </a>
                    @empty
                        <p>No users</p>
                    @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
