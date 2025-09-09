<script setup>
import { ref, onMounted } from "vue";
import BackendLayout from "@/Layouts/BackendLayout.vue";
import { Link, router, useForm, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AlertMessage from "@/Components/AlertMessage.vue";
import { displayResponse, displayWarning } from "@/responseMessage.js";

const props = defineProps(["websitemenu", "id", "countedData", "parentMenus"]);

const form = useForm({
  name: props.websitemenu?.name ?? "",
  parent_id: props.websitemenu?.parent_id ?? "",
  order: props.websitemenu?.order ?? "",
  status: props.websitemenu?.status ?? "",
  imagePreview: props.websitemenu?.image ?? "",
  filePreview: props.websitemenu?.file ?? "",
  _method: props.websitemenu?.id ? "put" : "post",
});

const submit = () => {
  const routeName = props.id
    ? route("backend.websitemenu.update", props.id)
    : route("backend.websitemenu.store");
  form
    .transform((data) => ({
      ...data,
      remember: "",
      isDirty: false,
    }))
    .post(routeName, {
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
              :href="route('backend.websitemenu.index')"
              type="button"
              class="btn btn-primary"
            >
              View WebsiteMenu List
              <span class="badge text-bg-light ms-2 mb-0">{{
                countedData
              }}</span>
            </Link>
          </div>
          <div class="card-body">
            <AlertMessage />
            <form @submit.prevent="submit">
              <div class="row g-3">
                <div class="col-md-6">
                  <InputLabel for="name" value="Name" />
                  <input
                    id="name"
                    class="form-control"
                    v-model="form.name"
                    type="text"
                    placeholder="Name"
                  />
                  <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="col-md-6">
                  <InputLabel for="parent_id" value="Parent Menu (Optional)" />
                  <select
                    id="parent_id"
                    class="form-control"
                    v-model="form.parent_id"
                  >
                    <option value="">None</option>
                    <option
                      v-for="parent in parentMenus"
                      :key="parent.id"
                      :value="parent.id"
                    >
                      {{ parent.name }}
                    </option>
                  </select>
                  <InputError class="mt-2" :message="form.errors.parent_id" />
                </div>

                <div class="col-md-6">
                  <InputLabel for="order" value="Order" />
                  <input
                    id="order"
                    class="form-control"
                    v-model="form.order"
                    type="text"
                    placeholder="Order"
                  />
                  <InputError class="mt-2" :message="form.errors.order" />
                </div>

                <div class="col-md-6">
                  <InputLabel for="status" value="Status" />
                  <select
                    id="status"
                    class="form-control"
                    v-model="form.status"
                  >
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                  </select>
                  <InputError class="mt-2" :message="form.errors.status" />
                </div>
              </div>
              <div class="d-flex justify-content-end mt-4">
                <PrimaryButton
                  type="submit"
                  class="ms-4"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  {{ props.id ?? false ? "Update" : "Create" }}
                </PrimaryButton>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </BackendLayout>
</template>
