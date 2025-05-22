
<script setup>
    import { ref } from "vue";
    import BackendLayout from '@/Layouts/BackendLayout.vue';
    import BaseTable from '@/Components/BaseTable.vue';
    import Pagination from '@/Components/Pagination.vue';
    import { Link, router } from '@inertiajs/vue3';

    let props = defineProps({
        filters: Object,
    });

    const filters = ref({

        numOfData: props.filters?.numOfData ?? 10,
    });

    const applyFilter = () => {
        router.get(route('backend.websitemenu.index'), filters.value, { preserveState: true });
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
                    <button type="button" class="btn px-3 py-2 btn-primary">
                        {{ $page.props.pageTitle
                        }}<span class="badge text-bg-light ms-2 mb-0">{{ $page.props.countedData }}</span>
                    </button>
                    </div>

                    <Link
                    :href="route('backend.websitemenu.create')"
                    type="button"
                    class="btn px-4 btn-primary"
                    >
                    <span class="btn-icon-start text-info"
                        ><i class="fa fa-plus color-info"></i> </span
                    >Create
                    </Link>
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
                        <div>
                        <div
                            class="d-flex justify-content-between w-100 p-3 bg-light rounded"
                        >
                            <div class="row w-100">
                            <!-- Select Dropdown -->
                            <div class="col-sm-4 col-md-6 d-md-block">
                                <div class="col-sm-8 col-md-2">
                                <select
                                    v-model="filters.numOfData"
                                    @change="applyFilter"
                                    class="form-control-sm form-select form-select-sm"
                                >
                                    <option value="10">Show 10</option>
                                    <option value="20">Show 20</option>
                                    <option value="30">Show 30</option>
                                    <option value="40">Show 40</option>
                                    <option value="100">Show 100</option>
                                    <option value="150">Show 150</option>
                                    <option value="500">Show 500</option>
                                </select>
                                </div>
                            </div>

                            <!-- Input Field -->
                            <div class="col-sm-8 col-md-6">
                                <div class="d-flex gap-2 justify-content-end">
                                <div class="col-sm-12 col-md-4">
                                    <input
                                    id="name"
                                    v-model="filters.name"
                                    class="form-control form-control-sm"
                                    type="text"
                                    placeholder="Search by websitemenu name"
                                    @input="applyFilter"
                                    />
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="w-full my-3 overflow-x-auto">
                            <BaseTable />
                        </div>

                        <Pagination />

                        </div>
                    </div>
                    <!-- /Recent Payments Queue -->
                    </div>
                </div>
                <!--/tab-content-->


                </div>
            </div>
            </div>
        </BackendLayout>
    </template>

