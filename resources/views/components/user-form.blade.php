<div x-data="userForm()" class="space-y-6">

    {{-- Форма ввода одного пользователя --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-white rounded-xl p-6 shadow">

        <div>
            <label class="block font-semibold mb-1">Full Name</label>
            <input type="text" x-model="newUser.full_name" class="gradient-border-input w-full" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Email</label>
            <input type="email" x-model="newUser.email" class="gradient-border-input w-full" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Grade</label>
            <select x-model="newUser.grade" class="gradient-border-input w-full">
                <template x-for="grade in grades">
                    <option :value="grade" x-text="grade"></option>
                </template>
            </select>
        </div>

        <div class="md:col-span-2">
            <label class="block font-semibold mb-1">Specialization</label>
            <select x-model="newUser.specialization" class="gradient-border-input w-full">
                <template x-for="specialization in specializations">
                    <option :value="specialization" x-text="specialization"></option>
                </template>
            </select>
        </div>

        <div class="md:col-span-2 flex justify-end">
            <button type="button" @click="addUser"
                    class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-purple-600 hover:to-pink-500 text-white font-bold py-2 px-5 rounded-xl shadow-md transition hover:scale-105">
                Add User
            </button>
        </div>
    </div>

    {{-- Таблица добавленных пользователей --}}
    <template x-if="users.length > 0">
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse border border-gray-300 mt-4">
                <thead class="bg-gray-100 text-sm">
                <tr>
                    <th class="border px-3 py-2 text-left">Full Name</th>
                    <th class="border px-3 py-2 text-left">Email</th>
                    <th class="border px-3 py-2 text-left">Grade</th>
                    <th class="border px-3 py-2 text-left">Specialization</th>
                    <th class="border px-3 py-2 text-left">Actions</th>
                </tr>
                </thead>
                <tbody>
                <template x-for="(user, index) in users" :key="index">
                    <tr>
                        <td class="border px-3 py-2" x-text="user.full_name"></td>
                        <td class="border px-3 py-2" x-text="user.email"></td>
                        <td class="border px-3 py-2" x-text="user.grade"></td>
                        <td class="border px-3 py-2" x-text="user.specialization"></td>
                        <td class="border px-3 py-2">
                            <button type="button" @click="removeUser(index)" class="text-red-600 hover:text-red-800 text-sm">Remove</button>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
    </template>

    {{-- Поле скрытое для отправки users как JSON --}}
    <textarea name="manual_users" x-model="JSON.stringify(users)" hidden></textarea>
</div>

<script>
    function userForm() {
        return {
            users: [],
            newUser: {
                full_name: '',
                email: '',
                grade: '',
                specialization: '',
            },
            grades: @json($grades ?? ['intern']),
            specializations: @json($specializations ?? ['frontend']),
            addUser() {
                if (!this.newUser.full_name || !this.newUser.email) return;
                this.users.push({ ...this.newUser });
                this.newUser = {
                    full_name: '',
                    email: '',
                    grade: '',
                    specialization: '',
                };
            },
            removeUser(index) {
                this.users.splice(index, 1);
            }
        };
    }
</script>
