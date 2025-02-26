<script setup>
    import DashboardLayout from '@/Layouts/DashboardLayout.vue'
    // import ItemCatalog from '@/Components/Dashboard/Catalog/ItemCatalog.vue'
    import SectionCatalog from '@/Components/Dashboard/Catalog/SectionCatalog.vue'

    const props = defineProps({
        'catalogs': Array
    })

    const catalog_new = {
        id: 0,
        sort: null,
        title: null,
        slug: null,
        image: null,
        icon: null,
    }
</script>

<template>
    <DashboardLayout>
        <q-list>
            <q-item v-for="catalog in catalogs" :key="catalog.id">
                <q-item-section>
                    <section-catalog
                        :catalog="catalog"
                        :urlUpdate="route('dashboard.catalog.update', { 'catalog': catalog.id })"
                        :urlDelete="route('dashboard.catalog.destroy', { 'catalog': catalog.id })"
                    />
                </q-item-section>
            </q-item>
            <q-item>
                <q-item-section>
                    <section-catalog
                        :catalog="catalog_new"
                        :urlCreate="route('dashboard.catalog.store')"
                    />
                </q-item-section>
            </q-item>
        </q-list>
    </DashboardLayout>
</template>
