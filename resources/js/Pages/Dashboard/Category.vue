<script setup>
    import DashboardLayout from '@/Layouts/DashboardLayout.vue'
    // import ItemCategory from '@/Components/Dashboard/Category/ItemCategory.vue'
    import SectionCategory from '@/Components/Dashboard/Category/SectionCategory.vue'
    import { ref } from 'vue'
    import { usePage, router } from '@inertiajs/vue3'
    import { api } from '../../axios'

    defineOptions({
        name: 'Category'
    })

    const props = defineProps({
        chapter_id: Number,
        categories: Array,
    })

    const category_new = {
        id: 0,
        chapter_id: props.chapter_id,
        title: null,
        slug: null,
        sort: 100,
        image: null,
        icon: null,
    }

    ///////////////////////////////////////////////////////////////

    const page = usePage()
    const chapter_id = page.props.chapter_id ?? 0

    const options = ref(null)
    const modelChapter = ref(null)

    const getTitleChapter = async (id) => {
        if (id) {
            try {
                const { data } = await api({ method: 'POST', url: '/get_title_chapter/' + id })
                modelChapter.value = [ data ]
            } catch (error) {
                console.log(error)
            }
        }
    }

    getTitleChapter(chapter_id)

    const loadOptionsCapter = async (val, update, abort) => {
        try {
            const { data } = await api({ method: 'POST', url: '/get_list_chapter' })
            update(() => options.value = data)
        } catch (error) {
            console.error(error)
        }
    }

    const abortFilterFn = () => false

    const updateModelCategory = (val) => {
        let vv = val == null ? 0 : val.value
        router.visit(route('dashboard.category.show', { category: vv }), { method: 'get'})
    }
</script>

<template>
    <DashboardLayout>
        <template v-slot:select>
            <div class="row items-start text-mutan">
                <q-select
                    filled
                    v-model="modelChapter"
                    use-chips
                    label="Отдел"
                    :options="options"
                    @filter="loadOptionsCapter"
                    @filter-abort="abortFilterFn"
                    style="width: 350px"
                    dense
                    bg-color="mutan"
                    color="gries"
                    square
                    @update:model-value="updateModelCategory"
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
            <q-item v-for="category in categories" :key="category.id">
                <q-item-section>
                    <section-category
                        :category="category"
                        :urlUpdate="route('dashboard.category.update', { 'category': category.id })"
                        :urlDelete="route('dashboard.category.destroy', { 'category': category.id })"
                    />
                </q-item-section>
            </q-item>
            <q-item v-if="chapter_id">
                <q-item-section>
                    <section-category
                        :category="category_new"
                        :urlCreate="route('dashboard.category.store')"
                    />
                </q-item-section>
            </q-item>
        </q-list>
    </DashboardLayout>
</template>
