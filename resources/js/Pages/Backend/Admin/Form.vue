<script setup>
import { ref, onMounted } from "vue";
import BackendLayout from "@/Layouts/BackendLayout.vue";
import {Link, router, useForm, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AlertMessage from "@/Components/AlertMessage.vue";
import { displayResponse, displayWarning } from "@/responseMessage.js";

const props = defineProps(["user", "id", "roles", 'countedData']);

const form = useForm({
    first_name: props.user?.first_name ?? "",
    last_name: props.user?.last_name ?? "",
    email: props.user?.email ?? "",
    photo: "",
    photoPreview: props.user?.photo ?? "",
    phone: props.user?.phone ?? "",
    role_id: props.user?.role_id ?? "",
    password: "",

    address: props.user?.address ?? "",
    _method: props.user?.id ? "put" : "post",
});

const handlePhotoChange = (event) => {
    const file = event.target.files[0];
    form.photo = file;

    // Display photo preview
    const reader = new FileReader();
    reader.onload = (e) => {
        form.photoPreview = e.target.result;
    };
    reader.readAsDataURL(file);
};

const submit = () => {
    const routeName = props.id
        ? route("backend.user.update", props.id)
        : route("backend.user.store");
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
            <!-- Column starts -->
            <div class="col-xl-12">
                <div class="card dz-card" id="bootstrap-table1">
                    <div class="card-header flex-wrap border-0">
                        <div>
                            <Link
                                :href="route('backend.user.index')"
                                type="button"
                                class="btn px-4 py-2 btn-primary"
                            >
                                View User List<span
                                    class="badge text-bg-light ms-2 mb-0"
                                    >{{ countedData }}</span
                                >
                            </Link>
                        </div>
                    </div>
                    <!--tab-content-->
                    <div class="tab-content" id="myTabContent">
                        <div
                            class="tab-pane fade active show"
                            id="Preview"
                            role="tabpanel"
                            aria-labelledby="home-tab"
                        >
                            <div class="card-body pt-0">
                                <form @submit.prevent="submit" class="p-4">
                                    <AlertMessage />
                                    <div class="row">


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first_name"
                                                    >First Name</label
                                                >
                                                <input
                                                    id="first_name"
                                                    class="form-control"
                                                    v-model="form.first_name"
                                                    type="text"
                                                    placeholder="First Name"
                                                />
                                                <InputError
                                                    class="mt-2"
                                                    :message="
                                                        form.errors.first_name
                                                    "
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="last_name"
                                                    >Last Name</label
                                                >
                                                <input
                                                    id="last_name"
                                                    class="form-control"
                                                    v-model="form.last_name"
                                                    type="text"
                                                    placeholder="Last Name"
                                                />
                                                <InputError
                                                    class="mt-2"
                                                    :message="
                                                        form.errors.last_name
                                                    "
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input
                                                    id="email"
                                                    class="form-control"
                                                    v-model="form.email"
                                                    type="email"
                                                    placeholder="Email"
                                                />
                                                <InputError
                                                    class="mt-2"
                                                    :message="form.errors.email"
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input
                                                    id="phone"
                                                    class="form-control"
                                                    v-model="form.phone"
                                                    type="text"
                                                    placeholder="Phone"
                                                />
                                                <InputError
                                                    class="mt-2"
                                                    :message="form.errors.phone"
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role_id"
                                                    >Role</label
                                                >
                                                <select
                                                    id="role_id"
                                                    class="form-control"
                                                    v-model="form.role_id"
                                                >
                                                    <option value="">
                                                        --Select Role--
                                                    </option>
                                                    <template
                                                        v-for="role in roles"
                                                    >
                                                        <option
                                                            :value="role.id"
                                                        >
                                                            {{ role.name }}
                                                        </option>
                                                    </template>
                                                </select>
                                                <InputError
                                                    class="mt-2"
                                                    :message="
                                                        form.errors.role_id
                                                    "
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-6" v-if="!props.user?.id">
                                            <div class="form-group">
                                                <label for="password"
                                                    >Password</label
                                                >
                                                <input
                                                    id="password"
                                                    class="form-control"
                                                    v-model="form.password"
                                                    type="password"
                                                    placeholder="Password"
                                                />
                                                <InputError
                                                    class="mt-2"
                                                    :message="
                                                        form.errors.password
                                                    "
                                                />
                                            </div>
                                        </div>

                                        <div class=" col-12">
                                            <div class="form-group">
                                                <label for="address"
                                                    >Address</label
                                                >
                                                <textarea
                                                    id="address"
                                                    class="form-control"
                                                    v-model="form.address"
                                                    placeholder="Address"
                                                ></textarea>
                                                <InputError
                                                    class="mt-2"
                                                    :message="
                                                        form.errors.address
                                                    "
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="photo">Photo</label>
                                                <div v-if="form.photoPreview">
                                                    <img
                                                        :src="form.photoPreview"
                                                        alt="Photo Preview"
                                                        class="img-thumbnail mb-2"
                                                        height="60"
                                                        width="60"
                                                    />
                                                </div>
                                                <input
                                                    id="photo"
                                                    type="file"
                                                    accept="image/*"
                                                    class="form-control"
                                                    @change="handlePhotoChange"
                                                />
                                                <InputError
                                                    class="mt-2"
                                                    :message="form.errors.photo"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="d-flex justify-content-end mt-4"
                                    >
                                        <PrimaryButton
                                            type="submit"
                                            class="ms-2"
                                            :class="{
                                                'opacity-25': form.processing,
                                            }"
                                            :disabled="form.processing"
                                        >
                                            {{
                                                props.id ?? false
                                                    ? "Update"
                                                    : "Create"
                                            }}
                                        </PrimaryButton>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--/tab-content-->
                </div>
            </div>
        </div>
    </BackendLayout>
</template>
