<script setup>
    import { useForm } from '@inertiajs/vue3'

    defineOptions({
        name: 'SectionCatalog'
    })

    const props = defineProps({
        catalog: Object,
        urlCreate: String,
        urlUpdate: String,
        urlDelete: String,
    })

    const idImage = 'idImage_' + props.catalog.id
    const idIcon = 'idIcon_' + props.catalog.id

    const form = useForm({
        id: props.catalog.id == 0 ? '' : props.catalog.id,
        sort: props.catalog.sort,
        title: props.catalog.title,
        slug: props.catalog.slug,
        image: null,
        icon: null,
        _method: 'POST',
    })

    const onSubmit = () => {
        if (form.id == 0) {
            form._method = 'POST'
            form.post(props.urlCreate, {
                onFinish: () => onReset()
            })
        } else {
            form._method = 'PUT'
            form.post(props.urlUpdate)
        }
    }

    const onReset = () => {
        form.id = props.catalog.id == 0 ? '' : props.catalog.id
        form.sort = props.catalog.sort
        form.title = props.catalog.title
        form.slug = props.catalog.slug
        form.image = null
        form.icon = null
        form._method = 'POST'
    }

    const onDelete = () => {
        form._method = 'DELETE'
        form.post(props.urlDelete)
    }

    const urlImage = () =>  form.image != undefined ? URL.createObjectURL(form.image) : props.catalog.image
    const urlIcon = () =>  form.icon != undefined ? URL.createObjectURL(form.icon) : props.catalog.icon

    const clickImage = () => document.querySelector('#' + idImage).click()
    const clickIcon = () => document.querySelector('#' + idIcon).click()

</script>

<template>
    <q-form @submit.stop.prevent="onSubmit" @reset="onReset">
        <q-card flat bordered class="slide-card">
            <q-card-section>
                <q-list class="img-width">
                    <q-item class="no-padding">
                        <q-item-section class="col-5">
                            <q-input
                                filled
                                square
                                label-color="gries"
                                color="gries"
                                v-model="form.sort"
                                label="Сортировка"
                                dense
                                class="q-field--with-bottom"
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
                        <q-item-section class="col-2">
                            <q-img
                                :src="urlImage()"
                                loading="eager"
                                height="120px"
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
                                input-style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                                :for="idImage"
                                class="q-error-pt-none full-width"
                                :error-message="form.errors.image"
                                :error="!!form.errors.image"
                                no-error-icon
                            >
                                <q-tooltip>{{ form.image == null ? urlIcon() : form.image.name }}</q-tooltip>
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
                        <q-item-section class="col-2">
                            <q-img
                                :src="urlIcon()"
                                height="120px"
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
                                v-model="form.icon"
                                filled
                                counter
                                input-style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                                :for="idIcon"
                                class="q-error-pt-none full-width"
                                :error-message="form.errors.icon"
                                :error="!!form.errors.icon"
                                no-error-icon
                            >
                                <q-tooltip>{{ form.icon == null ? catalog.icon : form.icon.name }}</q-tooltip>
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
                        <q-item-section class="items-between col-2">
                            <q-btn label="Сохранить" type="submit" color="gries" flat no-caps />
                            <q-btn label="Очистить" type="reset" color="gries" flat no-caps />
                            <q-btn v-if="catalog.id" label="Удалить" no-caps color="dbrem" flat @click.stop.prevent="onDelete" />
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
