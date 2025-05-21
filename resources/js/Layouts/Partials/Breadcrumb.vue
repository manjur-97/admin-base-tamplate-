<script setup>
import { Head, Link } from "@inertiajs/vue3";
defineProps(["breadcrumbs"]);
</script>

<template>

    <header v-if="breadcrumbs" class="bg-white rounded shadow-sm p-2 mb-2">


        <ul class="d-flex list-unstyled mb-0">

        <template
            v-for="(breadcrumb, breadcrumbIndex) in breadcrumbs"
            :key="breadcrumb.title"
        >

            <li>
            <Link
                v-if="breadcrumb.link"
                :href="breadcrumb.link"
                class="text-decoration-none text-dark fw-bold"
            >
                {{ breadcrumb.title }}
            </Link>

            <a
                v-else
                href="javascript:void(0)"
                class="text-decoration-none text-dark fw-semibold"
            >
                {{ breadcrumb.title }}
            </a>
            
            </li>

            <li
            v-if="breadcrumbIndex != parseInt(breadcrumbs?.length ?? 0) - 1"
            class="mx-2 text-muted"
            >
            /
            </li>

        </template>

        </ul>


    </header>

</template>
