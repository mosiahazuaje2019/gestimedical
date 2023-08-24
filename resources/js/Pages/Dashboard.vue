<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-20">
                <div class="bg-transparent overflow-hidden shadow-sm sm:rounded-lg justify-center">
                    <div class="grid">
                        <div class="col-12">
                            <PrimeButton
                                label="Administrar Medicamentos"
                                class="p-button-secondary w-full"
                                @click="activateProducts"
                            />
                        </div>
                        <div class="col-12">
                            <PrimeButton
                                label="Administrar Diagnósticos"
                                class="p-button-secondary w-full"
                                @click="activateDiagnostic" />
                        </div>
                        <div class="col-12">
                            <PrimeButton
                                label="Administrar Direcciones"
                                class="p-button-secondary w-full"
                                @click="activateAddress" />
                        </div>
                        <div class="col-12">
                            <PrimeButton
                                label="Administrar Presentaciones"
                                class="p-button-secondary w-full"
                                @click="activatePresentation" />
                        </div>
                        <div class="col-12">
                            <PrimeButton
                                label="Administrar Pacientes"
                                class="p-button-secondary w-full"
                                @click="activatePatient" />
                        </div>
                    </div>
                    <div class="grid">
                        <div class="col p-6" v-if="product === true">
                            <ListProducts />
                        </div>
                        <div class="col p-6" v-if="diagnostic === true">
                            <ListDiagnostic />
                        </div>
                        <div class="col p-6" v-if="address  === true">
                            <ListAddress />
                        </div>
                        <div class="col p-6" v-if="presentation === true">
                            <ListPresentation />
                        </div>
                        <div class="col p-6" v-if="patient === true">
                            <ListPatient v-if="$page.props.auth.user.role==='Admin'" />
                            <Message v-if="$page.props.auth.user.role==='Basic'" severity="warn" :closable="false">No cuenta con acceso a esta sección</Message>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';
import ListProducts from "@/Pages/Products/ListProducts";
import ListDiagnostic from "@/Pages/Diagnostics/ListDiagnostic";
import ListAddress from "@/Pages/Address/ListAddress";
import ListPresentation from "@/Pages/Presentations/ListPresentation";
import ListPatient from "@/Pages/Patients/ListPatient";

export default {
    components: {
        ListProducts,
        ListDiagnostic,
        ListAddress,
        ListPresentation,
        ListPatient,
        BreezeAuthenticatedLayout,
        Head,
    },
    data() {
        return {
            product: false,
            diagnostic: false,
            address: false,
            presentation: false,
            patient: false
        }
    },
    methods: {
        activateProducts() {
            this.address = false;
            this.diagnostic = false;
            this.presentation = false;
            this.patient = false;
            this.product = true;
        },
        activateDiagnostic() {
            this.address = false;
            this.product = false;
            this.presentation = false;
            this.patient = false;
            this.diagnostic = true;
        },
        activateAddress() {
            this.diagnostic = false;
            this.product = false;
            this.presentation = false;
            this.patient = false;
            this.address= true;
        },
        activatePresentation() {
            this.diagnostic = false;
            this.product = false;
            this.address= false;
            this.patient = false;
            this.presentation = true;
        },
        activatePatient() {
            this.diagnostic = false;
            this.product = false;
            this.address= false;
            this.presentation = false;
            this.patient = true;
        }
    },
}
</script>
<style scoped>
.del-btn{
    background-color: firebrick;
    border-bottom-width: 0px;
}
.edit_btn{
    background-color: blue;
}
.add-btn{
    margin-bottom: 20px;
    border-radius: 50%;
}
</style>
