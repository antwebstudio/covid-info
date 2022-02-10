<template>
  <div>
    <label :for="field.handle" class="form__label">{{ field.name }}</label>
    <div>
      <input v-model="tag" v-on:keyup.enter="addTag" type="text" class="w-100 form-control" :placeholder="placeholder">
      <span @click="removeTag(tag)" v-for="(tag, index) in tags" :key="index" class="badge badge-primary">{{tag}}<i @click="removeTag(index)" class="fa fa-times"></i></span>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      field: {
        type: Object,
        required: true,
      },

      value: {
        required: false,
        default: function() {
            return []
        },
      },
    },

    data(){
      return{
        tag: ''
      }
    },

    computed: {
      placeholder() {
        if (_.isUndefined(this.field.settings) || _.isUndefined(this.field.settings.placeholder)) {
          return 'Type in your tags and hit enter'
        }
        return this.field.settings.placeholder
      },
      tags: {
        get() {
          return this.value.map((tag) => {
            if (typeof(tag) == 'object' || typeof(tag) == 'OBJECT' || typeof(tag) == 'Object') {
              return tag.name;
            }
            return tag;
          }) || []
        },
        set(value) {
          this.$emit('input', value)
        }
      }
    },

    mounted() {
      this.tags = _.map(this.value, 'name') || []
      this.$forceUpdate();
    },

    methods:{
      addTag(){
        this.tags.push(this.tag);
        this.tag = '';
        this.$emit('input', this.tags)
        this.$emit('add-tag', this.tag)
      },

      removeTag(deletedTag){
        _.remove(this.tags, function(tag) {
            return tag == deletedTag;
        });
        this.$forceUpdate();
        this.$emit('input', this.tags)
        this.$emit('remove-tag', deletedTag)
      }
    }
  }
</script>

<style scoped>
  .w-100{
    width: 100%
  }
</style>
