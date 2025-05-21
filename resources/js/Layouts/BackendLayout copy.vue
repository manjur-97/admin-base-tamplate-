<script setup>
import { Head } from '@inertiajs/vue3';
import Sidebar from '@/Layouts/Partials/Sidebar.vue';
import Navbar from '@/Layouts/Partials/Navbar.vue';
import Breadcrumb from '@/Layouts/Partials/Breadcrumb.vue'; 


</script>

<template>
    <div>
          <Link :href="route('backend.student.create')" class="" aria-expanded="false">
            <div class="menu-icon">
              <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <g opacity="0.5">
                  <path
                    opacity="0.4"
                    d="M10.0833 15.9579H3.50777C2.67555 15.9579 2 16.6217 2 17.4393C2 18.2558 2.67555 18.9206 3.50777 18.9206H10.0833C10.9155 18.9206 11.5911 18.2558 11.5911 17.4393C11.5911 16.6217 10.9155 15.9579 10.0833 15.9579Z"
                    fill="white"
                  ></path>
                  <path
                    opacity="0.4"
                    d="M22 6.37855C22 5.56202 21.3244 4.89832 20.4933 4.89832H13.9178C13.0856 4.89832 12.41 5.56202 12.41 6.37855C12.41 7.19617 13.0856 7.85988 13.9178 7.85988H20.4933C21.3244 7.85988 22 7.19617 22 6.37855Z"
                    fill="white"
                  ></path>
                  <path
                    d="M8.87774 6.37856C8.87774 8.24523 7.33886 9.75821 5.43887 9.75821C3.53999 9.75821 2 8.24523 2 6.37856C2 4.51298 3.53999 3 5.43887 3C7.33886 3 8.87774 4.51298 8.87774 6.37856Z"
                    fill="white"
                  ></path>
                  <path
                    d="M22 17.3992C22 19.2648 20.4611 20.7778 18.5611 20.7778C16.6622 20.7778 15.1223 19.2648 15.1223 17.3992C15.1223 15.5325 16.6622 14.0196 18.5611 14.0196C20.4611 14.0196 22 15.5325 22 17.3992Z"
                    fill="white"
                  ></path>
                </g>
              </svg>
            </div>
            <span class="nav-text">Section</span>
          </Link>

    </div>
    <div>

        <!-- <Head :title="$page.props.pageTitle" /> -->


        <div class="w-full bg-slate-300 dark:bg-slate-950">
            <!-- nav bar  -->
            <Navbar />

            <div class="flex w-full">
                <!-- side bar  -->
                <Sidebar />

                <!-- main content  -->
                <div class="w-full h-[calc(100vh-48px)] mt-12 overflow-y-auto py-8 px-2">
                    <!-- Page Breadcrumb -->

                    <Breadcrumb :breadcrumbs="$page.props.breadcrumbs"/>
                    <!-- Page Content -->
                    <main>
                        <slot />
                    </main>
                </div>
            </div>

        </div>

    </div>
</template>

<style>
/* width */
::-webkit-scrollbar {
    width: 3px;
    height: 5px;
}

/* Track */
::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey;
    border-radius: 10px;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: rgb(17, 0, 62);
    border-radius: 10px;
}


body {
    background-color: #f8f3f2 !important;
}
</style>
