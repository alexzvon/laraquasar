<script setup>
  import { useForm } from '@inertiajs/vue3'
  import { ref, onMounted, onUpdated, isProxy } from 'vue'

  defineOptions({
    name: 'Characteristic'
  })

  const props = defineProps({
    characteristics: Array,
    category_characteristic: Array,
  })

  console.log(props.characteristics)
  console.log(props.category_characteristic)

  const tree = ref()
  const widthSplitter = ref(30)
  const selected = ref(null)
  const selectedTable = ref(null)
  const filter = ref(null)

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

  const emit = defineEmits(['proba'])

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
    console.log(selected.value)
  }

  const onEdit = () => {
    console.log('onEdit')
  }
  
  const onDestroy = () => {
    console.log('onDestroy')
  }

  const onProba = () => {
    console.log('onPropba')
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
      <q-table
        flat
        dense
        ref="tableRef"
        :rows="category_characteristic"
        :columns="columns"
        row-key="id"
        rows-per-page-label="Записей на странице"
        selection="single"
        :filter="filter"
        v-model:selected="selectedTable"
        class="text-gries bg-mutan"
        >
            <template v-slot:top-right>
                <q-input borderless dense debounce="300" v-model="filter" placeholder="Поиск">
                    <template v-slot:append>
                        <q-icon name="fa-solid fa-magnifying-glass" />
                    </template>
                </q-input>
            </template>
            <template v-slot:top-left>
                <q-btn flat no-caps label="Добавить" @click.stop.prevent="onAppend" />
                <q-btn flat no-caps label="Изменить" @click.stop.prevent="onEdit"/>
                <q-btn flat no-caps color="dbrem" label="Удалить" @click.stop.prevent="onDestroy" />
                <q-btn flat no-caps label="Проба" @click.stop.prevent="onProba" />
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
