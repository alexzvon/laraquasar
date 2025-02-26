<script setup>
  import DashboardLayout from '@/Layouts/DashboardLayout.vue'
  import Color from './Color.vue'

  defineOptions({
    name: 'Colors'
  })

  const props = defineProps({
    colors: Array
  })

  const thumbStyle = {
        right: '2px',
        borderRadius: '5px',
        backgroundColor: '#027be3',
        width: '5px',
        opacity: '0.75'
      }

  const color_new = {
    id: 0,
    sort: 100,
    title: '',
    picture_image: '',
  }
</script>

<template>
  <dashboard-layout>
    <q-scroll-area :thumb-style="thumbStyle" style="height: calc(100vh - 120px);">
      <q-list style="width: 70%">
        <q-item v-for="color in colors" :keys="color.id">
          <q-item-section>
            <color :color="color" />
          </q-item-section>
        </q-item>
        <q-item>
          <q-item-section>
            <color :color="color_new" />
          </q-item-section>
        </q-item>
      </q-list>
    </q-scroll-area>
  </dashboard-layout>
</template>
