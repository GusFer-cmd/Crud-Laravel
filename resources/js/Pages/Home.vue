<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="container mt-5">
    <div class="card p-4">
      <h1 class="text-center">Bem-vindo ao Sistema</h1>
      <p class="text-center">Obrigado por escolher nosso sistema! Estamos felizes em tê-lo(a) a bordo.</p>
      <p class="text-center">Cadastre seus alunos aqui:</p>
      <Link href="/student" class= "btn btn-primary text-white text-decoration-none">Students</Link>
    </div>
  </div>
</template>
  