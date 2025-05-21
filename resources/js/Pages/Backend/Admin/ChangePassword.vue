<script setup>
import { ref } from "vue";
import BackendLayout from "@/Layouts/BackendLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import AlertMessage from "@/Components/AlertMessage.vue";
import InputError from "@/Components/InputError.vue"; // Import the InputError component
import { displayResponse, displayWarning } from "@/responseMessage.js";

// Define the props for the component
const props = defineProps(["user", "id"]);

// Create a reactive form object using Inertia's useForm
const form = useForm({
    current_password: "",
    new_password: "",
    new_password_confirmation: "",
});

// Submit the form when the user clicks on the submit button
const submit = () => {
    form.post(route("backend.profile.password_update"), {
        onSuccess: (response) => {
            if (!props.id) form.reset();
            displayResponse(response); // Display success message
        },
        onError: (errorObject) => {
            displayWarning(errorObject); // Display error messages
        },
    });
};

// Reset the form and clear errors
const resetForm = () => {
    form.reset(); // Reset form fields
    form.clearErrors(); // Clear validation error messages
};
</script>

<template>
    <BackendLayout>
        <div class="">
            <div class="col-md-12">
                <div class="card dz-card" id="bootstrap-table1">
                   

                    <!-- Change Password Form -->
                    <div class="card-body pt-0">
                        <div class="card-header flex-wrap border-0">
                        <div>
                            <Link
                                :href="route('backend.profile')"
                                type="button"
                                class="btn px-4 py-2 btn-primary btn-sm"
                            >
                                Profile
                            </Link>
                        </div>
                    </div>
                        <form @submit.prevent="submit" class="p-4">
                            <!-- Alert Messages -->
                            <AlertMessage />

                            <!-- Current Password -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Current Password</label>
                                    <input 
                                        type="password" 
                                        class="form-control" 
                                        v-model="form.current_password" 
                                        required 
                                    />
                                    <InputError :message="form.errors.current_password" />
                                </div>
                            </div>

                            <!-- New Password -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">New Password</label>
                                    <input 
                                        type="password" 
                                        class="form-control" 
                                        v-model="form.new_password" 
                                        required 
                                    />
                                    <InputError :message="form.errors.new_password" />
                                </div>
                            </div>

                            <!-- Confirm New Password -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Confirm New Password</label>
                                    <input 
                                        type="password" 
                                        class="form-control" 
                                        v-model="form.new_password_confirmation" 
                                        required 
                                    />
                                    <InputError :message="form.errors.new_password_confirmation" />
                                </div>
                            </div>

                            <!-- Submit and Reset Buttons -->
                            <div class="d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <button type="button" @click="resetForm" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BackendLayout>
</template>
