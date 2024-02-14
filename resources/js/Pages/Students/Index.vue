<script setup>
import { Link, router } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import { usePage } from '@inertiajs/vue3';

defineProps({ students: Object });

</script>

<template>
    <div>
        <h1>Students</h1>
        <div>
            <div class="btn-group mb-2">
                <a class="btn btn-secondary" href="/">Início</a>
                <Link :href="`student/create`" class="btn btn-primary">New Student</Link>
            </div>

            <div class="table-responsive">
                <table class="table table-hovered">
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Matricula</th>
                        <th class="text-center">Options</th>
                    </tr>
                    <tr v-for="student in students" :key="student.id">
                        <td class="text-center">{{ student.id }}</td>
                        <td class="text-center">{{ student.name }}</td>
                        <td class="text-center">{{ student.email }}</td>
                        <td class="text-center">{{ student.matricula }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <Link :href="`student/${student.id}`" class="btn btn-outline-primary">Edit</Link>
                                <button class="btn btn-outline-danger" @click="deleteStudent(student.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>