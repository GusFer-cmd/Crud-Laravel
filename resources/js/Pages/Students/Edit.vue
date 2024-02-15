<script setup>
import { Link, router, useForm } from '@inertiajs/vue3';
import { reactive } from 'vue';

const props = defineProps({ 
    student: Object 
});

const form = reactive({
    name: props.student,
    email: '',
    matricula: ''
});

const errors = {};

function submitForm() {
    router.put('/student', form);
}
</script>

<template>
    <div class="container mt-5">
        <div class="card p-4">
            <h1 class="text-center">Edit Student</h1>
            <form @submit.prevent="submitForm">
                <div class="mb-2">
                    <input type="text" v-model="form.name" placeholder="Name" class="form-control"
                        :class="{ 'is-invalid': errors.name }">
                    <div v-if="errors.name" class="alert alert-danger">{{ errors.name }}</div>
                </div>

                <div class="mb-2">
                    <input type="email" v-model="form.email" placeholder="email@.com" class="form-control"
                        :class="{ 'is-invalid': errors.email }">
                    <div v-if="errors.email" class="alert alert-danger">{{ errors.email }}</div>
                </div>

                <div class="mb-2">
                    <input type="number" v-model="form.matricula" placeholder="Matrícula (ex:000000)" class="form-control"
                        :class="{ 'is-invalid': errors.matricula }">
                    <div v-if="errors.matricula" class="alert alert-danger">{{ errors.matricula }}</div>
                </div>

                <div class="mb-2">
                    <div class="btn-group" role="group">
                        <Link href="/student" class="btn btn-secondary text-white text-decoration-none">Go Back</Link>
                        <!-- <Link :href="`student/index`" class="btn btn-secondary">Go Back</Link> -->
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>