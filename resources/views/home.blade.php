@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Timeline</div>


                <div class="panel-body" id="list-1" v-infinite-scroll="loadMore" infinite-scroll-disabled="busy" infinite-scroll-distance="10">
                    <form method="POST" action="/tweet">
                        {{ csrf_field() }}
                        @if ($errors->has('tweet_body'))
                        <div class="form-group input-group has-error">
                        @else
                        <div class="form-group input-group">
                        @endif
                            <input type="text" class="form-control" id="tweet_body" name="tweet_body" placeholder="What's happening?">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">Tweet</button>
                            </span>
                        </div>
                        @if ($errors->has('tweet_body'))
                        <div class="has-error">
                            <span class="help-block">{{ $errors->first('tweet_body') }}</span>
                        </div>
                        @endif
                    </form>
                    <template v-for="item in items">
                        <tweet-component :tweet="item"></tweet-component>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ mix('/js/pages/home.js') }}"></script>
@endsection
