<div class="main--content" id="template_transaction">
    <h3 class="main--content__title">TRANSACTION HISTORY</h3>
    @include('cms.transaction.form')
    
    <div class="card">
        <a href="javascript:void(0);" class="minimize" data-toggle="collapse" data-target="#collapse-2"></a>
        <div class="card__header flex between vend">
            <div class="field">
                <div class="new__form__input__field field">
                    <label>Registration Id</label>
                    <input type="text" name="registrasi_id" id="registrasi_id" class="" v-model="registrasi_id">
                </div>
            </div>

            <div class="field widthauto flex">
                <fchosen :options="list_status" id="select-status" v-model="status_selector" name="status" label="Status"></fchosen>
            </div>
        </div>
        <div class="card__body collapse in" id="collapse-2">
            <table cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th class="center-align">#</th>
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Registration Id</th>
                        <th>Booking Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(value, index) in data">
                        <td class="center-align">@{{ index+1 }}</td>
                        <td class="center-align">@{{ value.member_name }}</td>
                        <td>
                            <a href="javascript::void(0)" class="link link-edit" @click="editData(value.id)">@{{ value.member_email }}</a>
                        </td>
                        <td>@{{ value.member_phone_number }}</td>
                        <td>@{{ value.registrasi_id }}</td>
                        <td>@{{ value.book_date | formatDate }}</td>
                        <td>@{{ value.status }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ------pagination------- -->
    <div class="pagination">
        <ul>

            <li v-if="pagination.current_page > 1">
                <a href="#" class="prev" @click.prevent="changePage(pagination.current_page - 1)"></a>
            </li>

            <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
            <a href="#" @click.prevent="changePage(page)">
              @{{ page }}
            </a>
          </li>

            <li v-if="pagination.current_page < pagination.last_page">
                <a href="#"class="next" @click.prevent="changePage(pagination.current_page + 1)"></a>
            </li>

        </ul>
    </div>
    <!-- ------------- -->
</div>

@include('partials.vars')