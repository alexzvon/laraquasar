<script setup>
  import { useForm } from '@inertiajs/vue3'

  defineOptions({
    name: 'Color'
  })

  const props = defineProps({
    color: Object
  })

  const idFile = 'idFile_' + props.color.id

  const urlStore = route('dashboard.color.store')
  const urlUpdate = route('dashboard.color.update', { 'color': props.color.id })
  const urlDestroy = route('dashboard.color.destroy', { 'color': props.color.id })

  const form = useForm({
    id: props.color.id,
    sort: props.color.sort,
    title: props.color.title,
    picture_image: null,
    // created_at: props.color.created_at,
    // updated_at: props.color.updated_at,
    _method: 'POST',
  })

  const url = () => form.picture_image != null ? URL.createObjectURL(form.picture_image) : props.color.picture_image
  const clickField = () => document.querySelector('#' + idFile).click()

  const onSave = () => {
    if (props.color.id == 0) {
      form._method = 'POST'
      form.post(urlStore, {
        onSuccess: () => onReset()
      })
    } else {
      form._method = 'PUT'
      form.post(urlUpdate, {
        onSuccess: () => onReset()
      })
    }



  }

  const onReset = () => {
    form.id = props.color.id
    form.sort = props.color.sort
    form.title = props.color.title,
    form.picture_image = null,
    form._method = 'POST'
  }

  const onDestroy = () => {
    form._method = 'DELETE'
    form.delete(urlDestroy)
  }

</script>

<template>
  <q-form>
  <q-card class="bg-mutan">
    <q-card-section>
      <q-list>
        <q-item>
          <q-item-section class="col-3">
            <q-item>
              <q-item-section>
                <q-item class="q-py-none q-pl-none">
                  <q-item-section>
                    <q-img
                      :src="url()"
                      height="206px"
                      width="100%"
                      class="border-ccc-4 cursor-pointer"
                      @click.stop.prevent="clickField"
                    />
                  </q-item-section>
                </q-item>
                <q-item class="q-py-none q-pl-none">
                  <q-item-section>
                    <q-file
                      dense
                      square
                      label-color="gries"
                      color="gries"
                      v-model="form.picture_image"
                      filled
                      counter
                      :for="idFile"
                      class="q-error-pt-none"
                    >
                      <template v-slot:append>
                        <q-icon @click.stop.prevent="form.picture_image = null" class="cursor-pointer" >
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                          </svg>
                        </q-icon>
                      </template>
                      <template v-slot:hint>
                        Файл
                      </template>
                    </q-file>
                  </q-item-section>
                </q-item>
              </q-item-section>
            </q-item>
          </q-item-section>
          <q-item-section class="col-6 justify-around q-ml-none">
            <q-input
              filled
              square
              dense
              readonly
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
              square
              label-color="gries"
              color="gries"
              v-model="form.sort"
              label="Сортировка"
              dense
              class="q-error-pt-none"
              :error-message="form.errors.sort"
              :error="!!form.errors.sort"
              no-error-icon
            />

            <q-input
                filled
                square
                label-color="gries"
                color="gries"
                v-model="form.title"
                label="Наименование"
                dense
                class="q-error-pt-none"
                :error-message="form.errors.title"
                :error="!!form.errors.title"
                no-error-icon
              />



<!--              
            <q-input
              filled
              square
              label-color="gries"
              color="gries"
              v-model="form.title"
              label="Наименование"
              dense
              class="q-error-pt-none"
              :error-message="form.errors.title"
              :error="!!form.errors.title"
              no-error-icon
            />


            <q-input
              filled
              square
              dense
              readonly
              label-color="gries"
              color="gries"
              v-model="color.created_at"
              label="Создан"
            />
            <q-input
              filled
              square
              dense
              readonly
              label-color="gries"
              color="gries"
              v-model="color.updated_at"
              label="Изменен"
            />
-->
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
  </q-form>
</template>
