import Fforgotmodal from './views/components/forgotmodal.vue';
import Fnotifymodal from './views/components/notifymodal.vue';
import Fmessagebox from './views/components/messagebox.vue';


var $form 
var origForm
window.editable_form = false


$(document).on('click', '.close-toggle', function(e){
    $('.open-toggle').removeClass('btn__disable');
    $(this).closest('.card.form').slideUp(400);

    // if(window.editable_form)
    // {
    //   if(confirm('Unsaved data will be lost.\nDo you want to continue ?'))
    //   {
    //     $('.open-toggle').removeClass('btn__disable');
    //     $(this).closest('.card.form').slideUp(400);
    //     window.editable_form = false
    //   }
    //   else
    //   {
    //     e.preventDefault()
    //     e.stopPropagation()
    //   }
    // }
});


$(document).on('change input', 'form', function(){
    //console.log($form.serialize() !== origForm && !window.editable_form)
    /*
    if($form.serialize() !== origForm && !window.editable_form)
       window.editable_form = true
    else if($form.serialize() == origForm)
      window.editable_form = false
    */
});


$(function () {
    //setup ajax error handling
    $.ajaxSetup({
        error: function (x, status, error) {
            if (x.status == 401) {
                alert("Sorry, your session has expired. Please login again to continue");
                window.location.href = "/auth/login";
            }
            else if(x.status == 403)
            {
                alert("Sorry, you are not allowed to access this page");
            }
            else {
                alert("An error occurred: " + status + "nError: " + error);
            }
        }
    });
});


Vue.http.interceptors.push(function (request, next) {
  next(function (response){ 
    if(response.status == 200 && response.data.status && request.method == 'POST')
    {
      /*setTimeout(function(){
        $form = $('div.form').find('form')
        origForm = $form.serialize();
      }, 1000)*/
      //window.editable_form = false
    }
    else if(response.status == 403)
    {
        alert("Sorry, you are not allowed to access this page");
    }
  });
});


// $(document).ajaxSuccess(function(event, xhr, settings) {
//     console.log('in')
//     console.log(xhr)
//     console.log(event)
// });

$(document).ready(function() {    

    Vue.directive("sortable",{
        bind: function(el){
            var _elem = $(el).find('li')
            Sortable.create(el, {
                draggable: '.sort-item',
                ghostClass: "sort-ghost",
                handle: '.handle',
                animation: 300,
                onUpdate: function(evt) {
                    Events.$emit('reorder_sortable', evt.oldIndex, evt.newIndex, _elem);
                },
                onChange: function(evt) {
                    Events.$emit('reorder_sortable', evt.oldIndex, evt.newIndex, _elem);
                }
            });
        }
    })

    window.facileApp = new Vue({
        el: '#headerApp',
        data: {
          showModal: false,
          //CONFIRM MODAL VARS
          showConfirm: false,
          isConfirm: false,
          confirmType: 'delete',
          dataConfirm: {},
          //==================
          showMessage: false,
          showNotification: false,
          label : {
            address: 'Recipient',
            message: 'Message',
          },

          total_message: 0,
          messages: [],
          confirmationFlag: 0,
          selector: [],
        },
        components: {
          Fforgotmodal, Fmessagebox, Fnotifymodal
        },
        computed: {
          showSelectorTitle: function() {
              var url = window.location.href
              var name = ''
              $.each(this.selector, function(index, obj) {
                  if(obj.link==url.replace('#','')) name = obj.name
              });
              return name
          },
        },
        mounted() {
            var parent = $(this.$el).find('.dropdown');
            var vm = this;


            $.each(parent, function(index, el){
              var child = $(el).children('.select--name');

              $(child).on('click', function(event){
                $('.dropdown--wrapper').removeClass('active');
                if($(el).hasClass('menu--message'))
                  vm.loadMessage();
                $(this).parent().toggleClass('active');
                return false;
              });   
            })  

            if(facile.menu != undefined )
            {
                $.each(facile.menu, function (index, obj){
                  if(obj == 'message')
                  {
                      //prepare the message
                      vm.countMessage();
                  }
                  
                  if(obj == 'selector')
                  {
                      vm.loadSelector();    
                  }
                  
                })
            }
        },
        methods: {
          setIsConfirm: function(status) {
            this.isConfirm = status
          },
          showPopup: function(e) {
            this.showModal = true
            // add class di container saat popup
            $(this.$el).addClass('show-popup');
          },
          showConfirmBox: function(type, data) {
            if(type)
              this.confirmType = type

            if(data)
              this.dataConfirm = data

            this.showConfirm = true
            // add class di container saat popup
            $(this.$el).addClass('show-popup');
          },
          closePopup: function() {
            this.showModal = false
            
            // remove class di container saat popup
            setTimeout(function() {
              $(this.$el).removeClass('show-popup');
            }, 300);
            
          },
          loadNotification: function() {
              return {};
          },
          loadSelector: function() {
              var vm = this
              // try {
              //   vm.selector = this.$parent.loadSelector()
                
              // }
              // catch(err) {
              //   // vm.selector = [
              //   //   {'link': '#', 'name': 'Group 1'},
              //   //   {'link': '#', 'name': 'Group 2'},
              //   // ];
              // }


              try {
                vm.selector = window.loadSelector()
              }
              catch(err) {

              }
          },
          countMessage: function() {
              var vm = this;
              var url = laroute.route('facile.message.count', { to : facile.user_email });
              this.$http.get(url).then(function (response) {
                vm.total_message = response.data.data.total;
              }); 
          },
          loadMessage: function() {
              var vm = this;
              var url = laroute.route('facile.message.list', { to : facile.user_email });
              this.$http.get(url).then(function (response) {
                vm.messages = response.data.data;
              }); 
          },


        }
  });
});