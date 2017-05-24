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
<script src="https://unpkg.com/vue-resource@1.2.0/dist/vue-resource.min.js"></script>
<script src="https://unpkg.com/vue-infinite-scroll@2.0.0"></script>
<script type="text/javascript">
    var page = 1;

    Vue.component('tweet-component', {
      props: ['tweet'],
      template: '\
        <div v-if="tweet.author" class="list-group-item">\
            <h4 class="list-group-item-heading">@{{ tweet.author.name }}</h4>\
            <p v-if="tweet.link && tweet.link.short_url">@{{ tweet.link.url }}</p>\
            <p v-else>@{{ tweet.body }}</p>\
            <div class="list-group-item-text panel panel-default" v-if="tweet.link">\
                <a v-bind:href="tweet.link.short_url || tweet.link.url" target="_blank" style="text-decoration: none;">\
                    <div class="media">\
                        <div class="media-middle">\
                            <img class="media-object center-block" style="max-width: 100%;" v-bind:src="tweet.link.cover">\
                        </div>\
                        <div class="media-body panel-body">\
                            <h3 class="media-heading">\
                                @{{ tweet.link.title }}\
                            </h3>\
                            <div>\
                                @{{ tweet.link.description }}\
                            </div>\
                        </div>\
                    </div>\
                </a>\
            </div>\
            <p class="list-group-item-text">@{{ tweet.created_at }}</p>\
        </div>\
      '
    });

    new Vue({
      el: '#list-1',
      data: {
        page: 1,
        items: [],
        busy: false
      },
      methods: {
        loadMore: function() {
            this.busy = true;

            var url = '/timeline' + (this.page > 1 ? '?page=' + this.page : '');

            this.$http.get(url)
            .then(response => {
                var data = response.body;

                // Push the response data into items
                for (var i = 0, j = data.length; i < j; i++) {
                  this.items.push(data[i]);
                }

                // If the response data is empty,
                // disable the infinite-scroll
                this.busy = (j < 1);

                // Increase the page number
                this.page++;
            });
        }
      }
    });
</script>
@endsection
