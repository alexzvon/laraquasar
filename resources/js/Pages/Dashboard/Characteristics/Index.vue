<script setup>
  import DashboardLayout from '@/Layouts/DashboardLayout.vue'
  import { useForm, router } from '@inertiajs/vue3'
  import { ref, onMounted } from 'vue'

  defineOptions({
    name: 'Index'
  })

  const props = defineProps({
    'characteristics': Array,
    'characteristic': Object,
    'types': Array,
  })

  // console.log(props.characteristics)
  // console.log(props.characteristic)
  // console.log(props.types)

  const widthSplitter = ref(30)
  const tree = ref(null)
  const filterTree = ref('')
  const selected = ref(null)

  const form = useForm({
    id: 0,
    sort: 100,
    title: '',
    smart: false,
    type: null,
    description: '',
    parent_id: null,
    _method: 'POST'
  })

  const onReset = () => {
    form.id = props.characteristic.id
    form.sort = props.characteristic.sort
    form.title = props.characteristic.title
    form.smart = props.characteristic.smart ?? false
    form.type = props.characteristic.type ?? null
    form.description = props.characteristic.description
    form.parent_id = props.characteristic.parent_id ?? null
    form._method = 'POST'
  }
  
  const onNodeSelected = (nodeId) => {
    router.visit(
      route('dashboard.characteristic.index', { 'characteristic_id': nodeId ?? 0 }),
      { 
        method: 'GET',
        only: [ 'characteristic' ],
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => onReset()
      }
    )
  }

  const onSave = () => {
    if (form.id == 0) {
      form._method = 'POST'
      form.post(route('dashboard.characteristic.create'), {
        only: [ 'errors', 'characteristics', 'characteristic' ],
      })
    } else {
      form._method = 'PUT'
      form.post(route('dashboard.characteristic.update'), {
        only: [ 'errors', 'characteristics', 'characteristic' ],
      })
    }
  }

  const onNewGroup = () => {
    form.id = 0
    form.sort = 100
    form.title = ''
    form.smart = false
    form.type = null
    form.description = ''
    form.parent_id = null
    form._method = 'POST'
  }

  const onNewCharacteristic = () => {
    form.id = 0
    form.sort = 100
    form.title = ''
    form.smart = false
    form.type = null
    form.description = ''
    form.parent_id = props.characteristic.parent_id ?? props.characteristic.id
    form._method = 'POST'
  }

  const onDestroy = () => {
    form._method = 'DELETE'
    form.post(route('dashboard.characteristic.destroy', { characteristic_id: form.id }), {
      only: [ ' errors', 'characteristics', 'characteristic' ],
      onBefore: () => confirm('Внимание!!! после удаления данные не подлежат востановлении, продолжить удаление...'),
    })
  }

  onMounted(() => {
    if (props.characteristic == null) {
      selected.value = 0
    } else {
      selected.value = props.characteristic.id
      onReset()
    }
  })

</script>

<template>
  <dashboard-layout>
    <q-input 
      v-model="filterTree" 
      label="Фильтр" 
      label-color="gries"
      color="gries"
      style="height: 40px;"
      dense
    >
      <template v-slot:append>
        <q-icon v-if="filterTree != ''" name="fa-solid fa-xmark" @click="filterTree = ''" class="cursor-pointer" />
      </template>
    </q-input>
    <q-splitter v-model="widthSplitter" style="height: calc(100vh - 159px)">
      <template v-slot:before>
        <q-tree
          ref="tree"
          icon="fa-solid fa-chevron-right"
          :nodes="characteristics"
          node-key="id"
          label-key="title"
          text-color="tree"
          class="text-font-size-small"
          selected-color="text-gries"
          :filter="filterTree"
          v-model:selected="selected"
          @update:selected="onNodeSelected"
          default-expand-all
        />
      </template>
      <template v-slot:after>
        <q-list>
          <q-item>
            <q-item-section  class="justify-around col-6">
              <q-input
                dense
                filled
                square
                label-color="gries"
                color="gries"
                v-model="form.id"
                label="Id"
                readonly
                class="q-field--with-bottom"
              />
              <q-input
                dense
                filled
                square
                label-color="gries"
                color="gries"
                v-model="form.sort"
                label="Сортировка"
                class="q-field--with-bottom"
              />
              <q-input
                dense
                filled
                square
                label-color="gries"
                color="gries"
                v-model="form.title"
                label="Наименование"
                class="q-field--with-bottom"
              />
              <q-input
                dense
                filled
                square
                label-color="gries"
                color="gries"
                v-model="form.description"
                label="Описание"
                class="q-field--with-bottom q-pb-none"
              />
              <template v-if="form.parent_id != null">
                <q-toggle 
                  v-model="form.smart"
                  color="gries"
                  label="Фильтр"
                />
                <q-select
                  dense
                  filled
                  square
                  label-color="gries"
                  color="gries"
                  :options="types"
                  v-model="form.type"
                  label="Тип характеристики"
                  class="q-field--with-bottom q-pb-none"
                />
              </template>
            </q-item-section>
            <q-item-section class="justify-around offset-1 col-4">
              <q-btn label="Сохранить" flat no-caps @click.stop.prevent="onSave()" />
              <q-btn label="Создать группу" flat no-caps @click.stop.prevent="onNewGroup()" />
              <q-btn label="Создать характеристику" flat no-caps @click.stop.prevent="onNewCharacteristic()" />
              <q-btn label="Отменить" flat no-caps @click.stop.prevent="onReset()" />
              <q-btn label="Удалить" flat no-caps @click.stop.prevent="onDestroy()" />
            </q-item-section>
          </q-item>
        </q-list>
      </template>
    </q-splitter>
  </dashboard-layout>
</template>

