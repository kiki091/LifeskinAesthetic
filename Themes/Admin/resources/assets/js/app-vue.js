import Ftext from './views/components/text.vue';
import Ftexteditor from './views/components/ckeditor.vue';
import Fselect from './views/components/select.vue';
import Fchosen from './views/components/chosen.vue';
import Fdate from './views/components/datepicker.vue';
import Fcheckbox from './views/components/checkbox.vue';
import Fvcheckbox from './views/components/vcheckbox.vue';
import Fradio from './views/components/radio.vue';
import Fswitch from './views/components/switch.vue';
import Fimage from './views/components/singleimage.vue';
import Fupload from './views/components/file.vue';
import Fselector from './views/components/itemselector.vue';
import Fmultipleimage from './views/components/multipleimage.vue';
import Ftextarea from './views/components/textarea.vue';

window.onload = function () {

    const app = new Vue({
        el: '#mainApp',
        data: {
            objs: {
              xxx: 'nama nya ini loh',
            },
            fillItem : {'title':'','description':'1234567890123456789','id':''},
            fillItemTxtArea : {'title':'','description':'text area','id':''},
            selected: 2,
            options: [
              { id: 1, text: 'Hello' },
              { id: 2, text: 'World' }
            ],
            selecteddate: '08-08-2017',
            selectedtime: '07:00',
            timeoptions: [
              { id: '07:00', text: '07:00' },
              { id: '08:00', text: '08:00' },
              { id: '09:00', text: '09:00' },
              { id: '10:00', text: '10:00' },
              { id: '11:00', text: '11:00' }
            ],
            checkboxchoices: [
              { id: '7', text: '07:00', disabled: 0 },
              { id: '8', text: '08:00', disabled: 0 },
              { id: '9', text: '09:00', disabled: 1 }
            ],
            selectedcheckbox : [ '8', '9'],
            radiochoices: [
              { id: 'R7', text: 'R07:00', disabled: 0 },
              { id: 'R8', text: 'R08:00', disabled: 0 },
              { id: 'R9', text: 'R09:00', disabled: 1 }
            ],
            selectedradio : 'R8',
            vcheckboxchoices: [
                {
                    id : 'h1',
                    text : 'header',
                    data : [
                        { id: '7', text: 'v07:00', disabled: 0 },
                        { id: '8', text: 'v08:00', disabled: 0 },
                        { id: '9', text: 'v09:00', disabled: 1 }
                    ]
                },

               
              
            ],
            vselectedcheckbox : [ '8', '9'],
            switchobject: { id: '1', text: 'Switch', disabled: 0, value: true },
            image : {
                id: '1',
                name: 'Image 1',
                options : {
                    height: '100px',
                    width: '100px'
                },
                image: '',
                image_url: '',
            },
            file: { id: '1', name: '', url: 'url'},
            items: [
                {id: '1', text: 'Ah Yat Abalone Restaurant', disabled: 0},
                {id: '2', text: 'Lawson Minimart', disabled: 0},
            ],
            itemselected: [],

            multipleimage: [
                { id: '1', 'image_desktop': 'https://akcdn.detik.net.id/community/media/visual/2017/06/05/dfd4f2e0-090e-4ee0-9024-05d704b6604f.jpg?w=780&q=90'
                ,'image_mobile': 'https://akcdn.detik.net.id/community/media/visual/2017/06/05/dfd4f2e0-090e-4ee0-9024-05d704b6604f.jpg?w=780&q=90'},
                { id: '2', 'image_desktop': 'https://akcdn.detik.net.id/community/media/visual/2017/06/05/dfd4f2e0-090e-4ee0-9024-05d704b6604f.jpg?w=780&q=90'
                ,'image_mobile': 'https://akcdn.detik.net.id/community/media/visual/2017/06/05/dfd4f2e0-090e-4ee0-9024-05d704b6604f.jpg?w=780&q=90'},
            ]

        },
        components : {
            Ftext, Ftexteditor, Fchosen, Fdate, Fcheckbox, Fradio, Fvcheckbox
            , Fswitch, Fimage, Fupload, Fselector, Fmultipleimage, Ftextarea
        },
        methods: {
            removeImageFromServer: function() {
                return true;
            },
        },
        mounted() {
            
        }
    });


}
