<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">FOTO ALTA DESCRIPCION</a></li>
            </ol>

            {{obra}}

            <foto-obra-dropzone></foto-obra-dropzone>






        </main>
</template>

<script>
    export default {
           props: {
            obra : Object
        },
        data: function data() {
            return {
            }
        },
        mounted() {
            console.log('OBRA ALTA : mounted', this.obra);
        },
        methods: {
        }
    }
</script>
<style>    
    
</style>
