<script setup>
  import { inject } from 'vue'

  defineOptions({
    name: 'Product'
  })

  const { form, updateProduct } = inject('product')

</script>

<template>
  <h1>Product</h1>
  {{ form }}
  <q-list>
    <q-item>
      <q-item-section>
        <q-input
          dense
          label="Id"
          v-model="form.id"
          readonly
        />
        <q-input
          dense
          label="sort"
          v-model="form.sort"
        />
        <q-input
          dense
          label="title"
          v-model="form.title"
        />
      </q-item-section>
      <q-item-section>
        <q-btn flat no-caps label="Сохранить" @click.stop.prevent="updateProduct()" />
      </q-item-section>
    </q-item>
  </q-list>
</template>
