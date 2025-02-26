<script setup>
  import { usePage, Link } from '@inertiajs/vue3'
  import { ref, toRaw } from 'vue'
  import MenuLevel2 from './MenuLevel2.vue'

  defineOptions({
    name: 'MenuLevel1'
  })

  const categories = toRaw(usePage().props.categories)[0].children
  const categoryTitle = ref("")
  const children = ref([])

  const loadChildren = (id) => {
		for (let i = 0; i < categories.length; i++) {
			if (categories[i].id == id) {
        categoryTitle.value = categories[i].title
				children.value = categories[i].children
				return
			}
		}
	}
</script>

<template>
  <q-card class="text-gries no-scroll fit bg-none">
    <q-card-actions class="full-height items-start">
      <q-card class="full-height width-category-1 no-scroll">
        <q-list dense bordered padding class="full-height rounded-borders scroll text-font-size-small">

            <template v-for="category in categories" :key="category.id">
              <Link :href="'/category/' + category.slug">
                <q-item clickable v-ripple @mouseover="loadChildren(category.id)">
                  <q-item-section avatar>
                    <q-icon :name="('img:' + (category.picture_icon ?? '/storage/icons/location_n1.svg'))" />
                  </q-item-section>
                  <q-item-section>
                    {{ category.title }}
                  </q-item-section>
                </q-item>
              </Link>
            </template>

        </q-list>
      </q-card>
      <q-card v-if="!!children.length" class="no-scroll full-height q-ml-md width-category-2">
        <q-toolbar class="text-gries">
          <q-toolbar-title>
            {{ categoryTitle }}
          </q-toolbar-title>
        </q-toolbar>
        <q-card-actions class="items-start content-start scroll" style="height: calc(100% - 41px)">
          <menu-level2 :categories="children" />
        </q-card-actions>
      </q-card>
    </q-card-actions>
  </q-card>
</template>

<style lang="sass" scoped>
.width-category-1
  width: 250px
.width-category-2
  width: calc(100% - 270px)
</style>
