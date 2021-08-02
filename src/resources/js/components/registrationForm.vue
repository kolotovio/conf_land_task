<template>
  <div class="grid gap-2 justify-items-start text-sm">
    <label class="flex flex-col">
      <span>LastName:</span>
      <input
        type="text"
        v-model="user.last_name"
        class="border border-gray-400"
      />
    </label>
    <label class="flex flex-col">
      <span>FirstName:</span>
      <input
        type="text"
        v-model="user.first_name"
        class="border border-gray-400"
      />
    </label>
    <label class="flex flex-col">
      <span>MiddleName:</span>
      <input
        type="text"
        v-model="user.middle_name"
        class="border border-gray-400"
      />
    </label>
    <label class="flex flex-col">
      <span>Email:</span>
      <input type="email" v-model="user.email" class="border border-gray-400" />
    </label>
    <label class="flex flex-col">
      <span>Phone:</span>
      <input type="text" v-model="user.phone" class="border border-gray-400" />
    </label>
    <label class="flex flex-col">
      <span>Company:</span>
      <input
        type="text"
        v-model="user.company"
        class="border border-gray-400"
      />
    </label>
    <label class="flex flex-col">
      <span>JobTitle:</span>
      <input
        type="text"
        v-model="user.job_title"
        class="border border-gray-400"
      />
    </label>
  </div>
  <button @click="addUser">Add</button>
</template>

<script>
import axios from '../axios'
export default {
  name: 'registrationFormComponent',
  data: () => ({
    user: {
      first_name: 'Иван',
      last_name: 'Иванов',
      middle_name: 'Иванович',
      email: 'ivan@iva.com',
      phone: '(8332)332233',
      company: 'NoCompona',
      job_title: 'NoJob'
    }
  }),
  methods: {
    async recapt() {
      await this.$recaptchaLoaded()
      const token = await this.$recaptcha('login')
      console.log(token)
    },
    async addUser() {
      const { data } = await axios.post('/users', this.user)
      console.log(data)
    }
  }
}
</script>
