<template>
  <div>
    <div id="dropdown" />
    <div class="md:flex md:flex-col">
      <div class="md:flex md:flex-col md:h-screen">
        <div class="md:flex md:flex-shrink-0">
          <div class="flex items-center justify-between px-6 py-4 bg-indigo-900 md:flex-shrink-0 md:justify-center md:w-56">
            <Link class="mt-1" href="/">
              <logo class="fill-white" width="120" height="28" />
            </Link>
            <dropdown class="md:hidden" placement="bottom-end">
              <template #default>
                <svg class="w-6 h-6 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" /></svg>
              </template>
              <template #dropdown>
                <div class="mt-2 px-8 py-4 bg-indigo-800 rounded shadow-lg">
                  <main-menu />
                </div>
              </template>
            </dropdown>
          </div>
          <div class="md:text-md flex justify-between w-full text-sm bg-white border-b md:px-12 md:py-0">
            <nav class="bg-white flex" aria-label="Breadcrumb">
              <ol class="w-full mx-auto px-4 flex space-x-4 sm:px-6 lg:px-8">
                <li class="flex">
                  <div class="flex items-center">
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                      <HomeIcon class="flex-shrink-0 h-5 w-5" aria-hidden="true" />
                      <span class="sr-only">Home</span>
                    </a>
                  </div>
                </li>
                <li v-for="(page, index) in breadcrumbs" :key="page.name" class="flex">
                  <div class="flex items-center">
                    <svg class="flex-shrink-0 w-6 h-full text-gray-200" viewBox="0 0 24 44" preserveAspectRatio="none" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                      <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                    </svg>
                    <a :href="page.url" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" :aria-current="page.is_current_page ? 'page' : undefined">{{ page.title }}</a>
                  </div>
                </li>
              </ol>
            </nav>
            <dropdown class="mt-1" placement="bottom-end">
              <template #default>
                <div class="group flex items-center cursor-pointer select-none">
                  <div class="mr-1 text-gray-700 group-hover:text-indigo-600 focus:text-indigo-600 whitespace-nowrap">
                    <span>{{ auth.user.first_name }}</span>
                    <span class="hidden md:inline">&nbsp;{{ auth.user.last_name }}</span>
                  </div>
                  <icon class="w-5 h-5 fill-gray-700 group-hover:fill-indigo-600 focus:fill-indigo-600" name="cheveron-down" />
                </div>
              </template>
              <template #dropdown>
                <div class="mt-2 py-2 text-sm bg-white rounded shadow-xl">
                  <Link class="block px-6 py-2 hover:text-white hover:bg-indigo-500" :href="`/users/${auth.user.id}/edit`">My Profile</Link>
                  <Link class="block px-6 py-2 hover:text-white hover:bg-indigo-500" href="/users">Manage Users</Link>
                  <Link class="block px-6 py-2 w-full text-left hover:text-white hover:bg-indigo-500" href="/logout" method="delete" as="button">Logout</Link>
                </div>
              </template>
            </dropdown>

          </div>
        </div>
        <div class="md:flex md:flex-grow md:overflow-hidden">
          <main-menu :key="$page.url" :menu="menu" class="hidden flex-shrink-0 w-56 bg-indigo-800 overflow-y-auto md:block" />

          <div class="md:flex-1 md:overflow-y-auto" scroll-region>
            <div class="">
              <slot />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import Logo from '@/Shared/Logo'
import Dropdown from '@/Shared/Dropdown'
import MainMenu from '@/Shared/MainMenu'
import FlashMessages from '@/Shared/FlashMessages'
import { HomeIcon } from '@heroicons/vue/solid'


export default {
  components: {
    Dropdown,
    FlashMessages,
    Icon,
    Link,
    Logo,
    MainMenu,
    HomeIcon,
  },
  props: {
    auth: Object,
    breadcrumbs: Object,
    menu: Object,
  },
}
</script>
