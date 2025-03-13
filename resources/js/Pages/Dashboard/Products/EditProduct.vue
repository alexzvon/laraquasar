<script setup>
  import { ref, inject } from 'vue'
  import Product from './Product.vue'
  import Images from './Images.vue'
  import Characteristics from './Characteristics.vue'
  import Description from './Description.vue'
  import Price from './Price.vue'

  const isComponent = ref('Product')
  const tagComponent = { Product, Images, Characteristics, Description, Price }

  const emit = defineEmits(['onEditProduct', 'onTableProducts'])

  defineOptions({
    name: 'EditProduct'
  })

  const form = inject('form')
</script>

<template>
  <q-toolbar class="bg-mutan text-gries border-bottom-grey-light-0">
    <q-tabs
      v-model="isComponent"
      dense
      active-color="gries"
    >
      <q-tab no-caps name="Product" label="Товар" />
      <q-tab :disable="!form.id" no-caps name="Images" label="Картинки" />
      <q-tab :disable="!form.id" no-caps name="Characteristics" label="Характеристики" />
      <q-tab :disable="!form.id" no-caps name="Description" label="Описание" />
      <q-tab :disable="!form.id" no-caps name="Price" label="Цены" />
    </q-tabs>
  </q-toolbar>
  <component :is="tagComponent[isComponent]" />
</template>
