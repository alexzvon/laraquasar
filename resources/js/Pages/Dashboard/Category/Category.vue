<script setup>
  import DashboardLayout from '@/Layouts/DashboardLayout.vue'
  import Characteristic from './Characteristic.vue'
  import { useForm, router } from '@inertiajs/vue3'
  import { ref } from 'vue'
  // import { api } from '../../../axios'

  defineOptions({
    name: 'Category'
  })

  const props = defineProps({
    categories: Array,
    characteristics: Array,
    category: Object,
  })

  const visible = ref(false)

  const urlCreate = ref(route('dashboard.category.create', { 'category': props.category.id }))
  const urlAppend = ref(route('dashboard.category.append', { 'category': props.category.id }))
  const urlUpdate = ref(route('dashboard.category.update', { 'category': props.category.id }))
  const urlDelete = ref(route('dashboard.category.destroy', { 'id': props.category.id }))

  const splitterModel = ref(30)
  const selected = ref(props.category.id)
  const filterTree = ref('')
  const tree = ref()
  
  const form = useForm({
    id: 0,
    sort: 100,
    title: '',
    slug: '',
    picture_image: null,
    picture_icon: null,
    _method: 'POST',
  })

  const onNodeSelected = (nodeId) => router.visit(route('dashboard.category.index', { id: nodeId ?? 1 }), { method: 'get'})

  const onReplay = () => {
    form.id = 0
    form.title = ''
    form.slug = ''
    form.sort = 100
    form.picture_image = null
    form.picture_icon = null
    category.value.picture_image = ''
    category.value.picture_icon = ''
    form._method = 'POST'
  }

  const onAppend = () => {
    console.log('onAppend')
    console.log(selected.value)
    console.log(prop.selected)

    if (form.id == 0) {
      visible.value = true
      form._method = 'POST'
      form.post(urlAppend.value, {
        onSuccess: () => {
          onNodeSelected(prop.selected)
          // tree.value.setExpanded(selected.value, true)
          selected.value = prop.selected
        }
      })
      visible.value = false
    }
  }

  const onCreate = () => {
    if (form.id == 0) {
      visible.value = true
      form._method = 'POST'
      form.post(urlCreate.value, {
        onSuccess: () => {
          onNodeSelected(prop.selected)
          tree.value.setExpanded(selected.value, true)
          selected.value = prop.selected
        }, 
        onFinish: () => {
          // console.log('onFinish')
        }
      })

      visible.value = false
    }
  }

  const onSave = () => {
    if (form.id > 1) {
      visible.value = true
      form._method = 'PUT'
      form.post(urlUpdate.value)
      visible.value = false
    }
  }

  const onReset = () => {
    form.id = props.category.id
    form.title = props.category.title
    form.slug = props.category.slug
    form.sort = props.category.sort
    form.picture_image = null
    form.picture_icon = null
    form._method = 'POST'
  }

  const onDestroy = () => {
    visible.value = true
    form._method = 'DELETE'
    form.post(urlDelete.value, {
      onSuccess: () => {
          onReplay()
        }, 
    })
    visible.value = false
  }

  const idImage = 'idImage_' + props.category.id
  const idIcon = 'idIcon_' + props.category.id

  const urlImage = () =>  form.picture_image != null ? URL.createObjectURL(form.picture_image) : props.category.picture_image
  const urlIcon = () =>  form.picture_icon != undefined ? URL.createObjectURL(form.picture_icon) : props.category.picture_icon

  const clickImage = () => document.querySelector('#' + idImage).click()
  const clickIcon = () => document.querySelector('#' + idIcon).click()

  onReset()
</script>

<template>
  <dashboard-layout>
    <q-input 
      v-model="filterTree" 
      label="Фильтр" 
      label-color="gries"
      color="gries"
      style="height: 40px;"
      dense
    >
      <template v-slot:append>
        <q-icon v-if="filterTree != ''" name="fa-solid fa-xmark" @click="filterTree = ''" class="cursor-pointer" />
      </template>
    </q-input>
    <q-splitter
      v-model="splitterModel"
      style="height: calc(100vh - 120px)"
    >
      <template v-slot:before>
        <q-tree
          ref="tree"
          icon="fa-solid fa-chevron-right"
          :nodes="categories"
          node-key="id"
          label-key="title"
          text-color="tree"
          class="q-size-font-tree"
          selected-color="text-gries"
          :filter="filterTree"
          v-model:selected="selected"
          @update:selected="onNodeSelected"
          default-expand-all
        />
      </template>
      <template v-slot:after>
          <q-card flat class="slide-card">
            <q-card-section style="height: 292px;">
                <q-list class="img-width">
                  <q-item class="no-padding">
                    <q-item-section class="justify-around">
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
                    </q-item-section>
                    <q-item-section class="col-3">
                      <q-img
                        :src="urlImage()"
                        loading="eager"
                        height="200px"
                        width="100%"
                        fit="contain"
                        class="slide-img--border cursor-pointer"
                        @click.stop.prevent="clickImage"
                      />
                      <q-file
                        dense
                        square
                        label="Картинка"
                        label-color="gries"
                        color="gries"
                        v-model="form.picture_image"
                        filled
                        counter
                        :for="idImage"
                        class="q-error-pt-none"
                        :error-message="form.errors.picture_image"
                        :error="!!form.errors.picture_image"
                        no-error-icon
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
                    <q-item-section class="col-3">
                      <q-img
                        :src="urlIcon()"
                        height="200px"
                        width="100%"
                        fit="contain"
                        class="slide-img--border cursor-pointer"
                        @click.stop.prevent="clickIcon"
                      />
                      <q-file
                        dense
                        square
                        label="Иконка"
                        label-color="gries"
                        color="gries"
                        v-model="form.picture_icon"
                        filled
                        counter
                        :for="idIcon"
                        class="q-error-pt-none"
                        :error-message="form.errors.picture_icon"
                        :error="!!form.errors.picture_icon"
                        no-error-icon
                      >
                          <template v-slot:append>
                              <q-icon @click.stop.prevent="form.picture_icon = null" class="cursor-pointer" >
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
                    <q-item-section class="items-between col-2">
                      <q-btn label="Сохранить" @click.stop.prevent="onSave" color="gries" flat no-caps>
                        <q-tooltip>Сохранить выбранную категорию</q-tooltip>
                      </q-btn>
                      <q-btn label="Добавить" color="gries" class="q-ml-sm" @click.stop.prevent="onAppend" flat no-caps>
                        <q-tooltip>Добавить категорию в текущий каталог</q-tooltip>
                      </q-btn>
                      <q-btn label="Создать" color="gries" class="q-ml-sm" @click.stop.prevent="onCreate" flat no-caps>
                        <q-tooltip>Создать новый каталог категорий</q-tooltip>
                      </q-btn>
                      <q-btn label="Отменить" @click.stop.prevent="onReset" color="gries" flat no-caps class="q-ml-sm">
                        <q-tooltip>Отменить все изменения категории</q-tooltip>
                      </q-btn>
                      <q-btn label="Очистить" @click.stop.prevent="onReplay" color="gries" flat no-caps class="q-ml-sm">
                        <q-tooltip>Очистить категорию</q-tooltip>
                      </q-btn>
                      <q-btn label="Удалить" color="dbrem" class="q-ml-sm" @click.stop.prevent="onDestroy" flat no-caps>
                        <q-tooltip>Удалить категорию/каталог</q-tooltip>
                      </q-btn>
                    </q-item-section>
                  </q-item>
              </q-list>
            </q-card-section>
            <!-- <q-separator dark inset /> -->
            <q-separator />
            <q-card-section class="q-pt-none">
              <characteristic :characteristics="characteristics" />
              <!-- {{ simple }} -->
            </q-card-section>
          </q-card>
      </template>
    </q-splitter>
    <q-inner-loading :showing="visible">
      <q-spinner-gears size="50px" color="gries" />
    </q-inner-loading>
  </dashboard-layout>
</template>

<style lang="sass" scoped>
.slide-img--border
  border: 1px solid #ccc
  border-radius: 4px
.slide-card
  width: 100%
  background: none
  border-bottom: 1px solid #D6D5D1
  border-radius: inherit
    // max-width: 1024px
.img-width
  width: 100%
.q-size-font-tree 
  font-size: small
</style>

<style lang="sass">
.q-error-pt-none .q-field__bottom
    padding-top: 0px
.q-tree__arrow
  font-size: 12px
  margin-right: 4px
</style>
