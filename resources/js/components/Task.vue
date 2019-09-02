<template>
    <tr>
        <td>{{ task.title }}</td>
        <td>{{ task.priority }}</td>
        <td>
            <button  @click="remove" class="btn btn-purple" ><i class="fas fa-check"></i></button>
            
        </td>
    </tr>
</template>

<script>
export default {
  data() {
    return {
        
    }
  },
  methods: {
      remove(){
          this.$emit('delete', this.task.id)
      }
  },
  props: ['task']
}
</script>
<style>
  .btn {
    @apply font-bold py-2 px-4 rounded;
  }
  .btn-purple {
    @apply bg-purple-500 text-white;
  }
  .btn-blue:hover {
    @apply bg-purple-700;
  }
</style>