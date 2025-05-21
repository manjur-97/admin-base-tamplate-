<script setup>
import { ref, onMounted, computed } from "vue";
import BackendLayout from "@/Layouts/BackendLayout.vue";
import { Link, router, useForm, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AlertMessage from "@/Components/AlertMessage.vue";
import { displayResponse, displayWarning } from "@/responseMessage.js";

const props = defineProps(["role", "permissions", "id", "groupedRoutes", "ExistingRolePermissions"]);

const checkedRoutes = ref([]); // To hold selected routes (permissions)

// Initialize checked routes from existing permissions
onMounted(() => {
  if(props.id){
    props.ExistingRolePermissions.forEach(permission => {
    // Find matching route in groupedRoutes
    Object.keys(props.groupedRoutes).forEach(controllerName => {
      props.groupedRoutes[controllerName].forEach(route => {
        if (route.uri === permission.uri && route.controller_function === permission.controller_function) {
          // Pre-check the matching route
          checkedRoutes.value.push(route);
        }
      });
    });
  });
  }
 
});
if (props.id && props.groupedRoutes['DashboardController']) {
  props.groupedRoutes['DashboardController'].forEach(route => {
    checkedRoutes.value.push(route);
  });
}

// Function to check if all routes are selected for a controller
const areAllSelected = (controllerRoutes) => {
  return controllerRoutes.every((route) => checkedRoutes.value.includes(route));
};

// Function to toggle select all routes
const toggleSelectAll = (controllerRoutes) => {
  const allSelected = areAllSelected(controllerRoutes);

  if (allSelected) {
    // Unselect all if currently all are selected
    controllerRoutes.forEach((route) => {
      const index = checkedRoutes.value.indexOf(route);
      if (index !== -1) {
        checkedRoutes.value.splice(index, 1);
      }
    });
  } else {
    // Select all if not currently all are selected
    controllerRoutes.forEach((route) => {
      if (!checkedRoutes.value.includes(route)) {
        checkedRoutes.value.push(route);
      }
    });
  }
};

// Set up the form object with initial values
const form = useForm({
  id: props.id,
  name: props.role?.name ?? "", // Role name
  guard_name: props.role?.guard_name ?? "admin", // Guard name (default to 'admin')
  permission_ids: props.role?.permission_ids ?? [], // Pre-select permissions if editing
  _method: props.role?.id ? "put" : "post", // Check if updating or creating
});

// Function to handle form submission
const submit = () => {
  // Set the route for either update or store
  const routeName = props.id
    ? route("backend.role.update", props.id)
    : route("backend.role.store");

  // Include the selected permissions (checked routes) in the form data
  form
    .transform((data) => ({
      ...data,
      checkedRoutes: checkedRoutes.value, // Map routes to their URIs
    }))
    .post(routeName, {
      onSuccess: (response) => {
        // Reset the form if creating a new role (no props.id)
        if (!props.id) form.reset();

        displayResponse(response); // Handle success response (custom function)
      },
      onError: (errorObject) => {
        displayWarning(errorObject); // Handle error response (custom function)
      },
    });
};

// Computed property for checked permissions
const checkedPermissions = computed({
  get: () => form.permission_ids,
  set: (newValue) => (form.permission_ids = newValue),
});
</script>
<template>
  <BackendLayout>
    <div class="row">
      <!-- Role Form -->
      <div class="col-xl-12">
        <div class="card dz-card">
          <div class="card-header">
            <Link :href="route('backend.role.index')" class="btn btn-primary">
              View Role List
            </Link>
          </div>

          <div class="card-body">
            <form @submit.prevent="submit">
              <AlertMessage />

              <!-- Role Name Input -->
              <div class="row g-3">
                <div class="col-md-6">
                  <InputLabel for="name" value="Role Name" />
                  <input v-model="form.name" type="text" class="form-control" placeholder="Role Name" />
                  <InputError :message="form.errors.name" />
                </div>

                <!-- Guard Name Input -->
                <div class="col-md-6">
                  
                  <InputLabel for="guard_name" value="Guard Name" />
                  <input v-model="form.guard_name" type="text"  class="form-control" readonly />
                  <InputError :message="form.errors.guard_name" />
                </div>
              </div>

              <!-- Permissions Section -->
              <div class="w-full mt-3" v-if="props.id" >
                <InputLabel for="permissions" value="Permissions" />
                <div class="row g-2">
                  <template v-for="(controllerRoutes, controllerName) in groupedRoutes" :key="controllerName">
                    <div class="col-md-4">
                      <div class="card p-2">
                        <div class="card-header py-1 d-flex align-items-center">
                          <!-- Select All Checkbox for the Controller -->
                          <input type="checkbox" :checked="areAllSelected(controllerRoutes)" @change="toggleSelectAll(controllerRoutes)" />
                          <h6 class="mb-0">{{ controllerName }}</h6>
                        </div>

                        <div class="card-body p-2">
                          <ul class="list-group list-group-flush">
                            <!-- Route Checkboxes -->
                            <li v-for="route in controllerRoutes" :key="route.uri" class="list-group-item py-1 px-2 d-flex align-items-center">
                              <input type="checkbox" v-model="checkedRoutes" :value="route" class="form-check-input me-2" />
                              <small>
                                {{ route.name }}
                              </small>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </template>
                </div>
              </div>

              <!-- Submit Button -->
              <div class="d-flex justify-content-end mt-4">
                <PrimaryButton :disabled="form.processing">{{ props.id ? "Update" : "Create" }}</PrimaryButton>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </BackendLayout>
</template>

<style scoped>
/* Custom raw CSS styles */
h3 {
  margin: 0.5rem 0;
}

.font-weight-bold {
  font-weight: bold;
}

.text-primary {
  color: #007bff; /* Bootstrap primary color */
}

.text-success {
  color: #28a745; /* Bootstrap success color */
}

.opacity-50 {
  opacity: 0.5;
}
</style>
