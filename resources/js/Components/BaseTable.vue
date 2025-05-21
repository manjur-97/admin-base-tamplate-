<script setup>
import {
  statusChangeConfirmation,
  deleteConfirmation,
} from "@/responseMessage.js";
import { onMounted } from "vue";
import { Link } from "@inertiajs/vue3";
import { defineProps } from "vue";

defineProps({
  openModal: Function,
});

onMounted(() => {
  document.querySelectorAll(".statusChange").forEach((button) => {
    button.addEventListener("click", function (e) {
      e.preventDefault();
      const url = this.getAttribute("href");
      statusChangeConfirmation(url);
    });
  });

  document.querySelectorAll(".deleteButton").forEach((button) => {
    button.addEventListener("click", function (e) {
      e.preventDefault();
      const url = this.getAttribute("data-url");
      deleteConfirmation(url).then((confirmed) => {
        if (confirmed) {
          Inertia.delete(url);
        }
      });
    });
  });
});

const openAttendanceRequestModal = (attendanceId) => {
  selectedRowId.value = attendanceId;
  applicationText.value = "";
  showModal.value = true;
};
</script>

<template>
  <div class="resptable-responsive"></div>

  <table class="table table-bordered table-striped table-responsive-sm">
    <thead class="text-center fw-bold">
      <tr class="text-center">
        <template
          v-for="(header, index) in $page.props.tableHeaders"
          :key="index"
        >
          <th scope="col">{{ header }}</th>
        </template>
      </tr>
    </thead>

    <tbody>
      <template
        v-for="(data, dataIndex) in $page.props.datas.data"
        :key="dataIndex"
      >
        <tr>
          <template
            v-for="(dateField, dateFieldIndex) in $page.props.dataFields"
            :key="dateFieldIndex"
          >
            <td class="px-4 py-2 border" :class="dateField.class">
              <p v-html="data[dateField.fieldName] ?? ''"></p>
            </td>
          </template>

          <template v-if="data.hasLink">
            <td class="text-center">
              <div>
                <template
                  v-for="(linkInfo, linkIndex) in data.links"
                  :key="linkIndex"
                >
                  <button
                    v-if="linkInfo.linkClass.includes('deleteButton')"
                    class="deleteButton btn btn-danger shadow btn-xs sharp"
                    type="button"
                    :data-url="linkInfo.link"
                  >
                    <span v-html="linkInfo.linkLabel"></span>
                  </button>

                  <button
                    v-else-if="linkInfo.linkClass.includes('modalButton')"
                    class="modalButton btn btn-success btn-xs shadow ms-1 sharp me-1"
                    type="button"
                    @click="openModal(linkInfo.dataId)"
                  >
                    <span v-html="linkInfo.linkLabel"></span>
                  </button>

                  <Link
                    v-else
                    :href="linkInfo.link"
                    :class="linkInfo.linkClass"
                  >
                    <span v-html="linkInfo.linkLabel"></span>
                  </Link>
                </template>
              </div>
            </td>
          </template>
        </tr>
      </template>
    </tbody>
  </table>
</template>
