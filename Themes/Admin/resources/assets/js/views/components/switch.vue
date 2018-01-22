<template>
    <div class="field width-auto">
        <label class="">{{ label }}</label>
        <div class="flex vcenter">
            <div class="flex vcenter margin-r20">
                <label class="switch-line" v-if="type=='line'">
                    <input class="switch-input" :id="'switch-'+id" type="checkbox" :checked="value" :disabled="object.disabled==1" :name="name" :value="object.id" v-on:click="clicked($event)">
                    <span class="switch-label"></span><span class="switch-handle"></span>
                </label>

                <label class="switch" v-else>
                    <input class="switch-input" :id="'switch-'+id" type="checkbox" :checked="value" :disabled="object.disabled==1" :name="name" :value="object.id" v-on:click="clicked($event)">
                    <span class="switch-label"></span><span class="switch-handle"></span>
                </label>
                <small class="margin-x10">{{ object.text }}</small>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                checkedvalue : this.value,
            };
        },
        props: ['id', 'name', 'label', 'object', 'type', 'value'],
        mounted() {
            var vm = this
        },
        watch: {
          value: function (value) {
            // update value
            
          },
        },
        destroyed: function () {
          
        },
        methods: {
            clicked: function(e) {
                var vm = this
                var obj = e.target
                var checked = $(obj).prop("checked")
                if(checked)
                    vm.$emit('input', true)
                else
                    vm.$emit('input', false)
            }
        },
    }
</script>