+function($) {
	'use strict'

	var tabs 	= '[data-role="tabs-material"]'
	var navTabs = '.nav-tabs'

	var MontaseTabs = function(el) {
    
	}

	MontaseTabs.VERSION = '0.0.1[BETA]'

	MontaseTabs.AUTHOR = 'thofikwiranata15@gmail.com'

	MontaseTabs.prototype.show = function(e) {

	 if(e) e.preventDefault()
	 MontaseTabs.prototype.active(this)
	
  }

	MontaseTabs.prototype.active = function(target) {
		var $this = $(target)
		var $parent = $this.closest(navTabs)
		var $nav = $parent.find('.tabs-material__list')
		var $parentContent = $('.tabs-material-content')//$parent.next()
		var indexListActiveBefore = getIndexListActive()

		$nav.removeClass('active')
		$parentContent
			.find('.tabs-material-item')
			.removeClass('active')

		var $currentList = $this.parent()
		$currentList.addClass('active')

		var space = getSpace()

		MontaseTabs.prototype.animate($parent, $currentList, space)
		MontaseTabs.prototype.setContentActive($this)

		function getSpace() {
			var currentIndex = $nav.index($currentList)
			var space50 = MontaseTabs.prototype.getSpace50($parent)
			var $list = $parent
							.find('.tabs-material__list')
							.eq(indexListActiveBefore)

			var space = sumSpace()
			return space50 + space

			function sumSpace() {
				var totalSpace = 0
				for(var i = 0; i < currentIndex; i++) {
					totalSpace  += $nav.eq(i).outerWidth()
				}

				return totalSpace
			}

		}

		function getIndexListActive() {
			var index = $parent
							.find('.tabs-material__list.active')
							.index()
			return index
		}
	}

	MontaseTabs.prototype.animate = function($parent, $currentList, space) {
		var $line = $parent.find('.tabs-material-line')
		var widthList = getWidth($currentList) 

		$line
			.css({
				transform: 'translate3d(' + space + 'px,0,0)',
				width: widthList
			})

		function getWidth($currentList) {
			return $currentList.width()
		}
	}

	MontaseTabs.prototype.setContentActive = function($target) {
		var contentID = $target.attr('href')
		$(contentID)
				.addClass('active')
				.addClass('is-tiny')
				
		setTimeout(function(){
			$(contentID).removeClass('is-tiny')
		}, 50);
	}

	MontaseTabs.prototype.getSpace50 = function($parent) {
		var haveGutter = $parent.attr('data-tabs-gutter')

		var gutter = haveGutter === undefined ? 0 : haveGutter
		// space => setengah space antara margin tabs dengan parent
		var space = (getParentWidth() - getTabsWidth()) / 2
		return parseInt(space) + parseInt(gutter)

		function getParentWidth() {
			return $parent.outerWidth()
		}

		function getTabsWidth() {
			var $parentTabs = $parent.children('.tabs-material')
			return $parentTabs.outerWidth()
		}
	}

	MontaseTabs.prototype.setupTabsLine = function(parentNav) {
		var $parent = $(parentNav)
		// space50 => setengah space antara margin tabs dengan parent
		var space50 = MontaseTabs.prototype.getSpace50($parent)
		var $line = $parent.find('.tabs-material-line')
		var widthList = getFirstListWidth()
				
		$line
			.css({
				transform: 'translate3d(' + space50 + 'px,0,0)',
				width: widthList
		})

		function getFirstListWidth() { 
			return $parent
					.find('.tabs-material__list')
					.first()
					.width()
		}
	}

	// TABS MATERIAL PLUGIN DEFINITION
	// ========================
	function Plugin(option) {
		return this.each(function () {
			var $this   = $(this)
			var data    = $this.data('mt.montasetabs')
				    
			if (!data) $this.data('mt.montasetabs', (data = new MontaseTabs(this)))
			if (typeof option == 'string') data[option]($this)
		})
	}

	$.fn.montasetabs             = Plugin
	$.fn.montasetabs.Constructor = MontaseTabs

	// TABS MATERIAL DATA-API 
	// ========================
	$(window).on('load', function () {
		$(navTabs).each(function () {
			var $this = $(this)
			MontaseTabs.prototype.setupTabsLine($this)
		})
	})

	$(document).on('click.mt.montasetabs.data-api', tabs, MontaseTabs.prototype.show)
}(jQuery)