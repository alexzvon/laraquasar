<script setup>
  import { ref, inject, onUpdated } from 'vue'

  defineOptions({
    name: 'TableProducts'
  })

  const emit = defineEmits(['onEditProduct', 'onTableProducts'])
  
  const { category, destroyProduct, reloadProduct } = inject('tableProducts')
  
  const tableRef = ref()
  const selected = ref([])
  const filter = ref('')

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
        label: 'Активность',
        name: 'active',
        field: 'active',
        align: 'center',
        format: val => val ? '☑' : '☐',
        headerStyle: 'font-weight: 505; font-size: 12px;',
        sortable: true,
      },
    {
      label: 'Сортировка',
      name: 'sort',
      field: 'sort',
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
      label: 'Слаг',
      name: 'slug',
      field: 'slug',
      align: 'center',
      headerStyle: 'font-weight: 505; font-size: 12px;',
      sortable: true,
    },
    {
      label: 'Цена',
      name: 'price',
      field: 'price',
      align: 'center',
      headerStyle: 'font-weight: 505; font-size: 12px;',
      sortable: true,
    },
  ];

  const onCreate = () => {
    emit('onEditProduct')
  }

  const onUpdate = () => {
    reloadProduct(false, selected.value[0].id)
  }
  
  const onDelete = () => {
    destroyProduct(selected.value[0].id)
    // console.log('onDelete')
  }


  // const props = defineProps({
  //   modelValue: {
  //     type: Object,
  //     required: true,
  //   },
  // });

  // const emit = defineEmits(['update:modelValue']);
</script>

<template>
  <q-table
    flat
    dense
    ref="tableRef"
    :rows="category.products"
    :columns="columns"
    row-key="id"
    rows-per-page-label="Записей на странице"
    selection="single"
    :filter="filter"
    v-model:selected="selected"
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
      <q-btn flat no-caps :disable="!!selected.length" label="Создать" @click.stop.prevent="onCreate" /> 
      <q-btn flat no-caps :disable="!selected.length" label="Изменить" @click.stop.prevent="onUpdate" /> 
      <q-btn flat no-caps color="dbrem" :disable="!selected.length" label="Удалить" @click.stop.prevent="onDelete"/>
      <!-- <q-btn flat no-caps color="dbrem" label="Удалить" @click.stop.prevent="onDestroy" />
      <q-btn flat no-caps label="Проба" @click.stop.prevent="onProba" /> -->
    </template>
  </q-table>
<!-- {{ selected }} -->

</template>
