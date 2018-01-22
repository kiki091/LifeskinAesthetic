<template>
    <div class="field">
        <label class="">{{ label }}</label>
        <p class="d-inline-block margin-r20" v-for="(obj, index) in choices">
            <input type="radio" class="radio" :id="'radio-' + id + '-' + index" @change="$emit('input', $event.target.value)"  :checked="obj.id==value" :disabled="obj.disabled==1" :name="name" :value="obj.id">
            <label :for="'radio-' + id + '-' + index" v-html="obj.text ? obj.text : obj.name" ></label>
        </p>
    </div>
</template>


<script>
    export default {
        data() {
            return {
            };
        },
        props: ['id', 'name', 'label', 'choices', 'value'],
        mounted() {
            var vm = this
        },
        watch: {
          value: function (value) {
            // update value
            
          },
          choices: function (options) {
            //console.log(options);
          },
        },
        destroyed: function () {
          
        },
        methods: {
            
        },
    }
</script>