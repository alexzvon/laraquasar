<script setup>
    import DashboardLayout from '@/Layouts/DashboardLayout.vue'
    // import ItemChapter from '@/Components/Dashboard/Chapter/ItemChapter.vue'
    import SectionChapter from '@/Components/Dashboard/Chapter/SectionChapter.vue'
    import { ref } from 'vue'
    import { usePage, router } from '@inertiajs/vue3'
    import { api } from '../../axios'

    defineOptions({
        name: 'Chapter'
    })

    const props = defineProps({
        'catalog_id': Number,
        'chapters': Array,
    })

    const chapter_new = {
        id: 0,
        catalog_id: props.catalog_id,
        title: null,
        slug: null,
        sort: null,
        image: null,
        icon: null,
    }

    ////////////////////////////////////////////////////////////////////////////////////////
    
    const page = usePage()
    const catalog_id = page.props.catalog_id ?? 0

    const getTitleCatalog = async (id) => {
        if (id) {
            try {
                const { data } = await api({ method: 'POST', url: '/get_title_catalog/' + id })
                modelCatalog.value = [ data ]
            } catch (error) {
                console.log(error)
            }
        }
    }

    getTitleCatalog(catalog_id)

    const options = ref(null)
    const modelCatalog = ref(null)

    const loadOptionsCatalog = async (val, update, abort) => {
        try {
            const { data } = await api({ method: 'POST', url: '/get_list_catalog' })
            update(() => options.value = data)
        } catch (error) {
            console.error(error)
        }
    }

    const updateModelChapter = (val) => {
        let vv = val == null ? 0 : val.value
        router.visit(route('dashboard.chapter.show', { chapter: vv }), { method: 'get'})
    }

    const abortFilterFn = () => false
</script>

<template>
    <DashboardLayout>
        <template v-slot:select>
            <div class="row items-start text-mutan">
                <q-select
                    filled
                    v-model="modelCatalog"
                    use-chips
                    label="Каталог"
                    :options="options"
                    @filter="loadOptionsCatalog"
                    @filter-abort="abortFilterFn"
                    style="width: 350px"
                    dense
                    bg-color="mutan"
                    color="gries"
                    square
                    @update:model-value="updateModelChapter"
                >
                    <template v-slot:no-option>
                        <q-item>
                            <q-item-section class="text-grey">
                                No results
                            </q-item-section>
                        </q-item>
                    </template>
                </q-select>
            </div>
        </template>

        <q-list>
            <q-item v-for="chapter in chapters" :key="chapter.id">
                <q-item-section>
                    <section-chapter
                        :chapter="chapter"
                        :urlUpdate="route('dashboard.chapter.update', { 'chapter': chapter.id })"
                        :urlDelete="route('dashboard.chapter.destroy', { 'chapter': chapter.id })"
                    />
                </q-item-section>
            </q-item>
            <q-item v-if="catalog_id">
                <q-item-section>
                    <section-chapter
                        :chapter="chapter_new"
                        :urlCreate="route('dashboard.chapter.store')"
                    />
                </q-item-section>
            </q-item>
        </q-list>
    </DashboardLayout>
</template>

