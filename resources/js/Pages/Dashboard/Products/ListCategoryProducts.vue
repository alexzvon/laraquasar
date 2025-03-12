<script setup>
  import DashboardLayout from '@/Layouts/DashboardLayout.vue'
  import TableProducts from './TableProducts.vue'
  import EditProduct from './EditProduct.vue'
  import { ref, provide, onUpdated, onMounted } from 'vue'
  import { useForm, router } from '@inertiajs/vue3'

  const props = defineProps({
    categories: Array,
    category: Object,
    product: Object,
  })
 
  const filterTree = ref('')
  const selected = ref(0)
  const widthSplitter = ref(30)
  const isComponent = ref('TableProducts')
  const tagComponetns = { TableProducts, EditProduct }
  const category = ref(props.category)
  
  selected.value = category == 'undefined' ? 0 : category.value.id

  const form = useForm({
    id: 0,
    active: true,
    title: '',
    sort: 100,
    category_id: 0,
    description: '',
    picture_image: [],
    price: 0,
    _method: 'POST'
  })

  const reloadProduct = (state = true, product_id = 0) => {
    router.visit(
      route('dashboard.product.index', { category_id: category.value.id, product_id: product_id }),
      {
        method: 'get',
        only: [ 'error', 'product' ],
        preserveState: state,
        preserveScroll: true,
        onSuccess: () => {
          selected.value = category.value.id
        }
      }
    )
  }

  const storeProduct = () => {
    if (category.value.id > 0) {
      form.category_id = category.value.id
      form._method = 'POST'

      form.post(route('dashboard.product.store'),
        {
         only: [ 'error', 'category', 'product' ],
        }
      )
    } else {
      form._method = 'PUT'
      console.log(form)
    }
  }
  
  const createProduct = () => {
    form.category_id = category.value.id
    form._method = 'POST'

    // form.post(route('dashboard.product.store'),
    //   {
    //     only: [ 'error', 'category', 'product' ],

    //   }
    // )

    // console.log(form)
  }

  // const resetProduct = () => {
  //   router.visit(
  //     route('dashboard.product.index', { category_id: category.value.id, product_id: 0 }),
  //     {
  //       method: 'get',
  //       only: [ 'error' ],
  //       // preserveState: true,
  //       preserveScroll: true,
  //       onSuccess: () => {
  //         form.id = 0
  //         form.active = true
  //         form.sort = 100
  //         form.category_id = category.value.id
  //         form.title = ''
  //         form.description = ''
  //         form.picture_image = []
  //         form.price = 0

  //         selected.value = category.value.id
  //       }
  //     }
  //   )
  // }
  // provide('product', { form, createProduct, resetProduct })

  const onNodeSelected = (nodeId) => {
    router.visit(
      route('dashboard.product.index', { category_id: nodeId ?? 1, product_id: 0 }),
      {
        method: 'get',
        only: [ 'errors', 'category' ],
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => { 
          category.value = props.category
          resetProduct()
          isComponent.value = 'TableProducts'
        }
      }
    )
  }

  const resetProduct = () => {
    form.id = 0
    form.active = true
    form.sort = 100
    form.category_id = category.value.id
    form.title = ''
    form.slug = ''
    form.description = ''
    form.picture_image = []
    form.price = 0
  }

  const rollbackProduct = () => {
    form.id = props.product.id
    form.active = props.product.active
    form.sort = props.product.sort
    form.category_id = category.value.id
    form.title = props.product.title
    form.slug = props.product.slug
    form.description = props.product.description
    form.picture_image = props.product.picture_image
    form.price = props.product.price
  }

  onUpdated(() => {
    // if (props.product) {
    //   rollbackProduct()
    //   isComponent.value = 'EditProduct'
    // } else {
    //   resetProduct()
    //   isComponent.value = 'TableProducts'
    // }

    // console.log('onUpdated')
    // console.log(props.category)
    // console.log(props.product)
  })

  onMounted(() => {
    if (props.product) {
      rollbackProduct()
      isComponent.value = 'EditProduct'
    } else {
      resetProduct()
      isComponent.value = 'TableProducts'
    }

    // console.log('onMounted')
    // console.log(props.category)
    // console.log(props.product)
  })

  provide('tableProducts', { category, reloadProduct })
  provide('storeProduct', { form, storeProduct, reloadProduct })
  


  // console.log(props.category)
</script>

<template>
  <DashboardLayout>
    <q-toolbar class="border-bottom-grey-light-0">
      <q-input 
        v-model="filterTree" 
        label="Категория" 
        label-color="gries"
        color="gries"
        style="height: 40px;"
        dense
      >
        <template v-slot:append>
          <q-icon v-if="filterTree != ''" name="fa-solid fa-xmark" @click="filterTree = ''" class="cursor-pointer" />
        </template>
      </q-input>
      <q-btn flat no-cast label="Table" @click="isComponent='TableProducts'" />
      <q-btn flat no-cast label="Edit" @click="isComponent='EditProduct'" />
    </q-toolbar>
    <q-splitter v-model="widthSplitter" style="height: calc(100vh - 168px)">
      <template v-slot:before>
        <q-tree
          ref="tree"
          icon="fa-solid fa-chevron-right"
          :nodes="categories"
          node-key="id"
          label-key="title"
          text-color="tree"
          class="text-font-size-small"
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
        <!-- <component :is="tagComponetns[isComponent]" v-model="form"/> -->
        <component 
          :is="tagComponetns[isComponent]" 
          @on-edit-product="isComponent='EditProduct'" 
          @on-table-products="isComponent='TableProducts'" 
        />
      </template>
    </q-splitter>
  </DashboardLayout>
</template>
