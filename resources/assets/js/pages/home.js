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