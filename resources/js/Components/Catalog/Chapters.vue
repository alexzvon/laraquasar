<script setup>
    import Categories from './Categories.vue';

    defineOptions({
        name: 'Chapters'
    })

    const props = defineProps({
        chapters: Array,
    })

</script>

<template>
    <q-list v-for="chapter in chapters" :key="chapter.id" dense bordered padding class="rounded-borders no-scroll full-width">
        <q-item clickable v-ripple  class="text-weight-bolder">
            <q-item-section>{{ chapter.title }}</q-item-section>
        </q-item>
        <q-item style="height: calc(100% - 20px);">
            <q-item-section>
                <categories :categories="chapter.categories"/>
            </q-item-section>
        </q-item>

  </q-list>
</template>

<style lang="sass" scoped>
.chapter-all
    height: 260px
</style>

