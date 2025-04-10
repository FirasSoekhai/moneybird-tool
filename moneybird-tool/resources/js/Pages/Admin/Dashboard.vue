<template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>
            
            <div v-if="$page.props.flash.message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
              {{ $page.props.flash.message }}
            </div>
            
            <div class="mt-6">
              <h2 class="text-xl font-semibold mb-2">User Management</h2>
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Username
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="user in users" :key="user.user_id">
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ user.user_id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ user.username }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span v-if="user.admin" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Admin (Level {{ user.admin.admin_level }})
                      </span>
                      <span v-else class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                        Regular User
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      <form v-if="canManageAdmins" @submit.prevent="toggleAdminStatus(user)">
                        <button type="submit" class="text-indigo-600 hover:text-indigo-900">
                          {{ user.admin ? 'Remove Admin' : 'Make Admin' }}
                        </button>
                      </form>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            
            <div class="mt-4">
              <Link :href="route('dashboard')" class="text-indigo-600 hover:text-indigo-900">
                Back to Dashboard
              </Link>
            </div>
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
    props: {
      users: Array
    },
    setup() {
      const page = usePage();
      const user = page.props.auth.user;
      
      const canManageAdmins = user.admin && user.admin.admin_level > 1;
      
      const toggleAdminStatus = (targetUser) => {
        router.post(route('admin.toggle', targetUser.user_id));
      };
      
      return {
        canManageAdmins,
        toggleAdminStatus
      };
    }
  });
  </script>