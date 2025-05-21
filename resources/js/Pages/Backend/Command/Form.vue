<script setup>
import { ref, onMounted } from "vue";
import BackendLayout from "@/Layouts/BackendLayout.vue";
import { router, useForm, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

import { displayResponse, displayWarning } from "@/responseMessage.js";

const props = defineProps(["command", "id"]);

const form = useForm({
    model: props.command?.model ?? "",
    controller: props.command?.controller ?? "",
    database_table: props.command?.database_table ?? "",
    status: props.command?.status ?? "",
    imagePreview: props.command?.image ?? "",
    filePreview: props.command?.file ?? "",

    _method: props.command?.id ? "put" : "post",
});

// Array to hold dynamic fields
const fields = ref([
    {
        name: "",
        type: "integer",
        length: "",
        nullable: false,
        defaultValue: "",

        relational_table: "",
    },
]);

const addField = () => {
    fields.value.push({
        name: "",
        type: "integer",
        length: "",
        nullable: false,
        defaultValue: "",

        relational_table: "",
    });
};

const removeField = (index) => {
    fields.value.splice(index, 1);
};

const submit = () => {
    const routeName = props.id
        ? route("backend.command.update", props.id)
        : route("backend.command.store");

    // Prepare data for submission
    const submittedData = {
        ...form.data,
        fields: fields.value, // Include dynamic fields in the submission
    };

    form.transform((data) => ({
        ...data,
        remember: "",
        fields: fields.value,
        isDirty: false,
    })).post(routeName, {
        data: submittedData, // Send the prepared data
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
        <div class="mt-3 bg-white border rounded-md">
            <div
                class="d-flex align-items-center justify-content-center bg-secondary text-white rounded shadow-md"
            >
                <div>
                    <h1 class="p-4 text-xl fw-bold">
                        CRUD MVC
                    </h1>
                </div>
                <div class="p-4 py-2"></div>
            </div>

            <form @submit.prevent="submit" class="p-4 bg-light border rounded">
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-6">
                        <label for="model" class="form-label fw-bold"
                            >Model</label
                        >
                        <input
                            id="model"
                            class="form-control"
                            v-model="form.model"
                            type="text"
                            placeholder="Enter model name"
                        />
                        <InputError class="mt-2" :message="form.errors.model" />
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="controller" class="form-label fw-bold"
                            >Controller</label
                        >
                        <input
                            id="controller"
                            class="form-control"
                            v-model="form.controller"
                            type="text"
                            placeholder="Enter controller name"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.controller"
                        />
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="database_table" class="form-label fw-bold">
                            Table Name</label
                        >
                        <input
                            id="database_table"
                            class="form-control"
                            v-model="form.database_table"
                            type="text"
                            placeholder="Enter database table name"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.database_table"
                        />
                    </div>
                </div>

                <fieldset class="border p-3 mb-4">
                    <legend class="fw-bold">
                        Table Field (Except ID and Status)
                    </legend>
                    <div
                        v-for="(field, index) in fields"
                        :key="index"
                        class="row g-3 align-items-center mb-3"
                    >
                        <div class="col-md-2">
                            <label
                                :for="'name_' + index"
                                class="form-label fw-bold"
                                >Field Name</label
                            >
                            <input
                                type="text"
                                :id="'name_' + index"
                                class="form-control"
                                v-model="field.name"
                                placeholder="Enter name"
                            />
                        </div>

                        <div class="col-md-2">
                            <label
                                :for="'type_' + index"
                                class="form-label fw-bold"
                                >Data Type</label
                            >
                            <select
                                :id="'type_' + index"
                                class="form-select"
                                v-model="field.type"
                            >
                                <option value="integer">Integer</option>
                                <option value="string">Varchar</option>
                                <option value="text">Text</option>
                                <option value="date">Date</option>
                                <option value="dateTime">DateTime</option>
                                <option value="float">Float</option>
                                <option value="double">Double</option>
                                <option value="decimal">Decimal</option>
                                <option value="boolean">Boolean</option>
                                <option value="binary">Binary (BLOB)</option>
                                <option value="enum">Enum</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label
                                :for="'length_' + index"
                                class="form-label fw-bold"
                                >Length</label
                            >
                            <input
                                type="text"
                                :id="'length_' + index"
                                class="form-control"
                                v-model="field.length"
                                placeholder="Enter length"
                                :required="
                                    ['string', 'integer'].includes(field.type)
                                "
                                :disabled="
                                    !['string', 'integer'].includes(field.type)
                                "
                            />
                        </div>

                        <div class="col-md-1">
                            <div
                                class="form-check d-flex flex-column align-items-center"
                            >
                                <label
                                    :for="'null_' + index"
                                    class="form-label fw-bold"
                                    >Is Null</label
                                >
                                <input
                                    type="checkbox"
                                    :id="'null_' + index"
                                    class="form-check-input ms-2 mt-1"
                                    v-model="field.nullable"
                                    style="
                                        width: calc(2.5rem + 2px);
                                        height: calc(2.5rem + 2px);
                                    "
                                />
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label
                                :for="'default_' + index"
                                class="form-label fw-bold"
                                >Default Value</label
                            >
                            <input
                                type="text"
                                :id="'default_' + index"
                                class="form-control"
                                v-model="field.defaultValue"
                                placeholder="Enter default value"
                            />
                        </div>

                        <div
                            class="col-md-2"
                            v-if="
                                ['integer', 'FLOAT', 'DOUBLE'].includes(
                                    field.type
                                )
                            "
                        >
                            <label
                                :for="'relational_table_' + index"
                                class="form-label fw-bold"
                                >Relational Table</label
                            >
                            <input
                                type="text"
                                :id="'relational_table_' + index"
                                class="form-control"
                                v-model="field.relational_table"
                            />
                        </div>

                        <div class="col-md-1 d-flex align-items-center">
                            <button
                                type="button"
                                class="btn btn-outline-danger btn-sm mt-4"
                                @click="removeField(index)"
                                title="Remove Field"
                            >
                                <i class="bi bi-x-circle"></i> Remove
                            </button>
                        </div>
                    </div>
                    <button
                        type="button"
                        class="btn btn-outline-primary mt-3"
                        @click="addField"
                    >
                        <i class="bi bi-plus-circle"></i> Add Field
                    </button>
                </fieldset>

                <div class="d-flex justify-content-end mt-4">
                    <button
                        type="submit"
                        class="btn btn-primary"
                        :class="{ disabled: form.processing }"
                        :disabled="form.processing"
                    >
                        {{ props.id ? "Update" : "Create" }}
                    </button>
                </div>
            </form>
        </div>
    </BackendLayout>
</template>
