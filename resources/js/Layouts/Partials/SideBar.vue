<script setup>
import { reactive, ref, onMounted, onBeforeUnmount } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import eventBus from "@/eventBus.js";

const screenWidth = ref(window.innerWidth);
const { props } = usePage();
const rolePermissions = props.routePermissions;

let menus = props.sideMenus;
const authKeys = Object.keys(props.auth);
const activeAuthKey = authKeys.findIndex((key) => props.auth[key] !== null);
const activeAuth = authKeys[activeAuthKey];

const user = props.auth.admin || props.auth.tanent;
const handleResize = () => {
  screenWidth.value = window.innerWidth;
};

onMounted(() => {
  window.addEventListener("resize", handleResize);
});

onBeforeUnmount(() => {
  window.removeEventListener("resize", handleResize);
});

const sideBar = ref(false);

eventBus.on("sidebarToggled", (flag) => {
  sideBar.value = flag;
});
// const isActiveRoute = (routeName) => {
//   console.log(routeName)
//   console.log(props.currentAccessRoute)
//   console.log(routeName == props.currentAccessRoute)
//   return  routeName == props.currentAccessRoute;
// };

const isActiveRoute = (routeName) => {
  if (!props.currentAccessRoute || !routeName) return false;

  // `backend.` থাকলে সেটি রিমুভ করে তুলনা করা
  const cleanedCurrentRoute = props.currentAccessRoute.replace(
    /^backend\./,
    ""
  );
  const cleanedRouteName = routeName.replace(/^backend\./, "");

  // মূল route মিলে গেলে true রিটার্ন করবে
  if (cleanedCurrentRoute === cleanedRouteName) {
    return true;
  }

  // যদি parent menu-এর কোনো child active থাকে, তবে সেটিও active দেখাবে
  const isChildActive = menus.some((menu) =>
    menu.childrens?.some((child) => child.route === cleanedCurrentRoute)

  );

  return isChildActive;
};
</script>
<template>
  <div class="deznav">
    <div class="deznav-scroll">
      <ul class="metismenu" id="">
        <li v-for="(menu, index) in menus" :key="index">
          <Link
            v-if="
              menu.route &&
              rolePermissions.includes(menu.route) &&
              menu.childrens.length <= 0 &&
              activeAuth == menu.permission_name
            "
            :href="route(menu.route)"
            :class="{ 'active-menu': isActiveRoute(menu.route) }"
            :aria-expanded="isActiveRoute(menu.route)"
          >
            <div class="menu-icon me-2">
              <i
                :class="menu.icon"
                :aria-expanded="!isActiveRoute(menu.route)"
              ></i>
            </div>
            <span class="nav-text">{{ menu.name }}</span>
          </Link>

          <a
            v-if="
              menu.childrens &&
              menu.childrens.length > 0 &&
              activeAuth == menu.permission_name
            "
            class="main-menu has-arrow"
            href="javascript:void(0);"
            :class="{ 'active-menu': isActiveRoute(menu.route) }"
            aria-expanded="false"
          >
            <div class="menu-icon me-2">
              <i
                :class="menu.icon"
                :aria-expanded="true"
              ></i>
            </div>
            <span class="nav-text">{{ menu.name }}</span>
          </a>
          <ul
            class="submenu"
            :aria-expanded="isActiveRoute(menu.route)"
            style="display: none"
          >
            <li v-for="(child, index) in menu.childrens" :key="index">
              <Link
                v-if="
                  child.route &&
                  rolePermissions.includes(child.route) &&
                  activeAuth == menu.permission_name
                "
                :href="route(child.route)"
                :class="{ 'active-menu': isActiveRoute( child.route) }"
              >
                {{ child.name }}
              </Link>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</template>
<style>
.active-menu {
  background-color:#6648c2;
  border: 10px solid #222B40;
  border-radius: 17px;
  padding: 10px 15px;
}
</style>
