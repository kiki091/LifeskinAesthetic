// SIDEBAR
$(function(){
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.isparent');
		// Evento
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
		$this = $(this),
		$next = $this.next();

		$next.slideToggle();
		$this.parent().toggleClass('open');

		if (!e.data.multiple) {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
		};
	}	

	var accordion = new Accordion($('#sidemenu'), false);

	// active state
	$('.main--menu .menu--link').on('click', function() {
		$('.main--menu .menu--link').removeClass('active');
		$(this).addClass('active');
	});

});

/* ============================= header dropdown user status =================================== */
$(function(){
  var status = new DropDown( $('.dropdown') );
});
function DropDown(el){
	this.user = el;
  this.name = this.user.find('.select--name');
	this.initEvents();
}

DropDown.prototype = {
	initEvents : function(){
		var obj = this;

		obj.name.on('click', function(event){
      $('.dropdown--wrapper').removeClass('active');
			$(this).parent().toggleClass('active');
			return false;
		});
	}
}
// HIDE DROPDOWN 
$(document).on('click', function() {
  $('.dropdown--wrapper').removeClass('active');
  $('.dropdown-check .arrow').attr('checked', false);
});
// PREVENT HIDE DROPDOWN
$(document).on('click', '.message--list', function(e){
  e.preventDefault(); 
  return false;   
});
$(document).on('click', '.dropdown-check', function(e){
  e.stopPropagation();
})
/* ========================================== END ============================================= */

// SLIDE TOGGLE SIDEBAR
$(document).on('click', '.sidebar--toggle', function(){
	$('.main--sidebar').toggleClass('animate');
	$('.main--wrapper').toggleClass('animate');
	$('.sidebar--toggle').toggleClass('animate');
});

// ONSCROLL ACTION
document.addEventListener('scroll', function (event) {
  if (event.target.className === 'main--content') {

    /* HIDE DATEPICKER WHEN CONTAINER SCROLLING */
    $(this).find('.datepick').datepicker('hide');
    $(this).find('.datepick').blur();  
    $(this).find('.datepick-disable-before-today').datepicker('hide');
    $(this).find('.datepick-disable-before-today').blur();    

    // hide dropdown in header
    // $(document).find('.dropdown--wrapper').removeClass('active');
    
  }
}, true /*Capture event*/);


$(document).ready(function(){

  selectorDropdownHeader()
  
	dragOrder()
	uploadFile()
  imageSingleUpload()
  showPreviewImage()

  datePicker()

  showPassword()
  // tokenInput()
  notify()

 //  replaceToCkEditor()
	// replaceToCkEditorWithLimit()
  limitCharacter()

  itemSelector()
  wizardSlide()

  switchCategoryCard()

  // treeTable()

  vueJs()
});


// GLOBAL COLLAPSE
$(document).on('click', '.collapse', function(){
	var id = $(this).data('collapse');

	if($('#'+ id).hasClass('open')){
		$('#'+ id).slideDown(400);
		$('#'+ id).removeClass('open');
	}
	else{
		$('#'+ id).slideUp(400);
		$('#'+ id).addClass('open');
	}
});

// JQUERY CHOSEN
(function($){
  $(document).ready(function(){
    $('.chosen').each(function () {
      var $this = $(this);
      $this.chosen({
        max_selected_options: 4,
        disable_search_threshold: 100
      });
    });

    $('.chosen').on('chosen:showing_dropdown', function(evt, params) {
      $(".chosen-results").mCustomScrollbar({
        axis: "y",
        theme: "dark"
      });
    });

    $('.chosen').on('chosen:hiding_dropdown', function(evt, params) {
      if($(".chosen-results").length) {
        $(".chosen-results").mCustomScrollbar("destroy");
      }
    });
  });

})(jQuery);


$(document).on('click', '.open-toggle', function(){
  var id = $(this).attr('id');
  $('#'+ id + '-content').slideDown(400);
  $('.open-toggle').removeClass('disable');
  $(this).addClass('disable');
  $('.card.form').not($('#'+ id + '-content')).slideUp(400);
});

$(document).on('click', '.close-toggle', function(){
  $('.open-toggle').removeClass('btn__disable');
  $(this).closest('.card.form').slideUp(400);

  // RESET CONDITION 
  
});

// SELECTOR DROPDOWN
function selectorDropdownHeader(){
  $('#selector-dropdown').on('click', function(){
    $(this).toggleClass('open');
  });

  $('#selector-dropdown').focusout(function() {
    // all dropdowns
    $('.dropdown__select__list').removeClass('open');
  });
}

/* ====== SORTABLE DRAG ====== */
function dragOrder(){
	//Make diagnosis table sortable
	$(".sortable").sortable({
		axis: 'y',
        opacity: 0.7,
        handle: '.handle',
        placeholder: 'plcehldr',
        start: function(ev, ui){
          isMoved = false;
          init_X = cX = ev.pageX;
          init_Y = cY = ev.pageY;
          sortingEl = ui.item;
          placeholderEl = ui.placeholder;
          sortingEl.addClass("sort-el").siblings().addClass("sort-items sort-trans");
          sortingItems = $(this).find('.sort-items');
          $(this).addClass("sort-active");
          sort_items_length = sortingItems.length;
          if (!isMoved) {
          minTop = sortingEl[0].offsetTop;
            maxTop = sortingEl.parent().outerHeight() - minTop - sortingEl.outerHeight();
            sortingElHeight = sortingEl.outerHeight()+5; // 3 is[margin(top+bottom)/2]
          }
        },
        sort: function(ev,ui){
          isMoved = true;
          cX = ev.pageX;
          cY = ev.pageY;
          new_Y =  cY - init_Y;

          if (new_Y < -minTop){
            new_Y = -minTop;
          }
          if (new_Y > maxTop){
            new_Y = maxTop;
          }
          sortingEl.css({"transform":"translateY("+new_Y+"px)"});

          sortingItems.each(function () {
            var currentEl = $(this);
            if (currentEl[0] === sortingEl[0]) return;
            var currentElOffset = currentEl[0].offsetTop;
            var currentElHeight = currentEl.outerHeight();
            var sortingElOffset = sortingEl[0].offsetTop + new_Y;

            if ((sortingElOffset >= currentElOffset - currentElHeight / 2) && sortingEl.index() < currentEl.index()) {
              currentEl.css({"transform":"translateY(-"+sortingElHeight+"px)"});
              placeholderEl.insertAfter(currentEl);
            }
            else if ((sortingElOffset <= currentElOffset + currentElHeight / 2) && sortingEl.index() > currentEl.index()) {
            currentEl.css({"transform":"translateY("+sortingElHeight+"px)"});
              placeholderEl.insertBefore(currentEl);
              return false;
            }
            else {
              $(this).css({"transform":"translateY(0px)"});
            }
          });
        },
        stop: function(ev,ui){
          $(this).removeClass("sort-active");
          isMoved = false;
          sortingEl.removeAttr("style").removeClass("sort-el");
          sortingItems.removeClass("sort-trans sort-items").removeAttr("style");
        }
	});
}
/* ====== END SORTABLE DRAG ====== */

/* ====== SIMPLE UPLOAD FILE ====== */
function uploadFile(){
  $(document).on('change', '.upload--file', function () {

    console.log('run');
    var fileName = $(this).val().replace('C:\\fakepath\\', '');

    $(this).parent().find('.upload--placeholder').text(fileName);

  });
}
/* ====== END SIMPLE UPLOAD FILE ====== */

/* ====== CKEDITOR ====== */
function replaceToCkEditor(){
	$(".ckeditor").each(function(){
		CKEDITOR.replace( $(this).attr('id') );	
	});
}
/* ====== END CKEDITOR ====== */

/* ====== CKEDITOR WITH LIMIT ====== */
function unescapeHTML(str) {
    str  = $.trim(str)
    return str.replace(/<[^>]*>|\n/g, '').replace(/\&([^;]+);/g, function (entity, entityCode) {
        
        var match;

        var htmlEntities = {
            nbsp: ' ',
            rsquo: '’',
            cent: '¢',
            pound: '£',
            yen: '¥',
            euro: '€',
            copy: '©',
            reg: '®',
            lt: '<',
            gt: '>',
            quot: '"',
            amp: '&',
            apos: '\''
        };

        if (entityCode in htmlEntities) {
            return htmlEntities[entityCode];
            /*eslint no-cond-assign: 0*/
        } else if (match = entityCode.match(/^#x([\da-fA-F]+)$/)) {
            return String.fromCharCode(parseInt(match[1], 16));
            /*eslint no-cond-assign: 0*/
        } else if (match = entityCode.match(/^#(\d+)$/)) {
            return String.fromCharCode(~~match[1]);
        } else {
            return entity;
        }
    });
};
function replaceToCkEditorWithLimit()
{

    $(".ckeditor-withlimit").each(function(){
        var parent = $(this).parents('.field');
        var child = parent.find('.chars');
        var datachar = $(this).data('length');
        child.text(datachar);
        var editor = CKEDITOR.replace( $(this).attr('id'),{
            extraPlugins: 'wordcount',
            wordcount: {
                maxCharCount: datachar,
                showParagraphs: false,
                showWordCount: true,
                showCharCount: true,
                countSpacesAsChars: true,
                countHTML: false,
            }
        });

        var ascii = new RegExp(/&#39;|&quot;|&amp;|&lt;|&gt;/g);

        var html = new RegExp(/<[^>]*>|\s/g);
        var combine = new RegExp( ascii.source + "|" + html.source );

        // console.log(combine);   

        editor.on('change', function(){
            var maxLength = datachar;
            var data = unescapeHTML(editor.getData());
            var datamax = data.substring(0, datachar);
            var length = data.length;
            var lengths = maxLength-length;
            child.text(lengths);

            if(child.text() <= 0){
                child.css('color', '#DE6061');
                child.text('0');
            }
            else{
                child.css('color', '#505050');   
            }
        });
    });
    setTimeout(function() {
        $('.cke_bottom').css('display', 'none');
    }, 1500);
}
/* ====== END CKEDITOR WITH LIMIT ====== */

/* ====== INPUT TEXT LIMIT ====== */
function limitCharacter(){
    $('.limit-char').keyup(function(){
        var maxLength = $(this).data('length');
        var length = $(this).val().length;
        var length = maxLength-length;
        var output = $(this).parents('.field' ).find('.chars').text(length);
    });
}
/* ====== END INPUT TEXT LIMIT ====== */

/* ====== SHOW PASSWORD ====== */
function showPassword(){
  $("#show-hide-pass").click(function(){
    if ($('#password').attr("type")=="password") {
     $('#password').attr("type", "text");
   }
   else{
     $('#password').attr("type", "password");
   }

 });
}
/* ====== END SHOW PASSWORD ====== */

/* ======= DATE PICKER ====== */
function datePicker(){
  /* DATE PICKER GLOBAL */
  $(document).on('click',".datepick", function(){
    $(this).datepicker({
      language: 'en',
      dateFormat: 'dd-mm-yyyy',
      navTitles: {days: 'MM <i>yyyy</i>'},
      autoClose: true,
      toggleSelected: false,
    });
  });
  $(document).on('click', '.icon-date', function(){
    $(this).parent('.input--date').find('.datepick').datepicker({
      language: 'en',
      dateFormat: 'dd-mm-yyyy',
      navTitles: {days: 'MM <i>yyyy</i>'},
      autoClose: true,
      toggleSelected: false
    }).focus();
  });

  /* DATE PICKER DISABLE BEFORE TODAY*/
  $(document).on('click',".datepick-disable-before-today", function(){
    $(this).datepicker({
      language: 'en',
      dateFormat: 'dd-mm-yyyy',
      navTitles: {days: 'MM <i>yyyy</i>'},
      autoClose: true,
      toggleSelected: false,
      minDate: new Date
    });
  });
  $(document).on('click', '.date-disabled-icon', function(){
    $(this).parent('.input-icon').find('.datepick-disable-before-today').datepicker({
      language: 'en',
      dateFormat: 'dd-mm-yyyy',
      navTitles: {days: 'MM <i>yyyy</i>'},
      autoClose: true,
      toggleSelected: false,
      minDate: new Date
    }).focus();
  });
}
/* ====== END DATE PICKER ======*/

/* ====== IMAGE SINGLE UPLOAD ====== */
function handleFileSelect(event) {
    var input = this;
    // var parent = input.parents('.upload--img');
    console.log(input.files)
    if (input.files && input.files.length) {
        var reader = new FileReader();
        this.enabled = false
        reader.onload = (function (e) {
            input.parents('.upload--img').find('img').attr('src', e.target.result);
            // $("#preview").html(['<img class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span class="remove_img_preview"></span>'].join(''))
        });
        parent.find('label').hide();
        reader.readAsDataURL(input.files[0]);
        parent.find('.remove_img_preview').show();
    }
}
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#upload--img--preview').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}
function imageSingleUpload(){
  $("#input-img-single").change(function () {
    readURL(this);
  });
  // $('#input-img-single').change(handleFileSelect);
  // $('.upload--img').on('click', '.upload--img--remove', function () {
  //   // $("#preview").empty()
  //   $(this).parents('.upload--img').find('input[type="file"]').val("");
  //   $(this).hide();
  //   $(this).parents('.upload--img').find('label').show();
  // });
}
/* ====== END IMAGE SINGLE UPLOAD ======*/

/* ====== ITEM SELECTOR BY CHECKBOX ====== */
function itemSelector(){

      //Helper function to keep table row from collapsing when being sorted
      var fixHelperModified = function(e, li) {
        var $originals = li.children();
        var $helper = li.clone();

        $helper.children().each(function(index)
        {
          $(this).width($originals.eq(index).width())
        });
        return $helper;
      };

      //Make diagnosis table sortable
      $(".item-selected ul").sortable({
        axis: 'y',
        opacity: 0.7,
        handle: '.handle',
        placeholder: 'plcehldr',
        start: function(ev, ui){
          isMoved = false;
          init_X = cX = ev.pageX;
          init_Y = cY = ev.pageY;
          sortingEl = ui.item;
          placeholderEl = ui.placeholder;
          sortingEl.addClass("sort-el").siblings().addClass("sort-items sort-trans");
          sortingItems = $(this).find('.sort-items');
          $(this).addClass("sort-active");
          sort_items_length = sortingItems.length;
          if (!isMoved) {
          minTop = sortingEl[0].offsetTop;
            maxTop = sortingEl.parent().outerHeight() - minTop - sortingEl.outerHeight();
            sortingElHeight = sortingEl.outerHeight()+5; // 3 is[margin(top+bottom)/2]
          }
        },
        sort: function(ev,ui){
          isMoved = true;
          cX = ev.pageX;
          cY = ev.pageY;
          new_Y =  cY - init_Y;

          if (new_Y < -minTop){
            new_Y = -minTop;
          }
          if (new_Y > maxTop){
            new_Y = maxTop;
          }
          sortingEl.css({"transform":"translateY("+new_Y+"px)"});

          sortingItems.each(function () {
            var currentEl = $(this);
            if (currentEl[0] === sortingEl[0]) return;
            var currentElOffset = currentEl[0].offsetTop;
            var currentElHeight = currentEl.outerHeight();
            var sortingElOffset = sortingEl[0].offsetTop + new_Y;

            if ((sortingElOffset >= currentElOffset - currentElHeight / 2) && sortingEl.index() < currentEl.index()) {
              currentEl.css({"transform":"translateY(-"+sortingElHeight+"px)"});
              placeholderEl.insertAfter(currentEl);
            }
            else if ((sortingElOffset <= currentElOffset + currentElHeight / 2) && sortingEl.index() > currentEl.index()) {
            currentEl.css({"transform":"translateY("+sortingElHeight+"px)"});
              placeholderEl.insertBefore(currentEl);
              return false;
            }
            else {
              $(this).css({"transform":"translateY(0px)"});
            }
          });
        },
        stop: function(ev,ui){
          $(this).removeClass("sort-active");
          isMoved = false;
          sortingEl.removeAttr("style").removeClass("sort-el");
          sortingItems.removeClass("sort-trans sort-items").removeAttr("style");
        }
      }).disableSelection();


  var checkedList = $(document).find('.item-selected ul');
  var unCheckedList = $(document).find('.item-list ul');

  $(document).on('change', '.checkbox--item-select .check', function(){
    if (this.checked){
      $(this).closest('li').appendTo(checkedList);
    }
    else if (!this.checked){
      $(this).closest('li').appendTo(unCheckedList);
    }

    var rs = checkedList.find('li').size();
    if (rs>0){
      $(document).find('.item-selected__placeholder').hide();
    }
    else{
      $(document).find('.item-selected__placeholder').show();
    }


    // if(rs>2){
    //   // console.log('lebih dari 3');
    //   unCheckedList.addClass('disabled');      
    // }
    // else{
    //   unCheckedList.removeClass('disabled');
    // }
  });
  // if(checkedList.length==0){
  //  $(document).find('.bg--placeholder').show();
  // }
  // if(checkedList.length>2){
  //   unCheckedList.find('.checkbox--label').addClass('disable'); 
  // }
}
/* ====== END ITEM SELECTOR BY CHECKBOX ====== */

/* ====== VUE JS DUMMY ====== */
function vueJs(){
  // register modal component
  Vue.component('modal', {
    template: '#modal-template'
  })

  // start app
  new Vue({
    el: '#app',
    data: {
      showModal: false
    },
    methods: {
      showPopup: function(e) {
        this.showModal = true
        
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
    }
  })
}
/* ====== END VUE JS DUMMY ====== */

/* ====== WIZARD TAB ====== */
function wizardSlide(){

  $('.wizard--tab ul').append('<li class="slide-line"></li>');

  $(document).on('click', '.wizard--tab li a', function () {
/* slide tab wizard */
    var $this = $(this).parent('li'),
    offset = $this.offset(),
    offsetBody = $('.wizard--tab').offset();

    TweenMax.to($(this).parents('ul').find('.slide-line'), 0.35, {
      css:{
        width: $this.outerWidth()+'px',
        left: (offset.left-offsetBody.left)+'px'
      },
      ease:Power2.easeInOut,

    });

/* tab wizard */
    $(this).parent().addClass("active__tab");
    $(this).parent().siblings().removeClass("active__tab");
    $('.wizard--tab li a').parent().addClass('inactive__tab');

    var tab = $(this).attr("href");
    $('.active__tab').removeClass('inactive__tab');
    $(".content__tab").not(tab).removeClass('active__content');
    $(tab).addClass('active__content');

/* hide next & prev button when on last and first element */
    if($('.firstTab').is(':not(.inactive__tab)')) {
      $(this).parents('.form').find('.prev-button').addClass('disabled');
      $(this).parents('.form').find('.next-button').removeClass('disabled');
    } else if($('.lastTab').is(':not(.inactive__tab)')) {
      $(this).parents('.form').find('.next-button').addClass('disabled');
      $(this).parents('.form').find('.prev-button').removeClass('disabled');
    } else {
      $(this).parents('.form').find('.next-button').removeClass('disabled');
      $(this).parents('.form').find('.prev-button').removeClass('disabled');
    }

    return false;
  });

  setTimeout(function() {
    $('#menu li').first().find('a').trigger('click');
  }, 500);
  
  $(document).on('click', '.next-button', function() {
    $(this).parents('.form').find('.active__tab').next().find('a').trigger("click");
    // $(this).toggle($('.content__tab:last').is(':not(.active__content)'));
  });
  $(document).on('click', '.prev-button', function() {
    $(this).parents('.form').find('.active__tab').prev().find('a').trigger("click");
    // $(this).toggle($('.content__tab:first').is(':not(.active__content)'));
  });
}
/* ====== END WIZARD TAB ====== */

/* ====== BUTTON SHOW PREVIEW MULTIPLE IMAGES ====== */
function showPreviewImage(){
  $(document).on('click', '.preview--show', function(){
    var id = $(this).attr('id');

    // add class di container saat popup
    $('.main--content').addClass('show-popup');
    $('body').addClass('preview');
    $('#'+ id + '-popup').fadeIn(200);
  });
}
/* ====== END BUTTON SHOW PREVIEW MULTIPLE IMAGES ====== */

/* ====== BUTTON CLOSE PREVIEW MULTIPLE IMAGES ====== */
$(document).on('click', '.preview--close', function(){
  $(this).parents('.preview--overlay').fadeOut(200);

  // remove class di container saat close popup
  setTimeout(function() {
   $('.main--content').removeClass('show-popup');
   $('body').removeClass('preview');
  }, 200);
});
/* ====== END BUTTON CLOSE PREVIEW MULTIPLE IMAGES ====== */

function switchCategoryCard(){
  $(document).on('change', '.check-category', function(){
    // console.log('aktif');
    if(this.checked){
      $(this).parents('.media--accordion').find('.media--accordion__body').find('.switch-input').prop('disabled', false);
    }
    else{
      $(this).parents('.media--accordion').find('.media--accordion__body').find('.switch-input').prop('disabled', true);
    }
  });
}

function treeTable(){
  var tableid = $(document).find('.treetable').attr('id');
  $(document).on('click', '.toggle', function () {
    console.log('aktif');
      //Gets all <tr>'s  of greater depth
      //below element in the table
      var findChildren = function (tr) {
        var depth = tr.data('depth');
        return tr.nextUntil($('tr').filter(function () {
          return $(this).data('depth') <= depth;
        }));
      };

      var el = $(this);
      var tr = el.closest('tr'); //Get <tr> parent of toggle button
      var children = findChildren(tr);

      //Remove already collapsed nodes from children so that we don't
      //make them visible. 
      //(Confused? Remove this code and close Item 2, close Item 1 
      //then open Item 1 again, then you will understand)
      var subnodes = children.filter('.expand');
      subnodes.each(function () {
        var subnode = $(this);
        var subnodeChildren = findChildren(subnode);
        children = children.not(subnodeChildren);
      });

      //Change icon and hide/show children
      if (tr.hasClass('notexpand')) {
        tr.removeClass('notexpand').addClass('expand');
        children.hide();
      } else {
        tr.removeClass('expand').addClass('notexpand');
        children.show();
      }
      return children;
    });
}

function tokenInput(){
  $("#message-recipient").tokenInput([{
    "first_name": "Arthur",
    "last_name": "Godfrey",
    "email": "arthur_godfrey@nccu.edu",
    "url": "https://dummyimage.com/25x25/000/fff"
  },
  {
    "first_name": "Adam",
    "last_name": "Johnson",
    "email": "wravo@yahoo.com",
    "url": "https://dummyimage.com/25x25/000/fff"
  },
  {
    "first_name": "Jeff",
    "last_name": "Johnson",
    "email": "bballnine@hotmail.com",
    "url": "https://dummyimage.com/25x25/000/fff"
  },
  {
    "first_name": "Adriana",
    "last_name": "Jameson",
    "email": "adriana.jameson@gmail.com",
    "url": "https://dummyimage.com/25x25/000/fff"
  },
  {
    "first_name": "Adriano",
    "last_name": "Pooley",
    "email": "adrianolpooley@lautau.com.br",
    "url": "https://dummyimage.com/25x25/000/fff"
  },
  {
    "first_name": "Alcir",
    "last_name": "Reis",
    "email": "alcirreis@yahoo.com",
    "url": "https://dummyimage.com/25x25/000/fff"
  },
  {
    "first_name": "Jack",
    "last_name": "Cunningham",
    "email": "jcunningham@hotmail.com",
    "url": "https://dummyimage.com/25x25/000/fff"
  },
  {
    "first_name": "Alejandro",
    "last_name": "Forbes",
    "email": "alejandforbes@gmail.com",
    "url": "https://dummyimage.com/25x25/000/fff"
  },
  {
    "first_name": "Alessandra",
    "last_name": "Mineiro",
    "email": "alc_mineiro@aol.com",
    "url": "https://dummyimage.com/25x25/000/fff"
  },
  {
    "first_name": "Alex",
    "last_name": "Frazo",
    "email": "alex.frazo@yahoo.com",
    "url": "https://dummyimage.com/25x25/000/fff"
  },
  {
    "first_name": "Alexandre",
    "last_name": "Crawford",
    "email": "xandycrawford@gmail.com",
    "url": "https://dummyimage.com/25x25/000/fff"
  },
  {
    "first_name": "Alexandre",
    "last_name": "Lalwani",
    "email": "alexandrelalwani@globo.com",
    "url": "https://dummyimage.com/25x25/000/fff"
  }
  ], {
    propertyToSearch: "first_name",
    preventDuplicates: false,
    animateDropdown: false,
    resultsFormatter: function(item){ return "<li>" + "<img src='" + item.url + "' title='" + item.first_name + " " + item.last_name + "' height='25px' width='25px' />" + "<div style='display: inline-block; padding-left: 10px;'><div class='full_name'>" + item.first_name + " " + item.last_name + "</div><div class='email'>" + item.email + "</div></div></li>" },
    tokenFormatter: function(item) { return "<li><p>" + item.first_name + " " + item.last_name + "</p></li>" }
  });
}


/* NOTIFICATION MESSAGE */
function notify(){

  // ERROR
  $(document).on('click', '.toastr-error', function(){
    $.notify({
      title: 'Few missing contents detected, please complete all the required fields.',
      message: '<li><small>Offers Title.jp is missing</small></li>'
    }, { 
      style: 'error',
      autoHide: false,
      clickToHide: false,
      position: 'bottom left',
      autoHide: true,
      autoHideDelay: 6000
    });
  });
  var img1 = assetBaseUrl + "/images/ico/ico-toastr-error.svg";
  $.notify.addStyle('error', {
    html:
    '<div>' +
      '<div class="toastr">' +
          '<div class="toastr--icon">' +
              '<img src="' + img1 + '" alt="">' +
          '</div>' +
          '<div class="toastr--msg">' +
              '<button class="toastr--close no">&times;</button>' +
              '<p class="toastr--content">' +
                  '<span class="toastr--title">Oops!</span>' +
                  '<span data-notify-html="title"></span>' +
                  '<ul class="toastr--content--ul" data-notify-html="message"></ul>' +
              '</p>' +
          '</div>' +
      '</div>' +
    '</div>'
  });


  // SUCCESS
  $(document).on('click', '.toastr-success', function(){
    $.notify({
      title: 'Your changes has been successfully saved.'
    }, { 
      style: 'success',
      autoHide: false,
      clickToHide: false,
      position: 'bottom left',
      autoHide: true,
      autoHideDelay: 6000
    });
  });
  var img2 = assetBaseUrl + "/images/ico/ico-toastr-success.svg";
  $.notify.addStyle('success', {
    html:
    '<div>' +
      '<div class="toastr">' +
          '<div class="toastr--icon">' +
              '<img src="' + img2 + '" alt="">' +
          '</div>' +
          '<div class="toastr--msg">' +
              '<button class="toastr--close no">&times;</button>' +
              '<p class="toastr--content">' +
                  '<span class="toastr--title">Success!</span>' +
                  '<span data-notify-html="title"></span>' +
              '</p>' +
          '</div>' +
      '</div>' +
    '</div>'
  });


  // INFO
  $(document).on('click', '.toastr-info', function(){
    $.notify({
      title: 'You can change your password on top-right corner.'
    }, { 
      style: 'info',
      autoHide: false,
      clickToHide: false,
      position: 'bottom left',
      autoHide: true,
      autoHideDelay: 6000
    });
  });
  var img3 = assetBaseUrl + "/images/ico/ico-toastr-info.svg";
  $.notify.addStyle('info', {
    html:
    '<div>' +
      '<div class="toastr">' +
          '<div class="toastr--icon">' +
              '<img src="' + img3 + '" alt="">' +
          '</div>' +
          '<div class="toastr--msg">' +
              '<button class="toastr--close no">&times;</button>' +
              '<p class="toastr--content">' +
                  '<span class="toastr--title">Did you know?</span>' +
                  '<span data-notify-html="title"></span>' +
              '</p>' +
          '</div>' +
      '</div>' +
    '</div>'
  });

  $(document).on('click', '.toastr .no', function() {
    $(this).trigger('notify-hide');
  });
}

/* FOCUS FORM TO */
function focusForm(_el){
    if(_el)
        $('.main--content').animate({scrollTop: $(_el).offset().top + 15}, 1500)
    else
        $('.main--content').animate({scrollTop: $('div.form').offset().top + 15}, 1500)
}
//# sourceMappingURL=facile_main.js.map
