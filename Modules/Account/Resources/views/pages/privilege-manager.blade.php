<div id="template_privilege">
	<div class="filter__wrapper">
		<div class="filter__content">
			<div class="filter__content__title">
				<h1>Privilege Manager</h1>		
				<div class="breadcrumb">
					<a href="#" class="breadcrumb--a"><p class="breadcrumb--p">Accounts</p></a>
				</div>
			</div>
			<div class="filter__content__btn">
				<a href="javascript:void(0);" class="btn__content__filter btn__filter trigger-toogle-form btn__toggle" id="toggle-privilege-manager" data-cancel="Cancel" data-name="Add Privilege" @click="changeButton">Add Privilege</a>
			</div>
		</div>
	</div>
	<div class="main__content">
		<div class="main__content__wrapper">

			<form action="#" method="POST" @submit.prevent>
				<div class="main__content__form__layer" id="toggle-privilege-manager-content" style="display: none;">
					<div class="create__form__wrapper">
						<div class="form--top flex-between">
							<div class="form__title"  @click="changeButton" id="form_title">Add Privilege</div>
						</div>
						<div class="form--mid">
							<div class="create__form">

								<div class="form__group__row">
									<div class="create__form__row">
										<div class="new__form__field">
											<label>Privilege Name</label>
											<input type="text" class="new__form__input__field" placeholder="Enter the privilege name here" v-model="models.name" id="name_title">
											<div class="form--error--message"><span id="error-name-title"></span></div>
										</div>
										<div class="new__form__field">
											<label>Description</label>
											<input type="text" class="new__form__input__field" placeholder="Enter the description here" v-model="models.description">
											<div class="form--error--message"><span id="error-description-title"></span></div>
										</div>
									</div>
									<div class="create__form__row">
										<div class="new__form__field">
											<label>System</label>
											<select name="system" id="select_system" >
												<option value="">--Choose One--</option>
												<option value="@{{ obj.id }}" v-for="obj in system_manager">@{{ obj.name }}</option>
											</select>
											<div class="form--error--message"><span id="error-system-title"></span></div>
										</div>
										<div class="new__form__field">
											<label>Menu</label>
											<select name="menu" id="select_menu" >
												<option value="">--Choose One--</option>
												<option value="@{{ obj.id }}" v-for="obj in menu_manager">@{{ obj.name }}</option>
											</select>
											<div class="form--error--message"><span id="error-menu-title"></span></div>
										</div>
									</div>
								</div>

								<hr class="form__line">

								<div class="form__group__row">
									<div class="create__form__row" >
										<span class="form__group__title">Coverage</span>
									</div>
									<div class="checkbox--grid__wrapper grid-check" >
										<!-- item grid list -->
										<div class="checkbox--grid grid--item-check" v-for="obj in controller_manager">
											<div class="checkbox--grid--item check-item-wrapper">
												<div class="checkbox--grid--item--top admin--top--check">
													<div class="form--checkbox__wrapper">
														<input type="checkbox" id="checkbox-controller-@{{ obj.id }}" class="checkbox--input check-item-all" name="controller" >
														<label for="checkbox-controller-@{{ obj.id }}" class="checkbox--label">@{{ obj.display_name }}</label>
													</div>
												</div>
												
												<div class="checkbox--grid--item--bottom" v-for="funct in obj.functions">
													<div class="form--checkbox__wrapper">
														<input type="checkbox" id="checkbox-@{{ funct.id }}" class="checkbox--input check-item" name="privilege" value="@{{ funct.id }}" v-model="checkFunctions" v-bind:checked="funct.checked">
														<label for="checkbox-@{{ funct.id }}" class="checkbox--label">@{{ funct.name }}</label>
													</div>
												</div>
											</div>
										</div>

									</div>
								</div>

							</div>
						</div>
						<div class="form--bot">
							<div class="create__form">
								<div class="create__form__row flex-end">
									<div class="new__form__btn">
										<button class="btn__form" type="submit" @click="addData">Save</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>


			<div class="main__content__layer">
				<ul class="news__list sortable">
					<li class="news__list__wrapper" v-for="obj in data">
						<div class="news__list__detail">
							<div class="news__list__detail__middle-right">
								<div class="news__list__detail__middle">
									<div class="news__list__desc">
										<div class="news__name">
											<a href="#" class="title__name content__edit__hover btn__toggle__edit" @click="editData(obj.id)">@{{ obj.name }}</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>