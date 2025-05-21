<script setup>
import { ref, onMounted } from "vue";
import BackendLayout from "@/Layouts/BackendLayout.vue";
import { router, useForm, usePage, Link } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AlertMessage from "@/Components/AlertMessage.vue";
import { displayResponse, displayWarning } from "@/responseMessage.js";

const props = defineProps(["menu", "id"]);

const form = useForm({
  name: props.menu?.name ?? "",

  icon: props.menu?.icon ?? "",

  route: props.menu?.route ?? "",

  description: props.menu?.description ?? "",

  sorting: props.menu?.sorting ?? "",

  parent_id: props.menu?.parent_id ?? "",

  permission_name: props.menu?.permission_name ?? "",

  status: props.menu?.status ?? "",
 
  _method: props.menu?.id ? "put" : "post",
});


const submit = () => {
  const routeName = props.id
    ? route("backend.menu.update", props.id)
    : route("backend.menu.store");
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
      <!-- Column starts -->
      <div class="col-xl-12">
        <div class="card dz-card" id="bootstrap-table1">
          <div class="card-header flex-wrap border-0">
            <div>
              <Link
                :href="route('backend.menu.index')"
                type="button"
                class="btn px-4 py-2 btn-primary"
              >
                View Menu List
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
                  <div
                    class="row"
                  >
                    <div class="col-6  mt-2">
                      <InputLabel for="name" value="Name" />
                      <input
                        id="name"
                        class="form-control"
                        v-model="form.name"
                        type="text"
                       
                      />
                      <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="col-6  mt-2">
                      <InputLabel for="icon" value="Icon" />
                      <input
                        id="icon"
                        class="form-control"
                        v-model="form.icon"
                        type="text"
                       
                      />
                      <InputError class="mt-2" :message="form.errors.icon" />
                    </div>

                    <div class="col-6  mt-2">
                      <InputLabel for="route" value="Route" />
                      <input
                        id="route"
                        class="form-control"
                        v-model="form.route"
                        type="text"
                       
                      />
                      <InputError class="mt-2" :message="form.errors.route" />
                    </div>

                    <div class="col-6  mt-2">
                      <InputLabel for="description" value="Description" />
                      <input
                        id="description"
                        class="form-control"
                        v-model="form.description"
                        type="text"
                       
                      />
                      <InputError
                        class="mt-2"
                        :message="form.errors.description"
                      />
                    </div>

                    <div class="col-6  mt-2">
                      <InputLabel for="sorting" value="Sorting" />
                      <input
                        id="sorting"
                        class="form-control"
                        v-model="form.sorting"
                        type="text"
                      
                      />
                      <InputError class="mt-2" :message="form.errors.sorting" />
                    </div>

                    <div class="col-6  mt-2">
                      <InputLabel for="parent_id" value="Parent?" />
                      <input
                        id="parent_id"
                        class="form-control"
                        v-model="form.parent_id"
                        type="text"
                       
                      />
                      <InputError
                        class="mt-2"
                        :message="form.errors.parent_id"
                      />
                    </div>

                    <div class="col-6  mt-2">
                      <InputLabel
                        for="permission_name"
                        value="Permission name"
                      />
                      <input
                        id="permission_name"
                        class="form-control"
                        v-model="form.permission_name"
                        type="text"
                       
                      />
                      <InputError
                        class="mt-2"
                        :message="form.errors.permission_name"
                      />
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
          <!--/tab-content-->
        </div>
      </div>
    </div>
  
  </BackendLayout>
</template>

