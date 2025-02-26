<script setup>
  import DashboardLayout from '@/Layouts/DashboardLayout.vue'
  import Dimension from './Dimension.vue'

  defineOptions({
    name: 'Dimentions'
  })

  const props = defineProps({
    dimensions: Array
  })

  const dimension_new = {
    id: 0,
    sort: 100,
    title: '',
  }

  const thumbStyle = {
    right: '2px',
    borderRadius: '5px',
    backgroundColor: '#59656F',
    width: '5px',
    opacity: '0.75'
  }
</script>

<template>
  <dashboard-layout>
    <q-scroll-area 
      :thumb-style="thumbStyle"
      style="height: calc(100vh - 120px);"
    >
      <q-list style="width: 70%">
        <q-item v-for="dimension in dimensions" :key="dimension.id">
          <q-item-section>
            <dimension :dimension="dimension" />
          </q-item-section>
        </q-item>
        <q-item>
          <q-item-section>
            <dimension :dimension="dimension_new" />
          </q-item-section>
        </q-item>
      </q-list>
    </q-scroll-area>
  </dashboard-layout>
</template>
