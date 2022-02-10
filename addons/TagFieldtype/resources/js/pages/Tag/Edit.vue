<template>
    <div>
        <portal to="title">
            <page-title :icon="'pencil-alt'">Edit {{ entry.name }}</page-title>
        </portal>

        <!-- <portal to="subtitle">{{ tag.description }}</portal> -->

        <shared-form
            v-if="form"
            :form="form"
            :entry="entry"
            :extension="extension"
           >
        </shared-form>
    </div>
    
</template>

<script>
    import Form from '@/services/Form'
    import SharedForm from './SharedForm'
    //import store from '../../store'

    export default {
        head: {
            title() {
                return {
                    inner: 'Tag'
                }
            }
        },
        
        components: {
            'shared-form': SharedForm
        },

        data() {
            return {
                form: null,
                entry: {},
                extension: {},
                endpoint: '/datatable/tags',
            }
        },

        methods: {
            submit() {
                this.form.patch('/api/tag/' + this.entry.id).then((response) => {
                    toast('Tag saved successfully', 'success')

                    this.$router.push('/tags')
                }).catch((response) => {
                    toast(response.message, 'failed')
                })
            },
        },
        
        beforeRouteEnter(to, from, next) {
            axios.get('/api/tag/' + to.params.id).then((response) => {
                console.log('response', response)
                
                next((vm) => {
                    let extension = response.data.data.extension
                    let entry = response.data.data.entry
                    let fields = {
                        name: entry.name,
                        slug: entry.slug,
                        status: entry.status,
                    }

                    vm.extension = extension
                    vm.entry = entry

                    if (extension.fieldset) {
                        _.forEach(extension.fieldset.sections, function(section) {
                            _.forEach(section.fields, function(field) {
                                fields[field.handle] = entry[field.handle]
                            })
                        })
                    }

                    vm.form = new Form(fields, true)

                    // vm.$emit('updateHead')
                })
            })
        }
    }
</script>
