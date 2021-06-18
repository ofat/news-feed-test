<template>
    <form class="w-1/3 m-auto" @submit.prevent="submit">
        <div class="mb-3">
            <label for="inputAuthor" class="text-md">Your name:</label>
            <input type="text" id="inputAuthor" v-model="author"
                   class="border rounded-xl p-1 px-2 text-black h-7 w-full block" required>
        </div>

        <div class="mb-3">
            <label for="inputMessage" class="text-md h-9">Message:</label>
            <textarea id="inputMessage" v-model="message"
                      class="border rounded-xl p-1 px-2 text-black h-24 w-full block" required></textarea>
        </div>

        <button type="submit"
                class="font-bold text-white bg-gray-900 p-3 px-5 rounded-xl hover:bg-gray-700">Submit</button>
    </form>
</template>
<script>
export default {
    props: ['postId'],
    data: () => ({
        author: null,
        message: null
    }),
    methods: {
        submit() {
            this.$store.dispatch('addComment', {
                author: this.author,
                message: this.message,
                post_id: this.postId
            }).then(() => {
                this.author = null;
                this.message = null;
                this.$store.dispatch('loadComments', {
                    postId: this.postId
                });
            })
        }
    }
}
</script>