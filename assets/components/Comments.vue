<template>
    <div>
        <h3 class="text-2xl">{{ $t('comments') }}</h3>
        <comment-item v-for="(item, key) in comments" :key="key" :comment="item" />

        <comment-form :post-id="postId" />
    </div>
</template>
<script>

import { mapState } from 'vuex';

export default {
    props: ['postId'],
    computed: mapState({
        comments: state => state.comments
    }),
    mounted() {
        this.$store.dispatch('loadComments',{
            postId: this.postId
        });
    }
}
</script>