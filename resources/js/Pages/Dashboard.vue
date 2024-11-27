<script setup>
import Main from "./Layout/Main.vue";
import { defineProps, ref, onMounted } from "vue";
import { Chart } from "chart.js";
import {
  CategoryScale,
  LinearScale,
  BarElement,
  BarController,
  Title,
  Tooltip,
  Legend
} from 'chart.js';

Chart.register(CategoryScale, LinearScale, BarElement,BarController, Title, Tooltip, Legend);

const props = defineProps({
  totalTask: {
    type: Number,
    required: true,
  },
  totalSubTask: {
    type: Number,
    required: true,
  },
  project: {
    type: Object,
    required: true,
  },
});


// fetch chart
const statusCounts = ref([]);
const fetchStatistics = async () => {
  try {
    const response = await fetch('/api/task-statistics');
    const data = await response.json();
    statusCounts.value = data.statusCounts;
    renderChart();
  } catch (error) {
    console.error('Error fetching task statistics:', error);
  }
};

// render chart
const renderChart = () => {
  const ctx = document.getElementById('statusChart');
  new Chart(ctx, {
    type: 'bar', // Bar chart type
    data: {
      labels: statusCounts.value.map((status) => `Status ${status.status}`), // Status labels
      datasets: [
        {
          label: 'Task Status Counts',
          data: statusCounts.value.map((status) => status.count), // Status counts
          backgroundColor: 'rgba(75, 192, 192, 0.2)', // Bar color
          borderColor: 'rgba(75, 192, 192, 1)', // Bar border color
          borderWidth: 1,
        },
      ],
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true, // Start Y axis from 0
          type: 'linear', // Explicitly set the scale type
        },
      },
    },
  });
};

onMounted(() => {
  fetchStatistics();
}); 
</script>


<template>
  <Main>
    <h1 class="text-2xl font-bold">Dashboard</h1>

    <!-- Card Stats -->
    <div class="grid grid-cols-4 gap-3 mt-3">
      <div class="card">
        <div class="stats shadow bg-base-200 rounded-lg flex flex-col">
          <div class="stat">
            <div class="stat-title text-lg font-semibold">
              Total Tasks Assigned
            </div>
            <div class="stat-value">{{ totalTask }}</div>
            <div class="stat-desc px-4">21% more than last month</div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="stats shadow bg-base-200 rounded-lg">
          <div class="stat flex items-center justify-between">
            <div class="stat-title">Total Sub Task</div>
            <div class="stat-value">{{ totalSubTask }}</div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="stats shadow bg-base-200 rounded-lg">
          <div class="stat flex items-center justify-between">
            <div class="stat-title">Total Page Views</div>
            <div class="stat-value">89,400</div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="stats shadow bg-base-200 rounded-lg">
          <div class="stat flex items-center justify-between">
            <div class="stat-title">Total Page Views</div>
            <div class="stat-value">89,400</div>
          </div>
        </div>
      </div>
    </div>

    <div class="divider"></div>

    <!-- Latest Notes -->
    <h1 class="text-2xl font-bold my-3">All Project</h1>

    <div class="grid grid-cols-12 gap-3">
      <!-- Left -->
      <div class="col-span-8">
        <div class="overflow-x-auto">
          <table class="table">
            <!-- head -->
            <thead>
              <tr>
                <th></th>
                <th>Project Name</th>
                <th>Due Date</th>
                <th>Creator</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, id) in props.project" :key="id" class="hover">
                <th>{{ item.id }}</th>
                <td>{{ item.project_title }}</td>
                <td>Desktop Support Technician</td>
                <td>Purple</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- Right -->
      <div class="col-span-4">
        <h1 class="text-2xl font-bold my-3">Goal Tracking</h1>
        <canvas id="statusChart"></canvas>
      </div>
    </div>
  </Main>
</template>