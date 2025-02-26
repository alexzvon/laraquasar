<script setup>
  import { Link } from '@inertiajs/vue3'

  defineOptions({
    name: "MenuLevel3",
  });

  const props = defineProps({
    categories: Array,
  });
</script>

<template>
  <div class="row justify-start">
    <div class="col-2 text-font-size-small" v-for="category in categories">
      <Link :href="'/category/' + category.slug">
        <q-item clickable v-ripple  class="text-weight-regular">
          <q-item-section avatar>
            <q-icon :name="('img:' + (category.picture_icon ?? '/storage/icons/location_n1.svg'))" />
          </q-item-section>
          <q-item-section>
            {{ category.title }}
          </q-item-section>
        </q-item>
      </Link>
    </div>
  </div>
</template>

<style lang="sass" scoped>
.category-all
  height: calc(100% - 270px)
a
  text-decoration: none
  color: inherit
</style>
