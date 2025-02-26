<script setup>
    import { ref, toRaw, computed } from "vue";
    import { usePage, Link, router } from '@inertiajs/vue3'

    defineOptions({
        name: "Categories",
    });

    const props = defineProps({
        categories: Array,
    });
</script>

<template>
    <div class="row justify-start">
        <div class="col-2 back_div" v-for="category in categories">
            <Link href="/">{{ category.title }}</Link>
        </div>
    </div>
</template>

<style lang="sass" scoped>
.category-all
    height: calc(100% - 270px)
a
    text-decoration: none
    color: inherit
.back_div
    &:hover
        background-color: #eeeff0
</style>
