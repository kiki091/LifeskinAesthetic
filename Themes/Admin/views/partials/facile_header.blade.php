<div class="main--header clearfix" id="headerApp">
    <a href="javascript:void(0);" class="sidebar--toggle float-left">
        <div class="bar">
            <span class="bar-1"></span>
            <span class="bar-2"></span>
            <span class="bar-3"></span>
        </div>
    </a>
    
    @if(in_array('selector', config('facile.core.core.admin-menu')))
    <div class="header--selector flex vcenter float-left">
        <div class="dropdown dropdown--wrapper">
            <div class="select--name flex vcenter" v-if="!showSelectorTitle">{{ config('facile.core.core.selector-menu-name') }}</div>
            <div class="select--name flex vcenter" v-if="showSelectorTitle">@{{ showSelectorTitle }} </div>
            <div class="dropdown--submenu left">
                <ul>
                    <li v-for="selectorObj in selector"><a :href="selectorObj.link"><small>@{{ selectorObj.name}}</small></a></li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    <div class="menu--user dropdown dropdown--wrapper float-right">
        <div class="select--name flex vcenter">
            <small>Welcome back, {{ session('user_info')['name'] }}</small>
            <div class="user__img">
                <img src="{{ Theme::url('images/thumb/user-img2.png') }}" alt="">
            </div>
        </div>
        <div class="dropdown--submenu">
            <div class="media">
                <div class="media-left media-middle">
                    <div class="user__img">
                        <img src="{{ Theme::url('images/thumb/user-img2.png') }}" alt="">
                    </div>
                </div>
                <div class="media-body media-middle">
                    <h6 class="margin0">{{ session('user_info')['name'] }}</h6>
                    @if(in_array('changephoto', config('facile.core.core.admin-menu')))
                    <a href="#" class="link">Change account photo</a>
                    @endif
                </div>
            </div>
            <ul>
                @if(in_array('changepassword', config('facile.core.core.admin-menu')))
                <li><a href="#" @click="showPopup"><small>Change Password</small></a></li>
                @endif
                @if(in_array('changelog', config('facile.core.core.admin-menu')))
                <li><a href="#"><small>Changelog</small></a></li>
                @endif
                <li><a href="{{ route('facile.logout') }}"><small>Logout</small></a></li>
            </ul>
        </div>           
    </div>
    @if(in_array('notification', config('facile.core.core.admin-menu')))
    <div class="menu--notif header--notification dropdown dropdown--wrapper float-right has-notif">
        <div class="select--name flex center vcenter">
            <i class="ico-bell"><small class="bold flex vcenter center padding0">8</small></i>
        </div>
        <div class="dropdown--submenu message--list">
            <div class="flex between vcenter message--header">
                <small class="s10 d-block bold">Notification</small>
                <a href="#" class="link d-block"><small class="s10">Mark all as read</small></a>
            </div>
            <ul>
                @for ($i = 0; $i < 4; $i++)
                <li>
                    <a href="#">
                        <div class="media">
                            <div class="media-left media-middle">
                                <div class="user__img">
                                    <img src="{{ Theme::url('images/thumb/user-img2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="media-body widthfull">
                                <div class="flex between">
                                    <h6 class="margin0 semibold">Sara Soueidan</h6>
                                    <small class="s10 margin-l5">35 min</small>
                                </div>
                                <small class="s10 message--text">Roger just updated the content for SEO section.</small>
                            </div>
                        </div>
                    </a>
                </li>
                @endfor
            </ul>
        </div>
    </div>
    @endif
    @if(in_array('message', config('facile.core.core.admin-menu')))
    <div class="menu--message header--notification dropdown dropdown--wrapper float-right has-notif">
        <div class="select--name flex center vcenter">
            <i class="ico-message">
                <small class="bold flex vcenter center padding0" v-if="total_message">@{{ total_message }}</small>
            </i>
        </div>
        <fmessagebox :messages="messages"></fmessagebox>
    </div>
    @endif
    <fforgotmodal v-model="showModal"></fforgotmodal>
    <fnotifymodal v-model="showConfirm" :type="confirmType" :data="dataConfirm"></fnotifymodal>
</div>