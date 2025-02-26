<script setup>
    import { toRaw } from 'vue'
    import { useForm } from '@inertiajs/vue3'

    const props = defineProps({
        catalog: Object,
        urlCreate: String,
        urlUpdate: String,
        urlDelete: String,
    })

    const urlCreate = toRaw(props.urlCreate)
    const urlUpdate = toRaw(props.urlUpdate)
    const urlDelete = toRaw(props.urlDelete)

    const catalog = toRaw(props.catalog)

    const idImage = 'idImage_' + catalog.id
    const idIcon = 'idIcon_' + catalog.id

    const form = useForm({
        id: catalog.id,
        title: catalog.title,
        slug: catalog.slug,
        image: null,
        icon: null,
        _method: 'POST',
    })

    const onSubmit = () => {
        if (form.id == 0) {
            form._method = 'POST'
            form.post(urlCreate, {
                onFinish: () => onReset()
            })
        } else {
            form._method = 'PUT'
            form.post(urlUpdate)
        }
    }

    const onReset = () => {
        form.id = catalog.id
        form.title = catalog.title
        form.slug = catalog.slug
        form.image = null
        form.icon = null
        form._method = 'POST'
    }

    const onDelete = () => {
        form._method = 'DELETE'
        form.post(urlDelete)
    }

    const urlImage = () =>  form.image != undefined ? URL.createObjectURL(form.image) : catalog.image
    const urlIcon = () =>  form.icon != undefined ? URL.createObjectURL(form.icon) : catalog.icon

    const clickImage = () => document.querySelector('#' + idImage).click()
    const clickIcon = () => document.querySelector('#' + idIcon).click()
</script>

<template>
    <q-form @submit.stop.prevent="onSubmit" @reset="onReset">
        <q-card flat bordered class="slide-card">
            <q-card-section>
                <q-list class="img-width">
                    <q-item v-if="form.id" class="no-padding">
                        <q-item-section>
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
                        </q-item-section>
                    </q-item>
                    <q-item class="no-padding">
                        <q-item-section>
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
                        </q-item-section>
                    </q-item>
                    <q-item class="no-padding">
                        <q-item-section>
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
                    </q-item>
                    <q-item class="no-padding">
                        <q-item-section>
                            <q-img
                                :src="urlImage()"
                                loading="eager"
                                height="275px"
                                width="100%"
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
                        </q-item-section>
                        <q-item-section>
                            <q-img
                                :src="urlIcon()"
                                height="275px"
                                width="100%"
                                class="slide-img--border cursor-pointer"
                                @click.stop.prevent="clickIcon"
                            />
                            <q-file
                                dense
                                square
                                label="Иконка"
                                label-color="gries"
                                color="gries"
                                v-model="form.icon"
                                filled
                                counter
                                :for="idIcon"
                                class="q-error-pt-none"
                                :error-message="form.errors.icon"
                                :error="!!form.errors.icon"
                                no-error-icon
                            >
                                <template v-slot:append>
                                    <q-icon @click.stop.prevent="form.icon = null" class="cursor-pointer" >
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
                    <q-item>
                        <q-item-section>
                            <q-linear-progress v-if="form.progress" indeterminate />
                            <!--
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                        -->
                        </q-item-section>
                    </q-item>
                    <q-item class="raw">
                        <q-item-section class="offset-2 col-2">
                            <q-btn label="Сохранить" type="submit" color="gries" />
                        </q-item-section>
                        <q-item-section class="offset-1 col-2">
                            <q-btn label="Очистить" type="reset" color="gries" flat class="q-ml-sm" />
                        </q-item-section>
                        <q-item-section class="offset-1 col-2">
                            <q-btn v-if="catalog.id" label="Удалить" color="dbrem" class="q-ml-sm" @click.stop.prevent="onDelete"/>
                        </q-item-section>
                    </q-item>
                </q-list>
            </q-card-section>
        </q-card>
    </q-form>
</template>

<style lang="sass" scoped>
.slide-img--border
    border: 1px solid #ccc
    border-radius: 4px
.slide-card
    width: 100%
    max-width: 1024px
.img-width
    width: 100%
</style>

<style lang="sass">
.q-error-pt-none .q-field__bottom
    padding-top: 0px
</style>

