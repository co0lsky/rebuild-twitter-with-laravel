@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Timeline</div>


                <div class="panel-body" id="list-1" v-infinite-scroll="loadMore" infinite-scroll-disabled="busy" infinite-scroll-distance="10">
                    <a href="#" class="list-group-item" v-for="tweet in items">
                        <h4 class="list-group-item-heading">@{{ tweet.body }}</h4>
                        <p class="list-group-item-text">@{{ tweet.created_at }}</p>
                    </a>
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
