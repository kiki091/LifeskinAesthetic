module.exports = function subscribe() {

    var controller = new Vue({
        el: '#template_subscribe',
        data: {
            pagination: {
              total: 0,
              per_page: 2,
              from: 1,
              to: 0,
              current_page: 1
            },
            offset: 4,
            pageNumberDefault : '1',
            data: [], 
        },
        components: {
            
        },
        computed: {
            isActived: function() {
                return this.pagination.current_page;
            },
            pagesNumber: function() {
              if (!this.pagination.to) {
                return [];
              }
              var from = this.pagination.current_page - this.offset;
              if (from < 1) {
                from = 1;
              }
              var to = from + (this.offset * 2);
              if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
              }
              var pagesArray = [];
              while (from <= to) {
                pagesArray.push(from);
                from++;
              }
              return pagesArray;
            },
        },
        methods: {
            changePage: function(page) {
              this.pagination.current_page = page;
              this.fetchData(page)
            },
            fetchData: function (page) {

                var vm = this
                var domain  = laroute.route('facile.newsletter.getData', []);
                if( typeof page !== 'undefined' ) {
                    domain = domain + "?page=" + page  
                }else{
                    domain = domain + this.pageNumberDefault
                }
                
                this.$http.get(domain).then(function (response) {

                  vm.data = response.data.data.data.paginate.data.data
                  vm.pagination = response.data.data.data.paginate.pagination

                });

                for (var supported_lang in this.supported_language) {
                    this.last_language_key = supported_lang
                }
            },
          
        },

        mounted() {
            this.fetchData(this.pagination.current_page)
        }
    })
}