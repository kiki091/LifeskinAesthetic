<div class="main--content" id="template_main_banner">
    <h3 class="main--content__title">MAIN BANNER MANAGER</h3>
    @include('cms.banner.form')

    <div class="card">
        <a href="javascript:void(0);" class="minimize" data-toggle="collapse" data-target="#collapse-2"></a>
        <div class="card__header flex between vend">
            <h6 class="bold">MAIN BANNER</h6>
            <a href="javascript:void(0);" class="btn--primary open-toggle" id="toggle-open" @click="changeButton">Add Data</a>
        </div>
        <div class="card__body collapse in" id="collapse-2">
            <div class="media--accordion">
                <div class="media--accordion__body">
                    <ul class="media__wrapper margin0 sortable" id="sort">
                        <li class="media sort-item" v-bind:data-id="main_banner_data.id" v-for="main_banner_data in data">
                            <div class="media__group flex">
                                <div class="media__thumb">
                                    <img :src="main_banner_data.filename_url">
                                </div>
                                <div class="media__text">
                                    <a href="#" class="content__edit__hover" @click="editData(main_banner_data.id)">
                                        <h6 class="s14">@{{ main_banner_data.title }}</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="media__control">
                                <a href="#" @click="showDeleteForm(main_banner_data.id)" class="ico-delete margin-x5">@include('svg-logo.ico-delete')</a>
                            </div>
                        </li>
                    </ul>  
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.vars')