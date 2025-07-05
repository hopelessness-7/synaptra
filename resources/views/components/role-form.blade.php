<div x-data="roleForm()" class="space-y-8">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <template x-for="(role, index) in roles" :key="index">
            <div class="relative w-full border rounded-xl p-4 bg-white shadow-sm">

                <div class="mb-3">
                    <div class="flex items-start justify-between mb-3">
                        <label class="block font-semibold mb-1">
                            Role Name
                        </label>
                        <button type="button" @click="removeRole(index)"
                                class="text-red-500 hover:text-red-700 text-lg font-bold leading-none">
                            &times;
                        </button>
                    </div>
                    <input type="text" :name="`roles[${index}][name]`"
                           x-model="role.name" class="gradient-border-input w-full" required>
                </div>

                <div class="mb-3">
                    <label class="block font-semibold mb-1">Description</label>
                    <textarea :name="`roles[${index}][description]`" x-model="role.description"
                              class="gradient-border-input w-full" rows="2"></textarea>
                </div>

                <div class="mb-3">
                    <label class="block font-semibold mb-1">Permissions</label>
                    <div class="grid grid-cols-2 gap-2">
                        <template x-for="perm in permissions" :key="perm">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox"
                                       :name="`roles[${index}][permissions][]`"
                                       :value="perm"
                                       x-model="role.permissions"
                                       class="text-indigo-600 rounded border-gray-300">
                                <span x-text="perm" class="text-sm text-gray-700"></span>
                            </label>
                        </template>
                    </div>
                </div>

            </div>
        </template>
    </div>

    <button type="button"
            @click="addRole()"
            class="w-full border-dashed border-2 border-indigo-400 hover:border-indigo-600 text-indigo-600 py-3 rounded-xl flex items-center justify-center space-x-2 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        <span class="font-semibold">Add Role</span>
    </button>
</div>

<script>
    function roleForm() {
        return {
            roles: @json($roles ?? []),
            permissions: @json($permissions ?? ['View Tasks', 'Edit Tasks', 'Manage Users']),
            addRole() {
                this.roles.push({
                    name: '',
                    description: '',
                    permissions: [],
                });
            },
            removeRole(index) {
                this.roles.splice(index, 1);
            }
        }
    }
</script>
