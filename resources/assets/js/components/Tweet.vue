<template>
    <div v-if="tweet.author" class="list-group-item">
        <h4 class="list-group-item-heading">@{{ tweet.author.name }}</h4>
        <p v-if="tweet.link && tweet.link.short_url">@{{ tweet.link.url }}</p>
        <p v-else>@{{ tweet.body }}</p>
        <div class="list-group-item-text panel panel-default" v-if="tweet.link">
            <a v-bind:href="tweet.link.short_url || tweet.link.url" target="_blank" style="text-decoration: none;">
                <div class="media">
                    <div class="media-middle">
                        <img class="media-object center-block" style="max-width: 100%;" v-bind:src="tweet.link.cover">
                    </div>
                    <div class="media-body panel-body">
                        <h3 class="media-heading">
                            @{{ tweet.link.title }}
                        </h3>
                        <div>
                            @{{ tweet.link.description }}
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <p class="list-group-item-text">@{{ tweet.created_at }}</p>
    </div>
</template>

<script>
    export default {
        props: ['tweet']
    }
</script>