<template>
    <Card>
        <template #header>
            <a :href="`/api/export_patients/${iniDate}/${endDate}`"
                title="Exportar pacientes"
                target="_blank">
                    <i class="pi pi-print grid grid-cols-12 float-right text-4xl pr-4 pt-4 cursor-pointer"></i>
            </a>
        </template>
        <template #title>
            <h2>Listado de pacientes</h2>
            <span class="float-right mt-2 mb-2 p-float-label">
                <Calendar v-model="dates" selectionMode="range" :manualInput="false" inputId="range_date" showIcon />
                <label for="range_date">Buscar por fecha</label>
                <PrimeButton icon="pi pi-search" aria-label="Buscar" class="ml-2" @click="searchPatients()" />
            </span>
        </template>
        <template #content>
            <DataTable v-model:filters="filters1" :value="patients" dataKey="id"
                       responsiveLayaout="scroll"
                       class="mt-6 w-full"
                       :paginator="true"
                       :rows="10"
                       :loading="loading1"
                       :globalFilterFields="['global','full_name']">
                <template #header>
                    <div class="flex justify-content-center">
                        <span class="p-input-icon-left w-full">
                            <i class="pi pi-search" />
                            <InputText v-model="filters1['global'].value" placeholder="Buscar" class="w-full mt-2" />
                        </span>
                    </div>
                </template>
                <Column field="full_name" header="Nombres"></Column>
                <Column field="personal_id" header="Cédula"></Column>
                <Column field="created_at"  header="Fecha de registro" bodyStyle="text-align: center" headerStyle="text-align:center"></Column>
                <Column bodyStyle="text-align: center; overflow: visible" header="Acción"
                        headerStyle="width: 14rem; text-align: center">
                    <template #body="slotProps">
                        <PrimeButton class="edit_btn" @click="viewPatient(slotProps.data.id)" icon="pi pi-eye" title="ver" />
                    </template>
                </Column>
            </DataTable>
        </template>
    </Card>

    <Dialog :header="editId === null ? 'Crear Paciente' : 'Ver Paciente'" :style="{width: '50vw'}"
            v-model:visible="display">
        <ViewPatient :editId="editId" />
    </Dialog>

</template>

<script>
import Swal from 'sweetalert2';
import axios from 'axios';
import { FilterMatchMode, FilterOperator } from 'primevue/api';
import ViewPatient from './ViewPatient.vue';

export default {
    name: "ListPatient",
    components: {
        ViewPatient
    },
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
            loading1: true,
            dates: null,
            selectedDate: null,
            iniDate: null,
            endDate: null,
        }
    },
    methods: {
        async getPatients() {
            await axios.get('api/patients').then((res) => {
                this.patients = res.data
                this.loading1 = false
            })
        },
        async searchPatients() {
            this.selectedDate = this.dates;
            this.iniDate = new Date(this.selectedDate[0]).toLocaleDateString('fr-CA');
            this.endDate = new Date(this.selectedDate[1]).toLocaleDateString('fr-CA');
            this.loading1 = true;

            await axios.get(`api/getPatientsByDate/${this.iniDate}/${this.endDate}`).then((res) => {
                this.patients = res.data;
                this.loading1 = false;
            })
        },
        async viewPatient (id) {
            this.editId = id
            this.display = true
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

