<script setup>
import { ref, onMounted } from "vue";
import BackendLayout from "@/Layouts/BackendLayout.vue";
import { Link, router, useForm, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AlertMessage from "@/Components/AlertMessage.vue";
import { displayResponse, displayWarning } from "@/responseMessage.js";

const props = defineProps(["websitepage", "id", "countedData"   , "menus"
]);

const form = useForm({
  menu_id: props.websitepage?.menu_id ?? "",

  name: props.websitepage?.name ?? "",

  slug: props.websitepage?.slug ?? "",

  status: props.websitepage?.status ?? "",
  imagePreview: props.websitepage?.image ?? "",
  filePreview: props.websitepage?.file ?? "",
  _method: props.websitepage?.id ? "put" : "post",
});



const submit = () => {
  const routeName = props.id
    ? route("backend.websitepage.update", props.id)
    : route("backend.websitepage.store");
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
              :href="route('backend.websitepage.index')"
              type="button"
              class="btn btn-primary"
            >
              View WebsitePage List <span
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
            <div class="form-group">
                <label for="menu_id"
                    >Menu</label
                >
                <select
                    id="menu_id"
                    class="form-control"
                    v-model="form.menu_id"
                >
                    <option value="">
                        --Select Menu--
                    </option>
                    <template
                        v-for="menu in  menus"
                    >
                        <option
                            :value="menu.id"
                        >   
    {{ menu.name }}                                                                         
                        </option>
                    </template>
                </select>
                <InputError
                    class="mt-2"
                    :message="
                        form.errors.menu_id
                    "
                />
            </div>
        </div>

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
