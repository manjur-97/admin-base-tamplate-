<template>
    <BackendLayout>
        <div class="row">
            <div class="col-xl-12">
                <div class="card dz-card">
                    <div class="card-header flex-wrap border-0">
                        <div>
                            <h4 class="card-title">Footer Settings</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <AlertMessage />
                        <!-- Error Alert -->
                        <div
                            v-if="error"
                            class="alert alert-danger alert-dismissible fade show"
                            role="alert"
                        >
                            {{ error }}
                            <button
                                type="button"
                                class="btn-close"
                                @click="error = ''"
                            ></button>
                        </div>
                        <div class="row">
                            <div
                                v-for="footer in footers"
                                :key="footer.id"
                                class="col-md-12"
                            >
                                <div class="h-100">
                                    <div class="card-body">
                                        <div
                                            class="d-flex align-items-center justify-content-between mb-3"
                                        >
                                            <div class="form-check">
                                                <input
                                                    type="radio"
                                                    class="form-check-input"
                                                    :checked="footer.is_active"
                                                    @change="
                                                        handleFooterSelect(
                                                            footer
                                                        )
                                                    "
                                                    name="footer_selection"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    >{{ footer.name }}</label
                                                >
                                            </div>
                                            <button
                                                @click="handlePreview(footer)"
                                                class="btn btn-primary btn-sm"
                                            >
                                                View Code
                                            </button>
                                        </div>
                                        <div class="footer-preview-container">
                                            <div
                                                v-html="footer.content"
                                                class="tailwind-preview"
                                            ></div>
                                        </div>
                                    </div>
                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preview Modal -->
        <div v-if="isPreviewOpen" class="modal-backdrop fade show"></div>
        <div v-if="isPreviewOpen" class="modal fade show d-block" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ selectedFooter?.name }} Code
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            @click="closePreview"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <pre
                                class="mb-0"
                            ><code>{{ selectedFooter?.content }}</code></pre>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            @click="closePreview"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </BackendLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import BackendLayout from "@/Layouts/BackendLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import AlertMessage from "@/Components/AlertMessage.vue";

const props = defineProps({
    footers: {
        type: Array,
        required: true,
    },
});

const isPreviewOpen = ref(false);
const selectedFooter = ref(null);
const error = ref("");

const form = useForm({
    footer: "",
    file_name: "",
});

const handlePreview = (footer) => {
    selectedFooter.value = footer;
    isPreviewOpen.value = true;
    document.body.style.overflow = "hidden";
};

const handleFooterSelect = (footer) => {
    error.value = ""; // Clear previous error
    form.footer = footer.content;
    form.file_name = footer.file_name;
    form.post(route("cms.settings.save-footer"), {
        preserveScroll: true,
        onSuccess: () => {
            // Update active state in footers array
            props.footers.forEach((f) => {
                f.is_active = f.id === footer.id;
            });
        },
        onError: (errors) => {
            error.value =
                errors.footer || "Something went wrong. Please try again.";
        },
    });
};

const closePreview = () => {
    isPreviewOpen.value = false;
    selectedFooter.value = null;
    document.body.style.overflow = "";
};

onMounted(() => {
    // Add Tailwind CSS Script
    const tailwindScript = document.createElement("script");
    tailwindScript.src = "https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4";
    document.head.appendChild(tailwindScript);
});
</script>

<style scoped>
.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1040;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.5);
}
.modal {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1050;
    width: 100%;
    height: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    outline: 0;
}
.footer-preview-container {
    border: 1px solid #e2e8f0;
    border-radius: 5px;
    padding: 1rem;
    background-color: #d6d9da;
}
.tailwind-preview {
    min-height: 100px;
    overflow: hidden;
}
.tailwind-preview :deep(a) {
    text-decoration: none;
    color: inherit;
}
.tailwind-preview :deep(button) {
    cursor: pointer;
}
</style>
