<script setup>
import { reactive, ref, onMounted, onBeforeUnmount } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import SideBarSubMenu from "@/Components/SideBarSubMenu.vue";
import eventBus from "@/eventBus.js";

const screenWidth = ref(window.innerWidth);
const { props } = usePage();
const rolePermissions = props.routePermissions;

let menus = props.sideMenus;

const authKeys = Object.keys(props.auth);
const activeAuthKey = authKeys.findIndex((key) => props.auth[key] !== null);
const activeAuth = authKeys[activeAuthKey];

const user = props.auth.admin || props.auth.employee;
const handleResize = () => {
  screenWidth.value = window.innerWidth;
};

onMounted(() => {
  window.addEventListener("resize", handleResize);
});

onBeforeUnmount(() => {
  window.removeEventListener("resize", handleResize);
});

if (screenWidth < 400) {
  //  console.log(screenWidth);
} else {
  // console.log('else');
}

const sideBar = ref(false);

eventBus.on("sidebarToggled", (flag) => {
  sideBar.value = flag;
});

const navSidebar = reactive([
  "flex items-center p-2 space-x-1 duration-500 border-b rounded-md cursor-pointer hover:bg-red-200 hover:text-black-700 border-slate-300 dark:border-slate-800",
]);

const sideNavListTrue = ref(["md:hidden lg:block"]);
const sideNavListFalse = ref("md:hidden lg:block");
</script>
<template>
  <div class="deznav">
    <div class="deznav-scroll">

      <ul
        class="metismenu"
        id=""
      >
        <li v-for="(menu, index) in menus" :key="index">

          <Link
            v-if="menu.route && rolePermissions.includes(menu.route) && menu.childrens.length <= 0  && activeAuth==menu.permission_name"
            :href="route(menu.route)"
            class=""
            aria-expanded="false"
          >
            <div class="menu-icon me-2">
              <i :class="menu.icon" aria-hidden="true"></i>
            </div>
            <span class="nav-text">{{ menu.name }}</span>
          </Link>

          <a
            v-if="menu.childrens && menu.childrens.length > 0 && activeAuth==menu.permission_name"
            class="has-arrow"
            href="javascript:void(0);"
            aria-expanded="false"
          >
            <div class="menu-icon me-2">
              <i :class="menu.icon" aria-hidden="true"></i>
            </div>
            <span class="nav-text">{{ menu.name }}</span>
          </a>
          <ul class="submenu" aria-expanded="false" style="display: none">
            <li v-for="(child, index) in menu.childrens" :key="index">
              <Link
                v-if="child.route && rolePermissions.includes(child.route) && activeAuth==menu.permission_name"
                :href="route(child.route)"
                >{{ child.name }}</Link
              >


            </li>
          </ul>

        </li>


      </ul>
    </div>
  </div>
</template>
