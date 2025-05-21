<script setup>
import BackendLayout from "@/Layouts/BackendLayout.vue";
import { Link } from "@inertiajs/vue3";
import { defineProps } from "vue";

const props = defineProps({
  user: {
    type: Object,
    default: () => null, // Ensure user is null initially, if not passed
  },
  role: {
    type: Object,
    default: () => null, // Ensure user is null initially, if not passed
  },
});

const uploadFile = (event) => {
  const file = event.target.files[0];
  // Handle file upload logic here
};
</script>

<template>
  <BackendLayout>
    <div v-if="user" class="row">
      <!-- Left Column - User Info -->
      <div class="col-xl-3 col-lg-4">
        <div class="clearfix">
          <div class="card card-bx profile-card author-profile m-b30">
            <div class="card-body">
              <div class="p-5">
                <div class="author-profile">
                  <div class="author-media">
                    <img
                      :src="
                        $page.props.auth.admin && $page.props.auth.admin.photo
                          ? $page.props.auth.admin.photo
                          : '/images/profile.png'
                      "
                      alt="User Profile"
                      height="130px"
                      width="200px"
                    />
                  </div>
                  <div class="author-info">
                    <h6 class="title">
                      {{ user.first_name }} {{ user.last_name }}
                    </h6>
                    <span>{{ role.name }}</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <Link :href="route('backend.profile.change_password')">
                <div class="input-group mb-3">
                  <div class="form-control text-center bg-white">
                    Change Password
                  </div>
                </div>
              </Link>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column - Account Setup Form -->
      <div class="col-xl-9 col-lg-8">
        <div class="card profile-card card-bx m-b30">
          <div class="card-header">
            <h6 class="title">Account info</h6>
          </div>
          <form class="profile-form">
            <div class="card-body">
              <div class="row">
                <!-- First Name -->
                <div class="col-sm-6 m-b30">
                  <label class="form-label">First Name</label>
                  <input
                    type="text"
                    class="form-control"
                    readonly
                    v-model="user.first_name"
                  />
                </div>

                <!-- Last Name -->
                <div class="col-sm-6 m-b30">
                  <label class="form-label">Last Name</label>
                  <input
                    type="text"
                    class="form-control"
                    readonly
                    v-model="user.last_name"
                  />
                </div>

                <div class="col-sm-6 m-b30">
                  <label class="form-label">Role</label>
                  <input
                    type="text"
                    class="form-control"
                    readonly
                    v-model="role.name"
                  />
                </div>
                <div class="col-sm-6 m-b30">
                  <label class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    readonly
                    v-model="user.email"
                  />
                </div>

                <div class="col-sm-6 m-b30">
                  <label class="form-label">Mobile</label>
                  <input
                    type="text"
                    class="form-control"
                    readonly
                    v-model="user.phone"
                  />
                </div>
                <div class="col-sm-6 m-b30">
                  <label class="form-label">Status</label>
                  <input
                    type="button"
                    class="form-control bg-primary text-light"
                    readonly
                    v-model="user.status"
                  />
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Loading Placeholder -->
    <div v-else>Information not found.</div>
  </BackendLayout>
</template>
