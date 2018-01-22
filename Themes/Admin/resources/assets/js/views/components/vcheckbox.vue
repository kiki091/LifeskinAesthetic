<template>
    <div class="field">
        <label class="">{{ label }}</label>
        <div class="checkbox__two-layers" v-for="(obj, index) in choices">
            <p class="d-block">
                <input type="checkbox" class="check" :id="'vchk-' + id + '-' + index" v-on:click="clicked($event)">
                <label class="bold" :for="'vchk-' + id + '-' + index" v-html="obj.text ? obj.text : obj.name" ></label>
            </p>
            <p class="d-block" v-for="(object, indexdata) in obj.data">
                <input :name="name" type="checkbox" class="check" :id="'vchkchild-' + id + '-' + indexdata" :checked="inArray(object.id)" :disabled="object.disabled==1" :value="object.id" v-on:click="childClicked($event)">
                <label :for="'vchkchild-' + id + '-' + indexdata" v-html="object.text ? object.text : object.name"></label>
            </p>
        </div>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                checkedvalue : this.value
            };
        },
        props: ['id', 'name', 'label', 'choices', 'value'],
        mounted() {
            var vm = this

            $(this.$el).find("input[id^='vchk']")
                .on('click', function() {
                    
                });

            $(this.$el).find("input[id^='vchkchild']")
                .on('click', function() {
                    

                });
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
                {
                    //vm.value.splice(0, (vm.value).length)
                    $.each(vm.choices[0].data, function(idx, choice)
                    {
                        if(!choice.disabled && vm.value.indexOf(choice.id) == -1)
                            vm.value.push(choice.id)
                    })  
                }
                else
                {
                    $.each(vm.choices[0].data, function(idx, choice)
                    {
                        if(!choice.disabled)
                            vm.value.splice(vm.value.indexOf(choice.id), 1)
                    })
                }   
            },
            childClicked: function(e) {
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