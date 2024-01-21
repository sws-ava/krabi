<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <a :to="{ name: user ? 'dashboard' : 'welcome' }" class="navbar-brand">
            Krabi
        </a>
        <!-- <button :aria-label="$t('toggle_navigation')" class="navbar-toggler" type="button"
                     data-toggle="collapse" data-target="#navbarToggler"
                     aria-controls="navbarToggler" aria-expanded="false"
             >
               <span class="navbar-toggler-icon" />
             </button> -->

        <div id="navbarToggler" class="collapse navbar-collapse">
            <!-- <ul class="navbar-nav">
              <locale-dropdown />
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
            </ul> -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a :to="{name: 'dashboard'}">
                        Админ панель
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <!-- Authenticated -->
                <!-- <li v-if="user" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark"
               href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            >
              <img :src="user.photo_url" class="rounded-circle profile-photo mr-1">
{{--              {{ user.name }}--}}
                user.name
                </a>
                <div class="dropdown-menu">
                  <router-link :to="{ name: 'settings.profile' }" class="dropdown-item pl-3">
{{--{{ $t('settings') }}--}}
                </router-link>

                <a class="dropdown-item pl-3" href="#" @click.prevent="logout">
{{--{{ $t('logout') }}--}}
                </a>
              </div>

            </li> -->
                <li v-if="user" class="nav-item">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf


                        <button
                            type="submit"
                            class="nav-link dropdown-toggle text-dark pl-3"
                            style="background: none; border: none;"
                        >
                            logout
                        </button>
                    </form>
                </li>
                <!-- Guest -->
                <template v-else>
                    <li class="nav-item">
                        <a :to="{ name: 'login' }" class="nav-link" active-class="active">
{{--                            <!-- {{ $t('login') }} -->--}}
                            login
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- <router-link :to="{ name: 'register' }" class="nav-link" active-class="active">
{{--                {{ $t('register') }}--}}
                        register
                        </router-link> -->
                    </li>
                </template>
            </ul>
        </div>
    </div>
</nav>
