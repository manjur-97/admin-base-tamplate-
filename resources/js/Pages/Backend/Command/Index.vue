<script setup>
import { ref } from "vue";
import BackendLayout from "@/Layouts/BackendLayout.vue";
import BaseTable from "@/Components/BaseTable.vue";
import Pagination from "@/Components/Pagination.vue";
import { router } from "@inertiajs/vue3";

let props = defineProps({
    filters: Object,
});

const filters = ref({
    numOfData: props.filters?.numOfData ?? 10,
});

const applyFilter = () => {
    router.get(route("backend.command.index"), filters.value, {
        preserveState: true,
    });
};
</script>

<template>
    <BackendLayout>
        <div class="bg-white p-4 mt-3 shadow rounded">
            <div
                class="d-flex justify-content-between align-items-center p-3 bg-secondary text-white rounded"
            >
                <div class="row w-100 g-2">
                    <div class="col-12 col-md-5">
                        <input
                            id="name"
                            v-model="filters.name"
                            type="text"
                            class="form-control"
                            placeholder="Title"
                            @input="applyFilter"
                        />
                    </div>
                </div>
                <div class="d-none d-md-block">
                    <select
                        v-model="filters.numOfData"
                        @change="applyFilter"
                        class="form-select"
                    >
                        <option value="10">show 10</option>
                        <option value="20">show 20</option>
                        <option value="30">show 30</option>
                        <option value="40">show 40</option>
                        <option value="100">show 100</option>
                        <option value="150">show 150</option>
                        <option value="500">show 500</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive my-3">
                <BaseTable />
            </div>
            <Pagination />
        </div>
    </BackendLayout>
</template>
