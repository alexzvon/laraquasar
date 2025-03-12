<script setup>
  import { ref } from 'vue'
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
</script>

<template>
  <q-toolbar class="bg-mutan text-gries border-bottom-grey-light-0">
    <q-tabs
      v-model="isComponent"
      dense
      active-color="gries"
    >
      <q-tab no-caps name="Product" label="Товар" />
      <q-tab no-caps name="Images" label="Картинки" />
      <q-tab no-caps name="Characteristics" label="Характеристики" />
      <q-tab no-caps name="Description" label="Описание" />
      <q-tab no-caps name="Price" label="Цены" />
    </q-tabs>
  </q-toolbar>



    <!-- <q-tab name="Product" icon="mail" label="Товар" />
    <q-tab name="Images" icon="alarm" label="Картинки" />
    <q-tab name="Characteristics" icon="movie" label="Характеристики" />
    <q-tab name="Description" icon="photo" label="Описание" />
    <q-tab name="Price" icon="slow_motion_video" label="Цены" /> -->
    <!-- <q-tab name="addressbook" icon="people" label="Address Book" /> -->

  <!-- <q-btn flat no-caps label="Product" @click="isComponent='Product'" />
  <q-btn flat no-caps label="Images" @click="isComponent='Images'" />
  <q-btn flat no-caps label="Characteristics" @click="isComponent='Characteristics'" />
  <q-btn flat no-caps label="Description" @click="isComponent='Description'" />
  <q-btn flat no-caps label="Price" @click="isComponent='Price'" />
 -->
  <component :is="tagComponent[isComponent]" />
</template>
