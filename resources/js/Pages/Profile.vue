<template>
  <div class="profile-container">
    <nav class="navbar">
      <div class="navbar-brand">United Auto Sales</div>
      <div class="navbar-links">
        <router-link to="/explore">Explore</router-link>
        <router-link to="/cars/new">Add Car</router-link>
        <router-link to="/profile">My Profile</router-link>
        <router-link to="/login">Logout</router-link>
      </div>
    </nav>

    <div v-if="user" class="profile-card">
      <img v-if="user.photo" :src="user.photo" alt="Profile Photo" class="profile-photo" />
      <div class="profile-name">{{ user.name }}</div>
      <div class="profile-info">{{ user.location }}</div>
      <div class="profile-info">{{ user.biography }}</div>
    </div>

    <h2 style="text-align:center;">Favourited Cars</h2>

    <div v-if="favourites.length === 0">
      <p style="text-align:center;">No favourites yet.</p>
    </div>

    <div v-else class="car-grid">
      <div v-for="car in favourites" :key="car.id" class="car-card">
        <img :src="car.photo || '/placeholder-car.png'" alt="Car photo" />
        <div class="car-card-body">
          <div class="car-card-title">{{ car.make }} {{ car.model }}</div>
          <div>{{ car.year }} - {{ car.transmission }}</div>
          <div class="car-card-price">${{ car.price }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getUserFavourites, getUserInfo } from '@/services/userService'

const user = ref(null)
const favourites = ref([])

const fetchProfile = async () => {
  try {
    const userInfo = await getUserInfo()
    user.value = userInfo

    const userFavs = await getUserFavourites(userInfo.id)
    favourites.value = userFavs
  } catch (error) {
    console.error('Error loading profile', error)
  }
}

onMounted(() => {
  fetchProfile()
})
</script>

<style src="@/../css/profile.css"></style>
