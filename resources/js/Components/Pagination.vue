<script setup>
import { Link } from "@inertiajs/vue3";
</script>
<template>
  <div class="row py-2 my-4">
    <div class="col-md-6 text-center text-md-start">
      <p class="text-muted small">
        {{
          `Displaying ${$page.props.datas?.from ?? 0} to ${
            $page.props.datas?.to ?? 0
          } of ${$page.props.datas?.total ?? 0} items`
        }}
      </p>
    </div>
    <nav class="col-md-6">
      <ul class="pagination justify-content-center justify-content-md-end mb-0">
        <!-- Previous Button -->
        <li
          class="page-item"
          :class="{ disabled: $page.props.datas.links[0].url === null }"
        >
          <a
            :href="$page.props.datas.links[0].url"
            class="page-link"
            v-if="$page.props.datas.links[0].url"
            rel="prev"
            >&laquo;</a
          >
          <span v-else class="page-link">&laquo;</span>
        </li>

        <!-- Page Links -->
        <li
          v-for="link in $page.props.datas.links.slice(1, -1)"
          :key="link.label"
          :class="{ active: link.active }"
          class="page-item"
        >
          <a :href="link.url" class="page-link" v-if="link.url">{{
            link.label
          }}</a>
          <span v-else class="page-link">{{ link.label }}</span>
        </li>

        <!-- Next Button -->
        <li
          class="page-item"
          :class="{
            disabled:
              $page.props.datas.links[$page.props.datas.links.length - 1]
                .url === null,
          }"
        >
          <a
            :href="
              $page.props.datas.links[$page.props.datas.links.length - 1].url
            "
            class="page-link"
            v-if="
              $page.props.datas.links[$page.props.datas.links.length - 1].url
            "
            rel="next"
            >&raquo;</a
          >
          <span v-else class="page-link">&raquo;</span>
        </li>
      </ul>
    </nav>
  </div>
</template>
