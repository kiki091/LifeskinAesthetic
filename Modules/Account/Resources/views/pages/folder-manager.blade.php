<div id="template_folder">
	<div class="filter__wrapper">
		<div class="filter__content">
			<div class="filter__content__title">
				<h1>Folder Manager</h1>		
				<div class="breadcrumb">
					<a href="#" class="breadcrumb--a"><p class="breadcrumb--p">Accounts</p></a>
				</div>
			</div>
		</div>
	</div>
	<div class="main__content">

        <modal :show.sync="showModal">
			<div class="popup__mask__alert">
				<div class="popup__wrapper__alert">
					<div class="popup__layer__alert">
						<div class="alert__message__wrapper">
							<div class="alert__message">
								<img src="{{ URL::asset('cms/images/logo-alert.png') }}" alt="">
								<h3>Alert!</h3>
								<label>Are you sure that you want to delete this?</label>
							</div>
							<div class="alert__message__btn">
								<div class="new__form__btn">
									<a href="#" class="btn__form__reset" @click.prevent="closeForm">Cancel</a>
									<a href="#" class="btn__form__create" @click="deleteFolder(models.id)">Confirm</a>
								</div>
							</div>
							<button class="alert__message__close" @click.prevent="closeForm"></button>
						</div>
					</div>
				</div>
			</div>
		</modal>

		<div class="main__content__wrapper">

			<form action="#" method="POST" enctype="multipart/form-data" @submit.prevent>
				<div class="main__content__form__layer" id="toggle-web-manager-content" style="display: none;">
					<div class="create__form__wrapper">
						<div class="form--top flex-between">
							<div class="form__title">Add Folder</div>
							<div class="form--top__btn">
								<a href="#" class="btn__add__cancel" @click="changeButton">Cancel</a>
							</div>
						</div>
						<div class="form--mid">
							<div class="create__form">
								<div class="create__form__row">
									<div class="new__form__field">
										<label>Folder Name<span class="required">&ast;</span></label>
										<input name="folder_name_fm" id="folder_title" v-model="models.folder_name" type="text" class="new__form__input__field" placeholder="Enter the menu folder name here">
										<div class="form--error--message"><span id="error-name-fm"></span></div>
									</div>
								</div>
								<div class="create__form__row">
									<div class="new__form__field">
										<label>Folder Group<span class="required">&ast;</span></label>
										<input v-model="models.folder_group" type="text" class="new__form__input__field" placeholder="Enter the menu folder group here">
										<div class="form--error--message"><span id="error-group-fm"></span></div>
									</div>
								</div>
								<div class="create__form__row">
									<div class="new__form__field">
										<label>Function Js<span class="required">&ast;</span></label>
										<input v-model="models.function_js" type="text" class="new__form__input__field" placeholder="Enter the menu function js here">
										<div class="form--error--message"><span id="error-functionjs-fm"></span></div>
									</div>
								</div>
								<div class="create__form__row">
									<div class="new__form__field">
										<label>Is Visible<span class="required">&ast;</span></label>
											<ul class="input--radio--ul">
												<li class="input--radio--li">
													<input v-model="models.is_visible" type="radio" id="option-1" name="is_visible" value="1" id="indoorOutdoor">
													<label for="option-1">Yes</label>
													<div class="check"></div>
												</li>
												<li class="input--radio--li">
													<input v-model="models.is_visible" type="radio" id="option-2" name="is_visible" value="0" id="Indoor">
													<label for="option-2">No</label>
													<div class="check"></div>
												</li>
											</ul>
										<div class="form--error--message"><span id="error-isvisible-fm"></span></div>
									</div>
								</div>
							</div>
						</div>
						<div class="form--bot">
							<div class="create__form">
								<div class="create__form__row flex-start">
									<div class="new__form__btn">
										<button class="btn__form" type="submit" v-if="!edit" @click="addFolder">Save</button>
										<button class="btn__form" type="submit" v-if="edit" @click="updateFolder(models.id)">Save</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>


			<div class="main__content__layer">
				<div class="content__top flex-between">
					<div class="content__title">
						<h2>Folders</h2>
					</div>
					<div class="content__btn">
						<a href="#" class="btn__add" id="toggle-web-manager">Add Folder</a>
					</div>
				</div>
				<div class="content__bottom">
					<ul class="news__list" id="sort" v-sort>
						<li class="news__list__wrapper sort-item" v-for="folder in data" id="@{{ folder.id }}">
							<div class="news__list__detail">
								<div class="drag__control">
									<!-- HANDLE -->
									<div class="handle">
										@include('cms.svg-logo.handle-drag')
									</div>
								</div>
								<div class="news__list__detail__middle-right">
									<div class="news__list__detail__middle">
										<div class="news__list__desc">
											<div class="news__name">
												<a href="#" class="title__name" @click="editFolder(folder.id)">@{{ folder.folder_name }}</a>
											</div>
											<div class="news__desc flex">
												<p class="news__cat">Folder group: <i>@{{ folder.folder_group }}</i></p>
												<p class="news__cat">Function js: <i>@{{ folder.function_js }}()</i></p>
											</div>
										</div>
									</div>
									<div class="news__list__detail__right">
										<a href="#" class="btn__delete" @click="showDeleteForm(folder.id)">
											<i class="ico-delete">@include('cms.svg-logo.ico-delete')</i>
										</a>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>