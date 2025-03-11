<script setup>
  import { ref, inject, onUpdated } from 'vue'

  defineOptions({
    name: 'TableProducts'
  })

  const emit = defineEmits(['onEditProduct', 'onTableProducts'])
  
  const category = inject('category')

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
  ];

  const onCreate = () => {
    console.log('onCreate')
  }


  const onUpdate = () => {
    console.log('onUpdate')
  }
  
  const onDelete = () => {
    console.log('onDelete')
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
  <h1>Table Products</h1>
  {{ category }} <br />
  <!-- {{ category.products }} -->

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
      <q-btn flat no-caps :disable="!!selected.length" label="Добавить" @click.stop.prevent="emit('onEditProduct')" /> 
      <q-btn flat no-caps :disable="!selected.length" label="Изменить" @click.stop.prevent="emit('onEditProduct')" /> 
      <q-btn flat no-caps :disable="!selected.length" label="Удалить" @click.stop.prevent="onDelete"/>
      <!-- <q-btn flat no-caps color="dbrem" label="Удалить" @click.stop.prevent="onDestroy" />
      <q-btn flat no-caps label="Проба" @click.stop.prevent="onProba" /> -->
    </template>
  </q-table>


</template>
