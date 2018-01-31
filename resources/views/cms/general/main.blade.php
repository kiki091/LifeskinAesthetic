<div class="main--content" id="template_general">
    <h3 class="main--content__title">GENERAL INFORMATION</h3>
    @include('cms.general.form')

    <div class="card">
        <a href="javascript:void(0);" class="minimize" data-toggle="collapse" data-target="#collapse-2"></a>
        <div class="card__header flex between vend">
            <h6 class="bold">GENERAL</h6>
        </div>
        <div class="card__body collapse in" id="collapse-2">
            <div class="media--accordion">
                <div class="media--accordion__body">
                    <ul class="media__wrapper margin0 sortable" id="sort">
                        <li class="media sort-item" v-bind:data-id="general_data.id" v-for="general_data in data">
                            <div class="media__group flex">
                                <div class="media__thumb">
                                    <img :src="general_data.logo_url">
                                </div>
                                <div class="media__text">
                                    <a href="#" class="content__edit__hover" @click="editData(general_data.id)">
                                        <h6 class="s14">@{{ general_data.web_title }}</h6>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>  
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.vars')