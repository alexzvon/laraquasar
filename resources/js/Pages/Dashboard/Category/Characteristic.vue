<script setup>
  import { useForm } from '@inertiajs/vue3'
  import { ref, onMounted, onUpdated, isProxy } from 'vue'

  defineOptions({
    name: 'Characteristic'
  })

  const props = defineProps({
    characteristics: Array,
    characteristic: Object,
  })

  // console.log(props.characteristics)
  // console.log(props.characteristic)

  const tree = ref()
  const widthSplitter = ref(30)
  const selected = ref(null)

  const form = useForm({
    id: 0,
    sort: 100,
    title: null,
    description: null,
    category_id: null,
    _method: 'POST'
  })

  const onSetNodeToForm = (node) => {
    if (isProxy(node)) {
      form.id = node.id
      form.sort = node.sort
      form.title = node.title
      form.description = node.description
      form.category_id = node.category_id
      form._method = 'POST'
    }
  }

  const onResetForm = () => {
    form.id = null
    form.sort = null
    form.title = null
    form.description = null
    form.category_id = null
    form._method = 'POST'
    selected.value = null
  }

  const onNodeSelected = (nodeId) => {
    onSetNodeToForm(tree.value.getNodeByKey(nodeId))
  }

  onMounted(() => {
    // console.log('onMounted')
    // console.log(props.characteristic)

    tree.value.expandAll()
    if (props.characteristic) {
      selected.value = props.characteristic.id
      onNodeSelected(props.characteristic.id)
    } else {
      onResetForm()
    }
  })

  onUpdated(() => {
    // console.log('onUpdated')
    // console.log(props.characteristic)

    tree.value.expandAll()
    if (props.characteristic) {
      selected.value = props.characteristic.id
      onNodeSelected(props.characteristic.id)
    } else {
      onResetForm()
    }
  })

  const onSave = () => {
    form._method = 'PUT'
    form.post(route('dashboard.category.characteristic.update'),{
      onSuccess: () => {
        console.log('onSuccess')
        
        console.log(props.characteristics)
        console.log(props.characteristic)

        onNodeSelected(props.characteristic)
      }
    })

  }
  
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
      <q-list>
        <q-item>
          <q-item-section>
            <q-input
              filled
              square
              label-color="gries"
              color="gries"
              v-model="form.id"
              label="Id"
              dense
              readonly
              class="q-field--with-bottom"
            />
            <q-input
              filled
              square
              label-color="gries"
              color="gries"
              v-model="form.sort"
              label="Сортировка"
              dense
              class="q-field--with-bottom"
            />
            <q-input
              filled
              square
              label-color="gries"
              color="gries"
              v-model="form.title"
              label="Наименование"
              dense
              class="q-field--with-bottom"
            />
            <q-input
              filled
              square
              label-color="gries"
              color="gries"
              v-model="form.description"
              label="Описание"
              dense
              class="q-field--with-bottom"
            />
          </q-item-section>
          <q-item-section>
            <q-btn label="Сохранить" flat no-caps color="gries" @click.stop.prevent="onSave" />
            <q-btn label="Вернуть" flat no-caps/>
            <q-btn label="Новый" flat no-caps/>
            <q-btn label="Удалить" flat no-caps/>
          </q-item-section>
        </q-item>
      </q-list>
    </template>
  </q-splitter>
</template>

<style lang="sass" scoped>
.q-size-font-tree 
  font-size: small
</style>
