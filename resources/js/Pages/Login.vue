<template>
  <div class="login-container">
    <nav class="navbar">
      <div class="navbar-brand">United Auto Sales</div>
      <div class="navbar-links">
        <router-link to="/register">Register</router-link>
        <router-link to="/login">Login</router-link>
      </div>
    </nav>

    <div class="login-card">
      <h1>Login to your account</h1>

      <form @submit.prevent="handleLogin">
        <div class="form-group">
          <label>Username</label>
          <input v-model="form.name" type="text" required placeholder="Enter your username" />
        </div>

        <div class="form-group">
          <label>Password</label>
          <input v-model="form.password" type="password" required placeholder="Enter your password" />
        </div>

        <button type="submit" class="login-button">Login</button>
      </form>

      <p v-if="errorMessage" class="error">{{ errorMessage }}</p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { loginUser } from '@/services/loginService'

const router = useRouter()

const form = ref({
  name: '',
  password: '',
})

const errorMessage = ref('')

const handleLogin = async () => {
  errorMessage.value = ''

  try {
    const token = await loginUser(form.value)

    localStorage.setItem('token', token)

    router.push('/explore')
  } catch (error) {
    if (error.response && error.response.data) {
      errorMessage.value = error.response.data.message || "Login failed."
    } else {
      errorMessage.value = "Login failed."
    }
  }
}
</script>

<style src="@/../css/login.css"></style>
