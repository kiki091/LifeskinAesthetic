<div class="card form" id="toggle-open-content" style="display: none;">
    <form action="{{ route('cms.news.store') }}" method="POST" id="form-news" enctype="multipart/form-data" @submit.prevent>
        <div class="form--top flex vcenter between">
            <h6 class="bold margin0">Edit Data</h6>
            <a href="javascript:void(0);" class="btn--primary2 close-toggle" id="toggle-menu-manager" data-cancel="Cancel" data-name="Add Data" @click="changeButton">Close</a>
        </div>
        <!-- FORM WIZARD -->
        <div class="wizard--tab" id="menu">
            <ul class="wizard--tab--ul" >
                <li class="wizard--tab--li" v-for="(supportedLang, supportedLangKey, index) in supported_language" :class="last_language_key == supportedLangKey? 'lastTab': ( !index ? 'firstTab active__tab' : 'inactive__tab')">
                    <a :href="'#lang-'+supportedLangKey" class="wizard--tab--link">@{{ supportedLang.name }}</a>

                </li>
               
            </ul>
        </div>
        <div class="form--middle">
            <div class="create__form content__tab" v-for="(supportedLang, supportedLangKey, index) in supported_language" :class="!index ? 'active__content' : ''" :id="'lang-'+supportedLangKey">

                <div class="field widthauto flex" v-if="showElementByDefaultLang(supportedLangKey)">
                    <fchosen :options="list_sub_category" id="select-sub-category" v-model="sub_category_selector" name="sub_category_id" label="Sub Category"></fchosen>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <ftext type='text' class="new__form__input__field" id="title" placeholder="Enter the title title here" name="title" v-model="models.title" label="Title News"></ftext>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <ftext type='text' class="new__form__input__field" id="video_url" placeholder="Enter the video_url video_url here" name="video_url" v-model="models.video_url" label="Video Url"></ftext>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <fimage id="thumbnail" name="thumbnail" v-model="thumbnail.image_url" label="Thumbnail Images" :ref="'thumbnail'" :options="thumbnail.options"></fimage>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <fimage id="filename" name="filename" v-model="filename.image_url" label="Detail Images" :ref="'filename'" :options="filename.options"></fimage>
                </div>

                <div class="field">
                    <ftexteditor name="introduction" v-model="models.introduction" label="Introduction" id="introduction"></ftexteditor>
                </div>

                <div class="field">
                    <ftexteditor name="description" v-model="models.description" label="Description" id="description"></ftexteditor>
                </div>

                <div class="field">
                    <ftexteditor name="quotes" v-model="models.quotes" label="quotes" id="Quotes"></ftexteditor>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <ftext type='text' class="new__form__input__field" id="meta_title" placeholder="Enter the meta title here" name="meta_title" v-model="models.meta_title" label="Meta Title"></ftext>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <ftext type='text' class="new__form__input__field" id="meta_keyword" placeholder="Enter the meta keyword here" name="meta_keyword" v-model="models.meta_keyword" label="Meta Keyword"></ftext>
                </div>

                <div class="field">
                    <ftexteditor name="meta_description" v-model="models.meta_description" label="meta_description" id="Meta Description"></ftexteditor>
                </div>
            </div>
        </div>

        <div class="form--bottom flex vcenter between">
            <div class="">
                <a href="#" class="btn--primary2 prev-button margin-r10" id=""><</a>
                <a href="#" class="btn--primary next-button" id="">Next</a>
            </div>
            {{ csrf_field() }}
            <input v-model="models.id" type="hidden" name="id" v-if="edit == true">
            <input class="btn__form btn--primary" type="submit" value="Save and Close" v-on:click="saveData">
        </div>
    </form>
</div>