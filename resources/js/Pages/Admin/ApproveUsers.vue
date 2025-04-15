<template>
    <div class="p-6 max-w-4xl mx-auto">
      <h1 class="text-2xl font-bold mb-6">Gebruikers Goedkeuren</h1>
  
      <div v-if="users.length === 0" class="text-gray-600">
        Alle gebruikers zijn al goedgekeurd 🎉
      </div>
  
      <table v-else class="w-full border text-sm">
        <thead>
          <tr class="bg-gray-100 text-left">
            <th class="p-2 border-b">Naam</th>
            <th class="p-2 border-b">Email</th>
            <th class="p-2 border-b">Geregistreerd op</th>
            <th class="p-2 border-b">Actie</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.user_id" class="hover:bg-gray-50">
            <td class="p-2 border-b">{{ user.name }}</td>
            <td class="p-2 border-b">{{ user.email }}</td>
            <td class="p-2 border-b">{{ new Date(user.created_at).toLocaleDateString() }}</td>
            <td class="p-2 border-b">
              <button
                @click="approveUser(user.user_id)"
                class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700"
              >
                Goedkeuren
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script setup>
  import { router } from '@inertiajs/vue3'
  import { defineProps } from 'vue'
  
  defineProps({
    users: Array
  })
  
  function approveUser(userId) {
    if (confirm('Weet je zeker dat je deze gebruiker wilt goedkeuren?')) {
      router.post(`/admin/users/${userId}/approve`, {}, {
        preserveScroll: true,
        onSuccess: () => {
          // reload pagina om lijst te verversen
          router.reload()
        }
      })
    }
  }
  </script>