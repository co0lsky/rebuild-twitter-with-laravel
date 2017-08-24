new Vue({
    el: '#app',

    data: {
        username: App.username,
        isFollowing: App.isFollowing,
        followBtnTextArr: ['Follow', 'Unfollow'],
        followBtnText: ''
    },

    methods: {
        follows: function (event) {
            var csrfToken = Laravel.csrfToken;
            var url = this.isFollowing ? '/unfollows' : '/follows';

            this.$http.post(url, {
                'username': this.username
            }, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => {
                var data = response.body;

                if (!data.status) {
                    alert(data.message);
                    return;
                }

                this.toggleFollowBtnText();
            });


        },

        toggleFollowBtnText: function() {
            this.isFollowing = (this.isFollowing + 1) % this.followBtnTextArr.length;
            this.setFollowBtnText();
        },

        setFollowBtnText: function() {
            this.followBtnText = this.followBtnTextArr[this.isFollowing];
        }
    },

    mounted: function() {
        this.setFollowBtnText();
    }
});