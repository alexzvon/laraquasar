<script setup>
  import DashboardLayout from '@/Layouts/DashboardLayout.vue'
  import Characteristic from './Characteristic.vue'
  import { useForm, router } from '@inertiajs/vue3'
  import { onUpdated, ref, toRaw } from 'vue'

  defineOptions({
    name: 'Category'
  })

  const props = defineProps({
    categories: Array,
    category: Object,
    characteristics: Array,
    // characteristic: Object,
  })

  // console.log(props.categories)
  // console.log(props.category)
  // console.log(props.characteristics)
  // console.log(props.characteristic)

  const splitterModel = ref(30)
  const selected = ref(props.category.id)
  const filterTree = ref('')
  const tree = ref()
  const characteristics = ref(toRaw(props.characteristics))

  const form = useForm({
    id: 0,
    sort: 100,
    title: '',
    slug: '',
    picture_image: null,
    picture_icon: null,
    _method: 'POST',
  })

  const onNodeSelected = (nodeId) => {
    router.visit(
      route('dashboard.category.index', 
        { category_id: nodeId ?? 1 }), 
          {
            method: 'get', 
            only: [ 'errors', 'ziggy', 'category', 'characteristics', 'characteristic' ],
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => onReset()
          }
    )
  }

  const onReplay = () => {
    form.id = 0
    form.title = ''
    form.slug = ''
    form.sort = 100
    form.picture_image = null
    form.picture_icon = null
    props.category.picture_image = ''
    props.category.picture_icon = ''
    form._method = 'POST'
    characteristics.value = []
  }

  const onAppend = () => {
    if (form.id == 0) {
      form._method = 'POST'
      form.post(route('dashboard.category.append', { 'category': props.category.id }), 
        {
          onSuccess: () => {
            onReset()
            selected.value = props.category.id
            tree.value.setExpanded(selected.value, true)
          }
        }
      )
    }
  }

  const onCreate = () => {
    if (form.id == 0) {
      form._method = 'POST'
      form.post(route('dashboard.category.create', { 'category': props.category.id }),
        {
          onSuccess: () => {
            onReset()
            selected.value = props.category.id
            tree.value.expandAll(selected.value)
          }
        }
      )
    }
  }

  const onSave = () => {
    if (form.id > 1) {
      form._method = 'PUT'
      form.post(route('dashboard.category.update', { 'category': props.category.id }))
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
    characteristics.value = toRaw(props.characteristics)
  }

  const onDestroy = () => {
    form._method = 'DELETE'
    form.post(route('dashboard.category.destroy', { 'id': props.category.id }), 
      {
        only: [ ' errors', 'categories', 'characteristics' ],
        onBefore: () => confirm('Внимание!!! после удаления данные не подлежат востановлении, продолжить удаление...'),
        onSuccess: () => onReplay(), 
    })
  }

  const onAttach = (characteristic_id) => {
    router.visit(
      route('dashboard.category.attach', { category_id: props.category.id, characteristic_id: characteristic_id }),
      {
        method: 'post',
          only: [ ' errors', 'ziggy', 'category', 'characteristics', 'characteristic' ],
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => onReset()
      }
    )
  }

  const onDetach = (characteristic_id) => {
    router.visit(
      route('dashboard.category.detach', { category_id: props.category.id, characteristic_id: characteristic_id }),
      {
        method: 'post',
          only: [ ' errors', 'ziggy', 'category', 'characteristics', 'characteristic' ],
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => onReset()
      }
    )
  }

  const idImage = 'idImage_' + props.category.id
  const idIcon = 'idIcon_' + props.category.id

  const urlImage = () =>  form.picture_image != null ? URL.createObjectURL(form.picture_image) : props.category.picture_image
  const urlIcon = () =>  form.picture_icon != undefined ? URL.createObjectURL(form.picture_icon) : props.category.picture_icon

  const clickImage = () => document.querySelector('#' + idImage).click()
  const clickIcon = () => document.querySelector('#' + idIcon).click()

  onReset()

  const onProba = (p) => {



  console.log('start proba')
  console.log(p)
  console.log(idImage)


  // selected.value = 1122

  // tree.value.setExpanded(selected.value, true)
  // tree.value.setSelectedNode(selected.value)

  // console.log(router)
  // console.log(form)


        //router.post(urlProba.value, form, { only: [ 'category' ]})

    // form.post(urlProba.value, { only: [ ' errors' ]})


  // form.post(route('dashboard.category.proba', { 'category': 7, 'characteristic': 55 }))

    // form.post(urlProba.value, {
    //   onSuccess: () => {
    //       onReplay()
    //     }, 
    // })


    console.log('end proba')
  }

  onUpdated(() => {
    characteristics.value = toRaw(props.characteristics)
  })

</script>

<template>
  <dashboard-layout>
    <q-input 
      filled
      dense
      v-model="filterTree" 
      label="Категория" 
      label-color="gries"
      color="gries"
      style="height: 40px;"
      class="q-mx-md"
    >
      <template v-slot:append>
        <q-icon v-if="filterTree != ''" name="fa-solid fa-xmark" @click="filterTree = ''" class="cursor-pointer" />
      </template>
    </q-input>
    <q-splitter
      v-model="splitterModel"
      style="height: calc(100vh - 159px)"
      class="q-ml-md"
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
      <template v-slot:separator>
        <q-icon>
          <svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none"  viewBox="0 0 16 16" id="Line-Vertical-Duotone--Streamline-Phosphor" height="16" width="16">
            <desc>Line Vertical Duotone Streamline Icon: https://streamlinehq.com</desc>
            <g id="line-vertical-duotone">
              <path id="Vector" fill="#c4c4c3" d="M14 3v10c0 0.2651875 -0.105375 0.5195625 -0.292875 0.707125 -0.1875625 0.1875 -0.4419375 0.292875 -0.707125 0.292875H3c-0.26521875 0 -0.51956875 -0.105375 -0.70710625 -0.292875C2.10535625 13.5195625 2 13.2651875 2 13V3c0 -0.26521875 0.10535625 -0.51956875 0.29289375 -0.70710625C2.48043125 2.10535625 2.73478125 2 3 2h10c0.2651875 0 0.5195625 0.10535625 0.707125 0.29289375C13.894625 2.48043125 14 2.73478125 14 3Z" stroke-width="0.0625"></path>
              <path id="Vector_2" fill="#000000" d="M8.5 1.5v13c0 0.132625 -0.0526875 0.2598125 -0.1464375 0.3535625S8.132625 15 8 15s-0.2598125 -0.0526875 -0.3535625 -0.1464375S7.5 14.632625 7.5 14.5V1.5c0 -0.13260625 0.0526875 -0.2597875 0.1464375 -0.35355625C7.7401875 1.05268125 7.867375 1 8 1s0.2598125 0.05268125 0.3535625 0.14644375C8.4473125 1.2402125 8.5 1.36739375 8.5 1.5Z" stroke-width="0.0625"></path>
            </g>
          </svg>
        </q-icon>
      </template>
      <template v-slot:after>
          <q-card flat class="slide-card full-height">
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
                      <q-btn label="Новая" @click.stop.prevent="onReplay" color="gries" flat no-caps class="q-ml-sm">
                        <q-tooltip>Новая категория или каталов</q-tooltip>
                      </q-btn>
                      <q-btn label="Удалить" color="dbrem" class="q-ml-sm" @click.stop.prevent="onDestroy" flat no-caps>
                        <q-tooltip>Удалить категорию/каталог</q-tooltip>
                      </q-btn>
                      
                      <q-btn label="Проба" color="dbrem" class="q-ml-sm" @click.stop.prevent="onProba" flat no-caps>
                        <q-tooltip>Проба</q-tooltip>
                      </q-btn>
                      
                    </q-item-section>
                  </q-item>
              </q-list>
            </q-card-section>
            <q-separator />
            <q-card-section class="q-py-none">
              <!-- <characteristic :characteristics="characteristics" :category="category" /> -->
              <characteristic :characteristics="characteristics" :category="category" @attach="onAttach" @detach="onDetach"/>
            </q-card-section>
          </q-card>
      </template>
    </q-splitter>
    <q-inner-loading :showing="form.processing">
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
