<template>
    <div id="questions mb-4">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="type">Idioma</label>
                    <select v-model="languaje" name="options[languaje]" class="form-control" id="type" required="true">
                        <option value="">Seleccione uno...</option>
                        <option value="ES">Español</option>
                        <option value="EN">Inglés</option>
                        <option value="PT">Portugués</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="type">Enunciado Versión 1</label>
                    <textarea v-model="enunciado.E1" name="options[enunciado][E1]" id="" required="true" class="form-control"></textarea>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="type">Enunciado Versión 2</label>
                    <textarea v-model="enunciado.E2" name="options[enunciado][E2]" id="" class="form-control"></textarea>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="type">Enunciado Versión 3</label>
                    <textarea v-model="enunciado.E3" name="options[enunciado][E3]" id="" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="type">Tipo de pregunta</label>
                    <select name="type" v-model="question.type" class="form-control" id="type" required="true">
                        <option value="">Seleccione uno...</option>
                        <option value="YN">Si/No</option>
                        <option value="17">Escala 1..7</option>
                        <option value="DE">Desarrollo</option>
                        <option value="TX">Texto</option>
                        <option value="NU">Número</option>
                        <option value="DT">Fecha</option>
                        <option value="EM">Email</option>
                        <option value="CB">Checkbox</option>
                        <option value="YE">Año</option>
                        <option value="SE">Selección</option>
                        <option value="RA">Radio</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="graph">Tipo de grafico</label>
                    <select name="graph" v-model="question.graph" class="form-control" id="graph">
                        <option value="">Seleccione uno...</option>
                        <option value="PIE">Torta</option>
                        <option value="BARS">Barras</option>
                        <option value="LINES">Líneas</option>
                    </select>
                </div>
            </div>
        </div>
        <div v-if="this.question.type == 'YN' || this.question.type == 'SE' || this.question.type == 'RA'" class="row">
            <div class="col-6">
                <h5>Opciones <button type="button" class="btn btn-success btn-sm" @click="opciones.push('')">+</button></h5>
            </div>
            <div class="col-12">
                <div class="row mb-2" v-for="(opcion,index) in opciones" :key="index">
                    <div class="col-6">
                        <div class="row">
                            <div class="col">
                                <input class="form-control" v-model="opciones[index]" type="text" placeholder="Texto de la opción" :name="`options[opciones][${index}]`" :id="`opciones${index}`" autocomplete="off" />
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn btn-danger btn-sm" @click="opciones.splice(index,1)">-</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Agregar opcion de seleccion multiple  -->
            <!-- Agregar Países a la pregunta de pais de residencia  -->
        </div>
        <div class="row">
            <div class="col">
                <label class="w-100">Requerido</label>
                <label class="">
                    <input v-model="required" type="radio" name="options[required]" value="1" id="option1" autocomplete="off"> Si
                </label>
                <label class="">
                    <input v-model="required" type="radio" name="options[required]" value="0" id="option2" autocomplete="off"> No
                </label>
            </div>
        </div>
        
    </div>
</template>

<script>

    export default {
        name: "questions",
        
        props: ['question'],
        
        data() {
            return {
                languaje: '',
                enunciado: {E1:'',E2:'',E3:''},
                required:'',
                opciones: [],
            }
        },

        created(){
            this.languaje = this.question.options.languaje?this.question.options.languaje:null;
            this.enunciado = this.question.options.enunciado?this.question.options.enunciado:{E1:'',E2:'',E3:''},
            this.opciones = this.question.options.opciones?this.question.options.opciones:[];
            this.required = this.question.options.required?this.question.options.required:null;
        },

        computed: {
        },

        methods: {
        }
    }
</script>

