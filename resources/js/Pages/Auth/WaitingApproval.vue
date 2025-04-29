<template>
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>
        <div class="py-12">
            <div class=" max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <h1 class="text-3xl font-bold mb-4">Je account wordt beoordeeld</h1>
                <p class="text-gray-600">Zodra een admin je goedkeurt, krijg je toegang tot het dashboard.</p>
            </div>
        </div>
         
    </AuthenticatedLayout>
  </template>
   
  <script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>