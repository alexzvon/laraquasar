<script setup>
  import { ref } from 'vue'

  defineOptions({
    name: 'Characteristic'
  })

  const props = defineProps({
    characteristics: Array
  })

  const tree = ref()
  const widthSplitter = ref(30)

</script>

<template>
  <q-splitter v-model="widthSplitter" style="height: calc(100vh - 452px)">
    <template v-slot:before>
      <q-scroll-area style="height: calc(100vh - 452px)">
        <q-tree
          dense
          ref="tree"
          icon="fa-solid fa-chevron-right"
          :nodes="characteristics"
          node-key="id"
          label-key="title"
        />
      </q-scroll-area>
    </template>
    <template v-slot:after>
      {{ characteristics }}
    </template>
  </q-splitter>
</template>
