<template>
  <div class="explore-container">
    <nav class="navbar">
      <div class="navbar-brand">United Auto Sales</div>
      <div class="navbar-links">
        <router-link to="/addcar">Add Car</router-link>
        <router-link to="/explore">Explore</router-link>
        <router-link to="/profile">My Profile</router-link>
        <a @click="logout" style="cursor:pointer">Logout</a>
      </div>
    </nav>

    <h1>Explore</h1>

    <!-- Search box -->
    <div class="search-card">
      <input v-model="filters.make"  type="text" placeholder="Make"  />
      <input v-model="filters.model" type="text" placeholder="Model" />
      <button @click="loadCars">Search</button>
    </div>

    <!-- Grid of cars -->
    <div class="car-grid">
      <div v-for="car in cars" :key="car.id" class="car-card">
        <img
          :src="car.photo_url"
          alt="Car photo"
          class="car-card-image"
          onerror="this.src='/fallback.png'"
        />

        <div class="car-card-body">
          <div class="car-card-title">
            {{ car.year }} {{ car.make }}
          </div>
          <div class="car-card-subtitle">
            {{ car.model }}
          </div>
          <div class="car-card-price">
            ${{ Number(car.price).toLocaleString() }}
          </div>

          <router-link
            :to="`/cars/${car.id}`"
            class="view-details-button"
          >
            View more details
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter }    from 'vue-router'
import { fetchCars }    from '@/services/carService'

const router  = useRouter()
const cars    = ref([])
const filters = ref({ make: '', model: '' })

// load cars from API
const loadCars = async () => {
  try {
    cars.value = await fetchCars(filters.value)
  } catch (err) {
    console.error('Failed to load cars:', err)
  }
}

// clear token + go to login
const logout = () => {
  localStorage.removeItem('token')
  router.push('/login')
}

onMounted(loadCars)
</script>

<style scoped src="@/../css/explore.css"></style>
