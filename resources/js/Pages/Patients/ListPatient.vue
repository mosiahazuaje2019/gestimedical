<template>
    <Card>
        <template #header>

        </template>
        <template #title>Listado de pacientes
            <a :href="`/api/export_patients/`"
                title="Exportar pacientes"
                target="_blank">
                <i class="pi pi-print grid grid-cols-12 float-right text-4xl cursor-pointer"></i>
            </a>
        </template>
        <template #content>
            <DataTable v-model:filters="filters1" :value="patients" dataKey="id"
                       responsiveLayaout="scroll"
                       :paginator="true"
                       :rows="10"
                       :loading="loading1"
                       :globalFilterFields="['global','full_name']">
                <template #header>
                    <div class="flex justify-content-center">
                        <span class="p-input-icon-left w-full">
                            <i class="pi pi-search" />
                            <InputText v-model="filters1['global'].value" placeholder="Buscar" class="w-full" />
                        </span>
                    </div>
                </template>
                <Column field="full_name" header="Nombres"></Column>
            </DataTable>
        </template>
    </Card>
</template>

<script>
import Swal from 'sweetalert2';
import axios from 'axios';
import { FilterMatchMode, FilterOperator } from 'primevue/api';

export default {
    name: "ListPatient",
    data() {
        return {
            patients: null,
            filter: null,
            filters1: null,
            filters2: {
                'global': {value:null, matchMode: FilterMatchMode.CONTAINS},
                'full_name': {value:null, matchMode: FilterMatchMode.STARTS_WITH}
            },
            editId: null,
            display: false,
            loading1: true
        }
    },
    methods: {
        async getPatients() {
            await axios.get('api/patients').then((res) => {
                this.patients = res.data
                this.loading1 = false
            })
        },
        initFilters1() {
            this.filters1 = {
                'global': {value:null, matchMode:FilterMatchMode.CONTAINS},
                'full_name':{operator: FilterOperator.AND, constraints: [{value:null, matchMode: FilterMatchMode.STARTS_WITH}]}
            }
        }
    },
    created() {
        this.initFilters1()
    },
    mounted() {
        this.getPatients()
    }
}
</script>

