<script setup>
    import { toRaw, ref } from 'vue'
    import { useForm } from '@inertiajs/vue3'

    defineOptions({
        name: 'Slide'
    })

    const props = defineProps({
        slide: Object,
        urlCreate: String,
        urlUpdate: String,
        urlDelete: String,
    })

    const urlCreate = toRaw(props.urlCreate)
    const urlUpdate = toRaw(props.urlUpdate)
    const urlDelete = toRaw(props.urlDelete)

    const slide = toRaw(props.slide)
    const form = useForm({
        id: slide.id,
        name: slide.name,
        href: slide.href,
        picture: null,
        _method: 'POST',
    })

    const idFile = 'idFile_' + toRaw(slide.id)

    const url = () =>  form.picture != undefined ? URL.createObjectURL(form.picture) : slide.picture
    const clickField = () => document.querySelector('#' + idFile).click()

    const onReset = () => {
        form.name = slide.name
        form.href = slide.href
        form.picture = null
        form._method = 'POST'
    }

    const onCreateSlide = () => {
        form._method = 'POST'

        form.post(urlCreate, {
            onFinish: () => {
                onReset()
            }
        })
    }

    const onUpdateSlide = () => {
        form._method = 'PUT'
        form.post(urlUpdate)
    }

    const onSubmit = () => form.id == 0 ? onCreateSlide() : onUpdateSlide()
    const onDelete = () => form.delete(urlDelete)

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
                                v-model="form.name"
                                label="Наименование"
                                dense
                                class="q-error-pt-none"
                                :error-message="form.errors.name"
                                :error="!!form.errors.name"
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
                    <q-item class="no-padding">
                        <q-item-section>
                            <q-img
                                :src="url()"
                                height="275px"
                                width="100%"
                                class="slide-img--border cursor-pointer"
                                @click.stop.prevent="clickField"
                            />
                        </q-item-section>
                    </q-item>
                    <q-item class="no-padding">
                        <q-item-section>
                            <q-file
                                dense
                                square
                                label-color="gries"
                                color="gries"
                                v-model="form.picture"
                                filled
                                counter
                                :for="idFile"
                                class="q-error-pt-none"
                            >
                                <template v-slot:append>
                                    <q-icon @click.stop.prevent="form.picture = null" class="cursor-pointer" >
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
                            <q-btn label="Отменить" type="reset" color="gries" flat class="q-ml-sm" />
                        </q-item-section>
                        <q-item-section class="offset-1 col-2">
                            <q-btn v-if="slide.id" label="Удалить" color="dbrem" class="q-ml-sm" @click.stop.prevent="onDelete"/>
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
.img-width
    width: 100%
.slide-card
    width: 100%
    max-width: 1024px
    background: #f4f3ee
</style>

<style lang="sass">
.q-error-pt-none .q-field__bottom
    padding-top: 0px
</style>
