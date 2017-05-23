@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Timeline</div>


                <div class="panel-body" id="list-1" v-infinite-scroll="loadMore" infinite-scroll-disabled="busy" infinite-scroll-distance="10">
                    <template v-for="tweet in items">
                        <div class="list-group-item">
                            <h4 class="list-group-item-heading">@{{ tweet.author.name }}</h4>
                            <p>@{{ tweet.body }}</p>
                            <div class="list-group-item-text panel panel-default">
                                <div class="media">
                                    <div class="media-middle">
                                        <img class="media-object center-block" src="https://cdn.boogiecall.com/media/images/872398e3d9598c494a2bed72268bf018_1440575488_7314_s.jpg">
                                    </div>
                                    <div class="media-body panel-body">
                                        <h3 class="media-heading">
                                            Events, parties & live concerts in Melbourne
                                        </h3>
                                        <div>
                                            List of events in Melbourne. Nightlife, best parties and concerts in Melbourne, event listings and reviews.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="list-group-item-text">@{{ tweet.created_at }}</p>
                        </div>
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
