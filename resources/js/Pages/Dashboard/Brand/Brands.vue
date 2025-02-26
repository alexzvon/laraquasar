<script setup>
  import DashboardLayout from '@/Layouts/DashboardLayout.vue'
  import Brand from '@/Components/Dashboard/Brand/Brand.vue'

  defineOptions({
    name: 'Brands'
  })

  const props = defineProps({
    brands: Array
  })

  const brand_new = {
    id: 0,
    title: '',
    slug: '',
    href: '',
    sort: 100,
    count_products: 0,
    picture_image: '',
    description: '',
  }

  const thumbStyle = {
    right: '2px',
    borderRadius: '5px',
    backgroundColor: '#59656F',
    width: '5px',
    opacity: '0.75'
  }

//  console.log(props.brands)
  
</script>

<template>
  <dashboard-layout>
    <q-scroll-area
      :thumb-style="thumbStyle"
      style="height: calc(100vh - 120px);"
    >
      <q-list>
        <q-item v-for="(brand, index) in brands" :key="brand.id">
          <q-item-section>
            <brand :brand="brand" />
          </q-item-section>
        </q-item>
        <q-item>
          <q-item-section>
            <brand :brand="brand_new" />
          </q-item-section>
        </q-item>
      </q-list>
    </q-scroll-area>
  </dashboard-layout>
</template>
