<script setup>
import { ref, onMounted } from "vue";
import BackendLayout from "@/Layouts/BackendLayout.vue";
import { Link, router, useForm, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AlertMessage from "@/Components/AlertMessage.vue";
import { displayResponse, displayWarning } from "@/responseMessage.js";

const props = defineProps(["websitepage", "id", "countedData", "menus", "groupedComponentFiles"]);
const showModal = ref(false);
const activeTab = ref(Object.keys(props.groupedComponentFiles)[0] || '');
const selectedComponents = ref([]);
const showPreview = ref({});

const form = useForm({
    menu_id: props.websitepage?.menu_id ?? "",
    name: props.websitepage?.name ?? "",
    slug: props.websitepage?.slug ?? "",
    status: props.websitepage?.status ?? "",
    imagePreview: props.websitepage?.image ?? "",
    filePreview: props.websitepage?.file ?? "",
    _method: props.websitepage?.id ? "put" : "post",
});

const openModal = () => {
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
};

const togglePreview = (componentName) => {
    showPreview.value[componentName] = !showPreview.value[componentName];
};

const handleComponentSelect = (component) => {
    const index = selectedComponents.value.indexOf(component);
    if (index === -1) {
        selectedComponents.value.push(component);
    } else {
        selectedComponents.value.splice(index, 1);
    }
};

const submit = () => {
    const routeName = props.id
        ? route("backend.websitepage.update", props.id)
        : route("backend.websitepage.store");
    form.transform((data) => ({
        ...data,
        remember: "",
        isDirty: false,
    })).post(routeName, {
        onSuccess: (response) => {
            if (!props.id) form.reset();
            displayResponse(response);
        },
        onError: (errorObject) => {
            displayWarning(errorObject);
        },
    });
};
</script>

<template>
    <BackendLayout>
        <div class="row">
            <div class="col-xl-12">
                <div class="card" id="bootstrap-table1">
                    <div class="card-header d-flex justify-content-between">
                        <Link
                            :href="route('backend.websitepage.index')"
                            type="button"
                            class="btn btn-primary"
                        >
                            View WebsitePage List
                            <span class="badge text-bg-light ms-2 mb-0">{{
                                countedData
                            }}</span>
                        </Link>
                    </div>
                    <div class="card-body">
                        <AlertMessage />
                        <form @submit.prevent="submit">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <InputLabel for="name" value="Name" />
                                    <input
                                        id="name"
                                        class="form-control"
                                        v-model="form.name"
                                        type="text"
                                        placeholder="Name"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.name"
                                    />
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="menu_id">Menu</label>
                                        <select
                                            id="menu_id"
                                            class="form-control"
                                            v-model="form.menu_id"
                                        >
                                            <option value="">
                                                --Select Menu--
                                            </option>
                                            <option value="no_menu">
                                                --Not Attached With Menu--
                                            </option>
                                            <template v-for="menu in menus" :key="menu.id">
                                                <option :value="menu.id">
                                                    {{ menu.name }}
                                                </option>
                                            </template>
                                        </select>
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.menu_id"
                                        />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <InputLabel for="slug" value="Slug" />
                                    <input
                                        id="slug"
                                        class="form-control"
                                        v-model="form.slug"
                                        type="text"
                                        placeholder="Slug"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.slug"
                                    />
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                               <button type="button" class="btn btn-primary" @click="openModal">Add Section</button>
                            </div>

                            <!-- Modal -->
                            <div v-if="showModal" class="modal fade show" style="display: block;" tabindex="-1">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Select Components</h5>
                                            <button type="button" class="btn-close" @click="closeModal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Tabs -->
                                            <ul class="nav nav-tabs" id="componentTabs" role="tablist">
                                                <li v-for="(files, group) in groupedComponentFiles"
                                                    :key="group"
                                                    class="nav-item"
                                                    role="presentation">
                                                    <button class="nav-link"
                                                            :class="{ active: activeTab === group }"
                                                            @click="activeTab = group"
                                                            type="button">
                                                        {{ group || 'Root' }}
                                                    </button>
                                                </li>
                                            </ul>

                                            <!-- Tab Content -->
                                            <div class="tab-content mt-3">
                                                <div v-for="(files, group) in groupedComponentFiles"
                                                     :key="group"
                                                     :class="{ 'd-none': activeTab !== group }">
                                                    <div class="row">
                                                        <div v-for="file in files"
                                                             :key="file.name"
                                                             class="col-md-6 mb-3">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                   type="checkbox"
                                                                                   :id="file.name"
                                                                                   :checked="selectedComponents.includes(file.name)"
                                                                                   @change="handleComponentSelect(file.name)">
                                                                            <label class="form-check-label" :for="file.name">
                                                                                {{ file.name }}
                                                                            </label>
                                                                        </div>
                                                                        <button type="button"
                                                                                class="btn btn-sm btn-outline-primary"
                                                                                @click="togglePreview(file.name)">
                                                                            {{ showPreview[file.name] ? 'Hide Preview' : 'Show Preview' }}
                                                                        </button>
                                                                    </div>
                                                                    <div v-if="showPreview[file.name]" class="preview-content mt-2">
                                                                        <div class="preview-header mb-2">
                                                                            <small class="text-muted">Preview:</small>
                                                                        </div>
                                                                        <div class="preview-body border rounded p-2 bg-light">
                                                                            <div v-html="file.content"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" @click="closeModal">Close</button>
                                            <button type="button" class="btn btn-primary">Add Selected Components</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="showModal" class="modal-backdrop fade show"></div>

                            <div class="d-flex justify-content-end mt-4">
                                <PrimaryButton
                                    type="submit"
                                    class="ms-4"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    {{
                                        props.id ?? false ? "Update" : "Create"
                                    }}
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BackendLayout>
</template>

<style scoped>
.modal-backdrop {
    background-color: rgba(0, 0, 0, 0.5);
}

.nav-tabs .nav-link {
    color: #6c757d;
}

.nav-tabs .nav-link.active {
    color: #0d6efd;
    font-weight: 500;
}

.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.preview-content {
    max-height: 300px;
    overflow-y: auto;
}

.preview-body {
    font-size: 0.875rem;
}

.modal-xl {
    max-width: 90%;
}
</style>
