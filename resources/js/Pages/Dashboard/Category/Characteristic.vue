<script setup>
  import { useForm, router } from '@inertiajs/vue3'
  import { ref, onMounted, onUpdated, isProxy } from 'vue'

  defineOptions({
    name: 'Characteristic'
  })

  const props = defineProps({
    characteristics: Array,
    category: Object,
  })

  // console.log(props.characteristics)
  // console.log(props.category)
  // console.log(props.category.characteristics)

  const tree = ref()
  const widthSplitter = ref(30)
  const selected = ref(null)
  const selectedTable = ref([])
  const filter = ref(null)
  const filterTree = ref('')

  const form = useForm({
    id: 0,
    sort: 100,
    title: null,
    description: null,
    category_id: null,
    _method: 'POST'
  })

  const columns = [
        {
          label: 'Id',
          name: 'id',
          field: 'id',
          align: 'center',
          headerStyle: 'font-weight: 505; font-size: 12px;',
          sortable: true,
        },
        {
          label: 'Наименование',
          name: 'title',
          field: 'title',
          align: 'center',
          headerStyle: 'font-weight: 505; font-size: 12px;',
          sortable: true,
        },
        {
          label: 'Фильтр',
          name: 'smart',
          field: 'smart',
          align: 'center',
          format: val => val ? '☑' : '☐',
          headerStyle: 'font-weight: 505; font-size: 12px;',
          sortable: true,
        },



        // {
        //     label: 'Почта',
        //     name: 'email',
        //     field: 'email',
        //     align: 'center',
        //     headerStyle: 'font-weight: 505; font-size: 12px;',
        //     sortable: true,
        // },
        // {
        //     label: 'Проверка',
        //     name: 'email_verified_at',
        //     field: 'email_verified_at',
        //     align: 'center',
        //     headerStyle: 'font-weight: 505; font-size: 12px;',
        //     sortable: true,
        // },
        // {
        //     label: 'Создан',
        //     name: 'createdAt',
        //     field: 'created_at',
        //     align: 'center',
        //     headerStyle: 'font-weight: 505; font-size: 12px;',
        //     sortable: true,
        // },
        // {
        //     label: 'Изменен',
        //     name: 'updateAt',
        //     field: 'updated_at',
        //     align: 'center',
        //     headerStyle: 'font-weight: 505; font-size: 12px;',
        //     sortable: true,
        // },
    ]

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

  // const onSelectRows = () => {
  //   for (let i = 0; i < props.category_characteristic.length; i++) {
  //     for (let j = 0; j < props.)
  //   }
  // }

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

  const emit = defineEmits([ 'attach', 'detach' ])

  const onSave = () => {

    console.log(props.proba)

    props.proba('probaprobaproba')

    emit('proba', 'emitemitemit')


    // form._method = 'PUT'
    // form.post(route('dashboard.category.characteristic.update'),{
    //   onSuccess: () => {
    //     console.log('onSuccess')
        
    //     console.log(props.characteristics)
    //     console.log(props.characteristic)

    //     onNodeSelected(props.characteristic)
    //   }
    // })

  }

  const onAppend = () => {
    emit('attach', selected.value)
  }

  const onDelete = () => {
    emit('detach', selectedTable.value[0].id)
    selectedTable.value = []
  }

  const onDblClick = (evt, row, index) => {
    router.get(route('dashboard.characteristic.index', { 'characteristic_id': row.id }))
  }
 
  const onDestroy = () => {
    console.log('onDestroy')
  }

  const onProba = () => {
    console.log('onPropba')
  }
  
</script>

<template>
      <q-input 
      filled
      dense
      v-model="filterTree" 
      label="Характеристика" 
      label-color="gries"
      color="gries"
      style="height: 40px;"
    >
      <template v-slot:append>
        <q-icon v-if="filterTree != ''" name="fa-solid fa-xmark" @click="filterTree = ''" class="cursor-pointer" />
      </template>
    </q-input>
  <q-splitter v-model="widthSplitter" style="height: calc(100vh - 492px)">
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
        :filter="filterTree"
        v-model:selected="selected"
        @update:selected="onNodeSelected"
        default-expand-all
      />
    </template>
    <template v-slot:separator>
      <q-icon>
        <svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none"  viewBox="0 0 16 16" id="Line-Vertical-Duotone--Streamline-Phosphor" height="16" width="16">
          <desc>Line Vertical Duotone Streamline Icon: https://streamlinehq.com</desc>
          <g id="line-vertical-duotone">
            <path id="Vector" fill="#c4c4c3" d="M14 3v10c0 0.2651875 -0.105375 0.5195625 -0.292875 0.707125 -0.1875625 0.1875 -0.4419375 0.292875 -0.707125 0.292875H3c-0.26521875 0 -0.51956875 -0.105375 -0.70710625 -0.292875C2.10535625 13.5195625 2 13.2651875 2 13V3c0 -0.26521875 0.10535625 -0.51956875 0.29289375 -0.70710625C2.48043125 2.10535625 2.73478125 2 3 2h10c0.2651875 0 0.5195625 0.10535625 0.707125 0.29289375C13.894625 2.48043125 14 2.73478125 14 3Z" stroke-width="0.0625"></path>
            <path id="Vector_2" fill="#000000" d="M8.5 1.5v13c0 0.132625 -0.0526875 0.2598125 -0.1464375 0.3535625S8.132625 15 8 15s-0.2598125 -0.0526875 -0.3535625 -0.1464375S7.5 14.632625 7.5 14.5V1.5c0 -0.13260625 0.0526875 -0.2597875 0.1464375 -0.35355625C7.7401875 1.05268125 7.867375 1 8 1s0.2598125 0.05268125 0.3535625 0.14644375C8.4473125 1.2402125 8.5 1.36739375 8.5 1.5Z" stroke-width="0.0625"></path>
          </g>
        </svg>
      </q-icon>
    </template>
    <template v-slot:after>
      <q-table
        flat
        dense
        ref="tableRef"
        :rows="category.characteristics"
        :columns="columns"
        row-key="id"
        rows-per-page-label="Записей на странице"
        selection="single"
        :filter="filter"
        v-model:selected="selectedTable"
        @row-dblclick="onDblClick"
        class="text-gries bg-mutan q-ml-md"
      >
        <template v-slot:top-right>
          <q-input borderless dense debounce="300" v-model="filter" placeholder="Поиск">
            <template v-slot:append>
              <q-icon name="fa-solid fa-magnifying-glass" />
            </template>
          </q-input>
        </template>
        <template v-slot:top-left>
          <q-btn flat no-caps :disable="!selected" label="Добавить" @click.stop.prevent="onAppend" /> 
          <q-btn flat no-caps :disable="!selectedTable.length" label="Удалить" @click.stop.prevent="onDelete"/>
          <!-- <q-btn flat no-caps color="dbrem" label="Удалить" @click.stop.prevent="onDestroy" />
          <q-btn flat no-caps label="Проба" @click.stop.prevent="onProba" /> -->
        </template>
      </q-table>

      {{ selected }}


      <!-- <q-list>
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
      </q-list> -->




    </template>
  </q-splitter>
</template>

<style lang="sass" scoped>
.q-size-font-tree 
  font-size: small
</style>
