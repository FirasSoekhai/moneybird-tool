<template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
            <p>Welcome, {{ user.username }}!</p>
            
            <div v-if="user.isAdmin" class="mt-4">
              <Link :href="route('admin.dashboard')" class="text-indigo-600 hover:text-indigo-900">
                Go to Admin Dashboard
              </Link>
            </div>
            
            <button @click="logout" class="mt-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
              Logout
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  import { Link, router, usePage } from '@inertiajs/vue3';
  
  export default defineComponent({
    components: {
      Link
    },
    setup() {
      const page = usePage();
      const user = page.props.auth.user;
  
      const logout = () => {
        router.post(route('logout'));
      };
  
      return {
        user,
        logout
      };
    }
  });
  </script>
