<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import BackendLayout from "@/Layouts/BackendLayout.vue";
import BarChart from "@/Components/Chart/BarChart.vue";
import PieChart from "@/Components/Chart/PieChart.vue";
import DoughnutChart from "@/Components/Chart/DoughnutChart.vue";
import LineChart from "@/Components/Chart/LineChart.vue";
import PolarAreaChart from "@/Components/Chart/PolarAreaChart.vue";
import EmpLineChart from "@/Components/Chart/EmpLineChart.vue";
import RadarChart from "@/Components/Chart/RadarChart.vue";
import { displayResponse } from "@/responseMessage.js";
import { ref, onMounted } from "vue";

const props = defineProps(["dashboardData", "flash", "employee" ,'totalCompanyLeave', 'previousYearUnusedLeave', 'currentLeaveCounts']);


onMounted(() => {
  if (props.flash?.errorMessage) {
    displayResponse({
      props: { flash: { errorMessage: props.flash.errorMessage } },
    });
  }
});
const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  terms: false,
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};

const imageUrl = "/images/e57b987df5b29f59db3eb669499154ee.jpg";

// Extract attendance status
const attendanceStatus =
  props.dashboardData?.attendanceStatus?.status || "Unknown";

const statusIcons = {
  "On-time": `<svg width="24" height="24" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="22.9715" cy="22.9715" r="19" stroke="#28a745" stroke-width="2"></circle>
                <path d="M15 22.9715L20 27.9715L30 17.9715" stroke="#28a745" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>`,
  Late: `<svg width="24" height="24" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="22.9715" cy="22.9715" r="19" stroke="#FFA500" stroke-width="2"></circle>
                <path d="M22.9715 12V24L30 28" stroke="#FFA500" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>`,
  Absent: `<svg width="24" height="24" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="22.9715" cy="22.9715" r="19" stroke="#FF0000" stroke-width="2"></circle>
                <line x1="15" y1="15" x2="30" y2="30" stroke="#FF0000" stroke-width="2" stroke-linecap="round"></line>
                <line x1="30" y1="15" x2="15" y2="30" stroke="#FF0000" stroke-width="2" stroke-linecap="round"></line>
              </svg>`,
  Unknown: `<svg width="24" height="24" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="22.9715" cy="22.9715" r="19" stroke="#808080" stroke-width="2"></circle>
                <text x="14" y="25" fill="#808080" font-size="10px">?</text>
              </svg>`,
};

// Function to dynamically assign badge colors based on status
const statusBadge = (status) => {
  switch (status) {
    case "Approve":
      return "badge badge-success";
    case "Pending":
      return "badge badge-secondary";
    case "Reject":
      return "badge badge-danger";
    default:
      return "badge badge-light";
  }
};

const formatDate = (date) => {
  if (!date) return "";
  const d = new Date(date);
  return d.toLocaleDateString("en-US", {
    day: "2-digit",
    month: "long",
    year: "numeric",
  });
};
</script>

<template>
  <BackendLayout>
    <div class="row mt-4">
      <div class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div
                class="icon-box icon-box-lg bg-light rounded-circle"
                v-html="statusIcons[attendanceStatus]"
              ></div>
              <div class="total-projects ms-3">
                <h4
                  :class="{
                    'text-success': attendanceStatus === 'Present',
                    'text-warning': attendanceStatus === 'Late',
                    'text-danger': attendanceStatus === 'Absent',
                    'text-secondary': attendanceStatus === 'Unknown',
                  }"
                >
                  {{ attendanceStatus }}
                </h4>
                <span>Check-in Status</span>
              </div>
            </div>
          </div>
        </div>
        9
      </div>
      <div class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div class="icon-box icon-box-lg bg-warning-light rounded-circle">
                <svg
                  width="24"
                  height="24"
                  viewBox="0 0 46 46"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <circle
                    cx="22.9715"
                    cy="22.9715"
                    r="19"
                    stroke="#F8B940"
                    stroke-width="2"
                  ></circle>
                  <path
                    d="M22.9715 12V24L30 28"
                    stroke="#F8B940"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  ></path>
                </svg>
              </div>
              <div class="total-projects ms-3">
                <h3 class="text-warning count">
                  {{ dashboardData.lateAttendance }}
                </h3>
                <span>Total Late</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div class="icon-box icon-box-lg bg-info-light rounded-circle">
                <svg
                  width="24"
                  height="24"
                  viewBox="0 0 46 46"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <rect
                    x="7"
                    y="10"
                    width="32"
                    height="26"
                    rx="3"
                    stroke="#17A2B8"
                    stroke-width="2"
                  />
                  <path
                    d="M14 6V14"
                    stroke="#17A2B8"
                    stroke-width="2"
                    stroke-linecap="round"
                  />
                  <path
                    d="M32 6V14"
                    stroke="#17A2B8"
                    stroke-width="2"
                    stroke-linecap="round"
                  />
                  <path d="M7 18H39" stroke="#17A2B8" stroke-width="2" />
                  <path
                    d="M19 26L22 29L28 23"
                    stroke="#17A2B8"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
              </div>
              <div class="total-projects ms-3">
                <h3 class="text-info count">
                  {{ dashboardData.totalLeavesThisMonth }}
                </h3>
                <span>Total Leaves</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div class="icon-box icon-box-lg bg-danger-light rounded-circle">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  width="24"
                  height="24"
                >
                  <circle cx="12" cy="12" r="10" />
                  <line x1="9" y1="9" x2="15" y2="15" />
                  <line x1="15" y1="9" x2="9" y2="15" />
                </svg>
              </div>
              <div class="total-projects ms-3">
                <h3 class="text-danger count">
                  {{ dashboardData.absentAttendance }}
                </h3>
                <span>Total Absent</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div class="icon-box icon-box-lg bg-warning-light rounded-circle">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  width="24"
                  height="24"
                >
                  <circle cx="12" cy="12" r="10" />
                  <path d="M12 8v4l2 2" />
                </svg>
              </div>
              <div class="total-projects ms-3">
                <h3 class="text-warning count">
                  {{ dashboardData.loanStats.running_loans_count }}
                </h3>
                <span>Running Loans</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Total Loan Amount -->
      <div class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div class="icon-box icon-box-lg bg-primary-light rounded-circle">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  width="24"
                  height="24"
                >
                  <path d="M5 12h14M12 5v14" />
                </svg>
              </div>
              <div class="total-projects ms-3">
                <h4 class="text-primary count">
                  ৳{{ Math.round(dashboardData.loanStats.total_loan_amount) }}
                </h4>
                <span>Total Loan Amount</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Paid Amount -->
      <div class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div class="icon-box icon-box-lg bg-success-light rounded-circle">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  width="24"
                  height="24"
                >
                  <path d="M5 13l4 4L19 7" />
                </svg>
              </div>
              <div class="total-projects ms-3">
                <h4 class="text-success count">
                  ৳{{ Math.round(dashboardData.loanStats.total_amount_paid) }}
                </h4>
                <span>Paid Amount</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Unpaid Amount -->
      <div class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div class="icon-box icon-box-lg bg-danger-light rounded-circle">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  width="24"
                  height="24"
                >
                  <path d="M12 5v14m-5-5l5-5 5 5" />
                </svg>
              </div>
              <div class="total-projects ms-3">
                <h4 class="text-danger count">
                  ৳{{ Math.round(dashboardData.loanStats.total_amount_unpaid) }}
                </h4>
                <span>Unpaid Amount</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-8">
        <div class="card">
          <div class="fw-bold p-3 text-dark">Employee Overview</div>
          <hr />
          <div class="card-body p-3">
            <div class="row d-flex justify-content-between">
              <div
                class="col-5 d-flex justify-center align-item-center"
                style="
                  border: 1px solid #452b90;
                  border-radius: 10px;
                  height: 220px;
                  width: 220px;

                  margin-left: 15px;
                  overflow: hidden;
                "
              >
                <img :src="imageUrl" class="img-fluid" alt="Employee Image" />
              </div>
              <div class="col-7">
                <h3>{{ employee.name_en }}</h3>
                <p>Designation: {{ employee.designation?.name }}</p>
                <ul>
                  <li>
                    <strong>Email:</strong>
                    {{ employee.email }}
                  </li>
                  <li><strong>Phone:</strong> {{ employee.contact_mobile }}</li>
                  <li>
                    <strong>Department:</strong> {{ employee.department?.name }}
                  </li>
                </ul>
              </div>
            </div>
            <hr />
            <div class="row text-center m-3">
              
              <table class="">
                <thead>
                  <tr>
                    <th rowspan="3">Leave Status</th>
                    <th colspan="5">Type of leave</th>

                    
                  </tr>
                  <tr>
                    <th rowspan="2">Casual</th>
                    <th rowspan="2">Sick</th>
                    <th colspan="3">Earn</th>
                  </tr>
                  <tr>
                    <th>This year</th>
                    <th>Previous</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Entitlement</td>
                    <td>{{ props.totalCompanyLeave.casual }}</td>
                    <td>{{ props.totalCompanyLeave.sick }}</td>
                    <td>{{ props.totalCompanyLeave.earn }}</td>
                    <td>{{ props.previousYearLeaveCount??0 }}</td>
                    <td>
                      {{
                        props.totalCompanyLeave.earn +
                        props.previousYearLeaveCount??0
                      }}
                    </td>
                   
                  </tr>
                  <tr>
                    <td>Availed</td>
                    <td>{{ props.currentLeaveCounts.casual_leave }}</td>
                    <td>{{ props.currentLeaveCounts.sick_leave }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ props.currentLeaveCounts.earn_leave??0 }}</td>
                  </tr>
                  <tr>
                    <td>Leave Available</td>
                    <td>
                      {{
                        props.totalCompanyLeave.casual -
                        props.currentLeaveCounts.casual_leave
                      }}
                    </td>
                    <td>
                      {{
                        props.totalCompanyLeave.sick -
                        props.currentLeaveCounts.sick_leave
                      }}
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                      {{
                        props.totalCompanyLeave.earn +
                        props.previousYearLeaveCount??0 -
                        props.currentLeaveCounts.earn_leave
                      }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <hr />
            <div class="row text-center justify-content-between px-5">
              <div class="row text-center justify-content-between px-5">
                <div class="col-auto">
                  <Link
                    class="btn btn-success btn-sm me-2"
                    :href="
                      route('backend.employee.show', (id = props.employee.id))
                    "
                  >
                    <i class="fa fa-eye me-2"></i>View Profile
                  </Link>
                </div>
                <div class="col-auto">
                  <Link
                    class="btn btn-secondary btn-sm me-2"
                    :href="
                      route('backend.employee.show', (id = props.employee.id))
                    "
                  >
                    <i class="fa fa-eye me-2"></i>Change Password
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4">
        <div class="card">
          <div class="fw-bold p-3 text-dark">Holidays</div>
          <hr />
          <div class="card-body p-3">
            <template v-if="dashboardData.holidays.length > 0">
              <div
                v-for="(holiday, index) in dashboardData.holidays"
                :key="index"
              >
                <div class="mb-3">
                  <div class="d-flex align-items-center">
                    <div class="me-3">
                      <i class="fa fa-calendar-alt text-primary fs-4"></i>
                    </div>
                    <div>
                      <h6 class="mb-1 fw-bold">{{ holiday.holiday_name }}</h6>
                      <p class="mb-0 text-muted">
                        {{ formatDate(holiday.start_date) }} -
                        {{ formatDate(holiday.end_date) }}
                      </p>
                    </div>
                  </div>
                </div>
                <hr v-if="index < dashboardData.holidays.length - 1" />
              </div>
            </template>
            <p v-else class="text-center text-muted">No upcoming holidays</p>

            <!-- See More Button -->
            <div class="text-center">
              <Link
                class="btn btn-primary btn-sm rounded"
                :href="route('backend.employee_holidays')"
              >
                <i class="fa fa-arrow-down me-2"></i> See More
              </Link>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-6">
        <div class="card">
          <div class="fw-bold p-3 text-dark">Leave History</div>
          <hr />
          <div class="card-body p-3">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(leave, index) in dashboardData.leaveHistory"
                    :key="index"
                  >
                    <td>
                      {{ leave.leaveType ? leave.leaveType.name : "N/A" }}
                    </td>
                    <td>{{ leave.date_from }}</td>
                    <td>{{ leave.date_to }}</td>
                    <td>
                      <span :class="statusBadge(leave.status)">{{
                        leave.status
                      }}</span>
                    </td>
                  </tr>
                  <tr v-if="dashboardData.leaveHistory.length === 0">
                    <td colspan="4" class="text-center">
                      No leave records found
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-6">
        <div class="card">
          <div class="fw-bold p-3 text-dark">Late Requests</div>
          <hr />
          <div class="card-body p-3">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Reason</th>
                    <th>Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(request, index) in dashboardData.lateRequests
                      .original.lateRequests"
                    :key="index"
                  >
                    <td>{{ request.reason }}</td>
                    <td>{{ formatDate(request.created_at) }}</td>
                    <td>
                      <span :class="statusBadge(request.status)">{{
                        request.status
                      }}</span>
                    </td>
                  </tr>
                  <tr
                    v-if="
                      dashboardData.lateRequests.original.lateRequests
                        .length === 0
                    "
                  >
                    <td colspan="3" class="text-center">
                      No late requests found
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-12">
        <div class="card">
          <div class="fw-bold p-3 text-dark">Notice / Announcement</div>
          <hr />
          <div class="card-body p-3">
            <div class="table-responsive active-projects bodybg">
              <div
                id="projects-tbl_wrapper"
                class="dataTables_wrapper no-footer"
              >
                <table
                  id="projects-tbl"
                  class="table dataTable no-footer"
                  aria-describedby="projects-tbl_info"
                >
                  <thead>
                    <tr>
                      <th
                        class="sorting"
                        tabindex="0"
                        aria-controls="projects-tbl"
                      >
                        Title
                      </th>
                      <th
                        class="sorting"
                        tabindex="0"
                        aria-controls="projects-tbl"
                      >
                        Description
                      </th>
                      <th
                        class="sorting"
                        tabindex="0"
                        aria-controls="projects-tbl"
                      >
                        Date
                      </th>
                      <th
                        class="sorting"
                        tabindex="0"
                        aria-controls="projects-tbl"
                      >
                        Attached file
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(
                        notice, index
                      ) in props.dashboardData.notices.slice(0, 5)"
                      :key="notice.id"
                      :class="index % 2 === 0 ? 'even' : 'odd'"
                    >
                      <td class="text-wrap">
                        {{ notice.name }}
                      </td>

                      <td class="text-wrap">
                        {{ notice.Description }}
                      </td>
                      <td class="text-primary">
                        {{ notice.created_at }}
                      </td>
                      <td class="text-wrap text-center">
                        <a :href="notice.file" target="_blank">
                          <i
                            class="fa-solid fa-file-pdf text-danger"
                            style="font-size: 24px"
                          ></i>
                          <br />
                          Download
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- <div class="col-xl-6">
                            <div class="card">
                                <div class="fw-bold p-3 text-dark">Salary Breakdown</div>
                                <hr />
                                <div class="card-body p-3">
                                    <table class="table table-sm">
                                        <tbody>
                                            <tr>
                                                <th>Base Salary</th>
                                                <td>$4000</td>
                                            </tr>
                                            <tr>
                                                <th>Bonus</th>
                                                <td>$500</td>
                                            </tr>
                                            <tr>
                                                <th>Deductions</th>
                                                <td>-$200</td>
                                            </tr>
                                            <tr>
                                                <th>Net Salary</th>
                                                <td><strong>$4300</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> -->
    </div>
  </BackendLayout>
</template>
<style scoped>
.card-image {
  width: 100%;
  overflow: hidden;
  border-radius: 10px;
}

.custom-calendar {
  height: 340px;
  max-height: 340px;
  overflow: hidden;
}

.badge {
  width: 100px;
  /* Adjust as needed */
  border-radius: 15px;
  /* Optional: keep consistent shape */
}

.table tbody tr td:last-child {
  text-align: start;
}
table {
  border-collapse: collapse;
  width: 100%;
  text-align: center;
 
}

td {
  border: 1px solid rgb(206, 206, 206);
  padding: 4px;
}
th {
  border: 1px solid rgb(206, 206, 206);
  padding: 1px;
}

</style>
