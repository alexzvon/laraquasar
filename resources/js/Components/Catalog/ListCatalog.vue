<script setup>
    import { usePage, Link } from '@inertiajs/vue3'
    import { ref, toRaw } from 'vue'
    import Chapters from '@/Components/Catalog/Chapters.vue'

    defineOptions({
        name: 'ListCatalog'
    })

    const catalogs = toRaw(usePage().props.catalogschapterscategory)
    const chapters = ref([])
	const catalogTitle = ref("")

    const loadChapter = (id) => {
		for (let i = 0; i < catalogs.length; i++) {
			if (catalogs[i].id == id) {
                catalogTitle.value = catalogs[i].title
				chapters.value = catalogs[i].chapters

				return
			}
		}
	}
</script>

<template>
    <q-card class="text-gries no-scroll fit bg-none">
        <q-card-actions class="full-height items-start">
            <q-card class="full-height width-catalog no-scroll">
                <q-list dense bordered padding class="full-height rounded-borders scroll">
                    <template v-for="catalog in catalogs" :key="catalog.id">
                        <Link :href="'/catalog/' + catalog.slug">
                            <q-item clickable v-ripple @mouseover="loadChapter(catalog.id)">
                                <q-item-section avatar>
                                    <q-icon :name="('img:' + catalog.picture.icon)" />
                                </q-item-section>
                                <q-item-section>
                                    {{ catalog.title }}
                                </q-item-section>
                            </q-item>
                        </Link>
                    </template>
                </q-list>
            </q-card>
            <q-card v-if="!!chapters.length" class="no-scroll full-height q-ml-md width-chapter">
                <q-toolbar class="text-gries">
                    <q-toolbar-title>
                        {{ catalogTitle }}
                    </q-toolbar-title>
                </q-toolbar>
                <q-card-actions class="items-start content-start scroll" style="height: calc(100% - 41px)">
                    <chapters :chapters="chapters" />
                </q-card-actions>
            </q-card>
        </q-card-actions>
    </q-card>
</template>

<style lang="sass" scoped>
.width-catalog
    width: 250px
//    max-width: 15vw
//    min-width: 250px
.width-chapter
    width: calc(100% - 270px)
//    width: 100%
//    max-width: 85vw
</style>

