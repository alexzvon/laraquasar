<script setup>
  import { inject } from 'vue'

  defineOptions({
    name: 'Product'
  })

  const { form, storeProduct, reloadProduct } = inject('storeProduct')

</script>

<template>
  <div class="row justify-center q-ma-lg">
    <q-list class="product-card" bordered separator>
      <q-item>
        <q-item-section>
          <q-input
            dense
            filled
            square
            label-color="gries"
            color="gries"
            label="Id"
            v-model="form.id"
            :error-message="form.errors.id"
            :error="!!form.errors.id"
            readonly
            class="q-mb-md"
          />
          <q-toggle 
            label-color="gries"
            color="gries"
            v-model="form.active"
            label="Активный"
            class="q-mb-md"
          />
          <q-input
            filled
            square
            label-color="gries"
            color="gries"
            dense
            label="sort"
            v-model="form.sort"
            :error-message="form.errors.sort"
            :error="!!form.errors.sort"
            class="q-mb-md"
          />
          <q-input
            filled
            square
            label-color="gries"
            color="gries"
            dense
            label="Наименование"
            v-model="form.title"
            :error-message="form.errors.title"
            :error="!!form.errors.title"
            class="q-mb-md"
          />
          <q-input
            filled
            square
            label-color="gries"
            color="gries"
            dense
            label="Слаг"
            v-model="form.slug"
            :error-message="form.errors.slug"
            :error="!!form.errors.slug"
            class="q-mb-md"
          />
        </q-item-section>
      </q-item>
      <q-item>
        <q-item-section>
          <q-btn flat no-caps label="Сохранить" @click.stop.prevent="storeProduct" />
        </q-item-section>
        <q-item-section>
          <q-btn flat no-caps label="Отменить" @click.stop.prevent="reloadProduct(false)" />
        </q-item-section>
      </q-item>
    </q-list>
  </div>
</template>

<style lang="sass" scoped>
.product-card
  width: 100%
  max-width: 550px
</style>
