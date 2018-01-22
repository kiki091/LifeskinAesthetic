<div class="main--content" id="template_menu">
	<h3 class="main--content__title">Menu Manager</h3>

	<div class="card form" id="toggle-open-content" style="display: none;">
		<form action="{{ route('facile.menu.store') }}" method="POST" @submit.prevent>
			<div class="form--top flex vcenter between">
	            <h6 class="bold margin0">Add Menu</h6>

	            <a href="javascript:void(0);" class="btn--primary2 close-toggle" id="toggle-menu-manager" data-cancel="Cancel" data-name="Add Menu" @click="changeButton">Close</a>
	        </div>

	        
	        <div class="form--middle">
					<div class="row">
						<ftext type='text' name="name" class="new__form__input__field" placeholder="Enter the menu title here" v-model="models.menu_name" id="menu_title" label="Menu Name"></ftext>
					</div>
					<div class="row">
						<ftext type='text' class="new__form__input__field" v-model="models.function_js" placeholder="Enter function js here" label="Function js"></ftext>
					</div>
					<div class="row">
						<fchosen name="group" id="select" :options="group_manager" v-model="selected" label="Group"></fchosen>
					</div>
					<div class="row">
						<ftext type='text' name="uri" class="new__form__input__field" placeholder="Enter the URL here" v-model="models.uri" label="Url"></ftext>
					</div>
	        </div>
	        <div class="form--bottom flex vcenter right">
				<input type="submit" value="Save and Close" @click="addData" class="btn--primary">
			</div>
		</form>
    </div>

    <div class="card">
        <a href="javascript:void(0);" class="minimize" data-toggle="collapse" data-target="#collapse-1"></a>
        <div class="card__header flex between vend">
            <h6 class="bold">Menu List</h6>
            <a href="javascript:void(0);" class="btn--primary open-toggle" id="toggle-open">Add Content</a>
        </div>
        <div class="card__body collapse in" id="collapse-1">
        	<ul class="media__wrapper margin0 sortable" id="sort" >
				<li class="media sort-item" v-for="obj in data" v-bind:data-id="obj.id">
					<div class="news__list__detail">
						<div class="media__group flex">
                            <div class="media__drag">
                                <div class="handle">@include('svg-logo.handle-drag')</div>
                            </div>
                            <div class="media__text">
                                <a href="#" class="title__name content__edit__hover btn__toggle__edit" @click="editData(obj.id)">@{{ obj.name }}</a>
                                <small class="s10">Group: <b>@{{ obj.group }}</b></small>
                            </div>
                        </div>
					</div>
				</li>
			</ul>
        </div>
    </div>
</div>
