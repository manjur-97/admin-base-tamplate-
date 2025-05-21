<script setup>
import { Head } from "@inertiajs/vue3";
import Sidebar from "@/Layouts/Partials/Sidebar.vue";
import Navbar from "@/Layouts/Partials/Navbar.vue";
import Breadcrumb from "@/Layouts/Partials/Breadcrumb.vue";
</script>

<template>


  <div id="main-wrapper">
    <Navbar />

    <Sidebar />

	<!-- Body -->

    <div class="content-body">


      <div class="container-fluid">

		 <Breadcrumb :breadcrumbs="$page.props.breadcrumbs"/>

        <slot />

      </div>


    </div>

    <!-- Footer -->

    <div class="footer">
  <div class="copyright">
    <p>
      &copy; Developed by 
      <a href="https://manjur.xyz" target="_blank" rel="noopener noreferrer">Manjur Rahman</a>
      <span class="current-year"> -2025</span>
    </p>
  </div>
</div>

  </div>

</template>

