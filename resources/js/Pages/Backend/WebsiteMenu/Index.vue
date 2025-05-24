<script setup>
    import { ref } from "vue";
    import BackendLayout from '@/Layouts/BackendLayout.vue';
    import BaseTable from '@/Components/BaseTable.vue';
    import Pagination from '@/Components/Pagination.vue';
    import { Link, router } from '@inertiajs/vue3';

    let props = defineProps({
        filters: Object,
        menus: {
            type: Array,
            required: true
        }
    });

    const filters = ref({
        numOfData: props.filters?.numOfData ?? 10,
    });

    const applyFilter = () => {
        router.get(route('backend.websitemenu.index'), filters.value, { preserveState: true });
    };

    const deleteMenu = (id) => {
        if (confirm('Are you sure you want to delete this menu item?')) {
            router.delete(route('website.menus.destroy', id));
        }
    };
</script>

<template>
    <BackendLayout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Website Menu List</h3>
                            <div class="card-tools">
                                <Link :href="route('backend.websitemenu.create')" class="btn btn-primary">
                                    Add New Menu
                                </Link>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Order</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="menu in menus" :key="menu.id">
                                            <!-- Parent Menu -->
                                            <tr>
                                                <td>{{ menu.name }}</td>
                                                <td>{{ menu.slug }}</td>
                                                <td>{{ menu.order }}</td>
                                                <td>
                                                    <span :class="['badge', menu.status === 'Active' ? 'badge-success' : 'badge-danger']">
                                                        {{ menu.status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <Link :href="route('backend.websitemenu.edit', menu.id)" class="btn btn-sm btn-info">
                                                        Edit
                                                    </Link>
                                                    <button @click="deleteMenu(menu.id)" class="btn btn-sm btn-danger">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- Child Menus -->
                                            <template v-if="menu.children && menu.children.length">
                                                <tr v-for="child in menu.children" :key="child.id" class="bg-light">
                                                    <td class="pl-4">
                                                        <i class="fas fa-level-down-alt mr-2"></i>
                                                        {{ child.name }}
                                                    </td>
                                                    <td>{{ child.slug }}</td>
                                                    <td>{{ child.order }}</td>
                                                    <td>
                                                        <span :class="['badge', child.status === 'Active' ? 'badge-success' : 'badge-danger']">
                                                            {{ child.status }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <Link :href="route('backend.websitemenu.edit', child.id)" class="btn btn-sm btn-info">
                                                            Edit
                                                        </Link>
                                                        <button @click="deleteMenu(child.id)" class="btn btn-sm btn-danger">
                                                            Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BackendLayout>
</template>

