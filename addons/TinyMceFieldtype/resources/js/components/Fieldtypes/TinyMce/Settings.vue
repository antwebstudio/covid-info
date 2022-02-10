<template>
    <div>
        <p-input
            name="settings.placeholder"
            label="Placeholder"
            help="Text that will appear inside the WYSIWYG element's content area when empty."
            autocomplete="off"
            v-model="settings.placeholder"
            :has-error="errors.has('settings.placeholder')"
            :error-message="errors.get('settings.placeholder')">
        </p-input>
        
        <p-select label="File Uploader" v-model="settings.uploader" name="settings.uploader" :options="uploaderTypes" />

        <p-select
            name="settings.root_directory"
            label="Root directory"
            help="Select root folder for this field; default root will be used if None selected."
            :options="directories"
            v-model="settings.root_directory"
            :has-error="errors.has('settings.root_directory')"
            :error-message="errors.get('settings.root_directory')">
        </p-select>

        <p-checkbox-group
            label="File type restrictions"
            help="Restrict which file types are selectable for this field; leave blank if no retriction is desired."
            :has-error="errors.has('settings.filetype_restrictions')"
            :error-message="errors.get('settings.filetype_restrictions')">
            <p-checkbox
                v-for="(filetype, index) in filetypes"
                name="settings.filetype_restrictions"
                :id="index"
                :key="index"
                :native-value="index"
                v-model="settings.filetype_restrictions">
                {{ filetype }}
            </p-checkbox>
        </p-checkbox-group>
    </div>
</template>

<script>
	import fieldtype from '@/mixins/fieldtype'

    export default {
        name: 'tinymce-fieldtype-settings',

        mixins: [fieldtype],

        data() {
        	return {
        		filetypes: {
	                image:    'Images',
	                video:    'Videos',
	                audio:    'Audio',
	                document: 'Documents',
	        	},
                uploaderTypes: [
                    {label: 'Filepicker', value: 'filepicker'}, 
                    {label: 'Image Uploader', value: 'image'},
                    {label: 'None', value: 'none'},
                ],
	        	directories: []
	        }
        },
        methods: {
        	recursiveMap(items, n) {
                _.forEach(items, (item) => {
                	this.directories.push({ 'label': _.repeat('- ', n) + item.name, 'value': item.id })

                    this.recursiveMap(item.children, n + 1)
                })
            },

        	fetchDirectoryHierarchy() {
                axios.get('/api/directories?recursive=true').then(({ data }) => {
                	this.directories.push({ 'label': 'Root', 'value': '0' })

                	this.recursiveMap(data.data, 1)
                })
            }
        },

        created() {
        	this.fetchDirectoryHierarchy()
        }
    }
</script>

