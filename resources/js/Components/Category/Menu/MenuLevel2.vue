<script setup>
  import { Link } from '@inertiajs/vue3' 
  import MenuLevel3 from './MenuLevel3.vue'

  defineOptions({
      name: 'MenuLevel2'
  })

  const props = defineProps({
    categories: Array,
  })
</script>

<template>
  <q-list v-for="category in categories" :key="category.id" dense bordered padding class="rounded-borders no-scroll full-width q-mb-sm">
    <Link :href="'/category/' + category.slug">
      <q-item clickable v-ripple  class="text-weight-bolder">
        <q-item-section avatar>
          <q-icon :name="('img:' + (category.picture_icon ?? '/storage/icons/location_n1.svg'))" />
        </q-item-section>
        <q-item-section>
          {{ category.title }}
        </q-item-section>
      </q-item>
    </Link>  
      <q-item style="height: calc(100% - 20px);">
        <q-item-section>
          <menu-level3 :categories="category.children"/>
        </q-item-section>
      </q-item>
  </q-list>
</template>

<style lang="sass" scoped>
</style>