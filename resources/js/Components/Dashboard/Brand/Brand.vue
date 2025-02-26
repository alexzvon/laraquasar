<script setup>
  import { useForm } from '@inertiajs/vue3'
  import { ref } from 'vue'

  defineOptions({
    name: 'Brand'
  })

  const props = defineProps({
    brand: Object
  })

  const urlStore = ref(route('dashboard.brand.store'))
  const urlUpdate = ref(route('dashboard.brand.update', {'brand': props.brand.id}))

  const form = useForm({
    id: props.brand.id,
    title: props.brand.title,
    slug: props.brand.slug,
    href: props.brand.href,
    sort: props.brand.sort,
    count_products: props.brand.count_products,
    picture_image: null,
    description: props.brand.description ?? '',
    _method: 'POST',
  })

  const idFile = 'idFile_' + props.brand.id

  const url = () =>  form.picture_image != null ? URL.createObjectURL(form.picture_image) : props.brand.picture_image
  const clickField = () => document.querySelector('#' + idFile).click()

  const onReset = () => {
    form.id = props.brand.id
    form.title = props.brand.title
    form.slug = props.brand.slug
    form.href = props.brand.href
    form.sort = props.brand.sort
    form.count_products = props.brand.count_products
    form.picture_image = null
    form.description = props.brand.description ?? ''
    form._method = 'POST'
  }
  
  const onSave = () => {
    if (form.id == 0) {
      form.post(urlStore.value, {
        onSuccess: () => onReset()
      })
    } else {
      form._method = 'PUT'
      form.post(urlUpdate.value)
    }
  }

  const onDestroy = () => form.delete(route('dashboard.brand.destroy', { 'brand': form.id }))

</script>

<template>
  <!--<q-form>-->
    <q-card class="bg-mutan">
      <q-card-section>
        <q-list>
          <q-item>
            <q-item-section class="col-3">
              <q-item class="q-py-none q-pl-none">
                <q-item-section>
                  <q-img
                    :src="url()"
                    height="275px"
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
            <q-item-section class="col-9 justify-between q-ml-none">
              <q-input
                filled
                square
                readonly
                label-color="gries"
                color="gries"
                v-model="form.id"
                label="Id"
                dense
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
              <q-input
                filled
                square
                label-color="gries"
                color="gries"
                v-model="form.slug"
                label="Слаг"
                dense
                class="q-error-pt-none"
                :error-message="form.errors.slug"
                :error="!!form.errors.slug"
                no-error-icon
              />
              <q-input
                filled
                square
                label-color="gries"
                color="gries"
                v-model="form.href"
                label="Ссылка"
                dense
                class="q-error-pt-none"
                :error-message="form.errors.href"
                :error="!!form.errors.href"
                no-error-icon
              />
            </q-item-section>
          </q-item>
          <q-item>
            <q-item-section>
              <q-editor v-model="form.description" min-height="12rem" class="bg-mutan" />
            </q-item-section>
          </q-item>
          <q-item>
            <q-item-section class="offset-2 col-2">
              <q-btn label="Сохранить" no-caps color="gries" @click.prevent.stop="onSave"/>
            </q-item-section>
            <q-item-section class="offset-1 col-2">
              <q-btn label="Отменить" no-caps color="gries" flat class="q-ml-sm" @click.prevent.stop="onReset"/>
            </q-item-section>
            <q-item-section class="offset-1 col-2">
              <q-btn v-if="form.id != 0" label="Удалить" no-caps color="dbrem" class="q-ml-sm" @click.prevent.stop="onDestroy"/>
            </q-item-section>
          </q-item>
        </q-list>
      </q-card-section>
    </q-card>
  <!--</q-form>-->
</template>


<style lang="sass">
div.q-ml-none
  margin-left: 0 !important
</style>

