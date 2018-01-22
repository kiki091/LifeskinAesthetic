<template>
    <div class="field width-auto">
        <label class="">{{ label }}</label>
        <p class="d-inline-block margin-r20 width200" v-for="(obj, index) in choices">
            <input type="checkbox" class="check" :id="'chk-' + id + '-' + index"  :checked="inArray(obj.id)" :disabled="obj.disabled==1" :name="name" :value="obj.id" v-on:click="clicked($event)">
            <label :for="'chk-' + id + '-' + index" v-html="obj.text ? obj.text : obj.name" ></label>
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
            inArray: function (checkVal) {
                return this.value.indexOf(checkVal.toString()) > -1 ? true : false;
            },
            clicked: function(e) {
                var vm = this
                var obj = e.target
                var checked = $(obj).prop("checked")
                if(checked)
                    vm.value.push($(obj).val())
                else{
                    vm.value.splice(vm.value.indexOf($(obj).val()), 1)
                }
            }
        },
    }
</script>