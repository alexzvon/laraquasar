<script setup>
  import { useForm } from '@inertiajs/vue3'
  import { ref } from 'vue'

  defineOptions({
    name: 'Dimension'
  })

  const props = defineProps({
    dimension: Object,
  })

  const urlStore = ref(route('dashboard.dimension.store'))
  const urlUpdate = ref(route('dashboard.dimension.update', { dimension: props.dimension.id }))
  const urlDestroy = ref(route('dashboard.dimension.destroy', { dimension: props.dimension.id }))

  const form = useForm({
    id: props.dimension.id,
    sort: props.dimension.sort,
    title: props.dimension.title,
    _method: 'POST'
  })

  const onSave = () => {
    if (props.dimension.id == 0) {
      form._method = 'POST'
      form.post(urlStore.value, {
        onSuccess: () => onReset()
      })
    } else {
      form._method = 'PUT'
      form.post(urlUpdate.value)
    }
  }

  const onReset = () => {
    form.id = props.dimension.id
    form.sort = props.dimension.sort
    form.title = props.dimension.title
    form._method = 'POST'
  }

  const onDestroy = () => {
    form._method = 'DELETE'
    form.delete(urlDestroy.value)
  }
</script>

<template>
  <q-card class="bg-mutan">
    <q-card-section>
      <q-list>
        <q-item>
          <q-item-section class="col-6 justify-around">
            <q-input 
              filled
              flat
              square
              readonly
              dense
              label-color="gries"
              color="gries"
              v-model="form.id"
              label="Id"
              class="q-error-pt-none"
              :error-message="form.errors.id"
              :error="!!form.errors.id"
              no-error-icon
            />
            <q-input 
              filled
              flat
              square
              dense
              label-color="gries"
              color="gries"
              v-model="form.sort"
              label="Сортировка"
              class="q-error-pt-none"
              :error-message="form.errors.sort"
              :error="!!form.errors.sort"
              no-error-icon
            />
            <q-input
              filled
              flat
              square
              dense
              label-color="gries"
              color="gries"
              v-model="form.title"
              label="Наименование"
              class="q-error-pt-none"
              :error-message="form.errors.title"
              :error="!!form.errors.title"
              no-error-icon
            />
          </q-item-section>
          <q-item-section class="col-3 justify-center">
            <q-btn label="Сохранить" no-caps flat color="gries" @click.prevent.stop="onSave"/>
            <q-btn label="Отменить" no-caps flat color="gries" class="q-ml-sm" @click.prevent.stop="onReset"/>
            <q-btn v-if="form.id != 0" label="Удалить" no-caps flat color="dbrem" class="q-ml-sm" @click.prevent.stop="onDestroy"/>
          </q-item-section>
        </q-item>
      </q-list>
    </q-card-section>
  </q-card>
</template>
