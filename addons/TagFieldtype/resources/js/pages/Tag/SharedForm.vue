<template>
<div>
    <form-container>
        <portal to="actions">
            <div class="buttons">
                <router-link v-if="extension.slug" :to="{ name: 'extension.index', params: {extension: extension.slug} }" class="button button--secondary">Go Back</router-link>
                <button type="submit" @click.prevent="$parent.submit" class="button button--primary" :class="{'button--disabled': !form.hasChanges}" :disabled="!form.hasChanges">Save</button>
            </div>
        </portal>

        <div class="card">
            <div class="card__body">
                <p-title
                    name="name"
                    :label="extension.name_label || 'Name'"
                    autocomplete="off"
                    autofocus
                    required
                    :placeholder="extension.name_label || 'Name'" 
                    :has-error="form.errors.has('name')"
                    :error-message="form.errors.get('name')"
                    v-model="form.name"
                    >
                </p-title>

                <p-tabs v-if="sections.body.length > 0">
                    <p-tab v-for="section in sections.body" :key="section.handle" :name="section.name">
                        <component
                            class="form__group"
                            v-for="field in section.fields"
                            :key="field.handle"
                            :is="field.type.id + '-fieldtype'"
                            :field="field"
                            :errors="form.errors"
                            v-model="form[field.handle]">
                        </component>
                    </p-tab>
                </p-tabs>

                <div v-else class="text-center">
                    <p>Things are looking a little empty here!</p>
                    <router-link class="button" :to="'/extensions/' + extension.id + '/edit'">Configure your extension</router-link>
                </div>
            </div>
        </div>

        <template v-slot:sidebar>
            <div class="card">
                <div class="card__body">
                    <p-slug
                        v-if="extension.show_name_field || entry.id"
                        name="slug"
                        label="Slug"
                        monospaced
                        autocomplete="off"
                        required
                        :help="extension.show_name_field ? '' : 'This field is auto-generated based on pattern specified.'"
                        :watch="form.name"
                        :readonly="!extension.show_name_field"
                        :has-error="form.errors.has('slug')"
                        :error-message="form.errors.get('slug')"
                        v-model="form.slug">
                    </p-slug>

                    <!-- <p-toggle
                        name="status"
                        label="Status"
                        v-model="form.status"
                        :true-value="1"
                        :false-value="0">
                    </p-toggle> -->
                </div>
            </div>

            <div class="card" v-for="(section) in sections.sidebar" :key="section.handle">
                <div class="card__header">
                    <h3 class="card__title">{{ section.name }}</h3>
                    <p v-if="section.description" class="card__subtitle">{{ section.description }}</p>
                </div>

                <div class="card__body">
                    <div v-for="field in section.fields">
                        <component
                            v-for="field in section.fields"
                            :key="field.handle"
                            :is="field.type.id + '-fieldtype'"
                            :field="field"
                            :has-error="form.errors.has(field.handle)"
                            :error-message="form.errors.get(field.handle)"
                            v-model="form[field.handle]">
                        </component>
                    </div>
                </div>
            </div>

            <p-definition-list v-if="entry">
                <p-definition name="Status">
                    <fa-icon :icon="['fas', 'circle']" class="fa-fw text-xs" :class="{'text-success-500': entry.status, 'text-danger-500': ! entry.status}"></fa-icon> {{ entry.status ? 'Enabled' : 'Disabled' }}
                </p-definition>

                <p-definition name="Created At">
                    {{ $moment(entry.created_at).format('Y-MM-DD, hh:mm a') }}
                </p-definition>

                <p-definition name="Updated At">
                    {{ $moment(entry.updated_at).format('Y-MM-DD, hh:mm a') }}
                </p-definition>
            </p-definition-list>
        </template>
    </form-container>
    </div>
</template>

<script>
    export default {
        props: {
            entry: {
                required: false
            },

            extension: {
                required: true,
            },

            form: {
                type: Object,
                required: true,
            }
        },
        
        computed: {
            sections() {
                let body = []
                let sidebar = []

                if (this.extension.fieldset) {
                    body = _.filter(this.extension.fieldset.sections, (section) =>
                        section.placement == 'body')

                    sidebar = _.filter(this.extension.fieldset.sections, (section) =>
                        section.placement == 'sidebar')
                }

                return { body, sidebar }
            }
        }
    }
</script>