<script setup>
  import { ref, onUpdated } from 'vue'

  defineOptions({
    name: 'Characteristic'
  })

  const props = defineProps({
    characteristics: Array
  })

  const tree = ref()
  const widthSplitter = ref(30)
  const selected = ref(0)

  const onNodeSelected = (nodeId) => console.log(nodeId)

  onUpdated(() => {
    tree.value.expandAll()
  })
  
</script>

<template>
  <q-splitter v-model="widthSplitter" style="height: calc(100vh - 452px)">
    <template v-slot:before>
      <q-tree
        ref="tree"
        icon="fa-solid fa-chevron-right"
        :nodes="characteristics"
        node-key="id"
        label-key="title"
        text-color="tree"
        class="q-size-font-tree"
        selected-color="text-gries"
        v-model:selected="selected"
        @update:selected="onNodeSelected"
        default-expand-all
      />
    </template>
    <template v-slot:after>
      {{ characteristics }}
    </template>
  </q-splitter>
</template>

<style lang="sass" scoped>
.q-size-font-tree 
  font-size: small
</style>
