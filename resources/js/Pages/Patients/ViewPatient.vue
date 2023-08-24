<template>
    <div>
        <div class="formgrid grid">
            <div class="field col">
                <label>Ciudad</label>
                <Dropdown class="w-full" disabled v-model="form.city_id" :options="cities" optionLabel="city" optionValue="id" placeholder="Selecione ciudad" :filter="true" />
                <small class="text-red-500">{{ error_city_id }}</small>
            </div>
            <div class="field col">
                <label>Nombre</label>
                <InputText v-model="form.first_name" class="w-full" disabled />
                <small class="text-red-500">{{ error_first_name }}</small>
            </div>
            <div class="field col">
                <label>Apellido</label>
                <InputText v-model="form.last_name" class="w-full" disabled />
                <small class="text-red-500">{{ error_last_name }}</small>
            </div>
        </div>
        <div class="formgrid grid">
            <div class="field col">
                <label>Identificacion</label>
                <InputText v-model="form.personal_id" class="w-full" disabled />
                <small class="text-red-500">{{ error_personal_id }}</small>
            </div>
            <div class="field col">
                <label>Edad</label>
                <InputNumber v-model="form.age" class="w-full" disabled />
                <small class="text-red-500">{{ error_age }}</small>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "ViewPatient",
    data () {
        return {
            form: {
                first_name: null,
                last_name: null,
                personal_id: null,
                age: null,
                city_id:null
            },
            cities: [],
        }
    },
    props: {
        editId: Number,
    },
    methods: {
        async getCities () {
            await axios.get('api/cities').then((res) => {
                this.cities = res.data
            })
        },

        cleanForm () {
            Object.keys(this.form).map((val, index) => this.form[index] = null)
        },

        async getEditData() {
            const res = await axios.get(`/api/patients/${this.$props.editId}`)
            this.form.first_name   = res.data.first_name
            this.form.last_name    = res.data.last_name
            this.form.personal_id  = res.data.personal_id
            this.form.age          = res.data.age
            this.form.city_id      = res.data.city_id
        }
    },
    mounted() {
        this.getCities();
        console.log(this.$props.editId);
        if (this.$props.editId) {
            this.getEditData()
        }
    }
}
</script>

<style scoped>

</style>
