<script setup>
import { ref, onMounted } from "vue";
import BackendLayout from "@/Layouts/BackendLayout.vue";
import { Link, router, useForm, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AlertMessage from "@/Components/AlertMessage.vue";
import { displayResponse, displayWarning } from "@/responseMessage.js";

const props = defineProps(["websitemenu", "id", "countedData"
]);

const form = useForm({
  name: props.websitemenu?.name ?? "",

  slug: props.websitemenu?.slug ?? "",

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
              View WebsiteMenu List <span
                                class="badge text-bg-light ms-2 mb-0"
                                >{{ countedData }}</span
                            >
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
  <InputLabel for="slug" value="Slug" />
  <input
    id="slug"
    class="form-control"
    v-model="form.slug"
    type="text"
    placeholder="Slug"
  />
  <InputError class="mt-2" :message="form.errors.slug" />
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
