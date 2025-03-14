<script setup>
  import { inject } from 'vue'

  defineOptions({
    name: 'Images'
  })

  const { form, storeImage, destroyImage } = inject('image')

  const idImage = 'idImage_' + form.id

  const urlImage = () =>  form.image != null ? URL.createObjectURL(form.image) : ''
  const clickImage = () => document.querySelector('#' + idImage).click()

  const onDestroy = (index) => {
    destroyImage(index)
    console.log(index)
  }

</script>

<template>
  <q-list>
    <q-item>
      <q-item-section class="col-9" style="border: 1px solid rgba(0, 0, 0, 0.12);">
        <div class="row content-start">
          <q-img  v-for="(path, index) in form.picture_image" :key="index"
            :src="path"
            loading="eager"
            height="200px"
            width="200px"
            fit="contain"
            class="slide-img--border q-ma-sm"
          > 
            <div style="padding: 5px;" class="absolute-top-right text-dbrem background-none">
              <q-icon name="fa-solid fa-xmark" @click="onDestroy(index)" class="cursor-pointer">
                <q-tooltip class="bg-dbrem" transition-show="rotate" transition-hide="rotate">
                  Удалить
                </q-tooltip>
              </q-icon>
            </div>
          </q-img>
        </div>
      </q-item-section>
      <q-item-section top class="col-3">
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
          v-model="form.image"
          filled
          counter
          :for="idImage"
          class="q-error-pt-none"
          :error-message="form.errors.image"
          :error="!!form.errors.image"
          no-error-icon
        >
          <template v-slot:append>
            <q-icon @click.stop.prevent="form.image = null" class="cursor-pointer" >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                  <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                </svg>
            </q-icon>
          </template>
          <template v-slot:hint>
            Файл
          </template>
        </q-file>
        <q-btn flat no-caps label="Добавить" @click.stop.prevent="storeImage" />
      </q-item-section>
    </q-item>
  </q-list>
</template>

<style lang="sass" scoped>
.slide-img--border
  border: 1px solid #ccc
  border-radius: 0px
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

