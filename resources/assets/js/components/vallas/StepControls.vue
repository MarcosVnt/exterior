<template>
    <div class="step-wrapper" :class="{ 'active': active }">
        <button class="btn btn-primary" @click="lastStep()" :disabled="firststep">Anterior</button>
        <button class="btn btn-primary" @click="nextStep()" v-if="currentstep<4" :disabled="laststep">Siguiente</button>
        <button class="btn btn-primary" @click="enviar()" v-if="laststep">Enviar</button>
    </div>

</template>

<script>
export default {
 props: ['step', 'stepcount', 'currentstep'],

    computed: {
        active: function() {
            return (this.step.id == this.currentstep)
        },

        firststep: function() {
            return (this.currentstep == 1)
        },

        laststep: function() {
            return (this.currentstep == this.stepcount)
        }
    },

    methods: {
        nextStep: function() {
            this.$emit('step-change', this.currentstep + 1)
        },

        lastStep: function() {
            this.$emit('step-change', this.currentstep - 1)
        },
		enviar: function() {
            this.$emit('step-change', 'enviar')
        }
    }
}
</script>

<style>

body {
	 padding: 0;
	 margin: 0;
	 background-color: #f6f6f6;
	 font-family: 'Roboto', sans-serif;
}
 .container {
	 width: 1000px;
	 background-color: #fff;
}
 .step-wrapper {
	 padding: 20px 0;
	 display: none;
}
 .step-wrapper.active {
	 display: block;
}
 .step-indicator {
	 border-collapse: separate;
	 display: table;
	 margin-left: 0px;
	 position: relative;
	 table-layout: fixed;
	 text-align: center;
	 vertical-align: middle;
	 padding-left: 0;
	 padding-top: 20px;
}
 .step-indicator li {
	 display: table-cell;
	 position: relative;
	 float: none;
	 padding: 0;
	 width: 1%;
}
 .step-indicator li:after {
	 background-color: #ccc;
	 content: "";
	 display: block;
	 height: 1px;
	 position: absolute;
	 width: 100%;
	 top: 32px;
}
 .step-indicator li:after {
	 left: 50%;
}
 .step-indicator li:last-child:after {
	 display: none;
}
 .step-indicator li.active .step {
	 border-color: #4183d7;
	 color: #4183d7;
}
 .step-indicator li.active .caption {
	 color: #4183d7;
}
 .step-indicator li.complete:after {
	 background-color: #87d37c;
}
 .step-indicator li.complete .step {
	 border-color: #87d37c;
	 color: #87d37c;
}
 .step-indicator li.complete .caption {
	 color: #87d37c;
}
 .step-indicator .step {
	 background-color: #fff;
	 border-radius: 50%;
	 border: 1px solid #ccc;
	 color: #ccc;
	 font-size: 24px;
	 height: 64px;
	 line-height: 64px;
	 margin: 0 auto;
	 position: relative;
	 width: 64px;
	 z-index: 1;
}
 .step-indicator .step:hover {
	 cursor: pointer;
}
 .step-indicator .caption {
	 color: #ccc;
	 padding: 11px 16px;
}
</style>
