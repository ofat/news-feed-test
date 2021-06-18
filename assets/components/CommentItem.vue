<template>
    <div class="border my-4 p-2 rounded-xl">
        <div class="bg-gray-600 text-white p-1 px-4 rounded-xl">
            {{ comment.author }}
            {{ $t("on") }}
            {{ comment.created_at }}
            {{ $t("wrote") }}:
        </div>
        <div class="p-4">{{ comment.message }}</div>
    </div>
</template>
<script>
export default {
    props: ['comment']
}
</script>